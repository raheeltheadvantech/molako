<?php defined('BASEPATH') OR exit('No direct script access allowed');
// ini_set("memory_limit","4096M");

class User_home extends User_Public_Controller {
	
	function __construct()
	{
		parent::__construct(); 
		// $this->output->cache(20000);
        // $this->output->enable_profiler(TRUE);
        $this->load->driver('cache', ['adapter' => 'file']); // Load cache driver
		$this->load->model(
			array(
				'user/common/Customer_model',
                'user/common/User_slider_model',
				'user/common/User_featured_module_model',
            )
		);
		$this->controller_name 	= 'user_home';
		$this->controller_dir 	= '';
		$this->view_dir 		= '';
	}
    public function cache_part($key, $callback, $ttl = 600) // 10 minutes cache
    {
        $cached_content = $this->cache->get($key);

        if ($cached_content) {
            return $cached_content;
        }

        // Generate new content
        $content = call_user_func($callback);

        // Store in cache
        $this->cache->save($key, $content, $ttl);

        return $content;
    }

    public function special_products()
    { 
        $data['special_products'] = $this->User_featured_module_model->get_new_special_products(4); // Fetch special products
        // dd($data['special_products']);
        echo $this->load->view('special_products1', $data, true);
        exit();
    }

    public function test()
    {  
    	wite_nav();
    	echo 'done';
    	die();
    }

    public function new_arrival_products()
    { 
        $data['new_arrival_products'] = $this->User_featured_module_model->get_new_arrival_products(10); 
        echo $this->load->view('new_arrival_products', $data, true);
        exit();
    }

	public function jazzcash()
	{
		$this->load->view('jazzcash');
	}
	public function map()
	{
		$this->view($this->user_view.'/page-content/map');
	}
	function getUniqueFirstLetters($brands) {
    $letters = [];

    foreach ($brands as $brand) {
        $firstLetter = strtoupper($brand['name'][0]); // Pehla letter uppercase me lo
        $letters[] = $firstLetter; // Array me add karo
    }

    return array_values(array_unique($letters)); // Unique letters ka array return karo
}
	public function brands()
	{
		$data['meta_title']			= site_config_item('config_meta_title');
		$data['meta_keywords']		= site_config_item('config_meta_keyword');
		$data['meta_description']	= site_config_item('config_meta_description');
		
		$data['page_title']			= site_config_item('config_meta_title');
		$data['page_header']		= site_config_item('config_meta_title');
		$brands = $this->db->get('brands')->result_array();
		$data['brands'] = $brands;
		$data['fbrands'] = $this->getUniqueFirstLetters($brands);
		$this->view($this->user_view.'/page-content/brands',$data);
	}
	
