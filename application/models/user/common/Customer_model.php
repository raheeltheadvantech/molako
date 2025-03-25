<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_model extends User_Model {

	function __construct()
	{
		parent::__construct();
	}
	
	function get_by_id($id)
	{
		$this->db->select('*');
		$this->db->where('customer_id', $id);
		$result	= $this->db->get('customers');
		$result	= $result->row();
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}		

	function save($data)
	{
		if ($data['customer_id'])
		{
			$this->db->where('customer_id', $data['customer_id']);
			$this->db->update('customers', $data);
			$id	= $data['customer_id'];
		}
		else
		{
			$this->db->insert('customers', $data);
			$id	= $this->db->insert_id();
		}
		
		return $id;
	}

	function is_already_exist($str, $id=false)
	{
		$this->db->select('customer_id');
		$this->db->from('customers');
		$this->db->where('email', $str);
		if ($id)
		{
			$this->db->where('customer_id !=', $id);
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
	
	function get_by_email($str)
	{
		$this->db->select('*');
		$this->db->from('customers');
		$this->db->where('email', $str);
		$result	= $this->db->get()->row();
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}

	function save_forget_token($data){
	    $success = false;
	    if(isset($data['customer_password_reset_request_id'])){
            $this->db->where('customer_password_reset_request_id', $data['customer_password_reset_request_id'])->update('customers_password_reset_requests', $data);
        }else{
            $this->db->insert('customers_password_reset_requests', $data);
            $success = $this->db->insert_id();
        }
        return $success;
    }
    function get_forget_token($user_id){
        $this->db->select('*');
        $this->db->from('customers_password_reset_requests');
        $this->db->where('customer_id', $user_id);
        $this->db->where('is_used', '0');
        $this->db->order_by('date_added', 'DESC');
        return $this->db->get()->row();
    }

	
}
// END User_model class

/* End of file User_model.php */
/* Location: ./application/models/user/User_model.php */