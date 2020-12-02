<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Skmk_m extends CI_Model {

	public function getInstansi()
	{
		return $this->db->get('tb_instansi', 1)->row();
	}

	public function getNomor()
	{
		$this->db->select('id_pelapor');
		return $this->db->get('tb_pelapor')->num_rows() + 1;
	}

	public function buatSkmk($pelapor, $terlapor)
	{
		$insertPelapor = $this->db->insert('tb_pelapor', $pelapor) ? true : false;

		if($insertPelapor){
			return $this->db->insert('tb_terlapor', $terlapor) ? true : false;
		}
	}

	public function getSKMK()
	{
		$this->db->select('a.no_skmk, a.nama_pelapor, b.nama_terlapor, b.tgl_meninggal, c.nama_pegawai');
		$this->db->join('tb_terlapor b', 'a.id_pelapor = b.id_pelapor', 'inner');
		$this->db->join('tb_user c', 'a.id_user = c.id_user', 'left');
		$this->db->order_by('a.id_pelapor', 'asc');
		$this->db->order_by('b.tgl_meninggal', 'asc');
		return $this->db->get('tb_pelapor a')->result();
	}

	public function getSkmkByID($id)
	{
		$this->db->select('a.*, b.*, date_format(b.tgl_meninggal, "%Y-%m-%d %H:%i") AS tgl_meninggal');
		$this->db->join('tb_terlapor b', 'a.id_pelapor = b.id_pelapor', 'inner');
		$this->db->where('md5(no_skmk)', verify($id));
		return $this->db->get('tb_pelapor a')->row_array();
	}

	public function editSkmk($pelapor, $terlapor, $id)
	{
		$this->db->where('md5(no_skmk)', verify($id));
		$updatePelapor = $this->db->update('tb_pelapor', $pelapor) ? true : false;

		if($updatePelapor){
			$this->db->where('id_pelapor', $pelapor['id_pelapor']);
			return $this->db->update('tb_terlapor', $terlapor) ? true : false;
		}
	}

	public function hapusSkmk($id)
	{
		$this->db->where('md5(no_skmk)', verify($id));
		return $this->db->delete('tb_pelapor') ? true : false;
	}

	public function getSkmkDetail($id)
	{
		$this->db->select('
			a.no_skmk,
			a.nama_pelapor,
			CONCAT(a.tempat_lahir_pelapor, ", ", date_format(a.tgl_lahir_pelapor, "%d-%m-%Y")) AS ttl_pelapor,
			a.no_ktp_pelapor,
			a.alamat_pelapor,
			a.pekerjaan_pelapor,
			a.hubungan,
			a.tembusan,
			a.tgl_dibuat,
			b.nama_terlapor,
			CONCAT(b.tempat_lahir_terlapor, ", ", date_format(b.tgl_lahir_terlapor, "%d-%m-%Y")) AS ttl_terlapor,
			b.no_ktp_terlapor,
			b.alamat_terlapor,
			b.pekerjaan_terlapor,
			date_format(b.tgl_meninggal, "%d %M %Y") tgl_meninggal,
			date_format(b.tgl_meninggal, "%H:%i") jam_meninggal,
			b.lokasi_meninggal,
			c.nama_pegawai, c.nip, d.user_type');
		$this->db->join('tb_terlapor b', 'a.id_pelapor = b.id_pelapor', 'inner');
		$this->db->join('tb_user c', 'a.id_user = c.id_user', 'left');
		$this->db->join('tb_user_type d', 'c.id_type = d.id_type', 'inner');
		$this->db->where('md5(a.no_skmk)', verify($id));
		return $this->db->get('tb_pelapor a')->row();
	}

	public function getPegawai()
	{
		$this->db->select('a.id_user, a.nama_pegawai, b.user_type');
		$this->db->join('tb_user_type b', 'a.id_type = b.id_type', 'inner');
		$this->db->order_by('a.nama_pegawai', 'asc');
		return $this->db->get('tb_user a')->result();
	}
}

/* End of file skmk_m.php */
/* Location: ./application/models/skmk_m.php */