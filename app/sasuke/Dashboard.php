<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends SASUKE_Core {

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		$this->access_control->check_role();

		$this->_partial = array(
			'head',
			'sidebar',
			'topbar',
			'body',
			'footer',
			'modal',
			'script'
		);

		$this->css_plugin 	= 'fontawesome-free/css/all.min';

		$this->js_plugin 	= 'bootstrap/js/bootstrap.bundle.min';
	}

	public function index()
	{
		$this->_module 	= 'dashboard/dashboard';

		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - Dashboard'
		);

		$this->load_view();
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */