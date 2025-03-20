<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Discount {

	private $CI;
	
	public function __construct() {
		
		$this->CI =& get_instance();
		$this->CI->load->database();
	}

    public function calculate($value, $return_include = false)
    {
        $amount = 0;
        $discount_config = $this->get_discount_config();
        //if($discount_config->status && $discount_config->is_eligible) {
        if($discount_config->status) {
            if ($discount_config->type == 'percent') {
                $amount = ($discount_config->value / 100) * $value;
            } elseif ($discount_config->type == 'fixed') {
                $amount = $discount_config->value;
            }
        }

        if($return_include){
            return $value - $amount;
        }else{
            return $amount;
        }
    }

    public function get_discount_config()
    {
        $result = new stdClass();
        $result->status = site_config_item('everyone_discount_status');
        $result->type  = site_config_item('everyone_discount_type');
        $result->value = site_config_item('everyone_discount_value');
        $result->is_eligible = $this->is_user_eligible_for_discount();
        return $result;
        
    }

	public function is_user_eligible_for_discount(){
		$this->CI->load->model('user/common/User_join_club_model');
		$user = $this->CI->user_session->userdata('user');
		return $this->CI->User_join_club_model->is_already_exist($user['email'], $user['id']);
    }
}
