<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_navigation_model extends Admin_Model
{
	function __construct()
	{
		parent::__construct();
	}
	function get_parent_cat()
	{
		$this->db->where('parent_id', 0);
        $query = $this->db->get('ci_categories');
        return $query->result();
	}
	
	function get_navigations($data=array(), $return_count=false)
	{
		if(empty($data) and !$return_count)
		{
			return false;
		}
		else
		{
			$sql = 'n.*';
			if($return_count === TRUE)
			{
				$sql = 'COUNT(*) AS found_total';
			}
			
			$this->db->select($sql);
			$this->db->from('navigations AS n');
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
			else
			{
				$this->db->order_by('sort_order', 'ASC');
			}
			
			//$this->db->order_by('sort_order', 'ASC');
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('n.navigation_id', $search->term);
					$this->db->or_like('n.module', $search->term);
					$this->db->group_end();
				}
			}
			
			
			if(!empty($data['params']))
			{
				foreach($data['params'] as $key=>$val)
				{
					
					$this->db->where($key, $val);
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
				
			}
		}
		
		if(!$result)
		{
			return false;
		}
		
		return $result;
	
	}
	
	function get_by_id($id)
	{
		$this->db->select('n.*');
		$this->db->from('navigations AS n');
		// $this->db->where(1,1, FALSE);
		$this->db->where('n.navigation_id', $id);
		$this->db->limit(1);
		$row = $this->db->get()->row();
		//echo $this->db->last_query();die;
		if(!$row)
		{
			return false;
		}
		
		return $row;
	}

	function get_chlid_by_id($id)
	{
		$this->db->select('n.*');
		$this->db->from('navigations AS n');
		$this->db->where(1,1, FALSE);
		$this->db->where('n.parent_id', $id);
		$this->db->limit(1);
		$row = $this->db->get()->row();
		//echo $this->db->last_query();die;
		if(!$row)
		{
			return false;
		}
		
		return $row;
	}

    function get_parent($id)
    {
        $this->db->select('n.*');
        $this->db->from('navigations AS n');
        $this->db->where(1,1, FALSE);
        $this->db->where('n.parent_id', $id);
        $this->db->limit(1);
        $row = $this->db->get()->row();
        //echo $this->db->last_query();die;
        if(!$row)
        {
            return false;
        }
        
        return $row;
    }


    function is_name_already_exist($str, $id=false)
    {
        $this->db->select('name');
        $this->db->from('navigations');
        $this->db->where('name', $str);
        if ($id)
        {
            $this->db->where('navigation_id !=', $id);
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


    function is_link_already_exist($str, $id=false)
    {
        $this->db->select('module_id');
        $this->db->from('navigations');
        $this->db->where('module_id', $str);
        if ($id)
        {
            $this->db->where('navigation_id !=', $id);
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


    function save($data)
	{
		if ($data['navigation_id'])
		{
			$this->db->where('navigation_id', $data['navigation_id']);
			$this->db->update('navigations', $data);
			$id	= $data['navigation_id'];
		}
		else
		{
			$this->db->insert('navigations', $data);
			$id	= $this->db->insert_id();
		}
		
		return $id;
	}
	
	function delete($navigation_id)
	{
		$this->db->where('navigation_id', $navigation_id);
		$delete = $this->db->delete('navigations');
			
		if($delete)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function organize($data)
	{
		$sequence = 0;
		foreach ($data as $item)
		{
			$this->db->where('slider_id',$item)->update('sliders', array('sort_order'=>$sequence));
			$sequence++;
		}
	}

    function get_navigation_typehead($data=array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }
        else
        {
            $sql = '*';
            $sql = 'navigation_id as value, name as label';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('navigations');
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
                    $this->db->or_like('navigation_id', $search->term);
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

        $navigation = array();

        if(!empty($result)) {
            foreach ($result as $key=>$val) {
                $nav = new stdClass;
                $nav->value = $val->value;
                $nav->label = $this->getparent($val->value);
                $navigation[] = $nav;
            }
        }

        return $navigation;

    }

	function getparent($id)
    {

        $this->db->select('*');
        $this->db->from('navigations');
        $this->db->where('navigation_id', $id);
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

    function get_sub_navigation($navigation_id = false)
	{
		if( intval($category_id) == 0)
		{
			return false;
		}
		
        $this->db->select('*');
        $this->db->from('navigations');
		$this->db->where(1,1, FALSE);
		$this->db->where('navigation_id', $navigation_id);
		$this->db->order_by('navigation_id', 'ASC');
		$this->db->limit(1);
		$result = $this->db->get()->row();
		
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}

	function organize_navigations($navigation)
	{
        
		$data = json_decode($navigation);

		
        $readbleArray = $this->parseJsonArrayy($data);

        // echo'<pre>';print_r($readbleArray);exit;
        if ($readbleArray) {
        	$this->db->truncate('navigations');
        }
        $order = 0;
       foreach($readbleArray as $key => $row)
       {
	   		$params = array(
	            'name' => $row['name'],
	            'slug' => $row['slug'],
	            'module' => $row['module'],
	            'cat_id' => (isset($row['cat_id']) && $row['cat_id'])?$row['cat_id']:0, 
	            'module_id' => $row['module_id'],
	            'is_enabled' => $row['is_enabled'],
	            'sort_order' => $order,
	            'parent_id' => $row['parent_id']
	        );

	        $exist = $this->get_nav_name($row['name']);
	        if(empty($exist)):
	        	$this->db->insert('navigations', $params);
	        endif;
	        
	        if (isset($row['children'])):
	        	$order2=0;
	        	foreach($row['children'] as $key2 => $row2)
	       		{

		        	$params = array(
			            'name' => $row2['name'],
			            'slug' => $row2['slug'],
			            'module' => $row2['module'],
			            'module_id' => $row2['module_id'],
			            'is_enabled' => $row2['is_enabled'],
			            'sort_order' => $order2
			        );

			        $nav = $this->get_nav_name($row['name']);
			        if ($nav) {
			        	$pid = $nav['navigation_id'];
			        }else
			        {
			       		$pid = $row2['parent_id'];
			       	}
			        $params['parent_id'] = $pid;
			        $exist2 = $this->get_nav_name($row2['name']);
			        if(empty($exist2)):
			        	$this->db->insert('navigations', $params);
			        endif;
			        
			        if (isset($row2['children'])) {
			        	$order3= 0;
			        	foreach($row2['children'] as $key3 => $row3)
			       		{
			       			$params = array(
					            'name' => $row3['name'],
					            'slug' => $row3['slug'],
					            'module' => $row3['module'],
					            'module_id' => $row3['module_id'],
					            'is_enabled' => $row3['is_enabled'],
					            'sort_order' => $order3
					        );

					        $nav = $this->get_nav_name($row2['name']);
					        if ($nav) {
					        	$pid = $nav['navigation_id'];
					        }else
					        {
					       		$pid = $row3['parent_id'];
					       	}
					        $params['parent_id'] = $pid;
					        $exist3 = $this->get_nav_name($row3['name']);
					        if(empty($exist3)):
					        	$this->db->insert('navigations', $params);
					        endif;
					        $order3;
			       		}
			       	}
			       	$order2++;
			    }
	        endif;
		$order++;
       }
    }

    function get_nav_name($name)
    {
        $this->db->order_by('navigation_id','desc');
        $this->db->where('name',$name);
        return $this->db->get('navigations')->row_array();
    }

    function parseJsonArrayy($jsonArray, $parentID = 0) 
    {

        $return = array();
        foreach ($jsonArray as $key => $subArray) 
        {
          if (isset($subArray->children)) 
          {
          	$return[] = array('id' => $subArray->id,'name' => $subArray->title,'slug' => $subArray->slug, 'parent_id' => $parentID,'module' => $subArray->module,'module_id' => $subArray->mid,'order' => $subArray->order,'cat_id' => $subArray->cat_id,'is_enabled' => $subArray->enb);
            $return[$key]['children'] = $this->parseJsonArrayy($subArray->children, $subArray->id);
           
          }else{
          	$return[] = array('id' => $subArray->id,'name' => $subArray->title,'slug' => $subArray->slug, 'parent_id' => $parentID,'module' => $subArray->module,'module_id' => $subArray->mid,'order' => $subArray->order,'cat_id' => $subArray->cat_id,'is_enabled' => $subArray->enb); 
          }
        }
        return $return;
      
    }

    function parseJsonArray($jsonArray, $parentID = 0) 
    {

        $return = array();
        foreach ($jsonArray as $subArray) 
        {
           
          $returnSubSubArray = array();
          if (isset($subArray->children)) 
          {
             
               $returnSubSubArray = $this->parseJsonArray($subArray->children, $subArray->id);
           
          }
       
          $return[] = array('id' => $subArray->id,'name' => $subArray->title,'slug' => $subArray->slug, 'parentID' => $parentID,'module' => $subArray->module,'module_id' => $subArray->mid,'islast' => $subArray->islast,'order' => $subArray->order);
          $return = array_merge($return, $returnSubSubArray);
        }
        return $return;
      
    }

    public function navigation_tree($parent_id = 0)
	{
		$this->db->select('navigation_id, name, parent_id');
		$this->db->from('navigations');
		$this->db->where('parent_id', $parent_id);
		$result = $this->db->get()->result();
		
		if(!$result)
		{
			return false;
		}
		
		$return = array();
		foreach($result as $key=>$val)
		{
			$dt = new stdClass();
			$dt->item = $val;
			//$dt->childs = $this->category_tree($val->category_id);
			
			$return[$key] = $this->navigation_tree(0, $dt);
		}
		
		return $return;
	}
       	
}