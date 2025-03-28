<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    #content {
        margin-top: 20px;
    }
    .additional-images .item.img-active:before{
        border-color: #cc0000;
    }
    .product-info-detailed{
        padding: 10px 0px 30px 0px;
    }
    .product-info-detailed .tab-content{
        border: 1px solid #ebebeb;
    }

    .product-info-main .button-call-for-price {
        float: left;
        margin-top: 15px;
        background: #cc3106;
        padding: 0 70px;
        font-size: 16px;
        font-weight: 700;
    }

    @media screen and (max-width: 600px) {
        .inner{
            padding-left: 15px;
            padding-right: 15px;
        }

        .product-info-detailed .nav-tabs li{
            display: inline-block;
            padding: 0px 15px;
        }
    }

    @media screen and (min-width: 641px) {
        .inner{
            padding-left: 15px;
            padding-right: 15px;
        }

        .product-info-detailed .nav-tabs li{
            display: inline-block;
            padding: 0px 15px;
        }
    }
</style>
<?php $vendor_dir = 'assets/vendors/'; ?>
<?php $assets_dir = 'assets/'.site_config_item('user_assets').'/'; ?>

<link href="<?php echo site_url($assets_dir.'css/style_3/zoom/zoom.css'); ?>" type="text/css" rel="stylesheet" media="screen" />
<link href="<?php echo site_url($vendor_dir.'cloudzoom/cloud-zoom.css'); ?>" type="text/css" rel="stylesheet" media="screen" />

<script type="text/javascript" src="<?php echo site_url($vendor_dir.'cloudzoom/cloud-zoom.1.0.2.min.js'); ?>" ></script>
<script type="text/javascript" src="<?php echo site_url($vendor_dir.'cloudzoom/zoom.js'); ?>" ></script>

