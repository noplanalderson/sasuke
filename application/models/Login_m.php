<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_m extends CI_Model {

	public function verify($user_name)
	{
		$this->db->select('id_user, id_type, user_password');
		$this->db->where('user_name', $user_name);
		$this->db->or_where('user_email', $user_name);
		return $this->db->get('tb_user');
	}	
}

/* End of file Login_m.php */
/* Location: ./application/models/Login_m.php */