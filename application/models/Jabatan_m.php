<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jabatan_m extends CI_Model {

	public function getJabatan()
	{
		$this->db->order_by('nama_jabatan', 'asc');
		return $this->db->get('tb_jabatan')->result();
	}

	public function getJabatanByID($id)
	{
		$this->db->where('md5(id_jabatan)', verify($id));
		return $this->db->get('tb_jabatan')->row_array();
	}

	public function tambahJabatan($post)
	{
		return $this->db->insert('tb_jabatan', array('nama_jabatan' => $post['nama_jabatan'])) ? true : false;
	}

	public function checkJabatan($jabatan, $id)
	{
		$this->db->where('nama_jabatan', $jabatan);
		$this->db->where('md5(id_jabatan) != ', verify($id));
		return $this->db->get('tb_jabatan')->num_rows();
	}

	public function editJabatan($jabatan, $id)
	{
		$this->db->where('md5(id_jabatan)', verify($id));
		return $this->db->update('tb_jabatan', array('nama_jabatan' => $jabatan)) ? true : false;
	}

	public function hapusJabatan($id)
	{
		$this->db->where('md5(id_jabatan)', verify($id));
		return $this->db->delete('tb_jabatan') ? true : false;
	}

	public function getPejabat()
	{
		$this->db->select('a.id_pejabat, a.nip, a.nama_pejabat, b.nama_jabatan');
		$this->db->join('tb_jabatan b', 'a.id_jabatan = b.id_jabatan', 'left');
		$this->db->order_by('a.nama_pejabat', 'asc');
		return $this->db->get('tb_pejabat a')->result();
	}

	public function tambahPejabat($post)
	{
		$object = array(
			'nip' => $post['nip'],
			'id_jabatan' => $post['id_jabatan'],
			'nama_pejabat' => $post['nama_pejabat']
		);
		
		return $this->db->insert('tb_pejabat', $object);
	}

	public function getPejabatByID($id)
	{
		$this->db->where('md5(id_pejabat)', verify($id));
		return $this->db->get('tb_pejabat')->row_array();
	}

	public function checkPejabat($post)
	{
		$this->db->where('nip', $post['nip']);
		$this->db->where('md5(id_pejabat) != ', verify($post['id_pejabat']));
		return $this->db->get('tb_pejabat')->num_rows();
	}

	public function editPejabat($post)
	{
		$object = array(
			'nip' => $post['nip'],
			'id_jabatan' => $post['id_jabatan'],
			'nama_pejabat' => $post['nama_pejabat']
		);

		$this->db->where('md5(id_pejabat)', verify($post['id_pejabat']));
		return $this->db->update('tb_pejabat', $object) ? true : false;
	}

	public function hapusPejabat($id)
	{
		$this->db->where('md5(id_pejabat)', verify($id));
		return $this->db->delete('tb_pejabat') ? true : false;
	}
}

/* End of file jabatan_m.php */
/* Location: ./application/models/jabatan_m.php */