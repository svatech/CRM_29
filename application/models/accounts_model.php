<?php
class Accounts_model extends CI_Model
{

function get_indent_cust_list(){
		return $this->db->query("select * from customer_master")->result_array();
	}
	
function get_initial_deposit($cust_name){
	return $this->db->query("SELECT * FROM customer_master WHERE customer_id='$cust_name'")->result_array();
}

function get_payment_list($cust_name){
	return $this->db->query("SELECT * FROM indent_stmt_payments a join indent_statement_bills b on b.bill_no=a.bill_no WHERE b.cust_id='$cust_name'")->result_array();
}

function get_cust_name($cust_id){
	return $this->db->query("SELECT * FROM customer_master where customer_id='$cust_id'")->result_array();
}

function get_bill_details($bill_no){
	return $this->db->query("SELECT *,(SELECT ifnull(SUM(amount),0) FROM indent_stmt_payments WHERE bill_no='$bill_no' and cheque_status!='BOUNCED') AS paid_amount FROM indent_statement_bills WHERE bill_no='$bill_no'")->result_array();
}

function submit_payment($billno,$pdate,$pmode,$pamount,$chequeno,$chequedate,$bankname,$refno,$status){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into indent_stmt_payments(bill_no,payment_date,payment_mode,amount,cheque_no,cheque_date,bank_name,cheque_status,reference_no,action_user,action_time) values('$billno','$pdate','$pmode','$pamount','$chequeno','$chequedate','$bankname','$status','$refno','$uname','$add_date')");
	}
	
function get_indent_stmt_by_bill($bill_no){
		return $this->db->query("Select a.*,b.customer_name,(SELECT Sum(amount) from indent_stmt_payments where bill_no='$bill_no') as 'paid_amt' from indent_statement_bills a join customer_master b on a.cust_id=b.customer_id where bill_no='$bill_no'")->result_array();
	}
	
function submit_adv_payment($cust_id,$pdate,$pmode,$pamount,$chequeno,$chequedate,$bankname,$refno,$status){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into indent_adv_payments(cust_id,payment_date,payment_mode,amount,cheque_no,cheque_date,bank_name,cheque_status,reference_no,action_user,action_time) values('$cust_id','$pdate','$pmode','$pamount','$chequeno','$chequedate','$bankname','$status','$refno','$uname','$add_date')");
}

function get_advance_payments($cust_id){
	return $this->db->query("SELECT IFNULL(IFNULL(C.ADV,0)-IFNULL(C.PAID,0),0) AS ADVANCE_PAYMENTS	FROM
	(SELECT (SELECT SUM(amount) FROM indent_stmt_payments a join indent_statement_bills b on b.bill_no=a.bill_no WHERE a.payment_mode='DEBIT FROM ADVANCE' and b.cust_id='$cust_id') AS PAID, (SELECT SUM(amount) FROM indent_adv_payments where cust_id='$cust_id') AS ADV FROM dual ) AS C")->result_array();
}

function get_balance_amount($cust_id){
	return $this->db->query("SELECT IFNULL(IFNULL(C.OPEN_BAL,0)+IFNULL(C.BILL,0)-IFNULL(C.PAID,0),0) AS bal_paymt	FROM
(SELECT (SELECT opening_balance FROM customer_master  WHERE customer_id='$cust_id') AS OPEN_BAL,(SELECT SUM(bill_amount) FROM indent_statement_bills  WHERE cust_id='$cust_id') AS BILL, (SELECT SUM(b.amount) FROM indent_statement_bills a join indent_stmt_payments b on b.bill_no=a.bill_no WHERE a.cust_id='$cust_id' and b.cheque_status!='BOUNCED') AS PAID) AS C")->result_array();
}
function submit_deduce_payment($bill_no,$pmode,$pamount){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$cur_date=date('Y-m-d');
		$this->db->query("INSERT INTO indent_stmt_payments(bill_no,payment_date,payment_mode,amount,cheque_status,action_user,action_time) values('$bill_no','$cur_date','$pmode','$pamount','CLEARED','$uname','$add_date')");
}

function add_new_cash_in($trans_date,$cash_source,$amount,$remarks){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into cash_inflow(transaction_date,cash_source,amount,remarks,added_by,added_time) values('$trans_date','$cash_source','$amount','$remarks','$uname','$add_date')");
}

function get_cash_in_list($start_date,$end_date){
	return $this->db->query("Select * from cash_inflow where transaction_date between '$start_date' and '$end_date'")->result();
}

function get_cash_inflow_info($trans_id){
	return $this->db->query("SELECT * FROM cash_inflow where id='$trans_id'")->result_array();
}

function update_cash_inflow($trans_id,$trans_date,$cash_source,$remarks,$amount){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Update cash_inflow set transaction_date='$trans_date', cash_source='$cash_source', amount='$amount', remarks='$remarks',added_by='$uname', added_time='$add_date' where id='$trans_id'");
}

function cancel_cash_in($trans_id,$reason){
		$uname=$this->session->userdata('admin_user_email');
		$add_date=date('Y-m-d H:i:s');
		$this->db->query("Insert into cancelled_cash_inflow (select '',transaction_date,cash_source,amount,remarks,added_by,added_time,\"$uname\",\"$add_date\",\"$reason\" from cash_inflow where id='$trans_id') ");
		$this->db->query("Delete from cash_inflow where id='$trans_id'");
}

function get_cancelled_cash_in($start_date,$end_date){
	return $this->db->query("Select * from cancelled_cash_inflow where transaction_date between '$start_date' and '$end_date'")->result();
}

function get_cashinhand(){
	return $this->db->query("SELECT ifnull(C.cashin-C.expense,0) AS cash_inhand	FROM
(SELECT (SELECT ifnull(SUM(amount),0) FROM cash_inflow) AS cashin, (SELECT ifnull(SUM(amount),0) FROM expenses) AS expense) AS C")->result_array();
}
}