<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_order_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	private function get_orders_count()
	{
		$this->db->select('COUNT(*) AS found_total');
		$this->db->from('order');
		$result = $this->db->get()->row();
		
		if(!$result)
		{
			return false;
		}
		
		return $result->found_total;
	}
	
	function get_orders($data=array(), $return_count=false)
	{

		if(empty($data) and !$return_count)
		{
			return false;
		}
		else
		{
			$sql = '*,';
			$sql .= '(SELECT COUNT(*) FROM '. $this->db->dbprefix .'order_products op WHERE op.order_id = '. $this->db->dbprefix .'order.order_id) as no_of_products ,';
			$sql .= '(SELECT `name` FROM '. $this->db->dbprefix .'order_status os WHERE os.order_status_id = '. $this->db->dbprefix .'order.order_status_id) as order_shipping_status,';
			$sql .= '(SELECT `name` FROM '. $this->db->dbprefix .'order_status os WHERE os.order_status_id = '. $this->db->dbprefix .'order.payment_status_id) as order_payment_status';
			if($return_count === TRUE)
			{
				$sql = 'COUNT(*) AS found_total';
			}
			
			$this->db->select($sql);
			$this->db->from('order');
			$this->db->where(1,1, FALSE);
			// $this->db->where('order_status_id <>', 0);
			$this->db->where('payment_status_id <>', 0);
			
			if(isset($data['customer_id']) && !empty($data['customer_id'])){
                $this->db->where('customer_id', $data['customer_id']);
            }
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
				$this->db->order_by($data['order'], $data['sort']);
			}else{
				$this->db->order_by('date_added', 'DESC');
			}
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('first_name', $search->term);
					$this->db->or_like('last_name', $search->term);
					$this->db->or_like('invoice_no', $search->term);
					$this->db->group_end();
				}

				
				if(!empty($search->order_filter) && $search->order_filter != -1){
					$this->db->where('order_id', $search->vendor_filter);
				}

				if(!empty($search->customer_id) && $search->customer_id != -1){
					$this->db->where('customer_id', $search->customer_id);
				}
			}

			if(!empty($search->start_date))
			{
				$this->db->where('DATE(date_added) >=',$search->start_date);
			}
			
			if(!empty($search->end_date))
			{
				$this->db->where('DATE(date_added) <=',$search->end_date);
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
		return $this->db->select('o.*, (SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = o.order_status_id)as order_shipping_status,(SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = o.payment_status_id)as order_payment_status')->from('order o')->where('o.order_id', $order_id)->get()->row();
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
		return $this->db->select('oh.*, (SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = oh.order_status_id)as order_shipping_status,(SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = oh.payment_status_id)as order_payment_status')->from('order_history oh')->where('oh.order_id', $order_id)->order_by('date_added', 'DESC')->get()->result();
	}

	public function get_order_status()
	{
		return $this->db->select('*')->from('order_status')->order_by('order_status_id', 'ASC')->get()->result();
	}
	public function get_order_status_name()
	{
		return $this->db->select('name')->from('order_status')->get()->row()->name;
	}
	public function get_order_status_by_status_id($order_status_id)
	{
		return $this->db->select('name')->from('order_status')->where('order_status_id', $order_status_id)->get()->row()->name;
	}

	public function save_history($data)
	{
		$this->db->trans_start();
		$success_flag = false;
		if($this->db->insert('order_history', $data)){
			$success_flag = true;
		}

		if($success_flag){
			if($this->db->where('order_id',$data['order_id'])->update('order', array('order_status_id' => $data['order_status_id'],'payment_status_id' => $data['payment_status_id']))){
				$success_flag = true;
			}else{
				$success_flag = false;
			}
		}

		if($success_flag){
			$this->db->trans_complete();
		}
		return $success_flag;
	}

}
