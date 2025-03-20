<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('custom_redirect'))
{
    function custom_redirect($url, $permanent = false) {
    if (!headers_sent()) {
        header('Location: ' . $url, true, $permanent ? 301 : 302);
        exit();
    } else {
        echo "<script>window.location.href='$url';</script>";
        exit();
    }
}

}
if ( ! function_exists('isMobile'))
{ 
    function isMobile() {
    // Check if the user agent contains mobile-related keywords
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $mobileKeywords = array('iPhone', 'Android', 'webOS', 'BlackBerry', 'iPod', 'Windows Phone', 'Mobile', 'Opera Mini');

    foreach ($mobileKeywords as $keyword) {
        if (strpos($userAgent, $keyword) !== false) {
            return true; // Mobile device detected
        }
    }
}
}
if ( ! function_exists('live_img_url'))
{ 
    function live_img_url() {
        $ci = get_instance();
return $ci->config->item('img_url');
}
}
if ( ! function_exists('prepair_cols_data'))
{
	function prepair_cols_data($k, $v)
	{
		$def = array('int'=>0, 'dash'=>'-', 'str'=>'No Name', 'float'=>'0.00');
		
		$cols['int'] = array('distributor_id', 'manufacturer_id', 'category_id', 'diameter', );
		
		$cols['dash'] = array('distributor_name', 'manufacturer_name', 'category_name', 'product_name', 'part_number', 'size', 'image', );
		
		$cols['str'] = array('back_space', 'max_load', 'center_cap_part_number', 'product_availability_date', 'short_description', 'long_description', 'unit_of_meas', 'lug_count', 'offset', 'upc', 'inv_order_type', 'rear_only', 'hub_clearance', 'hub_bore', 'barrel_config', 'cap_hardware', 'qty_of_cap_screws', 'cap_wrench', 'max_offset', 'min_offset', 'cap_style', 'cap_length', 'cap_assembly', 'display_model_number', 'whl_model_number', 'full_model_name', 'country_of_origin', 'abrv_finish_desc', 'weight_unit', 'bolt_pattern', 'maximum_rim_width', 'max_dual_imperial_load', 'maximum_inflate_load', 'stamped_max_single_inflate', 'keywords', 'warranty', 'style', 'discontinued', 'finish', 'inner_finish', 'outer_finish', 'lip_bead_lock', 'series', 'sidewall', 'tread_depth', 'construction', 'load_range', 'speed_rating', 'type', 'use_application', );
		
		$cols['float'] = array('height', 'length', 'unit_of_meas', 'sale_price', 'special_price', 'size', 'lug_count', 'offset', 'load_rating_lbs', 'load_rating_kgs', 'width', 'weight', 'weight_unit', 'bolt_pattern', 'center_bore', );
		
		
		foreach($cols as $key=>$val)
		{
			if(in_array($k, $val))
			{
				if(is_null($v) or empty($v))
				{
					$v = $def[$key];
				}
				
				break;
			}
		}
		
		return $v;
	}
}
function wite_nav_curl()
{
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => base_url().'/test.html',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Cookie: _u_secure=p3kahofqeftqevs9cp91ort28hcakit4'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
return  $response;
}
function wite_nav()
{
    $desktop = create_navigation_html(array(),1);
    write_html_to_file($desktop,'desk_nav.html');
    $desktop = create_mobile_navigation_html(array(),1);
    write_html_to_file($desktop,'mbl_nav.html');
}
function write_html_to_file($html,$path) {
    // File ka path jahan HTML likhna hai
    $file_path = FCPATH . '/cache/'.$path; 
    
    // File open karo aur likho
    if (file_put_contents($file_path, $html)) {
        return "HTML successfully written to file: " . $file_path;
    } else {
        return "Failed to write HTML to file.";
    }
}

if ( ! function_exists('get_image_extension'))
{
	function get_image_extension($file = '')
	{
		if($file == '')
		{
			return false;
		}
		
		$filename = basename($file);
		$file_extension = strtolower(substr(strrchr($filename, "."), 1));
		
		switch( $file_extension )
		{
			case "gif": $ctype="image/gif"; break;
			case "png": $ctype="image/png"; break;
			case "jpeg":
			case "jpg": $ctype="image/jpeg"; break;
			case "svg": $ctype="image/svg+xml"; break;
			default:
		}
		
		return $ctype;
	}
}

if ( ! function_exists('get_image'))
{
	function get_image($image_url = '')
	{
		if($image_url == '')
		{
			return false;
		}
		
		//$ext = get_image_extension($image_url);
		//header('Content-Type: ' . $ext);
		
		$url = $image_url;
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HEADER, false);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.11 (KHTML, like Gecko) Chrome/23.0.1271.1 Safari/537.11');
		$res = curl_exec($ch);
		$rescode = curl_getinfo($ch, CURLINFO_HTTP_CODE); 
		curl_close($ch);
		
		return $res;
	}
}


