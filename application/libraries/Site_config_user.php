<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/Site_config.php');

class Site_config_user extends Site_config
{
	function __construct()
	{
		parent::__construct();
		
		$this->cookie_name = 'u_lang';
		
		self::set_site_params();
		
		parent::set_default_config();
	}
	
	final function set_site_params($params = false)
	{
		$args = array(
		
		'user'			=> 'admin',
		'culture_code' 	=> $this->CI->config->item('culture_code'),
		'cookie' 		=> array(
							'prefix'=> '_',
							'name'  => $this->cookie_name,
							'value' => $this->CI->config->item('culture_code'),
							'path'	=> rtrim($this->CI->config->item('cookie_path'), '/').'/'.$this->CI->config->item('user_folder'),
							)
		);
		
		parent::set_site_params($args);
	}
}
