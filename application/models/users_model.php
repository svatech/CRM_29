<?php
Class Users_model extends CI_Model{

function _construct()
	{
		parent::_construct();
	}
	
function get_users_list(){
	return $this->db->query("select * from admin_users")->result();
}

function get_user_info($user_id){
	return $this->db->query("select * from admin_users where user_id='$user_id'")->result();
}

function check_username($username){

		$query=$this->db->query("select  count(*) as 'count' from admin_users where user_email='$username'");
		foreach ($query->result_array() as $row);
		if( $row["count"] == 0)
			print("OK");
		 else
	 		print("E");
	}


}