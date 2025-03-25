<div id="checkout-cart" class="container">

	<div class="row">
		<div id="content" class="col-sm-12">
			<h1><?php echo $page_header; ?></h1>
			<form class="form-horizontal" method="post" id="form-billing-address">
				<?php $first_flag = true; ?>
				<?php foreach ($shipping_methods as $key => $shipping_method): ?>
				<?php if($shipping_method[$key.'_status']): ?>
				<div class="radio">
					<label><input type="radio" <?php echo $first_flag ? 'checked="checked"' : ''; ?> name="shipping-method" value="<?php echo $key ?>"><?php echo $shipping_method[$key.'_title'] ?> (cost: <?php echo format_currency($shipping_method[$key.'_cost']) ?>)</label>
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

<script type="text/javascript"><!--
	$('input[name=\'shipping-address\']').on('change', function () {
		if (this.value == 'new') {
			$('#shipping-existing').hide();
			$('#payment-new').show();
		} else {
			$('#shipping-existing').show();
			$('#payment-new').hide();
		}
	});
	//--></script>
