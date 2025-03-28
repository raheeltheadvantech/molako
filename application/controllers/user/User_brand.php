<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_brand extends User_Public_Controller {
	
	private $is_solr_ping = true;
	
	function __construct()
	{
		parent::__construct();
		
		// load User_featured_module_model
		// $this->load->model('user/common/User_featured_module_model');
		$this->load->model('user/catalog/User_brand_model');
		
		$this->controller_name = 'user_brand';
		$this->controller_dir = 'user';
		$this->view_dir = 'homepage';
		
		$this->load->helper('string');
	}

	// public function get_brand()
	// {
	// 	$brand_url = urldecode($this->input->get('n'));
	// 	$temp = explode('-', $brand_url);
	// 	$brand_id = end($temp);
	// 	$brand = $this->User_brand_model->get_brand_by_id($brand_id);
	// 	$brand->images = json_decode($brand->images);

	// 	$data['meta_title']			= $brand->name;
	// 	$data['meta_keywords']		= $brand->name;
	// 	$data['meta_description']	= $brand->name;

	// 	$data['page_title']			= $brand->name;
	// 	$data['page_header']		= $brand->name;

    //     $previous_url = array();
    //     if(isset($_SERVER['HTTP_REFERER'])) {
    //     $previous_url = parse_url($_SERVER['HTTP_REFERER']);
    //     }
    //     $query_parameters = array();
    //     if(isset($previous_url['query'])){
    //         parse_str($previous_url['query'],$query_parameters);
    //     }


    //     if(isset($previous_url['path']) && strpos($previous_url['path'],'brands.html')){
    //         $this->breadcrumbs[] = array(
    //             'title' => 'Brands list',
    //             'href' => site_url('brands.html')
    //         );
    //     }

	// 	$result = (object)array(
	// 		'brand'		=> $brand,
	// 		'products'	=> $this->User_catalog_model->get_products_by_brand($brand_id)
	// 	);

	// 	$data['result'] = $result;

	// 	$this->view($this->user_view .'/'. $this->view_dir .'/inc.brands', $data);
	// }


}
