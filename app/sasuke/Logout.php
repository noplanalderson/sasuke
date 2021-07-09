<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends SASUKE_Core {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('app_m');
	}
	
	public function index()
	{
		$this->cache->delete('sasuke_menu_'.$this->user_hash);
		$this->cache->delete('sasuke_user_'.$this->user_hash);
		$this->cache->delete('sasuke_role_'.$this->user_hash);
		
		$this->app_m->updateLastActivity();
		
		$session = array('uid', 'gid', 'time');
		$this->session->unset_userdata($session);
		redirect('login');
	}
}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */