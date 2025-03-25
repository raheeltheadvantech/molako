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
                        <span><?php echo $page_header?></span>
                    </div>
                    
					<?php if(!empty($search)):?>
                    <div class="pull-right">
                    	<span style="color:#C60;">There are <strong><?php echo number_format($total, 0);?></strong> product found.</span>
                    </div>
                    <?php endif;?>
                </div><!-- Page Header -->
                <div class="custom-table">
                    
                    <!-- Table Meta -->
                    <div class="table-meta">
                    	<?php echo form_open($this->admin_folder .'/sales/orders.html', array('class'=>'form-inline'));?>
						<div class="leftbar">
							<div class="custom-search">
								<input type="text" name="term" value="<?php echo $search; ?>" class="form-control input-filter" placeholder="Search Here.."> 
								<select class="form-control text-left" id="customer_id" name="end_user_id" style="width: 125px;padding-left: 10px;">
									<option value="-1">All</option>
									<?php if(isset($customers) && !empty($customers)): ?>
									<?php foreach ($customers as $customer): ?>
											<option value="<?php echo $customer->customer_id ?>"><?php echo $customer->first_name .' '. $customer->last_name; ?></option>
									<?php endforeach; ?>
									<?php endif; ?>
								</select> 
								<button type="submit" class="btn btn-outline-blue">Search</button>
                                <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/sales/orders.html');?>">Reset</a>
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
                        	<?php if(!empty($result) and is_array($result)):?>
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th><?php echo sort_url('ID', 'order_id', $this->admin_url .'/sales/orders.html');?></th>
                                    <th><?php echo sort_url('Customer name', 'first_name', $this->admin_url .'/sales/orders.html');?></th>
                                    <th>No. of Products</th>
                                    <th>Total</th>
									<th>Date Added</th>
									<th>Shipping Status</th>
                                    <th>Payment Status</th>
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
                                    <tr role="row" id="tr-<?php echo $val->order_id;?>" class="<?php echo $class;?> item-product" data-key="<?php echo $val->order_id;?>">
                                        <td><?php echo $val->order_id;?></td>
                                        <td><?php echo $val->first_name .' '. $val->last_name;?></td>
                                        <td><?php echo $val->no_of_products;?></td>
                                        <td><?php echo format_currency($val->total);?></td>
                                        <td><?php echo format_date($val->date_added);?></td>
                                        <td><?php echo $val->order_shipping_status ;?> </td>
                                        <td><?php echo $val->order_payment_status ;?> </td>
                                        <td>
											<!--<a href="javascript:void(0);" class="btn-edit" data-id="<?php /*echo $val->order_id;*/?>">Edit</a>-->
											<a href="javascript:void(0);" class="btn-view" data-id="<?php echo $val->order_id;?>">View</a>
										</td>
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
                
                <?php /*?>
                <div class="table-pagination">
                    <div class="pull-left">
                        <span>Showing <strong>1 to 5 of 49</strong> entries</span>
                    </div>
                    <div class="pull-right">
                        <div class="pagination">
                            <?php echo $this->pagination->create_links();?>
                        </div>
                    </div>
                </div>
				<?php */?>
				
                <!-- Table pagination -->
                
            </div><!-- Content Wrapper -->
        </div>
    </div>



<script type="text/javascript">

$(document).ready(function(){
	
	$('.btn-view').click(function(){
		window.location = '<?php echo site_url($this->admin_folder .'/sales/orders/order-detail.html?id=');?>'+$(this).data('id');
	});
	
});
 
</script>
