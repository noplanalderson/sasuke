<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skmk extends SASUKE_Core {

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		
		$this->_partial = array(
			'head',
			'sidebar',
			'topbar',
			'body',
			'footer',
			'modal',
			'script'
		);

		$this->load->model('skmk_m');
	}

	public function index()
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'datatables/datatables.min'
		);

		$this->js_plugin  = array(
			'bootstrap/js/bootstrap.bundle.min',
			'datatables/datatables.min'
		);

		$this->_module 	= 'skmk/daftar-skmk';
		
		$this->js 		= 'skmk';
		
		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - Daftar Surat',
			'skmk_list'	=> $this->skmk_m->getSKMK(),
			'btn_detail'=> $this->app_m->getContentMenu('detail-skmk'),
			'btn_edit' 	=> $this->app_m->getContentMenu('edit-skmk'),
			'btn_del' 	=> $this->app_m->getContentMenu('hapus-skmk')
		);

		$this->load_view();
	}

	public function detail($id = NULL)
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min'
		);

		$this->js_plugin  = array(
			'bootstrap/js/bootstrap.bundle.min'
		);

		$skmk = $this->skmk_m->getSkmkDetail($id);

		if(empty($skmk)) show_404();

		$this->_module 	= 'skmk/detail-skmk';
		$this->_script  = 'detail-skmk';
		$this->js 		= 'detail_skmk';
		
		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - ' . $skmk->no_skmk,
			'skmk'		=> $skmk,
			'btn_detail'=> $this->app_m->getContentMenu('detail-skmk'),
			'btn_edit' 	=> $this->app_m->getContentMenu('edit-skmk'),
			'btn_del' 	=> $this->app_m->getContentMenu('hapus-skmk')
		);

		$this->load_view();
	}

	function kode_surat($str)
	{
		if(!preg_match("/(SKMK-)([A-Z\/]{1,4})(IX|IV|V?I{1,3})([\/]{1}+[0-9]{4})$/", $str))
		{
			$this->form_validation->set_message('kode_surat', 'Kode Surat tidak Valid');
			return false;
		}
		else
		{
			return true;
		}
	}

	private function _rules()
	{
		$rules = array(
			array(
				'field' => 'nomor',
				'label' => 'Nomor',
				'rules' => 'required|integer',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'integer' => '{field} harus integer.'
				)
			),
			array(
				'field' => 'no_skmk',
				'label' => 'Nomor SKMK',
				'rules' => 'required|callback_kode_surat',
				'errors'=> array(
					'required' => '{field} harus diisi.',
				)
			),
			array(
				'field' => 'id_user',
				'label' => 'Penanda Tangan',
				'rules' => 'required|integer',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'integer' => '{field} harus integer.'
				)
			),
			array(
				'field' => 'nama_pelapor',
				'label' => 'Nama Pelapor',
				'rules' => 'trim|required|regex_match[/[a-zA-Z ]+$/]|max_length[80]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
			array(
				'field' => 'nama_terlapor',
				'label' => 'Nama Terlapor',
				'rules' => 'trim|required|regex_match[/[a-zA-Z ]+$/]|max_length[80]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
			array(
				'field' => 'no_ktp_pelapor',
				'label' => 'No. KTP Pelapor',
				'rules' => 'required|integer|exact_length[16]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'integer' => '{field} harus angka.',
					'exact_length' => '{field} harus {param} karakter.'
				)
			),
			array(
				'field' => 'no_ktp_terlapor',
				'label' => 'No. KTP Terlapor',
				'rules' => 'required|integer|exact_length[16]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'integer' => '{field} harus angka.',
					'exact_length' => '{field} harus {param} karakter.'
				)
			),
			array(
				'field' => 'tempat_lahir_pelapor',
				'label' => 'Tempat Lahir Pelapor',
				'rules' => 'trim|required|regex_match[/[a-zA-Z ]+$/]|max_length[80]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
			array(
				'field' => 'tempat_lahir_terlapor',
				'label' => 'Tempat Lahir Terlapor',
				'rules' => 'trim|required|regex_match[/[a-zA-Z ]+$/]|max_length[80]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
			array(
				'field' => 'tgl_lahir_pelapor',
				'label' => 'Tgl Lahir Pelapor',
				'rules' => 'trim|required|valid_date',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} harus huruf dan spasi.',
					'valid_date' => 'Format {field} harus (YYYY-MM-DD).'
				)
			),
			array(
				'field' => 'tgl_lahir_terlapor',
				'label' => 'Tgl Lahir Terlapor',
				'rules' => 'trim|required|valid_date',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} harus huruf dan spasi.',
					'valid_date' => 'Format {field} harus (YYYY-MM-DD).'
				)
			),
			array(
				'field' => 'alamat_pelapor',
				'label' => 'Alamat Pelapor',
				'rules' => 'trim|required|regex_match[/[a-zA-Z0-9\/\-_., ]+$/]|max_length[255]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
			array(
				'field' => 'tgl_meninggal',
				'label' => 'Tanggal Meninggal',
				'rules' => 'required|valid_datetime[Y-m-d H:i]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'valid_datetime' => '{field} harus berformat Y-m-d H:i'
				)
			),
			array(
				'field' => 'lokasi_meninggal',
				'label' => 'Lokasi Meninggal',
				'rules' => 'trim|required|regex_match[/[a-zA-Z ]+$/]|max_length[100]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
			array(
				'field' => 'tembusan',
				'label' => 'tembusan',
				'rules' => 'trim|regex_match[/[a-zA-Z0-9\/\-_., ]+$/]|max_length[500]',
				'errors'=> array(
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
			array(
				'field' => 'pekerjaan_pelapor',
				'label' => 'Pekerjaan Pelapor',
				'rules' => 'trim|regex_match[/[a-zA-Z ]+$/]|max_length[100]',
				'errors'=> array(
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
			array(
				'field' => 'pekerjaan_terlapor',
				'label' => 'Pekerjaan Terlapor',
				'rules' => 'trim|regex_match[/[a-zA-Z ]+$/]|max_length[100]',
				'errors'=> array(
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
			array(
				'field' => 'hubungan',
				'label' => 'Hubungan Pelapor',
				'rules' => 'trim|required|regex_match[/[A-Z]+$/]|max_length[100]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'regex_match' => '{field} harus huruf dan spasi.',
					'max_length' => '{field} maksimal {param} karakter.'
				)
			),
		);
		return $rules;
	}

	public function buat()
	{
		$this->access_control->check_role();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'select2/css/select2.min',
			'datetimepicker/build/jquery.datetimepicker.min'
		);

		$this->js_plugin  = array(
			'bootstrap/js/bootstrap.bundle.min',
			'datetimepicker/build/jquery.datetimepicker.full.min',
			'tags/jquery.tagsinput.min'
		);

		$this->_module 	= 'skmk/buat-skmk';
		
		$this->js 		= 'buat_skmk';
		
		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - Buat SKMK',
			'pegawai'	=> $this->skmk_m->getPegawai(),
			'nomor'		=> $this->skmk_m->getNomor()
		);

		$this->load_view();
	}

	public function submit_skmk()
	{
		$status = 0;
		$post 	= $this->input->post(null, TRUE);

		$this->form_validation->set_rules($this->_rules());

		if ($this->form_validation->run() == TRUE)
		{	
			$pelapor = array(
				'id_pelapor' => $post['nomor'],
				'no_skmk' => sprintf("%03d",$post['nomor']).'/'.$post['no_skmk'],
				'id_user' => $post['id_user'],
				'nama_pelapor' => $post['nama_pelapor'],
				'no_ktp_pelapor' => $post['no_ktp_pelapor'],
				'pekerjaan_pelapor' => $post['pekerjaan_pelapor'],
				'tempat_lahir_pelapor' => $post['tempat_lahir_pelapor'],
				'tgl_lahir_pelapor' => $post['tgl_lahir_pelapor'],
				'alamat_pelapor' => $post['alamat_pelapor'],
				'hubungan' => $post['hubungan'],
				'tembusan' => $post['tembusan']
			);
			
			$terlapor = array(
				'id_pelapor' => $post['nomor'],
				'nama_terlapor' => $post['nama_terlapor'],
				'tempat_lahir_terlapor' => $post['tempat_lahir_terlapor'],
				'tgl_lahir_terlapor' => $post['tgl_lahir_terlapor'],
				'alamat_terlapor' => $post['alamat_terlapor'],
				'no_ktp_terlapor' => $post['no_ktp_terlapor'],
				'pekerjaan_terlapor' => $post['pekerjaan_terlapor'],
				'tgl_meninggal' => $post['tgl_meninggal'],
				'lokasi_meninggal' => $post['lokasi_meninggal']
			);
			
			$status = ($this->skmk_m->buatSkmk($pelapor, $terlapor) === true) ? 1 : 0;
			$msg 	= ($status === 1) ? 'Berhasil membuat surat.' : 'Gagal membuat surat.';
		}
		else
		{
			$msg = validation_errors();
		}
		
		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);
		
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function edit($id = NULL)
	{
		$this->access_control->check_role();

		$skmk = $this->skmk_m->getSkmkByID($id);
		if(empty($skmk)) show_404();

		$this->css_plugin = array(
			'fontawesome-free/css/all.min',
			'select2/css/select2.min',
			'datetimepicker/build/jquery.datetimepicker.min'
		);

		$this->js_plugin  = array(
			'bootstrap/js/bootstrap.bundle.min',
			'datetimepicker/build/jquery.datetimepicker.full.min',
			'tags/jquery.tagsinput.min'
		);

		$this->_module 	= 'skmk/edit-skmk';
		
		$this->js 		= 'buat_skmk';
		
		$this->_data 	= array(
			'title' 	=> $this->app->judul_app_alt . ' - Buat SKMK',
			'pegawai'	=> $this->skmk_m->getPegawai(),
			'nomor'		=> $this->skmk_m->getNomor(),
			'skmk'		=> $skmk
		);

		$this->load_view();
	}

	public function do_edit()
	{
		$status = 0;
		$post 	= $this->input->post(null, TRUE);

		$this->form_validation->set_rules($this->_rules());

		if ($this->form_validation->run() == TRUE)
		{
			$pelapor = array(
				'no_skmk' => sprintf("%03d",$post['nomor']).'/'.$post['no_skmk'],
				'id_user' => $post['id_user'],
				'nama_pelapor' => $post['nama_pelapor'],
				'no_ktp_pelapor' => $post['no_ktp_pelapor'],
				'tempat_lahir_pelapor' => $post['tempat_lahir_pelapor'],
				'tgl_lahir_pelapor' => $post['tgl_lahir_pelapor'],
				'alamat_pelapor' => $post['alamat_pelapor'],
				'tembusan' => $post['tembusan'],
				'pekerjaan_pelapor' => $post['pekerjaan_pelapor'],
				'hubungan' => $post['hubungan']
			);
			
			$terlapor = array(
				'nama_terlapor' => $post['nama_terlapor'],
				'tempat_lahir_terlapor' => $post['tempat_lahir_terlapor'],
				'tgl_lahir_terlapor' => $post['tgl_lahir_terlapor'],
				'alamat_terlapor' => $post['alamat_terlapor'],
				'no_ktp_terlapor' => $post['no_ktp_terlapor'],
				'pekerjaan_terlapor' => $post['pekerjaan_terlapor'],
				'tgl_meninggal' => $post['tgl_meninggal'],
				'lokasi_meninggal' => $post['lokasi_meninggal']
			);
			
			$status = ($this->skmk_m->editSkmk($pelapor, $terlapor, $post['hash_skmk']) === true) ? 1 : 0;
			$msg 	= ($status === 1) ? 'Berhasil mengubah surat.' : 'Gagal mengubah surat.';
		}
		else
		{
			$msg = validation_errors();
		}
		
		$token = $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}

	public function hapus()
	{
		$this->access_control->check_role();

		$status = 0;
		$hash 	= $this->input->post('id', TRUE);
		
		if( ! isset($hash) || (verify($hash) === false))
		{
			$msg = 'SKMK tidak ditemukan.';
		}
		else
		{
			$status = ($this->skmk_m->hapusSkmk($hash) === true) ? 1 : 0;
			$msg 	= ($status === 1) ? 'SKMK Berhasil Dihapus.' : 'Gagal Menghapus SKMK.';
		}

		$token 	= $this->security->get_csrf_hash();
		$result = array('result' => $status, 'msg' => $msg, 'token' => $token);

		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}