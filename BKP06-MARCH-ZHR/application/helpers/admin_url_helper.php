<?php defined('BASEPATH') OR exit('No direct script access allowed');

function assets_url($uri)
{
	$CI =& get_instance();
	
	return $CI->config->site_url('assets/'.$CI->config->item('admin_assets').'/'.$uri);
}

