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



<?php if(!empty($brands) and is_array($brands)):?>
<ul>
    <?php foreach($brands as $key=>$val ): ?>
    <li style="display:inline-block; list-style-type:square;"><a href="<?php echo site_url($this->user_url .'/'. 'catalog.html?brand_id='.$val->brand_id);?>"><?php echo $val->name;?></a></li>
    <?php endforeach;?>
</ul>
<?php endif;?>


    <div class="row">
        <div class="col-xs-12">
            <div class="content-wrapper">
                <div class="page-header">
                    <div class="pull-left">
                        <span><?php echo $page_header?></span>
                    </div>
                    <div class="pull-right">
                    	<span style="color:#C60;">There are <strong><?php echo number_format($total, 0);?></strong> product found.</span>
                    </div>
                </div><!-- Page Header -->
                
                
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo form_open($this->user_url .'/'. 'catalog.html', array('class'=>'form-inline'));?>
                            <fieldset>
                                <input type="text" name="term" value="<?php echo $search; ?>" class="form-control" placeholder="Search Here.."> 
                                <button class="btn" name="submit" value="search">Search</button>
                                <a class="btn" href="<?php echo site_url($this->user_url.'/'.$this->controller_name.'/catalog.html');?>">Reset</a>
                            </fieldset>
                        </form>
                    </div>
                </div>
                
                
                <?php echo form_open($this->user_url .'/'. 'catalog.html', array('class'=>'product-form'));?>
                <div class="custom-table">
                    
                    <!-- Table Meta -->
                    <!-- Table Filter -->
                    <div class="table-wrapper">
                        
                        <div class="table-responsive table-cols">
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th><?php echo sort_url('id', 'product_id', $this->user_url .'/'. $this->controller_name .'/catalog.html');?></th>
                                    <th><?php echo sort_url('name', 'product_name', $this->user_url .'/'. $this->controller_name .'/catalog.html');?></th>
                                    <th>Part number</th>
                                    <th>Alternate part number</th>
                                    <th>Part description</th>
                                    <th>mfr part number</th>
                                    <th>Category</th>
                                    <th>Sub Category</th>
                                    <th>Barcode</th>
                                </tr>
                                </thead>
                                
                                <?php if(!empty($result) and is_array($result)):?>
                                <tbody>
                                    <?php $index = 0;?>
                                    <?php foreach( $result as $key=>$val ): ?>
                                    <?php 
                                        $index++; 
                                        $class = 'even';
                                        if (($index % 2) == 1) $class = 'odd';
                                    ?>
                                    <tr role="row" id="tr-<?php echo $val->product_id;?>" class="<?php echo $class;?> item-product" data-key="<?php echo $val->product_id;?>">
                                        <td><a href="<?php echo site_url($this->user_url .'/'. $this->controller_name .'/product.html?product_id='.$val->product_id);?>" class="btn-view"><?php echo $val->product_name;?></a></td>
                                        <td><?php echo $val->product_name;?></td>
                                        <td><?php echo $val->part_number;?></td>
                                        <td><?php echo $val->alternate_part_number;?> </td>
                                        <td><?php echo $val->part_description;?></td>
                                        
                                        <td><?php echo $val->mfr_part_number;?></td>
                                        <td><?php echo $val->category;?></td>
                                        <td><?php echo $val->subcategory;?></td>
                                        <td><?php echo $val->barcode;?></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                                <?php else : ?>
                                    <tr>
                                        <td colspan="11" class="text-center">
                                            No item found
                                        </td>
                                    </tr>
                                <?php endif;?>
                                
                            </table><!-- Table -->
                        </div><!-- Table Responsive -->
                    </div><!-- Table wrapper -->
                </div><!-- Custom Table -->
                <?php echo form_close(); ?>
				
				<?php echo $this->pagination->create_links();?>
                <!-- Table pagination -->
                
            </div><!-- Content Wrapper -->
        </div>
    </div>



<script type="text/javascript">

$(document).ready(function(){
	
	$('.btn-edit').click(function(){
		window.location = '<?php echo site_url($this->user_url .'/'. 'edit.html?id=');?>'+$(this).data('id');
	});
	
});

</script>
