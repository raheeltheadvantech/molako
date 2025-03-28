<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_locations extends Admin_Controller {	

	function __construct()
	{	
		parent::__construct();
		
		$this->controller_dir = 'localisation';
		$this->controller_name = 'admin_locations';
		$this->view_dir = 'localisation';
		
		$this->load->model('admin/localisation/Admin_location_model');
		$this->lang->load('location');
	}

	function index($order_by="country_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$this->get_countries($order_by, $sort_order, $code, $page, $rows);
	}
	
	private function get_countries($order_by="country_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['locations']			= $this->Admin_location_model->get_countries();

		$data['function']			= 'index';
		$data['controller_dir']		= $this->controller_dir;
		$data['controller']			= $this->controller_prefix;
		
		$data['page_title']			= lang('000000000114');
		$data['page_header']		= lang('000000000114');
		
		$this->view($this->admin_view.'/locations/countries', $data);
	}
	
	function country_add()
	{
		$this->country_form(false, __FUNCTION__);
	}
	
	function country_edit($id = false)
	{
		$this->country_form($id, __FUNCTION__);
	}
	
	private function country_form($id = false, $function = false)
	{
		$data['function']		= $function;
		$data['controller_dir']	= $this->controller_dir;
		$data['controller']		= $this->controller_prefix;
		
		$data['page_title']		= lang('000000000127');
		$data['page_header']	= lang('000000000127');
		
		$data['id']					= $id;
		$data['name']				= '';
		$data['iso_code_2']			= '';
		$data['iso_code_3']			= '';
		$data['enabled']			= false;
		$data['postcode_required']	= false;
		$data['address_format']		= '';
		$data['is_default']			= 0;
		
		$data['language_names']		= array();
		$db_table_name				= 'country_names';
		$db_table_col				= 'country_id';
		
		if ($id)
		{	
			$result		= (array)$this->Admin_location_model->get_country($id);
			if (!$result)
			{
				$this->admin_session->set_flashdata('error', lang('error_country_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
			$data	= array_merge($data, $result);
			
			$data['language_names']		= $this->Admin_location_model->get_location_language_names($db_table_name, $db_table_col, $result['country_id'] );
		}
		
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('iso_code_2', 'lang:iso_code_2', 'trim|required');
		$this->form_validation->set_rules('iso_code_3', 'lang:iso_code_3', 'trim|required');
		$this->form_validation->set_rules('address_format', 'lang:address_format', 'trim');
		$this->form_validation->set_rules('postcode_required', 'lang:require_postcode', 'trim');
		$this->form_validation->set_rules('enabled', 'lang:enabled', 'trim');
		$this->form_validation->set_rules('is_default', 'lang:is_default', 'trim');	
		
		if($this->input->post('language_names')):
			foreach($this->input->post('language_names') as $key=>$val):
				$this->form_validation->set_rules("language_names[$key]", $key. ' string language names', 'required');
			endforeach;
		endif;
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view.'/locations/country_form', $data);
		}
		else
		{
			//die('Not allowed');
			$save['id']					= $id;
			$save['name']				= $this->input->post('name');
			$save['iso_code_2']			= $this->input->post('iso_code_2');
			$save['iso_code_3']			= $this->input->post('iso_code_3');
			$save['address_format']		= $this->input->post('address_format');
			$save['postcode_required']	= $this->input->post('postcode_required');
			$save['enabled'] 			= $this->input->post('enabled');
			$save['is_default'] 		= $this->input->post('is_default');
			
			//$id = $this->Admin_location_model->save_country($save);
			
			$this->admin_session->set_flashdata('message', lang('message_saved_country'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
		}
	}
	
	function delete_country($id = false)
	{
		die('Not allowed');
		if ($id)
		{	
			$location	= $this->Admin_location_model->get_country($id);
			if (!$location)
			{
				$this->admin_session->set_flashdata('error', lang('error_country_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
			else
			{
				$this->Admin_location_model->delete_country($id);
				
				$this->admin_session->set_flashdata('message', lang('message_deleted_country'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
		}
		else
		{
			$this->admin_session->set_flashdata('error', lang('error_country_not_found'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
		}
	}
	
	function country_bulk_save()
	{
		$countries	= $this->input->post('location');
		
		if(!$countries)
		{
			$this->admin_session->set_flashdata('error',  lang('error_bulk_no_pages'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
		}
		
		foreach($countries as $id=>$country)
		{
			$country['country_id']	= $id;
			$this->Admin_location_model->save_country($country);
		}
		
		$this->admin_session->set_flashdata('message', lang('message_bulk_update'));
		redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
	}
	
	function organize_countries()
	{
		$countries	= $this->input->post('country');
		$this->Admin_location_model->organize_countries($countries);
	}
	
	function get_zones($country_id = false, $order_by="country_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['function']			= __FUNCTION__;
		$data['controller_dir']		= $this->controller_dir;
		$data['controller']			= $this->controller_prefix;
		
		$data['page_title']			= lang('000000000114');
		$data['page_header']		= lang('000000000114');
		
		if($country_id)
		{
			$data['country']	= $this->Admin_location_model->get_country($country_id);
			if(!$data['country'])
			{
				$this->admin_session->set_flashdata('error', lang('error_zone_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
			
			$data['page_title']			= sprintf(lang('country_zones'), $data['country']->name);
		}
		
		$data['zones']	= $this->Admin_location_model->get_zones($country_id);
		
		$this->view($this->admin_view.'/locations/country_zones', $data);
	}
	
	function zone_add()
	{
		$this->zone_form(false, __FUNCTION__);
	}
	
	function zone_edit($id = false)
	{
		$this->zone_form($id, __FUNCTION__);
	}
	
	private function zone_form($id = false, $function = false)
	{
		$data['function']		= $function;
		$data['controller_dir']	= $this->controller_dir;
		$data['controller']		= $this->controller_prefix;
		
		$data['page_title']		= lang('000000000127');
		$data['page_header']	= lang('000000000127');
		
		$data['id']			= $id;
		$data['name']		= '';
		$data['country_id']	= '';
		$data['code']		= '';
		$data['enabled']		= false;
		
		$data['countries']		= $this->Admin_location_model->get_countries();

		$data['language_names']		= array();
		$db_table_name				= 'country_zone_names';
		$db_table_col				= 'zone_id';

		if ($id)
		{	
			$zone		= (array)$this->Admin_location_model->get_zone($id);
			if (!$zone)
			{
				$this->admin_session->set_flashdata('error', lang('error_zone_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
			
			$data	= array_merge($data, $zone);
			
			$data['language_names']		= $this->Admin_location_model->get_location_language_names($db_table_name, $db_table_col, $zone['zone_id'] );
		}
		
		$this->form_validation->set_rules('country_id', 'Country ID', 'trim|required');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('code', 'lang:code', 'trim|required');
		$this->form_validation->set_rules('enabled', 'lang:enabled', 'trim');		
		
		if($this->input->post('language_names')):
			foreach($this->input->post('language_names') as $key=>$val):
				$this->form_validation->set_rules("language_names[$key]", $key. ' string language names', 'required');
			endforeach;
		endif;
		
		if($this->input->post('language_names')):
			foreach($this->input->post('language_names') as $key=>$val):
				$this->form_validation->set_rules("language_names[$key]", $key. ' string language names', 'required');
			endforeach;
		endif;
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view.'/locations/country_zone_form', $data);
		}
		else
		{
			$save['zone_id']	= $id;
			$save['country_id']	= $this->input->post('country_id');
			$save['name']		= $this->input->post('name');
			$save['code']		= $this->input->post('code');
			$save['enabled'] 	= $this->input->post('enabled');
			
			$zone_id = $this->Admin_location_model->save_zone($save);
			
			$this->admin_session->set_flashdata('message', lang('message_zone_saved'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix .'/get_zones');
		}
	}
	
	function delete_zone($id = false)
	{
		die('Not allowed');
		if ($id)
		{	
			$location	= $this->Admin_location_model->get_zone($id);
			if (!$location)
			{
				$this->admin_session->set_flashdata('error', lang('error_zone_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
			else
			{
				$this->Admin_location_model->delete_zone($id);
				
				$this->admin_session->set_flashdata('message', lang('message_deleted_zone'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix.'/zones/'. $location->country_id);
			}
		}
		else
		{
			$this->admin_session->set_flashdata('error', lang('error_zone_not_found'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
		}
	}

	function get_zone_menu()
	{
		$id	= $this->input->post('id');
		$zones	= $this->Admin_location_model->get_zones_menu($id);
		foreach($zones as $id=>$z):?>
		<option value="<?php echo $id;?>"><?php echo $z;?></option>
		<?php endforeach;
	}
	
	function get_zone_areas($zone_id, $order_by="zone_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['function']			= __FUNCTION__;
		$data['controller_dir']		= $this->controller_dir;
		$data['controller']			= $this->controller_prefix;
		
		$data['zone']				= $this->Admin_location_model->get_zone($zone_id);
		$data['areas']				= $this->Admin_location_model->get_zone_areas($zone_id);
		
		$data['page_title']			= sprintf(lang('zone_areas_for'), $data['zone']->name);
		$data['page_header']		= lang('000000000114');
		
		$this->view($this->admin_view.'/locations/country_zone_areas', $data);
	}
	
	function zone_area_add($zone_id = false)
	{
		$this->zone_area_form($zone_id, false, __FUNCTION__);
	}
	
	function zone_area_edit($zone_id = false, $area_id = false)
	{
		$this->zone_area_form($zone_id, $area_id, __FUNCTION__);
	}
	
	private function zone_area_form($zone_id, $area_id = false, $function = false)
	{
		$data['function']		= $function;
		$data['controller_dir']	= $this->controller_dir;
		$data['controller']		= $this->controller_prefix;
		
		$zone					= $this->Admin_location_model->get_zone($zone_id);
		if (!$zone)
		{
			$this->admin_session->set_flashdata('error', lang('error_zone_not_found'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
		}
		
		$data['page_title']		= sprintf(lang('zone_area_form'), $zone->name);
		$data['page_header']	= lang('000000000127');
		
		
		$data['id']			= $id;
		$data['code']		= '';
		$data['zone_id']	= $zone_id;
		
		if ($area_id)
		{	
			$area		= (array)$this->Admin_location_model->get_zone_area($area_id);
			if (!$area)
			{
				$this->admin_session->set_flashdata('error', lang('error_zone_area_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix.'/zone_areas/'.$zone_id);
			}
			$data	= array_merge($data, $area);
		}
		
		$this->form_validation->set_rules('code', 'lang:code', 'trim|required');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view.'/locations/country_zone_area_form', $data);
		}
		else
		{
			die('Not allowed');
			$save['id']			= $area_id;
			$save['zone_id']	= $zone_id;
			$save['code']		= $this->input->post('code');
			$this->Admin_location_model->save_zone_area($save);
			
			$this->admin_session->set_flashdata('message', lang('message_saved_zone_area'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix . 'zone_areas/'.$save['zone_id']);
		}
	}
	
	function delete_zone_area($id = false)
	{
		die('Not allowed');
		if ($id)
		{	
			$location	= $this->Admin_location_model->get_zone_area($id);
			if (!$location)
			{
				$this->admin_session->set_flashdata('error', lang('error_zone_area_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
			else
			{
				$this->Admin_location_model->delete_zone_area($id);
				
				$this->admin_session->set_flashdata('message', lang('message_deleted_zone_area'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix .'/zone_areas/'.$location->zone_id);
			}
		}
		else
		{
			$this->admin_session->set_flashdata('error', lang('error_zone_area_not_found'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
		}
	}
	
	/************Cities***********/
	function get_cities($zone_id = false, $order_by="zone_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['function']			= __FUNCTION__;
		$data['controller_dir']		= $this->controller_dir;
		$data['controller']			= $this->controller_prefix;
		
		$data['page_title']			= 'Cities'; //lang('000000000114');
		$data['page_header']		= 'Cities'; //lang('000000000114');
		
		if($zone_id)
		{
			$data['zone']	= $this->Admin_location_model->get_zone($zone_id);
			if(!$data['zone'])
			{
				$this->admin_session->set_flashdata('error', lang('error_zone_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
			
			$data['page_title']			= sprintf(lang('country_zones'), $data['zone']->name);
		}
		
		$data['cities']	= $this->Admin_location_model->get_cities($zone_id);
		
		$this->view($this->admin_view.'/locations/country_zone_cities', $data);
	}
	
	function city_add($country_id = false, $zone_id = false)
	{
		$this->city_form($country_id, $zone_id, false, __FUNCTION__);
	}
	
	function city_edit($country_id = false, $zone_id = false, $id = false)
	{
		$this->city_form($country_id, $zone_id, $id, __FUNCTION__);
	}
	
	private function city_form($country_id = false, $zone_id = false, $id = false, $function = false)
	{
		$result	= $this->Admin_location_model->get_zone($zone_id);
		if (!$result)
		{
			$this->admin_session->set_flashdata('error', lang('000000000059'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix.'/get_zones');
		}
		
		$data['function']		= $function;
		$data['controller_dir']	= $this->controller_dir;
		$data['controller']		= $this->controller_prefix;
		
		$data['page_title']		= 'Add city';
		$data['page_header']	= 'Add city';
		
		$data['id']				= $id;
		$data['zone_id']= $zone_id;
		$data['country_id']		= $country_id;
		$data['name']			= '';
		$data['code']			= '';
		$data['enabled']		= '';
		
		$data['countries_menu']		= $this->Admin_location_model->get_countries_menu();
		$data['zones_menu']			= $this->Admin_location_model->get_zones_menu($country_id);

		$data['language_names']		= array();
		$db_table_name				= 'country_zone_city_names';
		$db_table_col				= 'city_id';

		if ($id)
		{	
			$city		= (array)$this->Admin_location_model->get_city($id);
			if (!$city)
			{
				$this->admin_session->set_flashdata('error', lang('error_zone_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
			
			$data	= array_merge($data, $city);
			
			$data['language_names']		= $this->Admin_location_model->get_location_language_names($db_table_name, $db_table_col, $city['city_id'] );
		}
		
		$this->form_validation->set_rules('zone_id', 'Country Zone ID', 'trim|required');
		$this->form_validation->set_rules('country_id', 'Country ID', 'trim|required');
		$this->form_validation->set_rules('name', 'lang:name', 'trim|required');
		//$this->form_validation->set_rules('code', 'lang:code', 'trim|required');
		$this->form_validation->set_rules('enabled', 'lang:enabled', 'trim');
		
		if($this->input->post('language_names')):
			foreach($this->input->post('language_names') as $key=>$val):
				$this->form_validation->set_rules("language_names[$key]", $key. ' string language names', 'required');
			endforeach;
		endif;	
	
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view.'/locations/country_zone_city_form', $data);
		}
		else
		{
			$save['city_id']	= $id;
			$save['zone_id']		= $this->input->post('zone_id');
			$save['country_id']				= $this->input->post('country_id');
			$save['name']					= $this->input->post('name');
			$save['code']					= $this->input->post('code');
			$save['enabled'] 				= $this->input->post('enabled');
			
			$city_id = $this->Admin_location_model->save_city($save);
			
			$this->admin_session->set_flashdata('message', 'City saved successfully.');
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix .'/get_cities/'.$zone_id);
		}
	}
	
	function delete_city($id = false)
	{
		die('Not allowed');
		if ($id)
		{	
			$location	= $this->Admin_location_model->get_zone($id);
			if (!$location)
			{
				$this->admin_session->set_flashdata('error', lang('error_zone_not_found'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
			}
			else
			{
				$this->Admin_location_model->delete_zone($id);
				
				$this->admin_session->set_flashdata('message', lang('message_deleted_zone'));
				redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix.'/zones/'. $location->country_id);
			}
		}
		else
		{
			$this->admin_session->set_flashdata('error', lang('error_zone_not_found'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller_prefix);
		}
	}

	function get_city_menu()
	{
		$id	= $this->input->post('id');
		$zones	= $this->Admin_location_model->get_zones_menu($id);
		foreach($zones as $id=>$z):?>
		<option value="<?php echo $id;?>"><?php echo $z;?></option>
		<?php endforeach;
	}
	/************Cities***********/


	function get_cities_menu_ajax()
	{
		$id	= $this->input->post('id');
		$zones	= $this->Admin_location_model->get_zones_menu($id);
		foreach($zones as $id=>$z):?>
		<option value="<?php echo $id;?>"><?php echo $z;?></option>
		<?php endforeach;
	}
	
	function get_zones_menu_ajax()
	{
		$id	= $this->input->post('id');
		$zones	= $this->Admin_location_model->get_zones_menu($id);
		foreach($zones as $id=>$z):?>
		<option value="<?php echo $id;?>"><?php echo $z;?></option>
		<?php endforeach;
	}
	
}
