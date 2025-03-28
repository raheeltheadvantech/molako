<?php //var_dump($result);die(); ?>
<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; 
?>
<style>
.collapsible {
    background-color: #fff;
    color: #000;
    cursor: pointer;
    padding: 18px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 15px;
}

.content {
    padding: 0 18px;
    display: none;
    overflow: hidden;
    background-color: #f1f1f1;
}

.active {
    display: block;
}
</style>


<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container-full left-sidebar">
    


<div class="widget-facet wd-categories">
    <div class="facet-title collapsed" data-bs-target="#categories" data-bs-toggle="collapse" aria-expanded="false" aria-controls="categories">
        <span>Categories</span>
        <span class="icon icon-arrow-up"></span>
    </div>
    <div id="categories" class="collapse" style="">
        <ul class="list-categoris current-scrollbar mb_36">
            <?php if (isset($result->category_menu) && !empty($result->category_menu)): ?>
            <?php foreach ($result->category_menu as $val): ?>
            <li><a href="<?php echo href_category($val); ?>"><?php echo $val['name']; ?></a></li>
            <?php endforeach; ?>
            <?php else: ?>
            <li>No Sub Categories</li>
            <?php endif; ?>
        </ul>
    </div>
</div>

<div class="widget-facet wd-categories">
    <div class="facet-title " data-bs-target="#brands" data-bs-toggle="collapse" aria-expanded="true" aria-controls="categories">
        <span>Brands</span>
        <span class="icon icon-arrow-up"></span>
    </div>
    <div id="brands" class="collapse show" style="">
        <ul class="list-categoris current-scrollbar mb_36">
            <?php if (isset($result->brands) && !empty($result->brands)): 
            $get = $_GET;

            ?>
            <?php foreach ($result->brands as $val): 

                    $get['brand_id'] =  $val->brand_id;

            $query= http_build_query($get);
            $cross = '';
            if(isset($_GET['brand_id']) && $_GET['brand_id'] == $val->brand_id)
            {
                unset($get['brand_id']);
                $query= http_build_query($get);
                 $cross = '<a style="width:15px;float:right" href="'.base_url('catalog.html').'?'.$query.'"><img src="'.base_url($assets_img_dir).'deep.png" /></a>';
            }
                ?>
            <li><a href="<?php echo base_url('catalog.html'); ?>?<?php echo $query; ?>"><?php echo $val->name; ?></a> <?php echo $cross; ?></li>
            <?php endforeach; ?>
            <?php else: ?>
            <li>No Sub Categories</li>
            <?php endif; ?>
        </ul>
    </div>
</div>
    <!-- Shop Layout -->
	<form id="filter_form">
	<input type="hidden" id="filter_order" name="order" value="<?= (isset($_GET['order'])?$_GET['order']:'') ?>" />
    <?php
    if(isset($_GET['is_special']))
    {
        ?>
        <input type="hidden" name="is_special" value="1" />

        <?php
    }

    ?>
	<input 
	type="hidden" id="filter_sort" name="sort" value="<?= (isset($_GET['sort'])?$_GET['sort']:'') ?>" />
	<?php
	if(isset($_GET['category_id']))
	{
		?>
		<input type="hidden" name="category_id" value="<?php echo $_GET['category_id'] ?>" />
		<?php
	}
	?>
	<?php
	if(isset($_GET['brand_id']))
	{
		?>
		<input type="hidden" name="brand_id" value="<?php echo $_GET['brand_id'] ?>" />
		<?php
	}
	?>
    <div class="shop-layout">
	
        <?php if (isset($filters) && !isset($_GET['is_special'])):
?>
            <?php $i = 0; 
			$filter_keys = array();
			if(is_array($_GET['filter_id']))
			{
			$fexp = $_GET['filter_id'];
			}
			else{
				$fexp = array($_GET['filter_id']);
			}
			
				foreach($fexp as $k=> $v)
				{
					$exp = explode('_',$v);
					if(isset($exp[0]) && $exp[0])
					{
						$filter_keys[] = $exp[0];
					}
				}
			?>
            <?php foreach ($filters as $key => $f): ?>
				<?php
