<div class="card-product style-skincare">
                                                <div class="card-product-wrapper">
                                                    <a href="<?php echo href_product($product) ?>" class="product-img">
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
                                    $img = 'images/products/medium/'.$img;
                                    // img1
                                    $img1 = $img;
                                    if(isset($product->images[1]))
                                    {
                                        $img1 = $product->images[1];
                                    }
                                    $img1 = 'images/products/medium/'.$img1;

                                    ?>
                                                        <img class="img-product ls-is-cached lazyloaded" data-src="<?= live_img_url().'/images/image.php?width=400&height=400&image=/'.$img; ?>" src="<?= live_img_url().'/images/image.php?width=400&height=400&image=/'.$img; ?>" alt="image-product">
                                                        <img class="img-hover ls-is-cached lazyloaded" data-src="<?= live_img_url().'/images/image.php?width=400&height=400&image=/'.$img1; ?>" src="<?= live_img_url().'/images/image.php?width=400&height=400&image=/'.$img1; ?>" alt="image-product">
                                                    </a>
                                                    <div class="list-product-btn">
                                <a href="#quick_add_<?php echo $product->product_id ?>" onclick="quick_add('<?php echo $product->product_id ?>','1','<?= (isset($product->varient_id)?$product->varient_id:0) ?>')" class="box-icon bg_white quick-add tf-btn-loading">
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
                                                <div class="card-product-info text-center">
                                                    <a href="<?php echo href_product($product) ?>" class="title link"><?= $product->product_name ?></a>
                                                    <?php
                                $val = $product;

                                ?>
                                <?php  
                                if((isset($mbl) && $mbl))
                                {
                                    

                                }
                                else
                                {


                                if(!empty($val->varient_price) && $val->varient_price >0){?>
                                    <p style="font-weight: bold;">Rs <?php echo ($val->varient_price)?$val->varient_price:$val->sale_price; ?></p>
                                <?php } else { 
                                    if(!empty($val->special_price)){?>
                                    <p style="font-weight: bold; margin-left: 10px;"><span style="left: -10px; color:red;" class="cut_price"><?php echo format_currency($val->sale_price); ?></span><?php echo format_currency($val->special_price); ?></p>                                <?php }else{?>
                                    <p style="font-weight: bold;">Rs <?php echo ($val->sale_price); ?></p>
                                <?php }}
                            } 

                                ?>
                                                    <div class="tf-product-btns">
                                                        <a href="#quick_add_<?php echo $product->product_id ?>" onclick="quick_add('<?php echo $product->product_id ?>','1','<?= (isset($product->varient_id)?$product->varient_id:0) ?>')" class="quick-add tf-btn style-3 radius-3 btn-fill animate-hover-btn">Quick add</a>
                                                    </div>
                                                </div>
                                            </div>