<?php //var_dump($result);die(); ?>
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
    <div class="facet-title collapsed" data-bs-target="#brands" data-bs-toggle="collapse" aria-expanded="false" aria-controls="categories">
        <span>Brands</span>
        <span class="icon icon-arrow-up"></span>
    </div>
    <div id="brands" class="collapse" style="">
        <ul class="list-categoris current-scrollbar mb_36">
            <?php if (isset($result->brands) && !empty($result->brands)): ?>
            <?php foreach ($result->brands as $val): ?>
            <li><a href="<?php echo base_url('catalog.html'); ?>?brand_id=<?php echo $val->brand_id; ?>"><?php echo $val->name; ?></a></li>
            <?php endforeach; ?>
            <?php else: ?>
            <li>No Sub Categories</li>
            <?php endif; ?>
        </ul>
    </div>
</div>
    <!-- Shop Layout -->
    <div class="shop-layout">
        <?php if (isset($filters)):
?>
            <?php $i = 0; ?>
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
                        <div id="color" class="collapse show">
                            <ul class="tf-filter-group filter-color current-scrollbar mb_36">
								<?php if (is_array($f)): 
								?>
                                <?php foreach ($f as $k=>$val): 

?>
									
                                    <?php $checked = (is_array($filter_ids) && in_array($val['color'], $filter_ids)) ? "checked" : ""; ?>
									<li class="list-item d-flex gap-12 align-items-center">
                                    <input type="checkbox" name="color" class="filter-checkbox tf-check-color bg_beige" id="<?= $val['color'] ?>"  data-key="<?php echo $key ?>" value="<?= $val['color'] ?>" style="background-color:<?= $val['code'] ?>" <?php echo $checked; ?>>
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
                    <div id="categories<?php echo $i; ?>" class="collapse">
                        <ul class="list-categoris current-scrollbar mb_36">
                            <?php if (is_array($f)): ?>
                                <?php foreach ($f as $k=>$val):
?>
									
                                    <?php $checked = (is_array($filter_ids) && in_array($val, $filter_ids)) ? "checked" : ""; ?>
                                    <li>
                                        <input type="checkbox" name="filter" id="filter<?php echo $val; ?>" class="filter-checkbox" data-key="<?php echo $key ?>" value="<?php echo $val; ?>" <?php echo $checked; ?>> 
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
		<div class="widget-facet filter-price">
                        <div class="facet-title" data-bs-target="#price" data-bs-toggle="collapse" aria-expanded="true" aria-controls="price">
                            <span>Price OKK </span>
                            <span class="icon icon-arrow-up"></span>
                        </div>
                        <div id="price" class="collapse show">
                            <div class="widget-price filter-price">
                                <div class="tow-bar-block">
                                    <div class="progress-price"></div>
                                </div>
                                <div class="range-input">
                                    <input id="mbl_min" class="range-min filter-checkbox" oninput="showVal('mbl')"
  onchange="showVal('mbl')" type="range" min="0" id="mbl_max" max="300" value="0">
                                    <input class="range-max filter-checkbox" oninput="showVal('mbl')"
  onchange="showVal('mbl')" type="range" min="0" max="300" value="300">
                                </div>
                                <div class="box-title-price">
                                    <span class="title-price">Price :</span>
                                    <div class="caption-price">
                                        <div>
                                            <span>$</span>
                                            <span class="min-price">0</span>
                                        </div>
                                        <span>-</span>
                                        <div>
                                            <span>$</span>
                                            <span class="max-price">300</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>
    </div><!-- End Shop Layout Area -->
</div>
<script type="text/javascript">
function toggleCollapse(button) 
{
const content = button.parentElement.nextElementSibling.querySelector('.content');
if (content) {
	content.classList.toggle('active');
}
} 
</script>
