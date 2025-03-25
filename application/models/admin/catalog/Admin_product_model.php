<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_product_model extends Admin_Model
{
    function __construct()
    {
        parent::__construct();
    }
    
    private function get_products_count()
    {
        $this->db->select('COUNT(*) AS found_total');
        $this->db->from('product_all_item_pages_data_tmp');
        $result = $this->db->get()->row();
        
        if(!$result)
        {
            return false;
        }
        
        return $result->found_total;
    }
    
    function get_products($data=array(), $return_count=false)
    {

        if(empty($data) and !$return_count)
        {
            return false;
        }
        else
        {
            $sql = '*';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }
            else
            {

            //  $sql .= ', (SELECT c.name FROM '. $this->db->dbprefix  .'categories AS c WHERE c.category_id = p.category_id) AS category_name';
            //  $sql .= ', (SELECT b.name FROM '. $this->db->dbprefix  .'brands AS b WHERE b.brand_id = p.brand_id) AS brand_name';
                // $sql .= ', (SELECT COUNT(*) FROM '. $this->db->dbprefix  .'order_products AS op WHERE op.product_id = p.product_id) AS sale_products';
                
                $sql .= ', \'\' AS category_name';
                $sql .= ', \'\' AS brand_name';
                // $sql .= ', \'\' AS sale_products';
            }
            
            $this->db->select($sql);
            $this->db->from('products p');
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
                $search = json_decode($data['term']);

                if(!empty($search->term))
                {
                    $this->db->group_start();
                    $this->db->like('p.product_name', $search->term);
                    $this->db->or_like('p.sku', $search->term);
                    $this->db->or_like('quantity', $search->term);
                    //$this->db->or_like('part_description', $search->term);
                    //$this->db->or_like('mfr_sku', $search->term);
                    //$this->db->or_like('p.category_id', $search->term);
                    //$this->db->or_like('subcategory', $search->term);
                    //$this->db->or_like('barcode', $search->term);
                    $this->db->group_end();
                }

                if(!empty($search->filter_category_id)) {
                    $this->db->where('p.category_id', $search->filter_category_id);
                }
                if(!empty($search->filter_manufacturer_id)){
                    $this->db->where('p.brand_id', $search->filter_manufacturer_id);
                }

            }

            if(!empty($search->start_date))
            {
                $this->db->where('DATE(p.date_added) >=',$search->start_date);
            }
            
            if(!empty($search->end_date))
            {
                $this->db->where('DATE(p.date_added) <=',$search->end_date);
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

    function get_products_typehead($data=array(), $return_count=false)
    {

        if(empty($data) and !$return_count)
        {
            return false;
        }
        else
        {
            $sql = 'product_id as value, product_name as label';
            if($return_count === TRUE)
            {
                $sql = 'COUNT(*) AS found_total';
            }
            else
            {

                //  $sql .= ', (SELECT c.name FROM '. $this->db->dbprefix  .'categories AS c WHERE c.category_id = p.category_id) AS category_name';
                //  $sql .= ', (SELECT b.name FROM '. $this->db->dbprefix  .'brands AS b WHERE b.brand_id = p.brand_id) AS brand_name';
                //  $sql .= ', (SELECT d.name FROM '. $this->db->dbprefix  .'distributors AS d WHERE d.distributor_id = p.distributor_id) AS distributor_name';

//                $sql .= ', \'\' AS category_name';
//                $sql .= ', \'\' AS brand_name';
//              $sql .= ', \'\' AS distributor_name';
            }

            $this->db->select($sql);
            $this->db->from('products p');
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
                $search = json_decode($data['term']);

                if(!empty($search->term))
                {
                    $this->db->group_start();
                    $this->db->like('p.product_name', $search->term);
                    $this->db->or_like('p.sku', $search->term);
                    //$this->db->or_like('alternate_sku', $search->term);
                    //$this->db->or_like('part_description', $search->term);
                    //$this->db->or_like('mfr_sku', $search->term);
                    //$this->db->or_like('p.category_id', $search->term);
                    //$this->db->or_like('subcategory', $search->term);
                    //$this->db->or_like('barcode', $search->term);
                    $this->db->group_end();
                }

//              if(!empty($search->filter_distributor_id)){
//                    $this->db->where('p.distributor_id', $search->filter_distributor_id);
//                }


            }

            if(!empty($search->start_date))
            {
                $this->db->where('DATE(p.date_added) >=',$search->start_date);
            }

            if(!empty($search->end_date))
            {
                $this->db->where('DATE(p.date_added) <=',$search->end_date);
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


    public function get_categories()
    {
        return $this->db->select('*')->from('categories')->where(array('is_enabled' => true))->order_by('name', 'ASC')->get()->result();
    }

    public function get_brands()
    {
        return $this->db->select('*')->from('brands')->where(array('is_enabled' => true))->order_by('name', 'ASC')->get()->result();
    }

//  public function get_distributors()
//  {
//      return $this->db->select('*')->from('distributors')->where(array('is_enabled' => true))->order_by('name', 'ASC')->get()->result();
//  }
//  public function get_distributor($distributor_id)
//  {
//      return $this->db->select('*')->from('distributors')->where(array('distributor_id' => $distributor_id))->get()->row();
//  }

    public function get_product_filters($product_id)
    {
        $this->db->select('pfa.*, fci.name as item_name, fc.name as category_name');
        $this->db->from('product_filters_association pfa');
        $this->db->join('products p', 'p.product_id = pfa.product_id');
        $this->db->join('filter_categories fc', 'fc.filter_category_id = pfa.filter_category_id');
        $this->db->join('filter_category_items fci', 'fci.filter_category_item_id = pfa.filter_category_item_id');
        $this->db->where('pfa.product_id', $product_id);
        return $this->db->get()->result();

    }

    public function get_product_images($product_id)
    {
        return $this->db->select('*')->from('product_images')->where('product_id', $product_id)->order_by('product_id', 'ASC')->get()->result();
    }
    
    function save($data)
    {
        // echo '<pre>'; print_r($data);die();

        $this->db->trans_start();
        $success_flag = false;
        // $product_images = isset($data['product_images']) ? $data['product_images'] : array();
        // if($product_images) {
        //  unset($data['product_images']);
        // }
        $product_filters = isset($data['filters']) ? $data['filters'] : array();
        unset($data['filters']);
        $product_related = isset($data['product_related']) ? $data['product_related'] : array();
        unset($data['product_related']);

        $product_categories = isset($data['product_categories']) ? $data['product_categories'] : array();
        unset($data['product_categories']);

        $product_option_value_id = isset($data['product_option_value_id']) ? $data['product_option_value_id'] : array();
        unset($data['product_option_value_id']);

        $variants_combination = isset($data['variants_combination']) ? $data['variants_combination'] : array();
        unset($data['variants_combination']);
        $variants_imgs = isset($data['variants_imgs']) ? $data['variants_imgs'] : array();
        unset($data['variants_imgs']);
        $dis_mode = isset($data['dis_mode']) ? $data['dis_mode'] : array();
        unset($data['dis_mode']);
        $dis_val = isset($data['dis_val']) ? $data['dis_val'] : array();
        unset($data['dis_val']);
        $dis_sdate = isset($data['dis_sdate']) ? $data['dis_sdate'] : array();
        unset($data['dis_sdate']);
        $dis_edate = isset($data['dis_edate']) ? $data['dis_edate'] : array();
        unset($data['dis_edate']);

        $variants_type = isset($data['variants_type']) ? $data['variants_type'] : array();
        unset($data['variants_type']);

        $variants_quantity = isset($data['variants_quantity']) ? $data['variants_quantity'] : array();
        unset($data['variants_quantity']);

        $variants_price = isset($data['variants_price']) ? $data['variants_price'] : array();
        unset($data['variants_price']);

        $variants_sku = isset($data['variants_sku']) ? $data['variants_sku'] : array();
        unset($data['variants_sku']);

        $option_name = isset($data['option_filter_name']) ? $data['option_filter_name'] : array();
        unset($data['option_filter_name']);

        $option_value = isset($data['option_filter_value']) ? $data['option_filter_value'] : array();
        unset($data['option_filter_value']);

        $specify_name = isset($data['specify_name']) ? $data['specify_name'] : array();
        unset($data['specify_name']);

        $specify_value = isset($data['specify_value']) ? $data['specify_value'] : array();
        unset($data['specify_value']);

        $specify_filter = isset($data['specify_filter']) ? $data['specify_filter'] : array();
        unset($data['specify_filter']);

        $product_images = isset($data['product_images']) ? $data['product_images'] : array();
        unset($data['product_images']);

        $special_price = isset($data['special_price']) ? $data['special_price'] : array();
        unset($data['special_price']);
        $start_date = isset($data['start_date']) ? $data['start_date'] : array();
        unset($data['start_date']);
        $end_date = isset($data['end_date']) ? $data['end_date'] : array();
        unset($data['end_date']);



        // echo '<pre>';print_r($product_images);die();
        if ($data['product_id'])
        {

            $id = $data['product_id'];
            $this->db->where('product_id', $data['product_id']);
            $this->db->update('products', $data);

            $this->db->where('product_id', $id)->delete('product_categories');
            if(!empty($product_categories)) {
                foreach ($product_categories as $item) {
                    $input_category = array(
                        'product_id'        => $id,
                        'category_id'       => $item,
                    );
                    $this->db->insert('product_categories', $input_category);
                }
            }


            $this->db->where('product_id', $id)->delete('related_products');
            if(!empty($product_related)) {
            foreach ($product_related as $item) {
                $input_filter = array(
                    'product_id'                => $id,
                    'related_product_id'        => $item,
                );
                $this->db->insert('related_products', $input_filter);
            }
            }

            $this->db->where('product_id', $id)->delete('product_images');
            if(!empty($product_images)) {
                foreach ($product_images as $item) {
                    $input_filter = array(
                        'product_id' => $id,
                        'image' => $item,
                    );
                    $this->db->insert('product_images', $input_filter);
                }
            }

            //products options values
            // echo '<pre>';print_r($variants_price);die();

            if (true) {
                if($product_option_value_id)
                {
                    $this->db->where('product_id',$id)->where_not_in('product_option_value_id', $product_option_value_id)->delete('product_option_value');
                }
                for ($i = 0; $i < count($product_option_value_id); $i++) {
                    if(true)
                    {
                        $combination = [];
                        $uid = $product_option_value_id[$i];

                        foreach ($variants_combination as $key => $value) {
                            $combination[$key] = $value[$i];
                        }

                        $params = array(
                            'product_id' => $id,
                            'quantity' => $variants_quantity[$i],
                            'price' => $variants_price[$i],
                            'sku' => $variants_sku[$i],
                            'dis_mode' => (isset($dis_mode[$i]) && $dis_mode[$i]?$dis_mode[$i]:''),
                            'dis_val' => (isset($dis_val[$i]) && $dis_val[$i]?$dis_val[$i]:''),
                            'dis_sdate' => (isset($dis_sdate[$i]) && $dis_sdate[$i]?$dis_sdate[$i]:''),
                            'dis_edate' => (isset($dis_edate[$i]) && $dis_edate[$i]?$dis_edate[$i]:''),
                            'combination' => json_encode($combination),
                        );
                        if(isset($variants_imgs[$i]) && $variants_imgs[$i])
                        {
                            $params['image'] = ($variants_imgs[$i] == 'del')?'':$variants_imgs[$i];
                        }

                        // echo "<pre>";var_dump($params);die();
                        if($uid > 0)
                        {

                            $r = $this->db->where('product_option_value_id',$uid)->update('product_option_value', $params);
                            
                        }
                        else
                        {
                            $r = $this->db->insert('product_option_value', $params);
                        }
                    }

                }
                // echo'opt<pre>';print_r($opt);die();
                // $this->db->insert_batch('product_option_value', $opt);
            }



            //products option filters
            if (!empty($option_name) && !empty($option_value)) {

                $this->db->where('product_id', $id)->where('is_filter', 1)->delete('product_option_filter');


                for ($i = 0; $i < count($option_name); $i++) {

                    $opt_val = $option_value[$i];

                    if(isset($opt_val) && !empty($opt_val)){
                        $option_val = '';
                        $option_val = explode("," , $opt_val);
                        for ($j = 0; $j < count($option_val); $j++) {
                            $data = [
                                'product_id' => $id,
                                'filter_key' => $option_name[$i],
                                'filter_value' => $option_val[$j],
                                'is_specification' => 0,
                                'is_filter' => 1,
                            ];
                            $r = $this->db->insert('product_option_filter', $data);

                        }

                    }

                }

            }

           // echo '<pre>';print_r($specify_filter);die();

            //products specifications
            if (!empty($specify_name) && !empty($specify_value)) {

                $this->db->where('product_id', $id)->where('is_specification', 1)->delete('product_option_filter');

                for ($i = 0; $i < count($specify_name); $i++) {
                    if (!empty($specify_name[$i]) && !empty($specify_value[$i])) {
                        $data = [
                            'product_id' => $id,
                            'filter_key' => $specify_name[$i],
                            'filter_value' => $specify_value[$i],
                            'is_specification' => 1,
                            'is_filter' => isset($specify_filter[$i]) ? $specify_filter[$i] : 0,
                        ];
                        $this->db->insert('product_option_filter', $data);
                    }
                }

            }

            //products Special Price

            if (!empty($special_price) && !empty($start_date) && !empty($end_date)) {

                $r = $this->db->where('product_id', $id)->delete('product_special_price');

                for ($i = 0; $i < count($special_price); $i++) {
                    if($special_price[$i] > 0) {
                        $data = [
                            'product_id' => $id,
                            'price' => $special_price[$i],
                            'start_date' => $start_date[$i],
                            'end_date' => $end_date[$i],
                        ];
                        $this->db->insert('product_special_price', $data);
                    }

                }

            }
            else
            {
                $r = $this->db->where('product_id', $id)->delete('product_special_price');
            }


        }
        else
        {
            $this->db->insert('products', $data);
                $id = $this->db->insert_id();


            $this->db->where('product_id', $id)->delete('product_categories');
            if(!empty($product_categories)) {
                foreach ($product_categories as $item) {
                    $input_category = array(
                        'product_id'        => $id,
                        'category_id'       => $item,
                    );
                    $this->db->insert('product_categories', $input_category);
                }
            }

            $this->db->where('product_id', $id)->delete('related_products');
            foreach ($product_related as $item) {
                $input_filter = array(
                    'product_id'                => $id,
                    'related_product_id'        => $item,
                );
                $this->db->insert('related_products', $input_filter);
            }

            //product
            $this->db->where('product_id', $id)->delete('product_images');
            if(!empty($product_images)) {
                foreach ($product_images as $item) {
                    $input_filter = array(
                        'product_id' => $id,
                        'image'     => $item,
                    );
                    $this->db->insert('product_images', $input_filter);
                }
            }

            //products options

            if (true) {
                $this->db->where('product_id', $id)->delete('product_option_value');

                for ($i = 0; $i < count($product_option_value_id); $i++) {

                    $combination = [];

                    foreach ($variants_combination as $key => $value) {
                        $combination[$key] = $value[$i];
                    }
                    if(true)
                    {

                            $data = [
                                //'product_option_value_id' => $_REQUEST['product_option_value_id'][$i],
                                'product_id' => $id,
                                //'image' => $variants_image[$i],
                                'quantity' => $variants_quantity[$i],
                                'price' => $variants_price[$i],
                                'sku' => $variants_sku[$i],
                                'dis_mode' => (isset($dis_mode[$i]) && $dis_mode[$i]?$dis_mode[$i]:''),
                            'dis_val' => (isset($dis_val[$i]) && $dis_val[$i]?$dis_val[$i]:''),
                            'dis_sdate' => (isset($dis_sdate[$i]) && $dis_sdate[$i]?$dis_sdate[$i]:''),
                            'dis_edate' => (isset($dis_edate[$i]) && $dis_edate[$i]?$dis_edate[$i]:''),
                                'image' => $variants_imgs[$i],
                                'combination' => json_encode($combination),
                            ];
                            $r = $this->db->insert('product_option_value', $data);

                        }

                }

            }
            // dd($_POST);
            //products option filters
            if (!empty($option_name) && !empty($option_value)) {

                $this->db->where('product_id', $id)->where('is_filter', 1)->delete('product_option_filter');


                for ($i = 0; $i < count($option_name); $i++) {

                    $opt_val = $option_value[$i];

                    if(isset($opt_val) && !empty($opt_val)){
                        $option_val = '';
                        $option_val = explode("," , $opt_val);
                        for ($j = 0; $j < count($option_val); $j++) {
                            $data = [
                                'product_id' => $id,
                                'filter_key' => $option_name[$i],
                                'filter_value' => $option_val[$j],
                                'is_specification' => 0,
                                'is_filter' => 1,
                            ];
                            $r = $this->db->insert('product_option_filter', $data);

                        }

                    }

                }

            }



            //products specifications
            if (!empty($specify_name) && !empty($specify_value)) {

                $this->db->where('product_id', $id)->where('is_specification', 1)->delete('product_option_filter');

                for ($i = 0; $i < count($specify_name); $i++) {

                    if(!empty($specify_name[$i]) && !empty($specify_value[$i])) {
                        $data = [
                            'product_id' => $id,
                            'filter_key' => $specify_name[$i],
                            'filter_value' => $specify_value[$i],
                            'is_specification' => 1,
                            'is_filter' => isset($specify_filter[$i]) ? $specify_filter[$i] : 0,
                        ];
                        $this->db->insert('product_option_filter', $data);
                    }
                }

            }

            //products Special Price
            if (!empty($special_price) && !empty($start_date) && !empty($end_date)) {

                $this->db->where('product_id', $id)->delete('product_special_price');

                for ($i = 0; $i < count($special_price); $i++) {
                    if ($special_price[$i] > 0) {
                        $data = [
                            'product_id' => $id,
                            'price' => $special_price[$i],
                            'start_date' => $start_date[$i],
                            'end_date' => $end_date[$i],
                        ];
                        $this->db->insert('product_special_price', $data);
                    }
                }
            }


        }
            $this->db->trans_complete();
        return true;
    }

    
    function get_product($id)
    {
        $this->db->select('*');
        $this->db->from('products');
        $this->db->where(1,1, FALSE);
        $this->db->where('product_id', $id);
        $result = $this->db->get()->row();
        //echo $this->db->last_query();
        if(!$result)
        {
            return false;
        }

        return $result;
    }


    public function get_products_by_typeahead($query)
    {
        if(!empty($query)){
            $this->db->select('product_id as "id", product_name,sku')->from('products');
            $this->db->like('product_name', $query);
            $this->db->or_like('sku', $query);
            $results = $this->db->get()->result();
        }else{
            $this->db->select('product_id as "id", product_name, sku')->from('products');
            $results = $this->db->get()->result();
        }

        return $results;

    }


    public function disable_product($pid)
    {
        $this->db->where('product_id', $pid)->update('products', array('is_enabled' => 0));
        return true;
    }


    public function update_product_images($data)
    {
        if (isset($data['product_id'])) {
            $this->db->where('product_id', $data['product_id']);
            $this->db->update('products', $data);
        }
    }

    function get_related_products($product_id)
    {
        $this->db->select('p.product_id, p.product_name');
        $this->db->from('products p');
        $this->db->join('related_products rp', 'rp.related_product_id = p.product_id');
        $this->db->where('rp.product_id', $product_id);
        $result = $this->db->get()->result();
        if(!$result)
        {
            return false;
        }

        return $result;
    }


    function get_product_categories($product_id)
    {
        $this->db->select('c.category_id , c.name');
        $this->db->from('categories c');
        $this->db->join('product_categories pc', 'pc.category_id = c.category_id');
        $this->db->where('pc.product_id', $product_id);
        $result = $this->db->get()->result();
        if(!$result)
        {
            return false;
        }

        if(!empty($result)) {
            foreach ($result as $key=>$val) {
                $cat = new stdClass;
                $cat->category_id = $val->category_id;
                $cat->name = $this->getparent($val->category_id);
                $category[] = $cat;
            }
        }

        return $category;

    }


    function getparent($id)
    {

        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('category_id', $id);
        $result = $this->db->get()->result_array();

        if (!$result) {
            return false;
        }

        foreach ($result as $row) {
            if ($row['parent_id'] != 0) {
                $name = $this->getparent($row['parent_id']) . '>>' . $row['name'];
            } else {
                $name = $row['name'];
            }
        }

        return $name;

    }





    function get_product_specification($product_id)
    {
        $this->db->select('pof.filter_key , pof.filter_value , pof.is_filter');
        $this->db->from('product_option_filter pof');
        $this->db->where('pof.product_id', $product_id);
        $this->db->where('pof.is_specification', 1);
        $result = $this->db->get()->result();
        if(!$result)
        {
            return false;
        }

        return $result;
    }


    function get_special_prices($product_id)
    {
        $this->db->select('psp.price , psp.start_date , psp.end_date');
        $this->db->from('product_special_price psp');
        $this->db->where('psp.product_id', $product_id);
        $result = $this->db->get()->result();
        if(!$result)
        {
            return false;
        }

        return $result;
    }



    function get_product_options($product_id)
    {
        $this->db->select('p.option_name, p.option_value');
        $this->db->from('products p');
        $this->db->where('p.product_id', $product_id);
        $result = $this->db->get()->row_array();
        if(!$result)
        {
            return false;
        }

        return $result;
    }


    function get_product_option_value($product_id)
    {
        $variants = [];
        $this->db->select('*');
        $this->db->from('product_option_value');
        $this->db->order_by('product_option_value_id','ASC');
        $this->db->where('product_id', $product_id);
        $result = $this->db->get()->result_array();
        if(!$result)
        {
            return false;
        }

        foreach ($result as $row) {

            $variants[] = [
                'product_option_value_id' => $row['product_option_value_id'],
                'product_id' => $row['product_id'],
                'combination' => json_decode($row['combination'], true),
                'price' => $row['price'],
                'quantity' => $row['quantity'],
                'sku' => $row['sku'],
                'dis_mode' => $row['dis_mode'],
                'dis_mode' => $row['dis_mode'],
                'dis_val' => $row['dis_val'],
                'dis_sdate' => $row['dis_sdate'],
                'dis_edate' => $row['dis_edate'],
                'image' => $row['image'],
            ];
        }

        return $variants;

    }


    function categoryTree($parent_id = 0, $sub_mark = '' , $pCategories){

        $this->db->select('*');
        $this->db->from('categories');
        $this->db->where('parent_id', $parent_id);
        $result = $this->db->get()->result_array();
        if(!$result)
        {
            return false;
        }
        $tree = '';
        foreach ($result as $row) {

            if(in_array($row['category_id'] , $pCategories))
            {
                $selected = 'selected';
            }else{
                $selected = '';
            }


            $tree .= '<option value="'.$row['category_id'].'"'.$selected.'>'.$sub_mark.$row['name'].'</option>';
            $tree.= $this->categoryTree($row['category_id'], $sub_mark.'---' , $pCategories);

        }

        return $tree;
    }


    function is_sku_already_exist($str, $id=false)
    {
        $this->db->select('sku');
        $this->db->from('products');
        $this->db->where('sku', $str);
        if ($id)
        {
            $this->db->where('product_id !=', $id);
        }

        $count = $this->db->count_all_results();

        if ($count > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

}
