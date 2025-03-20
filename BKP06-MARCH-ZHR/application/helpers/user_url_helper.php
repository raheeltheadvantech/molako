<?php defined('BASEPATH') OR exit('No direct script access allowed');
if ( ! function_exists('assets_url'))
{
function assets_url($uri)
{
	$CI =& get_instance();
	
	return $CI->config->site_url('assets/'.$CI->config->item('user_assets').'/'.$uri);
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
				$icon 		= '<i class="icon-chevron-up"></i>';
			}
			else
			{
				$order_by 	= 'asc';
				$icon 		= '<i class="icon-chevron-down"></i>';
			}
		}
		else
		{
			$order_by 	= 'asc';
			$icon 		= '';
		}
		//var_dump($CI->input->server('QUERY_STRING'));
		
		$ignore = array('code', 'sort', 'order');
		$QS = '';
		$QSV = $CI->input->get(null, false);
		
		if(!empty($QSV)):
		$QS = '';
		foreach($QSV as $key=>$val)
		{
			if(in_array($key, $ignore))
			{
				continue;
			}
			
			$QS[] = $key.'='.$val;
		}
		
		if(!empty($QS) and is_array($QS))
		{
			$QS = '&'.implode('&', $QS);
		}
		endif;
		
		
		$return 	= site_url($url .'?order='. $db_column .'&sort='. $order_by .'&code='. $code.''.$QS);
		$lan_val 	= lang($lang_key);
		$lang_text 	= (!empty($lan_val) ? lang($lang_key) : $lang_key);
		
		echo '<a href="' .$return. '">' .$lang_text . $icon. '</a>';
	}
}

function href_product($product, $params = array())
{
	if(empty($product) or !is_object($product))
	{
		return false;
	}
	
    $CI =& get_instance();
	//is_object($product) or $product = (array)$product;
	// $url = site_url('catalog/product-detail.html?product_id='.$product->product_id);
	$url = site_url('catalog/'.$product->product_slug.'.html');
	
	// if($CI->config->item('rewrite_product_route'))
	// {
	// 	$slug = url_slug($product->product_name, '-', TRUE);
	// 	$url = site_url('p/'.$product->product_id .'-'. $slug).'.html';
	// }
	
	return $url;
}

function href_category($category, $params = array())
{

   // echo '<pre>';print_r($category);die();

	if(empty($category))
	{
		return false;
	}

	$QS1 = '?category_id='.$category['category_id'];

	
    $CI =& get_instance();
	$url = site_url('catalog.html'.$QS1);

	// if($CI->config->item('rewrite_category_route'))
	// {
	// 	$slug = url_slug($category['name'], '-', TRUE);
	// 	// $url = site_url('c/'.$category['category_id'] .'-'. $slug).'.html';
	// 	$url = './c/'.$category['category_id'] .'-'. $slug.'.html';
	// }
	
	return $url;
}

function href_brand($brand, $params = array())
{
	if(empty($brand) or !is_object($brand))
	{
		return false;
	}
	
    $CI =& get_instance();
	$url = 'catalog.html?layout_id=2&brand_id='.$brand->brand_id;

	/*if(isset($params['category_id']) && !empty($params['category_id'])){
		$url .= '&ref_cat_id='. $params['category_id'];
	}
	
	$url = site_url($url);*/
	
	if($CI->config->item('rewrite_brand_route'))
	{
		$slug = url_slug($brand->name, '-', TRUE);
	//	$url = site_url('c/'.$brand->brand_id .'-'. $slug).'.html';
		$url = './b/'.$brand->brand_id .'-'. $slug.'.html';
	}
	
	return $url;
}

function href_page($page, $params = array())
{
	if(empty($page) or !is_object($page))
	{
		return false;
	}
	
    $CI =& get_instance();
	$url = 'pages/'.$page->slug.'.html';

	if($CI->config->item('rewrite_page_route'))
	{
		$slug = $page->slug;
		//$slug = url_slug($page->name, '-', TRUE);
	//	$url = site_url($page->id .'-'. $slug).'.html';
		$url = 'pages/'.$slug.'.html';
	}
	
	return $url;
}

