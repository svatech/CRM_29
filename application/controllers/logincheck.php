<?php
class Logincheck extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->library('SimpleLoginSecure');
		$this->session->set_userdata("adminpage",0);
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{	
		$data["menu"]='sales';
		$data["submenu"]='sales';
		$this->template->write('sideTitle', 'Main Menu');
		$this->template->write('titleText', "Login Form");
		//$this->template->write_view('sideLinks', 'general/menu',$data);
        $this->template->write_view('bodyContent', 'general/myContent');
        $this->template->render();
	}

	/* function ims()
	{
		if($this->session->userdata('admin_logged_in')) {
			redirect("/ims/index");
		} else {
			$this->template->write('title', 'Indent Management System');
			$this->template->write_view('body', 'ims/login_form');
			$this->template->write_view('sidelinks', 'sidelinks/home_links');
			$this->template->render();
		}
	} */

	function login()
	{
		if($this->session->userdata('admin_logged_in')) {
			redirect("/sales/index");
		} else {
			$email = $this->input->post('email');
			$pwd = $this->input->post('pwd');

			if($this->simpleloginsecure->login($email, $pwd)) {
				redirect("/sales/index");
			}
			else {
				$err = "Wrong Credentials";
				$data["err"] = $err;
				$data["menu"]='sales';
				$data["submenu"]='sales';
				$this->template->write_view('sideLinks', 'general/menu');
				$this->template->write_view('bodyContent', 'general/myContent',$data);
				$this->template->render();
			}
		}
	}


	
	function logout()
	{
		$this->simpleloginsecure->logout();
		redirect("general");
	}

	function create()
	{
		$form_data = $this->input->post();
		$uname=$form_data["u_name"];
		$username=$form_data["username"];
		$passwd=$form_data["passwd"];
		$ph_num=$form_data["ph_num"];
		$userrole=$form_data["userrole"];
		$addedname=$this->session->userdata('admin_user_email');
		$this->simpleloginsecure->create($uname,$username,$passwd,$ph_num,$userrole,$addedname);
		redirect("users/add_new_user");
	}

	function adduser(){
		
		$this->template->write_view('sideLinks', 'general/menu');
		$this->template->write_view('bodyContent', 'general/adduser');
		$this->template->render();
	}
	
	function updateuser(){
		$form_data = $this->input->post();
		$uname=$form_data["u_name"];
		$username=$form_data["username"];
		$passwd=$form_data["passwd"];
		$ph_num=$form_data["ph_num"];
		$userrole=$form_data["userrole"];
		
		$this->simpleloginsecure->update($uname,$username,$passwd,$ph_num,$userrole);
		echo "User Information updated successfully";
	}
}
