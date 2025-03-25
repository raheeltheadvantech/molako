<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class User_page extends User_Public_Controller
{	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('user/common/User_page_model');

		$this->controller_name = 'user_page';
		$this->controller_dir = 'user/';
		$this->view_dir = 'page-content';
	}
	
	function index()
	{
		$slug = substr($this->uri->segment(2),0,-5);
		// $page_id = $this->input->get('page_id');

		$result	= $this->User_page_model->get_page($slug);
		if(!$result)
		{
			show_404();
		}
		
		$data['result']			= $result;
		$data['page_title']		= $result->meta_title;
		$data['page_header']	= $result->meta_title;
		
		$data['meta_title']			= $result->meta_title;
		$data['meta_keywords']		= $result->meta_keywords;
		$data['meta_description']	= $result->meta_description;
		
		$this->view($this->user_view .'/page-content/'. 'page', $data);
	}

}