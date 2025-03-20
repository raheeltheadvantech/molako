<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * User Template
 */
?>

<?php include('inc.header.php') ?>
	<?php if($this->user_session->userdata('user') && strpos(current_url(),'secure')): ?>

			<div class="content-wrapper">
				<?php include('inc.errors.php') ?>
				<div class="clearfix"></div>
				<div class="container user-dashboard">

<!--					<div class="hidden">-->
<!--						DASHBOARD-->
<!--						<a href="#" class="btn-default">logout</a>-->
<!--						<a href="#" class="btn-default">Home</a>-->
<!--					</div>-->
					<div class="row" style="margin-top: 20px; margin-bottom: 20px;">
						<div class="col-sm-8">
							<?php echo $content ?>
						</div>
						<div class="col-sm-4">
							<?php include('inc.sidenavs.php') ?>
						</div>
					</div>
				</div>

			</div><!-- Content Wrapper -->



	<?php else: ?>
			<?php echo $content ?>
	<?php endif; ?>
<?php include('inc.footer.php') ?>
