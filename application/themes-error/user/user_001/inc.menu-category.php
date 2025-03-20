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
<div class="left-sidebar">
    <div class="left-sidebar-title">
        <h2>Shop By</h2>
    </div>
    <!-- Shop Layout -->
    <div class="shop-layout">
        <div class="layout-title" hidden>
            <h2>Sub Categories</h2>
        </div>
        <div class="layout-list" hidden>
            <ul>
                <?php
                if(isset($result->category_menu) && !empty($result->category_menu)){
                foreach ($result->category_menu as $key => $val) {
                    ?>
                <li><a href="<?php echo href_category($val) ?>"><?php echo $val['name']; ?></a></li>
               <?php } }
                else {?>
                    <li>No Sub Categories</li>
                <?php }?>
            </ul>
        </div>
        <?php 
if(isset($filters)): 
    foreach($filters as $key => $f):?>
        <div class="layout-title">
            <button class="collapsible" onclick="toggleCollapse(this)"><?php echo $key;?></button>
        </div>
        <div class="layout-list">
            <ul class="content">
                <?php
                if(is_array($f)){
                    foreach ($f as $key => $val) {
                        $checked = '';
                        if ($filter_ids) {
                            foreach($filter_ids as $f){
                                if ($f == $val) {
                                    $checked = "checked";
                                }
                            }
                        }
                        ?>
                        <li><input type="checkbox" name="filter" id="filter<?php echo $val;?>" class="filter-checkbox" value="<?php echo $val;?>" <?php echo $checked;?>> <?php echo $val; ?></li>
                    <?php } 
                }?>
            </ul>
        </div>
<?php 
    endforeach; 
endif;
?>
    </div><!-- End Shop Layout Area -->
    <!-- Shop Layout -->

</div>
<script type="text/javascript">
function toggleCollapse(button) {
  var content = button.parentElement.nextElementSibling.querySelector('.content');
  if (content) {
    content.classList.toggle('active');
  }
}
</script>