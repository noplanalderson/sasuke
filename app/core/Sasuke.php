<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sasuke extends CI_Controller 
{
	public $site = array();

	public $menus = array();

	public $form = '';

	public $msg = '';
	
	protected $_access = array();

	public function __construct()
	{
		parent::__construct();
		$CI =& get_instance();

		$CI->load->database();
		$CI->load->model('site_m');
		
		$this->site	= $this->site_m->getSetting();
		$this->instansi	= $this->site_m->getInstansi();

		if(empty($this->site)) redirect('konfigurasi');
		if(empty($this->instansi)) redirect('konfigurasi/instansi');

		$this->menus= $this->site_m->getMainMenu();
		$this->user = $this->site_m->getUserProfile();

		$this->_access = array(
			'uid' => $CI->session->userdata('uid'),
			'gid' => $CI->session->userdata('gid'),
			'menu' => $CI->uri->segment(1)
		);
		
		$CI->load->library('access_control');
		$CI->access_control->initialize($this->_access);
	}

	protected static function view($view, $data)
	{
		$CI =& get_instance();

		if(is_array($view))
		{
			for ($i = 0; $i < count($view); $i++) 
			{
				$CI->load->view($view[$i], $data);
			}
		}
		else
		{
			$CI->load->view($view, $data);
		}
	}
}

/* End of file my_Frontend.php */
/* Location: ./application/core/my_Frontend.php */