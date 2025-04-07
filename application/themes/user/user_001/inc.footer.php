<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; 
?>
<?php
        if(isset($max_price) && $max_price)
        {
            ?>
            <div class="btn-sidebar-style2">
            <button data-bs-toggle="offcanvas" data-bs-target="#sidebarmobile" aria-controls="offcanvas"><i class="icon icon-sidebar-2"></i><span class="abcdef">Filter</span></button>
        </div>
        <?php
            }
        ?>

      <!-- Footer -->

      <footer id="footer" class="footer md-pb-70">

            <div class="footer-wrap">

                <div class="footer-body">

                    <div class="container">

                        <div class="row">

                            <div class="col-xl-3 col-md-6 col-12">

                                <div class="footer-infor">

                                    <div class="footer-logo">

                                        <a href="<?php echo base_url();?>">

                                            <img width="50%" src="<?php echo site_url($assets_img_dir.'logo/logo55.webp') ?>" alt="">

                                        </a>

                                    </div>

                                    <ul>

                                        <li>

                                            <p><?php echo $this->site_config->item('config_address'); ?></p>

                                        </li>

                                        <li>

                                            <p>Email: <?php echo $this->site_config->item('config_email'); ?></p>

                                        </li>

                                        <li>

                                            <p>Phone: <a href="tel:<?php echo $this->site_config->item('config_telephone'); ?>"><?php echo $this->site_config->item('config_telephone'); ?></a></p>

                                        </li>

                                    </ul>

                                    <a href="<?= base_url('contact-us.html'); ?>" class="tf-btn btn-line">Get direction<i class="icon icon-arrow1-top-left"></i></a>

                                    <ul class="tf-social-icon d-flex gap-10">

                                        <li><a target="_blank" href="https://www.facebook.com/MolakoPeshawar?mibextid=ZbWKwL" class="box-icon w_34 round social-facebook social-line"><img src="<?= base_url($assets_img_dir) ?>facebook_icon.png" /></a></li>
 
                                        <li><a target="_blank" href="https://www.instagram.com/molako_peshawar?igsh=c3R2eTY1bDlxcWhs" class="box-icon w_34 round social-instagram social-line"><img src="<?= base_url($assets_img_dir); ?>instagram_icon.png" /></a></li>

                                    </ul>

                                </div>

                            </div>

                            <div class="col-xl-3 col-md-6 col-12 footer-col-block">

                                <div class="footer-heading footer-heading-desktop">

                                    <h6>Help</h6>

                                </div>

                                <div class="footer-heading footer-heading-moblie">

                                    <h6>Help</h6>

                                </div>

                                <ul class="footer-menu-list tf-collapse-content">

                                    <li>

                                        <a href="<?php echo base_url('pages/privacy-policy.html')?>" class="footer-menu_item">Privacy Policy</a>

                                    </li>

                                    <li> 

                                        <a href="<?php echo base_url('pages/returns-exchanges.html')?>" class="footer-menu_item">  Returns + Exchanges </a>

                                    </li>

                                    <li> 

                                        <a href="<?php echo base_url('pages/shipping.html')?>" class="footer-menu_item">Shipping</a>

                                    </li>

                                    <li> 

                                        <a href="<?php echo base_url('pages/terms-conditions.html')?>" class="footer-menu_item">Terms &amp; Conditions</a>

                                    </li>

                                    <li> 

                                        <a href="<?php echo base_url('pages/faqs.html')?>" class="footer-menu_item">FAQ’s</a>

                                    </li>

                                </ul>

                            </div>

                            <div class="col-xl-3 col-md-6 col-12 footer-col-block">

                                <div class="footer-heading footer-heading-desktop">

                                    <h6>About us</h6>

                                </div>

                                <div class="footer-heading footer-heading-moblie">

                                    <h6>About us</h6>

                                </div>

                                <ul class="footer-menu-list tf-collapse-content">

                                    <li>

                                        <a href="<?php echo base_url('pages/our-story.html')?>" class="footer-menu_item">Our Story</a>

                                    </li>

                                    <li> 

                                        <a href="<?php echo base_url('pages/visit-our-store.html')?>" class="footer-menu_item">Visit Our Store</a>

                                    </li>

                                    <li> 

                                        <a href="<?php echo base_url('contact-us.html'); ?>" class="footer-menu_item">Contact Us</a>

                                    </li>

                                </ul>

                            </div>

                            <div class="col-xl-3 col-md-6 col-12">

                                <div class="footer-newsletter footer-col-block">

                                    <div class="footer-heading footer-heading-desktop">

                                        <h6>Sign Up for Newsletter</h6>

                                    </div>

                                    <div class="footer-heading footer-heading-moblie">

                                        <h6>Sign Up for Newsletter</h6>

                                    </div>

                                    <div class="tf-collapse-content">

                                        <div class="footer-menu_item">Sign up to get first dibs on new arrivals, sales, exclusive content, events and more!</div>

                                        <form class="form-newsletter subscribe-form" id="" action="#" method="post" accept-charset="utf-8" data-mailchimp="true">

                                            <div class="subscribe-content">

                                                <fieldset class="email">

                                                <input type="text" name="subscribe_name" onkeydown = "return /^[a-zA-Z\s]*$/.test(event.key)" placeholder="Name" id="subscribe_name" required="required" class="form-control">

                                                <!-- <input type="text" title="Sign up for our newsletter" placeholder="Email" name="subscribe_email" id="subscribe_email" required="required" class="form-control"> -->

                                                </fieldset>

                                                <fieldset class="email mt-2">
                        
                                                <input type="text" title="Sign up for our newsletter" placeholder="Email" name="subscribe_email" id="subscribe_email" required="required" class="form-control">

                                                </fieldset>

                                                <div class="button-submit">

                                                    <button id="btn-newsletter" type="button" onclick="add_newsletter()" class="subscribe-button tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn" type="submit">Subscribe<i class="icon icon-arrow1-top-left"></i></button>

                                                </div>

                                            </div>

                                            <div class="subscribe-msg"></div>

                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <div class="footer-bottom">

                    <div class="container">

                        <div class="row">

                            <div class="col-12">

                                <div class="footer-bottom-wrap d-flex gap-20 flex-wrap justify-content-between align-items-center">

                                    <div class="footer-menu_item">© 2024 <a href="<?php echo base_url();?>">Molako Store</a>. All Rights Reserved</div>

                                    <div class="tf-payment">

                                        <img src="<?php echo site_url($assets_img_dir.'payments/bank.webp') ?>" style="height: 32px; width: 30%;" alt="">

                                        <img src="<?php echo site_url($assets_img_dir.'payments/Jazz.webp') ?>" style="height: 32px; width: 30%;" alt="">

                                        <img src="<?php echo site_url($assets_img_dir.'payments/easypaisa.webp') ?>" style="height: 32px; width: 30%;" alt="">

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

        </footer>
<span class="whatsaapp_sppan">
            <a href="https://wa.me/923359228881" target="_blank" id="whatsapp-button">
    <img src="https://upload.wikimedia.org/wikipedia/commons/6/6b/WhatsApp.svg" alt="WhatsApp" width="50">
</a>
</span>

        <!-- /Footer -->

        

    </div>



    

    <!-- gotop -->

    <div class="progress-wrap">

        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">

        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 286.138;"></path>

        </svg>

    </div>

    <!-- /gotop -->

    

    <!-- toolbar-bottom -->

   <?php
// Get the current URI
$current_page = basename($_SERVER['REQUEST_URI']);
?>

