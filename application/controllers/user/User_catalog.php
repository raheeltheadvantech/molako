<?php defined('BASEPATH') or exit('No direct script access allowed');


class User_catalog extends User_Public_Controller
{


    private $is_solr_ping = true;


    function __construct()

    {

        parent::__construct();


        // load User_featured_module_model

        $this->load->model('user/common/User_featured_module_model');

        $this->load->model('user/catalog/User_catalog_model');

        $this->load->model('Search_model');

        $this->load->model('user/catalog/User_brand_model');


        $this->controller_name = 'user_catalog';

        $this->controller_dir = 'user';

        $this->view_dir = 'catalog';


        $this->load->helper('string');

    }


    function index()

    {

        $this->catalog();

    }



    // public function indexes() {        

    // $this->load->model('User_catalog_model'); 

    // 	$data['categories'] = $this->User_catalog_model->category_tree();

    //     $data['bestseller_products'] = $pros = $this->User_catalog_model->get_best_seller_products();

    // 	$data['assets_img_dir'] = 'images/products/full/';

    //     $this->load->view('your_view', $data); 

    // }


    function do_search_ajax()

    {

        is_ajax();


        $term = $this->input->post();


        $result = $this->User_catalog_model->do_search(array('term' => $term));


        if (!$result) {

            ajax_response(array('message' => 'Item not found'));

        }


        $data = array();

        foreach ($result as $key => $val) {

            if ($val->product_name == '') {

                continue;

            }


            $data[] = array('name' => $val->product_name, 'value' => $val->product_name, 'q' => $term['q'],);

        }


        if (!$data) {

            ajax_response(array('message' => 'Item not found'));

        }


        ajax_response(array('error' => false, 'data' => $data, 'message' => 'Item found', 'sit' => true));

    }


    public function catalog_ajax()

    {

        echo "<pre>";

        print_r($this->input->get());

        echo "</pre>";

        exit;

    }


    function catalog()
    {
        $data['meta_title'] = 'Catalog';
        $data['meta_keywords'] = 'Catalog';
        $data['meta_description'] = 'Catalog';
        $data['title'] = 'Catalog';
        $data['page_title'] = 'Catalog';
        $data['page_header'] = 'Catalog';
        $layout_id = $this->input->get('layout') ? $this->input->get('layout') : '';
        $this->input->get('layout_id') ? $this->input->get('layout_id') : '';
        $layout_style = 'grid_3';
        $this->by_category($layout_style, $data);
    }


    public function deals()
    {
        $data['meta_title'] = 'Deals';
        $data['meta_keywords'] = 'Deals';
        $data['meta_description'] = 'Deals';
        $data['page_title'] = 'Deals';
        $data['page_header'] = 'Check it out Deals';
        $layout_id = $this->input->get('layout') ? $this->input->get('layout') : '';
        $this->input->get('layout_id') ? $this->input->get('layout_id') : '';
        $layout_style = 'grid_3';
        $ret['products'] = $this->User_featured_module_model->get_new_special_products_remove();
        $data['result'] = (object)$ret;
        $data['sort_id'] = '';
        $data['is_special'] = 1;
        $this->view($this->user_view . '/' . $this->view_dir . '/catalog_by_deals.php', $data);
    }


    public function brands($slug)
    {
        $data['meta_title'] = 'Brands';
        $data['meta_keywords'] = 'Brands';
        $data['meta_description'] = 'Brands';
        $data['page_title'] = 'Brands';
        $data['page_header'] = 'Brands';
        $layout_id = $this->input->get('layout') ?: $this->input->get('layout_id') ?: '';
        $layout_style = 'grid_3';
        $brand = $this->User_brand_model->get_brands($slug);
        // Fetch products with variants based on the brand slug
        $pros = array();
        if (isset($brand[0]->brand_id)) {
            $brand_id = $brand[0]->brand_id;
            $pros = $this->User_brand_model->get_products_by_brand($brand_id);
        }
        $data['products'] = $pros;
        $this->by_category($layout_style, null, $slug, $data);

    }

    function super_unique($array, $key)
    {
        $temp_array = [];
        foreach ($array as &$v) {
            if (!isset($temp_array[$v[$key]]))
                $temp_array[$v[$key]] =& $v;
        }
        $array = array_values($temp_array);
        return $array;
    }

    public function get_parent_categories($category_id)
    {
        $categories = [];
        while ($category_id != null) {
            $query = $this->db->get_where('categories', ['id' => $category_id]);
            $category = $query->row_array();

            if ($category) {
                $categories[] = $category;
                $category_id = $category['parent_id']; // Move to parent
            } else {
                break;
            }
        }
        return array_reverse($categories); // Parent to Child Order
    }


    private function by_category($layout_style = 'grid', $data = array(), $is_deals = false, $brand_slug = false)

