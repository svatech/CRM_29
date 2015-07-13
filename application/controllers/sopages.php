<?php
class SOpages extends CI_Controller
	{  
		 function __construct(){
		parent::__construct();
		$this->load->model('Sopages_model');
		$this->load->library('SimpleLoginSecure');
		$this->load->library('session');
		$this->load->library('Ro_sales_xl_rpt');
		$this->load->library('Ro_Stockloss_xl_rpt');
		$this->load->library('Ro_inventory_xl_rpt');
		if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
}

	function ro_sales(){
		$data["menu"]='sopages';
		$data["submenu"]='ro_sales';
		$this->template->write('titleText', "RO Sales");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sopages/ro_sales',$data);
        $this->template->render();
	}
	
	function ro_inventory(){
		$data["menu"]='sopages';
		$data["submenu"]='ro_inventory';
		$this->template->write('titleText', "RO Inventory");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sopages/ro_inventory',$data);
        $this->template->render();
	}
	function full_stock_list()
		{
			$date = $this->input->post();
			$start=$date["start"];
			$end=$date["end"];
			$data['summa']=$date["start"];
			$data['fuels']=$this->Sopages_model->fetch_fuel_stock($start,$end);
			$data['oil']=$this->Sopages_model->fetch_oil_stock($start,$end);
			$data['grease']=$this->Sopages_model->fetch_grease_stock($start,$end);
			$data['others']=$this->Sopages_model->fetch_others_stock($start,$end);
			$data['twotoil']=$this->Sopages_model->fetch_2toil_stock($start,$end);
			
			$this->load->view('sopages/pages/ro_inventory_page',$data);
			
		}
	function ro_inventory_dwnld($params){
		$form_data=explode("::", $params);
		$start=$form_data[0];
		$end=$form_data[1];
		
		$fuels=$this->Sopages_model->fetch_fuel_stock($start,$end);
		$oil=$this->Sopages_model->fetch_oil_stock($start,$end);
		$grease=$this->Sopages_model->fetch_grease_stock($start,$end);
		$others=$this->Sopages_model->fetch_others_stock($start,$end);
		$twotoil=$this->Sopages_model->fetch_2toil_stock($start,$end);
		$exporter= new Ro_inventory_xl_rpt();
		$exporter->Export($params,$fuels,$oil,$grease,$others,$twotoil);
	}
	function ro_stockloss(){
		$data["menu"]='sopages';
		$data["submenu"]='ro_stockloss';
		$data['tanks']=$this->Sopages_model->get_tank_list();
		$this->template->write('titleText', "RO Stock Loss");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sopages/ro_stockloss',$data);
        $this->template->render();
	}
	
	function ro_sales_rpt(){
		$form_data = $this->input->post();
		$data['stmt_date']=$form_data['sdate'];
		$data["pump_sales"]=$this->Sopages_model->productwise_total($form_data["sdate"]);
		$data["other_sales"]=$this->Sopages_model->otherpdts_total($form_data["sdate"]);
		$this->load->view('sopages/pages/ro_sales_page',$data);
	}
	
	function ro_inventory_rpt(){
		$form_data = $this->input->post();
		$data['stmt_date']=$form_data['sdate'];
		$data["pump_sales"]=$this->Sopages_model->productwise_total($form_data["sdate"]);
		$data["other_sales"]=$this->Sopages_model->otherpdts_total($form_data["sdate"]);
		$this->load->view('sopages/pages/ro_inventory_page',$data);
	}
	
	function ro_stockloss_rpt(){
		$form_data = $this->input->post();
		$data["tank"]=$form_data["tank"];
		$data["month"]=$form_data["month"];
		$data["year"]=$form_data["year"];
		$data["ebook"]=$this->Sopages_model->get_stockloss($form_data["tank"],$form_data["month"],$form_data["year"]);
		$this->load->view('sopages/pages/ro_stockloss_page',$data);
	}
	
	
	function ro_sales_dwnld($sdate){
		$pump_sales=$this->Sopages_model->productwise_total($sdate);
		$other_sales=$this->Sopages_model->otherpdts_total($sdate);
		$exporter= new Ro_sales_xl_rpt();
		$exporter->Export($sdate,$pump_sales,$other_sales);
	}
	
	function stockloss_dwnld($params){
		$form_data=explode("::", $params);
		$tank=$form_data[0];
		$month=$form_data[1];
		$year=$form_data[2];
		$data=$this->Sopages_model->get_stockloss($tank,$month,$year);
		$exporter= new Ro_Stockloss_xl_rpt();
		$exporter->Export($data,$params);
	}
	
	function ro_sales_chart(){
		$data["menu"]='sopages';
		$data["submenu"]='ro_sales_chart';
		$this->template->write('titleText', "RO Sales Chart");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sopages/ro_sales_chart',$data);
        $this->template->render();
	}
	
	function get_sales_chart(){
			$info = $this->input->post();
			$data["sale_rpt"]=$this->Sopages_model->get_sales_chart($info["sdate"],$info["edate"],$info["filter"]);	
			if($info["filter"]!='date' and $info["filter"]!='month'){
				$this->load->view('sopages/pages/sales_chart_page',$data);
			}
			/*else{
				$this->load->view('sopages/pages/pet_sales_rpt_page_mw',$data);
			}*/
	}
	function ro_cumulative_sales(){
		$data["menu"]='sopages';
		$data["submenu"]='ro_cumulative_sales';
		$this->template->write('titleText', "Cumulative Sales Chart");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sopages/ro_sales_chart',$data);
        $this->template->render();
	}
		
	function fetch_chart_details()
	{
		$info = $this->input->post();
		$TOT="true";
		 $data["result"]=$this->Sopages_model->fetch_chart_details($TOT,$info["sdate"],$info["edate"]);
		$TOT="false";
		$data["employee"]=$this->Sopages_model->fetch_chart_details($TOT,$info["sdate"],$info["edate"]);
		$this->load->view('sopages/pages/Chart',$data);
	}
	function ro_fuel_sales(){
		$data["menu"]='sopages';
		$data["submenu"]='ro_fuel_sales';
		$this->template->write('titleText', "Fuel Sales Chart");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sopages/ro_fuel_sales',$data);
        $this->template->render();
	}
	function fetch_fuelsales_details()
	{
		$info = $this->input->post();
		$PT="true";$product='PETROL';
		$data["dates"]=$this->Sopages_model->fetch_fuel_details($PT,$product,$info["sdate"],$info["edate"]);
		$PT="false";
		$data["sales"]=$this->Sopages_model->fetch_fuel_details($PT,$product,$info["sdate"],$info["edate"]);
		$product='DIESEL';
		$data["DT_sales"]=$this->Sopages_model->fetch_fuel_details($PT,$product,$info["sdate"],$info["edate"]);
		//$product='2TOIL_LOOSE';
		$data["TT_sales"]=$this->Sopages_model->fetch_oil_details($info["sdate"],$info["edate"]);
		$this->load->view('sopages/pages/fuel_sale_chart',$data);
	}
	
}