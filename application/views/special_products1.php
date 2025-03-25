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
    </div>
