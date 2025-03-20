<?php
function filterBrandsByFirstLetter($brands, $letter) {
    return array_filter($brands, function ($brand) use ($letter) {
        return stripos($brand['name'], $letter) === 0;
    });
}
?>
<!-- page-title -->
        <div class="tf-page-title style-2">
            <div class="container-full">
                <div class="heading text-center">Brands</div>
            </div>
        </div>
        <!-- /page-title -->
        <!-- filter -->
        <section class="flat-spacing-1">
            <div class="container">
                <div class="tf-brands-filter">
                    <button class="tf-btns-filter tf-tab-link tf-tab-link_all is--active" id="all">
                        <span>Show all</span>
                    </button>
                    <?php
                    $all = range('A', 'Z');
                            foreach($all as $k=> $char) {
	                    	?>
	                    	<button class="tf-btns-filter tf-tab-link <?= (!in_array($char,$fbrands)?'is-disable':'') ?>" id="tf_filter_<?= $char ?>">
		                        <span><?= $char ?></span>
		                    </button>

	                    	<?php

                    }

                    ?>
                    
                </div>
                <div id="parent" class="tf-brands-source-linklist style-row">
                    <?php
                    foreach($all as $k=> $char) {
                    		$b = filterBrandsByFirstLetter($brands, $char);
                    		if($b)
                    		{
                    			?>
                    <div class="tf_filter_<?= $char ?> tf-filter-item tf-tab-content">
                        <div class="tf-filter-item-inner">
                            <div class="tf-titles-filter">
                                <h4 class="tf-font-normal"><?= $char ?></h4>
                            </div>
                            <div class="tf-content-brands">
                            	<?php
                            		foreach($b as $k=> $v)
                            		{
                            			?>
                            			<div class="tf-item-inner">
                                    <a href="<?php echo base_url(); ?>catalog.html?brand_id=<?php echo $v['brand_id']; ?>">
                                    	<?php
                                    	if($v['images'])
                                    	{
                                    		?>

                                        <img src="<?= base_url().'images/image.php?width=400&height=400&image=/images/brands/thumbnails/'.$v['images']; ?>" alt="">
                                        <?php
                                    	}

                                    	?>
                                    </a>
                                    <a href="<?php echo base_url(); ?>catalog.html?brand_id=<?php echo $v['brand_id']; ?>"><?= $v['name'] ?></a>
                                </div>

                            			<?php
                            		}
                            	?>
                            </div>
                        </div>
                    </div>
                    <?php
                    		}
                    		else
                    		{
                    			?>
                    			<div class="tf_filter_<?= $char ?> tf-filter-item tf-tab-content is-disable">
                        <div class="tf-filter-item-inner">
                            <div class="tf-titles-filter">
                                <h4 class="tf-font-normal"><?= $char ?></h4>
                            </div>
                            <div class="tf-content-brands"></div>
                        </div>
                    </div>
                    			<?php
                    		}
	                    	?>
                    <?php
                	}
                    ?>
                    
                </div>
            </div>
        </section>
        <!-- /filter -->