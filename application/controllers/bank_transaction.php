<?php
class Bank_transaction extends CI_Controller
	{
		function __construct(){
		parent::__construct();
		$this->load->model('Bank_transaction_model');
		$this->load->library('SimpleLoginSecure');
		$this->load->helper('wordtonumber');	
		$this->load->library('session');
		if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
		}
		
		function index(){
			$data["menu"]='bank_transaction';
			$data["submenu"]='new_transaction';
			$data["banks"]=$this->Bank_transaction_model->get_banks();
			//$data["items"]=$this->Expense_mgr_model->get_items();
			$this->template->write('titleText', "Add New Transaction");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'bank_transaction/add_new_transaction',$data);
	        $this->template->render();
		}
		
		function add_new_transaction(){
			$details=$this->input->post();
			if($details["bank_name"]=='new_bank'){
				$bank_code=$this->Bank_transaction_model->get_bank_code();
				$this->Bank_transaction_model->insert_new_bank($bank_code,$details["new_bank_name"]);
				
			}
			else{
				$bank_code=$details["bank_name"];
			}
			$this->Bank_transaction_model->add_new_transaction($details["trans_type"],$details["deposited_date"],$bank_code,$details["remarks"],$details["shift_date"],$details["from_date"],$details["to_date"],$details["amount"]);
			echo $bank_code;
		}
		
		function manage_transaction(){
			$data["menu"]='bank_transaction';
			$data["submenu"]='manage_transaction';
			$data["banks"]=$this->Bank_transaction_model->get_banks();
			$this->template->write('titleText', "Manage Transaction");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'bank_transaction/manage_transaction',$data);
	        $this->template->render();
		}
		
		function get_transaction_list(){
			$date = $this->input->post();
			$start=$date["start"];
			$end=$date["end"];
			$data['transactions']=$this->Bank_transaction_model->get_transaction_list($start,$end);
			$this->load->view('bank_transaction/show_transactions_list',$data);	
		}
		
		function update_transaction_info(){
			$details = $this->input->post();
			$data["banks"]=$this->Bank_transaction_model->get_banks();
			$data["transactions"]=$this->Bank_transaction_model->get_transaction_info($details["transaction_id"]);
			$this->load->view('bank_transaction/update_transaction_info',$data);
		}
		
		function update_transaction(){
			$details = $this->input->post();
			if($details["bank_name"]=='new_bank'){
				$bank_code=$this->Bank_transaction_model->get_bank_code();
				$this->Bank_transaction_model->insert_new_vendor($bank_code,$details["new_bank_name"]);
				
			}
			else{
				$bank_code=$details["bank_name"];
			}
			$this->Bank_transaction_model->update_transaction($details["transaction_id"],$details["trans_type"],$details["deposited_date"],$bank_code,$details["shift_date"],$details["from_date"],$details["to_date"],$details["amount"],$details["remarks"]);
			
		}
		
		function cancel_entry(){
		$collect = $this->input->post();
		$trans_id=$collect["trans_id"];
		$reason=$collect["reason"];
		$result=$this->Bank_transaction_model->cancel_entry($trans_id,$reason);
		}
		
		function cancelled_transaction(){
			$data["menu"]='bank_transaction';
			$data["submenu"]='cancelled_transaction';
			$this->template->write('titleText', "Cancelled Transactions");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'bank_transaction/cancelled_transaction',$data);
	        $this->template->render();
		}
		
		function get_cancelled_transactions(){
			$date = $this->input->post();
			$start=$date["start"];
			$end=$date["end"];
			$data['transactions']=$this->Bank_transaction_model->get_cancelled_transactions($start,$end);
			$this->load->view('bank_transaction/show_cancelled_transactions',$data);	
		}
		
	}