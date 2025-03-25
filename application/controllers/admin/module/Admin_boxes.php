<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_boxes extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->load->model('admin/module/Admin_boxes_model');
		
		$this->controller_dir = 'module';
		$this->controller_name = 'admin_boxes';
		$this->view_dir = 'module/boxes';
		
		$this->load->helper('date');
	}
	
	function index()
	{
		$data['page_title']	= 'Slider';
		$data['page_header']= 'Slider';
		
		$params = array();
		
		$order 		= $this->input->get('order') ? $this->input->get('order') : 'c.slider_id';
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
			
			redirect(site_url($this->admin_folder .'/'. $this->controller_dir .'/sliders.html?code='.$code));
		}
		elseif ($code)
		{
			$term			= $this->Admin_search_model->get_term($code);
		}
		
		$data['term']		= $term;
		$data['order_by']	= $order;
		$data['sort_by']	= $sort;
		
		
		
		$result	= $this->Admin_boxes_model->get_sliders(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
		$total	= $this->Admin_boxes_model->get_sliders(array('params'=>$params, 'term'=>$term, 'order'=>$order, 'sort'=>$sort), true);
		
		$data['result']	= $result;
		$data['total']	= $total;
		
		$config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/sliders.html?order='.$order.'&sort='.$sort.'&code='.$code);
		
		$config['total_rows']			= $total;
		$config['per_page']				= $rows;
		$config['offset']				= $per_page;
		$config['uri_segment']			= $this->uri->total_segments();
		$config['use_page_numbers'] 	= TRUE;
		$config['page_query_string'] 	= TRUE;
		$config['reuse_query_string'] 	= TRUE;
		
		$this->load->library('pagination');
		
		$this->pagination->initialize($config);
		
		$this->view($this->admin_view  .'/'. $this->view_dir .'/sliders_list', $data);
	}
	
	function default_data(&$data)
	{
		$data['page_title']		= 'Slider form';
		$data['page_header']	= 'Slider form';

		$data['name']			= '';
		$data['title']			= '';
		$data['detail']			= '';
		$data['enable_on']		= '';
		$data['disable_on']		= '';
		$data['image']			= '';
		$data['link']			= '';
		$data['new_window']		= false;
		
		
		$data['id']				= $this->input->get('id');
		
		$data['route'] = 'box-add.html';
		
		$data['result'] = '';
		
		$config['upload_path']			= 'images/slides';
		$config['allowed_types']		= 'gif|jpg|png|svg';
		$config['max_size']				= $this->config->item('size_limit');
		$config['encrypt_name']			= true;
		$this->load->library('upload', $config);
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
    $this->default_data($data);
    
    if ($mode == 'edit')
    {
        $result = $this->Admin_boxes_model->get_by_id($data['id']);
        if(!$result)
        {
            $this->admin_session->set_flashdata('error', 'item not found.');
            redirect($this->admin_url .'/'. $this->controller_dir .'/boxes.html');
        }
        
        $data['result'] = $result;
        
        foreach($result as $key=>$val)
        {
            $data[$key] = $val;
        }
        $data['route'] = 'box-edit.html?id='.$data['id'];
    }
    
    // Set validation rules
    $this->form_validation->set_rules('name', 'lang:name', 'trim|required');
    $this->form_validation->set_rules('title', 'lang:title', 'trim|required');
    $this->form_validation->set_rules('enable_on', 'lang:enable_on', 'trim');
    $this->form_validation->set_rules('disable_on', 'lang:disable_on', 'trim');
    $this->form_validation->set_rules('link', 'lang:link', 'trim');
    $this->form_validation->set_rules('new_window', 'lang:new_window', 'trim');
    
    // Make 'image' field required
    // $this->form_validation->set_rules('image', 'lang:image', 'trim|required');
    
    if ($this->form_validation->run() == FALSE)
    {
        $this->view($this->admin_view  .'/'. $this->view_dir .'/slider_form', $data);
    }
    else
    {
        $save['slider_id']    = $data['id'];
        $save['name']         = $this->input->post('name');
        $save['title']        = $this->input->post('title',false);
        $save['detail']        = $this->input->post('detail',false);
         
        $save['date_added']   = date('Y-m-d H:i:s');
        if ($data['id'])
        {
            $save['date_modified'] = date('Y-m-d H:i:s');
        }
        
        $save['image'] = $this->input->post('image');
        
        // Resize image if it's not empty
        if(!empty($save['image']))
            $this->file_move($save['image']);
            

        $this->Admin_boxes_model->save($save);
        
        $this->admin_session->set_flashdata('message', 'Items have been saved.');
        redirect($this->admin_url .'/'. $this->controller_dir .'/boxes.html');
    }
}

	
	
	function image_upload_form()
	{
		$this->set_template('iframe');
		
		$data['file_name'] 		= false;
		$data['error']			= false;
		$data['form_action']	= $this->admin_url .'/'. $this->controller_dir .'/box/simple-image-uploader.html';
		
		$this->view($this->admin_view.'/iframe/simple_image_uploader', $data);
	}
	

    function simple_image_uploader()
    {

        $target_folder = 'images/boxes/';

        //$data['file_name'] 		= false;
        $data['error']			= false;

        $config['allowed_types'] 	= '*';
        $config['max_size']		= $this->config->item('size_limit');
        $config['upload_path'] 		= $target_folder . 'temp/';
        $config['encrypt_name'] 	= true;
        $config['remove_spaces']	= false;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('file'))
        {

            $upload_data = $this->upload->data();

            $this->load->library('image_lib');
            // var_dump($upload_data);

            echo $data['file_name']		= $upload_data['file_name'];
            $data['file_name_orig']	= $upload_data['orig_name'];

        }

        if($this->upload->display_errors() != '')
        {
            $data['error'] = $this->upload->display_errors();
        }

    }
    function file_move($file_name)
    {
    	$target_folder = 'images/boxes/';
    	$file_name = trim($file_name); // Ensure no extra spaces
$temp = $target_folder . 'temp/' . $file_name;
$new = $target_folder . 'file/' . $file_name;

// Ensure the destination directory exists
if (!is_dir(dirname($new))) {
    mkdir(dirname($new), 0777, true);
}

if (!is_writable(dirname($new))) {
    chmod(dirname($new), 0777);
}

// Rename the file
if (rename($temp, $new)) {
    unlink($temp);
}
    }


    function simple_image_uploader1()
    {

        $this->set_template('iframe');

        $target_folder = 'images/boxes/';

        $data['file_name'] 		= false;
        $data['error']			= false;
        $data['form_action']	= $this->admin_url .'/'. $this->controller_dir .'/boxes/simple-image-uploader.html';

        $config['allowed_types'] 	= '*';
        //$config['max_size']		= $this->config->item('size_limit');
        $config['upload_path'] 		= $target_folder;
        $config['encrypt_name'] 	= true;
        $config['remove_spaces']	= false;

        $this->load->library('upload', $config);

        if ( $this->upload->do_upload())
        {
            $upload_data = $this->upload->data();
            var_dump($upload_data);

            $this->load->library('image_lib');
            $data['file_name']		= $upload_data['file_name'];
            $data['file_name_orig']	= $upload_data['orig_name'];

        }

        if($this->upload->display_errors() != '')
        {
            $data['error'] = $this->upload->display_errors();
        }

        $this->view($this->admin_view.'/iframe/simple_image_uploader', $data);
    }

    function _date_check()
	{
		$enable_on 	= $this->input->post('enable_on');
		$disable_on = $this->input->post('disable_on');
		
		if( $disable_on == '' )
		{
			return TRUE;
		}
		
		if ( format_ymd($disable_on) <= format_ymd($enable_on) )
		{
			$this->form_validation->set_message('_date_check', 'Error: date not valid.');
			return FALSE;
		}
		
		return TRUE;
	}
	
	function sort_list()
	{
		$data['page_title']	= 'Slider Sort';
		$data['page_header']= 'Slider Sort';
		
		$params = array();
		
		$data['result']	= $this->Admin_boxes_model->get_sliders(array('params'=>$params, ));
		
		$this->view($this->admin_view  .'/'. $this->view_dir .'/sliders_sort', $data);
	}
	
	function sort_ajax()
	{
		is_ajax();
		
		$items = $this->input->post('items');
		
		$this->Admin_boxes_model->organize($items);
		
		ajax_response(array('error'=>false, 'message'=>'items updated.'));
	}
	
	public function delete()
    {
        $id = $this->input->get('id');
		$result	= $this->Admin_boxes_model->get_by_id($id);
		if(!$result)
		{
			$this->admin_session->set_flashdata('error', 'item not found.');
			redirect($this->admin_url .'/'. $this->controller_dir .'/boxes.html');
		}

		$this->Admin_boxes_model->delete($id);
		
		$this->admin_session->set_flashdata('message', 'item have been deleted successfully!');
        redirect($this->admin_url .'/'. $this->controller_dir .'/boxes.html');
    }
}