$t = $f['type'];
unset($f['type']);
if($t == 'color')
{
?>
	<div class="widget-facet">
                        <div class="facet-title" data-bs-target="#color" data-bs-toggle="collapse" aria-expanded="true" aria-controls="color">
                            <span><?= $key ?></span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
						
                        <div id="color" class="collapse <?php echo (in_array($key,$filter_keys)?'show':'hide') ?>">
                            <ul class="tf-filter-group filter-color current-scrollbar mb_36">
								<?php if (is_array($f)): 
								?>
                                <?php foreach ($f as $k=>$val): 

?>                         <?php $checked = (is_array($fexp) && in_array($key.'_'.$val['color'], $fexp)) ? "checked" : ""; ?>
									<li class="list-item d-flex gap-12 align-items-center">
                                    <input type="checkbox" name="filter_id[]" class="filter-checkbox tf-check-color bg_beige" id="<?= $val['color'] ?>"  data-key="<?php echo $key ?>" test="<?= $key.'_'.$val['color'] ?>" value="<?= $key.'_'.$val['color'] ?>" style="background-color:<?= $val['code'] ?>" <?php echo $checked; ?>>
                                    <label for="<?= $val['color'] ?>" class="label"><span><?= $val['color'] ?></span>&nbsp;<span></span></label>
                                </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                            </ul>
                        </div>
                    </div>

<?php

}
else
{
?>
	<div class="widget-facet wd-categories">
                    <div class="facet-title collapsed" data-bs-target="#categories<?php echo ++$i; ?>" data-bs-toggle="collapse" aria-expanded="false" aria-controls="categories<?php echo $i; ?>">
                        <span><?php echo $key; ?> </span>
                        <span class="icon icon-arrow-up"></span>
                    </div>
					<div id="categories<?php echo $i; ?>" class="collapse <?php echo (in_array($key,$filter_keys)?'show':'hide') ?>">
                        <ul class="list-categoris current-scrollbar mb_36">
                            <?php if (is_array($f)): ?>
                                <?php foreach ($f as $k=>$val):
?>
									
                                    <?php $checked = (is_array($fexp) && in_array($key.'_'.$val, $fexp)) ? "checked" : ""; ?>
                                    <li>
                                        <input type="checkbox" name="filter_id[]" id="filter<?php echo $val; ?>" class="filter-checkbox  tf-check" data-key="<?php echo $key ?>" value="<?php echo $key.'_'.$val; ?>"  <?php echo $checked; ?>> 
                                        <?php echo $val; ?>
                                    </li>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
<?php
}
?>
            <?php  endforeach; ?>
        <?php endif; ?>
		<?php
		if(isset($max_price) && $max_price)
		{
			$smax_price = $_GET['max_price'];
			$smin_price = $_GET['min_price'];
			$smax_price = ($smax_price < $max_price)?$smax_price:$max_price;
			$smin_price = ($smin_price > $min_price)?$smin_price:$min_price;			
			if(!$smax_price)
			{
				$smax_price = $max_price;
			}			
			if(!$smin_price)
			{
				$smin_price = $min_price;
			}
				
			?>
		<div class="widget-facet filter-price">
                        <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true" aria-controls="price">
                            <span>Price </span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="price" class="collapse show">
                            <div class="widget-price filter-price">
                                <div class="tow-bar-block">
                                    <div class="progress-price"></div>
                                </div>
                                <div class="range-input">
                                    <input class="range-min filter-checkbox" id="desktop_min" oninput="showVal('desktop','min')"
  onchange="showVal('desktop')" type="range" min="<?php echo $min_price?>" name="min_price" max="<?php echo $max_price?>" value="<?php echo $smin_price?>">
                                    <input class="range-max filter-checkbox" id="desktop_max" oninput="showVal('desktop','max')"
  onchange="showVal('desktop')" type="range" min="<?php echo $min_price?>"  name="max_price" max="<?php echo $max_price?>" value="<?php echo $smax_price?>">
                                </div>
                                <div class="box-title-price">
                                    <span class="title-price">Price (Rs):</span>
                                    <div class="caption-price">
                                        <div>
                                            <span class="desktop-min-price"><?php echo $smin_price?></span>
                                        </div>
                                        <span>-</span>
                                        <div>
                                            <span class="desktop-max-price"><?php echo $smax_price?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
    <?php
		}
		?>
		
	</div><!-- End Shop Layout Area -->
	</form>
</div>
<script type="text/javascript">
function toggleCollapse(button) {
    const content = button.parentElement.nextElementSibling.querySelector('.content');
    if (content) {
        content.classList.toggle('active');
    }
    }
}</script>
