<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_newsletters extends Admin_Controller {
	
	function __construct()
	{
		parent::__construct();
		
		$this->controller_name = 'admin_newsletter';
        $this->view_dir = 'support/newsletters';
		$this->load->model('admin/support/Admin_newsletters_model');
	}
	
	function index()
	{
		$data = array();
        $data['page_header'] = 'Newsletters';

        $order 		= $this->input->get('order') ? $this->input->get('order') : '';
        $sort 		= $this->input->get('sort') ? $this->input->get('sort') : 'asc';
        $code 		= $this->input->get('code') ? $this->input->get('code') : '';
        $page 		= $this->input->get('page') ? $this->input->get('page') : 0;
        $rows 		= $this->input->get('rows') ? $this->input->get('rows') : '10';
        $per_page 	= $this->input->get('per_page') ? $this->input->get('per_page') : '';

        $term				= false;
        $data['code']		= $code;
        $post				= $this->input->post(null, false);

        $this->load->model('admin/Admin_search_model');

        $this->load->model('admin/Admin_search_model');
        if($post)
        {
            $term			= json_encode($post);
            $code			= $this->Admin_search_model->record_term($term);
            $data['code']	= $code;
            redirect(site_url($this->admin_folder .'/support/newsletters.html?code='.$code));
        }
        elseif ($code)
        {
            $term			= $this->Admin_search_model->get_term($code);
        }


        $result	= $this->Admin_newsletters_model->get_newsletters_list(array('term'=>$term,'order'=>$order, 'sort'=>$sort, 'rows'=>$rows, 'per_page'=>$per_page));
        $total	= $this->Admin_newsletters_model->get_newsletters_list(array('term'=>$term,'order'=>$order, 'sort'=>$sort), true);

        $data['result']	= $result;
        $data['total']	= $total;

        $config['base_url']	= site_url($this->admin_folder .'/'. $this->controller_dir .'/support/newsletters.html?order='.$order.'&sort='.$sort.'&code='.$code);

        $config['total_rows']			= $total;
        $config['per_page']				= $rows;
        $config['offset']				= $per_page;
        $config['uri_segment']			= $this->uri->total_segments();
        $config['use_page_numbers'] 	= TRUE;
        $config['page_query_string'] 	= TRUE;
        $config['reuse_query_string'] 	= TRUE;

        $this->load->library('pagination');

        $this->pagination->initialize($config);

        $this->view($this->admin_view.'/'.$this->view_dir.'/list', $data);

	}

    // Export data in CSV format
    public function export_csv(){
        // file name
        $filename = 'newsletters_'.date('Ymd').'.csv';
        header("Content-Description: File Transfer");
        header("Content-Disposition: attachment; filename=$filename");
        header("Content-Type: application/csv; ");

        // get data
        $newsletters = $this->Admin_newsletters_model->get_newsletters_list(array('1' => 1));
        // file creation
        $file = fopen('php://output', 'w');

        $header = array("Newsletter_id","Email", "Date Added");
        fputcsv($file, $header);
        foreach ($newsletters as $key=>$line){
            $line = json_decode(json_encode($line),true);
            fputcsv($file,$line);
        }
        fclose($file);
        exit;
    }



}