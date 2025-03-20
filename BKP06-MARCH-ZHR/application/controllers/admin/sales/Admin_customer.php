<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_customer extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		$this->controller_name = 'admin_customer';
        $this->view_dir = 'sales/customer';
		$this->load->model('admin/sales/Admin_customer_model');
		$this->load->model('admin/sales/Admin_order_model');
        $this->load->model('admin/localisation/Admin_location_model');
	}
	
	function index()
	{
		$data = array();
        $data['page_header'] = 'Customers List';

        $order 		= $this->input->get('order') ? $this->input->get('order') : '';
        $sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code 		= $this->input->get('code') ? $this->input->get('code') : '';
        $page 		= $this->input->get('page') ? $this->input->get('page') : 0;
        $rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';


        $term				= false;
        $data['code']		= $code;
        $post				= $this->input->post(null, false);

        $this->load->model('admin/Admin_search_model');

        $this->load->model('admin/Admin_search_model');
        if($post)
        {
            $term			= json_encode($post);
            $code			= $this->Admin_search_model->record_term($term);
            $data['code']	= $code;
            redirect(site_url($this->admin_folder .'/sales/customers.html?code='.$code));
        }
        elseif ($code)
        {
            $term			= $this->Admin_search_model->get_term($code);
        }


        $result	= $this->Admin_customer_model->get_customers(array('term' => $term,'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total	= $this->Admin_customer_model->get_customers(array('term' => $term,'order'=>$order,'sort'=>$sort), true);

        $data['result']	= $result;
        $data['customers']	= $result;
        $data['total']	= $total;

        $config['base_url']	= site_url($this->admin_folder .'/sales/customers.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']			= $total;
        $config['per_page']				= $rows;
        $config['offset']				= $per_page;
        $config['uri_segment']			= $this->uri->total_segments();
        $config['use_page_numbers'] 	= TRUE;
        $config['page_query_string'] 	= TRUE;
        $config['reuse_query_string'] 	= TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);


		//$data['customers'] = $this->Admin_customer_model->get_customers();
		$data['add_link'] = site_url($this->admin_folder.'/sales/customers/add.html');
        $this->view($this->admin_view.'/'.$this->view_dir.'/customer_list', $data);

	}


	function default_data_customer_form(&$data){
        $data['route'] 	= 'sales/customers/add.html';
        $data['first_name'] = '';
        $data['last_name'] = '';
        $data['email'] = '';
        $data['phone'] = '';
        $data['password'] = '';
        $data['confirm_password'] = '';
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
            $result	= $this->Admin_customer_model->get_customer($id);
            if(!$result)
            {
                $this->admin_session->set_flashdata('error', lang('error_not_found'));
                redirect(site_url($this->admin_folder .'/sales/customers.html'));
            }

            foreach($result as $key=>$val)
            {
                $data[$key] = $val;
            }

            $data['password'] = '';
            $data['confirm_password'] = '';

            $data['addresses'] = $this->Admin_customer_model->get_customer_address($id);


            $data['route'] 	= 'sales/customers/edit.html?id='.$data['customer_id'];
        }else{

            $data['first_name'] = '';
            $data['last_name'] = '';
            $data['email'] = '';
            $data['phone'] = '';
            $data['is_enabled'] = '';

            $data['password'] = '';
            $data['confirm_password'] = '';

            $data['route'] 	= 'sales/customers/add.html';



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
            $this->view($this->admin_view .'/'. $this->view_dir .'/customer_form', $data);
        }
        else
        {
            $id = $this->input->get('id');
            if(!empty($id)){
                $save['customer_id'] = $id;
            }

            $save['first_name'] = $this->input->post('first_name');
            $save['last_name'] = $this->input->post('last_name');
            $save['email'] = $this->input->post('email');
            $save['phone'] = $this->input->post('phone');
            $save['is_enabled'] = $this->input->post('is_enabled');
            $save['date_added'] = date('Y-m-d H:i:s');            

            if ($this->input->post('password') != '')
            {
                $save['password'] = md5($this->input->post('password'));
            }

            $this->Admin_customer_model->save($save);

            $this->admin_session->set_flashdata('message', 'Customer have been saved successfully!');

            redirect(site_url($this->admin_folder .'/sales/customers.html'));
        }
    }

    function is_already_exist($str)
    {
        $email	= $this->input->post('email');
        $customer_id	= $this->input->get('id');

        if(trim($email) == '')
        {
            return TRUE;
        }

        $result = $this->Admin_customer_model->is_already_exist($email, $customer_id);
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
        $result	= $this->Admin_customer_model->get_customer($id);
        if(!$result)
        {
            $this->admin_session->set_flashdata('error', lang('error_not_found'));
            redirect(site_url($this->admin_folder .'/sales/customers.html'));
        }

        // VALIDATE THE CUSTOMER DATA BEFORE DELETE
        // GETTING CUSTOMER ORDER INFO
        $result = $this->Admin_order_model->get_orders(array('customer_id' => $id), true);
        if($result)
        {
            $this->admin_session->set_flashdata('error', 'This customer has orders in the system you can\'t delete it' );
            redirect(site_url($this->admin_folder .'/sales/customers.html'));
        }

        $this->Admin_customer_model->delete($id);
        $this->admin_session->set_flashdata('message', 'Customer has been deleted successfully!' );
        redirect(site_url($this->admin_folder .'/sales/customers.html'));
    }


    function customer_addresses()
    {
        $data = array();
        $data['page_header'] = 'Customer Addresses List';
        $id = $this->input->get('id');
        if(empty($id)){
            $this->admin_session->set_flashdata('error', lang('error_not_found'));
            redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/customers.html'));
        }
        $data['addresses'] = $this->Admin_customer_model->get_customer_addresses($id);
        $data['add_link'] = site_url($this->admin_folder.'/sales/customers/address/add.html?cust-id='. $id);

        $this->view($this->admin_view.'/'.$this->view_dir.'/customer_address_list', $data);

    }

    public function address_add()
    {
        $this->address_form();
    }

    public function address_edit($id= false)
    {
        $this->address_form('edit');
    }

    private function address_form($mode = '')
    {
        $data = array();
        if ($mode == 'edit')
        {

            $id = $this->input->get('id');
            $cust_id = $this->input->get('cust-id');
            $result	= $this->Admin_customer_model->get_customer_address($id);
            if(!$result)
            {
                $this->admin_session->set_flashdata('error', lang('error_not_found'));
                redirect(site_url($this->admin_folder .'/sales/customers.html'));
            }


            foreach($result as $key=>$val)
            {
                $data[$key] = $val;
            }

            $data['password'] = '';
            $data['confirm_password'] = '';
            $data['country_option'] = '';
            $data['regions'] = '';
            $data['addresses'] = $this->Admin_customer_model->get_customer_address($id);



            $countries = $this->Admin_location_model->get_countries(false);
            $countries_options  = array();

            foreach ($countries as $country){
                $countries_options[$country->country_id] = $country->name;
            }

            $data['regions'] = $this->Admin_location_model->get_zones_menu($data['country_id']);
            $data['country_options'] = $countries_options;


            $data['route'] 	= 'sales/customers/address/edit.html?id='.$data['address_id'].'&cust-id='. $cust_id;
            $data['back'] 	= $this->admin_folder .'/sales/customers/address_list.html?id='. $cust_id;
        }else{

            $cust_id = $this->input->get('cust-id');
            $data['route'] 	= 'sales/customers/address/add.html?cust-id='. $cust_id;
            $data['first_name'] = '';
            $data['last_name'] = '';
            $data['company'] = '';
            $data['address_1'] = '';
            $data['address_2'] = '';
            $data['city'] = '';
            $data['postcode'] = '';
            $data['country_id'] = '';
            $data['country_id']	=  $this->Admin_location_model->get_countries()->country_id;
            $data['region_id'] = '';
            $data['back'] 	= $this->admin_folder .'/sales/customers/address_list.html?id='. $cust_id;
            $data['country_option'] = '';
            $data['regions'] = '';


            $countries = $this->Admin_location_model->get_countries(false);
            $countries_options  = array();

            foreach ($countries as $country){
                $countries_options[$country->country_id] = $country->name;
            }

            $default_country_id = $this->Admin_location_model->get_default_country();

            if($default_country_id) {
                $data['regions'] = $this->Admin_location_model->get_zones_menu($default_country_id->country_id);
            }

            $data['country_options'] = $countries_options;

        }

        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
        $this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
        $this->form_validation->set_rules('city', 'City', 'trim|required');
        $this->form_validation->set_rules('country_id', 'Country', 'trim|required');
        $this->form_validation->set_rules('region_id', 'Region', 'trim|required');

        if ($this->form_validation->run() == FALSE)
        {
            $this->view($this->admin_view .'/'. $this->view_dir .'/customer_address_form', $data);
        }
        else
        {
            $save = $this->input->post();

            $id = $this->input->get('id');
            $cust_id = $this->input->get('cust-id');
            if(!empty($id)) {
                $save['address_id'] = $id;
            }else{
                $save['customer_id'] = $cust_id;
            }

            if($this->Admin_customer_model->save_address($save)){
                $this->admin_session->set_flashdata('message','Your new address has been saved successfully!');
            }else{
                $this->admin_session->set_flashdata('error','Your new address has not been saved successfully. Try Again!');
            }
            redirect(site_url($this->admin_folder.'/sales/customers/address_list.html?id='. $cust_id));
        }
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

}