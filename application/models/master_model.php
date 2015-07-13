<?php
Class Master_model extends CI_Model{
function _construct()
	{
		parent::_construct();
	}
	
	function get_product_list()
	{
	$prod =$this->db->query("SELECT PRODUCT_NAME FROM PRODUCT_MASTER");
	return $prod->result();
	}
	
	function get_tankproduct_list()
	{
	$prod =$this->db->query("SELECT PRODUCT_NAME FROM PRODUCT_MASTER WHERE tank_product = 1");
	return $prod->result();
	}
	
	function check_vehicle_no($params){
		$form_data=explode("-", $params);
		$veh_list="";
		foreach ($form_data as $val){
			if($val!='CAN' && $val!='BARREL'){
			$result=$this->db->query("SELECT COUNT(*) as cnt FROM CUSTOMER_MASTER WHERE  vehicle_number like '%$val%'")->row();
			if($result->cnt > 0){
				$veh_list=$veh_list."-".$val;
			}
			}
		}
		if($veh_list ==''){
			return 0;
		}
		else{
			return $veh_list;
		}
		//return $params;
	}
	
	function check_vehicle_no_upd($params,$cust_id){
		$form_data=explode("-", $params);
		$veh_list="";
		foreach ($form_data as $val){
			if($val!='CAN' && $val!='BARREL'){
			$result=$this->db->query("SELECT COUNT(*) as cnt FROM CUSTOMER_MASTER WHERE customer_id!='$cust_id' and vehicle_number like '%$val%'")->row();
			if($result->cnt > 0){
				$veh_list=$veh_list."-".$val;
			}
			}
		}
		if($veh_list ==''){
			return 0;
		}
		else{
			return $veh_list;
		}
		//return $params;
	}
	
	function get_tank_list()
	{
	$tank=$this->db->query("SELECT TANK_NO,PRODUCT FROM TANK_MASTER ");
	return $tank->result();
	}
	
	function get_activetank_list()
	{
	$tank=$this->db->query("SELECT TANK_NO,PRODUCT FROM TANK_MASTER WHERE STATUS =1");
	return $tank->result();
	}
	
	function get_category_list()
	{
		$category=$this->db->query("SELECT category FROM product_category");
		return $category->result();
	}
	
	function insert_pumpdtls($pump_no,$prod_name,$tank_no,$status,$count_no)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$data=$this->db->query("INSERT INTO pump_master VALUES('','$pump_no','$prod_name','$tank_no','$status','$count_no','$mydate','$uname','','')");
		return $data;
	}
	
	function check_pump($pump_no){

		$query=$this->db->query("select  count(*) as 'count' from pump_master where pump_no='$pump_no'");
		foreach ($query->result_array() as $row);
		if( $row["count"] == 0)
			print("OK");
		 else
	 		print("E");
	}
	
	function insert_tankdtls($tank_no,$prod_name,$capacity,$status)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$data=$this->db->query("INSERT INTO tank_master VALUES('','$tank_no','$prod_name','$capacity','$mydate','$uname','$status')");
		return $data;
	}
	
	function check_tank($tank_no){

		$query=$this->db->query("select  count(*) as 'count' from tank_master where tank_no='$tank_no'");
		foreach ($query->result_array() as $row);
		if( $row["count"] == 0)
			print("OK");
		 else
	 		print("E");
	}
	
function insert_productdtls($prod_name,$prod_rate,$category,$status,$prod_type)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$data=$this->db->query("INSERT INTO product_master VALUES('','$prod_name','$prod_rate','$category','$status','$mydate','$uname','$prod_type','','')");
		return $data;
	}
	
function insert_other_productdtls($prod_name,$prod_rate,$category,$status,$prod_type,$stock)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$data=$this->db->query("INSERT INTO product_master VALUES('','$prod_name','$prod_rate','$category','$status','$mydate','$uname','$prod_type','$stock','')");
		return $data;
	}
	
