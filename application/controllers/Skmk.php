<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skmk extends Sasuke {

	public $skmk = array(
		'id_pelapor' => '',
		'id_pejabat' => '',
		'nama_pelapor' => '',
		'tempat_lahir_pelapor' => '',
		'tgl_lahir_pelapor' => '',
		'alamat_pelapor' => '',
		'no_ktp_pelapor' => '',
		'pekerjaan_pelapor' => '',
		'hubungan' => '',
		'tembusan' => '',
		'nama_terlapor' => '',
		'tempat_lahir_terlapor' => '',
		'tgl_lahir_terlapor' => '',
		'alamat_terlapor' => '',
		'no_ktp_terlapor' => '',
		'pekerjaan_terlapor' => '',
		'tgl_meninggal' => '',
		'lokasi_meninggal' => ''
	);

	public function __construct()
	{
		parent::__construct();
		$this->access_control->check_login();
		$this->access_control->check_role();
		
		$this->load->model('skmk_m');
		$this->load->model('jabatan_m');
	}

	public function index()
	{
		$data = array(
			'title' 	=> $this->site['judul_app_alt'] . ' - Surat Kematian',
			'script' 	=> $this->load->view('script/skmk', NULL, TRUE),
			'skmk_list'	=> $this->skmk_m->getSKMK(),
			'btn_detail'=> $this->site_m->getContentMenu('detail-skmk'),
			'btn_edit' 	=> $this->site_m->getContentMenu('edit-skmk'),
			'btn_del' 	=> $this->site_m->getContentMenu('hapus-skmk')
		);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'daftar-skmk',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
	}

	public function detail($id = NULL)
	{
		$data = array(
			'title' 	=> $this->site['judul_app_alt'] . ' - Surat Kematian',
			'skmk'		=> $this->skmk_m->getSkmkDetail($id),
			'instansi'	=> $this->skmk_m->getInstansi()
		);

		$data['script'] = $this->load->view('script/detail-skmk', $data, TRUE);

		$view = array(
			'partial/head',
			'partial/sidebar',
			'partial/topbar',
			'detail-skmk',
			'partial/footer',
			'partial/modal',
			'partial/script'
		);

		Sasuke::view($view, $data);
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
				'field' => 'id_pejabat',
				'label' => 'Pejabat',
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
				'rules' => 'required|integer|exact_length[18]',
				'errors'=> array(
					'required' => '{field} harus diisi.',
					'integer' => '{field} harus angka.',
					'exact_length' => '{field} harus {param} karakter.'
				)
			),
			array(
				'field' => 'no_ktp_terlapor',
				'label' => 'No. KTP Terlapor',
				'rules' => 'required|integer|exact_length[18]',
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
		if(isset($_POST['submit'])) 
		{
			$post = $this->input->post(null, TRUE);

			$this->form_validation->set_rules($this->_rules());

			if ($this->form_validation->run() == TRUE)
			{	
				$id_skmk = $post['nomor'];
				$id_skmk += $post['nomor'];

				$pelapor = array(
					'id_pelapor' => $id_skmk,
					'no_skmk' => sprintf("%03d",$post['nomor']).'/'.$post['no_skmk'],
					'id_pejabat' => $post['id_pejabat'],
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
					'id_pelapor' => $id_skmk,
					'nama_terlapor' => $post['nama_terlapor'],
					'tempat_lahir_terlapor' => $post['tempat_lahir_terlapor'],
					'tgl_lahir_terlapor' => $post['tgl_lahir_terlapor'],
					'alamat_terlapor' => $post['alamat_terlapor'],
					'no_ktp_terlapor' => $post['no_ktp_terlapor'],
					'pekerjaan_terlapor' => $post['pekerjaan_terlapor'],
					'tgl_meninggal' => $post['tgl_meninggal'],
					'lokasi_meninggal' => $post['lokasi_meninggal']
				);
				
				if($this->skmk_m->buatSkmk($pelapor, $terlapor))
				{
					$status = 1;
					$msg = 'Berhasil membuat surat.';
				}
				else
				{
					$status = 0;
					$msg = 'Gagal membuat surat.';
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
		else
		{
			$data = array(
				'title' 	=> $this->site['judul_app_alt']. ' - Buat SKMK',
				'script' 	=> $this->load->view('script/buat-skmk', NULL, TRUE),
				'pejabat'	=> $this->jabatan_m->getPejabat(),
				'kode_instansi' => $this->skmk_m->getInstansi(),
				'nomor'		=> $this->skmk_m->getNomor(),
				'value'		=> $this->skmk,
				'messages'	=> $this->msg
			);

			$view = array(
				'partial/head',
				'partial/sidebar',
				'partial/topbar',
				'buat-skmk',
				'partial/footer',
				'partial/modal',
				'partial/script'
			);

			Sasuke::view($view, $data);
		}
	}

	public function edit($id = NULL)
	{
		$this->skmk = $this->skmk_m->getSkmkByID($id);
		if(empty($this->skmk)) show_404();

		if(isset($_POST['submit'])) 
		{
			$post = $this->input->post(null, TRUE);

			$this->form_validation->set_rules($this->_rules());

			if ($this->form_validation->run() == TRUE)
			{
				$pelapor = array(
					'id_pelapor' => $post['nomor'],
					'no_skmk' => sprintf("%03d",$post['nomor']).'/'.$post['no_skmk'],
					'id_pejabat' => $post['id_pejabat'],
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
				
				if($this->skmk_m->editSkmk($pelapor, $terlapor, $id))
				{
					$status = 1;
					$msg = 'Berhasil mengubah surat.';
				}
				else
				{
					$status = 0;
					$msg = 'Gagal mengubah surat.';
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
		else
		{
			$data = array(
				'title' 	=> $this->site['judul_app_alt']. ' - Buat SKMK',
				'script' 	=> $this->load->view('script/buat-skmk', NULL, TRUE),
				'pejabat'	=> $this->jabatan_m->getPejabat(),
				'kode_instansi' => $this->skmk_m->getInstansi(),
				'nomor'		=> $this->skmk_m->getNomor(),
				'value'		=> $this->skmk,
				'messages'	=> $this->msg
			);

			$view = array(
				'partial/head',
				'partial/sidebar',
				'partial/topbar',
				'buat-skmk',
				'partial/footer',
				'partial/modal',
				'partial/script'
			);

			Sasuke::view($view, $data);
		}
	}

	public function hapus($id = NULL)
	{
		if(!verify($id)) show_404();

		if($this->skmk_m->hapusSkmk($id)) {
			$msg = '<div class="alert alert-success" role="alert">Surat berhasil dihapus.</div>';
		}
		else
		{
			$msg = '<div class="alert alert-danger" role="alert">Gagal menghapus Surat.</div>';
		}

		$this->session->set_flashdata('message', $msg);
		redirect('surat-kematian');
	}
}