<?php
function renderPagination($currentPage, $totalPages) {
    // Show pagination only if total pages > 1
    if ($totalPages <= 1) return;

    // Sanitize query string
    $queryString = htmlspecialchars(http_build_query($_GET));

    echo '<ul class="pagination">';

    // Previous button
    if ($currentPage > 1) {
        echo '<li class="page-item"><a class="page-link" href="?' . $queryString . '&page=' . ($currentPage - 1) . '">&laquo; Previous</a></li>';
    } else {
        echo '<li class="page-item disabled"><span class="page-link">&laquo; Previous</span></li>';
    }

    // Calculate range for pagination
    $start = max(1, $currentPage - 2); // Start 2 pages before current
    $end = min($totalPages, $currentPage + 2); // End 2 pages after current

    // Add "..." before first page if needed
    if ($start > 1) {
        echo '<li class="page-item"><a class="page-link" href="?' . $queryString . '&page=1">1</a></li>';
        if ($start > 2) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
    }

    // Show page numbers within the range
    for ($i = $start; $i <= $end; $i++) {
        if ($i == $currentPage) {
            echo '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
        } else {
            echo '<li class="page-item"><a class="page-link" href="?' . $queryString . '&page=' . $i . '">' . $i . '</a></li>';
        }
    }

    // Add "..." after last page if needed
    if ($end < $totalPages) {
        if ($end < $totalPages - 1) {
            echo '<li class="page-item disabled"><span class="page-link">...</span></li>';
        }
        echo '<li class="page-item"><a class="page-link" href="?' . $queryString . '&page=' . $totalPages . '">' . $totalPages . '</a></li>';
    }

    // Next button
    if ($currentPage < $totalPages) {
        echo '<li class="page-item"><a class="page-link" href="?' . $queryString . '&page=' . ($currentPage + 1) . '">Next &raquo;</a></li>';
    } else {
        echo '<li class="page-item disabled"><span class="page-link">Next &raquo;</span></li>';
    }

    echo '</ul>';
}

?>

<!-- page-title -->
 <div class="tf-page-title">
            <div class="container-full">
                <div class="row">
                    <div class="col-12">
                        <div class="heading text-center"><?php echo (isset($title))?$title:'New Arrival'; ?></div>
                        <p class="text-center text-2 text_black-2 mt_5">Shop through our latest selection of Fashion</p> 
                    </div>
                </div>
            </div>
        </div>
        <!-- /page-title -->
        <?php
                        if(isset($_GET['category_id']) && !isset($_GET['brand_id']) && $breadcrumb)
                        {
                            ?>
        <div class="tf-breadcrumb">
            <div class="container">
                <div class="tf-breadcrumb-wrap d-flex justify-content-between flex-wrap align-items-center">
                    <div class="tf-breadcrumb-list">
                        <?php
                        echo $breadcrumb;

                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
                        }
                            ?>
        <section class="flat-spacing-1">
            <div class="container">
                <div class="tf-shop-control grid-3 align-items-center">
                    <div class="tf-control-filter">
                        <!-- <a href="#filterShop" data-bs-toggle="offcanvas" aria-controls="offcanvasLeft" class="tf-btn-filter"><span class="icon icon-filter"></span><span class="text">Filter</span></a> -->
                    </div>
                    <ul class="tf-control-layout d-flex justify-content-center">
                        <li class="tf-view-layout-switch sw-layout-2" data-value-grid="grid-2">
                            <div class="item"><span class="icon icon-grid-2"></span></div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-3 active" data-value-grid="grid-3">
                            <div class="item"><span class="icon icon-grid-3"></span></div>
                        </li>
                        <li class="tf-view-layout-switch sw-layout-4" data-value-grid="grid-4">
                            <div class="item"><span class="icon icon-grid-4"></span></div>
                        </li>
                        
                    </ul>
                    <div class="tf-control-sorting d-flex justify-content-end">
                        <?php
                                    $data = array('name'=>'sort_id', 'label'=>'Sort By:', 'class'=>'dd-sort_id', );
                                    echo form_dropdown_1($data, get_sort_menu(), set_value('sort_id', $sort_id));
                                    ?>
                            </div>
                        </div>
                        
                    </div>
                </div>
                <?php// include('inc.menu-category.php'); ?>
                <div class="tf-row-flex">
                    <aside class="tf-shop-sidebar wrap-sidebar-mobile">
						<?php include('inc.menu-category.php'); ?>
                    </aside>
                    <div class="tf-shop-content">
                        <?php
                        if($sub_cats && isset($_GET['category_id']) && !isset($_GET['brand_id']))
                        {
                            ?>
                                     <!-- Categories Women -->

        <section class="prod-categories flat-spacing-4 flat-categorie border-bottom mb-5">
            <div class="container">
                <div class="row">
                            <?php
                            foreach($sub_cats as $k=> $v)
                            {
                                ?>
                                <div class="col-lg-2 col-md-3 col-sm-6 col-xs-6 text-center">
                                        <a href="<?php echo base_url('catalog.html') ?>?category_id=<?php echo $v['category_id'] ?>">
                                        <?php
                                        if($v['images'])
                                        {
                                            $img = 'images/categories/medium/'.$v['images'];
                                            ?>
                                            <img style="max-width: 100%;" src="<?= live_img_url().'/images/image.php?width=204&height=204&image=/'.$img; ?>" />
                                            

                                            <?php
                                        }

                                        ?>
                                        <h6 class="text-center text-uppercase pt-3"><?php echo $v['name'] ?></h6>
                                        </a>
                                    </div>

                                <?php
                            }
                            ?>
                                    </div>
                                </div>

                            </section>
                            <?php
                        }
                        ?>
                    <div class="grid-layout wrapper-shop" data-grid="grid-3">
                    <?php 
                    if(isset($result->products) && $result->products)
                    {
                    foreach ($result->products as $product): ?>
                        <?php
                             $this->load->view('product_box',array('product'=>$product));
                            ?>
                    <?php endforeach; 
                    }
                    ?>
                </div>  
                        <!-- pagination -->
                        <?php if($tpage > 1){?>
                        <!-- Tab Bar -->
                        <div class="tab-bar tab-bar-bottom mb-3">
                            <div class="toolbar">
                                <nav aria-label="Page navigation example">
                                    <ul class="pagination">
                                        <?php renderPagination($cpage, $tpage);?>
                                    </ul>
                                </nav>
                            </div>
                        </div><!-- End Tab Bar -->
                        <?php }?>
                    </div>
                </div>
                
            </div>
        </section>
        