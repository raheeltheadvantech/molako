<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_checkout_account extends User_Public_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'User_checkout_account';
		$this->controller_dir = 'checkout';
		$this->view_dir = 'checkout';

		$this->load->model(array(
			'user/custom/User_address_model',
            'user/localisation/Location_model',
		));
	}
	
	function index()
	{ 
		$data['page_title']			= 'Contact Info';
		$data['page_header']		= 'Contact Info';
		$data['billing']		= 1;

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



		$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('country_id', 'Country', 'trim|required');
		$this->form_validation->set_rules('region_id', 'Region', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$input_data = $this->input->post();
			$input_data['customer_id'] = $this->customer_id;
			$address_id = $this->User_address_model->save_address($input_data);
			if($address_id){
				$this->user_session->set_flashdata('message','Your new address has been saved successfully!');
				$checkout = (object)$this->user_session->userdata('checkout');
				$checkout->billing_address = $address_id;
				$this->user_session->set_userdata('checkout', $checkout);
			
				redirect(site_url('checkout/billing.html'));
			// $this->view($this->user_view .'/'. $this->view_dir .'/billing-address', $data);
		}
		else
		{
			$this->user_session->set_flashdata('error','Your new address has not been saved successfully. Try Again!');
				redirect(site_url('checkout/billing/address.html'));
			}
		}

		$this->view($this->user_view .'/'. $this->view_dir .'/billing-address', $data);
	}

	function shipping_address()
	{ 
		$data['page_title']			= 'Shipping Address';
		$data['page_header']		= 'Shipping Address';
		$data['shipping']			= 1;

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



		$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
		$this->form_validation->set_rules('city', 'City', 'trim|required');
		$this->form_validation->set_rules('country_id', 'Country', 'trim|required');
		$this->form_validation->set_rules('region_id', 'Region', 'trim|required');

		if ($this->form_validation->run() == TRUE)
		{
			$input_data = $this->input->post();
			$input_data['customer_id'] = $this->customer_id;
			$address_id = $this->User_address_model->save_address($input_data);
			if($address_id){
				$this->user_session->set_flashdata('message','Your new address has been saved successfully!');
				$checkout = (object)$this->user_session->userdata('checkout');
				$checkout->shipping_address = $address_id;
				$this->user_session->set_userdata('checkout', $checkout);
			
				redirect(site_url('checkout/shipping.html'));
			// $this->view($this->user_view .'/'. $this->view_dir .'/shipping-address', $data);
		}
		else 
		{
			$this->user_session->set_flashdata('error','Your new address has not been saved successfully. Try Again!');
				redirect(site_url('checkout/shipping/address.html'));
			}
		}

		$this->view($this->user_view .'/'. $this->view_dir .'/shipping-address', $data);
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