<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_setting_model extends Admin_Model {

    function __construct()
    {
        parent::__construct();
    }
	
	function get_settings($code='config')
	{
		$this->db->where('code', $code);
		$result	= $this->db->get('settings')->result();
		if(!$result)
		{
			return false;
		}
		
		$return	= array();
		foreach($result as $val)
		{
			$return[$val->key]	= ($val->is_json == 1 ? json_decode($val->value, TRUE) : $val->value);
		}
		
		return $return;
	}

	function save_settings($code, $values)
	{
		$settings	= $this->get_settings($code);
	
		foreach($values as $key=>$value)
		{
			if(!empty($settings) and array_key_exists($key, $settings))
			{
				$update	= array('value'=>$value);
				$this->db->where('code', $code);
				$this->db->where('key',$key);
				$this->db->update('settings', $update);
			}
			else
			{
				$insert	= array('code'=>$code, 'key'=>$key, 'value'=>$value, );
				$this->db->insert('settings', $insert);
			}
		}
	}
	
	function delete_settings($code)
	{
		$this->db->where('code', $code);
		$this->db->delete('settings');
	}
	
	function delete_setting($code, $setting_key)
	{
		$this->db->where('code', $code);
		$this->db->where('key', $setting_key);
		$this->db->delete('settings');
	}

	public function getGeneralSettingByCodeAndKey($data){
		$this->db->select('*')->from('settings');
		if(isset($data['code']) && !empty($data['code']) && isset($data['key']) && !empty($data['key'])){
			$this->db->where('code', $data['code']);
			$this->db->where('key', $data['key']);
		}else{
			return false;
		}
		$result = $this->db->get()->row();
		if($result->is_json == 1){
			$result->value = json_decode($result->value, TRUE);
		}

		return $result;
	}

	public function saveGeneralSetting($data){
    	$success_flag = false;
		if(isset($data['code']) && !empty($data['code']) && isset($data['key']) && !empty($data['key'])){
			$this->db->select('*')->from('settings');
			$this->db->where('code', $data['code']);
			$this->db->where('key', $data['key']);
			$result = $this->db->get();
			if($result->num_rows()){
				$settings_id = $result->row()->setting_id;
				if($this->db->where('setting_id',$settings_id)->update('settings',array('value' => $data['value'], 'is_json' => $data['is_json']))){
					$success_flag = true;
				}
			}else{
				if($this->db->insert('settings', $data)){
					$success_flag = true;
				}
			}
		}
		return $success_flag;

	}

    function get_state_typehead($data=array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }
        else
        {

            $sql = 'zone_id as value, name as label';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('country_zones');
            $this->db->where(1,1, FALSE);

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
            }

            if(!empty($data['term']))
            {
                $search	= json_decode($data['term']);
                if(!empty($search->term))
                {
                    $this->db->group_start();
                    $this->db->like('name', $search->term);
                    $this->db->or_like('zone_id', $search->term);
                    $this->db->group_end();
                }
            }

            $result = $this->db->get()->result();

        }

        if(!$result)
        {
            return false;
        }

        return $result;

    }


}
