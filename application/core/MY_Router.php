<?php defined('BASEPATH') OR exit('No direct script access allowed');

class My_Router extends CI_Router 
{
	function __construct($routing = NULL)
	{
		parent::__construct($routing);
	}
	
	// this is here to add an additional layer to the routing system.
	//If a route isn't found in the routes config file. then it will scan the database for a matching route.
	function _parse_routes()
	{
		$segments	= $this->uri->segments;
		// Turn the segment array into a URI string
		$uri = implode('/', $segments);

		// Get HTTP verb
		$http_verb = isset($_SERVER['REQUEST_METHOD']) ? strtolower($_SERVER['REQUEST_METHOD']) : 'cli';

		// Loop through the route array looking for wildcards
		foreach ($this->routes as $key => $val)
		{
			// Check if route format is using HTTP verbs
			if (is_array($val))
			{
				$val = array_change_key_case($val, CASE_LOWER);
				if (isset($val[$http_verb]))
				{
					$val = $val[$http_verb];
				}
				else
				{
					continue;
				}
			}

			// Convert wildcards to RegEx
			$key = str_replace(array(':any', ':num'), array('[^/]+', '[0-9]+'), $key);

			// Does the RegEx match?
			if (preg_match('#^'.$key.'$#', $uri, $matches))
			{
				// Are we using callbacks to process back-references?
				if ( ! is_string($val) && is_callable($val))
				{
					// Remove the original string from the matches array.
					array_shift($matches);

					// Execute the callback using the values in matches as its parameters.
					$val = call_user_func_array($val, $matches);
				}
				// Are we using the default routing method for back-references?
				elseif (strpos($val, '$') !== FALSE && strpos($key, '(') !== FALSE)
				{
					$val = preg_replace('#^'.$key.'$#', $val, $uri);
				}

				$this->_set_request(explode('/', $val));
				return;
			}
		}
		
		// now try the Cart specific routing
		$segments = array_splice($segments, -2, 2);
		
		// Turn the segment array into a URI string
		$uri = implode('/', $segments);
		
		//look through the database for a route that matches and apply the same logic as above :-)
		//load the database connection information
		require_once BASEPATH.'database/DB'.EXT;
		
		
		
		if( count($segments) == 2 and !empty($segments[0]) )
		{
			if($segments[0] == 'c')
			{
				return $this->_set_db_route_category($segments);
			}
			elseif($segments[0] == 'p')
			{
				return $this->_set_db_route_product($segments);
			}
			elseif($segments[0] == 'b')
			{
				return $this->_set_db_route_brand($segments);
			}
		}
		
		
		if(count($segments) == 1)
		{
			return $this->_set_db_route_page($segments);
			
			$row = $this->_get_db_route($segments[0]);
			if(!empty($row))
			{
				return $this->_set_request(explode('/', $row['route']));
			}
		}
		else
		{
			$segments	= array_reverse($segments);
			
			//start with the end just to make sure we're not a multi-tiered category or category/product combo before moving to the second segment
			//we could stop people from naming products or categories after numbers, but that would be limiting their use.
			$row = $this->_get_db_route($segments[0]);
			//set a pagination flag. If this is set true in the next if statement we'll know that the first row is segment is possibly a page number
			$page_flag	= false;
			
			if($row)
			{
				return $this->_set_request(explode('/', $row['route']));
			}
			else
			{
				//this is the second go
				$row	= $this->_get_db_route($segments[1]);
				$page_flag	= true;
			}
			
			//we have a hit, continue down the path!
			if($row)
			{
				if(!$page_flag)
				{
					return $this->_set_request(explode('/', $row['route']));
				}
				else
				{
					$key = $row['slug'].'/([0-9]+)';
					
					//pages can only be numerical. This could end in a mighty big error!!!!
					if (preg_match('#^'.$key.'$#', $uri))
					{
						$row['route'] = preg_replace('#^'.$key.'$#', $row['route'],$uri);
						return $this->_set_request(explode('/', $row['route']));
					}
				}
			}
		}
		//var_dump($this->uri->segments);die;
		// If we got this far it means we didn't encounter a
		// matching route so we'll set the site default route
		$this->_set_request(array_values($this->uri->segments));
	}

