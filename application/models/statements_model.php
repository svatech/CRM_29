<?php
class Statements_model extends CI_Model{
	function pumpwise_total($shift,$date){
		return $this->db->query("Select p.pump_no,(select product_name from pump_master m 
		where status=1 and m.pump_no=p.pump_no) as product_name,open_reading,close_reading,
		sales_litres,(select sum(test_qty) from testing_register m where m.shift=p.shift 
		and m.account_date=p.acct_date and m.pump_no=p.pump_no) as 'test_litres',
		net_sales,rate,amount,(select sum(quantity) from bill_details 
		b join retail_bills r on r.bill_number=b.bill_no where r.pump_number=p.pump_no and 
		b.product_category='FUEL' and r.shift=p.shift and r.acct_date=p.acct_date and 
		r.sale_mode='Indent_sales') as Indent_sales,(select sum(quantity) from bill_details b 
		join retail_bills r on r.bill_number=b.bill_no where r.pump_number=p.pump_no and 
		b.product_category='FUEL' and r.shift=p.shift and r.acct_date=p.acct_date and 
		r.sale_mode='Credit_card_sales') as credit_card_sales,(select sum(quantity) from 
		bill_details b join retail_bills r on r.bill_number=b.bill_no where 
		r.pump_number=p.pump_no and b.product_category='FUEL' and r.shift=p.shift and 
		r.acct_date=p.acct_date and r.sale_mode='Fleet_card_sales') as Fleet_sales,
		(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and r.shift=p.shift and 
		r.acct_date=p.acct_date and r.sale_mode='Xtra_reward_sales') as XR_sales,
		(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and r.shift=p.shift and 
		r.acct_date=p.acct_date and r.sale_mode='Easy_fuel_sales') as EF_sales,
		(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and r.shift=p.shift and 
		r.acct_date=p.acct_date and r.sale_mode='Cheque_sales') as CH_sales,
		(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and r.shift=p.shift and 
		r.acct_date=p.acct_date and r.sale_mode='Cash_sales') as cash_sales from 
		petrol_sales_entry p join pump_master m on (m.pump_no=p.pump_no) join product_master 
		s on(s.product_name=m.product_name)  where p.shift='$shift' and p.acct_date='$date' 
		and s.category='FUEL' group by p.pump_no;")->result_array();
	}
	function pumpwise_total_shift3($shift,$date){
		return $this->db->query("Select p.pump_no,(select product_name from pump_master m 
		where status=1 and m.pump_no=p.pump_no) as product_name,open_reading,close_reading,
		sales_litres,(select sum(test_qty) from testing_register m where m.shift=p.shift 
		and m.account_date=p.acct_date and m.pump_no=p.pump_no) as 'test_litres',net_sales,rate,amount,(select sum(quantity) from bill_details b
		join retail_bills r on r.bill_number=b.bill_no where r.pump_number=p.pump_no and 
		b.product_category='FUEL' and r.shift=p.shift and (date(r.bill_time)=p.acct_date or 
		( date(r.bill_time)=DATE_ADD(p.acct_date, INTERVAL 1 DAY) and 
		time(r.bill_time) < '08:00:00')) and r.sale_mode='Indent_sales') as Indent_sales,
		(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and r.shift=p.shift and 
		date(r.bill_time)=p.acct_date and r.sale_mode='Credit_card_sales') as credit_card_sales,
		(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and r.shift=p.shift and 
		date(r.bill_time)=p.acct_date and r.sale_mode='Fleet_card_sales') as Fleet_sales,
		(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no
		where r.pump_number=p.pump_no and b.product_category='FUEL' and r.shift=p.shift and
		date(r.bill_time)=p.acct_date and r.sale_mode='Xtra_reward_sales') as XR_sales,
		(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no
		where r.pump_number=p.pump_no and b.product_category='FUEL' and r.shift=p.shift and 
		(date(r.bill_time)=p.acct_date or ( date(r.bill_time)=DATE_ADD(p.acct_date, 
		INTERVAL 1 DAY) and time(r.bill_time) < '08:00:00')) and r.sale_mode='Cash_sales') 
		as cash_sales from petrol_sales_entry p join pump_master m on (m.pump_no=p.pump_no)
		join product_master s on(s.product_name=m.product_name) where p.shift='$shift' 
		and p.acct_date='$date' and s.category='FUEL'  group by p.pump_no;")->result_array();
	}
	function loose_oil_total($shift,$date){
		return $this->db->query("Select p.pump_no,(select product_name from pump_master m 
		where status=1 and m.pump_no=p.pump_no) as product_name,open_reading,close_reading,
		sales_litres,(select sum(test_qty) from testing_register m where m.shift=p.shift 
		and m.account_date=p.acct_date and m.pump_no=p.pump_no) as 'test_litres',net_sales,rate,amount,(select sum(quantity) from bill_details 
		b join retail_bills r on r.bill_number=b.bill_no where r.twotoil_pump = p.pump_no and 
		b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date and r.shift=p.shift and 
		r.sale_mode='Indent_sales') as Indent_sales,(select sum(quantity) from bill_details b 
		join retail_bills r on r.bill_number=b.bill_no where r.twotoil_pump = p.pump_no and 
		b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date and r.shift=p.shift and 
		r.sale_mode='Credit_card_sales') as credit_card_sales,(select sum(quantity) from
		 bill_details b join retail_bills r on r.bill_number=b.bill_no where 
		 r.twotoil_pump = p.pump_no and b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date 
		 and r.shift=p.shift and r.sale_mode='Fleet_card_sales') as Fleet_sales,(select sum(quantity) from 
		 bill_details b join retail_bills r on r.bill_number=b.bill_no where 
		 r.twotoil_pump = p.pump_no and b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date 
		 and r.shift=p.shift and r.sale_mode='Xtra_reward_sales') as XR_sales,(select sum(quantity) from 
		 bill_details b join retail_bills r on r.bill_number=b.bill_no where 
		 r.twotoil_pump = p.pump_no and b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date 
		 and r.shift=p.shift and r.sale_mode='Easy_fuel_sales') as EF_sales,
		 (select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no where 
		 r.twotoil_pump = p.pump_no and b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date 
		 and r.shift=p.shift and r.sale_mode='Cheque_sales') as CH_sales,
		 (select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no where r.twotoil_pump = p.pump_no 
		 and b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date and r.shift=p.shift and 
		 r.sale_mode='Cash_sales') as cash_sales from petrol_sales_entry p join pump_master m 
		 on (m.pump_no=p.pump_no) join product_master s on(s.product_name=m.product_name)  
		 where  p.acct_date='$date' and p.shift='$shift' and s.category='2T_OIL_LOOSE' group by p.pump_no;")->result_array();
	}
	function other_pdt_tot($date){
		/*return $this->db->query("select product, sum(quantity) as qty, sum(value) as amt,
		 * (select sum(quantity)  from other_pdts_bill_details o join other_pdts_bill p on 
		 * (p.bill_no=o.bill_no) where p.sale_mode='Cash_sales' and o.product=m.product and 
		 * date(p.bill_time)=date(m.bill_time)) as bcs_qty,(select sum(value)  
		 * from other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) 
		 * where p.sale_mode='Cash_sales' and o.product=m.product and date(p.bill_time)=
		 * date(m.bill_time)) as bcs_rs ,(select sum(quantity)  from other_pdts_bill_details o 
		 * join other_pdts_bill p on (p.bill_no=o.bill_no) where p.sale_mode='Indent_sales' 
		 * and o.product=m.product and date(p.bill_time)=date(m.bill_time)) as is_qty,(select 
		 * sum(value)  from other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=
		 * o.bill_no) where p.sale_mode='Indent_sales' and o.product=m.product and 
		 * date(p.bill_time)=date(m.bill_time)) as is_rs,(select sum(quantity)  from 
		 * other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		 * p.sale_mode='Credit_card_sales' and o.product=m.product and date(p.bill_time)=
		 * date(m.bill_time)) as cs_qty,(select sum(value)  from other_pdts_bill_details o 
		 * join other_pdts_bill p on (p.bill_no=o.bill_no) where p.sale_mode='Credit_card_sales' 
		 * and o.product=m.product and date(p.bill_time)=date(m.bill_time)) as cs_rs,(select 
		 * sum(quantity)  from other_pdts_bill_details o join other_pdts_bill p on 
		 * (p.bill_no=o.bill_no) where p.sale_mode='Fleet_card_sales' and o.product=m.product 
		 * and date(p.bill_time)=date(m.bill_time)) as fs_qty,(select sum(value)  from 
		 * other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		 * p.sale_mode='Credit_card_sales' and o.product=m.product and date(p.bill_time)=
		 * date(m.bill_time)) as fs_rs,(select sum(quantity)  from other_pdts_bill_details o 
		 * join other_pdts_bill p on (p.bill_no=o.bill_no) where p.sale_mode='Xtra_reward_sales'
		 *  and o.product=m.product and date(p.bill_time)=date(m.bill_time)) as xr_qty,
		 *  (select sum(value)  from other_pdts_bill_details o join other_pdts_bill p on 
		 *  (p.bill_no=o.bill_no) where p.sale_mode='Xtra_reward_sales' and o.product=m.product 
		 *  and date(p.bill_time)=date(m.bill_time)) as xr_rs from other_pdts_bill_details m 
		 *  where date(m.bill_time)='$date' group by m.product")->result_array();*/
		return $this->db->query("select product, sum(quantity) as qty, sum(value) as amt,
		(select sum(quantity)  from other_pdts_bill_details o join other_pdts_bill p on 
		(p.bill_no=o.bill_no) where p.sale_mode='Cash_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as bcs_qty,(select sum(value)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Cash_sales' and o.product=q.product and p.acct_date=m.acct_date)
		as bcs_rs ,(select sum(quantity)  from other_pdts_bill_details o join other_pdts_bill p 
		on (p.bill_no=o.bill_no) where p.sale_mode='Indent_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as is_qty,(select sum(value)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Indent_sales' and o.product=q.product and p.acct_date=m.acct_date ) as is_rs,(select sum(quantity)  from other_pdts_bill_details o 
		join other_pdts_bill p on (p.bill_no=o.bill_no) where p.sale_mode='Credit_card_sales' 
		and o.product=q.product and p.acct_date=m.acct_date) as cs_qty,(select 
		sum(value)  from other_pdts_bill_details o join other_pdts_bill p on 
		(p.bill_no=o.bill_no) where p.sale_mode='Credit_card_sales' and o.product=q.product 
		and p.acct_date=m.acct_date) as cs_rs,(select sum(quantity)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Fleet_card_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as fs_qty,(select sum(value)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) 
		where p.sale_mode='Fleet_card_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as fs_rs,(select sum(quantity)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Xtra_reward_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as xr_qty,(select sum(value)  
		from other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) 
		where p.sale_mode='Xtra_reward_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as xr_rs,(select sum(quantity)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Easy_fuel_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as ef_qty,(select sum(value)  
		from other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) 
		where p.sale_mode='Easy_fuel_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as ef_rs,
		(select sum(quantity)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Cheque_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as ch_qty,(select sum(value)  
		from other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) 
		where p.sale_mode='Cheque_sales' and o.product=q.product and 
		p.acct_date=m.acct_date) as ch_rs
		from other_pdts_bill m join 
		other_pdts_bill_details q on q.bill_no=m.bill_no where m.acct_date='$date' 
		group by q.product")->result_array();
	}
	function get_indent_cust_list(){
		return $this->db->query("select * from customer_master")->result_array();
	}
	function get_indent_stmt($sdate,$edate,$cust_id){
		return $this->db->query("select bill_number,customer_name,vehicle_number,shift,indent_no,total_amount,reference_no,
		product,quantity,rate,value,r.acct_date as billdate from retail_bills r join bill_details b on b.bill_no=r.bill_number 
		where sale_mode='Indent_sales'and acct_date between '$sdate' and '$edate' and indent_stmt_no='NULL'
		and cust_id='$cust_id' union
		select o.bill_no,customer_name,vehicle_no,shift,indent_no,total_amt,reference_no,product,quantity,rate,
		value,acct_date as billdate from other_pdts_bill o join other_pdts_bill_details p on p.bill_no=o.bill_no 
		where sale_mode='Indent_sales' and acct_date between '$sdate' and '$edate' and indent_stmt_no='NULL' and 
		cust_id='$cust_id' order by vehicle_number,billdate")->result_array();
			
	}
	function get_cust_addr($cust_id){
		return $this->db->query("select customer_name,address,(select sum(bill_amount) from indent_statement_bills where cust_id='$cust_id')as total_bills,(select sum(b.amount) from indent_statement_bills a join indent_stmt_payments b on a.bill_no=b.bill_no where b.cheque_status!='BOUNCED') as total_payments from customer_master where customer_id='$cust_id'")->result_array();
	}
	function get_category_list()
	{
	$query=$this->db->query("SELECT * FROM product_category");
	return $query->result();
	}
	
	function get_tank_list(){
		return $this->db->query("select * from tank_master where status=1")->result_array();
	}
	
	function fetch_fuel_stock($start,$end)
	{
	$query=$this->db->query("SELECT product.product,
    ifnull(stock.opening, 0) as opening_stock,
    ifnull(purchase, 0) as Purchase,
	ifnull(purchase_value, 0) as Purchase_value,
	(ifnull(stock.opening, 0) + ifnull(purchase, 0)) as Total,
    ifnull(sales.net_sales, 0) as Sales,
	ifnull(sales.sales_value, 0) as Sales_value,
    (ifnull(stock.opening, 0) + ifnull(purchase, 0) - ifnull(sales.net_sales, 0)) as Closing_Stock
FROM
    (SELECT 
        product
    from
        tank_stock
    group by product) as product
        LEFT JOIN
    (SELECT 
        product, sum(volume) as opening
    from
        tank_stock
    WHERE
        account_date = '$start'
    GROUP BY product) as stock ON (stock.product = product.product)
        LEFT JOIN
    (SELECT 
        item_name, SUM(quantity) as purchase,SUM(amount) as purchase_value
    FROM
        pet_pur_entry ppe
    JOIN pet_pur_entry_details pped ON (ppe.voucher_no = pped.voucher_no)
    Where
        ppe.account_date BETWEEN '$start' AND '$end'
    GROUP BY item_name) as purchase ON (product.product = purchase.item_name)
        LEFT JOIN
    (SELECT 
        SUM(net_sales) AS net_sales,SUM(amount) AS sales_value, pm.product_name
    FROM
        petrol_sales_entry ps
    JOIN pump_master pm ON (ps.pump_no = pm.pump_no)
    WHERE
        acct_date BETWEEN '$start' AND '$end'
    GROUP BY pm.product_name) as sales ON (product.product = sales.product_name) 
UNION SELECT 
    'Total',
    SUM(ifnull(stock.opening, 0)) as opening_stock,
    SUM(ifnull(purchase, 0)) as Purchase,
	SUM(ifnull(purchase_value, 0)) as Purchase_value,
    SUM((ifnull(stock.opening, 0) + ifnull(purchase, 0))) as Total,
    SUM(ifnull(sales.net_sales, 0)) as Sales,
	SUM(ifnull(sales.sales_value, 0)) as Sales_value,
    SUM((ifnull(stock.opening, 0) + ifnull(purchase, 0) - ifnull(sales.net_sales, 0))) as Closing_Stock
FROM
    (SELECT 
        product
    from
        tank_stock
    group by product) as product
        LEFT JOIN
    (SELECT 
        product, sum(volume) as opening
    from
        tank_stock
    WHERE
        account_date = '$start'
    GROUP BY product) as stock ON (stock.product = product.product)
        LEFT JOIN
    (SELECT 
        item_name, SUM(quantity) as purchase,SUM(amount) as purchase_value
    FROM
        pet_pur_entry ppe
    JOIN pet_pur_entry_details pped ON (ppe.voucher_no = pped.voucher_no)
    Where
        ppe.account_date BETWEEN '$start' AND '$end'
    GROUP BY item_name) as purchase ON (product.product = purchase.item_name)
        LEFT JOIN
    (SELECT 
        SUM(net_sales) AS net_sales,SUM(amount) AS sales_value, pm.product_name
    FROM
        petrol_sales_entry ps
    JOIN pump_master pm ON (ps.pump_no = pm.pump_no)
    WHERE
        acct_date BETWEEN '$start' AND '$end'
    GROUP BY pm.product_name) as sales ON (product.product = sales.product_name)");
	return $query->result();
	}
	/*function fetch_2toil_stock($start,$end)
	{
					$query=$this->db->query("SELECT prm.product_name,(ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0)) as Opening_Stock,
											ifnull(purchase.purchase,0) as purchase,
											((ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)) as Total,
											ifnull(sales.sales,0) as Sales ,
											((ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)-ifnull(sales.sales,0)) as Closing_Stock
											FROM product_master prm JOIN pump_master pms 
											ON(prm.product_name=pms.product_name)
											LEFT JOIN (SELECT oped.item_name,SUM(oped.quantity) as QTy
											FROM other_pur_entry ope JOIN other_pur_entry_details oped
											ON(ope.voucher_no=oped.voucher_no)
											 JOIN product_master pr
											ON(pr.product_name=oped.item_name)
											WHERE oped.item_category ='2t_oil_loose' and ope.account_date BETWEEN (SELECT MIN(DATE(updated_date)) FROM 
											product_master
											WHERE category='2t_oil_loose' ) and
											(SELECT (CASE  WHEN DATE(updated_date) > '$start' THEN MIN(DATE(updated_date)) else  SUBDATE('$start',1) end )stupid 
											FROm product_master
											WHERE category='2t_oil_loose' ) 
											group by pr.product_name) AS open_purchase on( prm.product_name=OPEN_PURCHASE.item_name)
											 LEFT JOIN 
											(SELECT pm.product_name,SUM(ps.net_sales) as Qty
											FROM product_master pm JOIN pump_master pu
											ON(pm.product_name=pu.product_name)
											LEFT JOIN petrol_sales_entry ps
											ON(pu.pump_no=ps.pump_no) 
											where pm.category='2t_oil_loose' and acct_date BETWEEN (SELECT MIN(DATE(updated_date)) FROM 
											product_master
											WHERE category='2t_oil_loose' ) and
											(SELECT (CASE  WHEN DATE(updated_date) > '$start' THEN MIN(DATE(updated_date)) else  SUBDATE('$start',1) end )stupid 
											FROm product_master
											WHERE category='2t_oil_loose' ) 
											group by pm.product_name) AS open_sale on( prm.product_name=open_sale.product_name) left join (SELECT oped.item_name,SUM(oped.quantity) as purchase
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
											WHERE prm.category='2t_oil_loose' limit 1");
			return $query->result();
	}*/
	
	function fetch_2toil_stock($start,$end)
	{
					$query=$this->db->query("SELECT 
    prm.product_name,
    (ifnull(prm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0) - ifnull(open_sale_2.QTy, 0)) as Opening_Stock,
    ifnull(purchase.purchase, 0) as purchase,
	ifnull(purchase.purchase_value, 0) as purchase_value,
    ((ifnull(prm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0) - ifnull(open_sale_2.QTy, 0)) + ifnull(purchase.purchase, 0)) as Total,
    ifnull(sales.sales, 0) + ifnull(sales_2.sales, 0) as Sales,
	ifnull(sales.sales_value, 0) + ifnull(sales_2.sales_value, 0) as Sales_value,
    ((ifnull(prm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0) - ifnull(open_sale_2.QTy, 0)) + ifnull(purchase.purchase, 0) - ifnull(sales.sales, 0) - ifnull(sales_2.sales, 0)) as Closing_Stock
FROM
    product_master prm
        JOIN
    pump_master pms ON (prm.product_name = pms.product_name)
        LEFT JOIN
    (SELECT 
        oped.item_name, SUM(oped.quantity) as QTy
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped ON (ope.voucher_no = oped.voucher_no)
    JOIN product_master pr ON (pr.product_name = oped.item_name)
    WHERE
        oped.item_category = '2t_oil_loose'
            and ope.account_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = '2t_oil_loose') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = '2t_oil_loose')
    group by pr.product_name) AS open_purchase ON (prm.product_name = OPEN_PURCHASE.item_name)
        LEFT JOIN
    (SELECT 
        pm.product_name, SUM(ps.net_sales) as Qty
    FROM
        product_master pm
    JOIN pump_master pu ON (pm.product_name = pu.product_name)
    LEFT JOIN petrol_sales_entry ps ON (pu.pump_no = ps.pump_no)
    where
        pm.category = '2t_oil_loose'
            and acct_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = '2t_oil_loose') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = '2t_oil_loose')
    group by pm.product_name) AS open_sale ON (prm.product_name = open_sale.product_name)
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
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = '2t_oil_loose') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = '2t_oil_loose')
    group by pr.product_name) AS open_sale_2 ON (prm.product_name = open_sale_2.product)
        left join
    (SELECT 
        oped.item_name, SUM(oped.quantity) as purchase,SUM(oped.amount) as purchase_value
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped ON (ope.voucher_no = oped.voucher_no)
    WHERE
        oped.item_category = '2t_oil_loose'
            AND ope.account_date BETWEEN '$start' and '$end'
    GRoup by item_name) as purchase ON (prm.product_name = purchase.item_name)
        left join
    (SELECT 
        pm.product_name, SUM(ps.net_sales) as sales,SUM(ps.amount) as sales_value
    FROM
        product_master pm
    JOIN pump_master pu ON (pm.product_name = pu.product_name)
    LEFT JOIN petrol_sales_entry ps ON (pu.pump_no = ps.pump_no)
    where
        pm.category = '2t_oil_loose'
            and acct_date BETWEEN '$start' and '$end'
    GROUP BY pm.product_name) as sales ON (prm.product_name = sales.product_name)
        left join
    (SELECT 
        opbd.product, SUM(quantity) as sales,SUM(value) as sales_value
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    WHERE
        opbd.category = '2t_oil_loose'
            AND opb.acct_date BETWEEN '$start' and '$end'
    GROUP BY product) as sales_2 ON (prm.product_name = sales_2.product)
