<div class="container">
                <div class="flat-title">
                    <span class="title">Deals</span>
                </div>
                <div class="hover-sw-nav hover-sw-2">
                    <div class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            <?php if (isset($new_arrival_products) && !empty($new_arrival_products)): ?>
                                    <?php foreach ($new_arrival_products as $val): ?>
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