    {

        $data['meta_title'] = '';
        $data['meta_keywords'] = '';
        $data['meta_description'] = '';
        $data['page_title'] = 'Catalog';
        $data['page_header'] = 'Catalog';
        $data['is_deals'] = $is_deals;
        $data['is_special'] = $this->input->get('is_special');
        $params = array();
        $order = $this->input->get('order') ? $this->input->get('order') : '';
        $sort = $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code = $this->input->get('code') ? $this->input->get('code') : '';
        $page = $this->input->get('page') ? $this->input->get('page') : 1;
        $rows = $this->input->get('rows') ? $this->input->get('rows') : '12';
        $per_page = $this->input->get('per_page') ? $this->input->get('per_page') : '12';
        $data['sort_menu'] = get_sort_menu();
        $data['sort_id'] = $order . '.' . $sort;
        $result = new stdClass();
        if ($this->input->get('category_id')) {
            $category_id = $this->input->get('category_id');
        } else {
            $category_id = '';
        }
        $result->category_menu = $this->User_catalog_model->get_category_menu($category_id);
        $filter_ids = false;
        $filter_url_append = false;
        $filter_link = 'catalog.html?layout_id=1&category_id=' . $category_id;
        if ($this->input->get('filter_id')) {
            $data['filter_ids'] = $this->input->get('filter_id');
            $filter_ids = $this->input->get('filter_id');
        }
        $price = array();
        $price[0] = $this->input->get('min_price');
        $price[1] = $this->input->get('max_price');
        if (!empty($filter_ids)) {
            foreach ($filter_ids as $filter_id) {
                $filter_url_append .= '&filter_id[]=' . $filter_id;
            }
        }
        $data['filter_link'] = $filter_link;
        $data['filter_ids'] = $filter_ids;
        $this->current_active_nav = 'category-' . $category_id;
        $data['category_id'] = $category_id;
        $data['sub_cats'] = $result->category_menu;
        $data['breadcrumb'] = getbreadcrumb($category_id);
        $term = false;
        $data['code'] = $code;
        $post = $this->input->post(null, false);
        if ($post) {
            $term = json_encode($post);
            $code = $this->Search_model->record_term($term);
            $data['code'] = $code;
            if ($_POST['is_special'] == 1) {
                redirect(site_url($this->user_url . '/' . 'deals.html?layout_id=1&code=' . $code));
            } else {
                redirect(site_url($this->user_url . '/' . 'catalog.html?layout_id=1&code=' . $code));
            }
        } elseif ($code) {
            $term = $this->Search_model->get_term($code);
        }
        $data['term'] = $term;
        $data['order_by'] = $order;
        $data['sort_by'] = $sort;
        $brand_id = 0;
        if ($this->input->get('brand_id')) {
            $brand_id = $this->input->get('brand_id');
        }
        $total1 = array();
        if (!empty($filter_ids)) {
            $total1 = $this->User_catalog_model->get_filter_products(array('is_special' => $this->input->get('is_special'), 'params' => $params, 'category_id' => $category_id, 'term' => $term, 'order' => $order, 'brand_id' => $brand_id, 'sort' => $sort, 'rows' => $rows, 'per_page' => $per_page, 'filter_ids' => $filter_ids), true, $brand_slug);
            $total = $this->User_catalog_model->get_filter_products(array('is_special' => $this->input->get('is_special'), 'price' => $price, 'params' => $params, 'category_id' => $category_id, 'term' => $term, 'order' => $order, 'brand_id' => $brand_id, 'sort' => $sort, 'rows' => $rows, 'per_page' => $per_page, 'filter_ids' => $filter_ids), true, $brand_slug);
        } else {
            $total1 = $this->User_catalog_model->get_products(array('is_special' => $this->input->get('is_special'), 'brand_id' => $brand_id, 'params' => $params, 'category_id' => $category_id, 'term' => $term, 'order' => $order, 'sort' => $sort), true, $is_deals, 'test');
            $total1 = $total = $this->User_catalog_model->get_products(array('is_special' => $this->input->get('is_special'), 'price' => $price, 'brand_id' => $brand_id, 'params' => $params, 'category_id' => $category_id, 'term' => $term, 'order' => $order, 'sort' => $sort), true, $is_deals, 'test');
            $total_all = $this->User_catalog_model->get_products(array('params' => $params, 'category_id' => $category_id, 'term' => $term, 'order' => $order, 'sort' => $sort, 'rows' => $rows, 'per_page' => $per_page), null, $is_deals, $brand_slug);
        }
        $page_pro = array();
        foreach ($total as $k => $v) {
            if (!isset($v->remove)) {
                $page_pro[] = $v;
            }
        }
        $products = $page_pro;
        $current_page = $page; // Set this to the current page you want to display
// Calculate Total Pages
        $total_items = count($products);
        $total_pages = ceil($total_items / $per_page);
// Calculate Offset
        $offset = ($current_page - 1) * $per_page;
// Get Current Page Products
        $current_page_products = array_slice($products, $offset, $per_page);
// Pagination Data
        $pagination_data = [
            "current_page" => $current_page,
            "per_page" => $per_page,
            "total_items" => $total_items,
            "total_pages" => $total_pages,
            "products" => $current_page_products,
        ];
// Display Pagination Data
        $data['tpage'] = $total_pages;
        $data['cpage'] = $current_page;
        $res = $result->products = $current_page_products;
        //fdind min and max
        $min = 0;
        $max = 0;
        $pbrands = [];
        foreach ($total1 as $k => $v) {
            if (!in_array($v->brand_id, $pbrands)) {
                $pbrands[] = $v->brand_id;
            }
            $price = 0;
            if ($v->varient_price) {
                $price = $v->varient_price->price;

            } elseif ($v->special_price) {
                $price = $v->special_price;

            } else {
                $price = $v->sale_price;
            }
            if ($price > $max) {
                $max = $price;
            }
            if ($price < $min) {
                $min = $price;
            }
        }
        $data['max_price'] = $max;
        $data['min_price'] = $min;
        if ($this->input->get('price')) {
            $exp = explode('_', $this->input->get('price'));
            if (isset($exp[0]))
                $min = $exp[0];
            else {
                $min = $data['min_price'];
            }
            if (isset($exp[1]))
                $max = $exp[1];
            else {
                $max = $data['max_price'];
            }
        }
        if ($data['smax_price'] > $data['max_price']) {
            die('come hgere');
            $data['smax_price'] = $data['max_price'];
        }
        if ($data['smin_price'] < $data['min_price']) {
            $data['smin_price'] = $data['min_price'];
        }
        $data['smax_price'] = $max;
        $data['smin_price'] = $min;
        if ($this->input->get('price')) {
            $exp = explode('_', $this->input->get('price'));
            if (isset($exp[0]))
                $min = $exp[0];
            else {
                $min = $data['min_price'];
            }
            if (isset($exp[1]))
                $max = $exp[1];
            else {
                $max = $data['max_price'];
            }
        }
        if ($data['smax_price'] > $data['max_price']) {
            die('come hgere');
            $data['smax_price'] = $data['max_price'];
        }
        if ($data['smin_price'] < $data['min_price']) {
            $data['smin_price'] = $data['min_price'];
        }
        $data['smax_price'] = $max;
        $data['smin_price'] = $min;
        //fdind min and max
        $this->db->select('*');
        if ($pbrands)
            $this->db->where_in('brand_id', $pbrands);
        $this->db->from('brands');
        $this->db->where(1, 1, FALSE);
        $this->db->where('is_enabled', 1);
        $brands = $this->db->get()->result();
        $result->brands = $brands;
        $data['result'] = $result;
        $data['total'] = $total;
        $data['badge'] = '';
        if ($is_deals == 1) {
            $config['base_url'] = site_url($this->user_url . '/' . 'deals.html?layout_id=1&order=' . $order . '&sort=' . $sort . '&code=' . $code);

        } else {
            $config['base_url'] = site_url($this->user_url . '/' . 'catalog.html?layout_id=1&order=' . $order . '&sort=' . $sort . '&code=' . $code);
            $data['badge'] = 1;
        }
        $filter = array();
        $all_colors = array();
        $newColorsArray = [];
        if (!empty($res)) {
            foreach ($total as $key => &$val) {
                $mtypes = array();
                $color_code = array();
                $codes = array();
                if (isset($val->option_type) && $val->option_type) {
                    $option_type = json_decode($val->option_type, true);
                    $color_code = json_decode($val->color_code, true);
                    foreach ($color_code as $colorGroup) {
                        foreach ($colorGroup as $colorName => $hexCode) {
                            $newColorsArray[$colorName] = $hexCode;
                        }
                    }
                    $option_name = json_decode($val->option_name, true);
                    $codes = array();
                    foreach ($option_name as $k => $v) {
                        $mtypes[$v] = $option_type[$k];
                        $codes[$v] = $color_code[$k];
                    }
                }


                $filters_val = $this->User_catalog_model->get_filters($val->product_id);
                if (!empty($filters_val)) {
                    foreach ($filters_val as $keyy => $attribute) {
                        $t = '';
                        $index = -1;
                        if (isset($mtypes[$attribute['filter_key']])) {
                            $t = $mtypes[$attribute['filter_key']];
                            $index = array_search($attribute['filter_key'], $option_name);

                        }
                        $cool = (isset($color_code[$index])) ? $color_code[$index] : array();
                        if ($index != -1) {
                            if (isset($codes[$attribute['filter_key']])) {
                                $color_code = $codes[$attribute['filter_key']];
                            }

                        }
                        foreach ($attribute['filter_value'] as $vall) {
                            if ($t == 'color') {
                                $c = $vall;

                                $filter[$attribute['filter_key']][] = array('color' => trim($vall), 'code' => (isset($newColorsArray[$c]) ? $newColorsArray[$c] : '#000'));
                            } else {
                                $filter[$attribute['filter_key']][] = trim($vall);
                            }

                        }
                        $filter[$attribute['filter_key']]['type'] = $t;
                    }
                }
            }
            $filters = array();
            if (!empty($filter)) {
                foreach ($filter as $key => $val) {
                    if ($val['type'] == 'color') {
                        $cool = $color_code;
                        $colors = $val;
                        unset($val['type']);
                        $uniqueColors = [];
                        foreach ($colors as $color) {
                            // Use color as the key to filter unique entries
                            if (isset($color['color'])) {
                                $uniqueColors[$color['color']] = $color;
                            }
                        }
                        $uniqueColors = array_values($uniqueColors);
                        $n = array('type' => 'color');
                        foreach ($uniqueColors as $k => $v) {
                            if (isset($v['color']))
                                $n[] = array('color' => $v['color'], 'code' => $v['code']);
                        }

                        $filters[$key] = $n;
                    } else {
                        $filters[$key] = array_unique($val);
                    }

                }

            }

            $data['filters'] = $filters;

        }


        $data['result'] = $result;

        $data['total'] = $total;
        $brand_id = '';
        if (isset($_GET['brand_id'])) {
            $brand_id = $_GET['brand_id'];
        }


        $config['base_url'] = site_url($this->user_url . '/' . 'catalog.html?layout_id=1&price=' . $this->input->get('price') . '&order=' . $order . '&category_id=' . $category_id . '&brand_id=' . $brand_id . '&sort=' . $sort . '&code=' . $code . $filter_url_append);


        $config['total_rows'] = $total;

        $config['per_page'] = $per_page;

        $config['offset'] = $per_page;

        $config['uri_segment'] = $this->uri->total_segments();

        $config['use_page_numbers'] = TRUE;

        $config['page_query_string'] = TRUE;

        $config['reuse_query_string'] = TRUE;


        $this->load->library('pagination');

        $this->pagination->initialize($config);


        $this->view($this->user_view . '/' . $this->view_dir . '/catalog_by_category', $data);
        if (isset($_GET['debug'])) {
            $this->output->enable_profiler(TRUE);
        }

    }


