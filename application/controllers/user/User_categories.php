<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_categories extends User_Public_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->model(
			array(
				'user/common/User_page_model',
				'user/catalog/User_catalog_model',
				'user/common/User_contact_us_model',
			)
		);

		$this->controller_name = 'contact';
		$this->controller_dir = '';
		$this->view_dir = 'page-content';
	}


	function index(){
        $data = array();

        $data['categories'] = all_category_tree();

        $this->view($this->user_view . '/' . $this->view_dir . '/category-page', $data);
	}


}
