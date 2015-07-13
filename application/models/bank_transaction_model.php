<?php
class Bank_transaction_model extends CI_Model
{
function get_banks(){
	return $this->db->query("Select * from bank_accounts")->result_array();
}

function get_bank_code(){
		$result=$this->db->query("Select bank_id from bill_no_generator")->row();
		$curr_bank_id=$result->bank_id;
		$next_bank_id=++$curr_bank_id;
		$this->db->query("Update bill_no_generator set bank_id='$next_bank_id'");
		return $result->bank_id;
	}
	
function insert_new_bank($bank_code,$bank_name){
		$this->db->query("Insert into bank_accounts(bank_code,bank_name) values(\"$bank_code\",\"$bank_name\")");
	}
	
function add_new_transaction($trans_type,$deposited_date,$bank_code,$remarks,$shift_date,$from_date,$to_date,$amount){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into bank_transactions(transaction_type,deposited_date,bank_code,shift_date,trans_start_date,trans_end_date,amount,remarks,added_by,added_time) values('$trans_type','$deposited_date','$bank_code','$shift_date','$from_date','$to_date','$amount','$remarks','$uname','$add_date')");
	}
	
function get_transaction_list($start_date,$end_date){
		return $this->db->query("Select a.*,b.bank_name from bank_transactions a join bank_accounts b on b.bank_code=a.bank_code where deposited_date between '$start_date' and '$end_date'")->result();
	}
	
function get_transaction_info($trans_id){
		return $this->db->query("Select a.*,b.bank_name from bank_transactions a join bank_accounts b on b.bank_code=a.bank_code where a.id='$trans_id'")->result_array();
	}
	
function update_transaction($transaction_id,$trans_type,$deposited_date,$bank_code,$shift_date,$from_date,$to_date,$amount,$remarks){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Update bank_transactions set transaction_type='$trans_type',deposited_date='$deposited_date', bank_code='$bank_code', shift_date='$shift_date',trans_start_date='$from_date',trans_end_date='$to_date', amount='$amount',remarks='$remarks',added_by='$uname', added_time='$add_date' where id='$transaction_id'");
	}
function cancel_entry($trans_id,$reason){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into cancelled_bank_transactions (select '',id,deposited_date,bank_code,shift_date,amount,remarks,added_by,added_time,\"$uname\",\"$add_date\",\"$reason\",transaction_type,trans_start_date,trans_end_date from bank_transactions where id='$trans_id') ");
		$this->db->query("Delete from bank_transactions where id='$trans_id'");
		
	}
	
function get_cancelled_transactions($start_date,$end_date){
		return $this->db->query("Select a.*,b.bank_name from cancelled_bank_transactions a join bank_accounts b on b.bank_code=a.bank_code where deposited_date between '$start_date' and '$end_date'")->result();
	}
}