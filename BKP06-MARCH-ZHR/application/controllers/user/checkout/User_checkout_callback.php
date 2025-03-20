<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_checkout_callback extends User_Public_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'User_checkout_callback';
		$this->controller_dir = 'checkout';
		$this->view_dir = 'checkout';

		$this->load->model('user/custom/User_order_model');
	}

	function success() 
	{
 		// $order_id = $this->user_session->userdata('order_id');
		$order_id = $this->input->get('order_id');
		$customer_id = $this->input->get('customer_id');
		if ($order_id && $customer_id) 
		{
			$order = $this->User_order_model->get_by_id($order_id, $customer_id);
			echo "callback success";pre($order);
			DIE();
			if(!$order)
			{
				$this->user_session->set_flashdata('error', 'There was an error in your request, please try again or contact to the administrator.');
				redirect(site_url('checkout/confirm.html'));
			}

			$this->user_session->unset_userdata('cart');
			$this->user_session->unset_userdata('order_id');
			$this->user_session->unset_userdata('coupon');
			$this->user_session->unset_userdata('checkout');
			
			$this->view($this->user_view .'/'. $this->view_dir .'/order-success');
		}else{
			redirect(site_url('checkout/cart.html'));
		}
	} 

	public function jazzcash_capture_payment_by_return_url()
	{
		if(isset($_REQUEST['ppmpf_1']) && $_REQUEST['pp_ResponseCode'] != '000')
		{
			$this->user_session->set_flashdata('error', 'Ubable to verify the payment detail, once verify payment, your order will be updated.');
			redirect(site_url('checkout/cart.html'));
		}
		// echo'capture';pre($result);
		$order = $this->User_order_model->get_by_id($_REQUEST['ppmpf_1']);
		$order_id = $_REQUEST['ppmpf_1'];
		
		$this->update_order($order);
		$this->cart_lib->send_order_email($order_id,$order->customer_id);
		
		$this->user_session->set_flashdata('message', 'You order has been placed successfuly, we wil contact you shortly.');
		redirect(site_url('guest/order-success.html?order_id='.$order_id.'&customer_id='.$order->customer_id));
	}
	public function capture_payment_by_return_url()
    {
		$this->load->library('Paypal_Express');

		$token = $this->input->get('token');
		$result = $this->paypal_express->capture_payment($token, 'return_url');

		if($result->error)
		{
			$this->user_session->set_flashdata('error', $result->message);
			redirect(site_url('checkout/confirm.html'));
		}

		if($result->PAYMENTSTATUS != 'Completed')
		{
			$this->user_session->set_flashdata('error', 'Ubable to verify the payment detail, once verify payment, your order will be updated.');
			redirect(site_url('checkout/confirm.html'));
		}
		// echo'capture';pre($result);
		$order = $this->User_order_model->get_by_id($result->order_id, $result->customer_id);
		
		$this->update_order($order);
		
		$this->user_session->set_flashdata('message', 'You order has been placed successfuly, we wil contact you shortly.');
		redirect(site_url('checkout/order-success.html?order_id='.$result->order_id.'&customer_id='.$result->customer_id));
	}

	public function capture_payment_by_callback_url()
    {
		$this->load->library('Paypal_Express');

		$token = $this->input->get('token');
		$result = $this->paypal_express->capture_payment($token, 'callback_url');

		if($result->error)
		{
			return FALSE;
		}

		if($result->PAYMENTSTATUS != 'Completed')
		{
			return FALSE;
		}

		$dt = $this->User_order_model->get_by_id($result->order_id);
		if(!$dt)
		{
			return FALSE;
		}
		
		$order = $this->User_order_model->get_by_id($dt->order_id, $dt->customer_id);
		$this->update_order($order);
	}

	private function update_order($order)
	{
		$save['order_id'] = $order->order_id;
		$save['order_status_id'] 	= 1;
		$save['payment_status_id'] 	= 6;
		$save['date_modified'] 		= date('Y-m-d H:i:s');
		
		$this->User_order_model->update($save);
		$coupon['is_used'] = 1;
		$this->User_order_model->order_coupon($order->order_id, $coupon);
		
		$data['result'] = $order;
		
		$this->send_order_email($order);
	}

	private function send_order_email($order)
    {
		if(empty($order->order_id))
		{
			return FALSE;
		}

		$message = $this->load->view($this->user_view.'/emails/email_order_submit', array('order'=>$order), TRUE);
		$subject = site_config_item('config_name').' - Your order number '.$order->order_id;

		$from_email = site_config_item('config_mail_from_email');
		$from_name = site_config_item('config_mail_from_name');
		$to_email = $order->email;
		
		
		//var_dump($to_email, $from_email, $from_name, $subject, $message);die;

		$this->load->library('email');
		$config['mailtype'] = 'html';
		$this->email->initialize($config);

		$this->email->from($from_email, $from_name);
		$this->email->to($to_email);
		$this->email->subject($subject);
		$this->email->message($message);

		$e_1 = @$this->email->send();

		// additional emails
		$additional_emails = site_config_item('config_alert_emails');
		$arr_emails = explode(',', $additional_emails);
		$arr_emails = array_map('trim', $arr_emails);
		//var_dump($arr_emails);die;
		if ($arr_emails) {
			$this->email->to($arr_emails);
			$this->email->subject($subject . ' - ADMIN');
			$this->email->message($message);
			$e_2 = @$this->email->send();
		}
	}

}