<div class="container">
        <div class="flat-title">
            <span class="title wow fadeInUp" data-wow-delay="0s">Deals</span>
        </div>
        <div class="grid-layout loadmore-item wow fadeInUp" data-wow-delay="0s" data-grid="grid-4">
            <?php if (isset($special_products) && !empty($special_products)): ?>
                <?php foreach ($special_products as $val): ?>
                    <?php
                    // $product =   $val;
                            $this->load->view('product_box',array('product'=>$val));
                            ?>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <?php
            if($scount > 4)
            {
                ?>
                <div class="text-center mt-5">
                    <a class="text-center tf-btn style-3 radius-3 btn-fill animate-hover-btn" href="<?php echo base_url('deals.html') ?>?is_special=1">See All Deals</a>
                </div>

                <?php
            }

            ?>
    </div>
