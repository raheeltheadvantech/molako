<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin_extensions_model extends Admin_Model {

	function __construct()
	{
		parent::__construct();
	}

    public function get_payments($data = array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }else{
            $sql = '*';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('settings');
            // $this->db->where(1,1, FALSE);
            $this->db->where('type', 'payment');
            $this->db->group_by('code');

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
                $search = json_decode($data['term']);
                if(!empty($search->term))
                {
                    $this->db->group_start();
                    $this->db->like('code', $search->term);
                    $this->db->or_like('key', $search->term);
                    $this->db->group_end();
                }
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
                
                /*echo "<pre>";
                print_r($this->db->last_query());
                echo "</pre>";
                exit;*/
            }

            if(!$result)
            {
                return false;
            }

            return $result;
            
        }
        //return $this->db->select('*')->from('end_users')->order_by('date_added','DESC')->get()->result();
    }

    public function get_shipping($data = array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }else{
            $sql = '*';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('settings');
            // $this->db->where(1,1, FALSE);
            $this->db->where('type', 'shipping');
            $this->db->group_by('code');

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
                $search = json_decode($data['term']);
                if(!empty($search->term))
                {
                    $this->db->group_start();
                    $this->db->like('code', $search->term);
                    $this->db->or_like('key', $search->term);
                    $this->db->group_end();
                }
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
                
                /*echo "<pre>";
                print_r($this->db->last_query());
                echo "</pre>";
                exit;*/
            }

            if(!$result)
            {
                return false;
            }

            return $result;
            
        }
        //return $this->db->select('*')->from('end_users')->order_by('date_added','DESC')->get()->result();
    }

    public function get_totals($data = array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }else{
            $sql = '*';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('settings');
            // $this->db->where(1,1, FALSE);
            $this->db->where('type', 'totals');
            $this->db->group_by('code');

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
                $search = json_decode($data['term']);
                if(!empty($search->term))
                {
                    $this->db->group_start();
                    $this->db->like('code', $search->term);
                    $this->db->or_like('key', $search->term);
                    $this->db->group_end();
                }
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
                
                /*echo "<pre>";
                print_r($this->db->last_query());
                echo "</pre>";
                exit;*/
            }

            if(!$result)
            {
                return false;
            }

            return $result;
            
        }
        //return $this->db->select('*')->from('end_users')->order_by('date_added','DESC')->get()->result();
    }

    public function get_extension($code)
    {
        return $this->db->select('*')->from('settings')->where('code',$code)->get()->result();
    }
    // *****************************************************************
    public function get_extensions($data = array(), $return_count=false)
    {
        if(empty($data) and !$return_count)
        {
            return false;
        }else{
            $sql = '*';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }

            $this->db->select($sql);
            $this->db->from('extensions');
            $this->db->where(1,1, FALSE);

            if(!empty($data['scope']))
            {
                $this->db->where('scope', $data['scope']);
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
            }

            if(!empty($data['term']))
            {
                $search = json_decode($data['term']);
                if(!empty($search->term))
                {
                    $this->db->group_start();
                    $this->db->like('scope', $search->term);
                    $this->db->or_like('name', $search->term);
                    $this->db->group_end();
                }
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
                
                /*echo "<pre>";
                print_r($this->db->last_query());
                echo "</pre>";
                exit;*/
            }

            if(!$result)
            {
                return false;
            }


         foreach ($result as $key=>$value){
             $result[$key]->status =  $this->get_extension_status($value->scope ,$value->code);

         }

            return $result;
            
        }
        //return $this->db->select('*')->from('end_users')->order_by('date_added','DESC')->get()->result();
    }

    public function get_extensionold($extension_id)
    {
        return $this->db->select('*')->from('extensions')->where('extension_id',$extension_id)->get()->row();
    }

    function save($data)
    {
        /*if ($data['end_user_id'])
        {
            $this->db->where('end_user_id', $data['end_user_id']);
            $this->db->update('end_users', $data);
            $id	= $data['end_user_id'];
        }
        else
        {
            $this->db->insert('end_users', $data);
            $id	= $this->db->insert_id();
        }

        return $id;*/
    }

    /**
     * @param $code is equal to scope of extension
     * @param $key is equal to code of extension
     * @return mixed
     */

    public function get_extension_status($type , $code){
        $key =  $code.'_status';
        $this->db->select('*')->from('settings');
        $this->db->where('type', $type);
        $this->db->where('code', $code);
        $this->db->where('key', $key);
        $result =  $this->db->get()->result();

        if(!$result)
        {
            return false;
        }

        return $result[0]->value;

    }



    public function get_extension_setting($type , $code){
        $this->db->select('*')->from('settings');
        $this->db->where('type', $type);
        $this->db->where('code', $code);
        return $this->db->get()->result();
    }
    
    public function save_extension_setting($data)
    {
        foreach ($data as $key => $val){
            $temp = explode('_', $key);
            $setting_id = end($temp);

            $input_data = array(
                'value'  => $val
            );
            $this->db->where('setting_id', $setting_id)->update('settings', $input_data);
        }
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


}
