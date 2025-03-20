<!-- Single Product -->
<div id="related-products-carousel" class="owl-carousel custom-carousel">
<?php
if(isset($related_products) && !empty($related_products)){
    foreach ($related_products as $val) {?>
        <div class="singel-product single-product-col">
<!--            <div class="label-pro-new">New</div>-->
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
            <div class="single-product-content">
                <h2 class="product-name"><a title="Proin lectus ipsum" href="<?php echo href_product($val) ?>"><?php echo $val->product_name; ?></a></h2>
<!--                <div class="ratings">-->
<!--                    <div class="rating-box">-->
<!--                        <div class="rating">-->
<!--                            <i class="fa fa-star"></i>-->
<!--                            <i class="fa fa-star"></i>-->
<!--                            <i class="fa fa-star"></i>-->
<!--                            <i class="fa fa-star"></i>-->
<!--                            <i class="fa fa-star"></i>-->
<!--                        </div>-->
<!--                    </div>-->
<!--                </div>-->
                <div class="product-price">
                    <?php  if(!empty($val->varient_price) && $val->varient_price >0){?>
                        <p><?php echo '$ '.$val->varient_price; ?></p>
                    <?php } else { if(!empty($val->special_price)){?>
                        <p><span><?php echo '$ '.$val->sale_price; ?></span> <?php echo '$ '.$val->special_price; ?></p>
                    <?php }else{?>
                        <p><?php echo '$ '.$val->sale_price; ?></p>
                    <?php } }?>
                </div>
                <!-- Single Product Actions -->
                <div class="product-actions">
                    <button class="button btn-cart"  title="Add to Cart" data-is_variation="<?php echo $val->is_variation; ?>" onclick="cart.add(<?php echo $val->product_id; ?>,1,<?php echo isset($val->quantity) ? $val->quantity : 0; ?>,this)" type="button"><i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span></button>
                                    <div class="add-to-link">
                                        <ul class="">
                                            <li class="quic-view"><button type="button" data-bs-target="#productModal-rel-<?php echo $val->product_id; ?>" data-bs-toggle="modal"><i class="fa fa-search"></i>Quick view</button></li>
                                            <li class="wishlist" ><a href="#" onclick="wishlist.add(<?php echo $val->product_id; ?>)"><i class="fa fa-heart"></i></a></li>
                                        </ul>
                                    </div>
                </div><!-- End Single Product Actions -->
            </div><!-- End Single Product Content -->
        </div>

    <?php } }?>
</div>
<!-- End Single Product -->

<?php
if(isset($related_products) && !empty($related_products)){
    foreach ($related_products as $val) {?>
        <div id="quickview-wrapper">
            <div class="modal fade productModaal" id="productModal-rel-<?php echo $val->product_id; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
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
                                    <!--                            <div class="ratings">-->
                                    <!--                                <div class="rating-box">-->
                                    <!--                                    <div class="rating">-->
                                    <!--                                        <i class="fa fa-star"></i>-->
                                    <!--                                        <i class="fa fa-star"></i>-->
                                    <!--                                        <i class="fa fa-star"></i>-->
                                    <!--                                        <i class="fa fa-star"></i>-->
                                    <!--                                        <i class="fa fa-star"></i>-->
                                    <!--                                    </div>-->
                                    <!--                                </div>-->
                                    <!--                            </div>-->
                                    <!--                            <p class="rating-links">-->
                                    <!--                                <a href="#">1 Review(s)</a>-->
                                    <!--                                <span class="separator">|</span>-->
                                    <!--                                <a href="#" class="add-to-review">Add Your Review</a>-->
                                    <!--                            </p>-->
                                    <?php if($val->quantity > 0) {?>
                                        <p class="availability in-stock" id="yesVariant">Availability: <span>In stock</span></p>
                                    <?php }else{ ?>
                                        <p class="availability in-stock" id="yesVariant">Availability: <span>Out of stock</span></p>
                                    <?php } ?>

                                    <div class="quick-desc">
                                        <?php echo $val->short_description; ?>
                                    </div>
                                    <div class="price-box">
                                        <?php  if(!empty($val->varient_price) && $val->varient_price >0){?>
                                            <p><?php echo '$ '.$val->varient_price; ?></p>
                                        <?php } else { if(!empty($val->special_price)){?>
                                            <p><span><?php echo '$ '.$val->sale_price; ?></span> <?php echo '$ '.$val->special_price; ?></p>
                                        <?php }else{?>
                                            <p><?php echo '$ '.$val->sale_price; ?></p>
                                        <?php } }?>
                                    </div>
                                    <div class="quick-add-to-cart">
                                        <form method="post" class="cart">
                                            <div class="product-actions">
                                                <button class="button btn-cart" title="Add to Cart" data-is_variation="<?php echo $val->is_variation; ?>" onclick="cart.add(<?php echo $val->product_id; ?>,1,<?php echo isset($val->quantity) ? $val->quantity : 0; ?>,this)" type="button"><i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span></button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="social-sharing">
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
                    </div><!-- End modal-content -->
                </div><!-- End modal-dialog -->
            </div><!-- End Modal -->
        </div>
    <?php } }?>