<div class="tf-toolbar-bottom type-1150">

    <div class="toolbar-item <?= ($current_page == 'catalog.html') ? 'active' : '' ?>">
        <a href="<?php echo base_url('')?>catalog.html">
            <div class="toolbar-icon">
                <i class="icon-shop"></i>
            </div>
            <div class="toolbar-label">Shop</div>
        </a>
    </div>

    <div class="toolbar-item <?= ($current_page == '#canvasSearch') ? 'active' : '' ?>">
        <a href="#canvasSearch" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
            <div class="toolbar-icon">
                <i class="icon-search"></i>
            </div>
            <div class="toolbar-label">Search</div>
        </a>
    </div>

    <div class="toolbar-item">
        <?php
        if(isset($_SESSION['user']) && $_SESSION['user']) {
            ?>
            <div class="toolbar-item <?= ($current_page == 'dashboard.html') ? 'active' : '' ?>">
                <a href="<?= base_url('secure/dashboard.html') ?>" class="nav-icon-item">
                    <i class="icon icon-account"></i>
                    <div class="toolbar-label">Account</div>
                </a>
            </div>
            <?php
        } else {
            ?>
            <div class="toolbar-item <?= ($current_page == 'login.html') ? 'active' : '' ?>">
                <a href="<?= base_url('secure/login.html') ?>" class="nav-icon-item">
                    <i class="icon icon-account"></i>
                    <div class="toolbar-label">Account</div>
                </a>
            </div>
            <?php
        }
        ?>
    </div>

    <div class="toolbar-item <?= ($current_page == 'wishlist.html') ? 'active' : '' ?>">
        <a href="<?php echo base_url('secure/wishlist.html') ?>">
            <div class="toolbar-icon">
                <i class="icon-heart"></i>
            </div>
            <div class="toolbar-label">Wishlist</div>
        </a>
    </div>

    <div class="toolbar-item <?= ($current_page == '#shoppingCart') ? 'active' : '' ?>">
        <a href="#shoppingCart" onclick="loadCart();" data-bs-toggle="modal">
            <div class="toolbar-icon">
                <i class="icon-bag"></i>
            </div>
            <div class="toolbar-label">Cart</div>
        </a>
    </div>

