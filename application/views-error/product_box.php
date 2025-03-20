<?php
// var_dump($product);
// die();
?>
<!-- card product -->
<div class="card-product">
                            <div class="card-product-wrapper">
                                <a href="<?php echo href_product($product) ?>
                                " class="product-img">
                                    <?php
                                    $img = '';
                                    if(isset($product->img))
                                    {
                                        $img = $product->img;
                                    }
                                    elseif(isset($product->images[0]))
                                    {
                                        $img = $product->images[0];
                                    }
                                    ?>
                                    <img class="lazyload img-product" data-src="<?= base_url('images/products/medium/'.$img) ?>" src="<?= base_url('images/products/medium/'.$img) ?>" alt="image-product">
                                    <img class="lazyload img-hover" data-src="<?= base_url('images/products/medium/'.$img) ?>" src="<?= base_url('images/products/medium/'.$img) ?>" alt="image-product">
                                </a>
                                <div class="list-product-btn">
                                <a href="#quick_add_<?php echo $product->product_id ?>" onclick="quick_add('<?php echo $product->product_id ?>','1')" class="box-icon bg_white quick-add tf-btn-loading">
                                    <span class="icon icon-bag"></span>
                                    <span class="tooltip">Quick Add</span>
                                </a>
                                <?php
                                if(isset($wishlist))
                                {
                                    ?>
                                    <a href="#wishlist_<?php echo $product->product_id ?>" onclick="wishlist('<?php echo $product->product_id ?>',1)" class="box-icon bg_white wishlist btn-icon-action">
                                    <span class="icon icon-delete"></span>
                                    <span class="tooltip">Remove from  Wishlist</span>
                                    <span class="icon icon-delete"></span>
                                </a>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <a href="#wishlist_<?php echo $product->product_id ?>" onclick="wishlist('<?php echo $product->product_id ?>')" class="box-icon bg_white wishlist btn-icon-action">
                                    <span class="icon icon-heart"></span>
                                    <span class="tooltip">Add to Wishlist</span>
                                    <span class="icon icon-delete"></span>
                                </a>

                                    <?php

                                }


                                ?>
                                <a onclick="quick_view('<?php echo $product->product_id ?>')"  class="box-icon bg_white quickview tf-btn-loading">
                                    <span class="icon icon-view"></span>
                                    <span class="tooltip">Quick View</span>
                                </a>
                            </div>
                            </div>
                            <div class="card-product-info">
                                <a href="<?php echo href_product($product) ?>" class="title link"><?= $product->product_name ?></a>
                                <ul>
                                <?php
                                $val = $product;

                                ?>
                                <?php  if(!empty($val->varient_price) && $val->varient_price >0){?>
                                    <p><?php echo format_currency($val->varient_price); ?></p>
                                <?php } else { 
                                    if(!empty($val->special_price)){?>
                                    <p><span class="cut_price"><?php echo format_currency($val->sale_price); ?></span> <?php echo format_currency($val->special_price); ?></p>
                                <?php }else{?>
                                    <p><?php echo format_currency($val->sale_price); ?></p>
                                <?php }}?>
                                </ul>
                            </div>
                        </div>