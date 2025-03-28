<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_length_model extends Admin_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_lengths()
	{
		$this->db->select('*');
		$result = $this->db->get('length_class')->result();
		if(!$result)
		{
			return false;
		}
		
		return false;
	}
	
	function get_length($length_class_id)
	{
		$this->db->where('length_class_id', $length_class_id);
		$result = $this->db->get('length_class')->row();
		if(!$result)
		{
			return false;
		}
		
		return false;
	}

    function get_length_unit($length_class_id)
    {
        $this->db->where('length_class_id', $length_class_id);
        $result = $this->db->get('length_class')->row();
        if(!$result)
        {
            return false;
        }

        return $result->title;
    }
	
	function get_lengths_menu()
	{
		$this->db->select('*');
		$result = $this->db->get('length_class')->result();
		if(!$result)
		{
			return false;
		}
		
		$return = array();
		foreach($result as $key=>$val)
		{
			$return[$val->length_class_id] = $val->title;
		}
		
		return $return;
	}
}	