<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
	}
}

class Base_Controller extends MY_Controller
{
	public $form_validation_class_name = 'Form_validation';
	
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('site_session');
	}
	
	function phery()
	{
		$this->load->library('PheryUtils');
		$this->phery = PheryResponse::factory();
		$this->pheryutils->init($this);
	}
	
	protected function load_lang_user()
	{
		$lang = array();
		$file_lang = '';
		
		$files = glob( APPPATH. '/language/english'. '/*.php');
		foreach ($files as $file)
		{
			if (($found = file_exists($file)) === TRUE)
			{
				include($file);
			}
		}
		
		
		$this->lang->language = array_merge($this->lang->language, $lang);
		
		log_message('info', 'Language loaded: FrontEnd');
		return TRUE;
	}
	
	protected function load_lang_admin()
	{
		$lang = array();
		$file_lang = '';
		
		
		$files = glob( APPPATH. '/language/english'. '/*.php');
		foreach ($files as $file)
		{
			if (($found = file_exists($file)) === TRUE)
			{
				include($file);
			}
		}
		
		$this->lang->language = array_merge($this->lang->language, $lang);
		
		log_message('info', 'Language loaded: BackEnd');
		return TRUE;
	}
}

class Module_Base_Controller extends Base_Controller
{
	public $module_dir = 'modules';
	public $module_name = '';
	
	public function __construct()
	{
		//parent::__construct();
	//	$this->load = clone load_class('Loader');
	//	$this->load->initialize($this);
	//	$this->load->database('', FALSE, NULL, TRUE);
		
		//if(empty($this->load))
		//{
		$CI =& get_instance();
			foreach($CI as $key=>$val)
			{
				//$this->{$key} = ( is_object($val) ? clone $CI->$key : $val);
				$this->{$key} = $val;
			}
		//}
		
		$CI->module_dir = 'modules';
		$CI->module_name = '';
		
		$this->load->library('site_session');
		
		//$this->load->library('Email_template', '', 'Email_mananger');
	}
}


class MY_Module extends Module_Base_Controller
{
	protected $_module;
	
	public function __construct()
	{
		parent::__construct();
		
		//$this->set_module();
	}
	
	private function set_module()
	{
		$class = new ReflectionClass($this);
		$file = $class->getFileName();
		$module = basename($file);
		$module = strtolower($module);
		$module = str_replace('.php', '', trim($module));
		$module = ucfirst($module);
		
		$this->_module = $module;
	//	var_dump($this->_module);
		$this->module_name = strtolower($module);
		
	//	$CI =& get_instance();
	//	$CI->module_dir = 'modules';
	//	$CI->module_name = strtolower($module);
	}
}

