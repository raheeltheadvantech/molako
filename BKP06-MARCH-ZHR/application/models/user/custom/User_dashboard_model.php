<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_dashboard_model extends User_Model {
	
	private $culture_code = 'en-US';

	function __construct()
	{
		parent::__construct();
		
		if(!empty($this->user_session->culture_code))
		{
			$this->culture_code = $this->user_session->culture_code;
		}
	}
	
	function get_dashboard_data($customer_id)
	{
		$result = new stdClass();
		
		
		$this->db->select('*');
		$this->db->from('orders');
		$this->db->where('customer_id', $customer_id);
		$result->order_count = $this->db->get()->num_rows();
		
		
		$this->db->select('*');
		$this->db->from('prop_client_property_reviews_tmp');
		$this->db->where('customer_id', $customer_id);
		$result->review_count = $this->db->get()->num_rows();
		
		
		$this->db->select('*');
		$this->db->from('customer_wishlist');
		$this->db->where('customer_id', $customer_id);
		$result->wishlist_count = $this->db->get()->num_rows();
		
		
		$this->db->select('SUM(search_count) as total_count');
		$this->db->from('prop_client_property_recent_searched_log');
		$row = $this->db->get()->row();			
		$result->search_count = $row->total_count;

		
		$result->profile_score = $this->get_customer_profile_score($customer_id);

		
		$this->db->select('o.*, mcp.name as property_name, mcp.property_category_name');
		$this->db->select("(SELECT lng.name FROM {$this->db->dbprefix}order_master_property_names AS lng WHERE lng.order_id = o.order_id AND lng.culture_code = '{$this->culture_code}' LIMIT 1) AS property_name_translated", NULL);
		$this->db->select("(SELECT lng.name FROM {$this->db->dbprefix}order_master_property_category_names AS lng WHERE lng.order_id = o.order_id AND lng.culture_code = '{$this->culture_code}' LIMIT 1) AS property_category_name_translated", NULL);
		$this->db->from('orders o');
		$this->db->join('order_master_client_properties mcp', 'o.order_id = mcp.order_id');
		$this->db->where('o.customer_id', $customer_id);
		$this->db->order_by('o.date_added', 'DESC');
		$this->db->limit(5);
		$result->orders	= $this->db->get()->result();
		
		
		$this->db->select('p.*, p.name as property_name');
		//$this->db->select("(SELECT name FROM {$this->db->dbprefix}prop_master_property_categories AS mpc WHERE mpc.property_category_id = p.property_category_id LIMIT 1) AS property_name_translated", NULL);
		$this->db->select("(SELECT lng.name FROM {$this->db->dbprefix}prop_client_property_names AS lng WHERE lng.property_id = p.property_id AND lng.culture_code = '{$this->culture_code}' LIMIT 1) AS property_name_translated", NULL);
		$this->db->select("(SELECT lng.name FROM {$this->db->dbprefix}prop_master_property_category_names AS lng WHERE lng.property_category_id = p.property_category_id AND lng.culture_code = '{$this->culture_code}' LIMIT 1) AS property_category_name_translated", NULL);
		$this->db->from('prop_client_property_recent_viewed_log pv');
		$this->db->join('prop_client_properties p', 'pv.property_id = p.property_id');
		$this->db->order_by('pv.date_added', 'DESC');
		$this->db->limit(5);
		$result->recent_viewed_properties	= $this->db->get()->result();
		
		
		$this->db->select('p.*, p.name as property_name, ps.search_count');
		$this->db->select("(SELECT lng.name FROM {$this->db->dbprefix}prop_client_property_names AS lng WHERE lng.property_id = p.property_id AND lng.culture_code = '{$this->culture_code}' LIMIT 1) AS property_name_translated", NULL);
		$this->db->from('prop_client_property_recent_searched_log ps');
		$this->db->join('prop_client_properties p', 'ps.property_id = p.property_id');
		$this->db->order_by('ps.property_recent_searched_log_id', 'DESC');
		$this->db->limit(5);
		$result->recent_searched_properties	= $this->db->get()->result();
		
		
		return $result;
	}
	
	private function get_customer_profile_score($customer_id)
	{
		/*
		
		1- validate variables for user_profile
		
		*/

		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('customer_id', $customer_id);
		$this->db->limit(1);
		$customer	= $this->db->get()->row();
		if(!$customer)
		{
			return FALSE;
		}

		$master_count = 0;
		
		
		if($customer->images)
		{
			$master_count += 10;	
		}
		
		
		if($customer->display_name)
		{
			$master_count += 5;	
		}
		
		
		if($customer->dob_date)
		{
			$master_count += 5;	
		}
		
		
		if($customer->display_country_id)
		{
			$master_count += 5;	
		}
		
		
		if($customer->user_title)
		{
			$master_count += 5;	
		}
		
		
		if($customer->first_name and $customer->last_name)
		{
			$master_count += 10;	
		}
		
		
		if($customer->phone)
		{
			$master_count += 5;	
		}
		
		
		if($customer->gender)
		{
			$master_count += 5;	
		}
		
		
		if($customer->address_1 || $customer->country_id || $customer->city)
		{
			$master_count += 10;	
		}
		
		
		if($customer->business_name)
		{
			$master_count += 5;	
		}
		
		
		if($customer->business_phone)
		{
			$master_count += 5;	
		}
		
		
		if($customer->business_address || $customer->business_country_id || $customer->business_city)
		{
			$master_count += 10;	
		}
		
		
		if($customer->is_newsletter)
		{
			$master_count += 10;	
		}
		
		
		$this->db->select('COUNT(payment_method_credit_card_id) AS count_total');
		$this->db->from('customer_payment_method_credit_cards');
		$this->db->where('customer_id', $customer_id);
		$result	= $this->db->get()->row();
		if($result->count_total > 0)
		{
			$master_count += 10;
		}
		
		return $master_count;
	}	
	
	function get_credit_cards($customer_id)
	{
		$this->db->select('cc.*');
		$this->db->select("(SELECT c.name FROM {$this->db->dbprefix}countries AS c WHERE c.country_id = cc.country_id LIMIT 1) AS country_name", NULL);
		$this->db->select("(SELECT z.name FROM {$this->db->dbprefix}country_zones AS z WHERE z.zone_id = cc.zone_id LIMIT 1) AS zone_name", NULL);
		$this->db->select("(SELECT lng.name FROM {$this->db->dbprefix}country_names AS lng WHERE lng.country_id = cc.country_id AND lng.culture_code = '{$this->culture_code}' LIMIT 1) AS country_translated", NULL);
		$this->db->select("(SELECT lng.name FROM {$this->db->dbprefix}country_zone_names AS lng WHERE lng.zone_id = cc.zone_id AND lng.culture_code = '{$this->culture_code}' LIMIT 1) AS zone_translated", NULL);
		$this->db->from('customer_payment_method_credit_cards AS cc');
		$this->db->where('cc.customer_id', $customer_id);
		$result	= $this->db->get()->result();
		if(!$result)
		{
			return false;
		}
		
		foreach($result as $key=>&$val)
		{
			$val->country_name	= ($val->country_translated != '' ? $val->country_translated : $val->country_name);
			$val->zone_name 	= ($val->zone_translated != '' ? $val->zone_translated : $val->zone_name);
		}
		
		return $result;
	}
	
	function get_credit_card($id, $customer_id)
	{
		$this->db->select('*');
		$this->db->from('customer_payment_method_credit_cards');
		$this->db->where('payment_method_credit_card_id', $id);
		$this->db->where('customer_id', $customer_id);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}
	
	function save_credit_card($data)
	{
		if ($data['payment_method_credit_card_id'])
		{
			$this->db->where('payment_method_credit_card_id', $data['payment_method_credit_card_id']);
			$this->db->update('customer_payment_method_credit_cards', $data);
			$id	= $data['payment_method_credit_card_id'];
		}
		else
		{
			$this->db->insert('customer_payment_method_credit_cards', $data);
			$id	= $this->db->insert_id();
		}
		
		return $id;
	}
	
	function credit_card_delete($id)
	{
		$this->db->where('payment_method_credit_card_id', $id);
		return $this->db->delete('customer_payment_method_credit_cards');
	}
	
	function change_default_credit_card($id, $customer_id)
	{
		$this->db->set('is_default', 0);
		$this->db->where('customer_id', $customer_id);
		$this->db->update('customer_payment_method_credit_cards');
		
		$this->db->set('is_default', 1);
		$this->db->where('customer_id', $customer_id);
		$this->db->where('payment_method_credit_card_id', $id);
		$this->db->update('customer_payment_method_credit_cards');
		
		return true;
	}
	
	function save_user_profile_picture($data)
	{
		if ( !empty($data['images']) )
		{
			$this->db->set('images', $data['images']);
			$this->db->where('customer_id', $data['customer_id']);
			$this->db->update('customers');
			return $id	= $data['file_id'];
		}
		
		return false;
	}
	
}