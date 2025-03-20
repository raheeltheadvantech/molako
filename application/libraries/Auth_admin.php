<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Auth_admin
{
	private $CI;
	private $folder_path;
	private $session_expire;

	function __construct()
	{


	    $this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('encrypt');

		$this->folder_path = strtolower($this->CI->config->item('admin_folder'));
		$this->session_expire = !empty($this->CI->config->item('admin_session_exipry')) ? $this->CI->config->item('admin_session_exipry') : 10600 ;
		$cookie_path = rtrim($this->CI->config->item('cookie_path'), '/').'/'.$this->folder_path;
		$save_path = 'sessions_a';	//$this->CI->config->item('save_path_admin');
		
		$config = array(
		//	'sess_cookie_name' => '_admin',
			'cookie_name' 		=> /*$this->CI->config->item('cookie_prefix').*/'_a_secure',
		    'sess_expiration' 	=> 0,
			'cookie_path'		=> $cookie_path,
			'save_path'			=> $save_path
		);

		$this->CI->load->library('session', $config, 'admin_session');

	}
	
	function is_logged_in()
	{

	    $admin = $this->CI->admin_session->userdata('admin');
		if (!$admin)
		{
			return FALSE;
		}
		else
		{
			if($admin['expire'] && $admin['expire'] < time())
			{
				$this->logout();
				
				return FALSE;
			}
			else
			{
				if($admin['expire'])
				{
					$admin['expire'] = time() + $this->session_expire;
					//$this->CI->admin_session->admin_object = (object)$admin;
					$this->CI->admin_session->set_userdata(array('admin'=>$admin));
				}
			}
			
			return TRUE;
		}
	}
	
	function login_admin($email, $password, $remember=false)
	{
		$this->CI->db->select('a.*');
		$this->CI->db->from('admin_users AS a');
		$this->CI->db->where('a.email', $email);
		$this->CI->db->where('a.password', sha1($password));
		$this->CI->db->limit(1);
		$result = $this->CI->db->get()->row_array();
		
		if (isset($result) && sizeof($result) > 0)
		{
			$admin = array();
			$admin['admin']						= array();
			$admin['admin']['id']				= $result['admin_user_id'];
			$admin['admin']['admin_user_id']	= $result['admin_user_id'];
			$admin['admin']['first_name']		= $result['first_name'];
			$admin['admin']['last_name']		= $result['last_name'];
			$admin['admin']['email']			= $result['email'];
			$admin['admin']['admin_role_id']	= $result['admin_role_id'];
			$admin['admin']['is_sa']			= $result['is_sa'];
			$admin['admin']['culture_code']		= $result['culture_code'];
			
			if(!$remember)
			{
				$admin['admin']['expire'] = time()+$this->session_expire;
			}
			else
			{
				$admin['admin']['expire'] = false;
			}

			$this->CI->admin_session->set_userdata($admin);


			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function logout()
	{
		$this->CI->admin_session->unset_userdata('admin');
		$this->CI->admin_session->sess_destroy();
	}
	
	function reset_password($email)
	{
		$admin = $this->get_admin_by_email($email);
		if ($admin)
		{
			$this->CI->load->helper('string');
			$this->CI->load->library('email');
			
			$config['mailtype'] = 'html';
			$this->CI->email->initialize($config);

			$new_password		= random_string('alnum', 8);
			$admin['password']	= sha1($new_password);
			$this->save($admin);
			
			$this->CI->email->from($this->CI->config->item('email'), $this->CI->config->item('site_name'));
			$this->CI->email->to($email);
			$this->CI->email->subject($this->CI->config->item('site_name').': Admin Password Reset');
			$this->CI->email->message('Your password has been reset to '. $new_password .'.');
			$this->CI->email->send();
			
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	
	function get_admin_by_email($email)
	{
		$this->CI->db->select('*');
		$this->CI->db->where('email', $email);
		$this->CI->db->limit(1);
		$result = $this->CI->db->get('admin');
		$result = $result->row_array();

		if (sizeof($result) > 0)
		{
			return $result;	
		}
		else
		{
			return FALSE;
		}
	}
			
	function get_permissions($controller = false, $method = false)
	{
		$current_admin	= $this->CI->admin_session->userdata('admin');
		
		if($current_admin)
		{
			return $current_admin['permissions'];
		}
		
		return FALSE;
	}
	
	function get_admin_user($id)
	{
		$this->CI->db->select('*');
		$this->CI->db->where('admin_user_id', $id);
		$result	= $this->CI->db->get('admin');
		$result	= $result->row();

		return $result;
	}		
	
	function check_id($str)
	{
		$this->CI->db->select('admin_user_id');
		$this->CI->db->from('admin');
		$this->CI->db->where('admin_user_id', $str);
		$count = $this->CI->db->count_all_results();
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return FALSE;
		}	
	}
	
	function check_email($str, $id=false)
	{
		$this->CI->db->select('email');
		$this->CI->db->from('admin');
		$this->CI->db->where('email', $str);
		if ($id)
		{
			$this->CI->db->where('admin_user_id !=', $id);
		}
		$count = $this->CI->db->count_all_results();
		
		if ($count > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function delete($id)
	{
		if ($this->check_id($id))
		{
			$admin	= $this->get_admin($id);
			$this->CI->db->where('admin_user_id', $id);
			$this->CI->db->limit(1);
			$this->CI->db->delete('admin');

			return $admin->firstname.' '.$admin->lastname.' has been removed.';
		}
		else
		{
			return 'The admin could not be found.';
		}
	}
}