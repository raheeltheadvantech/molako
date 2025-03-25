<?php defined('BASEPATH') OR exit('No direct script access allowed'); 

class Admin_dashboard extends Admin_Controller {
	
	function __construct()
	{

	    parent::__construct();
		
		$this->controller_name = 'admin_dashboard';
		$this->load->model('admin/Admin_dashboard_model');
		$this->load->helper('formatting');
	}
	
	function index()
	{
		$data = array();
        $this->add_external_css('https://cdn.jsdelivr.net/npm/chartist@0.11.0/dist/chartist.min.css');
        $this->add_external_css(site_url('assets/admin_001/css/dashboard/dashboard.css'));
        $this->add_external_js('https://cdn.jsdelivr.net/npm/chart.js@2.7.3/dist/Chart.bundle.min.js');

        $data['total_sales'] = $this->Admin_dashboard_model->get_total_sales();
        $data['total_orders'] = $this->Admin_dashboard_model->get_total_by_table('order');
       // $data['total_club_members'] = $this->Admin_dashboard_model->get_total_by_table('join_club');
        $data['total_customers'] = $this->Admin_dashboard_model->get_total_by_table('customers');

        $data['latest_orders'] = $this->Admin_dashboard_model->get_latest_orders();
        $data['most_viewed_products'] = $this->Admin_dashboard_model->get_most_viewed_products();
        $data['bestseller_products'] = $this->Admin_dashboard_model->get_bestseller_products();

        $data['latest_customers'] = $this->Admin_dashboard_model->get_latest_customers();
        $data['latest_club_members'] = $this->Admin_dashboard_model->get_latest_club_members();
        $data['latest_contact_us'] = $this->Admin_dashboard_model->get_latest_contact_us();


        $this->view($this->admin_view.'/dashboard', $data);
	}


    public function chart($output = 'json') {
        $json = array();
        $json['order'] = array();
        $json['customer'] = array();
        $json['xaxis'] = array();

        $json['order']['label'] = 'Order';
        $json['customer']['label'] = 'Customer';
        $json['order']['data'] = array();
        $json['customer']['data'] = array();

        if ($this->input->get('range')) {
            $range = $this->input->get('range');
        } else {
            $range = 'day';
        }

        switch ($range) {
            default:
            case 'day':
                $results = $this->Admin_dashboard_model->get_total_orders_by_day();

                foreach ($results as $key => $value) {
                    $json['order']['data'][] = array($key, $value['total']);
                }

                $results = $this->Admin_dashboard_model->get_total_customers_by_day();

                foreach ($results as $key => $value) {
                    $json['customer']['data'][] = array($key, $value['total']);
                }

                for ($i = 0; $i < 24; $i++) {
                    $json['xaxis'][] = array($i, $i);
                }
                break;
            case 'week':
                
                $results = $this->Admin_dashboard_model->get_total_orders_by_week();

                foreach ($results as $key => $value) {
                    $json['order']['data'][] = array($key, $value['total']);
                }

                $results = $this->Admin_dashboard_model->get_total_customers_by_Week();

                foreach ($results as $key => $value) {
                    $json['customer']['data'][] = array($key, $value['total']);
                }

                $date_start = strtotime('-' . date('w') . ' days');

                for ($i = 0; $i < 7; $i++) {
                    $date = date('Y-m-d', $date_start + ($i * 86400));

                    $json['xaxis'][] = array(date('w', strtotime($date)), date('D', strtotime($date)));
                }
                break;
            case 'month':
                
                $results = $this->Admin_dashboard_model->get_total_orders_by_month();

                foreach ($results as $key => $value) {
                    $json['order']['data'][] = array($key, $value['total']);
                }

                $results = $this->Admin_dashboard_model->get_total_customers_by_month();

                foreach ($results as $key => $value) {
                    $json['customer']['data'][] = array($key, $value['total']);
                }

                for ($i = 1; $i <= date('t'); $i++) {
                    $date = date('Y') . '-' . date('m') . '-' . $i;

                    $json['xaxis'][] = array(date('j', strtotime($date)), date('d', strtotime($date)));
                }
                break;
            case 'year':
                
                $results = $this->Admin_dashboard_model->get_total_orders_by_year();

                foreach ($results as $key => $value) {
                    $json['order']['data'][] = array($key, $value['total']);
                }

                $results = $this->Admin_dashboard_model->get_total_customers_by_year();

                foreach ($results as $key => $value) {
                    $json['customer']['data'][] = array($key, $value['total']);
                }

                for ($i = 1; $i <= 12; $i++) {
                    $json['xaxis'][] = array($i, date('M', mktime(0, 0, 0, $i)));
                }
                break;
        }

        if($output == 'json'){
            header('Content-Type: application/json');
            return $this->output->set_output(json_encode($json));
        }else{
            return $json;
        }
	}
}