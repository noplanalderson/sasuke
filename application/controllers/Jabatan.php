<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan extends Sasuke {

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		$this->access_control->check_role();

		$this->load->model('jabatan_m');
	}

	public function index()
	{
		$data = array(
			'title' 	=> $this->site['judul_app_alt'] . ' - Daftar Jabatan',
			'script' 	=> $this->load->view('script/jabatan', NULL, TRUE),
			'jabatan'	=> $this->jabatan_m->getJabatan(),
			'btn_add' 	=> $this->site_m->getContentMenu('tambah-jabatan'),
			'btn_edit' 	=> $this->site_m->getContentMenu('edit-jabatan'),
			'btn_del' 	=> $this->site_m->getContentMenu('hapus-jabatan')
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'daftar-jabatan',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
	}

	public function get_jabatan()
	{
		$post = $this->input->post(null, TRUE);
		
		if( ! isset($post['id'])) :
			return false;
		else :
			$token 	= array('token' => $this->security->get_csrf_hash());
			$data 	= $this->jabatan_m->getJabatanByID($post['id']);
			$array 	= array_merge($token, $data);
			echo json_encode($array);
		endif;
	}

	public function tambah()
	{
		$post = $this->input->post(null, TRUE);

		$this->form_validation->set_rules('nama_jabatan', 'Jabatan', 'trim|required|regex_match[/^[a-zA-Z0-9 .]+$/]|min_length[2]|max_length[255]|is_unique[tb_jabatan.nama_jabatan]');

		if ($this->form_validation->run() == TRUE)
		{		
			if($this->jabatan_m->tambahJabatan($post)){
				$status = 1;
				$msg = 'Jabatan berhasil ditambahkan.';
			}
			else{
				$status = 0;
				$msg = 'Gagal menambahkan jabatan.';
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

	public function edit()
	{
		$post = $this->input->post(null, TRUE);

		$this->form_validation->set_rules('nama_jabatan', 'Jabatan', 'trim|required|regex_match[/^[a-zA-Z0-9 ]+$/]|min_length[2]|max_length[255]');

		if ($this->form_validation->run() == TRUE)
		{
			if($this->jabatan_m->checkJabatan($post['nama_jabatan'], $post['id_jabatan']) == 0)
			{
				if($this->jabatan_m->editJabatan($post['nama_jabatan'], $post['id_jabatan'])){
					$status = 1;
					$msg = 'Jabatan berhasil diubah.';
				}
				else
				{
					$status = 0;
					$msg = 'Gagal mengubah jabatan.';
				}
			}
			else
			{
				$status = 0;
				$msg = 'Jabatan sudah ada.';
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

	public function hapus($id = NULL)
	{
		if(!verify($id)) show_404();

		if($this->jabatan_m->hapusJabatan($id)) {
			$msg = '<div class="alert alert-success" role="alert">Jabatan berhasil dihapus.</div>';
		}
		else
		{
			$msg = '<div class="alert alert-danger" role="alert">Gagal menghapus jabatan.</div>';
		}

		$this->session->set_flashdata('message', $msg);
		redirect('daftar-jabatan');
	}
}

/* End of file jabatan.php */
/* Location: ./application/controllers/jabatan.php */