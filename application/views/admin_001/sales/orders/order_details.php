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
					<?php
					if(!$order->shipping_method)
					{
						$order->shipping_method = 'free';
					}

					?>
					<td class="text-left" style="width: 50%;"> <b>Order ID:</b> #<?php echo $order->order_id; ?><br>
						<b>Date Added:</b> <?php echo format_date($order->date_added); ?></td>
					<td class="text-left" style="width: 50%;"> <b>Payment Method:</b> <?php echo $order->payment_method ?><br>
						<b>Shipping Method:</b> <?php echo (isset($smethods[$order->shipping_method]['title'])?$smethods[$order->shipping_method]['title']:$order->shipping_method); ?> </td>
				</tr>
				</tbody>
			</table>

			<table class="table table-bordered table-hover">
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

            <table class="table table-bordered table-hover">
                <thead>
                <tr>
                    <td class="text-left" colspan="2">Customer Detail</td>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="text-left" style="width: 50%;"> <b>Name:</b> <?php echo $order->first_name.' '.$order->last_name;?><br>
                        <b>Email:</b> <?php echo $order->email; ?></td>
                    <td class="text-left" style="width: 50%;"> <b>City:</b> <?php echo $order->payment_city ?><br>
                        <b>Phone:</b> <?php echo $order->telephone ?> </td>
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
						<?php echo $order->payment_city .', '.$order->payment_zone  .', '. $order->payment_postcode ?><br>
						<?php echo $order->payment_country ?>
					</td>
					<td class="text-left">
						<?php echo $order->shipping_first_name .' ' . $order->shipping_last_name  ?><br>
						<?php echo $order->shipping_company ?><br>
						<?php echo $order->shipping_address_1 ?><br>
						<?php echo  $order->shipping_city .', '.$order->shipping_zone .', '. $order->shipping_postcode ?><br>
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
						<td class="text-left"><?php echo $product->sku; ?></td>
						<td class="text-right"><?php echo $product->quantity; ?></td>
						<td class="text-right"><?php echo format_currency($product->unit_price); ?></td>
						<td class="text-right"><?php echo format_currency($product->total); ?></td>
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
			</div>
			<h3>Order Status</h3>
			<table class="table table-bordered table-hover">
				<thead>
				<tr>
					<td class="text-left">Date Added</td>
					<td class="text-left">Shipping Status</td>
					<td class="text-left">Payment Status</td>
					<td class="text-left">Comment</td>
				</tr>
				</thead>
				<tbody>
				<?php if(isset($order->history) && !empty($order->history)): ?>
				<?php $status_id = 0;$status_id2 = 0;
					foreach ($order->history as $key => $item): 
						if ($key == 0) {
							$status_id = $item->order_status_id;
							$status_id2 = $item->payment_status_id;
						}
					?>
				<tr>
					<td class="text-left"><?php echo format_date($item->date_added); ?></td>
					<td class="text-left"><?php echo $item->order_shipping_status ?></td>
					<td class="text-left"><?php echo $item->order_payment_status ?></td>
					<td class="text-left"><?php echo $item->comment ?></td>
				</tr>
				<?php endforeach; ?>
				<?php endif; ?>
				</tbody>
			</table>
			<fieldset>
				<legend>Amend Status</legend>
				<form class="form-horizontal" action="<?php echo site_url($this->admin_url. '/sales/orders/add-order-history.html?id='. $order->order_id); ?>" method="post" id="order-history-form">
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-order-status">Order Shipping Status</label>
						<div class="col-sm-10">
							<select name="order_status_id" id="input-order-status" class="form-control">
								<?php if(isset($order_status) && !empty($order_status)): ?>
								<?php foreach ($order_status as $status): 
									if ($status->name != 'Payment'):
									$selected = ($status->order_status_id === $status_id) ? 'selected="selected"': '';?>
										<option value="<?php echo $status->order_status_id; ?>" <?php echo $selected; ?>><?php echo $status->name ?></option>
								<?php endif; endforeach; ?>
								<?php endif; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-order-status">Order Payment Status</label>
						<div class="col-sm-10">
							<select name="payment_status_id" id="input-order-status" class="form-control">
								<?php if(isset($order_status) && !empty($order_status)): ?>
								<?php foreach ($order_status as $status): 
									if ($status->name == 'Pending' || $status->name == 'Completed'
										|| $status->name == 'Canceled'):
									$selected = ($status->order_status_id === $status_id2) ? 'selected="selected"': '';?>
										<option value="<?php echo $status->order_status_id; ?>" <?php echo $selected; ?>><?php echo $status->name ?></option>
								<?php endif; endforeach; ?>
								<?php endif; ?>
							</select>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-notify">Notify Customer</label>
						<div class="col-sm-10">
							<input type="checkbox" name="notify" value="1" id="input-notify">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label" for="input-comment">Comment</label>
						<div class="col-sm-10">
							<textarea name="comment" rows="8" id="input-comment" class="form-control"></textarea>
						</div>
					</div>
				</form>
			</fieldset>
			<div class="buttons clearfix">
				<div class="pull-left"><a href="<?php echo site_url($this->admin_folder .'/sales/orders.html') ?>" class="btn btn-primary">Back</a></div>
				<div class="pull-right">
					<button id="button-history" data-loading-text="Loading..." class="btn btn-primary"><i class="fa fa-plus-circle"></i> Add History</button>

				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).on('click','#button-history', function () {
		$('#order-history-form').submit();
	});
</script>
