<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Order Review</div>
    </div>
</div>
<div class="checkout-area">
    <div class="container">
        <div class="row">
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <!-- Panel Default -->
                <div class="panel panel_default">
                    <div class="panel_heading mb-2">
                    </div>
                    <div class="panel-body"> 
                        <div class="form-group" style="margin-bottom: 15px">
                            <?php if ($this->disable_checkout) {?>
                            <div class="alert alert-danger">
                                <button type="button" class="close btn btn-default" data-dismiss="alert">×</button>
                                <i class="fa-fw fa fa-warning"></i>
                                <strong>Notice</strong> Checkout Disabled
                            </div>
                            <?php }?>
                        </div>
                        <div class="message"></div>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <form method="post" action="<?php echo site_url('checkout/confirm-order.html'); ?>">
                                    <!-- Previous -->
                                    <table class="table table-striped table-responsive" >
                                        <tbody>
                                            <thead style="color: #fff; background-color: #2e6ed5;">
                                            <tr>
                                                <th>Product Name</th>
                                                <th>Price</th>
                                                <th>Qty</th>
                                                <th>Subtotal</th>
                                            </tr>
                                            </thead>
                                            <?php if(isset($products) && !empty($products)): ?>
                                                <?php foreach ($products as $product): ?>

                                                    <tr>
                                                        <td><?php echo $product->product_name ?></td>
                                                        <td><p class="tabletextp"><?php echo $product->unite_price ?></p></td>
                                                        <td><?php echo $product->quantity ?></td>
                                                        <td><p class="tabletextp"><?php echo $product->total; ?></p></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php endif; ?>

                                            <?php if(isset($products) && !empty($products)): ?>
                                                <?php
                                               // echo '<pre>';print_r($total);die();


                                                foreach ($total as $key => $value): ?>
                                                    <?php if($value->amount  != '$0.00' && !empty($value->amount)):

                                                    if($key != 'tax'):

                                                        ?>
                                                        <tr>
                                                            <td colspan="3">
                                                                <p class="tabletext"><?php echo $value->title ?></p>
                                                            </td>
                                                            <td>
                                                                <p class="tabletextp"><?php echo format_currency($value->amount) ?></p>
                                                            </td>
                                                        </tr>
                                                    <?php else:

                                                    foreach ($value->amount as $val):
                                                        if($val['price']  != '$0.00' && !empty($val['price'])):?>

                                                            <tr>
                                                                <td colspan="3">
                                                                    <p class="tabletext"><?php echo $val['name']; ?></p>
                                                                </td>
                                                                <td>
                                                                    <p class="tabletextp"><?php echo format_currency($val['price']) ?></p>
                                                                </td>
                                                            </tr>


                                                    <?php endif;endforeach;
                                                    endif;endif; ?>
                                                <?php endforeach; ?>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                    <button type="submit" class="tf-btn w-30 radius-3 btn-fill animate-hover-btn justify-content-center">Continue</button>
                                    <!-- End -->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                                            