<div id="product-product" class="container">

    <?php /*?>
	<ul class="breadcrumb">
		<li><a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a></li>
    </ul>
    <?php */?>

    <div class="row">
        <div id="content" class="col-sm-12">
            <div class="row">
                <div class="product-image-main col-sm-6">

                    <input type="hidden" id="check-use-zoom" value="1" />
                    <input type="hidden" id="light-box-position" value="1" />
                    <input type="hidden" id="product-identify" value="<?php echo $result->product_id; ?>" />
                    <div class="lightbox-container"></div>



                    <div class="product-zoom-image">
                        <div id="wrap">
                            <?php
                            $main_image = base_url($this->site_config->item('config_placeholder_large'));

                            $images = $result->images;
                            //var_dump($images);

                            if( isset($images[0]) and !empty($images[0]) )
                            {
                                $local_image = $result->product_id .'-'.basename($images[0]);
                                $cloud_image = $images[0];

                                if(file_exists('uploads/original/products/'. $local_image) && filesize('uploads/original/products/'. $local_image) > 0)
                                {
                                    $doc = file_get_contents('uploads/original/products/'. $local_image);
                                    if(substr($doc, 0, 5) == "<?xml")
                                    {
                                        $main_image = base_url($this->site_config->item('config_placeholder_large'));
                                    }
                                    else
                                    {
                                        $main_image = base_url('images/image.php?width=1000&height=1000&image='. $this->local_images_path . $local_image);
                                    }
                                }
                                elseif($cloud_image != '')
                                {
                                    $doc = get_image($cloud_image);
                                    $doc = trim($doc);

                                    if(substr($doc, 0, 5) == "<?xml" Or strpos($doc, '<meta') !== false)//<meta charset="utf-8">
                                    {
                                        $main_image = base_url($this->site_config->item('config_placeholder_large'));
                                    }
                                    else
                                    {
                                        $main_image = $cloud_image;
                                    }
                                }

                                if($main_image == '' Or trim($main_image) == 'N/A|N/A|N/A' )
                                {
                                    $main_image = base_url($this->site_config->item('config_placeholder_large'));
                                }
                            }

                            ?>


                            <?php //var_dump($val_img);?>
                            <a
                                    href="<?php echo $main_image ?>"
                                    class="cloud-zoom main-image"
                                    id="product-cloud-zoom"
                                    rel="showTitle: false, zoomWidth:540,zoomHeight:540, position:'inside', adjustX:0"
                            >
                                <img
                                        src="<?php echo $main_image ?>"
                                        title="<?php echo $result->product_name; ?>"
                                        alt="<?php echo $result->product_name; ?>"
                                />
                            </a>
                        </div>
                    </div>



                    <div class="additional-images owl-carousel owl-theme">

                        <?php $counter = 1; ?>
                        <?php if(!empty($result->images)): ?>
                            <?php foreach($result->images as $key_img=>$val_img) : ?>

                                <?php

                                $local_image = $result->product_id .'-'.basename($val_img);
                                if(file_exists('uploads/original/products/'. $local_image)){
                                    $small_image = base_url('images/image.php?width=100&height=100&image='. $this->local_images_path . $local_image);
                                    $big_image = base_url('images/image.php?width=1000&height=1000&image='. $this->local_images_path . $local_image);
                                }else{
                                    continue;
                                    $big_image = $small_image = $image = $images[0];
                                }

                                ?>

                                <?php $counter++; ?>
                                <div class="item">
                                    <a class="cloud-zoom-gallery sub-image" id="product-image-options-"
                                       href="<?php echo $big_image; ?>"
                                       title="<?php echo $result->product_name; ?>"
                                       rel="useZoom: 'product-cloud-zoom', smallImage: '<?php echo $big_image; ?>'"
                                       data-pos="<?php echo $counter; ?>">
                                        <img
                                                src="<?php echo $small_image; ?>"
                                                title="<?php echo $result->product_name; ?>"
                                                alt="<?php echo $result->product_name; ?>"/>
                                    </a>
                                </div>

                            <?php endforeach; ?>
                        <?php endif; ?>

                    </div>


                </div>

                <div class="col-sm-6 product-info-main">
                    <div class="row">
                        <div class="inner">

                            <h1 class="product-name"><?php echo $result->product_name; ?></h1>


                            <?php  if($result->special_price > 0): ?>
                                <div class="price-box box-special">
                                    <p class="special-price"><span class="price"><?php echo format_currency($result->special_price) ?></span></p>
                                    <p><span class="original-price"><?php echo format_currency($result->sale_price) ?></span></p>
                                </div>
                            <?php else:  ?>
                                <div class="price-box box-regular">
							<span class="regular-price">
								<span class="price"><?php echo $result->sale_price == 9999.99 ? "" :format_currency($result->sale_price) ?></span>
							</span>
                                </div>
                            <?php  endif; ?>


                            <ul class="list-unstyled">
                                <?php if($result->sale_price): ?>

                                    <?php if(isset($result->has_tax) && !empty($result->has_tax)): ?>
                                        <li><span class="ex-text">Tax <?php echo format_currency($result->tax); ?></span></li>
                                    <?php endif; ?>

                                <?php endif; ?>

                                <?php if(!empty($result->brand)): ?>
                                    <li>
                                        Brand: <a href="<?php echo href_brand($result->brand)?>"><?php echo $result->brand->name; ?></a>
                                    </li>
                                <?php endif;?>

                                <li>Model: <span><?php echo $result->part_number; ?></span></li>

                                <?php if(!empty($result->price)): ?>
                                    <li>Availability: <span>In Stock</span></li>
                                <?php endif;?>
                            </ul>


                            <div id="product">
                                <div class="form-group">
                                    <?php if($result->sale_price != 9999.99): ?>
                                        <label class="control-label" for="input-quantity">Qty</label>
                                        <input type="text" name="quantity" value="1" size="2" id="input-quantity" class="form-control">
                                        <input type="hidden" name="product_id" value="<?php echo $result->product_id; ?>">
                                        <button type="button" id="button-cart" data-loading-text="Loading..." class="btn button button-cart" title="Add to Cart">Add to Cart</button>
                                    <?php else: ?>
                                        <button type="button" id="button-call-for-price" data-loading-text="Loading..." class="btn button button-call-for-price" title="Call 800-999-DRAG For Price & Availability">Call 800-999-DRAG For Price & Availability</button>
                                    <?php endif; ?>

                                    <button type="button" class="btn btn-default button btn-wishlist" title="Add to Wish List" onclick="wishlist.add('<?php echo $result->product_id; ?>');">Add to Wish List</button>
                                    <!--<button type="button" class="btn btn-default button btn-compare" title="Compare this Product" onclick="compare.add('54');">Compare this Product</button>-->
                                </div>
                                <div class="product-info-detailed">
                                    <ul class="nav nav-tabs">
                                        <li class="active"><a href="#tab-description" data-toggle="tab">Description</a></li>
                                        <li><a href="#tab-specification" data-toggle="tab">Specifications</a></li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab-description"><p>
                                            <p><?php echo $result->long_description; ?></p>
                                        </div>
                                        <div class="tab-pane" id="tab-specification">
                                            <table class="table table-bordered table-striped">
                                                <?php /*?><?php if(!empty($result->distributor_name)): ?>
                                            <tr><td>Distributor Name</td><td><?php echo $result->distributor_name; ?></td></tr>
                                            <?php endif; ?><?php */?>
                                                <?php if(!empty($result->brand_name) and $result->brand_name != -9999): ?>
                                                    <tr><td>Brand Name</td><td><?php echo $result->brand_name; ?></td></tr>
                                                <?php endif; ?>
                                                <?php /*?><?php if(!empty($result->category_name)): ?>
                                            <tr><td>Category Name</td><td><?php echo $result->category_name; ?></td></tr>
                                            <?php endif; ?><?php */?>
                                                <?php if(!empty($result->diameter) and $result->diameter != -9999): ?>
                                                    <tr><td>Diameter</td><td><?php echo $result->diameter; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->back_space) and $result->back_space != -9999): ?>
                                                    <tr><td>Back space</td><td><?php echo $result->back_space; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->max_load) and $result->max_load != -9999): ?>
                                                    <tr><td>Max load</td><td><?php echo $result->max_load; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->maximum_rim_width) and $result->maximum_rim_width != -9999): ?>
                                                    <tr><td>Maximum rim width</td><td><?php echo $result->maximum_rim_width; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->max_dual_imperial_load) and $result->max_dual_imperial_load != -9999): ?>
                                                    <tr><td>Max dual imperial load</td><td><?php echo $result->max_dual_imperial_load; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->maximum_inflate_load) and $result->maximum_inflate_load != -9999): ?>
                                                    <tr><td>Maximum inflate load</td><td><?php echo $result->maximum_inflate_load; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->stamped_max_single_inflate) and $result->stamped_max_single_inflate != -9999): ?>
                                                    <tr><td>Stamped max single inflate</td><td><?php echo $result->stamped_max_single_inflate; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->max_offset) and $result->max_offset != -9999): ?>
                                                    <tr><td>Max offset</td><td><?php echo $result->max_offset; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->min_offset) and $result->min_offset != -9999): ?>
                                                    <tr><td>Min offset</td><td><?php echo $result->min_offset; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->product_availability_date) and $result->product_availability_date != -9999): ?>
                                                    <tr><td>Product availability date</td><td><?php echo $result->product_availability_date; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->product_availability_date) and $result->product_availability_date != -9999): ?>
                                                    <tr><td>Product availability date</td><td><?php echo $result->product_availability_date; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->height) and $result->height != -9999): ?>
                                                    <tr><td>Height</td><td><?php echo $result->height; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->length) and $result->length != -9999): ?>
                                                    <tr><td>Length</td><td><?php echo $result->length; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->width) and $result->width != -9999): ?>
                                                    <tr><td>Width</td><td><?php echo $result->width; ?></td></tr>
                                                <?php endif; ?>
                                                <?php /*?><?php if(!empty($result->unit_of_meas)): ?>
                                            <tr><td>Unit of meas</td><td><?php echo $result->unit_of_meas; ?></td></tr>
                                            <?php endif; ?><?php */?>
                                                <?php if(!empty($result->weight) and $result->weight != -9999): ?>
                                                    <tr><td>Weight</td><td><?php echo $result->weight; ?></td></tr>
                                                <?php endif; ?>
                                                <?php /*?><?php if(!empty($result->weight_unit)): ?>
                                            <tr><td>Weight unit</td><td><?php echo $result->weight_unit; ?></td></tr>
                                            <?php endif; ?><?php */?>
                                                <?php if(!empty($result->size) and $result->size != -9999): ?>
                                                    <tr><td>Size</td><td><?php echo $result->size; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->offset) and $result->offset != -9999): ?>
                                                    <tr><td>Offset</td><td><?php echo $result->offset; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->load_rating_lbs) and $result->load_rating_lbs != -9999): ?>
                                                    <tr><td>Load rating lbs</td><td><?php echo $result->load_rating_lbs; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->load_rating_kgs) and $result->load_rating_kgs != -9999): ?>
                                                    <tr><td>Load rating kgs</td><td><?php echo $result->load_rating_kgs; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->load_rating_kgs) and $result->load_rating_kgs != -9999): ?>
                                                    <tr><td>Load rating kgs</td><td><?php echo $result->load_rating_kgs; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->upc) and $result->upc != -9999): ?>
                                                    <tr><td>Upc</td><td><?php echo $result->upc; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->center_cap_part_number) and $result->center_cap_part_number != -9999): ?>
                                                    <tr><td>Center cap part number</td><td><?php echo $result->center_cap_part_number; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->cap_hardware) and $result->cap_hardware != -9999): ?>
                                                    <tr><td>Cap hardware</td><td><?php echo $result->cap_hardware; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->qty_of_cap_screws) and $result->qty_of_cap_screws != -9999): ?>
                                                    <tr><td>Qty of cap screws</td><td><?php echo $result->qty_of_cap_screws; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->cap_wrench) and $result->cap_wrench != -9999): ?>
                                                    <tr><td>Cap wrench</td><td><?php echo $result->cap_wrench; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->cap_style) and $result->cap_style != -9999): ?>
                                                    <tr><td>Cap style</td><td><?php echo $result->cap_style; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->cap_length) and $result->cap_length != -9999): ?>
                                                    <tr><td>Cap length</td><td><?php echo $result->cap_length; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->cap_assembly) and $result->cap_assembly != -9999): ?>
                                                    <tr><td>Cap assembly</td><td><?php echo $result->cap_assembly; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->display_model_number) and $result->display_model_number != -9999): ?>
                                                    <tr><td>Display model number</td><td><?php echo $result->display_model_number; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->country_of_origin) and $result->country_of_origin != -9999): ?>
                                                    <tr><td>Country of origin</td><td><?php echo $result->country_of_origin; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->bolt_pattern) and $result->bolt_pattern != -9999): ?>
                                                    <tr><td>Bolt_pattern</td><td><?php echo $result->bolt_pattern; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->center_bore) and $result->center_bore != -9999): ?>
                                                    <tr><td>Center bore</td><td><?php echo $result->center_bore; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->warranty) and $result->warranty != -9999): ?>
                                                    <tr><td>Warranty</td><td><?php echo $result->warranty; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->style) and $result->style != -9999): ?>
                                                    <tr><td>Style</td><td><?php echo $result->style; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->finish) and $result->finish != -9999): ?>
                                                    <tr><td>Finish</td><td><?php echo $result->finish; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->series) and $result->series != -9999): ?>
                                                    <tr><td>Series</td><td><?php echo $result->series; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->sidewall) and $result->sidewall != -9999): ?>
                                                    <tr><td>Sidewall</td><td><?php echo $result->sidewall; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->tread_depth) and $result->tread_depth != -9999): ?>
                                                    <tr><td>Tread depth</td><td><?php echo $result->tread_depth; ?></td></tr>
                                                <?php endif; ?>
                                                <?php if(!empty($result->type) and $result->type != -9999): ?>
                                                    <tr><td>Type</td><td><?php echo $result->type; ?></td></tr>
                                                <?php endif; ?>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="policy-block policy-block-2 hidden">
                                <div class="inner">
                                    <div class="col ">
                                        <div class="box">

                                            <div class="text">
                                                <p>Free Shipping</p>
                                                <p>Ships Today</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col ">
                                        <div class="box">

                                            <div class="text">
                                                <p>Easy</p>
                                                <p>Returns</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col ">
                                        <div class="box">

                                            <div class="text">
                                                <p>Lowest Price</p>
                                                <p>Guarantee</p>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php include('inc.product-detail-shipping-banner.php');?>
                        <div class="row">
                            <div class="col-sm-12">
                                <!-- AddThis Button BEGIN -->
                                <div class="addthis_toolbox addthis_default_style" data-url="<?php echo href_product($result)?>"><a class="addthis_button_facebook_like" fb:like:layout="button_count"></a> <a class="addthis_button_tweet"></a> <a class="addthis_button_pinterest_pinit"></a> <a class="addthis_counter addthis_pill_style"></a></div>
                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-515eeaf54693130e"></script>
                                <!-- AddThis Button END -->
                            </div>
                        </div>




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="main-row">
    <div class="container">

        <div class="row">
            <div class="col-md-12">

                <div><strong>CALIFORNIA RESIDENTS</strong></div>
                <div><img alt="prop 65 warning" src="assets/img/p65_warning.png" /><strong>WARNING:</strong> This product can expose you to Lead, which is known to the State of California to cause cancer, birth defects, or other reproductive harm. For more information go to <a href="http://www.p65warnings.ca.gov" target="_blank">www.p65warnings.ca.gov</a>.</div>

            </div>
        </div>
    </div>
