<style>
	#right-sidebar .right-sidebar-wrapper{
		border: 2px solid #CC0000;
		margin: 0px -15px;
		padding: 15px;
		border-radius: 5px;
	}

	#right-sidebar ul.link-follow li a:before {
		font-size: 18px;
		display: inline-block;
		line-height: 1.8;
		vertical-align: top;
	}

	#right-sidebar ul.link-follow,
	#right-sidebar .free-shipping-image,
	#right-sidebar .payment-image {
		margin: 10px 0px ;
	}

	#right-sidebar ul.link-follow li a{
		width: 32px;
		height: 32px;
		border-radius: 5px;
	}

	#right-sidebar ul.link-follow li{
		margin-right: 9px;
	}

	#right-sidebar .style1{
		text-align: center;
		color: #CC0000;
	}
	#right-sidebar .style1 a{
		display: block;
		color: #CC0000;
	}
	#right-sidebar .style1 a:hover{
		text-decoration: underline;
	}

</style>
<div id="right-sidebar" class="col-md-3 col-sm-3 col-xs-12">
	<div class="right-sidebar-wrapper">
		<p class="style1">
			<a href="http://www.mccormackracing.com/club.htm">Join "The Club" from McCormack Racing</a>
			<strong>Get access to INSTANT DISCOUNTS!</strong>
		</p>

		<ul class="link-follow">
			<li><a target="_blank" class="facebook ion-social-facebook" title="Facebook" href="https://www.facebook.com/plazathemes1"><span>facebook</span></a></li>
			<li><a target="_blank" class="twitter ion-social-twitter" title="Twitter" href="https://twitter.com/plazathemes"><span>twitter</span></a></li>
			<li><a target="_blank" class="google ion-social-googleplus-outline" title="Google" href="#"><span>google </span></a></li>
			<li><a target="_blank" class="youtube ion-social-youtube" title="Youtube" href="https://www.youtube.com/user/plazathemes"><span>youtube </span></a></li>
		</ul>
		<img src="http://www.mccormackracing.com/images/payments_190.gif" class="payment-image">

		<div align="center">
			<a href="<?php echo site_url('free-shipping.html'); ?>">
				<img src="http://www.mccormackracing.com/images/free_shipping_175.png" class="free-shipping-image">
			</a>
		</div>
	</div>
</div>
