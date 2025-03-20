<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Shipping Address</div>
    </div>
</div>

<form action="<?php echo site_url('checkout/shipping.html') ?>" method="post">

<div id="checkout-cart" class="container" style="padding-bottom: 20px;">
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
                        <a href="<?php echo site_url('checkout/shipping/address.html')?>" class="btn btn-primary"><i class="fa fa-plus"> Add</i></a>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group" style="margin-bottom: 15px;">
                        <?php $first_flag = true; ?>
                            <?php
                            if(!empty($shipping_methods)):
                                foreach ($shipping_methods as $key => $shipping_method): 
                                    // echo'<pre>';print_r($key);die;?>
                                <?php if($shipping_method['status']): ?>
                                    <div class="flatrate">
                                        <div class="radio">
                                            <input type="radio" <?php echo $first_flag ? 'checked="checked"' : ''; ?> name="shipping-method" value="<?php echo $key ?>"> <?php echo strtoupper($key) ?> (cost: <?php echo format_currency($shipping_method['cost']) ?>)
                                        </div>
                                    </div>
                                    <?php $first_flag = false; ?>
                                <?php  endif; ?>
                            <?php endforeach; ?>
                        <?php  endif; ?>
                    </div>
                </div>
            </div>
        	
            <?php if(!empty($address_menu)):?>
            <div class="row">
                <div class="col-md-7 text-right">
                    <input class="btn btn-primary" type="submit" name="continue" value="continue" />
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