<!-- Breadcurb Area -->
<div class="breadcurb-area">
    <div class="container">
        <ul class="breadcrumb">
            <?php echo $breadcrumb;?>
        </ul>
    </div>
</div><!-- End Breadcurb Area -->
<!-- Shop Product Area -->
<div class="shop-product-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-md-12">
                <!-- Left Sidebar-->
                <?php include('inc.menu-category.php'); ?>
                <!-- End Left Sidebar -->
            </div>
            <div class="col-lg-9 col-md-12">
                <!-- Shop Product View -->
                <div class="shop-product-view">
                    <!-- Shop Category Image -->
                    <div class="shop-category-image">
<!--                        <img src="assets/images/banner/banner-grid.webp" alt="banner">-->
                    </div>
                    <!-- Shop Product Tab Area -->
                    <div class="product-tab-area">
                        <!-- Tab Bar -->
                        <div class="tab-bar">
                            <div class="tab-bar-inner">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li><a class="active" href="#shop-product" data-bs-toggle="tab"><i class="fa fa-th-large"></i></a></li>
                                    <li><a href="#shop-list" data-bs-toggle="tab"><i class="fa fa-th-list"></i></a></li>
                                </ul>
                            </div>
                            <div class="toolbar">
                                <div class="sorter">
                                    <div class="sort-by">
                                    <?php
                                    $data = array('name'=>'sort_id', 'label'=>'Sort By:', 'class'=>'dd-sort_id', );
                                    echo form_dropdown_1($data, get_sort_menu(), set_value('sort_id', $sort_id));
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Tab Bar -->
                        <!-- Tab Content -->
                        <div class="tab-content">
                            <!-- Shop Product-->
                            <div class="tab-pane active" id="shop-product">
                                <!-- Tab Single Product-->

                                <?php $counter = 1; 
                                if(isset($result->products) && !empty($result->products)){
                                    foreach($result->products as $key=>$val) 
                                    {?>
                                        <div class="tab-single-product">
                                            <!-- Single Product -->
                                            <form method="post" id="product-data1" class="product-form-data1" action="<?php echo site_url('checkout/add-to-cart.html')?>">
                                                <div class="singel-product single-product-col">
                                                    <!-- <div class="label-pro-new">New</div> -->
                                                    <!-- Single Product Image -->
                                                    <div class="single-product-img">
                                                        <a href="<?php echo href_product($val) ?>">
                                                            <?php
                                                            $imgClass = '';
                                                            echo create_product_image_html($val ,'small' , 1 ,222 ,222 ,  $imgClass);
                                                            ?>

                                                        </a>
                                                    </div> 
                                                    <!-- Single Product Content -->
                                                    <div class="single-product-content">
                                                        <h2 class="product-name"><a title="<?php echo $val->product_name; ?>" href="<?php echo href_product($val) ?>"><?php echo $val->product_name; ?></a></h2>
                                                        <div class="product-price">
                                                            <?php  if(!empty($val->varient_price) && $val->varient_price >0){?>
                                                                <p><?php echo format_currency($val->varient_price); ?></p>
                                                            <?php } else { 
                                                                if(!empty($val->special_price)){?>
                                                                <p><span><?php echo format_currency($val->sale_price); ?></span> <?php echo format_currency($val->special_price); ?></p>
                                                            <?php }else{?>
                                                                <p><?php echo format_currency($val->sale_price); ?></p>
                                                            <?php }}?>
                                                        </div>

                                                        <!-- Single Product Actions -->
                                                        <div class="product-actions">
                                                            <input type="hidden" name="item[product_id]" id="product_id" value="<?php echo $val->product_id; ?>" />

                                                            <!-- <button class="button btn-cart"  title="Add to Cart"  type="submit">
                                                                <i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span>
                                                            </button> -->
                                                            <a href="<?php echo href_product($val) ?>">
                                                            <button class="button btn-cart"  title="Add to Cart"  type="button">
                                                                <i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span>
                                                            </button></a>
                                                            <div class="add-to-link">
                                                                <ul class="">
                                                                    <li class="quic-view"> <button type="button" data-bs-target="#productModal-grid-<?php echo $val->product_id; ?>" data-bs-toggle="modal"><i class="fa fa-search"></i>Quick view </button></li>
                                                                    <li class="wishlist" ><button type="button" class="add-wishlist"><i class="fa fa-heart"></i></button></li>
                                                                 </ul>
                                                            </div>
                                                        </div><!-- End Single Product Actions -->
                                                    </div><!-- End Single Product Content -->
                                                </div><!-- End Single Product -->
                                            
                                            </form>
                                        </div><!-- Single Product -->
                                    <?php }
                                }else{
                                    echo'No Product Found';
                                }?>
                            </div>
                            <!-- Shop List -->
                            <div class="tab-pane" id="shop-list">
                                <!-- Single Shop -->

                                <?php
                                if(isset($result->products) && !empty($result->products)){
                                foreach($result->products as $key=>$val) { ?>
                                <form method="post" id="product-data1" class="product-form-data1" action="<?php echo site_url('checkout/add-to-cart.html')?>">
                                    <div class="single-shop single-product">
                                        <input type="hidden" name="item[product_id]" id="product_id" value="<?php echo $val->product_id; ?>" />
                                        <input hidden class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="item[quantity]">
                                        <input type="hidden" name="item[product_cur_qty]" id="product_cur_qty"  value="<?php if($val->quantity > 0){ echo $val->quantity;}else{ echo 0; } ?>">
                                        <input type="hidden" name="item[redirect]" id="redirect" value="0" />
                                        <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                                        <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                                        <input type="hidden" name="item[reload]" value="categories.html" />

                                        <div class="row">
                                            <div class="col-lg-4 col-md-4 col-sm-5">
                                                <div class="single-product-img">
                                                    <a href="<?php echo href_product($val) ?>">
                                                        <?php
                                                        $imgClass = '';
                                                        echo create_product_image_html($val ,'small' , 1 ,222 ,222 ,  $imgClass);
                                                        ?>

                                                    </a>
                                                    <div class="add-to-link">
                                                        <ul class="">
                                                            <li class="quic-view"><button data-bs-toggle="modal" data-bs-target="#productModal-list-<?php echo $val->product_id; ?>" type="button"><i class="fa fa-search"></i>Quick view</button></li>
                                                            <li class="wishlist 45" ><button type="button" class="add-wishlist"><i class="fa fa-heart"></i></button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-7">
                                                <div class="single-product-content">
                                                    <h2 class="product-name"><a href="<?php echo href_product($val) ?>" title="<?php echo $val->product_name; ?>"><?php echo $val->product_name; ?></a></h2>
                                                    <div class="product-price">
                                                        <?php if(!empty($val->special_price)){?>
                                                            <p><span><?php echo format_currency($val->sale_price); ?></span> <?php echo format_currency($val->special_price); ?></p>
                                                        <?php }else{?>
                                                            <p><?php echo format_currency($val->sale_price); ?></p>
                                                        <?php } ?>
                                                    </div> 
                                                    <div class="single-shop-details">
                                                        <?php echo $val->short_description; ?>
                                                    </div>
                                                    <!-- Single Product Actions -->
                                                    <div class="product-actions">
                                                        <button class="button btn-cart"  title="Add to Cart"  type="submit">
                                                            <i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span>
                                                        </button>
                                                    </div><!-- End Single Product Actions -->
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- End Single Shop -->
                                </form>
                                <?php } } ?>
                            </div><!-- End Shop List -->
                        </div><!-- End Tab Content -->
                        <?php if($this->pagination->create_links_html2()):?>
                        <!-- Tab Bar -->
                        <div class="tab-bar tab-bar-bottom mb-3">
                            <div class="toolbar"> 
                                <?php echo $this->pagination->create_links_html2();?>
                            </div>
                        </div><!-- End Tab Bar -->
                        <?php endif;?>
                    </div><!-- End Shop Product Tab Area -->
                </div><!-- End Shop Product View -->
            </div>
        </div>
    </div>
