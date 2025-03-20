<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_order_return_model extends Admin_Model 
{
	function __construct()
	{
		parent::__construct();
	}

	private function get_return_count()
	{
		$this->db->select('COUNT(*) AS found_total');
		$this->db->from('return');
		$result = $this->db->get()->row();
		
		if(!$result)
		{
			return false;
		}
		
		return $result->found_total;
	}
	
	function get_order_returns($data=array(), $return_count=false)
	{

		if(empty($data) and !$return_count)
		{
			return false;
		}
		else
		{
			
			$sql = '*,';
			$sql .= '(SELECT `name` FROM '. $this->db->dbprefix .'order_status os WHERE os.order_status_id = '. $this->db->dbprefix .'return.return_status_id) as return_status_name';
			if($return_count === TRUE)
			{
				$sql = 'COUNT(*) AS found_total';
			}
			
			$this->db->select($sql);
			$this->db->from('return');
			$this->db->where(1,1, FALSE);
			$this->db->where('return_status_id <>', 0);
			
			if(isset($data['customer_id']) && !empty($data['customer_id'])){
                $this->db->where('customer_id', $data['customer_id']);
            }
			if(!empty($data['rows']))
			{
				$this->db->limit($data['rows']);
			}
			
			if(!empty($data['per_page']))
			{
				$this->db->offset($data['per_page']);
			}
			
			if(!empty($data['order']))
			{
				$this->db->order_by($data['order'], $data['sort']);
			}else{
				$this->db->order_by('date_added', 'DESC');
			}
			
			if(!empty($data['term']))
			{
				$search	= json_decode($data['term']);
				if(!empty($search->term))
				{
					$this->db->group_start();
					$this->db->like('firstname', $search->term);
					$this->db->or_like('lastname', $search->term);
					$this->db->group_end();
				}

				
				if(!empty($search->order_filter) && $search->order_filter != -1){
					$this->db->where('return_id', $search->vendor_filter);
				}

				if(!empty($search->customer_id) && $search->customer_id != -1){
					$this->db->where('customer_id', $search->customer_id);
				}
			}

			if(!empty($search->start_date))
			{
				$this->db->where('DATE(date_added) >=',$search->start_date);
			}
			
			if(!empty($search->end_date))
			{
				$this->db->where('DATE(date_added) <=',$search->end_date);
			}
			
			if($return_count)
			{
				$result = $this->db->get()->row();
				if(!$result)
				{
					return false;
				}
				
				return $result->found_total; 
			}
			else
			{
				$result = $this->db->get()->result();
			}
		}
		
		if(!$result)
		{
			return false;
		}
		
		return $result;
	}

	public function get_order_return($return_id)
	{
		return $this->db->select('o.*, (SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = o.return_status_id)as order_status_name')->from('return o')->where('o.return_id', $return_id)->get()->row();
	}

	public function get_order_products($order_id)
	{
		return $this->db->select('*')->from('order_products')->where('order_id', $order_id)->get()->result();
	}

	public function get_order_totals($order_id)
	{
		return $this->db->select('*')->from('order_total')->where('order_id', $order_id)->order_by('sort_order', 'ASC')->get()->result();
	}

	public function get_order_history($order_id)
	{
		return $this->db->select('oh.*, (SELECT `name` FROM '. $this->db->dbprefix .'order_status WHERE order_status_id = oh.order_status_id)as order_status_name')->from('order_history oh')->where('oh.order_id', $order_id)->order_by('date_added', 'DESC')->get()->result();
	}

	public function get_order_status()
	{
		return $this->db->select('*')->from('order_status')->order_by('order_status_id', 'ASC')->get()->result();
	}
	public function get_order_status_name()
	{
		return $this->db->select('name')->from('order_status')->get()->row()->name;
	}
	public function get_order_status_by_status_id($order_status_id)
	{
		return $this->db->select('name')->from('order_status')->where('order_status_id', $order_status_id)->get()->row()->name;
	}

	public function save_history($data)
	{
		$this->db->trans_start();
		$success_flag = false;
		if($this->db->insert('order_history', $data)){
			$success_flag = true;
		}

		if($success_flag){
			if($this->db->where('order_id',$data['order_id'])->update('order', array('order_status_id' => $data['order_status_id']))){
				$success_flag = true;
			}else{
				$success_flag = false;
			}
		}

		if($success_flag){
			$this->db->trans_complete();
		}
		return $success_flag;
	}

	// ******************************************************************

	public function addReturn($data) 
	{
		$this->db->query("INSERT INTO `" . $this->db->dbprefix . "return` SET order_id = '" . (int)$data['order_id'] . "', product_id = '" . (int)$data['product_id'] . "', customer_id = '" . (int)$data['customer_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', product = '" . $this->db->escape($data['product']) . "', model = '" . $this->db->escape($data['model']) . "', quantity = '" . (int)$data['quantity'] . "', opened = '" . (int)$data['opened'] . "', return_reason_id = '" . (int)$data['return_reason_id'] . "', return_action_id = '" . (int)$data['return_action_id'] . "', return_status_id = '" . (int)$data['return_status_id'] . "', comment = '" . $this->db->escape($data['comment']) . "', date_ordered = '" . $this->db->escape($data['date_ordered']) . "', date_added = NOW(), date_modified = NOW()");
	
		return $this->db->getLastId();
	}

	public function editReturn($return_id, $data) 
	{
		$this->db->query("UPDATE `" . $this->db->dbprefix . "return` SET order_id = '" . (int)$data['order_id'] . "', product_id = '" . (int)$data['product_id'] . "', customer_id = '" . (int)$data['customer_id'] . "', firstname = '" . $this->db->escape($data['firstname']) . "', lastname = '" . $this->db->escape($data['lastname']) . "', email = '" . $this->db->escape($data['email']) . "', telephone = '" . $this->db->escape($data['telephone']) . "', product = '" . $this->db->escape($data['product']) . "', model = '" . $this->db->escape($data['model']) . "', quantity = '" . (int)$data['quantity'] . "', opened = '" . (int)$data['opened'] . "', return_reason_id = '" . (int)$data['return_reason_id'] . "', return_action_id = '" . (int)$data['return_action_id'] . "', comment = '" . $this->db->escape($data['comment']) . "', date_ordered = '" . $this->db->escape($data['date_ordered']) . "', date_modified = NOW() WHERE return_id = '" . (int)$return_id . "'");
	}

	public function deleteReturn($return_id) {
		$this->db->query("DELETE FROM `" . $this->db->dbprefix . "return` WHERE `return_id` = '" . (int)$return_id . "'");
		$this->db->query("DELETE FROM `" . $this->db->dbprefix . "return_history` WHERE `return_id` = '" . (int)$return_id . "'");
	}

	public function getReturn($return_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT CONCAT(c.firstname, ' ', c.lastname) FROM " . $this->db->dbprefix . "customer c WHERE c.customer_id = r.customer_id) AS customer, (SELECT rs.name FROM " . $this->db->dbprefix . "return_status rs WHERE rs.return_status_id = r.return_status_id AND rs.language_id = '" . (int)$this->config->get('config_language_id') . "') AS return_status FROM `" . $this->db->dbprefix . "return` r WHERE r.return_id = '" . (int)$return_id . "'");

		return $query->row;
	}

	public function getReturns($data = array()) {
		$sql = "SELECT *, CONCAT(r.firstname, ' ', r.lastname) AS customer, (SELECT rs.name FROM " . $this->db->dbprefix . "return_status rs WHERE rs.return_status_id = r.return_status_id AND rs.language_id = '" . (int)$this->config->get('config_language_id') . "') AS return_status FROM `" . $this->db->dbprefix . "return` r";

		$implode = array();

		if (!empty($data['filter_return_id'])) {
			$implode[] = "r.return_id = '" . (int)$data['filter_return_id'] . "'";
		}

		if (!empty($data['filter_order_id'])) {
			$implode[] = "r.order_id = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$implode[] = "CONCAT(r.firstname, ' ', r.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_product'])) {
			$implode[] = "r.product = '" . $this->db->escape($data['filter_product']) . "'";
		}

		if (!empty($data['filter_model'])) {
			$implode[] = "r.model = '" . $this->db->escape($data['filter_model']) . "'";
		}

		if (!empty($data['filter_return_status_id'])) {
			$implode[] = "r.return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$implode[] = "DATE(r.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$sort_data = array(
			'r.return_id',
			'r.order_id',
			'customer',
			'r.product',
			'r.model',
			'status',
			'r.date_added',
			'r.date_modified'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.return_id";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getTotalReturns($data = array()) {
		$sql = "SELECT COUNT(*) AS total FROM `" . $this->db->dbprefix . "return`r";

		$implode = array();

		if (!empty($data['filter_return_id'])) {
			$implode[] = "r.return_id = '" . (int)$data['filter_return_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$implode[] = "CONCAT(r.firstname, ' ', r.lastname) LIKE '" . $this->db->escape($data['filter_customer']) . "%'";
		}

		if (!empty($data['filter_order_id'])) {
			$implode[] = "r.order_id = '" . $this->db->escape($data['filter_order_id']) . "'";
		}

		if (!empty($data['filter_product'])) {
			$implode[] = "r.product = '" . $this->db->escape($data['filter_product']) . "'";
		}

		if (!empty($data['filter_model'])) {
			$implode[] = "r.model = '" . $this->db->escape($data['filter_model']) . "'";
		}

		if (!empty($data['filter_return_status_id'])) {
			$implode[] = "r.return_status_id = '" . (int)$data['filter_return_status_id'] . "'";
		}

		if (!empty($data['filter_date_added'])) {
			$implode[] = "DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		if (!empty($data['filter_date_modified'])) {
			$implode[] = "DATE(r.date_modified) = DATE('" . $this->db->escape($data['filter_date_modified']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalReturnsByReturnStatusId($return_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . $this->db->dbprefix . "return` WHERE return_status_id = '" . (int)$return_status_id . "'");

		return $query->row['total'];
	}

	public function getTotalReturnsByReturnReasonId($return_reason_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . $this->db->dbprefix . "return` WHERE return_reason_id = '" . (int)$return_reason_id . "'");

		return $query->row['total'];
	}

	public function getTotalReturnsByReturnActionId($return_action_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM `" . $this->db->dbprefix . "return` WHERE return_action_id = '" . (int)$return_action_id . "'");

		return $query->row['total'];
	}
	
	public function addReturnHistory($return_id, $return_status_id, $comment, $notify) {
		$this->db->query("UPDATE `" . $this->db->dbprefix . "return` SET `return_status_id` = '" . (int)$return_status_id . "', date_modified = NOW() WHERE return_id = '" . (int)$return_id . "'");
		$this->db->query("INSERT INTO `" . $this->db->dbprefix . "return_history` SET `return_id` = '" . (int)$return_id . "', return_status_id = '" . (int)$return_status_id . "', notify = '" . (int)$notify . "', comment = '" . $this->db->escape(strip_tags($comment)) . "', date_added = NOW()");
	}

	public function getReturnHistories($return_id, $start = 0, $limit = 10) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 10;
		}

		$query = $this->db->query("SELECT rh.date_added, rs.name AS status, rh.comment, rh.notify FROM " . $this->db->dbprefix . "return_history rh LEFT JOIN " . $this->db->dbprefix . "return_status rs ON rh.return_status_id = rs.return_status_id WHERE rh.return_id = '" . (int)$return_id . "' AND rs.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY rh.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalReturnHistories($return_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . $this->db->dbprefix . "return_history WHERE return_id = '" . (int)$return_id . "'");

		return $query->row['total'];
	}

	public function getTotalReturnHistoriesByReturnStatusId($return_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . $this->db->dbprefix . "return_history WHERE return_status_id = '" . (int)$return_status_id . "'");

		return $query->row['total'];
	}
}