    function product_detail($slug)

    {

        $product = $this->User_catalog_model->get_product_slug($slug);
        // dd($product);

        $product_id = $product->product_id;

        // pre($product);

        if (!$product) {

            redirect($this->user_url . '/' . 'catalog.html');

        }
        if (!$product->is_enabled) {

            redirect($this->user_url . '/' . 'catalog.html');

        }


        // $images = explode('|', $product->image);

        //$product->images = $images;
        //var_dump($product);
        // die('OKK');
        $val = (object)$product;
        $val->images = get_product_images($val->product_id);
        $val->special_price = get_product_special_price($val->product_id);

        if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {
            $val->is_variation = 1;
            $val->varient_price = get_product_varient_price($val->product_id)->price;
        } else {
            $val->is_variation = 0;
            $val->varient_price = 0;
        }
        $product = $val;
        if (json_decode($val->option_name, true)) {

            $p = get_product_varient_price($val->product_id);
            if (isset($p->quantity) && $p) {
                $product->quantity = $p->quantity;
            } else {
                $product->quantity = 0;
            }
        }


        $data['result'] = $product;
        $data['option_name'] = json_decode($product->option_name);
        $data['option_type'] = json_decode($product->option_type);
        $data['color_code'] = json_decode($product->color_code, true);
        $data['option_value'] = json_decode($product->option_value);
        $config_catalog_purchase = $this->db->where('key', 'config_catalog_purchase')->get('ci_settings')->row();
        if ($config_catalog_purchase) {
            $config_catalog_purchase = $config_catalog_purchase->value;
        } else {
            $config_catalog_purchase = 0;
        }
        $data['config_catalog_purchase'] = $config_catalog_purchase;
        $config_catalog_outstock = $this->db->where('key', 'config_catalog_outstock')->get('ci_settings')->row();
        if ($config_catalog_outstock) {
            $config_catalog_outstock = $config_catalog_outstock->value;
        } else {
            $config_catalog_outstock = 0;
        }
        $data['config_catalog_outstock'] = $config_catalog_outstock;


        $variants_data = $this->User_catalog_model->get_product_variants($product_id);
        $com = $this->User_catalog_model->get_combinations($product_id);
        $combination = array();
        foreach ($com as $k => $v) {
            $combination[] = array('comb' => json_decode($v->combination), 'stock' => $v->quantity);
        }

        //Get first variaTOION
        $sing = $this->User_catalog_model->get_single_variants($product_id);
        if (isset($sing->combination))
            $data['comb'] = json_decode($sing->combination, true);
        $data['sing_var'] = $sing;
        // dd($data['sing_var']);
        $data['combination'] = $combination;
        //Get first variation


        //$variants_data = json_decode($variants_resp, true);


        $data['variations'] = '';

        if (!empty($variants_data['variants'])) {

            $data['variations'] = $variants_data['variants'];

        }


        // dd($data['variations']);


        $data['meta_title'] = isset($product->meta_title) ? $product->meta_title : '';

        $data['meta_keywords'] = isset($product->meta_keywords) ? $product->meta_keywords : '';

        $data['meta_description'] = isset($product->meta_description) ? $product->meta_description : '';


        $data['page_title'] = ((isset($product->meta_title) ? $product->meta_title : '') ? $product->meta_title : $product->product_name);

        $data['page_header'] = $product->product_name;


        $this->load->model('user/common/User_featured_module_model');

        $data['most_view_products'] = array_reverse($this->User_featured_module_model->get_most_view_products());


        // +-----------------[MOST VIEW PRODUCTS ENDS]----------------------+


        // +----------------[BESTSELLER PRODUCTS START]----------------------+

        $bestseller_product_rows = (object)array();

        $data['bestseller_products'] = $this->User_featured_module_model->get_bestseller_products(16);


        $query_parameters = $previous_url = array();

        $url_type = $url_id = false;


        if (isset($_SERVER['HTTP_REFERER'])) {

            $previous_url = parse_url($_SERVER['HTTP_REFERER']);

        }


        if (isset($previous_url['query'])) {

            parse_str($previous_url['query'], $query_parameters);

        }


        if ($url_id != false) {

            if (isset($query_parameters['category_id'])) {

                $category = $this->User_catalog_model->get_category($query_parameters['category_id']);

                $this->breadcrumbs[] = array(

                    'title' => $category->name,

                    'href' => href_category($category)

                );

            }


            if (isset($query_parameters['brand_id'])) {

                $brand = $this->User_catalog_model->get_brand($query_parameters['brand_id']);

                $this->breadcrumbs[] = array(

                    'title' => $brand->name,

                    'href' => href_brand($brand)

                );

            }

        }


        if (isset($previous_url['path']) && strpos($previous_url['path'], 'special.html')) {

            $this->breadcrumbs[] = array(

                'title' => 'Products Special',

                'href' => site_url('catalog/special.html')

            );

        }


        //IF PRODUCT IS VISITED DIRECTLY FROM URL

        if (empty($previous_url)) {

            // ALL BRANDS BREADCRUMB LINK

            $this->breadcrumbs[] = array(

                'title' => 'Brands List',

                'href' => site_url('brands.html')

            );


            // PRODUCT BRAND BREADCRUMB LINK

            $brand = $this->User_catalog_model->get_brand($product->brand_id);

            if ($brand) {

                $this->breadcrumbs[] = array(

                    'title' => $brand->name,

                    'href' => href_brand($brand)

                );

            }

        }


        $this->breadcrumbs[] = array(

            'title' => $product->product_name,

            'href' => 'javascript:void(0);'

        );


        // +----------------[ADDING VIEW TO PRODUCT VIEW COUNTER START]-----------------+

        $this->User_catalog_model->add_product_view($product_id);

        // +-----------------[ADDING VIEW TO PRODUCT VIEW COUNTER ENDS]-----------------+


        // +----------------[ADDING RELATED PRODUCTS START]-----------------+

        $data['related_products'] = $this->User_catalog_model->get_related_products($product_id);

        // +----------------[ADDING RELATED PRODUCTS ENDS]-----------------+

        // pre($data);


        $this->view($this->user_view . '/' . $this->view_dir . '/product_detail', $data);

    }


