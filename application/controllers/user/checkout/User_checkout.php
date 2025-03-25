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
		$checkout = $this->user_session->userdata('checkout');
			$checkout->note = $this->input->post('note');
			$this->user_session->set_userdata('checkout', $checkout);
		$this->is_ready_for_checkout_process();

		$data['address_id']		= false;
		$data['address_menu']	= $this->User_address_model->get_address_menu($this->customer_id);
		
		// var_dump($checkout);die();
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
	public function shipping_method()
	{
		// redirect to cart of checkout process is not ready
		$this->is_ready_for_checkout_process();

		$checkout = (array)$this->user_session->userdata('checkout') ? $this->user_session->userdata('checkout') : array();

        $cart_items = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();



        $tax = $sub_total = $state_id = 0;
       // foreach ($cart_items as $product_id => $item){
        foreach ($cart_items as $item) {
            $product_id =  $item['product_id'];

            //if(!empty($product_id)) {
            $product_info = $this->User_catalog_model->get_product($product_id);

            $product_info->images = get_product_images($product_id);

            if (!empty($product_info->images) && count($product_info->images) > 0) {
                $image = $product_info->images;
            } else {
                $image = base_url($this->site_config->item('config_placeholder_small'));
            }

            if($item['price'] >0){
                $price = $item['price'];
            }else {
                $special_price = get_product_special_price($product_id);
                $price = $special_price > 0 ? $special_price : $product_info->sale_price;
            }



           // $price = $product_info->special_price > 0 ? $product_info->special_price : $product_info->sale_price;

            $item_total_amount = $price * $item['quantity'];

            $item_tax_amount = $this->tax->calculate_tax($item_total_amount, false, $state_id);
            $item_total = $this->tax->calculate_tax($item_total_amount, true, $state_id);

            $products[] = (object)array(
                'product_id' => $product_info->product_id,
                'image' => $image,
                'product_name' => $product_info->product_name,
                'sku' => $product_info->sku,
                'quantity' => $item['quantity'],
                'unite_price' => format_currency(round($price,2)),
                'tax' => format_currency(round($item_tax_amount,2)),
                'total' => round($item_total_amount,2),
            );

            $tax += $item_tax_amount;
            $sub_total += $item_total - $item_tax_amount;
        }
		


		$data = array();
		$data['meta_title']			= 'Shipping Method';
		$data['meta_keywords']		= 'Shipping Method';
		$data['meta_description']	= 'Shipping Method';

		$data['page_title']		= 'Shipping Method';
		$data['page_header']	= 'Shipping Method';

		$shipping_methods = $this->User_setting_model->get_shipping_methods();

		$free_shipping_start_amount = false;
		if(isset($shipping_methods['free']) && $shipping_methods['free']['free_status'] == 1){
		    $free_shipping_start_amount = $shipping_methods['free']['free_total'];
        }

        if($free_shipping_start_amount && ($sub_total >= $free_shipping_start_amount)) {
		    $data['shipping_methods']['free'] = $shipping_methods['free'];
        }else{
		    unset($shipping_methods['free']);
		    foreach ($shipping_methods as $shipping_method_key => $shipping_method){
		    	if($shipping_methods[$shipping_method_key][$shipping_method_key.'_status'] == 1){
					$data['shipping_methods'][$shipping_method_key] = $shipping_method;
				}
			}
            //$data['shipping_methods'] = $shipping_methods;
        }

		$this->current_active_nav = 'checkout-shipping-method';

		$user = (object)$this->user_session->userdata('user');
		if($this->site_config->item('is_short_checkout')){
			if(!isset($data['shipping_methods'])){
				$this->user_session->set_flashdata('error', 'No shipping method is available yet. Please contact with store owner!');
				redirect(site_url('checkout/cart.html'));
			}
			$shipping_methods_keys = array_keys($data['shipping_methods']);
			$result = isset($shipping_methods_keys[0]) ? $shipping_methods_keys[0] :  false;
			if($result){
				$checkout['shipping_method'] = $result;
				$this->user_session->set_userdata('checkout', $checkout);
				redirect(site_url('checkout/payment-method.html'));
			}else{
				$this->user_session->set_flashdata('error', 'No shipping method is available yet. Please contact with store owner!');
				redirect(site_url('checkout/cart.html'));
			}
		}else {
		if($this->input->post()){
			if($this->input->post('shipping-method')) {
				$checkout['shipping_method'] = $this->input->post('shipping-method');
				$this->user_session->set_userdata('checkout', $checkout);
				redirect(site_url('checkout/payment-method.html'));
			}else {
				$this->user_session->set_flashdata('error', 'Shipping method has not been added in to checkout process successfully. Try Again!');
				redirect(site_url('checkout/shipping-method.html'));
			}
		}else{
			$this->view($this->user_view . '/' . $this->view_dir . '/shipping-method', $data);
		}
	}
	}
	
	function billing()
	{
		$data['page_title'] 	= 'Billing Address';
		$data['page_header'] 	= 'Billing Address';
		$checkout = $this->user_session->userdata('checkout');
		// var_dump($checkout);die();
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
	private function find_product($products,$id)
	{
		$products =  json_decode(json_encode($products), FALSE);
		$pro = array();
		foreach($products as $k=> $v)
		{
			if($v->product_id == $id && !$pro)
			{
				$pro = $v;
			}
		}
		
		return $pro;
	}

	function place_order()
	{
		if ($this->disable_checkout) 
		{
			redirect(site_url('checkout/confirm.html'));
		}
		$checkout = $this->user_session->userdata('checkout');
		$cart = $this->user_session->userdata('cart');
		$items = array();
		foreach($cart as $k=> $v)
		{
			$pro = (array)$this->find_product($checkout->items,$v['product_id']);
			
			$dt = $product_info = $this->User_catalog_model->get_product($v['product_id']);
			$product_options = '';
	                $options = $v['options'];

	                if(count($options) > 0) {

	                    foreach ($options as $key => $value) {

	                        if ($key != 'product_option_value_id')
	                            $product_options .= $key . ":" . $value . " ";

	                    }
	                    
	                    if(!empty($product_options)){
	                        $product_name =  $pro['product_name'].' ('.$product_options . ')';
	                    }else{
	                        $product_name =  $pro['product_name'];
	                    }
	                    
	                }else{
	                    $product_name =  $pro['product_name'];

	                }
					$pro['product_name'] = $product_name;
					
					$n	= array_merge($pro, $v);
					
					$n ['total'] = $v['price'] * $v['quantity']; 
					$n ['unit_price'] = $v['price']; 
					$items[] = $n;
			
		if ($n['options']) 
        {
            $curr_qty = get_current_qty($product_info->product_id,$n['sku']);
        }else{
            $curr_qty = get_current_qty($product_info->product_id);
        }
		if(!$curr_qty)
		{
			$this->user_session->set_flashdata('error', $product_info->product_name.' is out of stock');
			redirect(site_url('checkout/cart.html'));
		}
			
		}
		$checkout->items = $items;
		//product_option_value_id
		
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
