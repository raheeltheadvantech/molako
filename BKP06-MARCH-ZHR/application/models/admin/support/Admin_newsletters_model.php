<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_newsletters_model extends Admin_Model {

	function __construct()
	{
		parent::__construct();
	}

    public function get_newsletters_list($data = array(), $return_count=false)
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

            $this->db->order_by('newsletter_id','DESC');
            $this->db->select($sql);
            $this->db->from('newsletters');
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
                    $this->db->like('name', $search->term);
                    $this->db->or_like('email', $search->term);
                    $this->db->group_end();
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
    }

}
