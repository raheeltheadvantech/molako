<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_page_model extends Admin_Model
{
		
	function __construct()
	{
		parent::__construct();
	}
	
	/********************************************************************
	Page functions
	********************************************************************/
	function get_pages($data=array(), $return_count=false,$enabled=false)
	{
		if(empty($data) and !$return_count)
		{
			$this->db->order_by('id', 'ASC');
			if($enabled != FALSE)
			$this->db->where('enabled', 1);
			
			$result = $this->db->get('pages')->result();
			if(!$result)
			{
				return false;
			}
			$return	= array();
			foreach($result as $page)
			{
				$return[$page->id]				= $page;
				$return[$page->id]->children	= $this->get_pages($page->id, $enabled);
			}
			return $return;
		}
		else
		{
			$sql = 'pages.*';
			if($return_count === TRUE)
			{
				$sql = 'COUNT(*) AS found_total';
			}
			
			$this->db->select($sql);
			$this->db->from('pages');
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
				$this->db->order_by('id', 'ASC');
			}
			
			// $this->db->order_by('id', 'ASC');
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('id', $search->term);
					$this->db->or_like('title', $search->term);
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
	
	function get_page($id)
	{
		$this->db->where('id', $id);
		$result = $this->db->get('pages')->row();
		
		return $result;
	}
	
	function get_slug($id)
	{
		$page = $this->get_page($id);
		if($page) 
		{
			return $page->slug;
		}
	}
	
	function save($data)
	{
		if($data['id'])
		{
			$this->db->where('id', $data['id']);
			$this->db->update('pages', $data);
			return $data['id'];
		}
		else
		{
			$this->db->insert('pages', $data);
			return $this->db->insert_id();
		}
	}
	
	function delete_page($id)
	{
		//delete the page
		$this->db->where('id', $id);
		$this->db->delete('pages');
	
	}
	
	function get_page_by_slug($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('pages')->row();
		
		return $result;
	}
	
}