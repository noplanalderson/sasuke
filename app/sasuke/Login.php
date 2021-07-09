<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends SASUKE_Core
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

		$this->load->model('login_m');

		$this->css_plugin 	= 'fontawesome-free/css/all.min';

		$this->js_plugin 	= 'bootstrap/js/bootstrap.bundle.min';
		
		$this->js = 'login';
	}

	public function index()
	{
		$this->_module 		= 'account/login';

		$this->_data 		= array(
			'title' 		=> $this->app->judul_app_alt . ' - Login'
		);

		$this->load_view();
	}

	public function auth()
	{
		$status = 0;
		$post 	= $this->input->post(null, TRUE);
		
		$form_rules = [
	        ['field' => 'user_name',
	         'label' => 'User Name',
	         'rules' => 'trim|required|regex_match[/^[a-zA-Z0-9.\-_@]+$/]',
	         'errors'=> array('regex_match' => '{field} only allowed alfa numeric, dash, @, and underscore')
	        ],
	        ['field' => 'user_password',
	         'label' => 'Password',
	         'rules' => 'trim|required'
	        ]
	    ];

		$this->form_validation->set_rules($form_rules);

		if ($this->form_validation->run() === TRUE)
		{
			$query = $this->login_m->verify($post['user_name']);

			if($query->num_rows() == 1)
			{
				$user 	= $query->row();
				$status = password_verify($post['user_password'], $user->user_password) ? 1 : 0;
				$msg 	= ($status == 1) ? 'Login Berhasil. Tunggu sebentar...' : 'Login Gagal. Password Salah!';
				
				if($status == 1)
				{
					$now = new DateTime();
					$now->setTimezone(new DateTimeZone('Asia/Jakarta'));

					$sessionLogin = array(  
						'uid' 	=> $user->id_user,
						'gid' 	=> $user->id_type,
						'time'	=> strtotime($now->format('Y-m-d H:i:s')),
					);

					$this->session->set_userdata($sessionLogin);
				}
			}
			else
			{
				$msg = 'Login Gagal. Username tidak terdaftar atau belum diaktivasi!';
			}
		}
		else
		{
			$msg = validation_errors();
		}

		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token, 'url' => $this->index_page);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */