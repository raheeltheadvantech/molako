<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <div class="row">
        <div class="col-xs-12">
            <div class="content-wrapper">
            
                <div class="page-header">
                    <div class="pull-left">
                        <span><?php echo $page_header; ?></span>
                    </div>
                    
                    <div class="pull-right">
                    	<div class="btn-group">
                        <a href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/tax-add.html');?>" class="btn btn-primary">Add</a>
                        </div>
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
                                    <th>Country Name</th>
                                    <th>State Name</th>
                                    <th>Tax Price</th>
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
                                        <td><?php echo $val->country_id;?></td>
                                        <td><?php echo $val->region_id;?></td>
                                        <td><?php echo $val->tax_rate;?></td>
                                        <td><a href="javascript:void(0);" class="btn-edit" data-id="<?php echo $val->tax_id;?>">Edit</a> / <a href="javascript:void(0);" class="btn-del" data-id="<?php echo $val->tax_id;?>">Del</a></td>
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
		window.location = '<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/tax-edit.html?id=');?>'+$(this).data('id');
	});
	
	$('.btn-del').click(function(){
		if(!confirm('Are you sure you want to remove this tax?')){
			return false;
		}
		
		window.location = '<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/taxes/delete.html?id=');?>'+$(this).data('id');
	});
	
});
</script>
