<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<?php $product_img_dir = 'images/products/'; ?>

<!-- Main Slider Area -->
<div class="main-slider-area">
    <!-- Main Slider -->
    <div class="main-slider">
        <div class="slider">
                <div id="mainSlider" class="nivoSlider slider-image">
                    <?php foreach ($sliders as $key => $val): ?>
                        <?php if ($val->link != ''): ?>
                            <?php
                            $url = $val->link;
                            if (strpos($val->link, 'http') === FALSE) {
                                $url = 'http://' . $val->link;
                            }
                            ?>
                            <a class="link-slide" href="<?php echo $url; ?>" <?php if ($val->new_window): ?>target="_blank"<?php endif; ?>>
                        <?php endif; ?>
                        <img src="<?php echo site_url('images/slides/' . $val->image); ?>"
                             data-thumb="<?php echo site_url('images/slides/thumbnails/' . $val->image); ?>"
                             alt="" width="300" height="300"/>
                        <?php if ($val->link != ''): ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
        </div>
    </div><!-- End Main Slider -->
</div><!-- End Main Slider Area -->
