

                                

                                <div class="tf-search-hidden-inner">

                                <?php foreach ($products as $product): ?>
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
                                        $img1 = 'images/products/medium/'.$img1;
                                    }

                                    ?>

                                <div class="tf-loop-item">

                                    <div class="image">

                                        <a href="<?php echo href_product($product)?>">

                                                <img src="<?= live_img_url().'/images/image.php?width=200&height=200&image=/'.$img; ?>" />

                                            </a>

                                    </div>

                                    <div >

                                        <a href="<?php echo href_product($product)?>"><?php echo $product->product_name; ?></a>

                                        <div class="tf-product-info-price">

                                            <div class="price fw-6">
                                                <?php
                                                $val = $product;
                                                if($val->final_price < $val->sale_price)
                                    {
                                        ?>
                                        <p style="font-weight: bold; margin-left: 10px;"><span style="left: -10px; color:red;" class="cut_price"><?php echo format_currency($val->sale_price); ?></span><?php echo format_currency($val->final_price); ?></p>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <p style="font-weight: bold; margin-left: 10px;"><?php echo format_currency($val->final_price); ?></p>
                                        <?php
                                    }

                                                ?>
                                            </div>

                                        </div>

                                    </div>

                                </div>

                                <?php endforeach; ?>

                            </div>
                            