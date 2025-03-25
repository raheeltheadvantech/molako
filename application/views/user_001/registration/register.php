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
                <div class="heading text-center">Register</div>
            </div>
        </div>
        <!-- /page-title -->

<div class="my-account-area mb-5 mt-5">
    <div class="container">
        <?php echo form_open($this->user_url .'/secure/register.html') ?>
        <div class="row">
            <div class="col-lg-3 col-md-3"></div>
            <div class="col-lg-6 col-md-6">
                <div class="resestered-customers customer">
                    <div class="customer-inner" style="border: none;">
                        <div class="user-title">
                            <h2></h2>
                        </div>
                        <div class="user-content">
                            <!-- <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p> -->
                        </div>
                        <div class="account-form contact-form">

                            <div class="form-goroup">
                                <?php echo form_input_1(array('name'=>'first_name', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label'=>'First name *', 'class'=>'form-control', 'value'=>set_value('first_name', $first_name))); ?>
                            </div>
                            <div class="form-goroup">
                                <?php echo form_input_1(array('name'=>'last_name', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label'=>'Last name *',  'class'=>'form-control', 'value'=>set_value('last_name', $last_name))); ?>
                            </div>
                            <div class="form-goroup">
                                <?php echo form_input_1(array('name'=>'email', 'label'=>'Email *', 'class'=>'form-control', 'value'=>set_value('email', $email))); ?>
                            </div>
                            <div class="form-goroup">
                                <?php echo form_input_1(array('name'=>'phone', 'label'=>'Phone *','onkeyup'=>'formatPhone(this)', 'class'=>'form-control', 'value'=>set_value('phone', $phone))); ?>
                            </div>
                            <div class="form-goroup">
                                <?php echo form_input_1(array('name'=>'password', 'label'=>'Password *', 'class'=>'form-control', 'type'=>'password')); ?>
                            </div>
                            <div class="form-goroup">
                                <?php echo form_input_1(array('name'=>'confirm', 'label'=>'Confirm password *', 'class'=>'form-control', 'type'=>'password')); ?>
                            </div>

                        </div>
                        <div class="mb_20">
                                <button type="submit" class="tf-btn w-100 radius-3 btn-fill animate-hover-btn justify-content-center">Register</button>
                            </div>
                            <div class="text-center">
                                <a href="<?php echo site_url($this->user_url .'/secure/login.html');?>" class="tf-btn btn-line">Already have an account? Log in here<i class="icon icon-arrow1-top-left"></i></a>
                            </div>
                        
                            
                    </div>
                </div>
            </div>
            <input type="hidden" name="submitted" value="submitted">
        </div>
        <?php echo form_close(); ?>    
    </div>
</div>