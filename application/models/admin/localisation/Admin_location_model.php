<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_location_model extends Admin_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	function save_zone_area($data)
	{
		if(!$data['id']) 
		{
			$this->db->insert('country_zone_areas', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('id', $data['id']);
			$this->db->update('country_zone_areas', $data);
			return $data['id'];
		}
	}
	
	function delete_zone_areas($country_id)
	{
		$this->db->where('zone_id', $country_id)->delete('country_zone_areas');
	}
	
	function delete_zone_area($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('country_zone_areas');
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
	
	//zones
	function save_zone($data)
	{
		if(!$data['zone_id']) 
		{
			$this->db->insert('country_zones', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('zone_id', $data['zone_id']);
			$this->db->update('country_zones', $data);
			return $data['zone_id'];
		}
	}
	
	function delete_zones($country_id)
	{
		$this->db->where('country_id', $country_id)->delete('country_zones');
	}
	
	function delete_zone($id)
	{
		$this->delete_zone_areas($id);
		
		$this->db->where('zone_id', $id);
		$this->db->delete('country_zones');
	}
	
	function get_zones($country_id = false) 
	{
		if($country_id !== false)
		$this->db->where('country_id', $country_id);
		
		$this->db->order_by('country_id', 'ASC');
		return $this->db->get('country_zones')->result();
	}
	
	
	function get_zone($id)
	{
		$this->db->where('zone_id', $id);
		return $this->db->get('country_zones')->row();
	}
	
	
	
	//countries
	function save_country($data)
	{
		if(!$data['country_id']) 
		{
			$this->db->insert('countries', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('country_id', $data['country_id']);
			$this->db->update('countries', $data);
			return $data['country_id'];
		}
	}
	
	function organize_countries($countries)
	{
		//now loop through the products we have and add them in
		$sequence = 0;
		foreach ($countries as $country)
		{
			$this->db->where('country_id',$country)->update('countries', array('sequence'=>$sequence));
			$sequence++;
		}
	}
	
	function get_countries_old()
	{
		return $this->db->order_by('sequence', 'ASC')->get('countries')->result();
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

	function delete_country($id)
	{
		die('Not Allowed');
		$this->db->where('id', $id);
		$this->db->delete('countries');
	}
	
	function get_countries_menu()
	{	
		$countries	= $this->db->order_by('sequence', 'ASC')->where('enabled', 1)->get('countries')->result();
		$return		= array();
		foreach($countries as $c)
		{
			$c->name = htmlentities($c->name, ENT_QUOTES, 'utf-8', false);
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
			$z->name = htmlentities($z->name, ENT_QUOTES, 'utf-8', false);
			$return[$z->zone_id] = $z->name;
		}
		return $return;
	}
	
	function save_city($data)
	{
		if(!$data['city_id']) 
		{
			$this->db->insert('country_zone_cities', $data);
			return $this->db->insert_id();
		} 
		else 
		{
			$this->db->where('city_id', $data['city_id']);
			$this->db->update('country_zone_cities', $data);
			return $data['city_id'];
		}
	}
	
	function delete_cities($zone_id)
	{
		$this->db->where('zone_id', $zone_id)->delete('country_zone_cities');
	}
	
	function delete_city($id)
	{
		$this->db->where('zone_id', $id);
		$this->db->delete('country_zone_cities');
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
	
	function get_location_language_names($db_table, $primary_key_id, $primary_key_val, $is_array=false)
	{
		$this->db->select('*');
		$this->db->from($db_table);
		$this->db->where($primary_key_id, $primary_key_val);
		$result	= $this->db->get()->result();
		if(!$result)
		{
			return false;
		}
		
		$return = array();
		foreach($result as $key=>$val)
		{
			$return[$val->culture_code] =  $val->name;
		}
		
		return $return;
	}

	function save_location_language_names($db_table, $primary_key_id, $data)
	{
		$this->db->where($primary_key_id, $data[$primary_key_id]);
		$this->db->where('culture_code', $data['culture_code']);
		$this->db->delete($db_table);
	
		$this->db->insert($db_table, $data);
		$id	= $this->db->insert_id();
					
		return $id;
	}
	
	/*
	// returns array of strings formatted for select boxes
	function get_countries_zones()
	{
		$countries = $this->db->get('countries')->result_array();
		
		$list = array();
		foreach($countries as $c)
		{
			if(!empty($c['name']))
			{		
				$zones =  $this->db->where('country_id', $c['id'])->get('country_zones')->result_array();
				$states = array();
				foreach($zones as $z)
				{
					// todo - what to put if there are no zones in a country?
					
					if(!empty($z['code']))
					{
						$states[$z['id']] = $z['name'];
					}
				}
				
				$list[$c['name']] = $states;
			}
		}
		
		return $list;
	}
	*/
}	