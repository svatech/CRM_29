<?php
	class Expense_mgr extends CI_Controller
	{
		function __construct(){
		parent::__construct();
		$this->load->model('Expense_mgr_model');
		$this->load->library('SimpleLoginSecure');
		$this->load->helper('wordtonumber');	
		$this->load->library('session');
		if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
		}
		
		function index(){
			$data["menu"]='expense_mgr';
			$data["submenu"]='new_expense';
			$data["vendors"]=$this->Expense_mgr_model->get_vendors();
			//$data["items"]=$this->Expense_mgr_model->get_items();
			$this->template->write('titleText', "Add New Expense");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'expense_mgr/add_new_expense',$data);
	        $this->template->render();
		}
		
		function add_new_expense(){
			$details=$this->input->post();
			if($details["vendor_name"]=='new_vendor'){
				//$vendor_code=$this->insert_new_vendor($details["new_vendor_name"]);
				$vendor_code=$this->Expense_mgr_model->get_vendor_code();
				$this->Expense_mgr_model->insert_new_vendor($vendor_code,$details["new_vendor_name"]);
				
			}
			else{
				$vendor_code=$details["vendor_name"];
			}
			$this->Expense_mgr_model->add_new_expense($details["exp_date"],$details["bill_no"],$vendor_code,$details["items"],$details["amount"]);
			echo $vendor_code;
		}
		
		function manage_expense(){
			$data["menu"]='expense_mgr';
			$data["submenu"]='manage_expense';
			$data["vendors"]=$this->Expense_mgr_model->get_vendors();
			$this->template->write('titleText', "Manage Expense");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'expense_mgr/manage_expense',$data);
	        $this->template->render();
		}
		
		function get_expenses_list(){
			$date = $this->input->post();
			$start=$date["start"];
			$end=$date["end"];
			$data['expenses']=$this->Expense_mgr_model->get_expenses_list($start,$end);
			$this->load->view('expense_mgr/show_expenses_list',$data);	
		}
		
		function update_expense_info(){
			$details = $this->input->post();
			$data["vendors"]=$this->Expense_mgr_model->get_vendors();
			$data["expenses"]=$this->Expense_mgr_model->get_expense_info($details["expense_id"]);
			$this->load->view('expense_mgr/update_expense_info',$data);
		}
		
		function update_expense(){
			$details = $this->input->post();
			if($details["vendor_name"]=='new_vendor'){
				$vendor_code=$this->Expense_mgr_model->get_vendor_code();
				$this->Expense_mgr_model->insert_new_vendor($vendor_code,$details["new_vendor_name"]);
				
			}
			else{
				$vendor_code=$details["vendor_name"];
			}
			$this->Expense_mgr_model->update_expense($details["expense_id"],$details["bill_no"],$details["exp_date"],$vendor_code,$details["items"],$details["amount"]);
			
		}
		
		function cancel_entry(){
		$collect = $this->input->post();
		$exp_id=$collect["exp_id"];
		$reason=$collect["reason"];
		$result=$this->Expense_mgr_model->cancel_entry($exp_id,$reason);
		
		}
		
		function cancelled_expense(){
			$data["menu"]='expense_mgr';
			$data["submenu"]='cancelled_expense';
			$this->template->write('titleText', "Cancelled Expenses");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'expense_mgr/cancelled_expense',$data);
	        $this->template->render();
		}
		
		function get_cancelled_expenses(){
			$date = $this->input->post();
			$start=$date["start"];
			$end=$date["end"];
			$data['expenses']=$this->Expense_mgr_model->get_cancelled_expenses($start,$end);
			$this->load->view('expense_mgr/show_cancelled_expenses',$data);	
		}
	}