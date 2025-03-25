<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<?php echo form_open($this->admin_folder.'/login.html') ?>
<div class="login-box">
    <a href="javascript:void(0);">
        <img class="login-logo" src="<?php echo img_url('login-logo.PNG'); ?>" alt="">
    </a>
    
    <?php if ($this->admin_session->flashdata('error')) : ?>
        <div class="alert alert-danger fade in">
            <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-warning"></i>
            <strong>Error</strong> <?php echo $this->admin_session->flashdata('error'); ?>
        </div>
	<?php endif; ?>
    
    <div class="row">
        <div class="col-sm-12">
        	<?php echo form_input_1(array('name'=>'email', 'label'=>'Username', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('email', $email))); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
			<?php echo form_input_1(array('name'=>'password', 'label'=>'Password', 'placeholder'=>'', 'class'=>'form-control', 'type'=>'password')); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="pull-left">
				<?php echo lang('remember_me');?>
                <?php echo form_checkbox(array('name'=>'remember', 'value'=>'1', 'class'=>'pull-left', 'checked'=>set_checkbox('remember', 1, (boolean)$remember)))?>
                
                <span style="margin-left:5px;"><?php echo lang('stay_logged_in_hint');?></span>
                
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary btn-100">Login</button>
</div>

<input type="hidden" name="submitted" value="submitted" />
<?php echo form_close(); ?>
