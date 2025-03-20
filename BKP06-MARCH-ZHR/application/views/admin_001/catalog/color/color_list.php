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

<style>
.splitter{ margin-left:0px;}
</style>
    <div class="row">
        <div class="col-xs-12">
            <div class="content-wrapper">
            
                <div class="page-header">
                    <div class="pull-left">
                        <span><?php echo $page_header?></span>
                    </div>

                    <div class="pull-right">
                        <a href="<?php echo $add_link; ?>" class="btn btn-primary">Add</a>
                    </div>
                    
                    <div class="pull-right">
						<?php if(!empty($search)):?>
                            <span style="color:#C60;">There are <strong><?php echo number_format($total, 0);?></strong> item found.</span>
                        <?php endif;?>
                    </div>
                </div><!-- Page Header -->
                
                
                <div class="custom-table">
                    
                    <!-- Table Meta -->
                    <div class="table-meta">
                    	<?php echo form_open($this->admin_folder .'/'. $this->controller_dir .'/color.html', array('class'=>'form-inline'));?>
						<div class="leftbar">
							<div class="custom-search">
								<input type="text" name="term" value="<?php echo $search; ?>" class="form-control input-filter" placeholder="Search Here.."> 
								<button type="submit" class="btn btn-outline-blue">Search</button>
                                <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/'.$this->controller_dir.'/color.html');?>">Reset</a>
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
                                    <th><?php echo sort_url('ID', 'color_id', $this->admin_folder .'/'. $this->controller_dir .'/color.html');?></th>
                                    <th><?php echo sort_url('Name', 'name', $this->admin_folder .'/'. $this->controller_dir .'/color.html');?></th>
                                    <th><?php echo sort_url('Code', 'code', $this->admin_folder .'/'. $this->controller_dir .'/color.html');?></th>
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
                                    <tr role="row" id="tr-<?php echo $val->color_id;?>" class="<?php echo $class;?> item-color_id" data-key="<?php echo $val->color_id;?>">
                                        <td><?php echo $val->color_id;?></td>
                                        <td><?php echo $val->name;?></td>
                                        <td><div style="border:1px solid black;width: 50px;height: 50px;background: <?php echo $val->code;?>;">.</div></td>
                                        
                                        <td><a href="javascript:void(0);" class="btn-edit" data-id="<?php echo $val->color_id;?>">Edit</a> |
                                            <a href="javascript:void(0);" class="btn-delete" data-id="<?php echo $val->color_id; ?>">Delete</a></td>
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
		window.location = '<?php echo site_url($this->admin_folder .'/'. $this->controller_dir. '/color-edit.html?id=');?>'+$(this).data('id');
	});

    $('.btn-delete').click(function () {
        var x = confirm('Do you really want to delete this brand');
        if(x) {
            window.location = '<?php echo site_url($this->admin_folder . '/' . $this->controller_dir . '/color-delete.html?id=');?>' + $(this).data('id');
        }
    });
	
});
</script>
