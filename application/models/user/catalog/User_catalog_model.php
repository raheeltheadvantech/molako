<?php defined('BASEPATH') OR exit('No direct script access allowed');



class User_catalog_model extends User_Model

{

	function __construct()

	{



		parent::__construct();

	}

	

	function get_products($data=array(), $return_count=false, $is_deals=null, $brand_slug=0)

	{





		if(empty($data) and !$return_count)

		{

			return false;

		}

		else

		{

			$this->db = get_base_product_query($this->db, ''); // Base Query Call

$this->db->where('p.is_enabled', 1); // Sirf enabled products lein

// Agar config allow nahi karta out of stock products dikhana
$display_out_stock = site_config_item('config_catalog_outstock');
if ($display_out_stock != 1) {
    $this->db->where('p.quantity >', 0);
}
$this->db->group_by('p.product_id');

			if($is_deals != 1){

				if(!empty($data['category_id']))

				{

					$this->db->join('product_categories pc', 'pc.product_id = p.product_id');

					$this->db->where('pc.category_id', $data['category_id']);

				}

			}



			if($data['brand_id']){

				$this->db->where('p.brand_id', $data['brand_id']);

			}

			

			if(!empty($data['order']))

			{

				$this->db->order_by($data['order'], $data['sort']);

			}



			

			if(!empty($data['term'])) 

			{

				$search	= json_decode($data['term']);

				// pre($search);

				if(!empty($search->term))

				{

					$terms = explode(',',$search->term);

					// pre($terms);

					if ($terms[1]) 

					{

						$this->db->join('product_categories pc', 'pc.product_id = p.product_id');

                		$this->db->where('pc.category_id', $terms[1]);

					}

					if (!empty($terms[0])) 

					{

						$this->db->group_start();

						$this->db->like('p.product_name', $terms[0]);

						$this->db->or_like('p.sku', $terms[0]);

						// $this->db->or_like('pc.category_id', $t);

	                    $this->db->or_like('LOWER(p.short_description)', $terms[0]);

	                    $this->db->or_like('LOWER(p.long_description)', $terms[0]);

						$this->db->group_end();

					}

						

				}

			}



			if(!empty($data['params']) and is_array($data['params']) )

			{

				foreach($data['params'] as $key=>$val)

				{

					$this->db->or_where($key, $val);

				}

			}



			if(!empty($data['rows']))

			{

				$this->db->limit($data['rows']);

			}



			if(!empty($data['page']))

			{

				$offset = ($data['page'] * $data['rows'])-$data['rows'] ;

				$this->db->offset($offset);

			}



			if(isset($data['special_product']) && !empty($data['special_product'])){

				$this->db->where('p.special_price >' , 0);

			}

			

		}

		$result = $this->db->get()->result();

		



		if(!$result)

		{

			if($return_count)

			{

				return 0;



				

			}

			return false;

		}



		foreach($result as $key=>&$val) {
$val->images= explode(', ', $val->images);

		}

		

		$result2 = [];

		if($is_deals){

			foreach ($result as $key => $p) {

				if($p->special_price){

					array_push($result2,$p);

				}

			}

			return $result2;



		}else{

			return $result;

		}



		

	}





    function get_combinations($product_id)

	{

		$this->db->where('product_id',$product_id);

		$this->db->select('*');

$this->db->from('product_option_value');

$r = $this->db->get()->result();

return $r;



	}





    function varient_total_qty($product_id)

	{

		$this->db->where('product_id',$product_id);

		$this->db->select('SUM(quantity) as quantity');

$this->db->from('product_option_value');

$r = $this->db->get()->row();

return $r->quantity;



	}

    function get_filters($product_id)

    {

        $this->db->distinct();

        $this->db->select('filter_key');

        $this->db->from('product_option_filter');

        $this->db->where('product_id', $product_id);

        $this->db->where('is_filter', 1);

        $result = $this->db->get()->result_array();



       // return $result;



        if(!$result)

        {

            return false;

        }





        foreach($result as $key=>&$val)

        {

            $val['filter_value'] 		= $this->get_filters_value($val['filter_key'] , $product_id);



        }



        return $result;



    }



    function get_filters_value($filter_key , $product_id)

    {

        $this->db->distinct();

        $this->db->select('filter_value');

        $this->db->from('product_option_filter');

		$this->db->where('is_filter', 1);

        $this->db->where('filter_key', $filter_key);

        $this->db->where('product_id', $product_id);

        $result = $this->db->get()->result_array();



        if(!$result)

        {

            return false;

        }



        foreach($result as $key=>&$val)

        {

            $val	= $val['filter_value'];

        }



         return $result;

    }





	function get_special_products($data=array(), $return_count=false)

