<?php

Class Stock extends CI_Controller
{	
function __construct(){
	parent::__construct();
	$this->load->library('SimpleLoginSecure');
	$this->load->model('stock_model');
	if(!$this->session->userdata('admin_logged_in'))
	{
		redirect('logincheck');
	}
	}
function tank_stock_entry()
{
	$data["menu"]='stock';
	$data["submenu"]='stock_dtls';
	$data['tankdetails']=$this->stock_model->fetch_tank_details();
	$this->template->write('titleText', "Tank Stock Entry");
	$this->template->write_view('sideLinks','general/menu',$data);
	$this->template->write_view('bodyContent','stock_management/tank_stock_entry',$data);	
	$this->template->render();
}
function get_product($tank_no){
	echo  $this->stock_model->get_product($tank_no);
}
function check_tank()
	{
		//$tank_no=str_replace('%20',' ', $tank_no);
		$form_data=$this->input->get();
		$tank_no=$form_data["tank"];
		$acct_date=$form_data["act_date"];
		echo $this->stock_model->check_tank($tank_no,$acct_date);
		
	} 
	function tank_stock_details()
	{	
		$acct_date=$_POST['acct_date'];
		$tank_no=$_POST['tank_no'];
		$product=$_POST['product'];
		$volume=$_POST['volume'];
		$dip_level=$_POST['dip_level'];
		$water_level=$_POST['water_level'];
		$density=$_POST['density'];
		$act_density=$_POST['act_density'];
		$act_temp=$_POST['act_temp'];
		$count=$_POST['count'];
		if($count == 0){
			$this->stock_model->insert_tank_stock_details($acct_date,$tank_no,$product,$volume,$dip_level,$water_level,$density,$act_density,$act_temp);	
		}else
		{
			$this->stock_model->update_tank_stock_details($acct_date,$tank_no,$product,$volume,$dip_level,$water_level,$density,$act_density,$act_temp);
		}
		redirect('stock/tank_stock_entry');
		}
		
}?>