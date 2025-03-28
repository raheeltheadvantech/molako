<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('site_config_item'))
{
    function site_config_item($item)
    {
        static $_config;
        $CI =& get_instance();

        if (empty($_config))
        {
            // references cannot be directly assigned to static variables, so we use an array
            $_config[0] = $CI->site_config->get_config();
        }

        return isset($_config[0][$item]) ? $_config[0][$item] : NULL;
    }
}
if ( ! function_exists('color_name_to_hex'))
{
    function color_name_to_hex($color_name)
    {
        $CI =& get_instance();
        $all    = $CI->db->get('ci_colors')->result();
        $a = array();
        foreach ($all as $key => $value) {
            $a[strtolower($value->name)] = $value->code;
        }
        $data['all_colors'] = $a;
        // standard 147 HTML color names
        $colors  =  $a;

        $color_name = strtolower($color_name);
        if (isset($colors[$color_name]))
        {
            return $colors[$color_name];
        }
        else
        {
            return ($color_name);
        }
    }
}
if ( ! function_exists('is_ajax'))
{
    function is_ajax($has_header_footer = false)
    {
        $CI =& get_instance();
        if(!$CI->input->is_ajax_request())
        {
            echo json_encode(array('error'=>true, 'message'=>'Direct access is not allowed.'));
            exit;
        }

        $template_id = 'popup-content-only';

        if($has_header_footer)
        {
            $template_id = 'popup';
        }

        $CI->set_template($template_id);

        return TRUE;
    }
}

if ( ! function_exists('ajax_response'))
{
    function ajax_response($response)
    {
        $default = array('error'=>true, 'message'=>'', 'redirect'=>false, 'data'=>false, 'html'=>false, );

        if( ENVIRONMENT === 'development')
        {
            $CI =& get_instance();
            $post_vars = $CI->input->post();
            $get_vars = $CI->input->get();
            $default = array_merge(array('post_vars'=>$post_vars, 'get_vars'=>$get_vars), $default);
        }

        if(!empty($response) and is_array($response))
        {
            $result = array_merge(array(), $default, $response);
        }

        // header('Content-Type: application/json');
        echo json_encode($result);
        exit;

        return FALSE;
    }
}



if ( ! function_exists('get_sort_menu'))
{
    function get_sort_menu()
    {
        $options = array(
            array('name'=>'Name, Z to A', 'order'=>'product_name', 'sort'=>'desc', ),
            array('name'=>'Name, A to Z', 'order'=>'product_name', 'sort'=>'asc', ),
            // array('name'=>'Price, low to high', 'order'=>'sale_price', 'sort'=>'asc', ),
            // array('name'=>'Price, high to low', 'order'=>'sale_price', 'sort'=>'desc', ),
        );

        $return	= array();
        foreach($options as $key=>$val)
        {
            $val = (object)$val;

            $obj 			= new stdClass();
            $obj->id 		= $val->order .'.'. $val->sort;
            $obj->name 		= $val->name;
            $obj->order 	= $val->order;
            $obj->sort 		= $val->sort;
            $return[$obj->id] = $obj;
        }

        return $return;
    }





}


if ( ! function_exists('category_tree')) {

    function category_tree($parent_id = 0)
    {
        $CI =& get_instance();

        $CI->db->select('*');
        $CI->db->from('categories');
        $CI->db->where('is_enabled', 1);
        $CI->db->where('parent_id', $parent_id);
        $CI->db->order_by('sort','ASC');
        $result = $CI->db->get()->result_array();
        // var_dump($CI->db->last_query());
        if (!$result) {
            return false;
        }

        return $result;
    }
}

if ( ! function_exists('all_category_tree')) {

    function all_category_tree($parent_id = 0 , $sub_mark = '')
    {
        $CI =& get_instance();

        $CI->db->select('*');
        $CI->db->from('categories');
        $CI->db->where('parent_id', $parent_id);
        $CI->db->order_by('sort','ASC');
        $result = $CI->db->get()->result_array();
        if (!$result) {
            return false;
        }

        $tree = '';
        foreach ($result as $row) {
            $tree .= '<option value="'.$row['category_id'].'">'.$sub_mark.$row['name'].'</option>';
            $tree.= all_category_tree($row['category_id'], $sub_mark.'_' );

        }

        return $tree;
    }

}


if ( ! function_exists('all_categories')) {

    function all_categories($parent_id = 0 , $sub_mark = '')
    {
        $CI =& get_instance();

        $CI->db->select('*');
        $CI->db->from('categories');
        $CI->db->where('parent_id', $parent_id);
        $CI->db->order_by('sort','ASC');
        $result = $CI->db->get()->result_array();
        if (!$result) {
            return false;
        }

        $tree = '';
        foreach ($result as $row) {
            $tree .= '<option value="'.$row['category_id'].'">'.$sub_mark.$row['name'].'</option>';
            // '<a href="href_category('".$row['category_id']."')">'.$tree[$i]['name'];
            //if($has_tree_one){<i class="fa fa-caret-right"></i><?php }</a>';
            // $tree.= all_category_tree($row['category_id'], $sub_mark.'_' );

        }

        return $tree;
    }

}





if ( ! function_exists('getparent')) {

    function getparent($id)
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('categories');
        $CI->db->where('category_id', $id);
        $CI->db->order_by('sort','ASC');
        $result = $CI->db->get()->result_array();
        if (!$result) {
            return false;
        }

        foreach ($result as $row) {
            if ($row['parent_id'] != 0) {
                $name = getparent($row['parent_id']) . '>>' . $row['name'];
            } else {
                $name = $row['name'];
            }
        }

        return $name;


    }

}


if ( ! function_exists('getbreadcrumb')) {

    function getbreadcrumb($id)
    {
        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from('categories');
        $CI->db->where('category_id', $id);
        $result = $CI->db->get()->result_array();
        if (!$result) {
            return false;
        }

        foreach ($result as $row) {
            if ($row['parent_id'] != 0) {
                $name = getbreadcrumb($row['parent_id']).'<a href="'.href_category($row).'">'.$row['name'].'</a><i class="icon icon-arrow-right"></i>';
            } else {
                $name = '<a href="'.href_category($row).'">'.$row['name'].'</a><i class="icon icon-arrow-right"></i>';
            }
        }

        return $name;
    }

}



if ( !function_exists('get_product_images')) {
    function get_product_images($product_id)
    {
        $imgarray = array();

        $CI =& get_instance();
        $CI->db->select('image');
        $CI->db->from($CI->db->dbprefix . 'product_images');
        $CI->db->where('product_id', $product_id);

        $result = $CI->db->get()->result();
        foreach ($result as $value)
            $imgarray[] = $value->image;
        $CI->db->select('image');
        $CI->db->from($CI->db->dbprefix . 'product_option_value');
        $CI->db->where('product_id', $product_id);

        $result = $CI->db->get()->result();
        foreach ($result as $value)
        {
            if($value->image)
                $imgarray[] = $value->image;
        }


        return $imgarray;
    }
}


if ( ! function_exists('get_product_special_price')) {
    function get_product_special_price($product_id)
    {
        $CI =& get_instance();

        $currentDate = date("Y-m-d");
        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'product_special_price');
        $CI->db->where('product_id', $product_id);
        $CI->db->where("'$currentDate' BETWEEN start_date AND end_date");

        $result = $CI->db->get()->result();
        if (!$result) {
            return FALSE;
        }
        // echo $CI->db->last_query();
        // die();
        return $result[0]->price;
    }
}

if ( ! function_exists('get_brand')) {
    function get_brand($brand_id)
    {
        $CI =& get_instance();

        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'brands');
        $CI->db->where(1,1, FALSE);
        $CI->db->where('is_enabled', 1);
        $CI->db->where('brand_id', $brand_id);

        $result = $CI->db->get()->result();
        if (!$result) {
            return FALSE;
        }
        return $result;
    }
}

if ( ! function_exists('get_product_specification')) {
    function get_product_specification($product_id)
    {
        $CI =& get_instance();

        $CI->db->select('filter_key , filter_value');
        $CI->db->from($CI->db->dbprefix . 'product_option_filter');
        $CI->db->where('product_id', $product_id);
        $CI->db->where('is_specification', 1);

        $result = $CI->db->get()->result();
        if (!$result) {
            return FALSE;
        }

        return $result;
    }
}


if ( !function_exists('get_product_varient_price')) {
    function get_product_varient_price($product_id)
    {

        $CI =& get_instance();
        $CI->db->select('price,quantity,product_option_value_id');
        $CI->db->from($CI->db->dbprefix . 'product_option_value');
        $CI->db->where('product_id', $product_id);
        $CI->db->where('price >', 0);
        $CI->db->where('quantity >', 0);
        $CI->db->order_by('price','ASC');
        $result = $CI->db->get()->result();
        if (!$result) {
            return FALSE;
        }

        return $result[0];
    }

}


if ( !function_exists('get_current_qty')) {
    function get_current_qty($product_id,$sku=NULL)
    {
        $CI =& get_instance();
        $CI->db->select('quantity');
        if ($sku)
        {
            $CI->db->from($CI->db->dbprefix . 'product_option_value');
            $CI->db->where('sku', $sku);//extra
        }else{
            $CI->db->from($CI->db->dbprefix . 'products');
        }

        // $CI->db->from($CI->db->dbprefix . 'products');
        $CI->db->where('product_id', $product_id);


        $result = $CI->db->get()->result();
        if (!$result) {
            return FALSE;
        }

        return $result[0]->quantity;
    }

}

function get_bestseller_products($limit = 5){
    $CI =& get_instance();


    $CI->db->select('op.product_id, SUM(op.quantity) AS total, p.product_id , p.product_name,  p.product_slug , p.sale_price , p.short_description , p.sku, p.quantity');
    $CI->db->from('order_products op');
    $CI->db->join('order o', 'o.order_id = op.order_id','left');
    $CI->db->join('products p', 'p.product_id = op.product_id','left');
    $CI->db->where('o.order_status_id >', 0);
    $CI->db->where('p.is_enabled', 1);
    $display_out_stock = site_config_item('config_catalog_outstock');
    if ($display_out_stock == 0)
    {
        $CI->db->where('p.quantity >', 0);
    }
    $CI->db->group_by('op.product_id');
    $CI->db->order_by('total','DESC');
    $CI->db->limit($limit);
    $result = $CI->db->get()->result();

    // echo $CI->db->last_query();

    if(!$result)
    {
        return FALSE;
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




if ( !function_exists('dd')) {
    function dd($data)
    {
        echo "<pre>";
        var_dump($data);
        die();

    }
}
if ( !function_exists('create_navigation_html')) {
    function create_navigation_html($bestseller_products)
    {
        // $bestseller_products = get_bestseller_products(6);

        $CI =& get_instance();
        $CI->load->model('user/common/User_featured_module_model');
        $bestseller_products = $CI->User_featured_module_model->get_bestseller_products(6);
        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'navigations');
        $CI->db->where('is_enabled', 1);
        $CI->db->order_by('sort_order','ASC');

        $result = $CI->db->get()->result();
        // dd($result);
        if (!$result) {
            return FALSE;
        }

        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'brands');
        $CI->db->where('is_enabled', 1);
        $CI->db->order_by('date_added', 'ASC');
        $CI->db->limit(8);

        $brands = $CI->db->get()->result();

        $nav = array();
        foreach ($result as $value) {

            $exit = get_parent($value->parent_id);
            if($value->parent_id != 0)
            {
                $nav[$value->name] = $value->slug;
            }
            // else
            // {
            //     $nav[$value->name][$value->slug] = $value->slug;
            // }

        }

        // echo'<pre>';print_r($nav);die;
        $num = 0;
        $html = '';
        foreach ($result as  $key=>$value) {
            $exit = get_parent($value->parent_id);
            if($value->slug == 'pages') {
                $html .= '<li >';
                $html .= '<a href = "#" >pages</a >';
                $html .= '<ul class="sub-menu sub-menu-pages" >';
                foreach ($nav as  $val) {
                    $val2 = str_replace('-' , ' ' , $val);
                    $html .= '<li ><a href = "pages/'.$val->slug.'.html'.'" > '.ucfirst($val2).'</a ></li >';
                }
                $html .= '</ul>';
                $html .= '</li >';
            }elseif($value->slug == 'manufacturer') {
                $imgClass = '';
                $html .= '<li >';
                $html .= '<a href = "#" >'.$value->name.'</a >';
                $html .= '<ul class="sub-menu sub-menu-pages" style="width: 400px; border: 2px solid #2E6ED5;border-top: none">';
                foreach ($brands as  $b) {
                    $bslug = str_replace('-' , ' ' , $b->name);
                    $html .= '<li class="mbl" style="width: 25%; display:inline-flex;"><a href ="'.base_url('catalog/brand/'.$b->name.'.html').'"><span style="font-size: smaller">'.$b->name.'</span> <img src="'.site_url('images/brands/thumbnails/'.$b->images).'" width="auto" style="height: auto"/></a ></li >';
                }
                $html .= '</ul>';
                $html .= '</li >';

            }elseif($value->module == 'category') {
                // var_dump($value);
                $subcategories = category_tree($value->cat_id);
                // var_dump();
                $hasSubcategories = !empty($subcategories);
                $html .= '<li class="menu-item">';
                $html .= '<a href="' . base_url('catalog.html') . '?category_id='.$value->cat_id.'" style="gap:0px !important;" class="item-link">' . html_entity_decode(htmlspecialchars($value->name)) . '<i class="icon icon-arrow-down"></i></a>';
                $html .= '<div class="sub-menu mega-menu">';
                $html .= '<div class="container">';
                $html .= '<div class="row">';
                if ($hasSubcategories || !empty($bestseller_products)) {
                    $html .= '<div class="col-lg-8">';
                    $html .= '<div class="row d-flex flex-wrap">'; // Display subcategories in columns
                    if($subcategories && is_array($subcategories))
                    {
                        for ($j = 0; $j < count($subcategories); $j++) {
                            $html .= '<div class="col-lg-2">'; // Use col-lg-2 for subcategories
                            $html .= '<div class="mega-menu-item">';
                            $html .= '<div onclick="redirect_cat('.$subcategories[$j]['category_id'].')" class="menu-heading">' . html_entity_decode(htmlspecialchars($subcategories[$j]['name'])) . '</div>';
                            $thirdLevel = category_tree($subcategories[$j]['category_id']);
                            if (!empty($thirdLevel)) {
                                $html .= '<ul class="menu-list">';
                                for ($k = 0; $k < count($thirdLevel); $k++) {
                                    $html .= '<li><a href="' . html_entity_decode(htmlspecialchars(href_category($thirdLevel[$k]))) . '" class="menu-link-text link">' . html_entity_decode(htmlspecialchars($thirdLevel[$k]['name'])) . '</a></li>';
                                }
                                $html .= '</ul>';
                            }
                            $html .= '</div>'; // End mega-menu-item
                            $html .= '</div>'; // End col-lg-2
                        }
                    }
                    $html .= '</div>'; // End row
                    $html .= '</div>'; // End col-lg-8
                    $CI =& get_instance();
                    $html.= $CI->load->view('nav_bpro',array('bestseller_products'=>$bestseller_products),true);

                    // Slider section


                }

                $html .= '</div>'; // End row
                $html .= '</div>'; // End container
                $html .= '</div>'; // End mega-menu
                $html .= '</li>'; // End menu-item
                /*$imgClass = '';
                $html .= '<li >';
                $html .= '<a href = "#" >'.$value->name.' I m here</a >';
                $html .= '<ul class="sub-menu sub-menu-pages" style="width: 400px; border: 2px solid #2E6ED5;border-top: none">';
                foreach ($brands as  $b) {
                    $bslug = str_replace('-' , ' ' , $b->name);
                    $html .= '<li class="mbl" style="width: 25%; display:inline-flex;"><a href ="'.base_url('catalog/brand/'.$b->name.'.html').'"><span style="font-size: smaller">'.$b->name.'</span> <img src="'.site_url('images/brands/thumbnails/'.$b->images).'" width="auto" style="height: auto"/></a ></li >';
                }
                $html .= '</ul>';
                $html .= '</li >';*/
            }else{
                if($value->parent_id == 0):
                    $html .= '<li class="menu-item"><a class="item-link" href = "' . $value->slug . '.html" >' . html_entity_decode($value->name) . '</a ></li >';
                endif;
            }

        }

        // $html .= '<li ><a href = "contact-us.html" >Contact Us</a ></li >';

        return $html;
    }



    if ( !function_exists('get_parent')) {
        function get_parent($parent_id)
        {
            $CI =& get_instance();
            $CI->db->select('slug');
            $CI->db->from($CI->db->dbprefix . 'navigations');
            $CI->db->where('parent_id', $parent_id);
            $result = $CI->db->get()->row();
            if (!$result) {
                return FALSE;
            }

            return $result->slug;
        }

    }
}

