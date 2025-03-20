                <div class="col-lg-4">
                    <div class="menu-heading">Best seller</div>
                    <div class="hover-sw-nav hover-sw-2">
                        <div class="swiper tf-product-header wrap-sw-over">
                            <div class="swiper-wrapper">
                                <?php if (isset($bestseller_products) && !empty($bestseller_products)): ?>
                                    <?php foreach ($bestseller_products as $val): ?>
                                        <div class="swiper-slide" lazy="true">
                                        <?php
                    // $product =   $val;
                            $this->load->view('product_box',array('product'=>$val));
                            ?>
                                        </div>

                                        <!-- Quick Add Modal -->
                                        <div class="modal fade" id="quick_add_<?php echo $val->product_id; ?>" tabindex="-1" aria-labelledby="quickAddModalLabel_<?php echo $val->product_id; ?>" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="quickAddModalLabel_<?php echo $val->product_id; ?>">Quick Add: <?php echo $val->product_name; ?></h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form method="post" action="<?php echo site_url('checkout/add-to-cart.html'); ?>">
                                                            <input type="hidden" name="product_id" value="<?php echo $val->product_id; ?>">
                                                            <p>Price: <?php echo format_currency($val->sale_price); ?></p>
                                                            <!-- Add quantity and size options if needed -->
                                                            <button type="submit" class="btn btn-primary">Add to Cart</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End of Quick Add Modal -->
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <p>No best seller products available.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="nav-sw nav-next-slider nav-next-product-header box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                        <div class="nav-sw nav-prev-slider nav-prev-product-header box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                    </div>
                </div>