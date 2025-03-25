<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_category_model extends User_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_categories($data=array(), $return_count=false)
	{
		if(empty($data) and !$return_count)
		{
			return false;
		}
		else
		{
			$sql = '*';
			if($return_count === TRUE)
			{
				$sql = 'COUNT(*) AS found_total';
			}
			
			$this->db->select($sql);
			$this->db->from('categories');
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
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('name', $search->term);
					$this->db->or_like('category_id', $search->term);
					$this->db->group_end();
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
		
		foreach($result as $key=>&$val)
		{
			$val->item = $this->get_sub_categories($val->parent_id);
		}
		
		return $result;
	}
	
	function get_sub_categories($category_id = false)
	{
		if( intval($category_id) == 0)
		{
			return false;
		}
		
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where(1,1, FALSE);
		$this->db->where('category_id', $category_id);
		$this->db->order_by('name', 'ASC');
		$this->db->limit(1);
		$result = $this->db->get()->row();
		
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}
	
	function get_category($id)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where(1,1, FALSE);
		$this->db->where('category_id', $id);
		$result = $this->db->get()->row();
		//echo $this->db->last_query();
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}
	
	function get_by_id($id)
	{
		return $this->get_category($id);
	}
}