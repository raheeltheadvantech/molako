<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_users_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_users($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			return $this->get_all_users();
		}
		else
		{
		    $sql = '*';
		    $sql .= ',(SELECT `name` FROM '. $this->db->dbprefix .'roles WHERE role_id = u.admin_role_id) as role_name';

			$this->db->select($sql, FALSE);
			$this->db->from('admin_users u');
			$this->db->where(1,1, FALSE);
			$this->db->where('enabled', 1);
			
			if(!empty($data['rows']))
			{
				$this->db->limit($data['rows']);
			}
			
			if(!empty($data['page']))
			{
				$this->db->offset($data['page']);
			}
			
			if(!empty($data['order_by']))
			{
				$this->db->order_by($data['order_by'], $data['sort_order']);
			}
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('first_name', $search->term);
					$this->db->or_like('last_name', $search->term);
					$this->db->or_like('middle_name', $search->term);
					$this->db->group_end();
				}
			}
			
			if($return_count)
			{
				$result = $this->db->get()->num_rows();
			}
			else
			{
				$result = $this->db->get()->result();
			}
			
			return $result;
		}
	}
	
	function get_all_users()
	{
		$this->db->order_by('first_name', 'ASC');
		$result	= $this->db->get('admin_users')->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function get_user_roles()
	{

	    $this->db->select('*')->from('roles')->where('enabled',1);
	    $this->db->order_by('name', 'ASC');
		$result	= $this->db->get()->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function save($data)
	{
		if ($data['admin_user_id'])
		{
			$this->db->where('admin_user_id', $data['admin_user_id']);
			$this->db->update('admin_users', $data);
			$id	= $data['admin_user_id'];
		}
		else
		{
			$this->db->insert('admin_users', $data);
			$id	= $this->db->insert_id();
		}
		//echo $this->db->last_query();
		return $id;
	}
	
	function save_batch($data)
	{
		$this->db->insert_batch('admin_users', $data);
		
		return true;
	}

	function is_already_exist($str, $id=false)
	{
		$this->db->select('admin_user_id');
		$this->db->from('admin_users');
		$this->db->where('first_name', $str);
		if ($id)
		{
			$this->db->where('admin_user_id !=', $id);
		}
		$count = $this->db->count_all_results();
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function get_user_by_id($str)
	{
		$this->db->select('*');
		$this->db->from('admin_users');
		$this->db->where('admin_user_id', $str);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function delete($id)
	{
		$this->db->where('admin_user_id', $id);
		return $this->db->delete('admin_users');
	}

	function check_name($str, $id=false)
	{
		$this->db->select('first_name');
		$this->db->from('admin_users');
		$this->db->where('first_name', $str);
		if ($id)
		{
			$this->db->where('admin_user_id !=', $id);
		}
		$count = $this->db->count_all_results();
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}