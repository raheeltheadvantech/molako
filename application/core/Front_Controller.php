<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Front_Controller extends Base_Controller {
	
	public $user;
	public $settings;
	public $languages;
	public $includes;
	public $current_uri;
    public $theme;
    public $template;
    public $error;
	
    function __construct()
    {
        parent::__construct();
		
        // get current uri
		$this->current_uri = "/" . uri_string();
		
		$this->includes[ 'page_title' ] = '';
		$this->includes[ 'page_header' ] = '';
		
        $this->settings = new stdClass();

		// get settings
        $settings = $this->Setting_model->get_settings();
        $this->settings->site_name  	= $this->config->item('site_name');
		foreach ($settings as $setting_key=>$setting_val)
        {
			$this->settings->{$setting_key} = (@unserialize($setting_val) !== FALSE) ? unserialize($setting_val) : $setting_val;
        }
        $this->settings->site_version = $this->config->item('site_version');
        $this->settings->root_folder  = $this->config->item('root_folder');

		
        $this->settings->theme = strtolower($this->config->item('front_theme'));
		
        // get current user
        $this->user = $this->session->userdata('logged_in');
		
        // get languages
        $this->languages = get_languages();
        // set language according to this priority:
        //   1) First, check session
        //   2) If session not set, use the users language
        //   3) Finally, if no user, use the configured languauge
        if ($this->session->language)
        {
            // language selected from nav
            $this->config->set_item('language', $this->session->language);
        }
        elseif ($this->user['language'])
        {
            // user's saved language
            $this->config->set_item('language', $this->user['language']);
        }
        else
        {
            // default language
            $this->config->set_item('language', $this->config->item('language'));
        }

        // save selected language to session
        $this->session->language = $this->config->item('language');

        // load the core language file
        $this->lang->load('core');
		
		
        // declare main template
        $this->template = "../../{$this->settings->root_folder}/themes/{$this->settings->theme}/template.php";
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
		
        $this->includes[ 'page_title' ] = $page_title;
		
		echo $this->includes[ 'page_header' ] = isset( $this->includes[ 'page_header' ] ) ? $this->includes[ 'page_header' ] : $page_title;
		
		return $this;
    }

    function set_page_header( $page_header )
    {
        $this->includes[ 'page_header' ] = $page_header;
        return $this;
    }

    function add_custom_js( $js_code )
    {
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

            if ( !empty( $js_code ) )
            $this->includes[ 'js_custom' ][ sha1( $js_code ) ] = $js_code;

        return $this;
    }

    function add_custom_js_external( $js_code )
    {
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

            if ( !empty( $js_code ) )
            $this->includes[ 'js_custom_external' ][ sha1( $js_code ) ] = $js_code;

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
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $css_files is string, then convert into array
        $css_files = is_array( $css_files ) ? $css_files : explode( ",", $css_files );

        foreach( $css_files as $css )
        {
            // remove white space if any
            $css = trim( $css );

            // go to next when passing empty space
            if ( empty( $css ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->includes[ 'css_files' ][ sha1( $css ) ] = base_url( "/themes/{$this->settings->theme}/css" ) . "/{$css}";
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
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $css_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $js ) as a key to prevent duplicate js to be included
            $this->includes[ 'js_files' ][ sha1( $js ) ] = base_url( "/themes/{$this->settings->theme}/js" ) . "/{$js}";
        }

        return $this;
    }


    /**
     * Add JSi18n files from Active Theme Folder
     *
     * -----------------------------------
     * Example:
     * -----------------------------------
     * 1. Using string as parameter
     *     $this->add_jsi18n_theme( "dahboard_i18n.js, contact_i18n.js" );
     *
     * 2. Using array as parameter
     *     $this->add_jsi18n_theme( array( "dahboard_i18n.js", "contact_i18n.js" ) );
     *
     * 3. Or we can use add_js_theme function, and add TRUE for second parameter
     *     $this->add_js_theme( "dahboard_i18n.js, contact_i18n.js", TRUE );
     *      or
     *     $this->add_js_theme( array( "dahboard_i18n.js", "contact_i18n.js" ), TRUE );
     * --------------------------------------
     */
    function add_jsi18n_theme( $js_files )
    {
        // make sure that $this->includes has array value
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $css_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $js ) as a key to prevent duplicate js to be included
            $this->includes[ 'js_files_i18n' ][ sha1( $js ) ] = $this->jsi18n->translate( "/themes/{$this->settings->theme}/js/{$js}" );
        }

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
		
        $this->template = '../themes/'."{$this->settings->theme}/{$template_file}";
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
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $css_files is string, then convert into array
        $css_files = is_array( $css_files ) ? $css_files : explode( ",", $css_files );

        foreach( $css_files as $css )
        {
            // remove white space if any
            $css = trim( $css );

            // go to next when passing empty space
            if ( empty( $css ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->includes[ 'css_files' ][ sha1( $css ) ] = is_null( $path ) ? $css : $path . $css;
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
        if ( ! is_array( $this->includes ) )
            $this->includes = array();

        // if $js_files is string, then convert into array
        $js_files = is_array( $js_files ) ? $js_files : explode( ",", $js_files );

        foreach( $js_files as $js )
        {
            // remove white space if any
            $js = trim( $js );

            // go to next when passing empty space
            if ( empty( $js ) ) continue;

            // using sha1( $css ) as a key to prevent duplicate css to be included
            $this->includes[ 'js_files' ][ sha1( $js ) ] = is_null( $path ) ? $js : $path . $js;
        }

        return $this;
    }


}
