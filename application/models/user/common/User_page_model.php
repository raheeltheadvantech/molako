<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_page_model extends User_Model
{
		
	function __construct()
	{
		parent::__construct();
	}
	
	function get_page($slug)
	{
		$this->db->where('slug', $slug);
		$result = $this->db->get('pages')->row();
		return $result;
	}
	
	function get_pages($enabled=false)
	{
		$this->db->order_by('sequence', 'ASC');
		// $this->db->where('parent_id', $parent);

		if($enabled != FALSE)
		$this->db->where('enabled', 1);
		
		$result = $this->db->get('pages')->result();
		//echo $this->db->last_query();
		
		$return	= array();
		foreach($result as $page)
		{
			$return[$page->id]				= $page;
			// $return[$page->id]->children	= $this->get_pages($enabled);
		}
		// echo'<pre>';print_r($return);die;
		return $return;
	}
	
	/***	Pages	 ***/
	
	/***	Page Contents	***/
	
	function get_page_content($id)
	{
		$this->db->select('*');
		$this->db->from('page_contents');
		$this->db->where('page_content_id', $id);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}

	function get_page_contents($id, $culture_code = 'en-US')
	{
		$this->db->select('*');
		$this->db->from('page_contents');
		$this->db->where('page_id', $id);
		$this->db->where('culture_code', $culture_code);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}
	/***	Page Contents	***/
	
}