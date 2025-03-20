<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_weight_model extends Admin_Model 
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_weights()
	{
		$this->db->select('*');
		$result = $this->db->get('weight_class')->result();
		if(!$result)
		{
			return false;
		}
		
		return false;
	}

    function get_weight($weight_class_id)
    {
        $this->db->where('weight_class_id', $weight_class_id);
        $result = $this->db->get('weight_class')->row();
        if(!$result)
        {
            return false;
        }

        return false;
    }

    function get_weight_unit($weight_class_id)
    {
        $this->db->where('weight_class_id', $weight_class_id);
        $result = $this->db->get('weight_class')->row();
        if(!$result)
        {
            return false;
        }

        return $result->title;
    }

	function get_weights_menu()
	{
		$this->db->select('*');
		$result = $this->db->get('weight_class')->result();
		if(!$result)
		{
			return false;
		}
		
		$return = array();
		foreach($result as $key=>$val)
		{
			$return[$val->weight_class_id] = $val->title;
		}
		
		return $return;
	}

}	