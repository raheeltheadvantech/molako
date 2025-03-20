<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_geo_zone_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/***	Geo Zones ***/
	
	function get_geo_zones($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			return $this->get_all_geo_zone();
		}
		else
		{
			$this->db->select("*", FALSE);
			$this->db->from('geo_zone');
			$this->db->where(1,1, FALSE);
			
			if(!empty($data['rows']))
			{
				$this->db->limit($data['rows']);
			}
			
			if(!empty($data['page']))
			{
				$this->db->offset($data['page']);
			}
			
			if(!empty($data['order_by']))
			{
				$this->db->order_by($data['order_by'], $data['sort_order']);
			}
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('name', $search->term);
					$this->db->or_like('description', $search->term);
					$this->db->group_end();
				}
			}
			

			if($return_count)
			{
				$result = $this->db->get()->num_rows();
				
			}
			else
			{
				$result = $this->db->get()->result();
			}
			
			return $result;
			
		}
	}

	
	function get_all_geo_zone()
	{
		$this->db->order_by('name', 'ASC');
		$result	= $this->db->get('geo_zone')->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function save_geo_zone($data)
	{

        $this->db->trans_start();

        $zone_to_geo_zone = isset($data['zone_to_geo_zone']) ? $data['zone_to_geo_zone'] : array();
        unset($data['zone_to_geo_zone']);

	    if ($data['geo_zone_id'])
		{
			$this->db->where('geo_zone_id', $data['geo_zone_id']);
			$this->db->update('geo_zone', $data);
			$id	= $data['geo_zone_id'];

            if (isset($zone_to_geo_zone) && !empty($zone_to_geo_zone)) {

                $this->db->where('geo_zone_id', $id)->delete('zone_to_geo_zone');

                foreach ($zone_to_geo_zone as $value) {
                    if($value['country_id'] > 0 && $value['zone_id'] > 0 ) {
                        $data = [
                            'country_id' => $value['country_id'],
                            'zone_id' => $value['zone_id'],
                            'geo_zone_id' => $id,
                            'date_added' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('zone_to_geo_zone', $data);
                    }

                }

            }

		}
		else
		{

			$this->db->insert('geo_zone', $data);
			$id	= $this->db->insert_id();

            if (isset($zone_to_geo_zone) && !empty($zone_to_geo_zone)) {

                $this->db->where('geo_zone_id', $id)->delete('zone_to_geo_zone');

                foreach ($zone_to_geo_zone as $value) {
                    if($value['country_id'] > 0 && $value['zone_id'] > 0 ) {
                        $data = [
                            'country_id' => $value['country_id'],
                            'zone_id' => $value['zone_id'],
                            'geo_zone_id' => $id,
                            'date_added' => date('Y-m-d H:i:s'),
                        ];
                        $this->db->insert('zone_to_geo_zone', $data);
                    }

                }

            }

		}

        $this->db->trans_complete();
        return true;
	}
	
	function is_geo_zone_name_already_exist($str, $id=false)
	{
		$this->db->select('name');
		$this->db->from('geo_zone');
		$this->db->where('name', $str);
		if ($id)
		{
			$this->db->where('geo_zone_id !=', $id);
		}
		$count = $this->db->count_all_results();
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

    function getTaxRatesByGeoZoneId($geo_zone_id)
    {
        $this->db->select('name');
        $this->db->from('tax_rate');
        $this->db->where('geo_zone_id', $geo_zone_id);
        $count = $this->db->count_all_results();

        if ($count > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
	
	function get_geo_zone($str, $is_array=false)
	{
		$this->db->select('*');
		$this->db->from('geo_zone');
		$this->db->where('geo_zone_id', $str);
		$result	= $this->db->get()->{($is_array ? 'row_array' : 'row')}();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function get_zone_to_geo_zone($geo_zone_id, $is_array=false)
	{
		$this->db->select('*');
		$this->db->from('zone_to_geo_zone');
		$this->db->where('geo_zone_id', $geo_zone_id);
		$this->db->order_by('zone_to_geo_zone_id', 'ASC');
		$result	= $this->db->get()->{($is_array ? 'result_array' : 'result')}();
		if(!$result)
		{
			return false;
		}
		return $result;
	}
	
	function save_zone_to_geo_zone($data)
	{
		if ($data['zone_to_geo_zone_id'])
		{
			$this->db->where('zone_to_geo_zone_id', $data['zone_to_geo_zone_id']);
			$this->db->update('zone_to_geo_zone', $data);
			$id	= $data['zone_to_geo_zone_id'];
		}
		else
		{
			$this->db->insert('zone_to_geo_zone', $data);
			$id	= $this->db->insert_id();
		}
		
		return $id;
	}
	
	function is_already_exist_zone_to_geo_zone($geo_zone_id, $country_id, $zone_id, $id=false)
	{
		$this->db->select('*');
		$this->db->from('zone_to_geo_zone');
		$this->db->where('geo_zone_id', $geo_zone_id);
		$this->db->where('country_id', $country_id);
		$this->db->where('zone_id', $zone_id);
		if ($id)
		{
			$this->db->where('id !=', $id);
		}
		$count = $this->db->count_all_results();
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

	function delete_zone($geo_zone_id)
	{

        $this->db->trans_start();
        $this->db->where('geo_zone_id', $geo_zone_id)->delete('geo_zone');
        $this->db->where('geo_zone_id', $geo_zone_id)->delete('zone_to_geo_zone');
        $this->db->trans_complete();
        return true;

	}
	
	function get_geo_zone_menu()
	{	
		$countries	= $this->db->order_by('sort_order', 'ASC')->where('enabled', 1)->get('geo_zone')->result();
		$return		= array();
		foreach($countries as $c)
		{
			$c->name = htmlentities($c->name, ENT_QUOTES, 'utf-8', false);
			$return[$c->geo_zone_id] = $c->name;
		}
		return $return;
	}

	/***	Geo Zones ***/
	
}