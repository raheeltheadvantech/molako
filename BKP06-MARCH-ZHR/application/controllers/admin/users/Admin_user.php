<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_user extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'Admin_user';
        $this->view_dir = 'users/user';
		$this->load->model('admin/users/Admin_users_model');
	}
	
	function index()
	{
		$data = array();
        $data['page_header'] = 'Admin Users List';

        $order 		= $this->input->get('order') ? $this->input->get('order') : '';
        $sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code 		= $this->input->get('code') ? $this->input->get('code') : '';
        $page 		= $this->input->get('page') ? $this->input->get('page') : 0;
        $rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';

        $term               = false;
        $data['code']       = $code;
        $post               = $this->input->post(null, false);

        $this->load->model('admin/Admin_search_model');

        if($post)
        {
            $term           = json_encode($post);
            $code           = $this->Admin_search_model->record_term($term);
            $data['code']   = $code;
            redirect(site_url($this->admin_folder .'/users/user.html?code='.$code));
        }
        elseif ($code)
        {
            $term           = $this->Admin_search_model->get_term($code);
        }

        $result	= $this->Admin_users_model->get_users(array('term' => $term,'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total	= $this->Admin_users_model->get_users(array('term' => $term,'order'=>$order, 'sort'=>$sort), true);
        $data['users']	= $result;
        $data['total']	= $total;

        $config['base_url']	= site_url($this->admin_folder .'/users/user.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']			= $total;
        $config['per_page']				= $rows;
        $config['offset']				= $per_page;
        $config['uri_segment']			= $this->uri->total_segments();
        $config['use_page_numbers'] 	= TRUE;
        $config['page_query_string'] 	= TRUE;
        $config['reuse_query_string'] 	= TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);


		//$data['customers'] = $this->Admin_users_model->get_customers();
		$data['add_link'] = site_url($this->admin_folder.'/users/add.html');
        $this->view($this->admin_view.'/users/user/user_list', $data);

	}

	function default_data(&$data){
        $data['route'] 	= 'users/add.html';
        $data['first_name'] = '';
        $data['last_name'] = '';
        $data['email'] = '';
        $data['password'] = '';
        $data['confirm_password'] = '';
        $data['enabled'] = '';
        $data['role_id'] = '';
        $data['admin_roles'] = $this->Admin_users_model->get_user_roles();
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
            $result	= $this->Admin_users_model->get_user_by_id($id);
            
            if(!$result)
            {
                $this->admin_session->set_flashdata('error', lang('error_not_found'));
                redirect(site_url($this->admin_folder .'/users/user.html'));
            }

            foreach($result as $key=>$val)
            {
                $data[$key] = $val;
            }

            $data['password'] = '';
            $data['confirm_password'] = '';



            $data['route'] 	= 'users/edit.html?id='.$data['admin_user_id'];
        }

        $this->form_validation->set_rules('first_name', 'First name', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('last_name', 'Last name', 'trim|required|max_length[32]');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_is_already_exist');

        if(strlen($this->input->post('password')) > 0) {
            $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
            $this->form_validation->set_rules('confirm_password', 'Confirm password', 'required|matches[password]');
        }

        if ($this->form_validation->run() == FALSE)
        {
            $this->view($this->admin_view .'/'. $this->view_dir .'/user_form', $data);
        }
        else
        {
            $post = $this->input->post();

            unset($post['confirm_password']);
            
            $id = $this->input->get('id');
            if(!empty($id)){
                $post['admin_user_id'] = $id;
            }

            if ($this->input->post('password') != '')
            {
                $post['password'] = sha1($this->input->post('password'));
            }else{
                unset($post['password']);
            }

           // $post['is_sa'] = 1;

            $this->Admin_users_model->save($post);

            $this->admin_session->set_flashdata('message', 'User have been saved successfully!');

            redirect(site_url($this->admin_folder .'/users/user.html'));
        }
    }

    function is_already_exist($str)
    {
        $email	= $this->input->post('email');
        $admin_user_id	= $this->input->get('id');

        if(trim($email) == '')
        {
            return TRUE;
        }

        $result = $this->Admin_users_model->is_already_exist($email, $admin_user_id);
        if ($result)
        {
            $this->form_validation->set_message('is_already_exist', 'Email is already exist.');
            return FALSE;
        }

        return TRUE;
    }

    public function delete()
    {
        $id = $this->input->get('id');
        $result	= $this->Admin_users_model->get_user_by_id($id);
        if(!$result)
        {
            $this->admin_session->set_flashdata('error', lang('error_not_found'));
            redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/users.html'));
        }

        if($result->is_sa == 1)
        {
            $this->admin_session->set_flashdata('error', 'You can\'t delete Super Admin user');
            redirect(site_url($this->admin_folder .'/users/user.html'));
        }

        if($this->Admin_users_model->delete($id)){
            $this->admin_session->set_flashdata('message', 'User have been deleted successfully!');
        }else{
            $this->admin_session->set_flashdata('error', 'User have been deleted successfully. Please try again!');
        }

        redirect(site_url($this->admin_folder .'/users/user.html'));

    }

}