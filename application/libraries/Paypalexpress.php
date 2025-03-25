<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 
class PaypalExpress {

/**
* Paypal Express Checkout(NVP) CodeIgniter library
*
* This CodeIgniter library handles payments via paypal.
*
* @package codeigniter-paypal-express-checkout(NVP)
* @author Rakesh Sharma, <sharmarakesh395[at]gmail.com>
* @copyright Copyright (c) 2014, Rakesh Sharma
* @link https://github.com/rakeshksharma/codeigniter-payvector/
*/	
	public $pex_settings;
  	private $CI;
  	private $config;
	
	function __construct(){
		// $this->pex_settings = $pex_settings;
        $this->CI =& get_instance();
		$this->set_config();
	}
	
/**
  * hash_call: Function to perform the API call to PayPal using API signature
  * @method_name is name of API  method.
  * @nvpStr is nvp string.
  * returns an associtive array containing the response from the server.
  */

  	private function set_config()
	{
		$this->load_settings('payment');
        
        $settings = (object)$this->get_settings('paypal');
        
        
        $sandbox_mode = site_config_item('sandbox_mode');
        $sandbox_mode = $settings->sandbox_mode;
		
		if($sandbox_mode)
		{
			$paypal_username = $settings->sandbox_username;
            $paypal_password = $settings->sandbox_password;
            $paypal_api_signature = $settings->sandbox_api_signature;
			$this->config['api_endpoint'] 	= 'https://api-3t.sandbox.paypal.com/nvp';
			$this->config['api_url'] 		= 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=';
		}
		else
		{
			$paypal_username = $settings->live_username;
            $paypal_password = $settings->live_password;
            $paypal_api_signature = $settings->live_api_signature;

			$this->config['api_endpoint'] 	= 'https://api-3t.paypal.com/nvp';
			$this->config['api_url'] 		= 'https://www.paypal.com/webscr&cmd=_express-checkout&token=';
		}
		$this->config['api_username'] 	= $paypal_username;
		$this->config['api_password'] 	= $paypal_password;
		$this->config['api_signature'] 	= $paypal_api_signature;
		$this->config['api_version'] 	= '124.0';
		$this->config['currency_code'] 	= 'USD';
		$this->config['payment_type']	= 'SALE';
		
	}

	public function hash_call($method_name, $nvpstr)
	{
	    $nvp_headers = '&PWD='.urlencode($this->config['api_password']).'&USER='.urlencode($this->config['api_username']).'&SIGNATURE='.urlencode($this->config['api_signature']).'&CURRENCYCODE='.urlencode($this->config['currency_code']).'&PAYMENTACTION='.urlencode($this->config['payment_type']);
		
		//setting the curl parameters.
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->config['api_endpoint']);
		curl_setopt($ch, CURLOPT_VERBOSE, 1);
		
		//turning off the server and peer verification(TrustManager Concept).
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
		curl_setopt($ch, CURLOPT_POST, 1);
		
		$nvpstr = $nvp_headers . '&'.$nvpstr;
		
		//check if version is included in $nvpstr else include the version.
		if(strlen(str_replace('VERSION=', '', strtoupper($nvpstr))) == strlen($nvpstr))
		{
			$nvpstr = '&VERSION=' . urlencode($this->config['api_version']) . $nvpstr;	
		}
		
		$nvpreq = 'METHOD=' . urlencode($method_name) . $nvpstr;
		
		// echo'<pre>';print_r($nvpreq);die('hascall HERE');
		
		//setting the nvpreq as POST FIELD to curl
		curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);

		//getting response from server
		$response = curl_exec($ch);
		
		$response = $this->deformat_nvp($response);
		
		$errno = curl_errno($ch);
		$error = curl_error($ch);
		curl_close($ch);
		
		if ($errno)
		{
			$response = (object)array('error'=>true, 'message'=>'There was an error in your request at PayPal, please try again. - error no. '.$errno.', error .'.$error, 'data'=>false, 'redirect'=>false, );
		}
		elseif(isset($response['ACK']))
		{
			$response = (object)$response;
			
			$response->error 	= false;
			$response->message 	= '';
			$response->data 	= false;
			$response->redirect = '';
		}
		
		return $response;
	}

/** This function will take nvpstring and convert it to an Associative Array and it will decode the response.
  * It is usefull to search for a particular key and displaying arrays.
  */
	function deformat_nvp($nvpstr)
	{
		$intial=0;
		$nvparray = array();
		while(strlen($nvpstr)){
			//postion of Key
			$keypos= strpos($nvpstr,'=');
			//position of value
			$valuepos = strpos($nvpstr,'&') ? strpos($nvpstr,'&'): strlen($nvpstr);
			/*getting the Key and Value values and storing in a Associative Array*/
			$keyval=substr($nvpstr,$intial,$keypos);
			$valval=substr($nvpstr,$keypos+1,$valuepos-$keypos-1);
			//decoding the respose
			$nvparray[urldecode($keyval)] = urldecode($valval);
			$nvpstr=substr($nvpstr,$valuepos+1,strlen($nvpstr));
		}
		return $nvparray;
	}

