<?php
	class Sales extends CI_Controller
	{   function __construct(){
		parent::__construct();
		$this->load->model('Sales_model');
		$this->load->library('SimpleLoginSecure');
		$this->load->helper('wordtonumber');	
		$this->load->library('session');
		if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
	
}
	
	function index()
	{	
		$data["bill_no"]=$this->Sales_model->get_cashsales_billno();
		$data["pdt_list"]=$this->Sales_model->get_pdts_list();
		/*if(defined($this->session->userdata['counter'])){
			$ctr_no=$this->session->userdata['counter'];
		}else{
			$ctr_no='One';
		}
		$data["twotpumps"]=$this->Sales_model->get_2tpumps_list($ctr_no);
		*/
		$data["pump_list"]=$this->Sales_model->get_pump_list();
		$data["counters"]=$this->Sales_model->get_counters_list();
		$data["indent_cust"]=$this->Sales_model->get_indent_customers();
		$data["retail_trucks"]=$this->Sales_model->get_retail_trucks();
		$data["rfid_vehicles"]=$this->Sales_model->get_rfid_entry();
		$data["billsms_status"]=$this->Sales_model->get_billsms_status();
		$data["menu"]='sales';
		$data["submenu"]='sales';
		$this->template->write('titleText', "Petrol/Diesel Bill Entry");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/cash_sales',$data);
        $this->template->render();					
	}
	function check_cust_type(){
		$form_data = $this->input->post();
		echo $this->Sales_model->check_cust_type($form_data["veh"]);
		
	}
	function add_shift_session(){
		$form_data = $this->input->post();
		session_start();
		if (isset($form_data["shift"])) {$this->session->set_userdata('shift',$form_data["shift"] );}
			
	}
	
	function check_shift_closed(){
		$form_data = $this->input->post();
		$result=$this->Sales_model->check_shift_closed($form_data['shft'],$form_data["acct_date"],$form_data["counter"]);
		foreach ($result as $res){
			if($res["cnt"]>0){
				echo "yes";
			}
			else{
				echo "no";
			}
		}
	}
	function check_shift_open(){
		$form_data=$this->input->post();
		$result=$this->Sales_model->check_shift_open($form_data['shft'],$form_data["act_date"],$form_data["ctr"]);
		foreach ($result as $res){
			if($res["action"]=='open'){
				echo "yes";
			}
			else{
				echo "no";
			}
		}
	}
	
	function checkIndentCust(){
		$form_data=$this->input->post();
		$result=$this->Sales_model->checkIndentCust($form_data['cust_name']);
		foreach($result as $res){
			if($res["cnt"]>0){
				echo "yes";
			}
			else{
				echo "no";
			}
		}
	}
	function get_bill_cash_sales(){
		$form_data=$this->input->post();
	    $this->Sales_model->get_bill_cash_sales($form_data['act_date'],$form_data['shft'],$form_data['pmp_no'],$form_data['cnt_no']);
	}
	
	function get_pdt_of_pump(){
		$form_data=$this->input->post();
		echo $this->Sales_model->get_pdt_of_pump($form_data['pump_no']);
	}
	function add_counter_session(){
		$form_data = $this->input->post();
		session_start();
		if (isset($form_data["counter"])) {$this->session->set_userdata('counter',$form_data["counter"] );}
		echo $this->Sales_model->get_pump_of_counter($form_data['counter']);
			
	}
	function get_2toil_pumps(){
		$form_data = $this->input->post();
		echo $this->Sales_model->get_2tpumps_list($form_data['counter']);
			
	}
	function petrol_sales_entry()
	{	
		$data["menu"]='sales';
		$data["submenu"]='sales_entry';
		$data["counters"]=$this->Sales_model->get_counters_list();
		$data["pump_list"]=$this->Sales_model->get_pump_list();
		$this->template->write('titleText', "Petrol/Diesel Sales Entry");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/sales_entry',$data);
        $this->template->render();					
	}
	function other_sales_entry(){
		$data["pump_list"]=$this->Sales_model->get_pump_list();
		$data["pdt_list"]=$this->Sales_model->get_other_pdts_list();
		$data["counters"]=$this->Sales_model->get_counters_list();
		$data["indent_cust"]=$this->Sales_model->get_indent_customers();
		$data['customerid']=$this->Sales_model->fetch_otherproducts_custid();
		$data["retail_customers"]=$this->Sales_model->get_retail_customers();
		
		$data["billsms_status"]=$this->Sales_model->get_billsms_status();
		$data["menu"]='sales';
		$data["submenu"]='other_sales_entry';
		$this->template->write('titleText', "Other Products Bill Entry");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/other_sales_entry',$data);
        $this->template->render();
	}
	
	function testing_litres_entry(){
		$data["menu"]='sales';
		$data["submenu"]='testing_entry';
		$data["counters"]=$this->Sales_model->get_counters_list();
		$this->template->write('titleText', "Testing Litres Bill Entry");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/testing_litres_entry',$data);
        $this->template->render();
	} 
	
	function open_close_shift(){
		$data["menu"]='sales';
		$data["submenu"]='open_shift';
		$data["counters"]=$this->Sales_model->get_counters_list();
		$data["status"]=$this->Sales_model->get_counter_status();
		$data["entry_list"]=$this->Sales_model->get_shift_entries();
		$this->template->write('titleText', "Open/Close Shift");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/open_close_shift',$data);
        $this->template->render();
	}
	function get_rate(){
		//$product=str_replace('%20',' ', $pdt);
		$form_data=$this->input->post();
		$product=$form_data["pdt"];
		echo $this->Sales_model->get_rate($product);
		//echo $product;
	}
	
	function cash_form(){
		$form_data = $this->input->post();
		$sale_mode=$form_data["sales_mode"];
		$bill_nos=$this->Sales_model->get_bill_no($sale_mode);
		foreach ($bill_nos as $no);
		$bill=$no[$sale_mode];	
		if($sale_mode=='Cash_sales'){
			$bill_no="CA".$no[$sale_mode];
		}
		else if($sale_mode=='Indent_sales'){
			$bill_no="IN".$no[$sale_mode];
		}
		else if($sale_mode=='Credit_card_sales'){
			$bill_no="CR".$no[$sale_mode];
		}
		else if($sale_mode=='Fleet_card_sales'){
			$bill_no="XP".$no[$sale_mode];
		}
		else if($sale_mode=='Xtra_reward_sales'){
			$bill_no="XR".$no[$sale_mode];
		}
		else if($sale_mode=='Easy_fuel_sales'){
			$bill_no="EF".$no[$sale_mode];
		}
		else if($sale_mode=='Cheque_sales'){
			$bill_no="CH".$no[$sale_mode];
		}
		if($form_data["sales_mode"]!='Cheque_sales'){
			$cheque_no='NULL';
			$cheque_date='NULL';
			$cheque_status='NULL';
			$bank_name='NULL';
		}
		else{
			$cheque_no=$form_data["cheque_no"];
			$cheque_date=$form_data["cheque_date"];
			$cheque_status='NOT_CLEARED';
			$bank_name=$form_data["bank_name"];
		}
		if($form_data["sales_mode"]!='Indent_sales'){
			$indent_no='NULL';
			$custname=$form_data["cust_name"];
			$cust_id='NULL';
			$ref_no='NULL';
		}else
		{
			$indent_no=$form_data["indent_no"];
			$custname=$form_data["ind_cust_name"];
			$ref_no=$form_data["ref_no"];
			$cust_id=$this->Sales_model->getCustId($form_data['ind_cust_name']);
		} 
		
		if(isset($form_data["2toilpump"])){ 
			if(($form_data["2toilpump"]!='default') &&($form_data["2toilqty"]!='0') ){
			$twotpumpno=$form_data["2toilpump"];
			}
			else{
				$twotpumpno='NULL';
			}
		}
		else{
			$twotpumpno='NULL';
		}
		$this->Sales_model->insert_bill($bill_no,$custname,$cust_id,trim($form_data["veh_no"]),$form_data["mob_no"],$form_data["pump_no"],$form_data["shift"],$form_data["counterno"],$form_data["sales_mode"],$form_data["total"],$indent_no,$form_data["km_rdng"],$form_data["acct_date"],$twotpumpno,$cheque_no,$cheque_date,$cheque_status,$bank_name,$ref_no);
		$cnt=$form_data["count"];
		for ($i = 1; $i <= $cnt; $i++) {
			if($form_data["item$i"]!='default'){
				$this->Sales_model->insert_bill_details($bill_no,$form_data["item$i"],$form_data["qty$i"],$form_data["rate$i"],$form_data["val$i"]);
			}
			//$this->Sales_model->insert_bill_details($bill_no,$form_data["item$i"],$form_data["qty$i"],$form_data["val$i"]);
		}
		if(isset($form_data["2toilpump"])){
		if(($form_data["2toilpump"]!='default') &&($form_data["2toilqty"]!='0')){
			$this->Sales_model->insert_bill_details($bill_no,'2TOIL_LOOSE',$form_data["2toilqty"],$form_data["2toilrate"],$form_data["2toilval"]);
		}
		}
		if($form_data["sales_mode"]=='Indent_sales'){
			$this->Sales_model->update_indent_taken($cust_id,$form_data["total"],'Add');
		}
		$this->Sales_model->update_billno($bill,$sale_mode);
		//redirect("sales/index");
		$this->Sales_model->update_rfid_entry($bill_no,trim($form_data["veh_no"]));
		 if(!($form_data["sales_mode"]=='Indent_sales'))
		{
		if (preg_match("/[^a-zA-Z'-]/",trim($form_data["veh_no"]))) {
		$vehicle=$form_data["veh_no"];	
		if(!is_numeric($vehicle)){	
			$rowcount=$form_data["rowcount"];
			if($rowcount == 0)
			{
			 $this->Sales_model->insert_retailcustomer(trim($form_data["veh_no"]),$form_data["cust_name"],$form_data["mob_no"]);
			}else{
			 $this->Sales_model->update_retailcustomer(trim($form_data["veh_no"]),$form_data["cust_name"],$form_data["mob_no"]);
			}
		}
		}
		}
		echo $bill_no;
	}
	function other_sales_form(){
		$form_data = $this->input->post();
		$sale_mode=$form_data["sales_mode"];
		$bill_nos=$this->Sales_model->get_bill_no($sale_mode);
		foreach ($bill_nos as $no);
		$bill=$no[$sale_mode];	
		if($sale_mode=='Cash_sales'){
			$bill_no="CA".$no[$sale_mode];
		}
		else if($sale_mode=='Indent_sales'){
			$bill_no="IN".$no[$sale_mode];
		}
		else if($sale_mode=='Credit_card_sales'){
			$bill_no="CR".$no[$sale_mode];
		}
		else if($sale_mode=='Fleet_card_sales'){
			$bill_no="XP".$no[$sale_mode];
		}
		else if($sale_mode=='Xtra_reward_sales'){
			$bill_no="XR".$no[$sale_mode];
		}
		else if($sale_mode=='Easy_fuel_sales'){
			$bill_no="EF".$no[$sale_mode];
		}
		else if($sale_mode=='Cheque_sales'){
			$bill_no="CH".$no[$sale_mode];
		}
		
		
		if($form_data["sales_mode"]!='Cheque_sales'){
			$cheque_no='NULL';
			$cheque_date='NULL';
			$cheque_status='NULL';
			$bank_name='NULL';
			$clearance_date='NULL';
		}
		else{
			$cheque_no=$form_data["cheque_no"];
			$cheque_date=$form_data["cheque_date"];
			$cheque_status='NOT_CLEARED';
			$bank_name=$form_data["bank_name"];
			$clearance_date='NULL';
		}
		if($form_data["sales_mode"]!='Indent_sales'){
			$indent_no='NULL';
			$custname=$form_data["cust_name"];
			$cust_id='NULL';
			$ref_no='NULL';
		}else
		{
			$indent_no=$form_data["indent_no"];
			$custname=$form_data["ind_cust_name"];
			$cust_id=$this->Sales_model->getCustId($form_data['ind_cust_name']);
			$ref_no=$form_data["ref_no"];
		} 
		
		
		$this->Sales_model->insert_other_pdt_bill($bill_no,$custname,$cust_id,trim($form_data["veh_no"]),$form_data["mob_no"],$form_data["shift"],$form_data["counterno"],$form_data["sales_mode"],$form_data["total"],$form_data["acct_date"],$indent_no,$cheque_no,$cheque_date,$cheque_status,$bank_name,$clearance_date,$ref_no);
	
		$cnt=$form_data["count"];
		for ($i = 1; $i <= $cnt; $i++) {
			if($form_data["item$i"]!='default'){
				
				$this->Sales_model->insert_other_bill_details($bill_no,$form_data["item$i"],$form_data["qty$i"],$form_data["rate$i"],$form_data["val$i"]);
			}
		}
		
		
		if($form_data["sales_mode"]=='Indent_sales'){
			$this->Sales_model->update_indent_taken($cust_id,$form_data["total"],'Add');
		}
			$this->Sales_model->update_billno($bill,$sale_mode);
			
			 if(!($form_data["sales_mode"]=='Indent_sales'))
			 	{
				$rowcount=$form_data["rowcount"];
				$oil_service_enable=$form_data["Oil_service_status"];
				if(($rowcount == 0 && $oil_service_enable == "0") || ($rowcount == 0 && $oil_service_enable =="1") )
				{
					if($form_data["avg_km"]!="" )
					{       
							
							$avg_km=$form_data["avg_km"];
							$km1=2750;
							$km2=round($km1/$avg_km);
					    	$exp_date = date('Y-m-d',strtotime('+'.$km2.' days'));	
							$this->Sales_model->insert_other_pdts_customer_km(trim($form_data["veh_no"]),$form_data["cust_name"],$form_data["mob_no"],$form_data["current_custid"],$form_data["next_custid"],$form_data["avg_km"],$form_data["km_reading"],$exp_date,$oil_service_enable,$form_data["oil_service_dob"],$form_data["oil_service_wedding_date"]);
							if($oil_service_enable=="1" )
							{       
							$this->Sales_model->insert_oil_service_customer(trim($form_data["veh_no"]),$form_data["cust_name"],$form_data["mob_no"],$form_data["current_custid"],$form_data["next_custid"],$form_data["avg_km"],$form_data["km_reading"],$exp_date,$oil_service_enable,$form_data["oil_service_dob"],$form_data["oil_service_wedding_date"]);
							}
					}
					else {
							$oil_service_enable=$form_data["Oil_service_status"];
							
							$this->Sales_model->insert_other_pdts_customer($form_data["veh_no"],$form_data["cust_name"],$form_data["mob_no"],$form_data["current_custid"],$form_data["next_custid"],$oil_service_enable);
					}
				}
				else if ($rowcount == 1 && $oil_service_enable =="1")
				{
					if($form_data["avg_km"]!="")
					{
						    $oil_service_enable=$form_data["Oil_service_status"];
							$avg_km=$form_data["avg_km"];
							$km1=2750;
							$km2=round($km1/$avg_km);
					    	$exp_date = date('Y-m-d',strtotime('+'.$km2.' days'));		
							$this->Sales_model->update_other_pdts_customer_km(trim($form_data["veh_no"]),$form_data["cust_name"],$form_data["mob_no"],$form_data["cust_id"],$form_data["avg_km"],$form_data["km_reading"],$exp_date,$oil_service_enable,$form_data["oil_service_dob"],$form_data["oil_service_wedding_date"]);
						if($oil_service_enable=="1" )
							{       
							$this->Sales_model->insert_oil_service_customer(trim($form_data["veh_no"]),$form_data["cust_name"],$form_data["mob_no"],$form_data["cust_id"],$form_data["next_custid"],$form_data["avg_km"],$form_data["km_reading"],$exp_date,$oil_service_enable,$form_data["oil_service_dob"],$form_data["oil_service_wedding_date"]);
							}
					}
						else {
							$oil_service_enable=$form_data["Oil_service_status"];
							
							 $this->Sales_model->update_other_pdts_customer($form_data["veh_no"],$form_data["cust_name"],$form_data["mob_no"],$form_data["cust_id"],$oil_service_enable);
						}
				}else if ($rowcount == 1 && $oil_service_enable =="0")
				{
					if($form_data["avg_km"]!="")
					{
						    $oil_service_enable=$form_data["Oil_service_status"];
							$avg_km=$form_data["avg_km"];
							$km1=2750;
							$km2=round($km1/$avg_km);
					    	$exp_date = date('Y-m-d',strtotime('+'.$km2.' days'));		
							$this->Sales_model->update_other_pdts_customer_km(trim($form_data["veh_no"]),$form_data["cust_name"],$form_data["mob_no"],$form_data["cust_id"],$form_data["avg_km"],$form_data["km_reading"],$exp_date,$oil_service_enable,$form_data["oil_service_dob"],$form_data["oil_service_wedding_date"]);
						
						}else {
							$oil_service_enable=$form_data["Oil_service_status"];
							
							 $this->Sales_model->update_other_pdts_customer($form_data["veh_no"],$form_data["cust_name"],$form_data["mob_no"],$form_data["cust_id"],$oil_service_enable);
						}
				}
			}
			
			
			
			//echo $bill_no;  
			
		echo $bill_no;
	}
	
	function test_litres_form(){
		$form_data = $this->input->post();
		$bill_mode="testing_litres";
		$bill_nos=$this->Sales_model->get_bill_no($bill_mode);
		foreach ($bill_nos as $no);
		$bill_no=$no[$bill_mode];
		$bill="TE".$bill_no;
		$this->Sales_model->insert_test_reg_entry($bill,$form_data["shift"],$form_data["acct_date"],$form_data["counterno"],$form_data["pump_no"],$form_data["purpose"],$form_data["test_litres"]);
		$this->Sales_model->update_billno($bill_no,$bill_mode);
		echo $bill;
	}
	function get_open_reading($pump){
		$pump_no=str_replace('%20',' ', $pump);
		echo $this->Sales_model->get_open_reading($pump_no);
	}
	
	function get_pumps(){
		$form_data=$this->input->post();
		echo $this->Sales_model->get_pump_of_counter($form_data['counter']);
	}
	
	function get_pumps_sales_entry(){
		$form_data=$this->input->post();
		echo $this->Sales_model->get_pump_of_counter_sales_entry($form_data['counter']);
	}
	function last_five_trans_petro($vehicle){
		$data["last_trans"]=$this->Sales_model->last_five_trans_petro_report($vehicle);
		$this->load->view('sales/last_five_trans_petro',$data);
	}
	function last_five_trans_others($customer){
		$data["last_trans"]=$this->Sales_model->last_five_trans_others_report($customer);
		$this->load->view('sales/last_five_trans_others',$data);
	}
	function get_acct_date(){
		$form_data=$this->input->post();
		$result=$this->Sales_model->get_acct_date($form_data['counter']);
		if($result!='nodata'){
			foreach($result as $res){
				echo $res["acct_date"].":::".$res["shift"];
			}
		}
		else {
			echo "nodata";
		}
	}
	function get_test_litres(){
		$form_data=$this->input->post();
		echo $this->Sales_model->get_test_litres($form_data['act_date'],$form_data["shft"],$form_data["pump"]);
	}
	
	function getVehList(){
		$form_data=$this->input->post();
		echo $this->Sales_model->getVehList($form_data['cust_name']);
	}
	function get_cust_id(){
		$form_data=$this->input->post();
		 echo $this->Sales_model->get_cust_id($form_data['cust_name']);
	}
	function get_indent_limit(){
		$form_data=$this->input->post();
        echo $this->Sales_model->get_indent_limit($form_data['cust_id']);
	}
	function get_retail_cust_id($customer)
	{
	$customer_name=str_replace('%20',' ',$customer);
	 echo $this->Sales_model->get_retail_cust_id($customer_name);
	}
	function pet_sales_entry(){
		$form_data=$this->input->post();
		$this->Sales_model->insert_sale_entry($form_data);
		redirect("sales/petrol_sales_entry");
	}
	function Edit_retail_bill()
	{
		$data["indent_cust"]=$this->Sales_model->get_indent_customers();
		$data["menu"]='sales';
		$data["submenu"]='Edit_retail_bill';
		$this->template->write('titleText', "Manage Petrol/Diesel Bills");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/billdetails',$data);
        $this->template->render();	
	}
	
	function Edit_test_litres_bill()
	{
		$data["menu"]='sales';
		$data["submenu"]='Edit_test_litres_bill';
		$this->template->write('titleText', "Manage Testing Litres Bills");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/testing_details',$data);
        $this->template->render();	
	}
		function PD_bill_details()
		{	
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['billdetails']=$this->Sales_model->fetch_bill_details($start,$end);
		$this->load->view('sales/Show_billdetails',$data);	
		}
		
		function testing_bill_details()
		{	
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['billdetails']=$this->Sales_model->fetch_testing_bill_details($start,$end);
		$this->load->view('sales/Show_testing_billdetails',$data);	
		}
		
		function other_pdts_bill_details()
		{
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['billdetails']=$this->Sales_model->fetch_other_pdts_bill_details($start,$end);
		
		$this->load->view('sales/Show_otherproduct_billdetails',$data);	
		}
	
		function update_bill_info($bill_no)
		{
		$data['billdetails']=$this->Sales_model->get_part_bill_details($bill_no);	
		$data['pumplist']=$this->Sales_model->get_pump_list();
		$data['twotpumplist']=$this->Sales_model->get_2toilpump_list();
		$data['counter']=$this->Sales_model->get_counter_no();
		$data['productlist']=$this->Sales_model->get_product_info();
		$data['productdetails']=$this->Sales_model->get_product_bill_details($bill_no);
		$data["indent_cust"]=$this->Sales_model->get_indent_customers();
		$this->load->view('sales/editretailbill',$data);
		}
	function delete_bill_details($bill_no)
	{
		echo $this->Sales_model->delete_billdetails($bill_no);
	}
	function update_billdetails()
	{
		$details = $this->input->post();
		$this->Sales_model->insert_billdetails($details["bill_no"],$details["prod"],$details["rate"],$details["value"],$details["qty"],$details["bill_status"]);
		//echo "Bill Information Update Successfully";
	}
	function retailbill_update(){
		$collect = $this->input->post();
		if($collect["sales_mode"]=='Indent_sales'){
			$this->Sales_model->update_indent_taken($collect["cust_id"],$collect["old_total"],'Sub');
			$this->Sales_model->update_indent_taken($collect["cust_id"],$collect["total"],'Add');
		}
		$this->Sales_model->update_retailbill_info($collect["bill_no"],$collect["cust_name"],$collect["veh_no"],$collect["mob_no"],$collect["pump_no"],$collect["shift"],$collect["counter"],$collect["sales_mode"],$collect["total"],$collect["indent_no"],$collect["meter_reading"],$collect["cust_id"],$collect["twotoilpump"],$collect["cheque_no"],$collect["cheque_date"],$collect["cheque_status"],$collect["bank_name"],$collect["clearance_date"],$collect["ref_no"]);
		echo "Bill Information Update Successfully";
	}	
	function Edit_other_products_bill()
	{
		$data['billdetails']=$this->Sales_model->fetch_other_products_bill_details();
		$data["indent_cust"]=$this->Sales_model->get_indent_customers();		
		$data["menu"]='sales';
		$data["submenu"]='Edit_other_products_bill';
		$this->template->write('titleText', "Manage Other Products Bills");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/otherproduct_billdetails',$data);
        $this->template->render();	
	}
	function show_otherproduct_bill_info($bill_no)
	{
		$data['billdetails']=$this->Sales_model->get_part_otherproducts_bill_details($bill_no);	
		$data['counter']=$this->Sales_model->get_counter_no();
		$data['productlist']=$this->Sales_model->get_otherproducts_info();
		$data['products']=$this->Sales_model->get_otherproducts_info();
		$data['productdetails']=$this->Sales_model->get_otherproducts_bill_details($bill_no);
		$this->load->view('sales/edit_otherproducts_bill',$data);
	}
	function get_indent_cust($mode)
	{
		echo $this->Sales_model->get_indent_cust();
	
	}
	function get_sale_mode($bill_no)
	{
		echo $this->Sales_model->get_sale_mode($bill_no);
	}
	function delete_other_product_bill_details($bill_no)
	{
		echo $this->Sales_model->delete_other_product_billdetails($bill_no);
	}
	function update_other_product_billdetails()
	{
		$details = $this->input->post();
		$this->Sales_model->insert_other_product_billdetails($details["bill_no"],$details["prod"],$details["rate"],$details["value"],$details["qty"],$details["bill_status"]);
		echo "Bill Information Update Successfully";
	}
	function update_other_product_bill(){
		$collect = $this->input->post();
		if($collect["sales_mode"]=='Indent_sales'){
			$this->Sales_model->update_indent_taken($collect["cust_id"],$collect["old_total"],'Sub');
			$this->Sales_model->update_indent_taken($collect["cust_id"],$collect["total"],'Add');
		}
		$this->Sales_model->update_other_product_bill($collect["bill_no"],$collect["cust_name"],$collect["veh_no"],$collect["mob_no"],$collect["shift"],$collect["counter"],$collect["sales_mode"],$collect["total"],$collect["indent_no"],$collect["cust_id"],$collect["cheque_no"],$collect["cheque_date"],$collect["cheque_status"],$collect["bank_name"],$collect["clearance_date"],$collect["ref_no"]);	
		echo "Bill Information Update Successfully";
	}
	function get_other_product_sale_mode($bill_no)
	{
		echo $this->Sales_model->get_other_product_sale_mode($bill_no);
	}
	function check_indent_no($cust_id)
	{
		echo $this->Sales_model->check_indent_no($cust_id);
	}
	function check_indent_duplication()
	{
		$form_data = $this->input->post();
		echo $this->Sales_model->check_indent_duplication($form_data["indentno"]);
	}
	function bill_print(){
		$form_data = $this->input->post();
		$bill_no=$form_data['bill'];
		$copy=$form_data['copy'];
		$data['bill_no']=$bill_no;
		$data['bill_info']=$this->Sales_model->get_bill_info($bill_no);
		$data['bill_details']=$this->Sales_model->get_bill_details($bill_no);
		$data['copy']=$copy;
		$this->load->view('sales/bill_print_page',$data);
		
	}	
	function sms_bill_info(){
		$form_data = $this->input->post();
		$bill_no=$form_data['bill'];
		$data['bill_no']=$bill_no;
		$data['cust_name']=$form_data["smsname"];
		$data['cust_mobile']=$form_data["smsno"];
		$data['info']="Petrol";
		$data['bill_info']=$this->Sales_model->get_bill_info($bill_no);
		$data['bill_details']=$this->Sales_model->get_bill_details($bill_no);
		$this->load->view('sales/sms_bill_info',$data);
		
	}
	function sms_other_bill_info(){
		$form_data = $this->input->post();
		$bill_no=$form_data['bill'];
		$data['bill_no']=$bill_no;
		$data['cust_name']=$form_data["smsname"];
		$data['cust_mobile']=$form_data["smsno"];
		$data['info']="Other";
		$data['bill_info']=$this->Sales_model->get_oth_bill_info($bill_no);
		$data['bill_details']=$this->Sales_model->get_oth_bill_details($bill_no);
		$this->load->view('sales/sms_bill_info',$data);
		
	}
	function other_bill_print(){
		$form_data = $this->input->post();
		$bill_no=$form_data['bill_no'];
		$data['bill_no']=$bill_no;
		echo $data['bill_no'];
	
		$data['bill_info']=$this->Sales_model->get_oth_bill_info($bill_no);
		$data['bill_details']=$this->Sales_model->get_oth_bill_details($bill_no);
		$data['copy']=$form_data['copy'];
		$this->load->view('sales/oth_bill_print_page',$data);
		
	}	
	
	function test_bill_print(){
		$form_data = $this->input->post();
		$bill_no=$form_data['bill_no'];
		$data['bill_no']=$bill_no;
		$data['bill_info']=$this->Sales_model->get_test_bill_info($bill_no);
		$this->load->view('sales/test_bill_print_page',$data);
		
	}	
	function check_sales_entry(){
		$form_data = $this->input->post();
		echo $this->Sales_model->check_sales_entry($form_data['chk_date'],$form_data['chk_shift'],$form_data['chk_pump']);
	}
	
	function get_retail_customer_details($vehicle)
	{
		//echo $vehicle;
		echo $this->Sales_model->get_retail_customer_details($vehicle);
	}	
	function get_other_pdts_customer_details($customer_id)
	{
			$customer_id=str_replace('%20',' ', $customer_id);
			echo $this->Sales_model->get_other_pdts_customer_details($customer_id);
	}	
	function check_vehicle($vehicle)
	{
	echo $this->Sales_model->check_vehicle($vehicle);
	}
	function check_customer($Cust)
	{
	echo $this->Sales_model->check_customer($Cust);
	}
	function getCounterShift(){
		$form_data = $this->input->post();
		$result=$this->Sales_model->getCounterShift($form_data["counter"]);
		foreach ($result as $res){
			if($res["action"]=='open'){
			//echo $res["shift"]."::".date('d-m-Y',strtotime($res["account_date"]));
			echo $res["shift"]."::".date('Y-m-d',strtotime($res["account_date"]));
			}
			else{
				echo "null";
			}
		}
	}
	function check_tank_stock(){
		$form_data = $this->input->post();
		if($form_data["actn"]=='open'){
			$result=$this->Sales_model->check_tank_stock($form_data["act_date"]);
			if(!empty($result)){
				$err='';
				foreach($result as $res){
					if($err==''){
						$err=$res["tank_no"];
					}
					else{
						$err=$err."-".$res["tank_no"];
					}
				}
				echo $err;
			}
			else{
				echo "ok";
			}
		}
		else{
			echo "ok";
		}
		
	}
	function insert_open_close_shift(){
		$form_data = $this->input->post();
		$result=$this->Sales_model->last_shift_status($form_data["ctr"],$form_data["shft"],$form_data["actn"],$form_data["act_date"]);
		if($result!='yes'){
			echo $result;
		}
		else{
		echo $this->Sales_model->open_close_shift($form_data["ctr"],$form_data["shft"],$form_data["actn"],$form_data["act_date"]);
		}
	}
		function retail_bill_log()
		{
		$data["menu"]='sales';
		$data["submenu"]='retail_bill_log';
		$this->template->write('titleText', "Petrol/Diesel Bills Log");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/struct_managed_retail_bills',$data);
        $this->template->render();	
		}
		function managed_retail_bill_details()
		{	
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['managed_retail_bill_details']=$this->Sales_model->fetch_managed_retail_bill_details($start,$end);
		$this->load->view('sales/content_managed_retail_bills',$data);	
		}
		function fetch_no_of_version($bill_no)
		{
		echo $this->Sales_model->fetch_no_of_version($bill_no);		
		}
		function fetch_current_version($bill_no)
		{
		
		$data['billdetails']=$this->Sales_model->get_part_bill_details($bill_no);	
		$data['productdetails']=$this->Sales_model->get_product_bill_details($bill_no);
		if ($data['billdetails'] !=0 || $data['productdetails']){
		$this->load->view('sales/currentbilldetails',$data);
		}
		else
		{
		$norow=0;
		echo $norow;
		}
		}
		function fetch_old_version()
		{
		$bill_details = $this->input->post();
		$bill_no=$bill_details["bill_no"];
		$version=$bill_details["version"];
		$data['oldbilldetails']=$this->Sales_model->get_old_bill_details($bill_no,$version);	
		$data['oldproductdetails']=$this->Sales_model->get_old_product_bill_details($bill_no,$version);
		$this->load->view('sales/oldbilldetails',$data);
		}
		function other_pdts_bill_log()
		{
		$data["menu"]='sales';
		$data["submenu"]='other_pdts_bill_log';
		$this->template->write('titleText', "Other Products Bills Log");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/struct_managed_otherpdts_bills',$data);
        $this->template->render();	
		}
		function managed_other_pdts_bill_details()
		{	
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['managed_other_pdts_bill_details']=$this->Sales_model->fetch_managed_other_pdts_bill_details($start,$end);
		$this->load->view('sales/content_managed_other_pdts_bills',$data);	
		}
		function fetch_no_of_version_other($bill_no)
		{
		echo $this->Sales_model->fetch_no_of_version_other($bill_no);		
		}
		function fetch_current_version_other($bill_no)
		{
		
		$data['otherpdts_billdetails']=$this->Sales_model->get_part_otherproducts_bill_details($bill_no);	
		$data['otherpdts_productdetails']=$this->Sales_model->get_otherproducts_bill_details($bill_no);
		if ($data['otherpdts_billdetails'] !=0 || $data['otherpdts_productdetails']){
		$this->load->view('sales/currentbilldetails_other',$data);
		}
		else
		{
		$norow=0;
		echo $norow;
		}
		}
		function fetch_old_version_other()
		{
		$bill_details = $this->input->post();
		$bill_no=$bill_details["bill_no"];
		$version=$bill_details["version"];
		$data['otherpdts_oldbilldetails']=$this->Sales_model->get_otherpdts_old_bill_details($bill_no,$version);	
		$data['otherpdts_oldproductdetails']=$this->Sales_model->get_otherpdts_old_product_bill_details($bill_no,$version);
		$this->load->view('sales/oldbilldetails_other',$data);
		}
		
		function cancelbill()
		{
		$collect = $this->input->post();
		$bill_no=$collect["bill_no"];
		$result=$this->Sales_model->get_part_bill_details($collect["bill_no"]);
		foreach ($result as $res){
			$sales_mode=$res->sale_mode;
			if($sales_mode=='Indent_sales'){
				$this->Sales_model->update_indent_taken($res->cust_id,$res->total_amount,'Sub');
			}
		}
		
		$reason=$collect["reason"];
		$this->Sales_model->delete_retail_bills($bill_no);
		$this->Sales_model->update_cancelled_retail_bills($bill_no,$reason);
		$this->Sales_model->delete_billdetails($bill_no);
		}
		function cancel_testing_bill()
		{
		$collect = $this->input->post();
		$bill_no=$collect["bill_no"];
		$reason=$collect["reason"];
		$this->Sales_model->delete_testing_bills($bill_no);
		$this->Sales_model->update_cancelled_testing_bills($bill_no,$reason);
		}
		function cancelbill_other()
		{
		$collect = $this->input->post();
		$bill_no=$collect["bill_no"];
		$reason=$collect["reason"];
		$result=$this->Sales_model->get_part_otherproducts_bill_details($bill_no);
		foreach ($result as $res){
			$sales_mode=$res->sale_mode;
			if($sales_mode=='Indent_sales'){
				$this->Sales_model->update_indent_taken($res->cust_id,$res->total_amt,'Sub');
			}
		}
		$this->Sales_model->delete_other_pdt_bills($bill_no);
		$this->Sales_model->update_cancelled_other_pdt_bills($bill_no,$reason);
		$this->Sales_model->delete_other_product_billdetails($bill_no);
		}
		function cancelled_retail_bills()
		{
		$data["menu"]='sales';
		$data["submenu"]='cancelled_retail_bills';
		$this->template->write('titleText', "Cancelled Petrol/Diesel Bills");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/struct_cancelled_retail_bills',$data);
        $this->template->render();	
		}
		
		function cancelled_testing_bills()
		{
		$data["menu"]='sales';
		$data["submenu"]='cancelled_testing_bills';
		$this->template->write('titleText', "Cancelled Testing Litres Bills");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/struct_cancelled_testing_bills',$data);
        $this->template->render();	
		}
		
		function get_cancelled_bills()
		{
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['cancelled_bills']=$this->Sales_model->get_cancelled_bills($start,$end);
		$this->load->view('sales/content_cancelled_retail_bills',$data);	
		}
		
		function get_cancelled_testing_bills()
		{
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['cancelled_bills']=$this->Sales_model->get_cancelled_testing_bills($start,$end);
		$this->load->view('sales/content_cancelled_testing_bills',$data);	
		}
		
		function cancel_bill_details($bill_no)
		{
		$data['cancelled_bill_details']=$this->Sales_model->get_cancelled_bill_details($bill_no);
		$data['cancelled_bill_pdt_details']=$this->Sales_model->get_cancelled_bill_pdt_details($bill_no);
		$this->load->view('sales/cancelledbilldetails',$data);		
		
		}
				
		function cancelled_other_pdts_bills()
		{
		$data["menu"]='sales';
		$data["submenu"]='cancelled_other_pdts_bills';
		$this->template->write('titleText', "Cancelled Other Products Bills");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'sales/struct_cancelled_bills_other',$data);
        $this->template->render();	
		}
		function get_cancelled_bills_other()
		{
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['cancelled_bills_other']=$this->Sales_model->get_cancelled_bills_other($start,$end);
		$this->load->view('sales/content_cancelled_bills_other',$data);	
		}
		function cancel_bill_details_other($bill_no)
		{
		$data['cancelled_bill_details_other']=$this->Sales_model->get_cancelled_bill_details_other($bill_no);
		$data['cancelled_bill_pdt_details_other']=$this->Sales_model->get_cancelled_bill_pdt_details_other($bill_no);
		$this->load->view('sales/cancelledbilldetails_other',$data);		
		
		}
	}