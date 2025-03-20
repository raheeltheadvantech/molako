<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_total extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'Admin_total';
        $this->view_dir = 'extensions/total';
        $this->controller_dir = 'extensions';
        $this->load->model('admin/extensions/Admin_extensions_model');
	}
	
	function index()
    {
        $data = array();

        $data['page_header'] = 'Totals List';

        $order      = $this->input->get('order') ? $this->input->get('order') : '';
        $sort       = $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code       = $this->input->get('code') ? $this->input->get('code') : '';
        $page       = $this->input->get('page') ? $this->input->get('page') : 0;
        $rows       = $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page   = $this->input->get('per_page') ? $this->input->get('per_page') : '';

        $term               = false;
        $data['code']       = $code;
        $post               = $this->input->post(null, false);
        
        $this->load->model('admin/Admin_search_model');
        
        if($post)
        {
            $term           = json_encode($post);
            $code           = $this->Admin_search_model->record_term($term);
            $data['code']   = $code;
            redirect(site_url($this->admin_folder .'/extensions/total.html?code='.$code));
        }
        elseif ($code)
        {
            $term           = $this->Admin_search_model->get_term($code);
        }

        $result = $this->Admin_extensions_model->get_totals(array('term'=>$term,'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total  = $this->Admin_extensions_model->get_totals(array('term'=>$term, 'order'=>$order, 'sort'=>$sort), true);

        $data['result'] = $result;
        $data['results'] = $result;
        $data['total']  = $total;
        // echo'<pre>';print_r($result);die;

        $config['base_url'] = site_url($this->admin_folder .'/'. $this->controller_dir .'/total.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']           = $total;
        $config['per_page']             = $rows;
        $config['offset']               = $per_page;
        $config['uri_segment']          = $this->uri->total_segments();
        $config['use_page_numbers']     = TRUE;
        $config['page_query_string']    = TRUE;
        $config['reuse_query_string']   = TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);

        $data['add_link'] = site_url($this->admin_folder.'/extensions/total/add.html');

        $this->view($this->admin_view.'/extensions/total_list', $data);

    }

	function default_data(&$data){
        $data['route'] 	= '/total/add.html';
        $data['code'] = '';
        $data['sort_order'] = '';
    }

    function add()
    {
        $this->form();
    }

    function edit($id = false)
    {
        $this->form('edit');
    }
 
    private function form($mode = '')
    {
        $this->default_data($data);

        if ($mode == 'edit')
        {

            $id = $this->input->get('id');
            $result = $this->Admin_extensions_model->get_extension($id);
            
            if(!$result)
            {
                $this->admin_session->set_flashdata('error', lang('error_not_found'));
                redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/total.html'));
            }

            foreach($result as $key=>$val)
            {
                // if($val->key == 'status'){
                //     $field_title = $val->key .'_'. $val->setting_id;
                // }
                $field_title = $val->key .'_'. $val->setting_id;
                $data[$val->key .'_name'] = $val->key .'_'. $val->setting_id;
                $data[$val->key] = $val->value;
            }

            // foreach($result as $key=>$val)
            // {

            //     $data[$key] = $val;
            // }
            // echo "<pre>";print_r($result);die;

            $data['route'] 	= 'total/edit.html?id='.$id;
        }

        $this->form_validation->set_rules($field_title, 'Title', 'trim|required|max_length[255]');
      

        if ($this->form_validation->run() == FALSE)
        {
            $this->view($this->admin_view .'/'. $this->view_dir .'/total_form', $data);
        }
        else
        {
            $post = $this->input->post();
            $save = array();
            
            foreach ($post as $field_name => $field_value){
                $save[$field_name] = $this->input->post($field_name);
            }
            // echo "<pre>";print_r($save);die;
            $this->Admin_extensions_model->save_extension_setting($save);

            $this->admin_session->set_flashdata('message', 'User have been saved successfully!');

            redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/total.html'));
        }
    }

    function is_already_exist($str)
    {
        $code	= $this->input->post('code');
        $total_id	= $this->input->get('id');

        if(trim($code) == '')
        {
            return TRUE;
        }

        $result = $this->Admin_extensions_model->is_already_exist($code, $total_id);
        if ($result)
        {
            $this->form_validation->set_message('is_already_exist', 'Code is already exist.');
            return FALSE;
        }

        return TRUE;
    }

    public function delete()
    {
        $id = $this->input->get('id');
        $result	= $this->Admin_total_model->get_total_by_id($id);
        if(!$result)
        {
            $this->admin_session->set_flashdata('error', lang('error_not_found'));
            redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/total.html'));
        }

        if($this->Admin_extensions_model->delete($id)){
            $this->admin_session->set_flashdata('message', 'User have been deleted successfully!');
        }else{
            $this->admin_session->set_flashdata('error', 'User have been deleted successfully. Please try again!');
        }

        redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/total.html'));

    }

}