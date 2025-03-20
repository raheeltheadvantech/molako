<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_free extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'admin_free';
        $this->view_dir = 'extensions/shipping/free';
		$this->load->model('admin/extensions/Admin_extensions_model');
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
        $data['meta_title']			= 'Free Shipping';
        $data['meta_keywords']		= 'Free Shipping';
        $data['meta_description']	= 'Free Shipping';

        $data['page_title']			= 'Free Shipping';
        $data['page_header']		= 'Free Shipping';
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
                // DYNAMIC FILED NAME FOR FORM VALIDATION
                if($val->key == 'title'){
                    $field_title = $val->key .'_'. $val->setting_id;
                }

                // SETTING DYNAMIC FIELDS NAME AND VALUE
                $data[$val->key .'_name'] = $val->key .'_'. $val->setting_id;
                $data[$val->key] = $val->value;
            }
            // echo "<pre>";print_r($data);die;

            $data['route'] 	= current_url();
        }else{
            $this->admin_session->set_flashdata('error', lang('error_not_found'));
            redirect(site_url($this->admin_folder .'/extensions/shipping.html'));
        }

        $this->form_validation->set_rules($field_title, 'Title', 'trim|required|max_length[255]');


        if ($this->form_validation->run() == FALSE)
        {
            // dd($data);
            $this->view($this->admin_view .'/'. $this->view_dir .'/free_form', $data);
        }
        else
        {
            $post = $this->input->post();
            $save = array();
            
            foreach ($post as $field_name => $field_value){
                $save[$field_name] = $this->input->post($field_name);
            }
            
            
            $this->Admin_extensions_model->save_extension_setting($save);

            $this->admin_session->set_flashdata('message', 'Free shipping settings have been saved successfully!');

            redirect(site_url($this->admin_folder .'/extensions/shipping.html'));
        }
    }
}