WHERE
    prm.category = '2t_oil_loose'
group by prm.product_name");
	return $query->result();
	}
	/* 
	 * function fetch_2toil_stock($start,$end)
	{
					$query=$this->db->query("SELECT prm.product_name,(ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0)) as Opening_Stock,
											ifnull(purchase.purchase,0) as purchase,
											((ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)) as Total,
											ifnull(sales.sales,0) as Sales ,
											((ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)-ifnull(sales.sales,0)) as Closing_Stock
											FROM product_master prm JOIN pump_master pms 
											ON(prm.product_name=pms.product_name)
											LEFT JOIN (SELECT oped.item_name,SUM(oped.quantity) as QTy
											FROM other_pur_entry ope JOIN other_pur_entry_details oped
											ON(ope.voucher_no=oped.voucher_no)
											 JOIN product_master pr
											ON(pr.product_name=oped.item_name)
											WHERE oped.item_category ='2t_oil_loose' and ope.account_date BETWEEN (SELECT MIN(DATE(updated_date)) FROM 
											product_master
											WHERE category='2t_oil_loose' ) and
											(SELECT (CASE  WHEN DATE(updated_date) > '$start' THEN MIN(DATE(updated_date)) else  SUBDATE('$start',1) end )stupid 
											FROm product_master
											WHERE category='2t_oil_loose' ) 
											group by pr.product_name) AS open_purchase on( prm.product_name=OPEN_PURCHASE.item_name)
											 LEFT JOIN 
											(SELECT pm.product_name,SUM(ps.net_sales) as Qty
											FROM product_master pm JOIN pump_master pu
											ON(pm.product_name=pu.product_name)
											LEFT JOIN petrol_sales_entry ps
											ON(pu.pump_no=ps.pump_no) 
											where pm.category='2t_oil_loose' and acct_date BETWEEN (SELECT MIN(DATE(updated_date)) FROM 
											product_master
											WHERE category='2t_oil_loose' ) and
											(SELECT (CASE  WHEN DATE(updated_date) > '$start' THEN MIN(DATE(updated_date)) else  SUBDATE('$start',1) end )stupid 
											FROm product_master
											WHERE category='2t_oil_loose' ) 
											group by pm.product_name) AS open_sale on( prm.product_name=open_sale.product_name) left join (SELECT oped.item_name,SUM(oped.quantity) as purchase
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
											WHERE prm.category='2t_oil_loose'
											
											
											union
											
											
											SELECT 'Total',SUM((ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))),
											SUM(ifnull(purchase.purchase,0)),
											SUM(((ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0))),
											SUM(ifnull(sales.sales,0)),
											SUM(((ifnull(prm.opening_stock,0)+ifnull(open_purchase.QTy,0)-ifnull(open_sale.QTy,0))+ifnull(purchase.purchase,0)-ifnull(sales.sales,0)))
											FROM product_master prm JOIN pump_master pms 
											ON(prm.product_name=pms.product_name)
											LEFT JOIN (SELECT oped.item_name,SUM(oped.quantity) as QTy
											FROM other_pur_entry ope JOIN other_pur_entry_details oped
											ON(ope.voucher_no=oped.voucher_no)
											 JOIN product_master pr
											ON(pr.product_name=oped.item_name)
											WHERE oped.item_category ='2t_oil_loose' and ope.account_date BETWEEN (SELECT MIN(DATE(updated_date)) FROM 
											product_master
											WHERE category='2t_oil_loose' ) and
											(SELECT (CASE  WHEN DATE(updated_date) > '$start' THEN MIN(DATE(updated_date)) else  SUBDATE('$start',1) end )stupid 
											FROm product_master
											WHERE category='2t_oil_loose' ) 
											group by pr.product_name) AS open_purchase on( prm.product_name=OPEN_PURCHASE.item_name)
											 LEFT JOIN 
											(SELECT pm.product_name,SUM(ps.net_sales) as Qty
											FROM product_master pm JOIN pump_master pu
											ON(pm.product_name=pu.product_name)
											LEFT JOIN petrol_sales_entry ps
											ON(pu.pump_no=ps.pump_no) 
											where pm.category='2t_oil_loose' and acct_date BETWEEN (SELECT MIN(DATE(updated_date)) FROM 
											product_master
											WHERE category='2t_oil_loose' ) and
											(SELECT (CASE  WHEN DATE(updated_date) > '$start' THEN MIN(DATE(updated_date)) else  SUBDATE('$start',1) end )stupid 
											FROm product_master
											WHERE category='2t_oil_loose' ) 
											group by pm.product_name) AS open_sale on( prm.product_name=open_sale.product_name) left join (SELECT oped.item_name ,SUM(oped.quantity) as purchase
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
											WHERE prm.category='2t_oil_loose'");
			return $query->result();
	}*/
	function fetch_grease_stock($start,$end)
	{
		
		$query=$this->db->query("SELECT 
    pm.product_name,
    (ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) as Opening_Stock,
    ifnull(purchase.purchase, 0) as purchase,
	ifnull(purchase.purchase_value, 0) as purchase_value,
    ((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0)) as Total,
    ifnull(sales.sales, 0) as Sales,
	ifnull(sales.sales_value, 0) as Sales_value,
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
        oped.item_category = 'grease'
            and ope.account_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'grease') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'grease')
    group by pr.product_name) AS open_purchase ON (pm.product_name = OPEN_PURCHASE.item_name)
        LEFT JOIN
    (SELECT 
        opbd.product, SUM(quantity) as QTy
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    JOIN product_master pr ON (pr.product_name = opbd.product)
    WHERE
        opbd.category = 'grease'
            and opb.acct_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'grease') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'grease')
    group by pr.product_name) AS open_sale ON (pm.product_name = open_sale.product)
        left join
    (SELECT 
        oped.item_name, SUM(quantity) as purchase,SUM(amount) as purchase_value
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped ON (ope.voucher_no=oped.voucher_no)
    WHERE
        oped.item_category = 'grease'
            AND ope.account_date BETWEEN '$start' and '$end'
    GROUP BY oped.item_name) AS purchase ON (pm.product_name = purchase.item_name)
        left join
    (SELECT 
        opbd.product, SUM(quantity) as sales,SUM(value) as sales_value
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    WHERE
        opbd.category = 'grease'
            AND opb.acct_date BETWEEN '$start' and '$end'
    GROUP BY product) AS sales ON (pm.product_name = sales.product)
