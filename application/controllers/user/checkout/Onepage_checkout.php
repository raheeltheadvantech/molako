<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Onepage_checkout extends User_Public_Controller {

	private $shipping_methods = array();
	private $payment_methods = array();
	private $order_data = array();
	private $totals = array();


	function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'user/catalog/User_catalog_model',
			'user/common/User_setting_model',
			'user/common/Customer_model',
			'user/custom/User_address_model',
			'user/localisation/Location_model',
			'user/checkout/User_checkout_model',
		));

		$this->controller_name = 'user_checkout';
		$this->controller_dir = 'checkout';
		$this->view_dir = 'checkout';
		$this->disable_checkout = site_config_item('config_catalog_disable_checkout');
	}



		/*$this->user_session->cart['products'] = array(array(product=>45, qty=>2), array(product=>46, qty=>4);
		//$this->user_session->cart['checkout'] = array('is_billing'=>true, address_id=>4, 'is_payment_method'=>true, 'payment_method'=>'cod');
		//$this->user_session->cart['checkout'] = array('is_shipping'=>true, address_id=>4, 'is_shipping'=>true, 'payment_method'=>'cod');


		$this->user_session->cart['checkout'] = array('billing_address_id=>4, 'shipping_address_id'=>5);
		$this->user_session->cart['checkout'] = array('shipping_method'=>'flat', 'payment_method'=>'cod');*/




	private function set_shipping_methods()
	{
		$this->shipping_methods =  $this->user_settings->get_shipping_methods();
	}

	private function set_payment_methods()
	{
		$this->payment_methods =  $this->user_settings->get_payment_methods();
	}

	/*
	+-----------------------------------------------------------------------+
	|				SHOPPING CART FUNCTIONS STARED FROM HERE				|
	+-----------------------------------------------------------------------+
	*/
	public function cart()
	{

	    $data = array();
		$data['meta_title']			= '';
		$data['meta_keywords']		= '';
		$data['meta_description']	= '';

		$data['page_title']		= 'Shopping Cart';
		$data['page_header']	= 'Shopping Cart';

		$this->current_active_nav = 'cart';

		$cart_items = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();
		
        $checkout = $this->user_session->userdata('checkout');
        $shipping_address_id = isset($checkout['shipping_address']) ? $checkout['shipping_address'] : '';
        $shipping_address = $this->User_address_model->get_address($shipping_address_id);
        $state_id = !empty($shipping_address) ? $shipping_address->region_id : false;

        $coupon = $this->user_session->userdata('coupon');
        $coupon_status = isset($coupon['status']) ? $coupon['status'] : '';
        $coupon_type = isset($coupon['type']) ? $coupon['type'] : '';
        $coupon_value = isset($coupon['value']) ? $coupon['value'] : '';

		
		$products = array();
		$sub_total = $tax = 0;

        if(!empty($cart_items)) {
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

                $item_total_amount = $price * $item['quantity'];

                //$item_discount_total = $this->discount->calculate($item_total_amount, true);

                // I'M NOT SURE TAX WILL BE IMPLEMENTED AT DISCOUNTED AMOUNT OR REAL AMOUNT
                // IF IT IS ON BEFORE DISCOUNT AMOUNT THEN UNCOMMENT BELOW LINE AND COMMENT NEXT AFTER THAT
                //$item_tax_amount = $this->tax->calculate_tax($item_total_amount, false, $state_id);
                $item_tax_amount = $this->tax->calculate_tax($item_total_amount, false, $state_id);

                // I'M NOT SURE TAX WILL BE IMPLEMENTED AT DISCOUNTED AMOUNT OR REAL AMOUNT
                // IF IT IS ON BEFORE DISCOUNT AMOUNT THEN UNCOMMENT BELOW LINE AND COMMENT NEXT AFTER THAT
                //$item_total = $this->tax->calculate_tax($item_total_amount, true, $state_id);
                $item_total = $this->tax->calculate_tax($item_total_amount, true, $state_id);

                $product_options = '';
                $options = $item['options'];

                foreach ($options as $key=>$value){

                    if($key != 'product_option_value_id')
                        $product_options .=$key .":".$value." ";

                }

                $products[] = (object)array(
                    'product_id' => $product_info->product_id,
                    'images' => $image,
                    'product_name' => $product_info->product_name,
                    'product_options' => $product_options,
                    'sku' => $item['sku'],
                    'quantity' => $item['quantity'],
                    'unite_price' => format_currency(round($price, 2)),
                    // 'tax' => format_currency(round($item_tax_amount, 2)),
                    //'discount_total' => format_currency(round($item_discount_total,2)),
                    'total' => format_currency(round($item_total_amount, 2)),
                );

                $tax += $item_tax_amount;
                $sub_total += (int)$item_total - (int)$item_tax_amount;
            }
        }
        $data['products'] = $products;

        $final_total = false;
		$data['sub_total'] = format_currency(round($sub_total,2));
        $final_total = $sub_total;

		// $data['tax'] = format_currency(round($tax,2));
        $final_total += $tax;

//        if($this->site_config->item('config_coupon_code_status')) {
//            $coupon_discount = $coupon_status == 'applied' ? $this->coupon->calculate_discount($sub_total,$coupon_type,$coupon_value) : '';
//            $data['coupon_discount'] = format_currency(round($coupon_discount,2));
//            $final_total -= $coupon_discount;
//        }

