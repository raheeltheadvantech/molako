<style type="text/css">
    .btn-primary{
        border: none;
        background-color: #2e6ed5;
        color: #fff!important;
    }
    .btn-primary:hover{
      background-color:#ffa700!important;
    }
    .success-text p {
    	color:#023047 ;
    	font-size: 16px;

    }
    .success-text a {
    	color:#ffa700 ;
    }
    .success-text a:hover {
    	color:#ffa700 ;
    }

</style>
<div class="tf-page-title style-2">
    <div class="container-full">
        <div class="heading text-center">Thank You</div>
    </div>
</div>

<div id="checkout-confirm-order" class="container mt-3">
	<sdiv class="row">
		<div id="content" class="success-text col-sm-12 text-center">
			<p>Your order has been placed successfully!</p>
			<p> To view your order history, please visit <a href="<?php echo site_url($this->user_url_prefix . '/order-history.html') ?>">My Account </a>and select History tab. <a href="<?php echo site_url($this->user_url_prefix . '/order-history.html') ?>">history</a>.</p>
			<div class="pull-right mb-3">
				<a style="color: #000;" href="<?php echo site_url() ?>"><button type="submit" class="tf-btn w-30 radius-3 btn-fill animate-hover-btn justify-content-center">Continue</button></a>
			</div>
		</div>
	</div>
</div>