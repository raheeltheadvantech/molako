<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_brands extends Admin_Controller {

    private $brand_id = 0;

    function __construct()
    {
        parent::__construct();

        $this->load->model(array(
            'admin/catalog/Admin_brand_model',
        ));

        $this->controller_dir = 'catalog';
        $this->controller_name = 'brands';
        $this->view_dir = 'catalog/brands';
    }

    function index()
    {

        $data['page_title']	= 'Brands';
        $data['page_header']= 'Brands';

        $order 		= $this->input->get('order') ? $this->input->get('order') : 'brand_id, name';
        $sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code 		= $this->input->get('code') ? $this->input->get('code') : '';
        $page 		= $this->input->get('page') ? $this->input->get('page') : 0;
        $rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';


        $query_items = $this->input->get();
        $query = array();
        foreach ($query_items as $key => $item){
            if($key != 'id') {
                $query[$key] = $item;
            }
        }
        $query = http_build_query($query);
        $data['query'] = $query;

        $term				= false;
        $data['code']		= $code;
        $post				= $this->input->post(null, false);

        $this->load->model('admin/Admin_search_model');

        if($post)
        {
            $term			= json_encode($post);
            $code			= $this->Admin_search_model->record_term($term);
            $data['code']	= $code;

            redirect(site_url($this->admin_url .'/'. $this->controller_dir .'/brands.html?code='.$code));
        }
        elseif ($code)
        {
            $term			= $this->Admin_search_model->get_term($code);
        }

        $data['term']		= $term;
        $data['order_by']	= $order;
        $data['sort_by']	= $sort;

        $params	= '';

        $result	= $this->Admin_brand_model->get_brands(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total	= $this->Admin_brand_model->get_brands(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort), true);

        $data['result']	= $result;
        $data['total']	= $total;

        $config['base_url']	= site_url($this->admin_url .'/'. $this->controller_dir .'/brands.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']			= $total;
        $config['per_page']				= $rows;
        $config['offset']				= $per_page;
        $config['uri_segment']			= $this->uri->total_segments();
        $config['use_page_numbers'] 	= TRUE;
        $config['page_query_string'] 	= TRUE;
        $config['reuse_query_string'] 	= TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);


        $data['add_link'] = site_url($this->admin_folder.'/catalog/brand-add.html');
        $this->view($this->admin_view  .'/'. $this->view_dir .'/brands_list', $data);
    }

    function default_data(&$data)
    {
        $data['page_title']		= 'Brand form';
        $data['page_header']	= 'Brand form';

        $data['brand_id'] = 0;
        $data['name']			= '';
        $data['dis_mode']           = '';
        $data['dis_val']           = '';
        $data['dis_sdate']           = '';
        $data['dis_edate']           = '';
        $data['images']			= '';
        $data['sort']		        = 0;
        $data['is_enabled']		= 0;

        $data['id']				= $this->input->get('id');

        $data['route'] = 'brand-add.html';
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


        $query_items = $this->input->get();
        $query = array();
        foreach ($query_items as $key => $item){
            if($key != 'id') {
                $query[$key] = $item;
            }
        }
        $query = http_build_query($query);

        if ($mode == 'edit')
        {
            $result	= $this->Admin_brand_model->get_by_id($data['id']);
            if(!$result)
            {
                $this->admin_session->set_flashdata('error', 'item not found.');
                redirect($this->admin_url .'/'. $this->controller_dir .'/brands.html');
            }

            $this->brand_id = $result->brand_id;
            $save['date_modified']  = date('Y-m-d H:i:s');

            foreach($result as $key=>$val)
            {
                $data[$key] = $val;
            }

            $data['result'] = $result;
            $data['images'] = $result->images;
            $data['route'] 	= 'brand-edit.html?id='.$data['brand_id'];
        }



        $data['route'] .= !empty($query) ? '&'.$query : '';

        $brands = $this->Admin_brand_model->get_brands(array('1' => '1'));
        $data['brands'] = $brands;

        $this->form_validation->set_rules('name', 'brand Name', 'required|callback_is_brand_name_already_exist');


        if($this->input->post('submitted'))
        {
            $data['images']	= $this->input->post('images');
        }

        if ($this->form_validation->run() == FALSE)
        {
            $this->view($this->admin_view  .'/'. $this->view_dir .'/brands_form', $data);
        }
        else
        {

            $save['brand_id']		= $this->brand_id;
            $save['name']	        = $this->input->post('name');
            $save['dis_mode']           = $this->input->post('dis_mode');
            $save['dis_val']           = $this->input->post('dis_val');
            $save['dis_sdate']           = $this->input->post('dis_sdate');
            $save['dis_edate']           = $this->input->post('dis_edate');
            $save['sort']           = $this->input->post('sort');
            $save['is_enabled']	    = $this->input->post('is_enabled');
            $save['date_added']	    = date('Y-m-d H:i:s');

            $save['images']	= $this->input->post('images');

            //resize image
            if(!empty($save['images']))
              $this->image_resize($save['images']);

            $brand_id = $this->Admin_brand_model->save($save);
            $this->play_discount($brand_id);



            $url = $this->admin_url .'/'. $this->controller_dir .'/brands.html';
            $url.= !empty($query) ? '?'.$query : '';
            $url.= '#btn-edit-'. $this->brand_id;

            $this->admin_session->set_flashdata('message', 'Brand has been saved.');
            redirect($url);
        }
    }
    public function play_discount($brand_id)
    {

        $brand = $this->Admin_brand_model->get_by_id($brand_id);
        $products = $this->db->where('brand_id',$brand_id)->get('products')->result_array();
            $ids = array();
            $in = array();
            foreach ($products as $k => $v) {
                $ids[] = $v['product_id'];
                $nprice = $price = $v['sale_price'];
                if($brand->dis_mode == 'fixed')
                {
                    $nprice = $nprice - $brand->dis_val;

                }
                elseif($brand->dis_mode == 'per')
                {
                    $per = ($price * $brand->dis_val)/100;
                    $nprice = $nprice - $per;
                }
                $in[] = array(
                    'product_id'=> $v['product_id'],
                    'price'=> $nprice,
                    'from_date'=> $brand->dis_sdate,
                    'to_date'=> $brand->dis_edate,

                );
            }
            //delete old prices
            if($ids)
            $this->db->where_in('product_id',$ids)->delete('discount_prices');
        if(isset($brand->dis_val) && $brand->dis_val)
        {
            $r = $this->db->insert_batch('discount_prices', $in);

        }
        //variations
        if($ids)
        {
            $varis = $this->db->where_in('product_id',$ids)->get('product_option_value')->result_array();
            $vids = array();
            $in = array();
            foreach($varis as $k => $v)
            {
                $vids[] = $v['product_option_value_id'];
                unset($v['product_option_value_id']);
                $v['is_brand'] = 1;
                $v['bdis_mode'] = $brand->dis_mode;
                $v['bdis_val'] = $brand->dis_val;
                $v['bdis_sdate'] = $brand->dis_sdate;
                $v['bdis_edate'] = $brand->dis_edate;

                $in[] = $v;
            }
                //delete old variations
            if($vids)
            {
                $this->db->where_in('product_option_value_id',$vids)->delete('product_option_value');
            }

            if($in)
            {
                $r = $this->db->insert_batch('product_option_value', $in);

            }
        }

    }


    public function delete()
    {
        $id = $this->input->get('id');
        $this->Admin_brand_model->delete($id);
        $this->admin_session->set_flashdata('message', 'brand has been deleted successfully!' );
        redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/brands.html'));
    }


    function image_upload_form()
    {
       // $this->set_template('iframe');

        $data['file_name'] 		= false;
        $data['error']			= false;
        $data['form_action']	= $this->admin_url .'/'. $this->controller_dir .'/brand/simple-image-uploader.html';

        $this->view($this->admin_view.'/iframe/simple_image_uploader', $data);
    }

    function simple_image_uploader()
    {

        $target_folder = 'images/brands/';

        //$data['file_name'] 		= false;
        $data['error']			= false;

        $config['allowed_types'] 	= 'gif|jpg|png|jpeg';
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

        //$this->view($this->admin_view.'/iframe/simple_image_uploader', $data);
    }


    function image_resize($image_name){

        $this->load->library('image_lib');

        $target_folder = 'images/brands/';


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
        $prev_file_path = "./images/brands/temp/".$image_name;
        if(file_exists($prev_file_path ))
            unlink($prev_file_path );

    }

    function is_brand_name_already_exist($str)
    {

        $brand_id	= $this->input->get('id');
        $result = $this->Admin_brand_model->is_name_already_exist($str , $brand_id);
        if ($result)
        {
            dd($this->db->last_query());
            $this->form_validation->set_message('is_brand_name_already_exist', 'brand name is already exist');
            return FALSE;
        }
        else
        {
            return TRUE;
        }
    }
}
