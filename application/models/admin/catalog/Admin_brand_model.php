<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_brand_model extends Admin_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_brands($data=array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }
        else
        {

            $sql = '*';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('brands');
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
                    $this->db->or_like('brand_id', $search->term);
                    $this->db->group_end();
                }
            }

            if(!empty($search->start_date))
            {
                $this->db->where('DATE(date_added) >=',$search->start_date);
            }

            if(!empty($search->end_date))
            {
                $this->db->where('DATE(date_added) <=',$search->end_date);
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
            }
        }

        if(!$result)
        {
            return false;
        }

//		foreach($result as $key=>&$val)
//                {
//                    $val->child = $this->get_brand_childs($val->brand_id);
//                }

        return $result;
    }

//    public function get_brand_childs($parent_id)
//    {
//        return $this->db->select('*')->from('brands')->where('parent_id', $parent_id)->get()->result();
//    }




    function save($data)
    {

        $success_flag = false;
        $this->db->trans_start();

        if ($data['brand_id'])
        {
            $this->db->where('brand_id', $data['brand_id']);
            if($this->db->update('brands', $data)){
                $success_flag = true;
            }
            $id	= $data['brand_id'];
        }
        else
        {
            if($this->db->insert('brands', $data)){
                $success_flag = true;
            }
            $id	= $this->db->insert_id();
        }


        if($success_flag){
            $this->db->trans_complete();
            return $id;
        }


    }

    function get_brand($id)
    {
        $this->db->select('*');
        $this->db->from('brands');
        $this->db->where(1,1, FALSE);
        $this->db->where('brand_id', $id);
        $result = $this->db->get()->row();
        //echo $this->db->last_query();
        if(!$result)
        {
            return false;
        }

        return $result;
    }

    function get_by_id($id)
    {
        return $this->get_brand($id);
    }


    // DELETE CATEGORY
    public function delete($brand_id)
    {
        $this->db->where('brand_id', $brand_id);
        $this->db->delete('brands');
        return true;
    }

    function is_name_already_exist($str, $id=false)
    {
        $this->db->select('name');
        $this->db->from('brands');
        $this->db->where('name', $str);
        if ($id)
        {
            $this->db->where('brand_id !=', $id);
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

}
