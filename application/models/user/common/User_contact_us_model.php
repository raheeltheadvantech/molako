<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_contact_us_model extends User_Model {

	function __construct()
	{
		parent::__construct();
	}

	function is_already_exist($str)
	{
		$this->db->from('newsletters');
		$this->db->where('email', $str);
		
		$count = $this->db->count_all_results();
		
		if ($count > 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}

    public function save($data)
    {
        $this->db->insert('contact_us', $data);
		return $this->db->insert_id();
	}

	public function save_newsletter($data)
    {
        $this->db->insert('newsletters', $data);
		return $this->db->insert_id();
	}

}
