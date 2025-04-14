<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php

$left_nav = $this->admin_acl->get_left_navigation();
$active_nav =  $this->router->fetch_class();

// echo '<pre>';print_r($active_nav);die('11');

function get_menu_data($nav_slug){

    $nav= array();

    if($nav_slug =='admin_categories')
    {
        $nav['url'] = site_url('admin/catalog/categories.html');
    }

    if($nav_slug =='admin_manufacturers')
    {
        $nav['url'] = site_url('admin/catalog/manufacturers.html');
    }

    if($nav_slug =='admin_brands')
    {
        $nav['url'] = site_url('admin/catalog/brands.html');
    }

    if($nav_slug =='admin_color')
    {
        $nav['url'] = site_url('admin/catalog/color.html');
    }

    if($nav_slug =='admin_products')
    {
        $nav['url'] = site_url('admin/catalog/products.html');
    }

    if($nav_slug =='admin_orders')
    {
        $nav['url'] = site_url('admin/sales/orders.html');
    }

    if($nav_slug =='admin_order_returns')
    {
        $nav['url'] = site_url('admin/sales/returns.html');
    }

    if($nav_slug =='admin_user')
    {
        $nav['url'] = site_url('admin/users/user.html');
    }

    if($nav_slug =='admin_roles')
    {
        $nav['url'] = site_url('admin/users/roles.html');
    }

    if($nav_slug =='admin_customer')
    {
        $nav['url'] = site_url('admin/sales/customers.html');
    }


    if($nav_slug =='admin_contact')
    {
        $nav['url'] = site_url('admin/support/contact.html');
    }

    if($nav_slug =='admin_newsletters')
    {
        $nav['url'] = site_url('admin/support/newsletters.html');
    }


    if($nav_slug =='admin_pages')
    {
        $nav['url'] = site_url('admin/module/pages.html');
    }

    if($nav_slug =='admin_sliders')
    {
        $nav['url'] = site_url('admin/module/sliders.html');
    }

    if($nav_slug =='admin_boxes')
    {
        $nav['url'] = site_url('admin/module/boxes.html');
    }

    if($nav_slug =='inventory')
    {
        $nav['url'] = site_url('admin/inventory.html');
    }

    if($nav_slug =='variations-inventory')
    {
        $nav['url'] = site_url('admin/variations-inventory.html');
    }

    if($nav_slug =='admin_navigations')
    {
        $nav['url'] = site_url('admin/module/navigations.html');
    }

    if($nav_slug =='admin_settings')
    {
        $nav['url'] = site_url('admin/system/setting.html');
    }

    if($nav_slug =='admin_extensions')
    {
        $nav['url'] = site_url('admin/extensions.html');
    }

    if($nav_slug =='admin_payment')
    {
        $nav['url'] = site_url('admin/extensions/payment.html');
    }

    if($nav_slug =='admin_shipping')
    {
        $nav['url'] = site_url('admin/extensions/shipping.html');
    }

    if($nav_slug =='admin_totals')
    {
        $nav['url'] = site_url('admin/extensions/total.html');
    }


    if($nav_slug =='admin_geo_zones')
    {
        $nav['url'] = site_url('admin/localisation/geo_zones.html');
    }

    if($nav_slug =='admin_tax_rates')
    {
        $nav['url'] = site_url('admin/localisation/tax_rates.html');
    }

    if($nav_slug =='admin_tax_classes')
    {
        $nav['url'] = site_url('admin/localisation/tax_classes.html');
    }

   return   $nav;
}


function get_icon_class($cat_name){

    $icon= '';

    if($cat_name =='catalog')
    {
        $icon = 'fa fa-tags';
    }

    if($cat_name =='sales')
    {
        $icon = 'fa fa-shopping-cart';
    }

    if($cat_name =='users')
    {
        $icon = 'fa fa-user';
    }

    if($cat_name =='support')
    {
        $icon = 'fa fa-phone';
    }

    if($cat_name =='module')
    {
        $icon = 'fa fa-pie-chart';
    }

    if($cat_name =='system')
    {
        $icon = 'fa fa-gears';
    }

    if($cat_name =='extensions')
    {
        $icon = 'fa fa-puzzle-piece fw';
    }

    if($cat_name =='localisation')
    {
        $icon = 'fa fa-dollar';
    }

    
    return   $icon;
}?>

<div class="left-panel">
    <div class="nav-wrapper">
    	<div class="nav-wrapper">
            <span class="nav-title">Navigation</span>
            <ul id="metismenu" class="metismenu custom-nav">
                <li class="<?php echo $active_nav == 'Admin_dashboard' ? 'mm-active' : '' ?>">
                    <a class="" href="<?php echo site_url($this->admin_folder.'/dashboard.html') ?>" aria-expanded="false"><i class="icon-home-fill"></i>Dashboard</a>
                </li>

                <?php
                $this->user = $this->admin_session->userdata('admin');
                foreach($left_nav as $category){?>
                    <?php $icon = get_icon_class($category->slug);?>

                        <?php if($this->user['is_sa'] or isset($category->modules[0]->actions[0]->view) && $category->modules[0]->actions[0]->view == 1) {?>
                        <li>
                            <a class="" href="javascript:void(0);" aria-expanded="false"><i class="<?php echo $icon; ?>"></i><?php echo $category->name; ?><span class="glyphicon arrow"></span></a>
                            <ul class="mm-collapse">
                                <?php foreach($category->modules as $modules){
                                    $nav = get_menu_data($modules->slug);
                                    ?>
                                    <!-- <li class="<?php echo $active_nav == $modules->core_name ? 'mm-active' : '' ?>"> -->
                                    <li class="<?php echo $category->slug == $this->uri->segment(2) ? 'mm-active' : '' ?>">
                                        <a href="<?php if(isset($nav['url'])){ echo $nav['url']; } ?>"><?php echo $modules->name; ?></a>
                                    </li>
                                <?php }
                                if ($category->slug == 'extensions') {?>
                                    <li class="<?php echo $category->slug == $this->uri->segment(2) ? 'mm-active' : '' ?>">
                                        <a href="<?php echo site_url('admin/extensions/coupon_code.html')?>">Coupon Code</a>
                                    </li>
                                <?php }?>

                            </ul>
                        </li>
                    <?php } }?>
            </ul><!-- Menu Ul End -->
        </div>
    </div>
    <!-- Nav Wrapper -->
</div>
<!-- Left Column -->
