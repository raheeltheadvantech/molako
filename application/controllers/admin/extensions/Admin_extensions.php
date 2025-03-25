<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_extensions extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'admin_extensions';
        $this->view_dir = 'extensions';
        $this->controller_dir = 'extensions';
		$this->load->model('admin/extensions/Admin_extensions_model');
	}
	
	function index()
	{
		$data = array();

		$scope = $this->input->get('scope');

        $data['page_header'] = 'Extensions List';

        $order 		= $this->input->get('order') ? $this->input->get('order') : '';
        $sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code 		= $this->input->get('code') ? $this->input->get('code') : '';
        $page 		= $this->input->get('page') ? $this->input->get('page') : 0;
        $rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';

        $term               = false;
        $data['code']       = $code;
        $post               = $this->input->post(null, false);
        
        $this->load->model('admin/Admin_search_model');
        
        if($post)
        {
            $term           = json_encode($post);
            $code           = $this->Admin_search_model->record_term($term);
            $data['code']   = $code;
            
            redirect(site_url($this->admin_folder .'/extensions.html?code='.$code));
        }
        elseif ($code)
        {
            $term           = $this->Admin_search_model->get_term($code);
        }

        $result	= $this->Admin_extensions_model->get_extensions(array('term'=>$term,'scope'=>$scope,'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total	= $this->Admin_extensions_model->get_extensions(array('term'=>$term,'scope'=>$scope, 'order'=>$order, 'sort'=>$sort), true);

        $data['result']	= $result;
        $data['extensions']	= $result;
        $data['total']	= $total;

        $config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/extensions.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']			= $total;
        $config['per_page']				= $rows;
        $config['offset']				= $per_page;
        $config['uri_segment']			= $this->uri->total_segments();
        $config['use_page_numbers'] 	= TRUE;
        $config['page_query_string'] 	= TRUE;
        $config['reuse_query_string'] 	= TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);

        $this->view($this->admin_view.'/extensions/extensions_list', $data);

	}

    function payment()
    {
        $data = array();

        $data['page_header'] = 'Payment List';

        $order      = $this->input->get('order') ? $this->input->get('order') : '';
        $sort       = $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code       = $this->input->get('code') ? $this->input->get('code') : '';
        $page       = $this->input->get('page') ? $this->input->get('page') : 0;
        $rows       = $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page   = $this->input->get('per_page') ? $this->input->get('per_page') : '';

        $term               = false;
        $data['code']       = $code;
        $post               = $this->input->post(null, false);
        
        $this->load->model('admin/Admin_search_model');
        
        if($post)
        {
            $term           = json_encode($post);
            $code           = $this->Admin_search_model->record_term($term);
            $data['code']   = $code;
            redirect(site_url($this->admin_folder .'/extensions/payment.html?code='.$code));
        }
        elseif ($code)
        {
            $term           = $this->Admin_search_model->get_term($code);
        }

        $result = $this->Admin_extensions_model->get_payments(array('term'=>$term,'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total  = $this->Admin_extensions_model->get_payments(array('term'=>$term, 'order'=>$order, 'sort'=>$sort), true);

        $data['result'] = $result;
        $data['results'] = $result;
        $data['total']  = $total;
        // echo'<pre>';print_r($result);die;

        $config['base_url'] = site_url($this->admin_folder .'/'. $this->controller_dir .'/payment.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']           = $total;
        $config['per_page']             = $rows;
        $config['offset']               = $per_page;
        $config['uri_segment']          = $this->uri->total_segments();
        $config['use_page_numbers']     = TRUE;
        $config['page_query_string']    = TRUE;
        $config['reuse_query_string']   = TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);

        $this->view($this->admin_view.'/extensions/payment_list', $data);

    }

    function shipping()
    {
        $data = array();

        $data['page_header'] = 'Shipping List';

        $order      = $this->input->get('order') ? $this->input->get('order') : '';
        $sort       = $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code       = $this->input->get('code') ? $this->input->get('code') : '';
        $page       = $this->input->get('page') ? $this->input->get('page') : 0;
        $rows       = $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page   = $this->input->get('per_page') ? $this->input->get('per_page') : '';

        $term               = false;
        $data['code']       = $code;
        $post               = $this->input->post(null, false);
        
        $this->load->model('admin/Admin_search_model');
        
        if($post)
        {
            $term           = json_encode($post);
            $code           = $this->Admin_search_model->record_term($term);
            $data['code']   = $code;
            redirect(site_url($this->admin_folder .'/extensions/shipping.html?code='.$code));
        }
        elseif ($code)
        {
            $term           = $this->Admin_search_model->get_term($code);
        }

        $result = $this->Admin_extensions_model->get_shipping(array('term'=>$term,'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total  = $this->Admin_extensions_model->get_shipping(array('term'=>$term, 'order'=>$order, 'sort'=>$sort), true);

        $data['result'] = $result;
        $data['results'] = $result;
        $data['total']  = $total;
        // echo'<pre>';print_r($result);die;

        $config['base_url'] = site_url($this->admin_folder .'/'. $this->controller_dir .'/shipping.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']           = $total;
        $config['per_page']             = $rows;
        $config['offset']               = $per_page;
        $config['uri_segment']          = $this->uri->total_segments();
        $config['use_page_numbers']     = TRUE;
        $config['page_query_string']    = TRUE;
        $config['reuse_query_string']   = TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);

        $this->view($this->admin_view.'/extensions/shipping_list', $data);

    }

}