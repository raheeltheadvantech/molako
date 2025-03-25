<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php 
$search = '';
//$filter_distributor_id = '';
$filter_manufacturer_id = '';
$filter_category_id = '';
if(!empty($term))
{
	$search_term = @json_decode($term);
	if(!empty($search_term) and is_object($search_term))
	{
		$search = $search_term->term;
		//$filter_distributor_id = $search_term->filter_distributor_id;
       // $filter_manufacturer_id = $search_term->filter_manufacturer_id;
		//$filter_category_id = $search_term->filter_category_id;
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

                    <div class="pull-right">
                        <?php if(!empty($term)):?>
                    	<span style="color:#C60;">There are <strong><?php echo number_format($total, 0);?></strong> product found.</span>
                        <?php endif;?>

						<a href="<?php echo $add_link; ?>" class="btn btn-primary">Add</a>
                    </div>

                </div><!-- Page Header -->
                <div class="custom-table">
                    <div id="disable-message"></div>

                    <!-- Table Meta -->
                    <div class="table-meta">
                        <div class="loader-container" style="display: inline-block">
                            <span class="loader"></span>
                        </div>
						<div class="leftbar">
							<div class="custom-search">
                                <?php if($is_special_products == false): ?>
                                    <?php echo form_open($this->admin_folder .'/'. $this->controller_dir .'/products.html', array('class'=>'form-inline'));?>
                                <?php else: ?>
                                    <?php echo form_open($this->admin_folder .'/'. $this->controller_dir .'/special-products.html', array('class'=>'form-inline'));?>
                                <?php endif; ?>
								<input type="text" name="term" value="<?php echo $search; ?>" class="form-control input-filter" placeholder="Search Here.."> 

								<button type="submit" class="btn btn-outline-blue">Search</button>
                                <?php if($is_special_products == false): ?>
                                <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/'.$this->controller_dir.'/products.html');?>">Reset</a>
                                <?php else: ?>
                                    <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder.'/'.$this->controller_dir.'/special-products.html');?>">Reset</a>
                                <?php endif; ?>
                                <?php echo form_close(); ?>
                                <button  id="btnDisable" class="btn btn-outline-blue" style="display: none">Disable</button>
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


					</div>
                    
                    <!-- Table Filter -->
                    <div class="table-wrapper">
                        <div class="table-responsive table-cols">
                        	<?php if(!empty($result) and is_array($result)):?>
                            <table class="table table-bordered" id="selectcheck">
                                <thead>
                                <tr role="row">
                                    <th><input type="checkbox" id="selectAll" name="" value="" /></th>
                                    <th><?php echo sort_url('ID', 'product_id', $this->admin_folder .'/'. $this->controller_dir .'/products.html');?></th>
                                    <th style="width: 300px;"><?php echo sort_url('name', 'product_name', $this->admin_folder .'/'. $this->controller_dir .'/products.html');?></th>
                                    <th>SKU</th>
                                    <th>Barcode</th>
                                    <!-- <th>Brand</th> -->
                                    <th>Enabled</th>
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
                                    <tr role="row" id="tr-<?php echo $val->product_id;?>" class="<?php echo $class;?> item-product" data-key="<?php echo $val->product_id;?>">
                                        <td><input type="checkbox" class="item-val"  name="pids" value="<?php echo $val->product_id;?>"/></td>
                                        <td><?php echo $val->product_id;?></td>
                                        <td><?php echo $val->product_name;?></td>
                                        <td><?php echo $val->sku;?></td>
                                        <td><?php echo $val->barcode;?> </td>
                                        <!-- <td><?php echo $val->brand_name;?></td> -->
                                        <td><?php echo ($val->is_enabled == 1 ? lang('yes') : lang('no'));?></td>
                                        
                                        <td>
                                            <a href="javascript:void(0);" class="btn-edit" data-id="<?php echo $val->product_id;?>">Edit</a>
                                            <!-- <a href="javascript:void(0);" class="btn-delete" data-id="<?php echo $val->product_id; ?>">Delete</a> -->
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
                <!-- Table pagination -->
                
            </div><!-- Content Wrapper -->
        </div>
    </div>

<script type="text/javascript">

$(document).ready(function(){
	$('.btn-edit').click(function(){
		window.location = '<?php echo site_url($this->admin_folder .'/'. $this->controller_dir. '/product-edit.html?id=');?>'+$(this).data('id');
	});

    $('.btn-delete').click(function () {
        var x = confirm('Do you really want to delete this Product');
        if(x) {
            window.location = '<?php echo site_url($this->admin_folder . '/' . $this->controller_dir . '/product-delete?id=');?>' + $(this).data('id');
        }
    });

    $('body').on('click', '#selectAll', function () {

        if($(".po_status:checked").length === 1 && $("#draft").is(":checked") == true){
            $('#btnApprovepo').show();
        } else {
            $('#btnApprovepo').hide();
        }


        if ($(this).hasClass('allChecked')) {
            $('input[type="checkbox"]', '#selectcheck').prop('checked', false);
            $('#btnDisable').hide();
        } else {
            $('input[type="checkbox"]', '#selectcheck').prop('checked', true);
            $('#btnDisable').show();
        }
        $(this).toggleClass('allChecked');
    });


    $('.item-val').click(function () {
        if( $(".item-val").is(":checked") == true){
            $('#btnDisable').show();
        } else {
            $('#btnDisable').hide();
        }
    });


    $('#btnDisable').click(function () {

        var pdata = [];
        $.each($("input[name='pids']:checked"), function(){
            pdata.push($(this).val());
        });

        if(pdata != '') {
            $.ajax({
                url: '<?php echo site_url($this->admin_folder . '/catalog/mark-as-disable.html'); ?>',
                dataType: 'json',
                method: 'post',
                data: {'product_ids': pdata},
                beforeSend: function () {
                    $('.loader').show();
                },
                complete: function () {
                    $('.loader').hide();
                },
                success: function (data) {

                    $('#disable-message').show();
                    $('#disable-message').html('<h4 class="text-success">' + data.message + '</h4><p class="text-info">Window will reload in 2 seconds!</p>');
                    setTimeout(function () {
                        location.reload();
                    }, 1500);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }

    });

});

</script>
