<?php
class Users extends CI_Controller
	{   function __construct(){
		parent::__construct();
		$this->load->model('Users_model');
		$this->load->library('SimpleLoginSecure');
		$this->load->library('session');
		if(!$this->session->userdata('admin_logged_in')) {
			redirect("logincheck");
		}
}

	function list_users(){
		$data["menu"]='users';
		$data["submenu"]='list_users';
		$data['users']=$this->Users_model->get_users_list();
		$this->template->write('titleText', "User Master");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'users/listusers',$data);
        $this->template->render();
	}
	
	function add_new_user(){
		$data["menu"]='users';
		$data["submenu"]='list_users';
		$this->template->write('titleText', "User Master");
		$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'users/adduser',$data);
        $this->template->render();
	}
	
	function fetch_user_info($user_id)
	{
		$data['user_info'] = $this->Users_model->get_user_info($user_id);
		$this->load->view("users/user_info_form",$data);
		
	}
	
	function check_username($username)
	{
		$username=str_replace('%20',' ', $username);
		echo $this->Users_model->check_username($username);
	}
	
	}
