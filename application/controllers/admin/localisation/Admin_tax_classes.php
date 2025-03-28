<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_tax_classes extends Admin_Controller {


    function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'admin/localisation/Admin_tax_class_model', 
            'admin/localisation/Admin_location_model'));

        $this->controller_dir = 'localisation';
        $this->controller_name = 'admin_geo_zones';
        $this->view_dir = 'localisation';

    }

    /***	Geo Zones	 ***/

    function index()
    {

        $data['page_title']	= 'Tax Classes';
        $data['page_header']= 'Tax Classes';

        $params = array();

        $order 		= $this->input->get('order') ? $this->input->get('order') : 't.tax_class_id';
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

            redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/tax_classes.html?code='.$code));
        }
        elseif ($code)
        {
            $term			= $this->Admin_search_model->get_term($code);
        }

        $data['term']		= $term;
        $data['order_by']	= $order;
        $data['sort_by']	= $sort;



        $result	= $this->Admin_tax_class_model->get_tax_classes(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total	= $this->Admin_tax_class_model->get_tax_classes(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort), true);

        $data['result']	= $result;
        $data['total']	= $total;

        $config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/tax_classes.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']			= $total;
        $config['per_page']				= $rows;
        $config['offset']				= $per_page;
        $config['uri_segment']			= $this->uri->total_segments();
        $config['use_page_numbers'] 	= TRUE;
        $config['page_query_string'] 	= TRUE;
        $config['reuse_query_string'] 	= TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);

        $this->view($this->admin_view  .'/'. $this->view_dir .'/tax_classes_list', $data);
    }

    function default_data(&$data)
    {
        $data['page_title']		= 'Tax Class Form';
        $data['page_header']	= 'Tax Class Form';

        $data['title']			= '';
        $data['description']			= '';

        $data['id']	 = $this->input->get('id');

        $data['route'] = 'tax_class_add.html';

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
            $result	= $this->Admin_tax_class_model->get_tax_class($data['id']);
            if(!$result)
            {
                $this->admin_session->set_flashdata('error', 'Tax Class not found.');
                redirect($this->admin_url .'/'. $this->controller_dir .'/tax_classes.html');
            }

            $data['result'] 	= $result;

            foreach($result as $key=>$val)
            {
                $data[$key] = $val;
            }


            $tax_rate = $this->Admin_tax_class_model->get_tax_rate(false);

            $tax_rate_options  = array();

            foreach ($tax_rate as $taxrate){
                $tax_rate_options[$taxrate->tax_rate_id] = $taxrate->name;
            }

            $data['tax_rate'] = $tax_rate_options;


            $data['tax_rule']	= $this->Admin_tax_class_model->get_tax_rule($data['id']);

//            echo '<pre>';
//            print_r($data['tax_rule']);
//            die();

           // $data['route'] = 'tax-edit.html?id='.$data['id'];
            $data['route'] = 'tax_class_edit.html?id='.$data['id'];
        }
        else{


            $tax_rate = $this->Admin_tax_class_model->get_tax_rate(false);

            $tax_rate_options  = array();

            foreach ($tax_rate as $taxrate){
                $tax_rate_options[$taxrate->tax_rate_id] = $taxrate->name;
            }

            $data['tax_rate'] = $tax_rate_options;


//            echo '<pre>';
//            print_r($countries_options);
//            die();
        }

        $this->form_validation->set_rules('title', 'Title', 'trim|required|callback_is_tax_class_name_already_exist');
        $this->form_validation->set_rules('description', 'Description', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->view($this->admin_view  .'/'. $this->view_dir .'/tax_classes_form', $data);
        }
        else
        {
            $save['tax_class_id']		= $data['id'];
            $save['title']			= $this->input->post('title');
            $save['description']			= $this->input->post('description');
            $save['tax_rule']			= $this->input->post('tax_rule');


            $save['date_added']		= date('Y-m-d H:i:s');
            if ($data['id'])
            {
                $save['date_modified']	= date('Y-m-d H:i:s');
            }

            $this->Admin_tax_class_model->save_tax_class($save);

            $this->admin_session->set_flashdata('message', 'Tax Class has been saved.');
            redirect($this->admin_url .'/'. $this->controller_dir .'/tax_classes.html');
        }
    }


	
	function delete($id = false)
	{

        $tax_class_id	= $this->input->get('id');
	    $this->Admin_tax_class_model->delete_tax_class($tax_class_id);
		//$this->Admin_geo_zone_model->delete($id);

		$this->admin_session->set_flashdata('message', 'Tax Class has been deleted Successfully');

        redirect($this->admin_url .'/'. $this->controller_dir .'/tax_classes.html');

	}

    function is_tax_class_name_already_exist($str)
    {

        if(trim($str) == '')
        {
            return TRUE;
        }

        $tax_class_id	= $this->input->get('id');
        $result = $this->Admin_tax_class_model->is_tax_class_name_already_exist($str , $tax_class_id);
        if ($result)
        {
            $this->form_validation->set_message('is_tax_class_name_already_exist', 'Tax Class Name already exist');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

	function zone_to_geo_zone($geo_zone_id, $order_by="zone_to_geo_zone_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
	{
		
		$result			= $this->Admin_geo_zone_model->get_geo_zone($geo_zone_id);
		if (!$result)
		{
			$this->admin_session->set_flashdata('message', lang('error_not_found'));
			redirect($this->admin_folder.'/'.$this->controller_dir.'/'.$this->controller);
		}
		
		$data['zone']			= $result;
		$data['result']			= $this->Admin_geo_zone_model->get_zone_to_geo_zones($geo_zone_id);
		
		$function				= 'index';
		$data['id']				= '';
		$data['function']		= $function;
		$data['controller']		= $this->controller;
		$data['controller_dir']	= $this->controller_dir;
		
		$data['page_title']		= 'Zone Geo Zone';
		$data['page_header']	= 'Zone Geo Zone';
		
		$default_country_id = 184;
		$data['countries_menu']	= $this->Admin_location_model->get_countries_menu($default_country_id);
		$data['zones_menu']		= $this->Admin_location_model->get_zones_menu($default_country_id);
		$data['default_country_id']	= $default_country_id;
		
		$this->view($this->admin_view.'/localisation/zone_to_geo_zone_form', $data);
	}
	
	function ajaxcall_save_zone_to_geo_zone($posted = NULL)
	{
		$response = PheryResponse::factory();
		$this->load->model(array('admin/Admin_location_model', 'admin/Admin_geo_zone_model'));
		$geo_zone_id = !empty($posted['geo_zone_id']) ? $posted['geo_zone_id'] : 0;
		
		if (Phery::is_ajax(true))
		{
			$save = $save_batch = $recent_added = array();
			if(isset($posted['items']) and $geo_zone_id > 0)
			{
				$now = date("Y-m-d H:i:s");
				
				if(is_array($posted['items']) and sizeof($posted['items'])>0 )
				{
					$this->Admin_geo_zone_model->delete_zone_to_geo_zone($geo_zone_id);
					
					foreach($posted['items'] as $key=>$val)
					{
						$save = array();

						$is_already_exist = $this->Admin_geo_zone_model->is_already_exist_zone_to_geo_zone($geo_zone_id, $val['country_id'], $val['zone_id']);
						if($is_already_exist)continue;
						
						
						$save['zone_to_geo_zone_id'] 	= false;
						$save['country_id'] 			= $val['country_id'];
						$save['zone_id'] 				= $val['zone_id'];
						$save['geo_zone_id'] 			= $geo_zone_id;
						$save['date_added']				= $now;
						
						$zone_to_geo_zone_id 	= $this->Admin_geo_zone_model->save_zone_to_geo_zone($save);
						$recent_added[] 		= $zone_to_geo_zone_id;
						$save_batch[] 			= $save;
					}
					
					$data['recent_added']		= $recent_added;
					$data['result']				= $this->Admin_geo_zone_model->get_zone_to_geo_zones($geo_zone_id);
					//$view = $this->partial($this->admin_view.'/common/zone_to_geo_zone_ajax', $data, TRUE);
					
					$this->admin_session->set_flashdata('message', 'zone(s) added.');
					$response
						//->jquery('.table-list tbody tr')->remove()
						//->jquery('.table-list tbody')
						//->html($view)
					//	->html(set_js_message('zone(s) added.'), '#js_message_container')
					//	->jquery('window')->scrollTop(0)
						
						->call('redirect', site_url($this->admin_folder.'/localisation/admin_geo_zones/zone_to_geo_zone/'.$geo_zone_id), 0)
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



    public function get_region_by_country()
    {
        $json = array('error' => true);
        if($this->input->post()) {
            $country_id = $this->input->post('country_id');
            $zone = $this->Admin_location_model->get_zones_menu($country_id);

            $json['result'] = true;
            $json['data'] = $zone;
        }
        ajax_response($json);
    }


	/***	Geo Zones	 ***/
	
}


