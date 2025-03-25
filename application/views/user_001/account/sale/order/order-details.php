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
			<table style="width: 100%; max-width: 100%; margin-bottom: 20px; border-collapse: collapse; border-spacing: 0; background-color: transparent; border: 1px solid #ddd;" class="table table-bordered ">
				<thead style="background-color:#2e6ed5; color:#fff;">
				<tr>
					<th class="text-left"><b>Date Added </b></th>
					<th class="text-left"><b> Shipping Status</b></th>
					<th class="text-left"> <b>Payment Status</b></th>
					<th class="text-left"> <b>Comment</b></th>
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

			<h4 style="color: #2e6ed5;" >Order <span style="color: #ffa700;" >Detail</span></h4>
			<table style="width: 100%; max-width: 100%; margin-bottom: 20px; border-collapse: collapse; border-spacing: 0; background-color: transparent; border: 1px solid #ddd;" class="table table-bordered ">
				<tbody>
				<tr>
					<td class="text-left" style="width: 50%;"> <b>Order ID:</b> #<?php echo $order->order_id; ?><br>
						<b>Date Added:</b> <?php echo format_date($order->date_added); ?></td>
					<td class="text-left" style="width: 50%;"> <b>Payment Method:</b> <?php echo $order->payment_method ?><br>
						<?php
					if(!$order->shipping_method)
					{
						$order->shipping_method = 'free';
					}

					?>
						<b>Shipping Method:</b> <?php echo (isset($smethods[$order->shipping_method]['title'])?$smethods[$order->shipping_method]['title']:$order->shipping_method); ?> </td>
				</tr>
				</tbody>
			</table>
			<table style="width: 100%; max-width: 100%; margin-bottom: 20px; border-collapse: collapse; border-spacing: 0; background-color: transparent; border: 1px solid #ddd;" class="table table-bordered ">
				<thead>
				<tr>
					<td class="text-left" colspan="2"><b>Order Note</b></td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="text-left" ><?php echo $order->order_note; ?></td>
				</tr>
				</tbody>
			</table>
			<table style="width: 100%; max-width: 100%; margin-bottom: 20px; border-collapse: collapse; border-spacing: 0; background-color: transparent; border: 1px solid #ddd;" class="table table-bordered ">
				<thead style="background-color:#2e6ed5; color:#fff;">
				<tr>
					<th class="text-left" style="width: 50%; vertical-align: top;"><b>Payment Address</b></th>
					<th class="text-left" style="width: 50%; vertical-align: top;"><b>Shipping Address</b></th>
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
				<table style="width: 100%; max-width: 100%; margin-bottom: 20px; border-collapse: collapse; border-spacing: 0; background-color: transparent; border: 1px solid #ddd;" class="table table-bordered ">
					<thead style="background-color:#2e6ed5; color:#fff;">
					<tr>
						<th class="text-left"><b>Product Name</b></th>
						<th class="text-left"><b>Model</b></th>
						<th class="text-right"><b>Quantity</b></th>
						<th class="text-right"><b>Price</b></th>
						<th class="text-right"><b>Total</b></th>
					</tr>
					</thead>
					<tbody>
					<?php if(isset($order->products) && !empty($order->products)): ?>
					<?php foreach ($order->products as $product): ?>
					<tr>
						<td class="text-left"><?php echo $product->product_name; ?><br><?php echo $product->orignal_price?'<span style="left: -10px; color:red;" class="cut_price">'.format_currency($product->orignal_price).'</span>':'' ?></td>
						<td class="text-left"><?php echo $product->sku ?></td>
						<td class="text-right"><?php echo $product->quantity; ?></td>
						<?php
						$price = $product->unit_price;
						?>
						<td class="text-right"> <?php echo format_currency($product->unit_price); ?></td>
						<td class="text-right">
							<div class="price-box">
								<span class="original-price"> <?php echo format_currency($product->total); ?></span>
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
						<td class="text-right"> <?php echo format_currency($total->value); ?></td>

					</tr>
					<?php endif; endforeach; ?>
					<?php endif; ?>
					</tfoot>
				</table>
				<div class="buttons clearfix" style="margin-bottom: 10px;">
				<div class="pull-right"><a href="<?php echo site_url($this->user_url_prefix . '/order-history.html') ?>" class="tf-btn w-30 radius-3 btn-fill animate-hover-btn justify-content-center">Continue</a></div>
				</div>
			</div>
			</div>
	</div>
</div>
