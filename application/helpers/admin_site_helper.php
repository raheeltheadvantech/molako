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
		
		echo json_encode($result);
		exit;
		
		return FALSE;
	}
}


if( ! function_exists('validate_phone_format'))
{
	function validate_phone_format($number)
	{
		$format = '+92 ###-#######';

		$formats = array(trim(preg_replace("/[0-9]/", "#", $format)));
		$format = trim(preg_replace("/[0-9]/", "#", $number));
		
		$result = (!in_array($format, $formats)) ? true : false;
		
		return $result;
	}
}

if( ! function_exists('get_phone_format_js'))
{
	function get_phone_format_js()
	{
		$formats = config_item('phone_format');
		$format = trim(str_replace("#", "1", $formats));
		
		return $format;
	}
}

if( ! function_exists('get_phone_format_placeholder'))
{
	function get_phone_format_placeholder()
	{
		$formats = config_item('phone_format');
		$format = trim(str_replace("#", "9", $formats));
		
		return $format;
	}
}


if ( ! function_exists('get_time_zone_list'))
{
	function get_time_zone_list(){
		
		$return = array (
			'(UTC-11:00) Midway Island' => 'Pacific/Midway',
			'(UTC-11:00) Samoa' => 'Pacific/Samoa',
			'(UTC-10:00) Hawaii' => 'Pacific/Honolulu',
			'(UTC-09:00) Alaska' => 'US/Alaska',
			'(UTC-08:00) Pacific Time (US &amp; Canada)' => 'America/Los_Angeles',
			'(UTC-08:00) Tijuana' => 'America/Tijuana',
			'(UTC-07:00) Arizona' => 'US/Arizona',
			'(UTC-07:00) Chihuahua' => 'America/Chihuahua',
			'(UTC-07:00) La Paz' => 'America/Chihuahua',
			'(UTC-07:00) Mazatlan' => 'America/Mazatlan',
			'(UTC-07:00) Mountain Time (US &amp; Canada)' => 'US/Mountain',
			'(UTC-06:00) Central America' => 'America/Managua',
			'(UTC-06:00) Central Time (US &amp; Canada)' => 'US/Central',
			'(UTC-06:00) Guadalajara' => 'America/Mexico_City',
			'(UTC-06:00) Mexico City' => 'America/Mexico_City',
			'(UTC-06:00) Monterrey' => 'America/Monterrey',
			'(UTC-06:00) Saskatchewan' => 'Canada/Saskatchewan',
			'(UTC-05:00) Bogota' => 'America/Bogota',
			'(UTC-05:00) Eastern Time (US &amp; Canada)' => 'US/Eastern',
			'(UTC-05:00) Indiana (East)' => 'US/East-Indiana',
			'(UTC-05:00) Lima' => 'America/Lima',
			'(UTC-05:00) Quito' => 'America/Bogota',
			'(UTC-04:00) Atlantic Time (Canada)' => 'Canada/Atlantic',
			'(UTC-04:30) Caracas' => 'America/Caracas',
			'(UTC-04:00) La Paz' => 'America/La_Paz',
			'(UTC-04:00) Santiago' => 'America/Santiago',
			'(UTC-03:30) Newfoundland' => 'Canada/Newfoundland',
			'(UTC-03:00) Brasilia' => 'America/Sao_Paulo',
			'(UTC-03:00) Buenos Aires' => 'America/Argentina/Buenos_Aires',
			'(UTC-03:00) Georgetown' => 'America/Argentina/Buenos_Aires',
			'(UTC-03:00) Greenland' => 'America/Godthab',
			'(UTC-02:00) Mid-Atlantic' => 'America/Noronha',
			'(UTC-01:00) Azores' => 'Atlantic/Azores',
			'(UTC-01:00) Cape Verde Is.' => 'Atlantic/Cape_Verde',
			'(UTC+00:00) Casablanca' => 'Africa/Casablanca',
			'(UTC+00:00) Edinburgh' => 'Europe/London',
			'(UTC+00:00) Greenwich Mean Time : Dublin' => 'Etc/Greenwich',
			'(UTC+00:00) Lisbon' => 'Europe/Lisbon',
			'(UTC+00:00) London' => 'Europe/London',
			'(UTC+00:00) Monrovia' => 'Africa/Monrovia',
			'(UTC+00:00) UTC' => 'UTC',
			'(UTC+01:00) Amsterdam' => 'Europe/Amsterdam',
			'(UTC+01:00) Belgrade' => 'Europe/Belgrade',
			'(UTC+01:00) Berlin' => 'Europe/Berlin',
			'(UTC+01:00) Bern' => 'Europe/Berlin',
			'(UTC+01:00) Bratislava' => 'Europe/Bratislava',
			'(UTC+01:00) Brussels' => 'Europe/Brussels',
			'(UTC+01:00) Budapest' => 'Europe/Budapest',
			'(UTC+01:00) Copenhagen' => 'Europe/Copenhagen',
			'(UTC+01:00) Ljubljana' => 'Europe/Ljubljana',
			'(UTC+01:00) Madrid' => 'Europe/Madrid',
			'(UTC+01:00) Paris' => 'Europe/Paris',
			'(UTC+01:00) Prague' => 'Europe/Prague',
			'(UTC+01:00) Rome' => 'Europe/Rome',
			'(UTC+01:00) Sarajevo' => 'Europe/Sarajevo',
			'(UTC+01:00) Skopje' => 'Europe/Skopje',
			'(UTC+01:00) Stockholm' => 'Europe/Stockholm',
			'(UTC+01:00) Vienna' => 'Europe/Vienna',
			'(UTC+01:00) Warsaw' => 'Europe/Warsaw',
			'(UTC+01:00) West Central Africa' => 'Africa/Lagos',
			'(UTC+01:00) Zagreb' => 'Europe/Zagreb',
			'(UTC+02:00) Athens' => 'Europe/Athens',
			'(UTC+02:00) Bucharest' => 'Europe/Bucharest',
			'(UTC+02:00) Cairo' => 'Africa/Cairo',
			'(UTC+02:00) Harare' => 'Africa/Harare',
			'(UTC+02:00) Helsinki' => 'Europe/Helsinki',
			'(UTC+02:00) Istanbul' => 'Europe/Istanbul',
			'(UTC+02:00) Jerusalem' => 'Asia/Jerusalem',
			'(UTC+02:00) Kyiv' => 'Europe/Helsinki',
			'(UTC+02:00) Pretoria' => 'Africa/Johannesburg',
			'(UTC+02:00) Riga' => 'Europe/Riga',
			'(UTC+02:00) Sofia' => 'Europe/Sofia',
			'(UTC+02:00) Tallinn' => 'Europe/Tallinn',
			'(UTC+02:00) Vilnius' => 'Europe/Vilnius',
			'(UTC+03:00) Baghdad' => 'Asia/Baghdad',
			'(UTC+03:00) Kuwait' => 'Asia/Kuwait',
			'(UTC+03:00) Minsk' => 'Europe/Minsk',
			'(UTC+03:00) Nairobi' => 'Africa/Nairobi',
			'(UTC+03:00) Riyadh' => 'Asia/Riyadh',
			'(UTC+03:00) Volgograd' => 'Europe/Volgograd',
			'(UTC+03:30) Tehran' => 'Asia/Tehran',
			'(UTC+04:00) Abu Dhabi' => 'Asia/Muscat',
			'(UTC+04:00) Baku' => 'Asia/Baku',
			'(UTC+04:00) Moscow' => 'Europe/Moscow',
			'(UTC+04:00) Muscat' => 'Asia/Muscat',
			'(UTC+04:00) St. Petersburg' => 'Europe/Moscow',
			'(UTC+04:00) Tbilisi' => 'Asia/Tbilisi',
			'(UTC+04:00) Yerevan' => 'Asia/Yerevan',
			'(UTC+04:30) Kabul' => 'Asia/Kabul',
			'(UTC+05:00) Islamabad' => 'Asia/Karachi',
			'(UTC+05:00) Karachi' => 'Asia/Karachi',
			'(UTC+05:00) Tashkent' => 'Asia/Tashkent',
			'(UTC+05:30) Chennai' => 'Asia/Calcutta',
			'(UTC+05:30) Kolkata' => 'Asia/Kolkata',
			'(UTC+05:30) Mumbai' => 'Asia/Calcutta',
			'(UTC+05:30) New Delhi' => 'Asia/Calcutta',
			'(UTC+05:30) Sri Jayawardenepura' => 'Asia/Calcutta',
			'(UTC+05:45) Kathmandu' => 'Asia/Katmandu',
			'(UTC+06:00) Almaty' => 'Asia/Almaty',
			'(UTC+06:00) Astana' => 'Asia/Dhaka',
			'(UTC+06:00) Dhaka' => 'Asia/Dhaka',
			'(UTC+06:00) Ekaterinburg' => 'Asia/Yekaterinburg',
			'(UTC+06:30) Rangoon' => 'Asia/Rangoon',
			'(UTC+07:00) Bangkok' => 'Asia/Bangkok',
			'(UTC+07:00) Hanoi' => 'Asia/Bangkok',
			'(UTC+07:00) Jakarta' => 'Asia/Jakarta',
			'(UTC+07:00) Novosibirsk' => 'Asia/Novosibirsk',
			'(UTC+08:00) Beijing' => 'Asia/Hong_Kong',
			'(UTC+08:00) Chongqing' => 'Asia/Chongqing',
			'(UTC+08:00) Hong Kong' => 'Asia/Hong_Kong',
			'(UTC+08:00) Krasnoyarsk' => 'Asia/Krasnoyarsk',
			'(UTC+08:00) Kuala Lumpur' => 'Asia/Kuala_Lumpur',
			'(UTC+08:00) Perth' => 'Australia/Perth',
			'(UTC+08:00) Singapore' => 'Asia/Singapore',
			'(UTC+08:00) Taipei' => 'Asia/Taipei',
			'(UTC+08:00) Ulaan Bataar' => 'Asia/Ulan_Bator',
			'(UTC+08:00) Urumqi' => 'Asia/Urumqi',
			'(UTC+09:00) Irkutsk' => 'Asia/Irkutsk',
			'(UTC+09:00) Osaka' => 'Asia/Tokyo',
			'(UTC+09:00) Sapporo' => 'Asia/Tokyo',
			'(UTC+09:00) Seoul' => 'Asia/Seoul',
			'(UTC+09:00) Tokyo' => 'Asia/Tokyo',
			'(UTC+09:30) Adelaide' => 'Australia/Adelaide',
			'(UTC+09:30) Darwin' => 'Australia/Darwin',
			'(UTC+10:00) Brisbane' => 'Australia/Brisbane',
			'(UTC+10:00) Canberra' => 'Australia/Canberra',
			'(UTC+10:00) Guam' => 'Pacific/Guam',
			'(UTC+10:00) Hobart' => 'Australia/Hobart',
			'(UTC+10:00) Melbourne' => 'Australia/Melbourne',
			'(UTC+10:00) Port Moresby' => 'Pacific/Port_Moresby',
			'(UTC+10:00) Sydney' => 'Australia/Sydney',
			'(UTC+10:00) Yakutsk' => 'Asia/Yakutsk',
			'(UTC+11:00) Vladivostok' => 'Asia/Vladivostok',
			'(UTC+12:00) Auckland' => 'Pacific/Auckland',
			'(UTC+12:00) Fiji' => 'Pacific/Fiji',
			'(UTC+12:00) International Date Line West' => 'Pacific/Kwajalein',
			'(UTC+12:00) Kamchatka' => 'Asia/Kamchatka',
			'(UTC+12:00) Magadan' => 'Asia/Magadan',
			'(UTC+12:00) Marshall Is.' => 'Pacific/Fiji',
			'(UTC+12:00) New Caledonia' => 'Asia/Magadan',
			'(UTC+12:00) Solomon Is.' => 'Asia/Magadan',
			'(UTC+12:00) Wellington' => 'Pacific/Auckland',
			'(UTC+13:00) Nuku\'alofa' => 'Pacific/Tongatapu'
		);
		
		return array_flip($return);
	}
}

