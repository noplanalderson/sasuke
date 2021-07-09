<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SASUKE_Config extends CI_Controller 
{
	protected $CI;
	
	public function __construct()
	{
		parent::__construct();
		$CI =& get_instance();

		$CI->load->database();

		$this->load->library('CSP_Header');
		$this->csp_header->generateCSP();
	}

	protected static function view($view, $data = NULL)
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