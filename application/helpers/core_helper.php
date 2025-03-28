<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Outputs an array in a user-readable JSON format
 *
 * @param array $array
 */
if ( ! function_exists('pre'))
{
    function pre($array)
    {
    	echo'<pre>';print_r($array);die;
    }
}
if ( ! function_exists('display_json'))
{
    function display_json($array)
    {
        $data = json_indent($array);

        header('Cache-Control: no-cache, must-revalidate');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Content-type: application/json');

        echo $data;
    }
}


/**
 * Convert an array to a user-readable JSON string
 *
 * @param array $array - The original array to convert to JSON
 * @return string - Friendly formatted JSON string
 */
if ( ! function_exists('json_indent'))
{
    function json_indent($array = array())
    {
        // make sure array is provided
        if (empty($array))
            return NULL;

        //Encode the string
        $json = json_encode($array);

        $result        = '';
        $pos           = 0;
        $str_len       = strlen($json);
        $indent_str    = '  ';
        $new_line      = "\n";
        $prev_char     = '';
        $out_of_quotes = true;

        for ($i = 0; $i <= $str_len; $i++)
        {
            // grab the next character in the string
            $char = substr($json, $i, 1);

            // are we inside a quoted string?
            if ($char == '"' && $prev_char != '\\')
            {
                $out_of_quotes = !$out_of_quotes;
            }
            // if this character is the end of an element, output a new line and indent the next line
            elseif (($char == '}' OR $char == ']') && $out_of_quotes)
            {
                $result .= $new_line;
                $pos--;

                for ($j = 0; $j < $pos; $j++)
                {
                    $result .= $indent_str;
                }
            }

            // add the character to the result string
            $result .= $char;

            // if the last character was the beginning of an element, output a new line and indent the next line
            if (($char == ',' OR $char == '{' OR $char == '[') && $out_of_quotes)
            {
                $result .= $new_line;

                if ($char == '{' OR $char == '[')
                {
                    $pos++;
                }

                for ($j = 0; $j < $pos; $j++)
                {
                    $result .= $indent_str;
                }
            }

            $prev_char = $char;
        }

        // return result
        return $result . $new_line;
    }
}


/**
 * Save data to a CSV file
 *
 * @param array $array
 * @param string $filename
 * @return bool
 */
if ( ! function_exists('array_to_csv'))
{
    function array_to_csv($array = array(), $filename = "export.csv")
    {
        $CI = get_instance();

        // disable the profiler otherwise header errors will occur
        $CI->output->enable_profiler(FALSE);

        if ( ! empty($array))
        {
            // ensure proper file extension is used
            if ( ! substr(strrchr($filename, '.csv'), 1))
            {
                $filename .= '.csv';
            }

            try
            {
                // set the headers for file download
                header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
                header("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT");
                header("Cache-Control: no-cache, must-revalidate");
                header("Pragma: no-cache");
                header("Content-type: text/csv");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename={$filename}");

                $output = @fopen('php://output', 'w');

                // used to determine header row
                $header_displayed = FALSE;

                foreach ($array as $row)
                {
                    if ( ! $header_displayed)
                    {
                        // use the array keys as the header row
                        fputcsv($output, array_keys($row));
                        $header_displayed = TRUE;
                    }

                    // clean the data
                    $allowed = '/[^a-zA-Z0-9_ %\|\[\]\.\(\)%&-]/s';
                    foreach ($row as $key => $value)
                    {
                        $row[$key] = preg_replace($allowed, '', $value);
                    }

                    // insert the data
                    fputcsv($output, $row);
                }

                fclose($output);

            }
            catch (Exception $e) {}
        }

        exit;
    }
}


/**
 * Generates a random password
 *
 * @return string
 */
if ( ! function_exists('generate_random_password'))
{
    function generate_random_password()
    {
        $characters = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array();
        $alpha_length = strlen($characters) - 1;

        for ($i = 0; $i < 8; $i++)
        {
            $n = rand(0, $alpha_length);
            $pass[] = $characters[$n];
        }

        return implode($pass);
    }
}


/**
 * Retrieves list of language folders
 *
 * @return array
 */
if ( ! function_exists('get_languages'))
{
    function get_languages()
    {
        $CI = get_instance();

        if ($CI->session->languages)
        {
            return $CI->session->languages;
        }

        $CI->load->helper('directory');

        $language_directories = directory_map(APPPATH . '/language/', 1);
        if ( ! $language_directories)
        {
            $language_directories = directory_map(BASEPATH . '/language/', 1);
        }

        $languages = array();
        foreach ($language_directories as $language)
        {
            if (substr($language, -1) == "/" || substr($language, -1) == "\\")
            {
                $languages[substr($language, 0, -1)] = ucwords(str_replace(array('-', '_'), ' ', substr($language, 0, -1)));
            }
        }

        $CI->session->languages = $languages;

        return $languages;
    }
}

/**
 * Retrieves list of language folders
 *
 * @return array
 */
