
<?php
class Export_data extends CI_Controller
{   function __construct(){
	parent::__construct();
	$this->load->model('Export_data_model');
	$this->load->model('Sales_model');
	$this->load->helper('rstoword');
	$this->load->library('Indent_statement_xl_rpt');
	$this->load->library('Bank_transaction_rpt_xl_rpt');
	$this->load->library('Cheque_sales1_rpt_xl_rpt');
	$this->load->library('Cheque_sales1_nt_rpt_xl_rpt');
	$this->load->library('Indent_statement_payment_xl_rpt');
	$this->load->library('Icici_bank_transaction_rpt_xl_rpt');
	$this->load->library('Hdfc_bank_transc_rpt_xl_rpt');
	$this->load->library('Cash_sales1_rpt_xl_rpt');
	$this->load->library('SimpleLoginSecure');
	if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
}

        function index(){
			$data["menu"]='export_data';
			$data["submenu"]='indent_statement';
			$this->template->write('titleText', "Indent Statement Report");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'export_data/indent_statement',$data);
	        $this->template->render();
		}
		
		function indent_statement_page(){
			$info = $this->input->post();
			$sdate=$info["sdate"];
			$edate=$info["edate"];
			$data['indent_stmt']=$this->Export_data_model->indent_stmt_details($sdate,$edate);
			$data['indent_stmt1']=$this->Export_data_model->indent_stmt_details1();
			$this->load->view('export_data/pages/indent_statement_page',$data);
		}
	    function indent_statement_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Export_data_model->indent_stmt_details($sdate,$edate);	
		$data1=$this->Export_data_model->indent_stmt_details1();	
		$exporter= new Indent_statement_xl_rpt();
		$exporter->Export($data,$data1);
		}	
		
		function bank_transc_rpt(){
			$data["menu"]='export_data';
			$data["submenu"]='bank_transc_rpt';
			$this->template->write('titleText', "Bank Transaction Report");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'export_data/bank_trans_rpt',$data);
	        $this->template->render();
		}
		
		function bank_transc_rpt_page(){
			$info = $this->input->post();
			$sdate=$info["sdate"];
			$edate=$info["edate"];
			$data["transactions_rpt"]=$this->Export_data_model->get_transactions_report($sdate,$edate);
			$data['indent_stmt1']=$this->Export_data_model->indent_stmt_details1();
			$this->load->view('export_data/pages/bank_transc_rpt_page',$data);
		}
		
		function bank_transaction_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Export_data_model->get_transactions_report($sdate,$edate);	
		$data1=$this->Export_data_model->indent_stmt_details1();	
		$exporter= new Bank_transaction_rpt_xl_rpt();
		$exporter->Export($data,$data1);
		}	
		
		function cheque_sale_rpt(){
			$data["menu"]='export_data';
			$data["submenu"]='cheque_sale_rpt';
			$this->template->write('titleText', "Cheque Sales Report");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'export_data/cheque_sale_rpt',$data);
	        $this->template->render();
		}
		
		function cheque_sale_rpt_page(){
			$info = $this->input->post();
			$sdate=$info["sdate"];
			$edate=$info["edate"];
			$data["cheque_rpt"]=$this->Export_data_model->cheque_sal_report($sdate,$edate);
			$data['sale_code']=$this->Export_data_model->cheque_sale_code();
			$data['indent_stmt1']=$this->Export_data_model->indent_stmt_details1();
			$this->load->view('export_data/pages/cheque_sale_rpt_page',$data);
		}
		
		function cheque_sale_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Export_data_model->cheque_sal_report($sdate,$edate);
		$data2=$this->Export_data_model->cheque_sale_code();	
		$data1=$this->Export_data_model->indent_stmt_details1();	
		$exporter= new Cheque_sales1_rpt_xl_rpt();
		$exporter->Export($data1,$data,$data2);
		}

		function cheque_sale_nt_rpt(){
			$data["menu"]='export_data';
			$data["submenu"]='cheque_sale_nt_rpt';
			$this->template->write('titleText', "Cheque Sales Report(CHQ Not CR in Bank)");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'export_data/cheque_sale_nt_rpt',$data);
	        $this->template->render();
		}
		
		function cheque_sale_nt_rpt_page(){
			$info = $this->input->post();
			$sdate=$info["sdate"];
			$edate=$info["edate"];
			$data["chq_not_cleared_rpt"]=$this->Export_data_model->cheque_sal_not_cleared_report($sdate,$edate);
			$data['indent_stmt1']=$this->Export_data_model->indent_stmt_details1();
			$this->load->view('export_data/pages/cheque_sale_nt_rpt_page',$data);
		}
		
		function cheque_sale_nt_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Export_data_model->cheque_sal_not_cleared_report($sdate,$edate);	
		$data1=$this->Export_data_model->indent_stmt_details1();	
		$exporter= new Cheque_sales1_nt_rpt_xl_rpt();
		$exporter->Export($data,$data1);
		}

		function indent_statement_payment(){
			$data["menu"]='export_data';
			$data["submenu"]='indent_statement_payment';
			$this->template->write('titleText', "Indent Statement Payment Report");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'export_data/indent_statement_payment',$data);
	        $this->template->render();
		}
		
		function indent_statement_payment_page(){
			$info = $this->input->post();
			$sdate=$info["sdate"];
			$edate=$info["edate"];
	        $data["payment_rpt"]=$this->Export_data_model->indent_stmt_payment($sdate,$edate);
			$data['indent_stmt1']=$this->Export_data_model->indent_stmt_details1();
			$data['sale_code']=$this->Export_data_model->cheque_sale_code();
			$this->load->view('export_data/pages/indent_statement_payment_page',$data);
		}
	    function indent_statement_payment_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Export_data_model->indent_stmt_payment($sdate,$edate);
		$data1=$this->Export_data_model->indent_stmt_details1();
		$data2=$this->Export_data_model->cheque_sale_code();		
		$exporter= new Indent_statement_payment_xl_rpt();
		$exporter->Export($data,$data1,$data2);
		}	
		
		function icici_bank_transc_rpt(){
			$data["menu"]='export_data';
			$data["submenu"]='icici_bank_transc_rpt';
			$this->template->write('titleText', "ICICI Credit Card Bank Transaction Report");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'export_data/icici_bank_transc_rpt',$data);
	        $this->template->render();
		}
		
		function icici_bank_transc_rpt_page(){
			$info = $this->input->post();
			$sdate=$info["sdate"];
			$edate=$info["edate"];
			$data["credit_rpt"]=$this->Export_data_model->get_credit_report($sdate,$edate);
			$data['indent_stmt1']=$this->Export_data_model->indent_stmt_details1();
			$data['sale_code']=$this->Export_data_model->cheque_sale_code();
			$this->load->view('export_data/pages/icici_bank_transc_rpt_page',$data);
		}
		
		function icici_bank_transaction_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Export_data_model->get_credit_report($sdate,$edate);
		$data1=$this->Export_data_model->indent_stmt_details1();
		$data2=$this->Export_data_model->cheque_sale_code();
		$data1=$this->Export_data_model->indent_stmt_details1();	
		$exporter= new Icici_bank_transaction_rpt_xl_rpt();
		$exporter->Export($data,$data1,$data2);
		}	
		
		function hdfc_bank_transc_rpt(){
			$data["menu"]='export_data';
			$data["submenu"]='hdfc_bank_transc_rpt';
			$this->template->write('titleText', "HDFC Credit Card Bank Transaction Report");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'export_data/hdfc_bank_transc_rpt',$data);
	        $this->template->render();
		}
		
		function hdfc_bank_transc_rpt_page(){
			$info = $this->input->post();
			$sdate=$info["sdate"];
			$edate=$info["edate"];
			$data["hdfc_credit_rpt"]=$this->Export_data_model->get_hdfc_credit_report($sdate,$edate);
			$data['sale_code']=$this->Export_data_model->hdfc_cheque_sale_code();
			$data['indent_stmt1']=$this->Export_data_model->indent_stmt_details1();
			$this->load->view('export_data/pages/hdfc_bank_transc_rpt_page',$data);
		}
		
		function hdfc_bank_transc_rpt_dwnld($params){
			$form_data=explode("::", $params);
			$sdate=$form_data[0];
			$edate=$form_data[1];
			$data=$this->Export_data_model->get_hdfc_credit_report($sdate,$edate);
			$data2=$this->Export_data_model->hdfc_cheque_sale_code();
			$data1=$this->Export_data_model->indent_stmt_details1();		
			$exporter= new Hdfc_bank_transc_rpt_xl_rpt();
			$exporter->Export($data,$data1,$data2);
		}

		function export_data_master_dtls()	{
			$data["menu"]='export_data';
			$data["submenu"]='export_data_master_dtls';
			$data['export_data']=$this->Export_data_model->export_data();
			$this->template->write('titleText', "Export Data Master");
			$this->template->write_view('sideLinks','general/menu',$data);
			$this->template->write_view('bodyContent','export_data/exportdatamaster',$data);	
			$this->template->render();	
			
		}
		
		function fetch_export_info()
		{
			$data['exportinfo']=$this->Export_data_model->fetch_export_info();
			$this->load->view("export_data/exportdataform",$data);
			
		}
		
		function export_data_master_update(){
	
		$collect = $this->input->post();
		$this->Export_data_model->update_export_data_info($collect["section_code"],$collect["business_area"],$collect["sap_sale_code"],$collect["cost_center"],$collect["profit_center"],$collect["indent_stmt_rpt_ref"],$collect["bank_trans_rpt_ref"],$collect["cheque_sales_rpt_ref"],$collect["indent_pmt_rpt_ref"],$collect["credit_sales_rpt_ref"],$collect["hdfc_credit_sales_ref"],$collect["cash_sales_rpt_ref"]);	
		echo "Pump Information Update Successfully";
	}	
	
