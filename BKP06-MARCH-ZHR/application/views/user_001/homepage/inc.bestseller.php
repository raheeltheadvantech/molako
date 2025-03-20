<section class="flat-spacing-5 pt_0 flat-seller">
    <div class="container">
        <div class="flat-title">
            <span class="title wow fadeInUp" data-wow-delay="0s">Best Selling Products</span>
            <p class="sub-title wow fadeInUp" data-wow-delay="0s">Shop the Latest Styles: Stay ahead of the curve with our newest arrivals</p>
        </div>
        <div class="grid-layout loadmore-item wow fadeInUp" data-wow-delay="0s" data-grid="grid-4">
            <?php if (isset($bestseller_products) && !empty($bestseller_products)): ?>
                <?php foreach ($bestseller_products as $val): ?>
                    <?php
                    // $product =   $val;
                            $this->load->view('product_box',array('product'=>$val));
                            ?>

                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</section>
