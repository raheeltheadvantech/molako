<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_category_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	
	function get_categories($data=array(), $return_count=false)
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
			$this->db->from('categories');
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
					$this->db->or_like('category_id', $search->term);
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
		
		foreach($result as $key=>&$val)
		{
			$val->item = $this->getparent($val->category_id);
		}
		
		return $result;
	}
    function get_category_typehead($data=array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }
        else
        {
            $sql = '*';
            $sql = 'category_id as value, name as label';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('categories');
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
                    $this->db->or_like('category_id', $search->term);
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

        $category = array();

        if(!empty($result)) {
            foreach ($result as $key=>$val) {
                $cat = new stdClass;
                $cat->value = $val->value;
                $cat->label = $this->getparent($val->value);
                $category[] = $cat;
            }
        }

        return $category;

    }


    function get_category_typehead2($data=array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }
        else
        {
            $sql = '*';
            $sql = 'category_id as value, name as label';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('categories');
            $this->db->where(1,1, FALSE);
            $this->db->where_not_in('category_id',$data['category_id']);

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
                    $this->db->or_like('category_id', $search->term);
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

        $category = array();

        if(!empty($result)) {
            foreach ($result as $key=>$val) {
                $cat = new stdClass;
                $cat->value = $val->value;
                $cat->label = $this->getparent($val->value);
                $category[] = $cat;
            }
        }

        return $category;

    }

    function get_all_categories()
    {
        $this->db->select('category_id, name');
        $this->db->from('categories');
        $this->db->where(1,1, FALSE);
        //$this->db->where('parent_id', 0);
        $this->db->order_by('name', 'ASC');

        $result = $this->db->get()->result();

        if(!$result)
        {
            return false;
        }

        return $result;
    }


    function getparent($id)
    {

        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('category_id', $id);
        $result = $this->db->get()->result_array();

        if (!$result) {
            return false;
        }

        foreach ($result as $row) {
            if ($row['parent_id'] != 0) {
                $name = $this->getparent($row['parent_id']) . ' > ' . $row['name'];
            } else {
                $name = $row['name'];
            }
        }

        return $name;
    }



	function get_sub_categories($category_id = false)
	{
		if( intval($category_id) == 0)
		{
			return false;
		}
		
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where(1,1, FALSE);
		$this->db->where('category_id', $category_id);
		$this->db->order_by('name', 'ASC');
		$this->db->limit(1);
		$result = $this->db->get()->row();
		
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}
	
	
	function save($data)
	{
		$success_flag = false;
		$this->db->trans_start();


		if ($data['category_id'])
		{
			$this->db->where('category_id', $data['category_id']);
			if($this->db->update('categories', $data)){
				$success_flag = true;
			}
			$id	= $data['category_id'];
		}
		else
		{
			if($this->db->insert('categories', $data)){
				$success_flag = true;
			}
			$id	= $this->db->insert_id();
		}

		if($success_flag){
			$this->db->trans_complete();
			return $id;
		}
	}
	
	function get_category($id)
	{
		$this->db->select('*');
		$this->db->from('categories');
		$this->db->where(1,1, FALSE);
		$this->db->where('category_id', $id);
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
		return $this->get_category($id);
	}


	
	function delete_item_bulk($filter_category_id)
	{
		$this->db->where('filter_category_id', $filter_category_id);
		$this->db->delete('filter_category_items');
	}
	
	function save_item_bulk($data)
	{
		if ($data['unique_id'])
		{
			$this->db->insert('filter_category_items', $data);
		}

		return TRUE;
	}

    // DELETE CATEGORY
    public function delete($category_id)
    {
        $this->db->where('category_id', $category_id);
        $this->db->delete('categories');
        return true;
    }


    function is_name_already_exist($str, $id=false)
    {
        $this->db->select('name');
        $this->db->from('categories');
        $this->db->where('name', $str);
        if ($id)
        {
            $this->db->where('category_id !=', $id);
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


    function is_parent_already_child($parent_id, $id=false)
    {
        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('category_id', $parent_id);
        $result = $this->db->get()->row();
        //echo $this->db->last_query();

        if(!$result)
        {
            return false;
        }

        if ($result->parent_id == $id)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
