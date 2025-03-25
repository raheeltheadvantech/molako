<div class="header">

                    <div class="demo-title">Log in</div>

                    <span class="icon-close icon-close-popup" data-bs-dismiss="modal"></span>

                </div>

                <div class="tf-login-form">
					<div id="ajax_login">

                        <?php
                        if(form_error('submitted'))
                        {
                            echo form_error('submitted');

                        }

                        ?>
    
    <div class="row">
        <div class="col-sm-12">
            <?php echo form_input_1(array('name'=>'email', 'label'=>'Username', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('email', $email))); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php echo form_input_1(array('name'=>'password', 'label'=>'Password', 'placeholder'=>'', 'class'=>'form-control', 'type'=>'password')); ?>
        </div>

                        <div class="d-flex justify-content-between ">

                            <a href="<?php echo base_url('secure/forget-password.html'); ?>" target="_blank" class="btn-link link">Forgot your password?</a>
							<div>
							<a href="<?php echo base_url('secure/register.html'); ?>" target="_blank" class="btn-link fw-6 w-100 link">

                                    New customer? Create your account

                                    <i class="icon icon-arrow1-top-left"></i>

                                </a>
						</div>

                        </div>
						

                        <div class="bottom"> 

                           <div class="w-100 d-flex justify-content-between ">

                                <button type="button" onclick="login_submit()" class="tf-btn btn-fill animate-hover-btn radius-3  justify-content-center"  style="width:44%;"><span>Log in</span></button>
								<button type="button" onclick="location.href = '<?= base_url('guest/checkout.html') ?>';" class="tf-btn btn-fill animate-hover-btn radius-3  justify-content-center" style="width:44%;"><span>Guest</span></button>

                            </div>

                        </div>

                </div>
            </div></div>