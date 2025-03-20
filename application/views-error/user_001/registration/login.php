<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
	@media screen and (max-width: 600px) {
		form{
			padding: 15px;
		}
	}
</style>
       <!-- page-title -->
       <div class="tf-page-title style-2">
            <div class="container-full">
                <div class="heading text-center">Log in</div>
            </div>
        </div>
        <!-- /page-title -->
    
        <section class="flat-spacing-10">
            <div class="container">
                <div class="tf-grid-layout lg-col-2 tf-login-wrap">
                    <div class="tf-login-form">
                        <!-- <div id="recover">
                            <h5 class="mb_24">Reset your password</h5>
                            <p class="mb_30">We will send you an email to reset your password</p>
                            <div>
                                <form class="" id="login-form" action="#" method="post" accept-charset="utf-8" data-mailchimp="true">
                                    <div class="tf-field style-1 mb_15">
                                        <input class="tf-field-input tf-input" placeholder="" type="email" id="property3" name="email">
                                        <label class="tf-field-label fw-4 text_black-2" for="property3">Email *</label>
                                    </div>
                                    <div class="mb_20">
                                        <a href="#login" class="tf-btn btn-line">Cancel</a>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Reset password</button>
                                    </div>
                                </form>
                            </div>
                        </div> -->
                        <div id="login">
                            <h5 class="mb_36">Log in</h5>
                            <div>
                            <?php echo form_open($this->user_url .'/secure/login.html') ?>
                            <?php if ($this->user_session->flashdata('login_error')) : ?>
                                    <div class="alert alert-danger">
                                        <i class="fa-fw fa fa-warning"></i>
                                        <strong>Error!</strong> <?php echo $this->user_session->flashdata('login_error'); ?>
                                        <!-- <button class="close" data-dismiss="alert">×</button> -->
                                    </div>
                                    <?php elseif ($this->user_session->flashdata('message')):?>
                                    <div class="alert alert-success">
                                        <i class="fa-fw fa fa-success"></i>
                                        <strong>Success!</strong> <?php echo $this->user_session->flashdata('message'); ?>
                                        <!-- <button class="close" data-dismiss="alert">×</button> -->
                                    </div>
                                    <?php  endif; ?>
                                    <div class="tf-field style-1 mb_15">
                                        <input class="tf-field-input tf-input" placeholder="" type="email" id="property3" name="email">
                                        <label class="tf-field-label fw-4 text_black-2" for="property3">Email *</label>
                                    </div>
                                    <div class="tf-field style-1 mb_30">
                                        <input class="tf-field-input tf-input" placeholder="" type="password" id="property4" name="password">
                                        <label class="tf-field-label fw-4 text_black-2" for="property4">Password *</label>
                                    </div>
                                    <div class="mb_20">
                                    <a href="<?php echo site_url($this->user_url .'/secure/forget-password.html'); ?>">Forgot Your Password?</a>
                                    </div>
                                    <div class="">
                                        <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Log in</button>
                                    </div>
                                    <input type="hidden" name="submitted" value="submitted">
                                    <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="tf-login-content">
                        <h5 class="mb_36">I'm new here</h5>
                        <p class="mb_20">Sign up for early Sale access plus tailored new arrivals, trends and promotions. To opt out, click unsubscribe in our emails.</p>
                        <a href="<?php echo site_url($this->user_url .'/secure/register.html');?>" class="tf-btn btn-line">Register<i class="icon icon-arrow1-top-left"></i></a>
                    </div>
                </div>
            </div>
        </section>
<script type="text/javascript">
    $(function(){
        $('.alert').hide(10000);
    })
</script>