WHERE
    PM.CATEGORY = 'GREASE' 
UNION SELECT 
    'Total',
    SUM((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0))),
    SUM(ifnull(purchase.purchase, 0)),
	SUM(ifnull(purchase.purchase_value, 0)),
    SUM(((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0))),
    SUM(ifnull(sales.sales, 0)),
	SUM(ifnull(sales.sales_value, 0)),
    SUM(((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0) - ifnull(sales.sales, 0)))
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
        oped.item_category = 'grease'
            and ope.account_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'grease') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'grease')
    group by pr.product_name) AS open_purchase ON (pm.product_name = OPEN_PURCHASE.item_name)
        LEFT JOIN
    (SELECT 
        opbd.product, SUM(quantity) as QTy
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    JOIN product_master pr ON (pr.product_name = opbd.product)
    WHERE
        opbd.category = 'grease'
            and opb.acct_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'grease') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'grease')
    group by pr.product_name) AS open_sale ON (pm.product_name = open_sale.product)
        left join
    (SELECT 
        oped.item_name, SUM(quantity) as purchase,SUM(amount) as purchase_value
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped ON (ope.voucher_no=oped.voucher_no)
    WHERE
        oped.item_category = 'grease'
            AND ope.account_date BETWEEN '$start' and '$end'
    GROUP BY oped.item_name) AS purchase ON (pm.product_name = purchase.item_name)
        left join
    (SELECT 
        opbd.product, SUM(quantity) as sales,SUM(value) as sales_value
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    WHERE
        opbd.category = 'grease'
            AND opb.acct_date BETWEEN '$start' and '$end'
    GROUP BY product) AS sales ON (pm.product_name = sales.product)
