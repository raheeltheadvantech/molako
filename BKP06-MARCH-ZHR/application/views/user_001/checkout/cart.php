<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<!-- page-title -->
<div class="tf-page-title">
    <div class="container-full">
        <div class="heading text-center">Shopping Cart</div>
    </div>
</div>
<!-- /page-title -->

<!-- page-cart -->
<section class="flat-spacing-11">
    <div class="container">
        <!-- Uncomment this section if the cart is empty -->
        <!-- 
        <div class="tf-page-cart text-center mt_140 mb_200">
            <h5 class="mb_24">Your cart is empty</h5>
            <p class="mb_24">You may check out all the available products and buy some in the shop</p>
            <a href="shop-default.html" class="tf-btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">Return to shop<i class="icon icon-arrow1-top-left"></i></a>
        </div>
        -->

        <div class="tf-page-cart-wrap">
            <div class="tf-page-cart-item">
                <form>
                    <table class="tf-table-page-cart">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            $i = 0;
                            foreach ($products as $product): 
                                $i++;
                            ?>
                            <tr class="tf-cart-item file-delete tr_<?= $product->sku ?>" id="tr_<?= $i ?>" unit_price="<?= $product->unite_price_simple; ?>" pid="<?= $product->product_id; ?>" sku="<?= $product->sku; ?>">
                                <td class="tf-cart-item_product">
                                    <a href="<?= href_product($product) ?>" class="img-box">
                                        <img src="<?= $product->images ?>" alt="Product Image" />
                                    </a>
                                    <div class="cart-info">
									
                                        <a href="<?= href_product($product) ?>"><?= $product->product_name; ?></a>
                                        <div class="cart-meta-variant"><?= $product->product_options; ?></div>
                                        <span onclick="remove_cart('<?php echo $product->product_id; ?>','<?php echo $product->product_option_value_id ?>')" class="remove-cart link remove">Remove</span>
                                    </div>
                                </td>
                                <td class="tf-cart-item_price" cart-data-title="Price">
                                    <div class="cart-price"><?= $product->unite_price; ?></div>
                                </td>
                                <td class="tf-cart-item_quantity" cart-data-title="Quantity">
                                    <div class="cart-quantity">
                                        <div class="wg-quantity">
                                            <span class="btn-quantity" onclick="update_qty('<?= $i ?>','minus','<?php echo $product->product_option_value_id ?>')">
                                                <svg class="d-inline-block" width="9" height="1" viewBox="0 0 9 1" fill="currentColor">
                                                    <path d="M9 1H5.14286H3.85714H0V0H3.85714L5.14286 0L9 0V1Z"></path>
                                                </svg>
                                            </span>
                                            <input type="text" name="number" onkeyup="update_qty('<?= $i ?>','auto','<?php echo $product->product_option_value_id ?>')" class="qty_<?= $i ?>" value="<?= $product->quantity ?>">
                                            <span class="btn-quantity" onclick="update_qty('<?= $i ?>','plus','<?php echo $product->product_option_value_id ?>')">
                                                <svg class="d-inline-block" width="9" height="9" viewBox="0 0 9 9" fill="currentColor">
                                                    <path d="M9 5.14286H5.14286V9H3.85714V5.14286H0V3.85714H3.85714V0H5.14286V3.85714H9V5.14286Z"></path>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                </td>
                                <td class="tf-cart-item_total" cart-data-title="Total">
                                    <div class="cart-total"><?= $product->total; ?></div>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!-- <div class="tf-page-cart-note">
                        <label for="cart-note">Add Order Note</label>
                        <textarea name="note" id="cart-note" value="" placeholder="How can we help you?"></textarea>
                    </div> -->
                </form>
            </div>

            <div class="tf-page-cart-footer">
                <div class="tf-cart-footer-inner">
                    <div class="tf-page-cart-checkout">
                        <div style="margin: 5px 0">
                            <?php if ($this->coupon_code && $products): ?>
                            <div class="row">
                                <fieldset>
                                    <input type="text" name="coupon_code" id="coupon_code" class="form-control" placeholder="Coupon Code">
                                </fieldset>
                                <div>
                                    <button type="button" class="couponBtn tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Apply coupon</button>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>

                        <div id="tot">
                            <div class="tf-cart-totals-discounts">
                                <h3>Subtotal</h3>
                                <span class="stotal-value"><?= $sub_total; ?></span>
                            </div>

                            <?php if($this->user_session->userdata('coupon')): ?>
                            <div class="tf-cart-totals-discounts">
                                <h3><i class="icon icon-delete text-danger remveCoupon" style="cursor: pointer;"></i> Discount (coupon code)</h3>
                                <span class="coupon-value"><?= $discount; ?></span>
                            </div>
                            <div class="tf-cart-totals-discounts">
                                <h3>Grand Total</h3>
                                <span class="total-value"><?= $grand_total; ?></span>
                            </div>
                            <?php endif; ?>
                        </div>

                        <p class="tf-cart-tax">
                            Taxes and <a href="<?php echo base_url('pages/shipping.html')?>">shipping</a> calculated at checkout
                        </p>

                        <div class="cart-checkout-btn">
                            <form method="get" action="<?= base_url('guest/checkout.html') ?>">
                                <!-- <input type="hidden" name="note" value="add value o btn click"/> -->
										<?php
								if($this->auth_user->is_logged_in())
								{
									//Go direct to checkout
									?>
									<button class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center">
										<span>Check out</span>
									</button>
									
									<?php
								}
								else
								{
									?>
									<button type="button" href="#login" data-bs-toggle="modal" class="tf-btn w-100 btn-fill animate-hover-btn radius-3 justify-content-center">
                                    <span>Check out</span>
                                </button>
									<?php
								}
								?>
                            </form>
                        </div>

						<div class="tf-page-cart_imgtrust">
                                    <p class="text-center fw-6">Guarantee Safe Checkout</p>
                                    <div class="tf-payment">

                                        <img src="<?php echo site_url($assets_img_dir.'payments/bank.jpg') ?>" style="height: 32px; width: 30%;" alt="">

                                        <img src="<?php echo site_url($assets_img_dir.'payments/Jazz.jpg') ?>" style="height: 32px; width: 30%;" alt="">

                                        <img src="<?php echo site_url($assets_img_dir.'payments/easypaisa.jpg') ?>" style="height: 32px; width: 30%;" alt="">

                                    </div>
                                    </div>
                                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
