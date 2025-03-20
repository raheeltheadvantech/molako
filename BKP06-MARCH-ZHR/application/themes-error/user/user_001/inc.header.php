 <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
        <!doctype html>
        <html class="no-js" lang="">
        <head>
            <meta charset="utf-8">
            <meta http-equiv="x-ua-compatible" content="ie=edge">
            <title><?php echo $page_title; ?></title>
            <meta name="title" content="<?php echo $meta_title;?>">
            <meta name="keyword" content="<?php echo $meta_keywords;?>">
            <meta name="description" content="<?php echo $meta_description;?>">
            <meta name="viewport" content="width=device-width, initial-scale=1">


            <?php $assets_dir = 'assets/'.site_config_item('user_assets').'/css/'; ?>
            <?php $assets_dir_js = 'assets/'.site_config_item('user_assets').'/js/'; ?>
            <?php $assets_dir_fs = 'assets/'.site_config_item('user_assets').'/fonts/'; ?>
            <?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>

            <!-- Favicon -->
            <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url($assets_img_dir.'logo/favicon.png') ?>">

            <!-- Icon Font CSS -->
            <link rel="stylesheet" href="<?php echo site_url($assets_dir_fs.'fonts.css') ?>">

            <!-- Plugins CSS -->
            <link rel="stylesheet" href="<?php echo site_url($assets_dir_fs.'font-icons.css') ?>">
            <link rel="stylesheet" href="<?php echo site_url($assets_dir.'bootstrap.min.css') ?>">
            <link rel="stylesheet" href="<?php echo site_url($assets_dir.'swiper-bundle.min.css') ?>">
            <link rel="stylesheet" href="<?php echo site_url($assets_dir.'animate.css') ?>">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

            <link rel="stylesheet" href="<?php echo site_url($assets_dir.'styles.css') ?>">

<style>
/*    cut_price*/
.cut_price{
  position: relative;
  text-decoration: line-through;
}
.menu-item-inline {
    position: relative;
}

.third-level-menu {
    display: none;
    position: absolute;
    left: 100%;
    top: 0;
    background-color: #fff;
    border: 1px solid #ddd;
    z-index: 1000;
}

.menu-item-inline:hover .third-level-menu {
    display: block;
}

.menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.menu-link-text {
    text-decoration: none;
    color: #333;
}

.menu-item-inline > a {
    padding: 10px;
    display: block;
}
.error{
    border:1px solid red !important;
}


