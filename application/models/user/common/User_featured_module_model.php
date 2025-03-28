<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_featured_module_model extends User_Model 
{
    function __construct()
    {
        parent::__construct();
    }

    public function get_most_view_products($limit = 10){

            $this->db->select("
    p.views, 
    p.product_id, 
    p.product_name, 
    p.product_slug, 
    p.sale_price, 
    p.short_description, 
    p.option_name, 
    p.option_value, 
    p.quantity, 
    GROUP_CONCAT(DISTINCT pi.image ORDER BY pi.id desc SEPARATOR ', ') AS images,
    (CASE 
        WHEN sp.product_id IS NOT NULL AND CURDATE() BETWEEN sp.start_date AND sp.end_date 
        THEN sp.price 
        ELSE NULL 
    END) AS special_price,
    (
        SELECT pov.price 
        FROM " . $this->db->dbprefix . "product_option_value pov 
        WHERE pov.product_id = p.product_id 
        AND pov.price > 0 
        AND pov.quantity > 0
        ORDER BY pov.price ASC 
        LIMIT 1
    ) AS variant_price,
    (
        SELECT pov.product_option_value_id 
        FROM " . $this->db->dbprefix . "product_option_value pov 
        WHERE pov.product_id = p.product_id 
        AND pov.price > 0 
        AND pov.quantity > 0
        ORDER BY pov.price ASC 
        LIMIT 1
    ) AS variant_id
");
$this->db->from($this->db->dbprefix . 'products as p');
$this->db->join($this->db->dbprefix . 'product_images as pi', 'pi.product_id = p.product_id', 'left');
$this->db->join($this->db->dbprefix . 'product_special_price as sp', 'sp.product_id = p.product_id', 'left'); 

$this->db->where('p.is_enabled', 1);

$display_out_stock = site_config_item('config_catalog_outstock');
if ($display_out_stock != 1) {
    $this->db->where('p.quantity >', 0);
}

$this->db->group_by('p.product_id'); 
$this->db->order_by('p.views', 'DESC');

if ($limit) {
    $this->db->limit($limit);
}

$query = $this->db->get();
$result = $query->result();
        if(!$result)
        {
            return FALSE;
        }

        foreach($result as $key=>&$val) {
            $all_images = array();

    if (!empty($val->images)) {
        foreach(explode(', ', $val->images) as $k=> $v)
        {
            $all_images[] = $v;
        }
    }

    if (!empty($val->option_images)) {
        foreach(explode(', ', $val->option_images) as $k=> $v)
        {
            $all_images[] = $v;
        }
    }
            $val->images = array_reverse($all_images);//
            // $val->special_price = get_product_special_price($val->product_id);

            if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {
                
                $val->is_variation = 0;
                $val->varient_price = 0;
                if(isset($val->varient_price) && $val->varient_price)
                {
                    $val->is_variation = 1;
                
                }
            }
        }
        return $result;

    }
    public function get_best_products($limit = 10){

        $this->db->select(',DISTINCT(p.product_id) ,COUNT(op.product_id) AS total, p.product_name , p.product_slug , p.sale_price , p.short_description , p.option_name, p.option_value ,  p.quantity , b.name as brand');
        $this->db->from($this->db->dbprefix . 'products p');
        $this->db->join($this->db->dbprefix . 'order_products AS op', 'p.product_id = op.product_id', 'left');
        $this->db->join($this->db->dbprefix . 'brands b', 'b.brand_id = p.brand_id');
        $this->db->where('p.is_enabled', 1);
        $display_out_stock = site_config_item('config_catalog_outstock');
        
        if ($display_out_stock  != 1) 
        {
            $this->db->where('p.quantity >', 0);
        }

        $this->db->order_by('p.views', 'DESC');
        $this->db->limit($limit);
        
        $result = $this->db->get()->result();
        die();
        if(!$result)
        {
            return FALSE;
        }

        foreach($result as $key=>&$val) {
            $val->images = get_product_images($val->product_id);
            $val->special_price = get_product_special_price($val->product_id);

            if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {
                $val->is_variation = 1;
            $p =  get_product_varient_price($val->product_id);
                if(isset($p->price))
                {
                    $val->varient_price = $p->price;
                    $val->varient_id = $p->product_option_value_id;
                }
            } else {
                $val->is_variation = 0;
                $val->varient_price = 0;
            }
        }

        return $result;

    }

    public function get_bestseller_products($limit = 10){
    $this->db = get_base_product_query($this->db,'COUNT(op.product_id) AS total,');
$this->db->join($this->db->dbprefix . 'order_products AS op', 'p.product_id = op.product_id', 'left');
$this->db->where('p.is_enabled', 1);
$display_out_stock = site_config_item('config_catalog_outstock');
if ($display_out_stock != 1)
{
    $this->db->where('p.quantity >', 0);
}
$this->db->group_by('p.product_id');
$this->db->having('total >', 0);
$this->db->order_by('total', 'DESC');
if($limit)
{
    $this->db->limit($limit);
}

$query = $this->db->get();
$result = $query->result();


        // echo $this->db->last_query();
        // die();

        if(!$result)
        {
            return FALSE;
        }
        


        foreach($result as $key=>&$val) {

            $all_images = array();

    if (!empty($val->images)) {
        foreach(explode(', ', $val->images) as $k=> $v)
        {
            $all_images[] = $v;
        }
    }
            $val->images = $all_images;//
            // $val->special_price = get_product_special_price($val->product_id);

            if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {
                $val->is_variation = 1;
                $p =  get_product_varient_price($val->product_id);
                if(isset($p->price))
                {
                    $val->varient_price = $p->price;
                    $val->varient_id = $p->product_option_value_id;
                }
            } else {
                $val->is_variation = 0;
                $val->varient_price = 0;
            }
        }
        return $result;

    }

    public function get_special_products($limit = 10){

                $this->db->select("
    p.product_id, 
    p.product_name, 
    p.product_slug, 
    p.sale_price, 
    p.short_description, 
    p.option_name, 
    p.option_value, 
    p.quantity, 
    GROUP_CONCAT(DISTINCT pi.image ORDER BY pi.id desc SEPARATOR ', ') AS images,
    (CASE 
        WHEN sp.product_id IS NOT NULL AND CURDATE() BETWEEN sp.start_date AND sp.end_date 
        THEN sp.price 
        ELSE NULL 
    END) AS special_price
");
$this->db->from($this->db->dbprefix . 'products as p');
$this->db->join($this->db->dbprefix . 'product_images as pi', 'pi.product_id = p.product_id', 'left');
$this->db->join($this->db->dbprefix . 'product_special_price as sp', 'sp.product_id = p.product_id', 'left'); 
$this->db->where('p.is_enabled', 1);
$this->db->where('(CASE 
        WHEN sp.product_id IS NOT NULL AND CURDATE() BETWEEN sp.start_date AND sp.end_date 
        THEN sp.price 
        ELSE NULL 
    END) > ', 0);

$display_out_stock = site_config_item('config_catalog_outstock');
if ($display_out_stock  != 1) {
    $this->db->where('p.quantity >', 0);
}

$this->db->group_by('p.product_id'); // Ensure GROUP_CONCAT works properly
$this->db->order_by('p.date_added', 'DESC');
$this->db->limit($limit);

$query = $this->db->get();
$result = $query->result();

        if(!$result)
        {
            return FALSE;
        }

        foreach($result as $key=>&$val) {

            $all_images = array();

    if (!empty($val->images)) {
        foreach(explode(', ', $val->images) as $k=> $v)
        {
            $all_images[] = $v;
        }
    }

    if (!empty($val->option_images)) {
        foreach(explode(', ', $val->option_images) as $k=> $v)
        {
            $all_images[] = $v;
        }
    }
            $val->images = array_reverse($all_images);//
            // $val->special_price = get_product_special_price($val->product_id);

            if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {
                $val->is_variation = 1;
                $p =  get_product_varient_price($val->product_id);
                if(isset($p->price))
                {
                    $val->varient_price = $p->price;
                    $val->varient_id = $p->product_option_value_id;
                }
            } else {
                $val->is_variation = 0;
                $val->varient_price = 0;
            }
        }
        return $result;
    }
    public function get_special_price_products($limit = 10) {
    $this->db->select("
    pro.product_id, 
    pro.product_name, 
    pro.product_slug, 
    pro.sale_price, 
    pro.short_description, 
    pro.option_name, 
    pro.option_value, 
    pro.quantity, 
    GROUP_CONCAT(DISTINCT pi.image ORDER BY pi.id desc SEPARATOR ', ') AS images, 
    sp.price AS special_price
");

$this->db->from($this->db->dbprefix . 'product_special_price as sp');

// Join with the products table
$this->db->join($this->db->dbprefix . 'products as pro', 'pro.product_id = sp.product_id', 'left');

// Join with the product images table
$this->db->join($this->db->dbprefix . 'product_images as pi', 'pi.product_id = pro.product_id', 'left');

// Filter the products with active special prices
$this->db->where('CURDATE() BETWEEN sp.start_date AND sp.end_date');

// Ensure that only enabled products are selected
$this->db->where('pro.product_id >', 0);  // This condition can be adjusted as needed (pro.product_id > 0)

// Group by product_id to concatenate images
$this->db->group_by('pro.product_id');
if($limit)
{
    $this->db->limit($limit);
}
// Execute the query
$query = $this->db->get();
$results = $query->result();
    foreach($result as $key=>&$val) {

            $all_images = array();

    if (!empty($val->images)) {
        foreach(explode(', ', $val->images) as $k=> $v)
        {
            $all_images[] = $v;
        }
    }

    if (!empty($val->option_images)) {
        foreach(explode(', ', $val->option_images) as $k=> $v)
        {
            $all_images[] = $v;
        }
    }
            $val->images = array_reverse($all_images);//
            // $val->special_price = get_product_special_price($val->product_id);

            if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {
                $val->is_variation = 1;
                $p =  get_product_varient_price($val->product_id);
                if(isset($p->price))
                {
                    $val->varient_price = $p->price;
                    $val->varient_id = $p->product_option_value_id;
                }
            } else {
                $val->is_variation = 0;
                $val->varient_price = 0;
            }
        }
        return $result;
}


    public function get_new_arrival_products($limit = 10){

$this->db = get_base_product_query($this->db, ''); // Base Query Call

$this->db->where('p.is_enabled', 1); // Sirf enabled products lein

// Agar config allow nahi karta out of stock products dikhana
$display_out_stock = site_config_item('config_catalog_outstock');
if ($display_out_stock != 1) {
    $this->db->where('p.quantity >', 0);
}

$this->db->group_by('p.product_id'); // Ensure GROUP_CONCAT works properly
$this->db->order_by('p.date_added', 'DESC');
if($limit)
$this->db->limit($limit);

$query = $this->db->get();
$result = $query->result();

        if(!$result)
        {
            return FALSE;
        }

        foreach($result as $key=>&$val) {
            $all_images = array();

    if (!empty($val->images)) {
        foreach(explode(', ', $val->images) as $k=> $v)
        {
            $all_images[] = $v;
        }
    }

    if (!empty($val->option_images)) {
        foreach(explode(', ', $val->option_images) as $k=> $v)
        {
            $all_images[] = $v;
        }
    }
            $val->images = array_reverse($all_images);//
            // $val->special_price = get_product_special_price($val->product_id);

            if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {
                $val->is_variation = 1;
                $p =  get_product_varient_price($val->product_id);
                if(isset($p->price))
                {
                    $val->varient_price = $p->price;
                    $val->varient_id = $p->product_option_value_id;
                }
            } else {
                $val->is_variation = 0;
                $val->varient_price = 0;
            }
        }
        return $result;
    } 
    public function get_new_special_products($limit = 10){

        $this->db->select("
    p.product_id, 
    p.product_name, 
    p.product_slug, 
    p.sale_price, 
    p.short_description, 
    p.option_name, 
    p.option_value, 
    p.quantity, 
    GROUP_CONCAT(DISTINCT pi.image ORDER BY pi.image SEPARATOR ', ') AS images, 
    sp.price AS special_price
");
$this->db->from($this->db->dbprefix . 'product_special_price as sp');
$this->db->join($this->db->dbprefix . 'products as p', 'p.product_id = sp.product_id', 'left');
$this->db->join($this->db->dbprefix . 'product_images as pi', 'pi.product_id = p.product_id', 'left');

// Add the condition for quantity > 0
$this->db->where('p.quantity >', 0);

// Group by product ID
$this->db->group_by('p.product_id');
if($limit)
{
    $this->db->limit($limit);
}

// Execute the query
$query = $this->db->get();
$result = $query->result();
// dd($this->db->last_query());

// Display the result

        if(!$result)
        {
            return FALSE;
        }

        foreach($result as $key=>&$val) {
          $val = $this->get_product_slug($val->product_slug);

            
        }
        return $result;
    } 
    function get_product_slug($slug)



    {



        $this->db = get_base_product_query($this->db, ''); // Base Query Call

        



        $this->db->where('product_slug', $slug);



        $result = $this->db->get()->row();



        if(!$result)



        {



            return false;



        }



        $id = $result->product_id;



        $result->images = get_product_images($id);



        $result->special_price = get_product_special_price($id);



        $result->specification = get_product_specification($id);



        if (isset($result->option_name, $result->option_value) && ($result->option_name != '') && ($result->option_value != ''))



        {



            $result->is_variation = 1;



            $result->varient_price =  get_product_varient_price($id); 



        } else {



            $result->is_variation = 0;



            $result->varient_price = 0;



        }







        // $result->brand      = $this->get_brand($result->brand_id);



        // $result->is_special = false;



        // $result->price      = false;



        



        return $result;



    }

    public function get_new_special_products_remove($limit = 10){
$this->db = get_base_product_query($this->db, ''); // Base Query Call

$this->db->where('p.is_enabled', 1); // Sirf enabled products lein
 $this->db->having('is_special', 1); // Sirf enabled products lein

// Agar config allow nahi karta out of stock products dikhana
$display_out_stock = site_config_item('config_catalog_outstock');
if ($display_out_stock != 1) {
    $this->db->where('p.quantity >', 0);
}

// Group by product ID
$this->db->group_by('p.product_id');
if($limit)
{
    $this->db->limit($limit);
}

// Debugging Query
// $query = $this->db->get_compiled_select();
// echo $query;
// exit;

// Execute the query

$query = $this->db->get();
$result = $query->result();
// dd($this->db->last_query());







// Display the result

        if(!$result)
        {
            return FALSE;
        }
        $n = array();

        foreach($result as $key=>&$val) {
            $all_images = array();

    if (!empty($val->images)) {
        foreach(explode(', ', $val->images) as $k=> $v)
            {
                $all_images[] = $v;
            }
        }

            if (!empty($val->option_images)) {
                foreach(explode(', ', $val->option_images) as $k=> $v)
                {
                    $all_images[] = $v;
                }
            }
            $val->images = $all_images;
        }
        return $result;
        $result = $n;


        
        return $result;
    } 
    public function getSpecialProducts($limit = 0)
{
    $this->db->select("
        p.*,
        p.sale_price AS original_price,

        -- Identify product type
        CASE 
            WHEN EXISTS (
                SELECT 1 FROM ci_product_option_value pov 
                WHERE pov.product_id = p.product_id
            ) THEN 'variable'
            ELSE 'simple'
        END AS product_type,

        -- Check if product has special price
        CASE 
            WHEN EXISTS (
                SELECT 1 
                FROM ci_product_special_price sp 
                WHERE sp.product_id = p.product_id 
                AND CURDATE() BETWEEN sp.start_date AND sp.end_date
            ) 
            OR EXISTS (
                SELECT 1 
                FROM ci_product_option_value pov 
                WHERE pov.product_id = p.product_id 
                AND pov.dis_val > 0 
                AND CURDATE() BETWEEN pov.dis_sdate AND pov.dis_edate
            ) 
            THEN 1 ELSE 0 
        END AS is_special,

        -- Sale Price Calculation
        CASE 
            -- Simple Product: Take price from ci_products.sale_price
            WHEN NOT EXISTS (
                SELECT 1 FROM ci_product_option_value pov 
                WHERE pov.product_id = p.product_id
            ) 
            THEN p.sale_price  
            
            -- Variable Product: Get the minimum price after applying discount
            ELSE (
                SELECT pov.price 
                FROM ci_product_option_value pov
                WHERE pov.product_id = p.product_id 
                AND pov.dis_val > 0 
                AND CURDATE() BETWEEN pov.dis_sdate AND pov.dis_edate
                ORDER BY 
                    CASE 
                        WHEN pov.dis_mode = 'fixed' THEN (pov.price - pov.dis_val)
                        WHEN pov.dis_mode = 'per' THEN (pov.price - (pov.price * pov.dis_val / 100))
                        ELSE pov.price
                    END ASC
                LIMIT 1
            )
        END AS sale_price,

        -- Final Price Calculation
        CASE 
            -- Simple Product: Get price from ci_product_special_price if available
            WHEN NOT EXISTS (
                SELECT 1 FROM ci_product_option_value pov 
                WHERE pov.product_id = p.product_id
            ) 
            THEN (
                SELECT sp.price 
                FROM ci_product_special_price sp
                WHERE sp.product_id = p.product_id
                AND CURDATE() BETWEEN sp.start_date AND sp.end_date
                ORDER BY sp.price ASC
                LIMIT 1
            )
            
            -- Variable Product: Get the minimum price after discount
            ELSE (
                SELECT MIN(
                    CASE 
                        WHEN pov.dis_mode = 'fixed' THEN (pov.price - pov.dis_val)
                        WHEN pov.dis_mode = 'per' THEN (pov.price - (pov.price * pov.dis_val / 100))
                        ELSE pov.price
                    END
                ) 
                FROM ci_product_option_value pov 
                WHERE pov.product_id = p.product_id 
                AND pov.dis_val > 0 
                AND CURDATE() BETWEEN pov.dis_sdate AND pov.dis_edate
            )
        END AS final_price,

        -- Concatenate Product Images
        GROUP_CONCAT(DISTINCT pi.image ORDER BY pi.id ASC SEPARATOR ', ') AS images
    ");

    $this->db->from('ci_products p');
    $this->db->join('ci_product_images pi', 'pi.product_id = p.product_id', 'left');
    $this->db->where('p.is_enabled', 1);
    $this->db->where('p.quantity >', 0);
    $this->db->having('is_special', 1);
    $this->db->group_by('p.product_id');

    if ($limit > 0) {
        $this->db->limit($limit);
    }

    $query = $this->db->get();
    $result =  $query->result();
    foreach($result as $key=>&$val) {

    if (!empty($val->images)) {
            $val->images = explode(',', $val->images);
        }
    }
    return $result;
}


    public function get_sale_products()
    {
        $sql = 'p.*, p.product_name AS name, \'\' AS is_new, \'\' AS is_special, \'\' AS rate_special, \'\' AS has_tax, \'\' AS price ';

        $this->db->select($sql);
        $this->db->from('products AS p');
        // if(!empty($data['category_id']))
        // {
        //  $this->db->join('product_categories pc', 'pc.product_id = p.product_id');
        //     $this->db->where('pc.category_id', $data['category_id']);
        // }

        $this->db->where(1,1, FALSE);

        $this->db->where('p.is_enabled', 1);
        $display_out_stock = site_config_item('config_catalog_outstock');
        if ($display_out_stock  != 1) 
        {
            $this->db->where('p.quantity >', 0);
        }
        
        $this->db->order_by('p.product_id', 'DESC');
        
        $result = $this->db->get()->result();
            
        if(!$result)
        {
            return false;
        }

        foreach($result as $key=>&$val)
        {
            $val->images = get_product_images($val->product_id);
            $val->special_price = get_product_special_price($val->product_id);
            $val->brand         = get_brand($val->brand_id);

            if (isset($val->option_name, $val->option_value) && ($val->option_name != '') && ($val->option_value != '')) {
                $val->is_variation = 1;
                $p =  get_product_varient_price($val->product_id);
                if(isset($p->price))
                {
                    $val->varient_price = $p->price;
                    $val->varient_id = $p->product_option_value_id;
                }
            } else {
                $val->is_variation = 0;
                $val->varient_price = 0;
            }
        }

        return $result;
    }

}
