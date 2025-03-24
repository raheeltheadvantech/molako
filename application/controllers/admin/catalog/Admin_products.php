 <?php defined('BASEPATH') OR exit('No direct script access allowed'); 

//require_once(APPPATH.'third_party/ImageCache/ImageCache.php');

class Admin_products extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array(
		    'admin/catalog/Admin_product_model',
		    'admin/catalog/Admin_category_model',
		    'admin/catalog/Admin_brand_model',
            'admin/localisation/Admin_weight_model', 
            'admin/localisation/Admin_length_model' , 
            'admin/localisation/Admin_tax_class_model'));
		
		$this->controller_dir = 'catalog';
		$this->controller_name = 'products';
		$this->view_dir = 'catalog/products';
	}
	
	function index()
	{
        // show special products button in products
        $data['is_special_products'] = false;

		$data['page_title']		= 'Admin Products';
		$data['page_header']	= 'Admin Products';

		$order 		= $this->input->get('order') ? $this->input->get('order') : '';
		$sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
		$code 		= $this->input->get('code') ? $this->input->get('code') : '';
		$page 		= $this->input->get('page') ? $this->input->get('page') : 0;
		$rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
		$per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';
		
		//Filters list
        //$data['filter_distributors'] = $this->Admin_product_model->get_product_vendors();
        //$data['filter_manufacturers']       = $this->Admin_manufacturer_model->get_manufacturers(array('is_enabled' => 1, 'order'=>'name', 'sort'=>'asc'));
        $data['filter_categories']   = $this->Admin_category_model->get_categories(array('is_enabled' => 1));
		
		$term				= false;
		$data['code']		= $code;
		$post				= $this->input->post(null, false);
		
		$this->load->model('admin/Admin_search_model');
		
		if($post)
		{
			
			$term			= json_encode($post);
			$code			= $this->Admin_search_model->record_term($term);
			$data['code']	= $code;
			
			custom_redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/products.html?code='.$code));
		}
		elseif ($code)
		{
			$term			= $this->Admin_search_model->get_term($code);
		}
		
		$data['term']		= $term;
		$data['order_by']	= $order;
		$data['sort_by']	= $sort;
		
		$result	= $this->Admin_product_model->get_products(array('term'=>$term, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
		$total	= $this->Admin_product_model->get_products(array('term'=>$term, 'order'=>$order, 'sort'=>$sort), true);

		$data['result']	= $result;
		$data['total']	= $total;
		
		$config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/products.html?order='.$order.'&sort='.$sort.'&code='.$code);
		
		$config['total_rows']			= $total;
		$config['per_page']				= $rows;
		$config['offset']				= $per_page;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($config);
        // echo'<pre>';print_r($result);die;

        $data['add_link'] = site_url($this->admin_folder.'/catalog/product-add.html');
		$this->view($this->admin_view .'/'. $this->view_dir .'/product_list', $data);
	}
	
	function default_data(&$data)
	{
		$data['page_title']		= 'Product form';
		$data['page_header']	= 'Product form';
        $all    = $this->db->get('ci_colors')->result();
        $a = array();
        foreach ($all as $key => $value) {
            $a[strtolower($value->name)] = $value->code;
        }
        $data['all_colors'] = $a;


		$data['id']				= $this->input->get('id');
		$data['product_name']       = '';
		$data['short_description']  = '';
		$data['long_description']   = '';
		$data['is_enabled']         = '1';
		$data['barcode']                = '';
		$data['sku']        = '';
        $data['quantity']        = '';
		$data['category_id']        = '';
		$data['manufacturer_id']    = '';
        $data['brand_id']           = '';
		$data['distributor_id']     = '';
        $data['sale_price']         = '';
        $data['special_price']      = '';
        $data['map_price']          = '';
        $data['distributor_price']  = '';

        $data['length']             = '';
        $data['width']              = '';
        $data['height']             = '';
        $data['weight']             = '';
        $data['product_unit']       = '';
        $data['weight_unit']        = '';
        $data['p_unit'] 			= '';
        $data['w_unit'] 			= '';

        $data['is_shippable']       = '';
        $data['meta_title']         = '';
        $data['meta_description']   = '';
        $data['meta_keywords']      = '';
        $data['is_local']           = '0';

        $data['return_warrenty']    = '';
        $data['manufacturing_defect_warrenty']    = '';
        $data['courtesy_warranty']    = '';

        $data['keywords']                   = '';
        $data['display_model_number']       = '';
        $data['full_model_name']            = '';
        $data['country_of_origin']          = '';
        $data['warranty']                   = '';
        $data['tax_class_id']               = '';



        $data['filters']            = array();
        $data['additional_images']  = array();
        $data['product_inventory'] 	= array();
        $data['product_images']    	= array();
        $data['related_products']           = array();

        $data['categories']    		= $this->Admin_product_model->get_categories();
        $data['brands']    	= $this->Admin_product_model->get_brands();
		
		$data['route'] = 'product-add.html';
        $data['image'] = array(site_url(site_config_item('config_placeholder')));
	}
	
	function add()
	{
		$this->form();
	}
	
	function edit($id = false)
	{
		$this->form('edit');
	}

    private function form($mode = '')
    {
        $this->default_data($data);
        $this->lang->load('product_form');
        $pCategories = '';
        $categories = array();

        if ($mode == 'edit')
        {

            $id = $this->input->get('id');
            $result	= $this->Admin_product_model->get_product($id);



            if(!$result)
            {
                $this->admin_session->set_flashdata('error', lang('error_not_found'));
                redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/products.html'));
            }


            foreach($result as $key=>$val)
            {
                $data[$key] = $val;
            }


            $data['related_products']	= $this->Admin_product_model->get_related_products($id);
            $data['pspecifications']	= $this->Admin_product_model->get_product_specification($id);
            $data['product_images']	= $this->Admin_product_model->get_product_images($id);
            $data['special_price']	= $this->Admin_product_model->get_special_prices($id);
            $data['p_unit'] 				= $this->Admin_length_model->get_length_unit($result->product_unit);
            $data['w_unit'] 				= $this->Admin_weight_model->get_weight_unit($result->weight_unit);
            // echo '<pre>';print_r($data['option_name']);die();

            $pCategories	= $this->Admin_product_model->get_product_categories($id);

            $data['product_categories'] = $pCategories;

            $data['route'] 	= 'product-edit.html?id='.$data['id'];
        }
        // if($_POST)
        // {
        //     var_dump($_POST['product_category']);
        //     die('OKK');
        //     dd($_POST);
        // }


        $this->form_validation->set_rules('sku', 'SKU', 'trim|required|callback_is_product_sku_already_exist');
        $this->form_validation->set_rules('product_category[]', 'Category', 'trim|required');
        $this->form_validation->set_rules('sale_price', 'Sale Price', 'trim|required|numeric');
        //$this->form_validation->set_rules('special_price', 'Special Price', 'trim|numeric');
        //$this->form_validation->set_rules('length', 'Length', 'trim|numeric');
        //$this->form_validation->set_rules('width', 'Width', 'trim|numeric');
        //$this->form_validation->set_rules('height', 'Height', 'trim|numeric');
        //$this->form_validation->set_rules('weight', 'Weight', 'trim|numeric');
        //$this->form_validation->set_rules('meta_title', 'Meta Title', 'trim|required');
        //$this->form_validation->set_rules('meta_description', 'Meta Description', 'trim|required');
        //$this->form_validation->set_rules('meta_keywords', 'Meta Keywords', 'trim|required');

        $data['tree']	          = $this->Admin_product_model->categoryTree('','',$categories);
        $data['length_menu'] 	  = $this->Admin_length_model->get_lengths_menu();
        $data['weight_menu'] 	  = $this->Admin_weight_model->get_weights_menu();
        $data['tax_classes'] 	  = $this->Admin_tax_class_model->get_all_tax_class();


       // echo '<pre>';print_r($data['tax_classes']);die();

        if ($this->form_validation->run() == FALSE)
        {
            if(isset($_POST['variants_sku']) &&isset($_POST['variants_price']))
            {
                $old_data = [];
                foreach($_POST['variants_price'] as $k=> $v)
                {
                    if(isset($_POST['variants_sku'][$k]))
                    {
                        $sku = $_POST['variants_sku'][$k];
                        $qty = $_POST['variants_quantity'][$k];
                        $old_data[$sku] = $v;
                        $old_qty[$sku] = $qty;
                    }

                }
setcookie('old_data', json_encode($old_data), time() + (86400 * 30), "/"); // 86400 = 1 day

setcookie('old_qty', json_encode($old_qty), time() + (86400 * 30), "/"); // 86400 = 1 day
setcookie('session_set', 1, time() + (86400 * 30), "/"); // 86400 = 1 day

            }
            if(isset($_POST['product_related']) && $_POST['product_related'])
            {
                $rel = array();
                foreach($_POST['product_related'] as $k=> $v)
                {
                    $rel[] = $this->Admin_product_model->get_product($v);

                }
                $_POST['product_related'] = $rel;

            }
            $cats = array();
                if(isset($_POST['product_category']) && $_POST['product_category'])
                {
                    foreach($_POST['product_category'] as $k=> $v)
                    {
                        $cats[] = $this->Admin_category_model->get_sub_categories($v);

                    }
                    $_POST['product_category'] = $cats;
                }
            $data['session'] = ($_POST)?$_POST:array();
            if(validation_errors() && $_POST)
            {
                $_SESSION['error'] = validation_errors();
            }
            $this->view($this->admin_view . '/' . $this->view_dir . '/product_form', $data);
        }
        else{


            $save['product_id']                 = $data['id'];
            $save['is_local']                   = 1;

            // General Tab
            if(!$data['id'])
            {
                $slug  = $this->createSlug($this->input->post('product_name'));
                $save['product_slug']               = $slug;
            }
            $save['product_name']               = $this->input->post('product_name');

            $save['short_description']          = $this->input->post('short_description', true);
            $save['long_description']           = $this->input->post('long_description', true);
            $save['is_enabled']                 = $this->input->post('is_enabled');
            $save['sku']                        = $this->input->post('sku');
            $save['barcode']                    = $this->input->post('barcode');
            $save['quantity']                   = $this->input->post('quantity');

            // Links Tab
			//$save['distributor_id']   			= $this->input->post('distributor_id');
            $save['brand_id']                   =$brand_id= $this->input->post('brand_id');
            $brand                              = $this->Admin_brand_model->get_brand($this->input->post($brand_id));
            $save['brand_name']                 = ($brand)?$brand->name:'';
            $save['product_categories']         = $this->input->post('product_category');
           // $save['distributor_name']           = $this->Admin_product_model->get_distributor($this->input->post('distributor_id'))->name;
            //$save['brand_name']                 = $this->Admin_brand_model->get_brand($this->input->post('brand_id'))->name;

            // Filters Tab
            //$save['filters']                    = $this->input->post('filters');

            // Related Tab
            $save['product_related']            = $this->input->post('product_related');

            // Related Tab
            $save['product_images']            = preg_replace('/\s+/', '', $this->input->post('images'));

            //resize image
            if(!empty($save['product_images'])) {
                foreach ($save['product_images'] as $item) {
                    $this->image_resize($item);
                }
            }
            if(!empty($this->input->post('att_img'))) {
                foreach ($this->input->post('att_img') as $item) {
                    $this->image_resize($item);
                }
            }
            // Inventory Tab

            //options Tab
            $save['product_option_value_id']      = $this->input->post('product_option_value_id');
            $save['variants_combination']         = $this->input->post('variants_combination');
            $save['variants_type']                = $this->input->post('option_type');
            $save['variants_quantity']            = $this->input->post('variants_quantity');
            $save['variants_price']               = $this->input->post('variants_price');
            $save['dis_mode']               = $this->input->post('dis_mode');
            $save['dis_val']               = $this->input->post('dis_val');
            $save['dis_sdate']               = $this->input->post('dis_sdate');
            $save['dis_edate']               = $this->input->post('dis_edate');
            $save['variants_imgs']               = $this->input->post('att_img');
            $save['variants_sku']                 = $this->input->post('variants_sku');
            $save['variants_imgs']               = $this->input->post('att_img');
            $save['variants_sku']                 = $this->input->post('variants_sku');

            if(!empty($this->input->post('option_name')))
            $save['option_name']                 =  json_encode($this->input->post('option_name'));
            else
            $save['option_name']                 = '';


            if(!empty($this->input->post('option_value')))
			{
				$vls = $this->input->post('option_value');
				foreach($vls as $k=> $v)
				{
					$exp = array_unique(explode(',',$v));
					$vls[$k] = implode(',',$exp);
				}
                $save['option_value']                 =  json_encode($vls);
			}
            else
                $save['option_value']                 = '';
            if(!empty($this->input->post('color_code')))
                $save['color_code']                 =  json_encode($this->input->post('color_code'));
            else
                $save['color_code']                 = '';

            if(!empty($this->input->post('option_type')))
            $save['option_type']                 =  json_encode($this->input->post('option_type'));
            else
            $save['option_type']                 = '';


            $save['option_filter_name']                 =  $this->input->post('option_name');
            $save['option_filter_value']                 = $this->input->post('option_value');

            //product specifications
            $save['specify_name']                 = $this->input->post('specify_name');
            $save['specify_value']                = $this->input->post('specify_value');
            $save['specify_filter']                = $this->input->post('specify_filter');

            // Price Tab
            $save['sale_price']                 = $this->input->post('sale_price');

            //by default this for texable goods
            $save['tax_class_id']                 = $this->input->post('tax_class_id');

            //special price tab
            $save['special_price']              = $this->input->post('special_price');
            $save['start_date']              = $this->input->post('start_date');
            $save['end_date']              = $this->input->post('end_date');

            $save['is_shippable']               = $this->input->post('is_shippable');

            if($save['is_shippable'] == 1) {
                // Shipping tab
                $save['length'] = $this->input->post('length');
                $save['width'] = $this->input->post('width');
                $save['height'] = $this->input->post('height');
                $save['weight'] = $this->input->post('weight');
                $save['weight_unit'] = $this->input->post('weight_unit');
                $save['product_unit'] = $this->input->post('product_unit');
            }else{
                $data['length']             = '';
                $data['width']              = '';
                $data['height']             = '';
                $data['weight']             = '';
                $data['product_unit']       = '';
                $data['weight_unit']        = '';
            }

            $save['return_warrenty']                  = $this->input->post('return_warrenty');
            $save['manufacturing_defect_warrenty']    = $this->input->post('manufacturing_defect_warrenty');
            $save['courtesy_warranty']                = $this->input->post('courtesy_warranty');


            // SEO Tab
            $save['meta_title']                 = $this->input->post('meta_title');
            $save['meta_description']           = $this->input->post('meta_description', true);
            $save['meta_keywords']              = $this->input->post('meta_keywords', true);
            if($mode != 'edit')
            {

                $save['date_added']                 = date('Y-m-d H:i:s');
            }
            $save['date_modified']              = date('Y-m-d H:i:s');

             
            // echo'<pre>';print_r($save['product_option_value_id']);die;
            $this->Admin_product_model->save($save);
			$this->play_discount($save['brand_id']);
            wite_nav_curl();



			// $this->admin_session->set_flashdata('message', 'Product have been saved successfully!'); 
            $_SESSION['message'] = 'Product have been saved successfully!';

            
            custom_redirect(base_url($this->admin_folder .'/'. $this->controller_dir. '/products.html'));
        }
    }
	    public function play_discount($brand_id)
    {

        $brand = $this->Admin_brand_model->get_by_id($brand_id);
        $products = $this->db->where('brand_id',$brand_id)->get('products')->result_array();
            $ids = array();
            $in = array();
            foreach ($products as $k => $v) {
                $ids[] = $v['product_id'];
                $nprice = $price = $v['sale_price'];
                if($brand->dis_mode == 'fixed')
                {
                    $nprice = $nprice - $brand->dis_val;

                }
                elseif($brand->dis_mode == 'per')
                {
                    $per = ($price * $brand->dis_val)/100;
                    $nprice = $nprice - $per;
                }
                $in[] = array(
                    'product_id'=> $v['product_id'],
                    'price'=> $nprice,
                    'from_date'=> $brand->dis_sdate,
                    'to_date'=> $brand->dis_edate,

                );
            }
            //delete old prices
            if($ids)
			{
            $this->db->where_in('product_id',$ids)->delete('discount_prices');
			}
        if(isset($brand->dis_val) && $brand->dis_val)
        {
            $r = $this->db->insert_batch('discount_prices', $in);

        }
        //variations
        if($ids)
        {
            $varis = $this->db->where_in('product_id',$ids)->get('product_option_value')->result_array();
            $vids = array();
            $in = array();
            foreach($varis as $k => $v)
            {
                $vids[] = $v['product_option_value_id'];
                unset($v['product_option_value_id']);
                $v['is_brand'] =  $brand->is_enabled;
                $v['bdis_mode'] = $brand->dis_mode;
                $v['bdis_val'] = $brand->dis_val;
                $v['bdis_sdate'] = $brand->dis_sdate;
                $v['bdis_edate'] = $brand->dis_edate;
                $in[] = $v;
            }
                //delete old variations
            if($vids)
            {
                $this->db->where_in('product_option_value_id',$vids)->delete('product_option_value');
            }

            if($in)
            {
                $r = $this->db->insert_batch('product_option_value', $in);

            }
        }

    }


    public function createSlug($str, $delimiter = '-')
    {
        $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
        $count = 1;
        $originalSlug = $slug;

    while ($this->db->where('product_slug', $slug)->get('products')->num_rows() > 0) {
        $slug = $original_slug . '-' . $count;
        $count++;
    }
        return $slug;
    }

    function is_product_sku_already_exist($str)
    {

        $product_id	= $this->input->get('id');
        $result = $this->Admin_product_model->is_sku_already_exist($str , $product_id);
        if ($result)
        {

            $this->form_validation->set_message('is_product_sku_already_exist', 'Product sku is already exist');
            // $_SESSION['error'] = 'Product sku is already exist';

            // custom_redirect(base_url($this->admin_folder .'/'. $this->controller_dir. '/products.html'));

            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }


    public function mark_as_disable()
    {
        $json = array('error' => true, 'result' => array());

          $products = $this->input->post('product_ids');

          foreach ($products as $val){
              $this->Admin_product_model->disable_product($val);
          }
          $json['message'] = 'Product has been disabled successfully!';
        ajax_response($json);
    }

	public function products_autocomplete()
    {
        $term['term'] 		= $this->input->post('term') ? $this->input->post('term') : '';

        $term = json_encode($term);

        $rows 		= 10;
        $per_page 	= '';

        $result['result']	= $this->Admin_product_model->get_products_typehead(array('term'=>$term,'rows'=>$rows, 'per_page'=>$per_page));
       echo json_encode($result['result']);
        //ajax_response($result);
	}


    public function category_autocomplete()
    {
        $term['term'] 		= $this->input->post('term') ? $this->input->post('term') : '';

        $term = json_encode($term);

        $rows 		= 10;
        $per_page 	= '';

        $result['result']	= $this->Admin_category_model->get_category_typehead(array('term'=>$term,'rows'=>$rows, 'per_page'=>$per_page));

        echo json_encode($result['result']);
        //ajax_response($result);
    }

    public function save_options()
    {

        $product_id =  $this->input->post('product_id');
        $product_name =  $this->input->post('product_name');

        $option_name = null;
        $option_value = null;

        // Check if from data available
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($this->input->post('option_name'))) {
            $option_name = $this->input->post('option_name');
            $option_value = $option_value_def = $this->input->post('option_value');
			$vls = $this->input->post('option_value');
				foreach($vls as $k=> $v)
				{
					$exp = array_unique(explode(',',$v));
					$vls[$k] = implode(',',$exp);
				}
				$option_value = $vls;
			
        }

        // Check for DB if from data unavailable
        if (!empty($product_id) && (!empty($option_name) || !empty($option_value))) {
            try {

                $result	= $this->Admin_product_model->get_product_options($product_id);

                $option_name = !empty($result['option_name']) ? json_decode($result['option_name']) : null;
                $option_value = !empty($result['option_value']) ? json_decode($result['option_value']) : null;
                $option_value = $option_value_def;


                $options = $this->prepareOptions($option_name, $option_value);

                $variants	= $this->Admin_product_model->get_product_option_value($product_id);
                // dd($variants);


                $optionCol = [];
                if (!empty($variants[0]['combination'])) {
                    $optionCol = $this->prepareOptionCols($variants[0]['combination']);
                }

                if (!empty($variants)) {
                    $variantsData = [
                        'options' => $options,
                        'columns' => $optionCol,
                        'rows' => [],
                    ];

                    echo $theHTMLResponse    = $this->load->view($this->admin_view . '/' . $this->view_dir . '/new_options.php', $variantsData, true);
                    exit();

                }
                else
                {
                    $options = $this->prepareOptions($option_name, $option_value);
        // Get all combinations
        $combinations = $this->getVariantCombinations($options);
        // echo 'option<pre>';print_r($options);die;
        $variants = [];
        $variant_tmpl = [
            'product_option_value_id' => 1,
            'product_id' => 1,
            'combination' => [],
            'price' => 1,
            'quantity' => 1,
            'sku' => 1,
        ];

        $i = 0;
        foreach ($combinations as $combination) {
            $i++;
            $variant_tmpl['product_id'] = $i;
            $variant_tmpl['combination'] = $combination;
            $variant_tmpl['price'] = 0;
            $variant_tmpl['quantity'] = 1;
            $variant_tmpl['sku'] = str_replace(' ', '', trim($product_name)).implode('_',$combination);

            $variants[] = $variant_tmpl;
        }


        $optionCol = array_keys($variants[0]['combination']);
        $option_name = $_POST['option_name'];
        $options = $this->prepareOptions($option_name, $option_value);
        // $optionCol = $variants['combination'];
        array_unshift($optionCol, "image");
        $optionCol[] = 'Price';
        $optionCol[] = 'Stock';
        $optionCol[] = 'SKU';


        $variantsData = [
            'options' => $options,
            'columns' => $optionCol,
            'rows' => array(),
        ];


        // echo 'variant<pre>';print_r($variants);die;

        echo $theHTMLResponse    = $this->load->view($this->admin_view . '/' . $this->view_dir . '/new_options.php', $variantsData, true);

        // echo $theHTMLResponse    = $this->load->view($this->admin_view . '/' . $this->view_dir . '/options.php', $variantsData, true);
        die();
                }

                ///////////////////////////////////////////////////////////


            } catch (Exception $e) {
                //
            }

        }


        // if options are not available on this stage then return empty object
        if (empty($option_name) || empty($option_value)) {
            $variantsData = [
                'options' => [],
                'columns' => [],
                'rows' => [],
            ];


            //echo json_encode($variantsData);
            echo $theHTMLResponse    = $this->load->view($this->admin_view . '/' . $this->view_dir . '/options.php', $variantsData, true);
            exit();
        }



        $options = $this->prepareOptions($option_name, $option_value);
        // Get all combinations
        $combinations = $this->getVariantCombinations($options);
        // echo 'option<pre>';print_r($options);die;
        $variants = [];
        $variant_tmpl = [
            'product_option_value_id' => 1,
            'product_id' => 1,
            'combination' => [],
            'price' => 1,
            'quantity' => 1,
            'sku' => 1,
        ];

        $i = 0;
        foreach ($combinations as $combination) {
            $i++;
            $variant_tmpl['product_id'] = $i;
            $variant_tmpl['combination'] = $combination;
            $variant_tmpl['price'] = 0;
            $variant_tmpl['quantity'] = 1;
            $variant_tmpl['sku'] = str_replace(' ', '', trim($product_name)).implode('_',$combination);

            $variants[] = $variant_tmpl;
        }


        $optionCol = array_keys($variants[0]['combination']);
        // $optionCol = $variants['combination'];
        array_unshift($optionCol, "image");
        $optionCol[] = 'Price';
        $optionCol[] = 'Stock';
        $optionCol[] = 'SKU';


        $variantsData = [
            'options' => $options,
            'columns' => $optionCol,
            'rows' => array(),
        ];


        // echo 'variant<pre>';print_r($variants);die;

        echo $theHTMLResponse    = $this->load->view($this->admin_view . '/' . $this->view_dir . '/new_options.php', $variantsData, true);

        // echo $theHTMLResponse    = $this->load->view($this->admin_view . '/' . $this->view_dir . '/options.php', $variantsData, true);
        die();
    }


    public function getVariants($product_id = 0)
    {

        // Get variants from DB / Form
        $options = null;


        $option_name = null;
        $option_value = null;

        // Check if from data available
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_REQUEST['option_name'])) {
            $option_name = $_REQUEST['option_name'];
            $option_value = $_REQUEST['option_value'];
        }


        // Check for DB if from data unavailable
        if (!empty($product_id) && (empty($option_name) || empty($option_value))) {

            try {


                ///////////////////////////////////////////////////////////
                /// Database operation
                ///////////////////////////////////////////////////////////
                //$this->load->database();
                $qry = 'SELECT option_name, option_value FROM oc_product WHERE `product_id`= "' . $product_id . '" LIMIT 1';
                $CI = &get_instance();
                $row = $CI->db->query($qry)->row_array();
                $option_name = !empty($row['option_name']) ? json_decode($row['option_name']) : null;
                $option_value = !empty($row['option_value']) ? json_decode($row['option_value']) : null;

                $options = $this->prepareOptions($option_name, $option_value);


                $qry = 'SELECT * FROM oc_product_option_value  WHERE `product_id`= "' . $product_id . '" ORDER BY `product_option_value_id` ASC ';

                $query = $CI->db->query($qry);

                $variants = [];
                foreach ($query->result_array() as $row) {

                    $variants[] = [
                        'product_option_value_id' => $row['product_option_value_id'],
                        'product_id' => $row['product_id'],
                        'combination' => json_decode($row['combination'], true),
                        'price' => $row['price'],
                        'quantity' => $row['quantity'],
                        'sku' => $row['sku'],
                        'image' => $row['image'],
                    ];
                }

                $optionCol = [];
                if (!empty($variants[0]['combination'])) {
                    $optionCol = $this->prepareOptionCols($variants[0]['combination']);
                }

                if (!empty($variants)) {
                    $variantsData = [
                        'options' => $options,
                        'columns' => $optionCol,
                        'rows' => $variants,
                    ];

                    echo json_encode($variantsData);
                    exit();
                }

                ///////////////////////////////////////////////////////////


            } catch (Exception $e) {
                //
            }

        }

    } 

    public function prepareOptionCols($combination = [])
    {

        $optionCol = array_keys($combination);
        array_unshift($optionCol, "image");
        $optionCol[] = 'Price';
        $optionCol[] = 'Stock';
        $optionCol[] = 'SKU';

        return $optionCol;
    }

    public function prepareOptions($option_name = [], $option_value = [])
    {
        $options = [];
        if (empty($option_name)) {
            return $options;
        }

        for ($i = 0; $i < count($option_name); $i++) {
            if (empty($option_name[$i]) || empty($option_value[$i])) {
                continue;
            }

            $opt_name = str_replace('', '-', $option_name[$i]);
            //$opt_name = $option_name[$i];
            $opt_val = $option_value[$i];

            foreach (explode(',', $opt_val) as $value) {
                if (empty($value)) continue;
                $options[$opt_name][] = $value;
            }

        }

        return $options;
    }

    public function getVariantCombinations($arrays)
    {
        $result = [[]];
        foreach ($arrays as $property => $property_values) {
            $tmp = [];
            foreach ($result as $result_item) {
                foreach ($property_values as $property_value) {
                    $tmp[] = array_merge($result_item, [$property => $property_value]);
                }
            }
            $result = $tmp;
        }
        return $result;
    }

    function image_uploader()
    {

        $target_folder = 'images/products/';

        //$data['file_name'] 		= false;
        $data['error']			= false;

        $config['allowed_types'] 	= 'gif|jpg|png|jpeg|webp';
        $config['max_size']		= $this->config->item('size_limit');
        $config['upload_path'] 		= $target_folder . 'temp/';
        $config['encrypt_name'] 	= true;
        $config['remove_spaces']	= false;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file'))
        {

            $upload_data = $this->upload->data();

            $this->load->library('image_lib');
            $data['file_name']     = $upload_data['file_name'];
            if(!isset($_POST['ajax']))
            {

                    echo $data['file_name'];
            }
            else
            {
                $data['savefile'] = $data['file_name'];
                $data['file_name'] = base_url($config['upload_path'].'/'.$data['file_name']);
                $data['success'] = 1;
            }
            $data['file_name_orig']	= $upload_data['orig_name'];

        }

        if($this->upload->display_errors() != '')
        {
            $data['error'] = $this->upload->display_errors();
        }
        if(isset($_POST['ajax']))
        {
            echo json_encode($data);
            exit();
        }

    }


    function image_resize($image_name){

        $this->load->library('image_lib');

        $target_folder = 'images/products/';

        $data = file_get_contents("dimension.json");
        $size = json_decode($data, true);


        //this is the image
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $target_folder . 'temp/'. $image_name;
        $config['new_image']		= $target_folder . 'full/'. $image_name;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			=  $size['primary']['width'];
        $config['height']			=  $size['primary']['height'];
		
        $this->image_lib->initialize($config);

        $r = $this->image_lib->resize();
        $this->image_lib->clear();


        //this is the larger image
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $target_folder . 'full/'. $image_name;
        $config['new_image']		= $target_folder . 'medium/'. $image_name;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			=  $size['large']['width'];
        $config['height']			=  $size['large']['height'];
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        //small image
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $target_folder . 'medium/'. $image_name;
        $config['new_image']		= $target_folder . 'small/'. $image_name;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			=  $size['small']['width'];
        $config['height']			=  $size['small']['height'];
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        //cropped thumbnail
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $target_folder . 'medium/'. $image_name;
        $config['new_image']		= $target_folder . 'thumbnails/'.$image_name;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			=  $size['thumb']['width'];
        $config['height']			=  $size['thumb']['height'];
        $config['exact_size']		= TRUE;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        //delete temp file
        $prev_file_path = "./images/products/temp/".$image_name;
        if(file_exists($prev_file_path ))
        {
            unlink($prev_file_path );
        }

    }

}
