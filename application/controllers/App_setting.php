<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App_setting extends Sasuke {

	public $setting = array(
		'judul_app' => '',
		'judul_app_alt' => '',
		'logo_app' => '',
		'icon_app' => '',
		'text_footer_app' => '',
	);

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		$this->access_control->check_role();
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
		if(isset($_POST['submit']))
		{
			$this->setting = $this->input->post(null, TRUE);

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
						'upload_path' => FCPATH . 'assets/uploads', // Upload Directory. Default : ./uploads
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
						'cleared_path' => FCPATH . 'assets/uploads/sites'
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
						$logo_app = 'sites/'.$data_logo['file_name'];
					}
				}
				else
				{
					$logo_app = $this->setting['logo_app'];
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
						'upload_path' => FCPATH . 'assets/uploads', // Upload Directory. Default : ./uploads
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
						'cleared_path' => FCPATH . 'assets/uploads/sites'
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
						$icon_app = 'sites/'.$data_icon['file_name'];
					}
				}
				else
				{
					$icon_app = $this->setting['icon_app'];
				}

				$settings = array_replace($this->setting, array('logo_app' => $logo_app, 'icon_app' => $icon_app));

				if($this->site_m->updateSetting($settings))
				{
					$this->msg = '<div class="alert alert-success" role="alert">Pengaturan berhasil diubah.</div>';
				}
				else
				{
					$this->msg = '<div class="alert alert-danger" role="alert">Gagal mengubah pengaturan.</div>';
				}

			} else {
				$this->msg = '<div class="alert alert-danger" role="alert">'.validation_errors().'</div>';
			}

			$this->session->set_flashdata('message', $this->msg);
			redirect('app-setting','refresh');
		}

		$data = array(
			'title' 	=> $this->site['judul_app_alt'] . ' - Pengaturan Aplikasi',
			'script' 	=> '',
			'form_value'=> $this->site,
			'messages'	=> $this->msg
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'app-setting',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
	}

}

/* End of file app_setting.php */
/* Location: ./application/controllers/app_setting.php */