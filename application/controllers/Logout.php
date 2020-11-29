<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logout extends Sasuke {

	public function __construct()
	{
		parent::__construct();
	}
	
	public function index()
	{
		$this->load->model('Site_m');
		$this->site_m->updateLastActivity();

		$session = array('uid', 'gid', 'time');
		$this->session->unset_userdata($session);
		redirect('login');
	}

}

/* End of file logout.php */
/* Location: ./application/controllers/logout.php */