if (!function_exists('create_mobile_navigation_html')) {
    function create_mobile_navigation_html($bestseller_products)
    {
        // $bestseller_products = get_bestseller_products(6);

        $CI =& get_instance();
        $CI->load->model('user/common/User_featured_module_model');
        $bestseller_products = $CI->User_featured_module_model->get_bestseller_products(6);
        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'navigations');
        $CI->db->where('is_enabled', 1);
        $CI->db->order_by('sort_order', 'ASC');

        $result = $CI->db->get()->result();

        if (!$result) {
            return FALSE;
        }

        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'brands');
        $CI->db->where('is_enabled', 1);
        $CI->db->order_by('date_added', 'ASC');
        $CI->db->limit(8);

        $brands = $CI->db->get()->result();

        $nav = array();
        foreach ($result as $value) {
            if ($value->parent_id != 0) {
                $nav[$value->name] = $value->slug;
            }
        }

        $html = '<div class="mb-body">
                    <ul class="nav-ul-mb" id="wrapper-menu-navigation">';

        foreach ($result as $value) {
            if ($value->slug == 'pages') {
                $html .= '<li class="nav-mb-item">
                            <a href="#dropdown-menu-pages" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dropdown-menu-pages">
                                <span>Pages</span>
                                <span class="btn-open-sub"></span>
                            </a>
                            <div id="dropdown-menu-pages" class="collapse">
                                <ul class="sub-nav-menu">';
                foreach ($nav as $val) {
                    $html .= '<li><a href="pages/' . $val . '.html" class="sub-nav-link">' . ucfirst(str_replace('-', ' ', $val)) . '</a></li>';
                }
                $html .= '   </ul>
                            </div>
                        </li>';
            } elseif ($value->slug == 'manufacturer') {
                $html .= '<li class="nav-mb-item">
                            <a href="#dropdown-menu-brands" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dropdown-menu-brands">
                                <span>' . $value->name . '</span>
                                <span class="btn-open-sub"></span>
                            </a>
                            <div id="dropdown-menu-brands" class="collapse">
                                <ul class="sub-nav-menu">';
                foreach ($brands as $b) {
                    $html .= '<li><a href="' . base_url('catalog/brand/' . $b->name . '.html') . '" class="sub-nav-link">' . $b->name . '</a></li>';
                }
                $html .= '   </ul>
                            </div>
                        </li>';
            } elseif ($value->module == 'category') {
                $subcategories = category_tree($value->cat_id);
                $hasSubcategories = !empty($subcategories);

                $html .= '<li class="nav-mb-item">
                            <a href="#dropdown-menu-' . $value->slug . '" class="collapsed mb-menu-link" data-bs-toggle="collapse" aria-expanded="false" aria-controls="dropdown-menu-' . $value->slug . '">
                                <span>' . $value->name . '</span>
                                <span class="btn-open-sub"></span>
                            </a>
                            <div id="dropdown-menu-' . $value->slug . '" class="collapse">
                                <ul class="sub-nav-menu">';
                if ($hasSubcategories) {
                    foreach ($subcategories as $subcategory) {
                        $html .= '<li><a href="' . href_category($subcategory) . '" class="sub-nav-link">' . $subcategory['name'] . '</a></li>';
                    }
                }
                $html .= '   </ul>
                            </div>
                        </li>';
            } else {
                $html .= '<li class="nav-mb-item">
                            <a href="' . $value->slug . '.html" class="mb-menu-link">
                                <span>' . $value->name . '</span>
                            </a>
                        </li>';
            }
        }

        $html .= '   </ul>
                 </div>';

        return $html;
    }
}