/** 
  * This function will take token and processing actual payment with token.
  */
  	public function capture_payment($token, $scope = '')
	{
		$nvpstr = '&TOKEN='.$token;
		$method = 'GetExpressCheckoutDetails';
		
		$log_id = $this->save_log($method, $scope, $this->deformat_nvp($nvpstr));
	    $result = $this->hash_call($method, $nvpstr);
	    // echo'<pre>';print_r($log_id);die('HERE');
		
		$order_id = isset($result->CUSTOM) ? $result->CUSTOM : 0;
		$log_id = $this->save_log($method, $scope, $result, $order_id, $log_id);
		
		$ack = strtolower($result->ACK);
		
		if( $ack == 'success' or $ack == 'successwithwarning' )
		{
			$token 		= trim($result->TOKEN);
			$amount 	= trim($result->AMT);
			$payer_id 	= trim($result->PAYERID);
			$ip_address = trim($_SERVER['REMOTE_ADDR']);
			
			$nvpstr = '&TOKEN='.$token.'&PAYERID='.$payer_id.'&AMT='.$amount.'&IPADDRESS='.$ip_address.'&CUSTOM='.$order_id;
			
			$method = 'DoExpressCheckoutPayment';
			$log_id = $this->save_log($method, $scope, $this->deformat_nvp($nvpstr)); 
			
			$result = $this->hash_call($method, $nvpstr);
			$log_id = $this->save_log($method, $scope, $result, $order_id, $log_id);
			
			$result->order_id = $order_id;
			
			$ack = strtolower($result->ACK);
			
			if( $ack != 'success' and $ack != 'successwithwarning' )
			{
				return (object)array('error'=>true, 'message'=>'There was an error in your request at PayPal', 'data'=>$result, 'redirect'=>false, );
			}
			else
			{
				return $result;
			}
		}
		else
		{
			return (object)array('error'=>true, 'message'=>'There was an error in your request at PayPal', 'data'=>false, 'redirect'=>false, );
		}
	}

/** 
  * This function will take NVP string and setting up express checkout call and sending user to paypal url.
  */
  	public function process_payment($nvpstr, $order, $scope = 'return_url')
	{
		$method = 'SetExpressCheckout';
		// echo "create_paypal_payment<pre>";print_r($nvpstr);exit;
		$log_id = $this->save_log($method, $scope, $this->deformat_nvp($nvpstr), $order); 
	    $result = $this->hash_call($method, $nvpstr);
		$log_id = $this->save_log($method, $scope, $result, $order, $log_id);
		// echo'<pre>';print_r($result);die('process HERE');
		if($result->error)
		{
			return $result;
		}
		
		if( strtolower($result->ACK) == 'success')	//$result->ACK == 'Failure'
		{
			$result->redirect = $this->config['api_url'] . trim($result->TOKEN);
		}
		
		
		return $result;
	}

	private function save_log($method = '', $scope = '', $postvars = '', $order = 0, $log_id = false)
	{
		$data['log_id'] = $log_id;
		
		if(!$log_id)
		{
			// print_r($order);die('order');
			$data['url'] 			= $this->config['api_endpoint'];
			$data['method'] 		= $method;
			$data['scope'] 			= $scope;
			if ($order) {
				$data['order_id'] 		= $order->order_id;
			}
			
			$data['request_data'] 	= (is_array($postvars) or is_object($postvars)) ? json_encode($postvars) : $postvars;
			$data['date_added'] 	= date('Y-m-d H:i:s');
		}

		if($log_id)
		{
			$data['response_data'] 	= (is_array($postvars) or is_object($postvars)) ? json_encode($postvars) : $postvars;
			$data['date_modified'] 	= date('Y-m-d H:i:s');
		}
		
		$log_id = $this->add_log($data);

		return $log_id;
	}
	
    private function add_log($data)
    {
		if($data['log_id'])
		{
			$this->CI->db->where('log_id', $data['log_id']);
			$this->CI->db->update('paypal_log', $data);
			$log_id = $data['log_id'];
		}
		else
		{
			$this->CI->db->insert('paypal_log', $data);
			$log_id = $this->CI->db->insert_id();
		}
		
		return $log_id;
	}

    private function save_logOld($data)
    {
        $this->CI->load->model('user/checkout/User_checkout_model');
        $this->CI->User_checkout_model->save_paypal_log($data);
	} 

	public function load_settings($code = '')
    {
        $settings = $this->get_settings($code);
        
        if(!empty($settings)):
            foreach ($settings as $setting_key=>$setting_val)
            {
                $this->CI->site_config->set_item($setting_key, $setting_val);
            }
        endif;
    }

    function get_settings($code='config')
    {
        $this->CI->db->where('code', $code);
        $result = $this->CI->db->get('settings');
        
        $return = array();
        foreach($result->result() as $results)
        {
            $return[$results->key]  = ($results->is_json == 1 ? json_decode($results->value, TRUE) : $results->value);
        }
        
        return $return; 
    }
}
