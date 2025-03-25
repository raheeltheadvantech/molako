<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_categories extends Admin_Controller {
	
	private $category_id = 0;
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model(array('admin/catalog/Admin_category_model'));

		$this->controller_dir = 'catalog';
		$this->controller_name = 'categories';
		$this->view_dir = 'catalog/categories';
	}
	
	function index()
	{
		$data['page_title']	= 'Categories';
		$data['page_header']= 'Categories';
		
		$order 		= $this->input->get('order') ? $this->input->get('order') : 'parent_id, name';
		$sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
		$code 		= $this->input->get('code') ? $this->input->get('code') : '';
		$page 		= $this->input->get('page') ? $this->input->get('page') : 0;
		$rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
		$per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';
		
		
		$term				= false;
		$data['code']		= $code;
		$post				= $this->input->post(null, false);

		$this->load->model('admin/Admin_search_model');

		if($post)
		{
			$term			= json_encode($post);
			$code			= $this->Admin_search_model->record_term($term);
			$data['code']	= $code;

			redirect(site_url($this->admin_url .'/'. $this->controller_dir .'/categories.html?code='.$code));
		}
		elseif ($code)
		{
			$term			= $this->Admin_search_model->get_term($code);
		}
		
		$data['term']		= $term;
		$data['order_by']	= $order;
		$data['sort_by']	= $sort;
		
		$params	= '';

		$result	= $this->Admin_category_model->get_categories(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
		$total	= $this->Admin_category_model->get_categories(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort), true);


		// echo '<pre>';print_r($result);die();

        $data['result']	= $result;
		$data['total']	= $total;
		
		$config['base_url']	= site_url($this->admin_url .'/'. $this->controller_dir .'/categories.html?order='.$order.'&sort='.$sort.'&code='.$code);
		
		$config['total_rows']			= $total;
		$config['per_page']				= $rows;
		$config['offset']				= $per_page;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($config);

        $data['add_link'] = site_url($this->admin_folder.'/catalog/category-add.html');
		$this->view($this->admin_view  .'/'. $this->view_dir .'/categories_list', $data);
	}
	
	function default_data(&$data)
	{
		$data['page_title']		= 'Categories form';
		$data['page_header']	= 'Categories form';

		$data['category_id']	= 0;
		$data['parent_id']		= 0;
		$data['name']			= '';
        $data['description']	= '';
		$data['images']			= '';
        $data['meta_title']		= '';
        $data['meta_description']	= '';
        $data['meta_keywords']		= '';
        $data['sort']		        = '';
        $data['path']		        = '';
		$data['is_enabled']		    = 0;
        $data['parent_name'] = '';
		
		$data['id']				= $this->input->get('id');
		
		$data['route'] = 'category-add.html';
	}
	
	function add()
	{
		$this->form();
	}
	
	function edit()
	{
		$this->form('edit');
	}
	
	private function form($mode = '')
	{
		$this->add_external_js(site_url().'assets/'.site_config_item('admin_assets').'/js/jquery.ui.js');
		$this->add_external_css(site_url().'assets/'.site_config_item('admin_assets').'/css/jquery.ui.css');
		$this->default_data($data);


		if ($mode == 'edit')
		{
			$result	= $this->Admin_category_model->get_by_id($data['id']);
			if(!$result)
			{
				$this->admin_session->set_flashdata('error', 'item not found.');
				redirect($this->admin_url .'/'. $this->controller_dir .'/categories.html');
			}
			
			$this->category_id = $result->category_id;

            $this->category_id = $result->category_id;


			$data['result'] = $result;
			foreach($result as $key=>$val)
			{
				$data[$key] = $val;
			}

			if($result->parent_id != 0)
                $data['parent_name'] =  $this->Admin_category_model->getparent($result->category_id);
                else
                    $data['parent_name'] = '';

            $data['images'] = $result->images;
			$data['route'] 	= 'category-edit.html?id='.$data['id'];

		}
		
		$this->form_validation->set_rules('name', 'Category Name', 'required|callback_is_category_name_already_exist');
        $this->form_validation->set_rules('parent_id', 'Parent Category', 'callback_is_parent_category_already_child');
		$this->form_validation->set_rules('images[]', 'images', '');	



		// if($this->input->post('submitted'))
		// {
		// 	$data['images']	= (array)$this->input->post('images');
		// }



		if ($this->form_validation->run() == FALSE)
		{
            //$data['pcategories'] =  $this->Admin_category_model->get_all_categories();
		    $this->view($this->admin_view  .'/'. $this->view_dir .'/categories_form', $data);
		}
		else
		{
            $id = $this->input->get('id');
            if(!empty($id)){
                $save['category_id']= $id;
                $save['date_modified']	= date('Y-m-d H:i:s');
            }

		    $save['name']			=  $this->input->post('name', true);
            $save['parent_id']		=  $this->input->post('parent_id');


            $save['description']	=  $this->input->post('description', true);
            // SEO Tab
            $save['meta_title']      = $this->input->post('meta_title', true);
            $save['meta_description']= $this->input->post('meta_description', true);
            $save['meta_keywords']   = $this->input->post('meta_keywords', true);

            $save['sort']			= $this->input->post('sort');
			$save['is_enabled']		= $this->input->post('is_enabled');
			$save['date_added']		= date('Y-m-d H:i:s');
			

            $save['images']	= $this->input->post('images');

            //resize image
            if(!empty($save['images']))
                $this->image_resize($save['images']);
			
			$this->Admin_category_model->save($save);
			wite_nav_curl();
			
			$this->admin_session->set_flashdata('message', 'Category has been saved.');
			redirect($this->admin_url .'/'. $this->controller_dir .'/categories.html');
		}
	}

    public function delete()
    {
        $id = $this->input->get('id');
        $this->Admin_category_model->delete($id);
        $this->admin_session->set_flashdata('message', 'Category has been deleted successfully!' );
        redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/categories.html'));
    }


	function image_upload_form()
	{
		$this->set_template('iframe');
		
		$data['file_name'] 		= false;
		$data['error']			= false;
		$data['form_action']	= $this->admin_url .'/'. $this->controller_dir .'/category/simple-image-uploader.html';
		
		$this->view($this->admin_view.'/iframe/simple_image_uploader', $data);
	}

    function simple_image_uploader()
    {

        $target_folder = 'images/categories/';

        //$data['file_name'] 		= false;
        $data['error']			= false;

        $config['allowed_types'] 	= 'gif|jpg|png';
        $config['max_size']		= $this->config->item('size_limit');
        $config['upload_path'] 		= $target_folder . 'temp/';
        $config['encrypt_name'] 	= true;
        $config['remove_spaces']	= false;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file'))
        {

            $upload_data = $this->upload->data();

            $this->load->library('image_lib');

            echo $data['file_name']		= $upload_data['file_name'];
            $data['file_name_orig']	= $upload_data['orig_name'];

        }

        if($this->upload->display_errors() != '')
        {
            $data['error'] = $this->upload->display_errors();
        }

    }


    function image_resize($image_name){


        $this->load->library('image_lib');

        $target_folder = 'images/categories/';

        $data = file_get_contents("dimension.json");
        $size = json_decode($data, true);

        //this is the image
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $target_folder . 'temp/'. $image_name;
        $config['new_image']		= $target_folder . 'full/'. $image_name;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			=  $size['primary']['width'];
        $config['height']			=  $size['primary']['height'];
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();


        //this is the larger image
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $target_folder . 'full/'. $image_name;
        $config['new_image']		= $target_folder . 'medium/'. $image_name;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			=  $size['large']['width'];
        $config['height']			=  $size['large']['height'];
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        //small image
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $target_folder . 'medium/'. $image_name;
        $config['new_image']		= $target_folder . 'small/'. $image_name;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			=  $size['small']['width'];
        $config['height']			=  $size['small']['height'];
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        //cropped thumbnail
        $config['image_library'] 	= 'gd2';
        $config['source_image'] 	= $target_folder . 'medium/'. $image_name;
        $config['new_image']		= $target_folder . 'thumbnails/'.$image_name;
        $config['maintain_ratio'] 	= TRUE;
        $config['width'] 			=  $size['thumb']['width'];
        $config['height']			=  $size['thumb']['height'];
        $config['exact_size']		= TRUE;
        $this->image_lib->initialize($config);
        $this->image_lib->resize();
        $this->image_lib->clear();

        //delete temp file
        $prev_file_path = "./images/categories/temp/".$image_name;
        if(file_exists($prev_file_path ))
            unlink($prev_file_path );

    }


    function is_category_name_already_exist($str)
    {

        $category_id	= $this->input->get('id');
        $result = $this->Admin_category_model->is_name_already_exist($str , $category_id);
        if ($result)
        {
            $this->form_validation->set_message('is_category_name_already_exist', 'Category name is already exist');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }


    function is_parent_category_already_child($parent_id)
    {

       $category_id	= $this->input->get('id');
       $result = $this->Admin_category_model->is_parent_already_child($parent_id , $category_id);
        if ($result)
        {
            $this->form_validation->set_message('is_parent_category_already_child', 'The parent category you have chosen is a child of the current one!');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }



    public function category_autocomplete()
    {
        $term['term'] 		= $this->input->post('term') ? $this->input->post('term') : '';

        $term = json_encode($term);

        $category_id =  $this->input->post('category_id') ? $this->input->post('category_id') : '';

        $rows 		= 10;
        $per_page 	= '';

        $result['result']	= $this->Admin_category_model->get_category_typehead2(array('term'=>$term,'rows'=>$rows, 'per_page'=>$per_page, 'category_id'=>$category_id));

        echo json_encode($result['result']);
        //ajax_response($result);
    }

}
