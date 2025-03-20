<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php // include APPPATH.'/third_party/ImageResizer/image.php'; ?>
<style>
.pagination i{ display:none;}
.thumb.category-image {
	height: 150px;
	background-size: cover;
	background-repeat: no-repeat;
}
.image.rotate-image-container {
	padding: 15px;
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
        <div id="content" class="col-md-12 col-sm-12">
			<h1><?php echo $page_header ?></h1>
            <div class="custom-category">
                <?php if(!empty($products)) : ?>
                    <div class="row">
                        <?php $counter = 0; ?>
                        <?php foreach($products as $key=>$val) : ?>
                            <div class="product-layout product-grid col-xs-3 product-item">
                                <div class="product-thumb">
									<div class="item item<?php echo $counter; ?>">
										<div class="item-inner">
											<div class="caption-top">
                                                <div class="caption-top-top-bar">
                                                    <p class="part-number" >Part Number: <?php echo $val->part_number; ?></p>
                                                    <?php if($val->size): ?>
                                                        <p class="size">Size: <?php echo $val->size; ?></p>
                                                    <?php endif; ?>
                                                </div>

                                                <p class="text-available">availabe: <span>97 in stock</span></p>
												<p class="manufacture-product">
                                                    <a href="<?php echo href_brand($val->brand); ?>"><?php echo !empty($val->brand->name) ? $val->brand->name :''; ?></a>
												</p>
                                                <div class="price-box" style="min-height: <?php echo $val->sale_price != 9999.99 ? "auto": "25px"; ?>"><?php //echo $val->product_id; ?>
													<?php if($val->sale_price != 9999.99): ?>
                                                    <?php if($val->special_price > 0): ?>
                                                        <p class="special-price"><span class="price"><?php echo format_currency($val->special_price); ?></span></p>
                                                        <p class="old-price"><span class="price"><?php echo format_currency($val->sale_price); ?></span></p>
                                                    <?php else : ?>
                                                        <p class="regular-price"><span class="price"><?php echo format_currency($val->sale_price); ?></span></p>
                                                <?php endif;?>
													<?php endif; ?>

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

                                                            <div class="image rotate-image-container">
                                                                <a href="<?php echo href_product($val)?>">

                                                                    <?php
                                                                    $imgClass = 'img-responsive';
                                                                    echo create_product_image_html($val , $imgClass);
                                                                    ?>

                                                                 </a>
                                                            </div>
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
                                                    <?php if($val->size): ?>
                                                        <p class="product-des"><?php echo $val->size; ?></p>
                                                <?php endif; ?>
                                                    <p class="product-des"><?php //echo $val->long_description; ?></p>
													</div>
												<?php if($val->sale_price != 9999.99): ?>
                                                <button type="button" class="button btn-cart btn-block" title="Add to Cart" onclick="cart.add('<?php echo $val->product_id; ?>', '1');"><span>Add to Cart</span></button>
												<?php else: ?>
													<button type="button" style="line-height: 24px;" class="button btn-cart btn-block" title="Call 800-999-DRAG For Price & Availability" onclick="javascript:void(0);"><span>Call 800-999-DRAG For Price & Availability</span></button>
												<?php endif; ?>
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
                
                
                <?php if(empty($products)) : ?>
                    <p>There are no Deals to list.</p>
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