if (!function_exists('get_parent')) {
    function get_parent($parent_id)
    {
        $CI =& get_instance();
        $CI->db->select('slug');
        $CI->db->from($CI->db->dbprefix . 'navigations');
        $CI->db->where('parent_id', $parent_id);
        $result = $CI->db->get()->row();
        if (!$result) {
            return FALSE;
        }
        return $result->slug;
    }
}


if (!function_exists('get_brands_html')) {
    function get_brands_html()
    {
        $CI =& get_instance();

        // Fetch enabled brands, limited to 8
        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'categories');
        $CI->db->where('parent_id', 0);
        $CI->db->order_by('sort', 'ASC');
        $CI->db->limit(10);

        $brands = $CI->db->get()->result();
        if (!$brands) {
            return FALSE;
        }

        // Start the HTML structure for "SHOP BY CATEGORIES"
        $html = '<section class="flat-spacing-4 flat-categorie">';
        $html .= '<div class="container-full">';
        $html .= '<div class="flat-title-v2">';
        $html .= '<div class="box-sw-navigation">';
        $html .= '<div class="nav-sw nav-next-slider nav-next-collection"><span class="icon icon-arrow-left"></span></div>';
        $html .= '<div class="nav-sw nav-prev-slider nav-prev-collection"><span class="icon icon-arrow-right"></span></div>';
        $html .= '</div>';
        $html .= '<span class="text-3 fw-7 text-uppercase title wow fadeInUp" data-wow-delay="0s">SHOP BY CATEGORY</span>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-xl-12 col-lg-12 col-md-12">';
        $html .= '<div  class="swiper brands_swiper tf-sw-collection" data-preview="4" data-tablet="2" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">';
        $html .= '<div class="swiper-wrapper">';

        // Loop through the brands and generate swiper slides dynamically
        foreach ($brands as $brand) {
            if($brand->sort)
            {
                $brand_name = str_replace('-', ' ', $brand->name);
                $html .= '<div class="swiper-slide" lazy="true">';
                $html .= '<div class="collection-item style-left hover-img">';
                $html .= '<div class="collection-inner">';
                $html .= '<a href="' . base_url('catalog.html') . '?category_id='.$brand->category_id.'" class=" img-style">';
                $img = 'images/categories/medium/'.$brand->images;
                $img =  live_img_url().'/images/image.php?width=400&height=400&image=/'.$img;
                $html .= '<img class="lazyload" data-src="' .$img. '" src="' .$img. '" alt="' . $brand_name . '">';
                $html .= '</a>';
                $html .= '<div class="collection-content">';
                $html .= '<a href="' . base_url('catalog.html') . '?category_id='.$brand->category_id.'" class="tf-btn collection-title hover-icon fs-15">';
                $html .= '<span>' . $brand_name . '</span><i class="icon icon-arrow1-top-left"></i>';
                $html .= '</a>';
                $html .= '</div>'; // End collection content
                $html .= '</div>'; // End collection inner
                $html .= '</div>'; // End collection item
                $html .= '</div>'; // End swiper slide
            }//sort check
        }

        // Close the swiper wrapper and other surrounding HTML
        $html .= '</div>'; // End swiper wrapper
        $html .= '</div>'; // End swiper collection
        $html .= '</div>'; // End col-12
        $html .= '</div>'; // End row
        $html .= '</div>'; // End container-full
        $html .= '</section>'; // End section

        return $html;
    }
}

