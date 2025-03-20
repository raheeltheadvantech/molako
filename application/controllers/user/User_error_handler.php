<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_error_handler extends User_Public_Controller
{
	private $error_info = false;
	
	function __construct()
	{
		parent::__construct();
		
		$this->set_template('error-handler');
		
		$this->load->model('user/exception/User_error_handler_model');
		
		$this->set_error_info();
	}
	
	private function set_error_info()
	{
		$error_token = $this->input->get('error_token');
		if($error_token == '')
		{
			redirect(site_url());
		}
		
		$this->load->library('Encrypto');
		$error = false;
		$json = $this->encrypto->decode($error_token);
		if($json != '')
		{
			$error = json_decode($json, TRUE);
			if($error['error'] == 'YES')
			{
				$error_log_id = $error['id'];
				$this->error_info = $this->User_error_handler_model->get_error($error_log_id);
			}
			else
			{
				redirect(site_url());
			}
		}
	}
	
	function page_error()
	{
		$data['error_info'] = $this->error_info;
		$this->view($this->user_view.'/error-handler/user-error', $data);
	}
	
	function page_404()
	{
		$data['error_info'] = $this->error_info;
		$this->view($this->user_view.'/error-handler/user-404', $data);
	}
}
