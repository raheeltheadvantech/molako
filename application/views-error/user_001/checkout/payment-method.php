<div id="checkout-cart" class="container">

	<div class="row">
		<div id="content" class="col-sm-12">
			<h1><?php echo $page_header; ?></h1>
			<form class="form-horizontal" method="post" id="form-billing-address">
				<?php $first_flag = true; ?>
				<?php foreach ($payment_methods as $key => $payment_method): ?>
				<?php if($payment_method[$key.'_status']): ?>
				<div class="radio">
					<label><input type="radio" <?php echo $first_flag ? 'checked="checked"' : ''; ?> name="payment-method" value="<?php echo $key ?>"><?php echo $payment_method[$key.'_title'] ?></label>
				</div>
				<?php $first_flag = false; ?>
				<?php  endif; ?>
				<?php endforeach; ?>
				</div>
				<div class="buttons clearfix">
					<div class="pull-right">
						<button type="submit" class="btn btn-primary">Continue to Checkout</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
