<?php
class Sopages_model extends CI_Model{
	function productwise_total($date){
		return $this->db->query("SELECT acct_date,SUM(net_sales)as net_sales,SUM(test_litres) as test_litres,b.product_name,
    (SELECT SUM(quantity) FROM retail_bills r join bill_details b ON b.bill_no = r.bill_number where product = b.product_name and r.sale_mode = 'Indent_sales' and acct_date = a.acct_date) as Indent_sales,
    (SELECT SUM(quantity) FROM retail_bills r join bill_details b ON b.bill_no = r.bill_number where product = b.product_name and r.sale_mode = 'Credit_card_sales' and acct_date = a.acct_date) as Credit_sales,
    (SELECT SUM(quantity) FROM retail_bills r join bill_details b ON b.bill_no = r.bill_number where product = b.product_name and r.sale_mode = 'Fleet_card_sales' and acct_date = a.acct_date) as fleet_sales,
    (SELECT SUM(quantity) FROM retail_bills r join bill_details b ON b.bill_no = r.bill_number where product = b.product_name and r.sale_mode = 'Xtra_reward_sales' and acct_date = a.acct_date) as xr_sales
from petrol_sales_entry a join pump_master b ON b.pump_no = a.pump_no where acct_date = '$date' group by b.product_name")->result_array();
	}
	
	function otherpdts_total($date){
		return $this->db->query("select acct_date,product,sum(quantity) as qty,    
    (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Cash_sales' and o.product = q.product and p.acct_date = m.acct_date) as bcs_qty,
    (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Indent_sales' and o.product = q.product and p.acct_date = m.acct_date) as is_qty,
    (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Credit_card_sales' and o.product = q.product and p.acct_date = m.acct_date) as cs_qty,
    (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Fleet_card_sales' and o.product = q.product and p.acct_date = m.acct_date) as fs_qty,
    (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Xtra_reward_sales' and o.product = q.product and p.acct_date = m.acct_date) as xr_qty
from other_pdts_bill m join other_pdts_bill_details q ON q.bill_no = m.bill_no where m.acct_date = '2013-09-26'
group by q.product")->result_array();
	}
	
	function get_tank_list(){
		return $this->db->query("select * from tank_master where status=1")->result_array();
	}
	
	function get_stockloss($tank,$month,$year){
		return $this->db->query("Select account_date as 'Date',volume,(select quantity from tank_loading_register where tank_name=p.tank_no and delivery_date=p.account_date)as received,
		(select SUM(net_sales) from petrol_sales_entry where pump_no in (select pump_no from pump_master where tank_no=p.tank_no) 
		and acct_date=p.account_date) as sold,(select SUM(test_litres) from petrol_sales_entry where pump_no in (select pump_no
		from pump_master where tank_no=p.tank_no) and acct_date=p.account_date) as test from tank_stock p where tank_no='$tank' AND 
		month(account_date)='$month' and year(account_date)='$year'")->result_array();
	}
	
function fetch_fuel_stock($start,$end)
	{
	$query=$this->db->query("SELECT product.product,ifnull(stock.opening,0) as opening_stock,ifnull(purchase,0) as Purchase,(ifnull(stock.opening,0)+ifnull(purchase,0)) as Total,ifnull(sales.net_sales,0) as Sales,(ifnull(stock.opening,0)+ifnull(purchase,0)-ifnull(sales.net_sales,0)) as Closing_Stock
							FROM
							(SELECT product from tank_stock group by product) as product
							LEFT JOIN
							(SELECT product,sum(volume) as opening
							from tank_stock
							WHERE account_date = '$start'
							GROUP BY product) as stock ON (stock.product = product.product) 
							
							LEFT JOIN (SELECT item_name,SUM(quantity) as purchase
							FROM pet_pur_entry ppe JOIN pet_pur_entry_details pped
							ON(ppe.voucher_no=pped.voucher_no)
							Where  ppe.account_date BETWEEN '$start' AND '$end'
							GROUP BY item_name) as purchase ON(product.product=purchase.item_name)   LEFT JOIN (SELECT SUM(net_sales) AS net_sales ,pm.product_name
							FROM petrol_sales_entry ps  JOIN pump_master pm 
							on(ps.pump_no=pm.pump_no)
							WHERE acct_date BETWEEN '$start' AND '$end'
							GROUP BY pm.product_name) as sales ON(product.product=sales.product_name)
							UNION 
							SELECT 'Total',SUM(ifnull(stock.opening,0)) as opening_stock,SUM(ifnull(purchase,0)) as Purchase,SUM((ifnull(stock.opening,0)+ifnull(purchase,0))) as Total,SUM(ifnull(sales.net_sales,0)) as Sales,SUM((ifnull(stock.opening,0)+ifnull(purchase,0)-ifnull(sales.net_sales,0))) as Closing_Stock
								FROM
								(SELECT product from tank_stock group by product) as product
									LEFT JOIN
								(SELECT product,sum(volume) as opening
							from tank_stock
							WHERE account_date = '$start'
							GROUP BY product) as stock ON (stock.product = product.product)
							
							LEFT JOIN (SELECT item_name,SUM(quantity) as purchase
							FROM pet_pur_entry ppe JOIN pet_pur_entry_details pped
							ON(ppe.voucher_no=pped.voucher_no)
							Where  ppe.account_date BETWEEN '$start' AND '$end'
							GROUP BY item_name) as purchase ON(product.product=purchase.item_name)   LEFT JOIN (SELECT SUM(net_sales) AS net_sales ,pm.product_name
							FROM petrol_sales_entry ps  JOIN pump_master pm 
							on(ps.pump_no=pm.pump_no)
							WHERE acct_date BETWEEN '$start' AND '$end'
							GROUP BY pm.product_name) as sales ON(product.product=sales.product_name)");
	return $query->result();
	}
	function fetch_2toil_stock($start,$end)
	{
					$query=$this->db->query("SELECT prm.product_name,(ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0)-ifnull(open_sale_2.QTy,0)) as Opening_Stock,
											ifnull(purchase.purchase,0) as purchase,
											((ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0)-ifnull(open_sale_2.QTy,0))+ifnull(purchase.purchase,0)) as Total,
											ifnull(sales.sales,0)+ifnull(sales_2.sales,0) as Sales ,
											((ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0)-ifnull(open_sale_2.QTy,0))+ifnull(purchase.purchase,0)-ifnull(sales.sales,0)-ifnull(sales_2.sales,0)) as Closing_Stock
											FROM product_master prm JOIN pump_master pms 
											ON(prm.product_name=pms.product_name)
											LEFT JOIN (SELECT oped.item_name,SUM(oped.quantity) as QTy
											FROM other_pur_entry ope JOIN other_pur_entry_details oped
											ON(ope.voucher_no=oped.voucher_no)
											 JOIN product_master pr
											ON(pr.product_name=oped.item_name)
											WHERE oped.item_category ='2t_oil_loose' and ope.account_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
											product_master
											WHERE category='2t_oil_loose' ) and
											(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
											FROm product_master
											WHERE category='2t_oil_loose' ) 
											group by pr.product_name) AS open_purchase on( prm.product_name=OPEN_PURCHASE.item_name)
											 LEFT JOIN 
											(SELECT pm.product_name,SUM(ps.net_sales) as Qty
											FROM product_master pm JOIN pump_master pu
											ON(pm.product_name=pu.product_name)
											LEFT JOIN petrol_sales_entry ps
											ON(pu.pump_no=ps.pump_no) 
											where pm.category='2t_oil_loose' and acct_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
											product_master
											WHERE category='2t_oil_loose' ) and
											(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
											FROm product_master
											WHERE category='2t_oil_loose' ) 
											group by pm.product_name) AS open_sale on( prm.product_name=open_sale.product_name) 
											left join 
											
											(SELECT 
													opbd.product, SUM(quantity) as QTy
														FROM
															other_pdts_bill opb
															JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
															JOIN product_master pr ON (pr.product_name = opbd.product)
															WHERE
															opbd.category = '2t_oil_loose'
															and opb.acct_date BETWEEN (SELECT 
															subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1)
															FROM
															product_master
															WHERE
															category = '2t_oil_loose') and (SELECT 
															(CASE
															WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1)
															else SUBDATE('$start', 1)
															end) stupid
															FROm
															product_master
															WHERE
															category = '2t_oil_loose')
															group by pr.product_name) AS open_sale_2 on(prm.product_name=open_sale_2.product)
											
											
											
											left join (SELECT oped.item_name,SUM(oped.quantity) as purchase
											FROM other_pur_entry ope JOIN other_pur_entry_details oped
											ON(ope.voucher_no=oped.voucher_no)
											WHERE oped.item_category='2t_oil_loose' AND ope.account_date BETWEEN    '$start' and '$end'
											GRoup by item_name) as purchase
											ON(prm.product_name=purchase.item_name) left join (SELECT pm.product_name,SUM(ps.net_sales) as sales
											FROM product_master pm JOIN pump_master pu
											ON(pm.product_name=pu.product_name)
											LEFT JOIN petrol_sales_entry ps
											ON(pu.pump_no=ps.pump_no) 
											where pm.category='2t_oil_loose' and acct_date BETWEEN    '$start' and '$end'
											GROUP BY pm.product_name ) as sales ON(prm.product_name=sales.product_name)
											left join
											
											(SELECT 
        opbd.product, SUM(quantity) as sales
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    WHERE
        opbd.category = '2t_oil_loose'
            AND opb.acct_date BETWEEN '$start' and '$end'
    GROUP BY product) as sales_2 on(prm.product_name=sales.product_name)
	
											WHERE prm.category='2t_oil_loose' limit 1");
	return $query->result();
	}	
	function fetch_grease_stock($start,$end)
	{
		
		$query=$this->db->query("SELECT pm.product_name,(ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0)) as Opening_Stock,
								ifnull(purchase.purchase,0) as purchase,
								((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)) as Total,
								ifnull(sales.sales,0) as Sales ,
								((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)-ifnull(sales.sales,0)) as Closing_Stock
								FROM product_master pm  LEFT JOIN 
								(SELECT oped.item_name,SUM(oped.quantity) as QTy
								FROM other_pur_entry ope JOIN other_pur_entry_details oped
								ON(ope.voucher_no=oped.voucher_no)
								 JOIN product_master pr
								ON(pr.product_name=oped.item_name)
								WHERE oped.item_category ='grease' and ope.account_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
								product_master
								WHERE category='grease' ) and
								(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
								FROm product_master
								WHERE category='grease' ) 
								group by pr.product_name) AS open_purchase on( pm.product_name=OPEN_PURCHASE.item_name)
								LEFT JOIN 
								(SELECT opbd.product,SUM(quantity) as QTy
								FROM other_pdts_bill  opb JOIN other_pdts_bill_details opbd
								ON(opb.bill_no=opbd.bill_no)
								JOIN product_master pr
								ON(pr.product_name=opbd.product)
								WHERE opbd.category ='grease' and  opb.acct_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
								product_master
								WHERE category='grease' ) and
								(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
								FROm product_master
								WHERE category='grease' ) 
								group by pr.product_name) AS open_sale on( pm.product_name=open_sale.product)
								left join (SELECT oped.item_name,SUM(quantity) as purchase
								FROM other_pur_entry ope JOIN other_pur_entry_details oped
								WHERE oped.item_category='grease' AND ope.account_date BETWEEN    '$start' and '$end'
								GROUP BY oped.item_name) AS purchase  on(pm.product_name=purchase.item_name)
								left join (SELECT opbd.product,SUM(quantity) as sales
								FROM other_pdts_bill opb JOIN  other_pdts_bill_details opbd
								ON(opb.bill_no=opbd.bill_no)
								WHERE opbd.category='grease' AND opb.acct_date  BETWEEN    '$start' and '$end'
								GROUP BY product) AS sales on(pm.product_name=sales.product)
								WHERE PM.CATEGORY='GREASE'
								
								UNION 
								
								SELECT 'Total',SUM((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))),
								SUM(ifnull(purchase.purchase,0)),
								SUM(((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0))),
								SUM(ifnull(sales.sales,0)),
								SUM(((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)-ifnull(sales.sales,0)))
								FROM product_master pm  LEFT JOIN 
								(SELECT oped.item_name,SUM(oped.quantity) as QTy
								FROM other_pur_entry ope JOIN other_pur_entry_details oped
								ON(ope.voucher_no=oped.voucher_no)
								 JOIN product_master pr
								ON(pr.product_name=oped.item_name)
								WHERE oped.item_category ='grease' and ope.account_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
								product_master
								WHERE category='grease' ) and
								(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
								FROm product_master
								WHERE category='grease' ) 
								group by pr.product_name) AS open_purchase on( pm.product_name=OPEN_PURCHASE.item_name)
								LEFT JOIN 
								(SELECT opbd.product,SUM(quantity) as QTy
								FROM other_pdts_bill  opb JOIN other_pdts_bill_details opbd
								ON(opb.bill_no=opbd.bill_no)
								JOIN product_master pr
								ON(pr.product_name=opbd.product)
								WHERE opbd.category ='grease' and  opb.acct_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
								product_master
								WHERE category='grease' ) and
								(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
								FROm product_master
								WHERE category='grease' ) 
								group by pr.product_name) AS open_sale on( pm.product_name=open_sale.product)
								left join (SELECT oped.item_name,SUM(quantity) as purchase
								FROM other_pur_entry ope JOIN other_pur_entry_details oped
								WHERE oped.item_category='grease' AND ope.account_date BETWEEN    '$start' and '$end'
								GROUP BY oped.item_name) AS purchase  on(pm.product_name=purchase.item_name)
								left join (SELECT opbd.product,SUM(quantity) as sales
								FROM other_pdts_bill opb JOIN  other_pdts_bill_details opbd
								ON(opb.bill_no=opbd.bill_no)
								WHERE opbd.category='grease' AND opb.acct_date  BETWEEN    '$start' and '$end'
								GROUP BY product) AS sales on(pm.product_name=sales.product)
								WHERE PM.CATEGORY='GREASE'
								");
			return $query->result();
		
	}

