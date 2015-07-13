<?php
Class Stock_model extends CI_Model{

function _construct()
	{
		parent::_construct();
	}

function fetch_tank_details()
{
	$query=$this->db->query("SELECT * FROM tank_master");
	return $query->result();
}

function get_product($tank_no)
{
	$query=$this->db->query("SELECT product FROM tank_master  WHERE tank_no='$tank_no'")->result_array();
	foreach($query as $product){
	return $product["product"];
		} 	
}

function insert_tank_stock_details($acct_date,$tank_no,$product,$volume,$dip_level,$water_level,$density,$act_density,$act_temp){
		$uname=$this->session->userdata('admin_user_email');
		$date=date('Y-m-d H:i:s');
	$this->db->query("INSERT INTO tank_stock(account_date,tank_no,volume,product,water_level,dip_level,spec_density,actual_temp,actual_temp_density,added_date,user) VALUES('$acct_date','$tank_no','$volume','$product','$water_level','$dip_level','$density','$act_temp','$act_density','$date','$uname')");
	
}

function check_tank($tank_no,$acct_date){
		$date=date('Y-m-d');
		$query=$this->db->query("select  count(*) as 'count' from tank_stock where tank_no='$tank_no' AND account_date='$acct_date'");
		foreach ($query->result_array() as $row);
		$count= $row["count"]; 
		return $count;	
		
	}
	function update_tank_stock_details($acct_date,$tank_no,$product,$volume,$dip_level,$water_level,$density,$act_density,$act_temp){
		$uname=$this->session->userdata('admin_user_email');
		$date=date('Y-m-d H:i:s');
		$mydate=date('Y-m-d');
		$this->db->query("UPDATE tank_stock SET volume='$volume' ,product='$product',water_level='$water_level',dip_level='$dip_level',spec_density='$density',actual_temp='$act_temp',actual_temp_density='$act_density',added_date='$date', user='$uname' WHERE tank_no='$tank_no' AND account_date='$acct_date'");
	}
	}
?>