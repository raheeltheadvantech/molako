<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_wishlist extends User_Controller {
	
	function __construct()
	{
		parent::__construct();

		$this->load->model('user/catalog/User_catalog_model');

		$this->controller_name = 'user_wishlist';
		$this->controller_dir = 'account';
		$this->view_dir = 'account/wishlist';
	}

	function index()
	{
		$this->current_active_nav   = 'wish-list';
		$data['page_title']			= 'Wish List';
		$data['page_header']		= 'Wish List';

		$data['wish_list_items']	= $this->User_catalog_model->get_wish_list($this->customer_id);

		$this->view($this->user_view .'/'. $this->view_dir .'/wishlist', $data);
	}

	public function add_to_wishlist()
	{
		// echo('test');die();
		if($this->input->post())
		{

			$items = $this->input->post('item');
			$product_id = $items['product_id'];
			if(is_numeric($product_id)){

				if($this->User_catalog_model->is_exists_in_wish_list($this->customer_id, $product_id)){
					$json['message'] = 'Product is already exists in your wish list!';
					$this->user_session->set_flashdata('error', $json['message']);
				}else {

					$wishlist_input_data = array(
						'customer_id' => $this->customer_id,
						'product_id' => $product_id,
						'date_added' => date('Y-m-d H:i:s'),
						'date_modified' => date('Y-m-d H:i:s')
					);
					if ($this->User_catalog_model->add_to_wish_list($wishlist_input_data)) {
						$json['message'] = 'Product has been added to your wish list successfully';
						$this->user_session->set_flashdata('message', $json['message']);
					} else {
						$json['message'] = 'Product has not been added to your wish list successfully';
						$this->user_session->set_flashdata('error', $json['message']);
					}
				}
			}

			redirect(site_url($this->user_url_prefix . '/wishlist.html'));
		}else{
			$this->user_session->set_flashdata('error', 'Data has not been submited');
			redirect(site_url('categories.html'));
		}
	}

	public function remove_from_wishlist()
	{
		if($this->input->post())
		{
			$items = $this->input->post('item');
			$wish_list_id = $items['product_id'];
			
			if(is_numeric($wish_list_id))
			{
				if($this->User_catalog_model->remove_from_wishlist($wish_list_id,$this->customer_id)) {
					$json['message'] = 'Product has been removed from your wish list successfully';
					$this->user_session->set_flashdata('message', $json['message']);
				}else{
					$json['message'] = 'Product has not been removed from your wish list successfully';
					$this->user_session->set_flashdata('error', $json['message']);
				}
				redirect(site_url($this->user_url_prefix . '/wishlist.html'));
			}

		}else
		{
			$this->user_session->set_flashdata('error', 'Product has been not found');
			redirect(site_url($this->user_url_prefix . '/wishlist.html'));
		}
	}

}
