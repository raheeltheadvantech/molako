<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php include('header_email.php'); ?>
	<span style="font-family: 'Helvetica Neue', Helvetica, Arial,sans-serif; font-size:12px; color:#333;">
		Dear <?php echo $order->first_name.' '.$order->last_name;?>,<br>
		<p>Thank you for placing your order with <?php echo $this->config->item('config_name')?>. If you have any questions, please do not hesitate to contact us.</p>
		<p>Following are the details of your order.</p>
	</span>
	<h2>Order Details</h2>
	<table style="width: 100%; max-width: 100%; margin-bottom: 20px; border-collapse: collapse; border-spacing: 0; background-color: transparent; border: 1px solid #ddd;">
		<thead style="display: table-header-group; vertical-align: middle; border-color: inherit;">
		<tr style="display: table-row; vertical-align: inherit; border-color: inherit;">
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0"
				colspan="2">Order Details
			</td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0; width: 50%;"
			>
				<b>Order ID:</b> #<?php echo $order->order_id; ?><br>
				<b>Date Added:</b> <?php echo format_date($order->date_added); ?>
			</td>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0; width: 50%;"
			>
				<b>Payment Method:</b> <?php echo $order->payment_method ?><br>
				<b>Shipping Method:</b> <?php echo $order->shipping_method ?> </td>
		</tr>
		</tbody>
	</table>
	<table style="width: 100%; max-width: 100%; margin-bottom: 20px; border-collapse: collapse; border-spacing: 0; background-color: transparent; border: 1px solid #ddd;">
		<thead style="display: table-header-group; vertical-align: middle; border-color: inherit;">
		<tr style="display: table-row; vertical-align: inherit; border-color: inherit;">
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0; width: 50%;"
			>
				Payment Address
			</td>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0; width: 50%;"
			>
				Shipping Address
			</td>
		</tr>
		</thead>
		<tbody>
		<tr>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0; width: 50%;"
			>
				<?php echo $order->payment_first_name .' ' . $order->payment_last_name  ?><br>
				<?php echo $order->payment_company ?><br>
				<?php echo $order->payment_address_1 ?><br>
				<?php echo $order->payment_postcode .' '. $order->payment_zone ?><br>
				<?php echo $order->payment_country ?>
			</td>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0; width: 50%;"
			>
				<?php echo $order->shipping_first_name .' ' . $order->shipping_last_name  ?><br>
				<?php echo $order->shipping_company ?><br>
				<?php echo $order->shipping_address_1 ?><br>
				<?php echo $order->shipping_postcode .' '. $order->shipping_zone ?><br>
				<?php echo $order->shipping_country ?>
			</td>
		</tr>
		</tbody>
	</table>
<table style="width: 100%; max-width: 100%; margin-bottom: 20px; border-collapse: collapse; border-spacing: 0; background-color: transparent; border: 1px solid #ddd;">
				<thead>
				<tr>
					<td class="text-left" colspan="2">Order Note</td>
				</tr>
				</thead>
				<tbody>
				<tr>
					<td class="text-left"><?php echo $order->order_note; ?></td>
				</tr>
				</tbody>
			</table>

	<table style="width: 100%; max-width: 100%; margin-bottom: 20px; border-collapse: collapse; border-spacing: 0; background-color: transparent; border: 1px solid #ddd;">
		<thead style="display: table-header-group; vertical-align: middle; border-color: inherit;">
		<tr style="display: table-row; vertical-align: inherit; border-color: inherit;">
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0;"
			>
				Product Name
			</td>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0;"
			>
				Model
			</td>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0;"
			>
				Quantity
			</td>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0;"
			>
				Orignal Price
			</td>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0;"
			>
				Price
			</td>
			<td
				style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border-top: 1px solid #ddd; border: 1px solid #ddd; border-bottom-width: 2px; border-top: 0;"
			>
				Total
			</td>
		</tr>
		</thead>
		<tbody>
		<?php if(isset($order->products) && !empty($order->products)): ?>
			<?php foreach ($order->products as $product): ?>
				<tr style="display: table-row; vertical-align: inherit; border-color: inherit;">
					<td
						style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd; border-top: 0;"
					>
						<?php echo $product->product_name; ?>
					</td>
					<td
						style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd; border-top: 0;"
					>
						<?php echo $product->sku ?>
					</td>
					<td
						style="text-align: left; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd; border-top: 0;"
					>
						<?php echo $product->quantity; ?>
					</td>
					<td
						style="text-align: right; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd; border-top: 0;"
					>
						<span style="text-decoration: bold;"><?php
							if($product->unit_price < $product->orignal_price)
							{
								?>
						
						<span style="text-decoration: line-through;     color: red;margin-left:5px;font-size"><?php echo format_currency($product->orignal_price);
						?></span>
						<?php
							}
							else
							{
								?>
								<?php echo format_currency($product->orignal_price);
						?>
								<?php
							}
						?></span>
					</td>
					<td
						style="text-align: right; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd; border-top: 0;"
					>
						<span style="text-decoration: bold;"><?php echo format_currency($product->unit_price); ?></span>
					</td>
					<td
						style="text-align: right; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd; border-top: 0;"
					>
						<span style="font-weight: bold;"><?php //echo format_currency($product->discount_total); ?></span>
						<span style="text-decoration: bold;"><?php echo format_currency($product->total); ?></span>
					</td>
				</tr>
			<?php endforeach; ?>
		<?php endif; ?>
		</tbody>
		<tfoot>
		<?php if(isset($order->totals) && !empty($order->totals)): ?>
			<?php foreach ($order->totals as $total): ?>
				<?php
				if($total->value)
				{
					?>
				<tr style="display: table-row; vertical-align: inherit; border-color: inherit;">
					<td colspan="4"></td>
					<td
						style="text-align: right; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd; border-top: 0;"
					>
						<b><?php echo ucfirst(str_replace('_', ' ', $total->title)) ?></b>
					</td>
					<td
						style="text-align: right; padding: 8px; line-height: 1.42857143; vertical-align: top; border: 1px solid #ddd; border-top: 0;"
					>
						<?php echo format_currency($total->value); ?>
					</td>

				</tr>
				<?php
				}
				
				?>
			<?php endforeach; ?>
		<?php endif; ?>
		</tfoot>
	</table>

<?php include('footer_email.php');
