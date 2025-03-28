<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Billing Address</div>
    </div>
</div>


<form action="<?php echo site_url('checkout/billing.html') ?>" method="post">

    <div id="checkout-cart" class="billing container" style="padding-bottom: 20px;">
        <div class="chart-area">
            <div class="container contact-form">
                    <div class="row">
                        <div class="col-md-12" id="content">
                            <div class="cart-title">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <?php if ($this->disable_checkout) {?>
                            <div class="alert alert-danger">
                                <button type="button" class="close btn btn-default" data-dismiss="alert">×</button>
                                <i class="fa-fw fa fa-warning"></i>
                                <strong>Notice</strong> Checkout Disabled
                            </div>
                            <?php }?>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group" style="margin-bottom: 15px;">
                                <?php 
                                    $data = array('name'=>'address_id', 'label'=>'Address', 'class'=>'form-control','id'=>'address_id' );
                                    echo form_dropdown_1($data, $address_menu, set_value('address_id', $address_id));
                                ?>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group" style="padding-top: 19px;">
                                <a href="<?php echo site_url('checkout/billing/address.html')?>" class="tf-btn w-10 radius-3 btn-fill animate-hover-btn justify-content-center"><i class="fa fa-plus"> Add</i></a>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group" style="margin-bottom: 15px;">
                                <div class="flatrate">
                                    <?php $first_flag = true; ?>
                                    <?php if(!empty($payment_methods)): ?>
                                    <?php foreach ($payment_methods as $key => $payment_method): ?>
                                        <?php if($payment_method['status']): ?>
                                            <div class="radio">
                                                <label><input type="radio" <?php echo $first_flag ? 'checked="checked"' : ''; ?> name="payment-method" value="<?php echo $key ?>"> <?php echo strtoupper($key) ?></label>
                                            </div>
                                            <?php $first_flag = false; ?>
                                        <?php  endif; ?>
                                    <?php endforeach; ?>
                                    <?php  endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                	
                    <?php if(!empty($address_menu)):?>
                    <div class="row">
                        <div class="col-md-7 text-end">
                            <input class="tf-btn w-30 radius-3 btn-fill animate-hover-btn justify-content-center" type="submit" name="continue" value="continue" />
                        </div>
                    </div>
                    <?php endif;?>
            </div>
        </div>

    </div>
</form>

<script type="text/javascript">
    $(function() {
        $('#address_id').find('option:first').remove();
    })
    
</script>