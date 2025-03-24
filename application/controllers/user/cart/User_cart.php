<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_cart extends User_Public_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->model(array(
			'user/catalog/User_catalog_model',
			'user/custom/User_address_model',
			'user/common/User_setting_model',
			'user/checkout/User_checkout_model',
		));

		$this->controller_name = 'user_cart';
		$this->controller_dir = 'cart';
		$this->view_dir = 'checkout';
		$this->disable_checkout = site_config_item('config_catalog_disable_checkout');
		$this->coupon_code = site_config_item('config_checkout_coupon_code');
		$this->load->library('Auth_user');
	}
	
	function index()
	{
		$this->cart();
	}
	public function update_checkout()
	{
		$cart 		= $this->user_session->userdata('cart');
		$checkout 	= (object)$this->user_session->userdata('checkout');
		$coupon 	= (object)$this->user_session->userdata('coupon')? $this->user_session->userdata('coupon') : array();
		// var_dump($cart);die;
		$data['meta_title']			= 'Cart';		$data['meta_keywords']		= 'Cart';		$data['meta_description']	= 'Cart';				$data['page_title']		= 'Cart';		$data['page_header']	= 'Cart';		$data['title']			= 'Cart';
		$data['result'] = false;
		$data['totals'] = false;

		$products 		= array();
		$grand_total 	= 0;
		$sub_total 		= 0;
		$total_tax 		=0;
		$discount 		=0;
		$ttax		= 0;
		
		if(!isset($cart->error))
		{
			$r = array();
			// echo'<pre>';print_r($cart);die;
			if (isset($cart)) {
				foreach($cart as $k=>$v)
				{
					$dt = $this->User_catalog_model->get_product($v['product_id']);
					// echo'<pre>';print_r($dt);die;
					if (!empty($dt->images) && count($dt->images) > 0) {
	                    $image = base_url('images/products/medium/'.$dt->images[0]);
	                } else {
	                    $image = base_url($this->site_config->item('config_placeholder_small'));
	                }
					
					$item_total = $v['price'] * $v['quantity'];
					if($dt->special_price):
						$dt->unit_price 			= $dt->special_price;
					else:
						$dt->unit_price 			= $dt->sale_price;
					endif;
					$dt->quantity 				= $v['quantity'];
					$dt->total 					= $dt->unit_price * $dt->quantity;
					$dt->short_description 		= '';
					$dt->long_description 		= '';
					$dt->content_description 	= '';
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
	                    'unite_price' => format_currency(round($v['price'], 2)),
	                    'unite_price_simple' => round($v['price'], 2),
	                    'total' => format_currency(round($item_total, 2)),
	                );
					
					$r[] = $dt;

					$sub_total += $item_total;
				}
			}
			
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
		$tax_order = $this->User_setting_model->get_setting('tax');
		$discount_order = $this->User_setting_model->get_setting('discount');
		$total_order = $this->User_setting_model->get_setting('total');
		$grand_total = $sub_total - abs($discount);

		$data['totals']['sub_total'] 	= (object)array('code'=>'sub_total', 'title'=>'Sub Total', 'value'=>$sub_total, 'sort_order'=> $subTotal_order->value, );
		$data['totals']['shipping'] 	= (object)array('code'=>'shipping', 'title'=>'Shipping', 'value'=>0, 'sort_order'=>$shipp_order->value, );
		$data['totals']['tax'] 			= (object)array('code'=>'tax', 'title'=>'Tax', 'value'=>0, 'sort_order'=>$tax_order->value, );
		$data['totals']['discount'] 	= (object)array('code'=>'discount', 'title'=>'Discount', 'value'=>$discount, 'sort_order'=>$discount_order->value);
		$data['totals']['total'] 		= (object)array('code'=>'total', 'title'=>'Total', 'value'=>$grand_total, 'sort_order'=>$total_order->value, );
		
		$checkout = (object)$this->user_session->userdata('checkout');
		$checkout->items 		= $data['result'];
		$checkout->totals 		= $data['totals'];
		$checkout->total_tax 	= $total_tax;
		$checkout->ttax 		= $ttax;

		$this->user_session->set_userdata('checkout', $checkout);
	}

	public function cart()
	{

		$cart 		= $this->user_session->userdata('cart');
		$checkout 	= (object)$this->user_session->userdata('checkout');
		$coupon 	= (object)$this->user_session->userdata('coupon')? $this->user_session->userdata('coupon') : array();
		if(isset($checkout->note) && $checkout->note)
		{
			$data['note'] = $checkout->note;
		}
		$data['meta_title']			= 'Cart';		$data['meta_keywords']		= 'Cart';		$data['meta_description']	= 'Cart';				$data['page_title']		= 'Cart';		$data['page_header']	= 'Cart';		$data['title']			= 'Cart';
		$data['result'] = false;
		$data['totals'] = false;

		$products 		= array();
		$grand_total 	= 0;
		$sub_total 		= 0;
		$total_tax 		=0;
		$discount 		=0;
		$ttax		= 0;
		
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

						$img = live_img_url().'images/products/medium/'.$v['product_option_value_img'];
						 $image = base_url($img);
						 // dd($img);
					}
					elseif (!empty($dt->images) && count($dt->images) > 0) {
	                    $image = live_img_url().'images/products/medium/'.$dt->images[0];
	                } else {
	                    $image = live_img_url().$this->site_config->item('config_placeholder_small');
	                }
					
					$item_total = $v['price'] * $v['quantity'];
					if($dt->special_price):
						$dt->unit_price 			= $dt->special_price;
					else:
						$dt->unit_price 			= $dt->sale_price;
					endif;
					$dt->quantity 				= $v['quantity'];
					$dt->total 					= $dt->unit_price * $dt->quantity;
					$dt->short_description 		= '';
					$dt->long_description 		= '';
					$dt->content_description 	= '';
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
		$tax_order = $this->User_setting_model->get_setting('tax');
		$discount_order = $this->User_setting_model->get_setting('discount');
		$total_order = $this->User_setting_model->get_setting('total');
		$grand_total = $sub_total - abs($discount);

		$data['totals']['sub_total'] 	= (object)array('code'=>'sub_total', 'title'=>'Sub Total', 'value'=>$sub_total, 'sort_order'=> $subTotal_order->value, );
		$data['totals']['shipping'] 	= (object)array('code'=>'shipping', 'title'=>'Shipping', 'value'=>0, 'sort_order'=>$shipp_order->value, );
		$data['totals']['tax'] 			= (object)array('code'=>'tax', 'title'=>'Tax', 'value'=>0, 'sort_order'=>$tax_order->value, );
		$data['totals']['discount'] 	= (object)array('code'=>'discount', 'title'=>'Discount', 'value'=>$discount, 'sort_order'=>$discount_order->value);
		$data['totals']['total'] 		= (object)array('code'=>'total', 'title'=>'Total', 'value'=>$grand_total, 'sort_order'=>$total_order->value, );
		
		$checkout = (object)$this->user_session->userdata('checkout');
		$checkout->items 		= $data['result'];
		$checkout->totals 		= $data['totals'];
		$checkout->total_tax 	= $total_tax;
		$checkout->ttax 		= $ttax;

		$this->user_session->set_userdata('checkout', $checkout);

		
		$data['products'] 		= $products;
		$data['ttax'] 			= $ttax;
		$data['discount'] 		= format_currency(round($discount,2));
        $data['total_tax'] 		= $total_tax;
        $data['sub_total'] 		= format_currency(round($sub_total,2));
        $data['grand_total'] 		= format_currency(round($grand_total,2));
		$data['total_price'] 	= format_currency(round(($grand_total+$discount),2));
		// echo "cart";pre($data);

		$this->view($this->user_view .'/'. $this->view_dir .'/cart', $data);
	}
 
	public function top_srch()
	{

		$str = $this->input->get('srch');
		// is_ajax();
		
		$term = $this->input->post();
		
		$result	= $this->User_catalog_model->srch_pros($str);
		
		if(!$result)
		{
			echo 'Item not found';
			exit();
		}
			$data = array();
			$data['products'] = $result;

		
		$this->load->view($this->user_view .'/'. $this->view_dir .'/srch_pro',$data);


	}
	public function load_cart($type=0)
	{
		$cart 		= $this->user_session->userdata('cart');
		$checkout 	= (object)$this->user_session->userdata('checkout');
		$coupon 	= (object)$this->user_session->userdata('coupon')? $this->user_session->userdata('coupon') : array();
		// var_dump($cart);die;
		
		$data['result'] = false;
		$data['totals'] = false;

		$products 		= array();
		$grand_total 	= 0;
		$sub_total 		= 0;
		$total_tax 		=0;
		$discount 		=0;
		$ttax		= 0;
		
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

						$image = live_img_url().'images/products/medium/'.$v['product_option_value_img'];
					}
					else if (!empty($dt->images) && count($dt->images) > 0) {
	                    $image = live_img_url().'images/products/medium/'.$dt->images[0];
	                } else {
	                    $image = base_url($this->site_config->item('config_placeholder_small'));
	                }
					
					$item_total = $v['price'] * $v['quantity'];
					if($dt->special_price):
						$dt->unit_price 			= $dt->special_price;
					else:
						$dt->unit_price 			= $dt->sale_price;
					endif;
					$dt->quantity 				= $v['quantity'];
					$dt->total 					= $dt->unit_price * $dt->quantity;
					$dt->short_description 		= '';
					$dt->long_description 		= '';
					$dt->content_description 	= '';
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
	                    'cut_price' => $v['cut_price'] * $v['quantity'],
	                    'unite_price' => format_currency(round($v['price'], 2)),
	                    'total' => round($item_total, 2),
	                );
					
					$r[] = $dt;

					$sub_total += $item_total;
				}
			}
			
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
		$tax_order = $this->User_setting_model->get_setting('tax');
		$discount_order = $this->User_setting_model->get_setting('discount');
		$total_order = $this->User_setting_model->get_setting('total');

		$data['totals']['sub_total'] 	= (object)array('code'=>'sub_total', 'title'=>'Sub Total', 'value'=>$sub_total, 'sort_order'=> $subTotal_order->value, );
		$data['totals']['shipping'] 	= (object)array('code'=>'shipping', 'title'=>'Shipping', 'value'=>0, 'sort_order'=>$shipp_order->value, );
		$data['totals']['tax'] 			= (object)array('code'=>'tax', 'title'=>'Tax', 'value'=>0, 'sort_order'=>$tax_order->value, );
		$data['totals']['discount'] 	= (object)array('code'=>'discount', 'title'=>'Discount', 'value'=>$discount, 'sort_order'=>$discount_order->value);
		$data['totals']['total'] 		= (object)array('code'=>'total', 'title'=>'Total', 'value'=>$grand_total, 'sort_order'=>$total_order->value, );
		
		$checkout = (object)$this->user_session->userdata('checkout');
		$checkout->items 		= $data['result'];
		$checkout->totals 		= $data['totals'];
		$checkout->total_tax 	= $total_tax;
		$checkout->ttax 		= $ttax;
		$this->user_session->set_userdata('checkout', $checkout);

		
		$data['products'] 		= $products;
		$data['ttax'] 			= $ttax;
		$data['discount'] 		= format_currency(round($discount,2));
        $data['total_tax'] 		= $total_tax;
        $data['sub_total'] 		= format_currency(round($sub_total,2));
		$data['total_price'] 	= format_currency(round(($grand_total+$discount),2));
		if($type)
		{
			return $this->load->view($this->user_view .'/'. $this->view_dir .'/side_cart',$data,TRUE);

		}
		else
		{
			$this->load->view($this->user_view .'/'. $this->view_dir .'/side_cart',$data);
		}
	}
	public function add_to_cart()
	{
		$ret = array('status'=>0,'html'=>'','msg'=>'Invalid request');
		if($this->input->post())
		{
			$item = $this->input->post('item');
			$d = $this->cart_lib->add($item);
			$cart 		= $this->user_session->userdata('cart');
			if($d->error)
			{
				$ret['status'] = 0;
				$ret['msg'] = $d->message;
			}
			else
			{
				$this->update_checkout();
				echo $this->cart_count().'=@@';
				echo $html = $this->load_cart(1);
				exit();
			}
			
		}
		echo json_encode($ret);
		exit();
	}

	public function update_cart()
	{
		if($this->input->post())
		{
			$item = $this->input->post('item');
			$ajax = $this->input->post('ajax');
			// die('Hreere');
			$d = $this->cart_lib->update($item);

			$coupon 	= (object)$this->user_session->userdata('coupon')? $this->user_session->userdata('coupon') : array();
			if($d->error)
			{
				if($ajax)
				{
					$cart= $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();
					$ret = array('status'=>0,'msg'=>$d->message,'data'=>$cart,'coupon'=>$coupon);					
					echo json_encode($ret);
					exit();
				}
				$this->user_session->set_flashdata('error', $d->message);
				redirect(site_url('checkout/cart.html'));
			}
			$this->update_checkout();
			if($ajax)
				{
					$cart= $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();
					$ret = array('status'=>1,'msg'=>$d->message,'data'=>$cart,'coupon'=>$coupon);					
					echo json_encode($ret);
					exit();
				}

			$this->user_session->set_flashdata('message', $d->message);
			redirect(site_url('checkout/cart.html'));
		}
	}
	private function cart_count()
	{
		$cart 		= $this->user_session->userdata('cart');
		return (count($cart))?count($cart):'';
	}

	public function remove_cart()
	{
		$ret = array('status'=>0,'html'=>'','msg'=>'Invalid request');
		if($this->input->post())
		{
			$item = $this->input->post('item');
			$product_id = $item['product_id'];
			$product_option_value_id = $item['product_option_value_id'];
			$d = $this->cart_lib->remove($product_id,$product_option_value_id);
			if($d->error)
			{
				$ret['status'] = 0;
				$ret['msg'] = $d->message;
			}
			else
			{
				$this->update_checkout();
				echo $this->cart_count().'=@@';
				echo $html = $this->load_cart(1);
				exit();
			}
		}
		echo json_encode($ret);
		exit();
	}

	function get_variant_details()
    {

        $json = array();
        $variant_id = '';
        $variant_price = 0.00;
        $variant_qty = 0;

        $json['success']  = false;
        $json['variant_id'] = $variant_id;
        $json['variant_price'] = $variant_price;
        $json['variant_qty'] = 0;


        $product_id = $this->input->post('product_id');
		$dt = $this->User_catalog_model->get_product($product_id);
		$imgs = get_product_images($product_id);
        $variations = $this->input->post('item');
        $variants_resp = $this->User_catalog_model->get_product_variants_detail($product_id,(isset($variations['options'])?$variations['options']:array()));
        // dd($variants_resp);

        // echo '<pre>';
        // print_r($dt->sale_price);
        // die();

        if(isset($variants_resp)){
            if($variants_resp['variant_id'] != '')
            {
				$variants_resp['variant_price'] = (float) $variants_resp['variant_price'];

                $variant_price =  ($variants_resp['variant_price'])?$variants_resp['variant_price']:$dt->sale_price;
                $price_html =  ($variants_resp['price_html'])?$variants_resp['price_html']:$dt->sale_price;
                $json['success']  = true;
                $json['variant_id'] =  $variants_resp['variant_id'];
                $json['variant_image'] =  $variants_resp['variant_image']?$variants_resp['variant_image']:(isset($imgs[0])?$imgs[0]:'');
                $json['variant_price'] = format_currency(round($variant_price,2));
                $json['price_html'] = $price_html;
                $json['variant_price_to_show'] = format_currency(round($variant_price,2));
                $config_catalog_purchase = $this->db->where('key','config_catalog_purchase')->get('ci_settings')->row();
        if($config_catalog_purchase)
        {
            $config_catalog_purchase = $config_catalog_purchase->value;
        }
        else
        {
            $config_catalog_purchase = 0;
        }
                $json['variant_qty'] =  $variants_resp['variant_qty'];
                $json['config_catalog_purchase'] =  $config_catalog_purchase;
               // $json['variant_image'] = $variants->data->variant_image;
            }
        }

        echo json_encode($json);
    }

    public function apply_coupon()
    {
        $json = array('error' => true);
        if(!$this->auth_user->is_logged_in()){
			$json['message'] = 'Please login first to use coupon code';
            return ajax_response($json);

		}
        if($this->input->post('coupon_code'))
        {
            $coupon_code = $this->input->post('coupon_code');
            $coupon_info = $this->User_checkout_model->get_coupon($coupon_code);
            $json['coupon_info'] = $coupon_info;
            if($coupon_info)
            {
				$coupon_total_usage = $this->User_checkout_model->get_coupon_total_usage($coupon_info->id);
				
				if($coupon_info->coupon_count > $coupon_total_usage)
                {
                    $coupon = array(
                        'status' => 'applied',
                        'coupon_id' => $coupon_info->id,
                        'code'   	=> $coupon_code,
						'type'	 	=> $coupon_info->discount_type,
						'value'	 	=> '-'.$coupon_info->discount_value
                    );
                    (object)$this->user_session->set_userdata('coupon', $coupon);
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
        // echo $json['message'];
        echo json_encode($json);
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
