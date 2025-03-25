<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

    <?php if ($this->admin_session->flashdata('message')) : ?>
        <div class="alert alert-success fade in">
            <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-check"></i>
            <strong>Success</strong> <?php echo $this->admin_session->flashdata('message'); ?>
        </div>
    <?php 
unset($_SESSION['message']);
endif; ?>
    <?php if (isset($_SESSION['message']) && $_SESSION['message']) : ?>
        <div class="alert alert-success fade in">
            <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-check"></i>
            <strong>Success</strong> <?php echo $_SESSION['message']; ?>
        </div>
    <?php 
unset($_SESSION['message']);
endif; ?>
    
    <?php if ($this->admin_session->flashdata('error')) : ?>
        <div class="alert alert-danger fade in">
            <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-warning"></i>
            <strong>Error</strong> <?php echo $this->admin_session->flashdata('error'); ?>
        </div>
    <?php 
unset($_SESSION['error']);
endif; ?>
    
    <?php if (function_exists('validation_errors') && validation_errors()) : ?>
        <div class="alert alert-danger fade in">
            <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-warning"></i>
            <strong>Error</strong> <?php echo validation_errors(); ?>
        </div>
    <?php endif; ?>
    
    <?php if ($this->admin_error) : ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $this->admin_error; ?>
        </div>
    <?php endif; ?>

    <div id="js_message_container"></div>

    <?php if (!empty($message)): ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $message; ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $error; ?>
        </div>
    <?php endif; ?>