	protected function _set_request($segments = array())
	{
		$_segments	= $this->uri->segments;
		$_segments = array_splice($_segments, -2, 2);
		
		
		if( $segments[0] == 'content' and $segments[0] != $_segments[0] )
		{
			return show_404();
		}
		
		$segments = $this->_validate_request($segments);
		// If we don't have any segments left - try the default controller;
		// WARNING: Directories get shifted out of the segments array!
		if (empty($segments))
		{
			$this->_set_default_controller();
			return;
		}

		if ($this->translate_uri_dashes === TRUE)
		{
			$segments[0] = str_replace('-', '_', $segments[0]);
			if (isset($segments[1]))
			{
				$segments[1] = str_replace('-', '_', $segments[1]);
			}
		}

		$this->set_class($segments[0]);
		if (isset($segments[1]))
		{
			$this->set_method($segments[1]);
		}
		else
		{
			$segments[1] = 'index';
		}

		array_unshift($segments, NULL);
		unset($segments[0]);
		$this->uri->rsegments = $segments;
	}
	
	function _set_db_route_category($segments)
	{
		list($category_id) = explode('-', $segments[1], 2);
		
		$category_id = intval($category_id);
		
		$result = DB()->where(array('category_id'=>$category_id, 'is_enabled'=>1))->get('categories')->row();
		
		if(!$result)
		{
			return false;
		}
		
		$segments[0] = 'User_catalog';
		$segments[1] = 'index';
		
		$_GET['category_id'] = $result->category_id;
		$_GET['layout_id'] = 1;
		
		//var_dump($segments);die;
		
		return $this->_set_request($segments);
	}
	
	function _set_db_route_product($segments)
	{
		list($product_id) = explode('-', $segments[1], 2);
		
		$product_id = intval($product_id);
		
		$result = DB()->where(array('product_id'=>$product_id, 'is_enabled'=>1))->get('products')->row();
		
		if(!$result)
		{
			return false;
		}
		
		$segments[0] = 'User_catalog';
		$segments[1] = 'product_detail';
		
		$_GET['product_id'] = $result->product_id;
		
		//var_dump($segments);die;
		
		return $this->_set_request($segments);
	}
	
	function _set_db_route_brand($segments)
	{
		list($brand_id) = explode('-', $segments[1], 2);
		
		$brand_id = intval($brand_id);
		
		$result = DB()->where(array('brand_id'=>$brand_id, 'is_enabled'=>1))->get('brands')->row();
		
		if(!$result)
		{
			return false;
		}
		
		$segments[0] = 'User_catalog';
		$segments[1] = 'index';
		
		$_GET['brand_id'] = $result->brand_id;
		$_GET['layout_id'] = 2;
		//var_dump($segments);die;
		
		return $this->_set_request($segments);
	}
	
	function _set_db_route_page($segments)
	{
		$slug = str_replace('.html', '', $segments[0]);
		
		$result = DB()->where('slug', $slug)->get('routes')->row();
		
		if(!$result)
		{
			return false;
		}
		
		//User_page/index/1
		
		$route = explode('/', $result->route);
		
		$segments[0] = $route[0];
		$segments[1] = $route[1];
		
		$_GET['page_id'] = $route[2];
		
		return $this->_set_request($segments);
	}
	
	function _get_db_route($slug)
	{
		$result = DB()->where('slug', $slug)->get('routes')->row_array();
		if(!$result)
		{
			return false;
		}
		//var_dump($result);die;
	//	$result['route'] = $result['directory'] .'/'. $result['module'] .'/'. $result['method'] .'/'. $result['route'];
	//	$result['route'] = $result['module'] .'/'. $result['method'] .'/'. $result['route'];
		//$result['slug'] = $result['method'] .'/'. $result['slug'];
		
		return $result;
	}
}