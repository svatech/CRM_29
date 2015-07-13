<?php

	Class Master extends CI_Controller
	{
		function __construct(){
		parent::__construct();
		$this->load->library('SimpleLoginSecure');
		$this->load->model('master_model');
		$this->load->library('Prod_master_xl_rpt');
		$this->load->library('Tank_master_xl_rpt');
		$this->load->library('Pump_master_xl_rpt');
		$this->load->library('Customer_master_xl_rpt');
		$this->load->library('Retail_customer_master_xl_rpt');
		$this->load->library('Supplier_master_xl_rpt');
		$this->load->library('Rfid_vehicles_xl_rpt');
		
		if(!$this->session->userdata('admin_logged_in'))
		{
		redirect('logincheck');
		}
		}
		
	function index()
	{
		$data['prod']=$this->master_model->get_tankproduct_list();
		$data['tank']=$this->master_model->get_tank_list();
		$data["menu"]='master';
		$data["submenu"]='pump_master_dtls';
		$this->template->write('titleText', "Pump Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/pumpmaster',$data);	
		$this->template->render();
	}
	
	function pump_details()
	{
		$tank_no=$_POST['tank_no'];
		$pump_no=$_POST['pump_no'];
		$status=$_POST['status'];
		$count_no=$_POST['count_no'];
		$prod_name=$_POST['prod_name'];
		$inserted=$this->master_model->insert_pumpdtls($pump_no,$prod_name,$tank_no,$status,$count_no);
		if($inserted){
			redirect('master/index');
		}else 
		{
			echo "server Error";
		}
	}
	
	function check_pump($pump_no)
	{
		$pump_no=str_replace('%20',' ', $pump_no);
		echo $this->master_model->check_pump($pump_no);
	}
	
	function tank_master()
	{
		$data['prod']=$this->master_model->get_tankproduct_list();
		$data["menu"]='master';
		$data["submenu"]='tank_master_dtls';
		$this->template->write('titleText', "Tank Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/tankmaster',$data);	
		$this->template->render();	
	}
	
	function tank_details()
	{
		$tank_no=$_POST['tank_no'];
		$capacity=$_POST['capacity'];
		$status=$_POST['status'];
		$prod_name=$_POST['prod_name'];
		$inserted=$this->master_model->insert_tankdtls($tank_no,$prod_name,$capacity,$status);
		if($inserted){
			redirect('master/tank_master');
		}else 
		{
			echo "server Error";
		}
		
	}
	
	function check_tank($tank_no)
	{
		$tank_no=str_replace('%20',' ', $tank_no);
		echo $this->master_model->check_tank($tank_no);
	}
	
	function check_vehicle_no(){
		$collect = $this->input->post();
		echo $this->master_model->check_vehicle_no($collect["veh_no"]);
	}
	
	function check_vehicle_no_upd(){
		$collect = $this->input->post();
		echo $this->master_model->check_vehicle_no_upd($collect["veh_no"],$collect["custid"]);
	}
	
	function product_master()
	{
		$data['category']=$this->master_model->get_category_list();
		$data["menu"]='master';
		$data["submenu"]='product_master_dtls';
		$this->template->write('titleText', "Product Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/productmaster',$data);	
		$this->template->render();	
		
	}
	function product_details()
	{
		$prod_rate=$_POST['prod_rate'];
		$category=$_POST['category'];
		$status=$_POST['status'];
		$prod_name=$_POST['prod_name'];
		$prod_type=$_POST['tank_product'];
		if($category == 'FUEL'){
			$this->master_model->insert_productdtls($prod_name,$prod_rate,$category,$status,$prod_type);
		}ELSE{
			$stock=$_POST['stock'];
			$this->master_model->insert_other_productdtls($prod_name,$prod_rate,$category,$status,$prod_type,$stock);
		}
		redirect('master/product_master');
		
		
	}
	function check_product($prod_name)
	{
		$prod_name=str_replace('%20',' ', $prod_name);
		echo $this->master_model->check_product($prod_name);
	}
	function tank_master_dtls()
	{
		$data["menu"]='master';
		$data["submenu"]='tank_master_dtls';
		$data['product']=$this->master_model->get_tankproduct_list();
		$data['tankmaster']=$this->master_model->get_tankmaster();
		$this->template->write('titleText', "Tank Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/tankmasterdetails',$data);	
		$this->template->render();
		}
	function fetch_tank_info($tank_id)
	{
		$data['prod']=$this->master_model->get_tankproduct_list();
		$data['tank_info'] = $this->master_model->get_tank_info($tank_id);
		$this->load->view("master/tank_info_form",$data);
	}
	function tank_info_update(){
	
		$collect = $this->input->post();
		$this->master_model->update_tank_info($collect["tank_no"],$collect["capacity"],$collect["status"],$collect["prod_name"]);	
		echo "Tank Information Update Successfully";
	}	
	function pump_master_dtls()
	{
		$data["menu"]='master';
		$data["submenu"]='pump_master_dtls';
		$data['product']=$this->master_model->get_tankproduct_list();
		$data['tank']=$this->master_model->get_tank_list();
		$data['pumpmaster']=$this->master_model->get_pumpmaster();
		$this->template->write('titleText', "Pump Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/pumpmasterdetails',$data);	
		$this->template->render();
	}
	function fetch_pump_info($pump_no)
	{
		$data['prod']=$this->master_model->get_tankproduct_list();
		$data['pump_info'] = $this->master_model->get_pump_info($pump_no);
		$data['tank']=$this->master_model->get_activetank_list();
		$this->load->view("master/pump_info_form",$data);
		
	}
	function pump_info_update(){
	
		$collect = $this->input->post();
		$this->master_model->update_pump_info($collect["pump_no"],$collect["tank_no"],$collect["counter"],$collect["status"],$collect["prod_name"]);	
		echo "Pump Information Update Successfully";
	}	
	function product_master_dtls()
	{
		$data["menu"]='master';
		$data["submenu"]='product_master_dtls';
		$data['category']=$this->master_model->get_category_list();
		$data['productmaster']=$this->master_model->get_productmaster();
		$this->template->write('titleText', "Product Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/productmasterdetails',$data);	
		$this->template->render();
		}
	function fetch_product_info($prod_name)
	{
		$prod_name=str_replace('%20',' ', $prod_name);
		$data['product_info'] = $this->master_model->get_product_info($prod_name);
		$data['category']=$this->master_model->get_category_list();;
		$this->load->view("master/product_info_form",$data);
		
	}
	function product_info_update(){
	
		$collect = $this->input->post();
		$this->master_model->update_product_info($collect["prod_name"],$collect["prod_rate"],$collect["category"],$collect["status"],$collect["tank_product"],$collect["stock"],$collect["comm_rate"]);	
		echo "Product Information Updated Successfully";
	}	
	function customer_master()
	{
		$data["menu"]='master';
		$data["submenu"]='customer_master_dtls';
		$data['customerid']=$this->master_model->fetch_custid();
		$this->template->write('titleText', "Customer Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/customermaster',$data);	
		$this->template->render();
	}
	function customer_details()
	{
		
		$current_custid=$_POST['current_custid'];
		$next_custid=$_POST['next_custid'];
		$cust_name=$_POST['cust_name'];
		$addr=$_POST['addr'];
		$ph_num=$_POST['ph_num'];
		$tin=$_POST['tin'];
		
	    $ind_dob=$_POST['indent_dob'];
		$vehicle=$_POST['vehicle'];
		$indent_no_start=$_POST['indent_no_start'];
		$indent_no_end=$_POST['indent_no_end'];
		$initial_deposit=$_POST['initial_deposit'];
		$indent_limit=$_POST['indent_limit'];
		$open_bal=$_POST['open_bal'];
		$status=$_POST['status'];
        //echo $ind_dob;
		//$ind_dob=date("Y-m-d",strtotime($_POST['indent_dob']));
		//$form_data = $this->input->post();
		 $this->master_model->insert_customerdtls($cust_name,$addr,$ph_num,$tin,$vehicle,$indent_no_start,$indent_no_end,$current_custid,$next_custid,$initial_deposit,$indent_limit,$open_bal,$status,$ind_dob);
		redirect('master/customer_master');
	}
	function supplier_details()
	{	$supplier_id=$this->master_model->fetch_suppid();
	    foreach($supplier_id as $item){
			$supp= $item->supp_id ;
			$arr=str_split($supp,4);  
	 		$sec=$arr[1]+1 ;
			if($sec <10 )
			{
			$sec="000".$sec;
			}else if($sec <100 )	
			{
			$sec="00".$sec;
			}else if($sec <1000 )
			{	
			$sec="0".$sec;
			}
	 		 $supp_id=$arr[0].$sec;
	    }
		$supp_name=$_POST['supp_name'];
		$addr=$_POST['addr'];
		$ph_num=$_POST['ph_num'];
		$tin=$_POST['tin'];
		$supp_pdts=$_POST['supp_pdts'];
		$this->master_model->insert_supplierdtls($supp_name,$addr,$ph_num,$tin,$supp_pdts,$supp,$supp_id);
		redirect('master/supplier_master');
	}
	
	function check_customer()
	{
		$collect = $this->input->post();
		$cust_name=$collect['custname'];
		//$cust_name=str_replace('%20',' ', $cust_name);
		echo $this->master_model->check_customer($cust_name);
	}
	function check_supplier($supp_name)
	{
		$supp_name=str_replace('%20',' ',$supp_name);
		echo $this->master_model->check_supplier($supp_name);
	}
	function customer_master_dtls()
	{
		$data["menu"]='master';
		$data["submenu"]='customer_master_dtls';
		$data['customermaster']=$this->master_model->get_customermaster();
		$this->template->write('titleText', "Customer Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/customermasterdetails',$data);	
		$this->template->render();
		}
		
	function supplier_master()
	{
		$data["menu"]='master';
		$data["submenu"]='supplier_master_dtls';
		//$data['customerid']=$this->master_model->fetch_custid();
		$this->template->write('titleText', "Supplier Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/suppliermaster',$data);	
		$this->template->render();	
			}
	function supplier_master_dtls()
	{
		$data["menu"]='master';
		$data["submenu"]='supplier_master_dtls';
		$data['suppliermaster']=$this->master_model->get_suppliermaster();
		$this->template->write('titleText', "Supplier Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/suppliermasterdetails',$data);	
		$this->template->render();	
	}
			
	function fetch_customer_info($customer_id)
	{
		$data['customer_info'] = $this->master_model->get_customer_info($customer_id);
		$this->load->view("master/customer_info_form",$data);
		
	}
	function fetch_supplier_info($supplier_id)
	{
		$data['supplier_info'] = $this->master_model->get_supplier_info($supplier_id);
		$this->load->view("master/supplier_info_form",$data);
		
	}
	function customer_info_update(){
	
		$collect = $this->input->post();
		$this->master_model->update_customer_info($collect["cust_name"],$collect["cust_id"],$collect["addr"],$collect["phone_number"],$collect["tin"],$collect["indent_dob"],$collect["vehicle_number"],$collect["indent_start_no"],$collect["indent_end_no"],$collect['initial_deposit'],$collect['indent_limit'],$collect['open_bal'],$collect['status']);	
		echo "Customer Information Updated Successfully";
	}	
	function supplier_info_update(){
	
		$collect = $this->input->post();
		$this->master_model->update_supplier_info($collect["supp_name"],$collect["supp_id"],$collect["addr"],$collect["phone_number"],$collect["tin"],$collect["products"]);	
		echo "Supplier Information Updated Successfully";
	}	
	function get_tankproduct_list($tank_no)
	{
		echo $this->master_model->get_tankproduct_pump($tank_no);
	}
	function prod_master_dwnld(){
		
		$data=$this->master_model->get_productmaster();
		$exporter= new Prod_master_xl_rpt();
		$exporter->Export($data);
	}
	function tank_master_dwnld(){
		
		$data=$this->master_model->get_tankmaster();
		$exporter= new Tank_master_xl_rpt();
		$exporter->Export($data);
	}
	function pump_master_dwnld(){
		
		$data=$this->master_model->get_pumpmaster();
		$exporter= new Pump_master_xl_rpt();
		$exporter->Export($data);
	}
	function cust_master_dwnld(){
		
		$data=$this->master_model->get_customermaster();
		$exporter= new Customer_master_xl_rpt();
		$exporter->Export($data);
	}
	function supp_master_dwnld(){
		
		$data=$this->master_model->get_suppliermaster();
		$exporter= new Supplier_master_xl_rpt();
		$exporter->Export($data);
	}
	
	function sms_control_dtls(){
		$data["menu"]='master';
		$data["submenu"]='sms_control_dtls';
		$data['sms_status']=$this->master_model->get_sms_status();
		$this->template->write('titleText', "SMS Control");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/smscontrol',$data);	
		$this->template->render();
	}
	
	function change_sms_bill_opt(){
		$form_data = $this->input->post();
		$this->master_model->change_sms_bill_opt($form_data["status"]);
	}
	
	
	function rfid_vehicles_master_dtls(){
		$data["menu"]='master';
		$data["submenu"]='rfid_vehicles_master_dtls';
		$data['vehicles']=$this->master_model->get_rfid_vehicles();
		$this->template->write('titleText', "RFID Enabled Vehicles");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/rfidvehiclesmasterdetails',$data);	
		$this->template->render();
	}
	
	function remove_rfid_details(){
		$form_data = $this->input->post();
		$this->master_model->remove_rfid_details($form_data["veh_no"],$form_data["reason"]);
	}
	
	function rfid_vehicles_dwnld(){
		$data=$this->master_model->get_rfid_vehicles();
		$exporter= new Rfid_vehicles_xl_rpt();
		$exporter->Export($data);
	}
	
	function retail_customer_dtls()
	{
		$data["menu"]='master';
		$data["submenu"]='retail_customer_dtls';
		$data['retailcustomers']=$this->master_model->get_retailcustomermaster();
		$this->template->write('titleText', "Retail Customer Master");
		$this->template->write_view('sideLinks','general/menu',$data);
		$this->template->write_view('bodyContent','master/retailcustomerdetails',$data);	
		$this->template->render();
		}
		
	function fetch_retail_customer_info($cust_id){
		$data['customer_info'] = $this->master_model->get_retail_customer_info($cust_id);
		$this->load->view("master/retail_customer_info_form",$data);
	}
	
	function retail_customer_info_update(){
	
		$collect = $this->input->post();
		$this->master_model->update_retail_customer_info($collect["cust_name"],$collect["cust_id"],$collect["mobile_number"],$collect["vehicle_number"],$collect["reference_no"],$collect['status']);	
		echo "Customer Information Updated Successfully";
	}

	function retail_cust_dwnld(){
		
		$data=$this->master_model->get_retailcustomermaster();
		$exporter= new Retail_customer_master_xl_rpt();
		$exporter->Export($data);
	}
	
	
	}
?>