<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<?php $product_img_dir = 'images/products/'; ?>
<div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="header">
                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>
                </div>
                <div class="wrap">
                    <div class="tf-product-media-wrap">
                        <div class="swiper tf-single-slide">
                            <div class="swiper-wrapper" >
                                <div class="swiper-slide">
                                    <div class="item">
                                        <img src="<?php echo $img; ?>" width="720" height="1005" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-product-info-list">
                            <div class="tf-product-info-title">
                                <h5><?php echo $detail->product_name; ?></h5>
                            </div>
                            <div class="tf-product-info-badges">
                                <?php if($detail->quantity > 0) { ?>
                                    <div class="product-status-content"> 
                                        <i class="icon-lightning"></i>
                                        <p class="fw-6"> Only <span class="det_qty"><?php echo $detail->quantity; ?></span> items left! Hurry up and grab yours before they're gone!</p>
                                    </div>
                                <?php } elseif(!$config_catalog_purchase) { ?>
                                    <div class="alert alert-danger" role="alert">This item is out of stock!</div>
                                <?php } ?>
                            </div>
                            <?php  
                            $val = $detail;
                            $price = $val->sale_price;
                                if(!empty($val->varient_price) && $val->varient_price >0){?>
                                    <p><?php $price = $val->varient_price; ?></p>
                                <?php } else { 
                                    if(!empty($val->special_price)){
                                        $price = $val->special_price;
                                        ?>
                                        
                                <?php }}?> 
                            <div class="tf-product-info-price">
							
                                <div class="price"> <?= format_currency($price); ?></div>
                            </div>
                            <div class="tf-product-description">
                                <p><?= $detail->short_description ?></p>
                            </div>
                            <div class="tf-product-info-quantity">
                                <div class="quantity-title fw-6">Quantity</div>
                                <div class="wg-quantity">
                                    <span class="btn-quantity minus-btn" onclick="
                                    var qty_el = document.getElementById('pop_<?= $detail->product_id ?>'); var qty = qty_el.value; if( !isNaN(qty) ) qty--; if(qty){document.getElementById('pop_<?= $detail->product_id ?>').value=qty}return false;">-</span>
                                    <input type="text" name="number" value="1" id="pop_<?= $detail->product_id ?>">
                                    <span class="btn-quantity plus-btn" onclick="var qty_el = document.getElementById('pop_<?= $detail->product_id ?>'); var qty = qty_el.value; if( !isNaN(qty) ) qty++; document.getElementById('pop_<?= $detail->product_id ?>').value=qty;return false;">+</span>
                                </div>
                            </div>
                            <div class="tf-product-info-buy-button">
                                <form class="">
                                    <a href="#" onclick="var qty_el = document.getElementById('pop_<?= $detail->product_id ?>'); var qty = qty_el.value;quick_add('<?php echo $detail->product_id; ?>',qty,'<?= $detail->varient_id; ?>')" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1 animate-hover-btn "><span>Add to cart -&nbsp;</span><span class="tf-qty-price"><?= format_currency($price); ?></span></a>
                                    <a href="javascript:void(0);" onclick="wishlist('<?= $detail->product_id ?>')" class="tf-product-btn-wishlist hover-tooltip box-icon bg_white wishlist btn-icon-action">
                                        <span class="icon icon-heart"></span>
                                        <span class="tooltip">Add to Wishlist</span>
                                        <span class="icon icon-delete"></span>
                                    </a>
                                    <div class="w-100" hidden>
                                        <a href="#" onclick="quick_add('<?= $detail->product_id ?>',1,'<?= (isset($detail->varient_id)?$detail->varient_id:0) ?>')" class="btns-full">Buy Now <img src="images/payments/paypal.png" alt=""></a>
                                        <!-- <a href="#" class="payment-more-option">More payment options</a> -->
                                    </div>
                                </form>
                            </div>
                            <div>
                                <a href="<?php echo href_product($detail) ?>" class="tf-btn fw-6 btn-line">View full details<i class="icon icon-arrow1-top-left"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>