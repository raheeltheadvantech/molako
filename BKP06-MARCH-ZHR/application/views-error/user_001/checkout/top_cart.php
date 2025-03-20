<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="header-actions">
    <div class="header-cart">
        <a class="cart" href="javascript:void(0)">
            <i class="fa fa-shopping-cart"></i>
            <span class="my-cart">Cart</span> - <?php echo $total_items; ?> items
        </a>
        <?php if(isset($products) && !empty($products)): ?>

        <?php
            echo ''

            ?>

        <div class="header-cart-dropdown">
            <div class="dropdown-cart-items">

                <?php foreach ($products as $product_id => $product): ?>
                <form action="<?php echo site_url('checkout/remove-cart.html')?>" method="post" enctype="multipart/form-data">
                <input type="hidden" name="item[product_id]" value="<?php echo $product->product_id; ?>" />
                <div class="cart-item">
                    <div class="cart-img">
                        <a href="<?php echo href_product($product)?>">
                            <?php
                            if(!empty($product->images)) {
                                $imgClass = '';
                                echo create_product_image_html($product, 'thumbnails', 1, 50, 66 , $imgClass);
                            }
                            else{
                                echo create_product_image_html('', 'thumbnails', 1, 50 ,50 ,'');
                            }
                            ?>
                        </a>
                    </div>
                    <div class="cart-content">
                        <h5 class="title"><a  href="<?php echo href_product($product)?>"><?php echo $product->product_name; ?></a></h5>
                        <p><?php echo $product->product_options; ?></p>
                        <p><?php echo $product->quantity ?> x <span><?php echo $product->unite_price; ?></span></p>
                    </div>
                    <div class="cart-action">
                        <button type="submit" style="background: transparent;border: none;"><i class="fa fa-times"></i></button>
                        <!-- <a href=""><i class="fa fa-times"></i></a> -->
                    </div>
                </div>
                </form>
                <?php endforeach; ?>
            </div>

            <div class="cart-total-btn">
                <div class="cart-subtotal">
                    <p>Tax: <span><?php echo $tax; ?></span></p>
                </div>

            </div>

            <div class="cart-total-btn">
                <div class="cart-subtotal">
                    <p>Subtotal: <span><?php echo $sub_total; ?></span></p>
                </div>
                <div class="cart-btn">
                    <a href="<?php echo site_url('checkout/cart.html') ?>"><button type="button" class="btn">View Cart</button></a>
                </div>

            </div>
            <div class="cart-total-btn">
                <div class="cart-subtotal">
                    <p>Total Price: <span><?php echo $total_price; ?></span></p>
                </div>
                <div class="cart-btn">
                    <a href="<?php echo site_url('checkout/shipping.html') ?>"><button type="button" class="btn">checkout</button></a>
                </div>
            </div>
        </div>
        <?php else: ?>

            <div class="header-cart-dropdown">
                <div class="dropdown-cart-items">
                    <p class="text-center cart-empty">Your shopping cart is empty!</p>
                </div>

            </div>

        <?php endif; ?>

    </div>
</div>

<script>
    // Cart add remove functions
    var minCart = {
        'remove': function(key) {
            $.ajax({
                url: 'checkout/remove-cart.html?q=top-cart',
                type: 'post',
                data: 'key=' + key,
                dataType: 'json',
                beforeSend: function() {
                    $('.alert, .text-danger').remove();
                    $('#cart > button').button('loading');
                },
                complete: function() {
                    $('#cart > button').button('reset');
                },
                success: function(json) {
                    if (json['redirect']) {
                        location = json['redirect'];
                        return false;
                    }
                    if(json['result'] == true){
                        $('#cart').empty().append(json['cart']);
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    }

</script>
