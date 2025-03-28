<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_dashboard_model extends Admin_Model {

	function __construct()
	{
		parent::__construct();
	}

    public function get_total_by_table($table_name)
    {
        if($table_name == 'order') {
            $sql = "count(*) as count";
            return $this->db->select($sql)->from($table_name)->where('order_status_id' , 6)->get()->row()->count;
        }else{
            $sql = "count(*) as count";
            return $this->db->select($sql)->from($table_name)->get()->row()->count;
        }

    }


    public function get_total_sales()
    {
        return $this->db->select_sum('total')->from('order')->where('order_status_id' , 6)->get()->row()->total;

	}

    public function get_total_orders_by_day() {

        $order_data = array();

        for ($i = 0; $i < 24; $i++) {
            $order_data[$i] = array(
                'hour'  => $i,
                'total' => 0
            );
        }

        $return_data = $order_data;

        foreach ($order_data as $datum) {
            $sql = 'COUNT(*) AS total';
            $this->db->select($sql);
            $this->db->from('order');
            $this->db->where('date_added', 'DATE(NOW())');
            $this->db->where('order_status_id', 6);
            $this->db->order_by('date_added', 'ASC');
            $result = $this->db->get()->row();
            $return_data[$datum['hour']] = array(
                'hour'  => $datum['hour'],
                'total' => $result->total
            );
        }

        return $return_data;


        /*foreach ($results as $result) {
            $order_data[$result->hour] = array(
                'hour'  => $result->hour,
                'total' => $result->total
            );
        }

        return $order_data;*/
    }

    public function get_total_orders_by_week() {
        
        $order_data = array();

        $date_start = strtotime('-' . date('w') . ' days');

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', $date_start + ($i * 86400));

            $order_data[date('w', strtotime($date))] = array(
                'date'   => date('Y-m-d', strtotime($date)),
                'day'   => date('D', strtotime($date)),
                'total' => 0
            );
        }

        $return_data = $order_data;

        foreach ($order_data as $datum) {
            //$sql = 'COUNT(*) AS total, date_added';
            $sql = 'COUNT(*) AS total';
            $this->db->select($sql);
            $this->db->from('order');
            $this->db->where('order_status_id', 6);
            $this->db->where("DATE(date_added) = DATE(" . $this->db->escape($datum['date']) . ")");
            $result = $this->db->get()->row();

            $return_data[date('w', strtotime($datum['date']))] = array(
                'day'   => $datum['day'],
                'total' => $result->total
            );
        }

        return $return_data;

        /*foreach ($results as $result) {
            $order_data[date('w', strtotime($result->date_added))] = array(
                'day'   => date('D', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $order_data;*/
    }

    public function get_total_orders_by_month() {
        
        $order_data = array();

        for ($i = 1; $i <= date('t'); $i++) {
            $date = date('Y') . '-' . date('m') . '-' . $i;

            $order_data[date('j', strtotime($date))] = array(
                'date'   => date('Y-m-d', strtotime($date)),
                'day'   => date('d', strtotime($date)),
                'total' => 0
            );
        }

        $return_data = $order_data;
        
        
        foreach ($order_data as $datum){
            //$sql = 'COUNT(*) AS total, date_added';
            $sql = 'COUNT(*) AS total';
            $this->db->select($sql);
            $this->db->from('order');
            $this->db->where('order_status_id', 6);
            $this->db->where("DATE(date_added) = DATE(" . $this->db->escape($datum['date'] ).")");
            $this->db->where('YEAR(date_added) =  YEAR(NOW())');
            $result = $this->db->get()->row();
            $return_data[date('j', strtotime($datum['date']))] = array(
                'day'   => $datum['day'],
                'total' => $result->total
            );
        }
        
        return $return_data;

        

        /*foreach ($results as $result) {
            $order_data[date('j', strtotime($result->date_added))] = array(
                'day'   => date('d', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $order_data;*/
    }

    public function get_total_orders_by_year() {

        $order_data = array();

        for ($i = 1; $i <= 12; $i++) {
            $order_data[$i] = array(
                'date'   => date('Y-m-d', mktime(0, 0, 0, $i)),
                'month' => date('M', mktime(0, 0, 0, $i)),
                'total' => 0
            );
        }

        $return_data = $order_data;

        foreach ($order_data as $datum) {
            //$sql = 'COUNT(*) AS total, date_added';
            $sql = 'COUNT(*) AS total';
            $this->db->select($sql);
            $this->db->from('order');
            $this->db->where('order_status_id', 6);
            $this->db->where('MONTH(date_added) = MONTH('. $this->db->escape(date('Y') . '-' . date('m', strtotime($datum['date'])) . '-1') .')');
            $this->db->where('YEAR(date_added) = YEAR(NOW())');
            $result = $this->db->get()->row();
            $return_data[date('n', strtotime($datum['date']))] = array(
                'month' => $datum['month'],
                'total' => $result->total
            );
        }

        return $return_data;

        /*foreach ($results as $result) {
            $order_data[date('n', strtotime($result->date_added))] = array(
                'month' => date('M', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $order_data;*/
    }

    public function get_total_customers_by_day() {
        $customer_data = array();

        for ($i = 0; $i < 24; $i++) {
            $customer_data[$i] = array(
                'hour'  => $i,
                'total' => 0
            );
        }

        $return_data = $customer_data;

        foreach ($customer_data as $datum) {
            $sql = 'COUNT(*) AS total';
            $this->db->select($sql);
            $this->db->from('customers');
            $this->db->where('HOUR(date_added)', 'DATE(NOW())');
            $this->db->order_by('date_added', 'ASC');

            $result = $this->db->get()->row();
            $return_data[$datum['hour']] = array(
                'hour'  => $datum['hour'],
                'total' => $result->total
            );
        }

        return $return_data;

        /*foreach ($results as $result) {
            $customer_data[$result->hour] = array(
                'hour'  => $result->hour,
                'total' => $result->total
            );
        }
        return $customer_data;*/
    }

    public function get_total_customers_by_week() {
        $customer_data = array();

        $date_start = strtotime('-' . date('w') . ' days');

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', $date_start + ($i * 86400));

            $customer_data[date('w', strtotime($date))] = array(
                'date'   => date('Y-m-d', strtotime($date)),
                'day'   => date('D', strtotime($date)),
                'total' => 0
            );
        }

        $return_data = $customer_data;

        foreach ($return_data as $datum) {
            //$sql = 'COUNT(*) AS total, date_added';
            $sql = 'COUNT(*) AS total';
            $this->db->select($sql);
            $this->db->from('customers');
            $this->db->where("DATE(date_added) = DATE(" . $this->db->escape($datum['date']) . ")");
            $result = $this->db->get()->row();
            $return_data[date('w', strtotime($datum['date']))] = array(
                'day'   => $datum['day'],
                'total' => $result->total
            );
        }

        return $return_data;

        /*foreach ($results as $result) {
            $customer_data[date('w', strtotime($result->date_added))] = array(
                'day'   => date('D', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $customer_data;*/
    }

    public function get_total_customers_by_month() {
        $customer_data = array();

        for ($i = 1; $i <= date('t'); $i++) {
            $date = date('Y') . '-' . date('m') . '-' . $i;

            $customer_data[date('j', strtotime($date))] = array(
                'date'   => date('Y-m-d', strtotime($date)),
                'day'   => date('d', strtotime($date)),
                'total' => 0
            );
        }

        $return_data = $customer_data;

        foreach ($customer_data as $datum) {
            //$sql = 'COUNT(*) AS total, date_added';
            $sql = 'COUNT(*) AS total';
            $this->db->select($sql);
            $this->db->from('customers');
            $this->db->where("DATE(date_added) = DATE(" . $this->db->escape($datum['date'] ).")");
            $this->db->where('YEAR(date_added) =  YEAR(NOW())');
            $result = $this->db->get()->row();
            $return_data[date('j', strtotime($datum['date']))] = array(
                'day'   => $datum['day'],
                'total' => $result->total
            );
        }

        return $return_data;
        /*foreach ($results as $result) {
            $customer_data[date('j', strtotime($result->date_added))] = array(
                'day'   => date('d', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $customer_data;*/
    }

    public function get_total_customers_by_year() {
        $customer_data = array();

        for ($i = 1; $i <= 12; $i++) {
            $customer_data[$i] = array(
                'date'   => date('Y-m-d', mktime(0, 0, 0, $i)),
                'month' => date('M', mktime(0, 0, 0, $i)),
                'total' => 0
            );
        }
        $return_data = $customer_data;
        foreach ($customer_data as $datum) {
            $sql = 'COUNT(*) AS total';
            $this->db->select($sql);
            $this->db->from('customers');
            $this->db->where('MONTH(date_added) = MONTH('. $this->db->escape(date('Y') . '-' . date('m', strtotime($datum['date'])) . '-1') .')');
            $this->db->where('YEAR(date_added) = YEAR(NOW())');

            $result = $this->db->get()->row();
            $return_data[date('n', strtotime($datum['date']))] = array(
                'month' => $datum['month'],
                'total' => $result->total
            );
        }

        return $return_data;

        /*foreach ($results as $result) {
            $customer_data[date('n', strtotime($result->date_added))] = array(
                'month' => date('M', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $customer_data;*/
    }
    public function get_total_orders_by_day2() {

        $order_data = array();

        for ($i = 0; $i < 24; $i++) {
            $order_data[$i] = array(
                'hour'  => $i,
                'total' => 0
            );
        }

        $sql = 'COUNT(*) AS total, HOUR(date_added) AS hour';
        $this->db->select($sql);
        $this->db->from('order');
        $this->db->where('date_added', 'DATE(NOW())');
        $this->db->group_by('HOUR(date_added)');
        $this->db->order_by('date_added', 'ASC');

        $results = $this->db->get()->result();


        foreach ($results as $result) {
            $order_data[$result->hour] = array(
                'hour'  => $result->hour,
                'total' => $result->total
            );
        }

        return $order_data;
    }

    public function get_total_orders_by_week2() {
        
        $order_data = array();

        $date_start = strtotime('-' . date('w') . ' days');

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', $date_start + ($i * 86400));

            $order_data[date('w', strtotime($date))] = array(
                'day'   => date('D', strtotime($date)),
                'total' => 0
            );
        }

        $sql = 'COUNT(*) AS total, date_added';
        $this->db->select($sql);
        $this->db->from('order');
        $this->db->where("DATE(date_added) = DATE(" . $this->db->escape(date('Y-m-d', $date_start)) . ")");
        $this->db->group_by('DAYNAME(date_added)');
        $this->db->order_by('date_added', 'ASC');

        $results = $this->db->get()->result();

        foreach ($results as $result) {
            $order_data[date('w', strtotime($result->date_added))] = array(
                'day'   => date('D', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $order_data;
    }

    public function get_total_orders_by_month2() {

        $order_data = array();

        for ($i = 1; $i <= date('t'); $i++) {
            $date = date('Y') . '-' . date('m') . '-' . $i;

            $order_data[date('j', strtotime($date))] = array(
                'day'   => date('d', strtotime($date)),
                'total' => 0
            );
        }

        $sql = 'COUNT(*) AS total, date_added';
        $this->db->select($sql);
        $this->db->from('order');
        $this->db->where("DATE(date_added) = DATE(" . $this->db->escape(date('Y') . '-' . date('m') . '-1') . ")");
        $this->db->group_by('DAY(date_added)');
        $this->db->order_by('date_added', 'ASC');

        $results = $this->db->get()->result();

        foreach ($results as $result) {
            $order_data[date('j', strtotime($result->date_added))] = array(
                'day'   => date('d', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $order_data;
    }

    public function get_total_orders_by_year2() {

        $order_data = array();

        for ($i = 1; $i <= 12; $i++) {
            $order_data[$i] = array(
                'month' => date('M', mktime(0, 0, 0, $i)),
                'total' => 0
            );
        }

        $sql = 'COUNT(*) AS total, date_added';
        $this->db->select($sql);
        $this->db->from('order');
        $this->db->where('YEAR(date_added) = YEAR(NOW())');
        $this->db->group_by('MONTH(date_added)');
        $this->db->order_by('date_added', 'ASC');

        $results = $this->db->get()->result();

        foreach ($results as $result) {
            $order_data[date('n', strtotime($result->date_added))] = array(
                'month' => date('M', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $order_data;
    }

    public function get_total_customers_by_day2() {
        $customer_data = array();

        for ($i = 0; $i < 24; $i++) {
            $customer_data[$i] = array(
                'hour'  => $i,
                'total' => 0
            );
        }

        $sql = 'COUNT(*) AS total, HOUR(date_added) AS hour';
        $this->db->select($sql);
        $this->db->from('customers');
        $this->db->where('date_added', 'DATE(NOW())');
        $this->db->group_by('HOUR(date_added)');
        $this->db->order_by('date_added', 'ASC');

        $results = $this->db->get()->result();

        foreach ($results as $result) {
            $customer_data[$result->hour] = array(
                'hour'  => $result->hour,
                'total' => $result->total
            );
        }
        return $customer_data;
    }

    public function get_total_customers_by_week2() {
        $customer_data = array();

        $date_start = strtotime('-' . date('w') . ' days');

        for ($i = 0; $i < 7; $i++) {
            $date = date('Y-m-d', $date_start + ($i * 86400));

            $customer_data[date('w', strtotime($date))] = array(
                'day'   => date('D', strtotime($date)),
                'total' => 0
            );
        }

        $sql = 'COUNT(*) AS total, date_added';
        $this->db->select($sql);
        $this->db->from('customers');
        $this->db->where("DATE(date_added) = DATE(" . $this->db->escape(date('Y-m-d', $date_start)) . ")");
        $this->db->group_by('DAYNAME(date_added)');
        $this->db->order_by('date_added', 'ASC');

        $results = $this->db->get()->result();

        foreach ($results as $result) {
            $customer_data[date('w', strtotime($result->date_added))] = array(
                'day'   => date('D', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $customer_data;
    }

    public function get_total_customers_by_month2() {
        $customer_data = array();

        for ($i = 1; $i <= date('t'); $i++) {
            $date = date('Y') . '-' . date('m') . '-' . $i;

            $customer_data[date('j', strtotime($date))] = array(
                'day'   => date('d', strtotime($date)),
                'total' => 0
            );
        }

        $sql = 'COUNT(*) AS total, date_added';
        $this->db->select($sql);
        $this->db->from('customers');
        $this->db->where("DATE(date_added) = DATE(" . $this->db->escape(date('Y') . '-' . date('m') . '-1') . ")");
        $this->db->group_by('DAY(date_added)');
        $this->db->order_by('date_added', 'ASC');

        $results = $this->db->get()->result();


        foreach ($results as $result) {
            $customer_data[date('j', strtotime($result->date_added))] = array(
                'day'   => date('d', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $customer_data;
    }

    public function get_total_customers_by_year2() {
        $customer_data = array();

        for ($i = 1; $i <= 12; $i++) {
            $customer_data[$i] = array(
                'month' => date('M', mktime(0, 0, 0, $i)),
                'total' => 0
            );
        }

        $sql = 'COUNT(*) AS total, date_added';
        $this->db->select($sql);
        $this->db->from('customers');
        $this->db->where('YEAR(date_added) = YEAR(NOW())');
        $this->db->group_by('MONTH(date_added)');
        $this->db->order_by('date_added', 'ASC');

        $results = $this->db->get()->result();

        foreach ($results as $result) {
            $customer_data[date('n', strtotime($result->date_added))] = array(
                'month' => date('M', strtotime($result->date_added)),
                'total' => $result->total
            );
        }

        return $customer_data;
    }

    public function get_latest_orders($limit=5)
    {
        return $this->db->select('*')->from('order')->where('order_status_id' , 6)->limit($limit)->order_by('date_added','DESC')->get()->result();
    }

    public function get_most_viewed_products($limit=5)
    {
        $this->db->select('p.*, b.name as brand');
        $this->db->from($this->db->dbprefix . 'products p');
        $this->db->join($this->db->dbprefix . 'brands b', 'b.brand_id = p.brand_id');
        $this->db->where('p.is_enabled', 1);
        $this->db->order_by('p.views', 'DESC');
        $this->db->limit($limit);
        return	$this->db->get()->result();
    }

    public function get_bestseller_products($limit = 5){
        $this->db->select('products.*, COUNT(ci_order_products.product_id) AS total');
    $this->db->from('products');
    $this->db->join('ci_order_products', 'products.product_id = ci_order_products.product_id', 'left');
    $this->db->group_by('products.product_id');
    $this->db->order_by('total','DESC');
    $this->db->where('total >',0);
    $query = $this->db->get();
    return $R =  $query->result();

    }

    public function get_latest_customers($limit=5)
    {
        return $this->db->select('*')->from('customers')->limit($limit)->order_by('date_added','DESC')->get()->result();
    }

    public function get_latest_club_members($limit=5)
    {
        //return $this->db->select('*')->from('join_club')->limit($limit)->order_by('date_added','DESC')->get()->result();
    }

    public function get_latest_contact_us($limit=5)
    {
        return $this->db->select('*')->from('contact_us')->limit($limit)->order_by('date_added','DESC')->get()->result();
    }

}
