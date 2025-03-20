<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_acl_model extends Admin_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	/***	Categories & Modules	***/
	function get_admin_module_categories($acl_category_id = false, $acl_module_id = false, $acl_action_id = false, $is_sa = false)
	{
		$this->db->select('*, \'\' AS modules');
		$this->db->where('enabled', 1);
		if($is_sa == false and is_array($acl_category_id) )
		{
			$this->db->where_in('acl_category_id', $acl_category_id);
		}
		$this->db->order_by('acl_category_id', 'DESC');

		$result	= $this->db->get('acl_categories')->result();
		if(!$result)
		{
			return false;
		}
		
		foreach($result as $key=>$val)
		{
			$val->modules = $this->get_acl_modules($val->acl_category_id, $acl_module_id, $acl_action_id, $is_sa );
		}

//        echo '<pre>';
//		print_r($result);
//		die('dddd');


		return $result;
	}



    function get_admin_module_categories_nav($acl_category_id = false, $acl_module_id = false, $acl_action_id = false, $is_sa = false, $role = false)
    {
        $this->db->select('*, \'\' AS modules');
        $this->db->where('enabled', 1);
        if($is_sa == false and is_array($acl_category_id) )
        {
            $this->db->where_in('acl_category_id', $acl_category_id);
        }
        $this->db->order_by('sort', 'ASC');
        $result	= $this->db->get('acl_categories')->result();
        if(!$result)
        {
            return false;
        }

        foreach($result as $key=>$val)
        {
            $val->modules = $this->get_acl_modules_nav($val->acl_category_id, $acl_module_id, $acl_action_id, $is_sa , $role);
        }

//        echo '<pre>';
//		print_r($result);
//		die();


        return $result;
    }



	function get_acl_modules($id, $acl_module_id = false, $acl_action_id = false, $is_sa = false )
	{
		$this->db->select('*, \'\' AS actions');
		$this->db->where('acl_category_id', $id);
		$this->db->where('enabled', 1);
		if($is_sa == false and is_array($acl_module_id))
		{
			$this->db->where_in('acl_module_id', $acl_module_id);
		}
		$result	= $this->db->get('acl_modules')->result();
		if(!$result)
		{
			return false;
		}
		
		foreach($result as $key=>$val)
		{
			$val->actions = $this->get_acl_actions($val->acl_module_id, $acl_action_id, $is_sa);
		}

		return $result;
	}

    function get_acl_modules_nav($id, $acl_module_id = false, $acl_action_id = false, $is_sa = false ,  $role = false)
    {
        $this->db->select('*, \'\' AS actions');
        $this->db->where('acl_category_id', $id);
        $this->db->where('enabled', 1);
        if($is_sa == false and is_array($acl_module_id))
        {
            $this->db->where_in('acl_module_id', $acl_module_id);
        }
        $result	= $this->db->get('acl_modules')->result();
        if(!$result)
        {
            return false;
        }

        foreach($result as $key=>$val)
        {
            $val->actions = $this->get_roles_permission($val->acl_module_id, $acl_action_id, $is_sa, $role);
        }

        return $result;
    }



    function get_acl_actions($id, $acl_action_id = false, $is_sa = false)
	{
		$this->db->select('*');
		$this->db->where('acl_module_id', $id);
		$this->db->where('enabled', 1);
		if($is_sa == false and is_array($acl_action_id))
		{
			$this->db->where_in('acl_action_id', $acl_action_id);
		}
		$this->db->order_by('acl_action_id', 'ASC');
		$result	= $this->db->get('acl_actions')->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

    function get_roles_permission($id, $acl_action_id = false, $is_sa = false, $role = false)
    {
        $this->db->select('*');
        $this->db->where('acl_module_id', $id);
        $this->db->where('role_id', $role);
        if($is_sa == false and is_array($acl_action_id))
        {
            $this->db->where_in('acl_action_id', $acl_action_id);
        }
        $this->db->order_by('acl_action_id', 'ASC');
        $result	= $this->db->get('role_permissions')->result();
        if(!$result)
        {
            return false;
        }
        return $result;
    }

	function get_admin_module_action_by_slug($class, $method)
	{
		$this->db->select('m.slug AS module_slug');
		$this->db->select('a.*');
		$this->db->from('admin_modules AS m');
		$this->db->join('admin_module_actions AS a', 'm.admin_module_id = a.admin_module_id');
		$this->db->where('m.slug', $class);
		$this->db->where('a.slug', $method);
		$this->db->limit(1);
		$result	= $this->db->get()->row();
		
		if(!$result)
		{
			return false;
		}
		return $result;
	}


    function get_acl_module_id_by_slug($class)
    {
        $this->db->select('m.*');
        $this->db->from('acl_modules AS m');
        $this->db->where('m.slug', $class);
        $this->db->limit(1);
        $result	= $this->db->get()->row();

        if(!$result)
        {
            return false;
        }
        return $result;
    }

    function get_permissions($module_id, $method, $role_id)
    {

        if($method == 'index' or $method == 'list')
            $method = 'view';

        $restriced_method = array('view' , 'add' , 'edit' , 'delete');

        $this->db->select('*');
        $this->db->from('role_permissions');
        $this->db->where('acl_module_id', $module_id);
        $this->db->where('role_id', $role_id);

        if(in_array($method ,$restriced_method))
            $this->db->where($method, 1);

        $this->db->limit(1);
        $result	= $this->db->get()->num_rows();

        if(!$result)
        {
            return false;
        }
        return $result;
    }


	
	function get_admin_left_navigation($perms = false, $is_sa = false , $role = false)
	{
		if(!$perms and !$is_sa)return false;
		
		$categories = $modules = $actions = array();
		$perms = $this->get_role_permissions($role);
		if(is_array($perms)):
			foreach($perms as $key=>$val)
			{
				$categories[] 	= $val->acl_category_id;
				$modules[] 		= $val->acl_module_id;
				$actions[] 		= $val->acl_action_id;
			}
		endif;
		
		return $this->get_admin_module_categories_nav($categories, $modules, $actions, $is_sa , $role);
	}
	
	
	function save_module_action($data)
	{
		if ($data['admin_module_action_id'])
		{
			$this->db->where('admin_module_action_id', $data['admin_module_action_id']);
			$this->db->update('admin_module_actions', $data);
			$id	= $data['admin_module_action_id'];
		}
		else
		{
			$this->db->insert('admin_module_actions', $data);
			$id	= $this->db->insert_id();
		}
		return $id;
	}

	function save_admin_acl_actions($data,$id)
	{
		// $this->db->trans_start();
		// $this->db->where('acl_module_id', $id);
		// $this->db->delete('acl_actions');
		// $this->db->trans_complete();
		// if ($this->db->trans_status() === FALSE)
		// {
		// 	return false;
		// }
		return $this->db->insert('acl_actions', $data);
	}
	
	function save_module($data)
	{
		if ($data['admin_module_id'])
		{
			$this->db->where('admin_module_id', $data['admin_module_id']);
			$this->db->update('admin_modules', $data);
			$id	= $data['admin_module_id'];
		}
		else
		{
			$this->db->insert('admin_modules', $data);
			$id	= $this->db->insert_id();
		}
		return $id;
	}

	function save_module_category($data)
	{
		if ($data['admin_module_category_id'])
		{
			$this->db->where('admin_module_category_id', $data['admin_module_category_id']);
			$this->db->update('admin_module_categories', $data);
			$id	= $data['admin_module_category_id'];
		}
		else
		{
			$this->db->insert('admin_module_categories', $data);
			$id	= $this->db->insert_id();
		}
		return $id;
	}
	/***	Categories & Modules	***/
	
	

	/***	Roles	***/
	function admin_roles($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			return $this->get_all_admin_roles();
		}
		else
		{
			$this->db->select("*", FALSE);
			$this->db->from('roles');
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
//				$this->db->order_by($data['order_by'], $data['sort_order']);
			}
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('name', $search->term);
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
	
	function get_all_admin_roles()
	{
		$this->db->order_by('name', 'ASC');
		$result	= $this->db->get('roles')->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function save_admin_role($data)
	{
		if ($data['role_id'])
		{
			$this->db->where('role_id', $data['role_id']);
			$this->db->update('roles', $data);
			$id	= $data['role_id'];
		}
		else
		{
			$this->db->insert('roles', $data);
			$id	= $this->db->insert_id();
		}
		return $id;
	}
	
	function save_batch_admin_role($data)
	{
		$this->db->insert_batch('roles', $data);
		
		return true;
	}

	function is_admin_role_already_exist($str, $id=false)
	{
		$this->db->select('role_id');
		$this->db->from('roles');
		$this->db->where('name', $str);
		if ($id)
		{
			$this->db->where('role_id !=', $id);
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
	
	function get_admin_role($str)
	{
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where('role_id', $str);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		return $result;
	}
	
	function get_admin_role_by_id($str)
	{
		$this->db->select('*');
		$this->db->from('roles');
		$this->db->where('role_id', $str);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function admin_role_delete($id)
	{
		$this->db->where('role_id', $id);
		return $this->db->delete('roles');
	}

	function admin_role_check_name($str, $id=false)
	{
		$this->db->select('name');
		$this->db->from('roles');
		$this->db->where('name', $str);
		if ($id)
		{
			$this->db->where('role_id !=', $id);
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
	function get_admin_roles_menu()
	{
		$result = array();
		$data = $this->get_all_admin_roles(array('enabled'=>1));
		
		if(is_array($data)):
		foreach($data  as $key=>$val)
		{
			$result[$val->role_id] = $val->name;
		}
		endif;
		
		return $result;
	}

	/***	Roles	***/
	
	
	
	
	
	
	
	/***	Permissions	***/
	function get_role_permissions($id, $is_array = false)
	{
		$this->db->where('role_id', $id);
		$result	= $this->db->get('role_permissions')->{($is_array ? 'result_array' : 'result')}();
		if(!$result)
		{
			return false;
		}
		return $result;
	}



	function save_admin_role_permissions_batch($data, $id)
	{
		$this->db->trans_start();
		$this->db->where('role_id', $id);
		$this->db->delete('role_permissions');
		$this->db->trans_complete();
		if ($this->db->trans_status() === FALSE)
		{
			return false;
		}

//		echo '<pre>';
//		print_r($data);
//		die();

        foreach($data as $val) {
            $this->db->insert('role_permissions', $val);
        }

//		if(is_array($data))
//		return $this->db->insert_batch('role_permissions', $data);
//
		return TRUE;
	}
	/***	Permissions	***/





	/***	Users	***/
	function admin_users($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			return $this->get_all_admin_users();
		}
		else
		{
			$this->db->select("*", FALSE);
			$this->db->from('admin_users');
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
	
	function get_all_admin_users()
	{
		$this->db->order_by('first_name', 'ASC');
		$result	= $this->db->get('admin_users')->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}
	
	function get_admin_user($id)
	{
		$this->db->select('*');
		$this->db->where('admin_user_id', $id);
		$result	= $this->db->get('admin_users');
		$result	= $result->row();

		return $result;
	}		

	function save_admin_user($data)
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
		return $id;
	}

	function is_admin_user_already_exist($str, $id=false)
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
	
	function get_admin_user_by_id($str)
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

	function admin_user_delete($id)
	{
		$this->db->where('admin_user_id', $id);
		return $this->db->delete('admin_users');
	}

	function admin_user_check_name($str, $id=false)
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

	function check_admin_email($str, $id=false)
	{
		$this->db->select('email');
		$this->db->from('admin_users');
		$this->db->where('email', $str);
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
	/***	Users End	***/

	function get_admin_breadcrum()
	{
		$class 		= strtolower($this->router->fetch_class());
		$method 	= strtolower($this->router->fetch_method());
		$directory 	= strtolower($this->router->fetch_directory());
		
		$this->db->select('c.slug AS category_slug, c.name AS category_name, c.string_code_name AS category_string_code_name');
		$this->db->select('m.slug AS module_slug, m.name AS module_name, m.string_code_name AS module_string_code_name');
		$this->db->select('a.*, a.slug AS action_slug, a.name AS action_name, a.string_code_name AS action_string_code_name');
		$this->db->from('admin_module_actions AS a');
		$this->db->join('admin_modules AS m', 'a.admin_module_id = m.admin_module_id');
		$this->db->join('admin_module_categories AS c', 'm.admin_module_category_id = c.admin_module_category_id');
		$this->db->where('m.slug', $class);
		$this->db->where('a.slug', $method);
		$this->db->limit(1);
		$result	= $this->db->get()->row();
		//echo $this->db->last_query();
		
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}


}
// END Admin_Acl_model class

/* End of file Admin_Acl_model.php */
/* Location: ./application/models/admin/Admin_Acl_model.php */