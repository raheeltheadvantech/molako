<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once(dirname(__FILE__) . '/Site_config.php');

class Site_config_admin extends Site_config
{
	function __construct()
	{
		parent::__construct();
		
		$this->cookie_name = 'a_config';
		
		self::set_site_params();
		
		parent::set_default_config();
	}
	
	final function set_site_params($params = false)
	{
		$args = array(
		
		'user'			=> 'admin',
		
		);
		
		parent::set_site_params($args);
	}
}
