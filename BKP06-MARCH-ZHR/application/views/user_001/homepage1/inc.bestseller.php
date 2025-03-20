<style>
    .singel-product{
/*        margin: 5px;*/
/*        border: 1px solid #2e6ed5*/
    }
</style>
<!-- Single Product -->
<div class="product-view">
    <div id="bestseller-carousel" class="owl-carousel custom-carousel">
        <?php
        if(isset($bestseller_products) && !empty($bestseller_products)){
        foreach ($bestseller_products as $val) {?>
            <div class="singel-product single-product-col">
                <!-- Single Product Image -->
                <div class="single-product-img">
                    <a href="<?php echo href_product($val) ?>">
                        <?php
                        $imgClass = '';
                        echo create_product_image_html($val , 'small' , 1,222 , 222 ,$imgClass);
                        ?>

                    </a>

                </div>
                <!-- Single Product Content -->
                
                <form method="post" id="product-data1" class="product-form-data1" action="<?php echo site_url('checkout/add-to-cart.html')?>">
                    <div class="single-product-content">
                        
                        <input type="hidden" name="item[product_id]" id="product_id" value="<?php echo $val->product_id; ?>" />

                        <h2 class="product-name"><a title="<?php echo $val->product_name; ?>" href="<?php echo href_product($val) ?>"><?php echo $val->product_name; ?></a></h2>
                        <div class="product-price">
                            <?php  if(!empty($val->varient_price) && $val->varient_price >0){?>
                                <p><?php echo format_currency($val->varient_price); ?></p>
                            <?php } else { 
                                if(!empty($val->special_price)){?>
                                <p><span><?php echo format_currency($val->sale_price); ?></span> <?php echo format_currency($val->special_price); ?></p>
                            <?php }else{?>
                                <p><?php echo format_currency($val->sale_price); ?></p>
                            <?php }}?>
                        </div>
                        <!-- Single Product Actions -->
                        <div class="product-actions">
                            <a href="<?php echo href_product($val) ?>">
                            <button class="button btn-cart"  title="Add to Cart"  type="button">
                                <i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span>
                            </button></a>
                            <div class="add-to-link">
                                <ul class="">
                                    <li class="quic-view"><button type="button" data-bs-target="#productModal-best-<?php echo $val->product_id; ?>" data-bs-toggle="modal"><i class="fa fa-search"></i>Quick view</button></li>
                                    <li class="wishlist 45"><button type="button" class="add-wishlist"><i class="fa fa-heart"></i></button></li>
                                    <!-- <li class="refresh"><a href="#"><i class="fa fa-refresh"></i></a></li> -->
                                </ul>
                            </div>
                        </div><!-- End Single Product Actions -->
                    </div><!-- End Single Product Content -->
                </form>
            </div>

        <?php } }?>
    </div>
</div>
<!-- End Single Product -->

<!-- Quickview Product -->
    <!-- Modal -->
<?php
if(isset($bestseller_products) && !empty($bestseller_products)){
    foreach ($bestseller_products as $val) {?>
        <div id="quickview-wrapper">
            <div class="modal fade productModaal" id="productModal-best-<?php echo $val->product_id; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="post" id="product-data1" class="product-form-data1" action="<?php echo site_url('checkout/add-to-cart.html')?>">
                    <div class="modal-body">
                        <input type="hidden" name="item[product_id]" id="product_id" value="<?php echo $val->product_id; ?>" />
                        <input hidden class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="item[quantity]">
                        <input type="hidden" name="item[product_cur_qty]" id="product_cur_qty"  value="<?php if($val->quantity > 0){ echo $val->quantity;}else{ echo 0; } ?>">
                        <input type="hidden" name="item[redirect]" id="redirect" value="0" />
                        <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                        <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                        <input type="hidden" name="item[reload]" value="" />
                        <div class="modal-product">
                            <div class="product-images">
                                <div class="main-image images">
                                    <a href="<?php echo href_product($val) ?>">
                                        <?php
                                        $imgClass = '';
                                        echo create_product_image_html($val , 'medium' , 1,310 , 310 ,$imgClass);
                                        ?>

                                    </a>
                                </div>
                            </div><!-- End product-images -->
                            <div class="product-info">
                                <h1><?php echo $val->product_name; ?></h1>
                                <?php if($val->quantity > 0) {?>
                                    <p class="availability in-stock" id="yesVariant">Availability: <span>In stock</span></p>
                                <?php }else{ ?>
                                    <p class="availability in-stock" id="yesVariant">Availability: <span>Out of stock</span></p>
                                <?php } ?>

                                <div class="quick-desc">
                                    <?php echo $val->short_description; ?>
                                </div>
                                <div class="price-box-modal">
                                    <?php  if(!empty($val->varient_price) && $val->varient_price >0){?>
                                        <p><?php echo format_currency($val->varient_price); ?></p>
                                    <?php } else { 
                                        if(!empty($val->special_price)){?>
                                        <p><span><?php echo format_currency($val->sale_price); ?></span> <?php echo format_currency($val->special_price); ?></p>
                                    <?php }else{?>
                                        <p><?php echo format_currency($val->sale_price); ?></p>
                                    <?php }}?>

                                </div>
                                <div class="quick-add-to-cart">
                                    <div class="product-actions">
                                        <button class="button btn-cart"  title="Add to Cart"  type="submit">
                                                <i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="social-sharing" hidden>
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social-icons">
                                            <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fa fa-facebook"></i></a></li>
                                            <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fa fa-twitter"></i></a></li>
                                            <!-- <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fa fa-pinterest"></i></a></li> -->
                                            <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- End product-info -->
                        </div><!-- End modal-product -->
                    </div><!-- End modal-body -->
                    </form>
                </div><!-- End modal-content -->
            </div><!-- End modal-dialog -->
        </div><!-- End Modal -->
        </div>
<?php } }?>
