<?php //include('header.php'); ?>

<?php echo form_open($this->admin_url.'/'. $this->controller_dir.'/admin_coupon_code/form/'.$id, 'class="form2"'); ?>



<div class="panel with-nav-tabs panel-default">
	<div class="panel-heading">
        <h3 class="panel-title">Coupon Code Form</h3>
	</div>
    <div class="panel-body">

        <div class="box-body">
            <div class="row">
                 <div class="col-sm-4">
                    <?php 
                    $data = array('name'=>'coupon_name', 'label'=>"Coupon Name", 'placeholder'=>"Coupon Name", 'class'=>'form-control', 'value'=>set_value('coupon_name', $coupon_name));
                    echo form_input_1($data); 
                    ?>
                </div>
                <div class="col-sm-4">
                    <?php 
                    $data = array('name'=>'coupon_code', 'label'=>'Coupon Code', 'placeholder'=>'Coupon Code', 'class'=>'form-control', 'value'=>set_value('coupon_code', $coupon_code));
                    echo form_input_1($data); 
                    ?>
                </div>
                <div class="col-sm-4">
                    <?php 
                    $data = array('name'=>'coupon_count', 'label'=>'Coupon Count', 'placeholder'=>'Coupon Count', 'class'=>'form-control', 'value'=>set_value('coupon_count', $coupon_count));
                    echo form_input_1($data); 
                    ?>
                </div>
                <div class="col-sm-4">
                    <label>Discount Type</label>
                    <?php
                    $data   = array('name'=>'discount_type','label'=>'Discount Type', 'class'=>'form-control', 'id'=>'discount_type');
                    echo form_dropdown($data, $discount_type_list, set_value('discount_type', $discount_type));
                    ?>
                </div>
                <div class="col-sm-4">
                    <?php 
                    $data = array('name'=>'discount_value', 'label'=>'Discount Value', 'placeholder'=>'Discount Value', 'class'=>'form-control', 'value'=>set_value('discount_value', $discount_value));
                    echo form_input_1($data); 
                    ?>
                </div>
                <div class="col-sm-2">
                    <?php 
                    $data = array('name'=>'start_date', 'label'=>'Start Date', 'class'=>'form-control date_ex', 'value'=>set_value('start_date', $start_date));
                    echo form_input_1($data); 
                    ?>
                </div>
                <div class="col-sm-2">
                    <?php 
                    $data = array('name'=>'end_date', 'label'=>'End Date', 'class'=>'form-control date_ex', 'value'=>set_value('end_date', $end_date));
                    echo form_input_1($data); 
                    ?>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <label>Is enabled</label>
                    <?php
                    $options = array(
                        '1' => lang('enabled'),
                        '0' => lang('disabled')
                    );
                    echo form_dropdown('enabled', $options, set_value('enabled', $enabled), 'class="form-control"');
                    ?>
                </div>
            </div>
        </div>
	</div>
    <div class="panel-footer">
        <button type="submit" class="btn btn-primary">Save</button>
        <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder . '/' . $this->controller_dir . '/coupon_code.html'); ?>">Back</a>
    </div>
    
</div>
</form>
<script src="<?php echo base_url(); ?>assets/admin_001/new/vendor/tinymce/tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_001/new/vendor/tinymce/jquery.tinymce.min.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_001/new/vendor/tinymce/tinymce_properties.js"></script>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	
	$('form').submit(function() {
		$('.btn').attr('disabled', true).addClass('disabled');
	});
    $(".date_ex").datepicker({ dateFormat: 'yy-mm-dd' });
		
});
//]]>
</script>

<?php //include('footer.php'); ?>