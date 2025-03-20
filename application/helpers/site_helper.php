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

if (!function_exists('get_base_product_query')) {
    function get_base_product_query($db, $select = '') {
        $select = !empty($select) ? $select . ", " : "";

        $db->select("
            p.*,
            $select
            CASE 
                WHEN NOT EXISTS (SELECT 1 FROM " . $db->dbprefix('product_option_value') . " pov WHERE pov.product_id = p.product_id) 
                THEN p.sale_price
                ELSE (
                    SELECT MIN(pov.price) 
                    FROM " . $db->dbprefix('product_option_value') . " pov 
                    WHERE pov.product_id = p.product_id
                )
            END AS sale_price,

            CASE 
                WHEN NOT EXISTS (SELECT 1 FROM " . $db->dbprefix('product_option_value') . " pov WHERE pov.product_id = p.product_id) 
                THEN COALESCE(
                    CASE 
                        WHEN b.is_enabled = 1 
                        AND b.dis_val > 0 
                        AND CURDATE() BETWEEN b.dis_sdate AND b.dis_edate 
                        THEN 
                            CASE 
                                WHEN b.dis_mode = 'fixed' THEN (p.sale_price - b.dis_val)
                                WHEN b.dis_mode = 'per' THEN (p.sale_price - (p.sale_price * b.dis_val / 100))
                                ELSE p.sale_price
                            END
                        ELSE p.sale_price
                    END,
                    (SELECT sp.price 
                     FROM " . $db->dbprefix('product_special_price') . " sp 
                     WHERE sp.product_id = p.product_id 
                     AND CURDATE() BETWEEN sp.start_date AND sp.end_date 
                     LIMIT 1),
                    p.sale_price
                )
                ELSE 
                    (SELECT MIN(
                        CASE 
                            WHEN pov.dis_val > 0 AND CURDATE() BETWEEN pov.dis_sdate AND pov.dis_edate 
                            THEN 
                                CASE 
                                    WHEN pov.dis_mode = 'fixed' THEN (pov.price - pov.dis_val)
                                    WHEN pov.dis_mode = 'per' THEN (pov.price - (pov.price * pov.dis_val / 100))
                                    ELSE pov.price
                                END
                            ELSE pov.price
                        END
                    ) 
                    FROM " . $db->dbprefix('product_option_value') . " pov
                    WHERE pov.product_id = p.product_id)
            END AS final_price,

            GROUP_CONCAT(DISTINCT pi.image ORDER BY pi.id ASC SEPARATOR ', ') AS images
        ");

        $db->from($db->dbprefix('products') . ' as p');
        $db->join($db->dbprefix('brands') . ' as b', 'p.brand_id = b.brand_id', 'left');
        $db->join($db->dbprefix('product_images') . ' as pi', 'pi.product_id = p.product_id', 'left');

        return $db;
    }
}












    if (!function_exists('get_current_price')) {
    function get_current_price($product_id)
    {
        // Get CI instance
        $ci = get_instance();
        $ci->load->database();

        $ci->db->select("
            COALESCE(
                (CASE 
                    WHEN dp.product_id IS NOT NULL AND CURDATE() BETWEEN dp.from_date AND dp.to_date THEN dp.price 
                    ELSE NULL 
                END),
                (CASE 
                    WHEN sp.product_id IS NOT NULL AND CURDATE() BETWEEN sp.start_date AND sp.end_date THEN sp.price 
                    ELSE NULL 
                END),
                (
                    SELECT MIN(
                        CASE 
                            WHEN pov.dis_mode = 'fixed' AND NOW() BETWEEN pov.dis_sdate AND pov.dis_edate THEN pov.price - pov.dis_val
                            WHEN pov.dis_mode = 'per' AND NOW() BETWEEN pov.dis_sdate AND pov.dis_edate THEN pov.price - (pov.price * pov.dis_val / 100)
                            ELSE pov.price 
                        END
                    ) 
                    FROM ci_product_option_value pov 
                    WHERE pov.product_id = p.product_id 
                        AND pov.price > 0 
                        AND pov.quantity > 0
                ),
                p.sale_price
            ) AS final_price
        ");

        $ci->db->from("ci_products p");
        $ci->db->join("ci_product_special_price sp", "sp.product_id = p.product_id", "left");
        $ci->db->join("ci_discount_prices dp", "dp.product_id = p.product_id", "left");

        $ci->db->where("p.product_id", $product_id);
        $ci->db->where("p.is_enabled", 1);

        $query = $ci->db->get();
        $result = $query->row();

        return $result ? $result->final_price : 0; // Agar koi price nahi mili to 0 return karega
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






