<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<style>
	@media screen and (max-width: 600px) {
		form{
			padding: 15px;
		}
	}
</style>

<!-- My Account Area -->
<div class="my-account-area" style="margin-bottom: 10px;">
    <div class="container">
        <div class="row">
        <div class="tf-page-title style-2">
            <div class="container-full">
                <div class="heading text-center">Reset Password</div>
            </div>
        </div>
        </div>
        <div class="row">

            <?php echo form_open(current_url()) ?>
            <div class="col-lg-6 col-md-6">
                <?php if ($this->user_session->flashdata('login_error')) : ?>
                    <div class="alert alert-danger fade in">
                        <button class="close" data-dismiss="alert">×</button>
                        <i class="fa-fw fa fa-warning"></i>
                        <strong>Error</strong> <?php echo $this->user_session->flashdata('login_error'); ?>
                    </div>
                <?php endif; ?>
                <div class="resestered-customers customer">
                    <div class="customer-inner">
                        <div class="user-title">
                            <h2><i class="fa fa-file-text"></i>Reset Password?</h2>
                        </div>
                        <div class="account-form">

                            <div class="form-goroup">
                                <?php echo form_input_1(array('name'=>'password', 'label'=>'Password', 'placeholder'=>'', 'class'=>'form-control', 'type'=>'password')); ?>
                            </div>

                            <div class="form-goroup">
                                <?php echo form_input_1(array('name'=>'confirm', 'label'=>'Confirm password', 'placeholder'=>'', 'class'=>'form-control', 'type'=>'password')); ?>
                            </div>
                        </div>
                    </div>
                    <div class="user-bottom fix">
                    <div class="mb_20">
                        <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Reset Password</button>
                    </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div><!-- End My Account Area -->
