<?php
$tree = category_tree();
?>
<div class="mobile-menu d-block d-lg-none">
    <nav>
        <ul>
            <li class=""><a href="<?php echo site_url(); ?>">Home</a></li>

            <?php
            if(!empty($tree)){
            for($i = 0; $i<count($tree); $i++){
                $sub_tree_one = category_tree($tree[$i]['category_id']);
                ?>

            <li><a href="<?php echo href_category($tree[$i]); ?>"><?php echo $tree[$i]['name']; ?></a>
                <?php if(!empty($sub_tree_one)){ ?>
                <ul class="">
                    <?php for($j = 0; $j<count($sub_tree_one); $j++){
                    $sub_tree_two = category_tree($sub_tree_one[$j]['category_id']);
                    ?>

                    <li><a href="<?php echo href_category($sub_tree_one[$j]); ?>"><?php echo $sub_tree_one[$j]['name']; ?></a>
                        <?php if(!empty($sub_tree_two)){ ?>
                        <ul>
                            <?php for ($k = 0; $k < count($sub_tree_two); $k++) {?>
                            <li><a href="<?php echo href_category($sub_tree_two[$k]); ?>"><?php echo $sub_tree_two[$k]['name']; ?></a></li>
                            <?php } ?>
                        </ul>
                        <?php } ?>
                    </li>
                    <?php } ?>
                </ul>
                <?php } ?>
            </li>

            <?php } }?>
            <?php echo create_navigation_html();?>


        </ul>
    </nav>
</div>