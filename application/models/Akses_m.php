<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses_m extends CI_Model {

	public function getAllAkses()
	{
		return $this->db->get('tb_user_type')->result();
	}

	public function getAllRoles()
	{
		$this->db->select('id_menu, label_menu');
		$this->db->order_by('label_menu', 'asc');
		return $this->db->get('tb_menu')->result();
	}

	public function getRolesByID($id_type)
	{
		$this->db->select('a.label_menu');
		$this->db->join('tb_roles b', 'a.id_menu = b.id_menu', 'inner');
		$this->db->where('b.id_type', $id_type);
		$result = $this->db->get('tb_menu a');
		
		$data = $result->result_array();
		$count= $result->num_rows();

		if($count !== 0)
		{
			foreach ($data as $row) 
			{
				$roles[] = $row['label_menu'];
			}

			return implode(', ', $roles);
		}
	}

	private function _getSelectedRoles($id)
	{
		$this->db->select('id_menu');
		$this->db->where('md5(id_type)', $id);
		$result = $this->db->get('tb_roles');

		$data = $result->result_array();
		$count= $result->num_rows();

		if($count !== 0)
		{
			foreach ($data as $row) 
			{
				$roles[] = $row['id_menu'];
			}

			return implode(',', $roles);
		}
	}

	public function getUserTypeByID($id = NULL)
	{
		$id 	= verify($id);
		$roles 	= array('roles' => $this->_getSelectedRoles($id));
		
		$this->db->where('md5(id_type)', $id);
		$user_type =  $this->db->get('tb_user_type')->row_array();

		return array_merge($user_type, $roles);
	}

	public function tambahAkses($post)
	{
		$insert = $this->db->insert('tb_user_type', array('user_type' => $post['user_type'])) ? true : false;
		if($insert)
		{
			$id = $this->_getUserTypeID('user_type', strtolower($post['user_type']));
			$loop = count($post['id_menu']);

			for ($i = 0; $i < $loop; $i++)
			{
				$this->_tambahRoles($id, $post['id_menu'][$i]);
			}

			return true;
		}
	}

	private function _getUserTypeID($column, $value)
	{
		$this->db->select('id_type');
		$this->db->where($column, $value);
		
		$result = $this->db->get('tb_user_type', 1);
		$id = $result->row_array();

		return $id['id_type'];
	}

	private function _tambahRoles($id, $roles)
	{
		$object = array('id_type' => $id, 'id_menu' => $roles);
		return $this->db->insert('tb_roles', $object) ? true : false;
	}

	public function checkUserType($user_type, $id)
	{
		$this->db->select('user_type');
		$this->db->where('user_type', $user_type);
		$this->db->where('md5(id_type)', verify($id));
		return $this->db->get('tb_user_type')->num_rows();
	}

	public function editAkses($post)
	{
		$this->db->where('md5(id_type)', verify($post['id_type']));
		$delete = $this->db->delete('tb_roles') ? true : false;

		if($delete) {
			$this->db->where('md5(id_type)', verify($post['id_type']));
			$update = $this->db->update('tb_user_type', array('user_type' => $post['user_type']));
			if($update) {
				$id = $this->_getUserTypeID('md5(id_type)', verify($post['id_type']));
				$loop = count($post['id_menu']);

				for ($i = 0; $i < $loop; $i++)
				{
					$this->_tambahRoles($id, $post['id_menu'][$i]);
				}

				return true;
			}
		}
	}

	public function hapusAkses($id)
	{
		$this->db->where('md5(id_type)', verify($id));
		return $this->db->delete('tb_user_type');
	}
}

/* End of file akses_m.php */
/* Location: ./application/models/akses_m.php */