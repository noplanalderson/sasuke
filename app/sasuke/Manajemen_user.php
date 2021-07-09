<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_user extends SASUKE_Core {

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

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'select2/css/select2.min',
			'datatables/datatables.min'
		);

		$this->js_plugin  = array(
			'bootstrap/js/bootstrap.bundle.min',
			'select2/js/select2.min',
			'datatables/datatables.min'
		);

		$this->load->model('user_m');
	}

	public function index()
	{
		$this->_module 	= 'user/manajemen-user';
		
		$this->js 		= 'manajemen_user';
		
		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - Manajemen User',
			'users' 	=> $this->user_m->getAllUsers(),
			'user_type' => $this->user_m->getUserType(),
			'btn_add' 	=> $this->app_m->getContentMenu('tambah-user'),
			'btn_edit' 	=> $this->app_m->getContentMenu('edit-user'),
			'btn_del' 	=> $this->app_m->getContentMenu('hapus-user'),
			'btn_status'=> $this->app_m->getContentMenu('status-user')
		);

		$this->load_view();
	}
	
	public function get_user()
	{
		$post = $this->input->post(null, TRUE);
		
		if( ! verify($post['id'])) :
			return false;
		else :
			$token 	= array('token' => $this->security->get_csrf_hash());
			$data 	= $this->user_m->getUserByID($post['id']);
			$result	= array_merge($token, $data);
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
		endif;
	}

	public function tambah()
	{
		$status = 0;
		$post 	= $this->input->post(null, TRUE);

		$this->form_validation->set_rules($this->rules());
		
		if ($this->form_validation->run() == TRUE) 
		{	
			if($this->user_m->checkUser($post['user_name'], $post['user_email'], 'tambah') == 0)
			{
				$userSetting = array(
					'user_name' => $post['user_name'],
					'user_password' => '',
					'nama_pegawai' => ucwords($post['nama_pegawai']),
					'nip' => empty($post['nip']) ? NULL : $post['nip'],
					'user_email' => strtolower($post['user_email']),
					'id_type' => $post['id_type'],
					'user_token' => base64url_encode(openssl_random_pseudo_bytes(64)),
					'user_picture' => 'user.png'
				);

				$user = $this->user_m->tambahUser($userSetting);
				
				$status = ($user !== false) ? 1 : 0;

				if($status !== 0) {

					$userDir 	= FCPATH . '_/uploads/user_img/'.encrypt($user).'/';
					$assetDir 	= FCPATH . '_/uploads/user_img/';

					if (!is_dir($userDir)) mkdir($userDir, 0755, true);

					copy($assetDir . 'user.png', $userDir . 'user.png');

					$from = $this->config->item('smtp_user');
					$this->load->library('email');
					
					$this->email->from($from, 'Sistem Aplikasi Surat Kematian [SASUKE]');
					$this->email->to($userSetting['user_email']);
					
					$this->email->subject('SASUKE - Aktivasi Akun');
					$this->email->message("Email anda telah terdaftar pada Aplikasi SASUKE. Silakan aktivasi akun anda dengan mengunjungi tautan berikut.\n\n" . base_url('aktivasi/'.$userSetting['user_token']));
					
					$this->email->send();
				}

				$msg = ($status === 1) ? 'User berhasil ditambahkan.' : 'User gagal ditambahkan.';
			}
			else
			{
				$msg = 'User sudah Terdaftar';
			}
		} 
		else 
		{
			$msg = validation_errors();
		}

		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	private function rules()
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
				'field' => 'nama_pegawai',
				'label' => 'Nama Pegawai',
				'rules'	=> 'trim|required|regex_match[/[a-zA-Z .,]+$/]|max_length[255]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} hanya boleh mengandung huruf, spasi, titik, dan koma.',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			),
			array(
				'field' => 'nip',
				'label' => 'NIP',
				'rules'	=> 'integer|exact_length[18]',
				'errors'=> [
					'integer' => '{field} harus angka.',
					'exact_length' => 'Panjang {field} harus {param} karakater.'
				]
			),
			array(
				'field' => 'id_type',
				'label' => 'Tipe User',
				'rules' => 'required|integer|max_length[3]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'integer' => '{field} harus integer.',
					'max_length' => 'Panjang {field} maksimal {param} karakter.'
				]
			),
			array(
				'field' => 'is_active',
				'label' => 'Status User',
				'rules' => 'regex_match[/(true|false)$/]',
				'errors'=> [
					'regex_match' => '{field} harus bernilai TRUE atau FALSE.'
				]
			)
		);

		return $rules;
	}

	public function edit()
	{
		$status = 0;
		
		if(isset($_POST['user_name']))
		{
			$post = $this->input->post(null, TRUE);

			$user = $this->user_m->getUserByID($post['id_user']);

			if(empty($user)) 
			{
				$msg = 'User tidak Ditemukan.';
			}
			else
			{
				$this->form_validation->set_rules($this->rules());
				
				if ($this->form_validation->run() == TRUE) 
				{	
					if($this->user_m->checkUser($post['user_name'], $post['user_email'], 'edit', $post['id_user']) == 0)
					{

						$userSetting = array(
							'user_name' => $post['user_name'],
							'nama_pegawai' => ucwords($post['nama_pegawai']),
							'nip' => empty($post['nip']) ? NULL : $post['nip'],
							'user_email' => strtolower($post['user_email']),
							'id_type' => $post['id_type'],
							'is_active' => $post['is_active']
						);

						$status = ($this->user_m->editUser($userSetting, $post['id_user']) === true) ? 1 : 0;
						$msg 	= ($status === 1) ? 'User berhasil diubah.' : 'User gagal diubah.';
					}
					else
					{
						$msg = 'User sudah Terdaftar';
					}
				} 
				else 
				{
					$msg = validation_errors();
				}
			}
		}
		else
		{
			$msg = 'Method not Allowed.';
		}


		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function hapus()
	{
		$status = 0;
		$hash = $this->input->post('id', TRUE);
		
		if( ! isset($hash) || (verify($hash) === false))
		{
			$msg = 'User tidak ditemukan.';
		}
		else
		{
			if($this->user_m->hapusUser($hash))
			{
				remove_dir('./_/uploads/user_img/'.$hash);	
				$status = 1;
			}

			$msg = ($status === 1) ? 'User Berhasil Dihapus.' : 'Gagal Menghapus User.';
		}

		$token 	= $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */