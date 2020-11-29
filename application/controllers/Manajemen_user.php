<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_user extends Sasuke {

	public $form_user = array(
		'user_name' => '',
		'user_email'=> '',
		'id_type'	=> '',
		'user_picture' => '',
		'is_active' => ''
	);

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		$this->access_control->check_role();

		$this->load->model('user_m');
	}

	public function index()
	{
		$data = array(
			'title' 	=> $this->site['judul_app_alt'] . ' - Manajemen User',
			'script' 	=> '',
			'users' 	=> $this->user_m->getAllUsers(),
			'btn_add' 	=> $this->site_m->getContentMenu('tambah-user'),
			'btn_edit' 	=> $this->site_m->getContentMenu('edit-user'),
			'btn_del' 	=> $this->site_m->getContentMenu('hapus-user')
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'manajemen-user',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
	}

	public function tambah()
	{
		if(isset($_POST['submit']))
		{
			$this->form_user = $this->input->post(null, TRUE);

			$this->form_validation->set_rules($this->rules());
			
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
					'width' => 600, // New Image's width. Default : 800px
					'height' => 600, // New Image's Height. Default : 600px
					'cleared_path' => FCPATH . 'assets/uploads/user_img/'.$this->form_user['user_name'] // New Image's Location after clearing. Default : FCPATH . 'uploads/cleared'
				);

				// Load Library
				$this->load->library('secure_upload');

				// Send library configuration
				$this->secure_upload->initialize($config);

				// Run Library
				if($this->secure_upload->doUpload())
				{
					// Get Image(s) Data
					$data_picture = $this->secure_upload->data();
					$user_picture = $this->form_user['user_name'].'/'.$data_picture['file_name'];

					$plainText = random_char(8);
			    	
			    	$from = $this->config->item('smtp_user');

			        $this->email->set_newline("\r\n");
			        $this->email->from($from);
			        $this->email->to($this->form_user['user_email']);
			        $this->email->subject("PEMBERITAHUAN AKTIVASI AKUN SISTEM APLIKASI SURAT KEMATIAN.");
			        $this->email->message("Assalaamu'alaikum wa Rahmatullahi wa Barakaatuh\n Kepada Yth.".$this->form_user['user_email']."\n\nBerikut adalah akses Akun SASUKE Anda.\n\n\nUsername : ".$this->form_user['user_name']."\nPassword : ".$plainText."\n\nIngat baik-baik password anda dan jangan tulis password anda atau beritahu kepada siapapun.\nGanti password secara berkala dan gunakan kombinasi Huruf Besar, Huruf Kecil, Angka, dan Simbol.\n\n\nWassalaamu'alaikum wa Rahmatullahi wa Barakaatuh\n\n\n\n\n\n\n- Admin");
			        $this->email->send();

					$data = array_merge(
						$this->form_user,
						array('user_picture' => $user_picture),
						array('user_password' => password_hash($plainText, PASSWORD_ARGON2ID))
					);

					if($this->user_m->tambahUser($data))
					{
						$this->msg = '<div class="alert alert-success" role="alert">User berhasil ditambahkan.</div>';
					}
					else
					{
						$this->msg = '<div class="alert alert-danger" role="alert">Gagal menambahkan user.</div>';
					}
				}
				else
				{
					// Get Image(s) Error if Failure on Uploading Image
					$this->msg = '<div class="alert alert-danger" role="alert">'.$this->secure_upload->show_errors().'</div>';
				}
			} else {
				$this->msg = '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
			}
		}

		$data = array(
			'title' 	=> $this->site['judul_app_alt']. ' - Tambah User',
			'script' 	=> '',
			'user_type' => $this->user_m->getUserType(),
			'form_value'=> $this->form_user,
			'messages'	=> $this->msg
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'tambah-user',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
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
				'rules' => 'regex_match[/(TRUE)/]',
				'errors'=> [
					'regex_match' => '{field} harus bernilai TRUE atau FALSE.'
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

	public function edit($id = NULL)
	{
		$user = $this->user_m->getUserByID($id);

		if(empty($user)) show_404();

		if(isset($_POST['submit']))
		{
			$this->form_user = $this->input->post(null, TRUE);

			$this->form_validation->set_rules($this->rules());
			
			if ($this->form_validation->run() == TRUE) 
			{	
				if($this->user_m->checkUser($this->form_user['user_name'], $this->form_user['user_email'], 'edit', $id) === 0)
				{
					if(!empty($_FILES['user_picture']['name']))
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
							'width' => 600, // New Image's width. Default : 800px
							'height' => 600, // New Image's Height. Default : 600px
							'cleared_path' => FCPATH . 'assets/uploads/user_img/'.$this->form_user['user_name'] // New Image's Location after clearing. Default : FCPATH . 'uploads/cleared'
						);

						// Load Library
						$this->load->library('secure_upload');

						// Send library configuration
						$this->secure_upload->initialize($config);

						// Run Library
						if($this->secure_upload->doUpload())
						{
							// Get Image(s) Data
							$data_picture = $this->secure_upload->data();
							$user_picture = $this->form_user['user_name'].'/'.$data_picture['file_name'];
						}
					}
					else
					{
						$user_picture = $this->form_user['user_picture_old'];
					}

					$plainText = random_char(8);
			    	
			    	$from = $this->config->item('smtp_user');

			        $this->email->set_newline("\r\n");
			        $this->email->from($from);
			        $this->email->to($this->form_user['user_email']);
			        $this->email->subject("PEMBERITAHUAN PERUBAHAN AKUN SISTEM APLIKASI SURAT KEMATIAN.");
			        $this->email->message("Assalaamu'alaikum wa Rahmatullahi wa Barakaatuh\n Kepada Yth.".$this->form_user['user_email']."\n\nBerikut adalah akses Akun SASUKE Anda yang baru.\n\n\nUsername : ".$this->form_user['user_name']."\nPassword : ".$plainText."\n\nIngat baik-baik password anda dan jangan tulis password anda atau beritahu kepada siapapun.\nGanti password secara berkala dan gunakan kombinasi Huruf Besar, Huruf Kecil, Angka, dan Simbol.\n\n\nWassalaamu'alaikum wa Rahmatullahi wa Barakaatuh\n\n\n\n\n\n\n- Admin");
			        $this->email->send();

					$data = array_merge(
						$this->form_user,
						array('user_picture' => $user_picture),
						array('user_password' => password_hash($plainText, PASSWORD_ARGON2ID))
					);

					if($this->user_m->editUser($data, $id))
					{
						$this->msg = '<div class="alert alert-success" role="alert">User berhasil diubah.</div>';
					}
					else
					{
						$this->msg = '<div class="alert alert-danger" role="alert">Gagal merubah user.</div>';
					}
				}
				else
				{
					$this->msg = '<div class="alert alert-danger" role="alert">Username atau Email sudah ada.</div>';
				}
			} else {
				$this->msg = '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
			}
		}

		$data = array(
			'title' 	=> $this->site['judul_app_alt']. ' - Edit User',
			'script' 	=> $this->load->view('script/tambah-user', NULL, TRUE),
			'user_type' => $this->user_m->getUserType(),
			'form_value'=> $user,
			'messages'	=> $this->msg
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'tambah-user',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
	}

	public function hapus($id = NULL)
	{
		if(!verify($id)) show_404();

		if($this->user_m->hapusUser($id)) {
			$msg = '<div class="alert alert-success" role="alert">User berhasil dihapus.</div>';
		}
		else
		{
			$msg = '<div class="alert alert-danger" role="alert">Gagal menghapus user.</div>';
		}

		$this->session->set_flashdata('message', $msg);
		redirect('manajemen-user');
	}
}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */