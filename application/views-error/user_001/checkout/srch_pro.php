
                                
                                <div class="tf-search-hidden-inner">
                                <?php foreach ($products as $product): ?>
                                <div class="tf-loop-item">
                                    <div class="image">
                                        <a href="<?php echo href_product($product)?>">
                                                <img src="<?= $product->images ?>" />
                                            </a>
                                    </div>
                                    <div class="content">
                                        <a href="<?php echo href_product($product)?>"><?php echo $product->product_name; ?></a>
                                        <div class="tf-product-info-price">
                                            <div class="price fw-6"><?= $product->total ?></div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                                <div class="tf-loop-item">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img src="images/products/white-2.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <a href="product-detail.html">Mini crossbody bag</a>
                                        <div class="tf-product-info-price">
                                            <div class="price fw-6">$18.00</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tf-loop-item">
                                    <div class="image">
                                        <a href="product-detail.html">
                                            <img src="images/products/white-1.jpg" alt="">
                                        </a>
                                    </div>
                                    <div class="content">
                                        <a href="product-detail.html">Oversized Printed T-shirt</a>
                                        <div class="tf-product-info-price">
                                            <div class="price fw-6">$18.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>