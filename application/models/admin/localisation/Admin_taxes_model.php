<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_taxes_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_taxes($data=array(), $return_count=false)
	{
		if(empty($data) and !$return_count)
		{
			return false;
		}
		else
		{
			$sql = 't.*';
			if($return_count === TRUE)
			{
				$sql = 'COUNT(*) AS found_total';
			}
			
			$this->db->select($sql);
			$this->db->from('taxes AS t');
			$this->db->where(1,1, FALSE);
			
			if(!empty($data['rows']))
			{
				$this->db->limit($data['rows']);
			}
			
			if(!empty($data['per_page']))
			{
				$this->db->offset($data['per_page']);
			}
			
			$this->db->order_by('country_id', 'ASC');
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('t.tax_id', $search->term);
					//$this->db->or_like('c.name', $search->term);
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
		$this->db->select('t.*');
		$this->db->from('taxes AS t');
		$this->db->where(1,1, FALSE);
		$this->db->where('t.tax_id', $id);
		$this->db->limit(1);
		$row = $this->db->get()->row();
		//echo $this->db->last_query();die;
		if(!$row)
		{
			return false;
		}
		
		return $row;
	}
	
	function save($data)
	{
		if ($data['tax_id'])
		{
			$this->db->where('tax_id', $data['tax_id']);
			$this->db->update('taxes', $data);
			$id	= $data['tax_id'];
		}
		else
		{
			$this->db->insert('taxes', $data);
			$id	= $this->db->insert_id();
		}
		
		return $id;
	}
	
	function delete($tax_id)
	{
		$this->db->where('tax_id', $tax_id);
		$delete = $this->db->delete('taxes');
			
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
			$this->db->where('tax_id',$item)->update('taxes', array('sort_order'=>$sequence));
			$sequence++;
		}
	}
}