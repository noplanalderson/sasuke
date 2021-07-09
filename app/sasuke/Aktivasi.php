<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivasi extends SASUKE_Core 
{
	public function __construct()
	{
		parent::__construct();
		$this->access_control->is_login();

		$this->_partial = array(
			'head',
			'body',
			'script'
		);

		$this->css_plugin 	= 'fontawesome-free/css/all.min';
		$this->js_plugin 	= 'bootstrap/js/bootstrap.bundle.min';

		$this->load->model('akun_m');
	}

	public function index($token = NULL)
	{	
		$user = $this->akun_m->cekKodePemulihan($token);

		if($user == 0) show_error(
			'Halaman sudah tidak berlaku atau sudah kadaluarsa.', 
			'Halaman Kadaluarsa', 
			'Halaman Kadaluarsa', 200
		);
			
		$this->_module 	= 'account/aktivasi';

		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - Atur Password',
			'token'	 	=> $token
		);

		$this->load_view();
	}

	public function submit()
	{
		$status = 0;
		$kode 	= $this->input->post('kode', TRUE);
		$pwd 	= $this->input->post('user_password', TRUE);
		
		$this->form_validation->set_rules($this->_rulesPassword());

		if ($this->form_validation->run() === TRUE) 
		{	
			$status 	= ($this->akun_m->aktivasi($kode, passwordHash($pwd,[
							'memory_cost' => 2048, 
							'time_cost' => 4, 
							'threads' => 1
						])) == TRUE) ? 1 : 0;
			$msg 		= ($status == 1) ? 'Akun anda telah diaktivasi.' : 'Gagal Mengaktivasi Akun.';
		} 
		else 
		{
			$msg = validation_errors();
		}

		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
	
	private function _rulesPassword()
	{
		$rules = array(
			array(
				'field' => 'kode',
		        'label' => 'Kode',
		        'rules' => 'trim|required|regex_match[/[a-zA-Z0-9\-_]+$/]',
		        'errors'=> array(
		        	'required' => '{field} harus diisi.',
		        	'regex_match' => '{field} tidak valid.'
		        )
			),
			array(
				'field' => 'user_password',
		        'label' => 'Password',
		        'rules' => 'regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/]|required',
		        'errors'=> array(
		        	'required' => '{field} harus diisi.',
                    'regex_match' => '{field} harus terdiri dari Uppercase, Lowercase, Numerik, dan Simbol 8-16 karakter.'
                )
			),
			array(
				'field' => 'repeat_password',
		        'label' => 'Repeat Password',
		        'rules' => 'required|matches[user_password]',
		        'errors'=> array(
		        	'required' => '{field} harus diisi.',
                    'matches' => '{field} tidak cocok.'
                )
			)
		);
		return $rules;
	}
}