function check_product($prod_name){

		$query=$this->db->query("select  count(*) as 'count' from product_master where product_name='$prod_name'");
		foreach ($query->result_array() as $row);
		if( $row["count"] == 0)
			print("OK");
		 else
	 		print("E");
	}
	
	function get_tankmaster(){
		$query=$this->db->query("SELECT * FROM tank_master");
		return $query->result();
	}
	
	function get_tank_info($tank_id){
		$query=$this->db->query("SELECT  * FROM tank_master WHERE tank_no='$tank_id'");
		return $query->result();
	}
	
	function update_tank_info($tank_no,$capacity,$status,$prod_name)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		 $this->db->query("update tank_master set tank_no='$tank_no',capacity='$capacity', status='$status',product='$prod_name',updated_date='$mydate',updated_by='$uname' where tank_no='$tank_no'");
	}
	
	function get_pumpmaster(){
		$query=$this->db->query("SELECT * FROM pump_master");
		return $query->result();
	}
	
	function get_pump_info($pump_no){
		$query=$this->db->query("SELECT  * FROM pump_master WHERE pump_no='$pump_no'");
		return $query->result();
	}
	
	function update_pump_info($pump_no,$tank_no,$counter,$status,$prod_name)
	{
		
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		 $this->db->query("update pump_master set tank_no='$tank_no',counter='$counter', status='$status',product_name='$prod_name',updated_date='$mydate',updated_by='$uname' where pump_no='$pump_no'");
	}
	
	function get_productmaster(){
		$query=$this->db->query("SELECT * FROM product_master");
		return $query->result();
	}
	
	function get_product_info($prod_name)
	{
		
		$query=$this->db->query("SELECT  * FROM product_master WHERE product_name='$prod_name'");
		return $query->result();
		}
		
	function update_product_info($prod_name,$prod_rate,$category,$status,$tank_product,$stock,$comm_rate)
	{
		
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$this->db->query("update product_master set  product_rate=$prod_rate,tank_product='$tank_product',category='$category', status='$status',opening_stock='$stock' ,commision_rate='$comm_rate'where product_name='$prod_name'");
	}
	
	function insert_customerdtls($cust_name,$addr,$ph_num,$tin,$vehicle,$indent_no_start,$indent_no_end,$current_custid,$next_custid,$initial_deposit,$indent_limit,$open_bal,$status,$ind_dob)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$cust=mysql_real_escape_string($cust_name);
		$this->db->query("INSERT INTO customer_master(SNo,customer_name,address,phone_number,tin,indent_dob,vehicle_number,indent_start_no,indent_end_no,customer_id,updated_by,updated_date,initial_deposit,indent_limit,opening_balance,status) VALUES('',\"$cust\",'$addr','$ph_num','$tin','$ind_dob','$vehicle','$indent_no_start','$indent_no_end','$current_custid','$uname','$mydate','$initial_deposit','$indent_limit','$open_bal','$status')");
		$this->db->query("UPDATE bill_no_generator SET cust_id='$next_custid'");
	}
	
	function fetch_custid()
	{
		$data=$this->db->query("SELECT cust_id FROM bill_no_generator");
		return $data->result();
	}
	
	function fetch_suppid()
	{
		$data=$this->db->query("SELECT supp_id FROM bill_no_generator");
		return $data->result();
	}
	
function insert_supplierdtls($supp_name,$addr,$ph_num,$tin,$supp_pdts,$current_suppid,$next_suppid)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$this->db->query("INSERT INTO product_suppliers(supplier_id,supplier_name,supplier_address,phone_no,tin_no,supplied_products,updated_by,updated_date) VALUES('$current_suppid','$supp_name','$addr','$ph_num','$tin','$supp_pdts','$uname','$mydate')");
		$this->db->query("UPDATE bill_no_generator SET supp_id='$next_suppid'");
	}
	
function check_customer($cust_name){

		$query=$this->db->query("select  count(*) as 'count' from customer_master where customer_name='$cust_name'");
		foreach ($query->result_array() as $row);
		if( $row["count"] == 0)
			print("OK");
		 else
	 		print("E");
	}
	
function check_supplier($supp_name){

		$query=$this->db->query("select  count(*) as 'count' from product_suppliers where supplier_name='$supp_name'");
		foreach ($query->result_array() as $row);
		if( $row["count"] == 0)
			print("OK");
		 else
	 		print("E");
	}
	
function get_customermaster(){
		$query=$this->db->query("SELECT * FROM customer_master");
		return $query->result();
	}
