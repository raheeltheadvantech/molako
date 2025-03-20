<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_settings extends Admin_Controller 
{
	function __construct()
	{
		parent::__construct();
		
		$this->controller_dir = 'system';
		$this->controller_name = 'admin_settings';
		$this->view_dir = 'system';
		
		$this->load->model(array(
			'admin/system/Admin_setting_model', 
			'admin/localisation/Admin_location_model',
			'admin/localisation/Admin_weight_model', 
			'admin/localisation/Admin_length_model',
			'Email_model'));
		$this->load->helper('date');
	}
	
	function index()
	{
		$this->setting_edit();
	}

	function setting_add()
	{
		$route = 'setting-add.html';
		$this->setting_form(false, $route);
	}
	
	function setting_edit()
	{
		$route = 'setting-edit.html';
		$this->setting_form($mode = 'edit',  $route);
	}
	
	private function setting_form($mode = '', $function = false)
	{
		$config = 'config';
		
		$data['page_title']		= 'General settings';
		$data['page_header']	= 'General settings';

		$data['function']			= $function;
		$data['controller_dir']		= $this->controller_dir;
		$data['controller_name']	= $this->controller_name;
		
		$data['config']	= $config;
		
		
		$this->setting_default_data($data);

		if ($mode == 'edit')
		{	
			$result	= $this->Admin_setting_model->get_settings($config);

			if(!empty($result)):
			foreach($result as $key=>$val)
			{
				$data[$key]	= $val;
			}
			endif;
			$tax_states = array();
            if(!empty($data['tax_states'])){
              $states =   explode(',' , $data['tax_states']);

                foreach ($states as $val){

                    $tax_states[$val] = get_state_name($val);

                }

            }
            $data['tax_states'] = $tax_states;

			$data['zones_menu']	= $this->Admin_location_model->get_zones_menu($data['config_country_id']);
		}
		
		$this->form_validation->set_rules('config_name', 'lang:name', 'trim|required');
		$this->form_validation->set_rules('config_owner', 'lang:owner', 'trim|required');
		$this->form_validation->set_rules('config_email', 'lang:email', 'trim|required|valid_email|max_length[128]');
		$this->form_validation->set_rules('config_address', 'lang:address', 'trim|required');
		$this->form_validation->set_rules('config_telephone', 'lang:config_telephone', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('config_fax', 'lang:config_fax', 'trim|max_length[32]');
		
		
		$this->form_validation->set_rules('config_meta_title', 'lang:meta_title', 'trim|required');
		$this->form_validation->set_rules('config_meta_description', 'lang:meta_description', 'trim|required');
		$this->form_validation->set_rules('config_meta_keyword', 'lang:meta_keyword', 'trim|required');
		
		
		$this->form_validation->set_rules('config_currency', 'lang:currency', 'trim|required');
		
		$this->form_validation->set_rules('config_country_id', 'lang:country_id', 'trim|required');

		$this->form_validation->set_rules('config_zone_id', 'lang:zone_id', 'trim|required');


        $this->form_validation->set_rules('config_weight_class_id', 'lang:weight_unit', 'trim|required');
        $this->form_validation->set_rules('config_length_class_id', 'lang:length_unit', 'trim|required');

		$this->form_validation->set_rules('config_time_zone', 'lang:time_zone', 'trim|required');
 
		$this->form_validation->set_rules('config_paypal_sandbox_username', 'API Username', 'trim|required');
		$this->form_validation->set_rules('config_paypal_sandbox_password', 'API Password', 'trim|required');
		$this->form_validation->set_rules('config_paypal_sandbox_api_signature', 'API Signature', 'trim|required');
		$this->form_validation->set_rules('config_paypal_is_sandbox', 'Is Sandbox', 'trim');


		if(is_array($this->input->post('config_mail_from_email')))
		{
			//	@TODO
			$this->form_validation->set_rules('config_mail_from_email', 'lang:mail_from_email', 'trim|required');
			$this->form_validation->set_rules('config_mail_from_name', 'lang:mail_from_name', 'trim|required');
		}
		else
		{
			$this->form_validation->set_rules('config_mail_from_email', 'lang:mail_from_email', 'trim|required|valid_email|max_length[128]');
			$this->form_validation->set_rules('config_mail_from_name', 'lang:mail_from_name', 'trim|required');
		}
		
		$is_required = '|required';
		if($this->input->post('config_mail_engine') == 'smtp')
		{
            $this->form_validation->set_rules('config_mail_smtp_hostname', 'lang:smtp_host', 'trim'.$is_required);
            $this->form_validation->set_rules('config_mail_smtp_username', 'lang:smtp_user', 'trim'.$is_required);
            $this->form_validation->set_rules('config_mail_smtp_password', 'lang:smtp_password', 'trim'.$is_required);
            $this->form_validation->set_rules('config_mail_smtp_port', 'lang:smtp_port', 'trim'.$is_required);
            $this->form_validation->set_rules('config_mail_smtp_timeout', 'lang:smtp_timeout', 'trim');
            $this->form_validation->set_rules('config_mail_smtp_crypto', 'lang:smtp_crypto', 'trim'.$is_required);
		}elseif($this->input->post('config_mail_engine') == 'mail'){
            $this->form_validation->set_rules('config_mail_engine', 'lang:mail_engine', 'trim|required');
            $this->form_validation->set_rules('config_mail_parameter', 'lang:mail_parameter', 'trim');
        }elseif($this->input->post('config_mail_engine') == 'sendmail'){
            $this->form_validation->set_rules('config_sendmail_path', 'lang:sendmail_path', 'trim'.$is_required);
		}elseif($this->input->post('config_mail_engine') == 'sendgrid'){
			$this->form_validation->set_rules('sendgrid_key', 'Sendgrid APi key', 'trim|required');
		}
		
		
		if($this->input->post('country_id'))
		{
			$data['zones_menu']	= $this->Admin_location_model->get_zones_menu($this->input->post('country_id'));
		}
		
		if ($this->form_validation->run() == FALSE)
		{
			$this->view($this->admin_view .'/'. $this->view_dir. '/admin_setting_form', $data);
		}
		else
		{
			// echo "<pre>";var_dump($_POST);die();
			$cols = $this->setting_vars();
			foreach($cols as $key=>$col)
			{
				if(empty($col))
				{
					continue;
				}
				
				$save[$col] = $this->input->post_1($col);
			}
			// echo "<pre>";var_dump($save);die();

			$statees = $this->input->post('tax_states');
            if(!empty($statees)){
                $save['tax_states'] =  implode(',' ,$statees);
            }

//			echo '<pre>';
//			print_r($save);
//			die();

			$this->Admin_setting_model->save_settings($config, $save);
			
			$this->admin_session->set_flashdata('message', lang('message_item_saved'));
			
			redirect($this->admin_folder .'/'. $this->controller_dir. '/setting.html');
		}
	}
	public function test_email()
	{
		$mview = $this->admin_view .'/'. $this->view_dir. '/test_mail';
			$to = $this->input->post('your_email');
			$sub = 'Test mail by '.$result['config_meta_title'];
			$result	= $this->Admin_setting_model->get_settings('config');
			$html = $this->load->view($mview,array('comp'=>$result['config_name']),true);
			$r = $this->Email_model->do_email($to,$sub, $html);
			if(!$r)
			{
				$msg = 'Check configration please';
				$res['msg'] = $msg;
				$res['status'] = 0;
			}
			else
			{
				$res['status'] = '1';
				$res['msg'] = 'Email sent successfully!';
			echo json_encode($res);
			exit();
			}
		echo json_encode($res);
	}

	private function setting_default_data(&$data)
	{
		$cols = $this->setting_vars();
		
		foreach($cols as $key=>$val)
		{
			$data[$val] = '';
		}
		
		$data['config_time_zone']			= $this->config->item('time_zone');
		$data['config_currency']			= 'USD';  	// USD, EUR, etc,
		
		$data['config_mail_engine']			= 'mail';	//mail, sendmail, or smtp	The mail sending protocol.
		$data['config_sendmail_path']		= '/usr/sbin/sendmail';
		$data['config_mail_smtp_port']		= '25';
		$data['config_mail_smtp_timeout']	= '5';
		$data['sendgrid_key']	= ' ';

		$data['weight_menu'] 				= $this->Admin_weight_model->get_weights_menu();
		$data['length_menu'] 				= $this->Admin_length_model->get_lengths_menu();
		$data['countries_menu']				= $this->Admin_location_model->get_countries_menu();
		$countries_menu_keys 				= array_keys($data['countries_menu']);
		$data['zones_menu']					= $this->Admin_location_model->get_zones_menu(array_shift($countries_menu_keys));
		$data['time_zone_menu'] 			= get_time_zone_list();
		$data['currency_menu']				= array('$'=>'US Dollar', '£'=>'Pound Sterling', '€'=>'Euro', '₨'=>'Pakistani Rupee');
		$data['mail_engine_menu']			= array('mail'=>'Mail', 'sendmail'=>'Sendmail', 'smtp'=>'SMTP','sendgrid'=>'Sebdgrid' );
		$data['mail_smtp_crypto_menu']		= array('tls'=>'TLS', 'ssl'=>'SSL', );

        $data['discount_status']		    = array('1'=>'Enable', '0'=>'Disable');
        $data['discount_type']		        = array('percent'=>'percent', 'fixed'=>'fixed');

        $data['tax_status_select']		    = array('1'=>'Enable', '0'=>'Disable');
        $data['tax_type_select']		        = array('percent'=>'percent', 'fixed'=>'fixed');


	}
	
	private function setting_vars()
	{
		return $cols = array(
		'config_name', 'config_owner', 'config_email', 'config_address', 'config_telephone', 'config_fax',
		'config_meta_title', 'config_meta_description', 'config_meta_keyword', 'config_theme', 
		'config_country_id', 'config_zone_id','config_currency', 'config_length_class_id', 'config_weight_class_id',
		
		'config_mail_from_email', 'config_mail_from_name', 
		'config_mail_engine', 'config_mail_parameter', 'config_mail_smtp_hostname', 'config_mail_smtp_username', 'config_mail_smtp_password','sendgrid_key', 
		'config_sendmail_path', 'config_mail_smtp_port', 'config_mail_smtp_timeout', 'config_mail_smtp_crypto',
		
		'config_alert_emails','config_is_send_email_admin', 'config_is_send_email_customer', 
		'config_paypal_sandbox_username', 'config_paypal_sandbox_password', 'config_paypal_sandbox_api_signature','config_paypal_is_sandbox',
		
		'config_time_zone',
		'config_top_bar_content',
		'config_bottom_bar_content',
		
        'config_everyone_discount_type',
        'config_everyone_discount_value',
        'config_everyone_discount_status',

        'config_tax_type',
        'config_tax_value',
        'config_tax_status',
        'config_tax_states',

        'config_catalog_outstock','config_catalog_purchase','config_catalog_disable_checkout','config_checkout_coupon_code',

        );
	}

    public function state_autocomplete()
    {
         $term['term'] 		= $this->input->post('term') ? $this->input->post('term') : '';

        $term = json_encode($term);

        $rows 		= 10;
        $per_page 	= '';

        $result['result']	= $this->Admin_setting_model->get_state_typehead(array('term'=>$term,'rows'=>$rows, 'per_page'=>$per_page));

        echo json_encode($result['result']);
        //ajax_response($result);
    }

}
