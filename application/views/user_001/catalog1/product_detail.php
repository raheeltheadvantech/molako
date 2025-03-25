<?php
//echo '<pre>';
//print_r($result);
//die();
?>

<!-- Breadcurb Area -->
<div class="breadcurb-area">
    <div class="container">
        <ul class="breadcrumb">

            <?php $breadcrumbs = $this->breadcrumbs;
            for($i=0 ; $i<count($breadcrumbs); $i++){
                $class = '';
                if($i == 0)
                    $class = 'home';
            ?>
            <li class="<?php echo $class;?>"><a href="<?php echo $breadcrumbs[$i]['href']?>"><?php echo $breadcrumbs[$i]['title']; if($i == 0) echo ' >> ';?></a></li>
          <?php } ?>

        </ul>
    </div>
</div><!-- End Breadcurb Area -->
<!-- Single Product details Area -->
<div class="single-product-detaisl-area">
    <!-- Single Product View Area -->
    <div class="single-product-view-area">
        <div class="container">
            <div id="content"></div>
            <div class="row">
                <div class="col-lg-5">
                    <!-- Single Product View -->
                    <div class="single-procuct-view">
                        <!-- Simple Lence Gallery Container -->
                        <div class="simpleLens-gallery-container" id="p-view">
                            <?php  if(!empty($result->images)){?>
                            <div class="simpleLens-container tab-content">

                                <?php  $num = 1; foreach ($result->images as $value) {

                                    $class = '';
                                    if($num == 1)
                                        $class= 'active';

                                    ?>

                                    <div class="tab-pane <?php echo $class;?>" id="p-view-<?php echo $num;?>">
                                        <div class="simpleLens-big-image-container">
                                            <a class="simpleLens-lens-image" data-lens-image="<?php echo create_product_detail_image_path($value ,'full');?>">
                                                <?php echo create_product_detail_image_html($value ,'medium' , 0 , '' ,'' , 'simpleLens-big-image');?>
                                            </a>
                                        </div>
                                    </div>


                                <?php $num++; } ?>




                            </div>
                              <?php }else{?>
                            <div class="tab-pane"  >
                                <div class="simpleLens-big-image-container">
                                    <?php echo create_product_detail_image_html('' ,'medium' , 0 , '' ,'' ,  '');?>

                                </div>
                            </div>
                            <?php }?>
                            <!-- Simple Lence Thumbnail -->
                            <div class="simpleLens-thumbnails-container">
                                <div id="single-product" class="owl-carousel custom-carousel">
                                    <?php if(!empty($result->images)){  $num = 0; foreach ($result->images as $value) {  $num = $num+1; ?>

                                        <?php if ($num % 4 == 1) echo '<ul class="nav nav-tabs" role="tablist">';  ?>

                                            <?php
                                            $class = '';
                                            if($num == 1)
                                                $class= 'active';

                                            if($num == 2)
                                                $class= 'last-li';

                                            if($num == 3)
                                                $class= 'd-none d-xl-block';

                                            ?>

                                            <li><a class="<?php echo $class;?>" href="#p-view-<?php echo $num;?>" role="tab" data-bs-toggle="tab"><?php echo create_product_detail_image_html($value ,'thumbnails' , 1 ,  90 , 90 ,  '');?></a></li>
                                        <?php if ($num % 4 == 0) echo '</ul>';  ?>

                                    <?php  } }?>
                                </div>
                            </div><!-- End Simple Lence Thumbnail -->
                        </div><!-- End Simple Lence Gallery Container -->
                    </div><!-- End Single Product View -->
                </div>
                <div class="col-lg-7">
                    <!-- Single Product Content View -->
                    <form method="post" id="product-data1" class="product-form-data1" action="<?php echo site_url('checkout/add-to-cart.html')?>">
                        <input type="hidden" name="item[product_id]" id="product_id" value="<?php echo $result->product_id; ?>" />
                        <!-- <input type="hidden" name="item[product_cur_qty]" id="product_cur_qty"  value="<?php if($result->quantity > 0){ echo $result->quantity;}else{ echo 0; } ?>"> -->
                        <!-- <input type="hidden" name="item[redirect]" id="redirect" value="0" /> -->
                        <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                        <div class="single-product-content-view">
                            <div class="product-info">
                                <h1><?php echo $result->product_name; ?></h1>
                                <?php if($result->quantity > 0) {?>
                                <p class="availability in-stock" id="yesVariant">Availability: <span>In stock</span></p>
                                <?php } ?>
                                <div class="alert alert-danger noVariant mb-4" role="alert" id="noVariant" style=" display: none">
                                    <div class="d-flex justify-content-start">
                                        <span class="info-tip mr-4 intimation_icon"><i class="bx bxs-info-circle"></i></span>
                                        <p>This item is out of stock!</p>
                                    </div>
                                </div>
                                <div class="quick-desc">
                                    <?php echo $result->short_description; ?>
                                </div>
                                <div class="price-box">
                                    <?php  if(!empty($result->varient_price) && $result->varient_price >0){?>
                                        <p class="price"><span class="special-price"><span class="amount product-card__item-info-price-with-discount"><?php echo format_currency($result->varient_price) ?></span></span></p>
                                    <?php } else { 
                                        if(!empty($result->special_price)){?>
                                        <p class="price"><span class="special-price"><span class="amount product-card__item-info-price-with-discount"><?php echo format_currency($result->special_price) ?></span></span></p>
                                    <?php }else{?>
                                        <p class="price"><span class="special-price"><span class="amount product-card__item-info-price-with-discount"><?php echo format_currency($result->sale_price) ?></span></span></p>
                                    <?php }
                                    }?>
                                    
                                </div>
                            </div><!-- End product-info -->
                            <!-- Add to Box -->
                            <div class="add-to-box add-to-box2">

                            <?php if($variations){
                                 foreach($variations as $key=>$variants){
                                 if(!empty($key)){?>

                                <div class="product-select product-color">
                                    <h2><?php echo $key?> <sup>*</sup></h2>
                                  
                                    <select class="form-control variant_dropdowns font-color-editor"
                                            name="item[options][<?php echo $key?>]">
                                    <!-- <option value="">---Select--</option> -->
                                   <?php foreach($variants as $val) {?>
                                        <option value="<?php echo $val;?>"
                                                name="<?php echo $val;?>"><?php echo $val;?></option>
                                         <?php } ?>
                                    </select>
                                </div>

                                <?php } } } ?>
                                <input type="hidden" name="item[product_option_value_id]" id="variant_id" value="">

                                <div class="quick-add-to-cart">
                                    <form method="post" class="cart">
                                        <div class="qty-button">
                                            <input type="text" class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="item[quantity]">

                                            <div class="box-icon button-plus">
                                                <input type="button" class="qty-increase " onclick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty )) qty_el.value++;return false;" value="+">
                                            </div>
                                            <div class="box-icon button-minus">
                                                <input type="button" class="qty-decrease" onclick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty ) &amp;&amp; qty &gt; 1 ) qty_el.value--;return false;" value="-">
                                            </div>
                                        </div>
                                        <div class="product-actions">
                                            <button class="button btn-cart add-cart-button1" id="detail_add_to_cart1" title="Add to Cart" type="submit"><i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div><!-- End Add to Box -->

                        </div><!-- End Single Product Content View -->
                    </form>

                </div>
            </div>
        </div>
    </div><!-- End Single Product View Area -->
    <!-- Single Description Tab -->
    <div class="single-product-description" style="margin-bottom: 5px;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-description-tab custom-tab">
                        <!-- tab bar -->
                        <ul class="nav nav-tabs" role="tablist">
                            <li><a class="active" href="#product-des" data-bs-toggle="tab">Product Description</a></li>
                            <li><a href="#product-specf" data-bs-toggle="tab">Specifications</a></li>
                            <li><a href="#product-warrenty" data-bs-toggle="tab">Warranty & Returns</a></li>
                        </ul>
                        <!-- Tab Content -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="product-des">
                                <?php echo $result->long_description; ?>
                            </div>
                            <div class="tab-pane" id="product-specf">
                                <?php if(!empty($result->specification)){?>
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table align="left" border="0" class="pi-specs-table table">
                                            <tbody>

                                            <?php $spec = $result->specification; for($i=0 ; $i<count($spec); $i++){

                                            if ($i % 2 == 0) {
                                                $style = 'background: rgb(244, 244, 244);';
                                            }else{
                                                $style = '';
                                            }
                                                ?>
                                                <tr style="<?php echo $style;?>">
                                                <td align="left" width="50%"><?php echo  $spec[$i]->filter_key;?></td>
                                                <td width="50%"><?php echo $spec[$i]->filter_value;?></td>
                                                </tr>

                                            <?php }?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="tab-pane" id="product-warrenty">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <table align="left" border="0" class="pi-specs-table table">
                                            <tbody>
                                                <tr style="background: rgb(244, 244, 244);">
                                                    <td align="left" width="50%">Return & Exchange</td>
                                                    <td><?php echo $result->return_warrenty;?></td>
                                                </tr>
                                                <tr>
                                                    <td align="left" width="50%">Manufacturing Defect Exchange</td>
                                                    <td><?php echo $result->manufacturing_defect_warrenty;?></td>
                                                </tr>
                                                <tr style="background: rgb(244, 244, 244);">
                                                    <td align="left" width="50%">Courtesy Warranty Repair Shipment Service</td>
                                                    <td><?php echo $result->courtesy_warranty;?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Single Description Tab -->
    <!-- Product Area -->
    <?php
    if(isset($related_products) && !empty($related_products)){ ?>
        <div class="product-area ">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Product View Area -->
                        <div class="product-view-area fix">
                            <!-- Single Product Category Related Products -->
                            <div class="single-product-category related-products" style="padding-bottom: 20px;">
                                <!-- Product Category Title-->
                                <div class="head-title">
                                    <p>Related Products</p>
                                </div>
                                <!-- Product View -->
                                <div class="product-view">
                                    <!-- Product View Carousel -->
                                        <!-- Single Product -->
                                        <?php include('inc.product-detail-related-products.php'); ?>
                                   <!-- End Product View Carousel -->
                                </div><!-- End Product View-->
                            </div><!-- End Single Product Category -->
                            <!-- Single Product Category UpSell Product -->
                             </div><!-- End Product View Area -->
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    <!-- End Product Area -->
</div><!-- End Single Product details Area -->