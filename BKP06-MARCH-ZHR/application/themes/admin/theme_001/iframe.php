<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?php echo $page_title; ?> - <?php echo $this->site_config->item('site_name'); ?></title>

<?php $assets_dir = 'assets/'.site_config_item('admin_assets').'/css/'; ?>
<link rel="stylesheet" href="<?php echo site_url($assets_dir.'bootstrap.min.css') ?>">
<link rel="stylesheet" href="<?php echo site_url($assets_dir.'jquery.ui.css') ?>">


<style type="text/css">
/* fix some bootstrap problems */
.btn-mini [class^="icon-"] {
	margin-top: -1px;
}
.navbar-form .input-append .btn {
	margin-top:0px;
	padding-left:2px;
	padding-right:5px;
}
.container-fluid{ padding:0;}
</style>

<body>
	<div class="container-uploader">
	
	<?php echo $content; ?>


<?php $assets_dir = 'assets/'.site_config_item('admin_assets').'/js/'; ?>
<script type="text/javascript" src="<?php echo site_url($assets_dir.'jquery.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url($assets_dir.'jquery-migrate-1.0.0.min.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url($assets_dir.'jquery.ui.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url($assets_dir.'bootstrap.min.js'); ?>"></script>
<script type="text/javascript">
//<![CDATA[
	var SITE_URL = '<?php echo site_url()?>';
//]]>
</script>

<?php if (isset($js_custom) && is_array($js_custom)) : ?>
	<?php echo "\n"; ?><script type="text/javascript">
    <?php foreach ($js_custom as $js) : ?>
        <?php if ( ! is_null($js)) : ?>
            <?php echo $js; ?>
            <?php //$this->minify->js->add($js);?>
        <?php endif; ?>
    <?php endforeach; ?>
            <?php //echo $this->minify->js->gzip();?>
    </script><?php echo "\n"; ?>
<?php endif; ?>


	</div>
</body>
</html>