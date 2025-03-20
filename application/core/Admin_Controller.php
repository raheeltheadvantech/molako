<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Controller extends Admin_Public_Controller {

    function __construct()
    {

        parent::__construct();

		$this->load->library('Auth_admin');

        $this->load->library('Admin_acl');


		if( !$this->auth_admin->is_logged_in())
		{
			if($this->input->is_ajax_request())
			{
				ajax_response(array('error'=>true, 'message'=>'Please re-login to continue.'));
			}
			else
			{
				redirect(site_url($this->admin_folder.'/login.html'));
			}
		}
		
        $this->set_template('default');
    }
	
	function phery()
	{
		$this->load->library('PheryUtils');
		$this->phery = PheryResponse::factory();
		$this->pheryutils->init($this, 
			array(
			//'before' => array($this, 'is_logged_in_ajax')
			'before' => 'is_logged_in_ajax'
			)
		);
	}
	
}

function is_logged_in_ajax($posted = NULL)
{
	$CI =& get_instance();
	$response = PheryResponse::factory();
	
	if (Phery::is_ajax(true))
	{
		$login	= $CI->auth_admin->is_logged_in(false, false);
		if (!$login)
		{
			$response
				//->html(set_js_message(lang('000000000160'), 'error'), $js_error_container)
				//->jquery($js_error_container)->show('fast')
				->call('redirect', site_url($CI->admin_folder.'/login'), 0)
				;
			echo $response;
			exit;
		}
		
	}
	
	return $posted;
}
