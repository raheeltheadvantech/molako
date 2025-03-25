<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_error_handler_model extends Admin_Model {

	function __construct()
	{
		parent::__construct();
	}

	function get_error($id)
	{
		$this->db->select('*');
		$this->db->from('errors_log');
		$this->db->where('error_log_id', $id);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}
}