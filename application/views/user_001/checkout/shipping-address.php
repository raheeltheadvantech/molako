
<style type="text/css">
	.text-right{ text-align: right; }
	.btn-default{ 
		background: lightgray;}
		.edit{
			margin: 10px;
		border: 2px solid #2e6ed5;;
  		padding: 25px;
  		border-radius: 10px;
	}
</style>
<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Shipping Address</div>
    </div>
</div>
<div class="single-product-description " style="margin-bottom: 5px;">
	<div class="container contact-form">
		<div class="row ">
			<div class="col-sm-12 col-md-3"></div>
			<div class="edit col-sm-12 col-md-6 col-md-offset-2">
				<?php echo form_open('checkout/shipping/address.html');?>
				<div class="login-box">
					<div class="col-sm-12">
						<?php echo form_input_1(array('name' => 'first_name', 'onkeydown'=>'return /[a-z\s]/i.test(event.key)', 'label' => 'Full Name', 'placeholder' => 'Full Name', 'label_class' => 'required', 'class' => 'form-control', 'value' => set_value('first_name', $first_name))); ?>
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
							<?php echo form_input_1(array('name'=>'city', 'onkeydown'=>'return /[a-z]/i.test(event.key)', 'label'=>'City', 'placeholder'=>'City', 'required' => 'required', 'class'=>'form-control', 'value'=>set_value('city', $city))); ?>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12">
							<?php echo form_input_1(array('name'=>'postcode', 'label'=>'Zip Code', 'placeholder'=>'postcode', 'class'=>'form-control', 'value'=>set_value('postcode', $postcode))); ?>
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
						<div class="col-md-12 form-group">
							<label class="required">State</label>
	                        <?php
	                        echo form_dropdown('region_id', $regions, set_value('region_id', $region_id), 'class="form-control" id="regions"');
	                        ?>
						</div>
					</div>
					
					<div class="row hidden">
						<div class="col-md-12 ">
							<label class="radio-inline">
								Default Address
							</label>
							<label class="radio-inline">
								<input type="radio" name="default_address" value="0">No
							</label>
							<label class="radio-inline">
								<input type="radio" name="default_address" value="1" checked>Yes
							</label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-12 text-right mt-3">
							<a href="<?php echo site_url($this->user_url . '/checkout/shipping.html') ?>" class="btn btn-default" style="padding: 7px 10px;">Back</a>
							<button type="submit" class="tf-btn w-40 radius-3 btn-fill animate-hover-btn justify-content-center">Save & Continue</button>
						</div>
					</div>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>

<script>
    $("#cart").click(function (){
        $("#cart").addClass('open');
    });
    $(function(){
        $('#country_id').on('change',function(){

            var country_id = $('#country_id option:selected').val();
            console.log('country_id',country_id);
            $.ajax({
                url: '<?php echo site_url($this->user_url_prefix . '/addresses/country-region.html'); ?>',
                type: 'post',
                data: 'country_id=' + country_id,
                dataType: 'json',
                beforeSend: function() {
                    //$('#button-cart').button('loading');
                },
                complete: function() {
                    //  $('#button-cart').button('reset');
                },
                success: function(json) {
                    if (json['result'] == true) {

                        var states =  json['data'];
                        console.log(states);
                        $('#regions').empty();
                        $.each(states,function(key,val){
                            var opt = $('<option />');
                            opt.val(key);
                            opt.text(val);
                            $('#regions').append(opt);
                        });

                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });

        });
    });
</script>
