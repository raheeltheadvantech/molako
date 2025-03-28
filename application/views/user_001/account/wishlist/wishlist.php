<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<?php $product_img_dir = 'images/products/'; ?>

        <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">Your wishlist</div>
            </div>
        </div>
        <!-- /page-title -->
       
        <!-- Section Product -->
        <section class="flat-spacing-2">
            <div class="row">
                <?php if (isset($wish_list_items) && !empty($wish_list_items)): ?>
                <?php foreach ($wish_list_items as $val): ?>
                    <div class="col-md-4">
                    <?php
                    // $product =   $val;
                            $this->load->view('product_box',array('product'=>$val,'wishlist'=>1));
                            ?>
                        </div>

                <?php endforeach; ?>
            <?php endif; ?>
            </div>
        </section>
        <!-- /Section Product -->
