<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_tax_class_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/***	Geo Zones ***/
	
	function get_tax_classes($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			return $this->get_all_tax_class();
		}
		else
		{
			$this->db->select("*", FALSE);
			$this->db->from('tax_class');
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
					$this->db->like('title', $search->term);
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

	
	function get_all_tax_class()
	{
		$this->db->order_by('title', 'DESC');
		$result	= $this->db->get('tax_class')->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}



    function get_tax_rate()
    {
        $this->db->select('*');
        $this->db->from('tax_rate');
        $result	= $this->db->get()->result();
        if(!$result)
        {
            return false;
        }
        return $result;
    }


    function is_tax_class_name_already_exist($str, $id=false)
    {
        $this->db->select('title');
        $this->db->from('tax_class');
        $this->db->where('title', $str);
        if ($id)
        {
            $this->db->where('tax_class_id !=', $id);
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


    function save_tax_class($data)
	{

        $this->db->trans_start();

        $tax_rule = isset($data['tax_rule']) ? $data['tax_rule'] : array();
        unset($data['tax_rule']);

	    if ($data['tax_class_id'])
		{
			$this->db->where('tax_class_id', $data['tax_class_id']);
			$this->db->update('tax_class', $data);
			$id	= $data['tax_class_id'];

            if (isset($tax_rule) && !empty($tax_rule)) {

                $this->db->where('tax_class_id', $id)->delete('tax_rule');

                foreach ($tax_rule as $value) {
                    if($value['tax_rate_id'] > 0 ) {
                        $data = [
                            'tax_class_id' => $id,
                            'tax_rate_id' => $value['tax_rate_id'],
                            'based' => $value['based'],
                            'priority' => $value['priority'],
                        ];
                        $this->db->insert('tax_rule', $data);
                    }

                }

            }

		}
		else
		{

			$this->db->insert('tax_class', $data);
			$id	= $this->db->insert_id();

            if (isset($tax_rule) && !empty($tax_rule)) {

                $this->db->where('tax_class_id', $id)->delete('tax_rule');

                foreach ($tax_rule as $value) {
                    if($value['tax_rate_id'] > 0 ) {
                        $data = [
                            'tax_class_id' => $id,
                            'tax_rate_id' => $value['tax_rate_id'],
                            'based' => $value['based'],
                            'priority' => $value['priority'],
                        ];
                        $this->db->insert('tax_rule', $data);
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
	
	function get_tax_class($str, $is_array=false)
	{
		$this->db->select('*');
		$this->db->from('tax_class');
		$this->db->where('tax_class_id', $str);
		$result	= $this->db->get()->{($is_array ? 'row_array' : 'row')}();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function get_tax_rule($tax_rule_id, $is_array=false)
	{
		$this->db->select('*');
		$this->db->from('tax_rule');
		$this->db->where('tax_class_id', $tax_rule_id);
		$this->db->order_by('tax_rule_id', 'ASC');
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

	function delete_tax_class($tax_class_id)
	{

        $this->db->trans_start();
        $this->db->where('tax_class_id', $tax_class_id)->delete('tax_class');
        $this->db->where('tax_class_id', $tax_class_id)->delete('tax_rule');
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