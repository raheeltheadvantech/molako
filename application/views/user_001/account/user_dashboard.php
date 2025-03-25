<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
	.profilebg {
		padding: 15px;
  		border: 2px solid #2e6ed5;
		border-radius: 5px;
		margin-bottom: 20px;
	}
	.profile_name {
		font-size: 20px;
		text-transform: uppercase;
		font-weight: bold;
	}
	.profile_detail {
		color: #023047;
	}

	.profilebtn .btn-circle.btn-lg {
		width: 50px;
		height: 50px;
		padding: 10px 16px;
		line-height: 1.33;
		border-radius: 25px;
		font-size: 18px;
		text-align: center;
		margin-right: 10px;
	}
	.btn-info{
		border: none;
		color: #fff;
		background-color: #2E6ED5;
	}
	.btn-inverse {
		color: #ffffff;
		text-shadow: 0 -1px 0 rgba(0, 0, 0, 0.25);
		background-color: #363636;
		background-image: linear-gradient(to bottom, #444444, #222222);
		background-repeat: repeat-x;
		border-color: #222222 #222222 #000000;
	}
	a.btn:hover{
		background-color: #ffa700 !important;
	}

	.acc_cards {
/*		background-color: #023047;*/
  		border-bottom: 3px solid #ffa700 !important;
	}

	.acc_cards {
		border-radius: 5px;
		padding: 15px;
		border: 1px solid #2e6ed5;
		margin-bottom: 20px;
	}

	.acc_cards .title {
		color: #023047;
		text-transform: uppercase;
		font-size: 16px;
		border-bottom: 1px solid #fba70e;
		padding-bottom: 8px;
	}

	.acc_cards .card_content {
		min-height: 150px;
		text-align: center;
	}

	.acc_cards .card_content .num {
		color: #023047 !important;
	}

	.acc_cards .card_content .num {
		display: block;
		font-size: 85px;
		line-height: 85px;
		margin: 0;
	}

	.add_line {
		text-transform: uppercase;
		font-size: 16px;
		text-align: center;
	}

	.add_line span {
		color: #229ac8;
	}
	.add_line span {
		color: #229ac8;
	}
	.bottom_card.text-center a{
		color: #023047;
		font-size: 12px;
	}

	.profile_detail p:last-child {
		margin-bottom: 0px;
	}

	.profile_detail p {
		margin-bottom: 5px;
	}

	thead {
		background: #e0dfda;
		color: #000000;
	}

</style>
<div class="tf-page-title style-2">
            <div class="container-full">
                <div class="heading text-center">Dashboard</div>
            </div>
        </div>
	<div class="profilebg">
		<div class="row">
			<div class="col-sm-2">
				<ul class="list-inline">
					<li>
						<div class="profile_pic img-circle">
							<img src="<?php echo base_url($this->site_config->item('config_avatar')) ?>" alt="Name" height="100px" width="100px" class="img-responsive img-circle">
						</div>
					</li>
					<li>
						
					</li>
				</ul>
			</div>
			<div class="col-sm-10">
				<div class="profilebtn mt-3">
					<div class="profile_detail">
							<p class="profile_name"><i class="fa fa-user" style="font-size: 25px;"></i> <?php echo $user->first_name .' '. $user->last_name ?></p>
							<p class="profile_text"><i class="fa fa-envelope"></i> <?php echo $user->email ?></p>
							<p class="profile_text"><i class="fa fa-phone"></i> <?php echo $user->phone; ?></p>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-4">
			<div class="acc_cards">
				<div class="title">
					Total Orders <span class="pull-right"><i class="fa fa-shopping-bag text-right"></i></span>
				</div>
				<div class="card_content">
					<p class="num"><?php echo $total_orders; ?></p>
					<p style="color: #023047 ;">My Orders</p>
				</div>
				<div class="bottom_card text-center">
					<a href="<?php echo site_url($this->user_url_prefix . '/order-history.html') ?>">View all Orders</a>
				</div>
			</div> 
		</div>
		<div class="col-sm-4">
			<div class="acc_cards">
				<div class="title">
					Total WishList <span class="pull-right"><i class="fa fa-heart text-right"></i></span>
				</div>
				<div class="card_content">
					<p class="num"><?php echo $total_wish_list_items; ?></p>
					<p style="color: #023047 ;">Products</p>
				</div>
				<div class="bottom_card text-center">
					<a href="<?php echo site_url($this->user_url_prefix . '/wishlist.html') ?>">View Wishlist</a>
				</div>
			</div>
		</div>
		<div class="col-sm-4">
			<div class="acc_cards">
				<div class="title">
					Cart Items <span class="pull-right"><i class="fa fa-shopping-cart text-right"></i></span>
				</div>
				<div class="card_content">
					<p class="num"><?php echo $total_cart_items; ?></p>
					<p style="color: #023047 ;">Total items in your cart</p>
				</div>
				<div class="bottom_card text-center">
					<a href="<?php echo site_url('checkout/cart.html') ?>">View Your Cart</a>
				</div>
			</div>
		</div>
		<?php if(isset($latest_orders) && !empty($latest_orders)): ?>
		<div class="col-sm-12">
			<div class="list-group">
				<h4 style="color: #2E6ED5;" >Latest <span style="color: #ffa700;" >Orders</span></h4>
				<!-- <h4 style="color: #ffa700;"> </h4> -->
			</div>
			<div class="table-responsive">
				<table class="table table-hover">
					<thead style="color: #fff; background-color: #2E6ED5;">
						<tr>
							<th>ID</th>
							<th>No. of Products</th>
							<th>Status</th>
							<th>Total</th>
							<th>Date Added</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody style="border-top:none;">
					<?php foreach ($latest_orders as $order): ?>
					<tr>
						<td class="text-right">#<?php echo $order->order_id; ?></td>
						<!-- <td class="text-left"><?php echo $order->first_name .' '. $order->last_name; ?></td> -->
						<td class="text-right"><?php echo $order->no_of_products; ?></td>
						<td class="text-left"><?php echo $order->order_status_name; ?></td>
						<td class="text-right">Rs <?php echo number_format($order->total,2); ?></td>
						<td class="text-left"><?php echo format_date($order->date_added) ?></td>
						<td class="text-right"><a href="<?php echo site_url($this->user_url_prefix . '/order-history-detail.html?id='. $order->order_id) ?>" data-toggle="tooltip" title="" class="tf-btn w-10 radius-3 btn-fill animate-hover-btn justify-content-center" data-original-title="View"><i class="icon icon-view"></i></a></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<?php endif; ?>
	</div>

<script type="text/javascript">
	$(document).ready(function(){
	    $('[data-toggle="tooltip"]').tooltip();
	});
</script>