	{

		die('get_special_products');

		if(empty($data) and !$return_count)

		{

			return false;

		}

		else

		{

			$sql = 'p.*, p.product_name AS name, \'\' AS is_new, \'\' AS is_special, \'\' AS rate_special, \'\' AS has_tax, \'\' AS price ';



			$this->db->select($sql);

			if($return_count === FALSE)

			{

			//	$this->db->select("IFNULL((SELECT url FROM {$this->db->dbprefix}product_file_links AS pfl WHERE pfl.item_id = p.item_id AND pfl.size = 'M' LIMIT 1), '-') AS image", NULL);

			//	$this->db->select("IFNULL((SELECT purchase_cost FROM {$this->db->dbprefix}product_prices AS pr WHERE pr.item_id = p.item_id AND pr.can_purchase = '1' LIMIT 1), '-') AS price", NULL);

			}

			$this->db->from('products p');

            $this->db->join('product_categories pc', 'pc.product_id = p.product_id');

			$this->db->join('special_products sp', 'sp.product_id = p.product_id');

			$this->db->where(1,1, FALSE);



			$this->db->where('p.is_enabled', 1);



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

					$this->db->like('product_name', $search->term);

					$this->db->or_like('part_number', $search->term);

					//$this->db->or_like('item_id', $search->term);

					//$this->db->or_like('alternate_part_number', $search->term);

					//$this->db->or_like('part_description', $search->term);

					//$this->db->or_like('mfr_part_number', $search->term);

					$this->db->or_like('category', $search->term);

					//$this->db->or_like('subcategory', $search->term);

					//$this->db->or_like('barcode', $search->term);

					$this->db->group_end();

				}

			}



			if(!empty($data['params']) and is_array($data['params']) )

			{

				foreach($data['params'] as $key=>$val)

				{

					$this->db->where($key, $val);

				}

			}



			if(!empty($data['category_id']))

			{

				$this->db->where('pc.category_id', $data['category_id']);

			}





			if(!empty($data['rows']))

			{

				$this->db->limit($data['rows']);

			}



			if(!empty($data['per_page']))

			{

				$this->db->offset($data['per_page']);

			}



			if(isset($data['special_product']) && !empty($data['special_product'])){

				$this->db->where('p.special_price >' , 0);

			}



			/*if(!empty($data['sub_category_id']))

			{

				$this->db->or_where('sub_category_id', $data['sub_category_id']);

			}



			if(!empty($data['sub_category_ids']) and is_array($data['sub_category_ids']) )

			{

				//$this->db->where_in('sub_category_id', $data['sub_category_ids']);

			}*/