	function fetch_oil_stock($start,$end)
	{
		
		$query=$this->db->query("SELECT pm.product_name,(ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0)) as Opening_Stock,
							ifnull(purchase.purchase,0) as purchase,
							((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)) as Total,
							ifnull(sales.sales,0) as Sales ,
							((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)-ifnull(sales.sales,0)) as Closing_Stock
							FROM product_master pm  LEFT JOIN 
							(SELECT oped.item_name,SUM(oped.quantity) as QTy
							FROM other_pur_entry ope JOIN other_pur_entry_details oped
							ON(ope.voucher_no=oped.voucher_no)
							 JOIN product_master pr
							ON(pr.product_name=oped.item_name)
							WHERE oped.item_category ='oil' and ope.account_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
							product_master
							WHERE category='oil' ) and
							(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
							FROm product_master
							WHERE category='oil' ) 
							group by pr.product_name) AS open_purchase on( pm.product_name=OPEN_PURCHASE.item_name)
							LEFT JOIN 
							(SELECT opbd.product,SUM(quantity) as QTy
							FROM other_pdts_bill  opb JOIN other_pdts_bill_details opbd
							ON(opb.bill_no=opbd.bill_no)
							JOIN product_master pr
							ON(pr.product_name=opbd.product)
							WHERE opbd.category ='oil' and  opb.acct_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
							product_master
							WHERE category='oil' ) and
							(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
							FROm product_master
							WHERE category='oil' ) 
							group by pr.product_name) AS open_sale on( pm.product_name=open_sale.product)
							left join (SELECT oped.item_name,SUM(quantity) as purchase
							FROM other_pur_entry ope JOIN other_pur_entry_details oped
							WHERE oped.item_category='oil' AND ope.account_date BETWEEN    '$start' and '$end'
							GROUP BY oped.item_name) AS purchase  on(pm.product_name=purchase.item_name)
							left join (SELECT opbd.product,SUM(quantity) as sales
							FROM other_pdts_bill opb JOIN  other_pdts_bill_details opbd
							ON(opb.bill_no=opbd.bill_no)
							WHERE opbd.category='oil' AND opb.acct_date  BETWEEN    '$start' and '$end'
							GROUP BY product) AS sales on(pm.product_name=sales.product)
							WHERE PM.CATEGORY='oil'
							