if ( ! function_exists('modules_name_menu'))
{
    function modules_name_menu()
    {
		$result = array(
              'category'	=> 'Category',
              'catalog'		=> 'Catalog',
              'brand'		=> 'Brand',
              'contact-us'	=> 'Contact Us',
              'page'	=> 'Page',
          );
		
		return $result;
    }
}


if ( ! function_exists('sort_url_2'))
{
	function sort_url_2($lang_key, $db_column, $order_by, $sort_by='', $code='', $url)
	{		
		$sort_by = strtolower($sort_by);
		
		if ($order_by == $db_column)
		{
			if ($sort_by == 'asc')
			{
				$order_by	= 'desc';
				$icon	= ' <i class="icon-chevron-up"></i>';
			}
			else
			{
				$order_by	= 'asc';
				$icon	= ' <i class="icon-chevron-down"></i>';
			}
		}
		else
		{
			$order_by	= 'asc';
			$icon	= '';
		}
			
		$return = site_url($url .'/'. $db_column .'/'. $order_by .'/'. $code);
		$lan_val = lang($lang_key);
		$lang_text = (!empty($lan_val) ? lang($lang_key) : $lang_key);
		
		echo '<a href="' .$return. '">' .$lang_text . $icon. '</a>';
	}
}

if ( ! function_exists('sort_url'))
{
	function sort_url($lang_key, $db_column, $url)
	{
		$CI =& get_instance();
		
		$order_by 	= $CI->input->get('order') ? $CI->input->get('order') : '';
		$sort_by 	= $CI->input->get('sort') ? $CI->input->get('sort') : 'asc';
		$code 		= $CI->input->get('code') ? $CI->input->get('code') : '';
		
		$sort_by 	= strtolower($sort_by);
		
		if ($order_by == $db_column)
		{
			if ($sort_by == 'asc')
			{
				$order_by 	= 'desc';
				$icon 		= '<i class="estl icon-sort-alpha-asc"></i>';
			}
			else
			{
				$order_by 	= 'asc';
				$icon 		= '<i class="estl icon-sort-alpha-desc"></i>';
			}
		}
		else
		{
			$order_by 	= 'asc';
			$icon 		= '';
		}
		
		$return 	= site_url($url .'?order='. $db_column .'&sort='. $order_by .'&code='. $code);
		$lan_val 	= lang($lang_key);
		$lang_text 	= (!empty($lan_val) ? lang($lang_key) : $lang_key);
		
		echo '<a style="position:relative" href="' .$return. '">' .$lang_text . $icon. '</a>';
	}
}

