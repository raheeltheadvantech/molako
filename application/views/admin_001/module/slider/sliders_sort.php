<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
	.pagination {
		margin:0px;
		margin-top:-3px;
	}
</style>

    <div class="row">
        <div class="col-xs-12">
            <div class="content-wrapper">
            
                <div class="page-header">
                    <div class="pull-left">
                        <span><?php echo $page_header; ?></span>
                    </div>
                    
                    <div class="pull-right">
                    	<a href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/sliders.html');?>" class="btn btn-default">Back</a>
                    </div>
                </div><!-- Page Header -->
                
                
                <div class="custom-table">
                    
                    <!-- Table Meta -->
                    
                    <!-- Table Filter -->
                    <div class="table-wrapper">
                        <div class="table-responsive table-cols">
                        	<?php if(!empty($result)):?>
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th width="10">Sort</th>
                                    <th>ID</th>
                                    <th>Thumb</th>
                                    <th>Name</th>
                                </tr>
                                </thead>
                                
                                <tbody id="slider">
                                    <?php $index = 0;?>
                                    <?php foreach( $result as $key=>$val ): ?>
                                    <?php 
                                        $index++;
                                        $class = 'even';
                                        if (($index % 2) == 1) $class = 'odd';
                                    ?>
                                    <tr role="row" id="items-<?php echo $val->slider_id;?>" class="<?php echo $class;?> item-slider_id" data-key="<?php echo $val->slider_id;?>">
                                        <td class="handle"><a class="btn" style="cursor:move"><span class="glyphicon glyphicon-move"></span></a></td>
                                        <td><?php echo $val->slider_id;?></td>
                                        <td><img src="<?php echo site_url('images/slides/thumbnails/'.$val->image);?>" width="50" style="padding:0px; border:0px solid #ddd"/></td>
                                        <td><?php echo $val->name;?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table><!-- Table -->
							<?php else : ?>
								<div class="text-center alert alert-warning">No item found</div>
                            <?php endif;?>
                                
                        </div><!-- Table Responsive -->
                    </div><!-- Table wrapper -->
                </div><!-- Custom Table -->
				
            </div><!-- Content Wrapper -->
        </div>
    </div>

<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.ui/jquery.ui.min.js'); ?>"></script>
        

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	create_sortable();	
});
// Return a helper with preserved width of cells
var fixHelper = function(e, ui) {
	ui.children().each(function() {
		$(this).width($(this).width());
	});
	return ui;
};

function create_sortable()
{
	$('#slider').sortable({
		scroll: true,
		helper: fixHelper,
		axis: 'y',
		handle:'.handle',
		update: function(){
			save_sortable();
		}
	});	
	$('#slider').sortable('enable');
}

function save_sortable()
{
	serial = $('#slider').sortable('serialize') + '&<?php echo $this->security->get_csrf_token_name();?>=<?php echo $this->security->get_csrf_hash();?>';
	$.ajax({
		url:'<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/slider/ajax/sort.html');?>',
		type:'POST',
		data:serial
	});
}
//]]>
</script>