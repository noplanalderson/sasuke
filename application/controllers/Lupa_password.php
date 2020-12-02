<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lupa_password extends Sasuke 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('akun_m');
	}

	public function index()
	{
		if(isset($_POST['submit']))
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

			if ($this->form_validation->run() == TRUE) 
			{
				$user = $this->akun_m->cekUser($post['user_email']);
				
				if($user->num_rows() == 1)
				{
					$plain_text = hash('gost', random_string('alnum', 8));

					$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
					
					$this->session->set_tempdata('key', base64_encode($key), 300);

					$cipher = hash_generator($plain_text, $key);

					if($this->akun_m->kodePemulihan($post['user_email'], $plain_text))
					{
						$from = $this->config->item('smtp_user');

				        $this->email->set_newline("\r\n");
				        $this->email->from($from);
				        $this->email->to($post['user_email']);
				        $this->email->subject("PEMBERITAHUAN RESET PASSWORD AKUN SISTEM APLIKASI SURAT KEMATIAN.");
				        $this->email->message("Assalaamu'alaikum wa Rahmatullahi wa Barakaatuh\n Kepada Yth. \n".$post['user_email']."\n\nBerikut adalah link reset password Akun SASUKE Anda.\n\n\n".base_url('reset/'.base64url_encode($cipher))."\n\nJangan membagikan link ini dengan siapa pun.\n\n\nWassalaamu'alaikum wa Rahmatullahi wa Barakaatuh\n\n\n\n\n\n\n- Admin");
				        $this->email->send();

						$status = 1;
						$msg = 'Link Reset Password telah dikirim ke email anda';
					}
					else
					{
						$status = 0;
						$msg = 'Gagal Membuat Link Reset Password';
					}
				}
				else
				{
					$status = 0;
					$msg = 'Email tidak terdaftar';
				}
			} else {
				$status = 0;
				$msg = validation_errors();
			}

			$token = $this->security->get_csrf_hash();
			$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
			echo json_encode($result);
		}
		else
		{
			$data = array(
				'title' => $this->site['judul_app_alt'] . ' - Lupa Password',
				'script' => $this->load->view('script/script-lupa', NULL, TRUE)
			);

			$view = array(
				'partial/head',
				'lupa-password',
				'partial/script'
			);

			Sasuke::view($view, $data);
		}
	}

	public function reset($link = NULL)
	{
		if(empty($link)) show_error(
			'Halaman tidak ditemukan. Hubungi administrator anda jika anda merasa ini merupakan seebuah kesalahan.', 
			'Halaman Kadaluarsa', 
			'Halaman Kadaluarsa', 200
		);

		$key_session = base64_decode($this->session->tempdata('key'));
		if(empty($key_session)) show_error(
			'Halaman sudah tidak berlaku atau sudah kadaluarsa.', 
			'Halaman Kadaluarsa', 
			'Halaman Kadaluarsa', 200
		);

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
			if(isset($_POST['submit']))
			{
				$pwd = $this->input->post('user_password', TRUE);
				$this->form_validation->set_rules($this->_rulesPassword());

				if ($this->form_validation->run() == TRUE) {
					if($this->akun_m->updatePassword($kode, passwordHash($pwd)))
					{
						$this->session->unset_userdata('key');
						
						$status = 1;
						$msg = 'Berhasil Mengatur Ulang Password';
					}
					else
					{
						$status = 0;
						$msg = 'Gagal Mengatur Ulang Password';
					}
				} else {
					$status = 0;
					$msg = validation_errors();
				}

				$token = $this->security->get_csrf_hash();
				$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
				echo json_encode($result);
			}
			else
			{
				$data = array(
					'title' => $this->site['judul_app_alt'] . ' - Atur Ulang Password',
					'script' => $this->load->view('script/script-lupa', NULL, TRUE)
				);

				$view = array(
					'partial/head',
					'set-password',
					'partial/script'
				);

				Sasuke::view($view, $data);
			}
		}
	}

	private function _rulesPassword()
	{
		$rules = array(
			array(
				'field' => 'user_password',
		        'label' => 'Password',
		        'rules' => 'regex_match[/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?!.* )(?=.*[^a-zA-Z0-9]).{8,16}$/]|required',
		        'errors'=> array('required' => '{field} required',
                    'regex_match' => '{field} harus terdiri dari Uppercase, Lowercase, Numerik, dan Simbol 8-16 karakter.'
                )
			),
			array(
				'field' => 'repeat_password',
		        'label' => 'Repeat Password',
		        'rules' => 'required|matches[user_password]',
		        'errors'=> array(
		        	'required' => '{field} required',
                    'equal_to' => '{field} tidak cocok.'
                )
			)
		);
		return $rules;
	}
}

/* End of file lupa_password.php */
/* Location: ./application/controllers/lupa_password.php */