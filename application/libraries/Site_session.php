<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

final class Site_session
{
	private $CI;
	private $site_params;
	private $site_session;
	
	function __construct()
	{
		$this->CI =& get_instance();
	}
		
	function set_cookie($params = array())
	{
		if(empty($params) or !is_array($params) or empty($params['name']))
		{
			return FALSE;
		}
		
		$default = array('name'=>'', 'value'=>'', 'expire'=>'', 'domain'=>'', 'path'=>'/', 'prefix'=>'', 'secure'=>NULL, 'httponly'=>NULL, );
		
		$args = array_merge($default, $params);
		
		//	set_cookie($name, $value = '', $expire = '', $domain = '', $path = '/', $prefix = '', $secure = NULL, $httponly = NULL)
		$cookie = array(
			'name'   	=> $args['name'],
			'value'  	=> $args['value'],
			'expire' 	=> $args['expire'],		//7776000,	//90 Days = 7,776,000 Seconds = 7776000 Seconds
			'domain'  	=> $args['domain'],
			'path'  	=> $args['path'],
			'prefix'  	=> $args['prefix'],
			'secure'  	=> $args['secure'],
			'httponly'  => $args['httponly'],
		);
		
		$this->CI->input->set_cookie($cookie);
	}
}