if ( ! function_exists('db_escape'))
{
	function db_escape($string) 
	{
		$CI =& get_instance();
		
		if(is_null($string))
		{
			$string = '';
		}
		
		return $CI->db->escape($string);
	}
}


//if ( ! function_exists('getparent')) {
//
//    function getparent($id)
//    {
////        $CI =& get_instance();
////        $CI->db->select('*');
////        $CI->db->from('categories');
////        $CI->db->where('category_id', $id);
////        $result = $CI->db->get()->result_array();
////
////        if (!$result) {
////            return false;
////        }
////
////        foreach ($result as $row) {
////            if ($row['parent_id'] != 0) {
////                $name = getparent($row['parent_id']) . '>>' . $row['name'];
////            } else {
////                $name = $row['name'];
////            }
////        }
////
////        return $name;
//
//
//    }
//}


if ( !function_exists('get_state_name')) {
    function get_state_name($zone_id)
    {
        $CI =& get_instance();
        $CI->db->select('name');
        $CI->db->from($CI->db->dbprefix . 'country_zones');
        $CI->db->where('zone_id', $zone_id);
        $result = $CI->db->get()->result();
        if (!$result) {
            return FALSE;
        }

        return $result[0]->name;
    }

}

if ( !function_exists('create_navigation_html')) {
    function create_navigation_html($parent_id = 0)
    {

        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'navigations');
        $CI->db->where('parent_id', $parent_id);
        // $CI->db->order_by('navigation_id','ASC');
        $CI->db->order_by('sort_order','ASC');

        $result = $CI->db->get()->result();
        if (!$result) {
            return FALSE;
        }

        $return = array();
            $html = "";
            $html .= "<ul id='navMenu'>\n";
			foreach($result as $key=>$val)
			{
                if (!isset($val)) {
                    $html .= "<li  class='active'>\n" . $val->name . "\n</li>\n";
                }
                if (isset($val->navigation_id)) {
                    $html .= "<li>\n" . $val->name . "\n";
                    $html .=  create_navigation_html($val->navigation_id);
                    $html .= "</li>\n";
                }
				
				
				//$return[$key] = $dt;
			}
			$html .= "</ul>\n";
			return $html;
		
    }
}

