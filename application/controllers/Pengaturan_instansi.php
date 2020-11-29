<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengaturan_instansi extends Sasuke {

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		$this->access_control->check_role();
	}

	public function index()
	{
		$data = array(
			'title' 	=> $this->site['judul_app_alt'] . ' - Pengaturan Instansi',
			'script' 	=> $this->load->view('script/instansi', NULL, TRUE),
			'instansi'	=> $this->instansi
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'instansi',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
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
			),
			array(
				'field' => 'logo_kop_instansi',
				'label' => 'Logo Kop Instansi (old)',
				'rules' => 'trim|regex_match[/[a-zA-Z0-9\/\-_.]+$/]|max_length[255]',
				'errors'=> [
					'regex_match' => '{field} hanya boleh mengandung karakter [a-zA-Z0-9\/\-_.].',
					'max_length' => 'Panjang {field} maksimal {param} karakater.'
				]
			)
		);

		return $rules;
	}

	public function submit()
	{
		$post = $this->input->post(null, true);

		$this->form_validation->set_rules($this->_rulesInstansi());

		if ($this->form_validation->run() == TRUE) 
		{
			if(!empty($_FILES['logo_kop_instansi']['name']))
			{
				// Get Image's filename without extension
				$filename = pathinfo($_FILES['logo_kop_instansi']['name'], PATHINFO_FILENAME);

				// Remove another character except alphanumeric, space, dash, and underscore in filename
				$filename = preg_replace("/[^a-zA-Z0-9 \-_]+/i", '', $filename);

				// Remove space in filename
				$filename = str_replace(' ', '-', $filename);

				$config = array(
					'form_name' => 'logo_kop_instansi', // Form upload's name
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
					$data_kop = $this->secure_upload->data();
					$kop_app = 'sites/'.$data_kop['file_name'];
				}
			}
			else
			{
				$kop_app = $post['logo_kop_instansi'];	
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
			
			if($this->site_m->updateInstansi($instansi) == true)
			{
				$status = 1;
				$msg = 'Pengaturan Instansi Berhasil.';
			}
			else
			{
				$status = 0;
				$msg = 'Pengaturan Instansi Gagal.';
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
}

/* End of file app_setting.php */
/* Location: ./application/controllers/app_setting.php */