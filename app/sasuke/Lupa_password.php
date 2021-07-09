<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa_password extends SASUKE_Core 
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

	public function index()
	{	
		$this->js 		= 'lupa_password';
		$this->_module 	= 'account/lupa-password';
		
		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - Lupa Password'
		);

		$this->load_view();
	}

	public function submit()
	{
		$post = $this->input->post(null, TRUE);

		$this->form_validation->set_rules(
			'user_email', 
			'Email', 
			'trim|required|valid_email', 
			array(
				'required' => 'Email wajib diisi', 
				'valid_email' => 'Email harus valid'
			)
		);

		if ($this->form_validation->run() === TRUE) 
		{
			$status = 0; 
			$user 	= $this->akun_m->cekUser($post['user_email']);
			
			if($user->num_rows() == 1)
			{
				$plain_text = hash('gost', random_string('alnum', 8));

				$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
				
				$this->session->set_tempdata('key', base64_encode($key), 3600);

				$cipher = hash_generator($plain_text, $key);

				$status = ($this->akun_m->kodePemulihan($post['user_email'], $plain_text) === TRUE) ? 1 : 0;
				$msg 	= ($status == 1) ? 'Link Reset Password telah dikirim ke email anda.' : 'Gagal Membuat Link Reset Password.';

				if($status == 1)
				{
					$from = $this->config->item('smtp_user');

			        $this->email->set_newline("\r\n");
			        $this->email->from($from, 'Sistem Aplikasi Surat Kematian [SASUKE]');
			        $this->email->to($post['user_email']);
			        $this->email->subject("PEMBERITAHUAN RESET PASSWORD AKUN SISTEM APLIKASI SURAT KEMATIAN.");
			        $this->email->message("Berikut adalah link reset password Akun SASUKE Anda.\n\n\n".base_url('reset/'.base64url_encode($cipher))."\n\nJangan membagikan link ini dengan siapa pun.\n\n\n- Admin");
			        $this->email->send();
				}
			}
			else
			{
				$msg = 'Email tidak terdaftar.';
			}
		} 
		else 
		{
			$msg = validation_errors();
		}

		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		echo json_encode($result);
	}

	public function reset($link = NULL)
	{
		if(empty($link)) show_error(
			'Halaman tidak ditemukan. Hubungi administrator anda jika anda merasa ini merupakan sebuah kesalahan.', 
			200,
			'Halaman Kadaluarsa',
		);

		$tmp_key = $this->session->tempdata('key');

		if(empty($tmp_key)) 
		{
			show_error(
				'Halaman sudah tidak berlaku atau sudah kadaluarsa.', 
				200,
				'Halaman Kadaluarsa',
			);
		}
		else
		{
			$key_session = base64_decode($tmp_key);
			$link = base64url_decode($link);
			$kode = hash_unbox($link, $key_session);

			if($this->akun_m->cekKodePemulihan($kode) == 0) 
			{
				show_error(
					'Halaman sudah tidak berlaku atau sudah kadaluarsa.', 
					'Halaman Kadaluarsa', 
					'Halaman Kadaluarsa', 200
				);
			}
			else
			{
				$this->js 		= ['reset_password', 'show_pwd'];
				$this->_module 	= 'account/set-password';

				$this->_data 	= array(
					'title' 	=> $this->app->judul_app_alt . ' - Atur Ulang Password',
					'kode' 		=> $kode
				);

				$this->load_view();
			}
		}
	}

	public function submit_pwd()
	{
		$status = 0;
		$kode 	= $this->input->post('kode', TRUE);
		$pwd 	= $this->input->post('user_password', TRUE);
		
		$this->form_validation->set_rules($this->_rulesPassword());

		if ($this->form_validation->run() === TRUE) 
		{	
			$status 	= ($this->akun_m->updatePassword($kode, passwordHash($pwd,[
							'memory_cost' => 2048, 
							'time_cost' => 4, 
							'threads' => 1
						])) == TRUE) ? 1 : 0;
			$msg 		= ($status == 1) ? 'Berhasil Mengatur Ulang Password.' : 'Gagal Mengatur Ulang Password.';
			
			if($status == 1) $this->session->unset_userdata('key');
		} 
		else 
		{
			$msg = validation_errors();
		}

		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		echo json_encode($result);
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

/* End of file lupa_password.php */
/* Location: ./application/controllers/lupa_password.php */