</div>
    <!-- /toolbar-bottom -->

    <!--Filter model-->

    <div class="offcanvas offcanvas-start canvas-filter" id="filterShop" aria-modal="true" role="dialog">

        <div class="canvas-wrapper">

            <header class="canvas-header">

                <div class="filter-icon">

                    <span class="icon icon-filter"></span>

                    <span>Filter</span>

                </div>

                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>

            </header>

            <div class="canvas-body">

                <?php //include('inc.menu-category.php'); ?>    

            </div>

            

        </div>       

    </div>

    <!--Filter model-->





    <!-- canvasSearch -->

    <div class="offcanvas offcanvas-end canvas-search" id="canvasSearch">

        <div class="canvas-wrapper">

            <header class="tf-search-head">

                <div class="title fw-5">

                    Search our site

                    <div class="close">

                        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>

                    </div>

                </div>

                <div class="tf-search-sticky">

                    <div class="tf-mini-search-frm">

                        <fieldset class="text">

                            <input type="text" placeholder="Search" id="side_search" class="" name="text" tabindex="0" value="" aria-required="true" required="">

                        </fieldset>

                        <button class="" type="submit"><i class="icon-search"></i></button>

                    </div>

                </div>

            </header>

            <div class="canvas-body p-0">

                <div class="tf-search-content">

                    <div class="tf-cart-hide-has-results">

                        

                        <div class="tf-col-content" id="srch_rslt">

                            

                        </div>

                        <div class="tf-col-quicklink">



                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- /canvasSearch -->



    <!-- toolbarShopmb -->
    <!-- mobile menu -->
    <!-- <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-one" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-one">
                            <span>Home</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-one" class="collapse">
                            <ul class="sub-nav-menu" >
                                <li><a href="index.html" class="sub-nav-link">Home Fashion 01</a></li>
                                
                            </ul>
                        </div>
                        
                    </li>
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-two" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-two">
                            <span>Shop</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-two" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-navigation">
                                <li><a href="#sub-shop-one" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-shop-one">
                                        <span>Shop layouts</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-shop-one" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="shop-default.html" class="sub-nav-link">Default</a></li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#sub-shop-two" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-shop-two">
                                        <span>Features</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-shop-two" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="shop-link.html" class="sub-nav-link">Pagination links</a></li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#sub-shop-three" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-shop-three">
                                        <span>Product styles</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-shop-three" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-style-list.html" class="sub-nav-link">Product style list</a></li>
                                           
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-three" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-three">
                            <span>Products</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-three" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-navigation">
                                <li>
                                    <a href="#sub-product-one" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-product-one">
                                        <span>Product layouts</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-product-one" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-detail.html" class="sub-nav-link">Product default</a></li>
                                           
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#sub-product-two" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-product-two">
                                        <span>Product details</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-product-two" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-inner-zoom.html" class="sub-nav-link">Product inner zoom</a></li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#sub-product-three" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-product-three">
                                        <span>Product swatchs</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-product-three" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-color-swatch.html" class="sub-nav-link">Product color swatch</a></li>
                                            
                                        </ul>
                                    </div>
                                </li>
                                <li>
                                    <a href="#sub-product-four" class="sub-nav-link collapsed"  data-bs-toggle="collapse" aria-expanded="true" aria-controls="sub-product-four">
                                        <span>Product features</span>
                                        <span class="btn-open-sub"></span>
                                    </a>
                                    <div id="sub-product-four" class="collapse">
                                        <ul class="sub-nav-menu sub-menu-level-2">
                                            <li><a href="product-frequently-bought-together.html" class="sub-nav-link">Frequently bought together</a></li>
                                            
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-four" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-four">
                            <span>Pages</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-four" class="collapse">
                            <ul class="sub-nav-menu" id="sub-menu-navigation">
                                <li><a href="about-us.html" class="sub-nav-link">About us</a></li>
                                
                        </div>
                        
                    </li>
                    <li class="nav-mb-item">
                        <a href="#dropdown-menu-five" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-five">
                            <span>Blog</span>
                            <span class="btn-open-sub"></span>
                        </a>
                        <div id="dropdown-menu-five" class="collapse">
                            <ul class="sub-nav-menu" >
                                <li><a href="blog-detail.html" class="sub-nav-link">Single Post</a></li>
                            </ul>
                        </div>
                        
                    </li>
                </ul>
            </div>
        </div>       
    </div> -->
    <!-- /mobile menu -->

    <!-- /toolbarShopmb -->



    <!-- modal login -->

    <div class="modal modalCentered fade form-sign-in modal-part-content" id="login">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content login-content">

                

                    <?php

                    $CI =& get_instance();
                    echo $CI->load->view('ajax_login', array('email'=>''), true);


                    ?>

                </div>

            </div>

        </div>

    </div>

    <div class="modal modalCentered fade form-sign-in modal-part-content" id="forgotPassword">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="header">

                    <div class="demo-title">Reset your password</div>

                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>

                </div>

                <div class="tf-login-form">

                    <?php echo form_open($this->user_url .'/secure/forget-password.html') ?>

                            <?php if ($this->user_session->flashdata('login_error')) : ?>

                            <div class="alert alert-danger fade in">

                                <!-- <button class="close" data-dismiss="alert">×</button> -->

                                <i class="fa-fw fa fa-warning"></i>

                                <strong>Error!</strong> <?php echo $this->user_session->flashdata('login_error'); ?>

                            </div>

                            <?php endif; ?>

                        <div>

                            <p>Sign up for early Sale access plus tailored new arrivals, trends and promotions. To opt out, click unsubscribe in our emails</p>

                        </div>

                        <div class="tf-field style-1">

                        <?php echo form_input_1(array('name'=>'email', 'label'=>'Email', 'placeholder'=>'','type' => 'email', 'class'=>'form-control', 'value'=>set_value('email', $email))); ?>

                            <label class="tf-field-label" for="">Email *</label>

                        </div>

                        <div>

                            <a href="#login" data-bs-toggle="modal" class="btn-link link">Cancel</a>

                        </div>

                        <div class="bottom"> 

                            <div class="w-100">

                                <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Reset password</span></button>

                            </div>

                        </div>

                        <?php echo form_close(); ?>

                </div>

            </div>

        </div>

    </div>

    <div class="modal modalCentered fade form-sign-in modal-part-content" id="register">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="header">

                    <div class="demo-title">Register</div>

                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>

                </div>

                <div class="tf-login-form">

                <?php echo form_open($this->user_url .'/secure/register.html') ?>

                        <div class="tf-field style-1">

                        <?php echo form_input_1(array('name'=>'first_name', 'label'=>'First name *', 'class'=>'form-control', 'value'=>set_value('first_name', (isset($first_name)?$first_name:'')))); ?>

                            <label class="tf-field-label" for="">First name</label>

                        </div>

                        <div class="tf-field style-1">

                        <?php echo form_input_1(array('name'=>'last_name', 'label'=>'Last name *',  'class'=>'form-control', 'value'=>set_value('last_name', (isset($last_name)?$last_name:'')))); ?>

                            <label class="tf-field-label" for="">Last name</label>

                        </div>

                        <div class="tf-field style-1">

                        <?php echo form_input_1(array('name'=>'email', 'label'=>'Email *', 'class'=>'form-control', 'value'=>set_value('email', (isset($email)?$email:'')))); ?>

                            <label class="tf-field-label" for="">Email *</label>

                        </div>

                        <div class="tf-field style-1">

                        <?php echo form_input_1(array('name'=>'phone', 'label'=>'Phone *', 'class'=>'form-control', 'value'=>set_value('phone', (isset($phone)?$phone:'')))); ?>

                            <label class="tf-field-label" for="">Phone</label>

                        </div>

                        <div class="tf-field style-1">

                        <?php echo form_input_1(array('name'=>'password', 'label'=>'Password *', 'class'=>'form-control', 'type'=>'password')); ?>

                            <label class="tf-field-label" for="">Password *</label>

                        </div>

                        <div class="tf-field style-1">

                        <?php echo form_input_1(array('name'=>'confirm', 'label'=>'Confirm password *', 'class'=>'form-control', 'type'=>'password')); ?>

                            <label class="tf-field-label" for="">Password *</label>

                        </div>

                        <div class="bottom"> 

                            <div class="w-100">

                                <button type="submit" class="tf-btn btn-fill animate-hover-btn radius-3 w-100 justify-content-center"><span>Register</span></button>

                            </div>

                            <div class="w-100">

                                <a href="#login" data-bs-toggle="modal" class="btn-link fw-6 w-100 link">

                                    Already have an account? Log in here

                                    <i class="icon icon-arrow1-top-left"></i>

                                </a>

                            </div>

                        </div>

                        <?php echo form_close(); ?>  

                </div>

            </div>

        </div>

    </div>

    <!-- /modal login -->



    <!-- shoppingCart -->

    <div class="modal fullRight fade modal-shopping-cart" id="shoppingCart">

        <div class="modal-dialog">

            <div class="modal-content">

                <div class="header">

                    <div class="title fw-5">Shopping cart</div>

                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>

                </div>

                <div class="wrap" id="side_cart_content">

                    <div class="tf-mini-cart-threshold">

                        <div class="tf-progress-bar">

                            <span style="width: 50%;"></span>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- /shoppingCart -->

    

    <!-- modal quick_add -->

    <div class="modal fade modalDemo" id="quick_add">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">


                

            </div>

        </div>

    </div>

    <!-- /modal quick_add -->



    <!-- modal quick_view -->

    <div class="modal fade modalDemo" id="quick_view">

        <div class="modal-dialog modal-dialog-centered">

        </div>

    </div>

    <!-- /modal quick_view -->



    <!-- modal find_size -->

    <!-- Filter -->
    <!-- <div class="offcanvas offcanvas-start canvas-filter" id="filterShop">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <div class="filter-icon">
                    <span class="icon icon-filter"></span>
                    <span>Filter</span>
                </div>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </header>
            <div class="canvas-body">
                <div class="widget-facet wd-categories">
                    <div class="facet-title" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="true" aria-controls="categories">
                        <span>Product categories</span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
                    <div id="categories" class="collapse show">
                        <ul class="list-categoris current-scrollbar mb_36">
                            <li class="cate-item current"><a href="shop-default.html"><span>Fashion</span></a></li>
                            <li class="cate-item"><a href="shop-default.html"><span>Men</span></a></li>
                            <li class="cate-item"><a href="shop-default.html"><span>Women</span></a></li>
                            <li class="cate-item"><a href="shop-default.html"><span>Denim</span></a></li>
                            <li class="cate-item"><a href="shop-default.html"><span>Dress</span></a></li>
                        </ul>
                    </div>
                </div>
                <form action="#" id="facet-filter-form" class="facet-filter-form">
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#availability" data-bs-toggle="collapse" aria-expanded="true" aria-controls="availability">
                            <span>Availability</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="availability" class="collapse show">
                            <ul class="tf-filter-group current-scrollbar mb_36">
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="availability" class="tf-check" id="availability-1">
                                    <label for="availability-1" class="label"><span>In stock</span>&nbsp;<span>(14)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="availability" class="tf-check" id="availability-2">
                                    <label for="availability-2" class="label"><span>Out of stock</span>&nbsp;<span>(2)</span></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true" aria-controls="price">
                            <span>Price</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="price" class="collapse show">
                            <div class="widget-price">
                                <div id="slider-range"></div>
                                <div class="box-title-price">
                                    <span class="title-price">Price :</span>
                                    <div class="caption-price">
                                        <div>
                                            <span>$</span>
                                            <span id="slider-range-value1" class=""></span>
                                        </div>
                                        <span>-</span>
                                        <div>
                                            <span>$</span>
                                            <span id="slider-range-value2" class=""></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#brand" data-bs-toggle="collapse" aria-expanded="true" aria-controls="brand">
                            <span>Brand</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="brand" class="collapse show">
                            <ul class="tf-filter-group current-scrollbar mb_36">
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="brand" class="tf-check" id="brand-1">
                                    <label for="brand-1" class="label"><span>Ecomus</span>&nbsp;<span>(8)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="brand" class="tf-check" id="brand-2">
                                    <label for="brand-2" class="label"><span>M&H</span>&nbsp;<span>(8)</span></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#color" data-bs-toggle="collapse" aria-expanded="true" aria-controls="color">
                            <span>Color</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="color" class="collapse show">
                            <ul class="tf-filter-group filter-color current-scrollbar mb_36">
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_beige" id="beige">
                                    <label for="beige" class="label"><span>Beige</span>&nbsp;<span>(3)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_dark" id="black">
                                    <label for="black" class="label"><span>Black</span>&nbsp;<span>(18)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_blue-2" id="blue">
                                    <label for="blue" class="label"><span>Blue</span>&nbsp;<span>(3)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_brown" id="brown">
                                    <label for="brown" class="label"><span>Brown</span>&nbsp;<span>(3)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_cream" id="cream">
                                    <label for="cream" class="label"><span>Cream</span>&nbsp;<span>(1)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_dark-beige" id="dark-beige">
                                    <label for="dark-beige" class="label"><span>Dark Beige</span>&nbsp;<span>(1)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_dark-blue" id="dark-blue">
                                    <label for="dark-blue" class="label"><span>Dark Blue</span>&nbsp;<span>(3)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_dark-green" id="dark-green">
                                    <label for="dark-green" class="label"><span>Dark Green</span>&nbsp;<span>(1)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_dark-grey" id="dark-grey">
                                    <label for="dark-grey" class="label"><span>Dark Grey</span>&nbsp;<span>(1)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_grey" id="grey">
                                    <label for="grey" class="label"><span>Grey</span>&nbsp;<span>(2)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_light-blue" id="light-blue">
                                    <label for="light-blue" class="label"><span>Light Blue</span>&nbsp;<span>(5)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_light-green" id="light-green">
                                    <label for="light-green" class="label"><span>Light Green</span>&nbsp;<span>(3)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_light-grey" id="light-grey">
                                    <label for="light-grey" class="label"><span>Light Grey</span>&nbsp;<span>(1)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_light-pink" id="light-pink">
                                    <label for="light-pink" class="label"><span>Light Pink</span>&nbsp;<span>(2)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_purple" id="light-purple">
                                    <label for="light-purple" class="label"><span>Light Purple</span>&nbsp;<span>(2)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_light-yellow" id="light-yellow">
                                    <label for="light-yellow" class="label"><span>Light Yellow</span>&nbsp;<span>(1)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_orange" id="orange">
                                    <label for="orange" class="label"><span>Orange</span>&nbsp;<span>(1)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_pink" id="pink">
                                    <label for="pink" class="label"><span>Pink</span>&nbsp;<span>(2)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_taupe" id="taupe">
                                    <label for="taupe" class="label"><span>Taupe</span>&nbsp;<span>(1)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_white" id="white">
                                    <label for="white" class="label"><span>White</span>&nbsp;<span>(14)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="color" class="tf-check-color bg_yellow" id="yellow">
                                    <label for="yellow" class="label"><span>Yellow</span>&nbsp;<span>(1)</span></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="widget-facet">
                        <div class="facet-title" data-bs-target="#size" data-bs-toggle="collapse" aria-expanded="true" aria-controls="size">
                            <span>Size</span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="size" class="collapse show">
                            <ul class="tf-filter-group current-scrollbar">
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="size" class="tf-check" id="s">
                                    <label for="s" class="label"><span>S</span>&nbsp;<span>(7)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="size" class="tf-check" id="m">
                                    <label for="m" class="label"><span>M</span>&nbsp;<span>(8)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="size" class="tf-check" id="l">
                                    <label for="l" class="label"><span>L</span>&nbsp;<span>(8)</span></label>
                                </li>
                                <li class="list-item d-flex gap-12 align-items-center">
                                    <input type="radio" name="size" class="tf-check" id="xl">
                                    <label for="xl" class="label"><span>XL</span>&nbsp;<span>(6)</span></label>
                                </li>
                            </ul>
                        </div>
                    </div>
                </form>    
            </div>
            
        </div>       
    </div> -->
    <!-- End Filter -->

    <!-- /modal find_size -->



     <!-- add to cart -->

     <form action="<?php echo site_url('checkout/remove-cart.html')?>" method="post" id="rcart_form">

        <input type="hidden" name="item[product_id]" id="pid"/>
        <input type="hidden" name="item[product_option_value_id]" id="product_option_value_id"/>

     </form>

     <form action="<?php echo site_url('checkout/add-to-cart.html')?>" method="post" id="cart_form">

        <input type="hidden" name="item[quantity]" id="qty"/>
		<input type="hidden" name="item[product_option_value_id]" id="product_option_value_id"/>

        <input type="hidden" name="item[product_id]" id="pid"/>

     </form>

     <!-- add to cart end -->



     <!--  wishlists form -->

     <form action="<?php echo site_url('secure/wishlist/add.html')?>" method="post" id="wish_form">

        <input type="hidden" name="item[product_id]" id="pid"/>

     </form>

     <!-- wishlist form end -->



    <!-- auto popup  -->

    <!-- <div hidden class="modal modalCentered fade auto-popup modal-newleter">

        <div class="modal-dialog modal-dialog-centered">

            <div class="modal-content">

                <div class="modal-top">

                    <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'item/banner-newleter.jpg') ?>" src="<?php echo site_url($assets_img_dir.'item/banner-newleter.jpg') ?>" alt="home-01">

                    <span class="icon icon-close btn-hide-popup" data-bs-dismiss="modal"></span>

                </div>

                <div class="modal-bottom">

                    <h4 class="text-center">Don’t mis out</h4>

                    <h6 class="text-center">Be the first one to get the new product at early bird prices.</h6>

                    <form id="subscribe-form" action="#" class="form-newsletter" method="post" accept-charset="utf-8" data-mailchimp="true">

                        <div id="subscribe-content">

                        <input type="text" title="Sign up for our newsletter" placeholder="Email" name="subscribe_email" id="subscribe_email" required="required" class="form-control">

                        <button id="btn-newsletter"

                               onclick="add_newsletter()" title="Subscribe" class="tf-btn btn-fill radius-3 animate-hover-btn w-100 justify-content-center" type="submit">Subscribe</button>

                             <button type="button" id="subscribe-button" class="tf-btn btn-fill radius-3 animate-hover-btn w-100 justify-content-center">Keep me updated</button>

                        </div>

                        <div id="subscribe-msg"></div>

                    </form>

                </div>

            </div>

        </div>

    </div> -->

    <!-- auto popup  -->

    <!-- Filter sidebar-->
    <?php
        if(isset($max_price) && $max_price)
        {
            ?>
    <div class="offcanvas offcanvas-start canvas-filter canvas-sidebar" id="sidebarmobile">
        <div class="canvas-wrapper">
            <header class="canvas-header">
                <span class="title">Filters</span>
                <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
            </header>
            <div class="canvas-body sidebar-mobile-append">
                 
            </div>
            
        </div>       
    </div>
    <?php
    }
    ?>

