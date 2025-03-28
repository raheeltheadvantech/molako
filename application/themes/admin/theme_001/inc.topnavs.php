<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<header>
    <div class="primary-header">
    	<div class="custom-backdrop"></div>
        <div class="pull-left">
            <a href="javascript:void(0);" class="site-logo">
                <img class="site-logo" src="<?php echo img_url('login-logo.PNG'); ?>" alt="">
            </a>
        </div>
        <div class="pull-right">
            <ul class="top-nav">
                <li class="dropdown user-nav">
                    <span class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo img_url('user.jpg'); ?>"><?php echo $this->admin_name; ?></span>
                    <ul class="dropdown-menu">
                    	<li><a href="<?php echo site_url();?>" target="_blank">View Store<i class="icon-open-in-new"></i></a></li>
                        <li><a href="<?php echo site_url($this->admin_folder. '/system/setting.html'); ?>"><i class="icon-settings-outline"></i>Settings</a></li>
                        <li><a href="<?php echo site_url($this->admin_folder . '/users/edit.html?id='. $this->admin_user_id); ?>"><i class="icon-user-outline"></i>Profile</a></li>
                        <li><a href="<?php echo site_url($this->admin_folder.'/logout.html');?>"><i class="icon-power"></i> Log out</a></li>
                    </ul>
                </li>                        
            </ul>
        </div>
        
    </div><!-- Primary Header -->
</header><!-- Top Bar -->