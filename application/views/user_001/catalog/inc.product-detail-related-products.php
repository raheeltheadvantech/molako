 <!-- recent -->
 <section class="flat-spacing-4 pt_0">
            <div class="container">
                <div class="flat-title">
                    <span class="title">Related Product</span>
                </div>
                <div class="hover-sw-nav hover-sw-2">
                    <div class="swiper tf-sw-recent wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                        <div class="swiper-wrapper">
                            <?php if (isset($related_products) && !empty($related_products)): ?>
                                    <?php foreach ($related_products as $val): ?>
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