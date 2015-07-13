<?php
class Automatic extends CI_Controller
{
	
	
			function __construct()
		   {
			parent::__construct();
			$this->load->model('Sales_model');	
			$this->load->model('master_model');		
			}
		function index()
		{
			echo "koko";
		}
		 function oil_service_sms(){
	    	/*$avg_km=$form_data["avg_km"];
			$km1=2750;
			$km2=round($km1/$avg_km);
	    	$exp_date = date('Y-m-d',strtotime('+'.$km2.' days'));
	    	*/
	    	//$remind_date = date($exp_date,strtotime('-7days'));
			//$this->load->model('sales_model');	
	   		$data['oil_service']=$this->Sales_model->get_other_pdts_customer_sms();
	    	$this->load->view('sales/sms_oilservice',$data);
	    	echo "Message Sent Successfully";
		//$this->load->view('sales/sms',$data);$oil_service
	 	  }
	 	  function oil_service_dob_sms(){
	 	  	$data['oil_service']=$this->Sales_model->get_oil_service_dob_sms();
	    	$this->load->view('sales/sms_oilservicedob',$data);
	    	echo "Message Sent Successfully";
	 	  	}
			function indent_customer_dob_sms(){
	 	  	$data['indent_customer']=$this->master_model->get_indent_customer_dob_sms();
	    	$this->load->view('master/sms_indentcustomerdob',$data);
	    	echo "Message Sent Successfully";
	 	  	}
	 	  	
		 function oil_service_wedding_date_sms(){
			$data['oil_service']=$this->Sales_model->get_oil_service_wedding_date_sms();
	    	$this->load->view('sales/sms_oilserviceweddingdate',$data);
	    	echo "Message Sent Successfully";
		}
	
}
?>