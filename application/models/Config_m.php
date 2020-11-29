<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Config_m extends CI_Model {

	public function appSetting($data)
	{
		return $this->db->insert('tb_app_setting', $data) ? true : false;
	}

	public function addUser($data)
	{
		return $this->db->insert('tb_user', $data) ? true : false;
	}

	public function instansiSetting($data)
	{
		return $this->db->insert('tb_instansi', $data) ? true : false;
	}
}

/* End of file config_m.php */
/* Location: ./application/models/config_m.php */