<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_m extends CI_Model {

	public function getAppSetting()
	{
		return $this->db->get('tb_app_setting', 1)->row();
	}	

	public function getInstansi()
	{
		return $this->db->get('tb_instansi', 1)->row();
	}
	
	public function getMainMenu()
	{
		$this->db->select('a.id_menu, a.label_menu');
		$this->db->join('tb_roles b', 'a.id_menu = b.id_menu', 'inner');
		$this->db->where('a.tipe_menu', 'mainmenu');
		$this->db->where('b.id_type', $this->session->userdata('gid'));
		$this->db->order_by('a.id_menu', 'asc');
		return $this->db->get('tb_menu a')->result();
	}

	public function getSubMenu($parent_id)
	{
		$this->db->select('a.label_menu, a.link_menu, a.icon_menu');
		$this->db->join('tb_roles b', 'a.id_menu = b.id_menu', 'inner');
		$this->db->where('a.tipe_menu', 'submenu');
		$this->db->where('a.parent_id', $parent_id);
		$this->db->where('b.id_type', $this->session->userdata('gid'));
		$this->db->order_by('a.id_menu', 'asc');
		return $this->db->get('tb_menu a')->result();
	}

	public function getContentMenu($link)
	{
		$this->db->select('a.label_menu, a.link_menu, a.icon_menu');
		$this->db->join('tb_roles b', 'a.id_menu = b.id_menu', 'inner');
		$this->db->where('a.tipe_menu', 'content');
		$this->db->where('b.id_type', $this->session->userdata('gid'));
		$this->db->where('a.link_menu', $link);
		$this->db->order_by('a.id_menu', 'asc');
		return $this->db->get('tb_menu a')->row();
	}

	public function checkRole($menu, $gid)
	{
		$this->db->select('a.id_role');
		$this->db->join('tb_menu b', 'a.id_menu = b.id_menu', 'inner');
		$this->db->where('a.id_type', $gid);
		$this->db->where('b.link_menu', $menu);
		return $this->db->get('tb_roles a')->num_rows();
	}

	public function getUserProfile()
	{
		$this->db->select("a.user_name, a.user_picture, a.nama_pegawai, FROM_UNIXTIME(a.last_login) AS last_login, INET6_NTOA(a.last_ip) AS last_ip, b.index_page, b.user_type");
		$this->db->join('tb_user_type b', 'a.id_type = b.id_type', 'inner');
		$this->db->where('a.id_user', $this->session->userdata('uid'));
		return $this->db->get('tb_user a')->row();
	}

	public function updateLastActivity()
	{
		$data = array(
			'last_login' => $this->session->userdata('time'),
			'last_ip' => inet_pton(get_real_ip())
		);

		$this->db->where('id_user', $this->session->userdata('uid'));
		$this->db->update('tb_user', $data);
	}

	public function updateSetting($setting)
	{
		unset($setting['submit']);

		return $this->db->update('tb_app_setting', $setting) ? true : false;
	}

	public function updateInstansi($instansi)
	{
		return $this->db->update('tb_instansi', $instansi) ? true : false;
	}
}

/* End of file Site_m.php */
/* Location: ./application/models/Site_m.php */