</div><!-- End Shop Product Area -->


<?php
if(isset($result->products) && !empty($result->products)){
foreach($result->products as $key=>$val) { ?>
    <div id="quickview-wrapper">
        <div class="modal fade productModaal" id="productModal-grid-<?php echo $val->product_id; ?>">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form method="post" id="product-data1" class="product-form-data1" action="<?php echo site_url('checkout/add-to-cart.html')?>">
                    <div class="modal-body">
                        <input type="hidden" name="item[product_id]" id="product_id" value="<?php echo $val->product_id; ?>" />
                        <input hidden class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="item[quantity]">
                        <input type="hidden" name="item[product_cur_qty]" id="product_cur_qty"  value="<?php if($val->quantity > 0){ echo $val->quantity;}else{ echo 0; } ?>">
                        <input type="hidden" name="item[redirect]" id="redirect" value="0" />
                        <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                        <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                        <input type="hidden" name="item[reload]" value="categories.html" />

                        <div class="modal-product">
                            <div class="product-images">
                                <div class="main-image images">
                                    <a href="<?php echo href_product($val) ?>">
                                        <?php
                                        $imgClass = '';
                                        echo create_product_image_html($val , 'medium' , 1,310 , 310 ,$imgClass);
                                        ?>

                                    </a>
                                </div>
                            </div><!-- End product-images -->
                            <div class="product-info">
                                <h1><?php echo $val->product_name; ?></h1>
                                <?php if($val->quantity > 0) {?>
                                    <p class="availability in-stock" id="yesVariant">Availability: <span>In stock</span></p>
                                <?php }else{ ?>
                                    <p class="availability in-stock" id="yesVariant">Availability: <span>Out of stock</span></p>
                                <?php } ?>

                                <div class="quick-desc">
                                    <?php echo $val->short_description; ?>
                                </div>
                                <div class="price-box">
                                    <?php  if(!empty($val->varient_price) && $val->varient_price >0){?>
                                        <p><?php echo format_currency($val->varient_price); ?></p>
                                    <?php } else { if(!empty($val->special_price)){?>
                                        <p><span><?php echo format_currency($val->sale_price); ?></span> <?php echo format_currency($val->special_price); ?></p>
                                    <?php }else{?>
                                        <p><?php echo format_currency($val->sale_price); ?></p>
                                    <?php } }?>
                                </div>
                                <div class="quick-add-to-cart">
                                    <div class="product-actions">
                                        <button class="button btn-cart"  title="Add to Cart"  type="submit">
                                                <i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span>
                                        </button>
                                    </div>
                                </div>
                                <div class="social-sharing" hidden>
                                    <div class="widget widget_socialsharing_widget">
                                        <h3 class="widget-title-modal">Share this product</h3>
                                        <ul class="social-icons">
                                            <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fa fa-facebook"></i></a></li>
                                            <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fa fa-twitter"></i></a></li>
                                            <!-- <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fa fa-pinterest"></i></a></li> -->
                                            <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fa fa-google-plus"></i></a></li>
                                            <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fa fa-linkedin"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div><!-- End product-info -->
                        </div><!-- End modal-product -->
                    </div><!-- End modal-body -->
                    </form>
                </div><!-- End modal-content -->
            </div><!-- End modal-dialog -->
        </div><!-- End Modal -->
    </div>
<?php } } ?>


