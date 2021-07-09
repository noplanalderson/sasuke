<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_akses extends SASUKE_Core {

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
		
		$this->js 		  = 'manajemen_akses';

		$this->load->model('akses_m');
	}

	public function index()
	{
		$this->_module 	  = 'access/manajemen-akses';

		$this->_data 	  = array(
			'title' 	  => $this->app->judul_app_alt . ' - Manajemen Akses',
			'akses_list'  => $this->akses_m->getAllAkses(),
			'roles'		  => $this->akses_m->getAllRoles(),
			'btn_add' 	  => $this->app_m->getContentMenu('tambah-role'),
			'btn_edit' 	  => $this->app_m->getContentMenu('edit-role'),
			'btn_del' 	  => $this->app_m->getContentMenu('hapus-role')
		);

		$this->load_view();
	}

	public function get_role()
	{
		$post = $this->input->post(null, TRUE);
		
		if( ! verify($post['id'])) :
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

		$this->form_validation->set_rules('user_type', 'Tipe User', 'trim|required|regex_match[/^[a-zA-Z ]+$/]|min_length[1]|max_length[100]|is_unique[tb_user_type.user_type]');
		$this->form_validation->set_rules('id_menu[]', 'Roles', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{		
			$status = ($this->akses_m->tambahAkses($post) === TRUE) ? 1 : 0;
			$msg 	= ($status === 1) ? 'Tipe user berhasil ditambahkan.' : 'Gagal menambahkan tipe user.';
		}
		else
		{
			$status = 0;
			$msg = validation_errors();
		}
		
		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function edit()
	{
		$post = $this->input->post(null, TRUE);

		$this->form_validation->set_rules('user_type', 'Tipe User', 'trim|required|regex_match[/^[a-zA-Z ]+$/]|min_length[1]|max_length[100]');
		$this->form_validation->set_rules('id_menu[]', 'Roles', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{		
			$status = ($this->akses_m->editAkses($post) === TRUE) ? 1 : 0;
			$msg 	= ($status === 1) ? 'Tipe user berhasil diubah.' : 'Gagal mengubah tipe user.';
		}
		else
		{
			$status = 0;
			$msg = validation_errors();
		}
		
		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function hapus($id = NULL)
	{
		if(!verify($id)) show_404();

		$status = ($this->akses_m->hapusAkses($id) === TRUE) ? 1 : 0;
		$msg 	= ($status === 1) ? 'Tipe user berhasil dihapus.' : 'Gagal menghapus tipe user.';

		$result = array('result' => $status, 'msg' => $msg);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function update_index()
	{
		$data = $this->input->post(null, TRUE);
		$status = 0;

		if(verify($data['id']) !== FALSE) 
		{
			$this->form_validation->set_rules('index_page', 'Index', 'trim|required|regex_match[/[a-z\-]+$/]');
			if ($this->form_validation->run() == TRUE) 
			{
				$status = ($this->akses_m->updateIndex($data) === TRUE) ? 1 : 0;
			}
		}

		$token 	= $this->security->get_csrf_hash();
		$result = array('result' => $status, 'token' => $token);
		
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}

/* End of file manajemen_user.php */
/* Location: ./application/controllers/manajemen_user.php */