<div id="checkout-cart" class="container">

	<div class="row">
		<div id="content" class="col-sm-12">
			<h1><?php echo $page_header; ?></h1>
			<form class="form-horizontal" method="post" id="form-billing-address">
				<div class="radio">
					<label>
						<input type="radio" name="billing_address" value="existing" checked="checked">
						I want to use an existing address</label>
				</div>
				<div id="shipping-existing" style="display: block;">
					<select name="address_id" class="form-control">
						<?php foreach ($addresses as $key => $address): ?>
						<option value="<?php echo $key; ?>"><?php echo $address; ?></option>
						<?php endforeach; ?>
					</select>
				</div>
                <?php if(empty($addresses)): ?>
				<div class="radio">
					<label>
						<input type="radio" name="billing_address" value="new">
						I want to use a new address</label>
				</div>
                <?php endif; ?>
				<br>
				<div id="payment-new" style="display: none;">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name' => 'first_name', 'label' => 'First Name', 'placeholder' => 'First Name', 'label_class' => 'required', 'class' => 'form-control', 'value' => set_value('first_name', $first_name))); ?>
					</div>


					<div class="col-sm-12">
						<?php echo form_input_1(array('name' => 'last_name', 'label' => 'Last Name', 'placeholder' => 'Last Name', 'label_class' => 'required', 'class' => 'form-control', 'value' => set_value('last_name', $last_name))); ?>
					</div>


					<div class="col-sm-12">
						<?php echo form_input_1(array('name' => 'company', 'label' => 'Company', 'placeholder' => 'Company', 'class' => 'form-control', 'value' => set_value('company', $company))); ?>
					</div>

					<div class="col-sm-12">
						<?php echo form_input_1(array('name' => 'address_1', 'label' => 'Address 1', 'placeholder' => 'Address 1', 'label_class' => 'required', 'class' => 'form-control', 'value' => set_value('address_1', $address_1))); ?>
					</div>

					<div class="col-sm-12">
						<?php echo form_input_1(array('name' => 'address_2', 'label' => 'Address 2', 'placeholder' => 'Address 2', 'class' => 'form-control', 'value' => set_value('address_2', $address_2))); ?>
					</div>

					<div class="col-sm-12">
						<?php echo form_input_1(array('name' => 'city', 'label' => 'City', 'placeholder' => 'City', 'label_class' => 'required', 'class' => 'form-control', 'value' => set_value('city', $city))); ?>
					</div>

					<div class="col-sm-12">
						<?php echo form_input_1(array('name' => 'postcode', 'label' => 'Post Code', 'placeholder' => 'postcode', 'class' => 'form-control', 'value' => set_value('postcode', $postcode))); ?>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label class="required">Country</label>
							<?php
							echo form_dropdown('country_id', $country_option, set_value('country_id', $country_id), 'class="form-control" id="country"');
							?>
						</div>
					</div>

					<div class="col-sm-12">
						<div class="form-group">
							<label class="required">Regions</label>
							<?php
							$options = array(
								'3613' => 'Alabama',
								'3614' => 'Alaska',
								'3615' => 'American Samoa',
								'3616' => 'Arizona',
								'3617' => 'Arkansas',
								'3618' => 'Armed Forces Africa',
								'3619' => 'Armed Forces Americas',
								'3620' => 'Armed Forces Canada',
								'3621' => 'Armed Forces Europe',
								'3622' => 'Armed Forces Middle East',
								'3623' => 'Armed Forces Pacific',
								'3624' => 'California',
								'3625' => 'Colorado',
								'3626' => 'Connecticut',
								'3627' => 'Delaware',
								'3628' => 'District of Columbia',
								'3629' => 'Federated States Of Micronesia',
								'3630' => 'Florida',
								'3631' => 'Georgia',
								'3632' => 'Guam',
								'3633' => 'Hawaii',
								'3634' => 'Idaho',
								'3635' => 'Illinois',
								'3636' => 'Indiana',
								'3637' => 'Iowa',
								'3638' => 'Kansas',
								'3639' => 'Kentucky',
								'3640' => 'Louisiana',
								'3641' => 'Maine',
								'3642' => 'Marshall Islands',
								'3643' => 'Maryland',
								'3644' => 'Massachusetts',
								'3645' => 'Michigan',
								'3646' => 'Minnesota',
								'3647' => 'Mississippi',
								'3648' => 'Missouri',
								'3649' => 'Montana',
								'3650' => 'Nebraska',
								'3651' => 'Nevada',
								'3652' => 'New Hampshire',
								'3653' => 'New Jersey',
								'3654' => 'New Mexico',
								'3655' => 'New York',
								'3656' => 'North Carolina',
								'3657' => 'North Dakota',
								'3658' => 'Northern Mariana Islands',
								'3659' => 'Ohio',
								'3660' => 'Oklahoma',
								'3661' => 'Oregon',
								'3662' => 'Palau',
								'3663' => 'Pennsylvania',
								'3664' => 'Puerto Rico',
								'3665' => 'Rhode Island',
								'3666' => 'South Carolina',
								'3667' => 'South Dakota',
								'3668' => 'Tennessee',
								'3669' => 'Texas',
								'3670' => 'Utah',
								'3671' => 'Vermont',
								'3672' => 'Virgin Islands',
								'3673' => 'Virginia',
								'3674' => 'Washington',
								'3675' => 'West Virginia',
								'3676' => 'Wisconsin',
								'3677' => 'Wyoming',
							);
							echo form_dropdown('region_id', $options, set_value('region_id', $region_id), 'class="form-control" id="regions"');
							?>
						</div>
					</div>
				</div>
				<div class="buttons clearfix">
					<!--<div class="pull-right"><a href="<?php /*echo site_url('checkout/shipping-address.html'); */?>" class="btn btn-primary">Continue to Checkout</a></div>-->
					<div class="pull-right">
						<button type="submit" class="btn btn-primary">Continue to Checkout</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript"><!--
	$('input[name=\'billing_address\']').on('change', function () {
		if (this.value == 'new') {
			$('#shipping-existing').hide();
			$('#payment-new').show();
		} else {
			$('#shipping-existing').show();
			$('#payment-new').hide();
		}
	});
	//-->
</script>
<script type="text/javascript">
	$(document).on('change','#country',function(){
		$.post('http://localhost/www/mccormack-racing/admin/locations/ajax/zones-menu.html',{
			id:$(this).val(), 'ci_csrf_token' : ''}, function(data) {
			$('#regions').empty().append(data);

		});
	});
</script>