WHERE
    PM.CATEGORY = 'GREASE'	");
			return $query->result();
		
	}
	
	
	function fetch_oil_stock($start,$end)
	{
		
		$query=$this->db->query("SELECT 
    pm.product_name,
    (ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) as Opening_Stock,
    ifnull(purchase.purchase, 0) as purchase,
	ifnull(purchase.purchase_value, 0) as purchase_value,
    ((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0)) as Total,
    ifnull(sales.sales, 0) as Sales,
	ifnull(sales.sales_value, 0) as Sales_value,
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
        oped.item_category = 'oil'
            and ope.account_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'oil') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'oil')
    group by pr.product_name) AS open_purchase ON (pm.product_name = OPEN_PURCHASE.item_name)
        LEFT JOIN
    (SELECT 
        opbd.product, SUM(quantity) as QTy
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    JOIN product_master pr ON (pr.product_name = opbd.product)
    WHERE
        opbd.category = 'oil'
            and opb.acct_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'oil') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'oil')
    group by pr.product_name) AS open_sale ON (pm.product_name = open_sale.product)
        left join
    (SELECT 
        oped.item_name, SUM(quantity) as purchase,SUM(amount) as purchase_value
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped ON (ope.voucher_no=oped.voucher_no)
    WHERE
        oped.item_category = 'oil'
            AND ope.account_date BETWEEN '$start' and '$end'
    GROUP BY oped.item_name) AS purchase ON (pm.product_name = purchase.item_name)
        left join
    (SELECT 
        opbd.product, SUM(quantity) as sales,SUM(value) as sales_value
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    WHERE
        opbd.category = 'oil'
            AND opb.acct_date BETWEEN '$start' and '$end'
    GROUP BY product) AS sales ON (pm.product_name = sales.product)
