<?php
class Reports extends CI_Controller
{   function __construct(){
	parent::__construct();
	$this->load->model('Reports_model');
	$this->load->library('SimpleLoginSecure');
	$this->load->library('Pet_sal_xl_rpt');
	$this->load->library('Pet_sal_xl_rpt_mw');
	$this->load->library('Oth_sal_xl_rpt');
	$this->load->library('Ind_sal_xl_rpt');
	$this->load->library('Pet_pur_xl_rpt');
	$this->load->library('Oth_pur_xl_rpt');
	$this->load->library('Test_reg_xl_rpt');
	$this->load->library('Tank_stock_xl_rpt');
	$this->load->library('Shift_close_xl_rpt');
	$this->load->library('Pet_reg_xl_rpt');
	$this->load->library('Oth_reg_xl_rpt');
	$this->load->library('Expenses_rpt');
	$this->load->library('Transactions_rpt');
	$this->load->library('Rfid_rpt');
	$this->load->library('Indent_stmt_report');
	$this->load->library('Cash_inflow_rpt');
	$this->load->library('Indent_stmt_payment_rpt');
	$this->load->library('Cheque_sal_xl_rpt');
	if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
}

function index()
	{	
		$data["menu"]='reports';
		$data["submenu"]='pet_sal_rpt';
		$this->template->write('titleText', "Petrol/Diesel Sales Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/pet_sal_rpt',$data);
        $this->template->render();					
	}

function oil_service_sms()
	{	
		$data["menu"]='reports';
		$data["submenu"]='oil_service_sms_rpt';
		$this->template->write('titleText', "Oil Service SMS Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/oil_service_sms_rpt',$data);
        $this->template->render();					
	}	
/*function oil_service_dob_sms(){
         $data["menu"]='report';
         $data["submenu"]='oil_service_dob_sms_rpt';
         $this->template->write('titleText', "Oil Service DOB SMS Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/oil_service_dob_sms_rpt',$data);
        $this->template->render();					
}	
*/
function other_sales(){
		$data["menu"]='reports';
		$data["submenu"]='oth_sal_rpt';
		$data["pdt_list"]=$this->Reports_model->get_other_pdts_list();
		$this->template->write('titleText', "Other Products Sales Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/oth_sal_rpt',$data);
        $this->template->render();
	}
function indent_sales(){
		$data["menu"]='reports';
		$data["submenu"]='ind_sal_rpt';
		$data["cust_list"]=$this->Reports_model->get_indent_cust_list();
		$this->template->write('titleText', "Indent Sales Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/ind_sal_rpt',$data);
        $this->template->render();
}
function pet_purchase()
	{	
		$data["menu"]='reports';
		$data["submenu"]='pet_pur_rpt';
		$this->template->write('titleText', "Petrol/Diesel Purchase Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/pet_pur_rpt',$data);
        $this->template->render();					
	}
	
function other_purchase()
	{	
		$data["menu"]='reports';
		$data["submenu"]='oth_pur_rpt';
		$data["supp_list"]=$this->Reports_model->get_suppliers_list();
		$this->template->write('titleText', "Other Products Purchase Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/oth_pur_rpt',$data);
        $this->template->render();					
	}
	
function shift_close()
	{	
		$data["menu"]='reports';
		$data["submenu"]='shft_close_rpt';
		$data["counters"]=$this->Reports_model->get_counters_list();
		$this->template->write('titleText', "Shift Close Sales Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/shift_close_rpt',$data);
        $this->template->render();					
	}
function tank_stock()
	{	
		$data["menu"]='reports';
		$data["submenu"]='tank_stock_rpt';
		$data["tanks"]=$this->Reports_model->get_tank_list();
		$this->template->write('titleText', "Tank Stock Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/tank_stock_rpt',$data);
        $this->template->render();					
	}
	function test_register(){
		$data["menu"]='reports';
		$data["submenu"]='test_reg';
		$data["pump_list"]=$this->Reports_model->get_pump_list();
		$this->template->write('titleText', "Testing Litres Register");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/test_reg',$data);
        $this->template->render();
	}
	
	function get_report(){
			$info = $this->input->post();
			$data["sale_rpt"]=$this->Reports_model->get_report($info["sdate"],$info["edate"],$info["filter"]);	
			if($info["filter"]!='date' and $info["filter"]!='month'){
				$this->load->view('reports/pages/pet_sales_rpt_page',$data);
			}
			else{
				$this->load->view('reports/pages/pet_sales_rpt_page_mw',$data);
			}
	}
	function oil_service_sms_report(){
		$info = $this->input->post();
		$data["oil_service_report"]=$this->Reports_model->oil_service_sms_report($info["sdate"],$info["edate"]);
		$this->load->view('reports/pages/oil_service_sms_rpt_page',$data);
	}
	
	function other_sale_report(){
		$info = $this->input->post();
		$data["other_rpt"]=$this->Reports_model->other_sale_report($info["sdate"],$info["edate"],$info["product"],$info["shift"]);
		$this->load->view('reports/pages/other_sal_rpt_page',$data);
	}
	
	function ind_sal_report(){
		$info = $this->input->post();
		$data["indent_rpt"]=$this->Reports_model->ind_sal_report($info["sdate"],$info["edate"],$info["cust_name"]);
		$data["sdate"]=$info["sdate"];
		$data["edate"]=$info["edate"];
		$data["cust_name"]=$info["cust_name"];
		$this->load->view('reports/pages/ind_sal_rpt_page',$data);
	}
	function pet_pur_report(){
		$info = $this->input->post();
		$data["purchase_rpt"]=$this->Reports_model->get_pur_report($info["sdate"],$info["edate"],$info["product_type"]);
		$data["pdt_type"]=$info["product_type"];
		$this->load->view('reports/pages/pet_pur_rpt_page',$data);
	}

	function other_pur_report(){
		$info=$this->input->post();
		$data["other_purchase"]=$this->Reports_model->other_pur_report($info["sdate"],$info["edate"],$info["supp_name"]);
		$data["details"]=$info["details"];
		$this->load->view('reports/pages/other_pur_rpt_page',$data);
	}
	function tank_stock_rpt(){
		$info=$this->input->post();
		$data["tank_stock"]=$this->Reports_model->tank_stock_report($info["sdate"],$info["edate"],$info["tank_no"]);
		$this->load->view('reports/pages/tank_stock_rpt_page',$data);
	}
	function test_reg_rpt(){
		$info = $this->input->post();
		$data["test_info"]=$this->Reports_model->get_test_report($info["sdate"],$info["edate"],$info["pump_no"]);
		$this->load->view('reports/pages/test_rpt_page',$data);
	}
	
	function shift_close_report(){
		$info = $this->input->post();
		$data["counter"]=$info["counter"];
		$data["shift"]=$info["shift"];
		$data["acct_date"]=$info["acct_date"];
		$this->load->view('reports/pages/shift_close_rpt_page',$data);
	}
	
	function check_shift_closed(){
		$info = $this->input->post();
		$result=$this->Reports_model->check_shift_closed($info['shift'],$info["acct_date"],$info["counter"]);
		foreach ($result as $res){
			if($res["cnt"]>0){
				echo "yes";
			}
			else{
				echo "no";
			}
		}
	}
	function pet_sal_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$filter=$form_data[2];
		$data=$this->Reports_model->get_report($sdate,$edate,$filter);
		if($filter!='date' and $filter!='month'){
		$exporter= new Pet_sal_xl_rpt();
		}
		else{
			$exporter= new Pet_sal_xl_rpt_mw();
		}
        $exporter->Export($data);
	}
	
	
function oth_sal_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$pdt=$form_data[2];
		$shift=$form_data[3];
		$data=$this->Reports_model->other_sale_report($sdate,$edate,$pdt,$shift);
		$exporter= new Oth_sal_xl_rpt();
		$exporter->Export($data);
	}
	
function ind_sal_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$cust_id=$form_data[2];
		$data=$this->Reports_model->ind_sal_report($sdate,$edate,$cust_id);
		$exporter= new Ind_sal_xl_rpt();
		$exporter->Export($data,$params);
	}

function pet_pur_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$pdt=$form_data[2];
		$data=$this->Reports_model->get_pur_report($sdate,$edate,$pdt);
		$exporter= new Pet_pur_xl_rpt();
		$exporter->Export($data,$pdt);
	}
	
	function oth_pur_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$supp=$form_data[2];
		$details=$form_data[3];
		$supp_name=str_replace('%20',' ', $supp);
		$data=$this->Reports_model->other_pur_report($sdate,$edate,$supp_name);
		$exporter= new Oth_pur_xl_rpt();
		$exporter->Export($data,$details);
	}
	
	function tank_stock_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$tank=$form_data[2];
		$data=$this->Reports_model->tank_stock_report($sdate,$edate,$tank);
		$exporter= new Tank_stock_xl_rpt();
		$exporter->Export($data);
	}
	function test_reg_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$pump=$form_data[2];
		$data=$this->Reports_model->get_test_report($sdate,$edate,$pump);
		$exporter= new Test_reg_xl_rpt();
		$exporter->Export($data);
	}
	
	function pet_reg_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$filter=$form_data[2];
		$vehicle_no=$form_data[3];
		$data=$this->Reports_model->get_pet_bills($sdate,$edate,$filter,$vehicle_no);
		$exporter= new Pet_reg_xl_rpt();
		$exporter->Export($data,$filter);
	}
	
