<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<?php $product_img_dir = 'images/products/'; ?>
<style>
    .wrap-slider{
        height: auto !important;
    }
</style>

<!-- Main Slider Area -->
<div class="tf-slideshow slider-effect-fade position-relative">
    <div class="swiper tf-sw-slideshow" data-preview="1" data-tablet="1" data-mobile="1" data-centered="false" data-space="0" data-loop="true" data-auto-play="true" data-delay="5000" data-speed="1000">
        <div class="swiper-wrapper">
            <?php if (!empty($sliders)) : ?>
                <?php 
                $i = 0;
                foreach ($sliders as $key => $val) :?>
                    <?php if($i < 2 || true): 
                        $i++;

                        ?>
                    <div class="swiper-slide">
                        <div class="wrap-slider">
                            <img src="<?php echo live_img_url().'images/slides/temp/' . $val->image; ?>" alt="slider-image">
                            <div class="box-content c-box">
                                <div class="container">
                                    <?php if($val->head): ?>
                                    <h5 class="fade-item fade-item-1 text text-uppercase"><?php echo html_entity_decode($val->head); ?></h5>
                                    <?php endif ?>
                                    <?php if($val->title): ?>
                                    <h1 class="fade-item fade-item-1  fw-bold"><?php echo html_entity_decode($val->title); ?></h1>
                                <?php endif ?>
                                <?php if($val->detail): ?>
                                    <p class="fade-item fade-item-2"><?php echo html_entity_decode($val->detail); ?></p>
                                    <?php endif ?>
                                    <?php if (!empty($val->link)) : ?>
                                        <?php
                                        $url = $val->link;
                                        if (strpos($val->link, 'http') === false) {
                                            $url = 'http://' . $val->link;
                                        }
                                        ?>
                                        <a href="<?php echo $url; ?>" class="slider-btn fade-item fade-item-3 tf-btn btn-fill animate-hover-btn btn-xl radius-3"<?php if ($val->new_window) echo ' target="_blank"'; ?>>
                                            <span>Shop collection</span><i class="icon icon-arrow-right"></i>
                                        </a>
                                    <?php endif; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <?php
                endif;
                    ?> 
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
