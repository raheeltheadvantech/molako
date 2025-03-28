<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_slider_model extends User_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_sliders()
	{
		$this->db->select('c.*');
		$this->db->from('sliders AS c');
		$this->db->where(1,1, FALSE);
		$this->db->where('is_enabled',1);
		$this->db->order_by('sort_order', 'ASC');
		$result = $this->db->get()->result();
		
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}
}