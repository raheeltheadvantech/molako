<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User_support_model extends User_Model {

	function __construct()
	{
		parent::__construct();
	}

    public function save($data)
    {
        $this->db->insert('newsletters', $data);
        return $this->db->insert_id();
    }
    public function delete($email)
    {
        $this->db->where('email', $email)->delete('newsletters');
        return true;
    }

    public function is_already_exist($str, $id=false)
    {
        $this->db->select('email');
        $this->db->from('newsletters');
        $this->db->where('email', $str);
        if ($id)
        {
            $this->db->where('newsletter_id !=', $id);
        }
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

    // **********************************************

	public function is_already_exist1($str, $id=false)
    {
        $this->db->select('email');
        $this->db->from('support');
        $this->db->where('email', $str);
        if ($id)
        {
            $this->db->where('support_id !=', $id);
        }
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

    public function save1($data)
    {
        $this->db->insert('support', $data);
		return $this->db->insert_id();
	}

    public function save_webinar1($data)
    {
        $this->db->insert('webinar_registration', $data);
        return $this->db->insert_id();
    }

	public function delete1($email)
    {
        $this->db->where('email', $email)->delete('support');
        return true;
	}
}
