<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_customer_model extends Admin_Model {

	function __construct()
	{
		parent::__construct();
	}

    public function get_customers($data = array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }else{
            $sql = '*';
            if($return_count === TRUE) 
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('customers');
            $this->db->where(1,1, FALSE);

            if(!empty($data['rows']))
            {
                $this->db->limit($data['rows']);
            }

            if(!empty($data['per_page']))
            {
                $this->db->offset($data['per_page']);
            }

            if(!empty($data['order']))
            {
                $this->db->order_by($data['order'], $data['sort']);
            }

            if(!empty($data['term']))
            {
                $search	= json_decode($data['term']);
                if(!empty($search->term))
                {
                    $this->db->group_start();
                    $this->db->like('first_name', $search->term);
                    $this->db->or_like('last_name', $search->term);
                    $this->db->or_like('email', $search->term);
                    $this->db->or_like('phone', $search->term);
                    $this->db->group_end();
                }

                if($search->is_enabled != -1){
                    $this->db->where('is_enabled', $search->is_enabled);
                }
            }


            if($return_count)
            {
                $result = $this->db->get()->row();
                if(!$result)
                {
                    return false;
                }

                return $result->found_total;
            }
            else
            {
                $result = $this->db->get()->result();
                
                /*echo "<pre>";
                print_r($this->db->last_query());
                echo "</pre>";
                exit;*/
            }

            if(!$result)
            {
                return false;
            }

            return $result;
            
        }
        //return $this->db->select('*')->from('customers')->order_by('date_added','DESC')->get()->result();
    }

    // DELETE CUSTOMER
    public function delete($customer_id)
    {
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('customers');
        return true;
    }

    public function get_customer_addresses($customer_id)
    {
        return $this->db->select('*')->from('address')->where('customer_id',$customer_id)->get()->result();
    }
    public function get_customer($customer_id)
    {
        return $this->db->select('*')->from('customers')->where('customer_id',$customer_id)->get()->row();
    }

    public function get_customer_address($address_id)
    {
        return $this->db->select('*')->from('address')->where('address_id',$address_id)->get()->row();
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

    function save_address($data)
    {
        if (isset($data['address_id']))
        {
            $this->db->where('address_id', $data['address_id']);
            $this->db->update('address', $data);
            $id	= $data['address_id'];
        }
        else
        {
            if($this->db->insert('address', $data)){
                $id	= $this->db->insert_id();
            }

        }

        return $id;
    }


}