<!-- Import Javascript -->

<?php $assets_dir = 'assets/'.site_config_item('user_assets').'/js/'; ?>

<?php $vendor_dir = 'assets/vendors/'; ?>





<!-- Plugins JS -->
<?php
// if(isset($page) && $page == 'home')
// {

// }
?>
<script src="<?php echo site_url($assets_dir.'bootstrap.min.js'); ?>"></script>

<script src="<?php echo site_url($assets_dir.'jquery.min.js'); ?>"></script>

<script src="<?php echo site_url($assets_dir.'swiper-bundle.min.js'); ?>"></script>

<script src="<?php echo site_url($assets_dir.'carousel.js'); ?>"></script>

<script src="<?php echo site_url($assets_dir.'bootstrap-select.min.js'); ?>"></script>

<script src="<?php echo site_url($assets_dir.'lazysize.min.js'); ?>"></script>

<script src="<?php echo site_url($assets_dir.'bootstrap-select.min.js'); ?>"></script>

<script src="<?php echo site_url($assets_dir.'count-down.js'); ?>"></script>

<script src="<?php echo site_url($assets_dir.'wow.min.js'); ?>"></script>

<script src="<?php echo site_url($assets_dir.'multiple-modal.js'); ?>"></script>
<script async src="https://static.addtoany.com/menu/page.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script type="module" src="<?php echo site_url($assets_dir.'model-viewer.min.js'); ?>"></script>
    <script type="module" src="<?php echo site_url($assets_dir.'zoom.js'); ?>"></script>

