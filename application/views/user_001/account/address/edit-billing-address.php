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
        <div class="heading text-center">Address's</div>
    </div>
</div>
<div class="containter edit">
	<div class="row">
		<div class="col-sm-12 col-md-8 col-md-offset-2">
		</div>
		<div class="col-sm-12 col-md-8 col-md-offset-2">
			<?php if(isset($address_id) && !empty($address_id)): ?>
			<?php echo form_open($this->user_url_prefix . '/addresses/edit.html?id='. $address_id) ?>
				<input type="hidden" name="address_id" value="<?php echo $address_id ?>">
			<?php else: ?>
			<?php echo form_open($this->user_url_prefix . '/addresses/add.html') ?>
			<?php endif; ?>
			<div class="login-box contact-form">
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name'=>'first_name', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label'=>'First Name', 'placeholder'=>'First Name', 'required' => 'required', 'class'=>'form-control', 'value'=>set_value('first_name', $first_name))); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name'=>'last_name', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label'=>'Last Name', 'placeholder'=>'Last Name', 'required' => 'required', 'class'=>'form-control', 'value'=>set_value('last_name', $last_name))); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
				<div class="row">
						</div>
						<?php echo form_input_1(array('name'=>'address_1', 'label'=>'Address', 'placeholder'=>'Address', 'required' => 'required', 'class'=>'form-control', 'value'=>set_value('address_1', $address_1))); ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name'=>'city', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label'=>'City', 'placeholder'=>'City', 'required' => 'required', 'class'=>'form-control', 'value'=>set_value('city', $city))); ?>
					</div>
				</div>
				<div class="row hidden">
					<div class="col-md-12">
						<label class="required">Country</label>
                        <?php
                        echo form_dropdown('country_id', $country_option, set_value('country_id', $country_id), 'class="form-control" id="country"');
                        ?>

					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<label class="required">State</label>
                        <?php
                        echo form_dropdown('region_id', $regions, set_value('region_id', $region_id), 'class="form-control" id="regions"');
                        ?>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name'=>'postcode', 'label'=>'Zip Code', 'placeholder'=>'postcode', 'class'=>'form-control', 'value'=>set_value('postcode', $postcode))); ?>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-offset-4 col-sm-6">
								<a href="<?php echo site_url($this->user_url_prefix . '/addresses.html') ?>" style="background-color:#0d6efd;color: #fff" class="btn btn-default btn-block btn-100">Back</a>
							</div>
							<div class="col-sm-6 text-end">
								<button type="submit" class="tf-btn w-30 radius-3 btn-fill animate-hover-btn justify-content-center">Save</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<script>
    $("#cart").click(function (){
        $("#cart").addClass('open');
    });
</script>
