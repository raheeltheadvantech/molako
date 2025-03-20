<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Core Config File
 */


// Site Details
$config['site_name']			= "Molako";
$config['site_tag_line']		= "online store";
$config['site_version']			= "1.0.0";
$config['root_folder']			= "";


$config['admin_folder']			= "admin";
$config['admin_url']			= "admin";
$config['admin_theme']			= "theme_001";
$config['admin_view']			= "admin_001";
$config['admin_assets']			= "admin_001";



$config['user_folder']			= "";
$config['user_url']				= "";
$config['user_secure']			= "secure";
$config['user_view']			= "user_001";
$config['user_theme']			= "user_001";
$config['user_assets']			= "user_001";

$config['phone_format']	= '(###) ###-####';

// Login Attempts
$config['login_max_time']        = 10;          // in seconds
$config['login_max_attempts']    = 3;


// Miscellaneous
$config['client_session_exipry']	 = 14400;	//	4Hrs
$config['user_session_exipry']	 	 = 14400;	//	4Hrs
$config['expert_session_exipry']	 = 14400;	//	4Hrs
$config['admin_session_exipry']	 	 = 14400;	//	4Hrs


$config['user_profiler']				= FALSE;
$config['client_profiler']				= FALSE;
$config['expert_profiler']				= FALSE;
$config['admin_profiler']				= FALSE;
$config['manager_profiler']				= FALSE;


$config['is_display_error'] 	 		= TRUE;
$config['send_email_display_error']		= TRUE;

$config['rewrite_product_route'] 		= TRUE;
$config['rewrite_category_route'] 		= TRUE;
$config['rewrite_brand_route'] 			= TRUE;
$config['rewrite_page_route'] 			= TRUE;


$config['cdn_url'] 		 		 = 'http://localhost/www/techcity_cdn';
$config['cdn_path'] 		 	 = 'C:\xampp\htdocs\www/techcity_cdn';


$config['size_limit']			= intval(ini_get('upload_max_filesize'))*1024;

