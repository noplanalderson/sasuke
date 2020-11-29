<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_akses extends Sasuke {

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		$this->access_control->check_role();
		
		$this->load->model('akses_m');
	}

	public function index()
	{
		$data = array(
			'title' 	=> $this->site['judul_app_alt'] . ' - Manajemen Akses',
			'script' 	=> $this->load->view('script/manajemen-akses', NULL, TRUE),
			'akses_list'=> $this->akses_m->getAllAkses(),
			'roles'		=> $this->akses_m->getAllRoles(),
			'btn_add' 	=> $this->site_m->getContentMenu('tambah-role'),
			'btn_edit' 	=> $this->site_m->getContentMenu('edit-role'),
			'btn_del' 	=> $this->site_m->getContentMenu('hapus-role')
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'manajemen-akses',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
	}

	public function get_role()
	{
		$post = $this->input->post(null, TRUE);
		
		if( ! isset($post['id'])) :
			return false;
		else :
			$token 	= array('token' => $this->security->get_csrf_hash());
			$data 	= $this->akses_m->getUserTypeByID($post['id']);
			$array 	= array_merge($token, $data);
			echo json_encode($array);
		endif;
	}

	public function tambah()
	{
		$post = $this->input->post(null, TRUE);

		$this->form_validation->set_rules('user_type', 'Tipe User', 'trim|required|regex_match[/^[a-zA-Z ]+$/]|min_length[1]|max_length[15]|is_unique[tb_user_type.user_type]');
		$this->form_validation->set_rules('id_menu[]', 'Roles', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{		
			if($this->akses_m->tambahAkses($post)){
				$status = 1;
				$msg = 'Tipe user berhasil ditambahkan.';
			}
			else{
				$status = 0;
				$msg = 'Gagal menambahkan tipe user.';
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

		$this->form_validation->set_rules('user_type', 'Tipe User', 'trim|required|regex_match[/^[a-zA-Z ]+$/]|min_length[1]|max_length[15]');
		$this->form_validation->set_rules('id_menu[]', 'Roles', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{		
			if($this->akses_m->editAkses($post)){

				$status = 1;
				$msg = 'Tipe user berhasil diubah.';
			}
			else{
				$status = 0;
				$msg = 'Gagal mengubah tipe user.';
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

		if($this->akses_m->hapusAkses($id)) {
			$msg = '<div class="alert alert-success" role="alert">Tipe user berhasil dihapus.</div>';
		}
		else
		{
			$msg = '<div class="alert alert-danger" role="alert">Gagal menghapus tipe user.</div>';
		}

		$this->session->set_flashdata('message', $msg);
		redirect('manajemen-akses');
	}
}

/* End of file manajemen_user.php */
/* Location: ./application/controllers/manajemen_user.php */