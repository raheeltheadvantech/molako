<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Tax {
	
	private $tax_rates = array();
	private $tax_category_id;
	private $CI;
	
	public function __construct() {
		
		$this->CI =& get_instance();
		$this->CI->load->database();
	}

	public function unset_rates() {
		$this->tax_rates = array();
	}

	public function get_tax_category_id()
	{
		return $this->tax_category_id;
	}
	
	public function get_tax_rates()
	{
		return $this->tax_rates;
	}
	
	public function set_tax_category_id($country_id, $zone_id)
	{
		$this->CI->db->select('tr1.tax_category_id');
		$this->CI->db->from('tax_rules AS tr1');
		$this->CI->db->join('tax_rates AS tr2', 'tr1.tax_rate_id = tr2.tax_rate_id', 'LEFT');
		// $this->CI->db->join('tax_rate_to_customer_groups AS tr2cg', 'tr2.tax_rate_id = tr2cg.tax_rate_id');
		$this->CI->db->join('zone_to_geo_zone AS z2gz', 'tr2.geo_zone_id = z2gz.geo_zone_id', 'LEFT');
		$this->CI->db->join('geo_zones AS gz', 'tr2.geo_zone_id = gz.geo_zone_id', 'LEFT');
		
		$this->CI->db->where('tr1.based_on', 'store_address');
		// $this->CI->db->where('tr2cg.customer_group_id', config_item('config_customer_group_id'));
		$this->CI->db->where('z2gz.country_id', $country_id);
		$this->CI->db->group_start();
		$this->CI->db->where('z2gz.zone_id', 0);
		$this->CI->db->or_where('z2gz.zone_id', $zone_id);
		$this->CI->db->group_end();
		$this->CI->db->order_by('tr1.priority', 'ASC');
		$this->CI->db->limit(1);
		$result = $this->CI->db->get()->row();
		// echo $this->CI->db->last_query();
		
		if(!$result)
		{
			return false;
		}
		
		$this->set_store_address($country_id, $zone_id);
		// $this->set_shipping_address($country_id, $zone_id);
		// $this->set_payment_address($country_id, $zone_id);
		
		$this->tax_category_id = $result->tax_category_id;
	}


    public function set_shipping_address($country_id, $zone_id)
    {

        $this->CI->db->select('tr1.tax_class_id, tr2.tax_rate_id, tr2.name, tr2.rate, tr2.type, tr1.priority');
        $this->CI->db->from('tax_rule AS tr1');
        $this->CI->db->join('tax_rate AS tr2', 'tr1.tax_rate_id = tr2.tax_rate_id', 'LEFT');
        $this->CI->db->join('zone_to_geo_zone AS z2gz', 'tr2.geo_zone_id = z2gz.geo_zone_id', 'LEFT');
        // $this->CI->db->join('geo_zone AS gz', 'tr2.geo_zone_id = gz.geo_zone_id', 'LEFT');

        $this->CI->db->where('tr1.based', 'shipping');

        $this->CI->db->where('z2gz.country_id', $country_id);
        // $this->CI->db->group_start();
        // $this->CI->db->where('z2gz.zone_id', 0);
        // $this->CI->db->or_where('z2gz.zone_id', $zone_id);
        $this->CI->db->where('z2gz.zone_id', $zone_id);
        // $this->CI->db->group_end();

        $this->CI->db->order_by('tr1.priority', 'ASC');


        $result = $this->CI->db->get()->result_array();
		// echo'get taxes<pre>';print_r($result);die;
        if(!$result)
        {
            return false;
        }

        foreach ($result as $key=>$val) {
            $this->tax_rates[$val['tax_class_id']][$val['tax_rate_id']] = array(
                'tax_rate_id' => $val['tax_rate_id'],
                'name'        => $val['name'],
                'rate'        => $val['rate'],
                'type'        => $val['type'],
                'priority'    => $val['priority']
            );
        }
    }

    public function set_payment_address($country_id, $zone_id)
    {

        $this->CI->db->select('tr1.tax_class_id, tr2.tax_rate_id, tr2.name, tr2.rate, tr2.type, tr1.priority');
        $this->CI->db->from('tax_rule AS tr1');
        $this->CI->db->join('tax_rate AS tr2', 'tr1.tax_rate_id = tr2.tax_rate_id', 'LEFT');
        $this->CI->db->join('zone_to_geo_zone AS z2gz', 'tr2.geo_zone_id = z2gz.geo_zone_id', 'LEFT');
        // $this->CI->db->join('geo_zone AS gz', 'tr2.geo_zone_id = gz.geo_zone_id', 'LEFT');

        $this->CI->db->where('tr1.based', 'payment');

        $this->CI->db->where('z2gz.country_id', $country_id);
        // $this->CI->db->group_start();
        // $this->CI->db->where('z2gz.zone_id', 0);
        // $this->CI->db->or_where('z2gz.zone_id', $zone_id);
        $this->CI->db->where('z2gz.zone_id', $zone_id);
        // $this->CI->db->group_end();

        $this->CI->db->order_by('tr1.priority', 'ASC');
        $result = $this->CI->db->get()->result_array();

        if(!$result)
        {
            return false;
        }

        foreach ($result as $key=>$val) {
            $this->tax_rates[$val['tax_class_id']][$val['tax_rate_id']] = array(
                'tax_rate_id' => $val['tax_rate_id'],
                'name'        => $val['name'],
                'rate'        => $val['rate'],
                'type'        => $val['type'],
                'priority'    => $val['priority']
            );
        }

    }

	public function set_store_address($country_id, $zone_id)
	{

		$this->CI->db->select('tr1.tax_class_id, tr2.tax_rate_id, tr2.name, tr2.rate, tr2.type, tr1.priority');
		$this->CI->db->from('tax_rule AS tr1');
		$this->CI->db->join('tax_rate AS tr2', 'tr1.tax_rate_id = tr2.tax_rate_id', 'LEFT');
		//$this->CI->db->join('tax_rate_to_customer_groups AS tr2cg', 'tr2.tax_rate_id = tr2cg.tax_rate_id');
		$this->CI->db->join('zone_to_geo_zone AS z2gz', 'tr2.geo_zone_id = z2gz.geo_zone_id', 'LEFT');
		$this->CI->db->join('geo_zone AS gz', 'tr2.geo_zone_id = gz.geo_zone_id', 'LEFT');
		
		$this->CI->db->where('tr1.based', 'store');
		//$this->CI->db->where('tr2cg.customer_group_id', config_item('config_customer_group_id'));
		$this->CI->db->where('z2gz.country_id', $country_id);
		$this->CI->db->group_start();
		$this->CI->db->where('z2gz.zone_id', 0);
		$this->CI->db->or_where('z2gz.zone_id', $zone_id);
		$this->CI->db->group_end();
		$this->CI->db->order_by('tr1.priority', 'ASC');
		$result = $this->CI->db->get()->result_array();

		if(!$result)
		{
			return false;
		}

		foreach ($result as $key=>$val) {
			$this->tax_rates[$val['tax_class_id']][$val['tax_rate_id']] = array(
				'tax_rate_id' => $val['tax_rate_id'],
				'name'        => $val['name'],
				'rate'        => $val['rate'],
				'type'        => $val['type'],
				'priority'    => $val['priority']
			);
		}

	}

	public function calculate($value, $tax_class_id, $calculate = true)
	{

	    if ($tax_class_id && $calculate) {
			$amount = 0;

			 $tax_rates = $this->get_rates($value, $tax_class_id);

			foreach ($tax_rates as $tax_rate) {
				if ($calculate != 'P' && $calculate != 'F') {
					$amount += $tax_rate['amount'];
				} elseif ($tax_rate['type'] == $calculate) {
					$amount += $tax_rate['amount'];
				}
			}

			return $value + $amount;
		} else {
			return $value;
		}
	}

	public function get_tax($value, $tax_category_id) 
	{
		$amount = 0;

		$tax_rates = $this->get_rates($value, $tax_category_id);

		foreach ($tax_rates as $tax_rate) {
			$amount += $tax_rate['amount'];
		}

		return $amount;
	}

	public function get_tax_info($value, $tax_category_id) 
	{
		$tax_rates = $this->get_rates($value, $tax_category_id);

		return $tax_rates;
	}

	public function get_rate_name($tax_rate_id) {
		
		$this->CI->db->select('name');
		$this->CI->db->from('tax_rates');
		$this->CI->db->where('tax_rate_id', $tax_rate_id);
		$this->CI->db->limit(1);
		$result = $this->CI->db->get()->row();
		
		if(!$result)
		{
			return false;
		}
		
		return $result->name;
	}


    public function get_tax_price($region_id) {

        $this->CI->db->select('tax_rate');
        $this->CI->db->from('ci_taxes');
        $this->CI->db->where('region_id', $region_id);
        $this->CI->db->limit(1);
        $result = $this->CI->db->get()->row();

        if(!$result)
        {
            return false;
        }

        return $result->tax_rate;
    }


	public function get_tax_rate($tax_rate_id) {
		
		$this->CI->db->select('*');
		$this->CI->db->from('tax_rate');
		$this->CI->db->where('tax_rate_id', $tax_rate_id);
		$this->CI->db->limit(1);
		$result = $this->CI->db->get()->row();
		
		if(!$result)
		{
			return false;
		}
		
		return $result;

	}

    public function get_tax_name($tax_rate_id) {

        $this->CI->db->select('name');
        $this->CI->db->from('tax_rate');
        $this->CI->db->where('tax_rate_id', $tax_rate_id);
        $this->CI->db->limit(1);
        $result = $this->CI->db->get()->row();

        if(!$result)
        {
            return false;
        }

        return $result->name;
    }


	public function get_rates($value, $tax_class_id)
	{

	    $tax_rate_data = array();

        if (isset($this->tax_rates[$tax_class_id])) {

			foreach ($this->tax_rates[$tax_class_id] as $tax_rate) {

				if (isset($tax_rate_data[$tax_rate['tax_rate_id']])) {
					$amount = $tax_rate_data[$tax_rate['tax_rate_id']]['amount'];
				} else {
					$amount = 0;
				}

				if ($tax_rate['type'] == 'F') 
				{
					$amount += $tax_rate['rate'];
                } elseif ($tax_rate['type'] == 'P') 
                {
					$amount += ($value / 100 * $tax_rate['rate']);
				}


				$tax_rate_data[$tax_rate['tax_rate_id']] = array(
					'tax_rate_id' => $tax_rate['tax_rate_id'],
					'name'        => $tax_rate['name'],
					'rate'        => $tax_rate['rate'],
					'type'        => $tax_rate['type'],
					'amount'      => $amount
				);
			}
		}

		// echo'rates<pre>';print_r($tax_rate_data);die;

		return $tax_rate_data;
	}




    public function getTaxes() 
    {

        $cart_items = $this->CI->user_session->userdata('cart') ? $this->CI->user_session->userdata('cart') : array();

       // echo '<pre>';
       // print_r($cart_items);


        $tax_data = array();

        if(!empty($cart_items)) {
        	// print_r($cart_items);die;
            foreach ($cart_items as $product) {
                //foreach ($this->getProducts() as $product) {
               // echo $product['price'];
                //die();
                // echo '<pre>';print_r($product['price']);die;
                if (isset($product['tax_class_id'])) {
                    $tax_rates = $this->get_rates($product['price'], $product['tax_class_id']);
                   // echo '<pre>';print_r($tax_rates);die;


                    foreach ($tax_rates as $tax_rate) {
                        if (!isset($tax_data[$tax_rate['tax_rate_id']])) 
                        {
                            $tax_data[$tax_rate['tax_rate_id']] = ($tax_rate['amount'] * $product['quantity']);
                            // $tax_data[$tax_rate['type']] = $tax_rate['type'];
                        } else 
                        {
                            $tax_data[$tax_rate['tax_rate_id']] += ($tax_rate['amount'] * $product['quantity']);
                            // $tax_data[$tax_rate['type']] = $tax_rate['type'];
                        }
                    }
                }
            }
        }

        return $tax_data;
    }



    public function getTotal() 
    {
        $total = 0;

        $cart_items = $this->CI->user_session->userdata('cart') ? $this->CI->user_session->userdata('cart') : array();

        if(!empty($cart_items)) {
            foreach ($cart_items as $product) {
                $total += $this->calculate($product['price'], $product['tax_class_id'], 1) * $product['quantity'];
            }
        }

        return $total;
    }


	/*
	+-------------------------------------------------------------------------+
	| FUNCTIONS ARE ADDED FOR SIMPLE TAX CALCULATION WITHOUT TAX CATEGORIES   |
	| AND WITHOUT TAX CLASSES GEO ZONES ETC.                                  |
	+-------------------------------------------------------------------------+
	*/

    public function calculate_tax($value, $return_include = false, $state_id = false)
    {
        $amount = 0;

        $tax_rate = $this->get_tax_price($state_id);
        $tax_config = $this->get_tax_config();

         if($tax_rate){
            if ($tax_config->type == 'percent') {
                $amount = ($tax_rate / 100) * $value;
            } elseif ($tax_config->type == 'fixed') {
                $amount = $tax_rate;
            }
        }
        if($return_include){
            return $value + $amount;
        }else{
            return $amount;
        }
    }

    public function get_tax_config()
    {
        $result = new stdClass();
        $result->status  = site_config_item('tax_status');
        $result->type    = site_config_item('tax_type');
        $result->value   = site_config_item('tax_value');
        $result->states  = explode(',',site_config_item('tax_states'));
        return $result;
        
    }
}