</style>
        </head>
        <body class="preload-wrapper">
    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
    <div class="tf-top-bar bg_white line">
            <div class="px_15 lg-px_40">
                <div class="tf-top-bar_wrap grid-3 gap-30 align-items-center">
                    <ul class="tf-top-bar_item tf-social-icon d-flex gap-10">
                        <li><a  target="_blank" href="https://www.facebook.com/MolakoPeshawar?mibextid=ZbWKwL" class="box-icon w_28 round social-facebook bg_line"><i class="icon fs-12 icon-fb"></i></a></li>
                        <li><a href="https://m.twitter.com/login" class="box-icon w_28 round social-twiter bg_line"><i class="icon fs-10 icon-Icon-x"></i></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/molako_peshawar?igsh=c3R2eTY1bDlxcWhs" class="box-icon w_28 round social-instagram bg_line"><i class="icon fs-12 icon-instagram"></i></a></li>
                        <li><a target="_blank" href="https://www.tiktok.com/@molako_the_watch?_t=8psglCY6A2p&_r=1" class="box-icon w_28 round social-tiktok bg_line"><i class="icon fs-12 icon-tiktok"></i></a></li>
                        <li><a target="_blank" href="https://www.pinterest.com/" class="box-icon w_28 round social-pinterest bg_line"><i class="icon fs-12 icon-pinterest-1"></i></a></li>
                    </ul>
                    <div class="text-center overflow-hidden">
                        <div class="swiper tf-sw-top_bar" data-preview="1" data-space="0" data-loop="true" data-speed="1000" data-delay="2000">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <p class="top-bar-text fw-5"><?php echo $this->site_config->item('config_top_bar_content'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- <div class="top-bar-language tf-cur justify-content-end">


                        <div class="tf-currencies">
                            <select class="image-select center style-default type-currencies">
                                <option data-thumbnail="images/country/fr.svg">EUR <span>€ | France</span></option>
                                <option data-thumbnail="images/country/de.svg">EUR <span>€ | Germany</span></option>
                                <option selected data-thumbnail="images/country/us.svg">USD <span>$ | United States</span></option>
                                <option data-thumbnail="images/country/vn.svg">VND <span>₫ | Vietnam</span></option>
                            </select>
                        </div>
                        <div class="tf-languages">
                            <select class="image-select center style-default type-languages">
                                <option>English</option>
                                <option>العربية</option>
                                <option>简体中文</option>
                                <option>اردو</option>
                            </select>
                        </div>
                        
                    </div> -->
                </div>
            </div>
        </div>
        <!-- /Top Bar -->
        <!-- Header -->
        <header id="header" class="header-default header-absolute">
            <div class="px_15 lg-px_40">
                <div class="row wrapper-header align-items-center">
                    <!-- Mobile Menu Toggle -->
                    <div class="col-md-4 col-3 tf-lg-hidden">
                        <a href="#mobileMenu" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="16" viewBox="0 0 24 16" fill="none">
                                <path d="M2.00056 2.28571H16.8577C17.1608 2.28571 17.4515 2.16531 17.6658 1.95098C17.8802 1.73665 18.0006 1.44596 18.0006 1.14286C18.0006 0.839753 17.8802 0.549063 17.6658 0.334735C17.4515 0.120408 17.1608 0 16.8577 0H2.00056C1.69745 0 1.40676 0.120408 1.19244 0.334735C0.978109 0.549063 0.857702 0.839753 0.857702 1.14286C0.857702 1.44596 0.978109 1.73665 1.19244 1.95098C1.40676 2.16531 1.69745 2.28571 2.00056 2.28571ZM0.857702 8C0.857702 7.6969 0.978109 7.40621 1.19244 7.19188C1.40676 6.97755 1.69745 6.85714 2.00056 6.85714H22.572C22.8751 6.85714 23.1658 6.97755 23.3801 7.19188C23.5944 7.40621 23.7148 7.6969 23.7148 8C23.7148 8.30311 23.5944 8.59379 23.3801 8.80812C23.1658 9.02245 22.8751 9.14286 22.572 9.14286H2.00056C1.69745 9.14286 1.40676 9.02245 1.19244 8.80812C0.978109 8.59379 0.857702 8.30311 0.857702 8ZM0.857702 14.8571C0.857702 14.554 0.978109 14.2633 1.19244 14.049C1.40676 13.8347 1.69745 13.7143 2.00056 13.7143H12.2863C12.5894 13.7143 12.8801 13.8347 13.0944 14.049C13.3087 14.2633 13.4291 14.554 13.4291 14.8571C13.4291 15.1602 13.3087 15.4509 13.0944 15.6653C12.8801 15.8796 12.5894 16 12.2863 16H2.00056C1.69745 16 1.40676 15.8796 1.19244 15.6653C0.978109 15.4509 0.857702 15.1602 0.857702 14.8571Z" fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                    <!-- Logo -->
                    <div class="col-xl-3 col-md-4 col-6">
                        <a href="<?php echo base_url();?>" class="logo-header">
                            <img src="<?php echo site_url($assets_img_dir.'logo/logo.png') ?>" alt="logo" class="logo">
                        </a>
                    </div>
                    <!-- Navigation -->
                    <div class="col-xl-6 tf-md-hidden">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-ul d-flex align-items-center justify-content-center gap-30">
                            <?php echo create_navigation_html(array());?>
                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-3 col-md-4 col-3">
                        <ul class="nav-icon d-flex justify-content-end align-items-center gap-20">
                            <li class="nav-search">
                                <a href="#canvasSearch" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="nav-icon-item">
                                    <i class="icon icon-search"></i>
                                </a>
                            </li>
                            <?php
                            if(isset($_SESSION['user']) && $_SESSION['user'])
                            {
                                ?>
                                <li class="nav-account">
                                <a href="<?= base_url('secure/dashboard.html') ?>"  class="nav-icon-item">
                                    <i class="icon icon-account"></i>
                                </a>
                            </li>

                                <?php

                            }
                            else
                            {
                                ?>
                                <li class="nav-account">
                                <a href="<?= base_url('secure/login.html') ?>" class="nav-icon-item">
                                    <i class="icon icon-account"></i>
                                </a>
                            </li>
                                <?php
                            }

                        ?>
                            <li class="nav-wishlist">
                                <a href="<?= base_url('secure/wishlist.html') ?>" class="nav-icon-item">
                                    <i class="icon icon-heart"></i>
                                    <!-- <span class="count-box">0</span> -->

                                </a>
                            </li>
                            <li class="nav-cart">
                                <a href="#shoppingCart" onclick="loadCart();" data-bs-toggle="modal" class="nav-icon-item">
                                    <i class="icon icon-bag"></i>
                                    <?php
                                    if(isset($_SESSION['cart']) && count($_SESSION['cart']))
                                    {

                                    ?>
                                    <span class="count-box"><?= count($_SESSION['cart']) ?></span> 
                                    <?php
                                    }

                                    ?>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- mobile nav -->
                        <!-- mobile menu -->
                        <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
                            <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
                            <div class="mb-canvas-content">
                                <div class="mb-body">
                                    <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                                        <li class="nav-mb-item">
                                            <a href="#dropdown-menu-one" class="collapsed mb-menu-link current" data-bs-toggle="collapse" aria-expanded="true" aria-controls="dropdown-menu-one">
                                                <span>Shop By</span>
                                                <span class="btn-open-sub"></span>
                                            </a>
                                            <div id="dropdown-menu-one" class="collapse">
                                                <ul class="sub-nav-menu" >
                                                <?php echo create_navigation_html(array());?>
                                                </ul>
                                    <div class="mb-other-content">
                                        <div class="d-flex group-icon">
                                            <a href="wishlist.html" class="site-nav-icon"><i class="icon icon-heart"></i>Wishlist</a>
                                            <a href="home-search.html" class="site-nav-icon"><i class="icon icon-search"></i>Search</a>
                                        </div>
                                        <div class="mb-notice">
                                            <a href="contact-1.html" class="text-need">Need help ?</a>
                                        </div>
                                        <ul class="mb-info">
                                            <li>Address: <?php echo $this->site_config->item('config_address'); ?></li>
                                            <li>Email: <b><?php echo $this->site_config->item('config_email'); ?></b></li>
                                            <li>Phone: <b><?php echo $this->site_config->item('config_telephone'); ?></b></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>       
                        </div>
                        <!-- /mobile menu -->
                    <!-- Icons -->
            
                </div>
            </div>
        </header>
        <!-- /Header -->
</div>
<!-- The Modal -->

