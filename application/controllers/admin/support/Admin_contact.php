<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_contact extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'Admin_contact';
        $this->view_dir = 'support/contact';
		$this->load->model('admin/support/Admin_contact_model');
	}
	
	function index()
	{
		$data = array();
        $data['page_header'] = 'Contact List';

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

        $this->load->model('admin/Admin_search_model');
        if($post)
        {
            $term			= json_encode($post);
            $code			= $this->Admin_search_model->record_term($term);
            $data['code']	= $code;
            redirect(site_url($this->admin_folder .'/support/contact.html?code='.$code));
        }
        elseif ($code)
        {
            $term			= $this->Admin_search_model->get_term($code);
        }

        $result	= $this->Admin_contact_model->get_contact_list(array('term'=>$term,'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total	= $this->Admin_contact_model->get_contact_list(array('term'=>$term,'order'=>$order, 'sort'=>$sort), true);

        $data['result']	= $result;
        $data['total']	= $total;

        $config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/support/contact.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']			= $total;
        $config['per_page']				= $rows;
        $config['offset']				= $per_page;
        $config['uri_segment']			= $this->uri->total_segments();
        $config['use_page_numbers'] 	= TRUE;
        $config['page_query_string'] 	= TRUE;
        $config['reuse_query_string'] 	= TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);


		//$data['customers'] = $this->Admin_customer_model->get_customers();
		//$data['add_link'] = site_url($this->admin_folder.'/customers/add.html');
        $this->view($this->admin_view.'/support/contact/list', $data);

	}

    public function get_detail()
    {

        $data['page_title']		= 'Admin Contact';
        $data['page_header']	= 'Contact Details';

        $contact_us_id= '';
        if(!$this->input->get('id')){
            $this->admin_session->set_flashdata('error', 'Invalid order number to view the order details');
            redirect(site_url($this->admin_folder .'/contact-us/_list.html'));
        }else{
            $contact_us_id = $this->input->get('id');
        }
        $data['result'] = $this->Admin_contact_model->get_contact($contact_us_id);

        $this->view($this->admin_view .'/'. $this->view_dir .'/detail', $data);
    }


}