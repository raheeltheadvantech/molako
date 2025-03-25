<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_address extends User_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'user/custom/User_address_model',
            'user/localisation/Location_model',
        ));

		$this->controller_name = 'user_address';
		$this->controller_dir = 'account';
		$this->view_dir = 'account/address';
	}
	
   function index()
	{
		$this->current_active_nav = 'addresses';
		$data['page_title']			= 'Contact Info';
		$data['page_header']		= 'Contact Info';
		$data['addresses']			= $this->User_address_model->get_addresses($this->customer_id);

		$user = (object)$this->user_session->userdata('user');
		if($this->site_config->item('is_short_checkout')){
			$result = $this->User_address_model->get_default_address($user->customer_id);
			if(!$result){
				$this->user_session->set_flashdata('error', 'Your request cannot be completed. Address information is required.');
			}
		}
		// print_r($data); die();
		$this->view($this->user_view .'/'. $this->view_dir .'/address-list', $data);
	}

	function add_address()
	{
		$this->current_active_nav = 'addresses';
		$data['page_title']			= 'Contact Info';
		$data['page_header']		= 'Contact Info';

		$data['first_name']			= $this->input->post('first_name') ? $this->input->post('first_name') :'';
		$data['last_name']			= $this->input->post('last_name') ? $this->input->post('last_name') :'';
		$data['company']			= $this->input->post('company') ? $this->input->post('company') :'';
		$data['address_1']			= $this->input->post('address_1') ? $this->input->post('address_1') :'';
		$data['address_2']			= $this->input->post('address_2') ? $this->input->post('address_2') :'';
		$data['city']				= $this->input->post('city') ? $this->input->post('city') :'';
		$data['postcode']			= $this->input->post('postcode') ? $this->input->post('postcode') :'';
        $data['country_id']			= $this->input->post('country_id') ? $this->input->post('country_id') : $this->Location_model->get_countries()->country_id;
		$data['region_id']			= $this->input->post('region_id') ? $this->input->post('region_id') :'';

        $data['country_option'] = '';
        $data['regions'] = '';

        $countries = $this->Location_model->get_countries(false);
        $countries_options  = array();


        foreach ($countries as $country){
            $countries_options[$country->country_id] = $country->name;
        }

        $default_country_id = $this->Location_model->get_default_country();

        if($default_country_id) {
            $data['regions'] = $this->Location_model->get_zones_menu($default_country_id->country_id);
        }

        $data['country_option'] = $countries_options;



		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('country_id', 'Country', 'trim|required');
		$this->form_validation->set_rules('region_id', 'Region', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$input_data = $this->input->post();
			$input_data['customer_id'] = $this->customer_id;
			if($this->User_address_model->save_address($input_data)){
				$this->user_session->set_flashdata('message','Your new address has been saved successfully!');
			// $this->view($this->user_view .'/'. $this->view_dir .'/edit-billing-address', $data);
		}
		else
		{
			$this->user_session->set_flashdata('error','Your new address has not been saved successfully. Try Again!');
			}
			redirect(site_url('secure/addresses.html'));
		}

		$this->view($this->user_view .'/'. $this->view_dir .'/edit-billing-address', $data);
	}

	function make_default()
	{
		if(isset($_GET['id']))
		{
			
				if($this->User_address_model->make_default($this->customer_id,$_GET['id'])){
				$this->user_session->set_flashdata('message','Default address has been set successfully!');
				}
				else{
						$this->user_session->set_flashdata('error','Soomething working werong. Try Again!');
				}
				redirect(site_url('secure/addresses.html'));
		}
		else
		{
			$this->user_session->set_flashdata('error','Your new address has not been saved successfully. Try Again!');
			redirect(site_url('secure/addresses.html'));
		}
	}
	function edit_address()
	{
		$this->current_active_nav = 'addresses';
		$data['page_title']			= 'Contact Info';
		$data['page_header']		= 'Contact Info';

		if($this->input->get('id')){
			$address_id = $this->input->get('id');
			$address = $this->User_address_model->get_address($address_id);
			$address = $this->User_address_model->get_address($address_id);
			foreach ($address as $key => $val){
				$data[$key] = $val;
			}
		}else{
			redirect(site_url('secure/addresses.html'));
		}


        $data['country_option'] = '';
        $data['regions'] = '';

        $countries = $this->Location_model->get_countries(false);
        $countries_options  = array();

        foreach ($countries as $country){
            $countries_options[$country->country_id] = $country->name;
        }


        $default_country_id = $this->Location_model->get_default_country();

        if($default_country_id) {
            $data['regions'] = $this->Location_model->get_zones_menu($data['country_id']);
        }

        $data['country_option'] = $countries_options;


        $this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
		$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('country_id', 'Country', 'trim|required');
		$this->form_validation->set_rules('region_id', 'Region', 'trim|required');

		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->user_view .'/'. $this->view_dir .'/edit-billing-address', $data);
		}
		else
		{

			$input_data = $this->input->post();
			$input_data['customer_id'] = $this->customer_id;

			if($this->User_address_model->save_address($input_data)){
				$this->user_session->set_flashdata('message','Your new address has been saved successfully!');
			}else{
				$this->user_session->set_flashdata('error','Your new address has not been saved successfully. Try Again!');
			}
			redirect(site_url('secure/addresses.html'));
		}
	}

	function delete_address()
	{
		$this->current_active_nav = 'addresses';
		$data['page_title']			= 'Address Book';
		$data['page_header']		= 'Address Book';

		if($this->input->get('id')){
			$address_id = $this->input->get('id');
			if($this->User_address_model->delete_address($address_id)){
				$this->user_session->set_flashdata('message','Your address has been deleted successfully!');
			}else{
				$this->user_session->set_flashdata('error','Your address has not been deleted successfully. Try Again!');
			}
			redirect(site_url('secure/addresses.html'));
		}else{
			$this->user_session->set_flashdata('error','Invalid request to delete an address. Try Again!');
			redirect(site_url('secure/addresses.html'));
		}
	}

	function get_region_by_country()
    {
        $json = array('error' => true);
        if($this->input->post()) {
            $country_id = $this->input->post('country_id');
            $zone = $this->Location_model->get_zones_menu($country_id);

            $json['result'] = true;
            $json['data'] = $zone;
        }
        ajax_response($json);
    }

}
