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

	public function getIndexPage($type_id)
	{
		$this->db->select('a.label_menu, a.link_menu');
		$this->db->join('tb_roles b', 'a.id_menu = b.id_menu', 'inner');
		$this->db->where('b.id_type', $type_id);
		$this->db->where('a.tipe_menu != ', 'content');
		$this->db->where('a.link_menu IS NOT NULL');
		$this->db->order_by('a.label_menu', 'asc');
		$result = $this->db->get('tb_menu a');
		
		return $result->result();
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
		$akses = $this->db->insert('tb_user_type', array('user_type' => $post['user_type'])) ? $this->db->insert_id() : false;
		
		if($akses !== false)
		{
			$loop = count($post['id_menu']);

			for ($i = 0; $i < $loop; $i++)
			{
				$this->_tambahRoles($akses, $post['id_menu'][$i]);
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
		$this->db->delete('tb_roles');
			
		$this->db->where('md5(id_type)', verify($post['id_type']));
		$this->db->update('tb_user_type', array('user_type' => $post['user_type']));

		$id = $this->_getUserTypeID('md5(id_type)', verify($post['id_type']));
		
		$loop = count($post['id_menu']);
		
		if(!empty($id))
		{
			for ($i = 0; $i < $loop; $i++)
			{
				$this->_tambahRoles($id, $post['id_menu'][$i]);
			}

			return true;
		}
	}

	public function hapusAkses($id)
	{
		$this->db->where('md5(id_type)', verify($id));
		$this->db->delete('tb_user_type');
		return ($this->db->affected_rows() === 1) ? true  : false;
	}

	public function updateIndex($data)
	{
		$this->db->where('md5(id_type)', verify($data['id']));
		return $this->db->update('tb_user_type', ['index_page' => $data['index_page']]) ? true : false;
	}
}

/* End of file akses_m.php */
/* Location: ./application/models/akses_m.php */