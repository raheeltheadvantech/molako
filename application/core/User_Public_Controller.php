<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_Public_Controller extends Base_Controller {

	public $customer_id;
	public $user_role_id;
	public $user;
	
	public $user_folder;
	public $user_url_prefix;
	public $user_view;
	public $user_theme;
	public $user_url;
	public $user_template;
	
    public $user_current_uri;
	public $user_error;

	public $user_settings;
	public $admin_settings;
	public $store_settings;
	
	public $user_includes;

	public $controller_dir;
	public $controller_name;
	public $view_dir;
	
	public $content_pages;
	
	public $nav_brands;
	public $nav_categories;
	public $current_active_nav;
	public $footer_brand_slider;

	public $nav_cart;
	public $nav_wish_list;
	
	public $user_pages;
	public $breadcrumbs;
	
	public $local_images_path = '/mccormack/uploads/original/products/';

    function __construct()
    {
		parent::__construct();
		
		force_ssl();
		
		$this->user_settings = new stdClass();
		$this->admin_settings = new stdClass();
		
		$this->load_core_libraries();
		
		$this->current_uri = '/' . uri_string();
		
		$this->user_includes[ 'page_title' ] = '';
		$this->user_includes[ 'page_header' ] = '';
		$this->current_active_nav = 'home';
		
		
		$this->user = (object)$this->user_session->userdata('user');
        $this->customer_id = isset($this->user->customer_id) ? $this->user->customer_id : '';

		
        // prepare theme name
		$this->user_url_prefix			= strtolower($this->config->item('user_secure'));
		$this->user_folder				= strtolower($this->config->item('user_folder'));
		$this->user_view 				= strtolower($this->config->item('user_view'));
		$this->user_theme 				= strtolower($this->config->item('user_theme'));
		$this->user_url 				= strtolower($this->config->item('user_url'));
		
		// $this->load->model('Page_model');
		
        // set up global header data
        $this
			->set_title()
			->set_bodyclass()
			->set_template('default')
			;
		$this->load->model('user/common/User_page_model');
		$this->user_pages = $this->User_page_model->get_pages(0);

		// echo '<pre>';print_r($this->user_pages);die;
		$this->output->enable_profiler($this->config->item('user_profiler'));
    }
	
	private function load_core_libraries()
	{
		//$this->load->library('Email_template', '', 'Email_mananger');
		
		$this->load->library('Auth_user');
		
		$this->load->library('Site_config_user', '', 'site_config');
		
        $this->load->library('tax');
        $this->load->library('cart_lib');

       // $this->load->library('coupon');
       // $this->load->library('membership');
        $this->load->library('discount');
       // $this->load->library('user_agent');

		$this->load_lang_user();
		
		$this->load->helper('user_site');
		

		$this->load->library('Form_validation_user', '', 'form_validation');
		$this->form_validation->set_error_delimiters('<p class="text-danger">', '</p>');
		
		$this->load->helper('formatting');
		
		$this->load->helper('user_url');
		$this->load->helper('url');
		
		$this->load->helper('user_form');
		$this->load->helper('user_site');
		$this->load->helper('form');
		
		//$this->load->model('user/common/User_search_model', 'Search_model');
		
		// common settings
		if($this->site_config->item('config_time_zone') != '')
		{
			date_default_timezone_set($this->site_config->item('config_time_zone'));
		}
		
		// loading admin settings
		$this->load->model('admin/system/Admin_setting_model');
        $settings = $this->Admin_setting_model->get_settings();

		if(!empty($settings)):
		foreach ($settings as $setting_key=>$setting_val)
		{
			$this->site_config->set_item($setting_key, $setting_val);
			if($setting_key == 'config_time_zone' and $setting_val != '')
			{
				date_default_timezone_set($setting_val);
			}
		}
		endif;

        // $this->set_tax();
		// +---------------------[loading header cart]------------
		$this->nav_cart = $this->cart();

		//->set_footer_brand_slider();

		$this->breadcrumbs = array();
		$this->breadcrumbs[] = array(
		    'title' => 'Home',
            'href'  => site_url()
        );

	}
	
	private function _parse_view($view, $data = array(), $string=false)
	{
		$data = array_merge($this->user_includes, $data);
		
		$content = $this->load->view($view, $data, TRUE);
		
		if(preg_match_all('/<script(.*?)src="(.*?)"(.*?)>(.*?)<\/script>/i', $content, $matches) !== FALSE)
		{
			foreach($matches[2] as $custom_js)
				$this->add_custom_js_external($custom_js);
		}
		//if(preg_match_all('/<script(.*?)src(.*?)>(.*?)<\/script>/is', $content, $matches) !== FALSE)
		//if(preg_match_all('/<script((?:(?!src=).)*?)>(.*?)<\/script>/is', $content, $matches) !== FALSE)
		if(preg_match_all('/<script\b[^>]*>(.*?)<\/script>/is', $content, $matches) !== FALSE)
		{
			foreach($matches[1] as $custom_js)
				$this->add_custom_js($custom_js);
		}

		
		
		//$content = preg_replace('/<script(.*?)src(.*?)>(.*?)<\/script>/is', "", $content);		//external
		//$content = preg_replace('/<script((?:(?!src=).)*?)>(.*?)<\/script>/is', "", $content);	//inline
		$content = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $content);				//all
		
		
		//$content = preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~‌​is', '', $content);
		
		return $content;
	}
	
	function partial($view, $vars = array(), $string=false)
	{
		$path = '';//"../themes/admin/{$this->user_theme}";
		
		if($string)
		{
			return $this->load->view($path . '/'. $view, $vars, true);
		}
		else
		{
			$this->load->view($path . '/'. $view, $vars);
		}
	}
	
	function view($view, $data = array(), $string=false, $is_email=false)
	{
		if($is_email)return $this->view_email($view, $data, $string);
		
		$vars['content'] = $this->_parse_view($view, $data, TRUE);
		
		$data = array_merge($this->user_includes, $vars, $this->set_meta($data));
		$path = "../themes/user/{$this->user_theme}";
		if($string)
		{
			return $this->load->view($path . '/'.$this->user_template, $data, true);
		}
		else
		{
			$this->load->view($path . '/'.$this->user_template, $data);
		}
	}

	function view_email($view, $data = array(), $string=false)
	{
		if($string)
		{
			return $this->load->view($view, $data, true);
		}
		else
		{
			$this->load->view($view, $data);
		}
	}
	
	function set_meta($meta = array())
	{
		$user_includes[ 'page_title' ] 			= !empty($meta['page_title']) ? $meta['page_title'] : '';
		$user_includes[ 'meta_title' ] 			= !empty($meta['meta_title']) ? $meta['meta_title'] : '';
		$user_includes[ 'meta_keywords' ] 		= !empty($meta['meta_keywords']) ? $meta['meta_keywords'] : '';
		$user_includes[ 'meta_description' ] 	= !empty($meta['meta_description']) ? $meta['meta_description'] : '';
		
		return $user_includes;
	}

    function set_title( $page_title = '' )
    {
		if( $page_title == '' )
		{
			$class 	= $this->router->fetch_class();
			$page 	= $this->router->fetch_method();
			
		//	if($class == 'User_home')
		//	$page_title = config_item('site_name').' - '.config_item('site_tag_line');
		}
		
        $this->user_includes[ 'page_title' ] = $page_title;
		
		$this->user_includes[ 'page_header' ] = isset( $this->user_includes[ 'page_header' ] ) ? $this->user_includes[ 'page_header' ] : $page_title;
		
		return $this;
    }

    function set_page_header( $page_header )
    {
        $this->user_includes[ 'page_header' ] = $page_header;
        return $this;
    }
	
    function add_custom_js( $js_code )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->user_includes ) )
            $this->user_includes = array();

            if ( !empty( $js_code ) )
            $this->user_includes[ 'js_custom' ][ sha1( $js_code ) ] = $js_code;

        return $this;
    }

    function add_custom_js_external( $js_code )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->user_includes ) )
            $this->user_includes = array();

            if ( !empty( $js_code ) )
            $this->user_includes[ 'js_custom_external' ][ sha1( $js_code ) ] = $js_code;

        return $this;
    }

    function add_custom_js_links( $js_code )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->user_includes ) )
            $this->user_includes = array();

            if ( !empty( $js_code ) )
            $this->user_includes[ 'custom_js_links' ][ sha1( $js_code ) ] = $js_code;

        return $this;
    }

	function add_custom_html($html_code)
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->user_includes ) )
            $this->user_includes = array();

            if ( !empty( $html_code ) )
            $this->user_includes[ 'custom_html' ][ sha1( $html_code ) ] = $html_code;

        return $this;
    }

    /**
     * Add CSS from Active Theme Folder
     *
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as parameter
     *     $this->add_css_theme( "bootstrap.min.css, style.css, admin.css" );
     *
     * 2. Using array as parameter
     *     $this->add_css_theme( array( "bootstrap.min.css", "style.css", "admin.css" ) );
     *
     * --------------------------------------
     */
    function add_css_theme( $css_files )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->user_includes ) )
            $this->user_includes = array();

        // if $css_files is string, then convert into array
        $css_files = is_array( $css_files ) ? $css_files : explode( ",", $css_files );

        foreach( $css_files as $css )
        {
            // remove white space if any
            $css = trim( $css );

            // go to next when passing empty space
            if ( empty( $css ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->user_includes[ 'css_files' ][ sha1( $css ) ] = base_url( "/themes/user/{$this->user_theme}/css" ) . "/{$css}";
        }
		
        return $this;
    }
	
    /**
     * Add JS from Active Theme Folder
     *
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as parameter
     *     $this->add_js_theme( "jquery-1.11.1.min.js, bootstrap.min.js, another.js" );
     *
     * 2. Using array as parameter
     *     $this->add_js_theme( array( "jquery-1.11.1.min.js", "bootstrap.min.js,", "another.js" ) );
     *
     * --------------------------------------
     */
    function add_js_theme( $js_files, $is_i18n = FALSE )
    {
        if ( $is_i18n )
            return $this->add_jsi18n_theme( $js_files );

        // make sure that $this->includes has array value
        if ( ! is_array( $this->user_includes ) )
            $this->user_includes = array();

        // if $css_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $js ) as a key to prevent duplicate js to be included
            $this->user_includes[ 'js_files' ][ sha1( $js ) ] = base_url( "/themes/{$this->settings->theme}/js" ) . "/{$js}";
        }

        return $this;
    }
	
    /**
     * Add JS from Active Theme Folder
     *
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as parameter
     *     $this->add_js_theme( "jquery-1.11.1.min.js, bootstrap.min.js, another.js" );
     *
     * 2. Using array as parameter
     *     $this->add_js_theme( array( "jquery-1.11.1.min.js", "bootstrap.min.js,", "another.js" ) );
     *
     * --------------------------------------
     */
	
    function add_jsi18n_theme( $js_files = false )
    {
		if($js_files == false)
		{
			$class 	= $this->router->fetch_class();
			$page 	= $this->router->fetch_method();
			
			$file = $class.'_i18n.js';
			$path =  APPPATH . "/themes/admin/{$this->user_theme}/js/";
			
			$filename = $path . $file;
			//var_dump ($filename, is_file($filename), file_exists($filename), is_readable($filename));die;
			
			if(!is_file($filename) and file_exists($filename) and is_readable($filename))
			return $this;
			
			$js_files = $file;
		}
		
        if ( ! is_array( $this->user_includes ) )
            $this->user_includes = array();
		
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            $js = trim( $js );

            if ( empty( $js ) ) continue;

            $this->user_includes[ 'js_files_i18n' ][ sha1( $js ) ] = $this->jsi18n->translate( APPPATH . "/themes/admin/{$this->user_theme}/js/{$js}" );
        }

        return $this;
    }

	function set_bodyclass($bodyclass = '')
	{
		$class 	= $this->router->fetch_class();
		$page 	= $this->router->fetch_method();
		$url 	= uri_string();
		//$this->user_includes[ 'bodyclass' ] = $class .' '. $page .' '. str_replace(' ', '_', $class.'_'.$page) . ' ' . str_replace(' ', '', $bodyclass);
		$this->user_includes[ 'bodyclass' ] = $bodyclass;
		return $this;
	}

    /* Set Template
     * sometime, we want to use different template for different page
     * for example, 404 template, login template, full-width template, sidebar template, etc.
     * so, use this function
     * --------------------------------------
     */
	
    function set_template( $template_file = 'template.php' )
    {
        // make sure that $template_file has .php extension
        $template_file = substr( $template_file, -4 ) == '.php' ? $template_file : ( $template_file . ".php" );
		
        $this->user_template = "{$template_file}";
    }

    function get_template()
    {
		return $this->user_template;
    }

    /**
     * Add CSS from external source or outside folder theme
     *
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as first parameter
     *     $this->add_external_css( "global.css, color.css", "http://example.com/assets/css/" );
     *      or
     *      $this->add_external_css(  "http://example.com/assets/css/global.css, http://example.com/assets/css/color.css" );
     *
     * 2. Using array as first parameter
     *     $this->add_external_css( array( "global.css", "color.css" ),  "http://example.com/assets/css/" );
     *      or
     *      $this->add_external_css(  array( "http://example.com/assets/css/global.css", "http://example.com/assets/css/color.css") );
     *
     * --------------------------------------
     */
    function add_external_css($css_files, $path = NULL)
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->user_includes ) )
            $this->user_includes = array();

        // if $css_files is string, then convert into array
        $css_files = is_array( $css_files ) ? $css_files : explode( ",", $css_files );

        foreach( $css_files as $css )
        {
            // remove white space if any
            $css = trim( $css );

            // go to next when passing empty space
            if ( empty( $css ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->user_includes[ 'css_files' ][ sha1( $css ) ] = is_null( $path ) ? $css : $path . $css;
        }

        return $this;
    }
    /**
     * Add JS from external source or outside folder theme
     *
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as first parameter
     *     $this->add_external_js( "global.js, color.js", "http://example.com/assets/js/" );
     *      or
     *      $this->add_external_js(  "http://example.com/assets/js/global.js, http://example.com/assets/js/color.js" );
     *
     * 2. Using array as first parameter
     *     $this->add_external_js( array( "global.js", "color.js" ),  "http://example.com/assets/js/" );
     *      or
     *      $this->add_external_js(  array( "http://example.com/assets/js/global.js", "http://example.com/assets/js/color.js") );
     *
     * --------------------------------------
     */
    function add_external_js( $js_files, $path = NULL )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->user_includes ) )
            $this->user_includes = array();

        // if $js_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->user_includes[ 'js_files' ][ sha1( $js ) ] = is_null( $path ) ? $js : $path . $js;
        }
		
        return $this;
    }

    private function set_tax(){

        $this->load->model('user/custom/User_address_model');
        $this->load->model('admin/Admin_setting_model');


        $cart_items = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();

        $checkout =(object) $this->user_session->userdata('checkout');


        $shipping_address_id = isset($checkout->shipping_address) ? $checkout->shipping_address : '';
        $shipping_address = $this->User_address_model->get_address($shipping_address_id);

        if (!empty($shipping_address)) {
            $this->tax->set_shipping_address($shipping_address->country_id, $shipping_address->region_id);
        }

        $payment_address_id = isset($checkout->billing_address) ? $checkout->billing_address : '';
        $payment_address = $this->User_address_model->get_address($payment_address_id);

        if (!empty($payment_address)) {

            $this->tax->set_payment_address($payment_address->country_id, $payment_address->region_id);
        }


        $result	= $this->Admin_setting_model->get_settings('config');

        if(!empty($result)):
            foreach($result as $key=>$val)
            {
                $data[$key]	= $val;
            }
        endif;

        $this->tax->set_store_address($data['config_country_id'],$data['config_zone_id']);

    }

	private function cart()
	{
		$this->load->model('user/catalog/User_catalog_model');
		$this->load->model('user/custom/User_address_model');
		$cart_items = $this->user_session->userdata('cart') ? $this->user_session->userdata('cart') : array();

		$checkout 	= (object)$this->user_session->userdata('checkout');
		// echo '<pre>';print_r($checkout);die();
        $shipping_address_id = isset($checkout->shipping_address) ? $checkout->shipping_address : '';
        $shipping_address = $this->User_address_model->get_address($shipping_address_id);
        $state_id = !empty($shipping_address) ? $shipping_address->region_id : false;

        $coupon = $this->user_session->userdata('coupon');
        $coupon_status 	= isset($coupon['status']) ? $coupon['status'] : '';
		$coupon_type 	= isset($coupon['type']) ? $coupon['type'] : '';
		$coupon_value 	= isset($coupon['value']) ? $coupon['value'] : '';


           // echo '<pre>';print_r($cart_items);die();



        $taxes = $this->tax->getTaxes();



        //get tax with name;
        $ttax = array();
        $total_tax = 0;
        if(!empty($taxes)) {
            foreach ($taxes as $key => $val) {
                $ttax[$key]['name'] = $this->tax->get_tax_name($key);
                $ttax[$key]['price'] = $val;
                $total_tax += $val;
            }
        }

        $products = array();
        $sub_total = $tax = 0;
		if(!empty($cart_items)) {
			foreach ($cart_items as  $item) {
				if(isset($item['product_id'])):
	                $product_id =  $item['product_id'];


					$product_info = $this->User_catalog_model->get_product($product_id);

	                $product_info->images = $product_info->images;

					if (!empty($product_info->images) && count($product_info->images) > 0) {

	                    $image = $product_info->images;
	                    //$image = base_url($pimage[0]);
					} else {
						$image = base_url($this->site_config->item('config_placeholder_small'));
					}

					// print_r($image);die();

	                $price = $product_info->final_price;

	                $item_total = $price * $item['quantity'];

	                $product_options = '';
	                $options = $item['options'];

	                foreach ($options as $key=>$value){

	                    if($key != 'product_option_value_id')
	                        $product_options .=$key .":".$value." ";

	                }

					$products[] = (object)array(
						'product_id' => $product_info->product_id,
						'product_slug' => $product_info->product_slug,
						'images' => $image,
						'product_name' => $product_info->product_name,
	                    'product_options' => $product_options,
						'sku' => $item['sku'],
						'quantity' => $item['quantity'],
	                    'unite_price' => format_currency(round($price,2)),
	                    'tax' => format_currency(round($total_tax,2)),
	                    'total' => round($item_total,2),
					);

	                $sub_total += $item_total;
	            endif;
			}
		}

        //$discount = $coupon_status == 'applied' ? $this->coupon->calculate_discount($sub_total,$coupon_type,$coupon_value) : '';
        $discount = '';
		$data['products'] = $products;
		$data['total_items'] = count($products);
        $data['sub_total'] = format_currency(round($sub_total,2));
        $data['tax'] = format_currency(round($total_tax,2));
        $data['total_price'] = format_currency($sub_total + $total_tax);
		return $this->load->view('user_001/checkout/top_cart', $data, true);
    }

	private function set_footer_brand_slider()
	{
		$this->load->model('user/catalog/User_catalog_model');
		$this->footer_brand_slider = $this->User_catalog_model->get_brands(array('is_enabled' => 1));
	}

	public function is_customer_login()
	{
		if($this->user_session->userdata('user')){
			$user = (object)$this->user_session->userdata('user');
			return $user->customer_id;
		}else{
			return false;
		}
	}

    public function get_brands_menu()
    {
        $this->load->model('user/catalog/User_brand_model');
        $results = $this->User_brand_model->get_brand_for_menu(array('is_enabled' => 1));
        $brand_menu = array();

        foreach ($results as $result){

            /*if($result->category->category_id == 5){
                $brand_menu[0]['category'] = $result->category;
                $brand_menu[0]['category']->brands = $result->brands;
            }*/


            if($result->category->category_id == 1){
                $brand_menu[1]['category'] = $result->category;
                $total_brands = count($result->brands);
                $per_column_brands = ceil($total_brands/3);
				$menu_columns = array();
				$column_count = 1;
				$column_item_count = 0;
                foreach ($result->brands as $bkey => $brand) {
                	$menu_columns[$column_count][$bkey] = $brand;
                	if($column_item_count == ($per_column_brands - 1)){
                		$column_count++;
                		$column_item_count = 0;
                    } else {
                		$column_item_count++;
					}
                }

				$alphabetic_list = array();


                foreach ($menu_columns as $column_key => $column_brands) {
					$column_menu_brands = array();
                	foreach ($column_brands as $bkey => $brand) {
						if (is_numeric(substr($brand->name, 0, 1))) {
							$key = '0 - 9';
                    }else{
							$key = substr(strtoupper($brand->name), 0, 1);
						}
						$column_menu_brands[$key][$bkey] = $brand;
					}
                	$menu_column_keys_temp = array_keys($column_menu_brands);
					$alphabetic_list[strtolower($menu_column_keys_temp[0]).'_'. strtolower(end($menu_column_keys_temp))] = $column_menu_brands;


                	/*if($column_menu_brands){
                		foreach ($column_menu_brands as $column_menu_brand_key => $brand){
							$a_to_z = array('A', 'B', 'C', 'D', 'E', 'F');
							$column_menu_brands[$key][$bkey] = $brand->name;

							if (in_array($key, $a_to_z)) {
								$alphabetic_list['a_e'][$bkey] = $brand;
							} else {
                        $alphabetic_list['f_z'][$bkey] = $brand;

                    }
                }
					}*/
                }


                /*foreach ($menu_columns as $bkey => $brand) {
                	echo "<pre>";
                	print_r($brand->name);
                	echo "</pre>";

                    if (is_numeric(substr($brand->name, 0, 1))) {
                        $key = '0 - 9';
                    } else {
                        $key = substr(strtoupper($brand->name), 0, 1);
                    }

                    $a_to_z = array('A','B','C','D','E','F');
					$menu_columns[$key][$bkey] = $brand->name;

                    if (in_array($key,$a_to_z)) {
                        $alphabetic_list['a_e'][$bkey] = $brand;
                    }else{
                        $alphabetic_list['f_z'][$bkey] = $brand;

                    }
                }*/

                $brand_menu[1]['category']->brands = json_decode(json_encode($alphabetic_list));
            }

            if($result->category->category_id == 4){
                $brand_menu[2]['category'] = $result->category;
                $brand_menu[2]['category']->brands = $result->brands;
            }

        }
        ksort($brand_menu);
        return $brand_menu;
	}
	
}
