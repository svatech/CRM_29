<?php
class Expense_mgr_model extends CI_Model
{
	function get_vendors(){
		return $this->db->query("Select * from expenses_vendors")->result_array();
	}
	
	function insert_new_vendor($vendor_code,$vendor_name){
		$this->db->query("Insert into expenses_vendors(vendor_code,vendor_name) values(\"$vendor_code\",\"$vendor_name\")");
	}
	
	function get_vendor_code(){
		$result=$this->db->query("Select expense_vendor_id from bill_no_generator")->row();
		$curr_vendor_id=$result->expense_vendor_id;
		$next_vendor_id=++$curr_vendor_id;
		$this->db->query("Update bill_no_generator set expense_vendor_id='$next_vendor_id'");
		return $result->expense_vendor_id;
	}
	
	function add_new_expense($exp_date,$bill_no,$vendor_code,$items,$amount){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into expenses(exp_date,bill_no,vendor_code,items,amount,added_by,added_time) values('$exp_date','$bill_no','$vendor_code','$items','$amount','$uname','$add_date')");
	}
	
	function get_expenses_list($start_date,$end_date){
		return $this->db->query("Select a.*,b.vendor_name from expenses a join expenses_vendors b on b.vendor_code=a.vendor_code where exp_date between '$start_date' and '$end_date'")->result();
	}
	
	function get_expense_info($exp_id){
		return $this->db->query("Select a.*,b.vendor_name from expenses a join expenses_vendors b on b.vendor_code=a.vendor_code where a.id='$exp_id'")->result_array();
	}
	
	function update_expense($exp_id,$bill_no,$exp_date,$vendor_code,$items,$amount){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Update expenses set exp_date='$exp_date', bill_no='$bill_no', vendor_code='$vendor_code', items='$items', amount='$amount',added_by='$uname', added_time='$add_date' where id='$exp_id'");
	}
	
	function cancel_entry($exp_id,$reason){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into cancelled_expenses (select '',id,exp_date,bill_no,vendor_code,items,amount,added_by,added_time,\"$uname\",\"$add_date\",\"$reason\" from expenses where id='$exp_id') ");
		$this->db->query("Delete from expenses where id='$exp_id'");
		
	}
	
	function get_cancelled_expenses($start_date,$end_date){
		return $this->db->query("Select a.*,b.vendor_name from cancelled_expenses a join expenses_vendors b on b.vendor_code=a.vendor_code where exp_date between '$start_date' and '$end_date'")->result();
	}
}