<script type="text/javascript">


    var BASE_URL = '<?php echo base_url(); ?>';
    function redirect_cat(cid)
    {
        var url = BASE_URL+'catalog.html?category_id='+cid;
        location.href=url;
    }
	var address_slug = '<?php echo (isset($address_slug)?$address_slug:'addresses') ?>';

</script>

<script src="<?php echo site_url($assets_dir.'main.js'); ?>"></script>

<script>

        <?php 

    $error = $this->user_session->flashdata('error');

    if ($error) : ?>

    toastr.error('error','<?= $error ?>');

    <?php

endif;

    ?>

    <?php 

    $success = $this->user_session->flashdata('success');

    if ($success) : ?>

    toastr.success('success','<?= $success ?>');

    <?php

endif;

    ?>

    <?php 

    $message = $this->user_session->flashdata('message');

    if ($message) : ?>

    toastr.success('success','<?= $message ?>');

    <?php

endif;

    ?>
    function isJsonString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
}

    function quick_add(pid,qty,vari= 0)
    {
if(!qty)
        {
            return 0;
        }
        else
        {
			if(vari)
			{
				$('#cart_form #product_option_value_id').val(vari);
			}

        $('#cart_form #qty').val(qty);

        $('#cart_form #pid').val(pid);
        $.ajax({
            type: $('#cart_form').attr('method'),
            url: $('#cart_form').attr('action'),
            data: $('#cart_form').serialize()+'&is_ajax=',
            success: function (data) {
                if(isJsonString(data))
                {
                    data = JSON.parse(data);
                    toastr.error('error',data.msg);

                }
                else
                {
                    let str = data;
let endIndex1 = str.indexOf("=@"); // `=@` ka index find karna, but not include

let extractedString = str.substring(0, endIndex1); // `=@` se pehle tak extract karega

if(!extractedString)
{
    $('.nav-cart .count-box').hide();
}
else
{
    $('.nav-cart .count-box').show();
}
$('.nav-cart .count-box').html(extractedString);
let endIndex = data.indexOf("=@") + 3; // `=@` tak ka index find karna

let updatedStr = str.substring(endIndex); // `=@` tak ka part hata diya

                    $('#shoppingCart').modal('show');

                    $('#side_cart_content').html(updatedStr);
                }
            }
          });
    }

    }

    function remove_cart(pid,product_option_value_id)

    {

        $('#rcart_form #pid').val(pid);
        $('#rcart_form #product_option_value_id').val(product_option_value_id);

        

        // $('#rcart_form').submit();
        $.ajax({
            type: $('#rcart_form').attr('method'),
            url: $('#rcart_form').attr('action'),
            data: $('#rcart_form').serialize()+'&is_ajax=',
            success: function (data) {
                if(isJsonString(data))
                {
                    data = JSON.parse(data);
                    toastr.error('error',data.msg);

                }
                else
                {
                    var msg = 'Product is removed successfully from the cart.';
                    toastr.success('success',msg);
                    let str = data;
let endIndex1 = str.indexOf("=@"); // `=@` ka index find karna, but not include

let extractedString = str.substring(0, endIndex1); // `=@` se pehle tak extract karega

if(!extractedString)
{
    $('.nav-cart .count-box').hide();
}
else
{
    $('.nav-cart .count-box').show();
}
$('.nav-cart .count-box').html(extractedString);
let endIndex = data.indexOf("=@") + 3; // `=@` tak ka index find karna

let updatedStr = str.substring(endIndex); // `=@` tak ka part hata diya

                    $('#shoppingCart').modal('show');

                    $('#side_cart_content').html(updatedStr);
                }
            }
          });

    }



    function wishlist(pid,remove= 0)

    {

        if(remove)

        {

            var url = "<?= base_url('secure/wishlist/remove.html'); ?>";

            $('#wish_form').attr('action',url);

        }

        $('#wish_form #pid').val(pid);

        $('#wish_form').submit();

    }

function quick_view(pid)

{

// alert(pid);



var url = '<?= base_url() ?>quickview.html?pid='+pid;

$.ajax({url: url, success: function(result){

    

$('#quick_view').modal('show');$('#quick_view').html(result);

  }});

}



</script>

