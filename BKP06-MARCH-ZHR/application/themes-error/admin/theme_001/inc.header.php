<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $page_title; ?> - <?php echo $this->site_config->item('site_name'); ?></title>
    
		<!-- CSS files -->
		<?php if (isset($css_files) && is_array($css_files)) : ?>
			<?php foreach ($css_files as $css) : ?>
				<?php if ( ! is_null($css)) : ?>
					<link rel="stylesheet" href="<?php echo $css; ?>?v=<?php echo $this->site_config->item('site_version'); ?>"><?php echo "\n"; ?>
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>
		<?php $assets_img_dir = 'assets/'.site_config_item('admin_assets').'/img/'; ?>
		<!-- Favicon --> 
        <link rel="shortcut icon" type="image/x-icon" href="<?php echo site_url($assets_img_dir.'favicon.png') ?>">
    
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
        

		<!-- Import CSS -->
		<?php $assets_dir = 'assets/'.site_config_item('admin_assets').'/css/'; ?>
		<link rel="stylesheet" href="<?php echo site_url($assets_dir.'normalize.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url($assets_dir.'bootstrap.min.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url($assets_dir.'style.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url($assets_dir.'responsive.css') ?>">
        <link rel="stylesheet" href="<?php echo site_url($assets_dir.'style-rtl.css') ?>">
		<link rel="stylesheet" href="<?php echo site_url($assets_dir.'jquery.ui-v1.12.1.css') ;?>">
        <link rel="stylesheet" href="<?php echo site_url($assets_dir.'dropzone.css') ;?>">

        <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css"/>
        
		<!-- /Import CSS -->
		<!-- Head Libs -->

		<script src="<?php echo base_url(); ?>assets/admin_001/new/vendor/jquery/jquery.js"></script>
		<script src="<?php echo base_url(); ?>assets/admin_001/new/vendor/modernizr/modernizr.js"></script>
        
		<script type="text/javascript">
        //<![CDATA[
        var SITE_URL = '<?php echo site_url()?>';
		var ASSETS_URL = '<?php echo site_url('assets/'.site_config_item('admin_assets'))?>';
        //]]>
        </script>
        
        
	</head>

	<body class="<?php echo $bodyclass ?>">
    
    <!-- Page Container -->
    <div class="page-container">
        
        <?php include('inc.topnavs.php') ?>


	