function cash_sale_rpt(){
			$data["menu"]='export_data';
			$data["submenu"]='cash_sale_rpt';
			$this->template->write('titleText', "Cash Sales Report");
			$this->template->write_view('sideLinks', 'general/menu',$data);
	        $this->template->write_view('bodyContent', 'export_data/cash_sale_rpt',$data);
	        $this->template->render();
		}
		
		function cash_sale_rpt_page(){
			$info = $this->input->post();
			$sdate=$info["sdate"];
			$edate=$info["edate"];
			$data["cash_rpt"]=$this->Export_data_model->cash_sal_report($sdate,$edate);
			$data['sale_code']=$this->Export_data_model->cheque_sale_code();
			$data['indent_stmt1']=$this->Export_data_model->indent_stmt_details1();
			$this->load->view('export_data/pages/cash_sale_rpt_page',$data);
		}
		
		function cash_sale_dwnld($params){
		$form_data=explode("::", $params);
		$sdate=$form_data[0];
		$edate=$form_data[1];
		$data=$this->Export_data_model->cash_sal_report($sdate,$edate);
		$data2=$this->Export_data_model->cheque_sale_code();	
		$data1=$this->Export_data_model->indent_stmt_details1();	
		$exporter= new Cash_sales1_rpt_xl_rpt();
		$exporter->Export($data,$data1,$data2);
		}
		
}
