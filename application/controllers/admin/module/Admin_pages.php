<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_pages extends Admin_Controller {
		
	function __construct()
	{
		parent::__construct();
		
		$this->controller_dir = 'module';
		$this->controller_name = 'admin_pages';
		$this->view_dir = 'module/pages';
		
		$this->load->model('admin/module/Admin_page_model');
	}
	
	function index()
	{
		$data['page_title']	= 'Pages';
		$data['page_header']= 'Pages';
		
		$params = array();
		
		$order 		= $this->input->get('order') ? $this->input->get('order') : 'id';
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
			
			redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/pages.html?code='.$code));
		}
		elseif ($code)
		{
			$term			= $this->Admin_search_model->get_term($code);
		}
		
		$data['term']		= $term;
		$data['order_by']	= $order;
		$data['sort_by']	= $sort;
		
		
		
		$result	= $this->Admin_page_model->get_pages(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
		$total	= $this->Admin_page_model->get_pages(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort), true);
		
		$data['result']	= $result;
		$data['total']	= $total;
		
		$config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/pages.html?order='.$order.'&sort='.$sort.'&code='.$code);
		
		$config['total_rows']			= $total;
		$config['per_page']				= $rows;
		$config['offset']				= $per_page;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($config);
		// ********************************
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		// $data['page_title']	= lang('pages');
		// $data['pages']		= $this->Admin_page_model->get_pages();
		
		$this->view($this->admin_view .'/'. $this->view_dir. '/pages_list', $data);
	}
	
	function bulk_save()
	{
		$pages	= $this->input->post('page');
		
		if(!$pages)
		{
			$this->admin_session->set_flashdata('error',  lang('error_bulk_no_pages'));
			redirect($this->admin_folder .'/'. $this->controller_dir . '/admin_pages');
		}
		
		foreach($pages as $id=>$page)
		{
			$page['id']	= $id;
			$this->Admin_page_model->save($page);
		}
		
		$this->admin_session->set_flashdata('message', lang('message_bulk_update'));
		redirect($this->admin_folder .'/'. $this->controller_dir . '/admin_pages');
	}
	
	/********************************************************************
	edit page
	********************************************************************/
	function form($id = false)
	{
		if($id === false)
		{
			$id = $this->input->get('id');
		}
		
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['menu_title']	= '';
		$data['slug']		= '';
		$data['content']	= '';
		$data['is_form']	= '';
		$data['is_sidebar']	= '';
		
		$data['meta_title']			= '';
		$data['meta_keywords']		= '';
		$data['meta_description']	= '';

		
		$data['page_title']	= lang('page_form');
		$data['pages']		= $this->Admin_page_model->get_pages();
		
		if($id)
		{
			$page			= $this->Admin_page_model->get_page($id);
			if(!$page)
			{
				//page does not exist
				$this->admin_session->set_flashdata('error', lang('error_page_not_found'));
				redirect($this->admin_folder .'/'. $this->controller_dir . '/pages.html');
			}
			
			//set values to db values
			$data['id']				= $page->id;
			$data['title']			= $page->title;
			$data['menu_title']		= $page->menu_title;
			$data['content']		= $page->content;
			$data['slug']			= $page->slug;
			$data['enabled']			= $page->enabled;
			//$data['is_form']		= $page->is_form;
			//$data['is_sidebar']		= $page->is_sidebar;

			$data['meta_title']			= $page->meta_title;
			$data['meta_keywords']		= $page->meta_keywords;
			$data['meta_description']	= $page->meta_description;
			
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('menu_title', 'lang:menu_title', 'trim');
		$this->form_validation->set_rules('slug', 'lang:slug', 'trim');
		$this->form_validation->set_rules('content', 'lang:content', 'trim');
		
		$this->form_validation->set_rules('meta_title', 'lang:meta_title', 'trim');
		$this->form_validation->set_rules('meta_keywords', 'lang:meta_keywords', 'trim');
		$this->form_validation->set_rules('meta_description', 'lang:meta_description', 'trim');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->admin_view .'/'. $this->view_dir. '/page_form', $data);
		}
		else
		{
			$this->load->helper('text');
			
			//first check the slug field
			$slug = $this->input->post('slug');
			
			//if it's empty assign the name field
			if(empty($slug) || $slug=='')
			{
				$slug = $this->input->post('title');
			}
			
			$slug	= url_title(convert_accented_characters($slug), 'dash', TRUE);
			
			//validate the slug
			$this->load->model('admin/Admin_routes_model');
			if($id)
			{
				$slug		= $this->Admin_routes_model->validate_slug($slug, $page->route_id);
				$route_id	= $page->route_id;
			}
			else
			{
				$slug			= $this->Admin_routes_model->validate_slug($slug);
				$route['slug']	= $slug;	
				$route_id		= $this->Admin_routes_model->save($route);
			}
			
			
			$save = array();
			$save['id']			= $id;
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('menu_title'); 
			$save['content']	= $this->input->post('content');
			$save['route_id']	= $route_id;
			$save['slug']		= $slug;
			$save['enabled']	= $this->input->post('enabled');
			
			$save['meta_title']			= $this->input->post('meta_title');
			$save['meta_keywords']		= $this->input->post('meta_keywords');
			$save['meta_description']	= $this->input->post('meta_description');
			
			$now = date("Y-m-d H:i:s");
			if(!$id)$save['date_added']			= $now;
			if($id)$save['date_modified']		= $now;
			
			//set the menu title to the page title if if is empty
			if ($save['menu_title'] == '')
			{
				$save['menu_title']	= $this->input->post('title');
			}
			
			//save the page
			$page_id	= $this->Admin_page_model->save($save);
			
			//save the route
			$route['id']	= $route_id;
			$route['slug']	= $slug;
			$route['route']	= 'User_page/index/'.$page_id;
			
			$this->Admin_routes_model->save($route);
			
			$this->admin_session->set_flashdata('message', 'page has been saved');
			
			//go back to the page list
			redirect($this->admin_folder .'/'. $this->controller_dir . '/admin_pages');
		}
	}
	
	function link_form($id = false)
	{
	
		$this->load->helper('url');
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//set the default values
		$data['id']			= '';
		$data['title']		= '';
		$data['url']		= '';
		$data['new_window']	= false;

		
		$data['page_title']	= lang('link_form');
		$data['pages']		= $this->Admin_page_model->get_pages();
		if($id)
		{
			$page			= $this->Admin_page_model->get_page($id);

			if(!$page)
			{
				//page does not exist
				$this->admin_session->set_flashdata('error', lang('error_link_not_found'));
				redirect($this->admin_folder .'/'. $this->controller_dir . '/admin_pages');
			}
			
			
			//set values to db values
			$data['id']			= $page->id;
			$data['title']		= $page->title;
			$data['url']		= $page->url;
			$data['new_window']	= (bool)$page->new_window;
		}
		
		$this->form_validation->set_rules('title', 'lang:title', 'trim|required');
		$this->form_validation->set_rules('url', 'lang:url', 'trim|required');
		$this->form_validation->set_rules('new_window', 'lang:new_window', 'trim|integer');
		
		// Validate the form
		if($this->form_validation->run() == false)
		{
			$this->view($this->admin_view .'/'. $this->view_dir. '/link_form', $data);
		}
		else
		{	
			$save = array();
			$save['id']			= $id;
			$save['title']		= $this->input->post('title');
			$save['menu_title']	= $this->input->post('title'); 
			$save['url']		= $this->input->post('url');
			$save['new_window']	= $this->input->post('new_window');
			
			//save the page
			$this->Admin_page_model->save($save);
			
			$this->admin_session->set_flashdata('message', lang('message_saved_link'));
			
			//go back to the page list
			redirect($this->admin_folder .'/'. $this->controller_dir . '/admin_pages');
		}
	}
	
	/********************************************************************
	delete page
	********************************************************************/
	function delete()
	{


        $id = $this->input->get('id');
		$page	= $this->Admin_page_model->get_page($id);
		if($page)
		{
			$this->load->model('admin/Admin_routes_model');
			$this->Admin_routes_model->delete($page->route_id);
			$this->Admin_page_model->delete_page($id);
			$this->admin_session->set_flashdata('message', lang('message_deleted_page'));
		}
		else
		{
			$this->admin_session->set_flashdata('error', lang('error_page_not_found'));
		}
			// var_dump($this->admin_folder .'/'. $this->controller_dir . '/admin_pages'); die();
		redirect($this->admin_folder .'/'. $this->controller_dir . '/admin_pages');
	}
	
}