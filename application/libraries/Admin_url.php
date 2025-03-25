<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_url {

	protected $CI;

	protected $user = 0;

	public function __construct($config = array())
	{
		$this->CI = &get_instance();
		
		log_message('debug', 'URL Admin Class Initialized');
		
	}
	
	function set_admin_url()
	{	
		$this->user = $this->CI->admin_session->userdata('admin');
		if($this->user)
		{
			$admin_user_id 	= $this->user['admin_user_id'];
			$directory 		= strtolower($this->CI->router->fetch_directory());
			$class 			= strtolower($this->CI->router->fetch_class());
			$method 		= strtolower($this->CI->router->fetch_method());
			
			$now = date("Y-m-d H:i:s");
			
			$save['admin_user_id'] 		= $admin_user_id;
			$save['directory_name'] 	= $directory;
			$save['class_name'] 		= $class;
			$save['method_name'] 		= $method;
			$save['url']				= uri_string();
			$save['date_added']			= $now;


			$this->CI->db->select('*');
			$this->CI->db->where(array('admin_user_id'=>$admin_user_id));
			$result	= $this->CI->db->limit(1)->get('admin_url')->row_array();
			
			if(!$result)
			{
				$this->CI->db->insert('admin_url', $save);
				return $this->CI->db->insert_id();
			}
			
			$this->CI->db->where('admin_user_id', $admin_user_id);
			$this->CI->db->update('admin_url', $save);
		}
	}

	function get_admin_url()
	{
		$this->user = $this->CI->admin_session->userdata('admin');
		if($this->user)
		{
			$this->CI->db->select('*');
			$this->CI->db->from('admin_url');
			$this->CI->db->where('admin_user_id', $this->user['admin_user_id']);
			$result	= $this->CI->db->get()->row();
			if(!$result)
			{
				return false;
			}
			
			return $result;
		}
		
		return false;
	}

}

/* End of file Admin_Url.php */
/* Location: ./application/libraries/Admin_Url.php */