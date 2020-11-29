<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Sasuke {

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		$this->access_control->check_role();
	}

	public function index()
	{
		$data = array(
			'title' => $this->site['judul_app_alt'] .' - Dashboard',
			'script' => ''
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'home',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */