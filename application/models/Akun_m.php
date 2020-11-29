<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun_m extends CI_Model {

	public function ubahPassword($password)
	{
		$password = password_hash($password, PASSWORD_ARGON2ID);

		$this->db->where('id_user', $this->session->userdata('uid'));
		return $this->db->update('tb_user', array('user_password' => $password)) ? true : false;
	}

	public function getAkun()
	{
		$id = encrypt($this->session->userdata('uid'));

		$this->db->select('user_name, user_email, user_picture');
		$this->db->where('md5(id_user)', verify($id));
		return $this->db->get('tb_user')->row_array();
	}

	public function ubahAkun($akun)
	{
		$object = array(
			'user_name' => $akun['user_name'],
			'user_email'=> $akun['user_email'],
			'user_picture' => $akun['user_picture']
		);

		$id = encrypt($this->session->userdata('uid'));

		$this->db->where('md5(id_user)', verify($id));
		return $this->db->update('tb_user', $object) ? true : false;
	}
}

/* End of file akun_m.php */
/* Location: ./application/models/akun_m.php */