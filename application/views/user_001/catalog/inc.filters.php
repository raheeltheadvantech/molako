<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
ul.filter-block.list-inline {
    margin-bottom: 20px;
}
ul.filter-block.list-inline li {
	border: 1px solid #ccc;
    padding: 0px 8px;
    border-radius: 5px;
    position: relative;
    padding-right: 0px;
    margin-right: 5px;
}


ul.filter-block.list-inline li span {
	font-weight: bold;
    margin-right: 5px;
}
ul.filter-block.list-inline li ul li {
	padding: 0px 25px 0px 5px;
    position: relative;
    margin-bottom: 4px
}
.filter-block .items-block .list-group-items .filter-item:hover {
    border-color: #cc3106;
    cursor: pointer;
}
.filter-block .items-block .list-group-items .filter-item a.del-filter:after {
    content: 'x';
    height: 21px;
    width: 18px;
    color: #fff;
    background: red;
    position: absolute;
    top: 0px;
    right: 0px;
    line-height: 20px;
    text-align: center;
    border-top-right-radius: 5px;
    border-bottom-right-radius: 5px;
}
</style>
<?php if(!empty($result->filters)) : ?>
<div class="row">
    <div class="col-sm-12 col-md-12">
    <ul class="filter-block list-inline">
	<?php foreach($result->filters as $key => $filter_category) : ?>
        	<?php 
				$filter_items_html = _get_filter_items_html($filter_category->filter_items, $facet);
				if($filter_items_html == '')
				{
					continue;
				}
			?>
        <li>
            <span><?php echo $filter_category->filter_category_name; ?></span>
			<div class="items-block">
				<?php echo $filter_items_html; ?>
            </div>
        </li>
    <?php endforeach; ?>
    </ul>
    </div>
</div>    
<?php endif; ?>


<?php 

function _get_filter_items_html($filter_items = false, $facet = false)
{
	$html = '';
	$ul_html = false;
	 
	if($filter_items) : 

	foreach($filter_items as $filter_item_key=>$filter_item)
	{
		$is_checked = (!empty($facet) AND in_array($filter_item->filter_category_item_id, $facet)) ? TRUE : FALSE;
		if(!$is_checked)
		{
			continue;
		}
		
		if(!$ul_html)
		{
			$ul_html = true;
		}
		
		$html .= '<li class="filter-item">'. "\n";
		$html .= '	<a class="del-filter" href="javascript:void(0);" data-val="'.$filter_item->filter_category_item_id.'">'. $filter_item->name . "\n";
		$html .= '	</a>'. "\n";
		$html .= '</li>'. "\n";
	}
	
	if($ul_html)
	{
		$html = '<ul class="list-group-items">'. "\n" . $html . '</ul>'. "\n";
	}
	
	endif;
	
	return $html;
}

?>

<script>
$(document).ready(function(){
	$('.del-filter').click(function () {
		var v1 = $(this).data('val'),
		v2 = '', filter_link = ''
		;
		
		$('.del-filter').each(function(){
			v2 = $(this).data('val');
			if(v1 != v2){
				filter_link += '&facet[]='+encodeURIComponent(v2);
			}
		});
		
		window.location.href = '<?php echo $search_url; ?>' + filter_link;
	});
});
</script>