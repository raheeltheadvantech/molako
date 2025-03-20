<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_orders extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
			'admin/catalog/Admin_product_model',
			'admin/sales/Admin_order_model',
			'user/common/User_setting_model',
			'admin/sales/Admin_order_return_model',
			'admin/sales/Admin_customer_model',
		));

		
		$this->load->helper('formatting_helper');

		$this->controller_dir 	= 'sales';
		$this->controller_name 	= 'admin_orders';
		$this->view_dir 		= 'sales/orders';
	}


	function index()
	{
		$data['page_title']		= 'Admin Orders';
		$data['page_header']	= 'Admin Orders';

		$data['customers'] = $this->Admin_customer_model->get_customers(array('1'=>1));

        $customer_id= $this->input->get('customer_id') ? $this->input->get('customer_id') : '';
		$order 		= $this->input->get('order') ? $this->input->get('order') : '';
		$sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
		$code 		= $this->input->get('code') ? $this->input->get('code') : '';
		$page 		= $this->input->get('page') ? $this->input->get('page') : 0;
		$rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
		$per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';
		
		
		$term				= false;
		$data['code']		= $code;
		$post				= $this->input->post(null, false);
		
		$this->load->model('admin/Admin_search_model');
		
		if($post)
		{
			
			$term			= json_encode($post);
			$code			= $this->Admin_search_model->record_term($term);
			$data['code']	= $code;
			
			redirect(site_url($this->admin_folder .'/sales/orders.html?code='.$code));
		}
		elseif ($code)
		{
			$term			= $this->Admin_search_model->get_term($code);
		}
		
		
		$data['term']		= $term;
		$data['order_by']	= $order;
		$data['sort_by']	= $sort;
		
		$result	= $this->Admin_order_model->get_orders(array('term'=>$term, 'customer_id' => $customer_id, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
		$total	= $this->Admin_order_model->get_orders(array('term'=>$term, 'customer_id' => $customer_id, 'order'=>$order, 'sort'=>$sort), true);

		

		// echo "<pre>";print_r($result);exit();
		
		$data['result']	= $result;
		$data['total']	= $total;
		
		$config['base_url']	= site_url($this->admin_folder .'/sales/orders.html?order='.$order.'&sort='.$sort.'&code='.$code);
		
		$config['total_rows']			= $total;
		$config['per_page']				= $rows;
		$config['offset']				= $per_page;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($config);
		
		$this->view($this->admin_view .'/'. $this->view_dir .'/order_list', $data);
	}

	function order_return()
	{
		$data['page_title']		= 'Admin Product Returns';
		$data['page_header']	= 'Admin Product Returns';

		$data['customers'] = $this->Admin_customer_model->get_customers(array('1'=>1));

        $customer_id= $this->input->get('customer_id') ? $this->input->get('customer_id') : '';
		$order 		= $this->input->get('order') ? $this->input->get('order') : '';
		$sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
		$code 		= $this->input->get('code') ? $this->input->get('code') : '';
		$page 		= $this->input->get('page') ? $this->input->get('page') : 0;
		$rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
		$per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';
		
		
		$term				= false;
		$data['code']		= $code;
		$post				= $this->input->post(null, false);
		
		$this->load->model('admin/Admin_search_model');
		
		if($post)
		{
			
			$term			= json_encode($post);
			$code			= $this->Admin_search_model->record_term($term);
			$data['code']	= $code;
			
			redirect(site_url($this->admin_folder .'/sales/returns.html?code='.$code));
		}
		elseif ($code)
		{
			$term			= $this->Admin_search_model->get_term($code);
		}
		
		
		$data['term']		= $term;
		$data['order_by']	= $order;
		$data['sort_by']	= $sort;
		 
		$result	= $this->Admin_order_return_model->get_order_returns(array('term'=>$term, 'customer_id' => $customer_id, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
		$total	= $this->Admin_order_return_model->get_order_returns(array('term'=>$term, 'customer_id' => $customer_id, 'order'=>$order, 'sort'=>$sort), true);

		

		// echo "<pre>";print_r($result);exit();
		
		$data['result']	= $result;
		$data['total']	= $total;
		
		$config['base_url']	= site_url($this->admin_folder .'/sales/returns.html?order='.$order.'&sort='.$sort.'&code='.$code);
		
		$config['total_rows']			= $total;
		$config['per_page']				= $rows;
		$config['offset']				= $per_page;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($config);
		
		$this->view($this->admin_view .'/'. $this->view_dir .'/order_return', $data);
	}

	public function order_detail()
	{

		$data['page_title']		= 'Admin Order Details';
		$data['page_header']	= 'Order Details';
		$shipping_methods = $this->User_setting_model->get_shipping_methods();
		// dd($shipping_methods);
		$data['smethods'] = $shipping_methods;

		$order_id = '';
		if(!$this->input->get('id')){
			$this->admin_session->set_flashdata('error', 'Invalid order number to view the order details');
			redirect(site_url($this->admin_folder .'/sales/orders.html'));
		}else{
			$order_id = $this->input->get('id');
		}
		
		$order = $this->Admin_order_model->get_order($order_id);
		$order->products = $this->Admin_order_model->get_order_products($order_id);
		$order->totals = $this->Admin_order_model->get_order_totals($order_id);
		$order->history = $this->Admin_order_model->get_order_history($order_id);

		$data['order'] = $order;

		$data['order_status'] = $this->Admin_order_model->get_order_status();

		$this->view($this->admin_view .'/'. $this->view_dir .'/order_details', $data);
	}

	private function get_order($order_id = '')
	{

		$order = $this->Admin_order_model->get_order($order_id);
		$order->products = $this->Admin_order_model->get_order_products($order_id);
		$order->totals = $this->Admin_order_model->get_order_totals($order_id);
		$order->history = $this->Admin_order_model->get_order_history($order_id);
		return $order;
	}

	public function add_order_history()
	{
		$order_id = 0;
		if(!$this->input->get('id')){
			$this->admin_session->set_flashdata('error', 'Invalid order number to view the order details');
			redirect(site_url($this->admin_folder .'/sales/orders.html'));
		}else{
			$order_id = $this->input->get('id');
		}

		$this->form_validation->set_rules('order_status_id', 'Order Shipping status', 'trim|required');
		$this->form_validation->set_rules('payment_status_id', 'Order Payment status', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view .'/'. $this->view_dir .'/product_form', array('order' => $this->get_order($order_id)));
		} else {
			$order_history_input = array(
				'order_status_id'	=> $this->input->post('order_status_id'),
				'payment_status_id'	=> $this->input->post('payment_status_id'),
				'notify'			=> $this->input->post('notify') ? $this->input->post('notify') : 0,
				'comment'			=> $this->input->post('comment'),
				'order_id'			=> $order_id,
				'date_added'		=> date('Y-m-d H:i:s')
			);

			if($this->Admin_order_model->save_history($order_history_input)){
				$this->admin_session->set_flashdata('success', 'Order history has been save successfully');
				if($this->input->post('notify')){
					$order_info = $this->get_order($order_id);
					$email_input = (object)array(
						'order_shipping_status' 	=> $this->Admin_order_model->get_order_status_by_status_id($this->input->post('order_status_id')),
						'order_payment_status' 	=> $this->Admin_order_model->get_order_status_by_status_id($this->input->post('payment_status_id')),
						'order_id'		=> $order_id,
						'customer_id'	=> $order_info->customer_id,
						'email'	=> $order_info->email,
						'first_name'	=> $order_info->first_name,
						'last_name'	=> $order_info->last_name,
						'comment'	    => $this->input->post('comment'),
					);
					$this->send_order_status_email($email_input);
				}
			}else{
				$this->admin_session->set_flashdata('error', 'Order history has not been save successfully! try again!.');
			}
			redirect(site_url($this->admin_url.'/sales/orders.html'));
		}
	}

	private function send_order_status_email($data)
	{
		$this->load->model('admin/Admin_customer_model');
		$result = $this->Admin_customer_model->get_customer($data->customer_id);
		
		$message = $this->view_email($this->admin_view.'/emails/email_order_history', array('data'=>$data, 'result'=>$result), TRUE);

		$subject = site_config_item('config_name').' - Order updated';

		$from_email = site_config_item('config_mail_from_email');
		$from_name = site_config_item('config_mail_from_name');

		$this->load->library('email');
		$config['mailtype'] = 'html'; 
		$this->email->initialize($config);
		$this->load->model('Email_model');
		$e_1 = $this->Email_model->do_email($data->email,$subject, $message);

		// additional emails
		$additional_emails = site_config_item('config_alert_emails');
		$arr_emails = explode(',', $additional_emails);
		$arr_emails = array_map('trim', $arr_emails);
		if ($arr_emails) {
			foreach($arr_emails as $k=> $em)
			{
				$e_2 = $this->Email_model->do_email($em,$subject . ' - ADMIN', $message);
			}
		}
	}

}