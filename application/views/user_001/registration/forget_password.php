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
        <div class="heading text-center">Reset Password</div>
    </div>
</div>
<!-- /page-title -->

<div class="my-account-area mt-5 mb-5">
    <div class="container">
        <?php echo form_open($this->user_url .'/secure/forget-password.html') ?>
        <div class="row">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-6 col-md-6">
                <?php if ($this->user_session->flashdata('login_error')) : ?>
                    <div class="alert alert-danger fade in">
                        <!-- <button class="close" data-dismiss="alert">×</button> -->
                        <i class="fa-fw fa fa-warning"></i>
                        <strong>Error!</strong> <?php echo $this->user_session->flashdata('login_error'); ?>
                    </div>
                <?php endif; ?>
                <div class="resestered-customers customer">
                    <div class="customer-inner" style="border: none;min-height: auto!important;">
                        <div class="account-form contact-form">

                            <div class="form-goroup">
                                <div class="form-goroup">
                                <?php echo form_input_1(array('name'=>'email', 'label'=>'Email', 'placeholder'=>'','type' => 'email', 'class'=>'form-control', 'value'=>set_value('email', $email))); ?>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <p style="margin: 10px 0px;">Already have an account? <a href="<?php echo site_url($this->user_url .'/secure/login.html');?>" class="btn-login">Login</a></p>
                            </div>
                            <div class="col-sm-6 text-right">
                            <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Reset Password</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <?php echo form_close(); ?> 
    </div>
</div>
<script type="text/javascript">
    $(function(){
        $('.alert').hide(10000);
    })
</script>