if ( ! function_exists('create_product_image_html'))
{
    function create_product_image_html($val , $size , $crop , $width=200 , $height=200 , $imgclass)
    {

        $CI =& get_instance();

       $no_img =  $CI->site_config->item('config_placeholder_small');
        $main_image = base_url($CI->site_config->item('config_placeholder_small'));

        $imagepath = '/images/products/'.$size.'/';
        $imagepath2 = '/images/products/'.$size.'/';

        if(!empty($val->images)) {

            $images = $val->images;

            if (!empty($images[0])) {
                $local_image = basename($images[0]);

                if (file_exists($imagepath . $local_image) && filesize($imagepath . $local_image) > 282) {

                    if($crop)
                        $main_image = base_url('images/image.php?width='.$width.'&height='.$height.'&image=' . $imagepath2 . $local_image);
                        else
                        $main_image = base_url($imagepath . $local_image);

                }


            }
        }
        else{
            $main_image = base_url('images/image.php?width='.$width.'&height='.$height.'&image=' . '/techcity/' . $no_img);
        }

        $image_html = '<img src="'.$main_image.'" alt="'.$val->product_name.'" title="'.$val->product_name.'" width="'.$width.'" height="'.$height.'" class="'.$imgclass.'"/>';

        return $image_html;
    }
}
if ( ! function_exists('create_product_otion_image'))
{
    function create_product_otion_image($img , $size , $crop , $width=200 , $height=200 , $imgclass)
    {

        $CI =& get_instance();

       $no_img =  $CI->site_config->item('config_placeholder_small');
        $main_image = base_url($CI->site_config->item('config_placeholder_small'));

        $imagepath = '/images/products/'.$size.'/';
        $imagepath2 = '/images/products/'.$size.'/';

        if(!empty($img)) {

            $images = $img;

            if (!empty($img)) {
                $local_image = basename($img);

                if (file_exists($imagepath . $local_image) && filesize($imagepath . $local_image) > 282) {

                    if($crop)
                        $main_image = base_url('images/image.php?width='.$width.'&height='.$height.'&image=' . $imagepath2 . $local_image);
                        else
                        $main_image = base_url($imagepath . $local_image);

                }


            }
        }
        else{
            $main_image = base_url('images/image.php?width='.$width.'&height='.$height.'&image=' . '/techcity/' . $no_img);
        }

        $image_html = '<img src="'.$main_image.'" alt="'.$val->product_name.'" title="'.$val->product_name.'" width="'.$width.'" height="'.$height.'" class="'.$imgclass.'"/>';

        return $image_html;
    }
}


if ( ! function_exists('create_product_detail_image_html'))
{
    function create_product_detail_image_html($image , $size , $crop , $width=200 , $height=200 , $imgclass)
    {

        $CI =& get_instance();

        $no_img =  $CI->site_config->item('config_placeholder_small');
        $main_image = base_url($CI->site_config->item('config_placeholder_small'));
        $imagepath = 'images/products/'.$size.'/';
        $imagepath2 = '/techcity/images/products/'.$size.'/';

            if (!empty($image)) {

                $local_image = basename($image);

                if (file_exists($imagepath . $local_image) && filesize($imagepath . $local_image) > 282) {

                    if($crop)
                        $main_image = base_url('images/image.php?width='.$width.'&height='.$height.'&image=' . $imagepath2 . $local_image);
                    else
                        $main_image = base_url($imagepath . $local_image);

                }
            }
            else{
                $main_image = base_url('images/image.php?width='.$width.'&height='.$height.'&image=' . '/techcity/' . $no_img);
            }

        $image_html = '<img src="'.$main_image.'" alt="" title="" width="'.$width.'" height="'.$height.'" class="'.$imgclass.'"/>';

        return $image_html;
    }
}


if ( ! function_exists('create_product_detail_image_path'))
{
    function create_product_detail_image_path($image , $size )
    {

        $CI =& get_instance();

        $main_image = base_url($CI->site_config->item('config_placeholder_small'));

        $imagepath = 'images/products/'.$size.'/';

            if (!empty($image)) {
                $local_image = basename($image);

                if (file_exists($imagepath . $local_image) && filesize($imagepath . $local_image) > 282) {

                        $main_image = base_url($imagepath . $local_image);

                }

            }

        return $main_image;
    }
}
if (!function_exists('dd')) {
    /**
     * Dump and Die
     * @param mixed ...$vars
     * @return void
     */
    function dd($vars)
    {
        echo '<pre>';
        var_dump($vars);
        echo '</pre>';
        die();
    }
}






