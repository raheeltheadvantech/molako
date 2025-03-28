<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Template
 */
?>
<?php include('inc.header-login.php') ?>

<div class="page-wrapper">
	<div class="container-fluid">
    	<div class="info-block"><?php //include('inc.errors.php') ?></div>
        <!-- Page Content -->
        <div class="login-wrapper">
            <?php echo $content ?>
        </div>
        <!-- /Page Content -->
    </div>
</div>

<?php include('inc.footer-login.php') ?>