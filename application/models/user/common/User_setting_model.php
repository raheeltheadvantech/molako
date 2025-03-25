<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_setting_model extends User_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_settings($code='config')
	{
		$this->db->where('code', $code);
		$result	= $this->db->get('settings');
		
		$return	= array();
		foreach($result->result() as $results)
		{
			$return[$results->key]	= ($results->is_json == 1 ? json_decode($results->value, TRUE) : $results->value);
		}
		
		return $return;	
	}

	function get_setting($code)
	{
		$this->db->like('type', $code);
		$this->db->where('key', 'total');
		$result	= $this->db->get('settings')->row();
		return $result;	
	}



	private function get_general_settings($data)
	{
		$output = array();
		$this->db->select('*')->from('settings');
		if(isset($data['code']) && !empty($data['code']) 
			&& isset($data['key']) && !empty($data['key']) 
			&& isset($data['type']) && !empty($data['type'])){
			$this->db->where('type', $data['type']);
			$this->db->where('code', $data['code']);
			$this->db->where('key', $data['key']);
			$results = $this->db->get()->result();

			if($results) {
				foreach ($results as $key => $result) {
					$result->value = json_decode($result->value, TRUE);
					$results->{$key} = $result;
				}
			}
			$output = $results;
		}
		elseif(isset($data['code']) && !empty($data['code']) && isset($data['key']) && !empty($data['key'])){
			$this->db->where('code', $data['code']);
			$this->db->where('key', $data['key']);
			$result = $this->db->get()->row();

			if($result->is_json == 1){
				$result->value = json_decode($result->value, TRUE);
			}
			$output = $result;
		}
		elseif(isset($data['type']) && !empty($data['type'])){
			$this->db->where('type', $data['type']);
			$output = $this->db->get()->result();

		}else{
			return false;
		}
		return $output;
	}

	public function get_payment_methods()
	{
		// $input_data = array(
		// 	'type'	=> 'payment',
		// );

		// $results =  $this->get_general_settings($input_data);
		// $output = array();
		// if($results) {
		// 	foreach ($results as $key => $result) {
		// 		$output[$result->code][$result->key] = $result->value;
		// 	}
		// }

		$this->db->select('*')->from('settings');
		$this->db->where('type','payment');
		$result = $this->db->get()->result();

		if(!$result) 
		{
			return false;
		}

		$dt = array();
		foreach ($result as $key => $val)
		{

			if($val->is_json == 1)
			{
				$val->value = json_decode($val->value);
			}
			unset($val->is_json,$val->setting_id,$val->type);

			if(isset($dt[$val->code]))
			{
				// $dt[$val->code] = array_merge($dt[$val->code], (array)$val);
				array_push($dt[$val->code], (array)$val);
			}
			else
			{
				$dt[$val->code] = (array)$val;
			}
		}

		$dt2=  array();
		foreach($dt as $key => $vl)
		{
			$ar = array(
				'key' => $vl[0]['key'],
				'value' => $vl[0]['value']
			);
			// $dt2[] = $ar;
			array_merge($dt[$key], $ar);
			$dt2[$vl[0]['code']] = array_column($dt[$key], 'value','key');
		}
		// echo'<pre>';print_r($dt2);die;
		return $dt2;
	}

	public function get_shipping_methods()
	{
		$this->db->select('*')->from('settings');
		$this->db->where('type','shipping');
		$result = $this->db->get()->result();
		// dd($result);

		if(!$result) 
		{
			return false;
		}

		$dt = array();
		foreach ($result as $key => $val)
		{

			if($val->is_json == 1)
			{
				$val->value = json_decode($val->value);
			}
			unset($val->is_json,$val->setting_id,$val->type);

			if(isset($dt[$val->code]))
			{
				// $dt[$val->code] = array_merge($dt[$val->code], (array)$val);
				array_push($dt[$val->code], (array)$val);
			}
			else
			{
				$dt[$val->code] = (array)$val;
			}
		}

		$dt2=  array();
		foreach($dt as $key => $vl)
		{
			$ar = array(
				'key' => $vl[0]['key'],
				'value' => $vl[0]['value']
			);
			// $dt2[] = $ar;
			array_merge($dt[$key], $ar);
			$dt2[$vl[0]['code']] = array_column($dt[$key], 'value','key');
		}
		// echo'<pre>';print_r($dt2);die;
		return $dt2;

	}


	// 	}

	// 	$output = $results;

	// 	// $input_data = array(
	// 	// 	'type'	=> 'shipping',
	// 	// );

	// 	$results =  $this->get_general_settings($input_data);
	// 	$output = array();
	// 	if($results) {
	// 		foreach ($results as $key => $result) {
	// 			$output[$result->code][$result->key] = $result->value;
	// 		}
	// 	}
	// 	return $output;
	// }
	
	public function load_settings($code = '')
	{
		$settings = $this->get_settings($code);
		
		if(!empty($settings)):
			foreach ($settings as $setting_key=>$setting_val)
			{
				$this->site_config->set_item($setting_key, $setting_val);
			}
		endif;
	}

	
}
