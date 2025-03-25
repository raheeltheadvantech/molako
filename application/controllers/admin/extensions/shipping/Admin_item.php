<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_item extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'admin_item';
        $this->view_dir = 'extensions/shipping/item';
        $this->load->model(array(
            'admin/extensions/Admin_extensions_model',
            'admin/localisation/Admin_tax_class_model', 
            'admin/localisation/Admin_geo_zone_model'
        ));
	}
	
	function index()
	{

	}
	function edit()
	{
        $this->form('edit');
	}

    private function default_data(&$data)
    {
        $data['meta_title']			= 'Per Item';
        $data['meta_keywords']		= 'Per Item';
        $data['meta_description']	= 'Per Item';

        $data['page_title']			= 'Per Item';
        $data['page_header']		= 'Per Item';
    }

    private function form($mode = '')
    {
        $this->default_data($data);
        $field_title = '';
        if ($mode == 'edit')
        {


            $id = $this->input->get('id');
            $result	= $this->Admin_extensions_model->get_extension($id);
            if(!$result)
            {
                $this->admin_session->set_flashdata('error', lang('error_not_found'));
                redirect(site_url($this->admin_folder .'/extensions/shipping.html'));
            }

            // $result	= $this->Admin_extensions_model->get_extension_setting($result->type, $result->code);
            $data['result'] = $result;
            

            foreach($result as $key=>$val)
            {
                if($val->key == 'title'){
                    $field_title = $val->key .'_'. $val->setting_id;
                }
                $data[$val->key .'_name'] = $val->key .'_'. $val->setting_id;
                $data[$val->key] = $val->value;
            }

           // echo "<pre>";print_r($data);exit;

            $data['geo_zones'] 	= $this->Admin_geo_zone_model->get_geo_zones();
            $data['tax_classes'] 	=  $this->Admin_tax_class_model->get_tax_classes();

           // echo "<pre>";print_r( $data['tax_classes']);die
            
            $data['route'] 	= current_url();
        }else{
            $this->admin_session->set_flashdata('error', lang('error_not_found'));
            redirect(site_url($this->admin_folder .'/extensions/shipping.html'));
        }

        $this->form_validation->set_rules($field_title, 'Title', 'trim|required|max_length[255]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->view($this->admin_view .'/'. $this->view_dir .'/item_form', $data);
        }
        else
        {
            $post = $this->input->post();
            $save = array();

            foreach ($post as $field_name => $field_value){
                $save[$field_name] = $this->input->post($field_name);
            }
            
            $this->Admin_extensions_model->save_extension_setting($save);

            $this->admin_session->set_flashdata('message', 'Per Item shipping settings have been saved successfully!');

            redirect(site_url($this->admin_folder .'/extensions/shipping.html'));
        }
    }
}