    private function set_search_args()

    {

        $ignore = array('order', 'sort', 'code', 'page', 'rows', 'per_page', 'facet', 'category_id', 'layout_id',);


        $terms = array();

        $QS = $this->input->get();

        if (!empty($QS)):

            foreach ($QS as $key => $val) {

                if (in_array($key, $ignore)) {

                    continue;

                }


                $terms[$key] = $val;

            }

        endif;


        $terms['q'] = trim($this->input->get('q'));

        $terms['code'] = trim($this->input->get('code'));

        $this->user_session->set_userdata('search_items', $terms);

        $this->user_session->set_userdata('search_facet_items', $this->input->get('facet'));

    }


    function search_results_solr($args, $is_count = false, $is_count_with_facet = true)

    {

        $this->load->library('Solr_search');

        $this->solr_search->setPath('/solr/mccormackracing_products');


        if (!$this->solr_search->ping()) {

            //echo 'Solr service is not responding.'; exit;

            return;

        }


        $this->is_solr_ping = true;


        $facet = $args['facet'];

        $term = $args['term'];

        $q = $term['q'];


        $sort = $args['sort'];

        $order = $args['order'];

        $rows = $args['rows'];

        $per_page = $args['per_page'];

        $category_id = !empty($args['category_id']) ? $args['category_id'] : FALSE;

        $brand_id = !empty($args['brand_id']) ? $args['brand_id'] : FALSE;


        $group_by = !empty($args['group_by']) ? $args['group_by'] : FALSE;


        if (is_array($q)) {

            extract($q);

        }


        //var_dump($q);


        $offset = $per_page;

        $limit = $rows;

        //var_dump($offset, $limit);

        //$query = '(product_name:*' .$q. '* OR short_description:*' .$q. '* OR long_description:*' .$q. '*)';


        $cols = array('product_name', 'part_number', 'brand_name', 'distributor_name', 'category_name', 'short_description', 'long_description',);


        $query = '';

        $SQL = array();

        if (!empty($q)) {

            /*$qs = explode(' ', $q);



            foreach($qs as $qv)

            {

                foreach($cols as $col)

                {

                    $SQL[] = $col.':'.$qv.'*';

                }

            }*/


            foreach ($cols as $col) {

                $SQL[] = $col . ':"' . $q . '*"';

            }


            $query = '(' . implode(' OR ', $SQL) . ')';


            if ($category_id) {

                $query .= ' AND category_id:' . intval($category_id) . '';

            }

            if ($brand_id) {

                $query .= ' AND brand_id:' . intval($brand_id) . '';

            }

        } else {

            if ($category_id) {

                $query .= 'category_id:' . intval($category_id) . '';

            }

            if ($brand_id) {

                $query .= 'brand_id:' . intval($brand_id) . '';

            }

        }


        $query = array($query);


        $sort = strtolower($sort);

        if (!in_array($sort, array('desc', 'asc',))) {

            $sort = 'asc';

        }


        $order = strtolower($order);

        if ($order == 'name') {

            $order = 'product_name_sort';

        } elseif ($order == 'price') {

            $order = 'sale_price';

        }


        if (!in_array($order, array('product_name', 'sale_price',))) {

            $order = 'product_name_sort';

        }


        $sort_order = $order . ' ' . $sort;


        $filter_query = array();

        $facet_query = array();

        $facet_field = array();


        $group_query = array();

        $group_field = array();


        $this->load->model('user/catalog/User_filter_model');

        $facet_data = $this->User_filter_model->get_filter_items_by_id($facet);

        $category_facets = $this->User_filter_model->get_filter_categories(array('order' => 'sort_order', 'sort' => 'ASC', 'category_id' => $category_id, 'brand_id' => $brand_id));


        if (!empty($category_facets)) {

            foreach ($category_facets as $key => $val) {

                if (empty($val->column_id)) {

                    continue;

                }


                $post_fix = $val->column_scope == 'key' ? '_str' : '';

                $facet_field[] = $val->column_id . $post_fix;

            }

        }


        if (!empty($facet)) {

            foreach ($facet as $key => $val) {

                $cat_item_id = $val;

                $facet_query[] = $this->get_facet_data($cat_item_id, $facet_data);

                $filter_query[] = $this->get_facet_data($cat_item_id, $facet_data);

            }


            $facet_field = array_unique($facet_field);

        }


        $QF = 'product_id^10 product_name^9 part_number^8 distributor_name^7 category_name^6 brand_name^5 short_description^4 long_description^3';

        $addit_param = array('qf' => $QF, 'facet' => 'true', 'facet.mincount' => 1, 'facet.limit' => 2000, 'facet.sort' => 'count', 'facet.field' => $facet_field, 'facet.query' => $facet_query, 'fq' => $filter_query, 'sort' => $sort_order,);

        //var_dump($query, $addit_param);


        if ($is_count == true) {

            $addit_param = array('facet' => 'true', 'facet.mincount' => 1, 'facet.limit' => 2000, 'facet.sort' => 'count', 'facet.field' => $facet_field, 'facet.query' => $facet_query, 'fq' => $filter_query, 'sort' => $sort_order, 'fl' => array());

            $response = $this->solr_search->search($query, $offset, $limit, $addit_param);

            return $response->response->numFound;

        }


        if ($group_by !== false) {

            //&group=true&group.field=manu_exact

            $addit_param = array('group' => 'true', 'group.limit' => 1, 'group.field' => $group_by,);

            $addit_param = array('facet' => 'true', 'facet.mincount' => 1, 'facet.limit' => 2000, 'facet.field' => array('distributor_id', 'category_id', 'brand_id'), 'facet.query' => array(), 'fq' => $filter_query, 'sort' => $sort_order, 'fl' => array('distributor_id', 'category_id', 'brand_id'));

            //$addit_param = array('group'=>'true', 'group.field'=>$group_by, );

            $response = $this->solr_search->search($query, $offset, 1, $addit_param);

            $facets = (array)$response->facet_counts->facet_fields;

        } else {

            $response = $this->solr_search->search($query, $offset, $limit, $addit_param);

            $facets = (array)$response->facet_counts->facet_fields;

        }


        $raw_resp = json_decode($response->getRawResponse());

        $docs = $raw_resp->response->docs;

        $facets = $raw_resp->facet_counts->facet_fields;


        //var_dump( $facets, '-RAW-', $raw_resp ); exit;

        //var_dump( $facets );

        //echo rawurldecode($response->response->query);

        //var_dump($facets, $response->response->query); exit;


        // http://89.47.164.12:8718/solr/mccormackracing_products/select?qf=product_id^10+product_name^9+part_number^8+distributor_name^7+category_name^6+brand_name^5+short_description^4+long_description^3&facet=true&facet.mincount=1&facet.limit=2000&facet.sort=count&facet.field=brand_name_str&facet.field=style_str&facet.field=bolt_pattern_str&facet.field=back_space_str&facet.field=diameter_str&facet.field=offset_str&facet.field=finish_str&facet.field=width_str&facet.query=tags:99c2d2edb99729b3b3c9dc8ab77fb330&fq=tags:99c2d2edb99729b3b3c9dc8ab77fb330&sort=product_name+asc&wt=json&json.nl=map&q=category_id:1&start=0&rows=12		


        // http://89.47.164.12:8718/solr/mccormackracing_products/select?qf=product_id^10+product_name^9+part_number^8+distributor_name^7+category_name^6+brand_name^5+short_description^4+long_description^3&facet=true&facet.mincount=1&facet.limit=2000&facet.sort=count&facet.field=style_str&facet.field=category_name_str&facet.field=back_space_str&facet.field=bolt_pattern_str&facet.field=diameter_str&facet.field=offset_str&facet.field=finish_str&facet.field=width_str&sort=product_name_sort+asc&wt=json&json.nl=map&q=brand_id:26&start=0&rows=12


        $brands = $this->get_brands();


        if (!empty($docs)) {

            foreach ($docs as $key => &$val) {

                $val->brand = $this->get_brand_info($val->brand_id, $brands);

                $val->has_tax = false;

            }

        }


        $facet_category_id = $facet_brand_id = 0;


        if (!empty($facets)) {

            foreach ($facets as $key => &$val) {

                $obj = new stdClass();

                foreach ($val as $key2 => $val2) {

                    if (!empty($facet) and $category_id > 0 and $key == 'brand_name_str') {

                        $dt = $this->get_brand_by_name($key2);

                        if ($dt and in_array($dt->filter_category_item_id, $facet)) {

                            $facet_brand_id = $dt->brand_id;

                        }

                    }


                    if (!empty($facet) and $brand_id > 0 and $key == 'category_name_str') {

                        $dt = $this->get_category_by_name($key2);

                        if ($dt and in_array($dt->filter_category_item_id, $facet)) {

                            $facet_category_id = $dt->category_id;

                        }

                    }


                    $obj->{strtolower($key2)} = $val2;

                }

                $val = $obj;

            }

        }


        //var_dump( '-RAW-', $facets ); exit;

        $return = array('total_found' => $response->response->numFound, 'docs' => $docs, 'facets' => $facets, 'facet_category_id' => $facet_category_id, 'facet_brand_id' => $facet_brand_id);

        //var_dump($return); exit;

        return $return;

    }


