<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Misc_model extends CI_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_phone_formats()
	{
		$this->db->select('*');
		$this->db->from('phone_formats');
		$this->db->where('enabled', 1);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function get_phone_format_menu()
	{
		$result = array();
		$data = $this->get_phone_formats(array('enabled'=>1));
		
		if(is_array($data)):
		foreach($data  as $key=>$val)
		{
			$result[$val->format] = $val->format;
		}
		endif;
		
		return $result;
	}

	function get_calendar_codes()
	{
		$this->db->select('*');
		$this->db->from('calendar_codes');
		$this->db->where('enabled', 1);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		return $result;
	}

	function get_calendar_code_menu()
	{
		$result = array();
		$data = $this->get_calendar_codes(array('enabled'=>1));
		
		if(is_array($data)):
		foreach($data  as $key=>$val)
		{
			$result[$val->format] = $val->name;
		}
		endif;
		
		return $result;
	}

}