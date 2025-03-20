<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<?php $product_img_dir = 'images/products/'; ?>
<!-- Slider -->
<?php include('inc.slider.php') ?>
?>
    
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
        <!-- End Main Cate Area -->
        <!-- Categories -->
        <!-- <section class="flat-spacing-4 flat-categorie">
                    <div class="container-full">
                    <div class="flat-title-v2">
                            <div class="box-sw-navigation">
                                <div class="nav-sw nav-next-slider nav-next-collection"><span class="icon icon-arrow-left"></span></div>
                                <div class="nav-sw nav-prev-slider nav-prev-collection"><span class="icon icon-arrow-right"></span></div>
                            </div>
                            <span class="text-3 fw-7 text-uppercase title wow fadeInUp" data-wow-delay="0s">SHOP BY CATEGORIES</span>
                    </div>
                    <div class="row">
                            <div class="col-xl-12 col-lg-12 col-md-12">
                                <div class="swiper tf-sw-collection" data-preview="3" data-tablet="2" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-loop="false" data-auto-play="false">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide" lazy="true">
                                            <div class="collection-item style-left hover-img">
                                                <div class="collection-inner">
                                                    <a href="shop-default.html" class="collection-image img-style">
                                                        <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'collections/collection-17.jpg') ?>" src="<?php echo site_url($assets_img_dir.'collections/collection-17.jpg') ?>" alt="collection-img">
                                                    </a>
                                                    <div class="collection-content">
                                                        <a href="shop-default.html" class="tf-btn collection-title hover-icon fs-15"><span>Clothing</span><i class="icon icon-arrow1-top-left"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </div>
                    
                    </div>
        </section> -->
        <!-- /Categories -->
        <!-- Seller -->
        <?php include('inc.bestseller.php') ?>
        <!-- /Seller -->
        <!-- product -->
        <section class="flat-spacing-1 pt_0">
            <div class="container">
                <div class="flat-title">
                    <span class="title">Deals</span>
                </div>
                <div class="hover-sw-nav hover-sw-2">
                    <div class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            <?php if (isset($special_products) && !empty($special_products)): ?>
                                    <?php foreach ($special_products as $val): ?>
                                        <div class="swiper-slide" lazy="true">
                                        <?php
                    // $product =   $val;
                                        // dd($val);
                            $this->load->view('product_box',array('product'=>$val));
                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /product -->
        <!-- recent -->
        <section class="flat-spacing-4 pt_0" style="padding-bottom:0px;">
            <div class="container">
                <div class="flat-title">
                    <span class="title">New Arrival</span>
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
                                <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'shop/file/look3.jpg') ?>" src="<?php echo site_url($assets_img_dir.'shop/file/look3.jpg') ?>" alt="image-lookbook">
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide" lazy="true">
                        <div class="wrap-lookbook lookbook-2">
                            <div class="image">
                                <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'shop/file/look4.jpg') ?>" src="<?php echo site_url($assets_img_dir.'shop/file/look4.jpg') ?>" alt="image-lookbook">
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
                                        <div class="name">Robert smith</div>
                                        <div class="metas">Customer from USA</div>
                                    </div>
                                    <div class="product">
                                        <div class="image">
                                            <a href="product-detail.html">
                                                <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'shop/products/img-p2.png') ?>" src="<?php echo site_url($assets_img_dir.'shop/products/img-p2.png') ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="content-wrap">
                                            <div class="product-title">
                                                <a href="product-detail.html">Jersey thong body</a>
                                            </div>
                                            <div class="price">$105.95</div>
                                        </div>
                                        <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
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
                                        <div class="name">Allen Lyn</div>
                                        <div class="metas">Customer from France</span></div>
                                    </div>
                                    <div class="product">
                                        <div class="image">
                                            <a href="product-detail.html">
                                                <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'shop/products/img-p2.png') ?>" src="<?php echo site_url($assets_img_dir.'shop/products/img-p3.png') ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="content-wrap">
                                            <div class="product-title">
                                                <a href="product-detail.html">Cotton jersey top</a>
                                            </div>
                                            <div class="price">$7.95</div>
                                        </div>
                                        <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
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
                                        <div class="name">Peter Rope</div>
                                        <div class="metas">Customer from USA</div>
                                    </div>
                                    <div class="product">
                                        <div class="image">
                                            <a href="product-detail.html">
                                                <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'shop/products/img-p4.png') ?>" src="<?php echo site_url($assets_img_dir.'shop/products/img-p4.png') ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="content-wrap">
                                            <div class="product-title">
                                                <a href="product-detail.html">Ribbed modal T-shirt</a>
                                            </div>
                                            <div class="price">From $18.95</div>
                                        </div>
                                        <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
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
                                        <div class="name">Hellen Ase</div>
                                        <div class="metas">Customer from Japan</span></div>
                                    </div>
                                    <div class="product">
                                        <div class="image">
                                            <a href="product-detail.html">
                                                <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'shop/products/img-p5.png') ?>" src="<?php echo site_url($assets_img_dir.'shop/products/img-p5.png') ?>" alt="">
                                            </a>
                                        </div>
                                        <div class="content-wrap">
                                            <div class="product-title">
                                                <a href="product-detail.html">Customer from Japan</a>
                                            </div>
                                            <div class="price">$16.95</div>
                                        </div>
                                        <a href="product-detail.html" class=""><i class="icon-arrow1-top-left"></i></a>
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
        <section class="flat-spacing-5 pt_0">
            <div class="container">
                <div class="swiper tf-sw-brand" data-loop="false" data-play="false" data-preview="6" data-tablet="3" data-mobile="2" data-space-lg="0" data-space-md="0">
                    <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="brand-item">
                                    <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'brand/brand-01.png') ?>" src="<?php echo site_url($assets_img_dir.'brand/brand-01.png') ?>" alt="image-brand">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-item">
                                    <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'brand/brand-02.png') ?>" src="<?php echo site_url($assets_img_dir.'brand/brand-02.png') ?>" alt="image-brand">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-item">
                                    <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'brand/brand-03.png') ?>" src="<?php echo site_url($assets_img_dir.'brand/brand-03.png') ?>" alt="image-brand">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-item">
                                    <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'brand/brand-04.png') ?>" src="<?php echo site_url($assets_img_dir.'brand/brand-04.png') ?>" alt="image-brand">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-item">
                                    <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'brand/brand-05.png') ?>" src="<?php echo site_url($assets_img_dir.'brand/brand-05.png') ?>" alt="image-brand">
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="brand-item">
                                    <img class="lazyload" data-src="<?php echo site_url($assets_img_dir.'brand/brand-06.png') ?>" src="<?php echo site_url($assets_img_dir.'brand/brand-06.png') ?>" alt="image-brand">
                                </div>
                            </div>
                    </div>
                </div>
                <div class="sw-dots style-2 sw-pagination-brand justify-content-center"></div>
            </div>
        </section>
        <!-- /brand -->
        <!-- Shop Gram -->
        <section class="flat-spacing-7">
            <div class="container">
                <div class="flat-title wow fadeInUp" data-wow-delay="0s">
                    <span class="title">Shop Gram</span>
                    <p class="sub-title">Inspire and let yourself be inspired, from one unique fashion to another.</p>
                </div>
                <div class="wrap-carousel wrap-shop-gram">
                    <div class="swiper tf-sw-shop-gallery" data-preview="5" data-tablet="3" data-mobile="2" data-space-lg="7" data-space-md="7">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".2s">
                                    <div class="img-style">
                                        <img class="lazyload img-hover" data-src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-7.jpg') ?>" src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-7.jpg') ?>" alt="image-gallery">
                                    </div>
                                    </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".3s">
                                    <div class="img-style">
                                        <img class="lazyload img-hover" data-src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-3.jpg') ?>" src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-3.jpg') ?>" alt="image-gallery">
                                    </div>
                                    </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".4s">
                                    <div class="img-style">
                                        <img class="lazyload img-hover" data-src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-5.jpg') ?>" src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-5.jpg') ?>" alt="image-gallery">
                                    </div>
                                    </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".5s">
                                    <div class="img-style">
                                        <img class="lazyload img-hover" data-src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-8.jpg') ?>" src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-8.jpg') ?>" alt="image-gallery">
                                    </div>
                                    </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="gallery-item hover-img wow fadeInUp" data-wow-delay=".6s">
                                    <div class="img-style">
                                        <img class="lazyload img-hover" data-src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-6.jpg') ?>" src="<?php echo site_url($assets_img_dir.'shop/gallery/gallery-6.jpg') ?>" alt="image-gallery">
                                    </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <div class="sw-dots sw-pagination-gallery justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Shop Gram -->
        <!-- Icon box -->
        <section class="flat-spacing-7 flat-iconbox wow fadeInUp" data-wow-delay="0s">
            <div class="container">
                <div class="wrap-carousel wrap-mobile">
                    <div class="swiper tf-sw-mobile" data-preview="1" data-space="15">
                        <div class="swiper-wrapper wrap-iconbox">
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-shipping"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">Free Shipping</div>
                                        <p>Free shipping over order $120</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-payment fs-22"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">Flexible Payment</div>
                                        <p>Pay with Multiple Credit Cards</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-return fs-22"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">14 Day Returns</div>
                                        <p>Within 30 days for an exchange</p>
                                    </div>
                                </div>
                            </div>
                            <div class="swiper-slide">
                                <div class="tf-icon-box style-border-line text-center">
                                    <div class="icon">
                                        <i class="icon-suport"></i>
                                    </div>
                                    <div class="content">
                                        <div class="title">Premium Support</div>
                                        <p>Outstanding premium support</p>
                                    </div>
                                </div>
                            </div>
                        </div>
    
                    </div>
                    <div class="sw-dots style-2 sw-pagination-mb justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /Icon box -->