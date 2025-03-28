<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

abstract class Site_config
{
	protected $CI;
	protected $cookie_name = '_config';
	private $site_params;
	private $site_config;
	
	function __construct()
	{
		$this->CI =& get_instance();
		
		self::set_site_params( array(
		
		'abs'			=> 'yes',));
	}
	
	private function get_site_params()
	{
		return self::site_params;
	}
	
	protected function set_site_params($params = false)
	{
		$args = array(
		
		'user'			=> '',
		);
		
		if(!empty($params) and is_array($params))
		{
			//$args = array_merge($args, $params);
			foreach($params as $key=>$val)
			{
				if(!empty($val) and is_array($val)):
				foreach($val as $key2=>$val2)
				{
					$args[$key][$key2] = $val2;
				}
				else:
					$args[$key] = $val;
				endif;
			}
		}
		
		$this->site_params = $args;
	}
	
	function set_default_config()
	{
	}
	
	function set_config($culture_code = '')
	{
	}
	
	public function set_item($item, $value)
	{
		$this->site_config =& get_config();
		
		$this->site_config[$item] = $value;
	}
	
	public function item($item, $index = '')
	{
		$this->site_config =& get_config();
		
		if ($index == '')
		{
			return isset($this->site_config[$item]) ? $this->site_config[$item] : NULL;
		}
		
		return isset($this->site_config[$index], $this->site_config[$index][$item]) ? $this->site_config[$index][$item] : NULL;
	}
	
	function get_config()
	{
		return $this->site_config;
	}
	
}