	function oth_reg_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$filter=$form_data[2];
		$vehicle_no=$form_data[3];
		$data=$this->Reports_model->get_other_bills($sdate,$edate,$filter,$vehicle_no);
		$exporter= new Oth_reg_xl_rpt();
		$exporter->Export($data,$filter);
	}
	
	
function shift_close_dwnld($params){
		$exporter= new Shift_close_xl_rpt();
		$exporter->Export($params);
	}


function pet_bill_register()
	{	
		$data["menu"]='reports';
		$data["submenu"]='pet_bill_register';
		$data["vehicles_list"]=$this->Reports_model->get_vehicles_list();
		$this->template->write('titleText', "Petrol/Diesel Bill Register");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/pet_bill_register',$data);
        $this->template->render();					
	}
	function get_pet_bill_register()
	{
		$info = $this->input->post();
		$data["pet_bills"]=$this->Reports_model->get_pet_bills($info["sdate"],$info["edate"],$info["filter"],$info["vehicle_no"]);
		$data["filter"]=$info["filter"];
		$this->load->view('reports/pages/pet_bill_register_page',$data);
	}
	function other_bill_register()
	{	
		$data["menu"]='reports';
		$data["submenu"]='other_bill_register';
		$data["vehicles_list"]=$this->Reports_model->get_vehicles_list();
		$this->template->write('titleText', "Other Products Bill Register");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/other_bill_register',$data);
        $this->template->render();					
	}
	function get_other_bill_register()
	{
		$info = $this->input->post();
		$data["other_bills"]=$this->Reports_model->get_other_bills($info["sdate"],$info["edate"],$info["filter"],$info["vehicle_no"]);
		$data["filter"]=$info["filter"];
		$this->load->view('reports/pages/other_bill_register_page',$data);
	}
	
	function expenses(){
		$data["menu"]='reports';
		$data["submenu"]='expenses';
		$data["vendors"]=$this->Reports_model->get_vendors();
		$this->template->write('titleText', "Daily Expenses Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/expenses_rpt',$data);
        $this->template->render();
	}
	
	function get_expenses_report(){
			$info = $this->input->post();
			$data["expenses_rpt"]=$this->Reports_model->get_expenses_report($info["sdate"],$info["edate"],$info["filter"]);	
			$this->load->view('reports/pages/expenses_rpt_page',$data);
			
	}
	
	function expenses_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$filter=$form_data[2];
		$data=$this->Reports_model->get_expenses_report($sdate,$edate,$filter);
		$exporter= new Expenses_rpt();
		$exporter->Export($data);
	}
	
	function transactions(){
		$data["menu"]='reports';
		$data["submenu"]='transactions';
		$data["banks"]=$this->Reports_model->get_banks();
		$this->template->write('titleText', "Bank Transactions Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/transactions_rpt',$data);
        $this->template->render();
	}
	
	function get_transactions_report(){
			$info = $this->input->post();
			$data["transactions_rpt"]=$this->Reports_model->get_transactions_report($info["sdate"],$info["edate"],$info["filter"]);	
			$this->load->view('reports/pages/transactions_rpt_page',$data);
			
	}
	
	function transactions_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$filter=$form_data[2];
		$data=$this->Reports_model->get_transactions_report($sdate,$edate,$filter);
		$exporter= new Transactions_rpt();
		$exporter->Export($data);
	}
	
	function indent_stmt_payment(){
		$data["menu"]='reports';
		$data["submenu"]='indent_stmt_payment';
		$data["cust_list"]=$this->Reports_model->get_indent_cust_list();
		$this->template->write('titleText', "Indent Statments Payment Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/indent_stmt_payment_rpt',$data);
        $this->template->render();
	}
	
	function ind_stmt_payment_report(){
		$info = $this->input->post();
		$data["indent_rpt"]=$this->Reports_model->ind_stmt_payment_report($info["sdate"],$info["edate"],$info["cust_name"],$info["payment_type"]);
		$data["sdate"]=$info["sdate"];
		$data["edate"]=$info["edate"];
		$data["cust_name"]=$info["cust_name"];
		$data["payment_type"]=$info["payment_type"];
		$this->load->view('reports/pages/ind_stmt_payment_rpt_page',$data);
	}
	
	function ind_stmt_paymt_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$cust_name=$form_data[2];
		$payment_type=$form_data[3];
		$data=$this->Reports_model->ind_stmt_payment_report($sdate,$edate,$cust_name,$payment_type);
		$exporter= new Indent_stmt_payment_rpt();
		$exporter->Export($data,$sdate,$edate);
	}
	
	function cash_inflow_rpt(){
		$data["menu"]='reports';
		$data["submenu"]='cash_inflow_rpt';
		$this->template->write('titleText', "Cash Inflow Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/cash_inflow_rpt',$data);
        $this->template->render();
	}
	
	function cash_inflow_report(){
		$info = $this->input->post();
		$data["result"]=$this->Reports_model->get_cash_inflow_report($info["sdate"],$info["edate"]);	
		$this->load->view('reports/pages/cash_inflow_rpt_page',$data);
	}
	
	function rfid_vehicles_report(){
		$data["menu"]='reports';
		$data["submenu"]='rfid_vehicles_report';
		$this->template->write('titleText', "RFID Vehicles Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/rfid_vehicles_report',$data);
        $this->template->render();
	}
	function rfid_vehicles_rpt(){
		
		$date = $this->input->post();
		$sdate=$date["sdate"];
		$edate=$date["edate"];
		$data["result"]=$this->Reports_model->get_rfid_vehicles_report($sdate,$edate);	
		$this->load->view('reports/rfid_vehicles_rpt_page',$data);
	}
	
		function rfid_bill_details($bill_no){
		$data['billdetails']=$this->Reports_model->get_part_bill_details($bill_no);	
		$data['productdetails']=$this->Reports_model->get_product_bill_details($bill_no);
		$this->load->view('reports/showbilldetails',$data);		
		
		}
		
		function rfid_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Reports_model->get_rfid_vehicles_report($sdate,$edate);
		$exporter= new Rfid_rpt();
		$exporter->Export($data);
	}		
		function cash_inflow_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Reports_model->get_cash_inflow_report($sdate,$edate);	
		$exporter= new Cash_inflow_rpt();
		$exporter->Export($data);
	}	
		function indent_stmt_report(){
		$data["menu"]='reports';
		$data["submenu"]='indent_stmt_report';
		$data["cust_list"]=$this->Reports_model->get_indent_cust_list();
		$this->template->write('titleText', "Indent Statments Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/indent_stmt_rpt',$data);
        $this->template->render();
		}
		function indent_stmt_rpt_det(){
			$date = $this->input->post();
			$sdate=$date["sdate"];
			$edate=$date["edate"];
			$cust_name=$date["cust_name"];
			$data['indent_stmt']=$this->Reports_model->indent_stmt_details($sdate,$edate,$cust_name);
			
			$this->load->view('reports/pages/indent_stmt_rpt_page',$data);
		}
		
		function indent_stmt_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$cust_name=$form_data[2];
		$data=$this->Reports_model->indent_stmt_details($sdate,$edate,$cust_name);
		$exporter= new Indent_stmt_report();
		$exporter->Export($data,$params);
		}
	function cheque_sal_report()
	{	
		$data["menu"]='reports';
		$data["submenu"]='cheque_sal_report';
		$this->template->write('titleText', "Cheque Sales Report");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'reports/cheque_sal_report',$data);
        $this->template->render();					
	}
	function cheque_sal_rpt_page(){
		$info = $this->input->post();
		$data["cheque_rpt"]=$this->Reports_model->cheque_sal_report($info["sdate"],$info["edate"]);
		$data["sdate"]=$info["sdate"];
		$data["edate"]=$info["edate"];
		$this->load->view('reports/pages/cheque_sal_rpt_page',$data);
	}
	function cheque_sal_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Reports_model->cheque_sal_report($sdate,$edate);	
		$exporter= new Cheque_sal_xl_rpt();
		$exporter->Export($data);
	}	
}
