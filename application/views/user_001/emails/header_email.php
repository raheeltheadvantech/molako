<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" style="font-size: 100%;-webkit-text-size-adjust: 100%;-ms-text-size-adjust: 100%;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<title><?php echo $this->config->item('config_name')?></title>
<base href="<?php echo base_url(); ?>" /> 
<body style="margin: 0;font-family:'Helvetica Neue', Helvetica, Arial,sans-serif;font-size: 13px;line-height: 18px;color: #333;background-color: #fff;">
	<div style="display:block; width:100%;">
   		<a href="<?php echo site_url();?>"><img src="<?php echo rawurlencode(site_url($assets_img_dir.'logo/logo44.png')); ?>" alt="<?php echo $this->config->item('config_name')?>" width="150px" /></a>
    </div>
<div style="clear:both;"></div>