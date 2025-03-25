<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_login extends Admin_Public_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'login';
		$this->controller_dir = '';
		$this->view_dir = '';
	}
	
	function login()
	{
		redirect($this->admin_folder.'/login.html');
	}
	
	function index()
	{
		$login	= $this->auth_admin->is_logged_in();
		if ($login)
		{
			redirect($this->admin_folder.'/dashboard.html');
		}
		//echo 'template = '.$this->get_template();
		
		$data['page_title']	= 'Admin login';
		$data['page_title']	= 'Admin login';

		$this->set_bodyclass('login');
		
		
		$data['email'] 		= '';
		$data['password'] 	= '';
		$data['remember'] 	= 0;
		
		
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'lang:password', 'trim|required');
		$this->form_validation->set_rules('remember', 'lang:remember', 'trim');
		$this->form_validation->set_rules('submitted', 'submitted', 'trim|required|callback__do_authorize');
		
		if ($this->form_validation->run() == FALSE)
		{
        	$this->view($this->admin_view.'/login', $data);
		}
		else
		{
			redirect($this->admin_folder.'/dashboard.html');
		}
	}
	
	function _do_authorize()
	{
		$email		= $this->input->post('email');
		$password	= $this->input->post('password');
		$remember   = $this->input->post('remember');
		
		if( trim($email) == '' Or trim($password) == '' )
		{
			return TRUE;
		}
		
		if( function_exists('validation_errors') and validation_errors())
		{
			return TRUE;
		}
		
		$result	= $this->auth_admin->login_admin($email, $password, $remember);
		
		if ( $result === FALSE )
       	{
			$this->admin_session->set_flashdata('error', 'Authentication failed, please check your username or password.');
			//$this->form_validation->set_message('_do_authorize', 'Unable to authorized, please check your username or password.');
			$this->form_validation->set_message('_do_authorize', 'NO_ERROR');
			
			return FALSE;
		}
		
		return TRUE;
	}
	
	function logout()
	{
		$this->auth_admin->logout();
		
		//when someone logs out, automatically redirect them to the login page.
		$this->admin_session->set_flashdata('message', lang('message_logged_out'));
		redirect($this->admin_folder.'/login.html');
	}

	function forgot_password()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$data['page_title']	= '';lang('forgot_password');
		$data['email'] = '';
		$submitted = $this->input->post('submitted');
		
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|max_length[128]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->load->view($this->admin_folder.'/forgot_password', $data);
		}
		else
		{
			$this->load->helper('string');
			$email = $this->input->post('email');
			
			$reset = $this->auth_admin->reset_password($email);
			
			if ($reset)
			{
				$this->admin_session->set_flashdata('message', lang('message_new_password'));
			}
			else
			{
				$this->admin_session->set_flashdata('error', lang('error_no_account_record'));
			}
			
			redirect($this->admin_folder.'/login/forgot_password.html');
		}
		
	}

}
