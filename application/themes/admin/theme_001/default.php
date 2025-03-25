<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Admin Template
 */
?>

<?php include('inc.header.php') ?>

<div class="page-wrapper">
	<div class="container-fluid">
    	
		<?php include('inc.sidenavs.php') ?>
        
        <div class="right-panel">
            
            <div class="row">
                <div class="col-xs-12">
                    <div class="content-wrapper">
                    	<?php include('inc.errors.php') ?>
                        <div class="clearfix"></div>
						<?php echo $content ?>
                    </div><!-- Content Wrapper -->
                </div>
            </div>
            
        </div><!-- Right Column -->
        
    </div>
    
</div>

<?php include('inc.footer.php') ?>