<?php
if(isset($result->products) && !empty($result->products)){
    foreach($result->products as $key=>$val) { ?>
        <div id="quickview-wrapper">
            <div class="modal fade productModaal" id="productModal-list-<?php echo $val->product_id; ?>">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <form method="post" id="product-data1" class="product-form-data1" action="<?php echo site_url('checkout/add-to-cart.html')?>">
                        <div class="modal-body">
                            <input type="hidden" name="item[product_id]" id="product_id" value="<?php echo $val->product_id; ?>" />
                            <input hidden class="input-text qty" title="Qty" value="1" maxlength="12" id="qty" name="item[quantity]">
                            <input type="hidden" name="item[product_cur_qty]" id="product_cur_qty"  value="<?php if($val->quantity > 0){ echo $val->quantity;}else{ echo 0; } ?>">
                            <input type="hidden" name="item[redirect]" id="redirect" value="0" />
                            <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                            <input type="hidden" name="item[is_variation]" id="is_variation" value="0" />
                            <input type="hidden" name="item[reload]" value="categories.html" />

                            <div class="modal-product">
                                <div class="product-images">
                                    <div class="main-image images">
                                        <a href="<?php echo href_product($val) ?>">
                                            <?php
                                            $imgClass = '';
                                            echo create_product_image_html($val , 'medium' , 1,310 , 310 ,$imgClass);
                                            ?>

                                        </a>
                                    </div>
                                </div><!-- End product-images -->
                                <div class="product-info">
                                    <h1><?php echo $val->product_name; ?></h1>
                                    <?php if($val->quantity > 0) {?>
                                        <p class="availability in-stock" id="yesVariant">Availability: <span>In stock</span></p>
                                    <?php }else{ ?>
                                        <p class="availability in-stock" id="yesVariant">Availability: <span>Out of stock</span></p>
                                    <?php } ?>

                                    <div class="quick-desc">
                                        <?php echo $val->short_description; ?>
                                    </div>
                                    <div class="price-box">
                                        <?php  if(!empty($val->varient_price) && $val->varient_price >0){?>
                                            <p><?php echo format_currency($val->varient_price); ?></p>
                                        <?php } else { if(!empty($val->special_price)){?>
                                            <p><span><?php echo format_currency($val->sale_price); ?></span> <?php echo format_currency($val->special_price); ?></p>
                                        <?php }else{?>
                                            <p><?php echo format_currency($val->sale_price); ?></p>
                                        <?php } }?>
                                    </div>
                                    <div class="quick-add-to-cart">
                                        <form method="post" class="cart">
                                            <div class="product-actions">
                                                <button class="button btn-cart"  title="Add to Cart"  type="submit">
                                                    <i class="fa fa-shopping-cart">&nbsp;</i><span>Add to Cart</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="social-sharing" hidden>
                                        <div class="widget widget_socialsharing_widget">
                                            <h3 class="widget-title-modal">Share this product</h3>
                                            <ul class="social-icons">
                                                <li><a target="_blank" title="Facebook" href="#" class="facebook social-icon"><i class="fa fa-facebook"></i></a></li>
                                                <li><a target="_blank" title="Twitter" href="#" class="twitter social-icon"><i class="fa fa-twitter"></i></a></li>
                                                <!-- <li><a target="_blank" title="Pinterest" href="#" class="pinterest social-icon"><i class="fa fa-pinterest"></i></a></li> -->
                                                <li><a target="_blank" title="Google +" href="#" class="gplus social-icon"><i class="fa fa-google-plus"></i></a></li>
                                                <li><a target="_blank" title="LinkedIn" href="#" class="linkedin social-icon"><i class="fa fa-linkedin"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div><!-- End product-info -->
                            </div><!-- End modal-product -->
                        </div><!-- End modal-body -->
                        </form>
                    </div><!-- End modal-content -->
                </div><!-- End modal-dialog -->
            </div><!-- End Modal -->
        </div>
<?php } } ?>


<script type="text/javascript">
    $(document).ready(function(){
        $('.dd-sort_id').on('change', function(){
            var dis = $(this),
                sort = dis.find(':selected').data('sort'),
                order = dis.find(':selected').data('order'),
                sort = (typeof sort == 'undefined' ? '' : sort),
                order = (typeof order == 'undefined' ? '' : order),
                <?php if( isset($category_id)) { ?>
                inpts = 'order='+order+'&sort='+sort+'&code=<?php echo $code; ?>'+'&category_id=<?php echo $category_id; ?>';
                <?php } ?>
                //inpts = 'order='+order+'&sort='+sort;

            url = '<?php echo site_url($this->user_url . '/catalog.html'); ?>';
            //url =  window.location.href;

            url = url + ((url.indexOf('?') !== -1) ? '&' : '?') + inpts;
            //alert(url);return false;
            window.location = url;
        });

    });
</script>
