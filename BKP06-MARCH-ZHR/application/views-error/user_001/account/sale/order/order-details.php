<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style type="text/css">
	.custom-button{
		color: #fff;
		background-color: #2e6ed5;
	}
	.custom-button:hover{
		color: #fff;
		background-color: #fbb203;
	}
</style>
<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Order Status</div>
    </div>
</div>
<div class="containter">
	<div class="row">
		<div class="col-sm-12">
			<table class="table table-bordered table-hover">
				<thead style="background-color:#2e6ed5; color:#fff;">
				<tr>
					<th class="text-left">Date Added</th>
					<th class="text-left">Shipping Status</th>
					<th class="text-left">Payment Status</th>
					<th class="text-left">Comment</th>
				</tr>
				</thead>
				<tbody>
				<?php if(isset($order->history) && !empty($order->history)):?>
				<?php foreach ($order->history as $item): ?>
				<tr>
					<td class="text-left"><?php echo format_date($item->date_added); ?></td>
					<td class="text-left"><?php echo $item->order_status_name ?></td>
					<td class="text-left"><?php echo $item->payment_status_name ?></td>
					<td class="text-left"><?php echo $item->comment ?></td>
				</tr>
				<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>

			<h2 style="color: #2e6ed5;" >Order <span style="color: #ffa700;" >Detail</span></h2>
			<table class="table table-bordered table-hover">
				<thead>
				<tr>
					<td class="text-left" colspan="2">Order Details</td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="text-left" style="width: 50%;"> <b>Order ID:</b> #<?php echo $order->order_id; ?><br>
						<b>Date Added:</b> <?php echo format_date($order->date_added); ?></td>
					<td class="text-left" style="width: 50%;"> <b>Payment Method:</b> <?php echo $order->payment_method ?><br>
						<b>Shipping Method:</b> <?php echo $order->shipping_method ?> </td>
				</tr>
				</tbody>
			</table>
			<table class="table table-bordered table-hover">
				<thead style="background-color:#2e6ed5; color:#fff;">
				<tr>
					<th class="text-left" style="width: 50%; vertical-align: top;">Payment Address</th>
					<th class="text-left" style="width: 50%; vertical-align: top;">Shipping Address</th>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="text-left">
						<?php echo $order->payment_first_name .' ' . $order->payment_last_name  ?><br>
						<?php echo $order->payment_company ?><br>
						<?php echo $order->payment_address_1 ?><br>
						<?php echo $order->payment_postcode .' '. $order->payment_city ?><br>
						<?php echo $order->payment_zone ?><br>
						<?php echo $order->payment_country ?>
					</td>
					<td class="text-left">
						<?php echo $order->shipping_first_name .' ' . $order->shipping_last_name  ?><br>
						<?php echo $order->shipping_company ?><br>
						<?php echo $order->shipping_address_1 ?><br>
						<?php echo $order->shipping_postcode .' '. $order->shipping_city ?><br>
						<?php echo $order->shipping_zone ?><br>
						<?php echo $order->shipping_country ?>
					</td>
				</tr>
			</table>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead style="background-color:#2e6ed5; color:#fff;">
					<tr>
						<th class="text-left">Product Name</th>
						<th class="text-left">Model</th>
						<th class="text-right">Quantity</th>
						<th class="text-right">Price</th>
						<th class="text-right">Total</th>
					</tr>
					</thead>
					<tbody>
					<?php if(isset($order->products) && !empty($order->products)): ?>
					<?php foreach ($order->products as $product): ?>
					<tr>
						<td class="text-left"><?php echo $product->product_name; ?></td>
						<td class="text-left"><?php echo $product->sku ?></td>
						<td class="text-right"><?php echo $product->quantity; ?></td>
						<td class="text-right"><?php echo format_currency($product->unit_price); ?></td>
						<td class="text-right">
							<div class="price-box">
								<span class="original-price"><?php echo format_currency($product->total); ?></span>
							</div>
						</td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
					<tfoot>
					<?php if(isset($order->totals) && !empty($order->totals)): ?>
					<?php foreach ($order->totals as $total):
						if ($total->value != 0):?>
					<tr>
						<td colspan="3"></td>
						<td class="text-right"><b><?php echo ucfirst(str_replace('_', ' ', $total->title)) ?></b></td>
						<td class="text-right"><?php echo format_currency($total->value); ?></td>

					</tr>
					<?php endif; endforeach; ?>
					<?php endif; ?>
					</tfoot>
				</table>
				<div class="buttons clearfix" style="margin-bottom: 10px;">
				<div class="pull-right"><a href="<?php echo site_url($this->user_url_prefix . '/order-history.html') ?>" class="btn custom-button">Continue</a></div>
				</div>
			</div>
			</div>
	</div>
</div>
