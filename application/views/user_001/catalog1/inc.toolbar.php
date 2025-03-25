<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<div id="filter-button-wrapper">
    <a href="javascript:void(0)" id="filter-button" class="btn btn-default" style="background: #ff0; color:#000; font-weight: bold; width: -webkit-fill-available;
                    margin: 5px 0px 5px 0px; border-bottom-style: double;">
        SIZE/SPECS CUSTOMIZER
        <span class="br"></span>
        (Click to open)
    </a>
</div>

<div class="toolbar toolbar-products">
    <div class="modes">    
    </div>
    
	<div class="toolbar-amount">
        <?php /*?><span> Showing 1 to 9 of 12 (2 Pages) </span><?php */?>
    </div>
    
    <div class="sorter">
        <label  for="input-sort">Sort By:</label>
    	<?php 
			$data = array('name'=>'sort_id', 'label'=>false, 'class'=>'form-control dd-sort_id', );
			echo form_dropdown_1($data, get_sort_menu(), set_value('sort_id', $sort_id));
		?>
 
    </div>
    
</div>



<?php /*?>
<div class="toolbar toolbar-products">
    <div class="modes">
        
        <button type="button" onclick="category_view.changeView('grid', 2, 'btn-grid-2')" class="btn btn-default btn-custom-view btn-grid btn-grid-2" data-toggle="tooltip" title="2">2</button>
        <button type="button" onclick="category_view.changeView('grid', 3, 'btn-grid-3')" class="btn btn-default btn-custom-view btn-grid btn-grid-3" data-toggle="tooltip" title="3">3</button>
        <button type="button" onclick="category_view.changeView('grid', 4, 'btn-grid-4')" class="btn btn-default btn-custom-view btn-grid btn-grid-4" data-toggle="tooltip" title="4">4</button>
        <button type="button" onclick="category_view.changeView('grid', 5, 'btn-grid-5')" class="btn btn-default btn-custom-view btn-grid btn-grid-5" data-toggle="tooltip" title="5">5</button>
        <button type="button" onclick="category_view.changeView('list', 0, 'btn-list')" class="btn btn-default btn-custom-view btn-list" data-toggle="tooltip" title="List">List</button>
        <input type="hidden" id="category-view-type" value="grid" />
        <input type="hidden" id="category-grid-cols" value="3" />
    
        <?php /*?>
        <button type="button" id="grid-view" class="btn btn-default btn-grid"  title="{{ button_grid }}">{{ button_grid }}</button>
        <button type="button" id="list-view" class="btn btn-default btn-list"  title="{{ button_list }}">{{ button_list }}</button>
        <?php * /?>
            
     </div>
    <div class="toolbar-amount">
        <?php /*?><span> Showing 1 to 9 of 12 (2 Pages) </span><?php * /?>
    </div>
    <div class="sorter">
        <label  for="input-sort">Sort By:</label>
        
        <select id="input-sort" class="form-control">
          <option value="<?php echo href_category($result->category)?>&sort=p.sort_order&order=ASC" selected="selected">Default</option>
          <option value="<?php echo href_category($result->category)?>&sort=pd.name&order=ASC">Name (A - Z)</option>
          <?php /*?>
          <option value="<?php echo href_category($val)?>&sort=pd.name&aorder=DESC">Name (Z - A)</option>
          <option value="<?php echo href_category($val)?>&path=312&sort=p.price&order=ASC">Price (Low &gt; High)</option>
          <option value="<?php echo href_category($val)?>&path=312&sort=p.price&order=DESC">Price (High &gt; Low)</option>
          <option value="<?php echo href_category($val)?>&sort=rating&order=DESC">Rating (Highest)</option>
          <option value="<?php echo href_category($val)?>&sort=rating&order=ASC">Rating (Lowest)</option>
          <option value="<?php echo href_category($val)?>&sort=p.model&order=ASC">Model (A - Z)</option>
          <option value="<?php echo href_category($val)?>&sort=p.model&order=DESC">Model (Z - A)</option>
          <?php * /?>
        </select>

    </div>
    
    <?php /*?>
    <div class="limiter">
        <label for="input-limit">Show:</label>
        <select id="input-limit" class="form-control">
          <option value="<?php echo href_category($val)?>&sort=p.sort_order&order=ASC&limit=9" selected="selected">9</option>
          <option value="<?php echo href_category($val)?>&sort=p.sort_order&order=ASC&limit=25">25</option>
          <option value="<?php echo href_category($val)?>&sort=p.sort_order&order=ASC&limit=50">50</option>
          <option value="<?php echo href_category($val)?>&sort=p.sort_order&order=ASC&limit=75">75</option>
          <option value="<?php echo href_category($val)?>&sort=p.sort_order&order=ASC&limit=100">100</option>
        </select>
    </div>
    <?php * /?>
    
</div><?php */?>

<script type="text/javascript">
$(document).ready(function(){
	$('.dd-sort_id').on('change', function(){
		var dis = $(this),
		sort = dis.find(':selected').data('sort'),
		order = dis.find(':selected').data('order'),
		sort = (typeof sort == 'undefined' ? '' : sort),
		order = (typeof order == 'undefined' ? '' : order),
		<?php if( isset($brand_id)) { ?>
		//inpts = 'order='+order+'&sort='+sort+'&code=<?php echo $code; ?>'+'&brand_id=<?php echo $brand_id; ?>';
		<?php }elseif( isset($category_id)) { ?>
		//inpts = 'order='+order+'&sort='+sort+'&code=<?php echo $code; ?>'+'&category_id=<?php echo $category_id; ?>';
		<?php } ?>
		inpts = 'order='+order+'&sort='+sort;
		
		url = '<?php echo site_url($this->user_url . '/catalog.html'); ?>';
		url = '<?php echo (isset($no_sort_url)?$no_sort_url:''); ?>';
		//url =  window.location.href;
		
		url = url + ((url.indexOf('?') !== -1) ? '&' : '?') + inpts;
		//alert(url);return false;
		window.location = url;
	});
	
});
</script>
