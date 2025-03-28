<style>
.sale-tag {
    position: absolute;
    top: 0px;
    left: 61%;
    z-index: 1;
    width: 144px;
    aspect-ratio: 1;
    clip-path: polygon(0 0,100% 100%,100% 0);
    background-color: red;
}
.sale-tag span {
    position: relative;
    z-index: 1111111111111111111111111111111111;
    font-size: 2.6vh;
    font-weight: bold;
    top: 50px;
    left: 36px;
    color: #fff;
    display: block;
    transform: rotate(45deg);
    width: 120px;
}

@media screen and (max-width: 575px) {

  .sale-tag{
		position: absolute;
		top: 0px;
		left: 47%;
		z-index: 1;
		width: 100px;
		aspect-ratio: 1;
		clip-path: polygon(0 0, 100% 60%, 100% 0);
		background-color: red;
	}		
	.sale-tag span{
		position: relative;
		z-index: 1111111111111111111111111111111111;
		font-size: 1.4vh;
		font-weight: bold;
		top: 29px;
		left: 33px;
		color: #fff;
		display: block;
		transform: rotate(31deg);
		width: 120px;
	}
}

</style>
<?php 
$assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/';
$assets_box_dir = '/images/';
 ?>
<?php $product_img_dir = 'images/products/'; ?>
<!-- Slider -->
<?php include('inc.slider.php') ?>
    
<!-- /Slider -->

<div id="wrapper">
<!-- Marquee -->
        <div class="tf-marquee bg_yellow-2">
            <div class="wrap-marquee">
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
                <div class="marquee-item">
                    <div class="icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="" width="15" height="20" viewBox="0 0 15 20"><path d="M14.5833 8H8.61742L9.94318 0L0 12H5.96591L4.64015 20L14.5833 8"></path></svg>
                    </div>
                    <p class="text"><?php echo $this->site_config->item('config_bottom_bar_content'); ?></p>
                </div>
            </div>
                      
        </div>
        <!-- /Marquee -->
         <!-- Main cate Area -->
         <div class="brands-section">
            <?php echo get_brands_html(); ?>
        </div>
        <!-- Seller -->
        <?php include('inc.bestseller.php') ?>
<div class="brands-section">
            <?php echo get_brands_html1(); ?>
        </div>
        <!-- /Seller -->
        <!-- product -->
        <section class="flat-spacing-1 pt_0" id="special_products">
            Loading ...
        </section>
        <!-- /product -->
        <!-- recent -->
        <section class="flat-spacing-4 pt_0" style="padding-bottom:0px;">
            <div class="container">
                <div class="flat-title">
                    <span class="title">New Arrivals</span>
                </div>
                <div class="hover-sw-nav hover-sw-2">
                    <div class="swiper tf-sw-recent wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                        <div class="swiper-wrapper">
                            <?php if (isset($new_arrival_products) && !empty($new_arrival_products)): ?>
                                    <?php foreach ($new_arrival_products as $val): ?>
                                        <div class="swiper-slide" lazy="true">
                                        <?php
                    // $product =   $val;
                            $this->load->view('product_box',array('product'=>$val));
                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-recent box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-recent box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-recent justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /recent -->
        <!-- Lookbook -->
        <section class="flat-spacing-6">
            <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                <span class="title">Shop the look</span>
                <p class="sub-title">Inspire and let yourself be inspired, from one unique fashion to another.</p>
            </div>
            <div class="swiper tf-sw-lookbook" data-preview="2" data-tablet="2" data-mobile="1" data-space-lg="0" data-space-md="0">
                <div class="swiper-wrapper">
                    <div class="swiper-slide" lazy="true">
                        <div class="wrap-lookbook lookbook-1">
                            <div class="image">
                                <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'shop/file/look5.jpg') ?>" src="<?php echo site_url($assets_img_dir.'shop/file/look5.jpg') ?>" alt="image-lookbook">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" lazy="true">
                        <div class="wrap-lookbook lookbook-2">
                            <div class="image">
                                <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'shop/file/look6.jpg') ?>" src="<?php echo site_url($assets_img_dir.'shop/file/look6.jpg') ?>" alt="image-lookbook">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wrap-pagination">
                    <div class="container-full">
                        <div class="sw-dots sw-pagination-lookbook justify-content-center"></div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /Lookbook -->
        <!-- Testimonial -->
       <section class="flat-spacing-5 pt_0 flat-testimonial">
            <div class="container">
                <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                    <span class="title">Happy Clients</span>
                    <p class="sub-title">Hear what they say about us</p>
                </div>
                <div class="wrap-carousel">
                    <div class="swiper tf-sw-testimonial" data-preview="3" data-tablet="2" data-mobile="1" data-space-lg="30" data-space-md="15">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="testimonial-item style-column wow fadeInUp" data-wow-delay="0s">
                                    <div class="rating">
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                    </div>
                                    <div class="heading">Best Online Fashion Site</div>
                                    <div class="text">
                                        “ I always find something stylish and affordable on this web fashion site ”
                                    </div>
                                    <div class="author">
                                        <div class="name">Tayyaba Zaidi</div>
                                        <div class="metas">Customer from Lahore</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-item style-column wow fadeInUp" data-wow-delay=".1s">
                                    <div class="rating">
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                    </div>
                                    <div class="heading">Great Selection and Quality</div>
                                    <div class="text">
                                        "I love the variety of styles and the high-quality clothing on this web fashion site."
                                    </div>
                                    <div class="author">
                                        <div class="name">Rida Shakeel</div>
                                        <div class="metas">Customer from Islamabad</span></div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-item style-column wow fadeInUp" data-wow-delay=".2s">
                                    <div class="rating">
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                    </div>
                                    <div class="heading">Best Customer Service</div>
                                    <div class="text">
                                        "I finally found a web fashion site with stylish and flattering options in my size."
                                    </div>
                                    <div class="author">
                                        <div class="name">Saba Naik</div>
                                        <div class="metas">Customer from Karachi</div>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="testimonial-item style-column wow fadeInUp" data-wow-delay=".3s">
                                    <div class="rating">
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                        <i class="icon-start"></i>
                                    </div>
                                    <div class="heading">Great Selection and Quality</div>
                                    <div class="text">
                                        "I love the variety of styles and the high-quality clothing on this web fashion site."
                                    </div>
                                    <div class="author">
                                        <div class="name">Hareem Fatima</div>
                                        <div class="metas">Customer from Peshawar</span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-testimonial lg"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-testimonial lg"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-testimonial justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Testimonial -->
        <!-- brand -->
        <!-- Main cate Area -->
        
        <!-- /brand -->
        <!-- Shop Gram -->
        <!-- /Shop Gram -->
        <!-- Icon box -->
        <section class="flat-spacing-7 flat-iconbox wow fadeInUp" data-wow-delay="0s">
            <div class="container">
                <div class="wrap-carousel wrap-mobile">
                    <div class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                        <div class="swiper-wrapper wrap-iconbox">
                            <?php
                            if($boxes)
                            {
                                foreach($boxes as $k=> $v)
                                {
                                    ?>
                                <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <?php
                                        if($v->image)
                                        {
                                            ?>
                                            <img width="25" height="25" src="<?php echo base_url().$assets_box_dir; ?>boxes/file/<?php echo $v->image; ?>" />

                                            <?php
                                        }

                                        ?>
                                    </div>
                                    <div class="content">
                                        <div class="title"><?php echo $v->title ?></div>
                                        <p><?php echo $v->detail; ?></p>
                                    </div>
                                </div>
                            </div>

                                    <?php
                                }
                            }

                            ?>
                        </div>
    
                    </div>
                    <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Icon box -->