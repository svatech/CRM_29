<?php
class Reports_model extends CI_Model{
	function get_report($sdate,$edate,$filter){
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
	
	function get_pur_report($sdate,$edate,$pdtype){
		return $this->db->query("select * from pet_pur_entry where account_date between '$sdate' and '$edate'")->result_array();
	}
	
	function get_pur_report_details($voucher_no,$pdt_type){
		if($pdt_type=='both'){
			$whr="";
		}
		else{
			$whr="and item_name='$pdt_type'";
		}
		return $this->db->query("select * from pet_pur_entry_details where 
		voucher_no='$voucher_no' $whr  ")->result_array();
	}
	
	function get_suppliers_list(){
		return $this->db->query("select * from product_suppliers")->result_array();
	}
	function get_pump_list()
	{
		return $this->db->query("select pump_no from pump_master where status=1")->result_array();
	}
	function check_shift_closed($shift,$acct_date,$counter){
		if($counter!='all'){
			return $this->db->query("select count(*) as cnt from shift_open_entry where counter='$counter' and shift='$shift' and date(account_date)='$acct_date' and action='close' ")->result_array();
		}
		else{
			return $this->db->query("select count(*) as cnt from shift_open_entry where  shift='$shift' and date(account_date)='$acct_date' and action='close' ")->result_array();
		}
		
	}
	function get_tank_list()
	{
		return $this->db->query("select * from tank_master ")->result_array();
	}
	function get_test_report($sdate,$edate,$pump_no){
		if($pump_no=='default'){
			$whr="";
		}
		else
		{
			$whr="and pump_no='$pump_no'";
		}
		return $this->db->query("select * from testing_register where test_qty!=0 and account_date between '$sdate' and '$edate' $whr")->result_array();
	}
	
	function other_pur_report($sdate,$edate,$supp){
		if($supp=='default'){
			$whr="";
		}
		else{
			$whr="and b.supplier_id='$supp'";
		}
		return $this->db->query("select a.* from other_pur_entry a join product_suppliers b on b.supplier_name=a.party_name where a.account_date between '$sdate' and '$edate' $whr ")->result_array();
	}
	function get_other_pdts_list(){
		return $this->db->query("select * from product_master where category!='FUEL'")->result_array();
	}
	function other_pur_report_details($voucher_no){
		return $this->db->query("select * from other_pur_entry_details where voucher_no='$voucher_no'  ")->result_array();
	}
	
	function oil_service_sms_report($sdate,$edate){
		
		return $this->db->query("select * from oil_service_customers where   
		cast(added_date as date) between '$sdate' and '$edate'")->result_array();
	}
	
	function get_oil_service_details($cust_id){
		
		return $this->db->query("SELECT count(*) as customer_counter FROM oil_service_customers where vehicle_number='$cust_id'")->result_array();
	}
	
	function other_sale_report($sdate,$edate,$pdt,$shift){
	if($pdt=='default'){
			$whr="";
		}
		else{
			$whr="and b.product='$pdt'";
		}
		
	if($shift=='all'){
		$shft='';
	}
	else{
		$shft="and a.shift='$shift'";
	}
		return $this->db->query("select a.acct_date,a.shift,b.product,
		sum(b.quantity) as qty,b.rate,sum(b.value) as amt from other_pdts_bill a join 
		other_pdts_bill_details b on b.bill_no=a.bill_no  where a.acct_date between 
		'$sdate' and '$edate' $whr $shft group by a.acct_date,a.shift,b.product,b.rate")->result_array();
	}
	
	function get_indent_cust_list(){
		return $this->db->query("select * from customer_master")->result_array();
	}
	
	function ind_sal_report($sdate,$edate,$cust_name){
		if($cust_name=='all'){
			$whr='';
		}
		else{
			$whr="and cust_id='$cust_name'";
		}
		return $this->db->query("select bill_number,customer_name,cust_id,vehicle_number,mobile_number,shift,counter,sale_mode,total_amount,indent_no,user,acct_date as bill_date from retail_bills where sale_mode='Indent_sales' and 
		acct_date between '$sdate' and '$edate' $whr
		UNION
		select bill_no,customer_name,cust_id,vehicle_no,mobile_no,shift,counter,sale_mode,total_amt,indent_no,added_by,acct_date as bill_date from other_pdts_bill where sale_mode='Indent_sales' 
		and acct_date between '$sdate' and '$edate' $whr
		ORDER BY bill_date")->result_array();
	}
	
	function ind_sal_report_details($bill_no){
		return $this->db->query("select * from 
		(select bill_no,product,quantity,rate,value,product_category,added_by,bill_time from bill_details where bill_no='$bill_no'
		union
		select bill_no,product,quantity,rate,value,category,added_by,bill_time from other_pdts_bill_details where bill_no='$bill_no') as bill_table  
		")->result_array();
	}
	
	function other_ind_sal_report($sdate,$edate,$cust_name){
		if($cust_name=='all'){
			$whr='';
		}
		else{
			$whr="and cust_id='$cust_name'";
		}
		return $this->db->query("select * from other_pdts_bill where sale_mode='Indent_sales' 
		and date(bill_time) between '$sdate' and '$edate' $whr")->result_array();
	}
	
	function other_ind_sal_report_details($bill_no){
		return $this->db->query("select * from other_pdts_bill_details where bill_no='$bill_no'")->result_array();
	}
	
	function get_counters_list()
	{
		return $this->db->query("select * from counters ")->result_array();
	}
	
	function shift_petrol_sales($acct_date,$shift,$counter){
		if($counter!='all'){
			return $this->db->query("Select p.pump_no,(select product_name from pump_master m 
			where status=1 and m.pump_no=p.pump_no) as product_name,open_reading,close_reading,
			sales_litres,(select sum(test_qty) from testing_register m where m.shift=p.shift 
			and m.account_date=p.acct_date and m.pump_no=p.pump_no) as 'test_litres',net_sales,rate,amount,
			(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no where r.pump_number=p.pump_no and 
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
			s on(s.product_name=m.product_name)  where p.shift='$shift' and p.acct_date='$acct_date' 
			and s.category='FUEL' and m.counter='$counter' group by p.pump_no;")->result_array();
		}							
		else{
			return $this->db->query("Select p.pump_no,(select product_name from pump_master m 
			where status=1 and m.pump_no=p.pump_no) as product_name,open_reading,close_reading,
			sales_litres,(select sum(test_qty) from testing_register m where m.shift=p.shift 
			and m.account_date=p.acct_date and m.pump_no=p.pump_no) as 'test_litres',net_sales,rate,amount,
			(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no where r.pump_number=p.pump_no and 
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
			s on(s.product_name=m.product_name)  where p.shift='$shift' and p.acct_date='$acct_date' 
			and s.category='FUEL'  group by p.pump_no;")->result_array();
		}
	}
	
	function shift_loose_oil_sales($acct_date,$shift,$counter){
		if($counter!='all'){
			return $this->db->query("Select p.pump_no,(select product_name from pump_master m 
			where status=1 and m.pump_no=p.pump_no) as product_name,open_reading,close_reading,
			sales_litres,(select sum(test_qty) from testing_register m where m.shift=p.shift 
			and m.account_date=p.acct_date and m.pump_no=p.pump_no) as 'test_litres',
			net_sales,rate,amount,(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no where r.twotoil_pump = p.pump_no and 
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
			 (select sum(quantity) from 
			 bill_details b join retail_bills r on r.bill_number=b.bill_no where 
			 r.twotoil_pump = p.pump_no and b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date 
			 and r.shift=p.shift and r.sale_mode='Cheque_sales') as CH_sales,
			 (select sum(quantity) from bill_details 
			 b join retail_bills r on r.bill_number=b.bill_no where r.twotoil_pump = p.pump_no 
			 and b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date and r.shift=p.shift and 
			 r.sale_mode='Cash_sales') as cash_sales from petrol_sales_entry p join pump_master m 
			 on (m.pump_no=p.pump_no) join product_master s on(s.product_name=m.product_name)  
			 where  p.acct_date='$acct_date' and p.shift='$shift' and s.category='2T_OIL_LOOSE' and m.counter='$counter' group by p.pump_no;")->result_array();
		}
		else{
			return $this->db->query("Select p.pump_no,(select product_name from pump_master m 
			where status=1 and m.pump_no=p.pump_no) as product_name,open_reading,close_reading,
			sales_litres,(select sum(test_qty) from testing_register m where m.shift=p.shift 
			and m.account_date=p.acct_date and m.pump_no=p.pump_no) as 'test_litres',
			net_sales,rate,amount,(select sum(quantity) from bill_details b join retail_bills r on r.bill_number=b.bill_no where r.twotoil_pump = p.pump_no and 
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
			 (select sum(quantity) from 
			 bill_details b join retail_bills r on r.bill_number=b.bill_no where 
			 r.twotoil_pump = p.pump_no and b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date
			 and r.shift=p.shift and r.sale_mode='Cheque_sales') as CH_sales,
			 (select sum(quantity) from bill_details 
			 b join retail_bills r on r.bill_number=b.bill_no where r.twotoil_pump = p.pump_no 
			 and b.product_category='2T_OIL_LOOSE'  and r.acct_date=p.acct_date and r.shift=p.shift and 
			 r.sale_mode='Cash_sales') as cash_sales from petrol_sales_entry p join pump_master m 
			 on (m.pump_no=p.pump_no) join product_master s on(s.product_name=m.product_name)  
			 where  p.acct_date='$acct_date' and p.shift='$shift' and s.category='2T_OIL_LOOSE'  group by p.pump_no;")->result_array();
		}
	}
	
	function shift_other_pdts_sales($acct_date,$shift,$counter){
		if($counter!='all'){
			 return $this->db->query("select product,sum(quantity) as qty,sum(value) as amt,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Cash_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as bcs_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Cash_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as bcs_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Indent_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as is_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Indent_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as is_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Credit_card_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as cs_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Credit_card_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as cs_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Fleet_card_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as fs_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Fleet_card_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as fs_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Xtra_reward_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as xr_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Xtra_reward_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as xr_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Easy_fuel_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as ef_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Easy_fuel_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as ef_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Cheque_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as ch_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Cheque_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as ch_rs
			from other_pdts_bill n join other_pdts_bill_details m ON m.bill_no = n.bill_no
			where n.acct_date = '$acct_date' and n.shift = '$shift' and n.counter = '$counter'
			group by m.product")->result_array();
		}
		else{
			return $this->db->query("select product,sum(quantity) as qty,sum(value) as amt,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Cash_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as bcs_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Cash_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as bcs_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Indent_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as is_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Indent_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as is_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Credit_card_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as cs_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Credit_card_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as cs_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Fleet_card_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as fs_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Fleet_card_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as fs_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Xtra_reward_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as xr_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Xtra_reward_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as xr_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Easy_fuel_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as ef_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Easy_fuel_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as ef_rs,
			 (select sum(quantity) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Cheque_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as ch_qty,
			 (select sum(value) from other_pdts_bill_details o join other_pdts_bill p ON (p.bill_no = o.bill_no) where p.sale_mode = 'Cheque_sales' and o.product = m.product and p.acct_date = n.acct_date and p.shift=n.shift) as ch_rs
			from other_pdts_bill n join other_pdts_bill_details m ON m.bill_no = n.bill_no
			where n.acct_date = '$acct_date' and n.shift = '$shift' 
			group by m.product")->result_array();
		}
	}
	
	
	function tank_stock_report($sdate,$edate,$tank_no){
		if($tank_no=='all'){
			$whr='';
		}else {
			$whr="and tank_no='$tank_no'";
		}
		
		return $this->db->query("select * from tank_stock where date(added_date) between '$sdate' and '$edate' $whr")->result_array();
	}
	function get_pet_bills($sdate,$edate,$filter,$vehicle_no){
		if($filter=='all'){
			
			$filter="";
		}
		else{
			$filter="and sale_mode ='$filter'";
		}
		if($vehicle_no==''){
			$veh_no="";
		}
		else{
			$veh_no="and vehicle_number='$vehicle_no'";
		}
		return $this->db->query("select * from retail_bills where acct_date between '$sdate' and '$edate' $filter $veh_no")->result_array();
	}
	function get_pet_bill_details($bill_no){
		
		return $this->db->query("Select * from bill_details where 
		bill_no='$bill_no'   ")->result_array();
	}
	function get_other_bills($sdate,$edate,$filter,$vehicle_no){
	if($filter=='all'){
			
			$filter="";
		}
		else{
			$filter="and sale_mode ='$filter'";
		}
	if($vehicle_no==''){
			$veh_no="";
		}
		else{
			$veh_no="and vehicle_no='$vehicle_no'";
		}
		return $this->db->query("select * from other_pdts_bill where acct_date between '$sdate' and '$edate' $filter $veh_no")->result_array();
	}
	function get_other_bill_details($bill_no){
		return $this->db->query("Select * from other_pdts_bill_details where 
		bill_no='$bill_no'")->result_array();
	}
	
	function get_vendors(){
		return $this->db->query("Select * from expenses_vendors")->result_array();
	}
	
	function get_expenses_report($sdate,$edate,$filter){
		if($filter=='all'){
			$filter="";
		}
		else{
			$filter="and a.vendor_code='$filter'";
		}
		return $this->db->query("select * from expenses a join expenses_vendors b on b.vendor_code=a.vendor_code where exp_date between '$sdate' and '$edate' $filter")->result_array();
	}
	
	function get_banks(){
		return $this->db->query("Select * from bank_accounts")->result_array();
	}
	
	function get_transactions_report($sdate,$edate,$filter){
		if($filter=='all'){
			$filter="";
		}
		else{
			$filter="and a.bank_code='$filter'";
		}
		return $this->db->query("select * from bank_transactions a join bank_accounts b on b.bank_code=a.bank_code where deposited_date between '$sdate' and '$edate' $filter")->result_array();
	}
	
	function ind_stmt_payment_report($sdate,$edate,$cust_name,$payment_mode){
		if($payment_mode!='ALL'){
			$paymode="and b.payment_mode='$payment_mode'";
		}
		else{
			$paymode='';
		}
		
		if($cust_name!='all'){
			$custid="and a.cust_id='$cust_name'";
		}
		else{
			$custid='';
		}
		return $this->db->query("Select c.customer_name,c.tin,a.bill_no,b.payment_mode,b.amount,b.payment_date,b.cheque_no,b.cheque_date,b.cheque_status,b.bank_name,b.clearance_date from indent_statement_bills a join indent_stmt_payments b on b.bill_no=a.bill_no join customer_master c on c.customer_id=a.cust_id where b.payment_date between '$sdate' and '$edate' $paymode $custid")->result_array();
	}
	
	function get_cash_inflow_report($sdate,$edate){
		return $this->db->query("SELECT * FROM cash_inflow where transaction_date between '$sdate' and '$edate'")->result_array();
	}
	function get_rfid_vehicles_report($sdate,$edate){
	return $this->db->query("SELECT a.*,b.bill_time,b.bill_updated FROM rfid_read_log a JOIN retail_bills b ON b.bill_number=a.bill_no where date(a.action_time) between '$sdate' and '$edate'")->result_array();	
	}
	function get_part_bill_details($bill_no)
	{
		$query=$this->db->query("SELECT * FROM retail_bills JOIN rfid_read_log on(bill_no=bill_number)   WHERE bill_number='$bill_no'");
		$rowcount=$query->num_rows();
		if($rowcount > 0)
		{
		return $query->result();
		}else 
		{
		return 0;	
		}
	}
		function get_product_bill_details($bill_no)
	{
	$query=$this->db->query("SELECT * FROM bill_details    WHERE bill_no='$bill_no'");
	$rowcount=$query->num_rows();
		if($rowcount > 0)
		{
		return $query->result();
		}else 
		{
		return 0;	
		}
	}

	function indent_stmt_details($sdate,$edate,$cust_name){
	if($cust_name=='all'){
			$whr='';
		}
		else{
			$whr="and cust_id='$cust_name'";
		}
		return $this->db->query("Select a.*,ifnull((select sum(amount) from indent_stmt_payments c where c.bill_no=a.bill_no and c.cheque_status!='BOUNCED'),0) as amount,b.customer_name,b.tin from indent_statement_bills a join customer_master b on b.customer_id=a.cust_id where bill_date between '$sdate' and '$edate' $whr")->result_array();
	}

	function cheque_sal_report($sdate,$edate){
		return $this->db->query("
	Select bill_number,acct_date ,bank_name,customer_name,vehicle_number,total_amount,
    cheque_date,cheque_no,cheque_status,clearance_date from retail_bills
	where cheque_no!='NULL' and acct_date between '$sdate' and '$edate'

	union

	Select bill_no,acct_date,bank_name,customer_name,vehicle_no,total_amt, cheque_date,
	cheque_no,cheque_status,clearance_date from other_pdts_bill
	where cheque_no!='NULL' and acct_date between '$sdate' and '$edate'
	order by bill_number
	")->result_array();
	}
	
function get_vehicles_list(){
		$result=$this->db->query("select distinct vehicle_number from retail_customers")->result_array();
		if(!empty($result)){
		foreach($result as $res){
			$row_set[]=$res['vehicle_number'];
		} 
		}else{
			$row_set[]='';
		}
		return $row_set;
	}
	
	
}