if (!function_exists('get_brands_html1')) {
    function get_brands_html1()
    {

        $CI =& get_instance();

        // Fetch enabled brands, limited to 8
        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'brands');
        $CI->db->where('is_enabled', 1);
        $CI->db->where('show_home', 1);
        // $CI->db->where('dis_val >', 0);
        // $CI->db->where('CURDATE() BETWEEN dis_sdate AND dis_edate', NULL, FALSE);

        $CI->db->order_by('sort', 'ASC');

        $brands = $CI->db->get()->result();
		//if(isset($_GET['debug']))
		//{
			//die('OKKK');
         //dd($brands);
		//}
        if (!$brands) {
            return FALSE;
        }
        // Start the HTML structure for "SHOP BY CATEGORIES"
        $html = '<section class="flat-spacing-4 flat-categorie">';
        $html .= '<div class="container-full">';
        $html .= '<div class="flat-title-v2">';
        $html .= '<div class="box-sw-navigation">';
        $html .= '<div class="nav-sw nav-next-slider nav-next-collection"><span class="icon icon-arrow-left"></span></div>';
        $html .= '<div class="nav-sw nav-prev-slider nav-prev-collection"><span class="icon icon-arrow-right"></span></div>';
        $html .= '</div>';
        $html .= '<span class="text-3 fw-7 text-uppercase title wow fadeInUp" data-wow-delay="0s">SHOP BY BRAND</span>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-xl-12 col-lg-12 col-md-12">';
        $html .= '<div  class="swiper brands_swiper tf-sw-collection" data-preview="4" data-tablet="2" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">';
        $html .= '<div class="swiper-wrapper">';

        // Loop through the brands and generate swiper slides dynamically
        $currency_symbol 		= $CI->config->item('config_currency') ? $CI->config->item('config_currency') : '$';
        foreach ($brands as $brand) {
            if($brand->sort || true)
            {
                $dtext = '';
                if($brand->dis_val)
                {
                    $dtext = $currency_symbol.'<br>'.$brand->dis_val.'<br> OFF';;
                    if(isset($brand->dis_mode) && $brand->dis_mode == 'per')
                    {
                        $dtext = 
                        $brand->dis_val.'% OFF ';

                    }
                }
                $brand_name = str_replace('-', ' ', $brand->name);
                $html .= '<div class="swiper-slide" lazy="true">';
                $html .= '<div class="collection-item style-left hover-img">';
                $html .= '<div class="collection-inner">';
                $html .= '<a href="'. base_url('catalog.html') . '?brand_id='.$brand->brand_id.'" class=" img-style">';
                $img = 'images/brands/medium/'.$brand->images;
                $img =  live_img_url().'/images/image.php?width=400&height=400&image=/'.$img;
                $html .= '<img class="lazyload" data-src="' .$img. '" src="' .$img. '" alt="' . $brand_name . '">';
                if($dtext)
                {
                    $html .= '<div class="sale-tag"><span>'.$dtext.'</span></div>';
                }
                $html .= '</a>';
                $html .= '<div class="collection-content">';
                //$html .= '<a href="'. base_url('catalog.html') . '?brand_id='.$brand->brand_id.'" class="tf-btn collection-title hover-icon fs-15">';
                //$html .= '<span>' . $brand_name . '</span><i class="icon icon-arrow1-top-left"></i>';
                //$html .= '</a>';
                $html .= '</div>'; // End collection content
                $html .= '</div>'; // End collection inner
                $html .= '</div>'; // End collection item
                $html .= '</div>'; // End swiper slide
            }//sort check
        }

        // Close the swiper wrapper and other surrounding HTML
        $html .= '</div>'; // End swiper wrapper
        $html .= '</div>'; // End swiper collection
        $html .= '</div>'; // End col-12
        $html .= '</div>'; // End row
        $html .= '</div>'; // End container-full
        $html .= '</section>'; // End section

        return $html;
    }
}

