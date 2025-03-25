<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_tax_rate_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	/***	Tax Rate ***/

    function get_tax_rates($data=array(), $return_count=false)
    {
        if(empty($data))
        {

            return $this->get_all_tax_rate();
        }
        else
        {
            $this->db->select("*", FALSE);
            $this->db->from('tax_rate');
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
                    $this->db->group_end();
                }
            }


            if($return_count)
            {
               return  $result = $this->db->get()->num_rows();

            }
            else
            {
                $result = $this->db->get()->result();

            }


            foreach($result as $key=>$val)
            {
                if($val->type == 'P')
                    $val->type = 'Percentage';
                else
                    $val->type = 'Fixed Amount';

                $val->geo_zone_id = $this->get_geo_zone_name($val->geo_zone_id);

            }

            return $result;

        }
    }


    function get_geo_zone_name($id)
    {
        $this->db->select('name');
        $this->db->from('geo_zone');
        $this->db->where('geo_zone_id', $id);
        $result	= $this->db->get()->row();
        if(!$result)
        {
            return false;
        }

        return $result->name;
    }

    function get_geo_zone()
    {
        $this->db->select('*');
        $this->db->from('geo_zone');
        $result	= $this->db->get()->result();
        if(!$result)
        {
            return false;
        }
        return $result;
    }



    function get_all_tax_rate()
    {
        $this->db->order_by('name', 'ASC');
        $result	= $this->db->get('tax_rate')->result();
        if(!$result)
        {
            return false;
        }

        return $result;
    }


    function is_tax_rate_name_already_exist($str, $id=false)
    {
        $this->db->select('name');
        $this->db->from('tax_rate');
        $this->db->where('name', $str);
        if ($id)
        {
            $this->db->where('tax_rate_id !=', $id);
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


    function getTaxClassByTaxRateId($tax_rate_id)
    {
        $this->db->select('tax_class_id');
        $this->db->from('tax_rule');
        $this->db->where('tax_rate_id', $tax_rate_id);
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


    function save_geo_zone($data)
    {

        $this->db->trans_start();

        if ($data['tax_rate_id'])
        {
            $this->db->where('tax_rate_id', $data['tax_rate_id']);
            $this->db->update('tax_rate', $data);
            $id	= $data['tax_rate_id'];
        }
        else
        {

            $this->db->insert('tax_rate', $data);
            $id	= $this->db->insert_id();
        }

        $this->db->trans_complete();
        return true;
    }

    function delete_rate($tax_rate_id)
    {

        $this->db->where('tax_rate_id', $tax_rate_id)->delete('tax_rate');
        return true;

    }

    //old functionssssssss====================


	function tax_rates($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			return $this->get_all_tax_rates();
		}
		else
		{
			$this->db->select("*", FALSE);
			$this->db->from('tax_rate');
			$this->db->where(1,1, FALSE);
			$this->db->where('enabled', 1);
			
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
	
	function get_all_tax_rates()
	{
		$this->db->order_by('name', 'ASC');
		$result	= $this->db->get('tax_rate')->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}



	function save_tax_rate($data)
	{
		if ($data['tax_rate_id'])
		{
			$this->db->where('tax_rate_id', $data['tax_rate_id']);
			$this->db->update('tax_rate', $data);
			$id	= $data['tax_rate_id'];
		}
		else
		{
			$this->db->insert('tax_rate', $data);
			$id	= $this->db->insert_id();
		}
		
		return $id;
	}
	
	function is_already_exist_tax_rate_name($str, $id=false)
	{
		$this->db->select('name');
		$this->db->from('tax_rate');
		$this->db->where('name', $str);
		if ($id)
		{
			$this->db->where('tax_rate_id !=', $id);
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
	
	function get_tax_rate($str, $is_array=false)
	{
		$this->db->select('*');
		$this->db->from('tax_rate');
		$this->db->where('tax_rate_id', $str);
		$result	= $this->db->get()->{($is_array ? 'row_array' : 'row')}();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function delete_tax_rate($tax_rate_id)
	{
		$this->db->where('tax_rate_id', $tax_rate_id);
		return $this->db->delete('tax_rate');
	}
	
	function get_tax_rate_menu()
	{	
		$countries	= $this->db->order_by('sort_order', 'ASC')->where('enabled', 1)->get('tax_rates')->result();
		$return		= array();
		foreach($countries as $c)
		{
			$c->name = htmlentities($c->name, ENT_QUOTES, 'utf-8', false);
			$return[$c->tax_rate_id] = $c->name;
		}
		return $return;
	}

	/***	Tax Rate ***/

	/***	Tax Category ***/
	
	function tax_categories($data=array(), $return_count=false)
	{
		if(empty($data))
		{
			return $this->get_all_tax_categories();
		}
		else
		{
			$this->db->select("*", FALSE);
			$this->db->from('tax_categories');
			$this->db->where(1,1, FALSE);
			$this->db->where('enabled', 1);
			
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
	
	function get_all_tax_categories()
	{
		$this->db->order_by('name', 'ASC');
		$result	= $this->db->get('tax_categories')->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function get_tax_categories()
	{
		$this->db->select("*", FALSE);
		$this->db->from('tax_categories');
		$this->db->where(1,1, FALSE);
		$this->db->where('enabled', 1);
		$this->db->order_by('name', 'ASC');
		$result	= $this->db->get()->result();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function save_tax_category($data)
	{
		if ($data['tax_category_id'])
		{
			$this->db->where('tax_category_id', $data['tax_category_id']);
			$this->db->update('tax_categories', $data);
			$id	= $data['tax_category_id'];
		}
		else
		{
			$this->db->insert('tax_categories', $data);
			$id	= $this->db->insert_id();
		}
		
		return $id;
	}
	
	function is_already_exist_tax_category_name($str, $id=false)
	{
		$this->db->select('name');
		$this->db->from('tax_categories');
		$this->db->where('name', $str);
		if ($id)
		{
			$this->db->where('tax_category_id !=', $id);
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
	
	function get_tax_category($str, $is_array=false)
	{
		$this->db->select('*');
		$this->db->from('tax_categories');
		$this->db->where('tax_category_id', $str);
		$result	= $this->db->get()->{($is_array ? 'row_array' : 'row')}();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function delete_tax_category($tax_category_id)
	{
		$this->db->where('tax_category_id', $tax_category_id);
		return $this->db->delete('tax_categories');
	}

	function get_tax_rate_to_categories($tax_category_id, $is_array=false)
	{
		$this->db->select('*');
		$this->db->from('tax_rules');
		$this->db->where('tax_category_id', $tax_category_id);
		$this->db->order_by('tax_rule_id', 'ASC');
		$result	= $this->db->get()->{($is_array ? 'result_array' : 'result')}();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function save_tax_rate_to_category($data)
	{
		if ($data['tax_rule_id'])
		{
			$this->db->where('tax_rule_id', $data['tax_rule_id']);
			$this->db->update('tax_rules', $data);
			$id	= $data['tax_rule_id'];
		}
		else
		{
			$this->db->insert('tax_rules', $data);
			$id	= $this->db->insert_id();
		}
		
		return $id;
	}
	
	function is_already_exist_tax_rate_to_category($tax_category_id, $tax_rate_id, $based_on, $id=false)
	{
		$this->db->select('*');
		$this->db->from('tax_rules');
		$this->db->where('tax_category_id', $tax_category_id);
		$this->db->where('tax_rate_id', $tax_rate_id);
		$this->db->where('based_on', $based_on);
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

	function delete_tax_rate_to_category($tax_category_id)
	{
		$this->db->where('tax_category_id', $tax_category_id);
		return $this->db->delete('tax_rules');
	}

	/***	Tax Category ***/
	
}