if ( !function_exists('create_navigation_tree')) {
    function create_navigation_tree($parent_id = 0)
    {

        $CI =& get_instance();
        $CI->db->select('*');
        $CI->db->from($CI->db->dbprefix . 'navigations');
        $CI->db->where('parent_id', $parent_id);
        // $CI->db->order_by('navigation_id','ASC');
        $CI->db->order_by('sort_order','ASC');

        $result = $CI->db->get()->result();
        if (!$result) {
            return FALSE;
        }
        // echo '<pre>';print_r($result);exit;
        $return = array();
            $html = "";
            $html .= "<ol class='dd-list'>\n";
			foreach($result as $key=>$val)
			{
                if (!isset($val)) {
                    $html .= "<li class='dd-item' data-id=$val->navigation_id data-name=$val->name data-cat_id=$val->cat_id data-module=$val->module >\n<div class='dd-handle'>\n" . $val->name . "\n</div>\n</li>\n";
                }
                if (isset($val->navigation_id)) {
                	$btn = '';
                	$btnAssign='';
                
                	// if ($val->is_last) {
                	// 	$btnAssign ="<button class='btn btn-default dd-nodrag btn-assign' data-toggle='modal' data-target='#childModal' style='float: right;padding: 1px 4px;margin-top: -2px;'  data-toggle='tooltip' data-placement='top' title='Assign Module'><i class='fa fa-gears'></i></button>";
                	// }else{
                		$btn ="<button class='btn btn-default dd-nodrag btn-chlid' data-toggle='modal' data-target='#childModal' style='float: right;padding: 1px 4px;margin-top: -2px;margin-left: 5px;' data-toggle='tooltip' data-placement='top' title='Add Chlid'><i class='fa fa-plus'></i></button>";
                		$btnAssign ="<button class='btn btn-default dd-nodrag btn-assign' data-toggle='modal' data-target='#childModal' style='float: right;padding: 1px 4px;margin-top: -2px;' data-toggle='tooltip' data-placement='top' title='Assign Module'><i class='fa fa-gears'></i></button>";
                	// }
                	$module = "<span class='text-primary'>(".$val->module.")</span>";
                	if (empty($val->module)) {
                		$btn ="<button class='btn btn-default dd-nodrag btn-chlid' data-toggle='modal' data-target='#childModal' style='float: right;padding: 1px 4px;margin-top: -2px;margin-left: 5px;' data-toggle='tooltip' data-placement='top' title='Add Chlid'><i class='fa fa-plus'></i></button>";
                		$module = "";
                	}
                    $html .= "<li class='dd-item' data-pid='$val->parent_id' data-cat_id='$val->cat_id' data-id='$val->navigation_id' data-title='$val->name' data-slug='$val->slug' data-module='$val->module' data-mid='$val->module_id'  data-enb='$val->is_enabled' data-order='$val->sort_order'>\n<div class='dd-handle'>\n" . $val->name ." ".$module." ".$btn." ".$btnAssign."</div>\n";
                    $html .=  create_navigation_tree($val->navigation_id);
                    $html .= "</li>\n";
                }
				
				
				//$return[$key] = $dt;
			}
			$html .= "</ol>\n";
			return $html;
		
    }
}

if ( !function_exists('RemoveSpecialChar')) {
    function RemoveSpecialChar($str)
    {

        // Using str_replace() function
        // to replace the word
        $res = str_replace(array('\'', '"',
            ',', ';', '<', '>'), ' ', $str);

        // Returning the result
        return $res;
    }
}