<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $this->config->item('title')?><?php echo (isset($meta_title))?' :: '.$meta_title:''; ?><?php echo (isset($page_title))?' :: '.$page_title:''; ?></title>

<link type="text/css" href="<?php echo base_url('assets/css/bootstrap.custom.min.css');?>" rel="stylesheet" media="all" />
<link type="text/css" href="<?php echo base_url('assets/css/bootstrap-responsive.min.css');?>" rel="stylesheet" media="all" />

<link type="text/css" href="<?php echo base_url('assets/css/jquery-ui.css');?>" rel="stylesheet" media="all" />
<link type="text/css" href="<?php echo base_url('assets/css/jquery.ui.theme.css');?>" rel="stylesheet" media="all" />
<link type="text/css" href="<?php echo base_url('assets/css/jquery.ui.datepicker.css');?>" rel="stylesheet" media="all" />

<link type="text/css" href="<?php echo base_url('assets/css/admin-styles.css');?>" rel="stylesheet" media="all" />

<script type="text/javascript" src="<?php echo base_url('assets/js/jquery.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-migrate-1.0.0.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/bootstrap.min.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/jquery-ui.js');?>"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/site-js.js');?>"></script>
<?php /*?><script type="text/javascript" src="<?php echo base_url('assets/js/jquery.cookie.js');?>"></script><?php */?>

<body style="margin: 0;font-family:'Helvetica Neue', Helvetica, Arial,sans-serif;font-size: 13px;line-height: 18px;color: #333;background-color: #fff;">
<div style="clear:both;"></div>


<div class="container contents">

	<?php if(!empty($page_title)):?>
	<div class="page-header">
		<h3><?php echo  $page_title; ?></h3>
	</div>
	<?php endif;?>

    <div class="container2">
        <?php
        //lets have the flashdata overright "$message" if it exists
        if($this->admin_session->flashdata('message'))
        {
            $message	= $this->admin_session->flashdata('message');
        }
        
        if($this->admin_session->flashdata('error'))
        {
            $error	= $this->admin_session->flashdata('error');
        }
        
        if(function_exists('validation_errors') && validation_errors() != '')
        {
            $error	= validation_errors();
        }
        ?>
        
        <div id="js_error_container" class="alert alert-error" style="display:none;"> 
            <p id="js_error"></p>
        </div>
        
        <div id="js_note_container" class="alert alert-note" style="display:none;">
        </div>
        
        <?php if (!empty($message)): ?>
            <div class="alert alert-success">
                <a class="close" data-dismiss="alert">×</a>
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    
        <?php if (!empty($error)): ?>
            <div class="alert alert-error">
                <a class="close" data-dismiss="alert">×</a>
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
    </div>		
    

	

	