<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_navigations extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(
			array(
				'admin/module/Admin_navigation_model',
       			'admin/module/Admin_page_model', 
       		));

		
		$this->controller_dir = 'module';
		$this->controller_name = 'admin_navigations';
		$this->view_dir = 'module/navigation';
		
		$this->load->helper('date');
	}
	
	function index()
	{
		$data['page_title']	= 'Navigation';
		$data['page_header']= 'Navigation';
		
		$params = array();
		
		$order 		= $this->input->get('order') ? $this->input->get('order') : 'n.sort_order';
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
			
			redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/navigations.html?code='.$code));
		}
		elseif ($code)
		{
			$term			= $this->Admin_search_model->get_term($code);
		}
		
		$data['term']		= $term;
		$data['order_by']	= $order;
		$data['sort_by']	= $sort;
		
		
		
		$result	= $this->Admin_navigation_model->get_navigations(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
		$total	= $this->Admin_navigation_model->get_navigations(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort), true);
		
		$data['result']	= $result;
		$data['total']	= $total;
		
		$config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/navigations.html?order='.$order.'&sort='.$sort.'&code='.$code);
		
		$config['total_rows']			= $total;
		$config['per_page']				= $rows;
		$config['offset']				= $per_page;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($config);

		$data['navigation'] = create_navigation_tree();
		$data['menu']		= create_navigation_html();
		$data['route'] = 'navigation/add.html';
		// echo "<pre>";print_r($data['navigation']);die;
		
		$this->view($this->admin_view  .'/'. $this->view_dir .'/navigations_listold', $data);
	}
	
	function default_data(&$data)
	{
		$data['page_title']		= 'Navigation form';
		$data['page_header']	= 'Navigation form';

		$data['name']			= '';
		$data['link']			= '';
		$data['has_child_nav']	= '';

        $data['is_enabled']	= '';

        $data['sort_order']	= '';

		$data['id']				= $this->input->get('id');
		
		$data['route'] = 'navigation-add.html';
		
		$data['result'] = '';

	}
	
	function add()
	{
		$this->form();
	}
	
	function edit()
	{
		$this->form('edit');
	}
	
	private function form($mode = '')
	{
		$this->default_data($data);
		
		if ($mode == 'edit')
		{
			$result	= $this->Admin_navigation_model->get_by_id($data['id']);
			if(!$result)
			{
				$this->admin_session->set_flashdata('error', 'Navigation not found.');
				redirect($this->admin_url .'/'. $this->controller_dir .'/navigations.html');
			}
			
			$data['result'] 	= $result;
			
			foreach($result as $key=>$val)
			{
				$data[$key] = $val;
			}

			$data['route'] = 'navigation-edit.html?id='.$data['id'];
		}

         $pages		= $this->Admin_page_model->get_pages();

		$page = array();
        foreach ($pages as $key=>$val) {

            $page[$val->slug] = $val->title;
        }

        $data['pages'] = $page;

		$this->form_validation->set_rules('name', 'lang:name', 'trim|required|callback_is_name_already_exist');


        if($this->input->post('name') == 'pages')
            $this->form_validation->set_rules('page-link', 'Page link', 'trim|required|callback_is_link_already_exist');
          else
		    $this->form_validation->set_rules('link', 'lang:link', 'trim|required');


		$this->form_validation->set_rules('is_enabled', 'Enabled', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view  .'/'. $this->view_dir .'/navigation_form', $data);
		}
		else
		{
			$save['navigation_id']		= $data['id'];
			$save['name']			    = $this->input->post('name');

			if($save['name'] == 'pages') {
                $save['link'] = $this->input->post('page-link');
                $save['has_child_nav'] = 1;

                }else {
                $save['link'] = $this->input->post('link');
                $save['has_child_nav'] = 0;
			    }

			$save['is_enabled']		= $this->input->post('is_enabled');
			$save['sort_order']		= $this->input->post('sort_order');
			
			$save['date_added']		= date('Y-m-d H:i:s');
			if ($data['id'])
			{
				$save['date_modified']	= date('Y-m-d H:i:s');
			}

//			print_r($save);
//			die();
			
			$this->Admin_navigation_model->save($save);
			
			$this->admin_session->set_flashdata('message', 'Navigation has been saved.');
			redirect($this->admin_url .'/'. $this->controller_dir .'/navigations.html');
		}
	}


    function is_name_already_exist($str)
    {

        if($str == 'pages')
            return TRUE;

        $navigation_id	= $this->input->get('id');



        $result = $this->Admin_navigation_model->is_name_already_exist($str , $navigation_id);
        if ($result)
        {
            $this->form_validation->set_message('is_name_already_exist', 'Navigation name is already exist');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

    function is_link_already_exist($str)
    {

        $navigation_id	= $this->input->get('id');

        $result = $this->Admin_navigation_model->is_link_already_exist($str , $navigation_id);
        if ($result)
        {
            $this->form_validation->set_message('is_link_already_exist', 'Navigation Link is already exist');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }



    function sort_list()
	{
		$data['page_title']	= 'Navigation Sort';
		$data['page_header']= 'Navigation Sort';
		
		$params = array();
		
		$data['result']	= $this->Admin_navigation_model->get_navigations(array('params'=>$params, ));
		
		$this->view($this->admin_view  .'/'. $this->view_dir .'/navigations_sort', $data);
	}
	
	function sort_ajax()
	{
		is_ajax();
		
		$items = $this->input->post('items');
		
		$this->Admin_navigation_model->organize($items);
		
		ajax_response(array('error'=>false, 'message'=>'Navigation updated.'));
	}
	
	public function delete()
    {
        $id = $this->input->get('id');
		$result	= $this->Admin_navigation_model->get_by_id($id);
		if(!$result)
		{
			$this->admin_session->set_flashdata('error', 'navigation not found.');
			redirect($this->admin_url .'/'. $this->controller_dir .'/navigations.html');
		}

		$this->Admin_navigation_model->delete($id);
		
		$this->admin_session->set_flashdata('message', 'Navigation have been deleted successfully!');
        redirect($this->admin_url .'/'. $this->controller_dir .'/navigations.html');
    }
}
