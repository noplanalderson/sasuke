<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_setting extends SASUKE_Core {

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
			'select2/css/select2.min'
		);

		$this->js_plugin  = array(
			'bootstrap/js/bootstrap.bundle.min',
			'select2/js/select2.min'
		);
	}

	private function _rules()
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
				'rules' => 'trim|required|min_length[5]|max_length[80]|regex_match[/[a-zA-Z0-9 \-_]+$/]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
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
				'field' => 'logo_app',
				'label' => 'Logo App',
				'rules' => 'trim|regex_match[/[a-zA-Z0-9\/\-_.]+$/]|max_length[255]',
				'errors'=> [
					'regex_match' => '{field} hanya boleh mengandung karakter [a-zA-Z0-9\/\-_.].',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			),
			array(
				'field' => 'icon_app',
				'label' => 'Icon App',
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
		$this->_module 	= 'settings/app-setting';
		
		$this->js 		= 'app_setting';
		
		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - Pengaturan Aplikasi'
		);

		$this->load_view();
	}

	public function submit()
	{
		$status  = 0;
		$setting = $this->input->post(null, TRUE);

		$this->form_validation->set_rules($this->_rules());

		if ($this->form_validation->run() == TRUE) {
			
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
					$data_logo 	= $this->secure_upload->data();
					$logo_app 	= $data_logo['file_name'];
				}
			}
			else
			{
				$logo_app = $setting['logo_app'];
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
					$data_icon 	= $this->secure_upload->data();
					$icon_app 	= $data_icon['file_name'];
				}
			}
			else
			{
				$icon_app = $setting['icon_app'];
			}

			$settings = array_replace($setting, array('logo_app' => $logo_app, 'icon_app' => $icon_app));

			$status = ($this->app_m->updateSetting($settings) === true) ? 1 : 0;
			$msg 	= ($status === 1) ? 'Pengaturan berhasil diubah.' : 'Gagal mengubah pengaturan.';

			if($status === 1) $this->cache->delete('sasuke_setting');
		} 
		else 
		{
			$msg = validation_errors();
		}

		$token 	= $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		$this->output->set_content_type('application/json')->set_output(json_encode($result)); 
	}
}

/* End of file app_setting.php */
/* Location: ./application/controllers/app_setting.php */