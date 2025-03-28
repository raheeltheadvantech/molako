<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_Public_Controller extends Base_Controller {
	
	public $admin_user_id;
	public $admin_role_id;
	public $admin_name;
	
	public $admin_url;
	public $admin_folder;
	public $admin_view;
	public $admin_theme;
    public $admin_template;
	
    public $admin_current_uri;
	public $admin_error;

	public $admin_settings;
	public $admin_languages;
	public $admin_includes;
	
	public $controller_dir = '';
	public $controller_name = '';
	public $view_dir = '';
	
	public $current_active_nav = '';

	
    function __construct()
    {
        parent::__construct();
		
		force_ssl();
		
		$this->admin_settings = new stdClass();
		
		$this->load_core_libraries();
		
		$this->current_uri = "/" . uri_string();
		
		$this->admin_includes[ 'page_title' ] = '';
		$this->admin_includes[ 'page_header' ] = '';
		
		
		// prepare theme name
		$this->admin_url 	= strtolower($this->site_config->item('admin_url'));
		$this->admin_folder = strtolower($this->site_config->item('admin_folder'));
		$this->admin_view 	= strtolower($this->site_config->item('admin_view'));
		$this->admin_theme 	= strtolower($this->site_config->item('admin_theme'));
		
		
		// set up global header data
		$this
			->set_title()
			->set_bodyclass()
			->set_template('login')
			;
		
		// declare main template
		//$this->admin_template = 'login-full-width.php';
		
		//$this->parse_breadcrumb();

		
		$this->output->enable_profiler($this->site_config->item('admin_profiler'));
    }

	private function load_core_libraries()
	{
		$this->form_validation_class_name = 'Form_validation_admin';
		
		//$this->load->library('Email_template', '', 'email_mananger');
		
		$this->load->library('Auth_admin');
		
		//unset($this->site_config);
		$this->load->library('Site_config_admin', '', 'site_config');
		
		$this->load_lang_admin();

		$this->load->helper('admin_site');
		
		//unset($this->form_validation);
		//$this->load->library('Zain_cart_admin', '', 'zain_cart');
	//	$this->load->library('Form_validation');
		$this->load->library('Form_validation_admin', '', 'form_validation');
		
		
		$this->load->helper('admin_url');
		$this->load->helper('url');
		
		$this->load->helper('admin_form');
		$this->load->helper('admin_site');
		$this->load->helper('form');
		
		$this->load->model('admin/Admin_search_model', 'Search_model');
		
		// common settings
		if($this->site_config->item('time_zone') != '')
		{
			date_default_timezone_set($this->site_config->item('time_zone'));
		}
		
		// loading admin settings
		$this->load->model('admin/system/Admin_setting_model');
		$settings = $this->Admin_setting_model->get_settings();
		if(!empty($settings)):
		foreach ($settings as $setting_key=>$setting_val)
		{
			$this->site_config->set_item($setting_key, $setting_val);
			if($setting_key == 'time_zone' and $setting_val != '')
			{
				date_default_timezone_set($setting_val);
			}
		}
		endif;




		//ADDING USERNAME
        if($admin_info = $this->admin_session->userdata('admin')){
            $this->admin_name = $admin_info['first_name'] .' ' . $admin_info['last_name'];
            $this->admin_user_id = $admin_info['admin_user_id'];
        }
	}
	
	private function _parse_view($view, $data = array(), $string=false)
	{
		$data = array_merge($this->admin_includes, $data);
		
		$content = $this->load->view($view, $data, TRUE);

		if(preg_match_all('/<script(.*?)noparse="(.*?)"(.*?)>(.*?)<\/script>/is', $content, $matches) !== FALSE)
		{
			if( isset($matches[2]) and sizeof($matches[2]) > 0 )
			return $content;
		}

		if(preg_match_all('/<script(.*?)src="(.*?)"(.*?)>(.*?)<\/script>/is', $content, $matches) !== FALSE)
		{
			foreach($matches[2] as $custom_js)
				$this->add_custom_js_external($custom_js);
		}
		
		//if(preg_match_all('/<script(.*?)src(.*?)>(.*?)<\/script>/is', $content, $matches) !== FALSE)
	//	if(preg_match_all('/<script((?:(?!src=).)*?)>(.*?)<\/script>/is', $content, $matches) !== FALSE)
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
		$path = '';//"../themes/admin/{$this->admin_theme}";
		
		if($string)
		{
			return $this->load->view($path . '/'. $view, $vars, true);
		}
		else
		{
			$this->load->view($path . '/'. $view, $vars);
		}
	}
	
	function view($view, $data = array(), $string=false)
	{
		$vars['content'] = $this->_parse_view($view, $data, TRUE);

		$data = array_merge($this->admin_includes, $vars);
		$path = "../themes/admin/{$this->admin_theme}";

		if($string)
		{
			return $this->load->view($path . '/'.$this->admin_template, $data, true);
		}
		else
		{
			$this->load->view($path . '/'.$this->admin_template, $data);
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
	
    function set_title( $page_title = '' )
    {
		if( $page_title == '' )
		{
			$class 	= $this->router->fetch_class();
			$page 	= $this->router->fetch_method();
			
			$page_title = str_replace('_', ' ', $page);
			if($page_title == 'index')
			$page_title = str_replace('_', ' ', $class);
			
			$page_title = ucfirst(strtolower($page_title));
		}
		
        $this->admin_includes[ 'page_title' ] = $page_title;
		
		$this->admin_includes[ 'page_header' ] = isset( $this->admin_includes[ 'page_header' ] ) ? $this->admin_includes[ 'page_header' ] : $page_title;
		
		return $this;
    }

    function set_page_header( $page_header )
    {
        $this->admin_includes[ 'page_header' ] = $page_header;
        return $this;
    }
	
    function add_custom_js( $js_code )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->admin_includes ) )
            $this->admin_includes = array();

            if ( !empty( $js_code ) )
            $this->admin_includes[ 'js_custom' ][ sha1( $js_code ) ] = $js_code;

        return $this;
    }

    function add_custom_js_external( $js_code )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->admin_includes ) )
            $this->admin_includes = array();

            if ( !empty( $js_code ) )
            $this->admin_includes[ 'js_custom_external' ][ sha1( $js_code ) ] = $js_code;

        return $this;
    }

	function add_custom_js_links( $js_code )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->admin_includes ) )
            $this->admin_includes = array();

            if ( !empty( $js_code ) )
            $this->admin_includes[ 'custom_js_links' ][ sha1( $js_code ) ] = $js_code;

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
        if ( ! is_array( $this->admin_includes ) )
            $this->admin_includes = array();

        // if $css_files is string, then convert into array
        $css_files = is_array( $css_files ) ? $css_files : explode( ",", $css_files );

        foreach( $css_files as $css )
        {
            // remove white space if any
            $css = trim( $css );

            // go to next when passing empty space
            if ( empty( $css ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->admin_includes[ 'css_files' ][ sha1( $css ) ] = base_url( "/themes/{$this->settings->theme}/css" ) . "/{$css}";
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
        if ( ! is_array( $this->admin_includes ) )
            $this->admin_includes = array();

        // if $css_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $js ) as a key to prevent duplicate js to be included
            $this->admin_includes[ 'js_files' ][ sha1( $js ) ] = base_url( "/themes/{$this->settings->theme}/js" ) . "/{$js}";
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
			$path =  APPPATH . "/themes/admin/{$this->admin_theme}/js/";
			
			$filename = $path . $file;
			//var_dump ($filename, is_file($filename), file_exists($filename), is_readable($filename));die;
			
			if(!is_file($filename) and file_exists($filename) and is_readable($filename))
			return $this;
			
			$js_files = $file;
		}
		
        if ( ! is_array( $this->admin_includes ) )
            $this->admin_includes = array();
		
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            $js = trim( $js );

            if ( empty( $js ) ) continue;

            $this->admin_includes[ 'js_files_i18n' ][ sha1( $js ) ] = $this->jsi18n->translate( APPPATH . "/themes/admin/{$this->admin_theme}/js/{$js}" );
        }

        return $this;
    }

	function set_bodyclass($bodyclass = '')
	{
		$class 	= $this->router->fetch_class();
		$page 	= $this->router->fetch_method();
		$url 	= uri_string();
		$this->admin_includes[ 'bodyclass' ] = $class .' '. $page .' '. str_replace(' ', '_', $class.'_'.$page) . ' ' . str_replace(' ', '', $bodyclass);
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
		
        $this->admin_template = "{$template_file}";
    }

    function get_template()
    {
		return $this->admin_template;
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
        if ( ! is_array( $this->admin_includes ) )
            $this->admin_includes = array();

        // if $css_files is string, then convert into array
        $css_files = is_array( $css_files ) ? $css_files : explode( ",", $css_files );

        foreach( $css_files as $css )
        {
            // remove white space if any
            $css = trim( $css );

            // go to next when passing empty space
            if ( empty( $css ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->admin_includes[ 'css_files' ][ sha1( $css ) ] = is_null( $path ) ? $css : $path . $css;
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
        if ( ! is_array( $this->admin_includes ) )
            $this->admin_includes = array();

        // if $js_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->admin_includes[ 'js_files' ][ sha1( $js ) ] = is_null( $path ) ? $js : $path . $js;
        }
		
        return $this;
    }
	

	
}
