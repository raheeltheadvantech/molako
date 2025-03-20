<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<style type="text/css">
	.edit{
		border: 2px solid #2e6ed5;;
  		padding: 25px;
  		border-radius: 10px;
	}
</style>
<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Edit Profile</div>
    </div>
</div>
<div class="containter edit">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
		</div>
		<div class="col-sm-12 col-md-8 col-md-offset-2">
			<?php echo form_open($this->user_url_prefix . '/profile.html') ?>
			<div class="login-box contact-form">

				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name'=>'first_name', 'label'=>'First name', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('first_name', $user->first_name))); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name'=>'last_name', 'label'=>'Last name', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('last_name', $user->last_name))); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name'=>'email', 'label'=>'Email', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('email', $user->email))); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name'=>'phone', 'label'=>'Phone', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('phone', $user->phone))); ?>
					</div>
				</div>
                <div class="row mb-4 mt-2">
                    <div class="col-sm-12">
                        <label>Subscribe Newsletters</label>
                        <div class="radio">
                            <label><input type="radio" value="1" name="is_newsletter" <?php echo $user->is_newsletter == 1 ? 'checked' : ''; ?>> Yes</label>
                            <label><input type="radio" value="0" name="is_newsletter" <?php echo $user->is_newsletter == 0 ? 'checked' : ''; ?> style="margin-left: 10px;"> No</label>
                        </div>
                    </div>
				</div>

				<div class="row">
					<div class="col-sm-12 text-right">
						<!-- <div class="row">
							<div class="col-sm-4"> -->
								<button type="submit" class="btn custom-button btn-block btn-100">Save</button>
							<!-- </div>
						</div> -->
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>

		</div>
	</div>
</div>
