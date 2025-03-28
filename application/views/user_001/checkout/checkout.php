

        <!-- page-title -->
        <div class="tf-page-title">
            <div class="container-full">
                <div class="heading text-center">Check Out</div>
            </div>
        </div>
        <!-- /page-title -->
        
        <!-- page-cart -->
        <section class="checkout_guest flat-spacing-11">
            <div class="container">
                <div class="tf-page-cart-wrap layout-2">
                    <div class="tf-page-cart-item">
                        <h5 class="fw-5 mb_20">Billing details</h5>
                        <form class="form-checkout1 tf-page-cart-checkout widget-wrap-checkout checkout_form" method="POST" action="<?= base_url('guest/checkout.html') ?>">
                            <?php
                            /*$error = $this->user_session->flashdata('error');
                            if($error)
                            {
                                ?>
                                <div class="alert alert-danger" role="alert">
  <?php echo $error; ?>
</div>

                                <?php

                            }*/

                            ?>
                            <input type="hidden" name="page" value="checkout">
                            <?php
                            $default = array();
                            if(isset($address_menu) && $address_menu)
                            {
                                ?>
                            <div id="shipping-existing" class="row">
                    <select name="address_id"  class="address_id form-control" onchange="chng_address()">
                        <?php foreach ($address_menu as $key => $address): 
                            $selected = '';
                            if($address['default'])
                            {
                                $selected = 'selected="selected"';
                                $default = $address;
                            }

                            ?>
                        <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $address['txt']; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <?php
                            }
                            // var_dump($default);

                            ?>
                            <div id="side_html">
                                <?php
                                    include "checkout_form.php";
                                ?>
                                
                            </div>
                    </div>
                    <div class="tf-page-cart-footer">
                        <div class="tf-cart-footer-inner tf-page-cart-checkout widget-wrap-checkout">
						
                            <h5 class="fw-5 mb_20">Your order</h5>
                                <ul class="wrap-checkout-product">
                                    <?php 
                            $i = 0;
                            foreach ($products as $product):
                                $i++;
                            ?>
                                    <li class="checkout-product-item">
                                        <figure class="img-product">
                                            <img src="<?= $product->images ?>" alt="Product Image" />
                                            <span class="quantity"><?php echo $product->quantity; ?></span>
                                        </figure>
                                        <div class="content">
                                            <div class="info">
                                                <p class="name"><?= $product->product_name; ?></p>
                                                <span class="variant"><?= $product->product_options; ?></span>
                                            </div>
                                            <span class="price"><?php
                                                if((double)$product->unite_price < (double)$product->cut_price)
                                    {
                                        $product->unite_price = (float) $product->unite_price;
                                        ?>
                                        <p style="font-weight: bold; margin-left: 10px;"><span style="left: -10px; color:red;" class="cut_price"><?php echo format_currency($product->cut_price); ?></span><?php echo format_currency($product->unite_price); ?></p>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <p style="font-weight: bold; margin-left: 10px;"><?php echo format_currency($product->unite_price); ?></p>
                                        <?php
                                    }
                                    ?></span>
                                        </div>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>
                                <div class="coupon-box" hidden>
                                    <input type="text" placeholder="Discount code">
                                    <a href="#" class=" -btn btn-sm radius-3 btn-fill btn-icon animate-hover-btn">Apply</a>
                                </div>
                                <?php?>
                                <div id="tot">
                            <div class="tf-cart-totals-discounts">
                                <h3>Subtotal</h3>
                                <span class="stotal-value"><?= $sub_total; ?></span>
                            </div>

                            <?php if($this->user_session->userdata('coupon')): ?>
                            <div class="tf-cart-totals-discounts">
                                <h3><i class="icon icon-delete text-danger remveCoupon" style="cursor: pointer;"></i> Discount (coupon code)</h3>
                                <span class="coupon-value"><?= $discount; ?></span>
                            </div>
                            <div class="tf-cart-totals-discounts">
                                <h3>Grand Total</h3>
                                <span class="total-value"><?= $grand_total; ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                                <div class="wd-check-payment ">
                                            <div class="tf-cart-totals-discounts">
                                <h5>Payment Methods</h5>
                                <span class="stotal-value"></span>
                            </div>
									<?php $first_flag = true; ?>
                                    <?php if(!empty($payment_methods)): ?>
                                    <?php foreach ($payment_methods as $key => $payment_method): ?>
                                        <?php if($payment_method['status']): ?>
										<div class="fieldset-radio mb_20">
                                        <input type="radio" <?php echo $first_flag ? 'checked="checked"' : ''; ?> name="payment-method" value="<?php echo $key ?>" class="tf-check">
                                        <label for="bank"><?php echo strtoupper($key) ?></label>
                                       
                                    </div>
                                            <?php $first_flag = false; ?>
                                        <?php  endif; ?>
                                    <?php endforeach; ?>
                                    <?php  endif; ?>
                                    <div class="tf-cart-totals-discounts">
                                <h5>Shipping Methods</h5>
                                <span class="stotal-value"></span>
                            </div>

                                    <?php $first_flag = true; ?>
                                    <?php if(!empty($shipping_methods)): ?>
                                    <?php foreach ($shipping_methods as $key => $shipping_method): ?>
                                        <?php if($shipping_method['status']): ?>

                                        <div class="fieldset-radio mb_20">
                                        <input type="radio" <?php echo $first_flag ? 'checked="checked"' : ''; ?> name="shipping-method" value="<?php echo $key ?>" class="tf-check">
                                        <label for="bank"><?php echo $shipping_method['title'] ?> (cost: <?php echo format_currency($shipping_method['cost']) ?>)</label>
                                       
                                    </div>
                                            <?php $first_flag = false; ?>
                                        <?php  endif; ?>
                                    <?php endforeach; ?>
                                    <?php  endif; ?>
                                    <p class="text_black-2 mb_20">Your personal data will be used to process your order, support your experience throughout this website, and for other purposes described in our <a href="<?php echo base_url('pages/privacy-policy.html')?>" class="text-decoration-underline">privacy policy</a>.</p>
                                    <div class="box-checkbox fieldset-radio mb_20">
                                        <input type="checkbox" id="check-agree" class="tf-check">
                                        <label for="check-agree" class="text_black-2">I have read and agree to the website <a href="<?php echo base_url('pages/terms-conditions.html')?>" class="text-decoration-underline">terms and conditions</a>.</label>
                                    </div>
                                </div>
                                <button type="button" onclick="place_order()" class="tf-btn radius-3 btn-fill btn-icon animate-hover-btn justify-content-center">Place order</button>
                            </form>
                            <?php
                            if(isset($jazzcash['status']) && $jazzcash['status'])
                            {
                                $type = 'live';
                                $post_url = 'https://payments.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform';
                                if($jazzcash['sandbox_mode'])
                                {
                                    $type = 'sandbox';
                                    $post_url = 'https://sandbox.jazzcash.com.pk/CustomerPortal/transactionmanagement/merchantform/';
                                }
                                //============================Get Form Values=========================================================
$packagePrice = 100;
//============================Get EForm Values=========================================================


//=============================JazzCash API Configurations=============================================
$pp_Amount = $packagePrice * 100;






//============================Get Form Values=========================================================
$packagePrice = 100;
//============================Get EForm Values=========================================================


//=============================JazzCash API Configurations=============================================
$pp_Amount = $packagePrice * 100;

$MerchantID = $jazzcash[$type.'_username']; //Your Merchant from transaction Credentials
$Password = $jazzcash[$type.'_password']; //Your Password from transaction Credentials
$HashKey = $jazzcash[$type.'_api_signature']; //Your HashKey/integrity salt from transaction Credentials
$ReturnURL = $jazzcash[$type.'_return_url']; //Your Return URL, It must be static


date_default_timezone_set("Asia/karachi");

$Amount = $pp_Amount; //Last two digits will be considered as Decimal thats the reason we are multiplying amount with 100 in line number 11
$BillReference = "billRef".time(); //use AlphaNumeric only
$Description = "Product test description"; //use AlphaNumeric only
$IsRegisteredCustomer = "No"; // do not change it
$Language = 'EN'; // do not change it
$TxnCurrency = 'PKR'; // do not change it
$TxnDateTime = date('YmdHis');
$TxnExpiryDateTime = date('YmdHis', strtotime('+1 Days'));
$TxnRefNumber = 'EHB'.date('YmdHis') . mt_rand(10, 100);
$TxnType = ""; // Leave it empty
$Version = '2.0';
$SubMerchantID = ""; // Leave it empty
$BankID = ""; // Leave it empty
$ProductID = ""; // Leave it empty
$ppmpf_1 = "22"; // use to store extra details (use AlphaNumeric only)
$ppmpf_2 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_3 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_4 = ""; // use to store extra details (use AlphaNumeric only)
$ppmpf_5 = ""; // use to store extra details (use AlphaNumeric only)

//========================================Hash Array for making Secure Hash for API call================================
$HashArray = [$Amount, $BankID, $BillReference, $Description, $IsRegisteredCustomer,
    $Language, $MerchantID, $Password, $ProductID, $ReturnURL, $TxnCurrency, $TxnDateTime,
    $TxnExpiryDateTime, $TxnRefNumber, $TxnType, $Version, $ppmpf_1, $ppmpf_2, $ppmpf_3,
    $ppmpf_4, $ppmpf_5];

$SortedArray = $HashKey;
for ($i = 0; $i < count($HashArray); $i++) {
    if ($HashArray[$i] != 'undefined' and $HashArray[$i] != null and $HashArray[$i] != "") {
        $SortedArray .= "&" . $HashArray[$i];
    }
}
$Securehash = hash_hmac('sha256', $SortedArray, $HashKey);
//========================================Hash Array for making Secure Hash for API call================================



?>
        <form method="post" id="jazzcash_form" action="<?php echo $post_url; ?>" >
        <input type="hidden" name="pp_Version" value="<?php echo $Version; ?>" />
        <input type="hidden" name="pp_TxnType" placeholder="TxnType" value="<?php echo $TxnType; ?>" />
        <input type="hidden" name="pp_Language" value="<?php echo $Language; ?>" />
        <input type="hidden" name="pp_MerchantID" value="<?php echo $MerchantID; ?>" />
        <input type="hidden" name="pp_SubMerchantID" value="<?php echo $SubMerchantID; ?>" />
        <input type="hidden" name="pp_Password" value="<?php echo $Password; ?>" />
        <input type="hidden" name="pp_TxnRefNo" value="<?php echo $TxnRefNumber; ?>" />
        <input type="hidden" name="pp_Amount" value="<?php echo $Amount; ?>" />
        <input type="hidden" name="pp_TxnCurrency" value="<?php echo $TxnCurrency; ?>" />
        <input type="hidden" name="pp_TxnDateTime" value="<?php echo $TxnDateTime; ?>" />
        <input type="hidden" name="pp_BillReference" value="<?php echo $BillReference ?>" />
        <input type="hidden" name="pp_Description" value="<?php echo $Description; ?>" />
        <input type="hidden" name="pp_IsRegisteredCustomer" value="<?php echo $IsRegisteredCustomer; ?>" />
        <input type="hidden" id="pp_BankID" name="pp_BankID" value="<?php echo $BankID ?>">
        <input type="hidden" id="pp_ProductID" name="pp_ProductID" value="<?php echo $ProductID ?>">
        <input type="hidden" name="pp_TxnExpiryDateTime" value="<?php echo $TxnExpiryDateTime; ?>" />
        <input type="hidden" name="pp_ReturnURL" value="<?php echo $ReturnURL; ?>" />
        <input type="hidden" name="pp_SecureHash" value="<?php echo $Securehash; ?>" />
        <input type="hidden" name="ppmpf_1" placeholder="ppmpf_1" value="<?php echo $ppmpf_1; ?>" />
        <input type="hidden" name="ppmpf_2" placeholder="ppmpf_2" value="<?php echo $ppmpf_2; ?>" />
        <input type="hidden" name="ppmpf_3" placeholder="ppmpf_3" value="<?php echo $ppmpf_3; ?>" />
        <input type="hidden" name="ppmpf_4" placeholder="ppmpf_4" value="<?php echo $ppmpf_4; ?>" />
        <input type="hidden" name="ppmpf_5" placeholder="ppmpf_5" value="<?php echo $ppmpf_5; ?>" /><br> <br> <br>
    </form>


<?php

                            }

                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- page-cart -->
