<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_jazzcash extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'admin_jazzcash';
        $this->view_dir = 'extensions/payment/jazzcash';
		$this->load->model('admin/extensions/Admin_extensions_model');
		$this->load->model('admin/sales/Admin_order_model');
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
        $data['meta_title']			= 'Jazzcash integration settings';
        $data['meta_keywords']		= 'Jazzcash integration settings';
        $data['meta_description']	= 'Jazzcash integration settings';

        $data['page_title']			= 'Jazzcash integration settings';
        $data['page_header']		= 'Jazzcash integration settings';
        $data['order_status']       = $this->Admin_order_model->get_order_status();
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
                redirect(site_url($this->admin_folder .'/extensions/payment.html'));
            }

            $result	= $this->Admin_extensions_model->get_extension_setting('payment', 'jazzcash');
            $data['result'] = $result;

            foreach($result as $key=>$val)
            {
                if($val->key == 'title'){
                    $field_title = $val->key .'_'. $val->setting_id;
                }
                $data[$val->key .'_name'] = $val->key .'_'. $val->setting_id;
                $data[$val->key] = $val->value;
            }
            $data['enabled'] = 0;
            if ($data['status'] == 1) {
                $data['enabled'] = 1;
            }
            // echo "<pre>";print_r($data);die;

            $data['route'] 	= current_url();
        }else{
            $this->admin_session->set_flashdata('error', lang('error_not_found'));
            redirect(site_url($this->admin_folder .'/extensions/payment.html'));
        }

        $this->form_validation->set_rules($field_title, 'Title', 'trim|required|max_length[255]');


        if ($this->form_validation->run() == FALSE)
        {
            $this->view($this->admin_view .'/'. $this->view_dir .'/jazzcash_form', $data);
        }
        else
        {
            $post = $this->input->post();
            $save = array();
            
            foreach ($post as $field_name => $field_value){
                $save[$field_name] = $this->input->post($field_name);
            }
            

            
            $this->Admin_extensions_model->save_extension_setting($save);

            $this->admin_session->set_flashdata('message', 'Jazzcash settings have been saved successfully!');

            redirect(site_url($this->admin_folder .'/extensions/payment.html'));
        }
    }
}