							UNION 
							
							SELECT 'Total',SUM((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))),
							SUM(ifnull(purchase.purchase,0)),
							SUM(((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0))),
							SUM(ifnull(sales.sales,0)),
							SUM(((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)-ifnull(sales.sales,0)))
							FROM product_master pm  LEFT JOIN 
							(SELECT oped.item_name,SUM(oped.quantity) as QTy
							FROM other_pur_entry ope JOIN other_pur_entry_details oped
							ON(ope.voucher_no=oped.voucher_no)
							 JOIN product_master pr
							ON(pr.product_name=oped.item_name)
							WHERE oped.item_category ='oil' and ope.account_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
							product_master
							WHERE category='oil' ) and
							(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
							FROm product_master
							WHERE category='oil' ) 
							group by pr.product_name) AS open_purchase on( pm.product_name=OPEN_PURCHASE.item_name)
							LEFT JOIN 
							(SELECT opbd.product,SUM(quantity) as QTy
							FROM other_pdts_bill  opb JOIN other_pdts_bill_details opbd
							ON(opb.bill_no=opbd.bill_no)
							JOIN product_master pr
							ON(pr.product_name=opbd.product)
							WHERE opbd.category ='oil' and  opb.acct_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
							product_master
							WHERE category='oil' ) and
							(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
							FROm product_master
							WHERE category='oil' ) 
							group by pr.product_name) AS open_sale on( pm.product_name=open_sale.product)
							left join (SELECT oped.item_name,SUM(quantity) as purchase
							FROM other_pur_entry ope JOIN other_pur_entry_details oped
							WHERE oped.item_category='oil' AND ope.account_date BETWEEN    '$start' and '$end'
							GROUP BY oped.item_name) AS purchase  on(pm.product_name=purchase.item_name)
							left join (SELECT opbd.product,SUM(quantity) as sales
							FROM other_pdts_bill opb JOIN  other_pdts_bill_details opbd
							ON(opb.bill_no=opbd.bill_no)
							WHERE opbd.category='oil' AND opb.acct_date  BETWEEN    '$start' and '$end'
							GROUP BY product) AS sales on(pm.product_name=sales.product)
							WHERE PM.CATEGORY='oil'
		");
			return $query->result();
		
	}
