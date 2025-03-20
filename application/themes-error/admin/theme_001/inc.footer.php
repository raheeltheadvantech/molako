<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

                <!-- Footer Content -->
                <footer>
                    <div class="container">
                        <div class="text-center">
                            <p> Molako v<?php echo $this->site_config->item('site_version'); ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </footer>
                <!-- /Footer Content -->
                
        </div>
        <!-- /Page Container -->

			<!-- Import Javascript -->
        <?php $assets_dir = 'assets/'.site_config_item('admin_assets').'/js/'; ?>
        <script type="text/javascript" src="<?php echo site_url($assets_dir.'jquery.js'); ?>"></script>
		<script type="text/javascript" src="<?php echo site_url($assets_dir.'jquery-ui-v1.12.1.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url($assets_dir.'jquery-migrate-1.0.0.min.js') ?>"></script>
        <script type="text/javascript" src="<?php echo site_url($assets_dir.'bootstrap.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url($assets_dir.'metismenu.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url($assets_dir.'mCustomScrollbar.min.js'); ?>"></script>
        
        	<!-- TinyMCE JS Editor-->
		<script type="text/javascript" src="<?php echo site_url($assets_dir.'tinymce/tinymce.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url($assets_dir.'tinymce/jquery.tinymce.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url($assets_dir.'tinymce/tinymce_properties.js'); ?>"></script>
			<!-- Custom JS -->
		<script type="text/javascript" src="<?php echo site_url($assets_dir.'jquery.maskedinput.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url($assets_dir.'site-js.js'); ?>"></script>

    

        <script type="text/javascript" src="<?php echo site_url($assets_dir.'Sortable.min.js'); ?>"></script>
        <script type="text/javascript" src="<?php echo site_url($assets_dir.'dropzone.min.js'); ?>"></script>

        <script src = "https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


        <?php //include('inc.footer-typeahead.php') ?>

		<?php // Javascript files ?>
        <?php if (isset($js_files) && is_array($js_files)) : ?>
            <?php foreach ($js_files as $js) : ?>
                <?php if ( ! is_null($js)) : ?>
                    <?php echo "\n"; ?><script type="text/javascript" src="<?php echo $js; ?>?v=<?php echo $this->site_config->item('site_version'); ?>"></script><?php echo "\n"; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
            <?php foreach ($js_files_i18n as $js) : ?>
                <?php if ( ! is_null($js)) : ?>
                    <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        
		<?php if (isset($js_custom_external) && is_array($js_custom_external)) : ?>
            <?php foreach ($js_custom_external as $js) : ?>
                <?php if ( ! is_null($js)) : ?>
                	<?php echo "\n"; ?><script type="text/javascript" src="<?php echo $js;?>?v=<?php echo $this->site_config->item('site_version'); ?>"></script><?php //echo "\n"; ?>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>
        
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
        
		<!-- /Import Javascript -->
	</body>
</html>


<script>
$(document).ready(function () {
	$( ".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
	});
});
</script>