if ( ! function_exists('get_admin_languages'))
{
    function get_admin_languages()
    {
        $CI = get_instance();

        if ($CI->admin_session->languages)
        {
            return $CI->admin_session->languages;
        }

        $CI->load->helper('directory');

        $language_directories = directory_map(APPPATH . '/language/', 1);
        if ( ! $language_directories)
        {
            $language_directories = directory_map(BASEPATH . '/language/', 1);
        }

        $languages = array();
        foreach ($language_directories as $language)
        {
            if (substr($language, -1) == "/" || substr($language, -1) == "\\")
            {
                $languages[substr($language, 0, -1)] = ucwords(str_replace(array('-', '_'), ' ', substr($language, 0, -1)));
            }
        }

        $CI->admin_session->languages = $languages;

        return $languages;
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


//	echo sort_url('lang_key', 'col_name', $order_by, $sort_order, $code, $url))

//if ( ! function_exists('sort_url'))
//{
//	function sort_url($lang, $by, $order_by, $sort_order='', $code='', $url)
//	{
//		if ($order_by == $by)
//		{
//			if ($sort_order == 'asc')
//			{
//				$order_by	= 'desc';
//				$icon	= ' <i class="icon-chevron-up"></i>';
//			}
//			else
//			{
//				$order_by	= 'asc';
//				$icon	= ' <i class="icon-chevron-down"></i>';
//			}
//		}
//		else
//		{
//			$order_by	= 'asc';
//			$icon	= '';
//		}
//
//		$return = site_url($url.'/'.$by.'/'.$order_by.'/'.$code);
//		$lan_val = lang($lang);
//		$lang_text = (!empty($lan_val) ? lang($lang) : $lang);
//
//		echo '<a href="'.$return.'">'.$lang_text.$icon.'</a>';
//	}
//}


if ( ! function_exists('get_core_language_menu'))
{
	function get_core_language_menu($return_type = 0)
	{
		$CI = &get_instance();
		$CI->load->model('admin/Admin_language_model');
		$result = $CI->Admin_language_model->get_core_language_menu();
		
		if(!$result)
		{
			return FALSE;
		}
		
		return $result;
	}
}

if ( ! function_exists('get_core_language_dropdown'))
{
	function get_core_language_dropdown($args = array(), $minify = true)
	{
		$CI = &get_instance();
		$CI->load->model('admin/Admin_language_model');
		$result = $CI->Admin_language_model->get_core_languages();
		if(!$result)
		{
			return FALSE;
		}
		
		$params = array('name'=>'', 'class'=>'', 'id'=>'', 'selected'=>'');
		$params = array_merge($params , $args);
		
		if(empty($params['name']))
		return false;
		
		$control = '<select name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'">';
		
		$options = '';
		foreach($result as $key=>$val)
		{
			if($val->culture_code == '')continue;
			
			$val->country = htmlentities($val->country, ENT_QUOTES, 'utf-8', false);
			$val->language = htmlentities($val->language, ENT_QUOTES, 'utf-8', false);
			
			$options .= '<option data-country_id="'.$val->country_id.'" data-id="'.$val->language_id.'" data-iso2="'.$val->iso2_country_code.'" data-iso3="'.$val->iso3_country_code.'" data-iso2-lang="'.$val->iso2_language_code.'" data-iso3-lang="'.$val->iso3_language_code.'" data-name="'.$val->country.'" data-language="'.$val->language.'" data-name_info="'.$val->country.' - '.$val->language.'" data-is_rtl="'.$val->is_rtl.'" data-charset="'.$val->charset.'" data-culture_code="'.$val->culture_code.'" value="'.$val->culture_code.'"'.($params['selected'] == $val->culture_code ? ' selected="selected"':'').'>'.$val->country.' ('.$val->language.')</option>' . "\n";
		}
		$control .= $options. "\n". '</select>';
		
		if($minify)
		$control = replace_newline($control, false);
		
		return $control;
	}
}

if ( ! function_exists('replace_newline'))
{
	function replace_newline($string, $addslashes = true) {
	  if(!$addslashes)
	  return trim((string)str_replace(array("\r", "\r\n", "\n", "\t"), ' ', $string));
	  
	  return addslashes(trim((string)str_replace(array("\r", "\r\n", "\n", "\t"), ' ', $string)));
	}
}

if ( ! function_exists('set_js_message'))
{
	function set_js_message($message = '', $type = 'success' )
	{
		$message = trim($message);
		
		if($message == '')
		return false;
		
		if($type == 'error')$type = 'danger';
		
		return
		$hrml = '
		
		<div id="js-container" class="alert alert-'.$type.' alert-dismissable error-box">
			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'
			//<div id="js-'.$type.'">'.$message.'</div>
			.'<ul><li>'.$message.'</li></ul>
		</div>
		
		';
	}
}

if ( ! function_exists('get_core_phone_formats_dropdown'))
{
	function get_core_phone_formats_dropdown($args = array(), $minify = true)
	{
		$CI = &get_instance();
		$CI->load->library('Phone_formats');
		$result = $CI->phone_formats->get_phone_formats();
		if(!$result)
		{
			return FALSE;
		}
		
		$params = array('name'=>'', 'class'=>'', 'id'=>'', 'selected'=>'');
		$params = array_merge($params , $args);
		
		if(empty($params['name']))
		return false;
		
		$control = '<select name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'">';
		
		$options = '';
		foreach($result as $key=>$val)
		{
			if($val->format == '')continue;
			
			$val->country = htmlentities($val->country, ENT_QUOTES, 'utf-8', false);
			
			$options .= '<option data-country_id="'.$val->country_id.'" data-id="'.$val->phone_format_id.'" data-name="'.$val->country.'" data-name_info="'.$val->country.' - '.$val->format.'" data-digits="'.$val->digits.'" data-format="'.$val->format.'" value="'.$val->format.'"'.($params['selected'] == $val->format ? ' selected="selected"':'').'>'.$val->country.' ('.$val->format.')</option>' . "\n";
		}
		$control .= $options. "\n". '</select>';
		
		if($minify)
		$control = replace_newline($control, false);
		
		return $control;
	}
}

if( ! function_exists('get_module_actions_menu'))
{
	
	function get_module_actions_menu()
	{
		return array(
					''		=> lang('000000000070'),
					'add'	=> lang('000000000019'),
					'edit'	=> lang('000000000020'),
					'delete'=> lang('000000000021'),
					'view'	=> lang('000000000069'),
					);
		
	}
}

if( ! function_exists('validate_phone_format'))
{
	function validate_phone_format($number)
	{
		//$formats = array(config_item('phone_format'));
		$formats = array(trim(preg_replace("/[0-9]/", "#", config_item('phone_format'))));
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

if ( ! function_exists('get_role_name_by_id'))
{
	function get_role_name_by_id($id)
	{
		$CI = &get_instance();
		$CI->load->model('admin/Admin_Acl_model');
		$result = $CI->Admin_Acl_model->get_admin_role_by_id($id);
		if(!$result)
		{
			return FALSE;
		}
		
		return $result->name;
	}
	
}

if ( ! function_exists('zero_fill'))
{
	function zero_fill($input_num, $zerofill = 12)
	{
		return str_pad($input_num, $zerofill, '0', STR_PAD_LEFT);
	}
}

if ( ! function_exists('get_admin_language_dropdown'))
{
	function get_admin_language_dropdown($args = array(), $minify = true)
	{
		$CI = &get_instance();
		$CI->load->model('admin/Admin_language_model');
		$result = $CI->Admin_language_model->get_culture_codes();
		if(!$result)
		{
			return FALSE;
		}
		
		return create_language_dropdown($result, $args, $minify);
	}
}

if ( ! function_exists('get_language_dropdown'))
{
	function get_language_dropdown($args = array(), $minify = true)
	{
		$CI = &get_instance();
		$CI->load->model('Language_model');
		$result = $CI->Language_model->get_culture_codes();
		if(!$result)
		{
			return FALSE;
		}
		
		return create_language_dropdown($result, $args, $minify);
	}
}

if ( ! function_exists('create_language_dropdown'))
{
	function create_language_dropdown($result, $args = array(), $minify = true)
	{
		$params = array('name'=>'', 'class'=>'', 'id'=>'', 'selected'=>'', 'is_submit'=>'onchange="this.form.submit();"');
		$params = array_merge($params , $args);
		
		if(empty($params['name']))
		return false;
		
		$control = '<select name="'.$params['name'].'" id="'.$params['id'].'" class="'.$params['class'].'" '.$params['is_submit'].'>';
		
		$options = '';
		foreach($result as $key=>$val)
		{
			if($val->culture_code == '')continue;
			
			$val->country = htmlentities($val->country, ENT_QUOTES, 'utf-8', false);
			$val->language = htmlentities($val->language, ENT_QUOTES, 'utf-8', false);
			
			$options .= '<option data-country_id="'.$val->country_id.'" data-id="'.$val->language_id.'" data-iso2="'.$val->iso2_country_code.'" data-iso3="'.$val->iso3_country_code.'" data-iso2-lang="'.$val->iso2_language_code.'" data-iso3-lang="'.$val->iso3_language_code.'" data-name="'.$val->country.'" data-language="'.$val->language.'" data-name_info="'.$val->country.' - '.$val->language.'" data-is_rtl="'.$val->is_rtl.'" data-charset="'.$val->charset.'" data-culture_code="'.$val->culture_code.'" value="'.$val->culture_code.'"'.($params['selected'] == $val->culture_code ? ' selected="selected"':'').'>'.$val->country.' ('.$val->language.')</option>' . "\n";
		}
		$control .= $options. "\n". '</select>';
		
		if($minify)
		$control = replace_newline($control, false);
		
		return $control;
	}
}

if ( ! function_exists('get_language_dropdown_ul'))
{
	function get_language_dropdown_ul($args = array(), $minify = true)
	{
		$CI = &get_instance();
		$CI->load->model('Language_model');
		$result = $CI->Language_model->get_culture_codes();
		if(!$result)
		{
			return FALSE;
		}
		
		return create_language_dropdown_ul($result, $args, $minify);
	}
}

if ( ! function_exists('create_language_dropdown_ul'))
{
	function create_language_dropdown_ul($result, $args = array(), $minify = true)
	{
		$params = array('class'=>'', 'id'=>'');
		$params = array_merge($params , $args);
		
		/*if(empty($params['name']))
		return false;*/
		
		$control = '<ul id="'.$params['id'].'" class="'.$params['class'].'">';
		
		$options = '';
		foreach($result as $key=>$val)
		{
			if($val->culture_code == '')continue;
			
			$val->country = htmlentities($val->country, ENT_QUOTES, 'utf-8', false);
			$val->language = htmlentities($val->language, ENT_QUOTES, 'utf-8', false);
			
			$options .= '<li class="'.$val->iso2_country_code.'-flag" data-country_id="'.$val->country_id.'" data-id="'.$val->language_id.'" data-iso2="'.$val->iso2_country_code.'" data-iso3="'.$val->iso3_country_code.'" data-iso2-lang="'.$val->iso2_language_code.'" data-iso3-lang="'.$val->iso3_language_code.'" data-name="'.$val->country.'" data-language="'.$val->language.'" data-name_info="'.$val->country.' - '.$val->language.'" data-is_rtl="'.$val->is_rtl.'" data-charset="'.$val->charset.'" data-culture_code="'.$val->culture_code.'"><a href="javascript:void(0)" data-id="'.$val->culture_code.'" onclick="$(\'.set_lang\').val($(this).data(\'id\')); $(\'#frm_language\').submit();">'.$val->country.' ('.$val->language.')</a></li>' . "\n";//change_language('."'".$val->culture_code."'".')
		}
		$control .= $options. "\n". '</ul>';
		$control .= '<input type="hidden" name="set_lang" class="set_lang">';
		if($minify)
		$control = replace_newline($control, false);
		
		return $control;
	}
}

if ( ! function_exists('get_language_dropdown_ul_2_client'))
{
	function get_language_dropdown_ul_2_client($args = array(), $minify = true)
	{
		$CI = &get_instance();
		$CI->load->model('client/Client_language_model');
		$result = $CI->Client_language_model->get_culture_codes();
		if(!$result)
		{
			return FALSE;
		}
		
		return create_language_dropdown_ul_2($result, $args, $minify);
	}
}

if ( ! function_exists('get_language_dropdown_ul_2'))
{
	function get_language_dropdown_ul_2($args = array(), $minify = true)
	{
		$CI = &get_instance();
		$CI->load->model('Language_model');
		$result = $CI->Language_model->get_culture_codes();
		if(!$result)
		{
			return FALSE;
		}
		
		return create_language_dropdown_ul_2($result, $args, $minify);
	}
}

if ( ! function_exists('create_language_dropdown_ul_2'))
{
	function create_language_dropdown_ul_2($result, $args = array(), $minify = true)
	{
		$params = array('class'=>'', 'id'=>'');
		$params = array_merge($params , $args);
		
		/*if(empty($params['name']))
		return false;*/
		
		$control = '<ul id="'.$params['id'].'" class="'.$params['class'].'">';
		
		$options = '';
		foreach($result as $key=>$val)
		{
			if($val->culture_code == '')continue;
			
			$val->country = htmlentities($val->country, ENT_QUOTES, 'utf-8', false);
			$val->language = htmlentities($val->language, ENT_QUOTES, 'utf-8', false);
			
			$options .= '<li class="" data-country_id="'.$val->country_id.'" data-id="'.$val->language_id.'" data-iso2="'.$val->iso2_country_code.'" data-iso3="'.$val->iso3_country_code.'" data-iso2-lang="'.$val->iso2_language_code.'" data-iso3-lang="'.$val->iso3_language_code.'" data-name="'.$val->country.'" data-language="'.$val->language.'" data-name_info="'.$val->country.' - '.$val->language.'" data-is_rtl="'.$val->is_rtl.'" data-charset="'.$val->charset.'" data-culture_code="'.$val->culture_code.'"><a href="javascript:void(0)" data-id="'.$val->culture_code.'" onclick="$(\'.set_lang\').val($(this).data(\'id\')); $(\'#frm_language\').submit();"><i class="sflag slang-'.strtolower($val->iso2_country_code).'"></i>'.$val->country.' ('.$val->language.')</a></li>' . "\n";//change_language('."'".$val->culture_code."'".')
		}
		$control .= $options. "\n". '</ul>';
		$control .= '<input type="hidden" name="set_lang" class="set_lang">';
		if($minify)
		$control = replace_newline($control, false);
		
		return $control;
	}
}

if ( ! function_exists('get_language_dropdown_ul_3'))
{
	function get_language_dropdown_ul_3($args = array(), $minify = true)
	{
		$CI = &get_instance();
		$CI->load->model('Language_model');
		$result = $CI->Language_model->get_culture_codes();
		if(!$result)
		{
			return FALSE;
		}
		
		return create_language_dropdown_ul_3($result, $args, $minify);
	}
}

if ( ! function_exists('create_language_dropdown_ul_3'))
{
	function create_language_dropdown_ul_3($result, $args = array(), $minify = true)
	{
		$params = array('class'=>'', 'id'=>'');
		$params = array_merge($params , $args);
		
		/*if(empty($params['name']))
		return false;*/
		
		$control = '<ul id="'.$params['id'].'" class="'.$params['class'].'">';
		
		$options = '';
		foreach($result as $key=>$val)
		{
			if($val->culture_code == '')continue;
			
			$val->country = htmlentities($val->country, ENT_QUOTES, 'utf-8', false);
			$val->language = htmlentities($val->language, ENT_QUOTES, 'utf-8', false);
			
			$options .= '<li class="" data-country_id="'.$val->country_id.'" data-id="'.$val->language_id.'" data-iso2="'.$val->iso2_country_code.'" data-iso3="'.$val->iso3_country_code.'" data-iso2-lang="'.$val->iso2_language_code.'" data-iso3-lang="'.$val->iso3_language_code.'" data-name="'.$val->country.'" data-language="'.$val->language.'" data-name_info="'.$val->country.' - '.$val->language.'" data-is_rtl="'.$val->is_rtl.'" data-charset="'.$val->charset.'" data-culture_code="'.$val->culture_code.'">
			<a href="javascript:void(0)" data-id="'.$val->culture_code.'" onclick="language_change(this); $(\'.set_lang\').val($(this).data(\'id\')); $(\'#frm_language\').submit();">
				<div class="leftbar">
					<img src="'.site_url("assets/img/$val->culture_code.svg").'" alt="">
				</div>
				<div class="rightbar">
					<div class="pull-left">
						<span>'.$val->language.'</span>
						<p>'.$val->country.'</p>
					</div>
					<div class="pull-right">
						<i class="fa fa-spin fa-spinner pull-left" id="language-loader-'.$val->culture_code.'" style="display:none;"></i>
						<i class="pull-left icon-tick '.($val->culture_code == $params['culture_code'] ? 'active' : '').'"></i>
					</div>
				</div>
			</a>
			
			</li>' . "\n";//change_language('."'".$val->culture_code."'".')
		}
		$control .= $options. "\n". '</ul>';
		$control .= '<input type="hidden" name="set_lang" class="set_lang">';
		if($minify)
		$control = replace_newline($control, false);
		
		return $control;
	}
}

if ( ! function_exists('create_checkin_menu'))
{
	function create_checkin_menu($type = 'from')
	{
		$result['from'] = array('07:00'=>'7:00 AM', '07:30'=>'7:30 AM', '08:00'=>'8:00 AM', '08:30'=>'8:30 AM', '09:00'=>'9:00 AM', '09:30'=>'9:30 AM', '10:00'=>'10:00 AM', '10:30'=>'10:30 AM', '11:00'=>'11:00 AM', '11:30'=>'11:30 AM', '12:00'=>'12:00 PM', '12:30'=>'12:30 PM', '13:00'=>'13:00 PM', '13:30'=>'13:30 PM', '14:00'=>'14:00 PM', '14:30'=>'14:30 PM', '15:00'=>'15:00 PM', '15:30'=>'15:30 PM', '16:00'=>'16:00 PM', '16:30'=>'16:30 PM', '17:00'=>'17:00 PM', '17:30'=>'17:30 PM', '18:00'=>'18:00 PM', '18:30'=>'18:30 PM', '19:00'=>'19:00 PM', '19:30'=>'19:30 PM', '20:00'=>'20:00 PM');
		
		$result['to'] = array('12:00'=>'12:00 PM', '12:30'=>'12:30 PM', '13:00'=>'13:00 PM', '13:30'=>'13:30 PM', '14:00'=>'14:00 PM', '14:30'=>'14:30 PM', '15:00'=>'15:00 PM', '15:30'=>'15:30 PM', '16:00'=>'16:00 PM', '16:30'=>'16:30 PM', '17:00'=>'17:00 PM', '17:30'=>'17:30 PM', '18:00'=>'18:00 PM', '18:30'=>'18:30 PM', '19:00'=>'19:00 PM', '19:30'=>'19:30 PM', '20:00'=>'20:00 PM', '20:30'=>'20:30 PM', '21:00'=>'21:00 PM', '21:30'=>'21:30 PM', '22:00'=>'22:00 PM', '22:30'=>'22:30 PM', '23:00'=>'23:00 PM', '23:30'=>'23:30 PM', '00:00'=>'12:00 AM', 
		);
		
		return $result[$type];
		
	}
}

if ( ! function_exists('create_checkout_menu'))
{
	function create_checkout_menu($type = 'from')
	{
		$result['from'] = array('00:00'=>'12:00 AM', '00:30'=>'12:30 AM', '01:00'=>'1:00 AM', '01:30'=>'1:30 AM', '02:00'=>'2:00 AM', '02:30'=>'2:30 AM', '03:00'=>'3:00 AM', '03:30'=>'3:30 AM' , '04:00'=>'4:00 AM', '04:30'=>'4:30 AM', '05:00'=>'5:00 AM', '05:30'=>'5:30 AM', '06:00'=>'6:00 AM', '06:30'=>'6:30 AM', '07:00'=>'7:00 AM', '07:30'=>'7:30 AM', '08:00'=>'8:00 AM', '08:30'=>'8:30 AM', '09:00'=>'9:00 AM', '09:30'=>'9:30 AM', '10:00'=>'10:00 AM', '10:30'=>'10:30 AM', '11:00'=>'11:00 AM', '11:30'=>'11:30 AM', '12:00'=>'12:00 PM', '12:30'=>'12:30 PM', '13:00'=>'13:00 PM', '13:30'=>'13:30 PM', '14:00'=>'14:00 PM', 
		);
		
		$result['to'] = array('07:00'=>'7:00 AM', '07:30'=>'7:30 AM', '08:00'=>'8:00 AM', '08:30'=>'8:30 AM', '09:00'=>'9:00 AM', '09:30'=>'9:30 AM', '10:00'=>'10:00 AM', '10:30'=>'10:30 AM', '11:00'=>'11:00 AM', '11:30'=>'11:30 AM', '12:00'=>'12:00 PM', '12:30'=>'12:30 PM', '13:00'=>'13:00 PM', '13:30'=>'13:30 PM', '14:00'=>'14:00 PM', '14:30'=>'14:30 PM', '15:00'=>'15:00 PM', '15:30'=>'15:30 PM', '16:00'=>'16:00 PM', '16:30'=>'16:30 PM', '17:00'=>'17:00 PM', '17:30'=>'17:30 PM', '18:00'=>'18:00 PM', '18:30'=>'18:30 PM', '19:00'=>'19:00 PM', '19:30'=>'19:30 PM', '20:00'=>'20:00 PM');
		
		return $result[$type];
	}
}

if ( ! function_exists('get_client_ip'))
{
    function get_client_ip()
	{
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_CF_CONNECTING_IP']))
            $ipaddress = $_SERVER['HTTP_CF_CONNECTING_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';

        return $ipaddress;
	}
}

if ( ! function_exists('get_client_ip_env'))
{
	function get_client_ip_env() {
		$ipaddress = '';
		if (getenv('HTTP_CLIENT_IP'))
			$ipaddress = getenv('HTTP_CLIENT_IP');
		else if(getenv('HTTP_X_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
		else if(getenv('HTTP_X_FORWARDED'))
			$ipaddress = getenv('HTTP_X_FORWARDED');
		else if(getenv('HTTP_FORWARDED_FOR'))
			$ipaddress = getenv('HTTP_FORWARDED_FOR');
		else if(getenv('HTTP_FORWARDED'))
			$ipaddress = getenv('HTTP_FORWARDED');
		else if(getenv('REMOTE_ADDR'))
			$ipaddress = getenv('REMOTE_ADDR');
		else
			$ipaddress = 'UNKNOWN';
	 
		return $ipaddress;
	}
}

if ( ! function_exists('get_real_ip'))
{
	function get_real_ip() 
	{
		$headers = array ('HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'HTTP_VIA', 'HTTP_X_COMING_FROM', 'HTTP_COMING_FROM', 'HTTP_CLIENT_IP' );
	 
		foreach ( $headers as $header ) 
		{
			if (isset ( $_SERVER [$header]  )) 
			{
			   if (($pos = strpos ( $_SERVER [$header], ',' )) != false) 
			   {
					$ip = substr ( $_SERVER [$header], 0, $pos );
				} else {
					$ip = $_SERVER [$header];
				}
				$ipnum = ip2long ( $ip );
				
				if ($ipnum !== - 1 && $ipnum !== false && (long2ip ( $ipnum ) === $ip)) 
				{
					if (($ipnum - 184549375) && // Not in 10.0.0.0/8
					($ipnum  - 1407188993) && // Not in 172.16.0.0/12
					($ipnum  - 1062666241)) // Not in 192.168.0.0/16
					if (($pos = strpos ( $_SERVER [$header], ',' )) != false) 
					{
						$ip = substr ( $_SERVER [$header], 0, $pos );
					} else {
						$ip = $_SERVER [$header];
					}
					return $ip;
				}
			}
			
		}
		
		return $_SERVER ['REMOTE_ADDR'];
	}
}

if ( ! function_exists('get_real_ip2'))
{
function get_real_ip2($void=null) {

$headers = array(
'HTTP_VIA',
'HTTP_X_FORWARDED_FOR',
'HTTP_FORWARDED_FOR',
'HTTP_X_FORWARDED',
'HTTP_FORWARDED',
'HTTP_CLIENT_IP',
'HTTP_HTTP_CLIENT_IP',
'HTTP_FORWARDED_FOR_IP',
'VIA',
'X_FORWARDED_FOR',
'FORWARDED_FOR',
'X_FORWARDED',
'FORWARDED',
'CLIENT_IP',
'FORWARDED_FOR_IP',
'HTTP_XPROXY_CONNECTION',
'HTTP_PROXY_CONNECTION',
'HTTP_X_REAL_IP',
'HTTP_X_PROXY_ID',
'HTTP_USERAGENT_VIA',
'HTTP_HTTP_PC_REMOTE_ADDR',
'HTTP_X_CLUSTER_CLIENT_IP'
);

		foreach ($headers as $header) if (isset($_SERVER[$header]) && !empty($_SERVER[$header])) return $_SERVER[$header];
	
		if (trim($_SERVER['SERVER_ADDR']) == trim($_SERVER['REMOTE_ADDR'])) return $_SERVER['SERVER_ADDR'];
	
		return $_SERVER['REMOTE_ADDR'];
	}
}

if ( ! function_exists('get_ip_by_webservice'))
{
	function get_ip_by_webservice()
	{
		return $ip = file_get_contents('https://api.ipify.org');
	}
}

if ( ! function_exists('ipaddress_to_ipnumber'))
{
	function ipaddress_to_ipnumber($ipaddress = false) {
		$CI = &get_instance();
		if(!$ipaddress)
		$ipaddress = $CI->input->ip_address();
		//$ipaddress = get_client_ip();
		
		$ipaddress = '79.170.50.40';	// PK- '103.255.5.42';
		
		$pton = @inet_pton($ipaddress);
		if (!$pton) { return false; }
			$number = '';
			foreach (unpack('C*', $pton) as $byte) {
				$number .= str_pad(decbin($byte), 8, '0', STR_PAD_LEFT);
			}
		return base_convert(ltrim($number, '0'), 2, 10);
	}
}

if ( ! function_exists('create_internet_menu'))
{
	function create_internet_menu($type = 'has_internet')
	{
		$result['has_internet'] = array('no'=>lang('000000000014'), 'yes'=>lang('000000000219'), 'paid'=>lang('000000000220'));
		
		$result['internet_type'] = array("cable"=>lang('000000000221'), "wireless"=>lang('000000000222'));
		
		$result['internet_availability'] = array("public_areas"=>lang('000000000223'), "some_rooms"=>lang('000000000224'), "all_rooms"=>lang('000000000225'), "entire_property"=>lang('000000000226'));
		
		$result['internet_price_unit'] = array("per_minute"=>lang('000000001882'), "per_half_hour"=>lang('000000001883'), "per_hour"=>lang('000000001884'), "per_day"=>lang('000000001371'));
		
		return $result[$type];
	}
}

if ( ! function_exists('create_parking_menu'))
{
	function create_parking_menu($type = 'has_parking')
	{
		$result['has_parking'] = array('no'=>lang('000000000014'), 'yes'=>lang('000000000219'), 'paid'=>lang('000000000220'));
		
		$result['parking_space'] = array("public"=>lang('000000000196'), "private"=>lang('000000000195'));
		
		$result['parking_location'] = array("on_site"=>lang('000000000197'), "off_site"=>lang('000000000198'));
		
		$result['parking_reservation_required'] = array("yes"=>lang('000000000200'), "no"=>lang('000000000201'));
		
		$result['parking_price_unit'] = array("per_hour"=>lang('000000001884'), "per_day"=>lang('000000001371'), "per_week"=>lang('000000001886'), "per_stay"=>lang('000000001752'));
		
		return $result[$type];
	}
}

if ( ! function_exists('create_breakfast_menu'))
{
	function create_breakfast_menu($type = 'is_breakfast_included')
	{
		$result['is_breakfast_included'] = array('no'=>lang('000000000014'), 'included'=>lang('000000000227'), 'optional'=>lang('000000000228'));
		
		return $result[$type];
	}
}

if ( ! function_exists('create_pets_menu'))
{
	function create_pets_menu($type = 'is_pets_allowed')
	{
		$result['is_pets_allowed'] = array('no'=>lang('000000000014'), 'yes'=>lang('000000000013'), 'request'=>lang('000000000229'));
		
		$result['pets_fee'] = array('free'=>lang('000000000212'), 'paid'=>lang('000000000213'));
		
		return $result[$type];
	}
}

if ( ! function_exists('create_smoking_menu'))
{
	function create_smoking_menu()
	{
		return array("no"=>lang('000000000244'), "yes"=>lang('000000000245'));
	}
}

if ( ! function_exists('create_quantity_menu'))
{
	function create_quantity_menu($start=1, $end=10)
	{
		for($i=$start; $i<=$end; $i++){
			$result[$i] = $i;
		}
		return $result;
	}
}

if ( ! function_exists('create_cancel_policy_menu'))
{
	function create_cancel_policy_menu($type = 'cancel_free_days')
	{
		$result['cancel_guest_payment'] = array("first_night"=>lang('000000000511'), "full_stay"=>lang('000000000512'));
		
		$result['hall_cancel_guest_payment'] = array("full_stay"=>"of the full booking");
		
		$result['cancel_free_days'] = array("0"=>lang('000000000504'), "1"=>lang('000000000505'), "2"=>lang('000000000506'), "3"=>lang('000000000507'), "7"=>lang('000000000508'), "14"=>lang('000000000509'));
		
		$result['hall_cancel_free_days'] = array("1"=>lang('000000000505'), "2"=>lang('000000000506'), "3"=>lang('000000000507'), "7"=>lang('000000000508'), "14"=>lang('000000000509'));
		
		return $result[$type];
	}
}

if ( ! function_exists('create_invoice_recipient_menu'))
{
	function create_invoice_recipient_menu()
	{
		return array(lang('000000000536')=>lang('000000000536'), lang('000000000532')=>lang('000000000532'), 'Waqar Hafeez'=>'Waqar Hafeez');
	}
}

if ( ! function_exists('create_room_measure_unit_menu'))
{
    function create_room_measure_unit_menu()
    {
        return array("square_meters"=>lang('000000000494'), "square_feet"=>lang('000000000495'));
    }
}

if ( ! function_exists('create_yes_free_yes_paid_menu'))
{
    function create_yes_free_yes_paid_menu()
    {
        return array(''=>lang('000000000206'), 'free'=>lang('000000000219'), 'paid'=>lang('000000000220'));
    }
}

if ( ! function_exists('transform_array_1'))
{
    function transform_array_1($assoc_key_1 = '', $array_1 = array(), $assoc_key_2 = '', $array_2 = array())
    {
		if( sizeof($array_1) != sizeof($array_2) )return array();
		
		$result = array();
		for($p=0; $p<sizeof($array_1); $p++)
		{
			if(empty($array_1[$p]) Or empty($array_2[$p]))continue;
			$result[$p] = array($assoc_key_1=>$array_1[$p], $assoc_key_2=>$array_2[$p]);
		}
		
		return $result;
    }
}

if ( ! function_exists('transform_array_2'))
{
    function transform_array_2($assoc_key_1 = '', $array_1 = array(), $assoc_key_2 = '', $array_2 = array())
    {
		$array_1 = array_keys($array_1);
		//$array_2 = @array_values($array_2);
		
		if( !is_array($array_1) )return array();
		
		$result = array();
		for($p=0; $p<sizeof($array_1); $p++)
		{
			$result[$p] = array($assoc_key_1=>$array_1[$p], $assoc_key_2=>isset($array_2[$array_1[$p]]) ? $array_2[$array_1[$p]] : '');
		}
		
		return $result;
    }
}

if ( ! function_exists('transform_array_3'))
{
    function transform_array_3($array = array(), $assoc_key_1 = '', $assoc_key_2 = '')
    {
		if( !is_array($array) or $assoc_key_1 == '' or $assoc_key_2 == '')return array();
		
		$result = array();
		foreach($array as $key=>$val)
		{
			$val_1 = $val_2 = array();
			
			foreach($val as $key2=>$val2){
				
				$val_1[$val2[$assoc_key_1]] = $val2[$assoc_key_1];
				$val_2[$val2[$assoc_key_1]] = $val2[$assoc_key_2];
			}
			$result[$key] = array($assoc_key_1=>$val_1, $assoc_key_2=>$val_2);
		}
		
		return $result;
    }
}

if ( ! function_exists('transform_array_4'))
{
    function transform_array_4($assoc_key_1 = '', $array_1 = array(), $assoc_key_2 = '', $array_2 = array())
    {
		
		if( !is_array($array_1) or !is_array($array_2))return array();
		if( sizeof($array_1) != sizeof($array_2) )return array();
		
		$result = array();
		for($p=0; $p<sizeof($array_1); $p++)
		{
			$result[$p] = array($assoc_key_1=>$array_1[$p], $assoc_key_2=>$array_2[$p]);
		}
		
		return $result;
    }
}

if ( ! function_exists('transform_array_5'))
{
    function transform_array_5($array = array(), $assoc_key_1 = '', $assoc_key_2 = '')
    {
		if( !is_array($array) or $assoc_key_1 == '' or $assoc_key_2 == '')return array();
		
		$result = array();
		$val_1 = $val_2 = array();
		foreach($array as $key=>$val)
		{
			$val_1[] = $val[$assoc_key_1];
			$val_2[] = $val[$assoc_key_2];
		}
		
		$result = array($assoc_key_1=>$val_1, $assoc_key_2=>$val_2);
		
		return $result;
    }
}

if ( ! function_exists('transform_array_1_1'))
{
    function transform_array_1_1($assoc_key_1 = '', $array_1 = array(), $assoc_key_2 = '', $array_2 = array())
    {
		if( sizeof($array_1) != sizeof($array_2) )return array();
		
		$result = array();
		for($p=0; $p<sizeof($array_1); $p++)
		{
			//if(empty($array_1[$p]) /*Or empty($array_2[$p])*/)continue;
			$result[$p] = array($assoc_key_1=>isset($array_1[$p]) ? $array_1[$p] : '', $assoc_key_2=>isset($array_2[$p]) ? $array_2[$p] : '');
		}
		
		return $result;
    }
}

if ( ! function_exists('transform_array_1_1_inverse'))
{
    function transform_array_1_1_inverse($array = array(), $assoc_key_1 = '', $assoc_key_2 = '')
    {
		if( !is_array($array) or $assoc_key_1 == '' or $assoc_key_2 == '')return array($assoc_key_1=>array(), $assoc_key_2=>array());
		
		$result = array();
		$val_1 = $val_2 = array();
		foreach($array as $key=>$val)
		{
			$val_1[] = $val[$assoc_key_1];
			$val_2[] = $val[$assoc_key_2];
		}
		
		$result = array($assoc_key_1=>$val_1, $assoc_key_2=>$val_2);
		
		return $result;
    }
}

if ( ! function_exists('transform_array_1_1_1'))
{
    function transform_array_1_1_1($assoc_key_1 = '', $array_1 = array())
    {
		if( sizeof($array_1) != 0 )return array();
		
		$result = array();
		for($p=0; $p<sizeof($array_1); $p++)
		{
			//if(empty($array_1[$p]) /*Or empty($array_2[$p])*/)continue;
			$result[$p] = array($assoc_key_1=>isset($array_1[$p]) ? $array_1[$p] : '');
		}
		
		return $result;
    }
}

if ( ! function_exists('transform_array_1_1_1_inverse'))
{
    function transform_array_1_1_1_inverse($array = array(), $assoc_key_1 = '')
    {
		if( !is_array($array) or $assoc_key_1 == '')return array($assoc_key_1=>array());
		
		$result = array();
		$val_1 = array();
		foreach($array as $key=>$val)
		{
			$val_1[] = $val[$assoc_key_1];
		}
		
		$result = array($assoc_key_1=>$val_1);
		
		return $result;
    }
}

if ( ! function_exists('transform_array_1_2'))
{
    function transform_array_1_2($assoc_key_1 = '', $array_1 = array(), $assoc_key_2 = '', $array_2 = array(), $assoc_key_3 = '', $array_3 = array())
    {
		
		if( sizeof($array_1) != sizeof($array_2) Or sizeof($array_2) != sizeof($array_3) )return array();
		
		$result = array();
		for($p=0; $p<sizeof($array_1); $p++)
		{
			//if(!isset($array_1[$p]) /*Or !isset($array_2[$p]) Or !isset($array_3[$p])*/)continue;
			$result[$p] = array($assoc_key_1=>isset($array_1[$p]) ? $array_1[$p] : '', $assoc_key_2=>isset($array_2[$p]) ? $array_2[$p] : '', $assoc_key_3=>isset($array_3[$p]) ? $array_3[$p] : '');
		}
		
		return $result;
    }
}

if ( ! function_exists('transform_array_1_2_inverse'))
{
    function transform_array_1_2_inverse($array = array(), $assoc_key_1 = '', $assoc_key_2 = '', $assoc_key_3 = '')
    {
		if( !is_array($array) or $assoc_key_1 == '' or $assoc_key_2 == '' or $assoc_key_3 == '')return array($assoc_key_1=>array(), $assoc_key_2=>array(), $assoc_key_3=>array());
		
		$result = array();
		$val_1 = $val_2 = $val_3 = array();
		foreach($array as $key=>$val)
		{
			$val_1[] = $val[$assoc_key_1];
			$val_2[] = $val[$assoc_key_2];
			$val_3[] = $val[$assoc_key_3];
		}
		
		$result = array($assoc_key_1=>$val_1, $assoc_key_2=>$val_2, $assoc_key_3=>$val_3);
		
		return $result;
    }
}

if ( ! function_exists('transform_array_1_3'))
{
    function transform_array_1_3($assoc_key_1 = '', $array_1 = array(), $assoc_key_2 = '', $array_2 = array())
    {
		
		if( !is_array($array_1) )return array();
		
		$result = array();
		for($p=0; $p<sizeof($array_1); $p++)
		{
			//if(!isset($array_1[$p]) /*Or !isset($array_2[$p]) Or !isset($array_3[$p])*/)continue;
			$result[$p] = array($assoc_key_1=>isset($array_1[$p]) ? $array_1[$p] : '', $assoc_key_2=>isset($array_2[$p]) ? $array_2[$p] : '');
		}
		
		return $result;
    }
}


if ( ! function_exists('transform_array_1_3_inverse'))
{
    function transform_array_1_3_inverse($array = array(), $assoc_key_1 = '', $assoc_key_2 = '', $assoc_key_3 = '', $assoc_key_4 = '')
    {
		if( !is_array($array) or $assoc_key_1 == '' or $assoc_key_2 == '' or $assoc_key_3 == '' or $assoc_key_4 == '')return array($assoc_key_1=>array(), $assoc_key_2=>array(), $assoc_key_3=>array(), $assoc_key_4=>array());
		
		$result = array();
		$val_1 = $val_2 = $val_3 = $val_4 = array();
		foreach($array as $key=>$val)
		{
			$val_1[] = $val[$assoc_key_1];
			$val_2[] = $val[$assoc_key_2];
			$val_3[] = $val[$assoc_key_3];
			$val_4[] = $val[$assoc_key_4];
		}
		
		$result = array($assoc_key_1=>$val_1, $assoc_key_2=>$val_2, $assoc_key_3=>$val_3, $assoc_key_4=>$val_4);
		
		return $result;
    }
}

if ( ! function_exists('extra_bed_children_max_age_menu'))
{
    function extra_bed_children_max_age_menu()
    {
		
		$result = array('6'=> sprintf(lang('000000002401'), 6), '12'=>sprintf(lang('000000002401'), 12), '16'=>sprintf(lang('000000002401'), 16));
		
		return $result;
    }
}

if ( ! function_exists('create_user_title_menu'))
{
    function create_user_title_menu()
    {
        return array('mr'=>lang('000000002402'), 'ms'=>lang('000000002403'), 'mrs'=>lang('000000002404'));
    }
}

if ( ! function_exists('create_gender_menu'))
{
    function create_gender_menu()
    {
        return array(''=>lang('000000000206'), 'male'=>lang('000000002405'), 'female'=>lang('000000002406'), 'no'=>lang('000000002407'));
    }
}

if ( ! function_exists('create_dob_dates_menu'))
{
    function create_dob_dates_menu($start = 1, $end = 31)
    {
		$result = array(''=>'Day');
		for($i=$start; $i<=$end; $i++){
			$key = str_pad($i,2,"0",STR_PAD_LEFT);
			$result[$key] = $i;
		}
		return $result;
    }
}

if ( ! function_exists('create_dob_months_menu'))
{
    function create_dob_months_menu()
    {
		return array(''=>lang('000000002408'),'01'=>lang('000000002409'),'02'=>lang('000000002410'),'03'=>lang('000000002411'),'04'=>lang('000000002412'),'05'=>lang('000000002413'),'06'=>lang('000000002414'),'07'=>lang('000000002415'),'08'=>lang('000000002416'),'09'=>lang('000000002417'),'10'=>lang('000000002418'),'11'=>lang('000000002419'),'12'=>lang('000000002420'));
	
	}
}

if ( ! function_exists('create_dob_years_menu'))
{
    function create_dob_years_menu()
    {
		$year_now = date('Y');		
		$years = array(''=>'Year');
		for($y = $year_now; $y > $year_now - 70; $y--)
			$years[$y] = $y;
		return $years;	
    }
}

if ( ! function_exists('create_credit_card_expire_months_menu'))
{
    function create_credit_card_expire_months_menu()
    {
		return array(''=>lang('000000002408'),'01'=>lang('000000002409'),'02'=>lang('000000002410'),'03'=>lang('000000002411'),'04'=>lang('000000002412'),'05'=>lang('000000002413'),'06'=>lang('000000002414'),'07'=>lang('000000002415'),'08'=>lang('000000002416'),'09'=>lang('000000002417'),'10'=>lang('000000002418'),'11'=>lang('000000002419'),'12'=>lang('000000002420'));
	
	}
}

if ( ! function_exists('create_credit_card_expire_years_menu'))
{
    function create_credit_card_expire_years_menu()
    {
		$year_now = date('Y');		
		$expires_on_years = array(''=>'Year');
		for($y = $year_now; $y < $year_now + 7; $y++)
			$expires_on_years[$y] = $y;	
		return $expires_on_years;
    }
}

if ( ! function_exists('create_credit_card_type_menu'))
{
    function create_credit_card_type_menu()
    {
		return array(''=>lang('000000002421'), 'american_express'=>'American Express', 'visa'=>'Visa', 'master_card'=>'Euro/Mastercard', 'master_vitual_credit_card'=>'MasterCard (virtual credit card)');
    }
}

if ( ! function_exists('create_currency_menu'))
{
    function create_currency_menu()
    {
		return array('SAR'=>'SAR', 'USD'=>'USD', 'PKR'=>'PKR');
    }
}

if ( ! function_exists('create_filter_star_rating_menu'))
{
    function create_filter_star_rating_menu()
    {
		return array(lang('000000002422'), '5 '.lang('000000002423'),  sprintf(lang('000000002424'), 4), sprintf(lang('000000002424'), 3),sprintf(lang('000000002424'), 2));
    }
}

if ( ! function_exists('create_email_template_user_types_menu'))
{
	function create_email_template_user_types_menu()
	{
		return array('user'=>lang('000000002425'), 'client'=>lang('000000002426'), 'admin'=>lang('000000000096'));
	}
}

if ( ! function_exists('create_email_template_types_menu'))
{
	function create_email_template_types_menu($type = 'user')
	{
		$result['user']= array('user-signup'=>lang('000000002427'), 'user-password-reset'=>lang('000000002428'), 'user-password-reset-confirmation'=>lang('000000002429'), 'user-signup-verification'=>lang('000000002430'), 'user-signup-confirmation'=>lang('000000002431'), 'user-booking-room-order'=>'User booking room order', 'user-booking-hall-order'=>'User booking hall order', 'user-booking-istiraha-order'=>'User booking istiraha order', 'user-booking-chalet-order'=>'User booking chalet order');
		
		$result['client']= array('client-signup'=>lang('000000002433'), 'client-password-reset'=>lang('000000002434'), 'client-password-reset-confirmation'=>lang('000000002435'), 'client-add-property'=>lang('000000002436'), 'client-signup-verification'=>lang('000000002437'), 'client-signup-confirmation'=>lang('000000002438'), 'client-booking-room-order'=>'Client booking room order', 'client-booking-hall-order'=>'Client booking hall order', 'client-booking-istiraha-order'=>'Client booking istiraha order', 'client-booking-chalet-order'=>'Client booking chalet order');
		
		$result['admin']= array('admin-signup'=>lang('000000002440'), 'admin-password-reset'=>lang('000000002441'), 'admin-approve-property'=>lang('000000002442'));
		
		return $result[$type];
	}
}

if ( ! function_exists('email_access_key_menu'))
{
	function email_access_key_menu($type = 'user')
	{
		return create_email_template_types_menu($type);
	}
}

if ( ! function_exists('create_airport_from_type_menu'))
{
	function create_airport_from_type_menu()
	{
		return array(''=>lang('000000002421'), 'jeddah'=>lang('000000002522'), 'makkah'=>lang('000000002523'), 'madina'=>lang('000000002524'));
	}
}

if ( ! function_exists('create_transport_type_menu'))
{
	function create_transport_type_menu()
	{
		return array(''=>lang('000000002421'), 'airport-shuttle-by-property'=>lang('000000002443'), 'airport-shuttle-public'=>lang('000000002444'), 'bus'=>lang('000000002445'), 'car'=>lang('000000001653'), 'subway-metro'=>lang('000000002446'), 'taxi'=>lang('000000001435'), 'train'=>lang('000000001654'), 'tram'=>lang('000000002447'), 'ferry'=>lang('000000002448'), 'walking'=>lang('000000002449'));
	}
}

if ( ! function_exists('create_property_renting_month_menu'))
{
    function create_property_renting_month_menu()
    {
		return array(''=>lang('000000002408'),'01'=>lang('000000002409'),'02'=>lang('000000002410'),'03'=>lang('000000002411'),'04'=>lang('000000002412'),'05'=>lang('000000002413'),'06'=>lang('000000002414'),'07'=>lang('000000002415'),'08'=>lang('000000002416'),'09'=>lang('000000002417'),'10'=>lang('000000002418'),'11'=>lang('000000002419'),'12'=>lang('000000002420'));
	
	}
}

if ( ! function_exists('create_property_renovating_month_menu'))
{
    function create_property_renovating_month_menu()
    {
		return array(''=>lang('000000002408'),'01'=>lang('000000002409'),'02'=>lang('000000002410'),'03'=>lang('000000002411'),'04'=>lang('000000002412'),'05'=>lang('000000002413'),'06'=>lang('000000002414'),'07'=>lang('000000002415'),'08'=>lang('000000002416'),'09'=>lang('000000002417'),'10'=>lang('000000002418'),'11'=>lang('000000002419'),'12'=>lang('000000002420'));
	
	}
}

if ( ! function_exists('create_property_renovating_year_menu'))
{
    function create_property_renovating_year_menu()
    {
		$year_now = date('Y');		
		$years = array(''=>lang('000000002929'));
		for($y = $year_now; $y > $year_now - 118; $y--)
			$years[$y] = $y;
		return $years;	
    }
}

if ( ! function_exists('create_property_location_menu'))
{
    function create_property_location_menu()
    {
		return array("on_site"=>lang('000000000197'), "off_site"=>lang('000000000198'));
	}
}

if ( ! function_exists('create_property_profile_facility_menu'))
{
    function create_property_profile_facility_menu()
    {
		return array('All facilities'=>lang('000000002450'), 'Tennis Court'=>lang('000000000397'), 'Golf Course (within 2 miles)'=>lang('000000000411'), 'Facilities for Disabled Guests'=>lang('000000001542'), 'Family Rooms'=>lang('000000000476'), 'Buffet-style Restaurant'=>lang('000000000350'), 'Baby Safety Gates'=>lang('000000000381'), 'Kids TV Networks'=>lang('000000002451'), 'Secured Parking'=>lang('000000001888'), 'Electric Vehicle Charging Station'=>lang('000000001891'), 'Tickets to Attractions or Shows'=>lang('000000002452'), 'Airport Pick-up'=>lang('000000002453'), 'Airport Drop-off'=>lang('000000002454'));
		
	}
}

if ( ! function_exists('create_arrival_time_menu'))
{
	function create_arrival_time_menu($date)
	{
		$result = array();
		
		$current_date =	date('l, jS F Y', strtotime($date));
		$tomorrow_date = date('l, jS F Y', strtotime($current_date.'+ 1 day'));
		
		$result = array('-1'=>'I don\'t know');
		
		$result[$current_date] = array('0'=>'00:00 AM - 01:00 AM', '1'=>'01:00 AM - 02:00 AM', '2'=>'02:00 AM - 03:00 AM', '3'=>'03:00 AM - 04:00 AM', '4'=>'04:00 AM - 05:00 AM', '5'=>'05:00 AM - 06:00 AM', '6'=>'06:00 AM - 07:00 AM', '7'=>'07:00 AM - 08:00 AM', '8'=>'08:00 AM - 09:00 AM', '9'=>'09:00 AM - 10:00 AM', '10'=>'10:00 AM - 11:00 AM', '11'=>'11:00 AM - 12:00 PM', '12'=>'12:00 PM - 01:00 PM', '13'=>'01:00 PM - 02:00 PM', '14'=>'02:00 PM - 03:00 PM', '15'=>'03:00 PM - 03:00 PM', '16'=>'04:00 PM - 05:00 PM', '17'=>'05:00 PM - 06:00 PM', '18'=>'06:00 PM - 07:00 PM', '19'=>'07:00 PM - 08:00 PM', '20'=>'08:00 PM - 09:00 PM', '21'=>'09:00 PM - 10:00 PM', '22'=>'10:00 PM - 11:00 PM', '23'=>'11:00 PM - 12:00 AM');
		
		$result[$tomorrow_date] = array('24'=>'12:00 AM - 01:00 AM', '25'=>'01:00 AM - 02:00 AM');
		
		return $result;
	}
}

if ( ! function_exists('create_cancellation_interval_menu'))
{
	function create_cancellation_interval_menu()
	{
		return array(''=>lang('000000000206'), '1d'=>sprintf(lang('000000002455'), '1 day'), '2d'=>sprintf(lang('000000002455'), '2 days'), '3d'=>sprintf(lang('000000002455'), '3 days'), '5d'=>sprintf(lang('000000002455'), '5 days'), '7d'=>sprintf(lang('000000002455'), '7 days'), '14d'=>sprintf(lang('000000002455'), '14 days'), '30d'=>sprintf(lang('000000002455'), '30 days'), '42d'=>sprintf(lang('000000002455'), '42 days') , '60d'=>sprintf(lang('000000002455'), '60 days'));
	}
}

if ( ! function_exists('create_cancellation_fee_menu'))
{
	function create_cancellation_fee_menu()
	{
		return array(''=>lang('000000000206'), '100fn'=>lang('000000000511'), '10'=>sprintf(lang('000000002456'), 10), '30'=>sprintf(lang('000000002456'), 30), '50'=>sprintf(lang('000000002456'), 50), '60'=>sprintf(lang('000000002456'), 60), '70'=>sprintf(lang('000000002456'), 70));
	}
}

if ( ! function_exists('create_cancellation_interval_fee_menu'))
{
	function create_cancellation_interval_fee_menu()
	{
		return array(''=>lang('000000000206'), '30'=>sprintf(lang('000000002456'), 30), '50'=>sprintf(lang('000000002456'), 50), '60'=>sprintf(lang('000000002456'), 60), '70'=>sprintf(lang('000000002456'), 70), '90'=>sprintf(lang('000000002456'), 90), '100'=>sprintf(lang('000000002456'), 100));	//, '100fn'=>lang('000000000511')
	}
}

if ( ! function_exists('create_no_arrival_fee_menu'))
{
	function create_no_arrival_fee_menu()
	{
		return array('same_as_cancellation_fee'=>lang('000000002457'), 'full_charged'=>sprintf(lang('000000002456'), 100));	
	}
}

if ( ! function_exists('create_non_refundable_fee_menu'))
{
	function create_non_refundable_fee_menu()
	{
		return array('50'=>sprintf(lang('000000002456'), 50), '100'=>sprintf(lang('000000002456'), 100));	//'1fn'=>'the first night'
	}
}

if ( ! function_exists('create_prepayment_method_menu'))
{
	function create_prepayment_method_menu()
	{
		return array(''=>lang('000000002458'), 'bank_transfer'=>lang('000000002459'), 'credit_card'=>lang('000000001096'), 'paypal'=>'Paypal', 'other'=>lang('000000001643'));	
	}
}

if ( ! function_exists('create_prepayment_refund_days_menu'))
{
	function create_prepayment_refund_days_menu()
	{
		return array(''=>lang('000000002458'), '7'=>sprintf(lang('000000002460'), 7), '14'=>sprintf(lang('000000002460'), 14), '30'=>sprintf(lang('000000002460'), 30), '60'=>sprintf(lang('000000002460'), 60));	
	}
}

if ( ! function_exists('create_refund_fee_menu'))
{
	function create_refund_fee_menu()
	{
		$return = array(''=>'Please select');
		
		for($i = 1; $i < 100; $i++)
		{
			$return[$i] = $i. '% of the total price';
		}
		
		return $return;
	}
}

if ( ! function_exists('create_calendar_preset_menu'))
{
	function create_calendar_preset_menu()
	{
		return array('next_30'=>lang('000000002461'), 'upcoming_30'=>date('F Y',strtotime('first day of +1 month')), 'custom'=>lang('000000002462'));	
	}
}

if ( ! function_exists('create_calendar_month_dates_menu'))
{
	function create_calendar_month_dates_menu($start_date = '', $end_date = '')
	{
		$start_date	= strtotime($start_date);
		$end_date	= strtotime($end_date);
		
		$result = array();
		
		while($start_date <= $end_date){
			$date		= date("Y-m-d", $start_date);
			$month	= date("M Y", $start_date);
			$day_val	= date("d", $start_date);
			$day	= date("D", $start_date);
			
			$result[$month][]	= array('date'=>$date, 'day_val'=>$day_val, 'day_key'=>$day);
			$start_date 		= strtotime('+1 day', $start_date);
		}
		
		return $result;
	}
}

if ( ! function_exists('create_calendar_dates_menu'))
{
	function create_calendar_dates_menu($start_date = '', $end_date = '')
	{
		$start_date	= strtotime($start_date);
		$end_date	= strtotime($end_date);
		
		$result = array();
		
		while($start_date <= $end_date){
			$result[]	= date('Y-m-d', $start_date);
			$start_date = strtotime('+1 day', $start_date);
		}
		
		return $result;
	}
}

if ( ! function_exists('create_discount_type_menu'))
{
	function create_discount_type_menu()
	{
		return array('percent'=>'%', 'fixed'=>'SAR');
	}
}

if ( ! function_exists('create_discount_direction_menu'))
{
	function create_discount_direction_menu()
	{
		return array('-', '+');
	}
}

if ( ! function_exists('calculate_discount'))
{
	function calculate_discount($amount, $discount_amount, $discount_type, $discount_direction = false)
	{
		if($discount_type == 'percent')
		{
			$discount_amount = ($amount/100) * $discount_amount;	
		}
		
		if($discount_direction)
		{
			$amount = ($amount + $discount_amount);
		}
		else
		{
		$amount = ($amount - $discount_amount);
		}
		
		return $amount;
	}
}

if ( ! function_exists('create_customer_support_help_options_menu'))
{
	function create_customer_support_help_options_menu()
	{
		return array(''=>lang('000000002458'), 'Payment'=>lang('000000002463'), 'Booking confirmation'=>lang('000000002464'), 'Make changes'=>lang('000000002465'), 'Special requests'=>lang('000000002466'), 'Cancel my booking'=>lang('000000002467'), 'Cancellation questions'=>lang('000000002468'), 'Property details'=>lang('000000000183'), 'Website feedback'=>lang('000000002469'), 'Property reviews'=>lang('000000002470'), 'Edit guest details'=>lang('000000002471'), 'Other'=>lang('000000001643'));	
	}
}

if ( ! function_exists('setval'))
{
	function setval($data, $key)
	{
		return !empty($data[$key]) ? $data[$key] : '';
	}
}

if ( ! function_exists('parking_reservation_status'))
{
	function parking_reservation_status($str)
	{
		if($str == 'yes')
		{
			$str = lang('000000002472');
		}
		elseif($str == 'no')
		{
			$str = lang('000000002473');
		}
		elseif($str == 'not_available')
		{
			$str = lang('000000002474');
		}
		
		return $str;
	}
}

if ( ! function_exists('security_deposit_return_when'))
{
	function security_deposit_return_when($str)
	{
		if($str == 1)
		{
			$str = lang('000000002475');
		}
		elseif($str == 7)
		{
			$str = lang('000000002476');
		}
		elseif($str == 14)
		{
			$str = lang('000000002477');
		}
		
		return $str;
	}
}

if ( ! function_exists('create_security_deposit_return_days_menu'))
{
	function create_security_deposit_return_days_menu()
	{
		return array('0'=>lang('000000000206'), '1'=>lang('000000002475'), '7'=>lang('000000002476'), '14'=>lang('000000002477'));
	}
}

if ( ! function_exists('create_security_deposit_collect_return_method_menu'))
{
	function create_security_deposit_collect_return_method_menu()
	{
		return array(''=>lang('000000002458'), 'bank_transfer'=>lang('000000002459'), 'credit_card'=>lang('000000001096'), 'paypal'=>'Paypal', 'other'=>lang('000000001643'));	
	}
}

if ( ! function_exists('create_additional_services_menu'))
{
	function create_additional_services_menu()
	{
		return array(''=>lang('000000000206'), 'Service charge'=>lang('000000002478'), 'Resort fee'=>lang('000000002479'), 'Cleaning fee'=>lang('000000002030'), 'Towel fee'=>lang('000000002480'), 'Electricity fee'=>lang('000000002481'), 'Bed linens fee'=>lang('000000002482'), 'Gas fee'=>lang('000000002483'), 'Oil fee'=>lang('000000002484'), 'Wood fee'=>lang('000000002485'), 'Water usage fee'=>lang('000000002486'), 'Destination fee'=>lang('000000002487'), 'Environment fee'=>lang('000000002488'), 'Spa fee'=>lang('000000002489'), 'Shuttle fee'=>lang('000000002490'));
	}
}

if ( ! function_exists('create_existing_bed_max_age_menu'))
{
	function create_existing_bed_max_age_menu()
	{
		return array('12'=>sprintf(lang('000000002401'), 12), '16'=>sprintf(lang('000000002401'), 16), '6'=>sprintf(lang('000000002401'), 6));
	}
}

if ( ! function_exists('create_additional_amount_included_menu'))
{
	function create_additional_amount_included_menu()
	{
		return array('yes'=>lang('000000000013'), 'no'=>lang('000000000014'));
	}
}

if ( ! function_exists('create_additional_amount_unit_menu'))
{
	function create_additional_amount_unit_menu()
	{
		return array('N/A'=>lang('000000002493'), 'per_stay'=>lang('000000001752'), 'person_per_stay'=>lang('000000002494'), 'per_night'=>lang('000000002495'), 'person_per_night'=>lang('000000002496'), 'percent'=>'%', 'incalculable'=>lang('000000002497'));
	}
}

if ( ! function_exists('create_key_collection_from_menu'))
{
	function create_key_collection_from_menu()
	{
		return array(
			'unknown'=>lang('000000002421'),
			'reception'=>lang('000000002498'),
			'someone_will_meet'=>lang('000000002499'),
			'door_code'=>lang('000000002500'),
			'lock_box'=>lang('000000002501'),
			'secret_spot'=>lang('000000002502'),
			'other'=>lang('000000001643')
		);
	}
}

if ( ! function_exists('create_breakfast_food_item_menu'))
{
	function create_breakfast_food_item_menu()
	{
		return array('Bread'=>lang('000000002503'), 'Pastries'=>lang('000000000046'), 'Pancakes'=>lang('000000002505'), 'Jam'=>lang('000000002506'), 'Butter'=>lang('000000002507'), 'Cheese'=>lang('000000002508'), 'Cereal'=>lang('000000002509'), 'Cold meat'=>lang('000000002510'), 'Eggs'=>lang('000000002511'), 'Yogurt'=>lang('000000002512'), 'Fruit'=>lang('000000002513'), 'Coffee'=>lang('000000002514'), 'Tea'=>lang('000000002515'), 'Hot chocolate'=>lang('000000002516'), 'Fruit juice'=>lang('000000002517'), 'Champagne'=>lang('000000002518'), '� la carte menu'=>lang('000000002519'), 'Local specialities'=>lang('000000002520'), 'Cooked/warm meals'=>lang('000000002521'));	
	}
}

if ( ! function_exists('create_reservation_type_menu'))
{
	function create_reservation_type_menu()
	{
		return array(''=>'Any', 'booking'=>'Reservation', 'arrival'=>'Arrival', 'departure'=>'Departure', 'invoiced'=>'Invoice', 'stay'=>'Stay');	
	}
}

if ( ! function_exists('get_breadcrumb'))
{
    function get_breadcrumb()
    {
        $CI =& get_instance();
        $CI->config->load('breadcrumb');
		$CI->load->library('breadcrumb');
		$hide_breadcrumb = $CI->config->item('hide_breadcrumb') ;
		if($hide_breadcrumb == TRUE)return '';
		
		return $CI->breadcrumb->show();
	}
}

if ( ! function_exists('str_short'))
{
	function str_short($text, $maxchar = 20, $end = '...')
	{
		if (strlen($text) > $maxchar and $text == '')
		{
			$words = preg_split('/\s/', $text);      
			$output = '';
			$i      = 0;
			while (1)
			{
				$length = strlen($output)+strlen($words[$i]);
				if ($length > $maxchar)
				{
					break;
				} 
				else
				{
					$output .= " " . $words[$i];
					++$i;
				}
			}
			$output .= $end;
		} 
		else
		{
			$output = $text;
		}
		
		return $output;
	}
}

if ( ! function_exists('create_search_adults_menu'))
{
	function create_search_adults_menu($start = 1, $end = 30)
	{
		$result = array();
		
		for($i=$start; $i<=$end; $i++)
		{
			$result[$i] = $i .' '. ($i == 1 ? lang('000000002774') : lang('000000001207'));
		}
		
		return $result;	
	}
}

if ( ! function_exists('create_search_childrens_menu'))
{
	function create_search_childrens_menu($start = 1, $end = 10)
	{
		$result = array(''=>lang('000000002778'));
		
		for($i=$start; $i<=$end; $i++)
		{
			$result[$i] = $i .' '. ($i == 1 ? lang('000000002776') : lang('000000002775'));
		}
		
		return $result;	
	}
}

if ( ! function_exists('create_search_rooms_menu'))
{
	function create_search_rooms_menu($start = 1, $end = 30)
	{
		$result = array();
		
		for($i=$start; $i<=$end; $i++)
		{
			$result[$i] = $i .' '. ($i == 1 ? lang('000000002777') : lang('000000000112'));
		}
		
		return $result;	
	}
}

if ( ! function_exists('create_search_hall_seating_plan_menu'))
{
	function create_search_hall_seating_plan_menu()
	{
		return array(''=>lang('000000002421'), '1-100'=>'1 to 100', '100-200'=>'100 to 200', '200-300'=>'200 to 300', '300-400'=>'300 to 400', '400-500'=>'400 to 500', '500-600'=>'500 to 600', '600-700'=>'600 to 700', '700-800'=>'700 to 800', '800-900'=>'800 to 900', '900-1000'=>'900 to 1000');
	}
}

if ( ! function_exists('create_search_time_slots_menu'))
{
	function create_search_time_slots_menu()
	{
		return array(''=>'Time slot', '10am-3pm'=>'10am - 3pm', '5pm-11pm'=>'5pm - 11pm');
	}
}

if ( ! function_exists('get_review_score_status'))
{
	function get_review_score_status($score)
	{
		$status = '';
		if($score >= 1 and $score < 3)
			$status = lang('000000002779');
		elseif($score >= 3 and $score < 4)
			$status = lang('000000002780');
		elseif($score >= 4 and $score < 5)
			$status = lang('000000002781');
		elseif($score >= 5 and $score < 5.5)
			$status = lang('000000002782');
		elseif($score >= 5.5 and $score < 6)
			$status = lang('000000002783');
		elseif($score >= 6 and $score < 7)
			$status = lang('000000002748');
		elseif($score >= 7 and $score < 8)
			$status = lang('000000001305');
		elseif($score >= 8 and $score < 8.5)
			$status = lang('000000002784');
		elseif($score >= 8.5 and $score < 9)
			$status = lang('000000002785');
		elseif($score >= 9 and $score < 9.5)
			$status = lang('000000002786');
		elseif($score >= 9.5 and $score <= 10)
			$status = lang('000000002787');						
		
		return $status;					
	}
}

if ( ! function_exists('round_score'))
{
	function round_score($score)
	{
		$score = ($score + 0);
		return $score; 
	}
}

if ( ! function_exists('http_build_search_query'))
{
	function http_build_search_query($arr1 = false, $arr2 = false, $arr3 = false)
	{
		$arr = array();
		
		if(is_array($arr1) and is_array($arr2) and is_array($arr3))
		{
			$arr = array_merge($arr1, $arr2, $arr3);		
		}
		elseif(is_array($arr1) and is_array($arr2))
		{
			$arr = array_merge($arr1, $arr2);		
		}
		elseif(is_array($arr2) and is_array($arr3))
		{
			$arr = array_merge($arr2, $arr3);		
		}
		elseif(is_array($arr1))
		{
			$arr = $arr1;		
		}
		elseif(is_array($arr2))
		{
			$arr = $arr2;		
		}
		elseif(is_array($arr3))
		{
			$arr = $arr3;		
		}
		
		return http_build_query($arr);	
	}
}

if ( ! function_exists('get_country_zone_menu'))
{
	function get_country_zone_menu($country_id = 0)
	{
		$CI = &get_instance();
		$CI->load->model('admin/Admin_location_model');
		$result = $CI->Admin_location_model->get_zones_menu($country_id);
		
		if(!$result)
		{
			return FALSE;
		}
		
		return $result;
	}
}

if ( ! function_exists('create_yes_no_menu'))
{
	function create_yes_no_menu()
	{
		return array("no"=>lang('000000000014'), "yes"=>lang('000000000013'));
	}
}

if ( ! function_exists('round_number'))
{
	function round_number($val)
	{
		$val = ($val + 0);
		if($val == 0) 
		{
			return '';
		}
		
		return $val; 
	}
}

if ( ! function_exists('format_number'))
{
	function format_number($val)
	{
		$val = ($val + 0);
		return $val; 
	}
}

if ( ! function_exists('create_hall_time_slots_menu'))
{
	function create_hall_time_slots_menu()
	{
		return array(''=>'Select', 1=>'1 slot', 2=>'2 slots', 3=>'3 slots'); 	
	}
}

if ( ! function_exists('create_hall_start_time_slots_menu'))
{
	function create_hall_start_time_slots_menu()
	{
		return array(''=>'Start time', '07:00'=>'7:00 AM', '07:30'=>'7:30 AM', '08:00'=>'8:00 AM', '08:30'=>'8:30 AM', '09:00'=>'9:00 AM', '09:30'=>'9:30 AM', '10:00'=>'10:00 AM', '10:30'=>'10:30 AM', '11:00'=>'11:00 AM', '11:30'=>'11:30 AM', '12:00'=>'12:00 PM', '12:30'=>'12:30 PM', '13:00'=>'13:00 PM', '13:30'=>'13:30 PM', '14:00'=>'14:00 PM', '14:30'=>'14:30 PM', '15:00'=>'15:00 PM', '15:30'=>'15:30 PM', '16:00'=>'16:00 PM', '16:30'=>'16:30 PM', '17:00'=>'17:00 PM', '17:30'=>'17:30 PM', '18:00'=>'18:00 PM', '18:30'=>'18:30 PM', '19:00'=>'19:00 PM', '19:30'=>'19:30 PM', '20:00'=>'20:00 PM', '21:00'=>'21:00 PM', '21:30'=>'21:30 PM', '22:00'=>'22:00 PM', '22:30'=>'22:30 PM', '23:00'=>'23:00 PM');
	}
}

if ( ! function_exists('create_hall_end_time_slots_menu'))
{
	function create_hall_end_time_slots_menu()
	{
		return array(''=>'End time', '12:00'=>'12:00 PM', '12:30'=>'12:30 PM', '13:00'=>'13:00 PM', '13:30'=>'13:30 PM', '14:00'=>'14:00 PM', '14:30'=>'14:30 PM', '15:00'=>'15:00 PM', '15:30'=>'15:30 PM', '16:00'=>'16:00 PM', '16:30'=>'16:30 PM', '17:00'=>'17:00 PM', '17:30'=>'17:30 PM', '18:00'=>'18:00 PM', '18:30'=>'18:30 PM', '19:00'=>'19:00 PM', '19:30'=>'19:30 PM', '20:00'=>'20:00 PM', '20:30'=>'20:30 PM', '21:00'=>'21:00 PM', '21:30'=>'21:30 PM', '22:00'=>'22:00 PM', '22:30'=>'22:30 PM', '23:00'=>'23:00 PM', '23:30'=>'23:30 PM', '00:00'=>'12:00 AM', 
		);
	}
}

if ( ! function_exists('get_master_languages_sort_order_solr'))
{
	function get_master_languages_sort_order_solr()
	{
		$array =  array(
					'en-US'=>'0',
					'ar-SA'=>'1'
					);	
		
		return $array;
	}
}

if ( ! function_exists('get_custom_amenity_categories'))
{
	function get_custom_amenity_categories($culture_code = 'en-US')
	{
		$return['en-US'] = array(1000001=>'Hall', 1000002=>'Room', 1000003=>'Kitchen', 1000004=>'Playground', 1000005=>'Kids area', 1000006=>'Garden', );
		
		if(empty($return[$culture_code]))
		{
			return false;
		}
		
		return $return[$culture_code];
	}
}

if ( ! function_exists('create_custom_amenity_categories_menu'))
{
	function create_custom_amenity_categories_menu($culture_code = 'en-US')
	{
		$result = array(''=>lang('000000002421'));
		
		$culture_codes = get_custom_amenity_categories($culture_code);
		foreach($culture_codes as $key=>$val)
		{
			$result[$key] = $val;
		}
		
		return $result;
	}
}

if ( ! function_exists('create_review_sort_by_filter_menu'))
{
	function create_review_sort_by_filter_menu()
	{
		return array(''=>'Recommended', 'recent_desc'=>'Date (newer to older)', 'recent_asc'=>'Date (older to newer)', 'score_desc'=>'Score (higher to lower)', 'score_asc'=>'Score (lower to higher)'); ;
	}
}

if ( ! function_exists('get_common_policy'))
{
	function get_common_policy($child_policy, $property_policy)
	{	
        if( $child_policy == '-' and $property_policy == '-')
		{
			return false;
		}

        $policy_1 = $policy_2 = array();
		if(is_array($child_policy) or is_object($child_policy)):
        foreach($child_policy as $key=>$val)
		{
			$policy_1[$key] = $val;
		}
		endif;
			  
		if(is_array($property_policy) or is_object($property_policy)):
        foreach($property_policy as $key=>$val)
		{
			$policy_2[$key] = $val;
		}
		endif;
		
		$policy = array_merge($policy_2, $policy_1);
		
		return $policy;
	}
}

if ( ! function_exists('get_prepayment_percentage'))
{
	function get_prepayment_percentage($data = array())
	{
		if( !is_array($data) or empty($data) ) return false;
		
		$value = '';
		
		$is_non_refundable	= !empty($data['is_non_refundable']) ? $data['is_non_refundable'] : '';
		$non_refundable_fee = !empty($data['non_refundable_fee']) ? $data['non_refundable_fee'] : '';
		
		$is_refund_allowed	= !empty($data['is_refund_allowed']) ? $data['is_refund_allowed'] : '';
		$refund_fee 		= !empty($data['refund_fee']) ? $data['refund_fee'] : '';
		
		$is_free_cancel 	= !empty($data['is_free_cancel']) ? $data['is_free_cancel'] : '';
		$cancellation_fee 	= !empty($data['cancellation_fee']) ? $data['cancellation_fee'] : '';
		$interval 			= !empty($data['cancellation_interval']) ? $data['cancellation_interval'] : '';
		$interval_fee 		= !empty($data['cancellation_interval_fee']) ? $data['cancellation_interval_fee'] : '';
		
		$is_prepayment 		= !empty($data['is_prepayment']) ? $data['is_prepayment'] : '';
		
		if($is_prepayment != 'yes') return;
		
		if($is_non_refundable == 'yes')
		{
			$value = $non_refundable_fee;	
		}
		elseif($is_free_cancel == 'yes')
		{
			$value = $interval_fee;	
		}
		if($is_free_cancel == 'no')
		{
			$value = $cancellation_fee;	
		}
		
		return $value;
	}
}

if ( ! function_exists('get_cancellation_fee_percentage'))
{
	function get_cancellation_fee_percentage($data = array(), $order_date = false)
	{
		if(empty($data)) return;
		
		$value	= 0;
		$data	= (array)$data;
		
		$is_non_refundable	= !empty($data['is_non_refundable']) ? $data['is_non_refundable'] : '';
		$non_refundable_fee = !empty($data['non_refundable_fee']) ? $data['non_refundable_fee'] : '';
		
		$is_refund_allowed	= !empty($data['is_refund_allowed']) ? $data['is_refund_allowed'] : '';
		$refund_fee 		= !empty($data['refund_fee']) ? $data['refund_fee'] : '';
		
		$is_free_cancel 	= !empty($data['is_free_cancel']) ? $data['is_free_cancel'] : '';
		$cancellation_fee 	= !empty($data['cancellation_fee']) ? $data['cancellation_fee'] : '';
		$interval 			= !empty($data['cancellation_interval']) ? $data['cancellation_interval'] : '';
		$interval_fee 		= !empty($data['cancellation_interval_fee']) ? $data['cancellation_interval_fee'] : '';
		
		$is_prepayment 		= !empty($data['is_prepayment']) ? $data['is_prepayment'] : '';
		
		$days				= str_replace('d', '', $interval);
		$interval_date		= format_date($order_date, 11, $days);
		$interval_days		= ($days == 1 ? $days .' day' : $days .' days');
		
		$date	= date('Y-m-d');
		//$date	= '2018-06-30';
		
		if($is_non_refundable == 'yes')
		{
			$value	= $non_refundable_fee;
		}
		elseif($is_free_cancel == 'no')
		{
			$value	= $cancellation_fee;	
		}
		elseif($is_free_cancel == 'yes' and strtotime($date) <= strtotime($interval_date))
		{
			$value	= 0;
		}
		elseif($is_free_cancel == 'yes' and $is_refund_allowed == 'yes' and strtotime($date) >= strtotime($interval_date))
		{
			$value	= $refund_fee;
		}
		else
		{
			$value	= $interval_fee;
		}
		
		return $value;
	}
}

if ( ! function_exists('create_cancellation_survey_found_better_place_other_menu'))
{
	function create_cancellation_survey_found_better_place_other_menu()
	{
		return array(''=>'- Please tell us what you liked better -', 'found_better_place_cheaper'=>'It was cheaper', 'found_better_place_better_location'=>'It had a better location', 'found_better_place_better_facilities'=>'It had better facilities', 'found_better_place_payment_facilities'=>'It was easier to pay for', 'found_better_place_other_other'=>'Other');	
	}
}

if ( ! function_exists('create_cancellation_survey_needed_to_change_menu'))
{
	function create_cancellation_survey_needed_to_change_menu()
	{
		return array(''=>'- Please select what you want to change -', 'wanted_to_change_dates'=>'The dates of the reservation', 'wanted_to_change_party_size'=>'The amount of guests staying', 'wanted_to_change_room_type'=>'A different or better room type', 'wanted_to_request_checkin_times'=>'Earlier or later check-in times', 'wanted_to_request_parking'=>'Add a parking spot', 'wanted_to_request_bed_change'=>'Request a double or twin bed', 'wanted_to_request_other'=>'Other');	
	}
}