<script type="text/javascript">



    $(function() {

        $('.couponBtn').click(function() {

            let coupon_code = $('#coupon_code').val();

            console.log('coupon_code',coupon_code);

            if (coupon_code) {

                $.ajax({

                    url:"<?php echo base_url('checkout/apply-coupon.html')?>",

                    type:"POST",

                    data:{coupon_code:coupon_code},

                    success:function (res) {

                        console.log('res',res);

                        res = $.parseJSON(res);

                        if (res.error == true) 

                        {

                            toastr.error('error',res.message);

                        }else{

                            toastr.success('success',res.message);

                            location.reload(true);//issue to get code record

                        }

                    }

                })

            }

        });

        $('.remveCoupon').click(function() {

            $.ajax({

                url:"<?php echo base_url('checkout/remove-coupon.html')?>",

                success:function (res) {

                    res = $.parseJSON(res);

                    if (res.error == true) 

                    {

                        toastr.error('error',res.message);

                    }else{

                        toastr.success('success',res.message);

                    }

                    // window.href = "<?php echo base_url('checkout/cart.html')?>";

                    location.reload(true);

                }

            })

        });

    })

    function loadCart()

    {
        $('#shoppingCart').modal('show');

        var html = `<div class="text-center mt-5"><div class="spinner-border" role="status">

  <span class="visually-hidden">Loading...</span>

</div></div>`;

        $('#side_cart_content').html(html);

        // return 0;

        var url = '<?= base_url('checkout/load-cart.html') ?>';

        $.ajax({

        url: url,

        async: true,

        data: { },

        success: function (data) {

           $('#side_cart_content').html(data);

        },

        error: function (xhr, exception) {

            var msg = "";

            if (xhr.status === 0) {

                msg = "Not connect.\n Verify Network." + xhr.responseText;

            } else if (xhr.status == 404) {

                msg = "Requested page not found. [404]" + xhr.responseText;

            } else if (xhr.status == 500) {

                msg = "Internal Server Error [500]." +  xhr.responseText;

            } else if (exception === "parsererror") {

                msg = "Requested JSON parse failed.";

            } else if (exception === "timeout") {

                msg = "Time out error." + xhr.responseText;

            } else if (exception === "abort") {

                msg = "Ajax request aborted.";

            } else {

                msg = "Error:" + xhr.status + " " + xhr.responseText;

            }

           

        }

    });

    }

    $('#side_search').on("keypress keyup", function(e) {

    var str = $(this).val();

    if(str.length >= 3)

    {

        var html = `<div class="text-center mt-5"><div class="spinner-border" role="status">

  <span class="visually-hidden">Loading...</span>

</div></div>`;

        $('#srch_rslt').html(html);      

        var url = '<?= base_url('checkout/top-search.html') ?>';

        $.ajax({

        url: url,

        async: true,

        data: { srch:str },

        success: function (data) {

           $('#srch_rslt').html(data);

        },

        error: function (xhr, exception) {

            var msg = "";

            if (xhr.status === 0) {

                msg = "Not connect.\n Verify Network." + xhr.responseText;

            } else if (xhr.status == 404) {

                msg = "Requested page not found. [404]" + xhr.responseText;

            } else if (xhr.status == 500) {

                msg = "Internal Server Error [500]." +  xhr.responseText;

            } else if (exception === "parsererror") {

                msg = "Requested JSON parse failed.";

            } else if (exception === "timeout") {

                msg = "Time out error." + xhr.responseText;

            } else if (exception === "abort") {

                msg = "Ajax request aborted.";

            } else {

                msg = "Error:" + xhr.status + " " + xhr.responseText;

            }

           

        }

    });

    }



})

     function add_newsletter() {

        let name = $('input[name=\'subscribe_name\']').val();

        let email = $('input[name=\'subscribe_email\']').val();

        var error = 0;

        $('.subscribe-form input').each(function(){

            $(this).removeClass('error');

    if($(this).attr('required') == 'required' && !$(this).val()){

        error = 1;

        $(this).addClass('error');

    }

 });

        console.log('email',email);

        if(!error)

        {



        $.ajax({

            url: '<?= base_url('newsletter.html'); ?>',

            type: 'post',

            data: {

                'email': email,

                'name': name,

            },

            dataType: 'json',

            beforeSend: function () {

                $('#btn-newsletter').button('loading');

            },

            complete: function () {

                $('#btn-newsletter').button('reset');

            },

            success: function (json) {

                $('.subscribe-form input').each(function(){

            $(this).removeClass('error');

 });

                $('#name').empty();

                $('#nemail').empty();



                if (json.error == true) 

                {

                    toastr.error('error',json.message);

                }

                else

                {

                    toastr.success('success',json.message);

                }



            },

            error: function (xhr, ajaxOptions, thrownError) {

                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

            }

        });

        }

    }

    function update_qty(i,type,vari)

    {

        var qid = '.qty_'+i;

        var old_qty = $(qid).val();

        var pid = $('#tr_'+i).attr('pid');

        var new_qty = old_qty;

        if(type == 'plus')

        {

            new_qty++;

        }
        else if(type == "auto")
        {
            new_qty = $(qid).val();

        }

        else

        {

            new_qty--;

        }

        if(!new_qty)

        {

            //remove_cart(pid);

            return 0;



        }
        if(new_qty)
        {

        $(qid).val(new_qty);

        var url ="<?= base_url('checkout/update-cart.html'); ?>";

        //show b loader
 
                var html = `<div class="text-center"><div class="spinner-border" role="status">

  <span class="visually-hidden">Loading...</span>

</div></div>`;

$('#tr_'+i+' .cart-total').html(html);

$('#tot').html(html);

$.ajax({

            url: url,

            type: 'post',

            data: {

                'item[key]': $('#tr_'+i).attr("sku"),

                'item[quantity]': new_qty,
                'item[product_option_value_id]': vari,

                'ajax':1

            },

            // dataType: 'json',

            beforeSend: function () {

                $('#tr_'+i+' .cart-total').html(html);

$('.total-value').html(html);

            },

            complete: function () {

                $('#btn-newsletter').button('reset');

            },

            success: function (json) {

                var obj = JSON.parse(json);

            if(obj.status)

            {

                toastr.success('success',obj.msg);

                calculateCart(obj.data,obj.coupon);



            }

            else

            {
				$(qid).val(old_qty);

                toastr.error('error',obj.msg);
				$(qid).val(old_qty);
				calculateCart(obj.data,obj.coupon);

                //calculateCart(obj.data,obj.coupon);



            }



            },

            error: function (xhr, ajaxOptions, thrownError) {

                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);

            }

        });
        }



    }

    function isNumber(n) {

        //return !isNaN(parseFloat(n)) && isFinite(n);

        return parseFloat(n) == n;

    }

    function number_format(number, decimals, dec_point, thousands_sep) {



    // Strip all characters but numerical ones.

    number = (number + '').replace(/[^0-9+\-Ee.]/g, '');

    var n = !isFinite(+number) ? 0 : +number,

        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),

        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,

        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,

        s = '',

        toFixedFix = function(n, prec) {

            var k = Math.pow(10, prec);

            return '' + Math.round(n * k) / k;

        };

    // Fix for IE parseFloat(0.55).toFixed(0) = 0;

    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');

    if (s[0].length > 3) {

        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);

    }

    if ((s[1] || '').length < prec) {

        s[1] = s[1] || '';

        s[1] += new Array(prec - s[1].length + 1).join('0');

    }

    return s.join(dec);

}

    function format_currency(value, symbol, decimal_points) {



    symbol = typeof(symbol) != 'undefined' ? symbol : true;

    decimal_points = typeof(decimal_points) != 'undefined' ? decimal_points : true;



    if (!isNumber(value)) {

        return;

    }



    if (value < 0) {

        neg = '- ';

    } else {

        neg = '';

    }



    if (symbol) {

        formatted = number_format(Math.abs(value), (decimal_points ? 2 : 0), '.', ',');



        if ('left' == 'left') {

            formatted = neg + 'Rs' + formatted;

        } else {

            formatted = neg + formatted + 'Rs';

        }

    } else {

        //traditional number formatting

        formatted = number_format(Math.abs(value), (decimal_points ? 2 : 0), '.', ',');

    }



    return formatted;

}

    function calculateCart(data,coupon)

    {
        $('#tot').html(' ');
		//cart-total


        console.log(data);

        var tot = 0;

        $.each(data , function(sku, val) {

  console.log(sku);
  console.log(sku, val);

    var sing = (val.price * val.quantity);
	$('tr[sku="'+sku+'"]').find('.cart-total').html(format_currency(sing)); 

  //$('tr_'+sku+' .cart-total').html(format_currency(sing));

  tot = tot + sing; 



});
        var html = `<div class="tf-cart-totals-discounts">
                                    <h3>Subtotal</h3>
                                    <span class="stotal-value">`+format_currency(tot)+`</span>
                                </div>`;
                                $('#tot').append(html);
                                var discount = 0;
                                if(coupon)
                                {
                                    if (coupon.type == 'percent') 
                                    {
                                        discount = (tot/100)*coupon.value;
                                    }else{
                                        discount = coupon.value;
                                    }
            html = `<div class="tf-cart-totals-discounts">
                                    <h3><i class="icon icon-delete text-danger remveCoupon" style="cursor: pointer;"></i> Discount (`+coupon.code+`)</h3>
                                    <span class="coupon-value">`+format_currency(discount)+`</span>
                                </div>`;
                                $('#tot').append(html);
                                } 
                                tot = tot - Math.abs(discount);
                                html = `<div class="tf-cart-totals-discounts">
                                    <h3>Grandtotal</h3>
                                    <span class="stotal-value">`+format_currency(tot)+`</span>
                                </div>`;
                                $('#tot').append(html);

    }
    var isMobile = false;
