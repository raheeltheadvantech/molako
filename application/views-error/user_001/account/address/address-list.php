<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
	.default-address-wrapper{
		position: relative;
	}
	span.default-address {
		position: absolute;
		right: 0;
		background: #cc0000;
		padding: 5px;
		border-radius: 3px;
		color: #fff;
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
							<?php echo $address->default_address == 1 ? '<div class="default-address-wrapper"><span class="default-address">Default Address</span></div>': '' ?>
							<?php echo $address->first_name ?> <?php echo $address->last_name ?><br>
							<?php echo $address->company ?><br>
							<?php echo $address->address_1 ?><br>
							<?php if($address->address_2): ?>
								<?php echo $address->address_2 ?><br>
							<?php endif; ?>
							<?php echo $address->postcode; ?>, <?php echo $address->region_name ?>, <?php echo $address->country_name ?>
						</td>
						<td class="text-right">
							<a style="color:#fff; background-color: #2e6ed5" href="<?php echo site_url($this->user_url_prefix . '/addresses/edit.html?id='. $address->address_id); ?>" class="btn btn-info">Edit</a>
							<a href="<?php echo site_url($this->user_url_prefix . '/addresses/delete.html?id='. $address->address_id); ?>" class="btn btn-danger">Delete</a>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody></table>
			</div>
			<?php else: ?>
				<h4 style="margin-bottom: 40px; line-height: 1.8;">Please complete your account profile by adding your shipping/billing address and any other required information by <a class="text-success" style="font-weight: 700;" href="<?php echo site_url($this->user_url_prefix . '/addresses/add.html'); ?>">CLICKING HERE</a></h4>
			<?php endif; ?>
			<div class="buttons clearfix">
				<div class="pull-left"><a href="<?php echo site_url($this->user_url_prefix . '/dashboard.html') ?>" class="btn btn-default">Back</a></div>
				<?php //if(isset($addresses) && empty($addresses)): ?>
				<div class="pull-right"><a href="<?php echo site_url($this->user_url_prefix . '/addresses/add.html') ?>" class="btn btn-primary">New Address</a></div>
				<?php //endif; ?>
			</div>
		</div>
	</div>
</div>
