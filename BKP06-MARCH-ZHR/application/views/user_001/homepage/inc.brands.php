<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<?php $product_img_dir = 'images/products/'; ?>


<!-- Categories -->
        <section class="flat-spacing-4 flat-categorie">
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
        </section>
        <!-- /Categories -->