<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_languages extends Admin_Controller 
{
	protected $controller_dir 	 = 'localisation';
	protected $controller_prefix = 'admin_languages';
	
	function __construct()
	{
		parent::__construct();
		$this->load->helper('date');
		$this->lang->load('admin_languages');
		$this->load->model('admin/localisation/Admin_language_model');
		
		parent::phery();
	}
	
	function index($order_by="admin_language_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		$data['result']	= $this->Admin_language_model->languages();
		
		$data['function']		= __FUNCTION__;
		$data['controller_dir']	= $this->controller_dir;
		$data['controller']		= $this->controller_prefix;
		
		$data['page_title']			= lang('000000000111');
		$data['page_header']		= lang('000000000111');
		
		$this->view($this->admin_view.'/common/admin_languages', $data);
	}
	
	function ajaxcall_save_language($posted = NULL)
	{
		$response = PheryResponse::factory();
		$this->load->model('admin/Admin_language_model');
		
		if (Phery::is_ajax(true))
		{
			$save = $save_batch = $recent_added = array();
			if(isset($posted['items']))
			{
				$now = date("Y-m-d H:i:s");
				
				if(is_array($posted['items']) and sizeof($posted['items'])>0 )
				{
					foreach($posted['items'] as $key=>$val)
					{
						$save = array();
						$is_already_exist = $this->Admin_language_model->is_already_exist($val['culture_code']);
						if($is_already_exist)continue;
						$lang = $this->Admin_language_model->get_core_language_by_culture_code($val['culture_code']);
						if(!$lang)continue;
						
						$save['admin_language_id'] 	= false;
						$save['culture_code'] 	= $val['culture_code'];
						$save['name'] 			= $val['name'];
						$save['name_info'] 		= $val['name_info'];
						$save['is_rtl'] 		= $val['is_rtl'];
						$save['charset'] 		= $val['charset'];
						$save['language_id'] 	= $lang['language_id'];
						$save['country_id'] 	= $lang['country_id'];
						$save['country'] 		= $lang['country'];
						$save['language'] 		= $lang['language'];
						$save['iso2_country_code'] 		= $lang['iso2_country_code'];
						$save['iso3_country_code'] 		= $lang['iso3_country_code'];
						$save['iso2_language_code'] 	= $lang['iso2_language_code'];
						$save['iso3_language_code'] 	= $lang['iso3_language_code'];
						
						$save['date_added']		= $now;
						
						$save_batch[] = $save;
						$recent_added[] = $save['culture_code'];
						$this->Admin_language_model->save($save);
					}
					//$this->Admin_language_model->save_batch($save_batch);
					
					$data['recent_added']		= $recent_added;
					$data['admin_languages']	= $this->Admin_language_model->languages();
					$view = $this->partial($this->admin_view.'/common/admin_languages_ajax', $data, TRUE);
					
					$response
						->jquery('.table-language tbody tr')->remove()
						->jquery('.table-language tbody')
						->html($view)
					//	->appendTo('.table-language')
						->html(set_js_message('language added.'), '#js_message_container')
						->jquery('window')->scrollTop(0)
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

	function ajaxcall_delete_language($posted = NULL)
	{
		$response = PheryResponse::factory();
		$this->load->model('admin/Admin_language_model');
		
		$id = ( isset($posted['id']) ? $posted['id'] : false);
		if (Phery::is_ajax(true))
		{
			if(!$id)
			{
				$response
					->html(set_js_message('posted items not found.', 'error'), '#js_message_container')
					->jquery('window')->scrollTop(0)
					;
			}
			
			$lang = $this->Admin_language_model->get_language_by_id($id);
			if(!$lang)
			{
				$response
					->html(set_js_message('items not found.', 'error'), '#js_message_container')
					->jquery('window')->scrollTop(0)
					;
			}
				
			if($this->Admin_language_model->delete($id))
			//if(true)
			{	
				$response
					->jquery('.table-language tbody #tr-'.$id)
					->animate(array(
							'background-color' => '#ffff00',
							'opacity' => 0.8,
						), 800, 'linear', PheryFunction::factory('function(){$(this).remove();}')
					)
					->html(set_js_message('language deleted.', 'warning'), '#js_message_container')
					->jquery('window')->scrollTop(0)
					;
			}
			else
			{
				$response
					->html(set_js_message('Unable to delete selected item.', 'error'), '#js_message_container')
					->jquery('window')->scrollTop(0)
					;
			}
		}
		else
		{
			$response
					->html(set_js_message('posted items not found 2.', 'error'), '#js_message_container')
					->jquery('window')->scrollTop(0)
					;
		}
		
		echo $response;
		exit;
	}
		
}