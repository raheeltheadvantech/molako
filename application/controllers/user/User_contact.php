<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_contact extends User_Public_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->model(
			array(
				'user/common/User_page_model',
				'user/catalog/User_catalog_model',
				'user/common/User_contact_us_model',
			)
		);

		$this->controller_name = 'contact';
		$this->controller_dir = '';
		$this->view_dir = 'page-content';
	}
	
    public function contact_us_default_data(&$data)
    {
		$data['meta_title']			= 'Contact Us';
		$data['meta_keywords']		= 'Contact Us';
		$data['meta_description']	= 'Contact Us';

		$data['page_title']			= 'Contact Us';
		$data['page_header']		= 'Contact Us';

		$data['name']	= '';
		$data['email']	= '';
		$data['phone']	= '';
        $data['city']	= '';
		$data['message']= '';

	}

	function index()
	{
	    $data = array();
	    $this->contact_us_default_data($data);
		$this->current_active_nav 	= 'contact';

		$this->form_validation->set_rules('name', 'Name','trim|required');
		$this->form_validation->set_rules('email', 'Email','trim|required|valid_email');
		$this->form_validation->set_rules('message', 'Message','trim|required|min_length[3]');


        if ($this->form_validation->run() == FALSE) {
            $this->view($this->user_view . '/' . $this->view_dir . '/contact-page', $data);
        } else 
        {
        	// Google reCAPTCHA API keys settings 
			// $secretKey  = '6LdmcvkmAAAAAJTXrFmFU2YeehmzEVhLpCxl8G37'; 
			 
			// Validate reCAPTCHA checkbox 
	        // if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response']))
	        // { 
	        	// Verify the reCAPTCHA API response  
	            // $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
	             
	            // Decode JSON data of API response 
	            // $responseData = json_decode($verifyResponse); 
	            // If the reCAPTCHA API response is valid 
	            // if($responseData->success)
	            // { 

                    $save['name'] = $this->input->post('name');
                    $save['email'] = $this->input->post('email');
                    $save['phone'] = $this->input->post('phone');
                    $save['city'] = $this->input->post('city');
                    $save['message'] = $this->input->post('message');
                    $save['date_added'] = date('Y-m-d H:i:s');

                    $this->User_contact_us_model->save($save);
                    $save['type'] = 'contacting us';
                    $this->send_contact_email($save);
                    $this->user_session->set_flashdata('message', 'Thank you for contact us. Your message has been sent successfully!');
            //     }else{
        	// 			$this->user_session->set_flashdata('message', 'Robot verification failed, please try again.');
            // 	}

	        // }else{ 
	        // 	$this->user_session->set_flashdata('message', 'Please check the reCAPTCHA checkbox.');
            // }

           	redirect(site_url('contact-us.html'));

        }

	}

	public function get_information_page($page_id = '')
	{
		$page_id = !empty($page_id) ? $page_id : '1000000';
		$data = array();
		switch ($page_id){
			case '1000000':
				$this->current_active_nav 	= 'about';
				break;
			case '1000011':
				$this->current_active_nav 	= 'free-shipping';
				break;
			case '1000012':
				$this->current_active_nav 	= 'gallery';
				break;
			default:
				$this->current_active_nav 	= 'about';
		}


		$culture_code = $this->config->item('culture_code');

		$result 		= $this->User_page_model->get_page_contents($page_id, $culture_code);

		if(!$result)
		{
			show_404();
		}

		$data['result'] 			= $result;
		$data['meta_title']			= $result->meta_title;
		$data['meta_keywords']		= $result->meta_keywords;
		$data['meta_description']	= $result->meta_description;

		$data['page_title']			= $result->name;
		$data['page_header']		= $result->name;


		$data['content']			= $result->content;
		//$this->view($this->user_view .'/'. $this->view_dir .'/about-page', $data);
		$this->view($this->user_view . '/page-content/page', $data);
	}

	public function free_shipping()
	{
		$page_id = '1000011';
		$data = array();
		$this->current_active_nav 	= 'free-shipping';

		$culture_code = $this->config->item('culture_code');

		$result 		= $this->User_page_model->get_page_contents($page_id, $culture_code);

		if(!$result)
		{
			show_404();
		}

		$data['result'] 			= $result;
		$data['meta_title']			= $result->meta_title;
		$data['meta_keywords']		= $result->meta_keywords;
		$data['meta_description']	= $result->meta_description;

		$data['page_title']			= $result->name;
		$data['page_header']		= $result->name;


		$data['content']			= $result->content;
		$this->view($this->user_view .'/'. $this->view_dir .'/about-page', $data);
	}


	public function store_location()
	{
		
		// $data['result'] 			= $result;
		// $data['meta_title']			= $result->meta_title;
		// $data['meta_keywords']		= $result->meta_keywords;
		// $data['meta_description']	= $result->meta_description;

		$data['page_title']			= "Store Location";
		// $data['page_header']		= $result->name;


		// $data['content']			= $result->content;
		$this->view($this->user_view .'/'. $this->view_dir .'/store-location', $data);
	}

	public function add_newsletter()
    { 
        $json = array('error' => true);

        $this->form_validation->set_rules('email', 'Email','trim|required|valid_email|callback_is_already_newsletter');
        $this->form_validation->set_rules('name', 'Name','trim|required');

        if ($this->form_validation->run() == FALSE){
            $json['message'] = strip_tags(form_error('email'));
        }else {

            $email = $this->input->post('email');
            $name = $this->input->post('name');
            $save['name'] = $name;
            $save['email'] = $email;
            $save['date_added'] = date('Y-m-d H:i:s');
            $this->User_contact_us_model->save_newsletter($save);
            $save['phone'] = '';
            $save['type'] = 'subscribe';
            $this->send_contact_email($save);
            $json['result'] = true;
            $json['error'] = false;
            $json['message'] = 'Newsletter subscribed successfully';
        }
        ajax_response($json);
    }


    // public function unsubscribe();
    // {
    // 	$email= $this->input->get('email');
    // 	$params['status'] = 0;
    //     $this->User_contact_us_model->update_status($params, $email);
    //     $this->user_session->set_flashdata('message', 'You have successfully unsubscribed from our newsletter.');
    //     redirect(site_url('contact-us.html'));
    // }

	/**
	 * SEND EMAIL TO USER WHO SUBMITS THE CONTACT US FORM
	 * @param $order_id
	 * @param $end_user_id
	 * @return bool
	 */
	private function send_contact_email($data)
	{
		if(empty($data))
		{
			return FALSE;
		}
		
		$data = (object)$data;
		
		$message = $this->view_email($this->user_view.'/emails/email_contact_user', array('user'=>$data), TRUE);
		$subject = site_config_item('config_name').' - Thank you for '.$data->type;

		$from_email = site_config_item('config_mail_from_email');
		$from_name = site_config_item('config_mail_from_name');

		$this->load->library('email');
		$config['mailtype'] = 'html'; 
		$this->email->initialize($config);

		$this->email->from($from_email, $from_name);
		$this->email->to($data->email);
		$this->email->subject($subject);
		$this->email->message($message);

		$e_1 = @$this->email->send();

		// additional emails
		$additional_emails = site_config_item('config_alert_emails');
		$arr_emails = explode(',', $additional_emails);
		$arr_emails = array_map('trim', $arr_emails);
		// pre($additional_emails);
		if ($arr_emails) {
			// echo'if';pre($additional_emails);
			$this->email->to($arr_emails);
			$this->email->subject($subject . ' - ADMIN');
			$this->email->message($message);
			$e_2 = @$this->email->send();
		}
	}


    

    public function is_already_newsletter($str)
    {
        $email	= $this->input->post('email');

        if(trim($email) == '')
        {
            return TRUE;
        }

        $result = $this->User_contact_us_model->is_already_exist($email);
        if ($result)
        {
            $this->form_validation->set_message('is_already_newsletter', 'This email is already exists.');
            return FALSE;
        }

        return TRUE;
	}

}
