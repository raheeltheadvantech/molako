<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_dashboard extends User_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'dashboard';
		$this->controller_dir = 'account';
		$this->view_dir = 'account';

		$this->load->model(array(
			'user/checkout/User_checkout_model',
			'user/common/Customer_model',
			'user/catalog/User_catalog_model',
		));
	}
	
	function index()
	{
		$this->dashboard();
	}
	
	function dashboard()
	{
		$this->current_active_nav = 'dashboard';
		$data['page_title']			= 'Dashboard';
		$data['page_header']		= 'Dashboard';
		$data['user'] = $this->Customer_model->get_by_id($this->customer_id);

		$data['total_orders'] = $this->User_checkout_model->get_orders(array('customer_id' => $this->customer_id), true);
		$cart = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();

        $data['total_wish_list_items'] = 0;
		if(!empty($this->User_catalog_model->get_wish_list($this->customer_id)))
		$data['total_wish_list_items'] = count($this->User_catalog_model->get_wish_list($this->customer_id));

		$data['total_cart_items'] = count($cart);
		$data['latest_orders'] = $this->User_checkout_model->get_orders(array('customer_id'=>$this->customer_id, 'rows' => 5, 'sort' => 'DESC'));

		$this->view($this->user_view .'/'. $this->view_dir .'/user_dashboard', $data);
	}

}
