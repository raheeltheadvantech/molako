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
                        <a href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/geo_zone_add.html');?>" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </div><!-- Page Header -->

                <div class="custom-table">
                    <!-- Table Meta -->
                    <div class="table-meta">
                        <?php echo form_open($this->admin_folder .'/'. $this->controller_dir.'/geo_zones.html', array('class'=>'form-inline'));?>
                        <div class="leftbar">
                            <div class="custom-search">
                                <input type="text" name="term" value="<?php echo $search; ?>" class="form-control input-filter" placeholder="Search Here.."> 
                                 
                                <button type="submit" class="btn btn-outline-blue">Search</button>
                                <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/'. $this->controller_dir.'/geo_zones.html');?>">Reset</a>
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
                                    <th>No#</th>
                                    <th>Geo Zone Name</th>
                                    <th>Description</th>
                                    <th>Action</th>
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
                                        <td><?php echo $index;?></td>
                                        <td><?php echo $val->name;?></td>
                                        <td><?php echo $val->description;?></td>
                                        <td><a href="javascript:void(0);" class="btn-edit" data-id="<?php echo $val->geo_zone_id;?>">Edit</a> / <a href="javascript:void(0);" class="btn-del" data-id="<?php echo $val->geo_zone_id;?>">Del</a></td>
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
		window.location = '<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/geo_zone_edit.html?id=');?>'+$(this).data('id');
	});
	
	$('.btn-del').click(function(){
		if(!confirm('Are you sure you want to remove this Geo ZOne?')){
			return false;
		}
		
		window.location = '<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/geo_zones/delete.html?id=');?>'+$(this).data('id');
	});
	
});
</script>
