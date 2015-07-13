<?php
class Purchase extends CI_Controller
{   function __construct(){
	parent::__construct();
	$this->load->model('Purchase_model');
	$this->load->library('SimpleLoginSecure');
		if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
	
}

	function index(){
		$data["menu"]='purchase';
		$data["submenu"]='petrol_pur';
		$data["pdt_list"]=$this->Purchase_model->get_pdts_list();
		$data["tank_list"]=$this->Purchase_model->get_tanks_list();
		$data["bill_nos"]=$this->Purchase_model->get_bill_no('petrol_voucher');
		$this->template->write('titleText', "Petrol/Diesel Purchase");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'purchase/petrol_diesel_purchase',$data);
        $this->template->render();					
	}
	
	function other_purchase(){
		$data["menu"]='purchase';
		$data["submenu"]='other_pur';
		$data["pdt_list"]=$this->Purchase_model->get_other_pdts_list();
		$data["supp_list"]=$this->Purchase_model->get_suppliers_list();
		$data["bill_nos"]=$this->Purchase_model->get_bill_no('other_pur_voucher');
		$this->template->write('titleText', "Other Products Purchase");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'purchase/other_purchase',$data);
        $this->template->render();					
	}
	function get_tnk_pdt(){
		$form_data = $this->input->post();
		$result=$this->Purchase_model->get_tnk_pdt($form_data['tank']);
		foreach($result as $res){
			echo $res['product'];
		}
	}
	function petrol_pur(){
		$form_data = $this->input->post();
		$this->Purchase_model->insert_bill($form_data["voucher_no"],$form_data["acct_date"],$form_data["inv_no"],$form_data["inv_date"],$form_data["party_name"],$form_data["total"]);
		$cnt=$form_data["count"];
		$tnk_cnt=$form_data["tnk_count"];
		for ($i = 1; $i <= $cnt; $i++) {
			if($form_data["item$i"]!='default'){
				
				$this->Purchase_model->insert_bill_details($form_data["voucher_no"],$form_data["item$i"],$form_data["qty$i"],$form_data["val$i"],$form_data["inv_den$i"],$form_data["del_den$i"]);
			}
		}
		
		for($i=1;$i <= $tnk_cnt;$i++){
			if(($form_data["tnk$i"]!='default')&&($form_data["pdt$i"]!='')&&(($form_data["ltrs$i"]!='')&&($form_data["ltrs$i"]!='0'))){
				
				$this->Purchase_model->insert_tnk_load_details($form_data["voucher_no"],$form_data["tnk$i"],$form_data["pdt$i"],$form_data["ltrs$i"],$form_data["acct_date"]);
			}
		}
			$this->Purchase_model->update_billno($form_data["voucher_no"],'petrol_voucher');
			redirect('purchase');
		
	}
	
	function other_pur(){
		$form_data = $this->input->post();
		
		$this->Purchase_model->insert_other_bill($form_data["voucher_no"],$form_data["acct_date"],$form_data["inv_no"],$form_data["inv_date"],$form_data["party_name"],$form_data["pay_mode"],$form_data["total"],$form_data["cash_disc"],$form_data["cash_disc_amt"],$form_data["sch_disc"],$form_data["sch_disc_amt"],$form_data["vat"],$form_data["vat_amt"],$form_data["other_amt"],$form_data["grnd_tot"]);
		$cnt=$form_data["count"];
		for ($i = 1; $i <= $cnt; $i++) {
			if($form_data["item$i"]!='default'){
				$cat=$this->Purchase_model->get_pdt_category($form_data["item$i"]);		
				$this->Purchase_model->insert_other_bill_details($form_data["voucher_no"],$form_data["item$i"],$cat,$form_data["qty$i"],$form_data["rate$i"],$form_data["val$i"]);
			}
		}
			$this->Purchase_model->update_billno($form_data["voucher_no"],'other_pur_voucher');
			redirect('purchase/other_purchase');
		
	}
	
	function sample(){
		echo "hello";
	}
	
	function edit_petrol_purchase(){
		$data["menu"]='purchase';
		$data["submenu"]='edit_petrol_purchase';
		$this->template->write('titleText', "Manage Petrol/Diesel Purchase Bills");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'purchase/edit_pet_pur_details',$data);
        $this->template->render();
	}
	
	function pet_pur_details(){
		$date = $this->input->post();
		$sdate=$date["start"];
		$edate=$date["end"];
		$data['pur_details']=$this->Purchase_model->fetch_purchase_details($sdate,$edate);
		$this->load->view('purchase/show_pet_pur_details',$data);
	}
	
	function update_bill_info($bill_no)
		{
		$data["pdt_list"]=$this->Purchase_model->get_pdts_list();
		$data["tank_list"]=$this->Purchase_model->get_tanks_list();
		$data["bill_details"]=$this->Purchase_model->get_pet_pur_details($bill_no);
		$data["pdt_details"]=$this->Purchase_model->pet_pur_pdt_details($bill_no);
		$data["tank_loads"]=$this->Purchase_model->get_tanks_loading_details($bill_no);
		$this->load->view('purchase/pet_pur_bill_edit_page',$data);
	}
	
	function update_other_bill_info($bill_no)
		{
		$data["pdt_list"]=$this->Purchase_model->get_other_pdts_list();
		$data["suppliers"]=$this->Purchase_model->get_suppliers_list();
		$data["bill_details"]=$this->Purchase_model->get_oth_pur_details($bill_no);
		$data["pdt_details"]=$this->Purchase_model->oth_pur_pdt_details($bill_no);
		$this->load->view('purchase/oth_pur_bill_edit_page',$data);
	}
	
	function delete_pet_pur_details($voucher_no){
		echo $this->Purchase_model->delete_pet_pur_details($voucher_no);
	}
	
	function delete_oth_pur_details($voucher_no){
		echo $this->Purchase_model->delete_oth_pur_details($voucher_no);
	}
	
	function delete_tank_loading_details($voucher_no){
		echo $this->Purchase_model->delete_tank_loading_details($voucher_no);
	}
	function update_pet_pur_details(){
		$details = $this->input->post();
		$this->Purchase_model->insert_pet_pur_dtls($details["voucher_no"],$details["prod"],$details["qty"],$details["amt"],$details["inv_den"],$details["del_den"],$details["voucher_status"]);
		//echo "Bill Information Update Successfully";
	}
	function update_oth_pur_details(){
		$details = $this->input->post();
		$cat=$this->Purchase_model->get_pdt_category($details["prod"]);
		$this->Purchase_model->insert_oth_pur_dtls($details["voucher_no"],$details["prod"],$details["qty"],$details["amt"],$details["rate"],$cat,$details["voucher_status"]);
		//echo "Bill Information Update Successfully";
	}
	function update_tank_loading_details(){
		$details = $this->input->post();
		$this->Purchase_model->insert_tank_loading_dtls($details["voucher_no"],$details["tnk"],$details["pdt"],$details["ltrs"],$details["acct_date"],$details["voucher_status"]);
		//echo "Bill Information Update Successfully";
		//echo $details["voucher_no"]." ".$details["tnk"]." ".$details["pdt"]." ".$details["ltrs"]." ".$details["acct_date"];
	}
	function pet_pur_bill_update(){
		$collect = $this->input->post();
		$this->Purchase_model->update_pet_pur_info($collect["voucher_no"],$collect["acct_date"],$collect["inv_no"],$collect["inv_date"],$collect["party_name"],$collect["total_amt"]);	
		echo "Bill Information Update Successfully";
	}
	function oth_pur_bill_update(){
		$collect = $this->input->post();
		$this->Purchase_model->update_oth_pur_info($collect["voucher_no"],$collect["acct_date"],$collect["inv_no"],$collect["inv_date"],$collect["party_name"],$collect["pay_mode"],$collect["total"],$collect["cash_disc"],$collect["cash_disc_amt"],$collect["sch_disc"],$collect["sch_disc_amt"],$collect["vat"],$collect["vat_amt"],$collect["other_amt"],$collect["grnd_tot"]);	
		echo "Bill Information Update Successfully";
	}
	function edit_other_purchase(){
		$data["menu"]='purchase';
		$data["submenu"]='edit_other_purchase';
		$this->template->write('titleText', "Manage Other Products Purchase Bills");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'purchase/edit_oth_pur_details',$data);
        $this->template->render();
	}
	
	function oth_pur_details(){
		$date = $this->input->post();
		$sdate=$date["start"];
		$edate=$date["end"];
		$data['other_details']=$this->Purchase_model->fetch_other_purchase_details($sdate,$edate);
		$this->load->view('purchase/show_oth_pur_details',$data);
	}
	function retail_purchase_log()
		{
		$data["menu"]='purchase';
		$data["submenu"]='retail_purchase_log';
		$this->template->write('titleText', "Petrol/Diesel Purchase Log");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'purchase/struct_managed_retail_purchase',$data);
        $this->template->render();	
		}
		function managed_retail_purchase_details()
		{	
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['managed_retail_purchase_details']=$this->Purchase_model->fetch_managed_retail_purchase_details($start,$end);
		$this->load->view('purchase/content_managed_retail_purchase',$data);	
		}
		function fetch_no_of_version($voucher_no)
		{
		echo $this->Purchase_model->fetch_no_of_version($voucher_no);		
		}	
		function fetch_current_version($voucher_no)
		{
		
		$data["bill_details"]=$this->Purchase_model->get_pet_pur_details($voucher_no);
		$data["pdt_details"]=$this->Purchase_model->pet_pur_pdt_details($voucher_no);
		$data["tank_loads"]=$this->Purchase_model->get_tanks_loading_details($voucher_no);
		$this->load->view('purchase/currentpurchasedetails',$data);
		}
		function fetch_old_version()
		{
		$voucher_details = $this->input->post();
		$voucher_no=$voucher_details["voucher_no"];
		$version=$voucher_details["version"];
		$data['oldpurchasedetails']=$this->Purchase_model->get_old_purchase_details($voucher_no,$version);	
		$data['oldproductpurchasedetails']=$this->Purchase_model->get_old_product_purchase_details($voucher_no,$version);
		$data["old_tank_loads"]=$this->Purchase_model->get_old_tanks_loading_details($voucher_no,$version);
		$this->load->view('purchase/oldpurchasedetails',$data);
		}
		function other_purchase_log()
		{
		$data["menu"]='purchase';
		$data["submenu"]='other_purchase_log';
		$this->template->write('titleText', "Other Products Purchase Log");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'purchase/struct_managed_other_purchase',$data);
        $this->template->render();	
		}
		function managed_other_purchase_details()
		{	
		$date = $this->input->post();
		$start=$date["start"];
		$end=$date["end"];
		$data['managed_other_purchase_details']=$this->Purchase_model->fetch_managed_other_purchase_details($start,$end);
		$this->load->view('purchase/content_managed_other_purchase',$data);	
		}
		function fetch_no_of_version_other($voucher_no)
		{
		echo $this->Purchase_model->fetch_no_of_version_other($voucher_no);		
		}
		function fetch_current_version_other($voucher_no)
		{
		
		$data["bill_details"]=$this->Purchase_model->get_oth_pur_details($voucher_no);
		$data["pdt_details"]=$this->Purchase_model->oth_pur_pdt_details($voucher_no);
		$this->load->view('purchase/currentpurchasedetails_other',$data);
		}
		function fetch_old_version_other()
		{
		$voucher_details = $this->input->post();
		$voucher_no=$voucher_details["voucher_no"];
		$version=$voucher_details["version"];
		$data['oldpurchasedetails_other']=$this->Purchase_model->get_old_purchase_details_other($voucher_no,$version);	
		$data['oldproductpurchasedetails_other']=$this->Purchase_model->get_old_product_purchase_details_other($voucher_no,$version);
		
		$this->load->view('purchase/oldpurchasedetails_other',$data);
		}
		function fetch_comm_rate($product)
		{
		echo $this->Purchase_model->fetch_comm_rate($product);
		}
		function get_supplier_prod()
		{
		$form_data=$this->input->post();
		$supplier=$form_data["supplier"];
		echo $this->Purchase_model->get_supplier_prod($supplier);
		}
		
}