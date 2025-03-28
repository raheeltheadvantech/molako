<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>


	#top-shipping-banner .banner-box{
		border: 1px solid #e0dfda;
		margin: 0px -15px;
		padding: 15px;
		border-radius: 0px;
		min-height: 100px;
		text-align: center;
	}

	#top-shipping-banner .banner-box:hover{
		border-color: #CC0000;
	}

	#top-shipping-banner ul.link-follow li a:before {
		font-size: 18px;
		display: inline-block;
		line-height: 1.8;
		vertical-align: top;
	}

	#top-shipping-banner ul.link-follow,
	#top-shipping-banner .free-shipping-image,
	#top-shipping-banner .payment-image {
		margin: 0 auto;
	}

	#top-shipping-banner ul.link-follow li a{
		width: 32px;
		height: 32px;
		border-radius: 5px;
	}

	#top-shipping-banner ul.link-follow li{
		margin-right: 9px;
	}

	#top-shipping-banner .style1{
		text-align: center;
		color: #CC0000;
		margin-top: 0px;
		margin-bottom: 0px;
	}
	#top-shipping-banner .style1 strong{
		display: block;
	}
	#top-shipping-banner .style1 a{
		display: block;
		color: #CC0000;

	}
	#top-shipping-banner ul.link-follow{
		margin-top: 10px;
	}
	#top-shipping-banner .payment-image{
		margin-top: 8px;
	}
	#top-shipping-banner .free-shipping-image{
		margin-top: 0px;
		height: 68px;
	}
	#top-shipping-banner .style1 a:hover{
		text-decoration: underline;
	}

	.banner-box.facebook .img-responsive{
		margin-top: -42px;
		padding: 41px;
	}

	#product-detail-shipping-banner .banner-box.payment-image img{
		margin-top: -35px;
		padding: 30px;
		overflow: hidden;
	}

	@media screen and (max-width: 600px) {
		.banner-box.facebook .img-responsive{
			margin-top: -10px;
			padding: 0px 70px;
		}

		.banner-box.payment-image {
			overflow: hidden;
		}
		#product-detail-shipping-banner .banner-box.payment-image img{
			margin-top: -10px;
			padding: 0px 70px;
		}
		.banner-box.join-club .img-responsive{
			padding: 0px 50px;
		}
	}

</style>

<div id="product-detail-shipping-banner">
	<div class="row">
		<div class="col-sm-12">
			<div class="col-sm-6">
				<a href="<?php echo site_url('club.html') ?>">
                    <div class="banner-box join-club">
                        <img src="<?php echo base_url('assets/img/mccormack-club-2.png'); ?>" class="img-responsive" style="padding: 15px;">
					</div>
				</a>
			</div>
			<div class="col-sm-6">
				<div class="banner-box facebook">
					<a href="http://www.facebook.com/mccormackracing" target="_blank">
						<img src="<?php echo base_url('assets/img/facebook-logo.jpg'); ?>"  class="img-responsive">
					</a>
				</div>
			</div>
		</div>

		<div class="col-sm-12">
			<div class="col-sm-6">
				<div class="banner-box payment-image" style="overflow: hidden">
					<img src="<?php echo base_url('assets/img/paypal.jpg'); ?>" class="img-responsive">
				</div>
			</div>
			<div class="col-sm-6">
                <a href="<?php echo site_url('free-shipping.html') ?>">
                    <div class="banner-box free-shipping">
                        <img src="<?php echo base_url('assets/img/free-shipping.jpg'); ?>" class="img-responsive">
					</div>
				</a>
			</div>
		</div>
	</div>
</div>
