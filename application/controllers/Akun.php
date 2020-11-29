<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akun extends Sasuke {

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		
		$this->load->model('akun_m');
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

	private function _rulesAkun()
	{
		$rules = array(
			array(
				'field' => 'user_name',
				'label' => 'Username',
				'rules'	=> 'trim|required|regex_match[/[a-zA-Z0-9_]+$/]|min_length[3]|max_length[100]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} hanya boleh mengandung karakter alfanumeric dan underscore.',
					'min_length' => 'Panjang {field} minimal {param} karakater.',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			),
			array(
				'field' => 'user_email',
				'label' => 'Email',
				'rules'	=> 'trim|required|valid_email|max_length[100]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} hanya boleh mengandung karakter alfanumeric dan underscore.',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			),
			array(
				'field' => 'user_picture_old',
				'label' => 'Old User Picture',
				'rules' => 'trim|regex_match[/[a-zA-Z0-9\/\-_.]+$/]|max_length[255]',
				'errors'=> [
					'regex_match' => '{field} hanya boleh mengandung karakter [a-zA-Z0-9\/\-_.].',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			)
		);
		return $rules;
	}

	public function index()
	{
		$post = $this->input->post(null, TRUE);

		$this->form_validation->set_rules($this->_rulesAkun());

		if ($this->form_validation->run() == TRUE)
		{
			// Get Image's filename without extension
			$filename = pathinfo($_FILES['user_picture']['name'], PATHINFO_FILENAME);

			// Remove another character except alphanumeric, space, dash, and underscore in filename
			$filename = preg_replace("/[^a-zA-Z0-9 \-_]+/i", '', $filename);

			// Remove space in filename
			$filename = str_replace(' ', '-', $filename);

			$config = array(
				'form_name' => 'user_picture', // Form upload's name
				'upload_path' => FCPATH . 'assets/uploads/user_img', // Upload Directory. Default : ./uploads
				'allowed_types' => 'png|jpg|jpeg|webp', // Allowed Extension
				'max_size' => '5128', // Maximun image size. Default : 5120
				'detect_mime' => TRUE, // Detect image mime. TRUE|FALSE
				'file_ext_tolower' => TRUE, // Force extension to lower. TRUE|FALSE
				'overwrite' => TRUE, // Overwrite file. TRUE|FALSE
				'enable_salt' => TRUE, // Enable salt for image's filename. TRUE|FALSE
				'file_name' => $filename, // New Image's Filename
				'extension' => 'webp', // New Imaage's Extension. Default : webp
				'quality' => '100%', // New Image's Quality. Default : 95%
				'maintain_ratio' => TRUE, // Maintain image's dimension ratio. TRUE|FALSE
				'width' => 500, // New Image's width. Default : 800px
				'height' => 500, // New Image's Height. Default : 600px
				'cleared_path' => FCPATH . 'assets/uploads/user_img/'.$post['user_name']
			);

			// Load Library
			$this->load->library('secure_upload');

			// Send library configuration
			$this->secure_upload->initialize($config);

			// Run Library
			if($this->secure_upload->doUpload())
			{
				// Get Image(s) Data
				$picture = $this->secure_upload->data();
				$user_picture = $post['user_name'].'/'.$picture['file_name'];
			}
			else
			{
				$status = 0;
				$msg = $this->secure_upload->show_errors();
				$user_picture = $post['user_picture_old'];
			}

			$dataAkun = array_merge($post, array('user_picture' => $user_picture));

			if($this->akun_m->ubahAkun($dataAkun)){
				$status = 1;
				$msg = 'Pengaturan Akun berhasil.';
			}
			else{
				$status = 0;
				$msg = 'Pengaturan Akun Gagal.';
			}
		}
		else
		{
			$status = 0;
			$msg = validation_errors();
		}
		
		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		echo json_encode($result);
	}

	public function ganti_password()
	{
		$post = $this->input->post(null, TRUE);

		$this->form_validation->set_rules($this->_rulesPassword());

		if ($this->form_validation->run() == TRUE)
		{		
			if($this->akun_m->ubahPassword($post['user_password'])){
				$status = 1;
				$msg = 'Password berhasil diubah.';
			}
			else{
				$status = 0;
				$msg = 'Gagal mengubah password.';
			}
		}
		else
		{
			$status = 0;
			$msg = validation_errors();
		}
		
		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		echo json_encode($result);
	}

	public function get_akun()
	{
		echo json_encode($this->akun_m->getAkun());
	}
}