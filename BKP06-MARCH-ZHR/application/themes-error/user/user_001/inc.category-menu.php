<div class="category-menu d-none d-lg-block">
    <div class="category-menu-title">
        <h2>Categories</h2>
    </div>
    <div class="categorie-list">

        <?php
            $tree = category_tree();
           // echo '<pre>';
           // print_r($tree);
        ?>
        <ul>
           <?php
           if(!empty($tree)){
           for($i = 0; $i<count($tree); $i++){

               $has_tree_one = 0;
               $sub_tree_one = category_tree($tree[$i]['category_id']);
               if(!empty($sub_tree_one)){
                   $has_tree_one = 1;
               }
               $has_calss = '';
            if($i > 6 ) {
                $has_calss = 'rx-child';
            }
           ?>

            <li class="<?php echo  $has_calss; ?>"><a href="<?php echo href_category($tree[$i]); ?>"><?php echo $tree[$i]['name']; if($has_tree_one){?><i class="fa fa-caret-right"></i><?php } ?></a>
                <?php if($has_tree_one) {?>
                <ul class="mega-menu-ul">
                    <li>
                        <!--Mega Menu -->
                        <div class="mega-menu">
                            <?php for($j = 0; $j<count($sub_tree_one); $j++){
                                $sub_tree_two = category_tree($sub_tree_one[$j]['category_id']);
                                ?>
                            <div class="single-mega-menu">
                                <h2><a href="<?php echo href_category($sub_tree_one[$j]); ?>"><?php echo $sub_tree_one[$j]['name']; ?></a></h2>
                                <?php if(!empty($sub_tree_two)){
                                    for ($k = 0; $k < count($sub_tree_two); $k++) {?>
                                        <a href="<?php echo href_category($sub_tree_two[$k]); ?>"><?php echo $sub_tree_two[$k]['name']; ?></a>
                                <?php }} ?>
                            </div>
                           <?php } ?>
                        </div>
                    </li>
                </ul>
                <?php } ?>
            </li>

          <?php
           }
          if(count($tree) >6){
          ?>
            <li class=" rx-parent">
                <a class="rx-default"><img src="<?php echo site_url($assets_img_dir.'icon/m8.webp') ?>" alt="icon">More categories</a>
                <a class="rx-show"><img src="<?php echo site_url($assets_img_dir.'icon/m9.webp') ?>" alt="icon">close menu</a>
            </li>
        <?php }
           } ?>
            <!-- End Menu Accordion-->
        </ul>
    </div>
</div>