WHERE
    PM.CATEGORY = 'oil' 
UNION SELECT 
    'Total',
    SUM((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0))),
    SUM(ifnull(purchase.purchase, 0)),
	SUM(ifnull(purchase.purchase_value, 0)),
    SUM(((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0))),
    SUM(ifnull(sales.sales, 0)),
	SUM(ifnull(sales.sales_value, 0)),
    SUM(((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0) - ifnull(sales.sales, 0)))
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
        oped.item_category = 'oil'
            and ope.account_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'oil') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'oil')
    group by pr.product_name) AS open_purchase ON (pm.product_name = OPEN_PURCHASE.item_name)
        LEFT JOIN
    (SELECT 
        opbd.product, SUM(quantity) as QTy
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    JOIN product_master pr ON (pr.product_name = opbd.product)
    WHERE
        opbd.category = 'oil'
            and opb.acct_date BETWEEN (SELECT 
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'oil') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'oil')
    group by pr.product_name) AS open_sale ON (pm.product_name = open_sale.product)
        left join
    (SELECT 
        oped.item_name, SUM(quantity) as purchase,SUM(amount) as purchase_value
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped ON (ope.voucher_no=oped.voucher_no)
    WHERE
        oped.item_category = 'oil'
            AND ope.account_date BETWEEN '$start' and '$end'
    GROUP BY oped.item_name) AS purchase ON (pm.product_name = purchase.item_name)
        left join
    (SELECT 
        opbd.product, SUM(quantity) as sales,SUM(value) as sales_value
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    WHERE
        opbd.category = 'oil'
            AND opb.acct_date BETWEEN '$start' and '$end'
    GROUP BY product) AS sales ON (pm.product_name = sales.product)
