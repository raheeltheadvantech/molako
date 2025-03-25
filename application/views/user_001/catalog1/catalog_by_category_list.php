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
.p-5 {
	padding: 5px;
}
.brand-info {
	display: block;
	border: 1px solid #ccc;
	border-radius: 5px;
	padding: 15px;
	margin: 10px 0px;
	min-height: 160px;
	text-align: center;
}
.brand-info img{
	margin: 0 auto;
}
.brand-logo-wrapper {
	height: 75px;
}
.brand-info:hover {
	border-color: #fed54c;
}
@media screen and (max-width: 600px) {
	.thumb.category-image {
		display: none;
	}

	#top-shipping-banner{
		display: none;
	}

	.breadcrumb{
		padding: 0px;
	}

	.category-name{
		margin: 0;
		padding: 0;
	}

	.has-thumb{
		margin: 0;
	}
}

@media screen and (min-width: 641px) {
	.thumb.category-image {

	}
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
    
    <div class="row">
    	
    	<div class="col-order">
        
        <?php include('inc.menu-category.php'); ?>
        
        <div id="content" class="col-md-9 col-sm-12">
        	
			<?php //('inc.filters.php'); ?>
            
            <div class="row">
                <div class="col-sm-3">
            	<?php
				$cat_img = false;
				if(!empty($result->category->images)):
					$images = json_decode($result->category->images, TRUE);
					list($item1, $image) = each($images);
					$cat_img = !empty($image['filename']) ? $image['filename'] : '';
				endif;
				?>
			<?php if($cat_img) : ?>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="has-thumb">
                            <div class="thumb category-image"><img src="<?php echo site_url('images/categories/large/'.$cat_img);?>" alt="" title="" class="img-responsive" /></div>
                            <h1 class="category-name"><?php echo $result->category->name; ?></h1>
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <?php if(!empty($result->category->description)) : ?>
                            <div class="description"><?php echo $result->category->description; ?></div>
                        <?php endif; ?>
                    </div>
				</div>
			<?php else : ?>
                	<div class="col-sm-12">
                        <h1 class="category-name"><?php //echo $result->category->name; ?></h1>
                    <?php if(!empty($result->category->description)) : ?>
                        <div class="description"><?php echo $result->category->description; ?></div>
                    <?php endif; ?>
                    </div>
			<?php endif; ?>
                </div>
			<?php include('inc.top-shipping-banner.php'); ?>
            </div>
			<div class="row">
				<?php foreach ($result->brands as $brand): ?>
					<?php
					$cat_img = false;
					if(!empty($brand->images)):
						$images = json_decode($brand->images, TRUE);
						list($item1, $image) = each($images);
						$cat_img = !empty($image['filename']) ? $image['filename'] : '';
					endif;
					?>
					<div class="col-sm-4">
						<a href="<?php echo href_brand($brand).'&ref_cat_id='. $category_id; ?>">
							<div class="brand-info">
								<div class="brand-logo-wrapper">
									<div class="brand-logo">
										<img src="<?php echo site_url('images/brands/full/'.$cat_img);?>" class="img-responsive" alt="<?php echo $brand->name; ?>" width="180">
									</div>
								</div>
								<div class="brand-description-wrapper">
									<h3 class="brand-title"><?php echo $brand->name ?></h3>
									<p class="brand-description"></p>
								</div>
							</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
            
            
            
            <?php if(!empty($result->categories)) : ?>
                <h3 class="text-refine">Refine Search</h3>
                <div class="row">
                    <div class="col-sm-12">
                        <ul class="list-cate">
                            <?php foreach($result->categories as $key=>$val) : ?>
                                <li><a href="<?php echo href_category($val); ?>"><?php echo $val->name; ?></a></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
			
            <?php if(!empty($bestseller_products)): ?>
			<?php include('brand-bestseller-module.php'); ?>
            <?php endif; ?>

            <div class="custom-category" id="custom-category">

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
                                                <div class="caption-top-top-bar">
                                                    <p class="part-number" >Part Number: <?php echo $val->part_number; ?></p>

                                                </div>

												<p class="text-available">availabe: <span>97 in stock</span></p>
												<p class="manufacture-product">
													<a href="<?php echo href_brand($val->brand); ?>"><?php echo !empty($val->brand->name) ? $val->brand->name :''; ?></a>
												</p>
												<div class="price-box" style="min-height: <?php echo $val->sale_price == 9999.99 ? '25px' : '25px'; ?>"><?php //echo $val->product_id; ?>
													<?php /* if($val->special_price > 0): ?>
														<p class="special-price"><span class="price"><?php echo format_currency($val->special_price); ?></span></p>
														<p class="old-price"><span class="price"><?php echo format_currency($val->sale_price); ?></span></p>
													<?php else : */ ?>
														<p class="regular-price"><span class="price"><?php //echo $val->sale_price == 9999.99 ? '&nbsp;' : format_currency($val->sale_price); ?></span></p>
													<?php // endif; ?>

													<?php if($val->has_tax): ?>
														<p class="price-tax"><span class="price">Tax <?php echo format_currency($val->tax); ?></span></p>
													<?php endif; ?>
												</div>
											</div>
											<div class="image images-container">
												<div class="inner">
													<div class="box-label">

													</div>
													<div class="image rotate-image-container">
                                                    	<?php //echo 'IMG='.$val->image;?>
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
														</a>
													</div>
												</div>
											</div>
											<div class="caption">
												<div class="inner">
													<h4 class="product-name">
														<a href="<?php echo href_product($val)?>"><?php echo $val->product_name; ?></a>
													</h4>
													<?php if(!empty($val->brand)): ?>
														<p class="manufacture-product">
															<a href="<?php echo href_brand($val->brand)?>"><?php echo $val->brand->name; ?></a>
														</p>
													<?php endif;?>
													<div class="ratings hidden">
														<div class="rating-box">
															<div class="rating4">rating</div>
														</div>
													</div>
                                                    <p class="product-des"><?php echo $val->part_number; ?></p>

													<p class="product-des"><?php //echo $val->long_description; ?></p>
												</div>

													<button type="button" style="line-height: 24px;" class="button btn-cart btn-block" title="Call 800-999-DRAG For Price & Availability" onclick="javascript:void(0);"><span>Call 800-999-DRAG For Price & Availability</span></button>

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
		'add': function(product_id, quantity) {
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
