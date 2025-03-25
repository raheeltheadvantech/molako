<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_taxes extends Admin_Controller {
	
	protected $tax_id;
	protected $tax_category_id;
	protected $controller = 'admin_taxes';
	protected $controller_dir = 'localisation';
	
	function __construct()
	{
		parent::__construct();
		$this->load->model(array(
			'admin/localisation/Admin_tax_model', 
			'admin/localisation/Admin_geo_zone_model', 
			'admin/localisation/Admin_location_model'));
	}

	/***	Tax Rate	 ***/
	
	function index($order_by="tax_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$this->get_tax_rates();
	}
	
	private function get_tax_rates($order_by="tax_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['result']			= $this->Admin_tax_model->get_tax_rates();

		$function				= 'index';
		$data['id']				= '';
		$data['function']		= $function;
		$data['controller']		= $this->controller;
		$data['controller_dir']	= $this->controller_dir;
		
		$data['page_title']		= 'Tax Rates';
		$data['page_header']	= 'Tax Rates';
		
		$this->view($this->admin_view.'/localisation/tax_rates', $data);
	}
	
	function tax_rate_add()
	{
		$this->tax_rate_form(false, __FUNCTION__);
	}
	
	function tax_rate_edit($id = false)
	{
		$this->tax_rate_form($id, __FUNCTION__);
	}
	
	private function tax_rate_form($id = false, $function = false)
	{
		$this->load->helper('form');
		
		$data['function']		= $function;
		$data['controller']		= $this->controller;
		$data['controller_dir']	= $this->controller_dir;
		
		$data['page_title']		= 'Tax Rate Form';
		$data['page_header']	= 'Tax Rate Form';
		
		
		$data['id']					= $id;
		$data['tax_id']				= '';
		$data['name']				= '';
		$data['description']		= '';
		$data['type']				= '';
		$data['rate']				= '';
		$data['geo_zone_id']		= '';
		$data['enabled']			= '';
		$data['geo_zone_menu']		= $this->Admin_geo_zone_model->get_geo_zone_menu();
		
		$data['string_code_name']					= '';
		$data['string_code_description']			= '';
		
		if ($id)
		{	
			$this->tax_id	= $id;
			$result			= $this->Admin_tax_model->get_tax_rate($id);
			if (!$result)
			{
				$this->admin_session->set_flashdata('message', lang('error_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller);
			}
			
			$data['id']					= $result->tax_rate_id;
			$data['name']				= $result->name;
			$data['description']		= $result->description;
			$data['type']				= $result->type;
			$data['rate']				= $result->rate;
			$data['geo_zone_id']		= $result->geo_zone_id;
			$data['enabled']			= $result->enabled;

			$data['string_code_name']				= $result->string_code_name;
			$data['string_code_description']		= $result->string_code_description;
			
		}

		$this->form_validation->set_rules('name', 'lang:000000000071', 'trim|required|min_length[5]|max_length[100]|callback_is_already_exist_tax_rate_name');
		$this->form_validation->set_rules('description', 'lang:000000000072', 'trim');
		$this->form_validation->set_rules('type', 'type', 'trim|required');
		$this->form_validation->set_rules('rate', 'rate', 'trim|required|numeric');
		$this->form_validation->set_rules('geo_zone_id', 'geo_zone_id', 'trim|required|numeric');
		$this->form_validation->set_rules('enabled', 'lang:000000000031', 'trim|integer');

		$this->form_validation->set_rules('string_code_name', 'lang:000000000250', 'trim'); //|required
		$this->form_validation->set_rules('string_code_description', 'lang:000000000234', 'trim');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view.'/localisation/tax_rate_form', $data);
		}
		else
		{
			$save['tax_rate_id']	= $id;
			$save['name']			= $this->input->post('name');
			$save['description']	= $this->input->post('description');
			$save['type']			= $this->input->post('type');
			$save['rate']			= $this->input->post('rate');
			$save['geo_zone_id']	= $this->input->post('geo_zone_id');
			$save['enabled']		= $this->input->post('enabled');
			
			$save['string_code_name']					= $this->input->post('string_code_name');
			$save['string_code_description']			= $this->input->post('string_code_description');
			
			$now = date("Y-m-d H:i:s");
			if (!$id)$save['date_added']		= $now;
			if ($id)$save['date_modified']		= $now;
			
			$tax_id	= $this->Admin_tax_model->save_tax_rate($save);
			
			$this->admin_session->set_flashdata('message', lang('000000000063'));
			
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller);
		}
	}
	
	function tax_rate_delete($id = false)
	{
		$result	= $this->Admin_tax_model->get_tax_rate($id);
		if (!$result)
		{
			$this->admin_session->set_flashdata('error', lang('000000000059'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller);
		}

		$this->Admin_tax_model->delete_tax_rate($id);

		$this->admin_session->set_flashdata('message', lang('000000000064'));
		redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller);

	}

	function is_already_exist_tax_rate_name($str)
	{
		if(trim($str) == '')
		{
			return TRUE;
		}
		
		$result = $this->Admin_tax_model->is_already_exist_tax_rate_name($str, $this->tax_id);
		if ($result)
		{
			$this->form_validation->set_message('is_already_exist_tax_rate_name', lang('000000000060'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}

	/***	Tax Rate	 ***/


	/***	Tax Category	 ***/
	
	function tax_categories($order_by="tax_category_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$this->get_tax_categories();
	}
	
	private function get_tax_categories($order_by="tax_category_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['result']			= $this->Admin_tax_model->get_tax_categories();

		$function				= 'index';
		$data['id']				= '';
		$data['function']		= $function;
		$data['controller']		= $this->controller;
		$data['controller_dir']	= $this->controller_dir;
		
		$data['page_title']		= 'Tax Categories';
		$data['page_header']	= 'Tax Categories';
		
		$this->view($this->admin_view.'/localisation/tax_categories', $data);
	}
	
	function tax_category_add()
	{
		$this->tax_category_form(false, __FUNCTION__);
	}
	
	function tax_category_edit($id = false)
	{
		$this->tax_category_form($id, __FUNCTION__);
	}
	
	private function tax_category_form($id = false, $function = false)
	{
		$this->load->helper('form');
		
		$data['function']		= $function;
		$data['controller']		= $this->controller;
		$data['controller_dir']	= $this->controller_dir;
		
		$data['page_title']		= 'Tax Category Form';
		$data['page_header']	= 'Tax Category Form';
		
		
		$data['id']					= $id;
		$data['tax_category_id']	= '';
		$data['name']				= '';
		$data['description']		= '';
		$data['enabled']			= '';

		$data['string_code_name']					= '';
		$data['string_code_description']			= '';
		
		
		if ($id)
		{	
			$this->tax_category_id	= $id;
			$result			= $this->Admin_tax_model->get_tax_category($id);
			if (!$result)
			{
				$this->admin_session->set_flashdata('message', lang('error_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller.'/tax_categories');
			}
			
			$data['id']					= $result->tax_category_id;
			$data['name']				= $result->name;
			$data['description']		= $result->description;
			$data['enabled']			= $result->enabled;

			$data['string_code_name']				= $result->string_code_name;
			$data['string_code_description']		= $result->string_code_description;
			
		}

		$this->form_validation->set_rules('name', 'lang:000000000071', 'trim|required|min_length[5]|max_length[100]|callback_is_already_exist_tax_category_name');
		$this->form_validation->set_rules('description', 'lang:000000000072', 'trim');
		$this->form_validation->set_rules('enabled', 'lang:000000000031', 'trim|integer');
		
		$this->form_validation->set_rules('string_code_name', 'lang:000000000250', 'trim|required');
		$this->form_validation->set_rules('string_code_description', 'lang:000000000234', 'trim');

		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view.'/localisation/tax_category_form', $data);
		}
		else
		{
			$save['tax_category_id']	= $id;
			$save['name']			= $this->input->post('name');
			$save['description']	= $this->input->post('description');
			$save['enabled']		= $this->input->post('enabled');
			
			$save['string_code_name']					= $this->input->post('string_code_name');
			$save['string_code_description']			= $this->input->post('string_code_description');
			
			$now = date("Y-m-d H:i:s");
			if (!$id)$save['date_added']		= $now;
			if ($id)$save['date_modified']		= $now;
			
			$tax_id	= $this->Admin_tax_model->save_tax_category($save);
			
			$this->admin_session->set_flashdata('message', lang('000000000063'));
			
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller.'/tax_categories');
		}
	}
	
	function tax_category_delete($id = false)
	{
		$result	= $this->Admin_tax_model->get_tax_category($id);
		if (!$result)
		{
			$this->admin_session->set_flashdata('error', lang('000000000059'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller.'/tax_categories');
		}

		$this->Admin_tax_model->delete_tax_category($id);

		$this->admin_session->set_flashdata('message', lang('000000000064'));
		redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller.'/tax_categories');

	}

	function is_already_exist_tax_category_name($str)
	{
		if(trim($str) == '')
		{
			return TRUE;
		}
		
		$result = $this->Admin_tax_model->is_already_exist_tax_category_name($str, $this->tax_category_id);
		if ($result)
		{
			$this->form_validation->set_message('is_already_exist_tax_category_name', lang('000000000060'));
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	
	function tax_rate_to_category($tax_category_id, $order_by="tax_rule_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$function		= 'tax_categories';
		
		$result			= $this->Admin_tax_model->get_tax_category($tax_category_id);
		if (!$result)
		{
			$this->admin_session->set_flashdata('message', lang('error_not_found'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller.'/'.$function);
		}
		
		$data['category']		= $result;
		$data['result']			= $this->Admin_tax_model->get_tax_rate_to_categories($tax_category_id);
		
		$data['id']				= '';
		$data['function']		= $function;
		$data['controller']		= $this->controller;
		$data['controller_dir']	= $this->controller_dir;
		
		$data['page_title']		= 'Category Tax Rate';
		$data['page_header']	= 'Category Tax Rate';
		
		$data['tax_rate_menu']	= $this->Admin_tax_model->get_tax_rate_menu();
		
		$this->view($this->admin_view.'/localisation/tax_rate_to_category_form', $data);
	}
	
	function ajaxcall_save_tax_rate_to_category($posted = NULL)
	{
		$response = PheryResponse::factory();
		$this->load->model(array('admin/Admin_location_model', 'admin/Admin_tax_model'));
		$tax_category_id = !empty($posted['tax_category_id']) ? $posted['tax_category_id'] : 0;
		
		if (Phery::is_ajax(true))
		{
			$save = $save_batch = $recent_added = array();
			if(isset($posted['items']) and $tax_category_id > 0)
			{
				$now = date("Y-m-d H:i:s");
				
				if(is_array($posted['items']) and sizeof($posted['items'])>0 )
				{
					$this->Admin_tax_model->delete_tax_rate_to_category($tax_category_id);
					
					foreach($posted['items'] as $key=>$val)
					{
						$save = array();

						$is_already_exist = $this->Admin_tax_model->is_already_exist_tax_rate_to_category($tax_category_id, $val['tax_rate_id'], $val['based_on']);
						if($is_already_exist)continue;
						
						
						$save['tax_rule_id'] 		= false;
						$save['based_on'] 			= $val['based_on'];
						$save['tax_rate_id'] 		= $val['tax_rate_id'];
						$save['priority'] 			= $val['priority'];
						$save['tax_category_id'] 	= $tax_category_id;
						$save['date_added']			= $now;
						
						$this->Admin_tax_model->save_tax_rate_to_category($save);
					}
					
					$this->admin_session->set_flashdata('message', 'record(s) added.');
					
					$redirect = $this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller.'/tax_rate_to_category/'.$tax_category_id;
					
					$response
						->call('redirect', site_url($redirect), 0)
						;
				}
				else
				{
					$response
						->html(set_js_message('posted items not found.', 'error'), '#js_message_container')
						->jquery('window')->scrollTop(0)
						//->set_response_name('scrollTop')
						;
					
				}
			}
			else
			{
				$response
						->html(set_js_message('posted items not found 2.', 'error'), '#js_message_container')
						->jquery('window')->scrollTop(0)
						//->set_response_name('scrollTop')
						;
			}
		}
		
		echo $response;
		exit;
	}


	/***	Tax Category	 ***/
	
}


