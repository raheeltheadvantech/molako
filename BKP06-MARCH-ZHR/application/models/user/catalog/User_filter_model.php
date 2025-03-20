<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_filter_model extends User_Model
{
	function __construct()
	{
		parent::__construct();
	}

	// TO-DO: WE NEED TO WRITE CODE FOR THIS FUNCTION
	function get_filter_brands($data=array(), $return_count=false)
	{
		$sql = 'fc.*';
		
		if($return_count === TRUE)
		{
			$sql = 'COUNT(fb.*) AS found_total';
		}
		else
		{
			$this->db->distinct();
		}

		$this->db->select($sql);
		$this->db->from('filter_categories fc');
		if(!empty($data['brand_id']))
		{
			$this->db->join('brand_filters_association bfa', 'bfa.filter_category_id = fc.filter_category_id');
			$this->db->where('bfa.brand_id',$data['brand_id']);
		}
		
		$this->db->where('fc.is_enabled',1, FALSE);

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

		/*echo "<pre>";
		print_r($this->db->last_query());
		echo "</pre>";
		exit();*/

		if(!$result)
		{
			return false;
		}

		return $result;
	}

	function get_filter_categories($data=array(), $return_count=false)
	{
		$sql = 'fc.*';
		if($return_count === TRUE)
		{
			$sql = 'COUNT(fc.*) AS found_total';
		}
		else
		{
			$this->db->distinct();
		}

		$this->db->select($sql);
		$this->db->from('filter_categories fc');
		
		if(!empty($data['category_id']))
		{
			$this->db->select('cfa.sort_order');
			$this->db->join('category_filters_association cfa', 'cfa.filter_category_id = fc.filter_category_id');
			
			if(is_array($data['category_id']))
			{
				$this->db->where_in('cfa.category_id', $data['category_id']);
			}
			else
			{
				$this->db->where('cfa.category_id', $data['category_id']);
			}
			
			$this->db->order_by('cfa.sort_order', 'ASC');
		}
		else if(!empty($data['brand_id']))
		{
			$this->db->select('bfa.sort_order');
			$this->db->join('brand_filters_association bfa', 'bfa.filter_category_id = fc.filter_category_id');
			
			if(is_array($data['brand_id']))
			{
				$this->db->where_in('bfa.brand_id', $data['brand_id']);
			}
			else
			{
				$this->db->where('bfa.brand_id', $data['brand_id']);
			}
			
			$this->db->order_by('bfa.sort_order', 'ASC');
		}
		
		$this->db->where('fc.is_enabled',1, FALSE);

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
			//$this->db->order_by($data['order'], $data['sort']);
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

		//echo $this->db->last_query();

		if(!$result)
		{
			return false;
		}

		return $result;
	}

	public function get_filter_category_items($category_id, $param = array())
	{
		if(!empty($param['category_id']))
		{
			$this->db->distinct('fci.filter_category_item_id');
			$this->db->select('fci.*');
			$this->db->from('filter_category_items fci');
			$this->db->join('filter_categories fc', 'fc.filter_category_id = fci.filter_category_id');
			$this->db->join('category_filters_association cfa', 'cfa.filter_category_item_id = fci.filter_category_item_id');
			$this->db->where('fc.filter_category_id', $category_id);
			
			if(is_array($param['category_id']))
			{
				$this->db->where_in('cfa.category_id', $param['category_id']);
			}
			else
			{
				$this->db->where('cfa.category_id', $param['category_id']);
			}
			
			$this->db->where('fci.is_enabled', 1);
			// $this->db->order_by('fci.filter_category_item_id', 'ASC');
			$this->db->order_by('fci.name', 'ASC');
		}
		elseif(!empty($param['brand_id']))
		{
			$this->db->distinct('fci.filter_category_item_id');
			$this->db->select('fci.*');
			$this->db->from('filter_category_items fci');
			$this->db->join('filter_categories fc', 'fc.filter_category_id = fci.filter_category_id');
			$this->db->join('brand_filters_association bfa', 'bfa.filter_category_item_id = fci.filter_category_item_id');
			$this->db->where('fc.filter_category_id', $category_id);
			
			if(is_array($param['brand_id']))
			{
				$this->db->where_in('bfa.brand_id', $param['brand_id']);
			}
			else
			{
				$this->db->where('bfa.brand_id', $param['brand_id']);
			}
			
			$this->db->where('fci.is_enabled', 1);
			// $this->db->order_by('fci.filter_category_item_id', 'ASC');
			$this->db->order_by('fci.name', 'ASC');
		}
		else
		{
			$this->db->select('fci.*');
			$this->db->from('filter_category_items fci');
			$this->db->join('filter_categories fc', 'fc.filter_category_id = fci.filter_category_id');
			$this->db->where('fc.filter_category_id', $category_id);
			$this->db->where('fci.is_enabled', 1);
			//$this->db->order_by('fci.filter_category_item_id', 'ASC');
			$this->db->order_by('fci.name', 'ASC');
		}

		return $this->db->get()->result();
	}

	public function get_filter_category_item_count($filter_category_item_id, $data)
	{
		if(isset($data['brand_id'])){
			$sql = 'COUNT(*) as count';
			$this->db->select($sql);
			$this->db->from('products p');
			$this->db->join('product_filters_association pfa', 'pfa.product_id = p.product_id');
			$this->db->join('brand_filters_association bfa', 'bfa.filter_category_item_id = pfa.filter_category_item_id');
			$this->db->where('pfa.filter_category_item_id', $filter_category_item_id);
			$this->db->where('bfa.brand_id', $data['brand_id']);
			$this->db->where('p.brand_id', $data['brand_id']);
		}else{
			$sql = 'COUNT(*) as count';
			$this->db->select($sql);
			$this->db->from('products p');
			$this->db->join('product_filters_association pfa', 'pfa.product_id = p.product_id');
			$this->db->join('category_filters_association cfa', 'cfa.filter_category_item_id = pfa.filter_category_item_id');
			$this->db->where('pfa.filter_category_item_id', $filter_category_item_id);
			$this->db->where('p.category_id', $data);
		}
		return $this->db->get()->row()->count;
	}

	public function get_filter_category_items_count($filter_category_id, $data)
	{
		//$sql = "filter_category_item_id,filter_category_id, COUNT(*) FROM ci_product_filters_association GROUP BY filter_category_item_id HAVING filter_category_id = ". $category_id;
		if(isset($data['brand_id'])){
			$sql = "pfa.filter_category_item_id, pfa.filter_category_id, bfa.brand_id, COUNT(*) as count";
			$this->db->select($sql);
			$this->db->from('brand_filters_association bfa');
			$this->db->join('product_filters_association pfa', 'pfa.filter_category_item_id = bfa.filter_category_item_id');
			$this->db->join('products p', 'p.product_id = pfa.product_id');
			$this->db->group_by('pfa.filter_category_item_id');
			$this->db->having('pfa.filter_category_id', $filter_category_id);
			$this->db->having('bfa.brand_id', $data['brand_id']);
		}else{
			$sql = "pfa.filter_category_item_id, pfa.filter_category_id, cfa.category_id, COUNT(*) as count";
			$this->db->select($sql);
			$this->db->from('product_filters_association pfa');
			$this->db->join('category_filters_association cfa', 'cfa.filter_category_item_id = pfa.filter_category_item_id');
			$this->db->group_by('pfa.filter_category_item_id');
			$this->db->having('pfa.filter_category_id', $filter_category_id);
			$this->db->having('cfa.category_id', $data);
		}

		$results = $this->db->get()->result();
		
		echo "<pre>";
		print_r($this->db->last_query());
		echo "</pre>";
		exit();
		
		return $results;
	}

	public function get_filter_products($data, $return_count = false)
	{
		if($return_count){
			$sql = 'COUNT(*) AS found_total';
			$this->db->select($sql);
			$this->db->from('product_filters_association pfa');
			$this->db->where_in('pfa.filter_category_item_id', $data['filter_ids']);
			return $this->db->get()->row()->found_total;
		}else{

			$this->db->select('pfa.product_id');
			$this->db->from('product_filters_association pfa');
			$this->db->where_in('pfa.filter_category_item_id', $data['filter_ids']);
			$this->db->offset($data['offset']);
			$this->db->limit($data['limit']);
			return $this->db->get()->result();
		}
	}
	
	function get_filter_items_by_id($where_in = array())
	{
		if(empty($where_in))
		{
			$where_in = array(0);
		}
		
		$this->db->select('*');
		$this->db->from('filter_category_items');
		$this->db->where(1,1, FALSE);
		$this->db->where_in('filter_category_item_id', (array)$where_in);
		$result = $this->db->get()->result();
		//echo $this->db->last_query();die;
		if(!$result)
		{
			return array();
		}

		return $result;
	}
	
	function get_filter_items_by_category_id($id = 0)
	{
		$this->db->select('*');
		$this->db->from('filter_categories AS fc');
		$this->db->join('category_filters_association AS cfa', 'cfa.filter_category_id = fc.filter_category_id');
		$this->db->where(1,1, FALSE);
		$this->db->where('fc.filter_category_id', $id);
		$this->db->where('fc.is_enabled', 1);
		$result = $this->db->get()->result();
		//echo $this->db->last_query();die;
		if(!$result)
		{
			return false;
		}

		return $result;
	}
	
}
