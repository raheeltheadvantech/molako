<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_Acl {

	protected $CI;

	protected $user = 0;
	protected $role = 0;
	protected $permissions = array();
	protected $userdata = array();
	protected $navigation = array();

	public function __construct($config = array())
	{
		$this->CI = &get_instance();
		
		$this->CI->load->model('admin/Admin_acl_model');
		
		log_message('debug', 'ACL Admin Class Initialized');

		$this->initialize();
		
		$this->has_permission();



	}
	
	function initialize($config = array())
	{	
		$this->user = $this->CI->admin_session->userdata('admin');

		if($this->user)
		{
			$this->set_role();
			$this->set_role_permissions();
			$this->set_left_navigation();
		}
	}
	
	function set_left_navigation()
	{
		$this->navigation = $this->CI->Admin_acl_model->get_admin_left_navigation($this->permissions, (boolean)$this->user['is_sa'] ,$this->role);
	}
	
	function get_left_navigation()
	{
		return $this->navigation;
	}
	
	function set_role_permissions()
	{
		$this->permissions = $this->CI->Admin_acl_model->get_role_permissions($this->role);
	}
	
	function get_role_permissions()
	{
		return $this->permissions;
	}

	function get_role()
	{
		return $this->role;
	}
	
	function set_role()
	{
		$this->role = $this->user['admin_role_id'];
	}

	public function __get($key)
	{
		return ( ! isset($this->userdata[$key])) ? FALSE : $this->userdata[$key];
	}
	
	public function __set($key, $value)
	{
		$this->userdata[$key] = $value;
	}
	
	public function has_permission()
	{
		$directory 	= strtolower($this->CI->router->fetch_directory());
		$controller = strtolower($this->CI->router->fetch_class());
		$method 	= strtolower($this->CI->router->fetch_method());
		$ignore_control_list = array('admin_dashboard', 'admin_login');

		if($this->user) {
            if ($this->user['is_sa'] == 1) return true;


            if (!in_array($controller, $ignore_control_list)) {

                $res = $this->CI->Admin_acl_model->get_acl_module_id_by_slug($controller);
                if ($res) {
                    $module_id = $res->acl_module_id;
                    $result = $this->CI->Admin_acl_model->get_permissions($module_id, $method , $this->user['admin_role_id']);
                    if (!$result) {
                        //$this->CI->admin_session->set_flashdata('error', lang('error_access_not_allowed'));
                        redirect($this->CI->admin_folder.'/access_error.html');
                        return false;
                    } else {
                        return true;

                    }

                }


            }
        }
		return true;
	}
	
	function get_admin_module_action($class = false, $method = false)
	{
		if(!$class)
		{
			$class = $this->CI->router->fetch_class();
		}
		
		if(!$method)
		{
			$method = $this->CI->router->fetch_method();
		}
		
		return $this->CI->Admin_acl_model->get_admin_module_action_by_slug($class, $method);

	}


}

/* End of file Acl_admin.php */
/* Location: ./application/libraries/Acl_admin.php */