 <?php defined('BASEPATH') OR exit('No direct script access allowed'); 
 ?>
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

            <link rel="stylesheet" href="<?php echo site_url($assets_dir.'styles.css') ?>?v=<?= time() ?>">
            <!--Adeel css-->
            <style type="text/css">
                .hover-tooltip{
                    border:1px solid #c9c9c9 !important;
                }
                #whatsapp-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        background-color: #25d366;
        padding: 0px;
        border-radius: 50%;
        box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.2);
        transition: transform 0.2s ease-in-out;
    }
    
    #whatsapp-button:hover {
        transform: scale(1.1);
    }

  #footer{
    background-color: #000 !important;
  }

  .footer .footer-infor ul li a,   .footer .footer-infor ul li {
    color:#fff !important;
  }

  .footer-menu-list li,  .footer-menu-list li a, .footer-heading h6 .footer-heading-desktop h6 {
    color:#fff !important;
  }


  .footer-heading h6, .footer-menu_item, .filter-option-inner {
    color:#fff !important;
  }

  .dropdown.bootstrap-select.image-select.style-default > button::after {
    border: 0;
    position: absolute;
    right: 0;
    content: "\e904";
    font-family: "icomoon";
    font-size: 6px;
    color: #fff !important;
    margin: -3px 0 0 0;
  }
  @media (max-width: 1575px) { 
  .box-navigation {
  margin-left:-75px !important;
  }
}

  #footer{
    background-color: #000 !important;
  }

  .footer .footer-infor ul li a,   .footer .footer-infor ul li {
    color:#fff !important;
  }

  .footer-menu-list li,  .footer-menu-list li a, .footer-heading h6 .footer-heading-desktop h6 {
    color:#fff !important;
  }


  .footer-heading h6, .footer-menu_item, .filter-option-inner {
    color:#fff !important;
  }

  .dropdown.bootstrap-select.image-select.style-default > button::after {
    border: 0;
    position: absolute;
    right: 0;
    content: "\e904";
    font-family: "icomoon";
    font-size: 6px;
    color: #fff !important;
    margin: -3px 0 0 0;
  }.btn-line {
    padding: 0;
    padding-bottom: 7px;
    color: #fff !important;
    position: relative;
  }
  .btn-line .icon {
    margin-inline-start: 8px;
    display: inline-block;
    font-size: 8px;
  }
                .menu-heading{
                    cursor: pointer !important;
                }
                .header-bg{
                    position: fixed !important;
                }
				.card-product-wrapper img{
					max-height: 312px !important;
			object-fit: contain !important;
				}
				.tf-product-media-main .item img
				{
					max-height: 600px !important;
					object-fit: contain !important;
				}
                
            </style>
            <!--Adeel css-->
			<?php
	if(isset($max_price) && $max_price)
	{
		?>
		<style>
       

        .widget-price {
            margin-top: 24px;
            margin-bottom: 35px;
        }

        .filter-price .tow-bar-block {
            position: relative;
            background: #ddd;
            height: 3px;
            border-radius: 3px;
            margin-bottom: 10px;
        }

        .filter-price .progress-price {
            position: absolute;
            height: 3px;
            background: red;
            left: 0;
            right: 0;
            z-index: 1;
        }

        .filter-price .range-input {
            position: relative;
            z-index: 2;
        }

        .filter-price .range-input input {
            -webkit-appearance: none;
            width: 100%;
            position: absolute;
            pointer-events: all; 
            background: transparent; 
        }

        .filter-price .range-input input[type="range"] {
            height: 3px; 
            background: transparent; 
            z-index: 2;
            margin-top: -19px;
    margin-left: 0;
        }
        .filter-price .range-input input[type="range"]::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: red; 
            cursor: pointer;
            z-index: 3; 
        }

        .filter-price .range-input input[type="range"]::-moz-range-thumb {
            width: 15px;
            height: 15px;
            border-radius: 50%;
            background: red; 
            cursor: pointer;
            z-index: 3;
        }
        .filter-price .range-input input[type="range"]::-webkit-slider-runnable-track {
            height: 3px;
            background: transparent; 
        }

        .filter-price .range-input input[type="range"]::-moz-range-track {
            height: 3px; 
            background: transparent; 
        }
    </style>
		<?php
	}
?>
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
.product-img{
		height: 300px !important;
	}

.tf-sw-collection {
    .swiper-slide {
        img {
            height: 300px !important;
	    object-fit: contain !important; 
        }
    }
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
                        <li><a  target="_blank" href="https://www.facebook.com/MolakoPeshawar?mibextid=ZbWKwL" class="box-icon w_28 round social-facebook bg_line"><img src="<?= live_img_url().$assets_img_dir ?>facebook_icon.png" /></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/molako_peshawar?igsh=c3R2eTY1bDlxcWhs" class="box-icon w_28 round social-instagram bg_line"><img src="<?= live_img_url().$assets_img_dir ?>instagram_icon.png" /></a></li>
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
        <header id="header" class="header-default header-absolute gap-15">
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
                    <div class="col-xl-2 col-lg-4 col-md-4 col-6">
                        <a href="<?php echo base_url();?>" class="logo-header">
                            <img src="<?php echo site_url($assets_img_dir.'logo/logo44.webp') ?>" alt="logo" class="logo">
                        </a>
                    </div>
                    <!-- Navigation -->
                    <div class="col-xl-9 col-lg-4 tf-md-hidden">
                        <nav class="box-navigation text-center">
                            <ul class="box-nav-ul d-flex align-items-center justify-content-start gap-15">
                            <?php 
                            $path = 'desk_nav.html';
                            if(!isMobile())
                        {
                            include FCPATH . '/cache/'.$path;
                            }                            ?>

                            </ul>
                        </nav>
                    </div>
                    <div class="col-xl-1 col-lg-4 col-md-4 col-3">
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
                                    <span class="count-box" ><?= count($_SESSION['cart']) ?></span> 
                                    <?php
                                    }
                                    else
                                        {

                                    ?>
                                    <span class="count-box" style="display: none;"></span> 
                                    <?php
                                    }

                                    ?>
                                </a>
                            </li>
                        </ul>
                    </div>

                    <!-- mobile nav -->
                    <!-- Icons -->
            
                </div>
            </div>
                <!-- mobile menu -->
    <div class="offcanvas offcanvas-start canvas-mb" id="mobileMenu">
        <span class="icon-close icon-close-popup" data-bs-dismiss="offcanvas" aria-label="Close"></span>
        <div class="mb-canvas-content">
            <div class="mb-body">
                <ul class="nav-ul-mb" id="wrapper-menu-navigation">
                <?php 
                        if(isMobile())
                        {

                            $path = 'mbl_nav.html';
                            include FCPATH . '/cache/'.$path;
                        }

                            ?>

                </ul>
            </div>
        </div>       
    </div>
    <!-- /mobile menu -->
        </header>
        <!-- /Header -->
</div>
<!-- The Modal -->