if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) 
    || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
    isMobile = true;
}
	function showAjaxPreloader(is_window, top, left) {
	var topP = (typeof top === 'undefined') ? '' : top;
	var leftP = (typeof left === 'undefined') ? '' : left;
	var is_window = (typeof is_window === 'undefined') ? true : is_window;
	var preloaderOverlay = $('<div id="ajax-preloader-overlay"></div>').appendTo($('body')),
		preloaderContainer = $('<div id="preloader-container"></div>').appendTo($('body'));
		
	preloaderOverlay.css('width', $(document).width());
	preloaderOverlay.css('height', $(document).height());
	
	var topPosition = $(document).scrollTop() + ($(window).height() - preloaderContainer.outerHeight(true)) / 2,
		leftPosition = ($(document).width() - preloaderContainer.outerWidth(true)) / 2;
		
		if(topP != '')topPosition = topP;
		if(leftP != '')leftPosition = leftP;
		if(is_window){
			leftPosition = ($(window).width() - preloaderContainer.outerWidth(true)) / 2;
		}
		
	preloaderContainer.css({top: topPosition, left: leftPosition});
}
		$(document).on("click",".filter-checkbox", function(){
            var mid = $(this).attr('id');
            var ischecked = $(this).is(':checked');
            $(".filter-checkbox").each(function() {
    if($(this).attr('id') == mid)
    {
        $(this).prop("checked", ischecked);

    }
});

        Filter_check($(this));

    });
	var ptype = 'desktop';
	function Filter_check(th)
	{
         let filter = [];
		 showAjaxPreloader();
         let kk = th.attr('data-key');
         if(kk)
         {
             let val = $(th).val();
            if ($(th).is(":checked")) {

                filter.push(kk+'_'+val);

            }else{
     
                filter.splice( $.inArray(val, filter), 1 );

                

            }
        }

        console.log('filter',filter);

        // $.ajax({

        //     url: "<?php echo site_url('catalog.html?filter_id=')?>"+filter,

        //     // type:"",

        //     // data:{ 'filter_ids' : filter},

        //     success:function(resp){

        //         console.log('resp',resp);

        //     }

        // });
		var min = $('#'+ptype+'_min').val();
		var max = $('#'+ptype+'_max').val();
		
        if(isMobile)
        {
            min = $('.sidebar-mobile-append #'+ptype+'_min').val();
            max = $('.sidebar-mobile-append #'+ptype+'_max').val();

        }
        var price = min+'_'+max;
        $('.desktop-min-price').text(min);
        $('.desktop-max-price').text(max);

        

        if ($.isArray(filter)) {
            if(isMobile)
            {
                    $('.sidebar-mobile-append #filter_form').submit();
            }
            else
            {
    			$('#filter_form').submit();
            }

            //window.location = "<?php echo site_url('catalog.html?filter_id=');?>"+filter+'&price='+price;

        }
	}
	function showVal(type,min_max)
    {
        ptype = type;
        var mid = '#'+type+'_'+min_max;
        var mcls = '.'+type+'-'+min_max+'-price';
        $(mcls).text($(mid).val());
        var ths =  $(this);
        Filter_check($(this));
    }

    $('.dd-sort_id').on('change', function(){

        var dis = $(this),

        sort = dis.find(':selected').data('sort'),

        order = dis.find(':selected').data('order'),

        sort = (typeof sort == 'undefined' ? '' : sort),

        order = (typeof order == 'undefined' ? '' : order),

        <?php if( isset($brand_id)) { ?>

        //inpts = 'order='+order+'&sort='+sort+'&code=<?php echo $code; ?>'+'&brand_id=<?php echo $brand_id; ?>';

        <?php }elseif( isset($category_id)) { ?>

        //inpts = 'order='+order+'&sort='+sort+'&code=<?php echo $code; ?>'+'&category_id=<?php echo $category_id; ?>';

        <?php } ?>

        inpts = 'order='+order+'&sort='+sort;
		

        

        url = '<?php echo site_url($this->user_url . '/catalog.html'); ?>';

        url = '<?php echo (isset($no_sort_url)?$no_sort_url:''); ?>';

        //url =  window.location.href;

        

        url = url + ((url.indexOf('?') !== -1) ? '&' : '?') + inpts;

        //alert(url);return false;
		$('#filter_order').val(order);  
		$('#filter_sort').val(sort);
		$('#filter_form').submit();
		return 0;

        //window.location = url;

    });
    <?php
        if(isset($combination))
        {
            ?>
            var combination = JSON.parse('<?php echo json_encode($combination); ?>');
            function reset_variations(satt,sval,datt,dv)
            {
                var ret = false;
                Object.entries(combination).forEach(student => {
  // key: student[0]
  // value: student[1]
                    if(student[1]['stock'])
                    {
                        var comb = student[1]['comb'];
                        if(comb[satt] == sval && comb[datt]== dv && !ret)
                        {
                            ret = true;
                        }

                    }
});
                //yhn logic klikhni ha

                return ret;

            }

            <?php

        }
        ?>
    $(document).on('change', '.variant_dropdowns',function(event) {
        var sval = $(this).val();
        var src_attr= $(this).attr('data-key');
        $(".variant_dropdowns").each(function(){ 
            if($(this).attr('type') == 'radio' && $(this).attr('data-key') != src_attr)    
            {
                var ret = reset_variations(src_attr,sval,$(this).attr('data-key'),$(this).val());
                console.log(ret);
                var mid = '#'+$(this).attr('data-key')+'_'+$(this).val();
                if(!ret)
                {
                    

                    $(mid).hide();
                    $(this).attr("checked", false);
                }
                else
                {
                    $(mid).show();

                }
                console.log($(this).attr('data-key')+' : '+$(this).val()); 
            }
});


        get_variation_detail();
    });
	<?php
			if(isset($sing_var) && $sing_var)
			{
				?>
				get_variation_detail();
				
				<?php
			}
		?>

    function get_variation_detail(){

        $('#detail_add_to_cart').attr('disabled',true);
        $('#detail_add_to_cart').css('cursor','no-drop');

        var variations = '';
        $('.variant_dropdowns').each(function(){
			console.log($(this).val()+' = '+$(this).attr('checked'));
            if(variations == '')
                variations = $(this).val();
            else
                variations += '-'+$(this).val();
        });

        var product_id = $('#product_id').val();
        $('#noVariant').hide();
        $.ajax({
            url: BASE_URL+'checkout/get_variant_details.html',
            type: 'post',
            data: $('#product-data1').serialize(),
            dataType: 'json',
            beforeSend: function() {
                //$('#button-cart').button('loading');
            },
            complete: function() {
                //  $('#button-cart').button('reset');
            },
            success: function(json) {
                if (json['success']) {
                    if(json['variant_image'])
                    {
                        ch_img(json['variant_image']);
                    }
                    $('#variant_id').val(json['variant_id']);
                    $('.variant_id').val(json['variant_id']);
                    $('#product_cur_qty').val(json['variant_qty']);
                    $('.det_qty').text(json['variant_qty']);
                    if(json['variant_qty'] <= 5)
                    {
                        $('#qty5').show();
                    }
                    else
                    {
                        $('#qty5').hide();
                    }
                    $('.product-card__item-stock-number').text(json['variant_qty']+' ');
                    var item_price = json['variant_price'];

                    $('.price-on-sale').text(item_price);
                    $('.tf-qty-price').text(item_price);

                    $('#detail_add_to_cart1').removeAttr('disabled');
                    $('#detail_add_to_cart1').css('cursor','pointer');

                }else{ 
                if( json['config_catalog_purchase'])
                {

                    $('#noVariant').show();
                    $('#detail_add_to_cart1').attr('disabled',true);
                    $('#detail_add_to_cart1').css('cursor','no-drop');
                }
                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });

        // alert(variations);
    }
    function detail_click(form = '',btn_id = '')
    {
		if($('#'+btn_id).attr('disabled'))
		{ 
			return 0;
		}
		if(form == 'product-form-data1_up')
		{
			$('#quantity').val($('#qty').val());
		}
        $.ajax({
            type: $('.'+form).attr('method'),
            url: $('.'+form).attr('action'),
            data: $('.'+form).serialize()+'&is_ajax=',
            success: function (data) {
                if(isJsonString(data))
                {
                    data = JSON.parse(data);
                    toastr.error('error',data.msg);

                }
                else
                {
                    let str = data;
let endIndex1 = str.indexOf("=@"); // `=@` ka index find karna, but not include

let extractedString = str.substring(0, endIndex1); // `=@` se pehle tak extract karega

if(!extractedString)
{
    $('.nav-cart .count-box').hide();
}
else
{
    $('.nav-cart .count-box').show();
}
$('.nav-cart .count-box').html(extractedString);
let endIndex = data.indexOf("=@") + 3; // `=@` tak ka index find karna

let updatedStr = str.substring(endIndex); // `=@` tak ka part hata diya

                    $('#shoppingCart').modal('show');

                    $('#side_cart_content').html(updatedStr);
                }
            }
          });

    }
	function place_order()
	{
        var btn = $(this);
        console.log(btn.attr('disabled'));
        if(btn.attr('disabled'))
        { 
            return 0;
        }
        btn.attr("disabled", true);



        if(document.getElementById('check-agree').checked) {
            var payment = $("input[name='payment-method']:checked").val();
                    if(payment == 'jazzcash')
                    {
                        $.ajax({
            type: 'post',
            url: BASE_URL+'guest/ajax-checkout.html',
            data: $('.checkout_form').serialize(),
            success: function (resp) {
              resp = jQuery.parseJSON(resp);
            if(resp['error'])
            {
                $('#side_html').html(resp['html']);
                btn.attr("disabled", false);
            }
            else
            {
                // $('#jazzcash_form').find('input[name="ppmpf_1"]').val(resp['fields']['ppmpf_1']);
                // alert($('#jazzcash_form').find('input[name="ppmpf_1"]').val());
                $.each(resp['fields'], function(index, value){
      console.log(index+'  ==  '+value);
      $('#jazzcash_form').find('input[name="'+index+'"]').val(resp['fields'][index]);
    });
                $('#jazzcash_form').submit();
                // alert(resp['redirect']);
            }

            return 0;
            }
          });

                    }
                    else
                    {
                        $('.checkout_form').submit();

                    }
        } 
        else {
            btn.attr("disabled", false);
                toastr.error('error','Please Agree to Term and condition to place order');
        }
	}
    function login_submit()
    {


        // var sbmit = $(this);
        // var old_text = sbmit.text();
        // sbmit.text('Submitting ...');
        // sbmit.prop('disabled', true);

        // Collect form data
        var data = {
            email: $('#ajax_login').find('input[name="email"]').val(),
            password: $('#ajax_login').find('input[name="password"]').val(),
            submitted:'1'
        };

        console.log(data);

        $.ajax({
            method: 'post',
            url: '<?php echo site_url($this->user_url .'secure/ajax_login.html'); ?>',

            data: data,
        })
        .done(function(resp) {
            resp = jQuery.parseJSON(resp);
            if(resp['error'])
            {
                $('.login-content').html(resp['html']);
            }
            else
            {
                // alert(resp['redirect']);
                var url = resp['redirect'];
                window.location.href = url;
            }
            return 0;
        })
        .fail(function(jqXHR, textStatus, errorThrown) {
            sbmit.prop('disabled', false);
            sbmit.text(old_text);
            login_error.show();
            alert("Request failed: " + textStatus + ", " + errorThrown);
        });

    }
    function formatPhone(input) {
            // Remove all non-digit characters
            let phoneNumber = input.value.replace(/\D/g, '');

            // Apply the Pakistani phone number format
            if (phoneNumber.length <= 4) {
                input.value = phoneNumber;
            } else if (phoneNumber.length <= 11) {
                input.value = `${phoneNumber.substring(0, 4)}-${phoneNumber.substring(4)}`;
            } else {
                input.value = `${phoneNumber.substring(0, 4)}-${phoneNumber.substring(4, 11)}`;
            }
        }




</script>
<?php
if (isset($address_menu) && $address_menu) {
    // Convert each element's 'data' field into an array
    foreach ($address_menu as $k => $v) {
        $address_menu[$k] = (array) $v['data'];
    }

    // Encode PHP array to JSON
    $json = json_encode($address_menu, JSON_HEX_APOS | JSON_HEX_QUOT); // Use JSON_HEX_* constants to safely handle quotes

    // Output JSON safely in JavaScript
    ?>
    <script type="text/javascript">
        var address = JSON.parse('<?php echo $json; ?>');
        console.log(address, 'address');

        function chng_address() {
            var val = $('.address_id').val();
            if(address[val])
            {
                addres = address[val];
                $('.checkout_guest').find('input[name="first_name"]').val(addres.first_name);
                $('.checkout_guest').find('input[name="last_name"]').val(addres.last_name);
                $('.checkout_guest').find('input[name="last_name"]').val(addres.last_name);
                $('.checkout_guest').find('textarea[name="address_1"]').val(addres.address_1);
                $('.checkout_guest').find('input[name="region_name"]').val(addres.region_name);
                $('.checkout_guest').find('input[name="city"]').val(addres.city);
            }
        }
    </script>
    <?php
}
?>
    <script type="text/javascript">
        function ch_img(img)
        {
            var url = '<?= base_url('images/products/medium') ?>/'+img;
            $('.swiper-slide-active img').attr('src',url);
//             $('.swiper-wrapper .stagger-item').each(function(){
//                 if ($(this).find('img').attr('src').includes(img)) {
//   console.log("Found!");
// } else {
//   console.log("Not Found!");
// }
//                 //swiper-slide-active
//             });
        }
    </script>
    <?php
    if(isset($page) && $page == 'home')
    {
        ?>
        <script type="text/javascript">
            function updateButtonClass() {
    let btn = $('.wrap-slider a');
    
    if (window.innerWidth > 820) {
        $('.slider-btn').each(function(){
            $(this).removeClass("btn-sm");
            $(this).removeClass("btn-md");
            $(this).addClass("btn-xl");
        });
    }
    else if (window.innerWidth > 428 && window.innerWidth <= 820) {
        $('.slider-btn').each(function(){
            $(this).removeClass("btn-sm");
            $(this).removeClass("btn-xl");
            $(this).addClass("btn-md");
        });
    } else {
        $('.slider-btn').each(function(){
            $(this).removeClass("btn-md");
            $(this).removeClass("btn-xl");
            $(this).addClass("btn-sm");
        });
    }
}
$(document).ready(function(){
    updateButtonClass();
});

// Pehli baar function run karo
updateButtonClass();

// Jab bhi window resize ho, function run hoga
window.addEventListener("resize", updateButtonClass);

            document.addEventListener("DOMContentLoaded", function () {
    let lazyImages = document.querySelectorAll("img");
    lazyImages.forEach(img => {
        img.setAttribute("loading", "lazy");
    });
});
            $(document).ready(function(){
                var url = '<?= base_url('special_products.html'); ?>';
            $( "#special_products" ).load(url);
                var url = '<?= base_url('best_products.html'); ?>';
            $( "#best_products" ).load(url);
                var url = '<?= base_url('user_home/new_arrival_products'); ?>';
            $( "#new_arrival_products" ).load(url);

            });
        </script>

        <?php
    }
    ?>




</body>

</html>

