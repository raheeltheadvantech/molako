<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<?php $product_img_dir = 'images/products/'; ?>

<!-- Main Slider Area -->
<div class="">

<div class="tf-slideshow slider-effect-fade position-relative">
    <div class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false" data-space="0" data-loop="true" data-auto-play="false" data-delay="0" data-speed="1000">
        <div class="swiper-wrapper">
            <?php if (!empty($sliders)) : ?>
                <?php foreach ($sliders as $key => $val) : ?>
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="<?php echo site_url('images/slides/large/' . $val->image); ?>" alt="slider-image">
                            <div class="box-content">
                                <div class="container">
                                    <!-- <p class="fade-item fade-item-2">
                                    </p> -->
                                    <?php if (!empty($val->link)) : ?>
                                        <?php
                                        $url = $val->link;
                                        if (strpos($val->link, 'http') === false) {
                                            $url = 'http://' . $val->link;
                                        }
                                        ?>
                                        <a href="<?php echo $url; ?>" class="fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"<?php if ($val->new_window) echo ' target="_blank"'; ?>>
                                            <span>Shop collection</span><i class="icon icon-arrow-right"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="wrap-pagination">
        <div class="container">
            <div class="sw-dots sw-pagination-slider justify-content-center">
        
            </div>
            </div>
    </div>
</div>
<!-- /Slider -->
</div>
