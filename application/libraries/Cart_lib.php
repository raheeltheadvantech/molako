<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cart_lib {

	private $CI;
	
	public function __construct() {
		
		$this->CI =& get_instance();
		$this->CI->load->database();
        $this->totals =0;
	}

    public function get_countries()
    {
        $countries = $this->CI->Location_model->get_countries(false);
        $countries_options  = array();

        foreach ($countries as $country){
            $countries_options[$country->country_id] = $country->name;
        }

        return $countries_options;
    }
    
    public function get_payment_methods()
    {
        $method = array();
        // get payment methods
        $payment_methods = $this->CI->User_setting_model->get_payment_methods();
        
        foreach ($payment_methods as $payment_method_key => $payment_method){
            if($payment_methods[$payment_method_key]['status'] == 1){
                $method[$payment_method_key] = $payment_method;
            }
        }

        return $method;
    }

    public function get_shippings()
    {
        $dt = $this->CI->User_setting_model->get_shipping_methods();
        return $dt;
    }
	
	//set and get shipping address //via controller
	public function set_shipping_address($method)
    {
        $checkout = (object)$this->CI->user_session->userdata('checkout');
        if(isset($checkout->shipping_address))
        {
            unset($checkout->shipping_address);
        }
        if(isset($checkout->shipping_method))
        {
            unset($checkout->shipping_method);
        }

        if ($method):
            $checkout->shipping_method = $method;
        endif;

        $this->CI->user_session->set_userdata('checkout', $checkout);
		
		return $checkout;
	}

    public function get_shipping_address()
    {
        $checkout = (object)$this->CI->user_session->userdata('checkout') ? $this->CI->user_session->userdata('checkout') : false;
        
        if(!$checkout or !isset($checkout->shipping_method) or !isset($checkout->shipping_address))
        {
            $this->CI->user_session->set_flashdata('error', 'Please select shipping address and method');
            redirect(site_url('checkout/shipping.html'));
        }
    }
    //set and get billing address //via controller
    public function set_billing_address($method, $address)
    {
        $checkout = (object)$this->CI->user_session->userdata('checkout') ? $this->CI->user_session->userdata('checkout') : false;
        if(isset($checkout->billing_address)){
            unset($checkout->billing_address);
        }
        if(isset($checkout->payment_method))
        {
            unset($checkout->payment_method);
        }

        if ($method):
            $checkout->payment_method = $method;
        endif;
        if ($address):
            $checkout->billing_address = $address;
        endif;

        $this->CI->user_session->set_userdata('checkout', $checkout);
        
        return $checkout;
    }

    public function get_billing_address()
    {
        $checkout = (object)$this->CI->user_session->userdata('checkout') ? $this->CI->user_session->userdata('checkout') : false;;
        
        if(!$checkout or !isset($checkout->payment_method) or !isset($checkout->billing_address))
        {
            $this->CI->user_session->set_flashdata('error', 'Please select billing address and method');
            redirect(site_url('checkout/billing.html'));
        }
    }

	
    public function add($item)
    {
        if(!$item)
        {
            return (object)array('error'=>true, 'message'=>'Cart item not found', 'data'=>false);
        }

        $cart = $this->items($item);
        // echo'cart';pre($cart);

        if($cart->error)
        {
            return $cart;
        }
        else{
            $this->CI->user_session->set_userdata('cart', $cart);
        }
       return (object)array('error'=>false, 'message'=>'Product is successfully added to your shopping cart.', 'data'=>false);
    }

    public function update($item)
    {
        if(!$item)
        {
            return (object)array('error'=>true, 'message'=>'Cart item not found', 'data'=>false);
        }

        $product_sku = $item['key'];

        // $product_id = $item['product_id'];
        $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
        $quantity = intval($quantity);
        $quantity = abs($quantity);
        
        $cart = $this->CI->user_session->userdata('cart') ? $this->CI->user_session->userdata('cart') : array();
        $config_catalog_purchase = $this->CI->db->where('key','config_catalog_purchase')->get('ci_settings')->row();
        if($config_catalog_purchase)
        {
            $config_catalog_purchase = $config_catalog_purchase->value;
        }
        else
        {
            $config_catalog_purchase = 0;
        }
        
        if($quantity > $cart[$product_sku]['available_qty'] && !$config_catalog_purchase)
        {
            return (object)array('error'=>true, 'message'=>'Product quantity has not been updated in your shopping cart', 'data'=>false);
        }else
        {
            // ADDING OR UPDATING THE QUANTITY IN CART
            if (!empty($product_sku)) {
                $cart[$product_sku] = array(
                    'product_id' => $cart[$product_sku]['product_id'],
                    'quantity' => $quantity,
                    'product_option_value_id' => (isset($item['product_option_value_id'])?$item['product_option_value_id']:0),
                    'price' => $cart[$product_sku]['price'],
                    'options' => $cart[$product_sku]['options'],
                    'available_qty' => $cart[$product_sku]['available_qty'],
                    'tax_class_id'  => $cart[$product_sku]['tax_class_id'],
                    'sku' => $cart[$product_sku]['sku']
                );

                $this->CI->user_session->set_userdata('cart', $cart);
                return (object)array('error'=>false, 'message'=>'Product quantity updated in your shopping cart successfully', 'data'=>false);

            } else {
                return (object)array('error'=>true, 'message'=>'Product quantity has not been updated in your shopping cart', 'data'=>false);
            }
        }
        

        // return (object)array('error'=>false, 'message'=>'Product is updated successfully into the cart.', 'data'=>false);
    }

    public function remove($product_id,$product_option_value_id = 0)
    {
        $product = $this->CI->User_catalog_model->get_product($product_id);
        if(!$product)
        {
            return (object)array('error'=>true, 'message'=>'Product not found', 'data'=>false);
        }

        if($product_id)
        {
            $cart = $this->CI->user_session->userdata('cart');
            if($cart)
            {
                $c = array();
                foreach($cart as $k=>&$v)
                {
					$v['product_option_value_id'] = (isset($v['product_option_value_id'])?$v['product_option_value_id']:0);
                    if($product_id == $v['product_id'] && $product_option_value_id == $v['product_option_value_id'])
                    {
                        continue;
                    }
                    
                    $c[$k] = $v;
                }
                
                $this->CI->user_session->set_userdata('cart', $c);
            }
        }
        
        return (object)array('error'=>false, 'message'=> 'Product is removed successfully from the cart.', 'data'=>false);
    }

    public function items($item)
    {
        $product_id = $item['product_id'];
        $product_info = $this->CI->User_catalog_model->get_product($product_id);

        if(!$product_info)
        {
            return (object)array('error'=>true, 'message'=>'Product not found', 'data'=>false);
        }
        $cut_price = $product_info->sale_price;
        
        $cart = $this->CI->user_session->userdata('cart') ? $this->CI->user_session->userdata('cart') : array();

        $quantity = isset($item['quantity']) ? $item['quantity'] : 1;
        $quantity = intval($quantity);
        $quantity = abs($quantity);
		if(json_decode($product_info->option_name,true))
		{
		}
        if (isset($cart[$product_info->sku])) 
        {
            if($product_id == $cart[$product_info->sku]['product_id'])
            {
                $quantity = $cart[$product_info->sku]['quantity'] + $quantity;
            }
        }
		


        $product_option_value_id = '';
        $product_option_price = '';
        $product_option_image = '';
        $product_option_sku = '';

        if (isset($item['product_option_value_id']) && $item['product_option_value_id']) {
            $options = ($item['options'])?$item['options']:array();
            $product_option_value_id = $item['product_option_value_id'];


            if(!empty($product_option_value_id)) {
                $row = (object)$this->CI->User_catalog_model->get_product_option($product_id, $product_option_value_id);
                $cut_price = $row->original_price;

				 
                $product_option_price = $row->final_price;
                $product_option_image = $this->CI->User_catalog_model->get_column_value('product_option_value', 'product_option_value_id', $product_option_value_id, 'image');
                if(true)
                {
                    $product_option_image = ($product_option_image->image)?$product_option_image->image:'';
                }
                $combination = $this->CI->User_catalog_model->get_column_value('product_option_value', 'product_option_value_id', $product_option_value_id, 'combination');
                $product_option_price = isset($product_option_price->price) ? $product_option_price->price : 0;

                $product_option_sku = $this->CI->User_catalog_model->get_column_value('product_option_value', 'product_option_value_id', $product_option_value_id, 'sku');
                $product_option_sku = isset($product_option_sku->sku) ? $product_option_sku->sku : 0;
                if(!$options && isset($combination->combination))
                    {
                        $options = json_decode($combination->combination,true);

                    }
            }

        } else {
            $options = array();
        }

        // pre($item['options']);
        // if ($options) 
        // {
        //     if (!$product_option_value_id) 
        //     {
        //         $redirect_url = href_product($product_info);
        //         $json['message'] = 'Please select variant';
        //         $this->CI->user_session->set_flashdata('error', $json['message']);

        //         return (object)array('error'=>true, 'message'=>'Please select variant', 'data'=>$redirect_url);
        //     }
        // }

        $special_price = get_product_special_price($product_id);
        $product_info->price = get_current_price($product_id);
        
        // dd($this->CI->db->last_query());
        $product_cur_qty = 0;
		if($options && !$product_option_value_id)
		{
			$p = get_product_varient_price($product_id);
			if(isset($p->price) && $p->price)
			{
				$price = $p->price;
				$product_option_value_id = $p->product_option_value_id;
			}
        }


        if($product_option_value_id != '' ){
            $row = $this->CI->User_catalog_model->get_product_option($product_id, $product_option_value_id);

            $product_option_price = $row['final_price'];
            $product_info->price = $row['final_price'];
        }
		

        if($product_option_value_id != '' && $product_option_sku != ''){

            $product_info->sku = $product_option_sku;
        }
        if ($options) 
        {
            $curr_qty = get_current_qty($product_info->product_id,$product_option_sku);
                    }else{
            $curr_qty = get_current_qty($product_info->product_id);
        }
        $product_cur_qty = $curr_qty;


        //here check config_catalog_purchase
        $config_catalog_purchase = $this->CI->db->where('key','config_catalog_purchase')->get('ci_settings')->row();
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
            if($quantity > $product_cur_qty)
    		{

                $redirect_url = href_product($product_info);

                $json['message'] = 'Product quantity greater then product available quantity';
                // $this->CI->user_session->set_flashdata('error', $json['message']);

                return (object)array('error'=>true, 'message'=>'Product quantity greater then product available quantity', 'data'=>$redirect_url);
            }
        }
		if(json_decode($product_info->option_name,true))
		{
			$p =  get_product_varient_price($product_info->product_id);
			if(!$p)
			{
				$redirect_url = href_product($product_info);

            $json['message'] = 'Product quantity greater then product available quantity';
            // $this->CI->user_session->set_flashdata('error', $json['message']);

            return (object)array('error'=>true, 'message'=>'Product quantity greater then product available quantity', 'data'=>$redirect_url);
			}
			
		} 

        // ADDING OR UPDATING THE QUANTITY IN CART
        
        $cart[$product_info->sku] = array(
            'product_id'    => $product_id,
            'variant_id'      => $product_option_value_id,
            'quantity'      => $quantity,
            'price'         => $product_info->price,
            'cut_price'     => $cut_price,
            'options'       => $options,
            'product_option_value_id'       => $product_option_value_id,
            'product_option_value_img'       => $product_option_image,
            'available_qty' => $product_cur_qty,
            'tax_class_id'  =>  $product_info->tax_class_id,
            'sku' => isset($product_info->sku) ? $product_info->sku : 0
        );
        return $cart;
    }

    public function confirm()
    {
        $result     = array();
        $checkout= (object)$this->CI->user_session->userdata('checkout') ? $this->CI->user_session->userdata('checkout') : array();

        $temp = array();
        foreach ($checkout->totals as $key => $v) {
            // $v->total = 0;
            $temp[$v->sort_order] = $v;
        }
        ksort($temp);
        $checkout->totals = $temp;
        // echo'confirm lib';pre($temp);
        
        $shipping_address_id = isset($checkout->shipping_address) ? $checkout->shipping_address : '';
        $shipping_address = $this->CI->User_address_model->get_address($shipping_address_id);
        $state_id = !empty($shipping_address) ? $shipping_address->region_id : false;

        $this->CI->tax->set_shipping_address($shipping_address->country_id,$state_id);
        $this->CI->tax->set_payment_address($shipping_address->country_id,$state_id);

        // echo'set_address<pre>';print_r($checkout);die;


        $cart_items = $this->cart_items();
        $result['products'] = $cart_items['products'];

        $_total= array();
        foreach($checkout->totals as $k=>$v)
        {
            $_total[$v->code] = $this->{"total_module_$v->code"}($v);
        }
        $result['totals'] = $_total;
        // pre($checkout->totals);

        return $result;
    }
    // Total calculation
    public function total_module_sub_total($v)
    {
        $this->totals += $v->value;

        $return = (object)array('title' =>'Sub-Total', 'amount' => $v->value);
        return $return;
    }

    public function total_module_tax($v)
    {
        $checkout= (object)$this->CI->user_session->userdata('checkout') ? $this->CI->user_session->userdata('checkout') : array();
        $taxes = $this->CI->tax->getTaxes();

        $ttax = array();
        $ttax2 = array();
        $total_tax = 0;
        if(!empty($taxes)) {
            $count = 0;
            foreach ($taxes as $key => $val) {
                $ttax[$key]['name'] = $this->CI->tax->get_tax_name($key);
                $ttax[$key]['price'] = $val;

                $ttax2[$key]['code']    =  preg_replace('~[^-\w]+~', '',strtolower($this->CI->tax->get_tax_name($key)));;
                $ttax2[$key]['title']   = $this->CI->tax->get_tax_name($key);
                $ttax2[$key]['value']   = $val;
                $ttax2[$key]['sort_order'] = $count;

                $total_tax += $val;

                $count++;
            }
        }

        foreach($checkout->totals as $k=>$v)
        {
            if ($v->code =='tax') 
            {
                $v->value = $total_tax;
            }
        }
        $this->totals += $total_tax;
        
        $return = (object)array('title'=> 'Taxes','amount' => $ttax,'totals_tax'=> $total_tax);

        return $return;
    }

    public function total_module_shipping($v)
    {
        $checkout= (object)$this->CI->user_session->userdata('checkout') ? $this->CI->user_session->userdata('checkout') : array();
        $cart_items = $this->cart_items();

        $sub_total = $cart_items['sub_total'];
        $total_quantity = $cart_items['total_quantity'];

        $shipping_methods = $this->CI->User_setting_model->get_shipping_methods();

        if(isset($checkout->shipping_method)) 
        {
            $shipping_cost = $shipping_methods[$checkout->shipping_method]['cost'];

            if($checkout->shipping_method == 'item')
            {
                $shipping_cost =  $shipping_cost * $total_quantity;
            }

        }else{
            $shipping_cost = '';
        }
        foreach($checkout->totals as $k=>$v)
        {
            if ($v->code =='shipping') 
            {
                $v->value = $shipping_cost;
            }
        }

        $this->totals += intval($shipping_cost);
        $return = (object)array('title' => 'Shipping Cost','amount' => $shipping_cost);

        return $return; 
    }

    public function total_module_discount($v)
    {
        $checkout = (object)$this->CI->user_session->userdata('checkout') ? $this->CI->user_session->userdata('checkout') : array();

        foreach($checkout->totals as $k=>$v)
        {
            if ($v->code =='discount') 
            {
                $discount= $v->value;
            }
        }

        $this->totals += $discount;
        $return = (object)array('title' => 'Discount','amount' => $discount);
        
        return $return;
    }

    public function total_module_total($v)
    {
        $checkout= (object)$this->CI->user_session->userdata('checkout') ? $this->CI->user_session->userdata('checkout') : array();
        $total_order = $this->CI->User_setting_model->get_setting('total');
       
        $lastIndex = end($checkout->totals);
        if ($lastIndex->code == 'total') 
        {
            $lastIndex->value = $this->totals;
        }

        $return = (object)array('title' => 'Total','amount' => $this->totals);
        return $return;
    }
    // End Total calculation
    public function cart_items()
    {

        $cart_items = (object)$this->CI->user_session->userdata('cart') ? $this->CI->user_session->userdata('cart') : array();
        
        $products = array();
        $total_quantity = $sub_total = 0;

        foreach ($cart_items as $item) 
        {
            $product_id =  $item['product_id'];

            $product_info = $this->CI->User_catalog_model->get_product($product_id);


            $product_info->images = get_product_images($product_id);

            if (!empty($product_info->images) && count($product_info->images) > 0) {
                $image = $product_info->images;
            } else {
                $image = base_url($this->CI->site_config->item('config_placeholder_small'));
            }

            if($item['price'] >0){
                $price = $item['price'];
            }else {
                $special_price = get_product_special_price($product_id);
                $price = $special_price > 0 ? $special_price : $product_info->sale_price;
            }

            $options = $item['options'];
            $product_options = '';

            if(count($options) >0) {
                foreach ($options as $key => $value) {

                    if ($key != 'product_option_value_id')
                        $product_options .= $key . ":" . $value . " ";

                }
                $product_name =  $product_info->product_name .' ('.$product_options . ')';
            }else{
                $product_name =  $product_info->product_name;

            }

            $item_total = $price * $item['quantity'];


            $products[] = (object)array(
                'product_id' => $product_info->product_id,
                'image' => $image,
                'product_name' => !empty($product_name) ? $product_name : '',
                'sku' => $product_info->sku,
                'quantity' => $item['quantity'],
                'unite_price' => format_currency(round($price,2)),
                'total' => format_currency(round($item_total,2)),
            );

            $sub_total += $item_total;

            $total_quantity +=  $item['quantity'];
        }

        $return['products']         = $products;
        $return['total_quantity']   = $total_quantity;
        $return['sub_total']        = $sub_total;

        return $return;
    }
    
    public function save_order($customer_id = 0)
    {
        $checkout = $this->CI->user_session->userdata('checkout');
        $coupon = $this->CI->user_session->userdata('coupon');
		if(isset($checkout->onepage) && $checkout->onepage)
		{
			$shipping = (object)$checkout->address;
			$billing = (object)$checkout->address;
			if(!$customer_id)
			{
				$customer = (object)$checkout->address;
			}
			else{
				$customer   = $this->CI->Customer_model->get_by_id($customer_id);
			}
			if(isset($billing->phone))
			$customer->phone = $billing->phone;
            if(isset($billing->email) && $billing->email)
            $customer->email = $billing->email;
		}
		else{
			$customer   = $this->CI->Customer_model->get_by_id($customer_id);
        $shipping   = $this->CI->User_address_model->get_address($checkout->shipping_address);
        $billing    = $this->CI->User_address_model->get_address($checkout->billing_address);
		}

        // echo'<pre>';print_r($checkout);die;

        $now = date('Y-m-d H:i:s');
        
        $order = array();
        
        $order['order_id'] = false;
        $order['customer_id'] = $customer_id;
        //customer
        $order['first_name']    = $customer->first_name;
        $order['last_name']     = $customer->last_name;
        $order['email']         = (isset($customer->email)?$customer->email:'');
        $order['telephone']     = $customer->phone;

        //shipping
        $order['shipping_first_name']    = $shipping->first_name;
        $order['shipping_last_name']     = $shipping->last_name;
        $order['shipping_company']       = (isset($shipping->company))?$shipping->company:'';
        $order['shipping_address_1']     = $shipping->address_1;
        $order['shipping_address_2']     = (isset($shipping->address_2))?$shipping->address_2:$shipping->address_1;
        $order['shipping_city']          = (isset($shipping->city))?$shipping->city:'';
        $order['shipping_postcode']      = (isset($shipping->postcode))?$shipping->postcode:'';
        $order['shipping_country']       = (isset($shipping->country_name))?$shipping->country_name:'';
        $order['shipping_country_id']    = (isset($shipping->country_id))?$shipping->country_id:'';
        $order['shipping_zone']          = (isset($shipping->region_name))?$shipping->region_name:'';
        $order['shipping_zone_id']       = (isset($shipping->region_id))?$shipping->region_id:'';

        $order['shipping_method']        = (isset($checkout->shipping_method))?$checkout->shipping_method:'';
        $order['shipping_code']          = (isset($checkout->shipping_code))?$checkout->shipping_code:'';
        
        
        
        //billing
        $order['payment_first_name']    = (isset($billing->first_name))?$billing->first_name:'';
        $order['payment_last_name']     = (isset($billing->last_name))?$billing->last_name:'';
        $order['payment_company']       = (isset($billing->company))? $billing->company:''; 
        $order['payment_address_1']     = (isset($billing->address_1))?$billing->address_1:'';
        $order['payment_address_2']     = (isset($billing->address_2))?$billing->address_2:'';
        $order['payment_city']          = (isset($billing->city))?$billing->city:'';
        $order['payment_postcode']      = (isset($billing->postcode))?$billing->postcode:'';
        $order['payment_country']       = (isset($billing->country_name))?$billing->country_name:'';
        $order['payment_country_id']    = (isset($billing->country_id))?$billing->country_id:'';
        $order['payment_zone']          = (isset($billing->region_name))?$billing->region_name:'';
        $order['payment_zone_id']       = (isset($billing->region_id))?$billing->region_id:'';
        
        //payment
        $order['payment_method']        = $checkout->payment_method;
        $order['payment_code']          = $checkout->payment_method;
        
        $order['order_note']          = $checkout->note;

        //totals
        $order['total']     = end($checkout->totals)->value;
        
        $order['date_added']= $now;
        
        $order_info = (object)array('order'=>$order, 'products'=>$checkout->items, 'totals'=>$checkout->totals,'coupon'=>$coupon);
         // echo'save order lib';pre($order_info);
		 // die();
		 $this->CI->load->model('user/custom/User_order_model');
        $order_id = $this->CI->User_order_model->save($order_info);
        
        return $order_id;
    }

    public function payment_method($type,$customer_id)
    {
        if ($type == 'cod'):
            $this->cash_on_delivery($customer_id);
        elseif($type == 'paypal'):
            $this->paypayl_payment($customer_id);
        elseif($type == 'jazzcash'):
            $this->jazzcash_payment($customer_id);
        elseif($type == 'stripe'):
            $this->stripe_payment($customer_id);
        endif;
    }

    public function cash_on_delivery($customer_id)
    {
        // Do your stuff with success result.
        $order_id= $this->CI->user_session->userdata('order_id');
        $checkout= (object)$this->CI->user_session->userdata('checkout');


        $order_status_id = $this->CI->site_config->item('cod_order_status_id');

        $order_status_id = $order_status_id > 0 ? $order_status_id : 1;
        
        $params = array(
            'order_id'          => $order_id,
            'order_status_id'   => $order_status_id,
            'payment_status_id' => $order_status_id,
        );
 
        $this->CI->User_order_model->update($params);

        $coupon['is_used'] = 1;
        $this->CI->User_order_model->order_coupon($order_id, $coupon);

        //update product quantity

        $this->update_product_quantity();



        $this->send_order_email($order_id,$customer_id);
        if(isset($checkout->onepage) && $checkout->onepage)
        {
            redirect(site_url('guest/order-success.html?order_id='.$order_id.'&customer_id='.$customer_id));

        }
        else
        {
            redirect(site_url('checkout/order-success.html?order_id='.$order_id.'&customer_id='.$customer_id));

        }
        // redirect(site_url('checkout/order-success.html'));
    }

    public function stripe_payment($customer_id)
    {

    }

    private function paypayl_payment($customer_id)
    {
        $order = $this->get_order_details($this->CI->user_session->userdata('order_id'));
        // echo "create_paypal_cart<pre>";print_r($order);exit;
        $this->CI->load->library('Paypal_Express');
        
        $return_url = site_url('checkout/process-payment.html');
        $cancel_url = site_url('checkout/confirm.html');
        $notify_url = site_url('checkout/callback-payment.html');

        
        $nvp_dt = array();
        $item_total = 0;
        $AMT = $ITEMAMT = $SHIPPINGAMT =  $TAXAMT = $SUB_TOTAL = $COUPON_DISCAMT = $MEMBERSHIP_DISCAMT = 0;
        foreach($order->products as $k=>$v)
        {
            $L_NAME     = urlencode(substr($v->product_name, 0, 125));
            $L_AMT      = round($v->unit_price,2);
            $L_QTY      = $v->quantity;
            $L_NUMBER   = $v->sku;
            $dash_flag = $name_flag = strlen($L_NAME) > 0 ? true : false;
            $dash_flag = strlen($L_NUMBER) > 0 ? true : false;
            $L_DESC =  $dash_flag ? $L_NAME .'/'. $L_NUMBER :  ($name_flag ? $L_NAME :  $L_NUMBER);

            if (strlen($L_DESC) > 127)
                $L_DESC = substr($description, 0, 120);
            
            $ITEMAMT += round($v->unit_price,2) * $v->quantity;
            // $item_total += $v->total;
            
            $nvp_dt[] = 'L_NAME'.$k.'='.$L_NAME.'&L_DESC'.$k.'='.$L_DESC.'&L_AMT'.$k.'='.$L_AMT.'&L_QTY'.$k.'='.$L_QTY.'&L_NUMBER'.$k.'='.$L_NUMBER;
        }

        foreach ($order->totals as $total)
        {
            if($total->code == 'sub_total')
            {
                $SUB_TOTAL = round($total->value,2);
            }

            if($total->code == 'ecotax-200' 
                || $total->code == 'vat20'
                || $total->code == 'tax')
            {
                $TAXAMT += round($total->value,2);
            }

            if($total->code == 'shipping')
            {
                $SHIPPINGAMT = round($total->value,2);
            }

            if($total->code == 'discount')
            {
                $COUPON_DISCAMT = round($total->value,2);
            }
        }

        if ($nvp_dt && $COUPON_DISCAMT) 
        {
            $k++;
            $nvp_dt[] ='L_NAME'.$k.'=Discount&L_DESC'.$k.'=Discount coupon applied&L_AMT'.$k.'='.$COUPON_DISCAMT.'&L_QTY'.$k.'=1'; 

            $SUB_TOTAL  += $COUPON_DISCAMT;
            $ITEMAMT    += $COUPON_DISCAMT;
        }
        // pre($SHIPPINGAMT);
        $AMT = $SUB_TOTAL + $SHIPPINGAMT + $TAXAMT;
        
        
        $nvp_items = '';
        $nvp_items .= implode('&', $nvp_dt);
        $nvp_items .= '&NOSHIPPING=1&AMT='.(string)$AMT."&ITEMAMT=".(string)$ITEMAMT.'&TAXAMT='.(string)$TAXAMT.'&SHIPPINGAMT='.(string)$SHIPPINGAMT;
        $nvp_items .= '&ReturnUrl='.$return_url.'&CancelUrl='.$cancel_url.'&NotifyUrl='.$notify_url;
        $nvp_items .= '&PAYMENTACTION=SALE&DESC='.$customer_id.'&CUSTOM='.(string)$order->order_id;//$customer_id
        // pre($nvp_items);
        
        $result = $this->CI->paypal_express->process_payment($nvp_items, $order);
        
        // echo'<pre>';print_r($result);die('HERE');
        
        if($result->error)
        {
            $this->CI->user_session->set_flashdata('error', $result->message);
            redirect(site_url('checkout/confirm.html'));
        }

        $order_id = $order->order_id;

        $params = array(
            'order_status_id'   => 1,
            'payment_status_id' => 1, 
        );
        $this->CI->User_checkout_model->update_order_status($params, $order_id); 
        
        redirect($result->redirect);
    }
    private function get_jazzcash_detail()
    {
        $this->CI->db->where('code', 'jazzcash');
        $result = $this->CI->db->get('settings')->result();
        
        return $result; 
    }

    private function jazzcash_payment($customer_id)
    {
        
        $order = $this->get_order_details($this->CI->user_session->userdata('order_id'));
       $amount = $order->total;
       $jazzcash = $this->get_jazzcash_detail();
        $jz = array();
        foreach($jazzcash as $k=> $v)
        {
            $jz[$v->key] = $v->value;
        }
        $jazzcash = $jz;
        $type = 'live';
                                $post_url = 'https://payments.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform';
                                if($jazzcash['sandbox_mode'])
                                {
                                    $type = 'sandbox';
                                    $post_url = 'https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/';
                                }
        $pp_Amount = $amount * 100;

$MerchantID = $jazzcash[$type.'_username']; //Your Merchant from transaction Credentials
$Password = $jazzcash[$type.'_password']; //Your Password from transaction Credentials
$HashKey = $jazzcash[$type.'_api_signature']; //Your HashKey/integrity salt from transaction Credentials
$ReturnURL = $jazzcash[$type.'_return_url']; //Your Return URL, It must be static


date_default_timezone_set("Asia/karachi");

$Amount = $pp_Amount; //Last two digits will be considered as Decimal thats the reason we are multiplying amount with 100 in line number 11
$BillReference = "billRef".time(); //use AlphaNumeric only
$Description = "Product test description"; //use AlphaNumeric only
$IsRegisteredCustomer = "No"; // do not change it
$Language = 'EN'; // do not change it
$TxnCurrency = 'PKR'; // do not change it
$TxnDateTime = date('YmdHis');
$TxnExpiryDateTime = date('YmdHis', strtotime('+1 Days'));
$TxnRefNumber = 'EHB'.date('YmdHis') . mt_rand(10, 100);
$TxnType = ""; // Leave it empty
$Version = '2.0';
$SubMerchantID = ""; // Leave it empty
$BankID = ""; // Leave it empty
$ProductID = ""; // Leave it empty
$ppmpf_1 = $order->order_id; // use to store extra details (use AlphaNumeric only)
$ppmpf_2 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_3 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_4 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_5 = ""; // use to store extra details (use AlphaNumeric only)

//========================================Hash Array for making Secure Hash for API call================================
$HashArray = [$Amount, $BankID, $BillReference, $Description, $IsRegisteredCustomer,
    $Language, $MerchantID, $Password, $ProductID, $ReturnURL, $TxnCurrency, $TxnDateTime,
    $TxnExpiryDateTime, $TxnRefNumber, $TxnType, $Version, $ppmpf_1, $ppmpf_2, $ppmpf_3,
    $ppmpf_4, $ppmpf_5];

$SortedArray = $HashKey;
for ($i = 0; $i < count($HashArray); $i++) {
    if ($HashArray[$i] != 'undefined' and $HashArray[$i] != null and $HashArray[$i] != "") {
        $SortedArray .= "&" . $HashArray[$i];
    }
}
$Securehash = hash_hmac('sha256', $SortedArray, $HashKey);
$fields = array(
        'pp_BillReference'=> $BillReference,
        'pp_TxnDateTime'=> $TxnDateTime,
        'pp_TxnExpiryDateTime'=> $TxnExpiryDateTime,
        'TxnRefNumber'=> $TxnRefNumber,
        'pp_SecureHash'=> $Securehash,
        'pp_Amount'=> $Amount,
        'ppmpf_1'=> $ppmpf_1,
);

        $order_id = $order->order_id;

        ajax_response(array('error'=>false,'fields'=>$fields ));
    }

    public function update_product_quantity()
    {

        $cart_items = $this->CI->user_session->userdata('cart') ? $this->CI->user_session->userdata('cart') : array();

        foreach ($cart_items as $item) {
            $quantity = $item['available_qty'] -  $item['quantity'];
            if($item['product_option_value_id'] > 0)
                $has_options = $item['product_option_value_id'];
            else
                $has_options = 0;

            $this->CI->User_checkout_model->update_quantity($item['product_id'],$item['sku'] ,$quantity, $has_options);
        }
    }

    public function send_order_email($order_id, $customer_id)
    {
        $user = $this->CI->Customer_model->get_by_id($customer_id);

        $order = $this->get_order_details($order_id);
        if(empty($order))
        {
            return FALSE;
        }
        
        $message = $this->CI->view_email($this->CI->user_view.'/emails/email_order_submit', array('order'=>$order), TRUE);
        $subject = site_config_item('config_name').' - Your order number '.$order_id;

        $this->CI->load->model('Email_model');
        $e_1 = $this->CI->Email_model->do_email($order->email,$subject, $message);

        // additional emails
        $additional_emails = site_config_item('config_alert_emails');
        $arr_emails = explode(',', $additional_emails);
        $arr_emails = array_map('trim', $arr_emails);
        foreach($arr_emails as $k=> $em)
        $e_1 = $this->CI->Email_model->do_email($em,$subject . ' - ADMIN', $message);
    }

    public function get_order_details($order_id)
    {
        $order              = $this->CI->User_checkout_model->get_order($order_id);
        $order->products    = $this->CI->User_checkout_model->get_order_products($order_id);
        $order->totals      = $this->CI->User_checkout_model->get_order_totals($order_id);
        $order->history     = $this->CI->User_checkout_model->get_order_history($order_id);
        return $order;
    }
}
