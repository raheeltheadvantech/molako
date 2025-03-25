<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_address_model extends User_Model {
	
	private $culture_code = 'en-US';

	function __construct()
	{
		parent::__construct();

		if(!empty($this->user_session->culture_code))
		{
			$this->culture_code = $this->user_session->culture_code;
		}
	}

	public function get_addresses($user_id)
	{
		$this->db->select('a.address_id,a.customer_id,a.first_name,a.last_name, a.company, a.address_1, a.address_2, a.city,
			a.postcode, a.country_id, a.region_id, a.default_address,
			(SELECT name FROM '. $this->db->dbprefix .'country_zones WHERE zone_id = a.region_id) as region_name, (SELECT name FROM '. $this->db->dbprefix .'countries WHERE country_id = a.country_id) as country_name');
		$this->db->from('address a');
		$this->db->where('customer_id', $user_id);
		return $this->db->get()->result();
	}
	
	public function get_address_menu($user_id)
	{
		$this->db->order_by('address_id','desc');
		$result = $this->get_addresses($user_id);

		if(!$result)
		{
			return false;
		}
		
		$r = array();
		foreach($result as $k=>$v)
		{
			$txt = $v->first_name.' '.$v->last_name.', '.$v->company.', '.$v->address_1.', '.$v->city.' '.$v->postcode.', '.$v->region_name.' '.$v->country_name;
			$r[$v->address_id] = array('txt'=>$txt,'data'=>$v,'default'=>$v->default_address);
		}
		
		return $r;
	}
	public function get_default_address($user_id)
	{
		return $this->db->select('a.*, (SELECT name FROM '. $this->db->dbprefix .'country_zones WHERE zone_id = a.region_id) as region_name, (SELECT name FROM '. $this->db->dbprefix .'countries WHERE country_id = a.country_id) as country_name')->from('address a')->where(array('a.default_address' => '1', 'customer_id' => $user_id))->get()->row();
	}
	public function get_address($address_id)
	{
		return $this->db->select('a.*, (SELECT name FROM '. $this->db->dbprefix .'country_zones WHERE zone_id = a.region_id) as region_name, (SELECT name FROM '. $this->db->dbprefix .'countries WHERE country_id = a.country_id) as country_name')->from('address a')->where('a.address_id', $address_id)->get()->row();
	}

	public function make_default($customer_id,$address_id)
	{
		$success_flag = false;
		if($address_id){
			if($this->db->where('customer_id', $customer_id)->update('address', array('default_address'=>0)))
			{
				$this->db->where('address_id', $address_id)->update('address', array('default_address'=>1));
				$success_flag = true;
			}
		}
		return $success_flag;
	}
	public function save_address($data)
	{
		$success_flag = true;
		if(isset($data['address_id'])){
			if($this->db->where('address_id', $data['address_id'])->update('address', $data)){
				$success_flag = true;
			}
		}else{

			if($this->db->insert('address', $data)){
				$success_flag = $this->db->insert_id();
			}
		}
		return $success_flag;
	}

	public function delete_address($address_id)
	{
		$success_flag = false;
		if($this->db->where('address_id', $address_id)->delete('address')){			$success_flag = true;
		}

		return $success_flag;
	}
	
}
