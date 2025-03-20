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
        <?php if(isset($filters)): 
            foreach($filters as $key => $f):?>
        <div class="layout-title">
            <h2><?php echo $key;?></h2>
        </div>
        <div class="layout-list">

            <?php
               // echo '<pre>'; print_r($f);die();
            ?>
            <ul>
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
               <?php } }?>
            </ul>
        </div>
        <?php endforeach; endif;?>
    </div><!-- End Shop Layout Area -->
    <!-- Shop Layout -->

</div>
<script type="text/javascript">

$(document).ready(function(){
    const filter = [];
    
    var urlParams = new URLSearchParams(window.location.search);
    let valUrl = urlParams.get('filter_id');
    console.log('valUrl',valUrl);
    if (valUrl) {
        filter.push(valUrl);
        // $.each( filter, function(index,value) {
        //     console.log('value',value);
        //   $('#filter'+value).attr("checked",'checked');
        // });
        
     
        // if ($('#filter'+valUrl).is(":checked")) {
        //   filter.splice( $.inArray(valUrl, filter), 1 );  
        // }else{
            
        // }
        
    }
    $('.filter-checkbox').change(function(){
         // let filter = $('input[name=filter]:checked');
         let val = $(this).val();
        if ($(this).is(":checked")) {
            filter.push(val);
        }else{
            filter.splice( $.inArray(val, filter), 1 );
            
        }
        console.log('filter',filter);
        // $.ajax({
        //     url: "<?php echo site_url('catalog.html?filter_id=')?>"+filter,
        //     // type:"",
        //     // data:{ 'filter_ids' : filter},
        //     success:function(resp){
        //         console.log('resp',resp);
        //     }
        // });
        
        if ($.isArray(filter)) {
            window.location = "<?php echo site_url('catalog.html?filter_id=');?>"+filter;
        }
    });
});
</script>