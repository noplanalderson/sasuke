<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function flashMessage($name, $msg, $redirect_to = NULL)
{
	$CI =& get_instance();
	$CI->session->set_flashdata($index, $msg);
	
	if(!is_null($redirect_to))
	{
		redirect($redirect_to);
	}
}