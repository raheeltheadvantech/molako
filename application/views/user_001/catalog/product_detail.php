
<style>
    .tf-sticky-btn-atc .tf-sticky-atc-title {
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.tf-sticky-btn-atc .tf-sticky-atc-variant-price select {
    max-width: 120px;
}

.tf-sticky-btn-atc .wg-quantity input {
    width: 40px;
    text-align: center;
}

.tf-sticky-btn-atc .btn-quantity {
    padding: 5px 10px;
}

</style>
<div class="tf-page-title style-2">
            <div class="container-full">
                <div class="heading text-center">Product Detail</div>
            </div>
        </div>
<body class="preload-wrapper">
    <!-- preload -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div id="wrapper">
        <!-- breadcrumb -->
        <div class="tf-breadcrumb">
            <div class="container">
                <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
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
            </div>
        </div>
        <!-- /breadcrumb -->
        <!-- default -->
        <section class="flat-spacing-4 pt_0">
            <div class="tf-main-product section-image-zoom">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="tf-product-media-wrap sticky-top">
                                <div class="thumbs-slider">
                                    <div class="swiper tf-product-media-thumbs other-image-zoom" data-direction="vertical">
                                        <div class="swiper-wrapper stagger-wrap">
                                            <?php
                                            foreach($result->images as $k=> $v)
                                            {
                                                $v = base_url().'/images/products/medium/'.$v;
                                                ?>
                                                <div class="swiper-slide stagger-item">
                                                <div class="item">
                                                    <img class="lazyload" data-src="<?= $v ?>" src="<?= $v ?>" alt="">
                                                </div>
                                            </div>

                                                <?php
                                            }
                                            ?>
                                            
                                        </div>
                                    </div>
                                    <div class="swiper tf-product-media-main" id="gallery-swiper-started">
                                        <div class="swiper-wrapper" >
                                            <?php
                                            foreach($result->images as $k=> $v)
                                            {
                                                $v = base_url().'/images/products/medium/'.$v;
                                                ?>
                                                <div class="swiper-slide">
                                                <a href="<?= $v ?>" target="_blank" data-pswp-width="770px" data-pswp-height="1075px">
                                                    <img class="tf-image-zoom-magnifier lazyload" data-zoom="<?= $v ?>" data-src="<?= $v ?>" src="<?= $v ?>" alt="">
                                                </a>
                                            </div>

                                                <?php
                                            }
                                            ?>
                                            
                                            
                                        </div>
                                        <div class="swiper-button-next button-style-arrow thumbs-next"></div>
                                        <div class="swiper-button-prev button-style-arrow thumbs-prev"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                    <div class="tf-product-info-wrap position-relative">
                        <div class="tf-zoom-main"></div>
                        <div class="tf-product-info-list other-image-zoom">
                            <div class="tf-product-info-title">
                                <h5><?php echo $result->product_name; ?></h5>
                            </div>
                            <div class="tf-product-info-badges">
                                <?php if($result->quantity) { ?>
                                    <div class="product-status-content" style="display:<?= ($result->quantity <= 5)?'block':
                                        'none'; ?> " id="qty5"> 
                                        <i class="icon-lightning"></i>
                                        <p class="fw-6" > Only <span class="det_qty"><?php echo $result->quantity; ?></span> items left! Hurry up and grab yours before they're gone!</p>
                                    </div>
                                <?php } elseif(!$config_catalog_purchase) { ?>
                                    <div class="alert alert-danger" role="alert">This item is out of stock!</div>
                                <?php } ?>
                            </div>
							<?php  
							$val = $result;
							$price = $val->sale_price;
								if(!empty($val->varient_price) && $val->varient_price >0){?>
                                    <p><?php $price = $val->varient_price; ?></p>
                                <?php } else { 
                                    if(!empty($val->special_price)){
										$price = $val->special_price;
										?>
                                <?php }}?>
                            <div class="tf-product-info-price">
                                <div class="tf-product-info-price">
                                <p style="font-weight: bold; margin-left: 10px;">
                                    <?php
                                    if(!empty($val->special_price) && $result->sale_price > $val->special_price){

                                    ?>
                                    <span style="left: -10px; color:red;" class="cut_price"><?= format_currency($result->sale_price); ?></span>

                                    <?php
                                }

                                    ?>

                                    <?= format_currency($price); ?></p>
                            </div>
                            </div>

                            <!-- Variant Picker -->
                            <form method="post" id="product-data1" class="product-form-data1_up" action="<?php echo site_url('checkout/add-to-cart.html')?>">
							
                        <input type="hidden" name="item[quantity]" id="quantity" value="1" />
						<input type="hidden" name="item[product_option_value_id]" class="variant_id" id="variant_id" value="">
                        <input type="hidden" name="item[product_id]" id="product_id" value="<?php echo $result->product_id; ?>" />
                        <input type="hidden" name="product_id" id="product_id" value="<?php echo $result->product_id; ?>" />
                         <input type="hidden" name="item[product_cur_qty]" id="product_cur_qty"  value="<?php if($result->quantity > 0){ echo $result->quantity;}else{ echo 0; } ?>"> 
                        <!-- <input type="hidden" name="item[redirect]" id="redirect" value="0" /> -->
                        <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                        <div class="single-product-content-view">
                            <div class="product-info">
                                <?php if($result->quantity > 0) {?>
                                <p class="availability in-stock" id="yesVariant">Availability: <span>In stock</span></p>
                                <?php } ?>
                                <div class="alert alert-danger noVariant mb-4" role="alert" id="noVariant" style=" display: none">
                                    <div class="d-flex justify-content-start">
                                        <span class="info-tip mr-4 intimation_icon"><i class="bx bxs-info-circle"></i></span>
                                        <p>This item is out of stock!</p>
                                    </div>
                                </div>
                                <div class="price-box" hidden>
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
                            <form method="post" class="cart">
                            <div class="add-to-box add-to-box2">
							<div class="tf-product-info-variant-picker">
<?php 
if($variations){ 
								$i = 0;
								$comb = array();
								if(isset($sing_var) && $sing_var)
								{
									$comb = json_decode($sing_var->combination,true);
								}
                                // dd($variations);

								
                                 foreach($variations as $key=>$variants){
									 $select = (isset($comb[$key])?$comb[$key]:'');
								$name = (isset($option_name[$i]))?$option_name[$i]:'';
								$vls = (isset($option_value[$i]))?$option_value[$i]:'';
								$type = (isset($option_type[$i]))?$option_type[$i]:'';
								$ccodes = (isset($color_code[$i]))?$color_code[$i]:'';
								$i++;

								$name = $key;
								if($vls)
								{
									$vls = explode(',',$vls);
								}
								else
								{
									$vls = array();
								}
								if($type == 'color')
								{
									?>
									<div class="variant-picker-item">
                                            <div class="variant-picker-label">
                                                <?= $name ?>: <span class="fw-6 variant-picker-label-value"><?= $select ?></span>
                                            </div>
                                            <div class="variant-picker-values">
												<?php
													foreach($vls as $k=> $v){
                                                        if(in_array($v,$variations[$name]))
                                                        {
	$code =(isset($ccodes[$v])?$ccodes[$v]:color_name_to_hex(trim($v))); 
    // $code = color_name_to_hex(trim($v));

												?>
                                                <input id="values-<?= $v ?>" data-key="<?php echo $key?>" class="variant_dropdowns" type="radio" name="item[options][<?php echo $key?>]" value="<?= $v ?>" <?= ($v == $select)?'checked':true ?> />
                                                <label id="<?php echo $key?>_<?php echo $v ?>" class="hover-tooltip radius-60" for="values-<?= $v ?>" data-value="<?= $v ?>">
                                                    <span class="btn-checkbox bg-color-<?= $v ?>" style="background:<?= $code ?>"></span>
                                                    <span class="tooltip"><?= $v ?></span>
                                                </label>
<?php
}
}
?>
                                            </div>
                                        </div>
                                        
									<?php
								}
								else
{
?>
<div class="variant-picker-item">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="variant-picker-label">
                                                    <?php echo $name; ?>: <span class="fw-6 variant-picker-label-value"><?= $select ?></span>
                                                </div>
                                                <a href="#find_size" data-bs-toggle="modal" class="find-size fw-6" hidden>Find your size</a>
                                            </div>
                                            <div class="variant-picker-values">
												<?php
													foreach($vls as $k=> $v)
{
                                                       if(in_array($v,$variations[$name]))
                                                        {

												?>
                                                <input id="values-<?= $v ?>"  data-key="<?php echo $key?>" class="variant_dropdowns" type="radio" name="item[options][<?php echo $key?>]"  value="<?= $v ?>" <?= ($v == $select)?'checked':'' ?> />
                                                <label class="style-text" id="<?php echo $key?>_<?php echo $v ?>" for="values-<?= $v ?>" data-value="<?= $v ?>">
                                                    <p><?= $v ?></p>
                                                </label>
<?php
}
}
?>
                                            </div>
                                        </div>

<?php
}?>

                                <?php  } } ?>
                                    </div>

                            <?php 
							/*
							if($variations){
								$i = 0;
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

                                <?php } } }*/ ?>
                            </div><!-- End Add to Box -->

                        </div><!-- End Single Product Content View -->
                    </form>

                            <!-- Quantity Control -->
                            <div class="tf-product-info-quantity">
                                <div class="quantity-title fw-6">Quantity</div>
                                <div class="wg-quantity">
                                    <span class="btn-quantity minus-btn" onclick="var qty_el = document.querySelector('input[name=\'number\']'); var qty = qty_el.value; if( !isNaN(qty) && qty > 1 ) qty--; return false;">-</span>
                                    <input id="qty" type="text" name="number" value="1">
                                    <span class="btn-quantity plus-btn" onclick="var qty_el = document.querySelector('input[name=\'number\']'); var qty = qty_el.value; if( !isNaN(qty) ) qty++; return false;">+</span>
                                </div>
                            </div>

                            <!-- Add to Cart Button -->
                            <div class="tf-product-info-buy-button">
                                <form method="post" id="product-data1" action="<?php echo site_url('checkout/add-to-cart.html') ?>">
                                    <input type="hidden" name="product_id" value="<?php echo $result->product_id; ?>"> 
                                    <input type="hidden" name="item[product_option_value_id]" class="variant_id" id="variant_id" value=""> 
                                    <input type="hidden" name="item[is_variation]" value="0">
                                    <input type="hidden" name="item[quantity]" value="1">
                                    <a onclick="detail_click('product-form-data1_up','detail_add_to_cart1');" href="javascript:void(0)" class="tf-btn btn-fill justify-content-center fw-6 fs-16 flex-grow-1" id="detail_add_to_cart1">
                                        <span>Add to cart -&nbsp;</span><span class="tf-qty-price">
                                            <?php if (!empty($result->varient_price) && $result->varient_price > 0) { ?>
                                    <?php echo format_currency($result->varient_price); ?>
                                    <?php //echo format_currency($result->sale_price); ?>
                                <?php } elseif (!empty($result->special_price)) { ?>
                                    <?php echo format_currency($result->special_price); ?>
                                <?php } else { ?>
                                    <?php echo format_currency($result->sale_price); ?>
                                <?php } ?>
                                        </span>
                                    </a>
                                </form>
                            </div>

                            <!-- Other Info Links (Delivery, Return, Share) -->
                            <div class="tf-product-info-extra-link">
                                <div  class="tf-product-extra-icon">
                                    <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
<a class="a2a_dd" href="https://www.addtoany.com/share"></a>
<a class="a2a_button_facebook"></a>
<a class="a2a_button_whatsapp"></a>
<a class="a2a_button_email"></a>
<a class="a2a_button_telegram"></a>
</div>
                                </div>
                            </div>
							<!-- AddToAny BEGIN -->


<!-- AddToAny END -->
                        </div>
                    </div>
                </div>

                </div>
                </div>
            </div>
            <div class="tf-sticky-btn-atc" hidden >
                <div class="container">
                    <div class="tf-height-observer w-100 d-flex align-items-center">
                        <div class="tf-sticky-atc-product d-flex align-items-center">
                        <div class="tf-sticky-atc-img">
    <?php
    // Check if there are images available
    if (!empty($result->images)) {
        // Get the first image in the array
        $first_image = base_url() . '/images/products/medium/' . $result->images[0];
        ?>
        <!-- Display the first image -->
        <img class="lazyloaded" data-src="<?= $first_image ?>" src="<?= $first_image ?>" alt="Image">
    <?php
    }
    ?>
</div>
                        </div>
                        <div class="tf-sticky-atc-infos">
                            <form method="post" id="product-data1" class="product-form-data1" action="<?php echo site_url('checkout/add-to-cart.html')?>">
                                <input type="hidden" name="item[product_id]" id="product_id" value="<?php echo $result->product_id; ?>" />
                                <input type="hidden" name="product_id" id="product_id" value="<?php echo $result->product_id; ?>" />
                                <input type="hidden" name="product_id" id="product_id" value="<?php echo $result->product_id; ?>" />
                                <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                                
                                <!-- Stock availability with concise display and inline with quantity -->
                                <div class="d-flex align-items-center justify-content-between mb-2">

                                    <!-- Quantity Selection (aligned with availability) -->
                                    <div class="tf-product-info-quantity">
                                        <div class="wg-quantity d-inline-flex align-items-center">
                                            <span class="btn-quantity minus-btn" style="padding: 5px;" onclick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty ) && qty > 1 ) qty--;return false;">-</span>
                                            <input type="text" name="item[quantity]" id="bqty" value="1" style="max-width: 40px; text-align: center;" />
                                            <span class="btn-quantity plus-btn" style="padding: 5px;" onclick="var qty_el = document.getElementById('qty'); var qty = qty_el.value; if( !isNaN( qty )) qty++;return false;">+</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Price Display with Heading and Price Aligned -->
                                <div class="tf-sticky-atc-variant-price d-flex align-items-center mb-2">
                                    <div class="price-heading me-2" style="font-size: 14px; font-weight: 600;">
                                        Price:
                                    </div>
                                    <div class="price-box">
                                        <p class="mb-0">
                                            <?php  
                                            if (!empty($result->varient_price) && $result->varient_price > 0) {
                                                echo format_currency($result->varient_price);
                                            } else if (!empty($result->special_price)) {
                                                echo format_currency($result->special_price);
                                            } else {
                                                echo format_currency($result->sale_price);
                                            } 
                                            ?>
                                        </p>
                                    </div>
                                </div>

                                <!-- Variants Dropdown - Colors and RAM displayed inline -->
                                <div class="tf-sticky-atc-variant-price d-flex justify-content-between align-items-center">
                                    <?php if($variations){
                                        foreach($variations as $key=>$variants){ 
                                            if(!empty($key)){ ?>
                                            <div class="product-select product-color d-inline-flex align-items-center">
                                                <h2 class="mb-1 me-2" style="font-size: 14px;"><?php echo $key?>:</h2>
                                                <select class="tf-select" name="item[options][<?php echo $key?>]" style="max-width: 120px; display:inline-block; margin-right:10px;">
                                                    <?php foreach($variants as $val) {?>
                                                        <option value="<?php echo $val;?>"><?php echo $val;?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        <?php } } } ?>
                                    <input type="hidden" name="item[product_option_value_id]" id="variant_id" value="">
                                </div>

                                <!-- Add to Cart Button -->
                                <div class="tf-sticky-atc-btns">
                                    <button class="tf-btn btn-fill radius-3 fw-6 fs-14 flex-grow-1" id="detail_add_to_cart2" title="Add to Cart" type="button" onclick="var qty_el = document.querySelector('input[id=\'bqty\']'); var qty = qty_el.value;quick_add('<?php echo $result->product_id; ?>',qty)">
                                        <i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>




        </section>
        <!-- /default -->
        <!-- tabs -->
        <section class="flat-spacing-17 pt_0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="widget-tabs style-has-border">
                    <ul class="widget-menu-tab">
                        <li class="item-title active">
                            <span class="inner">Description</span>
                        </li>
                        <li class="item-title">
                            <span class="inner">Specifications</span>
                        </li>
                        <li class="item-title">
                            <span class="inner">Warranty & Returns</span>
                        </li>
                    </ul>
                    <div class="widget-content-tab">
                        <div class="widget-content-inner active">
                            <p class="mb_30">
                                <?php echo $result->long_description; ?>
                            </p>
                        </div>
                        <div class="widget-content-inner">
                            <?php if(!empty($result->specification)){?>
                            <table class="tf-pr-attrs">
                                <tbody>
                                    <?php $spec = $result->specification; for($i=0 ; $i<count($spec); $i++){
                                    if ($i % 2 == 0) {
                                        $style = 'background: rgb(244, 244, 244);';
                                    } else {
                                        $style = '';
                                    }
                                    ?>
                                    <tr style="<?php echo $style;?>">
                                        <th class="tf-attr-label"><?php echo  $spec[$i]->filter_key;?></th>
                                        <td class="tf-attr-value"><?php echo $spec[$i]->filter_value;?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                            <?php } ?>
                        </div>
                        <div class="widget-content-inner">
                            <table class="tf-pr-attrs">
                                <tbody>
                                    <tr style="background: rgb(244, 244, 244);">
                                        <th class="tf-attr-label">Return & Exchange</th>
                                        <td class="tf-attr-value"><?php echo $result->return_warrenty;?></td>
                                    </tr>
                                    <tr>
                                        <th class="tf-attr-label">Manufacturing Defect Exchange</th>
                                        <td class="tf-attr-value"><?php echo $result->manufacturing_defect_warrenty;?></td>
                                    </tr>
                                    <tr style="background: rgb(244, 244, 244);">
                                        <th class="tf-attr-label">Courtesy Warranty Repair Shipment Service</th>
                                        <td class="tf-attr-value"><?php echo $result->courtesy_warranty;?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


        <!-- /tabs -->
        <!-- product -->
		<!-- recent -->
        <section class="flat-spacing-4 pt_0" style="padding-bottom:0px;">
            <div class="container">
                <div class="flat-title">
                    <span class="title">Related Product</span>
                </div>
                <div class="hover-sw-nav hover-sw-2">
                    <div class="swiper tf-sw-recent wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="30" data-space="15" data-pagination="1" data-pagination-md="1" data-pagination-lg="1">
                        <div class="swiper-wrapper">
                            <?php if (isset($related_products) && !empty($related_products)): ?>
                                    <?php foreach ($related_products as $val): ?>
                                        <div class="swiper-slide" lazy="true">
                                        <?php
                    // $product =   $val;
                            $this->load->view('product_box',array('product'=>$val));
                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-recent box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-recent box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-recent justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /recent -->
		<!-- product -->
        <section class="flat-spacing-1 pt_0">
            <div class="container">
                <div class="flat-title">
                    <span class="title">Recent Viewed Products</span>
                </div>
                <div class="hover-sw-nav hover-sw-2">
                    <div class="swiper tf-sw-product-sell wrap-sw-over" data-preview="4" data-tablet="3" data-mobile="2" data-space-lg="30" data-space-md="15" data-pagination="2" data-pagination-md="3" data-pagination-lg="3">
                        <div class="swiper-wrapper">
                            <?php if (isset($bestseller_products) && !empty($bestseller_products)): ?>
                                    <?php foreach ($bestseller_products as $val): ?>
                                        <div class="swiper-slide" lazy="true">
                                        <?php
                    // $product =   $val;
                                        // dd($val);
                            $this->load->view('product_box',array('product'=>$val));
                            ?>
                                        </div>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                        </div>
                    </div>
                    <div class="nav-sw nav-next-slider nav-next-product box-icon w_46 round"><span class="icon icon-arrow-left"></span></div>
                    <div class="nav-sw nav-prev-slider nav-prev-product box-icon w_46 round"><span class="icon icon-arrow-right"></span></div>
                    <div class="sw-dots style-2 sw-pagination-product justify-content-center"></div>
                </div>
            </div>
        </section>
        <!-- /product -->
        
        <!-- /product -->
    </body>