
<?php
class Export_data_model extends CI_Model{
	
	function indent_stmt_details($sdate,$edate){
		return $this->db->query("Select a.*,b.customer_name,b.tin from indent_statement_bills a join customer_master b on b.customer_id=a.cust_id where bill_date between '$sdate' and '$edate'")->result_array();
	}
	
	function indent_stmt_details1(){
		return $this->db->query("Select * from export_data ")->result_array();
	}
	
	function get_transactions_report($sdate,$edate){
         return $this->db->query("select * from bank_transactions a join bank_accounts b on b.bank_code=a.bank_code where transaction_type='CASH' and deposited_date between '$sdate' and '$edate'")->result_array();
	}
	
	function export_data(){
		return $this->db->query("SELECT * FROM export_data")->result();
	}
	
	function fetch_export_info(){
		return $this->db->query("SELECT * FROM export_data ")->result_array();
	}
  function cheque_sal_report($sdate,$edate){
		return $this->db->query("
	Select bill_number,acct_date ,bank_name,customer_name,vehicle_number,total_amount,
    cheque_date,cheque_no,cheque_status,clearance_date from retail_bills
	where cheque_no!='NULL' and clearance_date!='NULL' and clearance_date between '$sdate' and '$edate'

	union

	Select bill_no,acct_date,bank_name,customer_name,vehicle_no,total_amt, cheque_date,
	cheque_no,cheque_status,clearance_date from other_pdts_bill
	where cheque_no!='NULL' and clearance_date!='NULL' and clearance_date between '$sdate' and '$edate'
	order by bill_number
	")->result_array();
	}
function cheque_sale_code(){
		return $this->db->query("SELECT reference_no FROM bank_accounts where bank_name='ICICI Bank'")->result_array();
	}
 function cheque_sal_not_cleared_report($sdate,$edate){
		return $this->db->query("
	Select a.bill_number,a.acct_date ,a.bank_name,a.customer_name,a.vehicle_number,a.total_amount,
    a.cheque_date,a.cheque_no,a.cheque_status,a.clearance_date,b.reference_no from retail_customers b right join  retail_bills a on b.vehicle_number=a.vehicle_number
	where a.cheque_no!='NULL' and a.cheque_status='NOT_CLEARED' and a.acct_date between '$sdate' and '$edate'

	union

	Select a.bill_no,a.acct_date,a.bank_name,a.customer_name,a.vehicle_no,a.total_amt, a.cheque_date,
	a.cheque_no,a.cheque_status,a.clearance_date,b.reference_no from retail_customers b right join other_pdts_bill a on b.vehicle_number=a.vehicle_no
	where cheque_no!='NULL' and cheque_status='NOT_CLEARED' and  acct_date between '$sdate' and '$edate'
	order by bill_number
	")->result_array();
	}
function indent_stmt_payment($sdate,$edate){
		return $this->db->query("Select c.customer_name,c.tin,a.bill_no,b.payment_mode,b.amount,b.payment_date,b.cheque_no,b.cheque_date,b.cheque_status,b.bank_name,b.clearance_date from indent_statement_bills a join indent_stmt_payments b on b.bill_no=a.bill_no join customer_master c on c.customer_id=a.cust_id where b.clearance_date between '$sdate' and '$edate' and payment_mode='CHEQUE' and cheque_status='CLEARED'")->result_array();
	}
function get_credit_report($sdate,$edate){
         return $this->db->query("select * from bank_transactions a join bank_accounts b on b.bank_code=a.bank_code where transaction_type='CREDIT' and deposited_date between '$sdate' and '$edate' and bank_name!='HDFC Bank'")->result_array();
	}
function get_hdfc_credit_report($sdate,$edate){
         return $this->db->query("select * from bank_transactions a join bank_accounts b on b.bank_code=a.bank_code where transaction_type='CREDIT' and deposited_date between '$sdate' and '$edate' and bank_name='HDFC Bank'")->result_array();
	}
function hdfc_cheque_sale_code(){
		return $this->db->query("SELECT reference_no FROM bank_accounts where bank_name='HDFC Bank'")->result_array();
	}
	
 function cash_sal_report($sdate,$edate){
		return $this->db->query("
	Select c.customer_name,a.bill_date,c.tin,a.bill_no,b.payment_mode,b.payment_date,b.amount from indent_statement_bills a join indent_stmt_payments b on b.bill_no=a.bill_no join customer_master c on c.customer_id=a.cust_id where b.payment_date between '$sdate' and '$edate' and payment_mode='CASH'
	")->result_array();
	}
	
	function update_export_data_info($section_code,$business_area,$sap_sale_code,$cost_center,$profit_center,$indent_stmt_rpt_ref,$bank_trans_rpt_ref,$cheque_sales_rpt_ref,$indent_pmt_rpt_ref,$credit_sales_rpt_ref,$hdfc_credit_sales_ref,$cash_sales_rpt_ref){
		return $this->db->query("UPDATE export_data SET section_code='$section_code',business_area='$business_area',sap_sale_code='$sap_sale_code',cost_center='$cost_center',profit_center='$profit_center',indent_stmt_rpt_ref='$indent_stmt_rpt_ref',bank_trans_rpt_ref='$bank_trans_rpt_ref',cheque_sales_rpt_ref='$cheque_sales_rpt_ref',indent_pmt_rpt_ref='$indent_pmt_rpt_ref',credit_sales_rpt_ref='$credit_sales_rpt_ref',hdfc_credit_sales_ref='$hdfc_credit_sales_ref',cash_sales_rpt_ref='$cash_sales_rpt_ref'");
	}
}