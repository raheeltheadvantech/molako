<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
    .toolbar-products .pages ul li a{
        width: 44px;
    }
</style>
<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Order History</div>
    </div>
</div>
<div class="containter">
	<div class="row">
		<div class="col-sm-12">
		</div>
		<div class="col-sm-12">
			<div class="table-responsive">
				<table class="table table-hover">
					<thead style="background-color:#2e6ed5; color:#fff;">
					<tr>
						<!--<td class="text-right">Order ID</td>-->
                        <th class="text-right">ID</th>
						<th class="text-right">No. of Products</th>
						<th class="text-left">Shipping Status</th>
						<th class="text-left">Payment Status</th>
						<th class="text-right">Total</th>
						<th class="text-left">Date Added</th>
						<td></td>
					</tr>
					</thead>
					<tbody>
					<?php if(isset($orders) && !empty($orders)): ?>
					<?php foreach ($orders as $order): ?>
					<tr>
						<td class="text-right">#<?php echo $order->order_id;  ?></td>
						<td class="text-right"><?php echo $order->no_of_products;  ?></td>
						<td class="text-left"><?php echo $order->order_status_name ?></td>
						<td class="text-left"><?php echo $order->order_payment_status ?></td>
						<td class="text-right">Rs <?php echo ($order->total) ?></td>
						<td class="text-left"><?php echo format_date($order->date_added); ?></td>
						<td class="text-right"><a href="<?php echo site_url($this->user_url_prefix . '/order-history-detail.html?id='. $order->order_id) ?>" data-toggle="tooltip" title="" style="color: #fff; " class="tf-btn w-10 radius-3 btn-fill animate-hover-btn justify-content-center" data-original-title="View"><i class="icon icon-view"></i></a></td>
					</tr>
					<?php endforeach; ?>
					<?php else: ?>
					<tr>
						<td colspan="8" class="text-center text-info">No order history to display.</td>
					</tr>
					<?php endif; ?>
					</tbody>
				</table>
			</div>
            <div class="toolbar toolbar-products toolbar-bottom">
                <?php echo $this->pagination->create_links_html2();?>
			</div>
		</div>
	</div>
</div>
