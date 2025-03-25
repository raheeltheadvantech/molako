<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_navigation_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_navigations($data=array(), $return_count=false)
	{
		if(empty($data) and !$return_count)
		{
			return false;
		}
		else
		{
			$sql = 'n.*';
			if($return_count === TRUE)
			{
				$sql = 'COUNT(*) AS found_total';
			}
			
			$this->db->select($sql);
			$this->db->from('navigations AS n');
			$this->db->where(1,1, FALSE);
			
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
			}
			else
			{
				$this->db->order_by('sort_order', 'ASC');
			}
			
			//$this->db->order_by('sort_order', 'ASC');
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('n.navigation_id', $search->term);
					$this->db->or_like('n.name', $search->term);
					$this->db->group_end();
				}
			}
			
			if(!empty($data['params']))
			{
				foreach($data['params'] as $key=>$val)
				{
					$this->db->where($key, $val);
				}
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
	
	function get_by_id($id)
	{
		$this->db->select('n.*');
		$this->db->from('navigations AS n');
		$this->db->where(1,1, FALSE);
		$this->db->where('n.navigation_id', $id);
		$this->db->limit(1);
		$row = $this->db->get()->row();
		//echo $this->db->last_query();die;
		if(!$row)
		{
			return false;
		}
		
		return $row;
	}


    function is_name_already_exist($str, $id=false)
    {
        $this->db->select('name');
        $this->db->from('navigations');
        $this->db->where('name', $str);
        if ($id)
        {
            $this->db->where('navigation_id !=', $id);
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


    function is_link_already_exist($str, $id=false)
    {
        $this->db->select('link');
        $this->db->from('navigations');
        $this->db->where('link', $str);
        if ($id)
        {
            $this->db->where('navigation_id !=', $id);
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


    function save($data)
	{
		if ($data['navigation_id'])
		{
			$this->db->where('navigation_id', $data['navigation_id']);
			$this->db->update('navigations', $data);
			$id	= $data['navigation_id'];
		}
		else
		{
			$this->db->insert('navigations', $data);
			$id	= $this->db->insert_id();
		}
		
		return $id;
	}
	
	function delete($navigation_id)
	{
		$this->db->where('navigation_id', $navigation_id);
		$delete = $this->db->delete('navigations');
			
		if($delete)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function organize($data)
	{
		$sequence = 0;
		foreach ($data as $item)
		{
			$this->db->where('slider_id',$item)->update('sliders', array('sort_order'=>$sequence));
			$sequence++;
		}
	}
}