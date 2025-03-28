<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<div class="containter">
	<div class="row">
		<div class="col-sm-12">
			<h2><?php echo $page_header; ?></h2>
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
				<thead>
				<tr>
					<td class="text-left" style="width: 50%; vertical-align: top;">Payment Address</td>
					<td class="text-left" style="width: 50%; vertical-align: top;">Shipping Address</td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="text-left">
						<?php echo $order->payment_first_name .' ' . $order->payment_last_name  ?><br>
						<?php echo $order->payment_company ?><br>
						<?php echo $order->payment_address_1 ?><br>
						<?php echo $order->payment_postcode .' '. $order->payment_zone ?><br>
						<?php echo $order->payment_country ?>
					</td>
					<td class="text-left">
						<?php echo $order->shipping_first_name .' ' . $order->shipping_last_name  ?><br>
						<?php echo $order->shipping_company ?><br>
						<?php echo $order->shipping_address_1 ?><br>
						<?php echo $order->shipping_postcode .' '. $order->shipping_zone ?><br>
						<?php echo $order->shipping_country ?>
					</td>
				</tr>
				</tbody>
			</table>
			<div class="table-responsive">
				<table class="table table-bordered table-hover">
					<thead>
					<tr>
						<td class="text-left">Product Name</td>
						<td class="text-left">Model</td>
						<td class="text-right">Quantity</td>
						<td class="text-right">Price</td>
						<td class="text-right">Total</td>
					</tr>
					</thead>
					<tbody>
					<?php if(isset($order->products) && !empty($order->products)): ?>
					<?php foreach ($order->products as $product): ?>
					<tr>
						<td class="text-left"><?php echo $product->product_name; ?></td>
						<td class="text-left"><?php echo $product->part_number ?></td>
						<td class="text-right"><?php echo $product->quantity; ?></td>
						<td class="text-right"><?php echo format_currency($product->unite_price); ?></td>
						<td class="text-right"><?php echo format_currency($product->total); ?></td>
					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					</tbody>
					<tfoot>
					<?php if(isset($order->totals) && !empty($order->totals)): ?>
					<?php foreach ($order->totals as $total): ?>
					<tr>
						<td colspan="3"></td>
						<td class="text-right"><b><?php echo ucfirst(str_replace('_', ' ', $total->title)) ?></b></td>
						<td class="text-right"><?php echo format_currency($total->value); ?></td>

					</tr>
					<?php endforeach; ?>
					<?php endif; ?>
					</tfoot>
				</table>
			</div>
			<h3>Order History</h3>
			<table class="table table-bordered table-hover">
				<thead>
				<tr>
					<td class="text-left">Date Added</td>
					<td class="text-left">Status</td>
					<td class="text-left">Comment</td>
				</tr>
				</thead>
				<tbody>
				<?php if(isset($order->history) && !empty($order->history)): ?>
				<?php foreach ($order->history as $item): ?>
				<tr>
					<td class="text-left"><?php echo format_date($item->date_added); ?></td>
					<td class="text-left"><?php echo $item->order_status_name ?></td>
					<td class="text-left"><?php echo $item->comment ?></td>
				</tr>
				<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
			<div class="buttons clearfix">
				<div class="pull-right"><a href="<?php echo site_url($this->user_url_prefix . '/order-history.html') ?>" class="btn btn-primary">Continue</a></div>
			</div>
		</div>
	</div>
</div>
