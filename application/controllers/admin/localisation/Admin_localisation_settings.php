<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_localisation_settings extends Admin_Controller 
{
	protected $controller_dir 	 = 'localisation';
	protected $controller_prefix = 'admin_localisation_settings';
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->lang->load('settings');
		$this->load->model(array(
			'admin/localisation/Admin_localisation_setting_model', 
			'admin/localisation/Admin_language_model'));
	}
	
	function index($order_by="admin_language_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['result']	= $this->Admin_language_model->languages();
		
		$data['function']			= __FUNCTION__;
		$data['controller_dir']		= $this->controller_dir;
		$data['controller']			= $this->controller_prefix;
		
		$data['page_title']			= 'Localisation settings';
		$data['page_header']		= 'Localisation settings';
		
		$this->view($this->admin_view.'/localisation/localisation_settings', $data);
	}

	function admin_settings_add($culture_code = false)
	{
		$this->admin_settings_form($culture_code, 'general_config', __FUNCTION__);
	}
	
	function admin_settings_edit($culture_code = false)
	{
		$this->admin_settings_form($culture_code, 'general_config', __FUNCTION__);
	}
	
	private function admin_settings_form($culture_code = false, $config = 'general_config', $function = false)
	{
		$data['function']		= $function;
		$data['controller_dir']	= $this->controller_dir;
		$data['controller']		= $this->controller_prefix;

		$this->load->helper('form');
		$this->load->helper('date');
		$this->load->library('form_validation');
		
		$data['page_title']		= 'Localisation setting';
		$data['page_header']	= 'Localisation setting';
		
		$data['config']			= $config;
		$data['culture_code']	= $culture_code;
		
		// Tab General
		$data['company_name']		= '';
		$data['owner']				= '';
		$data['address1']			= '';
		$data['address2']			= '';
		$data['email']				= '';
		$data['phone']				= '';
		$data['fax']				= '';
		
		// Tab Store
		$data['title']				= '';
		$data['site_name']			= '';
		$data['site_tag_line']		= '';
		$data['meta']				= '';
		$data['meta_keywords']		= '';
		$data['meta_description']	= '';
		
		// Tab Local
		$data['weight_unit']	    = 'LB'; 	// LB, KG, etc
		$data['dimension_unit']  	= 'IN'; 	// IN, FT, CM, etc
		$data['currency']						= 'USD';  	// USD, EUR, etc, @TODO store_helper func, default_currency()
		$data['currency_symbol']				= '$';	// $, €, £ etc
		$data['currency_symbol_side']			= 'left'; 	// anything that is not "left" is automatically right
		$data['currency_decimal']				= '.';	// .
		$data['currency_number_decimal_points']	= 2;	// 2
		$data['currency_thousands_separator']	= ',';	// ,
		
		if($config)	
		{
			$general_config			= $this->Admin_localisation_setting_model->get_settings($culture_code, $config);
			foreach($general_config as $key=>$val)
				$data[$key]	= $val;
		}
		
		$this->form_validation->set_rules('company_name', 'lang:company_name', 'trim|required');
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]');
		$this->form_validation->set_rules('phone', 'lang:phone', 'trim|required|max_length[32]|callback_check_phone_number');
		$this->form_validation->set_rules('fax', 'lang:fax', 'trim|required|max_length[32]|callback_check_phone_number');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view.'/localisation/localisation_setting_form', $data);
		}
		else
		{
			foreach($this->input->post() as $key=>$val)
				$save[$key]	= $val;
				
			$this->Admin_localisation_setting_model->save_settings($culture_code, $config, $save);
			
			$this->admin_session->set_flashdata('message', lang('message_saved_settings'));
			
			redirect($this->admin_folder.'/localisation/admin_localisation_settings');
		}
		
	}

	function check_phone_number($number)
	{
		if(trim($number) == '')
		{
			return TRUE;
		}
		
		$result = validate_phone_format($number);
		
        if ($result)
       	{
			$this->form_validation->set_message('check_phone_number', lang('error_invalid_phone'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
}