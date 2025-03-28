<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div class="left-sidebar">
    <div class="left-sidebar-title">
        <h2>Shop By</h2>
    </div>
    <!-- Shop Layout -->
    <div class="shop-layout">
        <div class="layout-title">
            <h2>Category</h2>
        </div>
        <div class="layout-list">
            <ul>
                <li><a href="#">Dreeses</a></li>
                <li><a href="#">Shoes</a></li>
                <li><a href="#">Handbages</a></li>
                <li><a href="#">Clothing</a></li>
            </ul>
        </div>
    </div><!-- End Shop Layout Area -->
    <!-- Price Filter -->
    <div class="price-filter-area shop-layout">
        <div class="price-filter">
            <div class="layout-title">
                <h2>Price</h2>
            </div>
            <div id="slider-range"></div>
            <p>
                <input type="text" id="amount" readonly style="border:0; color:#f6931f; font-weight:bold;">
            </p>
            <button class="btn btn-default">Filter</button>
        </div>
    </div><!-- End Price Filter Area -->
    <!-- Shop Layout -->
    <div class="shop-layout">
        <div class="layout-title">
            <h2>Manufacturer</h2>
        </div>
        <div class="layout-list">
            <ul>
                <li><a href="#">Adidas</a></li>
                <li><a href="#">Chanel</a></li>
                <li><a href="#">Dolce</a></li>
                <li><a href="#">Gabbana</a></li>
                <li><a href="#">Nike</a></li>
                <li><a href="#">Vogue</a></li>
            </ul>
        </div>
    </div><!-- End Shop Layout Area -->

    <?php if(!empty($filters)) : ?>
        <?php foreach($filters as $key => $filter_value) : ?>
        <!-- Shop Layout -->
        <div class="shop-layout filter-select by <?php echo str_replace(' ','-',strtolower($key)); ?>">
            <div class="layout-title">
                <h2><?php echo $key; ?></h2>
            </div>
            <div class="layout-list" id="filter-group<?php echo $key ?>">
                <ul>
                    <?php foreach($filter_value as $value) : ?>
                    <?php
                    $key_val = $key.'_'.$value;
                    $is_checked = (!empty($filter_ids) AND in_array($key_val, $filter_ids) ) ? 'checked="checked"': "" ?>
                    <li>
                        <a class="a-filter add-filter"  href="javascript:void(0);"><?php echo $value; ?></a>
                        <input type="checkbox" name="filter-item-checkbox[]" class="hidden" value="<?php echo $key.'_'.$value; ?>" <?php echo $is_checked ?>>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div><!-- End Shop Layout -->
        <!-- Shop Layout Banner -->
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
$(document).ready(function(){

	$('.a-filter').click(function () {

		var checkbox = $(this).parent().find('input:checkbox');
		if(checkbox.prop("checked") == true){
			checkbox.prop("checked", false);
		}else{
			checkbox.prop("checked", true);
			//checkbox.attr("checked","checked");
		}
		
		var filter_link = '';
		$('.a-filter').each(function(){
			var checkbox = $(this).parent().find('input:checkbox');
			if(checkbox.prop("checked") == true){
                // var chk_val = checkbox.val();
                // var chk = chk_val.split("_");
				// filter_link += '&'+chk[0]+'='+encodeURIComponent(chk[1]);
                filter_link += '&filter_id[]='+encodeURIComponent(checkbox.val());
			}
		});
		//alert('<?php //echo $search_url; ?>');
		//alert(filter_link);
        window.location.href = '<?php echo $filter_link; ?>' + filter_link;

	});
});
</script>

<script>
$('.list-group-item > div').each(function(){
	var item_lenght = $(this).find('.filter-item').length;
	if(item_lenght > 10){
		$(this).append('<a class="show-more" id="sm-'+ $(this).attr('id') +'" href="javascript:void(0);" data-action="show-more" data-targe-group="'+ $(this).attr('id') +'">Show More</a>');

		$('#sm-'+ $(this).attr('id')).click(function(){
			var action = $(this).attr('data-action');
			if(action == 'show-more'){
				
				$(this).parent().find('.filter-item').each(function(){
					$(this).removeClass('hidden');
				});
				
				$(this).attr('data-action','show-less');
				$(this).text('Show Less');
			
			}else{
				
				var item_loop = 0;
				$(this).parent().find('.filter-item').each(function(){
					item_loop++;
					if(item_loop > 10){
						$(this).addClass('hidden');
					}
				});
				
				$(this).attr('data-action', 'show-more');
				$(this).text('Show More');
			}
		});

		var loop_counter = 0;
		$(this).find('.filter-item').each(function(){
			loop_counter++;
			if(loop_counter > 10){
				$(this).addClass('hidden')
			}
		});
	}
});
// new code below
</script>
<script type="text/javascript">
    var filter_link = '';
    var ids = [];
    var min_price = parseFloat('<?php echo isset($min_price) ? $min_price : 0; ?>');
    var max_price = parseFloat('<?php echo isset($max_price) ? $max_price : 0; ?>');
    var current_min_price = parseFloat($('#price-from').val());
    var current_max_price = parseFloat($('#price-to').val());

    $('#slider-price').slider({
        range   : true,
        min     : min_price,
        max     : max_price,
        values  : [ current_min_price, current_max_price ],
        slide   : function (event, ui) {
            $('#price-from').val(ui.values[0]);
            $('#price-to').val(ui.values[1]);
            current_min_price = ui.values[0];
            current_max_price = ui.values[1];
        },
        stop : function (event, ui) {
			var filter_link = '';
			$('.a-filter').each(function(){
				var checkbox = $(this).parent().find('input:checkbox');
				if(checkbox.prop("checked") == true){
					filter_link += '&facet[]='+encodeURIComponent(checkbox.val());
				}
			});
		}
    });
</script>

<script type="text/javascript">
    $(document).ready(function () {
        $('.filter-attribute-container').each(function (i, element) {
            var current_filter_name = $(this);
            var count = 0;
            current_filter_name.find('.filter-item ').each(function () {
                count++;
            });
            if (count == 0) {
                current_filter_name.hide();
            }
        });
    });
</script>
