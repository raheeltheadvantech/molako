<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_order_model extends User_Model {
	
	private $culture_code = 'en-US';

	function __construct()
	{
		parent::__construct();

		if(!empty($this->user_session->culture_code))
		{
			$this->culture_code = $this->user_session->culture_code;
		}
	}

	public function get_by_id($order_id, $customer_id=null)
	{
		$this->db->select('*');
		$this->db->from('order');
		$this->db->where('order_id', $order_id);
		if ($customer_id) {
			$this->db->where('customer_id', $customer_id);
		}
		
		$result = $this->db->get()->row();

		if(!$result)
		{
			return false;
		}
		
		$result->products = $this->get_products($order_id);
		$result->totals = $this->get_totals($order_id);
		$result->history = $this->get_history($order_id);
		
		return $result;
	}

	public function get_products($order_id)
	{
		// $sql = '*,';
		// 	$sql .= '(SELECT special_price FROM '. $this->db->dbprefix .'order_items oi WHERE oi.order_id = '. $this->db->dbprefix .'order_items.order_id limit 1) as discount_total';
		$this->db->select('op.*');
		$this->db->from('order_products as op');
		// $this->db->join($this->db->dbprefix .'order_items as oi','oi.order_id = op.order_id');
		$this->db->where('op.order_id', $order_id);
		// $this->db->where('oi.order_id', $order_id);
		// $this->db->group_by('op.order_id');
		$result = $this->db->get()->result();

		if(!$result)
		{
			return false;
		}
		
		return $result;
	}

	public function get_totals($order_id)
	{
		$this->db->select('*');
		$this->db->from('order_total');
		$this->db->where('order_id', $order_id);
		$this->db->order_by('sort_order', 'ASC');
		$result = $this->db->get()->result();

		if(!$result)
		{
			return false;
		}
		
		return $result;
	}

	public function get_history($order_id)
	{
		$this->db->select('oh.*,os.name as order_status_name,os.name as payment_status_name');
		$this->db->from('order_history as oh');
		$this->db->join($this->db->dbprefix.'order_status as os','os.order_status_id = oh.order_status_id');
		$this->db->join($this->db->dbprefix.'order_status as osp','osp.order_status_id = oh.payment_status_id');
		$this->db->where('oh.order_id', $order_id);
		$this->db->order_by('oh.order_history_id', 'ASC');
		$result = $this->db->get()->result();

		if(!$result)
		{
			return false;
		}
		
		return $result;
	}

	public function get_orders($user_id)
	{
		return $this->db->select('*')->from('order')->where('customer_id', $user_id)->get()->result();
	}

	public function save($data)
	
{		$order_id = false;
		$customer_id = false;
		
		if(!empty($data->order))
		{
			$this->db->insert('order', $data->order);
			$order_id = $this->db->insert_id();
		}
		
		if(!$order_id)
		{
			return FALSE;
		}
		
		$customer_id = $data->order['customer_id'];
		$discount = 0;
		if($order_id and !empty($data->coupon))
		{
			$discount = $data->coupon['value'];
			$save = array();
			$save['order_id'] 		= $order_id;
			$save['coupon_code_id'] = $data->coupon['coupon_id'];
				
			$this->db->insert('order_coupon_codes', $save);
		}
		
		if($order_id and !empty($data->products))
		{
			foreach($data->products as $k=>$v)
			{
				$v= (object ) $v;
				$save =$item= array();
				$save['order_id'] 		= $order_id;
				$save['customer_id'] 	= $customer_id;
				
				$save['product_id'] 	= $v->product_id;
				$save['product_name'] 	= $v->product_name;
				$save['sku'] 			= $v->sku;
				$save['quantity'] 		= $v->quantity;
				$save['unit_price'] 	= $v->final_price;
				$save['orignal_price'] 	= $v->cut_price;
				$save['special_price'] 	= $v->special_price;
				$save['varient_price'] 	= (isset($v->varient_price->price)?$v->varient_price->price:0); 
				$save['discount_total'] = ($v->total/100)*$discount;
				$save['total'] 			= $v->total;
				
				$this->db->insert('order_products', $save);
			}
		}

		

		if($order_id and !empty($data->totals))
		{
			foreach($data->totals as $k=>$v)
			{
				// if ($v->code == 'tax') {
				// 	foreach($v->total as $v1)
				// 	{
				// 		$save = (array)$v1;
				// 		$save['order_id'] = $order_id;
				
				// 		$this->db->insert('order_total', $save);
				// 	}
				// }else{
					$save = (array)$v;
					$save['order_id'] = $order_id; 
					$save['sort_order'] = $k; 
					$this->db->insert('order_total', $save);
				// }
			}
		}
		
		return $order_id;
	}

	public function order_coupon($order_id,$coupon)
	{
		$success_flag= false;
		if($order_id and !empty($coupon))
		{
			$this->db->where('order_id', $order_id);
			$this->db->update('order_coupon_codes', $coupon);
			$success_flag = true;
		}
		return $success_flag;
	}

	public function update($data)
	{
		if(!$data['order_id'])
		{
			return FALSE;
		}
		
		$this->db->where('order_id', $data['order_id']);
		$this->db->update('order', $data);
		$order_id = $data['order_id'];
		
		
		$save['order_id']			= $data['order_id'];
		$save['order_status_id']	= $data['order_status_id'];
		$save['payment_status_id']	= $data['payment_status_id'];
		$save['notify']				= 1;
		$save['comment']			= 'order updated';
		$save['date_added']			= date('Y-m-d H:i:s');
		
		$this->db->insert('order_history', $save);
		
		return $order_id;
	}

	
}