    private function get_facet_data($cat_item_id, $facet_data, $scope = '')

    {

        $return = '';

        foreach ($facet_data as $key => $val) {

            if ($cat_item_id == $val->filter_category_item_id) {

                //$post_fix = ($scope == 'filter' and $val->column_scope == 'key') ? '_str' : '';

                //$return = $val->column_id.$post_fix .':'. $val->unique_id;


                $return = 'tags:' . $val->unique_id;

                break;

            }

        }


        return $return;

    }


    private function get_brands()

    {

        $result = $this->User_catalog_model->get_brands(array('is_enabled' => 1,));


        $return = array();

        foreach ($result as $key => $val) {

            $return[$val->brand_id] = $val;

        }


        return $return;

    }


    private function get_brand_info($brand_id, $brands)

    {

        if (!empty($brands[$brand_id])) {

            return $brands[$brand_id];

        }


        return FALSE;

    }


    private function get_category_by_name($brand_name)

    {

        return $this->User_catalog_model->get_product_by_category_name($brand_name);

    }


    private function get_brand_by_name($brand_name)

    {

        return $this->User_catalog_model->get_product_by_brand_name($brand_name);


    }


    private function by_brand()

    {

        $data['meta_title'] = '';

        $data['meta_keywords'] = '';

        $data['meta_description'] = '';


        $data['page_title'] = 'Catalog';

        $data['page_header'] = 'Catalog';


        $params = array();

        $order = $this->input->get('order') ? $this->input->get('order') : '';

        $sort = $this->input->get('sort') ? $this->input->get('sort') : 'asc';

        $code = $this->input->get('code') ? $this->input->get('code') : '';

        $page = $this->input->get('page') ? $this->input->get('page') : 0;

        $rows = $this->input->get('rows') ? $this->input->get('rows') : '12';

        $per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 0;


        $brand_id = $this->input->get('brand_id') ? $this->input->get('brand_id') : 1;

        $layout_id = $this->input->get('layout_id') ? $this->input->get('layout_id') : 2;


        $data['sort_menu'] = get_sort_menu();

        $data['sort_id'] = $order . '.' . $sort;


        $result = new stdClass();


        $data['max_price'] = $this->User_catalog_model->get_product_max_price(array('brand_id' => $brand_id));

        $data['min_price'] = $this->User_catalog_model->get_product_min_price(array('brand_id' => $brand_id));


        $this->current_active_nav = 'brand-' . $brand_id;

        $data['layout_id'] = $layout_id;

        $data['brand_id'] = $brand_id;

        //$data['filter_categories'] 	= $this->get_category_filters($brand_id);


        $result->brand = $this->User_catalog_model->get_brand($brand_id);

        $result->brands = array();

        $result->categories = array();

        $result->brand_menu = $this->User_catalog_model->get_brand_menu();

        $result->filters = $this->get_brand_filters($brand_id);


        // SEO TAGS

        $data['meta_title'] = $result->brand->meta_title;

        $data['meta_keywords'] = $result->brand->meta_keywords;

        $data['meta_description'] = $result->brand->meta_description;


        $data['page_title'] = $result->brand->name;

        $data['page_header'] = $result->brand->name;


        $this->breadcrumbs[] = array(

            'title' => 'Brands list',

            'href' => site_url('brands.html')

        );


        $this->breadcrumbs[] = array(

            'title' => $result->brand->name,

            'href' => 'javascript:void(0);'

        );


        $term = false;

        $data['code'] = $code;

        $post = $this->input->post(null, false);


        if ($post) {

            $term = json_encode($post);

            $code = $this->Search_model->record_term($term);

            $data['code'] = $code;


            redirect(site_url($this->user_url . '/' . 'catalog.html?layout_id=2&brand_id=' . $brand_id . '&code=' . $code));

        } elseif ($code) {

            $term = $this->Search_model->get_term($code);

        }


        //$data['term']		= $term;

        $data['order_by'] = $order;

        $data['sort_by'] = $sort;


        $this->set_search_args();


        $term = $this->user_session->userdata('search_items');

        $facet = $this->user_session->userdata('search_facet_items');


        $fq = array();

        if (is_array($facet)):

            foreach ($facet as $key => $val) {

                $fq[] = 'facet[]=' . $val;

            }

        endif;


        $sorting = array('sort' => $sort, 'order' => $order);


        //var_dump($facet);

        //var_dump($term, $facet, $fq, $sorting);

        //echo '<br>';


        $search_url = site_url('catalog.html?layout_id=' . $layout_id . '&brand_id=' . $brand_id . '&' . http_build_query($term));

        $base_url = site_url($this->user_url . '/' . 'catalog.html?layout_id=' . $layout_id . '&brand_id=' . $brand_id . '&' . http_build_query($term) . '&' . http_build_query($sorting)) . '&' . implode('&', $fq);


        $no_sort_url = site_url($this->user_url . '/' . 'catalog.html?layout_id=' . $layout_id . '&brand_id=' . $brand_id . '&' . http_build_query($term)) . '&' . implode('&', $fq);


        if ($this->config->item('rewrite_brand_route')) {

            $search_url = href_brand($result->brand) . '?' . http_build_query($term);

            $base_url = href_brand($result->brand) . '?' . http_build_query($term) . '&' . http_build_query($sorting) . '&' . implode('&', $fq);

            $no_sort_url = href_brand($result->brand) . '?' . http_build_query($term) . '&' . implode('&', $fq);

        }


        $data['term'] = $term;

        $data['facet'] = $facet;

        $data['search_url'] = $search_url;

        $data['no_sort_url'] = $no_sort_url;


        $param = array('brand_id' => $brand_id, 'term' => $term, 'facet' => $facet, 'code' => $code, 'order' => $order, 'sort' => $sort, 'price' => $this->input->get('price'), 'rows' => $rows, 'per_page' => $per_page,);


        $res = $this->search_results_solr($param);
        var_dump($res);
        die('1801');

        $total = $this->search_results_solr($param, true);

        //	$facet_total_found 	= $this->search_results_solr($param, true, false); 


        $result->products = $res['docs'];

        $result->facets = $res['facets'];

        $result->total_found = $res['total_found'];

        $data['result'] = $result;

        $data['total'] = $total;


        $config['base_url'] = $base_url;


        $config['total_rows'] = $total;

        $config['per_page'] = $rows;

        $config['offset'] = $per_page;

        $config['uri_segment'] = $this->uri->total_segments();

        $config['use_page_numbers'] = TRUE;

        $config['page_query_string'] = TRUE;

        $config['reuse_query_string'] = TRUE;


        $this->load->library('pagination');


        $this->pagination->initialize($config);


        $data['brand_info'] = $this->User_brand_model->get_by_id($brand_id);


        if (isset($facet[0]) && !empty($facet[0]))

            $data['bestseller_products'] = $this->User_brand_model->get_bestseller_products($brand_id, 5, $facet[0]);

        else

            $data['bestseller_products'] = $this->User_brand_model->get_bestseller_products($brand_id, 5, '');


        $this->view($this->user_view . '/' . $this->view_dir . '/catalog_by_brand_list', $data);

    }


