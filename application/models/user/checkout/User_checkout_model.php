<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_checkout_model extends User_Model {
	
	private $culture_code = 'en-US';

	function __construct()
	{
		parent::__construct();

		if(!empty($this->user_session->culture_code))
		{
			$this->culture_code = $this->user_session->culture_code;
		}
	}
	function addcustomer($userInfo)
    {
        $this->db->trans_start();
        $this->db->insert('tbl_customer', $userInfo);

        $insert_id = $this->db->insert_id();

        $this->db->trans_complete();

        return $insert_id;
    }

	public function save_order($data)
	{
        if($ord_id = $this->user_session->userdata('order_id')){
            /*$order_detail = $this->db->select('*')->from('order')->where('order_id', $ord_id)->get()->row();
            if(!empty($order_detail)){
                return $ord_id;
            }*/
            $this->delete_order($ord_id);
        }

		$this->db->trans_start();
		$success_flag = false;


		$products = $data['products'];
		$totals = $data['totals'];
		unset($data['products']);
		unset($data['totals']);
		$order = $data;
		

		$order_id = '';
		if($this->db->insert('order', $order)){
			$order_id = $this->db->insert_id();
			$success_flag = true;
		}

		if($success_flag){
			foreach ($products as $product){
				$product_input = array(
					'order_id'	=> $order_id,
					'customer_id'	=> $order['customer_id'],
					'product_id'	=> $product->product_id,
					'product_name'	=> $product->product_name,
					'sku'	=> $product->sku,
					'quantity'		=> $product->quantity,
					'unite_price'	=> $product->unite_price,
					'tax'	        => $product->tax,
					//'discount_total'=> $product->discount_total,
					'total'			=> $product->total,
					'date_added'	=> $order['date_added'],
					'added_by_ip'	=> $order['ip'],
				);


				if($this->db->insert('order_products', $product_input)){
					$success_flag = true;
				}else{
					$success_flag = false;
				}
			}
		}


		if($success_flag){
			$sort = 0;
			foreach ($totals as $title =>  $total){
				$order = $this->get_setting($title);
				$total_input = array(
					'order_id'		=> $order_id,
					'code'			=> $total['code'],
					'title'			=> $title,
					'value'			=> $total['value'],
					'sort_order'	=> $order->value,
				);
				$sort++;

				if($this->db->insert('order_total', $total_input)){
					$success_flag = true;
				}else{
					$success_flag = false;
				}
			}
		} 

		if($success_flag){
			$history_input = array(
				'order_id'			=> $order_id,
				'order_status_id'	=> $order['order_status_id'],
				'notify'			=>	'',
				'comment'			=>	'',
				'date_added'		=>	$order['date_added']
			);

			if($this->db->insert('order_history', $history_input)){
				$success_flag = true;
			}else{
				$success_flag = false;
			}
		}

		if($success_flag){
			$this->db->trans_complete();
			return $order_id;
		}else{
			return false;
		}
	}

	function get_setting($code)
	{
		$this->db->where('code', $code);
		$this->db->where('key', 'sort_order');
		$result	= $this->db->get('settings')->row();
		
		return $result;	
	}

	function get_jazzcash_detail()
	{
		$this->db->where('code', 'jazzcash');
		$result	= $this->db->get('settings')->result();
		
		return $result;	
	}

	public function get_orders($data=array(), $return_count=false)
	{
        if(empty($data) and !$return_count)
        {
            return false;
        }
        else {
            $sql = '*';
            if ($return_count === TRUE)
			{
                $sql = 'COUNT(*) AS found_total';
                $this->db->select($sql);
            }
			else
			{
				$this->db->select('o.*, (SELECT COUNT(*) FROM '. $this->db->dbprefix .'order_products WHERE order_id = o.order_id)as no_of_products , (SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = o.order_status_id)as order_status_name,
					(SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = o.payment_status_id)as order_payment_status
					');
            }
			
			$this->db->from('order o');
            
			if(!empty($data['customer_id']))
            {
                $this->db->where('o.customer_id', $data['customer_id']);
            }
			
			$this->db->where('o.order_status_id <>', 0);

            if(!empty($data['rows']))
            {
                $this->db->limit($data['rows']);
            }

            if(!empty($data['per_page']))
            {
                $this->db->offset($data['per_page']);
            }

            if(!empty($data['order']))
            {
                $this->db->order_by('o.' .$data['order'], $data['sort']);
			}else{
				$this->db->order_by('o.date_added','DESC');
			}

            if($return_count)
            {
                $result = $this->db->get()->row();
                if(!$result)
                {
                    return false;
                }

                return $result->found_total;
            }
            else
            {
                $result = $this->db->get()->result();
            }

        }
        if(!$result)
        {
            return false;
        }
        return $result;
	}

	public function get_order($order_id)
	{
		return $this->db->select('o.*, (SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = o.order_status_id)as order_status_name')->from('order o')->where('o.order_id', $order_id)->get()->row();
	}

	public function get_order_products($order_id)
	{
		return $this->db->select('*')->from('order_products')->where('order_id', $order_id)->get()->result();
	}

	public function get_order_totals($order_id)
	{
		return $this->db->select('*')->from('order_total')->where('order_id', $order_id)->order_by('sort_order', 'ASC')->get()->result();
	}

	public function get_order_history($order_id)
	{
		return $this->db->select('oh.*, (SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = oh.order_status_id)as order_status_name,
			(SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = oh.payment_status_id)as payment_status_name,')->from('order_history oh')->where('oh.order_id', $order_id)->order_by('date_added', 'DESC')->get()->result();
	}
	
    public function save_paypal_log($data)
    {
        if($this->db->insert('paypal_log', $data)){
            return true;
        }else{
            return false;
        }
	}

    public function update_order_status($params, $order_id)
    {
        $this->db->where('order_id', $order_id)->update('order', $params);
        $this->db->where('order_id', $order_id)->update('order_history', $params);
	}

//	public function update_coupon_status($coupon_code, $is_used)
//    {
//        $this->db->where('coupon_code', $coupon_code)->update('join_club', array('is_used' => $is_used));
//	}

    public function delete_order($order_id)
    {
        $this->db->trans_start();
        $success_flag = false;

        if($this->db->where('order_id',$order_id)->delete('order_products')){
            $success_flag = true;
        }else{
            $success_flag = false;
        }

        if($success_flag){
            if($this->db->where('order_id',$order_id)->delete('order_total')){
                $success_flag = true;
            }else{
                $success_flag = false;
            }
        }

        if($success_flag){
            if($this->db->where('order_id',$order_id)->delete('order_history')){
                $success_flag = true;
            }else{
                $success_flag = false;
            }
        }

        if($success_flag) {
            if ($this->db->where('order_id', $order_id)->delete('order')) {
                $success_flag = true;
            }else{
                $success_flag = false;
            }
        }

        if($success_flag){
            $this->db->trans_complete();
            return true;
        }else{
            return false;
        }
	}

//    public function get_membership_coupon($coupon, $data= array())
//    {
//        $this->db->select('*')->from('join_club');
//        $this->db->where('coupon_code', $coupon);
//        if(isset($data['is_used'])){
//            $this->db->where('is_used', $data['is_used']);
//        }
//        return $this->db->get()->row();
//	}

	public function get_coupon($coupon)
    {
    	$current_date = date('Y-m-d');

        $this->db->select('*')->from('coupon_codes');
        $this->db->where('coupon_code', $coupon);
        $this->db->where('enabled', 1);
        $this->db->where('start_date <=', $current_date);
        $this->db->where('end_date >=', $current_date);

        return $this->db->get()->row();
	}

	public function get_coupon_total_usage($coupon_id)
    {
		$sql = 'COUNT(*) AS found_total';
		$this->db->select($sql);
		$this->db->from('order_coupon_codes');
		$this->db->where('coupon_code_id', $coupon_id);
		$this->db->where('is_used', '1');
		$result = $this->db->get()->row();

		if(!$result)
		{
			return false;
		}
		return $result->found_total;
	}

	public function save_coupon_history($data)
	{
		$this->db->where(array('order_id' => $data['order_id'], 'coupon_id' => $data['coupon_id']))->delete('coupon_history');
		$this->db->insert('coupon_history',$data);
		return $this->db->insert_id();
	}
	public function update_coupon_history($data){
		return $this->db->where(array('order_id' => $data['order_id'], 'coupon_id' => $data['coupon_id']))->update('coupon_history', array('is_used' => '1'));
	}


    public function update_quantity($product_id , $sku , $quantity,  $has_options){
    	// die('OKK');

	    if($has_options)
            return $this->db->where(array('product_id' => $product_id, 'product_option_value_id' => $has_options))->update('product_option_value', array('quantity' => $quantity));
        else
            return $this->db->where(array('product_id' => $product_id, 'sku' => $sku))->update('products', array('quantity' => $quantity));
	}
}
