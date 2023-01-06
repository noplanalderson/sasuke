<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Konfigurasi extends SASUKE_Config {

	protected $app = array();

	protected $instansi = array();

	public $smtp = array();

	public function __construct()
	{
		parent::__construct();
		$this->load->model('config_m');

		$this->app = $this->app_m->getAppSetting();
		$this->instansi = $this->app_m->getInstansi();

		if(file_exists(APPPATH . 'config/email.php')) {
			include APPPATH . 'config/email.php';

			if(is_array($config) && 
				array_key_exists('protocol', $config) && 
				array_key_exists('smtp_host', $config) && 
				array_key_exists('smtp_user', $config) &&
				array_key_exists('smtp_port', $config) && 
				array_key_exists('smtp_pass', $config)) 
			{
				$this->smtp = $config;
			}
		}
	}

	public function index()
	{
		if(!empty($this->app)) redirect('konfigurasi/instansi');

		$view = array('config/app');
		SASUKE_Config::view($view);
	}

	private function _rulesApp()
	{
		$rules = array(
			array(
				'field' => 'judul_app',
				'label' => 'Judul Aplikasi',
				'rules' => 'trim|required|min_length[5]|max_length[255]|regex_match[/[a-zA-Z0-9 \-_]+$/]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'min_length' => 'Panjang minimal {field} {param} karakter',
					'max_length' => 'Panjang maksiml {field} {param} karakter',
					'regex_match'=> '{field} hanya  boleh mengandung alfanumerik - dan _'
				)
			),
			array(
				'field' => 'judul_app_alt',
				'label' => 'Judul Aplikasi (alt)',
				'rules' => 'trim|min_length[5]|max_length[80]|regex_match[/[a-zA-Z0-9 \-_]+$/]',
				'errors'=> array(
					'min_length' => 'Panjang minimal {field} {param} karakter',
					'max_length' => 'Panjang maksiml {field} {param} karakter',
					'regex_match'=> '{field} hanya  boleh mengandung alfanumerik - dan _'
				)
			),
			array(
				'field' => 'text_footer_app',
				'label' => 'Teks Footer Aplikasi',
				'rules' => 'trim|required|min_length[5]|max_length[100]|regex_match[/[a-zA-Z0-9 @&();\-_.]+$/]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'min_length' => 'Panjang minimal {field} {param} karakter',
					'max_length' => 'Panjang maksiml {field} {param} karakter',
					'regex_match'=> '{field} hanya  boleh mengandung alfanumerik, spasi, dan [@&();\-_.]'
				)
			),
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
				'rules' => 'trim|required|max_length[255]|regex_match[/[a-zA-Z ,.]+$/]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'min_length' => 'Panjang minimal {field} {param} karakter',
					'max_length' => 'Panjang maksiml {field} {param} karakter',
					'regex_match'=> '{field} hanya  boleh mengandung huruf, titik, koma, dan spasi'
				)
			),
			array(
				'field' => 'nip',
				'label' => 'NIP',
				'rules' => 'integer|exact_length[18]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'exact_length' => 'Panjang {field} harus {param} karakter',
					'integer'=> '{field} harus angka'
				)
			),
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

	public function submit()
	{
		$status = 0;
		$post 	= $this->input->post(null, true);

		$this->form_validation->set_rules($this->_rulesApp());

		if ($this->form_validation->run() == TRUE) 
		{
			if(!empty($_FILES['logo_app']['name']))
			{
				// Get Image's filename without extension
				$filename = pathinfo($_FILES['logo_app']['name'], PATHINFO_FILENAME);

				// Remove another character except alphanumeric, space, dash, and underscore in filename
				$filename = preg_replace("/[^a-zA-Z0-9 \-_]+/i", '', $filename);

				// Remove space in filename
				$filename = str_replace(' ', '-', $filename);

				$config = array(
					'form_name' => 'logo_app', // Form upload's name
					'upload_path' => FCPATH . '_/uploads', // Upload Directory. Default : ./uploads
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
					'cleared_path' => FCPATH . '_/uploads/sites'
				);

				// Load Library
				$this->load->library('secure_upload');

				// Send library configuration
				$this->secure_upload->initialize($config);

				// Run Library
				if($this->secure_upload->doUpload())
				{
					// Get Image(s) Data
					$data_logo = $this->secure_upload->data();
					$logo_app = $data_logo['file_name'];
				}
			}
			else
			{
				$logo_app = 'logo-default.png';
			}

			if(!empty($_FILES['icon_app']['name']))
			{
				// Get Image's filename without extension
				$filename = pathinfo($_FILES['logo_app']['name'], PATHINFO_FILENAME);

				// Remove another character except alphanumeric, space, dash, and underscore in filename
				$filename = preg_replace("/[^a-zA-Z0-9 \-_]+/i", '', $filename);

				// Remove space in filename
				$filename = str_replace(' ', '-', $filename);

				$config = array(
					'form_name' => 'icon_app', // Form upload's name
					'upload_path' => FCPATH . '_/uploads', // Upload Directory. Default : ./uploads
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
					'width' => 50, // New Image's width. Default : 800px
					'height' => 50, // New Image's Height. Default : 600px
					'cleared_path' => FCPATH . '_/uploads/sites'
				);

				// Load Library
				$this->load->library('secure_upload');

				// Send library configuration
				$this->secure_upload->initialize($config);

				// Run Library
				if($this->secure_upload->doUpload())
				{
					// Get Image(s) Data
					$data_icon = $this->secure_upload->data();
					$icon_app = $data_icon['file_name'];
				}
			}
			else
			{
				$icon_app = 'logo-default.png';
			}

			$appSetting = array(
				'id_app' => 1,
				'judul_app' => ucwords($post['judul_app']),
				'judul_app_alt' => empty($post['judul_app_alt']) ? $post['judul_app'] : $post['judul_app_alt'],
				'text_footer_app' => $post['text_footer_app'],
				'logo_app' => $logo_app,
				'icon_app' => $icon_app
			);

			$userSetting = array(
				'user_name' => $post['user_name'],
				'user_password' => passwordHash($post['user_password'], [
							'memory_cost' => 2048, 
							'time_cost' => 4, 
							'threads' => 1
						]),
				'nama_pegawai' => ucwords($post['nama_pegawai']),
				'nip' => empty($post['nip']) ? NULL : $post['nip'],
				'user_email' => strtolower($post['user_email']),
				'id_type' => 1,
				'user_picture' => 'user.png',
				'is_active' => TRUE
			);
			
			if($this->config_m->appSetting($appSetting) == true)
			{
				$user = $this->config_m->addUser($userSetting);
				if($user !== false)
				{
					$userDir 	= FCPATH . '_/uploads/user_img/'.encrypt($user).'/';
					$assetDir 	= FCPATH . '_/uploads/user_img/';

					if (!is_dir($userDir)) mkdir($userDir, 0755, true);

					copy($assetDir . 'user.png', $userDir . 'user.png');

					$status = 1;
				}
				
				$msg = ($status === 1) ? 'Pengaturan Aplikasi Berhasil. Mengalihkan ke Pengaturan Instansi...' : 'Gagal Menambahkan User.';
			}
			else
			{
				$msg = 'Pengaturan Aplikasi Gagal.';
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

	public function instansi()
	{
		if(empty($this->app)) redirect('konfigurasi');
		if(!empty($this->instansi)) redirect('login');

		$view = array('config/instansi');
		SASUKE_Config::view($view);
	}

	function telp_instansi($str)
	{
		if(!preg_match("/^(?:\+62|\(0\d{2,3}\)|0)\s?(?:361|8[17]\s?\d?)?(?:[ -]?\d{3,4}){2,3}$/", $str))
		{
			$this->form_validation->set_message('telp_instansi', 'Nomor telepon tidak Valid');
			return false;
		}
		else
		{
			return true;
		}
	}

	private function _rulesInstansi()
	{
		$rules = array(
			array(
				'field' => 'kode_instansi',
				'label' => 'Kode Instansi',
				'rules' => 'trim|required|min_length[2]|max_length[10]|regex_match[/[A-Z]+$/]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'min_length' => 'Panjang minimal {field} {param} karakter',
					'max_length' => 'Panjang maksiml {field} {param} karakter',
					'regex_match'=> '{field} hanya  boleh mengandung huruf'
				)
			),
			array(
				'field' => 'nama_instansi',
				'label' => 'Nama Instansi',
				'rules' => 'trim|required|min_length[5]|max_length[255]|regex_match[/[a-zA-Z0-9 \-]+$/]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'min_length' => 'Panjang minimal {field} {param} karakter',
					'max_length' => 'Panjang maksiml {field} {param} karakter',
					'regex_match'=> '{field} hanya  boleh mengandung alfanumerik, spasi, dan dash'
				)
			),
			array(
				'field' => 'nama_instansi_alt',
				'label' => 'Nama Instansi (alt)',
				'rules' => 'trim|min_length[5]|max_length[100]|regex_match[/[a-zA-Z0-9 \-]+$/]',
				'errors'=> array(
					'min_length' => 'Panjang minimal {field} {param} karakter',
					'max_length' => 'Panjang maksiml {field} {param} karakter',
					'regex_match'=> '{field} hanya  boleh mengandung alfanumerik, spasi, dan dash'
				)
			),
			array(
				'field' => 'induk_instansi',
				'label' => 'Induk Instansi',
				'rules'	=> 'trim|required|regex_match[/[a-zA-Z0-9 ]+$/]|min_length[3]|max_length[255]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} hanya boleh mengandung karakter alfanumeric dan underscore.',
					'min_length' => 'Panjang {field} minimal {param} karakater.',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			),
			array(
				'field' => 'kota_instansi',
				'label' => 'Kota Instansi',
				'rules'	=> 'trim|required|regex_match[/[a-zA-Z ]+$/]|min_length[3]|max_length[255]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} hanya boleh mengandung karakter alfanumeric dan underscore.',
					'min_length' => 'Panjang {field} minimal {param} karakater.',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			),
			array(
				'field' => 'kota_administrasi',
				'label' => 'Kota Administrasi',
				'rules'	=> 'trim|required|regex_match[/[a-zA-Z ]+$/]|min_length[3]|max_length[255]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} hanya boleh mengandung karakter alfanumeric dan underscore.',
					'min_length' => 'Panjang {field} minimal {param} karakater.',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			),
			array(
				'field' => 'alamat_instansi',
				'label' => 'Alamat Instansi',
				'rules'	=> 'trim|required|regex_match[/[a-zA-Z0-9 @&#\/\-_.,]+$/]|min_length[3]|max_length[500]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} hanya boleh mengandung karakter [a-zA-Z0-9 @&#\/\-_.,]',
					'min_length' => 'Panjang {field} minimal {param} karakater.',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			),
			array(
				'field' => 'kode_pos_instansi',
				'label' => 'Kode Pos',
				'rules'	=> 'required|regex_match[/[0-9]+$/]|exact_length[5]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} hanya boleh mengandung angka.',
					'exact_length' => 'Panjang {field} harus {param} karakater.'
				]
			),
			array(
				'field' => 'telp_instansi',
				'label' => 'No. Telepon',
				'rules'	=> 'required|callback_telp_instansi',
				'errors'=> [
					'required' => '{field} harus diisi.'
				]
			),
			array(
				'field' => 'email_instansi',
				'label' => 'Email',
				'rules'	=> 'trim|required|valid_email|max_length[100]',
				'errors'=> [
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} hanya boleh mengandung karakter alfanumeric dan underscore.',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			)
		);

		return $rules;
	}

	public function submit_instansi()
	{
		$status = 0;
		$post 	= $this->input->post(null, true);

		$this->form_validation->set_rules($this->_rulesInstansi());

		if ($this->form_validation->run() == TRUE) 
		{
			if(!empty($_FILES['kop_instansi']['name']))
			{
				// Get Image's filename without extension
				$filename = pathinfo($_FILES['logo_kop_instansi']['name'], PATHINFO_FILENAME);

				// Remove another character except alphanumeric, space, dash, and underscore in filename
				$filename = preg_replace("/[^a-zA-Z0-9 \-_]+/i", '', $filename);

				// Remove space in filename
				$filename = str_replace(' ', '-', $filename);

				$config = array(
					'form_name' => 'kop_instansi', // Form upload's name
					'upload_path' => FCPATH . '_/uploads', // Upload Directory. Default : ./uploads
					'allowed_types' => 'png|jpg|jpeg|webp', // Allowed Extension
					'max_size' => '5128', // Maximun image size. Default : 5120
					'detect_mime' => TRUE, // Detect image mime. TRUE|FALSE
					'file_ext_tolower' => TRUE, // Force extension to lower. TRUE|FALSE
					'overwrite' => TRUE, // Overwrite file. TRUE|FALSE
					'enable_salt' => TRUE, // Enable salt for image's filename. TRUE|FALSE
					'file_name' => $filename, // New Image's Filename
					'extension' => 'webp', // New Imaage's Extension. Default : webp
					'quality' => '100%', // New Image's Quality. Default : 95%
					'cleared_path' => FCPATH . '_/uploads/sites'
				);

				// Load Library
				$this->load->library('secure_upload');

				// Send library configuration
				$this->secure_upload->initialize($config);

				// Run Library
				if($this->secure_upload->doUpload())
				{
					// Get Image(s) Data
					$data_kop = $this->secure_upload->data();
					$kop_app = $data_kop['file_name'];
				}
			}

			$instansi = array(
				'id_instansi' => 1,
				'kode_instansi' => strtoupper($post['kode_instansi']),
				'nama_instansi' => ucwords($post['nama_instansi']),
				'nama_instansi_alt' => empty($post['nama_instansi_alt']) ? ucwords($post['nama_instansi']) : ucwords($post['nama_instansi_alt']),
				'alamat_instansi' => $post['alamat_instansi'],
				'induk_instansi' => ucwords($post['induk_instansi']),
				'logo_kop_instansi' => $kop_app,
				'kota_instansi' => ucwords($post['kota_instansi']),
				'kota_administrasi' => ucwords($post['kota_administrasi']),
				'kode_pos_instansi' => $post['kode_pos_instansi'],
				'telp_instansi' => $post['telp_instansi'],
				'email_instansi' => $post['email_instansi']
			);
			
			$status = ($this->config_m->instansiSetting($instansi) == true) ? 1 : 0;
			$msg = ($status === 1) ? 'Pengaturan Instansi Berhasil. Mengalihkan ke Pengaturan SMTP...' : 'Pengaturan Instansi Gagal.';
		} 
		else 
		{
			$msg = validation_errors();
		}
		
		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}