<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class  Auth_user
{
	private $CI;
	private $folder_path;
	private $session_expire;

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
		$this->CI->load->library('encrypt');
		
		$this->folder_path = strtolower($this->CI->config->item('user_folder'));
		$this->session_expire = !empty($this->CI->config->item('user_session_exipry')) ? $this->CI->config->item('user_session_exipry') : 10600 ;
		$cookie_path = rtrim($this->CI->config->item('cookie_path'), '/').'/'.$this->folder_path;
		$save_path = 'sessions_u';
		
		$config = array(
			'cookie_name' 		=> '_u_secure',
		    'sess_expiration' 	=> 0,
			'cookie_path'		=> $cookie_path,
			'save_path'			=> $save_path
		);
		
		$this->CI->load->library('session', $config, 'user_session');
	}
	
	function is_logged_in()
	{
		$user = $this->CI->user_session->userdata('user');
		if (!$user)
		{
			return false;
		}
		else
		{
			if($user['expire'] && $user['expire'] < time())
			{
				$this->logout();
				
				return false;
			}
			else
			{
				if($user['expire'])
				{
					$user['expire'] = time()+$this->session_expire;
					$this->CI->user_session->set_userdata(array('user'=>$user));
				}
			}
			
			return true;
		}
	}
	
	function login($email, $password, $remember=false)
	{
		$this->CI->db->select('a.*');
		$this->CI->db->from('customers AS a');
		$this->CI->db->where('a.email', $email);
		$this->CI->db->where('a.password',  md5($password));
		$this->CI->db->where('a.is_enabled', 1);
		$this->CI->db->limit(1);
		$result = $this->CI->db->get()->row_array();
//		echo '<pre>';
//		print_r($result);
//
//		die('ddd');

		if (isset($result) && sizeof($result) > 0)
		{
			$user = array();
			$user['user']					= array();
			$user['user']['id']				= $result['customer_id'];
			$user['user']['customer_id']	= $result['customer_id'];
			$user['user']['first_name']		= $result['first_name'];
			$user['user']['last_name']		= $result['last_name'];
			$user['user']['email']			= $result['email'];
			$user['user']['cell']			= (isset($result['cell'])?$result['cell']:'');
			$user['user']['user_role_id']	= (isset($result['user_role_id'])?$result['user_role_id']:'');
			
			if(!$remember)
			{
				$user['user']['expire'] = time()+$this->session_expire;
			}
			else
			{
				$user['user']['expire'] = false;
			}
			
			$this->CI->user_session->set_userdata($user);
			
			return true;
		}
		else
		{
			return false;
		}
	}


	function is_password_correct($email, $password)
	{

		$this->CI->db->select('a.*');
		$this->CI->db->from('customers AS a');
		$this->CI->db->where('a.email', $email);
		$this->CI->db->where('a.password',  md5($password));
		$this->CI->db->where('a.is_enabled', 1);
		$this->CI->db->limit(1);
		$result = $this->CI->db->get()->row_array();
		if (isset($result) && sizeof($result) > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function logout()
	{
		$this->CI->user_session->unset_userdata('user');
		$this->CI->user_session->sess_destroy();
	}
}