	function index()
	{
		// pre(site_config_item('config_catalog_outstock'));
		$data['meta_title']			= site_config_item('config_meta_title');
		$data['meta_keywords']		= site_config_item('config_meta_keyword');
		$data['meta_description']	= site_config_item('config_meta_description');
		
		$data['page_title']			= site_config_item('config_meta_title');
		$data['page_header']		= site_config_item('config_meta_title');
		$data['page']		= 'home';
		//check83 437 


 
		// $data['featured_categories']	= $this->User_featured_module_model->get_featured_categories();

		$data['sliders']				= $this->User_slider_model->get_sliders();





		// +-----------------[MOST VIEW PRODUCTS START]----------------------+
        // $data['most_view_products'] = $this->User_featured_module_model->get_most_view_products();
        // dd($data['most_view_products']);
        //check90 666

		// +-----------------[MOST VIEW PRODUCTS ENDS]----------------------+

		// +----------------[BESTSELLER PRODUCTS START]----------------------+
		$bestseller_product_rows = (object)array();
        $data['bestseller_products'] = $this->User_featured_module_model->get_bestseller_products(4);


         // pre($data['bestseller_products']);die;
		// +-----------------[BESTSELLER PRODUCTS ENDS]----------------------+

		// +----------------[SPECIAL PRODUCTS START]----------------------+
        // +-----------------[SPECIAL PRODUCTS ENDS]----------------------+
        // pre($data['special_products']);die;

		// +----------------[RECENT PRODUCTS START]----------------------+
        $data['new_arrival_products'] = $this->User_featured_module_model->get_new_arrival_products(10); 
        // +-----------------[RECENT PRODUCTS ENDS]----------------------+
        $data['sale_products'] = array();//$this->User_featured_module_model->get_sale_products();
        $boxes = $this->db->order_by('sort_order','asc')->get('boxes')->result();
        $data['boxes'] = $boxes;

		$this->view($this->user_view.'/homepage/homepage', $data);
		if(isset($_GET['debug']))
		{
			$this->output->enable_profiler(TRUE);
		}
	}
	public function deals()
	{
		$data['meta_title']			= "Deals";
		$data['meta_keywords']		= "Deals";
		$data['meta_description']	= "Deals";
		
		$data['page_title']			= "Deals";
		$data['page_header']		= "Deals";

		$this->view($this->user_view.'/page-content/deals', $data);
	}
	function login_redirect()
	{
		redirect($this->user_url .'/secure/login.html');
	}
	
	function register_redirect()
	{
		redirect($this->user_url .'/secure/register.html');
	}
	
	function signup()
	{
		redirect($this->user_url .'/secure/register.html');
	}
	
	function default_register_data(&$data){
		$data['page_title']			= 'User registration';
		$data['page_header']		= 'User registration';
		
		$data['client_user_id']	= false;
		$data['first_name']		= '';
		$data['middle_name']	= '';
		$data['last_name']		= '';
		$data['email']			= '';
		
		$data['password']		= '';
		$data['confirm']		= '';
		$data['cell']			= '';
		$data['phone']			= '';
		$data['fax']			= '';
		$data['address_1']		= '';
		$data['address_2']		= '';
		$data['city']			= '';
		$data['post_code']		= '';
		$data['country']		= '';
		$data['country_id']		= '';
		$data['zone_id']		= '';
    }
	
	function register()
	{
	    $this->default_register_data($data);
		$this->form_validation->set_rules('first_name', 'First name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('last_name', 'Last name', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|max_length[128]|callback_is_already_exist');
		$this->form_validation->set_rules(
    'phone', 
    'Phone', 
    'required|regex_match[/^03[0-9]{2}-?[0-9]{7}$/]', 
    array('regex_match' => 'The %s field must be in the correct format, like 03XX-XXXXXXX or 03XXXXXXXXX')
);
		
		$this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
		$this->form_validation->set_rules('confirm', 'Confirm password', 'required|matches[password]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->user_view.'/registration/register', $data);
		}
		else
		{
			$save['customer_id']	= false;
			$save['first_name']		= $this->input->post('first_name');
			$save['last_name']		= $this->input->post('last_name');
			$save['email']			= $this->input->post('email');
			$save['phone']			= $this->input->post('phone');
			
			if ($this->input->post('password') != '')
			{
				$save['password'] = md5($this->input->post('password'));
			}
			
			$save['date_added'] 	= date('Y-m-d H:i:s');
			$save['is_enabled'] 	= 1;
			// pre($save);
			if($customer_id = $this->Customer_model->save($save))
			{
				$this->user_session->set_flashdata('message', 'You have register successfully to our website, please login to continue your shopping now.');
				$this->scustomer_signup_email($customer_id);
			}
			else
			{
				$this->user_session->set_flashdata('error', 'You have not register successfully to our website, please try again!.');
			}
			
			redirect($this->user_url .'/secure/login.html');
		}
	}
	
	function signin()
	{
		redirect($this->user_url .'/secure/login.html');
	}
	
