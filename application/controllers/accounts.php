<?php
class Accounts extends CI_Controller
	{
		function __construct(){
		parent::__construct();
		$this->load->model('Accounts_model');
		$this->load->model('Sales_model');
		$this->load->library('SimpleLoginSecure');
		$this->load->library('session');
		$this->load->library('Accounts_stmt_xl_rpt');
		if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
		}
		
		function index(){
			$data["menu"]='accounts';
			$data["submenu"]='cash_in';
			$data["cash_inhand"]=$this->Accounts_model->get_cashinhand();
			$this->template->write('titleText', "Add Cash Inflow");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'accounts/add_new_cash_in',$data);
	        $this->template->render();
		}
		
		function add_new_cash_in(){
			$details=$this->input->post();
			$this->Accounts_model->add_new_cash_in($details["trans_date"],$details["cash_source"],$details["amount"],$details["remarks"]);
			echo $vendor_code;
		}
		
		function manage_cash_in(){
			$data["menu"]='accounts';
			$data["submenu"]='manage_cash_in';
			$this->template->write('titleText', "Manage Cash Inflow");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'accounts/manage_cash_in',$data);
	        $this->template->render();
		}
		
		function indent_cust_history(){
			$data["menu"]='accounts';
			$data["submenu"]='indent_cust_history';
			$data["cust_list"]=$this->Accounts_model->get_indent_cust_list();
			$this->template->write('titleText', "Indent Customers Account History");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'accounts/indent_cust_history',$data);
	        $this->template->render();
		}
		
		function get_acct_history(){
			$info = $this->input->post();
			$data["cust_info"]=$this->Accounts_model->get_initial_deposit($info["cust_name"]);	
			$data["pay_list"]=$this->Accounts_model->get_payment_list($info["cust_name"]);
			$data["adv_paymts"]=$this->Accounts_model->get_advance_payments($info["cust_name"]);
			$data["bal_amt"]=$this->Accounts_model->get_balance_amount($info["cust_name"]);
			$this->load->view('accounts/pages/indent_cust_history_page',$data);
			
		}
		
		function make_cust_payment($cust_id){
			//echo $cust_id;
			$data["cust_info"]=$this->Accounts_model->get_cust_name($cust_id);
			$data["adv_paymts"]=$this->Accounts_model->get_advance_payments($cust_id);
			
			$this->load->view('accounts/pages/make_cust_payment',$data);
		}
		
		function get_bill_details(){
			$info = $this->input->post();
			$result=$this->Accounts_model->get_bill_details($info["bill_no"]);
			if(!empty($result)){
			foreach($result as $res){
				echo $res["bill_amount"].":::".$res["paid_amount"];
			}
			}
			else{
				echo "0:::0";
			}
			
		}
		
		function submit_payment(){
			$details = $this->input->post();
			$result=$this->Accounts_model->get_indent_stmt_by_bill($details["bill_no"]);
			foreach ($result as $res){
				$cust_id=$res["cust_id"];
				$this->Sales_model->update_indent_taken($cust_id,$details["payment_amount"],'Sub');
			}
			$this->Accounts_model->submit_payment($details["bill_no"],$details["payment_date"],$details["payment_mode"],$details["payment_amount"],$details["cheque_no"],$details["cheque_date"],$details["bank_name"],$details["ref_no"],$details["status"]);
			echo $details["bill_no"];
		}
		
		function submit_adv_payment(){
			$details = $this->input->post();
			$this->Sales_model->update_indent_taken($details["cust_id"],$details["payment_amount"],'Sub');
			echo $this->Accounts_model->submit_adv_payment($details["cust_id"],$details["payment_date"],$details["payment_mode"],$details["payment_amount"],$details["cheque_no"],$details["cheque_date"],$details["bank_name"],$details["ref_no"],$details["status"]);
			
		}
		
		function submit_deduce_payment(){
			$details = $this->input->post();
			echo $this->Accounts_model->submit_deduce_payment($details["bill_no"],$details["payment_mode"],$details["payment_amount"]);
		}
		
		function get_cash_in_list(){
			$date = $this->input->post();
			$start=$date["start"];
			$end=$date["end"];
			$data['result']=$this->Accounts_model->get_cash_in_list($start,$end);
			$this->load->view('accounts/show_cash_in_list',$data);
		}
		
		function update_cash_inflow_info(){
			$details = $this->input->post();
			$data["result"]=$this->Accounts_model->get_cash_inflow_info($details["transaction_id"]);
			$this->load->view('accounts/update_cash_inflow_info',$data);
		}
		
		function update_cash_inflow(){
			$details = $this->input->post();
			$this->Accounts_model->update_cash_inflow($details["transaction_id"],$details["trans_date"],$details["cash_source"],$details["remarks"],$details["amount"]);
		}
		
		function cancelled_cash_in(){
			$data["menu"]='accounts';
			$data["submenu"]='cancelled_cash_in';
			$this->template->write('titleText', "Cancelled Cash Inflow");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'accounts/cancelled_cash_in',$data);
	        $this->template->render();
		}
		
		function get_cancelled_cash_in(){
			$date = $this->input->post();
			$start=$date["start"];
			$end=$date["end"];
			$data['result']=$this->Accounts_model->get_cancelled_cash_in($start,$end);
			$this->load->view('accounts/show_cancelled_cash_in',$data);
		}
		
		function cancel_cash_inflow(){
			$collect = $this->input->post();
			$trans_id=$collect["trans_id"];
			$reason=$collect["reason"];
			$result=$this->Accounts_model->cancel_cash_in($trans_id,$reason);
		}
		
		function cash_manager(){
			$data["menu"]='accounts';
			$data["submenu"]='cash_manager';
			$this->template->write('titleText', "Cash Manager");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'accounts/cash_manager',$data);
	        $this->template->render();
		}
		function ind_sal_dwnld($cust_name){
			//$cust_name=cust_name;
			$cust_info=$this->Accounts_model->get_initial_deposit($cust_name);	
			$pay_list=$this->Accounts_model->get_payment_list($cust_name);
			$adv_paymts=$this->Accounts_model->get_advance_payments($cust_name);
			$bal_amt=$this->Accounts_model->get_balance_amount($cust_name);
			$exporter= new Accounts_stmt_xl_rpt();
			$exporter->Export($cust_name,$cust_info,$pay_list,$adv_paymts,$bal_amt);	
		
	}
}