    private function by_search()

    {

        $data['meta_title'] = '';

        $data['meta_keywords'] = '';

        $data['meta_description'] = '';


        $data['page_title'] = 'Catalog';

        $data['page_header'] = 'Catalog';


        $params = array();

        $order = $this->input->get('order') ? $this->input->get('order') : '';

        $sort = $this->input->get('sort') ? $this->input->get('sort') : 'asc';

        $code = $this->input->get('code') ? $this->input->get('code') : '';

        $page = $this->input->get('page') ? $this->input->get('page') : 0;

        $rows = $this->input->get('rows') ? $this->input->get('rows') : '12';

        $per_page = $this->input->get('per_page') ? $this->input->get('per_page') : 0;

        $q = $this->input->get('q') ? $this->input->get('q') : '';


        $category_id = $this->input->get('category_id') ? $this->input->get('category_id') : 0;

        $brand_id = $this->input->get('brand_id') ? $this->input->get('brand_id') : 0;

        $layout_id = $this->input->get('layout_id') ? $this->input->get('layout_id') : 0;


        $data['q'] = $q;


        $data['max_price'] = $this->User_catalog_model->get_product_max_price(array('category_id' => $category_id));

        $data['min_price'] = $this->User_catalog_model->get_product_min_price(array('category_id' => $category_id));


        $result = new stdClass();


        $this->current_active_nav = 'category-' . $category_id;

        $data['layout_id'] = $layout_id;

        $data['category_id'] = $category_id;


        $result->category = $this->User_catalog_model->get_category($category_id);

        $result->brand = $this->User_catalog_model->get_brand($brand_id);

        $result->brands = array();

        $result->categories = array();

        $result->category_menu = $this->User_catalog_model->get_category_menu(0);

        //$result->filters 			= $this->get_category_filters($category_id);


        // SEO TAGS

        $data['meta_title'] = 'search for ' . $q;

        $data['meta_keywords'] = 'search for ' . $q;

        $data['meta_description'] = 'search for ' . $q;


        $data['page_title'] = 'search for ' . $q;

        $data['page_header'] = 'search for ' . $q;


        //var_dump($data);die;

        $term = false;

        $data['code'] = $code;

        $post = $this->input->post(null, false);


        if ($post) {

            $q = !empty($post['q']) ? $post['q'] : '';

            $term = json_encode($post);

            $code = $this->Search_model->record_term($term);

            $data['code'] = $code;


            redirect(site_url($this->user_url . '/' . 'catalog.html?q=' . $q . '&code=' . $code));

        } elseif ($code) {

            $term = $this->Search_model->get_term($code);

        }


        //$data['term']		= $term;

        $data['order_by'] = $order;

        $data['sort_by'] = $sort;


        $this->set_search_args();


        $term = $this->user_session->userdata('search_items');

        $facet = $this->user_session->userdata('search_facet_items');


        $fq = array();

        if (is_array($facet)):

            foreach ($facet as $key => $val) {

                $fq[] = 'facet[]=' . $val;

            }

        endif;


        $sorting = array('sort' => $sort, 'order' => $order);


        //var_dump($facet);

        //var_dump($term, $facet, $fq, $sorting);

        //echo '<br>';


        $search_url = site_url('catalog.html?' . http_build_query($term));

        $base_url = site_url($this->user_url . '/' . 'catalog.html?' . http_build_query($term) . '&' . http_build_query($sorting)) . '&' . implode('&', $fq);


        $data['term'] = $term;

        $data['facet'] = $facet;

        $data['search_url'] = $search_url;


        $param = array('term' => $term, 'facet' => $facet, 'code' => $code, 'order' => $order, 'price' => $this->input->get('price'), 'sort' => $sort, 'rows' => $rows, 'per_page' => $per_page,);


        $result->filters = $this->get_filters_by_search($param);


        $res = $this->search_results_solr($param);
        var_dump($res);
        die('2107');

        $total = $this->search_results_solr($param, true);


        // $facet_total_found 	= $this->search_results_solr($param, true, false);


        $result->products = $res['docs'];

        $result->facets = $res['facets'];

        $result->total_found = $res['total_found'];

        $data['result'] = $result;

        $data['total'] = $total;


        $config['base_url'] = $base_url;


        $config['total_rows'] = $total;

        $config['per_page'] = $rows;

        $config['offset'] = $per_page;

        $config['uri_segment'] = $this->uri->total_segments();

        $config['use_page_numbers'] = TRUE;

        $config['page_query_string'] = TRUE;

        $config['reuse_query_string'] = TRUE;


        $this->load->library('pagination');


        $this->pagination->initialize($config);


        $this->view($this->user_view . '/' . $this->view_dir . '/catalog_by_search', $data);

    }


