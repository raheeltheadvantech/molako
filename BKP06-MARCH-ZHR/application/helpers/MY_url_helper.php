<?php defined('BASEPATH') OR exit('No direct script access allowed');

function ssl_support()
{
	$CI =& get_instance();
    return (boolean)$CI->config->item('ssl_support');
}

if ( ! function_exists('force_ssl'))
{
	function force_ssl()
	{
		if (ssl_support() &&  (!isset($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == 'off'))
		{
			$CI =& get_instance();
			$CI->config->config['base_url'] = str_replace('http://', 'https://', $CI->config->config['base_url']);
			redirect($CI->uri->uri_string());
		}
	}
}

if ( ! function_exists('remove_ssl'))
{
	function remove_ssl()
	{	
		if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on')
		{
			$CI =& get_instance();
			$CI->config->config['base_url'] = str_replace('https://', 'http://', $CI->config->config['base_url']);
			
			redirect($CI->uri->uri_string());
		}
	}
}

function current_url()
{
    $CI =& get_instance();

    $url = $CI->config->site_url($CI->uri->uri_string());
    return $_SERVER['QUERY_STRING'] ? $url.'?'.$_SERVER['QUERY_STRING'] : $url;
}

// ------------------------------------------------------------------------

if ( ! function_exists('redirect_1'))
{
	/**
	 * Header Redirect
	 *
	 * Header redirect in two flavors
	 * For very fine grained control over headers, you could use the Output
	 * Library's set_header() function.
	 *
	 * @param	string	$uri	URL
	 * @param	string	$method	Redirect method
	 *			'auto', 'location' or 'refresh'
	 * @param	int	$code	HTTP Response status code
	 * @return	void
	 */
	function redirect_1($uri = '', $method = 'auto', $code = NULL)
	{
		if ( ! preg_match('#^(\w+:)?//#i', $uri))
		{
			$uri = site_url($uri);
		}

		// IIS environment likely? Use 'refresh' for better compatibility
		if ($method === 'auto' && isset($_SERVER['SERVER_SOFTWARE']) && strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') !== FALSE)
		{
			$method = 'refresh';
		}
		elseif ($method !== 'refresh' && (empty($code) OR ! is_numeric($code)))
		{
			if (isset($_SERVER['SERVER_PROTOCOL'], $_SERVER['REQUEST_METHOD']) && $_SERVER['SERVER_PROTOCOL'] === 'HTTP/1.1')
			{
				$code = ($_SERVER['REQUEST_METHOD'] !== 'GET')
					? 303	// reference: http://en.wikipedia.org/wiki/Post/Redirect/Get
					: 307;
			}
			else
			{
				$code = 302;
			}
		}

		switch ($method)
		{
			case 'refresh':
				header('Refresh:0;url='.$uri);
				break;
			default:
				header('Location: '.$uri, TRUE, $code);
				break;
		}
		exit;
	}
}

// ------------------------------------------------------------------------

/**
 * Header Redirect
 *
 * Header redirect in two flavors
 * For very fine grained control over headers, you could use the Output
 * Library's set_header() function.
 *
 * @access	public
 * @param	string	the URL
 * @param	string	the method: location or redirect
 * @return	string
 */
if ( ! function_exists('redirect'))
{
	function redirect($uri = '', $method = 'location', $http_response_code = 302)
	{
		
		if ( ! preg_match('#^https?://#i', $uri))
		{
			$uri = str_replace('//', '/', $uri);
			$uri = site_url($uri);
		}

		switch($method)
		{
			case 'refresh'	: header("Refresh:0;url=".$uri);
				break;
			default			: header("Location: ".$uri, TRUE, $http_response_code);
				break;
		}
		exit;
	}
}

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('site_url'))
{
	/**
	 * Site URL
	 *
	 * Create a local URL based on your basepath. Segments can be passed via the
	 * first parameter either as a string or an array.
	 *
	 * @param	string	$uri
	 * @param	string	$protocol
	 * @return	string
	 */
	function site_url($uri = '', $protocol = NULL)
	{
		if ( ! preg_match('#^https?://#i', $uri))
		{
			$uri = str_replace('//', '/', $uri);
		}
		
		$CI = get_instance();
		/*if(!empty($CI->client_session->userdata))
		{
			$userdata = $CI->client_session->userdata;
			var_dump($userdata['property_id']);
		}
		
		$property_id = false;
		if(!empty($CI->booking_cart))
		{
			$property_id = $CI->booking_cart->userdata('property_id');
			var_dump($property_id);
		}
		*/
		return $CI->config->site_url($uri, $protocol);
	}
}

/**
 * CodeIgniter URL Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/url_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('cdn_url'))
{
	/**
	 * CDN URL
	 *
	 * Create a local URL based on your basepath. Segments can be passed via the
	 * first parameter either as a string or an array.
	 *
	 * @param	string	$uri
	 * @param	string	$protocol
	 * @return	string
	 */
	function cdn_url($uri = '', $protocol = NULL)
	{
		$CI =& get_instance();
		$base_url = $CI->config->item('cdn_url');
		
		$base_url = rtrim($base_url, '/');
		
		if (empty($uri))
		{
			return $base_url .'/';
		}
		
		return $base_url .'/'. $uri;
	}
}

if ( ! function_exists('cdn_path'))
{
	/**
	 * CDN PATH
	 *
	 *
	 * @param	string	$path
	 * @return	string
	 */
	function cdn_path($path = '')
	{
		$CI =& get_instance();
		$base_path = $CI->config->item('cdn_path');
		
		$base_path = rtrim($base_path, '/');
		
		if (empty($path))
		{
			return $base_path .'/';
		}
		
		return $base_path .'/'. $path;
	}
}


/*------------------------------*/
function img_url($uri, $tag = false, $class = '')
{
	if($tag)
	{
		return '<img src="'.assets_url('img/'.$uri).'" alt="'.$tag.'" '.($class !== '' ? ' class="'.$class.'"' : '').' />';
	}
	else
	{
		return assets_url('img/'.$uri);
	}
}

function js_url($uri, $tag = false)
{
	if($tag)
	{
		return '<script type="text/javascript" src="'.assets_url('js/'.$uri).'"></script>';
	}
	else
	{
		return assets_url('js/'.$uri);
	}
}

function css_url($uri, $tag = false)
{
	if($tag)
	{
		$media = false;
		
		if(is_string($tag))
		{
			$media = 'media="'.$tag.'"';
		}
		
		return '<link href="'.assets_url('css/'.$uri).'" type="text/css" rel="stylesheet" '.$media.'/>';
	}
	
	return assets_url('css/'.$uri);
}
/*------------------------------*/


