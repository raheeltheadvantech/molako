<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
	.default-address-wrapper{
		position: relative;
	}
	span.default-address {
    position: absolute;
    background: #cc0000;
    padding: 12px;
    border-radius: 3px;
    color: #fff;
    width: 140px;
}
</style>
<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Address's</div>
    </div>
</div>
<div class="containter">
	<div class="row">
		<div class="col-sm-12">
		</div>
		<div class="col-sm-12 ">
			<?php if(isset($addresses) && !empty($addresses)): ?>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<tbody>
					<?php foreach ($addresses as $address): ?>
					<tr>
						<td class="text-left">
							<?php echo $address->first_name ?> <?php echo $address->last_name ?><br>
							<?php echo $address->company ?><br>
							<?php echo $address->address_1 ?><br>
							<?php if($address->address_2): ?>
								<?php echo $address->address_2 ?><br>
							<?php endif; ?>
							<?php echo $address->postcode; ?>, <?php echo $address->region_name ?>, <?php echo $address->country_name ?>
						</td>
						<td class="text-right">
							<a style="color:#fff;" href="<?php echo site_url($this->user_url_prefix . '/addresses/edit.html?id='. $address->address_id); ?>" class="tf-btn w-10 radius-3 btn-fill animate-hover-btn justify-content-center">Edit</a>
							<a href="<?php echo site_url($this->user_url_prefix . '/addresses/delete.html?id='. $address->address_id); ?>" class="tf-btn w-10 radius-3 btn-fill animate-hover-btn justify-content-center">Delete</a>
							<?php
							if($address->default_address)
							{
								echo $address->default_address == 1 ? '<div class="default-address-wrapper"><span class="default-address">Default Address</span></div>': '';
							}
							else{
								?>
								<a href="<?php echo site_url($this->user_url_prefix . '/addresses/make_default.html?id='. $address->address_id); ?>" class="tf-btn w-10 radius-3 btn-fill animate-hover-btn justify-content-center">Make Default</a>
								<?php
							}
							?>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody></table>
			</div>
			<?php else: ?>
				<h5 style="margin-bottom: 40px; line-height: 1.8;">Please complete your account profile by adding your shipping/billing address and any other required information by <a class="text-success" style="font-weight: 700;" href="<?php echo site_url($this->user_url_prefix . '/addresses/add.html'); ?>">CLICKING HERE</a></h5>
			<?php endif; ?>
			<div class="buttons clearfix">
				<?php //if(isset($addresses) && empty($addresses)): ?>
				<div class="pull-right text-start "><a href="<?php echo site_url($this->user_url_prefix . '/addresses/add.html') ?>" class="tf-btn w-40 radius-3 btn-fill animate-hover-btn justify-content-center">New Address</a></div>
				<?php //endif; ?>
			</div>
		</div>
	</div>
</div>
