<style>
	input[readonly]{
		background-color:transparent !important;
	}
	input[readonly]:before{
		content: 'Readonly';
	}
</style>
<div class="container">
<div class="row">
	<div class="container content-pages">
		<div id="content" class="col-sm-12 pages-text">
			<h1>Join <strong>The Club</strong></h1>
			<p>
				<strong>The Club</strong> from McCormack Racing gives you access to discounts on your orders with us online. The
				discount can be taken on regular priced products, sales and even promotions! Sign up below and get
				INSTANT access to all these savings! Watch your email from time to time for different codes to save in
				different ways.
			</p>
                <p class="hidden"><strong>If you already registered for the site, you are automatically a member!</strong></p>
            <p>All fields with an asterisk (*) are required.</p>
			<?php echo form_open(site_url('club.html')) ?>
			<div class="row">
				<div class="col-sm-12 col-md-6">
                        <?php echo form_input_1(array('name' => 'first_name', 'label' => 'First Name *', 'placeholder' => 'Enter your first name here...','readonly' => 'readonly', 'class' => 'form-control', 'value' => set_value('first_name', $first_name))); ?>
				</div>
				<div class="col-sm-12 col-md-6">
                        <?php echo form_input_1(array('name' => 'last_name', 'label' => 'Last Name *', 'placeholder' => 'Enter your last name here...','readonly' => 'readonly', 'class' => 'form-control', 'value' => set_value('last_name', $last_name))); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 col-md-6">
                        <?php echo form_input_1(array('name' => 'email', 'label' => 'Email *', 'placeholder' => 'Enter your email address here...','readonly' => 'readonly', 'class' => 'form-control', 'value' => set_value('email', $email))); ?>
				</div>
				<div class="col-sm-12 col-md-6">
                        <?php echo form_input_1(array('name' => 'phone', 'label' => 'Phone *', 'placeholder' => 'Enter your phone number i.e. 555-555-5555','readonly' => 'readonly', 'class' => 'form-control', 'value' => set_value('phone', $phone))); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 col-md-6">
                        <?php echo form_input_1(array('name' => 'address', 'label' => 'Address', 'placeholder' => 'Enter your address here...', 'class' => 'form-control', 'value' => set_value('address', $address))); ?>
				</div>
				<div class="col-sm-12 col-md-6">
                        <?php echo form_input_1(array('name' => 'city', 'label' => 'City', 'placeholder' => 'Enter your city here...', 'class' => 'form-control', 'value' => set_value('city', $city))); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 col-md-6">
                        <?php echo form_input_1(array('name' => 'state', 'label' => 'State', 'placeholder' => 'Enter your state here...', 'class' => 'form-control', 'value' => set_value('state', $state))); ?>
				</div>
				<div class="col-sm-12 col-md-6">
                        <?php echo form_input_1(array('name' => 'zip_code', 'label' => 'Zip Code', 'placeholder' => 'Enter your zip code here...', 'class' => 'form-control', 'value' => set_value('zip_code', $zip_code))); ?>
				</div>
			</div>

			<div class="row">
				<div class="col-sm-12 col-md-4 col-md-offset-5">
					<button class="btn btn-primary button" type="submit">Join the Club</button>
				</div>
			</div>
			<?php echo form_close(); ?>
            </div>
		</div>
	</div>
</div>
