<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_checkout extends User_Controller
{
	function __construct()
	{
		parent::__construct();
 
		$this->load->model(array(
			'user/catalog/User_catalog_model',
			'user/common/User_setting_model',
			'user/common/Customer_model',
			'user/custom/User_order_model',
			'user/custom/User_address_model',
			'user/localisation/Location_model',
			'user/checkout/User_checkout_model',
		));

		$this->controller_name = 'user_checkout';
		$this->controller_dir = 'checkout';
		$this->view_dir = 'checkout';
		$this->disable_checkout = site_config_item('config_catalog_disable_checkout');
	}
	
	
	function index()
	{
		redirect(site_url('checkout/billing.html'));
	}
 
	function shipping()
	{
		$data['page_title'] 	= 'Shipping Address';
		$data['page_header'] 	= 'Shipping Address';
		$this->is_ready_for_checkout_process();

		$data['address_id']		= false;
		$data['address_menu']	= $this->User_address_model->get_address_menu($this->customer_id);

		$data['shipping_methods'] = $this->cart_lib->get_shippings();
		if (empty($data['address_menu'])) {
			$data['address_menu'] = array('' => 'Select Shipping Address');
		}
		// echo'<pre>';print_r($data['shipping_methods']);die;
		
		$this->form_validation->set_rules('address_id', 'Address', 'trim|required|callback_is_valid_address');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->view($this->user_view .'/'. $this->view_dir .'/shipping', $data);
		}
		else
		{
			$address_id = $this->input->post('address_id');
            if ($address_id) {
                $method = $this->input->post('shipping-method');
                $address = $address_id;
                // print_r($address);die;
                $this->cart_lib->set_shipping_address($method,$address);
                
                redirect(site_url('checkout/billing.html'));
            }
			
			redirect(site_url('checkout/shipping.html'));
		}
	}
	
	function billing()
	{
		$data['page_title'] 	= 'Billing Address';
		$data['page_header'] 	= 'Billing Address';

		$this->cart_lib->get_shipping_address();

        $default_country_id = $this->Location_model->get_default_country();

        if($default_country_id) {
            $data['regions'] = $this->Location_model->get_zones_menu($default_country_id->country_id);
        }

        $data['country_option'] = $this->cart_lib->get_countries();


        $data['payment_methods'] = $this->cart_lib->get_payment_methods();
       
        // echo'<pre>';print_r($data);die;
		$data['address_id']		= false;
		$data['address_menu']	= $this->User_address_model->get_address_menu($this->customer_id);
		if (empty($data['address_menu'])) {
			$data['address_menu'] = array('' => 'Select Biling Address');
		}
		$this->form_validation->set_rules('address_id', 'Address', 'trim|required|callback_is_valid_address');

		if ($this->form_validation->run() == FALSE) 
		{
			$this->view($this->user_view .'/'. $this->view_dir .'/billing', $data);
		}
		else
		{
			$address_id = $this->input->post('address_id');
            if ($address_id) {
                // $same_shipping_address = $this->input->post('same_shipping_address');
                // if(isset($same_shipping_address) && $same_shipping_address == 1){
                //    $checkout['shipping_address'] = $address_id;
                // }
                $method = $this->input->post('payment-method');
                $address = $address_id;
                $this->cart_lib->set_billing_address($method,$address);

                redirect(site_url('confirm.html'));
            }
		}
	}

	private function is_ready_for_checkout_process()
	{
		if(!$this->is_cart_has_products()){
			$this->user_session->set_flashdata('error', 'Cart is empty!');
			redirect(site_url('checkout/cart.html'));
		}
	}

	public function is_cart_has_products()
    {
		$success_flag = false;
		if($this->user_session->userdata('cart')){
			$cart = $this->user_session->userdata('cart');
			$success_flag = count($cart);
		}
		return $success_flag;
	}
	
	function confirm()
	{
		$this->cart_lib->get_billing_address();
		$this->cart_lib->get_shipping_address();

		//confirm order
        $this->is_ready_for_checkout_process();
        $result = $this->cart_lib->confirm();
        // echo "confirm";pre($this->user_session->userdata('checkout'));

        $data['products'] = $result['products'];
        $data['total'] = $result['totals'];
		
		$this->view($this->user_view .'/'. $this->view_dir .'/confirm-order', $data);
	}

	function place_order()
	{
		if ($this->disable_checkout) 
		{
			redirect(site_url('checkout/confirm.html'));
		}
		$checkout = $this->user_session->userdata('checkout');
		
		if(!$checkout or !isset($checkout->items) or !isset($checkout->totals))
		{
			$this->user_session->set_flashdata('error', 'There is no product is the cart.');
			redirect(site_url('checkout/cart.html'));
		}
		
		$this->cart_lib->get_billing_address();
		// echo'<pre>';print_r($checkout);die;
		
		$order_id = $this->cart_lib->save_order($this->customer_id);
		
		if(!$order_id)
		{
			redirect(site_url('checkout/confirm.html'));
		}
		$this->user_session->set_userdata('order_id', $order_id);
		
		$order = $this->User_order_model->get_by_id($order_id, $this->customer_id);
		
		$this->cart_lib->payment_method($checkout->payment_method,$this->customer_id);
	}
	 
	// function success()
	// {
	// 	$order_id = $this->user_session->userdata('order_id');
		
	// 	$order = $this->User_order_model->get_by_id($order_id, $this->customer_id);
	// 	// echo "<pre>";print_r($order);exit;
	// 	if(!$order)
	// 	{
	// 		$this->user_session->set_flashdata('error', 'There was an error in your request, please try again or contact to the administrator.');
	// 		redirect(site_url('checkout/confirm.html'));
	// 	}
		
	// 	$data['result'] = $order;

	// 	$this->user_session->unset_userdata('cart');
	// 	$this->user_session->unset_userdata('order_id');
	// 	$this->user_session->unset_userdata('checkout');
		
	// 	$this->view($this->user_view .'/'. $this->view_dir .'/order-success', $data);
	// }
	
	// private function update_order($order)
	// {
	// 	if($order->order_status_id == 6)
	// 	{
	// 		return FALSE;
	// 	}
		
	// 	$save['order_id'] = $order->order_id;
	// 	$save['order_status_id'] = 1;
	// 	$save['payment_status_id'] = 6;
	// 	$save['date_modified'] = date('Y-m-d H:i:s');
		
		
	// 	$this->User_order_model->update($save);
		
	// 	$this->send_order_email($order);
	// }

	// private function send_order_email($order)
    // {
	// 	if(empty($order->order_id))
	// 	{
	// 		return FALSE;
	// 	}
		
	// 	$message = $this->load->view($this->user_view.'/emails/email_order_submit', array('order'=>$order), TRUE);
	// 	$subject = site_config_item('config_name').' - Your order number '.$order->order_id;

	// 	$from_email = site_config_item('config_mail_from_email');
	// 	$from_name = site_config_item('config_mail_from_name');
	// 	$to_email = $order->email;
		
		
	// 	//var_dump($to_email, $from_email, $from_name, $subject, $message);die;

	// 	// $this->load->library('email');

	// 	// $this->email->from($from_email, $from_name);
	// 	// $this->email->to($to_email);
	// 	// $this->email->subject($subject);
	// 	// $this->email->message($message);

	// 	// $e_1 = @$this->email->send();

	// 	$headrs  = "MIME-Version: 1.0\n";
    //  	$headrs .="Content-type: text/html; charset=iso-8859-1\n";
    //  	$headrs .= "From:".$from_email;
    //  	mail($to_email, $subject,$message, $headrs);

	// 	// additional emails
	// 	$additional_emails = site_config_item('config_alert_emails');
	// 	$arr_emails = explode(',', $additional_emails);
	// 	$arr_emails = array_map('trim', $arr_emails);
	// 	//var_dump($arr_emails);die;

	// 	// $this->email->to($arr_emails);
	// 	// $this->email->subject($subject . ' - ADMIN');
	// 	// $this->email->message($message);
	// 	// $e_2 = @$this->email->send();

	// 	mail($arr_emails, $subject . ' - ADMIN',$message, $headrs);
	// }
	
	public function is_valid_address()
    {
		$address_id	= $this->input->post('address_id');
		if(!$address_id)
		{
			return TRUE;
		}
		
        $result = $this->User_address_model->get_address($address_id);
        if(!$result)
        {
            $this->form_validation->set_message('is_valid_address', 'Address is not valid.');
            return FALSE;
        }

        return TRUE;
	}
	
}