WHERE
    PM.CATEGORY = 'oil'
		");
			return $query->result();
		
	}
function fetch_others_stock($start,$end)
	{
		
		$query=$this->db->query("SELECT 
    pm.product_name,
    (ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) as Opening_Stock,
    ifnull(purchase.purchase, 0) as purchase,
	ifnull(purchase.purchase_value, 0) as purchase_value,
    ((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0)) as Total,
    ifnull(sales.sales, 0) as Sales,
	ifnull(sales.sales_value, 0) as Sales_value,
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
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'others') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
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
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'others') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'others')
    group by pr.product_name) AS open_sale ON (pm.product_name = open_sale.product)
       left join
    (SELECT 
        oped.item_name, SUM(quantity) as purchase, SUM(amount) as purchase_value
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped ON (ope.voucher_no=oped.voucher_no)
    WHERE
        oped.item_category = 'others'
            AND ope.account_date BETWEEN '$start' and '$end'
    GROUP BY oped.item_name) AS purchase ON (pm.product_name = purchase.item_name)
        left join
    (SELECT 
        opbd.product, SUM(quantity) as sales,SUM(value) as sales_value
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    WHERE
        opbd.category = 'others'
            AND opb.acct_date BETWEEN '$start' and '$end'
    GROUP BY product) AS sales ON (pm.product_name = sales.product)
WHERE
    PM.CATEGORY = 'others' 
UNION SELECT 
    'Total',
    SUM((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0))),
    SUM(ifnull(purchase.purchase, 0)),
	SUM(ifnull(purchase.purchase_value, 0)),
    SUM(((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0))),
    SUM(ifnull(sales.sales, 0)),
	SUM(ifnull(sales.sales_value, 0)),
    SUM(((ifnull(pm.opening_stock, 0) + ifnull(open_purchase.QTy, 0) - ifnull(open_sale.QTy, 0)) + ifnull(purchase.purchase, 0) - ifnull(sales.sales, 0)))
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
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'others') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
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
                subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
            FROM
                product_master
            WHERE
                category = 'others') and (SELECT 
                (CASE
                        WHEN MIN(DATE(updated_date)) > '$start' THEN subdate(str_to_date(MIN(DATE(updated_date)), '%Y-%m-%d'), 1)
                        else SUBDATE('$start', 1)
                    end) stupid
            FROm
                product_master
            WHERE
                category = 'others')
    group by pr.product_name) AS open_sale ON (pm.product_name = open_sale.product)
        left join
    (SELECT 
        oped.item_name, SUM(quantity) as purchase, SUM(amount) as purchase_value
    FROM
        other_pur_entry ope
    JOIN other_pur_entry_details oped ON (ope.voucher_no=oped.voucher_no)
    WHERE
        oped.item_category = 'others'
            AND ope.account_date BETWEEN '$start' and '$end'
    GROUP BY oped.item_name) AS purchase ON (pm.product_name = purchase.item_name)
        left join
    (SELECT 
        opbd.product, SUM(quantity) as sales,SUM(value) as sales_value
    FROM
        other_pdts_bill opb
    JOIN other_pdts_bill_details opbd ON (opb.bill_no = opbd.bill_no)
    WHERE
        opbd.category = 'others'
            AND opb.acct_date BETWEEN '$start' and '$end'
    GROUP BY product) AS sales ON (pm.product_name = sales.product)
