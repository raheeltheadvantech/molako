<?php if (isset($bestseller_products) && !empty($bestseller_products)): ?>
                <?php foreach ($bestseller_products as $val): ?>
                    <?php
                    // $product =   $val;
                            $this->load->view('product_box',array('product'=>$val));
                            ?>

                <?php endforeach; ?>
            <?php endif; ?>