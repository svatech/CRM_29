<?php
class Statements extends CI_Controller
		{  
	function __construct(){
	parent::__construct();
	$this->load->model('Statements_model');
	$this->load->model('Sales_model');
	$this->load->helper('rstoword');
	$this->load->library('SimpleLoginSecure');
	$this->load->library('Ebook_xl_rpt');
	$this->load->library('Fuel_stmt_xl_rpt');
	$this->load->library('Cumulative_Fuel_stmt_xl_rpt');
	$this->load->library('Cumulative_Sales_stmt_xl_rpt');
	$this->load->library('Stock_stmt_xl_rpt');
	$this->load->library('Indent_stmt_xl_rpt');
		if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
	}

function index()
		{	
		$data["menu"]='statements';
		$data["submenu"]='fuel_stmt';
		$this->template->write('titleText', "Daily Fuel Statement");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'statements/fuel_statement',$data);
        $this->template->render();					
		}

	function fuel_stmt(){
	$form_data = $this->input->post();
	$data['stmt_date']=$form_data['sdate'];
	$this->load->view('statements/pages/fuel_stmt_page',$data);
	}

	function cumulative_fuel_stmt(){
		$data["menu"]='statements';
		$data["submenu"]='cumulative_fuel_stmt';
		$this->template->write('titleText', "Cumulative Fuel Statement");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'statements/cumulative_fuel_statement',$data);
        $this->template->render();
	}
	
	function cumulative_fuel_stmt_rpt(){
		$form_data = $this->input->post();
		$data['start_date']=$form_data['sdate'];
		$data['end_date']=$form_data['edate'];
		$this->load->view('statements/pages/cumulative_fuel_stmt_page',$data);
	}
	
		function cumulative_sales_stmt(){
		$data["menu"]='statements';
		$data["submenu"]='cumulative_sales_stmt';
		$data['category']=$this->Statements_model->get_category_list();
		$this->template->write('titleText', "Cumulative Sales Statement");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'statements/cumulative_sales_statement',$data);
        $this->template->render();
	}
	
	function cumulative_sales_stmt_rpt(){
		$form_data = $this->input->post();
		$data['start_date']=$form_data['sdate'];
		$data['end_date']=$form_data['edate'];
		$data['category']=$form_data['category'];
		$data["sales_stmt"]=$this->Statements_model->get_cumulative_sales_stmt($form_data["sdate"],$form_data["edate"],$form_data['category']);
		$this->load->view('statements/pages/cumulative_sales_stmt_page',$data);
	}
	
		function cumulative_sales_stmt_dwnld($params){
		$form_data=explode("::", $params);
		$start=$form_data[0];
		$end=$form_data[1];
		$category=$form_data[2];
		$stmt=$this->Statements_model->get_cumulative_sales_stmt($start,$end,$category);
		$exporter= new Cumulative_Sales_stmt_xl_rpt();
		$exporter->Export($params,$stmt);
	}
	
	
	function indent_stmt(){
	$data["menu"]='statements';
	$data["submenu"]='indent_stmt';
	$data["cust_list"]=$this->Statements_model->get_indent_cust_list();
	$this->template->write('titleText', "Indent Sales Statement");
	$this->template->write_view('sideLinks', 'general/menu',$data);
    $this->template->write_view('bodyContent', 'statements/indent_statement',$data);
    $this->template->render();		
	}

	function indent_stmt_page(){
	$form_data = $this->input->post();
	$data["sdate"]=$form_data["sdate"];
	$data["edate"]=$form_data["edate"];
	$data["cust_name"]=$form_data["cust_name"];
	$data["indent_stmt"]=$this->Statements_model->get_indent_stmt($form_data["sdate"],$form_data["edate"],$form_data["cust_name"]);
	$data["cust_addr"]=$this->Statements_model->get_cust_addr($form_data["cust_name"]);
	$this->load->view('statements/pages/indent_stmt_page',$data);
	 
	}
		function stock_statement()
		{
		$data["menu"]='statements';
		$data["submenu"]='stock_stmt';
		$data['category']=$this->Statements_model->get_category_list();
		$this->template->write('titleText', "Stock Statement");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','statements/stock_statement',$data);	
		$this->template->render();
		}
	function ebook(){
		$data["menu"]='statements';
		$data["submenu"]='ebook';
		$data['tanks']=$this->Statements_model->get_tank_list();
		$this->template->write('titleText', "E-Book");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','statements/ebook',$data);	
		$this->template->render();
	}
	
	function ebook_page(){
		$form_data = $this->input->post();
		$data["tank"]=$form_data["tank"];
		$data["month"]=$form_data["month"];
		$data["year"]=$form_data["year"];
		$data["ebook"]=$this->Statements_model->get_ebook($form_data["tank"],$form_data["month"],$form_data["year"]);
		$this->load->view('statements/pages/ebook_page',$data);
	}
		function full_stock_list()
		{
			$date = $this->input->post();
			$start=$date["start"];
			$end=$date["end"];
			$data['summa']=$date["start"];
			$data['fuels']=$this->Statements_model->fetch_fuel_stock($start,$end);
			$data['oil']=$this->Statements_model->fetch_oil_stock($start,$end);
			$data['grease']=$this->Statements_model->fetch_grease_stock($start,$end);
			$data['others']=$this->Statements_model->fetch_others_stock($start,$end);
			$data['twotoil']=$this->Statements_model->fetch_2toil_stock($start,$end);
			
			$this->load->view('statements/pages/stock_stmt_page',$data);
			
		}
		
		function ebook_dwnld($params){
		$form_data=explode("::", $params);
		$tank=$form_data[0];
		$month=$form_data[1];
		$year=$form_data[2];
		$data=$this->Statements_model->get_ebook($tank,$month,$year);
		$exporter= new Ebook_xl_rpt();
		$exporter->Export($data,$params);
	}
	
		function stock_stmt_dwnld($params){
		$form_data=explode("::", $params);
		$start=$form_data[0];
		$end=$form_data[1];
		$cat=$form_data[2];
		$fuels=$this->Statements_model->fetch_fuel_stock($start,$end);
		$oil=$this->Statements_model->fetch_oil_stock($start,$end);
		$grease=$this->Statements_model->fetch_grease_stock($start,$end);
		$others=$this->Statements_model->fetch_others_stock($start,$end);
		$twotoil=$this->Statements_model->fetch_2toil_stock($start,$end);
		$exporter= new Stock_stmt_xl_rpt();
		$exporter->Export($params,$fuels,$oil,$grease,$others,$twotoil);
	}
	
		
	
		function fuel_stmt_dwnld($sdate){
		$sdate=$sdate;
		$exporter= new Fuel_stmt_xl_rpt();
		$exporter->Export($sdate);
	}
	
		function get_indentstmt_billno(){
			 $bill_no=$this->Statements_model->get_indentstmt_billno();
			 $details = $this->input->post();
			 $this->Statements_model->insert_indentstmt($bill_no,$details["from_date"],$details["to_date"],$details["cust_id"],$details["bill_date"],$details["total"]);
			$this->Statements_model->update_indentstmtno($bill_no,$details["from_date"],$details["to_date"],$details["cust_id"]);
			 echo $bill_no;
			
		}
		function indent_customer_statement_sms(){
			
			
			$details = $this->input->post();
			//$result=$this->Statements_model->get_stmt_bills($details["billno"]);
			//$indent_sms_status=1;
			//$this->Statements_model->insert_indentstmt_sms($details["billno"],$indent_sms_status);
			$data['indent_customer_bill']= $this->Statements_model->fetch_indentstmt_details($details["billno"]);
			$this->Statements_model->update_indentstmt_sms($details["billno"]);
			$this->load->view('statements/sms_indent_bill_info',$data);
			//echo $params;
			 
		}
		
		
		function indent_stmt_mgmt(){
			$data["menu"]='statements';
			$data["submenu"]='indent_stmt_mgmt';
			$this->template->write('titleText', "Manage Indent Statements");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'statements/indent_stmt_mgmt',$data);
	        $this->template->render();
		}
		
		function indent_stmt_details(){
			$date = $this->input->post();
			$start=$date["sdate"];
			$end=$date["edate"];
			$data['indent_stmt']=$this->Statements_model->indent_stmt_details($start,$end);
			
			$this->load->view('statements/pages/indent_stmt_mgmt_page',$data);
		}
		
		function reprint_indent_stmt(){
			$bill_no = $this->input->post();
			//$this->Statements_model->update_indent_bill_amt($bill_no["billno"]);
			$result=$this->Statements_model->get_indent_stmt_by_bill($bill_no["billno"]);
			foreach ($result as $res){
				$data["sdate"]=$res["from_date"];
				$data["edate"]=$res["to_date"];
				$data["old_arrears"]=$res["old_arrears"];
				$data["cust_addr"]=$this->Statements_model->get_cust_addr($res["cust_id"]);
				$data["indent_stmt"]=$this->Statements_model->get_indent_stmt_bill($bill_no["billno"]);
				$this->load->view('statements/pages/indent_stmt_page',$data);
			}
		}
		
		function indent_stmt_info($bill_no){
			$data["bill"]=$this->Statements_model->get_indent_stmt_by_bill($bill_no);
			$data["payment"]=$this->Statements_model->indent_stmt_bill_details($bill_no);
			$this->load->view('statements/pages/indent_stmt_info',$data);
		}
		
		function make_payment($bill_no){
			$data["bill_no"]=$bill_no;
			$this->load->view('statements/pages/make_payment',$data);
			
		}
		
		function submit_payment(){
			$details = $this->input->post();
			$result=$this->Statements_model->get_indent_stmt_by_bill($details["bill_no"]);
			foreach ($result as $res){
				$cust_id=$res["cust_id"];
				$this->Sales_model->update_indent_taken($cust_id,$details["payment_amount"],'Sub');
			}
			$this->Statements_model->submit_payment($details["bill_no"],$details["payment_date"],$details["payment_mode"],$details["payment_amount"],$details["cheque_no"],$details["cheque_date"],$details["bank_name"],$details["status"],$details["ref_no"]);
			echo $details["bill_no"];
		}
		
		function update_chequestatus(){
			$details = $this->input->post();
			$result=$this->Statements_model->get_chequestatus($details["payid"]);
			foreach($result as $res){
				if($res["cheque_status"]=='BOUNCED'){
					if($details["status"]!='BOUNCED'){
						$this->Sales_model->update_indent_taken($res["cust_id"],$res["amount"],'Sub');
					}
				}
				else{
					if($details["status"]=='BOUNCED'){
						$this->Sales_model->update_indent_taken($res["cust_id"],$res["amount"],'Add');
					}
				}
			}
			echo $this->Statements_model->update_chequestatus($details["payid"],$details["status"]);
		}
		
		function update_clearancedate(){
			$details = $this->input->post();
			echo $this->Statements_model->update_clearancedate($details["payid"],$details["clearance_date"]);
		}
		
		function cancel_indent_bill(){
			$details = $this->input->post();
			$result=$this->Statements_model->get_stmt_bills($details["billno"]);
			foreach ($result as $res){
				echo $this->Sales_model->update_indent_taken($res["cust_id"],$res["tot_amt"],'Add');
			}
			$this->Statements_model->delete_stmt_bills($details["billno"]);
			$this->Statements_model->update_cancelled_stmt_bills($details["billno"]);
			$this->Statements_model->delete_indent_stmtno($details["billno"]);
		}
		
		function cancel_indent_payment(){
			$details = $this->input->post();
			$result=$this->Statements_model->get_indent_stmtno_by_pid($details["pid"]);
			foreach ($result as $res){
				$this->Sales_model->update_indent_taken($res["cust_id"],$res["amount"],'Add');
			}
			 $this->Statements_model->delete_stmt_payment($details["pid"]);
			 $this->Statements_model->update_cancelled_stmt_payments($details["pid"]);
		}
		
		function cumulative_fuel_stmt_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$exporter= new Cumulative_Fuel_stmt_xl_rpt();
		$exporter->Export($sdate,$edate);
	}
	function indent_stmt_dwnld($params){
	$form_data=explode("::", $params);
	$start=$form_data[0];
	$end=$form_data[1];
	$cust_name=$form_data[2];
	$indent_stmt=$this->Statements_model->get_indent_stmt($start,$end,$cust_name);
	$cust_addr=$this->Statements_model->get_cust_addr($cust_name);
	$exporter= new Indent_stmt_xl_rpt();
	$exporter->Export($params,$indent_stmt,$cust_addr);
	 
	}
}