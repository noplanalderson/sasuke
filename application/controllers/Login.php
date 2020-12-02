<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Sasuke
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('login_m');
		$this->access_control->is_login();
	}

	public function auth()
	{
		if(isset($_POST['submit']))
		{
			$this->form = $this->input->post(null, TRUE);
			
			$form_rules = [
		        ['field' => 'user_name',
		         'label' => 'User Name',
		         'rules' => 'trim|required|regex_match[/^[a-zA-Z0-9.-_@]+$/]',
		         'errors'=> array('required' => '{field} required', 
		                    'regex_match' => '{field} only allowed alfa numeric, dash, @, and underscore')
		        ],
		        ['field' => 'user_password',
		         'label' => 'Password',
		         'rules' => 'trim|required',
		         'errors'=> array('required' => '{field} required')
		        ]
		    ];

			$this->form_validation->set_rules($form_rules);

			if ($this->form_validation->run() == TRUE)
			{
				$query = $this->login_m->verify($this->form['user_name']);

				if($query->num_rows() == 1)
				{
					$user = $query->row();
					if(password_verify($this->form['user_password'], $user->user_password)) :
				
					$now = new DateTime();
					$now->setTimezone(new DateTimeZone('Asia/Jakarta'));

					$sessionLogin = array(  
						'uid' 	=> $user->id_user,
						'gid' 	=> $user->id_type,
						'time'	=> strtotime($now->format('Y-m-d H:i:s')),
					);

					$this->session->set_userdata($sessionLogin);

					$status = 1;
					$this->msg = 'Login Berhasil. Tunggu sebentar...';
					// redirect('dashboard');

					else:

						$status = 0;
						$this->msg = 'Login Gagal. Password Salah!';
					endif;
				}
				else
				{
					$status = 0;
					$this->msg = 'Login Gagal. Username tidak terdaftar atau belum diaktivasi!';
				}
			}
			else
			{
				$status = 0;
				$this->msg = validation_errors();
			}

			$token = $this->security->get_csrf_hash();
			$result = array('result' => $status, 'msg' => $this->msg, 'token' => $token);
			echo json_encode($result);
		}
		else
		{
			redirect('login');
		}
	}

	public function index()
	{
		$data = array(
			'form' 	=> $this->form,
			'msg' 	=> $this->msg,
			'script'=> '',
			'title'	=> $this->site['judul_app'] . ' - Login'
		);

		$view = array(
			'partial/head',
			'login',
			'partial/script'
		);

		Sasuke::view($view, $data);
	}
}

/* End of file dashboard.php */
/* Location: ./application/controllers/dashboard.php */