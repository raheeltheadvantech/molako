<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Phone_formats
{
	var $CI;

	function __construct()
	{
		$this->CI =& get_instance();
		$this->CI->load->database();
	}
	
	function get_phone_formats()
	{
		$this->CI->db->select('*');
		//$this->CI->db->where();
		$result = $this->CI->db->get('phone_formats');
		$result	= $result->result();
		
		if(!$result)
		{
			return false;
		}
		return $result;
	}
}