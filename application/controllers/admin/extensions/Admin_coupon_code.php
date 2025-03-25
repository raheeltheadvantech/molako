<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_coupon_code extends Admin_Controller {
		
	function __construct()
	{
		parent::__construct();
		
		$this->controller_dir = 'extensions';
		$this->controller_name = 'admin_coupon_code';
		$this->view_dir = 'extensions/coupon_code';
		
		$this->load->model('admin/extensions/Admin_coupon_code_model');
	}
	
	function index()
	{
		$data['coupon_code_title']	= 'coupon_code';
		$data['coupon_code_header']= 'coupon_code';
		
		$params = array();
		
		$order 		= $this->input->get('order') ? $this->input->get('order') : 'id';
		$sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
		$code 		= $this->input->get('code') ? $this->input->get('code') : '';
		$coupon_code 		= $this->input->get('coupon_code') ? $this->input->get('coupon_code') : 0;
		$rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
		$per_coupon_code 	= $this->input->get('per_coupon_code') ? $this->input->get('per_coupon_code') : '';
		
		
		$term				= false;
		$data['code']		= $code;
		$post				= $this->input->post(null, false);
		
		$this->load->model('admin/Admin_search_model');
		
		if($post)
		{
			$term			= json_encode($post);
			$code			= $this->Admin_search_model->record_term($term);
			$data['code']	= $code;
			
			redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/coupon_code.html?code='.$code));
		}
		elseif ($code)
		{
			$term			= $this->Admin_search_model->get_term($code);
		}
		
		$data['term']		= $term;
		$data['order_by']	= $order;
		$data['sort_by']	= $sort;
		
		
		
		$result	= $this->Admin_coupon_code_model->get_coupon_codes(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_coupon_code'=>$per_coupon_code));
		$total	= $this->Admin_coupon_code_model->get_coupon_codes(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort), true);
		
		$data['result']	= $result;
		$data['total']	= $total;
		
		$config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/coupon_code.html?order='.$order.'&sort='.$sort.'&code='.$code);
		
		$config['total_rows']			= $total;
		$config['per_coupon_code']				= $rows;
		$config['offset']				= $per_coupon_code;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_coupon_code_numbers'] 	= TRUE;
		$config['coupon_code_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($config);
		// ********************************
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// $data['coupon_code_title']	= lang('coupon_code');
		// $data['coupon_code']		= $this->Admin_coupon_code_model->get_coupon_codes();
		
		$this->view($this->admin_view .'/'. $this->view_dir. '/coupon_code_list', $data);
	}
	
	/********************************************************************
	edit coupon_code
	********************************************************************/
	function do_authorize_ajax()
	{
		
		$coupon_code		= $this->input->post('coupon_code');
		
		
		if( function_exists('validation_errors') and validation_errors())
		{
		
			return false;
		}
		else
		{
			$result	= $this->Admin_coupon_code_model->get_coupon_code_by_code($coupon_code);
			
			
			if ($result)
	       	{
				$this->form_validation->set_message('do_authorize_ajax', 'Coupon code should be unique');
				return FALSE;
			}
		}
		
		return TRUE;
	}
	function form($id = false)
	{
		if($id === false)
		{
			$id = $this->input->get('id');
		}
		
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');


		$data['discount_type_list']= array('percent'=>'percent', 'fixed'=>'fixed');
		
		//set the default values
		$data['id']				= '';
		$data['coupon_name']	= '';
		$data['coupon_code']	= '';
		$data['coupon_count']	= '';
		$data['discount_type']	= '';
		$data['discount_value']= '';
		
		$data['start_date']		= '';
		$data['end_date']		= '';
		$data['enabled']		= '';

		$data['coupon_codes']		= $this->Admin_coupon_code_model->get_coupon_codes();
		
		if($id)
		{
			$coupon_code			= $this->Admin_coupon_code_model->get_coupon_code($id);
			if(!$coupon_code)
			{
				//coupon_code does not exist
				$this->admin_session->set_flashdata('error', lang('error_coupon_code_not_found'));
				redirect($this->admin_folder .'/'. $this->controller_dir . '/coupon_code.html');
			}
			
			//set values to db values
			$data['id']				= $coupon_code->id;
			$data['coupon_name']	= $coupon_code->coupon_name;
			$data['coupon_code']	= $coupon_code->coupon_code;
			$data['coupon_count']	= $coupon_code->coupon_count;
			$data['discount_type']	= $coupon_code->discount_type;
			$data['discount_value']	= $coupon_code->discount_value;

			$data['start_date']		= $coupon_code->start_date;
			$data['end_date']		= $coupon_code->end_date;
			$data['enabled']		= $coupon_code->enabled;
			
		}
		
		$this->form_validation->set_rules('coupon_name', 'Coupon Name', 'trim|required');
		$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'trim|required|min_length[10]');
		$this->form_validation->set_rules('coupon_count', 'Coupon Count', 'trim|required');
		$this->form_validation->set_rules('discount_type', 'coupon_code Type', 'trim|required');
		$this->form_validation->set_rules('discount_value', 'coupon_code Value', 'trim|required');
		
		$this->form_validation->set_rules('start_date', 'Start Date', 'trim|required');
		$this->form_validation->set_rules('end_date', 'End Date', 'trim|required');
		$this->form_validation->set_rules('coupon_code', 'submitted', 'trim|required|callback_do_authorize_ajax');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->admin_view .'/'. $this->view_dir. '/coupon_code_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			//validate the slug
			$this->load->model('admin/Admin_routes_model');

			if($id)
			{
				$slug		= $this->Admin_routes_model->validate_slug($slug, $coupon_code->route_id);
				$route_id	= $coupon_code->route_id;
			}

			$save = array();
			$save['id']				= $id;
			$save['coupon_name']	= $this->input->post('coupon_name');
			$save['coupon_code']	= $this->input->post('coupon_code');
			$save['coupon_count']	= $this->input->post('coupon_count');
			$save['discount_type']	= $this->input->post('discount_type');
			$save['discount_value']	= $this->input->post('discount_value');
			$save['route_id']		= $route_id;
			$save['start_date']		= $this->input->post('start_date');
			$save['end_date']		= $this->input->post('end_date');
			$save['enabled']		= $this->input->post('enabled');
			
			$now 					= date("Y-m-d H:i:s");
			if(!$id)$save['date_added']			= $now;
			if($id)$save['date_modified']		= $now;
			
			
			//save the coupon_code
			$coupon_code_id	= $this->Admin_coupon_code_model->save($save);
			
			//save the route
			$route['id']	= $route_id;
			$route['route']	= 'User_coupon_code/index/'.$coupon_code_id;

			
			$this->Admin_routes_model->save($route);
			
			$this->admin_session->set_flashdata('message', 'coupon_code has been saved');
			
			//go back to the coupon_code list
			redirect($this->admin_folder .'/'. $this->controller_dir . '/admin_coupon_code');
		}
	}
	
	/********************************************************************
	delete coupon_code
	********************************************************************/
	function delete()
	{

        $id = $this->input->get('id');
		$coupon_code= $this->Admin_coupon_code_model->get_coupon_code($id);

		if($coupon_code)
		{
			$this->Admin_coupon_code_model->delete_coupon_code($id);
			$this->admin_session->set_flashdata('message', lang('message_deleted_coupon_code'));
		}
		else
		{
			$this->admin_session->set_flashdata('error', lang('error_coupon_code_not_found'));
		}
		
		redirect($this->admin_folder .'/'. $this->controller_dir . '/admin_coupon_code');
	}
	
}

