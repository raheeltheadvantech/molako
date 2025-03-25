<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_order extends User_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'user/checkout/User_checkout_model',
			'user/common/User_setting_model',
			));

		$this->controller_name = 'user_order';
		$this->controller_dir = 'account';
		$this->view_dir = 'account/sale/order';
	}
	
    function index()
	{
		$this->current_active_nav   = 'order-history';
		$data['page_title']			= 'Order History';
		$data['page_header']		= 'Order History';

        $order 		= $this->input->get('order') ? $this->input->get('order') : '';
        $sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code 		= $this->input->get('code') ? $this->input->get('code') : '';
        $page 		= $this->input->get('page') ? $this->input->get('page') : 0;
        $rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';

        $term 	= $this->input->get('term') ? $this->input->get('term') : '';
		//$result = $this->User_checkout_model->get_orders(array());

        $result = $this->User_checkout_model->get_orders(array('customer_id' => $this->customer_id,'term'=> $term, 'order'=> $order, 'sort'=> $sort, 'rows'=> $rows, 'per_page'=> $per_page));
        $total 	= $this->User_checkout_model->get_orders(array('customer_id' => $this->customer_id), true);


        $data['orders']	= $result;
        $data['total']	= $total;

        $config['base_url']	= site_url($this->user_url .'/secure/order-history.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']			= $total;
        $config['per_page']				= $rows;
        $config['offset']				= $per_page;
        $config['uri_segment']			= $this->uri->total_segments();
        $config['use_page_numbers'] 	= TRUE;
        $config['page_query_string'] 	= TRUE;
        $config['reuse_query_string'] 	= TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);


		$this->view($this->user_view .'/'. $this->view_dir .'/order-list', $data);
	}

	function order_detail()
	{
		$this->current_active_nav   = 'order-history';
		$data['page_title']			= 'Order Detail';
		$data['page_header']		= 'Order Detail';
		$shipping_methods = $this->User_setting_model->get_shipping_methods();
		// dd($shipping_methods);
		$data['smethods'] = $shipping_methods;


		$order_id = '';
		if(!$this->input->get('id')){
			$this->user_session->set_flashdata('error', 'You are trying to view order with Invalid order id');
			redirect(site_url('secure/order-history.html'));
		}else{
			$order_id = $this->input->get('id');
		}


		$order = $this->User_checkout_model->get_order($order_id);
		if($order->customer_id != $this->customer_id){
			$this->user_session->set_flashdata('error', 'You have no permissions to view this order');
			redirect(site_url('secure/order-history.html'));
		}
		$order->products = $this->User_checkout_model->get_order_products($order_id);
		$order->totals = $this->User_checkout_model->get_order_totals($order_id);
		$order->history = $this->User_checkout_model->get_order_history($order_id);

		$data['order'] = $order;
		// echo'<pre>';print_r($order->products);die;


		$this->view($this->user_view .'/'. $this->view_dir .'/order-details', $data);
	}

	function transactions_list()
	{
		$this->view_dir = 'customer/order';
		$this->current_active_nav   = 'transactions';
		$data['page_title']			= 'Transaction List';
		$data['page_header']		= 'Transaction List';

		$this->view($this->user_view .'/'. $this->view_dir .'/transactions', $data);
	}

}
