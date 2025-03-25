<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_search_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function record_term($term)
	{
		$code	= md5($term);
		$this->db->where('code', $code);
		$exists	= $this->db->count_all_results('search_a');
		if ($exists < 1)
		{
			$this->db->insert('search_a', array('code'=>$code, 'term'=>$term));
		}
		
		return $code;
	}
	
	function get_term($code)
	{
		$this->db->select('term');
		$result	= $this->db->get_where('search_a', array('code'=>$code));
		$result	= $result->row();
		
		return $result->term;
	}
}