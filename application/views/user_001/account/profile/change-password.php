<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style type="text/css">
	.edit{
		border: 2px solid #2e6ed5;
  		padding: 25px;
  		border-radius: 10px;
	}
</style>
<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Change Password</div>
    </div>
</div>
<div class="containter edit">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
		</div>
		<div class="col-sm-12 col-md-8 col-md-offset-2">
			<?php echo form_open($this->user_url_prefix .'/change-password.html') ?>
			<div class="login-box contact-form">
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('type'=>'password','name'=>'old_password', 'label'=>'Old Password', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('old_password', $old_password))); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('type'=>'password','name'=>'new_password', 'label'=>'New Password', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('new_password', $new_password))); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('type'=>'password','name'=>'confirm_password', 'label'=>'Confirm Password', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('confirm_password', $confirm_password))); ?>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-sm-12 text-end">
						<button type="submit" class="tf-btn w-40 radius-3 btn-fill animate-hover-btn justify-content-center">Save</button>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