    private function get_filters_by_search($param)

    {

        $param['group_by'] = TRUE;

        //var_dump($param);die;

        $data = $this->search_results_solr($param);

        //var_dump($data['facets']);die;


        $result = array('brand' => array(), 'category' => array(), 'distributor' => array(),);

        if (!empty($data['facets'])) {

            foreach ($data['facets'] as $key => $val) {

                $val = (array)$val;

                $val = array_map('intval', $val);

                $val = array_keys($val);

                //var_dump($val);die;

                $val = array_unique($val);

                $result[str_replace('_id', '', $key)] = $val;

            }

        }


        $result['brand'] = array_unique($result['brand']);

        $result['category'] = array_unique($result['category']);

        $result['distributor'] = array_unique($result['distributor']);


        //var_dump($result);die;

        //var_dump($result['category']);

        //var_dump($result['brand']);


        $filter1 = $this->get_category_filters($result['category']);

        return $filter1;

        $filter2 = $this->get_brand_filters($result['brand']);


        $filters = array_merge((array)$filter1, (array)$filter2);

        die;

        //var_dump($filters);die;

        return $filters;

    }


    function open_lightbox_ajax()

    {

        is_ajax();


        $product_id = $this->input->get('product_id');


        $product = $this->User_catalog_model->get_product_images($product_id);

        if (!$product) {

            ajax_response(array('message' => 'product not found'));

        }


        $data['result'] = $product;


        $html = $this->view($this->user_view . '/' . $this->view_dir . '/open_lightbox_ajax', $data, true);


        ajax_response(array('error' => false, 'html' => $html));

    }


    public function get_brand()

    {

        $brand_url = urldecode($this->input->get('n'));

        $temp = explode('-', $brand_url);

        $brand_id = end($temp);

        $brand = $this->User_brand_model->get_brand_by_id($brand_id);

        $brand->images = json_decode($brand->images);


        $data['meta_title'] = $brand->name;

        $data['meta_keywords'] = $brand->name;

        $data['meta_description'] = $brand->name;


        $data['page_title'] = $brand->name;

        $data['page_header'] = $brand->name;


        $previous_url = array();

        if (isset($_SERVER['HTTP_REFERER'])) {

            $previous_url = parse_url($_SERVER['HTTP_REFERER']);

        }

        $query_parameters = array();

        if (isset($previous_url['query'])) {

            parse_str($previous_url['query'], $query_parameters);

        }


        if (isset($previous_url['path']) && strpos($previous_url['path'], 'brands.html')) {

            $this->breadcrumbs[] = array(

                'title' => 'Brands list',

                'href' => site_url('brands.html')

            );

        }


        $result = (object)array(

            'brand' => $brand,

            'products' => $this->User_catalog_model->get_products_by_brand($brand_id)

        );


        $data['result'] = $result;


        $this->view($this->user_view . '/' . $this->view_dir . '/catalog_by_brand', $data);

    }


