<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_taxes extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('admin/localisation/Admin_taxes_model'));
        $this->load->model('admin/localisation/Admin_location_model');
		
		$this->controller_dir = 'common';
		$this->controller_name = 'admin_taxes';
		$this->view_dir = 'common';
		
		$this->load->helper('date');
	}
	
	function index()
	{
		$data['page_title']	= 'Taxes';
		$data['page_header']= 'Taxes';
		
		$params = array();
		
		$order 		= $this->input->get('order') ? $this->input->get('order') : 't.tax_id';
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
			
			redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/taxes.html?code='.$code));
		}
		elseif ($code)
		{
			$term			= $this->Admin_search_model->get_term($code);
		}
		
		$data['term']		= $term;
		$data['order_by']	= $order;
		$data['sort_by']	= $sort;
		
		
		
		$result	= $this->Admin_taxes_model->get_taxes(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
		$total	= $this->Admin_taxes_model->get_taxes(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort), true);
		
		$data['result']	= $result;
		$data['total']	= $total;
		
		$config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/taxes.html?order='.$order.'&sort='.$sort.'&code='.$code);
		
		$config['total_rows']			= $total;
		$config['per_page']				= $rows;
		$config['offset']				= $per_page;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($config);
		
		$this->view($this->admin_view  .'/'. $this->view_dir .'/taxes_list', $data);
	}
	
	function default_data(&$data)
	{
		$data['page_title']		= 'Taxes form';
		$data['page_header']	= 'Taxes form';

		$data['country_id']			= '';
		$data['region_id']			= '';
		$data['tax_rate']		= '';

		$data['id']	 = $this->input->get('id');

		$data['route'] = 'tax-add.html';

		$data['result'] = '';
		
//		$config['upload_path']			= 'images/slides';
//		$config['allowed_types']		= 'gif|jpg|png';
//		$config['max_size']				= $this->config->item('size_limit');
//		$config['encrypt_name']			= true;
//		$this->load->library('upload', $config);
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
			$result	= $this->Admin_taxes_model->get_by_id($data['id']);
			if(!$result)
			{
				$this->admin_session->set_flashdata('error', 'tax not found.');
				redirect($this->admin_url .'/'. $this->controller_dir .'/taxes.html');
			}
			
			$data['result'] 	= $result;
			
			foreach($result as $key=>$val)
			{
				$data[$key] = $val;
			}
			//var_dump($data);die;

            $countries = $this->Admin_location_model->get_countries(false);
            $countries_options  = array();

            foreach ($countries as $country){
                $countries_options[$country->country_id] = $country->name;
            }

            $data['regions'] = $this->Admin_location_model->get_zones_menu($data['country_id']);
            $data['country_options'] = $countries_options;

			$data['route'] = 'tax-edit.html?id='.$data['id'];
		}
		else{

            $countries = $this->Admin_location_model->get_countries(false);
            $countries_options  = array();

            foreach ($countries as $country){
                $countries_options[$country->country_id] = $country->name;
            }

            $default_country_id = $this->Admin_location_model->get_default_country();

            if($default_country_id) {
                $data['regions'] = $this->Admin_location_model->get_zones_menu($default_country_id->country_id);
            }

            $data['country_options'] = $countries_options;
        }
		
		$this->form_validation->set_rules('tax_rate', 'Tax Price', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view  .'/'. $this->view_dir .'/tax_form', $data);
		}
		else
		{
			$save['tax_id']		= $data['id'];
			$save['country_id']			= $this->input->post('country_id');
			$save['region_id']			= $this->input->post('region_id');
			$save['tax_rate']			= $this->input->post('tax_rate');
			
			$save['date_created']		= date('Y-m-d H:i:s');
			if ($data['id'])
			{
				$save['date_modified']	= date('Y-m-d H:i:s');
			}
			
			$this->Admin_taxes_model->save($save);
			
			$this->admin_session->set_flashdata('message', 'Tax has been saved.');
			redirect($this->admin_url .'/'. $this->controller_dir .'/taxes.html');
		}
	}

	
	public function delete()
    {
        $id = $this->input->get('id');
		$result	= $this->Admin_taxes_model->get_by_id($id);
		if(!$result)
		{
			$this->admin_session->set_flashdata('error', 'Tax not found.');
			redirect($this->admin_url .'/'. $this->controller_dir .'/taxes.html');
		}

		$this->Admin_taxes_model->delete($id);
		
		$this->admin_session->set_flashdata('message', 'Tax have been deleted successfully!');
        redirect($this->admin_url .'/'. $this->controller_dir .'/taxes.html');
    }
}