if (!function_exists('get_brands')) {
    function get_brands()
    {
        $CI =& get_instance();

        // Fetch enabled brands, limited to 8
        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'brands');
        $CI->db->where('is_enabled', 1);
        $CI->db->where('dis_val >', 0);
        $CI->db->where('CURDATE() BETWEEN dis_sdate AND dis_edate', NULL, FALSE);

        $CI->db->order_by('date_added', 'ASC');

        $brands = $CI->db->get()->result();
        if (!$brands) {
            return FALSE;
        }

        // Start the HTML structure for "SHOP BY CATEGORIES"
        $html = '<section class="flat-spacing-4 flat-categorie">';
        $html .= '<div class="container-full">';
        $html .= '<div class="flat-title-v2">';
        $html .= '<div class="box-sw-navigation">';
        $html .= '<div class="nav-sw nav-next-slider nav-next-collection"><span class="icon icon-arrow-left"></span></div>';
        $html .= '<div class="nav-sw nav-prev-slider nav-prev-collection"><span class="icon icon-arrow-right"></span></div>';
        $html .= '</div>';
        $html .= '<span class="text-3 fw-7 text-uppercase title wow fadeInUp" data-wow-delay="0s">SHOP BY BRANDS</span>';
        $html .= '</div>';
        $html .= '<div class="row">';
        $html .= '<div class="col-xl-12 col-lg-12 col-md-12 border-1">';
        $html .= '<div class="swiper tf-sw-collection" data-preview="3" data-tablet="2" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">';
        $html .= '<div class="swiper-wrapper">';

        // Loop through the brands and generate swiper slides dynamically
        foreach ($brands as $brand) {
            $brand_name = str_replace('-', ' ', $brand->name);
            $IMG = live_img_url().'/images/image.php?width=200&height=200&image=/images/brands/medium/' . $brand->images;
            $html .= '<div class="swiper-slide" lazy="true">';


            $html .= '<div class="collection-item style-left hover-img">';
            $html .= '<div class="collection-inner">';
            $html .= '<a href="' . base_url('catalog.html') . '?brand_id='.$brand->brand_id.'" class="collection-image img-style">';
            $html .= '<img class="lazyload" data-src="' . $IMG . '" src="' . $IMG . '" alt="' . $brand_name . '">';
            $html .= '<div class="sale-tag"><span>30% OFF</span></div>';
            $html .= '</a>';
            $html .= '<div class="collection-content">';
            //$html .= '<a href="' . base_url('catalog.html') . '?brand_id='.$brand->brand_id.'" class="tf-btn collection-title hover-icon fs-15">';
            // $html .= '<span>' . $brand_name . '</span><i class="icon icon-arrow1-top-left"></i>';
            //$html .= '</a>';
            $html .= '</div>'; // End collection content
            $html .= '</div>'; // End collection inner
            $html .= '</div>'; // End collection item
            $html .= '</div>'; // End swiper slide
        }

        // Close the swiper wrapper and other surrounding HTML
        $html .= '</div>'; // End swiper wrapper
        $html .= '</div>'; // End swiper collection
        $html .= '</div>'; // End col-12
        $html .= '</div>'; // End row
        $html .= '</div>'; // End container-full
        $html .= '</section>'; // End section

        return $html;
    }
}
if (!function_exists('get_brands1')) {
    function get_brands1()
    {
        $CI =& get_instance();

        // Fetch enabled brands, limited to 8
        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'brands');
        $CI->db->order_by('date_added', 'ASC');

        $brands = $CI->db->get()->result();
        if (!$brands) {
            return FALSE;
        }

        // Start the HTML structure for "SHOP BY CATEGORIES"
        $html = '<section class="flat-spacing-4 flat-categorie">';
        $html .= '<div class="row">';

        // Loop through the brands and generate swiper slides dynamically
        foreach ($brands as $brand) {
            $brand_name = str_replace('-', ' ', $brand->name);
            $html .= '<div class="col-md-3">';
            $html .= '<div class="collection-inner">';
            $html .= '<a href="' . base_url('catalog.html') . '?brand_id='.$brand->brand_id.'" class="collection-image img-style">';
            $html .= '<img class="lazyload" width="400" height="400" data-src="' . base_url().'images/image.php?width=400&height=400&image=/images/brands/small/'.$brand->images . '" src="' . base_url().'images/image.php?width=400&height=400&image=/images/brands/small/'.$brand->images . '" alt="' . $brand_name . '">';
            $html .= '</a>';
            $html .= '<div class="collection-content">';
            $html .= '<a href="' . base_url('catalog.html') . '?brand_id='.$brand->brand_id.'" class="tf-btn collection-title hover-icon fs-15">';
            $html .= '<span>' . $brand_name . '</span><i class="icon icon-arrow1-top-left"></i>';
            $html .= '</a>';
            $html .= '</div>'; // End collection content
            $html .= '</div>'; // End collection inner
            $html .= '</div>'; // End collection item
        }
        $html .= '</div>'; // End section
        $html .= '</section>'; // End section

        return $html;
    }
}