    public function get_special_products()

    {

        $this->current_active_nav = 'special';


        $data['meta_title'] = 'Deals';

        $data['meta_keywords'] = 'Deals';

        $data['meta_description'] = 'Deals';


        $data['page_title'] = 'Deals';

        $data['page_header'] = 'Deals';


        $this->breadcrumbs[] = array(

            'title' => $data['page_title'],

            'href' => 'javascript:void(0);'

        );


        $order = $this->input->get('order') ? $this->input->get('order') : '';

        $sort = $this->input->get('sort') ? $this->input->get('sort') : 'asc';

        $code = $this->input->get('code') ? $this->input->get('code') : '';

        $page = $this->input->get('page') ? $this->input->get('page') : 0;

        $rows = $this->input->get('rows') ? $this->input->get('rows') : '12';

        $per_page = $this->input->get('per_page') ? $this->input->get('per_page') : '';

        $term = false;

        $params = array();


        //$this->load->model('user/module/User_featured_module_model');

        $result = $this->User_catalog_model->get_special_products(array('special_product' => '1', 'params' => $params, 'term' => $term, 'order' => $order, 'sort' => $sort, 'rows' => $rows, 'per_page' => $per_page));

        $total = $this->User_catalog_model->get_special_products(array('special_product' => '1', 'params' => $params, 'term' => $term, 'order' => $order, 'sort' => $sort), true);


        /*echo "<pre>";

        print_r($result);

        echo "</pre>";

        exit();*/

        $data['result'] = $result;

        $data['total'] = $total;

        $data['products'] = $result;


        $config['base_url'] = site_url($this->user_url . '/' . 'catalog/special.html?order=' . $order . '&sort=' . $sort . '&code=' . $code);


        $config['total_rows'] = $total;

        $config['per_page'] = $rows;

        $config['offset'] = $per_page;

        $config['uri_segment'] = $this->uri->total_segments();

        $config['use_page_numbers'] = TRUE;

        $config['page_query_string'] = TRUE;

        $config['reuse_query_string'] = TRUE;


        $this->load->library('pagination');


        $this->pagination->initialize($config);

        //$products = $this->User_catalog_model->get_special_products(16);


        $this->view($this->user_view . '/' . $this->view_dir . '/special-products', $data);

    }


    private function get_category_filters($category_id)

    {

        $this->load->model('user/catalog/User_filter_model');

        $results = $this->User_filter_model->get_filter_categories(array('order' => 'sort_order', 'sort' => 'ASC', 'category_id' => $category_id));


        $filter_categories = array();

        if (!empty($results)) {

            foreach ($results as $key => $result) {

                $filter_items = $this->User_filter_model->get_filter_category_items($result->filter_category_id, array('category_id' => $category_id));

                //$filter_items_count = $this->User_filter_model->get_filter_category_items_count($result->filter_category_id, $category_id);

                /*

                foreach ($filter_items as $item){

                    $item->count = $this->User_filter_model->get_filter_category_item_count($item->filter_category_item_id, $category_id);

                }

                */


                $filter_categories[] = (object)array(

                    'filter_category_name' => $result->name,

                    'column_scope' => $result->column_scope,

                    'column_id' => $result->column_id,

                    'filter_items' => $filter_items

                );

            }

        }


        return $filter_categories;

    }


    private function get_brand_filters($brand_id)

    {

        $this->load->model('user/catalog/User_filter_model');

        //$results = $this->User_filter_model->get_filter_brands(array('order'=>'sort_order', 'sort'=>'ASC', 'brand_id'=>$brand_id));

        $results = $this->User_filter_model->get_filter_categories(array('order' => 'sort_order', 'sort' => 'ASC', 'brand_id' => $brand_id));


        $filter_categories = array();

        if (!empty($results)) {

            foreach ($results as $key => $result) {

                $filter_items = $this->User_filter_model->get_filter_category_items($result->filter_category_id, array('brand_id' => $brand_id));


                /*$items = new stdClass();



                foreach ($filter_items as $key => $item){

                    $count = $this->User_filter_model->get_filter_category_item_count($item->filter_category_item_id, array('brand_id' => $brand_id));

                    if($count) {

                        $item->count = $count;

                        $items->{$key} = $item;

                    }

                }*/


                $filter_categories[] = (object)array(

                    'filter_category_name' => $result->name,

                    'column_scope' => $result->column_scope,

                    'column_id' => $result->column_id,

                    'filter_items' => $filter_items

                );

            }

        }


        return $filter_categories;

    }


    private function get_filter_products($filter_ids, $per_page, $rows)
    {


        $this->load->model('user/catalog/User_filter_model');


        $filter_data = array(

            'filter_ids' => $filter_ids,

            'offset' => $per_page,

            'limit' => $rows

        );


        $product_ids = $this->User_filter_model->get_filter_products($filter_data);

        $return_data = array();

        foreach ($product_ids as $id) {

            $return_data[] = $id->product_id;

        }


        /*echo "<pre>";

        print_r($this->db->last_query());

        echo "</pre>";

        exit();*/


        return $return_data;

    }


    private function get_total_filter_products($filter_ids)

    {

        $filter_data = array(

            'filter_ids' => $filter_ids

        );

        $this->load->model('user/catalog/User_filter_model');

        return $this->User_filter_model->get_filter_products($filter_data, true);

    }


    public function brands_list()

    {

        $data['meta_title'] = 'Brands List';

        $data['meta_keywords'] = 'Brands List';

        $data['meta_description'] = 'Brands List';


        $this->current_active_nav = 'brand';


        $data['page_title'] = 'Brands List';

        $data['page_header'] = 'Brands List';


        $this->breadcrumbs[] = array(

            'title' => $data['page_title'],

            'href' => 'javascript:void(0);'

        );


        //$data['brands'] = $this->User_brand_model->get_brands(array('is_enabled' => 1));

        $data['categories'] = $this->User_brand_model->get_brand_for_menu(array('is_enabled' => 1));


        $this->view($this->user_view . '/' . $this->view_dir . '/brands_list_by_category', $data);

    }


}

