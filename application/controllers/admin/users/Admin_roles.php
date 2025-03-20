<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_roles extends Admin_Controller 
{

	function __construct()
	{
        $this->controller_name = 'admin_roles';
        $this->view_dir = 'users/roles';
        $this->admin_user_id;
        $this->admin_role_id;

		parent::__construct();
		$this->load->helper('date');
		$this->load->model('admin/users/Admin_Acl_model');
	}

    function index($order_by="admin_role_id", $sort_order="ASC", $code=0, $page=0, $rows=15)
    {
        $data['controller_dir']		= $this->controller_dir;

        $data['page_title']	= 'Roles List';
        $data['page_header']= 'Roles List';

        $order      = $this->input->get('order') ? $this->input->get('order') : '';
        $sort       = $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code       = $this->input->get('code') ? $this->input->get('code') : '';
        $page       = $this->input->get('page') ? $this->input->get('page') : 0;
        $rows       = $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page   = $this->input->get('per_page') ? $this->input->get('per_page') : '';

        $data['code']		= $code;
        $term				= false;

        $post				= $this->input->post(null, false);

        $this->load->model('admin/Admin_search_model');
        if($post)
        {
            $term           = json_encode($post);
            $code           = $this->Admin_search_model->record_term($term);
            $data['code']   = $code;
            redirect(site_url($this->admin_folder .'/users/roles.html?code='.$code));
        }
        elseif ($code)
        {
            $term           = $this->Admin_search_model->get_term($code);
        }

        $data['term']		= $term;
        $data['order_by']	= $order_by;
        $data['sort_order']	= $sort_order;

        $data['result']		= $this->Admin_Acl_model->admin_roles(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order, 'rows'=>$rows, 'page'=>$page));
        $data['total']		= $this->Admin_Acl_model->admin_roles(array('term'=>$term, 'order_by'=>$order_by, 'sort_order'=>$sort_order), true);

        $this->load->library('pagination');

        $config['base_url']	= site_url($this->admin_folder .'/users/roles.html?order='.$order_by.'&sort='.$sort_order.'&code='.$code);
        $config['total_rows']		= $data['total'];
        $config['per_page']			= $rows;
        $config['uri_segment']		= 8;

        $this->pagination->initialize($config);

        $this->view($this->admin_view.'/users/roles/admin_roles', $data);
    }

    function default_data_roles_form(&$data){
        $data['route'] 	= 'roles/add.html';
        $data['id']				= '';
        $data['name']			= '';
        $data['enabled']		= 1;
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
        $data = array();

        if ($mode == 'edit')
        {

            $id = $this->input->get('id');

            $result				= $this->Admin_Acl_model->get_admin_role($id);
            if (!$result)
            {
                $this->admin_session->set_flashdata('message', lang('error_not_found'));
                redirect($this->admin_folder . '/users/roles.html');
            }

            $data['id']				= $result->role_id;
            $data['name']			= $result->name;
            $data['enabled']		= $result->enabled;

            $data['route'] 	= 'users/roles/edit.html?id='. $data['id'];

            }else{

            $data['route'] 	= 'users/roles/add.html';
            $data['id']				= '';
            $data['name']			= '';
            $data['enabled']		= 1;
        }

        $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[5]|max_length[32]|callback_is_admin_role_already_exist');
        $this->form_validation->set_rules('enabled', 'Enables', 'trim|numeric');


        if ($this->form_validation->run($this) == FALSE)
        {
            $this->view($this->admin_view.'/users/roles/admin_role_form', $data);
        }
        else
        {
            $id = $this->input->get('id');
            if(!empty($id)){
                $save['role_id'] = $id;
            }

            $save['name']			= $this->input->post('name');
            $save['enabled']		= $this->input->post('enabled');

            $now = date("Y-m-d H:i:s");
            if (!$id)$save['date_added']		= $now;
            if ($id)$save['date_modified']		= $now;

            $this->Admin_Acl_model->save_admin_role($save);
            $this->admin_session->set_flashdata('message', 'Roles have been saved successfully!');

            redirect($this->admin_folder . '/users/roles.html');
        }
    }


    function delete()
    {
        $id = $this->input->get('id');
        $result	= $this->Admin_Acl_model->get_admin_role($id);
        if (!$result)
        {
            $this->admin_session->set_flashdata('error', 'Role not found');
            redirect($this->admin_folder . '/users/roles.html');
        }



        $this->Admin_Acl_model->admin_role_delete($id);

        $this->admin_session->set_flashdata('message', 'Role Delete Successfully');
        redirect($this->admin_folder . '/users/roles.html');

    }

    function admin_role_permission_add()
    {
        $this->admin_role_permission_form(false, __FUNCTION__);
    }

    function admin_role_permission_edit($id = false)
    {
        $id = $this->input->get('id');
        $this->admin_role_permission_form($id, __FUNCTION__);
    }

    private function admin_role_permission_form($id = false, $function = false)
    {

        $data['function'] = $function;
        $data['controller_dir'] = $this->controller_dir;

        $result = $this->Admin_Acl_model->get_admin_role($id);
        if (!$result) {
            $this->admin_session->set_flashdata('error', 'Roles not found');
            redirect($this->admin_folder . '/users/roles.html');
        }

        $data['items'] = array();
        $data['id'] = $id;
        $data['result'] = $result;
        $data['categories'] = $this->Admin_Acl_model->get_admin_module_categories();

        $data['route'] 	= 'permission/edit.html?id='. $data['id'];

        $perms = $this->Admin_Acl_model->get_role_permissions($id);

        $permissions = array();
        if (is_array($perms)) {
            foreach ($perms as $key => $val) {
                $permissions[$val->acl_category_id][$val->acl_module_id][] = (int)$val->acl_action_id;
                $permissions[$val->acl_category_id][$val->acl_module_id]['view'] = (int)$val->view;
                $permissions[$val->acl_category_id][$val->acl_module_id]['add'] = (int)$val->add;
                $permissions[$val->acl_category_id][$val->acl_module_id]['edit'] = (int)$val->edit;
                $permissions[$val->acl_category_id][$val->acl_module_id]['delete'] = (int)$val->delete;
            }
        }


        $data['items_tmp'] = $permissions;


        $data['page_title'] = 'Roles Permission';
        $data['page_header'] = 'Roles Permission';


        //if ($this->input->method() === 'post') {

            $this->form_validation->set_rules('items[]', 'lang:items', 'xss_clean');

            if ($this->form_validation->run() == FALSE) {
                $this->view($this->admin_view . '/users/roles/admin_role_permission_form', $data);
            } else {
                $items = $this->input->post('items');

                $save_batch = false;

                if (is_array($items)):
                    $save_batch = array();
                    foreach ($items as $key => $val) {
                        foreach ($val as $key2 => $val2) {
                            // if (sizeof($val2) > 1) 
                            // {
                                foreach ($val2 as $key3 => $val3) 
                                {
                                    $save = array();
                                    $save['role_permission_id'] = false;
                                    $save['role_id'] = $id;
                                    $save['acl_module_id'] = $key2;
                                    $save['acl_action_id'] = $key3;
                                    $save['acl_category_id'] = $key;

                                    if (isset($val3['view']))
                                        $save['view'] = $val3['view'];

                                    if (isset($val3['add']))
                                        $save['add'] = $val3['add'];

                                    if (isset($val3['edit']))
                                        $save['edit'] = $val3['edit'];

                                    if (isset($val3['delete']))
                                        $save['delete'] = $val3['delete'];

                                    $save_batch[] = $save;
                                }
                            // }else{
                            //     $params = array(
                            //         'acl_module_id' => $key2,
                            //         'enabled' => 1,
                            //     );
                            //     if (isset($val[$key2]['view']))
                            //     $params['view'] = $val2['view'];
                                
                            //     $acl_action_id = $this->Admin_Acl_model->save_admin_acl_actions($params,$key2);
                            //     $save = array();
                            //     $save['role_permission_id'] = false;
                            //     $save['role_id'] = $id;
                            //     $save['acl_module_id'] = $key2;
                            //     $save['acl_action_id'] = $acl_action_id;
                            //     $save['acl_category_id'] = $key;

                            //     if (isset($val[$key2]['view']))
                            //     $save['view'] = $val2['view'];
                            //     $save_batch[] = $save;
                            // }
                        }
                    }
                endif;

                if ($this->Admin_Acl_model->save_admin_role_permissions_batch($save_batch, $id)) {

                    $this->admin_session->set_flashdata('message', 'Roles Permission have been saved successfully!');
                } else {
                    $this->admin_session->set_flashdata('error', 'Roles Permission not saved!');
                }
                redirect($this->admin_folder . '/users/roles.html');
            }

       // }

    }

    function is_admin_role_already_exist($str)
    {

        $result = $this->Admin_Acl_model->is_admin_role_already_exist($str, $this->admin_role_id);
        if ($result)
        {
            $this->form_validation->set_message('is_admin_role_already_exist', 'Role name is already exist');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }

}