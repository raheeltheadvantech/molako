<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?php echo $page_title; ?> - <?php echo $this->site_config->item('site_name'); ?></title>
    
		<?php // CSS files ?>
        <?php if (isset($css_files) && is_array($css_files)) : ?>
        <?php foreach ($css_files as $css) : ?>
            <?php if ( ! is_null($css)) : ?>
			<link rel="stylesheet" href="<?php echo $css; ?>?v=<?php echo $this->site_config->item('site_version'); ?>"><?php echo "\n"; ?>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php endif; ?>
    
       <script type="text/javascript">
        //<![CDATA[
        var SITE_URL = '<?php echo site_url()?>';
		var ASSETS_URL = '<?php echo site_url('assets/'.site_config_item('admin_assets'))?>';
        //]]>
        </script>
        
        
	</head>

	<body class="nav-md <?php echo $bodyclass ?>">
            