			$result = $this->db->get()->row();

		}



		/*echo "<pre>";

		print_r($this->db->last_query());

		echo "</pre>";

		exit();*/



		if(!$result)

		{

			return false;

		}





		foreach($result as $key=>&$val)

		{

			$image_url = parse_url($val->image);

			if(!isset($image_url['host'])){

				$val->image = '';

			}





			//$val->image 		= $val->image; // $this->get_product_file_link($val->product_id, true);

			//$val->files 		= $this->get_product_files($val->item_id, true);

			$val->brand 		= $this->get_brand($val->brand_id);

			//$val->descriptions 	= $this->get_product_descriptions($val->item_id);

			//$val->description 	= $this->get_product_description($val->item_id);

		}



		return $result;

	}



	function get_filter_products($data=array(), $return_count=false)

	{





		if(empty($data) and !$return_count)

		{

			return false;

		}

		else

		{

			$this->db = get_base_product_query($this->db, ''); // Base Query Call

			if($return_count === FALSE)

			{

			//	$this->db->select("IFNULL((SELECT url FROM {$this->db->dbprefix}product_file_links AS pfl WHERE pfl.item_id = p.item_id AND pfl.size = 'M' LIMIT 1), '-') AS image", NULL);

			//	$this->db->select("IFNULL((SELECT purchase_cost FROM {$this->db->dbprefix}product_prices AS pr WHERE pr.item_id = p.item_id AND pr.can_purchase = '1' LIMIT 1), '-') AS price", NULL);

			}

			$this->db->from('products p');



			$this->db->where(1,1, FALSE);
			$this->db->where('p.is_enabled', 1);

			// echo '<pre>';print_r($data['filter_ids']);die();

			if($data['brand_id']){

				$this->db->where('p.brand_id', $data['brand_id']);

			}

			if(isset($data['price']) && $data['price'])

			{

				$price = $data['price'];

				// if(isset($price[0]))

				// {

				// 	$this->db->where('sale_price >=',$price[0]); 

				// }

				// if(isset($price[1]))

				// {

				// 	$this->db->where('sale_price <=',$price[1]);

				// }

			}



            if(!empty($data['filter_ids']) and is_array($data['filter_ids']) )

            {

               $i= 0;

               $this->db->group_start();



                foreach($data['filter_ids'] as $value)

                {

                	// print_r($value);die;

                	    



                    $val = explode('_', $value);

                    $pof = 'pof'.$i;

                    $this->db->join('ci_product_option_filter '.$pof, $pof.'.product_id = p.product_id');

					if($val)

					{

						$this->db->or_group_start();

                     $this->db->where($pof.'.filter_key', $val[0]);

                     $this->db->where($pof.'.filter_value', $val[1]);

                     $this->db->group_end();

					}

					else

                    $this->db->where($pof.'.filter_value', $value);

                    $i++;

                        



                }

                $this->db->group_end();

            }







            //	$this->db->where_in('pfa.filter_category_item_id', $data['filter_ids']);



			if(!empty($data['order']))

			{

				$this->db->order_by($data['order'], $data['sort']);

			}



			/*if(!empty($data['category_id']))

			{

				$this->db->where('category_id', $data['category_id']);

			}*/



			if(!empty($data['params']) and is_array($data['params']) )

			{

				foreach($data['params'] as $key=>$val)

				{

					$this->db->or_where($key, $val);

				}

			}



			if(!empty($data['rows']))

			{

				$this->db->limit($data['rows']);

			}





			if(!empty($data['page']))

			{

				$offset = ($data['page'] * $data['rows'])-$data['rows'] ;

				$this->db->offset($offset);

			}



			if(isset($data['special_product']) && !empty($data['special_product'])){

				$this->db->where('p.special_price >' , 0);

			}



			$result = $this->db->get()->result();

		}





		// echo "<pre>";print_r($this->db->last_query());exit();



		if(!$result)

		{

			return false;

		}

		



		// echo'<pre>';print_r($result);die;

		

			

		foreach($result as $key=>&$val)

		{

			if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {

                $val->is_variation = 1;

                $p =  get_product_varient_price($val->product_id);

				if(isset($p->price))

				{

					$val->varient_price = $p->price;

					$val->varient_id = $p->product_option_value_id;

				}

            } else {

                $val->is_variation = 0;

                $val->varient_price = 0;

            }

			if(isset($data['price'][1]) && $data['price'][1])

			{

				$price = 0;

				$v = $val;

				if($v->varient_price)

				{

					$price = $v->varient_price;

					

				}

				elseif($v->special_price)

				{

					$price = $v->special_price;

					

				}

				else

				{

					$price = $v->sale_price;

				} 

				if(isset($data['price']) && $data['price'])

				{

					$fprice = $data['price'];

					if(isset($fprice[0]) && $price < $fprice[0])

					{

						$val->remove = 1;

					}

					if(isset($price[1]) && $price > $fprice[1])

					{

							$val->remove = 1;

						

					}

				}

			}

			if($result[$key])

			{

				if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {

                $val->is_variation = 1;

                $p =  get_product_varient_price($val->product_id);

				if(isset($p->price))

				{

					$val->varient_price = $p->price;

					$val->varient_id = $p->product_option_value_id;

				}

            } else {

                $val->is_variation = 0;

                $val->varient_price = 0;

            }

            $val->images = get_product_images($val->product_id);

            $val->special_price = get_product_special_price($val->product_id);



			//$val->files 		= $this->get_product_files($val->item_id, true);

			$val->brand 		= $this->get_brand($val->brand_id);



            if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {

                $val->is_variation = 1;

                $val->varient_price =  get_product_varient_price($val->product_id); 
                if(isset($val->varient_price->price))
                	$val->varient_price = $val->varient_price->price;
                }

            } else {

                $val->is_variation = 0;

                $val->varient_price = 0;

            }

			}

		$result2 = [];

		if($is_deals){

			foreach ($result as $key => $p) {

				if($p->special_price){

					array_push($result2,$p);

				}

			}

			return $result2;



		}else{

			return $result;

		}

	}



	function get_brand_filter_products($data=array(), $return_count=false)

	{

		if(empty($data) and !$return_count)

		{

			return false;

		}

		else

		{

			$sql = 'p.*, p.product_name AS name, \'\' AS is_new, \'\' AS is_special, \'\' AS rate_special, \'\' AS has_tax, \'\' AS price ';

			if($return_count === TRUE)

			{

				$sql = 'COUNT(*) AS found_total';

			}



			$this->db->select($sql);

			if($return_count === FALSE)

			{

			//	$this->db->select("IFNULL((SELECT url FROM {$this->db->dbprefix}product_file_links AS pfl WHERE pfl.item_id = p.item_id AND pfl.size = 'M' LIMIT 1), '-') AS image", NULL);

			//	$this->db->select("IFNULL((SELECT purchase_cost FROM {$this->db->dbprefix}product_prices AS pr WHERE pr.item_id = p.item_id AND pr.can_purchase = '1' LIMIT 1), '-') AS price", NULL);

			}

			$this->db->from('brand_filters_association bfa');

			$this->db->join('product_filters_association pfa', 'pfa.filter_category_item_id = bfa.filter_category_item_id');

			$this->db->join('products p', 'p.product_id = pfa.product_id');

			$this->db->where(1,1, FALSE);

			$this->db->where_in('pfa.filter_category_item_id', $data['filter_ids']);



			if(!empty($data['order']))

			{

				$this->db->order_by($data['order'], $data['sort']);

			}



			$this->db->where('p.is_enabled', 1);



			if(!empty($data['params']) and is_array($data['params']) )

			{

				foreach($data['params'] as $key=>$val)

				{

					$this->db->where($key, $val);

					if($key == 'p.brand_id'){

						$this->db->where('bfa.brand_id', $val);

					}

				}

			}



			if(!empty($data['rows']))

			{

				$this->db->limit($data['rows']);

			}



			if(!empty($data['per_page']))

			{

				$this->db->offset($data['per_page']);

			}



			if(isset($data['special_product']) && !empty($data['special_product'])){

				$this->db->where('p.special_price >' , 0);

			}





			if($return_count)

			{

				$result = $this->db->get()->row();

				/*echo "<pre>";

				print_r($this->db->last_query());

				echo "</pre>";

				exit();*/

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



		/*echo "<pre>";

		print_r($this->db->last_query());

		echo "</pre>";

		exit();*/



		if(!$result)

		{

			return false;

		}





		foreach($result as $key=>&$val)

		{

			$image_url = parse_url($val->image);

			if(!isset($image_url['host'])){

				$val->image = '';

			}





			//$val->image 		= $val->image; // $this->get_product_file_link($val->product_id, true);

			//$val->files 		= $this->get_product_files($val->item_id, true);

			$val->brand 		= $this->get_brand($val->brand_id);

			//$val->descriptions 	= $this->get_product_descriptions($val->item_id);

			//$val->description 	= $this->get_product_description($val->item_id);

		}



		return $result;

	}

	

	function get_brands($data=array(), $return_count=false)

	{

		if(empty($data))

		{

			return false;

		}

		else

		{

			$this->db->select('*');

			$this->db->from('brands');

			$this->db->where(1,1, FALSE);

			$this->db->where('is_enabled', 1);

			

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

			

			if(!empty($data['params']))

			{

				foreach($data['params'] as $key=>$val)

				{

					$this->db->where($key, $val);

				}

			}

			

			if($return_count)

			{

				$result = $this->db->get()->num_rows();

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

	

	function get_categories($data=array(), $return_count=false)

	{

		if(empty($data))

		{

			return false;

		}

		else

		{

			$this->db->select('*');

			$this->db->from('categories');

			$this->db->where(1,1, FALSE);

			$this->db->where('is_enabled', 1);

			

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

			

			if(!empty($data['params']))

			{

				foreach($data['params'] as $key=>$val)

				{

					$this->db->where($key, $val);

				}

			}

			

			if($return_count)

			{

				$result = $this->db->get()->num_rows();

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

	

	function get_category_menu($parent)

	{



		$this->db->where(1,1, FALSE);

		$this->db->where('is_enabled', 1);

		$this->db->where('parent_id', $parent);

		$this->db->order_by('sort', 'ASC');

		$result	= $this->db->get('categories')->result();



		if(!$result)

		{

			return array();

		}



		$return	= array();

		foreach($result as $key=>$category)

		{

			$return[$key]['name']				= $category->name;
			$return[$key]['images']				= $category->images;

            $return[$key]['category_id']				= $category->category_id;

			//$return[]->children	= $this->get_category_menu($category->category_id);

		}



//		echo '<pre>';

//        print_r($return);

//		die();

		return $return;

	}

	

	function get_brand_menu()

	{

		$this->db->where(1,1, FALSE);

		$this->db->where('is_enabled', 1);

		$this->db->order_by('name', 'ASC');

		$result	= $this->db->get('brands')->result();

		if(!$result)

		{

			return array();

		}



		$return	= array();

		foreach($result as $key=>$val)

		{

			$return[$val->brand_id] = $val;

		}

		

		return $return;

	}



//	public function get_brands_of_category($category_id)

//	{

//		$this->db->distinct('b.*');

//		$this->db->select('b.*');

//		$this->db->from('brands b');

//		$this->db->join('products p','p.brand_id = b.brand_id');

//		$this->db->join('categories c','c.category_id = p.category_id');

//		$this->db->where('c.category_id', $category_id);

//		return $this->db->get()->result();

//	}



	

	function get_product($id)

	{

		    $this->db = get_base_product_query($this->db,'');

		$this->db->where('p.product_id', $id);

		$result = $this->db->get()->row();

		if(!$result)

		{

			return false;

		}



        $result->images = get_product_images($id);

        $result->special_price = get_product_special_price($id);

        $result->specification = get_product_specification($id);

        if (isset($result->option_name, $result->option_value) && ($result->option_name != '') && ($result->option_value != '')) {

            $result->is_variation = 1;

            $result->varient_price =  get_product_varient_price($id); 

        } else {

            $result->is_variation = 0;

            $result->varient_price = 0;

        }



		$result->brand 		= $this->get_brand($result->brand_id);

		$result->is_special = false;

		$result->price 		= false;

		

		return $result;

	}



	function get_product_slug($slug)

	{

		$this->db = get_base_product_query($this->db, ''); // Base Query Call
		

		$this->db->where('product_slug', $slug);

		$result = $this->db->get()->row();

		if(!$result)

		{

			return false;

		}

		$id = $result->product_id;

        $result->images = get_product_images($id);

        $result->special_price = get_product_special_price($id);

        $result->specification = get_product_specification($id);

        if (isset($result->option_name, $result->option_value) && ($result->option_name != '') && ($result->option_value != ''))

        {

            $result->is_variation = 1;

            $result->varient_price =  get_product_varient_price($id); 

        } else {

            $result->is_variation = 0;

            $result->varient_price = 0;

        }



		$result->brand 		= $this->get_brand($result->brand_id);

		$result->is_special = false;

		$result->price 		= false;

		

		return $result;

	}



    function get_single_variants($product_id)

	{

		$product_variant_table = $this->db->dbprefix('product_option_value');

		$this->db->order_by('price','ASC');

		$query = $this->db->where('quantity >','0')->where('price >','0')->where('product_id',$product_id)->get($product_variant_table);

        return $product =  $query->row();

	}

    function get_product_variants($product_id)

    {

    	$config_catalog_purchase = $this->db->where('key','config_catalog_purchase')->get('ci_settings')->row();

        if($config_catalog_purchase)

        {

            $config_catalog_purchase = $config_catalog_purchase->value;

        }

        else

        {

            $config_catalog_purchase = 0;

        }

        if($config_catalog_purchase)

        {



	        $product_variant_table = $this->db->dbprefix('product_option_value');

	        $query_set = "SELECT product_option_value_id as variant_opt_id, product_id, price, quantity, combination, 

							image as variant_image

							FROM $product_variant_table 

							WHERE product_id = $product_id  AND price > 0 order by price Asc";

	        $query = $this->db->query($query_set);

	        $product =  $query->result();

	    }

	    else

	    {

	    	$product_variant_table = $this->db->dbprefix('product_option_value');

	        $query_set = "SELECT product_option_value_id as variant_opt_id, product_id, price, quantity, combination, 

							image as variant_image

							FROM $product_variant_table 

							WHERE product_id = $product_id AND quantity > 0 AND price > 0 order by price Asc";

	        $query = $this->db->query($query_set);

	        $product =  $query->result();

	    }





        $data = [];

        $group_array = array();

        if(!empty($product)){



            foreach ($product as $key => $prod){

                $variant_json_decode = json_decode($prod->combination);

 //print_r($variant_json_decode); die();

                foreach ($variant_json_decode as $v_key => $vari) {

                    if(empty($group_array)){

                        $group_array[$v_key][] = $vari;

                    }else{



                        if(isset($group_array[$v_key])){

                            if(!in_array($vari,$group_array[$v_key])){

                                $group_array[$v_key][] = $vari;

                            }

                        }else{

                            $group_array[$v_key][] = $vari;

                        }

                    }

                }



            }

// echo '<pre>';print_r($product); die();

           return  $data = array('variants' => $group_array);

        }





    }







    function get_product_variants_detail($product_id , $variations)

    {

		//arrange values 

		$vl = '';

		$i = 0;

		foreach($variations as $k => $v)

		{

			if($i != count($variations)-1)

			{

				$vl = $vl.$v.'-';

			}

			else

			{

				$vl = $vl.$v;

			}

			$i++;

		}

		$variations = $vl;



        $product_variant_table = $this->db->dbprefix('product_option_value');

        $config_catalog_purchase = $this->db->where('key','config_catalog_purchase')->get('ci_settings')->row();

        $query_set = "SELECT product_option_value_id as variant_opt_id, product_id, price, quantity, combination, 

						image as variant_image

						FROM $product_variant_table 

						WHERE product_id = $product_id AND quantity > 0 order by price Asc";

        if($config_catalog_purchase)

        {

            $query_set = "SELECT product_option_value_id as variant_opt_id, product_id, price, quantity, combination, 

						image as variant_image

						FROM $product_variant_table 

						WHERE product_id = $product_id order by price Asc";

        }

        else

        {

        }

        $query = $this->db->query($query_set);

        $product =  $query->result();





        $data = [];

        $group_array = array();

        $type_array = array();

        $prices_array = array();

        $qty_array = array();

        $img_array = array();

        $variant_id = '';

        $variant_type = 0;

        $variant_price = 0;

        $variant_qty = 0;

        $variant_image= '';

        if(!empty($product)){



            foreach ($product as $key => $prod){

                $variant_json_decode = json_decode($prod->combination);



                $temp = '';

                foreach ($variant_json_decode as $v_key => $vari) {

                    if($temp == ''){

                        $temp = $vari;

                    }else{

                        $temp .= '-'.$vari;

                    }

                }

                $group_array[$prod->variant_opt_id] = $temp;

                $prices_array[$prod->variant_opt_id] = $prod->price;

                $qty_array[$prod->variant_opt_id] = $prod->quantity;

                $img_array[$prod->variant_opt_id] = $prod->variant_image;

            }

			



            if(!empty($group_array)){

                $variant_id = array_search($variations,$group_array);

                if($variant_id){

                    $variant_price = $prices_array[$variant_id];

                    $variant_qty = $qty_array[$variant_id];

                    $variant_image = $img_array[$variant_id];

                }



            }



        }



       return $data = array('variant_id' => $variant_id, 'variant_type' => $variant_type, 

       	'variant_price' => $variant_price, 'variant_qty' => $variant_qty, 'variant_image'=> $variant_image

        );





    }







    public function get_column_value($table_name,$where_column,$where_value,$required_column){



        $table_name = $this->db->dbprefix($table_name);

        $query_set = "SELECT $required_column 

						FROM $table_name 

						WHERE $where_column = $where_value";

        $query = $this->db->query($query_set);

        return $query->row();

    }



	function get_related_products($product_id)

	{

		$this->db->select('p.*');

		$this->db->from('products p');

		$this->db->join('related_products rp', 'rp.related_product_id = p.product_id');

		$this->db->where(1,1, FALSE);

		$this->db->where('p.is_enabled', 1);

		$this->db->where('rp.product_id', $product_id);

		$display_out_stock = site_config_item('config_catalog_outstock');

		if ($display_out_stock == 0) 

		{

			$this->db->where('p.quantity >', 0);

		}

		$result = $this->db->get()->result();

		if(!$result) 

		{

			return false;

		}



        foreach($result as $key=>&$val) {

            $val->images = get_product_images($val->product_id);

            $val->special_price = get_product_special_price($val->product_id);



            if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {

                $val->is_variation = 1;

                $val->varient_price =  get_product_varient_price($val->product_id);

            } else {

                $val->is_variation = 0;

                $val->varient_price = 0;

            }

        }

		return $result;

	}



	public function add_product_view($product_id){

		$product_views = $this->db->select('*')->from('products')->where('product_id', $product_id)->get()->row()->views;

		$product_views++;

		$this->db->where('product_id',$product_id)->update('products', array('views' => $product_views));

	}

	

	function get_product_images($id)

	{

		$this->db->select('*');

		$this->db->from('product_file_links AS s');

		$this->db->where(1,1, FALSE);

		$this->db->where('s.item_id', $id);

		$this->db->where_in('s.size', array('S', 'M', 'L'));

		$result = $this->db->get()->result();

		//	echo $this->db->last_query();die;

		if(!$result)

		{

			return false;

		}

		

		$index = 0;

		$obj = new stdClass();

		$return = array();

		foreach($result as $key=>$val)

		{

			//echo '<br>M = '.($key % 3);

			

			$obj->{$val->size} = $val->url;

			$return[$index] = $obj;

			

			//$return[$index][$val->size] = $val->url;

			

			if( ($key % 3) == 2)

			{

				$index++;

				$obj = new stdClass();

			}

		}



		return $return;

	}



	function get_product_local_images($id, $index = 0)

	{

		$this->db->select('*');

		$this->db->from('product_images');

		$this->db->where('product_id', $id);



		$result = $this->db->get()->result();



		if(!$result)

		{

			return false;

		}



		$return = array();

		foreach($result as $key=>$val) {

			$return[$index] = (object)array(

				'S'		=> base_url('images/products/medium/'. basename($val->image)),

				'M'		=> base_url('images/products/large/'.basename($val->image)),

				'L'		=> base_url('images/products/full/'.basename($val->image)),

			);

			$index++;

		}



	//	var_dump($return);die;

		return $return;

	}

	

	private function get_product_files($id, $size = false)

	{

		$this->db->select('*');

		$this->db->from('product_files');

		$this->db->where(1,1, FALSE);

		$this->db->where('item_id', $id);

		if($size)

		{

			$this->db->where('type', 'Image');

			$this->db->where('media_content', 'Photo - Primary');

		}

		$result = $this->db->get()->result();

		//echo $this->db->last_query();

		if(!$result)

		{

			return false;

		}

		

		foreach($result as $key=>&$val)

		{

			$val->links = $this->get_product_file_links($val->item_id, $size);

		}

		

		return $result;

	}

	

	private function get_product_file_link($id, $size = false)

	{

		$this->db->select('*');

		$this->db->from('product_file_links');

		$this->db->where(1,1, FALSE);

		$this->db->where('item_id', $id);

		$this->db->where('size', 'M');

		$this->db->limit(1);

		$result = $this->db->get()->row();

	//	echo $this->db->last_query();

		if(!$result)

		{

			return false;

		}

		

		return $result->url;

	}

	

	private function get_product_file_links($id, $size = false)

	{

		$this->db->select('*');

		$this->db->from('product_file_links');

		$this->db->where(1,1, FALSE);

		$this->db->where('item_id', $id);

		if($size)

		{

			$this->db->where('size', 'M');

		}

		$result = $this->db->get()->result();

	//	echo $this->db->last_query();

		if(!$result)

		{

			return false;

		}

		

		return $result;

	}

	

	private function get_product_description($id)

	{

		$this->db->select('*');

		$this->db->from('product_descriptions');

		$this->db->where(1,1, FALSE);

		$this->db->where('item_id', $id);

		$this->db->where('type', 'Product Description - Extended');

		$this->db->limit(1);

		$result = $this->db->get()->row();

	//	echo $this->db->last_query();

		if(!$result)

		{

			return false;

		}

		

		return $result->description;

	}

	

	private function get_product_descriptions($id)

	{

		$this->db->select('*');

		$this->db->from('product_descriptions');

		$this->db->where(1,1, FALSE);

		$this->db->where('item_id', $id);

		$result = $this->db->get()->result();

	//	echo $this->db->last_query();

		if(!$result)

		{

			return false;

		}

		

		return $result;

	}

	

	private function get_product_vehicle_fitments($id)

	{

		$this->db->select('*');

		$this->db->from('product_vehicle_fitments');

		$this->db->where(1,1, FALSE);

		$this->db->where('item_id', $id);

		$result = $this->db->get()->result();

	//	echo $this->db->last_query();

		if(!$result)

		{

			return false;

		}

		

		return $result;

	}

	

	function get_brand($id)

	{

		$this->db->select('*');

		$this->db->from('brands');

		$this->db->where(1,1, FALSE);

		$this->db->where('is_enabled', 1);

		$this->db->where('brand_id', $id);

		$result = $this->db->get()->row();

		if(!$result)

		{

			return false;

		}

		

		return $result;

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

	

	function get_category_child_ids($id)

	{

		$this->db->select('*');

		$this->db->from('categories');

		$this->db->where(1,1, FALSE);

		$this->db->where('parent_id', $id);

		$result = $this->db->get()->result();

		//echo $this->db->last_query();

		if(!$result)

		{

			return false;

		}

		

		$return = array();

		foreach($result as $key=>$val)

		{

			$return[] = $val->category_id;

		}

		

		return $return;

	}



	public function get_products_by_brand($brand_id){

		return $this->db

			->select('*')

			->from($this->db->dbprefix .'products')

			->where('brand_id', $brand_id)

			->where('is_enabled', true)

			->get()->result();

	}



	public function get_wish_list($customer_id){

		$this->db->select('wl.*, p.product_name, p.product_slug, p.sku, p.sale_price');

		$this->db->from('customer_wishlist wl');

		$this->db->join('products p', 'p.product_id = wl.product_id');

		$this->db->where('p.is_enabled', 1);

		$this->db->where('wl.customer_id', $customer_id);

		$this->db->order_by('wl.date_added', 'DESC');



        $result = $this->db->get()->result();

        //echo $this->db->last_query();

        if(!$result)

        {

            return FALSE;

        }



        foreach($result as $key=>&$val) {

        	$val->images = get_product_images($val->product_id);

            $val->special_price = get_product_special_price($val->product_id);

        }

        return $result;



	}



	public function is_exists_in_wish_list($customer_id, $product_id){

		return $this->db->select('*')->from('customer_wishlist')->where(array('customer_id' => $customer_id, 'product_id' => $product_id))->get()->row();

	}



	public function add_to_wish_list($data)

	{

		if($this->db->insert('customer_wishlist',$data)){

			return true;

		}else{

			return false;

		}

	}

	public function remove_from_wishlist($wish_list_id,$customer_id)

	{

		if($this->db->where('product_id', $wish_list_id)->where('customer_id', $customer_id)->delete('customer_wishlist')){

			return true;

		}else{

			return false;

		}

	}



    public function get_product_max_price($data)

    {

        $sql = "MAX(sale_price) as max_price";

        $this->db->select($sql);

        $this->db->from('products');

        if(isset($data['category_id']) && !empty($data['category_id'])){

            $this->db->where('category_id', $data['category_id']);

        }



        if(isset($data['brand_id']) && !empty($data['brand_id'])){

            $this->db->where('brand_id', $data['brand_id']);

        }



        if(isset($data['distributor_id']) && !empty($data['distributor_id'])){

            $this->db->where('distributor_id', $data['distributor_id']);

        }



        return $this->db->get()->row()->max_price;

	}



	public function get_product_min_price($data)

    {

        $sql = "MIN(sale_price) as min_price";

        $this->db->select($sql);

        $this->db->from('products');

        if(isset($data['category_id']) && !empty($data['category_id'])){

            $this->db->where('category_id', $data['category_id']);

        }



        if(isset($data['brand_id']) && !empty($data['brand_id'])){

            $this->db->where('brand_id', $data['brand_id']);

        }



        if(isset($data['distributor_id']) && !empty($data['distributor_id'])){

            $this->db->where('distributor_id', $data['distributor_id']);

        }



        return $this->db->get()->row()->min_price;

	}



	function do_search($data=array(), $return_count=false)

	{

		if(empty($data))

		{

			return false;

		}

		else

		{	

			$data['do_search'] = 1;

			

			$result = $this->prepair_products($data, $return_count);

			

			return $result;

		}

	}

	public function srch_pros($search_term){

		$this->db->where('is_enabled', 1);

		$this->db->like('product_name', $search_term);

        $this->db->or_like('long_description', $search_term);

        $this->db->or_like('meta_title', $search_term);

        $this->db->or_like('meta_keywords', $search_term);

        $query = $this->db->select('product_id,is_enabled')->get('products'); // 'products' is your products table name

        return $query->result_array();



	}

	

    private function prepair_products($data, $return_count)

    {

		if(empty($data))

		{

			return false;

		}

		

		$sql = 'p.*';

		if($return_count === TRUE)

		{

			$sql = 'COUNT(*) AS found_total';

		}

		

		$this->db->select($sql);

		$this->db->from('products AS p');

		$this->db->join('product_categories pc', 'pc.product_id = p.product_id');

		$this->db->where(1,1, FALSE);

		$this->db->where('p.is_enabled', 1);

		

		if(!empty($data['rows']))

		{

			$this->db->limit($data['rows']);

		}

		

		if(!empty($data['page']))

		{

			$this->db->offset($data['page']);

		}

		

		if(!empty($data['order']))

		{

			$this->db->order_by($data['order'], $data['sort']);

		}

		

		

		$ignore_terms = array(' ', '-', ',');

		

		if(!empty($data['term']))

		{

			if(!empty($data['term']['q']))

			{

				$term = $data['term']['q'];

			}

			else

			{

				$qt	= json_decode($data['term']);

				$term = !empty($qt->term) ? $qt->term : '';

			}

			

			//$qs = explode(' ', $term);

			$qs = explode('|||||', $term);

			

			if(!empty($qs))

			{

				$this->db->group_start();

				$count = 0;

				foreach($qs as $q)

				{

					$count ++;

					$search	= strtolower(trim($q));

					$search	= strip_tags($search);

					//$search	= str_replace(array(',', ' '), '', $search);

					//$search	= str_replace(array('&', ), ' ', $search);

					$search	= trim($search);

					if(empty($search) or in_array($search, $ignore_terms))

					{

						continue;

					}

					

					$this->db->or_like('LOWER(p.product_name)', $search);

					$this->db->or_like('LOWER(p.sku)', $search);

					$this->db->or_like('LOWER(p.brand_name)', $search);

					//$this->db->or_like('LOWER(p.distributor_name)', $search);

					$this->db->or_like('pc.category_id', $search);

					$this->db->or_like('LOWER(p.short_description)', $search);

					$this->db->or_like('LOWER(p.long_description)', $search);

				}

				$this->db->group_end();

			}

		}

		

		

		if($return_count)

		{

			$result = $this->db->get()->row();

			if(!$result)

			{

				return FALSE;

			}

			

			return $result->found_total;

		}

		

		$result = $this->db->get()->result();

		//echo $this->db->last_query();

		return $result;

	}

	

	function get_product_by_category_name($category_name)

	{

		$this->db->select('p.*, f.filter_category_item_id');

		$this->db->from('products AS p');

		$this->db->join('filter_category_items AS f', 'LOWER(p.category_name) = LOWER(f.unique_name)');

		//$this->db->join('filter_category_items AS f', 'LOWER(p.brand_name) LIKE CONCAT(\'%\', LOWER(TRIM(f.unique_name)), \'%\')');

		

		$this->db->where(1,1, FALSE);

		$this->db->where('f.column_id', 'category_name');

		$this->db->like('LOWER(p.category_name)', $category_name);

		

		

		$this->db->limit(1);

		$result = $this->db->get()->row();

		//echo $this->db->last_query();

		if(!$result)

		{

			return false;

		}

		

		return $result;

	}

	

	function get_product_by_brand_name($brand_name)

	{

		$this->db->select('p.*, f.filter_category_item_id');

		$this->db->from('products AS p');

		$this->db->join('filter_category_items AS f', 'LOWER(p.brand_name) = LOWER(f.unique_name)');

		//$this->db->join('filter_category_items AS f', 'LOWER(p.brand_name) LIKE CONCAT(\'%\', LOWER(TRIM(f.unique_name)), \'%\')');

		

		$this->db->where(1,1, FALSE);

		$this->db->where('f.column_id', 'brand_name');

		$this->db->like('LOWER(p.brand_name)', $brand_name);

		

		

		$this->db->limit(1);

		$result = $this->db->get()->row();

		//echo $this->db->last_query();

		if(!$result)

		{

			return false;

		}

		

		return $result;

	}



	public function category_tree() {

        // Implement your logic to fetch categories

        $this->db->select('*');

        $this->db->from('categories');

        $query = $this->db->get();

        return $query->result_array();

    }



    public function get_best_seller_products() {

    	$sql = 'SELECT p.*,pi.image AS img

FROM ci_products p

LEFT JOIN ci_product_images pi ON p.product_id = pi.product_id

AND pi.product_id = (

    SELECT MIN(product_id)

    FROM ci_product_images

    WHERE product_id = p.product_id

);';

        // Implement your logic to fetch bestseller products

$query = $this->db->query($sql)->result();

        return $query;

    }



}

