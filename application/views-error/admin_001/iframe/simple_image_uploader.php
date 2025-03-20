<style>
.form-uploader .control_001{ display:inline-block;}
</style>

<script type="text/javascript">
<?php if( $this->input->post('submitted') ):?>
$(window).ready(function(){
	$('#iframe_uploader<?php echo isset($image_type) ? '_'.$image_type : '';?>', window.parent.document).height($('body').height());
});
<?php endif;?>

<?php if($file_name):?>
	parent.add_image(<?php echo isset($image_type) ? '\''.$image_type.'\', ' : ''?>'<?php echo $file_name;?>', '<?php echo $file_name_orig;?>');
<?php endif;?>

</script>

<?php if (!empty($error)): ?>
<div class="alert alert-danger fade in">
	<button class="close" data-dismiss="alert">×</button>
    <i class="fa-fw fa fa-warning"></i> <?php echo $error; ?>
</div>
<?php endif; ?>

<div class="form-uploader">
	<?php echo form_open_multipart($form_action, 'class="form-inline"');?>

        <div class="control_001">
        <?php echo form_upload(array('name'=>'userfile', 'id'=>'userfile', 'class'=>'input-file'));?>
        </div>
        <div class="control_001">
        <input class="btn" name="submit" type="submit" value="Upload<?php //echo lang('upload');?>" />
        </div>

<?php if(isset($image_type)) : ?>
<?php
$data	= array('name'=>'image_type', 'value'=>set_value('image_type', $image_type), 'type'=>'hidden');
echo form_input($data);
?>
<?php endif; ?>

	<?php echo form_close(); ?>
</div>

