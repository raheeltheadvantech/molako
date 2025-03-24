

                                

                                <div class="tf-search-hidden-inner">

                                <?php foreach ($products as $product): ?>

                                <div class="tf-loop-item">

                                    <div class="image">

                                        <a href="<?php echo href_product($product)?>">

                                                <img src="<?= $product->images ?>" />

                                            </a>

                                    </div>

                                    <div >

                                        <a href="<?php echo href_product($product)?>"><?php echo $product->product_name; ?></a>

                                        <div class="tf-product-info-price">

                                            <div class="price fw-6"><?= $product->total ?></div>

                                        </div>

                                    </div>

                                </div>

                                <?php endforeach; ?>

                            </div>