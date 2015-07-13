<?php
class Sales_model extends CI_Model
{
	function get_cashsales_billno(){
		return $this->db->query("select * from bill_no_generator")->result_array();
	}
	function get_indent_customers(){
		$result=$this->db->query("select * from customer_master where status='ACTIVE'")->result_array();
		if(!empty($result)){
		foreach($result as $res){
			$row_set[]=$res['customer_name'];
		} }
		else{
			$row_set[]='';
		}
		return $row_set;
	}
	function check_shift_open($shift,$acct_date,$counter){
		return $this->db->query("select * from shift_open_entry where counter='$counter' and shift='$shift' and date(account_date)='$acct_date' order by added_date desc limit 1")->result_array();
	}
	
	function check_shift_closed($shift,$acct_date,$counter){
		return $this->db->query("select count(*) as cnt from shift_open_entry where counter='$counter' and shift='$shift' and date(account_date)='$acct_date' and action='close' ")->result_array();
	}
	function get_retail_trucks(){
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
	function get_shift_entries(){
		return $this->db->query("select * from shift_open_entry order by added_date desc limit 25")->result_array();
	}
	
	function get_bill_cash_sales($act_date,$shft,$pmp_no,$cnt_no){
		return $this->db->query("select sum(total_amount) from retail_bills where acct_date='$act_date' and shift='$shft' and pump_number='$pmp_no' and counter='$cnt_no' and sale_mode='Cash_sales'")->result_array();
	}
	function get_counter_status(){
		return $this->db->query("
		SELECT s.* FROM shift_open_entry s join counters t on s.counter=t.counter WHERE id in 
		( select d.id from (SELECT counter,(select id from shift_open_entry where counter=c.counter order by added_date desc limit 1) as id from counters c) as d) 
		order by t.Sno")->result_array();
	}
	
	
	function checkIndentCust($cust_name){
		return $this->db->query("select count(*) as cnt from customer_master where customer_name='$cust_name'")->result_array();
	}
	function get_retail_customers(){
		$result=$this->db->query("select * from retail_customers WHERE cust_id Not In ('0')")->result_array();
		if(!empty($result)){
		foreach($result as $res){
			$row_set[]=$res['customer_name'];
		} 
		}
		else{
			$row_set[]='';
		}
		return $row_set;
	}

	
	function insert_test_reg_entry($bill_no,$shift,$acct_date,$counterno,$pump_no,$purpose,$test_litres){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		return $this->db->query("insert into testing_register(bill_no,pump_no,test_qty,purpose,account_date,shift,counter,added_by,added_time) values('$bill_no','$pump_no','$test_litres','$purpose','$acct_date','$shift','$counterno','$uname','$add_date')");
	}
	function get_rate($pdt){
		
		$rates=$this->db->query("select product_rate from product_master where product_name='$pdt'")->result_array();
		foreach($rates as $rate){
			return $rate["product_rate"];
		}
		
		// echo $pdt;
	}
	function get_pdts_list(){
		return $this->db->query("select * from product_master where status=1 and category in('FUEL')")->result_array();
	}
	function get_2tpumps_list($ctr){
		$pumps=$this->db->query("select p.* from pump_master p join product_master m on m.product_name=p.product_name where p.status=1 and m.category='2T_OIL_LOOSE' and p.counter='$ctr'");
	$rowcount=$pumps->num_rows();
		if ($rowcount > 0)
		{
		$pumpno="";
		for($i=0;$i<$rowcount;$i++)
		{
		$row = $pumps->row_array($i); 
		$pump[$i]=$row['pump_no'];
		$pumpno=$pumpno."!".$pump[$i];
		}
		echo $pumpno;
		}
		else{
			echo "no";
		}
	}
	function get_other_pdts_list(){
		return $this->db->query("select * from product_master where status=1 and category in('GREASE','OIL','OTHERS','2T_OIL_LOOSE')")->result_array();
	}
	
	function get_pdt_of_pump($pump_no){
		 $pdts=$this->db->query("select product_name from  pump_master where pump_no='$pump_no' and status='1'")->result_array();
		 foreach($pdts as $pdt){
		 	return $pdt["product_name"];
		 }
		}
		function get_retail_cust_id($customer)
		{
		$cust_id=$this->db->query("SELECT cust_id,mobile_number
									FROM retail_customers
											where customer_name='$customer'");
		$rowcount=$cust_id->num_rows();
		if ($rowcount > 0)
		{
		$customer_id="";
		$mobile_number="";
		for($i=0;$i<$rowcount;$i++)
		{
		$row = $cust_id->row_array($i); 
		$cust[$i]=$row['cust_id'];
		$mobile[$i]=$row['mobile_number'];
		$customer_id=$customer_id."!".$cust[$i];
		$mobile_number=$mobile_number."!".$mobile[$i];
		}
		echo $rowcount."!".$customer_id."!".$mobile_number;
		}
		
		/*foreach($pumps as $pumpno)
		{
		echo $pumpno["pump_no"];
		}*/
		}
	function get_pump_of_counter($counter)
		{
		$pumps=$this->db->query("SELECT pump_no 
									FROM pump_master
											where status=1 and product_name in ('PETROL','DIESEL') and counter='$counter'");
		$rowcount=$pumps->num_rows();
		if ($rowcount > 0)
		{
		$pumpno="";
		for($i=0;$i<$rowcount;$i++)
		{
		$row = $pumps->row_array($i); 
		$pump[$i]=$row['pump_no'];
		$pumpno=$pumpno."!".$pump[$i];
		}
		echo $pumpno;
		}
		
		/*foreach($pumps as $pumpno)
		{
		echo $pumpno["pump_no"];
		}*/
		}
		
function get_pump_of_counter_sales_entry($counter)
		{
		$pumps=$this->db->query("SELECT pump_no 
									FROM pump_master
											where status=1  and counter='$counter'");
		$rowcount=$pumps->num_rows();
		if ($rowcount > 0)
		{
		$pumpno="";
		for($i=0;$i<$rowcount;$i++)
		{
		$row = $pumps->row_array($i); 
		$pump[$i]=$row['pump_no'];
		$pumpno=$pumpno."!".$pump[$i];
		}
		echo $pumpno;
		}
		
		/*foreach($pumps as $pumpno)
		{
		echo $pumpno["pump_no"];
		}*/
		}
		
	function getVehList($cust_name){
		$vehicles=$this->db->query("select vehicle_number from customer_master where customer_name='$cust_name'")->result_array();
		foreach($vehicles as $veh){
		return $veh['vehicle_number'];
		}
	}
	
	function getCustId($cust_name){
		$custname=$this->db->query("select customer_id from customer_master where customer_name='$cust_name'")->result_array();
		foreach($custname as $cust){
			return $cust['customer_id'];
		}
	}
	function get_bill_no($sale_mode){
		return $this->db->query("select $sale_mode from bill_no_generator")->result_array();
	}
	
	function insert_bill($bill_no,$cust_name,$cust_id,$veh_no,$mob_no,$pump_no,$shift,$counter,$sales_mode,$tot_amt,$indent_no,$kmrdng,$acct_date,$twotpumpno,$cheque_no,$cheque_date,$cheque_status,$bank_name,$ref_no){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("insert into retail_bills(bill_number,customer_name,cust_id,vehicle_number,mobile_number,pump_number,shift,counter,sale_mode,total_amount,user,indent_no,bill_time,acct_date,km_reading,twotoil_pump,cheque_no,cheque_date,cheque_status,bank_name,indent_stmt_no,reference_no) values('$bill_no','$cust_name','$cust_id','$veh_no','$mob_no','$pump_no','$shift','$counter','$sales_mode','$tot_amt','$uname','$indent_no','$add_date','$acct_date','$kmrdng','$twotpumpno','$cheque_no','$cheque_date','$cheque_status','$bank_name','NULL','$ref_no')");
		
	}
	function insert_retailcustomer($vehicle_number,$customer_name,$mobile_number)
	{	
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$result=$this->db->query("SELECT other_pdts_cust_id FROM bill_no_generator")->result_array();
		foreach($result as $res){
			$cust_id=$res['other_pdts_cust_id'];
		}
		$this->db->query("insert into retail_customers(Sno,customer_name,vehicle_number,mobile_number,cust_id,user,added_date,reference_no,status)
			values('','$customer_name','$vehicle_number','$mobile_number','$cust_id','$uname','$add_date','','ACTIVE')");
		$new_cust_id=++$cust_id;
		$this->db->query("UPDATE bill_no_generator SET other_pdts_cust_id='$new_cust_id'");
		
		
	}
	function update_retailcustomer($vehicle_number,$customer_name,$mobile_number)
	{
	$uname=$this->session->userdata('admin_user_email');
	$add_date=date('Y-m-d H:i:s');
	return $this->db->query("UPDATE retail_customers 
	SET customer_name='$customer_name' ,mobile_number='$mobile_number',added_date='$add_date', user='$uname'
	WHERE vehicle_number='$vehicle_number'");
	}
	function fetch_otherproducts_custid()
	{
		$data=$this->db->query("SELECT other_pdts_cust_id FROM bill_no_generator");
		return $data->result();
	}
function insert_other_pdts_customer($vehicle_number,$customer_name,$mobile_number,$current_custid,$next_custid,$oil_service_enable)
	{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("insert into retail_customers values('','$customer_name','$vehicle_number','$mobile_number','$current_custid','$uname','$add_date','','ACTIVE','','','','',$oil_service_enable,'','')");
		$this->db->query("UPDATE bill_no_generator SET other_pdts_cust_id='$next_custid'");
	}
	function update_other_pdts_customer($vehicle_number,$customer_name,$mobile_number,$current_custid,$oil_service_enable)
	{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		return $this->db->query("UPDATE retail_customers 
		SET customer_name='$customer_name' ,mobile_number='$mobile_number',added_date='$add_date', user='$uname',vehicle_number='$vehicle_number',oil_service_enable='$oil_service_enable'
		WHERE cust_id='$current_custid' ");
		}
	function insert_other_pdts_customer_km($vehicle_number,$customer_name,$mobile_number,$current_custid,$next_custid,$avg_km,$km_reading,$exp_date,$oil_service_enable,$oil_service_dob,$oil_service_wedding_date)
	{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$k=date("Y-m-d");
		$result=$this->db->query("SELECT other_pdts_cust_id FROM bill_no_generator")->result_array();
		foreach($result as $res){
			$cust_id=$res['other_pdts_cust_id'];
		}
		$this->db->query("insert into retail_customers values('','$customer_name','$vehicle_number','$mobile_number','$cust_id','$uname','$add_date','','ACTIVE','$avg_km','$km_reading','$k','$exp_date','$oil_service_enable','$oil_service_dob','$oil_service_wedding_date')");
		$new_cust_id=++$cust_id;
		$this->db->query("UPDATE bill_no_generator SET other_pdts_cust_id='$new_cust_id'");
	}
	function insert_oil_service_customer($vehicle_number,$customer_name,$mobile_number,$current_custid,$next_custid,$avg_km,$km_reading,$exp_date,$oil_service_enable,$oil_service_dob,$oil_service_wedding_date)
	{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$k=date("Y-m-d");
		$result=$this->db->query("SELECT other_pdts_cust_id FROM bill_no_generator")->result_array();
		foreach($result as $res){
			$cust_id=$res['other_pdts_cust_id'];
		}
		$this->db->query("insert into oil_service_customers values('','$customer_name','$vehicle_number','$mobile_number','$current_custid','$uname','$add_date','','ACTIVE','$avg_km','$km_reading','$k','$exp_date','$oil_service_enable','$oil_service_dob','$oil_service_wedding_date')");
		}
	function update_other_pdts_customer_km($vehicle_number,$customer_name,$mobile_number,$current_custid,$avg_km,$km_reading,$exp_date,$oil_service_enable,$oil_service_dob,$oil_service_wedding_date)
	{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$k=date("Y-m-d");
		return $this->db->query("UPDATE retail_customers 
		SET customer_name='$customer_name' ,mobile_number='$mobile_number',added_date='$add_date', user='$uname',vehicle_number='$vehicle_number',avg_km='$avg_km',km_reading='$km_reading',km_add_date='$k',exp_date='$exp_date',oil_service_enable='$oil_service_enable',oil_service_dob='$oil_service_dob',oil_service_wedding_date='$oil_service_wedding_date'   
		WHERE cust_id='$current_custid' ");
		}
	function get_other_pdts_customer_sms()
	{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
	    return $this->db->query("SELECT mobile_number,exp_date,customer_name from retail_customers WHERE exp_date = DATE_ADD(CURDATE(),INTERVAL 7 DAY)")->result_array();
	    //foreach($result as $s){
	    //$oil_service = $s['oil_service'];
	  //}
	}
function get_oil_service_dob_sms()
	{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
	    return $this->db->query("SELECT mobile_number,oil_service_dob,customer_name
						FROM oil_service_customers
			WHERE DATE_FORMAT(oil_service_dob, '%m-%d') = DATE_FORMAT(CURDATE(), '%m-%d')")->result_array();
	    //foreach($result as $s){
	    //$oil_service = $s['oil_service'];
	  //}
	}
function get_oil_service_wedding_date_sms()
	{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
	    return $this->db->query("SELECT mobile_number,oil_service_wedding_date,customer_name FROM oil_service_customers
		WHERE DATE_FORMAT(oil_service_wedding_date, '%m-%d') = DATE_FORMAT(CURDATE(), '%m-%d')")->result_array();
	    //foreach($result as $s){
	    //$oil_service = $s['oil_service'];
	  //}
	}
		
	function insert_bill_details($bill_no,$pdt,$qty,$rate,$val){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$result=$this->db->query("select category from product_master where status='1' and  product_name='$pdt'")->result_array();
		foreach ($result as $res){
			$category=$res["category"];
		}
		$this->db->query("insert into bill_details(bill_no,product,quantity,rate,value,product_category,added_by,bill_time) values('$bill_no','$pdt','$qty','$rate','$val','$category','$uname','$add_date')");
	}
	function update_billno($bill_no,$sale_mode){
		$old_no=$bill_no;
		$new_no=++$bill_no;
		return $this->db->query("update bill_no_generator set $sale_mode='$new_no'");
	}
	
	function update_rfid_entry($bill_no,$vehicle_no){
		$add_date=date('Y-m-d');
		$this->db->query("update rfid_read_log set processed=1, bill_no='$bill_no' where vehicle_no='$vehicle_no' and date(action_time)='$add_date' and processed=0");
	}
	function get_pump_list()
	{
		return $this->db->query("select pump_no from pump_master where status=1")->result_array();
	}
	
	function get_2toilpump_list(){
		return $this->db->query("select p.pump_no from pump_master p join product_master m on m.product_name=p.product_name where p.status=1 and m.category='2T_OIL_LOOSE'")->result_array();
	}
	function get_counters_list()
	{
		return $this->db->query("select * from counters ")->result_array();
	}
	function get_open_reading($pump_no){
		$qry=$this->db->query("select last_close_reading,product_rate from pump_master join product_master on pump_master.product_name=product_master.product_name where pump_master.pump_no='$pump_no'")->result_array();
		if(!empty($qry))
		{
			foreach ($qry as $res){
				$str=$res["last_close_reading"]."::".$res["product_rate"];
			}
			print $str;
		}
		else {
			print "nodata";
		}
	}
function last_five_trans_petro_report($vehicle){
		return $this->db->query("select b.product,b.quantity,date(b.bill_time) as bill_time
from retail_bills a JOIN bill_details b on(a.bill_number = b.bill_no)
where a.vehicle_number='$vehicle' 
UNION ALL 
select c.product,c.quantity,date(c.bill_time) as bill_time from other_pdts_bill_details c
 join other_pdts_bill d on(c.bill_no = d.bill_no)
where d.vehicle_no='$vehicle'
limit 5")->result_array();
	}
function last_five_trans_others_report($customer){
		return $this->db->query("select b.product,b.quantity,date(b.bill_time) as bill_time
from retail_bills a JOIN bill_details b on(a.bill_number = b.bill_no)
where a.customer_name='$customer' 
UNION ALL 
select c.product,c.quantity,date(c.bill_time) as bill_time from other_pdts_bill_details c
 join other_pdts_bill d on(c.bill_no = d.bill_no)
where d.customer_name='$customer'
limit 5")->result_array();
	}	
	function get_test_litres($acct_date,$shift,$pump){
		$result=$this->db->query("select sum(test_qty) as test_ltrs from testing_register where account_date='$acct_date' and shift='$shift' and pump_no='$pump'")->result_array();
		if(!empty($result))
		{
			foreach ($result as $res){
				$str=$res["test_ltrs"];
			}
			print $str;
		}
		else {
			print "nodata";
		}
	}
	function insert_sale_entry($form_data){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$result=$this->db->query("select count(*) as cnt from petrol_sales_entry where acct_date='".$form_data["acct_date"]."' and shift='".$form_data["shift"]."' and pump_no='".$form_data["pump_no"]."'")->result_array();
		$last_shift=$form_data["acct_date"]."_".$form_data["shift"];
		foreach($result as $res){
			$count=$res["cnt"];
		}
		if($count==0){
			$this->db->query("insert into petrol_sales_entry(acct_date,shift,pump_no,open_reading,close_reading,sales_litres,test_litres,net_sales,rate,amount,added_date,added_by) values('".$form_data["acct_date"]."','".$form_data["shift"]."','".$form_data["pump_no"]."','".$form_data["open_rdng"]."','".$form_data["close_rdng"]."','".$form_data["sales_ltrs"]."','".$form_data["test_ltrs"]."','".$form_data["net_sales"]."','".$form_data["rate"]."','".$form_data["amt"]."','$add_date','$uname')");
			$this->db->query("update pump_master set last_close_reading='".$form_data["close_rdng"]."',last_close_shift='$last_shift' where pump_no='".$form_data["pump_no"]."'");
		}
		else 
		{
			$this->db->query("update petrol_sales_entry set open_reading='".$form_data["open_rdng"]."',close_reading='".$form_data["close_rdng"]."',sales_litres='".$form_data["sales_ltrs"]."',test_litres='".$form_data["test_ltrs"]."',net_sales='".$form_data["net_sales"]."',rate='".$form_data["rate"]."',amount='".$form_data["amt"]."' where acct_date='".$form_data["acct_date"]."' and shift='".$form_data["shift"]."' and pump_no='".$form_data["pump_no"]."'" );
			$result1=$this->db->query("SELECT last_close_shift from pump_master where pump_no='".$form_data["pump_no"]."' ")->result_array();
			foreach($result1 as $res1){
				$lcs=$res1["last_close_shift"];
			}
			if($lcs==$last_shift){
				$this->db->query("update pump_master set last_close_reading='".$form_data["close_rdng"]."' where pump_no='".$form_data["pump_no"]."'");
			}
		}
		
	}
	
	function insert_other_pdt_bill($bill_no,$cust_name,$cust_id,$veh_no,$mob_no,$shift,$counterno,$sales_mode,$total,$acct_date,$indent_no,$cheque_no,$cheque_date,$cheque_status,$bank_name,$clearance_date,$ref_no){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		return $this->db->query("insert into other_pdts_bill(bill_no,customer_name,cust_id,vehicle_no,mobile_no,shift,counter,indent_no,sale_mode,total_amt,acct_date,bill_time,added_by,cheque_no,cheque_date,cheque_status,bank_name,indent_stmt_no,reference_no,clearance_date) values('$bill_no','$cust_name','$cust_id','$veh_no','$mob_no','$shift','$counterno','$indent_no','$sales_mode','$total','$acct_date','$add_date','$uname','$cheque_no','$cheque_date','$cheque_status','$bank_name','NULL','$ref_no','$clearance_date')");
	}
	
	function insert_other_bill_details($bill_no,$item,$qty,$rate,$val){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$cat=$this->db->query("select category from product_master where product_name='$item'")->result_array();
		foreach ($cat as $category);
		$pdt_cat=$category["category"];
		return $this->db->query("insert into other_pdts_bill_details(bill_no,product,quantity,rate,value,category,added_by,bill_time) values('$bill_no','$item','$qty','$rate','$val','$pdt_cat','$uname','$add_date')");
	}
	function fetch_bill_details($start,$end)
	{
	
		$query=$this->db->query("SELECT * 
									FROM retail_bills 
										WHERE acct_date BETWEEN '$start' AND '$end' ORDER BY bill_time desc");
		return $query->result();
	}
	
	function fetch_testing_bill_details($start,$end)
	{
	
		$query=$this->db->query("SELECT * 
									FROM testing_register  
										WHERE account_date BETWEEN '$start' AND '$end' ORDER BY added_time desc");
		return $query->result();
	}
	
	function fetch_other_pdts_bill_details($start,$end)
	{
	
		$query=$this->db->query("SELECT * 
									FROM other_pdts_bill
										WHERE acct_date BETWEEN '$start' AND '$end' ORDER BY bill_time desc");
		return $query->result();
	}
	function get_part_bill_details($bill_no)
	{
		$query=$this->db->query("SELECT * FROM retail_bills JOIN bill_details on(bill_no=bill_number)   WHERE bill_number='$bill_no'");
		$rowcount=$query->num_rows();
		if($rowcount > 0)
		{
		return $query->result();
		}else 
		{
		return 0;	
		}
	}
	function get_counter_no()
	{
		$query=$this->db->query("SELECT * FROM counters");
		return $query->result();
	}
function get_product_info()
	{
		$query=$this->db->query("SELECT product_name FROM product_master WHERE category ='fuel' and status='1'");
		return $query->result();
	}
	function get_product_bill_details($bill_no)
	{
	$query=$this->db->query("SELECT * FROM bill_details   WHERE bill_no='$bill_no'");
	$rowcount=$query->num_rows();
		if($rowcount > 0)
		{
		return $query->result();
		}else 
		{
		return 0;	
		}
	}
	
	function delete_billdetails($bill_no)
	{
	$this->db->query("DELETE FROM bill_details  WHERE bill_no='$bill_no'");
	} 
	function insert_billdetails($bill_no,$prod,$rate,$value,$qty,$bill_status)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$result=$this->db->query("select category from product_master where status='1' and  product_name='$prod'")->result_array();
		foreach ($result as $res){
			$category=$res["category"];
		}
		$this->db->query("INSERT INTO bill_details VALUES('','$bill_no','$prod','$qty','$rate','$value','$category','$uname','$mydate','$bill_status')");
	}
	
	function update_retailbill_info($bill_no,$cust_name,$veh_no,$mob_no,$pump_no,$shift,$counter,$sales_mode,$total,$indent_no,$meter_reading,$cust_id,$twotoilpump,$cheque_no,$cheque_date,$cheque_status,$bank_name,$clearance_date,$ref_no)
	{
	$uname=$this->session->userdata('admin_user_email');
	$add_date=date('Y-m-d H:i:s');
	$this->db->query("UPDATE retail_bills SET customer_name='$cust_name',cust_id='$cust_id',vehicle_number='$veh_no',mobile_number='$mob_no',pump_number='$pump_no',shift='$shift',counter='$counter',sale_mode='$sales_mode',total_amount='$total',indent_no='$indent_no',km_reading='$meter_reading',user='$uname',bill_time='$add_date',bill_updated=(bill_updated+1),twotoil_pump='$twotoilpump',cheque_no='$cheque_no',cheque_date='$cheque_date',cheque_status='$cheque_status',bank_name='$bank_name',clearance_date='$clearance_date',reference_no='$ref_no' WHERE bill_number='$bill_no' ");
	}
	function fetch_other_products_bill_details()
	{
		$query=$this->db->query("SELECT * FROM other_pdts_bill");
		return $query->result();
	}
	function get_part_otherproducts_bill_details($bill_no)
	{
		$query=$this->db->query("SELECT * FROM other_pdts_bill opb JOIN other_pdts_bill_details  opbd
								on(opb.bill_no=opbd.bill_no)  
								WHERE opb.bill_no='$bill_no'");
		$rowcount=$query->num_rows();
		if($rowcount > 0)
		{
		return $query->result();
		}else 
		{
		return 0;	
		}
	}
	function get_otherproducts_info()
	{
		$query=$this->db->query("SELECT product_name FROM product_master WHERE category IN ('oil','Grease','others','2T_OIL_LOOSE');");
		return $query->result();
	}
	function get_otherproducts_bill_details($bill_no)
	{
		$query=$this->db->query("SELECT * FROM other_pdts_bill_details   WHERE bill_no='$bill_no'");
		$rowcount=$query->num_rows();
		if($rowcount > 0)
		{
		return $query->result();
		}else 
		{
		return 0;	
		}
	}
	function get_indent_cust(){
		$result=$this->db->query("select * from customer_master")->result_array();
		foreach($result as $res){
		return $res['customer_name'];
		} 
		}
	function get_cust_id($cust_name)
	{
	$cust_id=$this->db->query("SELECT customer_id FROM crmnoindex.customer_master
										where customer_name='$cust_name'");
	$cust_id=$cust_id->result();
	foreach($cust_id as $cust){
	$cust=$cust->customer_id;
	return $cust;
	}
	}
	
	function get_indent_limit($cust_id){
		$cust_id=$this->db->query("SELECT indent_limit,indent_taken,phone_number FROM crmnoindex.customer_master
											where customer_id='$cust_id'");
		
		$cust_id=$cust_id->result();
		foreach($cust_id as $cust){
		$indent_limit=$cust->indent_limit;
		$indent_taken=$cust->indent_taken;
		$mobile_no=$cust->phone_number;
	    //$indent_dob=$cust->indent_dob;
		
		return $indent_limit."::".$indent_taken."::".$mobile_no;
		}
	}
	function get_sale_mode($bill_no)
	{
	$sale_mode=$this->db->query("SELECT sale_mode FROM crm.retail_bills
										where bill_number='$bill_no'");
	$sale_mode=$sale_mode->result();
	foreach($sale_mode as $cust){
	$sale=$cust->sale_mode;
	return $sale;
	}
	}
function delete_other_product_billdetails($bill_no)
	{
	$this->db->query("DELETE FROM other_pdts_bill_details  WHERE bill_no='$bill_no'");
	}
function insert_other_product_billdetails($bill_no,$prod,$rate,$value,$qty,$bill_status)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$cat=$this->db->query("select category from product_master where product_name='$prod'")->result_array();
		foreach ($cat as $cat);
		$category=$cat["category"];
		
		$this->db->query("INSERT INTO other_pdts_bill_details VALUES('','$bill_no','$prod','$qty','$value','$category','$uname','$mydate','$rate','$bill_status')");
	}
function update_other_product_bill($bill_no,$cust_name,$veh_no,$mob_no,$shift,$counter,$sales_mode,$total,$indent_no,$cust_id,$cheque_no,$cheque_date,$cheque_status,$bank_name,$clearance_date,$ref_no)
	{
	$uname=$this->session->userdata('admin_user_email');
	$add_date=date('Y-m-d H:i:s');
	$this->db->query("UPDATE other_pdts_bill SET customer_name='$cust_name',cust_id='$cust_id',vehicle_no='$veh_no',mobile_no='$mob_no',shift='$shift',counter='$counter',sale_mode='$sales_mode',total_amt='$total',indent_no='$indent_no',added_by='$uname',bill_time='$add_date',bill_updated=(bill_updated+1),cheque_no='$cheque_no',cheque_date='$cheque_date',cheque_status='$cheque_status',bank_name='$bank_name',clearance_date='$clearance_date',reference_no='$ref_no' WHERE bill_no='$bill_no' ");
	}
function get_other_product_sale_mode($bill_no)
	{
	$sale_mode=$this->db->query("SELECT sale_mode FROM crm.other_pdts_bill
										where bill_no='$bill_no'");
	$sale_mode=$sale_mode->result();
	foreach($sale_mode as $cust){
	$sale=$cust->sale_mode;
	return $sale;
	}
	}
function check_indent_no($cust_id)
	{
	$Indent_no=$this->db->query("SELECT indent_start_no,indent_end_no FROM crmnoindex.customer_master
	where customer_id='$cust_id';");
	$Indent_no=$Indent_no->result();
	foreach($Indent_no as $indent){
	$indent_start=$indent->indent_start_no;
	$indent_end=$indent->indent_end_no;
	return $indent_start."!".$indent_end;
	}
	}
	function check_indent_duplication($indent_no){
		$result=$this->db->query("SELECT count(A.ind_no) as cnt
			FROM(
			SELECT indent_no as ind_no from retail_bills where indent_no='$indent_no' union
			SELECT indent_no as ind_no from other_pdts_bill  where indent_no='$indent_no'
			) AS A"
		)->result();
		foreach($result as $row){
			return $row->cnt;
		}
	}

	function get_bill_info($bill_no){
		return $this->db->query("select *,date(bill_time) as bill_date from retail_bills where bill_number='$bill_no'")->result_array();
	}
	
	function get_bill_details($bill_no){
		return $this->db->query("select * from bill_details where bill_no='$bill_no'")->result_array();
	}
	
	function get_oth_bill_info($bill_no){
		return $this->db->query("select *,date(bill_time) as bill_date from other_pdts_bill where bill_no='$bill_no'")->result_array();
	}
	
	function get_test_bill_info($bill_no){
		return $this->db->query("select * from testing_register where bill_no='$bill_no'")->result_array();
	}
	
	function get_oth_bill_details($bill_no){
		return $this->db->query("select * from other_pdts_bill_details where bill_no='$bill_no'")->result_array();
	}
	
	function check_sales_entry($edate,$shift,$pump){
		 $result=$this->db->query("select count(*) as cnt from petrol_sales_entry where acct_date='$edate' and shift='$shift' and pump_no='$pump'")->result_array();
		 foreach ($result as $res){
		 	return $res['cnt'];
		 }
		
	}
	function get_retail_customer_details($vehicle)
	{
		$retail_cust=$this->db->query("SELECT customer_name,mobile_number FROM crm.retail_customers
		where vehicle_number='$vehicle';");
		$rowcount=$retail_cust->num_rows();
		$retail_cust=$retail_cust->result();
		
		foreach($retail_cust as $cust){
		$customer_name= $cust->customer_name;
		$mobile_number= $cust->mobile_number;
		return $customer_name."!".$mobile_number."!".$rowcount;
		
		}
	}
	function get_other_pdts_customer_details($customer_id)
	{
		$retail_cust=$this->db->query("SELECT vehicle_number,mobile_number,avg_km,km_reading,oil_service_enable,oil_service_dob,oil_service_wedding_date  FROM retail_customers
		where cust_id='$customer_id';");
		$rowcount=$retail_cust->num_rows();
		$retail_cust=$retail_cust->result();
		
		foreach($retail_cust as $cust){
		$vehicle_number= $cust->vehicle_number;
		$mobile_number= $cust->mobile_number;
		$avg_km=$cust->avg_km;
		$km_reading=$cust->km_reading;
		$oil_service_enable=$cust->oil_service_enable;
		$oil_service_dob=$cust->oil_service_dob;
		$oil_service_wedding_date=$cust->oil_service_wedding_date;
		return $vehicle_number."!".$mobile_number."!".$avg_km."!".$km_reading."!".$oil_service_enable."!".$oil_service_dob."!".$oil_service_wedding_date."!".$rowcount;
		
		}
	}
	function check_vehicle($vehicle)
	{
		$query=$this->db->query("select  count(*) as 'count' from retail_customers where vehicle_number='$vehicle' ");
		foreach ($query->result_array() as $row);
		$count= $row["count"]; 
		return $count;	
	}	
	function check_customer($customer)
	{
		$query=$this->db->query("select  count(*) as 'count' from retail_customers where cust_id='$customer' ");
		foreach ($query->result_array() as $row);
		$count= $row["count"]; 
		return $count;	
	}	
	function check_tank_stock($acct_date){
		return $this->db->query("SELECT tank_no from tank_master t join product_master p on p.product_name=t.product where t.tank_no not in (SELECT tank_no from tank_stock where account_date='$acct_date') and t.status=1 and p.category!='2T_OIL_LOOSE'")->result_array();
	}
 	function last_shift_status($counter,$shift,$action,$acct_date){
		$result=$this->db->query("select * from shift_open_entry where counter='$counter' and added_date=(select max(added_date) from shift_open_entry where counter='$counter')")->result_array();
		if(!empty($result)){
		foreach ($result as $res){
			if($res["action"]==$action){
			 	return "Could not complete operation. Last Counter Details: Counter=".$res["counter"] .", Status=".$res["action"].", Shift=".$res["shift"]." and account date=".date('d-m-Y',strtotime($res["account_date"]));
			}
			else if(($action=='close')&&(($shift!=$res["shift"])||(date('d-m-Y',strtotime($acct_date))!=date('d-m-Y',strtotime($res["account_date"]))))){
				return "Could not complete operation. Last Counter Details: Status=".$res["action"].",shift=".$res["shift"]." and account date=".date('d-m-Y',strtotime($res["account_date"]));
			}
			else{
				return "yes";
			}
		}
		}
		else{
			 	return "yes";
		}
	}
	
	function get_acct_date($counter){
		$result=$this->db->query("select date(account_date) as 'acct_date',shift from shift_open_entry where counter='$counter' and added_date=(select max(added_date) from shift_open_entry where counter='$counter' and action='close')")->result_array();
		if(!empty($result)){
			return $result;
		}
		else{
			return "nodata";
		}
	}
	
	function open_close_shift($counter,$shift,$action,$acct_date){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$result=$this->db->query("insert into shift_open_entry(account_date,counter,shift,action,user,added_date) values('$acct_date','$counter','$shift','$action','$uname','$add_date')");
		if($action=='open'){
			return "Shift is opened Successfully:::$counter";
		}
		else if($action=='close'){
			return "Shift is closed Successfully";
		}
	}	
	
	function getCounterShift($counter){
		return $this->db->query("select * from shift_open_entry where counter='$counter' and added_date=(select max(added_date) from shift_open_entry where counter='$counter')")->result_array();
	}
	
	function fetch_managed_retail_bill_details($start,$end)
		{
	
		$query=$this->db->query("SELECT *
								FROM(SELECT bill_number,customer_name,vehicle_number,mobile_number,pump_number,shift,counter,sale_mode,total_amount,user,bill_time,acct_date,(bill_updated)+1 as bill_updated
								FROM retail_bills
								WHERE bill_updated NOT IN('0') 
								UNION 
								SELECT bill_number,customer_name,vehicle_number,mobile_number,pump_number,shift,counter,sale_mode,total_amount,user,bill_time,acct_date,bill_updated
								FROM retail_bills_log
								
								) as log
								WHERE acct_date BETWEEN '$start' and  '$end'
								ORDER BY log.bill_number,log.bill_updated desc");
		return $query->result();
		}
	function fetch_no_of_version($bill_no)
		{
		$query=$this->db->query("SELECT COUNT(*) AS COUNT
								FROM (SELECT *
								FROM retail_bills
								WHERE bill_updated NOT IN('0')  AND bill_number='$bill_no'
								UNION 
								SELECT *
								FROM retail_bills_log
								WHERE bill_number='$bill_no') as Log");
		foreach ($query->result_array() as $row);
		$count= $row["COUNT"]; 
		return $count;
		}
		function get_old_bill_details($bill_no,$version){
		$query=$this->db->query("SELECT * 
								 FROM crm.retail_bills_log 
								 where bill_number='$bill_no' AND  bill_updated='$version'");
		return $query->result();
		}
		function get_old_product_bill_details($bill_no,$version)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.bill_details_log  
								 where bill_no ='$bill_no' AND  bill_updated = '$version'
								 GROUP BY product");
		return $query->result();
		
		}
		function fetch_managed_other_pdts_bill_details($start,$end)
		{
	
		$query=$this->db->query("SELECT *
								FROM(SELECT bill_no,customer_name,vehicle_no,mobile_no,shift,counter,sale_mode,total_amt,added_by,bill_time,acct_date,(bill_updated)+1 as bill_updated
								FROM other_pdts_bill
								WHERE bill_updated NOT IN('0') 
								UNION 
								SELECT bill_no,customer_name,vehicle_no,mobile_no,shift,counter,sale_mode,total_amt,added_by,bill_time,acct_date,bill_updated
								FROM other_pdts_bill_log) as log
								WHERE acct_date BETWEEN '$start' and  '$end'
								ORDER BY log.bill_no,log.bill_updated desc");
		return $query->result();
		}
		function fetch_no_of_version_other($bill_no)
		{
		$query=$this->db->query("SELECT COUNT(*) AS COUNT
								FROM (SELECT *
								FROM other_pdts_bill
								WHERE bill_updated NOT IN('0')  AND bill_no='$bill_no'
								UNION 
								SELECT *
								FROM other_pdts_bill_log
								WHERE bill_no='$bill_no') as Log");
		foreach ($query->result_array() as $row);
		$count= $row["COUNT"]; 
		return $count;
		}
		function get_otherpdts_old_bill_details($bill_no,$version){
		$query=$this->db->query("SELECT * 
								 FROM crm.other_pdts_bill_log 
								 where bill_no='$bill_no' AND  bill_updated='$version'");
		return $query->result();
		}
		function get_otherpdts_old_product_bill_details($bill_no,$version)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.other_pdts_bill_details_log 
								 where bill_no ='$bill_no' AND  bill_updated = '$version'
								 GROUP BY product");
		return $query->result();
		
		}
		function delete_retail_bills($bill_no)
		{
		$this->db->query("DELETE FROM retail_bills  WHERE bill_number='$bill_no'");
		}
		function delete_testing_bills($bill_no)
		{
		$this->db->query("DELETE FROM testing_register  WHERE bill_no='$bill_no'");
		}
		function update_cancelled_retail_bills($bill_no,$reason)
		{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("UPDATE crm.cancelled_retail_bills
							SET cancelled_user='$uname',cancelled_time='$add_date',reason='$reason'
							WHERE bill_number='$bill_no' ");
		}
	function update_cancelled_testing_bills($bill_no,$reason)
		{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("UPDATE crm.cancelled_testing_register
							SET cancelled_user='$uname',cancelled_time='$add_date',reason='$reason'
							WHERE bill_no='$bill_no' ");
		}
		function delete_other_pdt_bills($bill_no)
		{
		$this->db->query("DELETE FROM other_pdts_bill  WHERE bill_no='$bill_no'");
		}
		function update_cancelled_other_pdt_bills($bill_no,$reason)
		{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("UPDATE crm.cancelled_other_pdts_bill
							SET cancelled_user='$uname',cancelled_time='$add_date',reason='$reason'
							WHERE bill_no='$bill_no'");
		}
		function get_cancelled_bills($start,$end)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.cancelled_retail_bills			 
								 where DATE(cancelled_time) BETWEEN '$start' and '$end' ORDER BY cancelled_time desc
								 ");
		return $query->result();
		}
		
		function get_cancelled_testing_bills($start,$end)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.cancelled_testing_register			 
								 where DATE(cancelled_time) BETWEEN '$start' and '$end' ORDER BY cancelled_time desc
								 ");
		return $query->result();
		}
		
		
		function get_cancelled_bill_details($bill_no)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.cancelled_retail_bills			 
								 where bill_number='$bill_no'
								 ");
		return $query->result();
		}
		function get_cancelled_bill_pdt_details($bill_no)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.cancelled_bill_details		 
								 where bill_no='$bill_no'
								 group by product
								 ");
		return $query->result();
		
		}
		function get_cancelled_bills_other($start,$end)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.cancelled_other_pdts_bill		 
								 where DATE(cancelled_time) BETWEEN '$start' and '$end' ORDER BY cancelled_time desc
								 ");
		return $query->result();
		}
		function get_cancelled_bill_details_other($bill_no)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.cancelled_other_pdts_bill		 
								 where bill_no='$bill_no'
								 ");
		return $query->result();
		}
		function get_cancelled_bill_pdt_details_other($bill_no)
		{
		$query=$this->db->query("SELECT *  
								 FROM crm.cancelled_other_pdts_bill_details		 
								 where bill_no='$bill_no'
								 group by product
								 ");
		return $query->result();
		
		}
		
		function update_indent_taken($cust_id,$amt,$mode){
			$result=$this->db->query("select indent_taken from customer_master where customer_id='$cust_id'")->row();
			$old_indent_taken=$result->indent_taken;
			if($mode=='Add'){
				$new_indent_taken=$old_indent_taken+$amt;
			}
			else{
				$new_indent_taken=$old_indent_taken-$amt;
			}
			
			$this->db->query("Update customer_master set indent_taken='$new_indent_taken' where customer_id='$cust_id'");
		}
		
		function get_rfid_entry(){
			$add_date=date('Y-m-d');
			return $this->db->query("SELECT * FROM rfid_read_log WHERE processed=0 and date(action_time)='$add_date'")->result_array();
		}
		
		function check_cust_type($veh){
		$result=$this->db->query("SELECT * FROM customer_master WHERE vehicle_number LIKE '%$veh%'")->result_array();
		if(!empty($result)){
		foreach($result as $res){
			return "yes"."!@#".$res["customer_name"];	
		}
		}
		else{
			return "no";
		}
		
	}
	
		function get_billsms_status(){
			return $this->db->query("SELECT bill_sms from sms_control limit 1;")->row();
		}

	}