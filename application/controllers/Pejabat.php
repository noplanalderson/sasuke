<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pejabat extends Sasuke {

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
			'title' 	=> $this->site['judul_app_alt'] . ' - Daftar Pejabat',
			'script' 	=> $this->load->view('script/pejabat', NULL, TRUE),
			'jabatan'	=> $this->jabatan_m->getJabatan(),
			'pejabat'	=> $this->jabatan_m->getPejabat(),
			'btn_add' 	=> $this->site_m->getContentMenu('tambah-pejabat'),
			'btn_edit' 	=> $this->site_m->getContentMenu('edit-pejabat'),
			'btn_del' 	=> $this->site_m->getContentMenu('hapus-pejabat')
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'daftar-pejabat',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
	}

	public function get_pejabat()
	{
		$post = $this->input->post(null, TRUE);
		
		if( ! isset($post['id'])) :
			return false;
		else :
			$token 	= array('token' => $this->security->get_csrf_hash());
			$data 	= $this->jabatan_m->getPejabatByID($post['id']);
			$array 	= array_merge($token, $data);
			echo json_encode($array);
		endif;
	}

	public function tambah()
	{
		$post = $this->input->post(null, TRUE);

		$this->form_validation->set_rules('nama_pejabat', 'Nama Pejabat', 'trim|required|regex_match[/^[a-zA-Z0-9 ]+$/]|min_length[2]|max_length[255]');
		$this->form_validation->set_rules('nip', 'NIP Pejabat', 'required|integer|exact_length[18]|is_unique[tb_pejabat.nip]');
		$this->form_validation->set_rules('id_jabatan', 'Jabatan', 'required|integer|min_length[1]|max_length[3]');

		if ($this->form_validation->run() == TRUE)
		{		
			if($this->jabatan_m->tambahPejabat($post)){
				$status = 1;
				$msg = 'Pejabat berhasil ditambahkan.';
			}
			else{
				$status = 0;
				$msg = 'Gagal menambahkan pejabat.';
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

		$this->form_validation->set_rules('id_pejabat', 'ID Pejabat', 'trim|required|regex_match[/[a-z0-9\-]+$/]|exact_length[36]');
		$this->form_validation->set_rules('nip', 'NIP Pejabat', 'required|integer|exact_length[18]');
		$this->form_validation->set_rules('nama_pejabat', 'Nama Pejabat', 'trim|required|regex_match[/^[a-zA-Z0-9 ]+$/]|min_length[2]|max_length[255]');
		$this->form_validation->set_rules('id_jabatan', 'Jabatan', 'required|integer|min_length[1]|max_length[3]');

		if ($this->form_validation->run() == TRUE)
		{
			if($this->jabatan_m->checkPejabat($post) == 0)
			{
				if($this->jabatan_m->editPejabat($post)){
					$status = 1;
					$msg = 'Pejabat berhasil diubah.';
				}
				else
				{
					$status = 0;
					$msg = 'Gagal mengubah Pejabat.';
				}
			}
			else
			{
				$status = 0;
				$msg = 'Pejabat sudah ada.';
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

		if($this->jabatan_m->hapusPejabat($id)) {
			$msg = '<div class="alert alert-success" role="alert">Pejabat berhasil dihapus.</div>';
		}
		else
		{
			$msg = '<div class="alert alert-danger" role="alert">Gagal menghapus Pejabat.</div>';
		}

		$this->session->set_flashdata('message', $msg);
		redirect('daftar-pejabat');
	}
}

/* End of file jabatan.php */
/* Location: ./application/controllers/jabatan.php */