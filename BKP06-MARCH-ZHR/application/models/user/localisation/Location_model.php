<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Location_model extends CI_Model 
{
	private $culture_code = 'en-US';
	
	function __construct()
	{
		parent::__construct();
		
		if(!empty($this->user_session->culture_code))
		{
			$this->culture_code = $this->user_session->culture_code;
		}
	}
	
	function get_zone_areas($country_id) 
	{
		$this->db->where('zone_id', $country_id);
		return $this->db->get('country_zone_areas')->result();
	}
	
	function get_zone_area($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('country_zone_areas')->row();
	}
	
	function get_zones($country_id) 
	{
		$this->db->where('country_id', $country_id);
		return $this->db->get('country_zones')->result();
	}
	
	function get_zone($id)
	{
		$this->db->where('zone_id', $id);
		return $this->db->get('country_zones')->row();
	}
	
	function get_countries($only_default = true)
	{
		if($only_default)
		{
			return $this->db->where('is_default', 1)->get('countries')->row();
		}
		return $this->db->order_by('sequence', 'ASC')->get('countries')->result();
	}
	
	function get_country_by_zone_id($id)
	{
		$zone	= $this->get_zone($id);
		return $this->get_country($zone->country_id);
	}
	
	function get_country($id)
	{
		$this->db->where('country_id', $id);
		return $this->db->get('countries')->row();
	}


    function get_default_country()
    {
        $this->db->where('is_default', 1);
        $result = $this->db->get('countries')->row();

        if(!$result)
        {
            return false;
        }

        return $result;

    }

	
	function get_countries_menu()
	{	
		$this->db->where('is_default', 1);
		$countries	= $this->db->order_by('sequence', 'ASC')->where('enabled', 1)->get('countries')->result();
		$return		= array();
		foreach($countries as $c)
		{
			$return[$c->country_id] = $c->name;
		}
		return $return;
	}
	
	function get_zones_menu($country_id)
	{
		$zones	= $this->db->where(array('enabled'=>1, 'country_id'=>$country_id))->get('country_zones')->result();
		$return	= array();
		foreach($zones as $z)
		{
			$return[$z->zone_id] = $z->name;
		}
		return $return;
	}
	
	function get_zone_cities($zone_id = false, $str = false)
	{
		$this->db->select('cn.*');
		$this->db->from('country_zone_cities AS c');
		$this->db->join('country_zone_city_names AS cn', 'c.city_id = cn.city_id');
		$this->db->where('c.zone_id', $zone_id);
		$this->db->where('cn.culture_code', $this->culture_code);
		if($str)
		{
			$this->db->like('cn.name', $str);
		}
		$result	= $this->db->get()->result();
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}
	
	function get_cities($zone_id = false) 
	{
		if($zone_id !== false)
		$this->db->where('zone_id', $zone_id);
		
		$this->db->order_by('zone_id', 'ASC');
		return $this->db->get('country_zone_cities')->result();
	}
	
	
	function get_city($id)
	{
		$this->db->where('city_id', $id);
		return $this->db->get('country_zone_cities')->row();
	}

	function get_country_by_ip()
	{
		$ci = get_instance();
		$ci->load->helper('core');
		
		$ipnumber = ipaddress_to_ipnumber();
		
		$this->db->select('*');
		$this->db->from('geo_ips');
		$this->db->where(''.$ipnumber.' BETWEEN `start` AND `end` ');
		$this->db->limit(1);
		$result  = $this->db->get()->row();
		//echo $this->db->last_query();
		
		if(!$result)
		return false;
		
		return $result;
	}
	
}	
