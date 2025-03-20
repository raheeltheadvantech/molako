<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php
$search = '';
if(!empty($term))
{
    $search_term = @json_decode($term);
    if(!empty($search_term) and is_object($search_term))
    {
        $search = $search_term->term;
    }
}
?>
    <div class="row">
        <div class="col-xs-12">
            <div class="content-wrapper">
            
                <div class="page-header">
                    <div class="pull-left">
                        <span><?php echo $page_header; ?></span>
                    </div>
                    
                    <div class="pull-right">
                    	<div class="btn-group">
                    	<?php if(!empty($result)):?>
                        <a href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/slider-sort.html');?>" class="btn btn-primary">Sort</a>
                        <?php endif;?>
                        <a href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/slider-add.html');?>" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </div><!-- Page Header -->
                
                
                <div class="custom-table">
                    
                    <!-- Table Meta -->
                    <div class="table-meta">
                        <?php echo form_open($this->admin_folder .'/'. $this->controller_dir.'/sliders.html', array('class'=>'form-inline'));?>
                        <div class="leftbar">
                            <div class="custom-search">
                                <input type="text" name="term" value="<?php echo $search; ?>" class="form-control input-filter" placeholder="Search Here.."> 
                                 
                                <button type="submit" class="btn btn-outline-blue">Search</button>
                                <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/'. $this->controller_dir.'/sliders.html');?>">Reset</a>
                            </div>
                        </div>
                        <div class="rightbar hide">
                            <div class="entry-filter">
                                <label class="control-label">Enteries</label>
                                <select class="form-control">
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <?php echo form_close(); ?>
                    </div>
                    <!-- Table Filter -->
                    <div class="table-wrapper">
                        <div class="table-responsive table-cols">
                        	<?php if(!empty($result)):?>
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th><?php echo sort_url('ID', 'slider_id', $this->admin_folder .'/'. $this->controller_dir .'/sliders.html');?></th>
                                    <th>Thumb</th>
                                    <th><?php echo sort_url('Name', 'name', $this->admin_folder .'/'. $this->controller_dir .'/sliders.html');?></th>
                                    
                                    <th style="width: 10%">Action</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                    <?php $index = 0;?>
                                    <?php foreach( $result as $key=>$val ): ?>
                                    <?php 
                                        $index++; 
                                        $class = 'even';
                                        if (($index % 2) == 1) $class = 'odd';
                                    ?>
                                    <tr role="row" id="tr-<?php echo $val->slider_id;?>" class="<?php echo $class;?> item-slider_id" data-key="<?php echo $val->slider_id;?>">
                                        <td><?php echo $val->slider_id;?></td>
                                        <td><img src="<?php echo site_url('images/slides/thumbnails/'.$val->image);?>" width="50" style="padding:0px; border:0px solid #ddd"/></td>
                                        <td><?php echo $val->name;?></td>
                                        
                                        
                                        <td><a href="javascript:void(0);" class="btn-edit" data-id="<?php echo $val->slider_id;?>">Edit</a> / <a href="javascript:void(0);<?php //echo site_url($this->admin_url .'/'. $this->controller_dir. '/slider-edit.html?id='.$val->slider_id);?>" class="btn-del" data-id="<?php echo $val->slider_id;?>">Del</a></td>
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
				
                <?php echo $this->pagination->create_links_html();?>
                
                <!-- Table pagination -->
                
            </div><!-- Content Wrapper -->
        </div>
    </div>



<script type="text/javascript">
$(document).ready(function(){
	
	$('.btn-edit').click(function(){
		window.location = '<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/slider-edit.html?id=');?>'+$(this).data('id');
	});
	
	$('.btn-del').click(function(){
		if(!confirm('Are you sure you want to remove this item?')){
			return false;
		}
		
		window.location = '<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/sliders/delete.html?id=');?>'+$(this).data('id');
	});
	
});
</script>