	function login()
	{
		$login = $this->auth_user->is_logged_in();
		if ($login)
		{
			redirect($this->user_url .'/secure/dashboard.html');
		}

		$this->current_active_nav = 'login';

		$data['page_title']	= 'Login';
		$data['page_title']	= 'Login';
		
		$data['email'] 		= '';
		$data['password'] 	= '';
		$data['remember'] 	= 0;
		
		$this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'lang:password', 'trim|required');
		$this->form_validation->set_rules('submitted', 'submitted', 'trim|required|callback__do_authorize');
		
		
		if ($this->form_validation->run() == FALSE)
		{

        	$this->view($this->user_view.'/registration/login', $data);
		}
		else
		{

			redirect($this->user_url .'/secure/dashboard.html');

		}
	}


    function ajax_login()
    {


    	is_ajax();


        $data['email'] 		= '';
        $data['password'] 	= '';
        $data['remember'] 	= 0;

        $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email');
        $this->form_validation->set_rules('password', 'lang:password', 'trim|required');
        $this->form_validation->set_rules('submitted', 'submitted', 'trim|required|callback_do_authorize_ajax');



        if ($this->form_validation->run() == FALSE)
        {
            $html = $this->load->view('ajax_login', $data, true);
            ajax_response(array('error'=>true,'html'=> $html));
        }
        else
        {
        	$r = $this->_do_authorize(1);
        	ajax_response(array('error'=> false,'redirect'=>site_url('guest/checkout.html')));

        }


        // if ($this->_do_authorize(1))
        // {
        //     $json['result'] = true;
        //     $json['redirect'] = $this->input->server('HTTP_REFERER');
        //     return $this->output->set_output(json_encode($json));
        // }
        // else
        // {
        //     $json['message'] = 'Username/Password not valid';
        //     $this->user_session->set_flashdata('error', $json['message']);
        //     $d = array('email'=>'');
        //     $json['html'] = $this->load->view('ajax_login',$d,true);

            
        //    // $json['result'] = 'error';
        //    // header('Content-Type: application/json');
        //    // return $this->output->set_output(json_encode($json));

        //     ajax_response($json);


        // }
    }

	function _do_authorize($ajax = 0)
	{
		$email		= $this->input->post('email');
		$password	= $this->input->post('password');
		$remember   = 0;
		if($ajax)
		$remember   = $this->input->post('remember');
		
		
		if( function_exists('validation_errors') and validation_errors())
		{
			return TRUE;
		}
		
		$result	= $this->auth_user->login($email, $password, $remember);
		
		
		if ( $result === FALSE )
       	{
			if(!$ajax)
			{
			// $this->user_session->set_flashdata('login_error', 'Unable to authorized, please check your username and password.');
			$this->form_validation->set_message('_do_authorize', 'NO_ERROR');
			}
			
			return FALSE;
		}
		
		return TRUE;
	}
	function do_authorize_ajax()
	{
		$email		= $this->input->post('email');
		$password	= $this->input->post('password');
		
		
		if( function_exists('validation_errors') and validation_errors())
		{
		
			$result	= $this->auth_user->login($email, $password, 0);
			var_dump($result);
			die();
			
			
			if ( $result === FALSE )
	       	{
				$this->form_validation->set_message('do_authorize_ajax', 'Enter valid Username/Password');

				
				return FALSE;
			}
		}
		else{
			$result	= $this->auth_user->login($email, $password, 0);
			
			
			if ( $result === FALSE )
	       	{
				$this->form_validation->set_message('do_authorize_ajax', 'Enter valid Username/Password');

				
				return FALSE;
			}
			
		}
		
		return TRUE;
	}
	
	function is_already_exist($str)
	{
		$email	= $this->input->post('email');
		
		if(trim($email) == '')
		{
			return TRUE;
		}
		
		$result = $this->Customer_model->is_already_exist($email, $this->customer_id);
		if ($result)
		{
			$this->form_validation->set_message('is_already_exist', 'Email is already exist.');
			return FALSE;
		}
		
		return TRUE;
	}


	function scustomer_signup_email($customer_id = 1000000)
	{
		$result = $this->Customer_model->get_by_id($customer_id);
		if(empty($result))
		{
			return FALSE;
		}

		$message = $this->view_email($this->user_view.'/emails/email_signup', array('user'=>$result), TRUE);
		$subject = site_config_item('config_name').' - User Registered';

		$from_email = site_config_item('config_mail_from_email');
		$from_name = site_config_item('config_mail_from_name');

		$this->load->library('email');

		$this->email->from($from_email, $from_name);
		$this->email->to($result->email);
		$this->email->subject($subject);
		$this->email->message($message);

		$e_1 = @$this->email->send();

		// additional emails
		$additional_emails = site_config_item('config_alert_emails');
		$arr_emails = explode(',', $additional_emails);
		$arr_emails = array_map('trim', $arr_emails);

		$this->email->to($arr_emails);
		$this->email->subject($subject . ' - ADMIN');
		$this->email->message($message);
		$e_2 = @$this->email->send();
	}
	

	function forget_password()
    {
        $login = $this->auth_user->is_logged_in();
        if ($login)
        {
            redirect($this->user_url .'/secure/dashboard.html');
        }

        $this->current_active_nav = 'forget_password';

        $data['page_title']	= 'Forget Password';
        $data['page_title']	= 'Forget Password';

        $data['email'] 		= '';

        $this->form_validation->set_rules('email', 'lang:email', 'trim|required|valid_email|callback_is_email_exist');

        if ($this->form_validation->run() == FALSE)
        {
            $this->view($this->user_view.'/registration/forget_password', $data);
        }
        else
        {
            $save = array();
            $email = $this->input->post('email');
            $account_info = $this->Customer_model->get_by_email($email);
            $save['customer_id']    = $account_info->customer_id;
            $save['confirm_hash']   = $this->generate_token_code();
            $save['is_used']        = '0';
            $save['date_added']     = date('Y-m-d H:i:s');
            $save['date_modified']  = date('Y-m-d H:i:s');

            $this->Customer_model->save_forget_token($save);

            $this->send_forget_password_email($save);

            $this->user_session->set_flashdata('message', 'Please check your email, we sent an email with reset password link at <strong>'. $email .'</strong>.');

            redirect($this->user_url .'/secure/login.html');
        }
    }

    function is_email_exist($str)
    {
        $result = $this->Customer_model->is_already_exist($str);
        if (empty($result))
        {
            $this->form_validation->set_message(__FUNCTION__, 'Email is not registered at website.');
            return FALSE;
        }else{

            return true;
        }
    }

    private function generate_token_code($limit = 20){
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $toke_code = "";
        for ($i = 0; $i < $limit; $i++) {
            $toke_code .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return $toke_code;
    }

    function send_forget_password_email($data)
    {
        $this->load->library('encrypt');
        $result = $this->Customer_model->get_by_id($data['customer_id']);
        if(empty($result))
        {
            return FALSE;
        }

        $user_id = $this->encrypt->encode($data['customer_id']);
        $user_id = str_replace(array('+', '/', '='), array('-', '_', '~'), $user_id);
        
        $hash = $user_id . '-'. $data['confirm_hash'];

        $link = site_url('secure/reset-password.html?hash='. $hash);

        $result->link = $link;

        $message = $this->view_email($this->user_view.'/emails/email_forget_password', array('user'=>$result), TRUE);
        log_message('error', $message);
        $subject = site_config_item('config_name').' - Forget Password';

        $from_email = site_config_item('config_mail_from_email');
        $from_name = site_config_item('config_mail_from_name');

        $this->load->library('email');

        $this->email->from($from_email, $from_name);
        $this->email->to($result->email);
        $this->email->subject($subject);
        $this->email->message($message);

        $e_1 = @$this->email->send();

        // additional emails
        $additional_emails = site_config_item('config_alert_emails');
        $arr_emails = explode(',', $additional_emails);
        $arr_emails = array_map('trim', $arr_emails);

        $this->email->to($arr_emails);
        $this->email->subject($subject . ' - ADMIN');
        $this->email->message($message);
        $e_2 = @$this->email->send();
    }

    function reset_password()
    {

        $login = $this->auth_user->is_logged_in();
        if ($login)
        {
            redirect($this->user_url .'/secure/dashboard.html');
        }

        $hash = $this->input->get('hash');

        if(!$hash){
            $this->user_session->set_flashdata('login_error', 'Invalid reset password link.');
            redirect($this->user_url .'/secure/login.html');
        }

        $code = explode('-', $hash);
        $token = end($code);
        $user_id_hash = substr($hash, 0, strlen($hash) - (strlen($token)+1));
        $user_id_hash = str_replace(array('-', '_', '~'), array('+', '/', '='), $user_id_hash);
        $user_id = $this->encrypt->decode($user_id_hash);

        // CHECKING USER IS EXISTING IN DATABASE OR NOT
        $result = $this->Customer_model->get_by_id($user_id);
        if(empty($result))
        {
            $this->user_session->set_flashdata('login_error', 'Invalid reset password link.');
            redirect($this->user_url .'/secure/login.html');
        }

        // CHECKING PASSWORD REST TOKEN VALIDITY
        $result = $this->Customer_model->get_forget_token($user_id);
        if(empty($result))
        {
            $this->user_session->set_flashdata('login_error', 'Invalid reset password link.');
            redirect($this->user_url .'/secure/login.html');
        }

        $customer_password_reset_request_id = $result->customer_password_reset_request_id;
        $saved_token = $result->confirm_hash;


        if($token != $saved_token)
        {
            $this->user_session->set_flashdata('login_error', 'Invalid reset password link.');
            redirect($this->user_url .'/secure/login.html');
        }

        $this->current_active_nav = 'reset_password';

        $data['page_title']	= 'Reset Password';
        $data['page_title']	= 'Reset Password';


        $this->form_validation->set_rules('password', 'Password', 'required|min_length[4]');
        $this->form_validation->set_rules('confirm', 'Confirm password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE)
        {
            $this->view($this->user_view.'/registration/reset_password', $data);
        }
        else 
        {
            $save = array();
            $save['customer_id'] = $user_id;
            $save['date_modified'] = date('Y-m-d H:i:s');
            if ($this->input->post('password') != '')
            {
                $save['password'] = md5($this->input->post('password'));
            }
            $this->Customer_model->save($save);

            unset($save['password']); 

            $save['is_used'] = 1;
            $save['customer_password_reset_request_id'] = $customer_password_reset_request_id;
            $this->Customer_model->save_forget_token($save);
            $this->send_reset_password_email($save);

            $this->user_session->set_flashdata('message', 'Your password has been reset successfully.');

            redirect($this->user_url .'/secure/login.html');
        }
    }


    function send_reset_password_email($data)
    {
        $this->load->library('encrypt');
        $result = $this->Customer_model->get_by_id($data['customer_id']);
        if(empty($result))
        {
            return FALSE;
        }

        $message = $this->view_email($this->user_view.'/emails/email_reset_password', array('user'=>$result), TRUE);
        log_message('error', $message);
        $subject = site_config_item('config_name').' - Reset Password';

        $from_email = site_config_item('config_mail_from_email');
        $from_name = site_config_item('config_mail_from_name');

        $this->load->library('email');

        $this->email->from($from_email, $from_name);
        $this->email->to($result->email);
        $this->email->subject($subject);
        $this->email->message($message);

        $e_1 = @$this->email->send();

        // additional emails
        $additional_emails = site_config_item('config_alert_emails');
        $arr_emails = explode(',', $additional_emails);
        $arr_emails = array_map('trim', $arr_emails);

        $this->email->to($arr_emails);
        $this->email->subject($subject . ' - ADMIN');
        $this->email->message($message);
        $e_2 = @$this->email->send();
    }
    public function quick_view()
    {
        $pid= $this->input->get('pid');
        $img = $this->db->where('product_id',$pid)->get('ci_product_images')->row();
        $detail = $this->db->where('product_id',$pid)->get('ci_products')->row();
        $data = array();
        if($img->image)
        {
	        $data['img'] = base_url().'images/products/full/'.$img->image;
	    }
	    else
	    {
	        $data['img'] = base_url().'/assets/img/full-product-image.jpg';
	    }
		$val = (object) $product;
		$val->images = get_product_images($val->product_id);
            $val->special_price = get_product_special_price($val->product_id);

            if (isset($detail->option_name, $detail->option_value) && ($detail->option_name != '') && ($detail->option_value != '')) {
                $detail->is_variation = 1;
                $detail->varient_price =  get_product_varient_price($detail->product_id)->price;
            } else {
                $detail->is_variation = 0;
                $detail->varient_price = 0;
            }
			if(json_decode($detail->option_name,true))
			{

				$p = get_product_varient_price($detail->product_id);
				if(isset($p->quantity) && $p)
				{
					$detail->quantity = $p->quantity;
				}
				else
				{
					$detail->quantity = 0;
				}
			}



        $data['result']				= $product;
        $data['option_name']				= json_decode($product->option_name);
        $data['option_type']				= json_decode($product->option_type);
        $data['color_code']				= json_decode($product->color_code,true);
        $data['option_value']				= json_decode($product->option_value);
        $config_catalog_purchase = $this->db->where('key','config_catalog_purchase')->get('ci_settings')->row();
        if($config_catalog_purchase)
        {
            $config_catalog_purchase = $config_catalog_purchase->value;
        }
        else
        {
            $config_catalog_purchase = 0;
        }
		$data['config_catalog_purchase'] = $config_catalog_purchase;
			$data['detail'] = $detail;
			
        echo $this->load->view('quick_view'  ,$data,true);
    }


	// THIS FUNCTION WAS USED FOR UPDATING BRANDS NAME
    private function update_brand_abr()
    {
        $temp = array(
            'GOR' => 'Gorilla',
            'FOO' => 'Foose',
            'MSA' => 'MSA (powersports)',
            'NIC' => 'Niche',
            'KMC' => 'KMC',
            'XDS' => 'XD',
            'AB' => 'Asanti Black Label',
            'AFW' => 'American Force',
            'AOR' => 'Asanti Off Road',
            'ARM' => 'American Racing Manufacturing',
            'ASA' => 'Asanti',
            'ATX' => 'ATX',
            'AV' => 'Adventus',
            'BYD' => 'Boyd',
            'CRA' => 'Cragar',
            'DIA' => 'Diamo',
            'DP' => 'DPR',
            'DUB' => 'Dub',
            'FUE' => 'Fuel',
            'HLO' => 'Helo',
            'FWY' => 'Fairway Alloy',
            'LOR' => 'Lorenzo',
            'MKT' => 'Marketing',
            'MR' => 'Motegi Racing',
            'MTO' => 'Moto Metal',
            'MWH' => 'MSA (powersports)',
            'OER' => 'OE Creations',
            'OTR' => 'Over The Road',
            'PR' => 'Performance Replica',
            'QT' => 'Quantum',
            'REA' => 'ReadyLift',
            'REV' => 'Revolution Supply',
            'ROT' => 'Rotiform',
            'TOP' => 'Topline',
            'TRX' => 'T-Rex Moto Metal',
            'USM' => 'US Mags',
            'VF' => 'American Racing Vintage Forged',
            'VN' => 'American Racing Vintage',
            'WES' => 'West Coast Acc',
            'XDP' => 'XD Powersports',
        );

        foreach ($temp as $key => $item){
            $this->db->where('brand', $key)->update('combined_final', array('brand' => $item));
        }
	}
}
