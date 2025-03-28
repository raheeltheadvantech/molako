<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_brand_model extends User_Model
{
	function __construct()
	{
		parent::__construct();
	}
	public function get_products_by_brand($brand_id) {
    	$sql = 'SELECT p.*,pi.image AS img
FROM ci_products p
LEFT JOIN ci_product_images pi ON p.product_id = pi.product_id
AND pi.product_id = (
    SELECT MIN(product_id)
    FROM ci_product_images
    WHERE product_id = p.product_id
) where brand_id = '.$brand_id.' GROUP by product_id;';
        // Implement your logic to fetch bestseller products
$query = $this->db->query($sql)->result();
        return $query;
    }

	public function get_brands($slug = '') {
		if($slug)
		{
			$this->db->where('name',$slug);
		}
        $query = $this->db->get('ci_brands'); // Make sure the table 'ci_brands' exists
        return $query->result(); // Returns an array of objects containing the brand records
    }

	function get_brandies($data=array(), $return_count=false)
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
            $this->db->where('parent_id',0);
			
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
			}else{
				$this->db->order_by('name', 'ASC');
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
		
		foreach($result as $key=>&$val)
                {
                    $val->child = $this->get_brand_childs($val->brand_id);
                }
		return $result;
	}
	public function get_brand_childs($parent_id)
    {
        return $this->db->select('*')->from('brands')->where('parent_id', $parent_id)->get()->result();
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

	function get_brand_by_id($id)
	{

		return $this->get_brand($id);
	}

	public function get_brand_for_menu($filter_data = array())
	{
		$categories = new stdClass();

        $categories_result = $this->db->select('*')->from('categories')->where('is_enabled', true)->order_by('category_id','ASC')->get()->result();

        foreach ($categories_result as $value){
            $category = new stdClass();
            $category->category = $value;
            $category->brands = $this->get_brand_by_category($value->category_id, $filter_data);
            $categories->{$value->category_id} = $category;
        }
        return $categories;
	}

    public function get_brand_by_category($category_id, $filter_data = array(), $limit = false)
    {
        $this->db->select('*')->from('brands b');
        $this->db->join('brand_categories_association bca', 'b.brand_id = bca.brand_id');
        if(isset($filter_data['is_enabled'])) {
			$this->db->where('b.is_enabled', $filter_data['is_enabled']);
		}
        $this->db->where('bca.category_id', $category_id);
        if($limit){
            $this->db->limit($limit);
        }
        $this->db->order_by('b.name','ASC');
        return $this->db->get()->result();
	}

    public function get_bestseller_products($brand_id, $limit = 10, $cat_id){

        $this->db->select('p.*, b.name as brand_name');
        $this->db->from('products p');
        $this->db->join('brand_bestseller_products bsp', 'bsp.product_id = p.product_id');
        $this->db->join('brands b', 'b.brand_id = p.brand_id');
        $this->db->where('p.is_enabled', 1);
        $this->db->where('p.brand_id', $brand_id);

        if($cat_id == 91 || $cat_id == 4) //tires
            $this->db->where('p.category_id', 4);

        if($cat_id == 92 || $cat_id == 1) //wheel
            $this->db->where('p.category_id', 1);


        $this->db->order_by('p.product_id', 'RANDOM');

        if($limit)
		{
            $this->db->limit($limit);
        }

        $result = $this->db->get()->result();


        if(!$result)
        {
            return FALSE;
        }

        foreach($result as $key=>&$val)
        {
			$val->brand = $this->get_by_id($val->brand_id);
        }




        return $result;
    }

}
