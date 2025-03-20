<!-- <?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<div class="container">
    <?php if (function_exists('validation_errors') and validation_errors() == '') : ?>
    
		<?php if ($this->user_session->flashdata('message')) : ?>
        <div class="alert alert-success alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $this->user_session->flashdata('message'); ?>
        </div>
        
    	<?php elseif ($this->user_session->flashdata('error')) : ?>
        
        <div class="alert alert-danger alert-dismissable">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $this->user_session->flashdata('error'); ?>
        </div>
        <?php endif; ?>
        
 	<?php endif; ?>

</div> -->