<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<aside id="column-right">
	<style>
		.add_line span{
			color:#229ac8;;
		}
		/*.custom_acc a.heading:hover{
			color: #fff;
			background:#023047;
		}*/
		.custom_acc .heading{
			background-color: #fbb203;
		}
		.custom_acc .heading a{
			color: #ffa700 !important;
		}
		.custom_acc a.heading{
			color:#000000;
		}
		.hover:hover{
			color: #ffa700 !important;
		}
	</style>
	<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Quick Links</div>
    </div>
</div>
	<div class="list-group custom_acc">
		<!-- <a class="list-group-item heading">Quick Links</a> -->
		<a href="<?php echo site_url($this->user_url_prefix . '/dashboard.html') ?>" class="list-group-item hover <?php echo $this->current_active_nav == 'dashboard' ? 'active' : '' ?>"><i class="fa fa-user"></i> User Dashboard</a>
		<a href="<?php echo site_url($this->user_url_prefix . '/profile.html') ?>" class="list-group-item hover <?php echo $this->current_active_nav == 'profile' ? 'active' : '' ?>"><i class="fa fa-pencil"></i> Edit Account</a>
		<a href="<?php echo site_url($this->user_url_prefix . '/change-password.html') ?>" class="list-group-item hover <?php echo $this->current_active_nav == 'change-password' ? 'active' : '' ?>"><i class="fa fa-key"></i> Password</a>
		
		<a href="<?php echo site_url($this->user_url_prefix . '/addresses.html') ?>" class="list-group-item hover <?php echo $this->current_active_nav == 'addresses' ? 'active' : '' ?>"><i class="fa fa-book"></i> Addresses</a>

		<a href="<?php echo site_url($this->user_url_prefix . '/wishlist.html') ?>" class="list-group-item hover <?php echo $this->current_active_nav == 'wishlist' ? 'active' : '' ?>"><i class="fa fa-heart"></i> Wishlist</a>
	</div>
	<div class="list-group custom_acc">
		<a class="list-group-item heading">Orders</a>
		<a href="<?php echo site_url($this->user_url_prefix . '/order-history.html') ?>" class="list-group-item hover <?php echo $this->current_active_nav == 'order-history' ? 'active' : '' ?>"><i class="fa fa-shopping-cart"></i> Order History</a>
	 	<!-- <a href="<?php //echo site_url($this->user_url_prefix . '/transactions.html') ?>" class="list-group-item <?php //echo $this->current_active_nav == 'transactions' ? 'active' : '' ?>"><i class="fa fa-arrows-h"></i> Transactions</a> */ ?> -->
	</div>
	<div class="list-group custom_acc">
		<a href="<?php echo site_url($this->user_url_prefix . '/logout.html') ?>" class="list-group-item hover"><i class="fa fa-sign-out"></i> Logout</a>
	</div>
</aside>
