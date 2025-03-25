<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.pagination i{ display:none;}
ul.list-cate li {
	display: inline-block;
	background: #fed54c;
	margin: 5px;
	min-width: 230px;
	border-left: solid #000 10px;
	border-radius: 10px 0px 10px 0px;
	border-top: solid 2px #000;
	border-bottom: solid 2px #000;
	border-right: solid #000 10px;
}

ul.list-cate li a{
	padding: 10px;
}

ul.list-cate li:hover{
	-webkit-transition: ease-in-out all .3s;
	-moz-transition: ease-in-out all .3s;
	transition: ease-in-out all .3s;

	background: #000;
	border-left: solid #ffd54c 10px;
	border-top: solid 2px #ffd54c;
	border-bottom: solid 2px #ffd54c;
	border-right: solid #ffd54c 10px;

}

ul.list-cate li:hover + a{
	color: #ffd54c;
}
</style>

<div id="product-category" class="container layer-category">
    
    <div class="layered-navigation-block"></div>
    
    <div class="search-ajax">
		<div class="ajax-loader-container" style="display: none;">
            <div class="ajax-loader">
                <img src="<?php echo site_url('assets/img/catalog/AjaxLoader.gif'); ?>" alt="" />
            </div>
		</div>
	</div>
    
    <ul class="breadcrumb">
		<li><a href="#">Search Results</a></li>
    </ul>
    
    <div class="row">
    	
    	<div class="col-order">
        
        <?php include('inc.menu-category.php'); ?>
        
        <div id="content" class="col-md-9 col-sm-12">
        	
        	<?php if(!empty($q)) : ?>
			<h2>Search Results for <span style="color: #ffd54c; border-bottom: 3px solid #000;"><?php echo $q; ?></span></h2>
            <?php endif; ?>
            
            <div class="custom-category">
                <?php if(!empty($result->products)) : ?>
					
                    <?php /*?><div><a href="" id="compare-total" >Product Compare (0)</a></div><?php */?>
                    
                    <?php //include('inc.toolbar.php'); ?>
                    
                    
                    <div class="row">
                        <?php $counter = 0; ?>
                        <?php foreach($result->products as $key=>$val) : ?>
                        <?php $counter++; ?>
                        
                            <div class="product-layout product-grid col-xs-4 product-item">
                            
                                <div class="product-thumb">
									<div class="item item<?php echo $counter; ?>">
										<div class="item-inner">
											<div class="caption-top">
                                            	
                                                <p class="text-available">availabe: <span>9999 in stock</span></p>
												<h4 class="product-name"><a href="<?php echo href_product($val)?>"><?php echo $val->product_name; ?></a></h4>
                                                
                                                <?php if(!empty($val->brand)): ?>
												<p class="manufacture-product">
													<a href="<?php echo href_brand($val->brand)?>"><?php echo $val->brand->name; ?></a>
												</p>
                                                <?php endif;?>
                                                
												 
											</div>
											<div class="image images-container">
												<div class="inner">
												
                                                <div class="box-label">	
													<?php if(!empty($val->is_new)): ?>
														<div class="label-product label_new"><span>New</span></div>
													<?php endif; ?>
                                                    
													<?php if(!empty($val->is_special)): ?>
														<div class="label-product label_sale"><span> -<?php echo $val->rate_special ?>%</span></div>
													<?php endif; ?>
												</div>
												
                                                
                                                <?php if( !empty($val->image) and $val->image != '-'): ?>
                                                <div class="image rotate-image-container">
                                                    <a href="<?php echo href_product($val)?>">
                                                        <?php
                                                        $imgClass = 'img-responsive img-default-image';
                                                        echo create_product_image_html($val , $imgClass);
                                                        ?>
                                                    </a>
                                                </div>
												<?php else: ?>
													<div class="image rotate-image-container">
														<a href="<?php echo href_product($val)?>">
															<img src="<?php echo base_url($this->site_config->item('config_placeholder')) ?>" title="<?php echo $val->product_name; ?>" alt="" class="img-responsive img-default-image" />
														</a>
													</div>
                                                <?php endif;?>
                                                
                                                

                                                    
												
												<div class="button-group action-links">
													<!--<button type="button" class="button btn-quickview" title="Quick View" onclick="ocquickview.ajaxView('<?php /*echo href_product($val); */?>')"><span>Quick View</span></button>-->
                                                    <button type="button"  class="button btn-wishlist" title="Add to Wish List" onclick="wishlist.add('<?php echo $val->product_id; ?>');"><span>Add to Wish List</span></button>
                                                    <!--<button type="button"  class="button btn-compare" title="Compare this Product" onclick="compare.add('<?php /*echo $val->product_id; */?>');"><span>Compare this Product</span></button>-->
												</div>
												
												
												</div>
											</div>
                                            
											<div class="caption">
												<div class="inner">
												
												
												<div class="ratings">
													<div class="rating-box">
                                                    	<div class="rating3">rating</div>
													</div>
												</div>
                                                
                                                <?php if(!empty($val->descriptions)): ?>
												
                                                <?php foreach($val->descriptions as $key_desc=>$val_desc) : ?>
                                                	<p class="product-des"><label><?php echo $val_desc->type; ?></label><?php echo $val_desc->description; ?></p>
                                                <?php endforeach; ?>
                                                <?php endif; ?>
                                                
                                                <?php if(!empty($val->description)): ?>
                                                	<p class="product-des"><label>Product Description - Extended</label><?php echo $val->description; ?></p>
                                                <?php endif; ?>
                                                
                                                
                                                <?php if(!empty($val->part_description)): ?>
                                                	<p class="product-des"><label>Product Description</label><?php echo $val->part_description; ?></p>
                                                <?php endif; ?>
                                                <p class="product-des"><?php echo $val->part_number; ?></p>
                                                <?php if($val->size): ?>
                                                    <p class="product-des"><?php echo $val->size; ?></p>
                                                <?php endif; ?>
                                                
                                                
												
                                                <?php /*?><div class="price-box"><?php //echo 'P = '.$val->special_price; ?>
													<?php if($val->special_price > 0): ?>
														<p class="special-price"><span class="price"><?php echo format_currency($val->special_price); ?></span></p>
														<p class="old-price"><span class="price"><?php echo format_currency($val->sale_price); ?></span></p>
													<?php else : ?>
														<p class="regular-price"><span class="price"><?php echo format_currency($val->sale_price); ?></span></p>
													<?php endif; ?>

													<?php if($val->has_tax): ?>
														<p class="price-tax"><span class="price">Tax <?php echo format_currency($val->tax); ?></span></p>
													<?php endif; ?>
												</div><?php */?>
                                                
                                                <div class="price-box" style="min-height: <?php echo $val->sale_price == 9999.99 ? '25px' : '25px'; ?>"><?php //echo $val->product_id; ?>
													<?php /* if($val->special_price > 0): ?>
														<p class="special-price"><span class="price"><?php echo format_currency($val->special_price); ?></span></p>
														<p class="old-price"><span class="price"><?php echo format_currency($val->sale_price); ?></span></p>
													<?php else : */ ?>
														<p class="regular-price"><span class="price"><?php echo $val->sale_price == 9999.99 ? '&nbsp;' : format_currency($val->sale_price); ?></span></p>
													<?php // endif; ?>

													<?php if($val->has_tax): ?>
														<p class="price-tax"><span class="price">Tax <?php echo format_currency($val->tax); ?></span></p>
													<?php endif; ?>
												</div>
                                                
                                                
                                                
                                                
                                                <?php if($val->sale_price != 9999.99): ?>
                                                <button type="button" class="button btn-cart" title="Add to Cart" onclick="cart.add('<?php echo $val->product_id; ?>', '1');"><span>Add to Cart</span></button>
												<?php else: ?>
													<button type="button" style="line-height: 24px;" class="button btn-cart btn-block" title="Call 800-999-DRAG For Price & Availability" onclick="javascript:void(0);"><span>Call 800-999-DRAG For Price & Availability</span></button>
												<?php endif; ?>
                                                
												
												</div>
											</div>
											
										</div>
									</div>
                                </div>
                            </div>
						
                        <?php endforeach; ?>
					</div>
                    
                    
                    
                    <div class="toolbar toolbar-products toolbar-bottom">
                    	<?php echo $this->pagination->create_links_html2();?>
                    </div>
				
				<?php endif; ?>
                
                
                <?php if(empty($result->categories) and empty($result->products)) : ?>
                    <p>There are no products to list in this category.</p>
                    <div class="buttons">
                        <div class="pull-right"><a href="<?php echo site_url();?>" class="btn btn-primary">Continue</a></div>
                    </div>
                <?php endif; ?>
                
            </div>
            
			<?php /*?> __content_bottom__ <?php */?>
            
        </div>
        <?php /*?> __column_right__ <?php */?>
    	</div>
	
	</div>

</div>




<script type="text/javascript">

$(document).ready(function(){
	
	$('.btn-edit').click(function(){
		window.location = '<?php echo site_url($this->user_url .'/'. 'edit.html?id=');?>'+$(this).data('id');
	});
	
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

	var wishlist = {
		'add': function(product_id) {
			$.ajax({
				url: "<?php echo site_url($this->user_url_prefix .'/wish-list/add.html'); ?>",
				type: 'post',
				data: 'product_id=' + product_id,
				dataType: 'json',
				beforeSend: function() {
				},
				complete: function() {
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
						}, 100);
						$('html, body').animate({
							scrollTop: 0
						}, 'slow');
					}
				},
				error: function(xhr, ajaxOptions, thrownError) {
					alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	}
</script>