</div>



<?php if(!empty($related_products)): ?>
    <?php include('inc.product-detail-related-products.php');?>
<?php endif; ?>






<script type="text/javascript">

    $(document).ready(function(){
        <?php /*?>$('body').addClass('product-details');
	$('.related-container').owlCarousel({
		nav: true,
		dots: false,
		navSpeed: 1000,
		margin: 0,
		responsive:{
			0:{
				items: 1,
				nav: false
			},
			480:{
				items: 2,
				nav: false
			},
			768:{
				items: 2
			},
			992:{
				items: 3
			},
			1200:{
				items: 4
			}
		},
		onInitialized: function() {
			owlAction();
		},
		onTranslated: function() {
			owlAction();
		}
	});

	function owlAction() {
		$(".related-container .owl-item").removeClass('first');
		$(".related-container .owl-item").removeClass('last');
		$(".related-container .owl-item").removeClass('before-active');
		$(".related-container .owl-item.active:first").addClass('first');
		$(".related-container .owl-item.active:last").addClass('last');
		$('.related-container .owl-item.active:first').prev().addClass('before-active');
	}<?php */?>
    });

</script>


<script>

    $('#button-cart').click(function () {
        var product_id 	= $('input[name="product_id"]').val();
        var quantity 	= $('input[name="quantity"]').val();
        //console.log(product_id);
        //console.log(quantity);
        cart.add(product_id,quantity);
    });
</script>
<script>
    // Cart add remove functions
    var cart = {
        'add': function(product_id, quantity) {
            $.ajax({
                url: 'checkout/add-to-cart.html',
                type: 'post',
                data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
                dataType: 'json',
                beforeSend: function() {
                    $('#cart > button').button('loading');
                },
                complete: function() {
                    $('#cart > button').button('reset');
                },
                success: function(json) {
                    $('.alert-dismissible, .text-danger').remove();
                    if (json['redirect']) {
                        location = json['redirect'];
                        return false;
                    }
                    if (json['result'] == true) {
                        $('#content').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                        setTimeout(function() {
                            //$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
                        }, 100);
                        $('html, body').animate({
                            scrollTop: 0
                        }, 'slow');
                        //$('#cart > ul').load('index.php?route=common/cart/info ul li');
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    }
</script>