//        if($this->is_member() && $this->site_config->item('join_club_discount_status')) {
//            $member_discount = $this->membership->calculate_discount($sub_total);
//            $data['membership_discount'] = format_currency(round($member_discount, 2));
//            $final_total -= $member_discount;
//        }

		$data['total_price'] = format_currency(round($final_total,2));
		
		$this->view($this->user_view .'/'. $this->view_dir .'/cart', $data);
	}

	public function add_to_cart()
	{

		$json = array('result' => false);
		if($this->input->post()){

            if ($this->input->post('product_id')) {
                $product_id = (int)$this->input->post('product_id');
            } else {
                $product_id = 0;
            }

            $quantity = $this->input->post('quantity');

            if ($this->input->post('product_cur_qty')) {
                $product_cur_qty = (int)$this->input->post('product_cur_qty');
            } else {
                $curr_qty = get_current_qty($this->input->post('product_id'));
                if($curr_qty > 0 ){
                    $product_cur_qty = $curr_qty;
                }else{
                    $product_cur_qty = 0;
                }
            }

            if($quantity > $product_cur_qty){

                $product_info = $this->User_catalog_model->get_product($product_id);
                $redirect_url = href_product($product_info);

                $json['message'] = 'Product quantity greater then product available quantity';
                $this->user_session->set_flashdata('error', $json['message']);
                $json['result'] = 'error';

                $json['redirect'] = $redirect_url;
                header('Content-Type: application/json');
                return $this->output->set_output(json_encode($json));
            }


		    if($this->input->post('is_variation')  == 1 && $this->input->post('redirect') ==1 ){

                $product_info = $this->User_catalog_model->get_product($product_id);
                $redirect_url = href_product($product_info);

                $json['redirect'] = $redirect_url;
                header('Content-Type: application/json');
                return $this->output->set_output(json_encode($json));
            }

            $product_option_value_id = '';
            $product_option_price = '';
            $product_option_sku = '';
            if ($this->input->post('options')) {
                $options = $this->input->post('options');
                $product_option_value_id = $options['product_option_value_id'];

                $product_option_price = $this->User_catalog_model->get_column_value('product_option_value' ,'product_option_value_id' ,$product_option_value_id , 'price' );
                $product_option_price = isset($product_option_price->price) ? $product_option_price->price : 0;

                $product_option_sku = $this->User_catalog_model->get_column_value('product_option_value' ,'product_option_value_id' ,$product_option_value_id , 'sku' );
                $product_option_sku = isset($product_option_sku->sku) ? $product_option_sku->sku : 0;


            } else {
                $options = array();
            }

		    $cart = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();
		    $cart_flag = false;

//		    if(isset($cart[$product_id])){
//		    	$quantity = $cart[$product_id]['quantity'] + $quantity;
//		    	$cart_flag = 'update';
//			}else{
		    	$cart_flag = 'add';
			//}

		    //CHECKING IF PRODUCT PRICE IS EQUAL TO 9999.99 THEN WILL NOT ADD TO CART
			$product_info = $this->User_catalog_model->get_product($product_id);

//			echo '<pre>';
//			print_r($product_info);
//			die();

            if($product_option_value_id != '' && $product_option_price > 0){
                $product_info->price = $product_option_price;
            }

            if($product_option_value_id != '' && $product_option_sku != ''){
                $product_info->sku = $product_option_sku;
            }

			// ADDING OR UPDATING THE QUANTITY IN CART
		    $cart[$product_info->sku] = array(
				'product_id'	=> $product_id,
				'quantity'		=> $quantity,
                'price'		=> $product_info->price,
                'options'	=> $options,
                'available_qty'		=> $product_cur_qty,
                'sku' => isset($product_info->sku) ? $product_info->sku : 0
			);

		    $this->user_session->set_userdata('cart', $cart);

//          echo '<pre>';
//		    print_r($cart);
//		    die();

			if($cart_flag == 'update'){
				$json['message'] = 'Product quantity updated in your <a href="'. site_url('checkout/cart.html') .'">shopping cart</a> successfully';
                $this->user_session->set_flashdata('message', $json['message']);
			}else{
				$json['message'] = 'Product added to your <a href="'. site_url('checkout/cart.html') .'">shopping cart</a> successfully';
				$this->user_session->set_flashdata('message', $json['message']);
				
			}

			$json['result'] = true;
			$json['redirect'] = $this->input->server('HTTP_REFERER');

		
		}
		
		header('Content-Type: application/json');
		return $this->output->set_output(json_encode($json));
	}

	public function update_cart()
	{
		$json = array('result' => false);
		if($this->input->post()){
		    $product_sku = $this->input->post('key');
		    $quantity = $this->input->post('quantity');

		    $cart = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();

//		    echo '<pre>';
//		    print_r($cart);
//		    die();

		    if($quantity > $cart[$product_sku]['available_qty'])
            {
                $json['message'] = 'Product quantity has not been updated in your <a href="' . site_url('checkout/cart.html') . '">shopping cart</a> successfully';
                $this->user_session->set_flashdata('error', $json['message']);
                $json['result'] = 'error';
            }else{
                // ADDING OR UPDATING THE QUANTITY IN CART
                if (!empty($product_sku)) {
                    $cart[$product_sku] = array(
                        'product_id' => $cart[$product_sku]['product_id'],
                        'quantity' => $quantity,
                        'price' => $cart[$product_sku]['price'],
                        'options' => $cart[$product_sku]['options'],
                        'available_qty' => $cart[$product_sku]['available_qty'],
                        'sku' => $cart[$product_sku]['sku']
                    );

                    $this->user_session->set_userdata('cart', $cart);
                    $json['message'] = 'Product quantity updated in your <a href="' . site_url('checkout/cart.html') . '">shopping cart</a> successfully';
                    $json['result'] = true;
                    $this->user_session->set_flashdata('message', $json['message']);

                } else {
                    $json['message'] = 'Product quantity has not been updated in your <a href="' . site_url('checkout/cart.html') . '">shopping cart</a> successfully';
                    $this->user_session->set_flashdata('error', $json['message']);
                    $json['result'] = 'error';
                }
            }

			$json['redirect'] = $this->input->server('HTTP_REFERER');
		}

		header('Content-Type: application/json');
		return $this->output->set_output(json_encode($json));
	}

	public function remove_cart()
	{
		$json = array('result' => false);
		if($this->input->post()){
		    $sku = $this->input->post('key');
		    $cart = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();

			// UNSET ITEM FROM CART
		    if(isset($cart[$sku])){
		    	unset($cart[$sku]);
			}
		    
		    $this->user_session->set_userdata('cart', $cart);
			$json['message'] = 'Product has been removed from your <a href="'. site_url('checkout/cart.html') .'">shopping cart</a> successfully';
			$this->user_session->set_flashdata('message', $json['message']);

			$json['result'] = true;
			$json['redirect'] = $this->input->server('HTTP_REFERER');
		}

		header('Content-Type: application/json');
		return $this->output->set_output(json_encode($json));
	}


    function get_variant_details(){

        $json = array();
        $variant_id = '';
        $variant_price = 0.00;
        $variant_qty = 0;

        $json['success']  = false;
        $json['variant_id'] = $variant_id;
        $json['variant_price'] = $variant_price;
        $json['variant_qty'] = 0;


        $product_id = $this->input->post('product_id');
        $variations = $this->input->post('variations');
        $variants_resp = $this->User_catalog_model->get_product_variants_detail($product_id,$variations);

       // echo '<pre>';
       // print_r($variants_resp);
       // die();

        if(isset($variants_resp)){
            if($variants_resp['variant_id'] != '')
            {

                $variant_price =  $variants_resp['variant_price'];
                $json['success']  = true;
                $json['variant_id'] =  $variants_resp['variant_id'];
                $json['variant_price'] = format_currency(round($variant_price,2));
                $json['variant_price_to_show'] = format_currency(round($variant_price,2));
                $json['variant_qty'] =  $variants_resp['variant_qty'];
               // $json['variant_image'] = $variants->data->variant_image;
            }
        }

//        $variants = json_decode($variants_resp);
//
//        if(isset($variants->data)){
//            if($variants->data->variant_id != '')
//            {
//                format_currency(round($price,2))
//                $variant_price = $variants->data->variant_price;
//                $json['success']  = true;
//                $json['variant_id'] = $variants->data->variant_id;
//                $json['variant_price'] = dc_format($variant_price, $this->data['store']->currency_icon);
//                $json['variant_price_to_show'] = dc_format($variant_price, $this->data['store']->currency_icon);
//                $json['variant_qty'] = $variants->data->variant_qty;
//                $json['variant_image'] = $variants->data->variant_image;
//            }
//        }

        echo json_encode($json);
    }



	/*
	+-----------------------------------------------------------------------+
	|					SHOPPING CART FUNCTIONS ENDS TO HERE				|
	+-----------------------------------------------------------------------+
	*/

	/*
	+-----------------------------------------------------------------------+
	|					CHECKOUT FUNCTIONS STARED FROM HERE					|
	+-----------------------------------------------------------------------+
	*/
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
			$ret = array('red'=>site_url('checkout/confirm.html'),'error'=>1,'msg'=>'You can not place order , Checkout is disabled by admin');
			echo json_encode($ret);
			exit();
			
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
	                        $product_name =  $pro['product_name'];
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
        $config_catalog_purchase = $this->db->where('key','config_catalog_purchase')->get('ci_settings')->row();
        if($config_catalog_purchase)
        {
            $config_catalog_purchase = $config_catalog_purchase->value;
        }
        else
        {
            $config_catalog_purchase = 0;
        }
        if(!$config_catalog_purchase)
        {
    		if($curr_qty < $v['quantity'])
    		{
    			$this->user_session->set_flashdata('error', $product_info->product_name.' is out of stock');
    			redirect(site_url('checkout/cart.html'));
    		}
        }
			
		}
		$checkout->items = $items;
		//product_option_value_id
		
		if(!$checkout or !isset($checkout->items) or !isset($checkout->totals))
		{
			$this->user_session->set_flashdata('error', 'There is no product is the cart.');
			redirect(site_url('checkout/cart.html'));
		}
		//echo'<pre>';print_r($checkout);die;
		
		$order_id = $this->cart_lib->save_order($this->customer_id);
		
		
		if(!$order_id)
		{
			$ret = array('red'=>site_url('checkout/confirm.html'),'error'=>1,'msg'=>'Server error!');
			echo json_encode($ret);
			exit();
		}
		$this->user_session->set_userdata('order_id', $order_id);
		
		$order = $this->User_order_model->get_by_id($order_id, $this->customer_id);

		
		$this->cart_lib->payment_method($checkout->payment_method,$this->customer_id);
        exit();

	}
    function place_order_ajax()
    {
        if ($this->disable_checkout) 
        {
            ajax_response(array('error'=>true,'msg'=> 'Checkout is disabled'));
            exit();
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
                    
                    $n  = array_merge($pro, $v);
                    
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
            ajax_response(array('error'=>true,'msg'=> $product_info->product_name.' is out of stock'));
            exit();
        }
            
        }
        $checkout->items = $items;
        //product_option_value_id
        
        if(!$checkout or !isset($checkout->items) or !isset($checkout->totals))
        {
            ajax_response(array('error'=>true,'msg'=> 'There is no product is the cart.'));
            exit();
        }
        //echo'<pre>';print_r($checkout);die;
        
        $order_id = $this->cart_lib->save_order($this->customer_id);
        
        if(!$order_id)
        {
            ajax_response(array('error'=>true,'msg'=> 'Order creation issue'));
            exit();
        }
        $this->user_session->set_userdata('order_id', $order_id);
        
        $order = $this->User_order_model->get_by_id($order_id, $this->customer_id);

        
        $this->cart_lib->payment_method($checkout->payment_method,$this->customer_id);
        

    }

    public function ajax_checkout()
    {
        is_ajax();


        $data['region_id']          = '';
        $data['note']           = '';
        $data['first_name']           = '';
        $data['last_name']           = '';
        $data['phone']           = '';
        $data['address_1']           = '';
        $data['region_name']           = '';
        $data['city']           = '';

        $this->load->library('form_validation');

        $this->form_validation->set_rules('first_name','First Name','trim|required|max_length[30]');
        $this->form_validation->set_rules('last_name','last Name','trim|required|max_length[30]');
        $this->form_validation->set_rules('address_1','Address', 'trim|required' );
        $this->form_validation->set_rules('region_name','Province', 'trim|required' );
        $this->form_validation->set_rules('city','City', 'trim|required' );
        $this->form_validation->set_rules('email', 'Email', 'valid_email');

        $this->form_validation->set_rules(
    'phone', 
    'Phone', 
    'required|regex_match[/^03[0-9]{2}-?[0-9]{7}$/]', 
    array('regex_match' => 'The %s field must be in the correct format, like 03XX-XXXXXXX or 03XXXXXXXXX')
);
        $this->form_validation->set_rules('payment-method','Payment Method','trim|required');



        if ($this->form_validation->run() == FALSE)
        {
            $html = $this->load->view($this->user_view .'/'. $this->view_dir .'/checkout_form', $data, true);
            ajax_response(array('error'=>true,'html'=> $html));
        }
        else
        {
            $this->checkout();
            exit();
            $first_name =$this->security->xss_clean($this->input->post('first_name'));
            $last_name =$this->security->xss_clean($this->input->post('last_name'));
            $phone = $this->security->xss_clean($this->input->post('phone'));
            $email= strtolower($this->security->xss_clean($this->input->post('email')));
            $address_1 = $this->security->xss_clean($this->input->post('address_1'));
            $city = $this->security->xss_clean($this->input->post('city'));
            $region_name = $this->security->xss_clean($this->input->post('region_name'));
            $result = $this->cart_lib->confirm();
            $checkout = $this->user_session->userdata('checkout');
            $checkout->note = $this->input->post('note');
            
            $address = array(
            'first_name'=> $first_name,
            'last_name'=> $last_name,
            'address_1'=> $address_1,
            'city'=> $city,
            'region_name'=> $region_name,
            'email'=> $email,
            'phone'=> $phone,
            );
            $checkout->payment_method = $this->input->post('payment-method');
            $checkout->address = $address;
            $checkout->telephone = $phone;
            $checkout->onepage = 1;
            $this->user_session->set_userdata('checkout', $checkout);
            // echo "confirm";pre($this->user_session->userdata('checkout'));

        $data['products'] = $result['products'];
        $data['total'] = $result['totals'];
        $this->place_order_ajax();

        }
    }
    public function checkout()
    {
        $jazzcash = $this->User_checkout_model->get_jazzcash_detail();
        $jz = array();
        foreach($jazzcash as $k=> $v)
        {
            $jz[$v->key] = $v->value;
        }
		$checkout = $this->user_session->userdata('checkout');
        $cart = $this->user_session->userdata('cart');
		if ($this->disable_checkout) 
		{
			redirect(site_url('checkout/cart.html'));
		}
        $data['payment_methods'] = $this->cart_lib->get_payment_methods();
        $data['shipping_methods'] = $smthods =  $this->cart_lib->get_shippings();
        // dd($data['shipping_methods']);
		$checkout->note = $this->input->post('note');
            $this->user_session->set_userdata('checkout', $checkout);
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
        $config_catalog_purchase = $this->db->where('key','config_catalog_purchase')->get('ci_settings')->row();
        if($config_catalog_purchase)
        {
            $config_catalog_purchase = $config_catalog_purchase->value;
        }
        else
        {
            $config_catalog_purchase = 0;
        }
        if(!$config_catalog_purchase)
        {
    		if($curr_qty < $n['quantity'])
    		{
    			$this->user_session->set_flashdata('error', $product_info->product_name.' ordered quanity did not available');
    			redirect(site_url('checkout/cart.html'));
    		}
        }
			
		}
		$checkout->items = $items;
		//product_option_value_id
		
		if(!$checkout or !isset($checkout->items) or !isset($checkout->totals))
		{
			$this->user_session->set_flashdata('error', 'There is no product is the cart.');
			redirect(site_url('checkout/cart.html'));
		}
        $data['region_id']          = '';
        $data['note']           = '';
        $data['first_name']           = '';
        $data['last_name']           = '';
        $data['phone']           = '';
        $data['address_1']           = '';
        $data['region_name']           = '';
        $data['city']           = '';
        $data['jazzcash'] = $jz;
        // var_dump($_REQUEST);
        // die();
        // $this->load->library('Auth_user');
        if( $this->auth_user->is_logged_in())
        {
             $user = (object)$this->user_session->userdata('user');
             $end_user_info = $this->Customer_model->get_by_id($user->customer_id);
             $data['address_menu']  = $this->User_address_model->get_address_menu($this->customer_id);
             $data['phone'] = $end_user_info->phone;
             $data['email'] = $end_user_info->email;
             $data['user']  = $end_user_info;
             $data['user']  = $end_user_info;
        }

		$default_country_id = $this->Location_model->get_default_country();

        if($default_country_id) {
            $data['regions'] = $this->Location_model->get_zones_menu($default_country_id->country_id);
        }
		$data['address_slug']  ='guest';

        $data['country_option'] = $this->cart_lib->get_countries();


        $data['payment_methods'] = $this->cart_lib->get_payment_methods();
        //guest/checkout.html

        // redirect to cart of checkout process is not ready
        $this->is_ready_for_checkout_process();
        $data['meta_title']			= '';
        $data['meta_keywords']		= '';
        $data['meta_description']	= '';


        $data['page_title']		= 'Billing Address';
        $data['page_header']	= 'Billing Address';
        $this->current_active_nav = 'checkout-billing-address';
        $cart       = $this->user_session->userdata('cart');
        $checkout   = (object)$this->user_session->userdata('checkout');
        $coupon     = (object)$this->user_session->userdata('coupon')? $this->user_session->userdata('coupon') : array();
        // var_dump($cart);die;
        $data['meta_title']         = 'Checkout';       $data['meta_keywords']      = 'Checkout';       $data['meta_description']   = 'Checkout';               $data['page_title']     = 'Cart';       $data['page_header']    = 'Cart';       $data['title']          = 'Checkout';
        $data['result'] = false;
        $data['totals'] = false;

        $products       = array();
        $grand_total    = 0;
        $sub_total      = 0;
        $total_tax      =0;
        $discount       =0;
        $ttax       = 0;
        
        if(!isset($cart->error))
        {
            $r = array();
            // echo'<pre>';print_r($cart);die;
            if (isset($cart)) {
                foreach($cart as $k=>$v)
                {
                    $dt = $this->User_catalog_model->get_product($v['product_id']);
                    // echo'<pre>';print_r($dt);die;
                    if(isset($v['product_option_value_img']) && $v['product_option_value_img'])
                    {

                        $image = live_img_url().'/images/products/medium/'.$v['product_option_value_img'];
                    }
                    elseif (!empty($dt->images) && count($dt->images) > 0) {
                        $image = base_url('images/products/medium/'.$dt->images[0]);
                    } else {
                        $image = base_url($this->site_config->item('config_placeholder_small'));
                    }
                    
                    $item_total = $v['price'] * $v['quantity'];
                    if($dt->special_price):
                        $dt->unit_price             = $dt->special_price;
                    else:
                        $dt->unit_price             = $dt->sale_price;
                    endif;
                    $dt->quantity               = $v['quantity'];
                    $dt->total                  = $dt->unit_price * $dt->quantity;
                    $dt->short_description      = '';
                    $dt->long_description       = '';
                    $dt->content_description    = '';
                    $dt->assignment_description = '';

                    $product_options = '';
                    $options = $v['options'];

                    if(count($options) > 0) {

                        foreach ($options as $key => $value) {

                            if ($key != 'product_option_value_id')
                                $product_options .= $key . ":" . $value . " ";

                        }
                        
                        if(!empty($product_options)){
                            $product_name =  $dt->product_name .' ('.$product_options . ')';
                        }else{
                            $product_name =  $dt->product_name;
                        }
                        
                    }else{
                        $product_name =  $dt->product_name;

                    }

                    $products[] = (object)array(
                        'product_id' => $dt->product_id,
                        'product_slug' => $dt->product_slug,
                        'product_option_value_id' => $v['product_option_value_id'],
                        'images' => $image,
                        'product_name' => !empty($product_name) ? $product_name : '',
                        'product_options' => $product_options,
                        'sku' => $v['sku'],
                        'quantity' => $v['quantity'],
                        'cut_price' => $v['cut_price'],
                        'unite_price' => round($v['price'], 2),
                        'unite_price_simple' => round($v['price'], 2),
                        'total' => format_currency(round($item_total, 2)),
                    );
                    
                    $r[] = $dt;

                    $sub_total += $item_total;
                }
            }
            
            $data['products'] = $products;
            $data['result'] = $r; 
            
            // $this->set_totals($data);
        }
        // print_r($checkout);die;
        if(isset($checkout->total_tax))
        {
            $total_tax = $checkout->total_tax;
            $ttax = $checkout->ttax;
        }
        if ($coupon) 
        {
            if ($coupon['type'] == 'percent') 
            {
                $discount = ($sub_total/100)*$coupon['value'];
            }else{
                $discount = $coupon['value'];
            }
        }
        $grand_total = $sub_total+ $total_tax;

        $subTotal_order = $this->User_setting_model->get_setting('sub_total');
        $shipp_order = $this->User_setting_model->get_setting('shipping');
        // dd($this->db->last_query());
        $tax_order = $this->User_setting_model->get_setting('tax');
        $discount_order = $this->User_setting_model->get_setting('discount');
        $total_order = $this->User_setting_model->get_setting('total');
        $grand_total = $sub_total - abs($discount);

        $data['totals']['sub_total']    = (object)array('code'=>'sub_total', 'title'=>'Sub Total', 'value'=>$sub_total, 'sort_order'=> $subTotal_order->value, );
        $ship= 0;
        if($this->input->post('shipping-method'))
        {
            $method = $this->input->post('shipping-method');
            // dd($smthods);
            $dt = $smthods[$method];
            if($method == 'free')
            {
                if(isset($dt['total']) && $grand_total <= $dt['total'])
                {
                 $ship= $dt['cost'];   
                }
            }
            elseif($method == 'item')
            {
                $ship = $dt['cost'] * count($cart);
            }
        }
        $grand_total = $grand_total + $ship;

        //$data['totals']['tax']          = (object)array('code'=>'tax', 'title'=>'Tax', 'value'=>0, 'sort_order'=>$tax_order->value, );
        $data['totals']['discount']     = (object)array('code'=>'discount', 'title'=>'Discount', 'value'=>$discount, 'sort_order'=>$discount_order->value);
        if($ship)
        {
            $data['totals']['shipping'] = (object)array('code'=>'shipping', 'title'=>'Shipping', 'value'=>$ship );
        }
        $data['totals']['total']        = (object)array('code'=>'total', 'title'=>'Total', 'value'=>$grand_total, 'sort_order'=>$total_order->value, );
        $data['products']       = $products;
        $data['ttax']           = $ttax;
        $data['discount']       = format_currency(round($discount,2));
        $data['total_tax']      = $total_tax;
        $data['sub_total']      = format_currency(round($sub_total,2));
        $data['grand_total']        = format_currency(round($grand_total,2));
        $data['total_price']    = format_currency(round(($grand_total+$discount),2));
        // dd($data['totals']);

		$this->load->library('form_validation');

        $this->form_validation->set_rules('first_name','First Name','trim|required|max_length[30]');
        $this->form_validation->set_rules('last_name','last Name','trim|required|max_length[30]');
        $this->form_validation->set_rules('address_1','Address', 'trim|required' );
        $this->form_validation->set_rules('region_name','Province', 'trim|required' );
        $this->form_validation->set_rules('city','City', 'trim|required' );
		$this->form_validation->set_rules(
    'phone', 
    'Phone', 
    'required|regex_match[/^03[0-9]{2}-?[0-9]{7}$/]', 
    array('regex_match' => 'The %s field must be in the correct format, like 03XX-XXXXXXX or 03XXXXXXXXX')
);
		$this->form_validation->set_rules('payment-method','Payment Method','trim|required');
        $this->form_validation->set_rules('shipping-method','Shipping Method','trim|required');

        if($this->form_validation->run() == FALSE)
        {
            $this->user_session->set_flashdata('error', validation_errors());
            $this->view($this->user_view .'/'. $this->view_dir .'/checkout', $data);
        }
        else
        {
            // pre($_POST);
            $first_name =$this->security->xss_clean($this->input->post('first_name'));
            $last_name =$this->security->xss_clean($this->input->post('last_name'));
            $phone = $this->security->xss_clean($this->input->post('phone'));
            $email= strtolower($this->security->xss_clean($this->input->post('email')));
            $address_1 = $this->security->xss_clean($this->input->post('address_1'));
            $city = $this->security->xss_clean($this->input->post('city'));
            $region_name = $this->security->xss_clean($this->input->post('region_name'));
			$result = $this->cart_lib->confirm();
			$checkout = $this->user_session->userdata('checkout');
			$checkout->note = $this->input->post('note');
            
			$address = array(
			'first_name'=> $first_name,
			'last_name'=> $last_name,
			'address_1'=> $address_1,
            'city'=> $city,
            'region_name'=> $region_name,
			'email'=> $email,
			'phone'=> $phone,
			);
            if($ship)
			$checkout->shipping_method = $this->input->post('shipping-method');
            $checkout->payment_method = $this->input->post('payment-method');
			$checkout->address = $address;
			$checkout->telephone = $phone;
			$checkout->onepage = 1; 
            $checkout->totals = $data['totals']; 
			$this->user_session->set_userdata('checkout', $checkout);
			// echo "confirm";pre($this->user_session->userdata('checkout'));

        $data['products'] = $result['products'];
        $data['total'] = $result['totals'];
		$this->place_order();
		
		//$this->view($this->user_view .'/'. $this->view_dir .'/confirm-order', $data);
			
			

            

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




	public function billing_address()
	{
		// redirect to cart of checkout process is not ready
		$this->is_ready_for_checkout_process();

		$this->user_session->unset_userdata('checkout');
		$checkout = array();

		$data = array();
		$data['meta_title']			= '';
		$data['meta_keywords']		= '';
		$data['meta_description']	= '';

		$data['page_title']		= 'Billing Address';
		$data['page_header']	= 'Billing Address';
		$this->current_active_nav = 'checkout-billing-address';

		$user = (object)$this->user_session->userdata('user');

        if($this->site_config->item('is_short_checkout')){
			$result = $this->User_address_model->get_default_address($user->customer_id);
			if($result){
				$checkout['billing_address'] = $result->address_id;
				$this->user_session->set_userdata('checkout', $checkout);
				redirect(site_url('checkout/shipping-address.html'));
			}else{
				$this->user_session->set_flashdata('error', 'Checkout process required your default address. Please add a default address and try checkout again!');
				redirect(site_url('secure/address-book.html'));
			}
		}


		$results = $this->User_address_model->get_addresses($user->customer_id);
		$addresses = array();
		foreach ($results as $address){
			$address_id = $address->address_id;
			unset($address->address_id);
			unset($address->customer_id);
			unset($address->country_id);
			unset($address->region_id);
			$addresses[$address_id] =  implode(', ', json_decode(json_encode($address),true));
		}


		$data['addresses'] = $addresses;

		$countries = $this->Location_model->get_countries(false);
		$countries_options  = array();

		foreach ($countries as $country){
			$countries_options[$country->country_id] = $country->name;
		}

		$data['country_option'] = $countries_options;

		$data['first_name']			= $this->input->post('first_name') ? $this->input->post('first_name') :'';
		$data['last_name']			= $this->input->post('last_name') ? $this->input->post('last_name') :'';
		$data['company']			= $this->input->post('company') ? $this->input->post('company') :'';
		$data['address_1']			= $this->input->post('address_1') ? $this->input->post('address_1') :'';
		$data['address_2']			= $this->input->post('address_2') ? $this->input->post('address_2') :'';
		$data['city']				= $this->input->post('city') ? $this->input->post('city') :'';
		$data['postcode']			= $this->input->post('postcode') ? $this->input->post('postcode') :'';
		$data['country_id']			= $this->input->post('country_id') ? $this->input->post('country_id') : $this->Location_model->get_countries()->country_id;
		$data['region_id']			= $this->input->post('region_id') ? $this->input->post('region_id') :'';
		$data['billing_address']	= $this->input->post('billing_address') ? $this->input->post('billing_address') : false;

		if($this->input->post('billing_address') && $this->input->post('billing_address') == 'new') {
			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('country_id', 'Country', 'trim|required');
			$this->form_validation->set_rules('region_id', 'Region', 'trim|required');

			if ($this->form_validation->run() == FALSE)
			{
				//$this->view($this->user_view .'/'. $this->view_dir .'/edit-billing-address', $data);
				$this->view($this->user_view .'/'. $this->view_dir .'/billing-address', $data);

			}
			else
			{
				$address_input = array(
					'first_name' => $this->input->post('first_name'),
					'last_name' => $this->input->post('last_name'),
					'company' => $this->input->post('company'),
					'address_1' => $this->input->post('address_1'),
					'address_2' => $this->input->post('address_2'),
					'city' => $this->input->post('city'),
					'postcode' => $this->input->post('postcode'),
					'country_id' => $this->input->post('country_id'),
					'region_id' => $this->input->post('region_id'),
					'customer_id' => $user->customer_id,
				);
				$address_id = $this->User_address_model->save_address($address_input);
			}
		}else{
			$address_id = $this->input->post('address_id');
		}

		if($this->input->post()) {
			if ($address_id) {
				$checkout['billing_address'] = $address_id;
				$this->user_session->set_userdata('checkout', $checkout);
				redirect(site_url('checkout/shipping-address.html'));
			} else {
				$this->user_session->set_flashdata('error', 'Billing address has not been added in to checkout process successfully. Try Again!');
				redirect(site_url('checkout/billing-address.html'));
			}
		}else{
			$this->view($this->user_view .'/'. $this->view_dir .'/billing-address', $data);
		}
	}

	public function success()
    {
        $order_id = $this->input->get('order_id');
        $customer_id = $this->input->get('customer_id');
        if ($order_id) 
        {
            $this->load->model('user/custom/User_order_model');
            $order = $this->User_order_model->get_by_id($order_id, $customer_id);
            if(!$order)
            {
                $this->user_session->set_flashdata('error', 'There was an error in your request, please try again or contact to the administrator.');
                redirect(site_url('/'));
            }

            $this->user_session->unset_userdata('cart');
            $this->user_session->unset_userdata('order_id');
            $this->user_session->unset_userdata('coupon');
            $this->user_session->unset_userdata('checkout');
            $data = array();
            $data['customer_id'] = $customer_id;
            
            $this->view($this->user_view .'/'. $this->view_dir .'/order-success', $data);
        }else{
            redirect(site_url('checkout/cart.html'));
        }
    }
    public function shipping_address()
	{
		// redirect to cart of checkout process is not ready
		$this->is_ready_for_checkout_process();

		$checkout = $this->user_session->userdata('checkout') ? $this->user_session->userdata('checkout') : array();
		if(isset($checkout['shipping_address'])){
			unset($checkout['shipping_address']);
		}
		if(isset($checkout['shipping_method'])){
			unset($checkout['shipping_method']);
		}
		if(isset($checkout['payment_method'])){
			unset($checkout['payment_method']);
		}

		$data = array();
		$data['meta_title']			= 'Shipping Address';
		$data['meta_keywords']		= 'Shipping Address';
		$data['meta_description']	= 'Shipping Address';

		$data['page_title']		= 'Shipping Address';
		$data['page_header']	= 'Shipping Address';

		$this->current_active_nav = 'checkout-shipping-address';

		$user = (object)$this->user_session->userdata('user');

		if($this->site_config->item('is_short_checkout')){
			$result = $this->User_address_model->get_default_address($user->customer_id);
			if($result){
				$checkout['shipping_address'] = $result->address_id;
				$this->user_session->set_userdata('checkout', $checkout);
				redirect(site_url('checkout/shipping-method.html'));
			}else{
				$this->user_session->set_flashdata('error', 'Checkout process required your default address. Please add a default address and try checkout again!');
				redirect(site_url('secure/address-book.html'));
			}
		}

		$results = $this->User_address_model->get_addresses($user->customer_id);
		$addresses = array();
		foreach ($results as $address){
			$address_id = $address->address_id;
			unset($address->address_id);
			unset($address->customer_id);
			unset($address->country_id);
			unset($address->region_id);
			$addresses[$address_id] =  implode(', ', json_decode(json_encode($address),true));
		}

		$data['addresses'] = $addresses;
		$countries = $this->Location_model->get_countries(false);
		$countries_options  = array();

		foreach ($countries as $country){
			$countries_options[$country->country_id] = $country->name;
		}

		$data['country_option'] = $countries_options;


		$data['first_name']			= $this->input->post('first_name') ? $this->input->post('first_name') :'';
		$data['last_name']			= $this->input->post('last_name') ? $this->input->post('last_name') :'';
		$data['company']			= $this->input->post('company') ? $this->input->post('company') :'';
		$data['address_1']			= $this->input->post('address_1') ? $this->input->post('address_1') :'';
		$data['address_2']			= $this->input->post('address_2') ? $this->input->post('address_2') :'';
		$data['city']				= $this->input->post('city') ? $this->input->post('city') :'';
		$data['postcode']			= $this->input->post('postcode') ? $this->input->post('postcode') :'';
		$data['country_id']			= $this->input->post('country_id') ? $this->input->post('country_id') : $this->Location_model->get_countries()->country_id;
		$data['region_id']			= $this->input->post('region_id') ? $this->input->post('region_id') :'';
		$data['billing_address']	= $this->input->post('billing_address') ? $this->input->post('billing_address') : false;


		/*echo "<pre>";
		print_r($this->input->post());
		echo "</pre>";
		exit();*/

		if($this->input->post('shipping-address') && ($this->input->post('shipping-address') == 'new')) {

			$this->form_validation->set_rules('first_name', 'First Name', 'trim|required');
			$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required');
			$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('country_id', 'Country', 'trim|required');
			$this->form_validation->set_rules('region_id', 'Region', 'trim|required');


			if ($this->form_validation->run() == FALSE) {
				$this->view($this->user_view . '/' . $this->view_dir . '/shipping-address', $data);
			} else {

				if ($this->input->post('shipping_address') && $this->input->post('shipping_address') == 'new') {
					$address_input = array(
						'first_name' => $this->input->post('first_name'),
						'last_name' => $this->input->post('last_name'),
						'company' => $this->input->post('company'),
						'address_1' => $this->input->post('address_1'),
						'address_2' => $this->input->post('address_2'),
						'city' => $this->input->post('city'),
						'postcode' => $this->input->post('postcode'),
						'country_id' => $this->input->post('country_id'),
						'region_id' => $this->input->post('region_id'),
						'customer_id' => $user->customer_id,
					);
					$address_id = $this->User_address_model->save_address($address_input);
				}
			}
		}else {
			$address_id = $this->input->post('address_id');
		}

		if($this->input->post()) {
			if ($address_id) {
				$checkout['shipping_address'] = $address_id;
				$this->user_session->set_userdata('checkout', $checkout);
				redirect(site_url('checkout/shipping-method.html'));
			} else {
				$this->user_session->set_flashdata('error', 'Shipping address has not been added in to checkout process successfully. Try Again!');
				redirect(site_url('checkout/shipping-address.html'));
			}
		}else{
			$this->view($this->user_view .'/'. $this->view_dir .'/shipping-address', $data);
		}

	}

	public function shipping_method()
	{
		// redirect to cart of checkout process is not ready
		$this->is_ready_for_checkout_process();

		$checkout = $this->user_session->userdata('checkout') ? $this->user_session->userdata('checkout') : array();

        $cart_items = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();
		
		if(isset($checkout['shipping_method'])){
			unset($checkout['shipping_method']);
		}
		if(isset($checkout['payment_method'])){
			unset($checkout['payment_method']);
		}



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


	public function payment_method()
	{
		// redirect to cart of checkout process is not ready
		$this->is_ready_for_checkout_process();

		$checkout = $this->user_session->userdata('checkout') ? $this->user_session->userdata('checkout') : array();

		if(isset($checkout['payment_method'])){
			unset($checkout['payment_method']);
		}

		$data = array();
		$data['meta_title']			= 'Payment Method';
		$data['meta_keywords']		= 'Payment Method';
		$data['meta_description']	= 'Payment Method';

		$data['page_title']		= 'Payment Method';
		$data['page_header']	= 'Payment Method';

		$payment_methods = $this->User_setting_model->get_payment_methods();
		foreach ($payment_methods as $payment_method_key => $payment_method){
			if($payment_methods[$payment_method_key][$payment_method_key.'_status'] == 1){
				$data['payment_methods'][$payment_method_key] = $payment_method;
			}
		}

		$this->current_active_nav = 'checkout-payment-method';

		$user = (object)$this->user_session->userdata('user');

		if($this->site_config->item('is_short_checkout')){
			if(!isset($data['payment_methods'])){
				$this->user_session->set_flashdata('error', 'No payment method is available yet. Please contact with store owner!');
				redirect(site_url('checkout/cart.html'));
			}
			$payment_methods_keys = array_keys($data['payment_methods']);
			$result = isset($payment_methods_keys[0]) ? $payment_methods_keys[0] :  false;
			if($result){
				$checkout['payment_method'] = $result;
				$this->user_session->set_userdata('checkout', $checkout);
				redirect(site_url('checkout/confirm-order.html'));
			}else{
				$this->user_session->set_flashdata('error', 'No payment method is available yet. Please contact with store owner!');
				redirect(site_url('checkout/cart.html'));
			}
		}else {
		if($this->input->post()){
			if($this->input->post('payment-method')) {
				$checkout['payment_method'] = $this->input->post('payment-method');
				
				$this->user_session->set_userdata('checkout', $checkout);
				redirect(site_url('checkout/confirm-order.html'));
			}else {
				$this->user_session->set_flashdata('error', 'Payment method has not been added in to checkout process successfully. Try Again!');
				redirect(site_url('checkout/payment-method.html'));
			}
		}else{
			$this->view($this->user_view . '/' . $this->view_dir . '/payment-method', $data);
		}
	}
	}

	public function confirm_order(){

//        $response = $this->get_transaction_details('9WL522128D716592S');
//        echo "<pre>"; print_r($response);
//        die('sss');

		if($this->input->post()){
			if(!$this->input->post('agree')){
				$this->user_session->set_flashdata('error', 'Warning: You must agree to the Terms & Conditions!');
			}elseif($this->input->post('agree')){
				
				if($this->input->post('comment') == ''){
					$this->user_session->set_flashdata('error', 'Error: Please add your vehicle year, make and model information.');
				}
				else
				{
					$payment_flag = false;
					$this->user_session->set_userdata('comment', $this->input->post('comment')) ;
					$checkout = $this->user_session->userdata('checkout') ? $this->user_session->userdata('checkout') : array();
					/*switch ($checkout['payment_method']){
						case 'paypal':
							$payment_flag = true;
							break;
						case 'cod':
							$payment_flag = true;
							break;
						default:
							$payment_flag = false;
							break;
					}*/
	
					$this->post_order();
					if($checkout['payment_method'] == 'paypal'){
						$this->paypayl_payment();
					}
				}
			}
			
			$this->user_session->set_userdata('agree', $this->input->post('agree')) ;
			$this->user_session->set_userdata('comment', $this->input->post('comment')) ;
			
		}
		
		$agree = $this->user_session->userdata('agree');
		$comment = $this->user_session->userdata('comment');

		// redirect to cart of checkout process is not ready
		$this->is_ready_for_checkout_process();

		$checkout = $this->user_session->userdata('checkout') ? $this->user_session->userdata('checkout') : array();
		$cart_items = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();

        $shipping_address_id = isset($checkout['shipping_address']) ? $checkout['shipping_address'] : '';
        $shipping_address = $this->User_address_model->get_address($shipping_address_id);
        $state_id = !empty($shipping_address) ? $shipping_address->region_id : false;

        $coupon = $this->user_session->userdata('coupon');
        $coupon_status = isset($coupon['status']) ? $coupon['status'] : '';
		$coupon_type = isset($coupon['type']) ? $coupon['type'] : '';
		$coupon_value = isset($coupon['value']) ? $coupon['value'] : '';

		$data = array();
		$this->current_active_nav = 'checkout-confirm-order';
		$data['meta_title']			= 'Confirm Order';
		$data['meta_keywords']		= 'Confirm Order';
		$data['meta_description']	= 'Confirm Order';

		$data['page_title']		= 'Confirm Order';
		$data['page_header']	= 'Confirm Order';

		$data['agree']       	= $agree;
		$data['comment']       	= $comment;

		$payment_methods = $this->User_setting_model->get_payment_methods();
		$shipping_methods = $this->User_setting_model->get_shipping_methods();

		$data['payment_method'] = $payment_methods[$checkout['payment_method']][$checkout['payment_method'].'_title'];
		$data['shipping_method'] = $shipping_methods[$checkout['shipping_method']][$checkout['shipping_method'].'_title'];
		$data['billing_address'] = $this->User_address_model->get_address($checkout['billing_address']);
		$data['shipping_address'] = $this->User_address_model->get_address($checkout['shipping_address']);


		$products = array();
        $sub_total = $tax = $coupon_discount = $member_discount = 0;

        //foreach ($cart_items as $product_id => $item){
        foreach ($cart_items as $item) {
                $product_id =  $item['product_id'];

                //if(!empty($product_id)) {
			$product_info = $this->User_catalog_model->get_product($product_id);

//			if ($product_info->image) {
//
//				$image_url = parse_url($product_info->image);
//				if (isset($image_url['scheme'])) {
//					$image = $product_info->image;
//				} else {
//					$image = base_url($product_info->image);
//				}
//			} else {
//				$image = base_url($this->site_config->item('config_placeholder_small'));
//			}

//            $product_info->images = get_product_images($product_id);
//
//            if (!empty($product_info->images) && count($product_info->images) > 0) {
//                $image = $product_info->images;
//            } else {
//                $image = base_url($this->site_config->item('config_placeholder_small'));
//            }
//
//            $special_price =  get_product_special_price($product_id);
//            $price = $special_price > 0 ? $special_price : $product_info->sale_price;

           // $price = $product_info->special_price > 0 ? $product_info->special_price : $product_info->sale_price;

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


            $item_total_amount = $price * $item['quantity'];

            //$item_tax_amount = $this->tax->calculate_tax($item_total_amount, false, $state_id);
            //$item_total = $this->tax->calculate_tax($item_total_amount, true, $state_id);

			//$item_discount_total = $this->discount->calculate($item_total_amount, true);

			// I'M NOT SURE TAX WILL BE IMPLEMENTED AT DISCOUNTED AMOUNT OR REAL AMOUNT
			// IF IT IS ON BEFORE DISCOUNT AMOUNT THEN UNCOMMENT BELOW LINE AND COMMENT NEXT AFTER THAT
			//$item_tax_amount = $this->tax->calculate_tax($item_total_amount, false, $state_id);
			$item_tax_amount = $this->tax->calculate_tax($item_total_amount, false, $state_id);

			// I'M NOT SURE TAX WILL BE IMPLEMENTED AT DISCOUNTED AMOUNT OR REAL AMOUNT
			// IF IT IS ON BEFORE DISCOUNT AMOUNT THEN UNCOMMENT BELOW LINE AND COMMENT NEXT AFTER THAT
			//$item_total = $this->tax->calculate_tax($item_total_amount, true, $state_id);
			$item_total = $this->tax->calculate_tax($item_total_amount, true, $state_id);

			$products[] = (object)array(
				'product_id' => $product_info->product_id,
				'image' => $image,
				'product_name' => $product_info->product_name,
				'sku' => $product_info->sku,
				'quantity' => $item['quantity'],
                'unite_price' => format_currency(round($price,2)),
                'tax' => format_currency(round($item_tax_amount,2)),
				//'discount_total' => format_currency(round($item_discount_total,2)),
				'total' => format_currency(round($item_total_amount,2)),
			);

            $tax += $item_tax_amount;
            $sub_total += (int)$item_total - (int)$item_tax_amount;
		}

//        if($this->site_config->item('config_coupon_code_status')) {
//            $coupon_discount = $coupon_status == 'applied' ? $this->coupon->calculate_discount($sub_total,$coupon_type,$coupon_value) : '';
//        }
//
//        if($this->is_member() && $this->site_config->item('join_club_discount_status')) {
//            $member_discount = $this->membership->calculate_discount($sub_total);
//        }

		$data['products'] = $products;

		$shipping_cost =  $shipping_methods[$checkout['shipping_method']][$checkout['shipping_method'].'_cost'];
		$totals = array(
			'sub_total'		=> (object)array('title' => 'Sub-Total', 'amount' => $sub_total),
			'shipping_cost'	=> (object)array('title' => 'Shipping Cost', 'amount' => $shipping_cost),
			'tax'	=> (object)array('title' => 'Tax', 'amount' => $tax),
			//'coupon_discount'	    => (object)array('title' => 'Discount <small>(Coupon applied)</small>', 'amount' => $coupon_discount),
			//'membership_discount'	=> (object)array('title' => 'Discount <small>(Membership)</small>', 'amount' => $member_discount),
			'total'	=> (object)array('title' => 'Total', 'amount' => $sub_total + $shipping_cost + $tax - $member_discount - $coupon_discount)
		);

		$data['total'] = $totals;

		$this->view($this->user_view . '/' . $this->view_dir . '/confirm-order', $data);

	}

	public function order_success()
	{
		$data = array();
		$this->current_active_nav = 'checkout-order-success';
		$data['meta_title']			= 'Your Order Has Been Placed!';
		$data['meta_keywords']		= 'Your Order Has Been Placed!';
		$data['meta_description']	= 'Your Order Has Been Placed!';

		$data['page_title']		= 'Your Order Has Been Placed!';
		$data['page_header']	= 'Your Order Has Been Placed!';
		$this->view($this->user_view . '/' . $this->view_dir . '/order-success', $data);
	}

	public function is_cart_has_products(){
		$success_flag = false;
		if($this->user_session->userdata('cart')){
			$cart = $this->user_session->userdata('cart');
			$success_flag = count($cart);
		}
		return $success_flag;
	}

	public function paypayl_payment(){
		$success_flag = false;
		
		$this->load->model('user/common/User_setting_model');        
		$this->User_setting_model->load_settings('payment');
		
		$settings = (object)$this->User_setting_model->get_settings('paypal');
		//var_dump($settings);
		
		$sandbox_mode = site_config_item('paypal_sandbox_mode');
        $sandbox_mode = $settings->paypal_sandbox_mode;
		
		if($sandbox_mode){
			$api_endpoint = 'https://api-3t.sandbox.paypal.com/nvp';
			$api_url = 'https://www.sandbox.paypal.com/webscr&cmd=_express-checkout&token=';
            //$paypal_username = site_config_item('paypal_sandbox_username');
            //$paypal_password = site_config_item('paypal_sandbox_password');
            //$paypal_api_signature = site_config_item('paypal_sandbox_api_signature');
			$paypal_username = $settings->paypal_sandbox_username;
			$paypal_password = $settings->paypal_sandbox_password;
			$paypal_api_signature = $settings->paypal_sandbox_api_signature;
        }else{
			$api_endpoint = 'https://api-3t.paypal.com/nvp';
			$api_url = 'https://www.paypal.com/webscr&cmd=_express-checkout&token=';
            //$paypal_username = site_config_item('paypal_live_username');
            //$paypal_password = site_config_item('paypal_live_password');
            //$paypal_api_signature = site_config_item('paypal_live_api_signature');
			$paypal_username = $settings->paypal_live_username;
			$paypal_password = $settings->paypal_live_password;
			$paypal_api_signature = $settings->paypal_live_api_signature;
        }

		$settings = array(
			'api_username' => $paypal_username,
			'api_password' => $paypal_password,
			'api_signature' => $paypal_api_signature,
			'api_endpoint' => $api_endpoint,
			'api_url' => $api_url,
			'api_version' => '124.0',
			'payment_type' => 'Sale',
			'currency' => 'USD'
		);
		
		//var_dump($settings);die;
		
		$this->load->library('paypalexpress', $settings);
		if(!isset($_GET['token'])) {
			// Setting up your intial variable to send payment process.
			$url = dirname('http://'.$_SERVER['SERVER_NAME'].':'.$_SERVER['SERVER_PORT'].$_SERVER['REQUEST_URI']);

			$order_details = $this->get_order_details($this->user_session->userdata('order_id'));

			$items = '';
			$AMT = $ITEMAMT = $SHIPPINGAMT =  $TAXAMT = $SUB_TOTAL = $COUPON_DISCAMT = $MEMBERSHIP_DISCAMT = 0;
            if($order_details){
                foreach ($order_details->products as $index_key => $product){
                    $product_name = $product->product_name;
                    $sku  = $product->sku;
                    $dash_flag = $name_flag = strlen($product_name) > 0 ? true : false;
                    $dash_flag = strlen($sku) > 0 ? true : false;
                    $description =  $dash_flag ? $product_name .'/'. $sku :  ($name_flag ? $product_name :  $sku);


                    if (strlen($product_name) > 127)
                        $product_name = substr($product_name, 0, 120);

                    if (strlen($description) > 127)
                        $description = substr($description, 0, 120);


                    $items .= "&L_PAYMENTREQUEST_0_NAME". $index_key ."=". $product_name .' (Original Price: '. format_currency($product->unite_price ) .')';
                    $items .= "&L_PAYMENTREQUEST_0_AMT". $index_key ."=". round($product->unite_price,2);
                    $items .= "&L_PAYMENTREQUEST_0_QTY". $index_key ."=". $product->quantity;
                    $items .= "&L_PAYMENTREQUEST_0_NUMBER". $index_key ."=" . $product->sku;
                    $items .= "&L_PAYMENTREQUEST_0_DESC". $index_key ."=" . $description;
                   // $items .= "&L_PAYMENTREQUEST_0_TAXAMT". $index_key ."=" . 10;
                  //  $items .= "&L_PAYMENTREQUEST_0_ITEMCATEGORY". $index_key ."=" . 10;
                    //$items .= "&L_PAYMENTREQUEST_0_ITEMURL". $index_key ."=" . "https://example.com/item=B";

                    //$AMT += $product->unite_price * $product->quantity;
                    $ITEMAMT += round($product->unite_price,2) * $product->quantity;

                }

                $discounts = array();

                foreach ($order_details->totals as $total){

                    if($total->title == 'sub_total'){
                        $SUB_TOTAL = round($total->value,2);
                    }

                    if($total->title == 'tax'){
                        $TAXAMT = round($total->value,2);
                    }

                    /*if($total->title == 'coupon_discount'){
                        $COUPON_DISCAMT = round($total->value,2);
                        $index_key = count($order_details->products);
                        $items .= "&L_NAME". $index_key ."=". 'Discount (coupon applied)';
                        $items .= "&L_AMT". $index_key ."=". $COUPON_DISCAMT;
                        $items .= "&L_QTY". $index_key ."=". 1;
                        $items .= "&L_DESC". $index_key ."=Discount coupon applied";
                        $ITEMAMT += $COUPON_DISCAMT;
                        $SUB_TOTAL +=  $COUPON_DISCAMT;
                    }*/

                  //  if($total->title == 'membership_discount'){
                        //$MEMBERSHIP_DISCAMT = round($total->value,2);
                        /*$index_key = count($order_details->products);
                        $items .= "&L_NAME". $index_key ."=". 'Discount (Membership)';
                        $items .= "&L_AMT". $index_key ."=". $MEMBERSHIP_DISCAMT;
                        $items .= "&L_QTY". $index_key ."=". 1;
                        $items .= "&L_DESC". $index_key ."=Membership discount applied";
                        $ITEMAMT += $MEMBERSHIP_DISCAMT;
                        $SUB_TOTAL +=  $MEMBERSHIP_DISCAMT;*/

                      //  if($MEMBERSHIP_DISCAMT) {
//							$discounts['membership_discount']['L_NAME'] = 'Discount (Membership)';
//							$discounts['membership_discount']['L_AMT'] = $MEMBERSHIP_DISCAMT;
//							$discounts['membership_discount']['L_QTY'] = 1;
//							$discounts['membership_discount']['L_DESC'] = "Membership discount applied";
//							$discounts['membership_discount']['ITEMAMT'] = $MEMBERSHIP_DISCAMT;
//							$discounts['membership_discount']['SUB_TOTAL'] = $MEMBERSHIP_DISCAMT;
					//	}
                   // }

                   // if($total->title == 'coupon_discount'){
                    //    $COUPON_DISCAMT = round($total->value,2);
                        /*$index_key = count($order_details->products);
                        $items .= "&L_NAME". $index_key ."=". 'Discount (coupon)';
                        $items .= "&L_AMT". $index_key ."=". $COUPON_DISCAMT;
                        $items .= "&L_QTY". $index_key ."=". 1;
                        $items .= "&L_DESC". $index_key ."=Coupon discount applied";
                        $ITEMAMT += $COUPON_DISCAMT;
                        $SUB_TOTAL +=  $COUPON_DISCAMT;*/

//                        if($COUPON_DISCAMT) {
//							$discounts['coupon_discount']['L_NAME'] = 'Discount (coupon)';
//							$discounts['coupon_discount']['L_AMT'] = $COUPON_DISCAMT;
//							$discounts['coupon_discount']['L_QTY'] = 1;
//							$discounts['coupon_discount']['L_DESC'] = "Coupon discount applied";
//							$discounts['coupon_discount']['ITEMAMT'] = $COUPON_DISCAMT;
//							$discounts['coupon_discount']['SUB_TOTAL'] = $COUPON_DISCAMT;
//						}
//
//                    }

                    if($total->title == 'shipping_cost'){
                        $SHIPPINGAMT = round($total->value,2);
                    }
                }
                
                
//                if(isset($discounts['membership_discount']) && !empty($discounts['membership_discount']) && isset($discounts['coupon_discount']) && !empty($discounts['coupon_discount'])){
//					$index_key = count($order_details->products);
//					$items .= "&L_NAME". $index_key ."=". 'Membership and Coupon Discount';
//					$items .= "&L_AMT". $index_key ."=". ($discounts['membership_discount']['L_AMT'] + $discounts['coupon_discount']['L_AMT']);
//					$items .= "&L_QTY". $index_key ."=". 1;
//					$items .= "&L_DESC". $index_key ."=Membership discount (". $discounts['membership_discount']['ITEMAMT'] .") + Coupon  discounts (". $discounts['coupon_discount']['ITEMAMT'] .") applied";
//					$ITEMAMT += ($discounts['membership_discount']['ITEMAMT'] + $discounts['coupon_discount']['ITEMAMT']);
//					$SUB_TOTAL +=  ($discounts['membership_discount']['SUB_TOTAL'] + $discounts['coupon_discount']['SUB_TOTAL']);
//				}elseif(isset($discounts['membership_discount']) && !empty($discounts['membership_discount'])){
//					$index_key = count($order_details->products);
//					$items .= "&L_NAME". $index_key ."=". $discounts['membership_discount']['L_NAME'];
//					$items .= "&L_AMT". $index_key ."=". $discounts['membership_discount']['L_AMT'];
//					$items .= "&L_QTY". $index_key ."=". $discounts['membership_discount']['L_QTY'];
//					$items .= "&L_DESC". $index_key ."=". $discounts['membership_discount']['L_DESC'];
//					$ITEMAMT += $discounts['membership_discount']['ITEMAMT'];
//					$SUB_TOTAL +=  $discounts['membership_discount']['SUB_TOTAL'];
//				}elseif(isset($discounts['coupon_discount']) && !empty($discounts['coupon_discount'])){
//					$index_key = count($order_details->products);
//					$items .= "&L_NAME". $index_key ."=". $discounts['coupon_discount']['L_NAME'];
//					$items .= "&L_AMT". $index_key ."=". $discounts['coupon_discount']['L_AMT'];
//					$items .= "&L_QTY". $index_key ."=". $discounts['coupon_discount']['L_QTY'];
//					$items .= "&L_DESC". $index_key ."=". $discounts['coupon_discount']['L_DESC'];
//					$ITEMAMT += $discounts['coupon_discount']['ITEMAMT'];
//					$SUB_TOTAL +=  $discounts['coupon_discount']['SUB_TOTAL'];
//				}

                $AMT = $SUB_TOTAL + $SHIPPINGAMT + $TAXAMT;
                $items .= "&PAYMENTREQUEST_0_ITEMAMT=".(string)$ITEMAMT;
                $items .= ($SHIPPINGAMT > 0) ? "&PAYMENTREQUEST_0_SHIPPINGAMT=".(string)$SHIPPINGAMT : '';
                $items .= "&PAYMENTREQUEST_0_TAXAMT=".(string)$TAXAMT;
                $items .= "&PAYMENTREQUEST_0_AMT=".(string)$AMT;
            }

            $returnURL = urlencode($url.'/paypayl.html');
            $cancelURL = urlencode("$url/paypayl.html");

            $items .= "&ReturnUrl=".$returnURL;
            $items .= "&CANCELURL=".$cancelURL;
            $items .= "&CURRENCYCODE=".$settings['currency'];
            $items .= "&PAYMENTACTION=".$settings['payment_type'];


            $nvpstr = $items;
			// calling initial api.
			$initresult = $this->paypalexpress->process_payment($nvpstr);
			if(isset($initresult) && $initresult['ACK'] == 'Failure') {
				// redirect to view with error message.
				$this->user_session->set_flashdata('error', 'Please check your details and try again to checkout.');
                redirect(site_url('checkout/confirm-order.html'));
			}
			echo "<pre>";
			print_r($initresult);
			echo "</pre>";
			exit;
		}
		else {
			$token = urlencode($_GET['token']);
			$result = $this->paypalexpress->make_payment($token);

			if(isset($result) && $result['ACK'] == 'Failure') {
				// redirect to view with error message.
				// exit('Please check your details and try again');
				$this->user_session->set_flashdata('error', 'Please check your details and try again');
				//redirect('paypal');
                redirect(site_url('checkout/confirm-order.html'));
			}
			else {
				// Do your stuff with success result.
                $order_id = $this->user_session->userdata('order_id');
                $order_status_id      = $this->site_config->item('config_complete_order_status');
                $shipping_status_id   = $this->site_config->item('shipping_order_status');

                $order_status_id = $order_status_id > 0 ? $order_status_id : 1;
                $shipping_status_id = $shipping_status_id > 0 ? $shipping_status_id : 1;

                $params = array(
                    'order_status_id'   => $shipping_status_id,
                    'payment_status_id' => $order_status_id,
                );
                $this->User_checkout_model->update_order_status($params, $order_id);
                $this->send_order_email($order_id,$this->customer_id);
                $this->user_session->unset_userdata('cart');
                $this->user_session->unset_userdata('order_id');
                $this->user_session->unset_userdata('checkout');

                $coupon = $this->user_session->userdata('coupon');
                if($coupon){
                    //$this->User_checkout_model->update_coupon_status($coupon['code'],1);
					$coupon_id = isset($coupon['coupon_id']) ? $coupon['coupon_id'] : '';
					$this->update_order_coupon_history($order_id,$coupon_id);
                    $this->user_session->unset_userdata('coupon');
                }

                redirect(site_url('checkout/order-success.html'));
			}
		}

		return $success_flag;
	}



    function get_transaction_details( $transaction_id ) {

        $this->load->model('user/common/User_setting_model');
        $this->User_setting_model->load_settings('payment');

        $settings = (object)$this->User_setting_model->get_settings('paypal');

        $paypal_username = $settings->paypal_sandbox_username;
        $paypal_password = $settings->paypal_sandbox_password;
        $paypal_api_signature = $settings->paypal_sandbox_api_signature;



        $api_request = 'USER=' . urlencode( $paypal_username )
            .  '&PWD=' . urlencode( $paypal_password )
            .  '&SIGNATURE=' . urlencode( $paypal_api_signature )
            .  '&VERSION=76.0'
            .  '&METHOD=GetTransactionDetails'
            .  '&TransactionID=' . $transaction_id;

        $ch = curl_init();
        curl_setopt( $ch, CURLOPT_URL, 'https://api-3t.sandbox.paypal.com/nvp' ); // For live transactions, change to 'https://api-3t.paypal.com/nvp'
        curl_setopt( $ch, CURLOPT_VERBOSE, 1 );

        // Uncomment these to turn off server and peer verification
        // curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
        // curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, FALSE );
        curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt( $ch, CURLOPT_POST, 1 );

        // Set the API parameters for this transaction
        curl_setopt( $ch, CURLOPT_POSTFIELDS, $api_request );

        // Request response from PayPal
        $response = curl_exec( $ch );
        // print_r($response);

        // If no response was received from PayPal there is no point parsing the response
        if( ! $response )
            die( 'Calling PayPal to change_subscription_status failed: ' . curl_error( $ch ) . '(' . curl_errno( $ch ) . ')' );

        curl_close( $ch );

        // An associative array is more usable than a parameter string
        parse_str( $response, $parsed_response );

        return $parsed_response;
    }





    function queryToArray($qry)
    {
        $result = array();
        //string must contain at least one = and cannot be in first position
        if(strpos($qry,'=')) {

            if(strpos($qry,'?')!==false) {
                $q = parse_url($qry);
                $qry = $q['query'];
            }
        }else {
            return false;
        }

        foreach (explode('&', $qry) as $couple) {
            list ($key, $val) = explode('=', $couple);
            $result[$key] = $val;
        }

        return empty($result) ? false : $result;
    }


	/*
	+-----------------------------------------------------------------------+
	|						CHECKOUT FUNCTIONS ENDS TO HERE					|
	+-----------------------------------------------------------------------+
	*/

	public function is_end_user_login()
	{

		if($this->user_session->userdata('user')){
			$user = (object)$this->user_session->userdata('user');
			return $user->customer_id;
		}else{
			return false;
		}
	}

	private function is_ready_for_checkout_process(){
		if(!$this->is_cart_has_products()){
			$this->user_session->set_flashdata('error', 'Cart is empty!');
			redirect(site_url('checkout/cart.html'));
		}

//		if(!$this->is_end_user_login()){
//			$this->user_session->set_flashdata('error', '<a style="color: #a94442;" href="'. site_url('secure/login.html') .'">Please login first!</a> ');
//			redirect(site_url('checkout/cart.html'));
//		}

	}

	private function post_order()
	{
		$this->is_ready_for_checkout_process();
		$checkout = $this->user_session->userdata('checkout') ? $this->user_session->userdata('checkout') : array();
		$cart_items = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();
		$payment_methods 	= $this->User_setting_model->get_payment_methods();
		$shipping_methods 	= $this->User_setting_model->get_shipping_methods();
		$billing_address 	= $this->User_address_model->get_address($checkout['billing_address']);
		$shipping_address 	= $this->User_address_model->get_address($checkout['shipping_address']);

		$order_data = $this->order_data;
		$totals  =$this->totals;
		
		
		$totals['sub_total'] = 0;

		$order_data['invoice_no'] 		= '';
		$order_data['invoice_prefix'] 	= $this->site_config->item('config_invoice_prefix');

		// GETTING ORDERED END USER INFORMATION
		$user = (object)$this->user_session->userdata('user');
		$end_user_info = $this->Customer_model->get_by_id($user->customer_id);
		$order_data['customer_id'] 	= $end_user_info->customer_id;
		$order_data['first_name'] 	= $end_user_info->first_name;
		$order_data['last_name'] 	= $end_user_info->last_name;
		$order_data['email'] 		= $end_user_info->email;
		$order_data['telephone'] 	= $end_user_info->cell;

		// GETTING ORDERED BILLING ADDRESS INFORMATION
		$order_data['payment_first_name'] 	= $billing_address->first_name;
		$order_data['payment_last_name']  	= $billing_address->last_name;
		$order_data['payment_company']    	= $billing_address->company;
		$order_data['payment_address_1']  	= $billing_address->address_1;
		$order_data['payment_address_2']	= $billing_address->address_2;
		$order_data['payment_city'] 		= $billing_address->city;
		$order_data['payment_postcode'] 	= $billing_address->postcode;
		$order_data['payment_zone'] 		= $this->Location_model->get_zone($billing_address->region_id)->name;
		$order_data['payment_zone_id'] 		= $billing_address->region_id;
		$order_data['payment_country'] 		= $this->Location_model->get_country($billing_address->country_id)->name;
		$order_data['payment_country_id'] 	= $billing_address->country_id;
		$order_data['payment_method']		= $payment_methods[$checkout['payment_method']][$checkout['payment_method'].'_title'];
		$order_data['payment_code']			= $checkout['payment_method'];

		if(isset($payment_methods[$checkout['payment_method']][$checkout['payment_method'].'_cost'])){
			$totals['payment_cost'] = array('code' => $checkout['payment_method'], 'value' => $payment_methods[$checkout['payment_method']][$checkout['payment_method'].'_cost']);
		}


		// GETTING ORDERED SHIPPING ADDRESS INFORMATION
		$order_data['shipping_first_name'] 	= $shipping_address->first_name;
		$order_data['shipping_last_name']  	= $shipping_address->last_name;
		$order_data['shipping_company']    	= $shipping_address->company;
		$order_data['shipping_address_1']  	= $shipping_address->address_1;
		$order_data['shipping_address_2']	= $shipping_address->address_2;
		$order_data['shipping_city'] 		= $shipping_address->city;
		$order_data['shipping_postcode'] 	= $shipping_address->postcode;
		$order_data['shipping_zone'] 		= $this->Location_model->get_zone($shipping_address->region_id)->name;
		$order_data['shipping_zone_id']		= $shipping_address->region_id;
		$order_data['shipping_country'] 	= $this->Location_model->get_country($shipping_address->country_id)->name;
		$order_data['shipping_country_id'] 	= $shipping_address->country_id;
		$order_data['shipping_method']		= $shipping_methods[$checkout['shipping_method']][$checkout['shipping_method'].'_title'];
		$order_data['shipping_code']		= $checkout['shipping_method'];
		$order_data['comment'] 				= $this->user_session->userdata('comment') ? $this->user_session->userdata('comment') : '';

		//GETTING ORDER DEFAULT STATUS
		$order_data['order_status_id'] = '0'; //$this->site_config->item('config_pending_order_status');

		// GETTING CURRENCY INFORMATION
		$order_data['currency_id'] 		= $this->site_config->item('config_currency_id');
		$order_data['currency_code'] 	= $this->site_config->item('config_currency');
		$order_data['currency_value'] 	= $this->site_config->item('config_currency_value');

		// GETTING SERVER VARIABLES INFORMATION
		$order_data['ip'] 				= $this->input->ip_address();
		if($this->input->server('HTTP_X_FORWARDED_FOR')){
			$order_data['forwarded_ip'] 	= $this->input->server('HTTP_X_FORWARDED_FOR');
		}elseif($this->input->server('HTTP_CLIENT_IP')){
			$order_data['forwarded_ip'] 	= $this->input->server('HTTP_CLIENT_IP');
		}else{
			$order_data['forwarded_ip'] 	= '';
		}

		if($this->input->server('HTTP_USER_AGENT')){
			$order_data['user_agent'] 	= $this->input->server('HTTP_USER_AGENT');
		}else{
			$order_data['user_agent'] 	= '';
		}

		if($this->input->server('HTTP_ACCEPT_LANGUAGE')){
			$order_data['accept_language'] 	= $this->input->server('HTTP_ACCEPT_LANGUAGE');
		}else{
			$order_data['accept_language'] 	= '';
		}

		if(isset($shipping_methods[$checkout['shipping_method']][$checkout['shipping_method'].'_cost'])){
			$totals['shipping_cost'] = array('code' => $checkout['shipping_method'], 'value' => $shipping_methods[$checkout['shipping_method']][$checkout['shipping_method'].'_cost']);
		}

		// GETTING ORDERED PRODUCTS INFORMATION
		$products = array();
        $sub_total = $tax = 0;

        //foreach ($cart_items as $product_id => $item) {

        foreach ($cart_items as $item) {
            $product_id =  $item['product_id'];


			//if(!empty($product_id)) {
			$product_info = $this->User_catalog_model->get_product($product_id);

            $price = $product_info->special_price > 0 ? $product_info->special_price : $product_info->sale_price;
            $item_total_amount = $price * $item['quantity'];

            //$item_tax_amount = $this->tax->calculate_tax($item_total_amount, false, $shipping_address->region_id);
            //$item_total = $this->tax->calculate_tax($item_total_amount, true, $shipping_address->region_id);

			//$item_discount_total = $this->discount->calculate($item_total_amount, true);

			// I'M NOT SURE TAX WILL BE IMPLEMENTED AT DISCOUNTED AMOUNT OR REAL AMOUNT
			// IF IT IS ON BEFORE DISCOUNT AMOUNT THEN UNCOMMENT BELOW LINE AND COMMENT NEXT AFTER THAT
			//$item_tax_amount = $this->tax->calculate_tax($item_total_amount, false, $shipping_address->region_id);
			$item_tax_amount = $this->tax->calculate_tax($item_total_amount, false, $shipping_address->region_id);

			// I'M NOT SURE TAX WILL BE IMPLEMENTED AT DISCOUNTED AMOUNT OR REAL AMOUNT
			// IF IT IS ON BEFORE DISCOUNT AMOUNT THEN UNCOMMENT BELOW LINE AND COMMENT NEXT AFTER THAT
			//$item_total = $this->tax->calculate_tax($item_total_amount, true, $shipping_address->region_id);
			$item_total = $this->tax->calculate_tax($item_total_amount, true, $shipping_address->region_id);

			$products[] = (object)array(
				'product_id' => $product_info->product_id,
				'product_name' => !empty($product_info->product_name) ? $product_info->product_name : '',
				'sku' => $product_info->sku,
				'quantity' => $item['quantity'],
                'unite_price' => round($price,2),
                'tax' => round($item_tax_amount,2),
				//'discount_total' => round($item_discount_total,2),
                'total' => round($item_total_amount,2),
			);

			$tax += $item_tax_amount;
            $sub_total += $item_total - $item_tax_amount;
		}

		$order_data['products'] = $products;

        $totals['sub_total'] = array('code' => 'sub_total', 'value' => $sub_total);
        $totals['tax'] = array('code' => 'tax', 'value' => $tax);

//        if($this->site_config->item('config_coupon_code_status')) {
//            $coupon = $this->user_session->userdata('coupon');
//            $coupon_status = isset($coupon['status']) ? $coupon['status'] : '';
//			$coupon_type = isset($coupon['type']) ? $coupon['type'] : '';
//			$coupon_value = isset($coupon['value']) ? $coupon['value'] : '';
//			$coupon_id = isset($coupon['coupon_id']) ? $coupon['coupon_id'] : '';
//            $coupon_discount = ($coupon_status == 'applied') ? $this->coupon->calculate_discount($sub_total,$coupon_type,$coupon_value) : '';
//            $totals['coupon_discount'] = array('code' => 'coupon_discount', 'value' => - $coupon_discount);
//        }

//        if($this->is_member() && $this->site_config->item('join_club_discount_status')) {
//            $member_discount = $this->membership->calculate_discount($sub_total);
//            $totals['membership_discount'] = array('code' => 'membership_discount', 'value' => - $member_discount);
//        }

		// GETTING ORDERED TOTALS INFORMATION
		$grand_total = 0;

		foreach ($totals as $code => $item){

			$grand_total += $item['value'];
		}
		$totals['total'] = array('code' => 'total' ,'value' => $grand_total);
		$order_data['total'] 	= $grand_total;
		$order_data['totals'] 	= $totals;

		//GETTING INFORMATION ABOUT THE ORDER DATES
		$order_data['date_added'] 		= date('Y-m-d H:i:s');
		$order_data['date_modified'] 	= date('Y-m-d H:i:s');
		//GETTING INFORMATION ABOUT THE ORDER MAKER
		$order_data['added_by_id'] 		= $end_user_info->customer_id;
		$order_data['added_by_name'] 	= $end_user_info->first_name .' ' . $end_user_info->last_name;
		$order_data['added_by_ip'] 		= $order_data['ip'];
		$order_data['modified_by_id'] 	= $end_user_info->customer_id;
		$order_data['modified_by_name']	= $end_user_info->first_name .' ' . $end_user_info->last_name;
		$order_data['modified_by_ip'] 	= $order_data['ip'];
		var_dump($order_data);
		die();

		if($order_id = $this->User_checkout_model->save_order($order_data)){
			$this->send_order_email($order_id,$this->customer_id);
			//$this->user_session->unset_userdata('cart');
			$this->user_session->set_userdata('order_id', $order_id);
			//$this->user_session->unset_userdata('checkout');
			//redirect(site_url('checkout/order-success.html'));
			if($this->site_config->item('config_coupon_code_status')) {
			$this->set_order_coupon_history($order_id,$coupon_id);
			}
		}else{
			$this->user_session->set_flashdata('error', 'Your order has not been placed successfully! Please try again!');
			redirect(site_url('checkout/confirm-order.html'));
		}
	}

	private function set_order_coupon_history($order_id, $coupon_id){
		$input_data = array(
			'order_id' 	=> $order_id,
			'coupon_id'	=>	$coupon_id
		);
		$this->User_checkout_model->save_coupon_history($input_data);
	}

	private function update_order_coupon_history($order_id,$coupon_id){
		$input_data = array(
			'order_id' 	=> $order_id,
			'coupon_id'	=>	$coupon_id
		);
		$this->User_checkout_model->update_coupon_history($input_data);
	}

	private function send_order_email($order_id, $customer_id)
	{
		$user = $this->Customer_model->get_by_id($customer_id);
		$order = $this->get_order_details($order_id);
		if(empty($order))
		{
			return FALSE;
		}
		
		$message = $this->view_email($this->user_view.'/emails/email_order_submit', array('order'=>$order), TRUE);
		$subject = site_config_item('config_name').' - Your order number '.$order_id;

		$from_email = site_config_item('config_mail_from_email');
		$from_name = site_config_item('config_mail_from_name');

		$this->load->library('email');

		$this->email->from($from_email, $from_name);
		$this->email->to($user->email);
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

	private function get_order_details($order_id)
	{
		$order = $this->User_checkout_model->get_order($order_id);
		$order->products = $this->User_checkout_model->get_order_products($order_id);
		$order->totals = $this->User_checkout_model->get_order_totals($order_id);
		$order->history = $this->User_checkout_model->get_order_history($order_id);
		return $order;
	}

    public function apply_coupon()
    {
        $json = array('error' => true);
        if(!$this->auth_user->is_logged_in()){
			$json['message'] = 'Please login first to use coupon code';
            return ajax_response($json);

		}
        if($this->input->post()){
            $coupon_code = $this->input->post('coupon');
            $coupon_info = $this->User_checkout_model->get_coupon($coupon_code);
            if($coupon_info){
				$coupon_total_usage = $this->User_checkout_model->get_coupon_total_usage($coupon_info->coupon_id);
                if($coupon_info->number_of_usage > $coupon_total_usage){
                    $coupon = array(
                        'status' => 'applied',
                        'coupon_id' => $coupon_info->coupon_id,
                        'code'   	=> $coupon_code,
						'type'	 	=> $coupon_info->coupon_type,
						'value'	 	=> $coupon_info->coupon_value
                    );
                    $this->user_session->set_userdata('coupon', $coupon);
                    $json['result'] = true;
                    $json['error'] = false;
                    $json['message'] = 'Coupon code applied successfully';
                    $this->user_session->set_flashdata('success', 'coupon code applied successfully!');
                }else{
					$json['message'] = 'This coupon code is reached at its maximum usage limit';
                }

            }else{
                $json['message'] = 'Invalid coupon code applied';
            }
        }
        ajax_response($json);
	}

	public function remove_coupon()
    {
        $json = array('error' => true);
        if(!$this->auth_user->is_logged_in()){
			$json['message'] = 'Please login first to use coupon code';
            return ajax_response($json);

		}

		$this->user_session->unset_userdata('coupon');
		$json['result'] = true;
		$json['error'] = false;
		$json['message'] = 'Coupon code has been removed successfully';
		$this->user_session->set_flashdata('success', 'Coupon code has been removed successfully!');
        ajax_response($json);
	}


}