if ( ! function_exists('url_slug'))
{
	function url_slug($str, $separator = '-', $lowercase = true) {
	// Make sure string is in UTF-8 and strip invalid UTF-8 characters
	$str = mb_convert_encoding((string)$str, 'UTF-8', mb_list_encodings());
	
	$defaults = array(
		'delimiter' => $separator,
		'limit' => null,
		'lowercase' => $lowercase,
		'replacements' => array(),
		'transliterate' => false,
	);
	
	// Merge options
	$options = $defaults;
	
	$char_map = array(
		// Latin
		'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A', 'Å' => 'A', 'Æ' => 'AE', 'Ç' => 'C', 
		'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I', 'Ï' => 'I', 
		'Ð' => 'D', 'Ñ' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ő' => 'O', 
		'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U', 'Û' => 'U', 'Ü' => 'U', 'Ű' => 'U', 'Ý' => 'Y', 'Þ' => 'TH', 
		'ß' => 'ss', 
		'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a', 'å' => 'a', 'æ' => 'ae', 'ç' => 'c', 
		'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i', 'ï' => 'i', 
		'ð' => 'd', 'ñ' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ő' => 'o', 
		'ø' => 'o', 'ù' => 'u', 'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ű' => 'u', 'ý' => 'y', 'þ' => 'th', 
		'ÿ' => 'y',
		// Latin symbols
		'©' => '(c)',
		// Greek
		'Α' => 'A', 'Β' => 'B', 'Γ' => 'G', 'Δ' => 'D', 'Ε' => 'E', 'Ζ' => 'Z', 'Η' => 'H', 'Θ' => '8',
		'Ι' => 'I', 'Κ' => 'K', 'Λ' => 'L', 'Μ' => 'M', 'Ν' => 'N', 'Ξ' => '3', 'Ο' => 'O', 'Π' => 'P',
		'Ρ' => 'R', 'Σ' => 'S', 'Τ' => 'T', 'Υ' => 'Y', 'Φ' => 'F', 'Χ' => 'X', 'Ψ' => 'PS', 'Ω' => 'W',
		'Ά' => 'A', 'Έ' => 'E', 'Ί' => 'I', 'Ό' => 'O', 'Ύ' => 'Y', 'Ή' => 'H', 'Ώ' => 'W', 'Ϊ' => 'I',
		'Ϋ' => 'Y',
		'α' => 'a', 'β' => 'b', 'γ' => 'g', 'δ' => 'd', 'ε' => 'e', 'ζ' => 'z', 'η' => 'h', 'θ' => '8',
		'ι' => 'i', 'κ' => 'k', 'λ' => 'l', 'μ' => 'm', 'ν' => 'n', 'ξ' => '3', 'ο' => 'o', 'π' => 'p',
		'ρ' => 'r', 'σ' => 's', 'τ' => 't', 'υ' => 'y', 'φ' => 'f', 'χ' => 'x', 'ψ' => 'ps', 'ω' => 'w',
		'ά' => 'a', 'έ' => 'e', 'ί' => 'i', 'ό' => 'o', 'ύ' => 'y', 'ή' => 'h', 'ώ' => 'w', 'ς' => 's',
		'ϊ' => 'i', 'ΰ' => 'y', 'ϋ' => 'y', 'ΐ' => 'i',
		// Turkish
		'Ş' => 'S', 'İ' => 'I', 'Ç' => 'C', 'Ü' => 'U', 'Ö' => 'O', 'Ğ' => 'G',
		'ş' => 's', 'ı' => 'i', 'ç' => 'c', 'ü' => 'u', 'ö' => 'o', 'ğ' => 'g', 
		// Russian
		'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'Yo', 'Ж' => 'Zh',
		'З' => 'Z', 'И' => 'I', 'Й' => 'J', 'К' => 'K', 'Л' => 'L', 'М' => 'M', 'Н' => 'N', 'О' => 'O',
		'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T', 'У' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',
		'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sh', 'Ъ' => '', 'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'Yu',
		'Я' => 'Ya',
		'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'ж' => 'zh',
		'з' => 'z', 'и' => 'i', 'й' => 'j', 'к' => 'k', 'л' => 'l', 'м' => 'm', 'н' => 'n', 'о' => 'o',
		'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't', 'у' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'c',
		'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sh', 'ъ' => '', 'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu',
		'я' => 'ya',
		// Ukrainian
		'Є' => 'Ye', 'І' => 'I', 'Ї' => 'Yi', 'Ґ' => 'G',
		'є' => 'ye', 'і' => 'i', 'ї' => 'yi', 'ґ' => 'g',
		// Czech
		'Č' => 'C', 'Ď' => 'D', 'Ě' => 'E', 'Ň' => 'N', 'Ř' => 'R', 'Š' => 'S', 'Ť' => 'T', 'Ů' => 'U', 
		'Ž' => 'Z', 
		'č' => 'c', 'ď' => 'd', 'ě' => 'e', 'ň' => 'n', 'ř' => 'r', 'š' => 's', 'ť' => 't', 'ů' => 'u',
		'ž' => 'z', 
		// Polish
		'Ą' => 'A', 'Ć' => 'C', 'Ę' => 'e', 'Ł' => 'L', 'Ń' => 'N', 'Ó' => 'o', 'Ś' => 'S', 'Ź' => 'Z', 
		'Ż' => 'Z', 
		'ą' => 'a', 'ć' => 'c', 'ę' => 'e', 'ł' => 'l', 'ń' => 'n', 'ó' => 'o', 'ś' => 's', 'ź' => 'z',
		'ż' => 'z',
		// Latvian
		'Ā' => 'A', 'Č' => 'C', 'Ē' => 'E', 'Ģ' => 'G', 'Ī' => 'i', 'Ķ' => 'k', 'Ļ' => 'L', 'Ņ' => 'N', 
		'Š' => 'S', 'Ū' => 'u', 'Ž' => 'Z',
		'ā' => 'a', 'č' => 'c', 'ē' => 'e', 'ģ' => 'g', 'ī' => 'i', 'ķ' => 'k', 'ļ' => 'l', 'ņ' => 'n',
		'š' => 's', 'ū' => 'u', 'ž' => 'z'
	);
	
	// Make custom replacements
	$str = preg_replace(array_keys($options['replacements']), $options['replacements'], $str);
	
	// Transliterate characters to ASCII
	if ($options['transliterate']) {
		$str = str_replace(array_keys($char_map), $char_map, $str);
	}
	
	// Replace non-alphanumeric characters with our delimiter
	$str = preg_replace('/[^\p{L}\p{Nd}]+/u', $options['delimiter'], $str);
	
	// Remove duplicate delimiters
	$str = preg_replace('/(' . preg_quote($options['delimiter'], '/') . '){2,}/', '$1', $str);
	
	// Truncate slug to max. characters
	$str = mb_substr($str, 0, ($options['limit'] ? $options['limit'] : mb_strlen($str, 'UTF-8')), 'UTF-8');
	
	// Remove delimiter from ends
	$str = trim($str, $options['delimiter']);
	
	return $options['lowercase'] ? mb_strtolower($str, 'UTF-8') : $str;
	}
}