function get_indent_customer_dob_sms()
	{
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
	    return $this->db->query("SELECT phone_number,indent_dob,customer_name FROM customer_master
			WHERE DATE_FORMAT(indent_dob, '%m-%d') = DATE_FORMAT(CURDATE(), '%m-%d') and  phone_number REGEXP '^[0-9]{10}$' ")->result_array();
	    //foreach($result as $s){
	    //$oil_service = $s['oil_service'];
	  //}
	}	
	
	
function get_suppliermaster(){
		$query=$this->db->query("SELECT * FROM product_suppliers");
		return $query->result();
	}
function get_customer_info($customer_id)
	{
		$query=$this->db->query("SELECT * FROM customer_master WHERE customer_id='$customer_id'");
		return $query->result();
		}
		
function update_customer_info($cust_name,$cust_id,$addr,$phone_number,$tin,$ind_dob,$vehicle_number,$indent_start_no,$indent_end_no,$initial_deposit,$indent_limit,$open_bal,$status)
	{
		
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$this->db->query("update customer_master set customer_name='$cust_name',address='$addr',phone_number='$phone_number',tin='$tin',indent_dob='$ind_dob',vehicle_number='$vehicle_number',indent_start_no='$indent_start_no',indent_end_no='$indent_end_no',updated_by='$uname',updated_date='$mydate',initial_deposit='$initial_deposit',indent_limit='$indent_limit',opening_balance='$open_bal',status='$status' WHERE customer_id='$cust_id'");
	}
	
function update_supplier_info($supp_name,$supp_id,$addr,$phone_number,$tin,$products)
	{
		$uname=$this->session->userdata('admin_user_email');
		$mydate=date('Y-m-d H:i:s');
		$this->db->query("update product_suppliers set supplier_name='$supp_name',supplier_address='$addr',phone_no='$phone_number',tin_no='$tin',supplied_products='$products',updated_by='$uname',updated_date='$mydate' WHERE supplier_id='$supp_id'");
	}
function get_supplier_info($supplier_id)
	{
		$query=$this->db->query("SELECT  * FROM product_suppliers WHERE supplier_id='$supplier_id'");
		return $query->result();
		}
function get_tankproduct_pump($tank_no)
	{
		$prod =$this->db->query("SELECT PRODUCT FROM tank_MASTER WHERE tank_no = '$tank_no'");
		$prod= $prod->result();
		foreach($prod as $prod)
		{
		$prod=$prod->PRODUCT;
		return $prod;
		}
	}
	
function change_sms_bill_opt($status){
	$this->db->query("UPDATE sms_control SET bill_sms='$status'");
}

function get_sms_status(){
	return $this->db->query("SELECT * FROM sms_control")->result_array();
}

function get_rfid_vehicles(){
	return $this->db->query("SELECT a.*,(SELECT customer_name from customer_master where vehicle_number like CONCAT('%',a.vehicle_no,'%') ) AS cust_name FROM rfid_tag_reg a ")->result();
}

function remove_rfid_details($veh_no,$reason){
	$uname=$this->session->userdata('admin_user_email');
	$mydate=date('Y-m-d H:i:s');
	$this->db->query("INSERT INTO rfid_tag_reg_scraps SELECT '',vehicle_no,tag_id,status,'$uname','$mydate','$reason' from rfid_tag_reg where vehicle_no='$veh_no'");
	$this->db->query("DELETE FROM rfid_tag_reg where vehicle_no='$veh_no'");
}

function get_retailcustomermaster(){
	$query=$this->db->query("SELECT distinct customer_name,vehicle_number,mobile_number,cust_id,status,reference_no FROM retail_customers");
	return $query->result();
}

function get_retail_customer_info($cust_id)
	{
		$query=$this->db->query("SELECT * FROM retail_customers WHERE cust_id='$cust_id'");
		return $query->result();
	}
	
	
function update_retail_customer_info($cust_name,$cust_id,$mobile_number,$vehicle_number,$reference_no,$status)
	{
		$this->db->query("update retail_customers set customer_name='$cust_name',mobile_number='$mobile_number',vehicle_number='$vehicle_number',reference_no='$reference_no',status='$status' WHERE cust_id='$cust_id'");
	}

    }
?>