WHERE
    PM.CATEGORY = 'others'
		");
		return $query->result();
		
	}
	
	
	function get_ebook($tank,$month,$year){
		return $this->db->query("Select account_date as 'Date',volume,(select SUM(quantity) from tank_loading_register where tank_name=p.tank_no and delivery_date=p.account_date)as received,
		(select SUM(net_sales) from petrol_sales_entry where pump_no in (select pump_no from pump_master where tank_no=p.tank_no) 
		and acct_date=p.account_date) as sold,(select SUM(test_litres) from petrol_sales_entry where pump_no in (select pump_no
		from pump_master where tank_no=p.tank_no) and acct_date=p.account_date) as test from tank_stock p where tank_no='$tank' AND 
		month(account_date)='$month' and year(account_date)='$year'")->result_array();
	}
	
	function get_indentstmt_billno(){
		$result=$this->db->query("Select indent_statement from bill_no_generator")->result_array();
		foreach($result as $res){
			$billno=$res["indent_statement"];
		}
		$newbillno=$billno+1;
		$this->db->query("Update bill_no_generator set indent_statement='$newbillno'");
		return $billno;
	}
	
	function insert_indentstmt($billno,$from_date,$to_date,$cust_id,$bill_date,$total){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into indent_statement_bills(bill_no,cust_id,from_date,to_date,bill_date,action_user,action_time,bill_amount) values('IS$billno','$cust_id','$from_date','$to_date','$bill_date','$uname','$add_date','$total')");
	}
function update_indentstmt_sms($billno){
	    $status=1;
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("update indent_statement_bills set indent_sms_status='$status' where bill_no='$billno'");
	}
function fetch_indentstmt_details($bill_no){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		return $this->db->query("SELECT * FROM customer_master LEFT JOIN indent_statement_bills
       ON customer_master.customer_id=indent_statement_bills.cust_id where bill_no='$bill_no'  and phone_number REGEXP '^[0-9]{10}$'")->result_array();
	}
	

	function update_indent_bill_amt($bill_no){
		$this->db->query("Update indent_statement_bills set bill_amount=(select sum(total_amount) from (
SELECT total_amount from retail_bills where indent_stmt_no='$bill_no' 
union 
SELECT total_amt as total from other_pdts_bill where indent_stmt_no='$bill_no' ) as tot_table) where bill_no='$bill_no'
		");
	}
	function indent_stmt_details($sdate,$edate){
		return $this->db->query("Select a.*,b.customer_name,phone_number from indent_statement_bills a join customer_master b on b.customer_id=a.cust_id where bill_date between '$sdate' and '$edate'")->result();
	}
	
	function get_indent_stmt_by_bill($bill_no){
		return $this->db->query("Select a.*,b.customer_name,(SELECT IFNULL(Sum(amount),0) from indent_stmt_payments where bill_no='$bill_no' and cheque_status!='BOUNCED') as 'paid_amt' from indent_statement_bills a join customer_master b on a.cust_id=b.customer_id where bill_no='$bill_no'")->result_array();
	}
	
	function indent_stmt_bill_details($bill_no){
		return $this->db->query("Select * from indent_stmt_payments where bill_no='$bill_no'")->result();
	}
	
	function update_indentstmtno($bill_no,$sdate,$edate,$cust_id){
		$this->db->query("Update retail_bills set indent_stmt_no='IS$bill_no' where sale_mode='Indent_sales'and acct_date between '$sdate' and '$edate' and cust_id='$cust_id' and indent_stmt_no='NULL' ");
		$this->db->query("Update other_pdts_bill set indent_stmt_no='IS$bill_no' where sale_mode='Indent_sales'and acct_date between '$sdate' and '$edate' and cust_id='$cust_id' and indent_stmt_no='NULL' ");
	}
	
	function get_indent_stmt_bill($bill_no){
		return $this->db->query("select bill_number,customer_name,vehicle_number,shift,indent_no,total_amount,reference_no,
		product,quantity,rate,value,r.acct_date as billdate from retail_bills r join bill_details b on b.bill_no=r.bill_number 
		where sale_mode='Indent_sales' and indent_stmt_no='$bill_no'
		union
		select o.bill_no,customer_name,vehicle_no,shift,indent_no,total_amt,reference_no,product,quantity,rate,
		value,acct_date as billdate from other_pdts_bill o join other_pdts_bill_details p on p.bill_no=o.bill_no 
		where sale_mode='Indent_sales' and indent_stmt_no='$bill_no'  
	    order by vehicle_number,billdate")->result_array();
	}
	
	function submit_payment($billno,$pdate,$pmode,$pamount,$chequeno,$chequedate,$bankname,$status,$ref_no){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into indent_stmt_payments(bill_no,payment_date,payment_mode,amount,cheque_no,cheque_date,bank_name,cheque_status,reference_no,action_user,action_time) values('$billno','$pdate','$pmode','$pamount','$chequeno','$chequedate','$bankname','$status','$ref_no','$uname','$add_date')");
	}
	
	function update_chequestatus($payid,$status){
		$this->db->query("Update indent_stmt_payments set cheque_status='$status' where id='$payid'");
	}
	function update_clearancedate($payid,$clearance_date){
		$this->db->query("Update indent_stmt_payments set clearance_date='$clearance_date' where id='$payid'");
	}
	
	function delete_stmt_bills($bill_no){
		return $this->db->query("Delete from indent_statement_bills where bill_no='$bill_no'");
	}
	
	function update_cancelled_stmt_bills($bill_no){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Update cancelled_indent_stmt_bills set  cancelled_user='$uname', cancelled_time='$add_date' where bill_no='$bill_no'");
	}
	function delete_stmt_payment($payid){
		return $this->db->query("Delete from indent_stmt_payments where id='$payid'");
	}
	
	function update_cancelled_stmt_payments($payid){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Update cancelled_indent_stmt_payments set  cancelled_user='$uname', cancelled_time='$add_date' where payment_id='$payid'");
	}
	
	function delete_indent_stmtno($billno){
		$this->db->query("Update retail_bills set indent_stmt_no='NULL' where indent_stmt_no='$billno'");
		$this->db->query("Update other_pdts_bill set indent_stmt_no='NULL' where indent_stmt_no='$billno'");
	}
	
	function get_indent_stmtno_by_pid($pid){
		return $this->db->query("Select b.cust_id,a.amount from indent_stmt_payments a join indent_statement_bills b on b.bill_no=a.bill_no where a.id='$pid'")->result_array();
	}
	
	function get_chequestatus($pid){
		return $this->db->query("Select a.cheque_status,b.cust_id,a.amount from indent_stmt_payments a join indent_statement_bills b on b.bill_no=a.bill_no where a.id='$pid'")->result_array();
	}
	
	function get_stmt_bills($bill_no){
		return $this->db->query("Select sum(a.amount) as tot_amt,(select cust_id from indent_statement_bills where bill_no='$bill_no') as cust_id from indent_stmt_payments a join indent_statement_bills b on b.bill_no=a.bill_no where a.cheque_status!='BOUNCED' ")->result_array();
	}
	
	function cumulative_pumpwise_total($start_date,$end_date){
		return $this->db->query("
		select pump_no,p.product_name, (select open_reading from petrol_sales_entry where acct_date between '$start_date' and '$end_date' 
		and pump_no=p.pump_no order by added_date asc limit 1 ) as open_reading,
		(select close_reading from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no order by added_date desc limit 1 ) as close_reading,
		(select sum(sales_litres) from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no) as sales_litres,
		(select sum(test_litres) from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no) as test_litres,
		(select sum(net_sales) from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no) as net_sales,
		(select sum(amount) from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no) as amount,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Indent_sales') as Indent_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Indent_sales') as Indent_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Credit_card_sales') as Credit_card_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Credit_card_sales') as Credit_card_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Fleet_card_sales') as Fleet_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Fleet_card_sales') as Fleet_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Xtra_reward_sales') as XR_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Xtra_reward_sales') as XR_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Easy_fuel_sales') as EF_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Easy_fuel_sales') as EF_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Cheque_sales') as CH_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Cheque_sales') as CH_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Cash_sales') as Cash_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.pump_number=p.pump_no and b.product_category='FUEL' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Cash_sales') as Cash_sales_rs
		 from pump_master p join product_master x on x.product_name=p.product_name where x.category!='2T_OIL_LOOSE' and p.status=1")->result_array();
	}
	
	function cumulative_loose_oil_total($start_date,$end_date){
		return $this->db->query("
		select pump_no,p.product_name, (select open_reading from petrol_sales_entry where acct_date between '$start_date' and '$end_date' 
		and pump_no=p.pump_no order by added_date asc limit 1 ) as open_reading,
		(select close_reading from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no order by added_date desc limit 1 ) as close_reading,
		(select sum(sales_litres) from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no) as sales_litres,
		(select sum(test_litres) from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no) as test_litres,
		(select sum(net_sales) from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no) as net_sales,
		(select sum(amount) from petrol_sales_entry where acct_date between '$start_date' and '$end_date' and 
		pump_no=p.pump_no) as amount,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Indent_sales') as Indent_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Indent_sales') as Indent_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Credit_card_sales') as Credit_card_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Credit_card_sales') as Credit_card_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Fleet_card_sales') as Fleet_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Fleet_card_sales') as Fleet_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Xtra_reward_sales') as XR_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Xtra_reward_sales') as XR_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Easy_fuel_sales') as EF_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Easy_fuel_sales') as EF_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Cheque_sales') as CH_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Cheque_sales') as CH_sales_rs,
		(select sum(quantity) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Cash_sales') as Cash_sales,
		 (select sum(value) from bill_details	b join retail_bills r on r.bill_number=b.bill_no 
		where r.twotoil_pump=p.pump_no and b.product_category='2T_OIL_LOOSE' and
		 r.acct_date between '$start_date' and '$end_date' and r.sale_mode='Cash_sales') as Cash_sales_rs
		 from pump_master p join product_master x on x.product_name=p.product_name where x.category='2T_OIL_LOOSE' and p.status=1")->result_array();
	}
	
	function cumulative_other_pdt_tot($start_date,$end_date){
		return $this->db->query("select product, sum(quantity) as qty, sum(value) as amt,
		(select sum(quantity)  from other_pdts_bill_details o join other_pdts_bill p on 
		(p.bill_no=o.bill_no) where p.sale_mode='Cash_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as bcs_qty,(select sum(value)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Cash_sales' and o.product=q.product and p.acct_date between '$start_date' and '$end_date')
		as bcs_rs ,(select sum(quantity)  from other_pdts_bill_details o join other_pdts_bill p 
		on (p.bill_no=o.bill_no) where p.sale_mode='Indent_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as is_qty,(select sum(value)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Indent_sales' and o.product=q.product and p.acct_date between '$start_date' and '$end_date' ) as is_rs,(select sum(quantity)  from other_pdts_bill_details o 
		join other_pdts_bill p on (p.bill_no=o.bill_no) where p.sale_mode='Credit_card_sales' 
		and o.product=q.product and p.acct_date between '$start_date' and '$end_date') as cs_qty,(select 
		sum(value)  from other_pdts_bill_details o join other_pdts_bill p on 
		(p.bill_no=o.bill_no) where p.sale_mode='Credit_card_sales' and o.product=q.product 
		and p.acct_date between '$start_date' and '$end_date') as cs_rs,(select sum(quantity)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Fleet_card_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as fs_qty,(select sum(value)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) 
		where p.sale_mode='Fleet_card_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as fs_rs,(select sum(quantity)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Xtra_reward_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as xr_qty,(select sum(value)  
		from other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) 
		where p.sale_mode='Xtra_reward_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as xr_rs,(select sum(quantity)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Easy_fuel_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as ef_qty,(select sum(value)  
		from other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) 
		where p.sale_mode='Easy_fuel_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as ef_rs,
		(select sum(quantity)  from 
		other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) where 
		p.sale_mode='Cheque_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as ch_qty,(select sum(value)  
		from other_pdts_bill_details o join other_pdts_bill p on (p.bill_no=o.bill_no) 
		where p.sale_mode='Cheque_sales' and o.product=q.product and 
		p.acct_date between '$start_date' and '$end_date') as ch_rs
		from other_pdts_bill m join 
		other_pdts_bill_details q on q.bill_no=m.bill_no where m.acct_date between '$start_date' and '$end_date'
		group by q.product")->result_array();
	}
	
	
	function get_cumulative_sales_stmt($start_date,$end_date,$category){
		if($category=='all'){
			$whr='';
		}
		else{
			$whr=" and category='$category'";
		}
		return $this->db->query("select product.acct_date as 'acct_date',product.category ,indent.sales as 'Indent_sales',credit.sales as 'Credit_card_sales',xreward.sales as 'XtraReward_sales',xpower.sales as 'XtraPower_sales',easy.sales as 'Easy_fuel_sales',cheque.sales as 'Cheque_sales', ifnull(tot.sales,0) - (ifnull(indent.sales,0) + ifnull(credit.sales,0) + ifnull(xreward.sales,0) + ifnull(xpower.sales,0) + ifnull(easy.sales,0) + ifnull(cheque.sales,0)) as 'Cash_sales',tot.sales as 'Total_sales'
from
(SELECT c.category,b.acct_date FROM petrol_sales_entry b join pump_master a on a.pump_no=b.pump_no join product_master c on c.product_name=a.product_name where b.acct_date between '$start_date' and '$end_date' $whr group by b.acct_date,c.category) as product  
left join 
(select a.acct_date,c.category,sum(amount) as sales from petrol_sales_entry a join pump_master b on b.pump_no=a.pump_no join product_master c on c.product_name=b.product_name group by a.acct_date, c.category
) as tot on tot.category=product.category and tot.acct_date=product.acct_date
left join 
(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Indent_sales'  group by a.acct_date,b.product_category 
) as indent on indent.product_category=product.category and indent.acct_date=product.acct_date
left join 
(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Credit_card_sales'  group by a.acct_date,b.product_category 
) as credit on credit.product_category=product.category and credit.acct_date=product.acct_date
left join 
(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Xtra_reward_sales'  group by a.acct_date,b.product_category 
) as xreward on xreward.product_category=product.category and xreward.acct_date=product.acct_date
left join 
(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Fleet_card_sales'  group by a.acct_date,b.product_category 
) as xpower on xpower.product_category=product.category and xpower.acct_date=product.acct_date
left join 
(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Easy_fuel_sales'  group by a.acct_date,b.product_category 
) as easy on easy.product_category=product.category and easy.acct_date=product.acct_date
left join 
(SELECT a.acct_date,b.product_category,SUM(b.value) as sales FROM bill_details b join retail_bills a on a.bill_number=b.bill_no where  a.sale_mode='Cheque_sales'  group by a.acct_date,b.product_category 
) as cheque on cheque.product_category=product.category and cheque.acct_date=product.acct_date

union

select product.acct_date,product.category,indent.sales as 'Indent_sales',credit.sales as 'Credit_card_sales',xreward.sales as 'XtraReward_Sales',xpower.sales as 'XtraPower_sales',easy.sales as 'Easy_fuel_sales',cheque.sales as 'Cheque_sales', ifnull(tot.sales,0) - (ifnull(indent.sales,0) + ifnull(credit.sales,0) + ifnull(xreward.sales,0) + ifnull(xpower.sales,0) + ifnull(easy.sales,0) + ifnull(cheque.sales,0)) as 'Cash_sales',tot.sales as 'Total_sales'
from
(SELECT b.category,a.acct_date FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where a.acct_date between '$start_date' and '$end_date' $whr group by a.acct_date,b.category ) as product  
left join 
(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no  group by a.acct_date,b.category
) as tot on  tot.acct_date=product.acct_date and tot.category=product.category
left join 
(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Indent_sales'  group by a.acct_date,b.category 
) as indent on  indent.acct_date=product.acct_date and indent.category=product.category
left join 
(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Credit_card_sales'  group by a.acct_date,b.category 
) as credit on  credit.acct_date=product.acct_date and credit.category=product.category
left join 
(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Xtra_reward_sales'  group by a.acct_date,b.category 
) as xreward on  xreward.acct_date=product.acct_date and xreward.category=product.category
left join 
(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Fleet_card_sales'  group by a.acct_date,b.category 
) as xpower on  xpower.acct_date=product.acct_date and xpower.category=product.category
left join 
(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Easy_fuel_sales'  group by a.acct_date,b.category  
) as easy on  easy.acct_date=product.acct_date and easy.category=product.category
left join 
(SELECT a.acct_date,b.category,SUM(b.value) as sales FROM other_pdts_bill_details b join other_pdts_bill a on a.bill_no=b.bill_no where  a.sale_mode='Cheque_sales'  group by a.acct_date,b.category 
) as cheque on  cheque.acct_date=product.acct_date and cheque.category=product.category

order by acct_date,category
		")->result_array();
	}
}