function fetch_others_stock($start,$end)
	{
		
		$query=$this->db->query("SELECT 
    pm.product_name,
    (ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) as Opening_Stock,
    ifnull(purchase.purchase, 0) as purchase,
    ((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0)) as Total,
    ifnull(sales.sales, 0) as Sales,
    ((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0) - ifnull(sales.sales, 0)) as Closing_Stock
FROM
    product_master pm
        LEFT JOIN
    (SELECT 
        oped.item_name, SUM(oped.quantity) as QTy
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped ON (ope.voucher_no = oped.voucher_no)
    JOIN product_master pr ON (pr.product_name = oped.item_name)
    WHERE
        oped.item_category = 'others'
            and ope.account_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1)
            FROM
                product_master
            WHERE
                category = 'others') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'others')
    group by pr.product_name) AS open_purchase ON (pm.product_name = OPEN_PURCHASE.item_name)
        LEFT JOIN
    (SELECT 
        opbd.product, SUM(quantity) as QTy
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    JOIN product_master pr ON (pr.product_name = opbd.product)
    WHERE
        opbd.category = 'others'
            and opb.acct_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1)
            FROM
                product_master
            WHERE
                category = 'others') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'others')
    group by pr.product_name) AS open_sale ON (pm.product_name = open_sale.product)
        left join
    (SELECT 
        oped.item_name, SUM(quantity) as purchase
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped
    WHERE
        oped.item_category = 'others'
            AND ope.account_date BETWEEN '$start' and '$end'
    GROUP BY oped.item_name) AS purchase ON (pm.product_name = purchase.item_name)
        left join
    (SELECT 
        opbd.product, SUM(quantity) as sales
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    WHERE
        opbd.category = 'others'
            AND opb.acct_date BETWEEN '$start' and '$end'
    GROUP BY product) AS sales ON (pm.product_name = sales.product)
WHERE
    PM.CATEGORY = 'others'
						
						UNION 
						
						SELECT 'Total',SUM((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))),
						SUM(ifnull(purchase.purchase,0)),
						SUM(((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0))),
						SUM(ifnull(sales.sales,0)),
						SUM(((ifnull(pm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)-ifnull(sales.sales,0)))
						FROM product_master pm  LEFT JOIN 
						(SELECT oped.item_name,SUM(oped.quantity) as QTy
						FROM other_pur_entry ope JOIN other_pur_entry_details oped
						ON(ope.voucher_no=oped.voucher_no)
						 JOIN product_master pr
						ON(pr.product_name=oped.item_name)
						WHERE oped.item_category ='others' and ope.account_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
						product_master
						WHERE category='others' ) and
						(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
						FROm product_master
						WHERE category='others' ) 
						group by pr.product_name) AS open_purchase on( pm.product_name=OPEN_PURCHASE.item_name)
						LEFT JOIN 
						(SELECT opbd.product,SUM(quantity) as QTy
						FROM other_pdts_bill  opb JOIN other_pdts_bill_details opbd
						ON(opb.bill_no=opbd.bill_no)
						JOIN product_master pr
						ON(pr.product_name=opbd.product)
						WHERE opbd.category ='others' and  opb.acct_date BETWEEN (SELECT subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) FROM 
						product_master
						WHERE category='others' ) and
						(SELECT (CASE  WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)),'%Y-%m-%d'),1) else  SUBDATE('$start',1) end )stupid 
						FROm product_master
						WHERE category='others' ) 
						group by pr.product_name) AS open_sale on( pm.product_name=open_sale.product)
						left join (SELECT oped.item_name,SUM(quantity) as purchase
						FROM other_pur_entry ope JOIN other_pur_entry_details oped
						WHERE oped.item_category='others' AND ope.account_date BETWEEN    '$start' and '$end'
						GROUP BY oped.item_name) AS purchase  on(pm.product_name=purchase.item_name)
						left join (SELECT opbd.product,SUM(quantity) as sales
						FROM other_pdts_bill opb JOIN  other_pdts_bill_details opbd
						ON(opb.bill_no=opbd.bill_no)
						WHERE opbd.category='others' AND opb.acct_date  BETWEEN    '$start' and '$end'
						GROUP BY product) AS sales on(pm.product_name=sales.product)
						WHERE PM.CATEGORY='others'
		");
		return $query->result();
		
	}
	
	function get_sales_chart($sdate,$edate,$filter,$var){
		if($filter!='date' and $filter!='month'){
			if($filter=='allshift'){
				$shift="";
			}
			else{
				$shift="and shift='$filter'";
			}
			return $this->db->query("select acct_date as acct_dates,shift,pump_no,open_reading,
			close_reading,sales_litres,test_litres,net_sales,rate,amount  from petrol_sales_entry
			where acct_date between '$sdate' and '$edate' $shift order by acct_date,shift,pump_no")->result_array();
		}
		else if ($filter=='date'){
			return $this->db->query("select acct_date as acct_dates,pump_no,(select open_reading from petrol_sales_entry e 
			where shift=(select min(shift) from petrol_sales_entry where acct_date=p.acct_date and pump_no=p.pump_no)
			and pump_no=p.pump_no and acct_date=p.acct_date) as open_rdng,(select close_reading from petrol_sales_entry e where 
			shift=(select max(shift) from petrol_sales_entry where acct_date=p.acct_date and pump_no=p.pump_no)
			and pump_no=p.pump_no and acct_date=p.acct_date) as close_rdng,sum(net_sales) as Sale_ltrs,rate,sum(test_litres) as test_ltrs,sum(amount)as 'Amount' 
			from petrol_sales_entry p where acct_date between '$sdate' and '$edate' group by acct_date,pump_no 
			order by acct_date,pump_no")->result_array();
		}
		else{
			return $this->db->query("SELECT monthname(ACCT_DATE) AS acct_dates,pump_no,(SELECT open_reading FROM petrol_sales_entry WHERE pump_no=p.pump_no AND 
			SHIFT=(select min(shift) from petrol_sales_entry where acct_date=(select min(acct_date) from petrol_sales_entry where 
			MONTH(acct_date)=MONTH(p.acct_date) and pump_no=p.pump_no)  and pump_no=p.pump_no) AND ACCT_DATE=(select min(acct_date) 
			from petrol_sales_entry where MONTH(acct_date)=MONTH(p.acct_date)  and pump_no=p.pump_no)) AS open_rdng,(SELECT close_reading 
			FROM petrol_sales_entry WHERE pump_no=p.pump_no AND SHIFT=(select max(shift) from petrol_sales_entry where acct_date=
			(select max(acct_date) from petrol_sales_entry where MONTH(acct_date)=MONTH(p.acct_date) and pump_no=p.pump_no)  and
			pump_no=p.pump_no) AND ACCT_DATE=(select max(acct_date) from petrol_sales_entry where MONTH(acct_date)=MONTH(p.acct_date)  
			and pump_no=p.pump_no)) AS close_rdng,SUM(net_sales)  as Sale_ltrs,SUM(test_litres) as test_ltrs,SUM(amount) as 'Amount'  FROM PETROL_SALES_ENTRY P 
			WHERE ACCT_DATE BETWEEN '$sdate' AND '$edate' GROUP BY MONTH(ACCT_DATE),PUMP_NO")->result_array();
		}
	}
function fetch_chart_details($TOT,$sdate,$edate)
		{
		$Sales_Type="";
		$Sales_Details="";
		 $result=$this->db->query("SELECT 'CashSales',ifnull(SUM(Cash_sales),0) as Cash_Sales
						FROM
						(select SUM(indent.sales) as 'Indent_sales',SUM(credit.sales) as 'Credit_card_sales',SUM(xreward.sales) as 'XtraReward_sales',SUM(xpower.sales) as 'XtraPower_sales',SUM(easy.sales) as 'Easy_fuel_sales',SUM(cheque.sales) as 'Cheque_sales', SUM(ifnull(tot.sales,0) - (ifnull(indent.sales,0) + ifnull(credit.sales,0) + ifnull(xreward.sales,0) + ifnull(xpower.sales,0) + ifnull(easy.sales,0) + ifnull(cheque.sales,0))) as 'Cash_sales',SUM(tot.sales) as 'Total_sales'
						from
						(SELECT b.product_category,a.acct_date FROM bill_details b join retail_bills a on a.bill_number=b.bill_no  where a.acct_date between '$sdate' and '$edate' group by a.acct_date,b.product_category ) as product
						left join
						(select a.acct_date,c.category,sum(amount) as sales from petrol_sales_entry a join pump_master b on b.pump_no=a.pump_no join product_master c on c.product_name=b.product_name group by a.acct_date, c.category
						) as tot on tot.category=product.product_category and tot.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Indent_sales'  group by a.acct_date,b.product_category
						) as indent on indent.product_category=product.product_category and indent.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Credit_card_sales'  group by a.acct_date,b.product_category
						) as credit on credit.product_category=product.product_category and credit.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Xtra_reward_sales'  group by a.acct_date,b.product_category
						) as xreward on xreward.product_category=product.product_category and xreward.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Fleet_card_sales'  group by a.acct_date,b.product_category
						) as xpower on xpower.product_category=product.product_category and xpower.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Easy_fuel_sales'  group by a.acct_date,b.product_category
						) as easy on easy.product_category=product.product_category and easy.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Cheque_sales'  group by a.acct_date,b.product_category
						) as cheque on cheque.product_category=product.product_category and cheque.acct_date=product.acct_date
						
						union
						
						select SUM(indent.sales) as 'Indent_sales',SUM(credit.sales) as 'Credit_card_sales',
						SUM(xreward.sales) as 'XtraReward_sales',SUM(xpower.sales) as 'XtraPower_sales',SUM(easy.sales) as 'Easy_fuel_sales',SUM(cheque.sales) as 'Cheque_sales',
						SUM(ifnull(tot.sales,0) - (ifnull(indent.sales,0) + ifnull(credit.sales,0) + ifnull(xreward.sales,0) + ifnull(xpower.sales,0) + ifnull(easy.sales,0) + ifnull(cheque.sales,0))) as 'Cash_sales',SUM(tot.sales) as 'Total_sales'
						from
						(SELECT b.category,a.acct_date FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where a.acct_date between '$sdate' and '$edate' group by a.acct_date ) as product
						left join
						(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no  group by a.acct_date
						) as tot on  tot.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Indent_sales'  group by a.acct_date
						) as indent on  indent.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Credit_card_sales'  group by a.acct_date
						) as credit on  credit.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Xtra_reward_sales'  group by a.acct_date
						) as xreward on  xreward.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Fleet_card_sales'  group by a.acct_date
						) as xpower on  xpower.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Easy_fuel_sales'  group by a.acct_date
						) as easy on  easy.acct_date=product.acct_date
						left join
						(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Cheque_sales'  group by a.acct_date
						) as cheque on  cheque.acct_date=product.acct_date) as y
						UNION
						SELECT 'IndentSales',SUM(sales) as Indent_Sales
						from
						(select sum(value) as sales
						FROM bill_details b join retail_bills a on a.bill_number=b.bill_no
						where  a.sale_mode='Indent_sales' and  a.acct_date between '$sdate' and '$edate'
						union
						SELECT SUM(b.value) as sales
						FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no
						where  a.sale_mode='Indent_sales' and  a.acct_date between '$sdate' and '$edate') as I
						UNION
						SELECT 'CreditSales',SUM(sales) as Credit
						FROM
						(SELECT  ifnull(SUM(b.value),0) as sales
						FROM bill_details b join retail_bills a on a.bill_number=b.bill_no
						where  a.sale_mode='Credit_card_sales'  and  a.acct_date between '$sdate' and '$edate'
						union
						SELECT ifnull(SUM(b.value),0) as sales
						FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no
						where   a.sale_mode='Credit_card_sales'  and  a.acct_date between '$sdate' and '$edate') as CC
						UNION
						SELECT 'XtraRewardSales',SUM(sales) as XtraReward
						FROM
						(SELECT ifnull(SUM(b.value),0) as sales
						FROM bill_details b join retail_bills a on a.bill_number=b.bill_no
						where  a.sale_mode='Xtra_reward_sales' and  a.acct_date between '$sdate' and '$edate'
						union
						SELECT ifnull(SUM(b.value),0) as sales
						FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no
						where   a.sale_mode='Xtra_reward_sales'  and  a.acct_date between '$sdate' and '$edate') as XR
						UNION
						SELECT 'Fleetcardsales',SUM(sales) as XtraPower
						FROM
						(SELECT ifnull(SUM(b.value),0) as sales
						FROM bill_details b join retail_bills a on a.bill_number=b.bill_no
						where  a.sale_mode='Fleet_card_sales' and  a.acct_date between '$sdate' and '$edate'
						union
						SELECT ifnull(SUM(b.value),0) as sales
						FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no
						where   a.sale_mode='Fleet_card_sales'  and  a.acct_date between '$sdate' and '$edate') as XP
						UNION
						SELECT 'Easyfuelsales',SUM(sales) as EasyFuel
						FROM
						(SELECT ifnull(SUM(b.value),0) as sales
						FROM bill_details b join retail_bills a on a.bill_number=b.bill_no
						where  a.sale_mode='Easy_fuel_sales' and  a.acct_date between '$sdate' and '$edate'
						union
						SELECT ifnull(SUM(b.value),0) as sales
						FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no
						where   a.sale_mode='Easy_fuel_sales'  and  a.acct_date between '$sdate' and '$edate') as EF
						UNION
						SELECT 'Chequesales',SUM(sales) as ChequeSales
						FROM
						(SELECT ifnull(SUM(b.value),0) as sales
						FROM bill_details b join retail_bills a on a.bill_number=b.bill_no
						where  a.sale_mode='Cheque_sales' and  a.acct_date between '$sdate' and '$edate'
						union
						SELECT ifnull(SUM(b.value),0) as sales
						FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no
						where   a.sale_mode='Cheque_sales'  and  a.acct_date between '$sdate' and '$edate') as CS
						")->result_array();
		if(!empty($result)){
		foreach($result as $res){
			$Sales_Type[]=$res['CashSales'];
			$Sales_Details[]=$res['Cash_Sales'];
		} 
		}else{
			$Sales_Type[]='';
			$Sales_Details[]="";
		}
		if ($TOT == "true")
		{
		return $Sales_Type;	
		}else {
		return $Sales_Details;	
		}
			
		}
		function fetch_fuel_details($PT,$product,$sdate,$edate)
		{
		$result=$this->db->query(" select acct_date as acct_dates,product_name,SUM(net_sales) as Sales
      from petrol_sales_entry pes JOIN pump_master pm
      ON(pes.pump_no=pm.pump_no)
			where acct_date between '$sdate' and '$edate' and product_name ='$product'
      GROUP BY acct_date,product_name ")->result_array();
		if(!empty($result)){
		foreach($result as $res){
			$acct_date[]=$res['acct_dates'];
			$sales_details[]=$res['Sales'];
		} 
		}else{
			$acct_date[]='';
			$sales_details[]="";
		}
		if ($PT == "true")
		{
		return $acct_date;	
		}else {
		return $sales_details;	
		}
		}
		function fetch_oil_details($sdate,$edate)
		{
		$result=$this->db->query(" select acct_date as acct_dates,product_name,SUM(net_sales) as Sales
      from petrol_sales_entry pes JOIN pump_master pm
      ON(pes.pump_no=pm.pump_no)
			where acct_date between '$sdate' and '$edate' and product_name ='2TOIL_LOOSE'
      GROUP BY acct_date,product_name ")->result_array();
		if(!empty($result)){
		foreach($result as $res){
			$acct_date[]=$res['acct_dates'];
			$sales_details[]=$res['Sales'];
		} 
		}
		return $sales_details;
		}
}