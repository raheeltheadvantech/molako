<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php echo form_open($this->admin_url .'/'. $this->controller_dir. '/'.$route); ?>

<div class="page-header">
    <div class="pull-left">
        <span><?php echo $page_header; ?></span>
    </div>

</div><!-- Page Header -->
<div class="box">
    
    <?php if ($this->admin_session->flashdata('error')) : ?>
        <div class="alert alert-danger fade in">
            <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-warning"></i>
            <strong>Error</strong> <?php echo $this->admin_session->flashdata('error'); ?>
        </div>
	<?php endif; ?>
    
    <div class="row">

        <div class="col-sm-4">
          <?php
            $options = array(
                'home'	=> 'Home',
                'catalog'	=> 'Catalog',
                'category'	=> 'Category',
                'brand'	=> 'Brand',
                'pages'	=> 'Pages',
            );
            $data = array('name'=>'name', 'label'=>'Name', 'class'=>'form-control','id'=>'page-name');
            echo form_dropdown_1($data, $options, set_value('name', $name));
            ?>

        </div>
    </div>

    <div class="row">
        <div class="col-sm-4" id="linkk">
        	<?php echo form_input_1(array('name'=>'link', 'label'=>'Link', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('link', $link))); ?>
        </div>

        <div class="col-sm-4" id="page-link" style="display: none;">
            <?php
            $data = array('name'=>'page-link', 'label'=>'Link', 'class'=>'form-control', 'id'=>'page-link');
            echo form_dropdown_1($data, $pages, set_value('page-link', $link));
            ?>

        </div>

    </div>


    <div class="row">
        <div class="col-sm-4">
            <?php
            $options = array(
                '1'	=> 'Yes',
                '0'	=> 'No'
            );
            $data = array('name'=>'is_enabled', 'label'=>'Enabled', 'class'=>'form-control',);
            echo form_dropdown_1($data, $options, set_value('is_enabled', $is_enabled));
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-4">
            <?php echo form_input_1(array('name'=>'sort_order', 'label'=>'Sort', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('sort_order', $sort_order))); ?>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir .'/navigations.html');?>">Back</a>
    
</div>

<input type="hidden" name="submitted" value="submitted" />

<?php echo form_close(); ?>


<script type="text/javascript">
$(document).ready(function(){

	$('.btn-edit').click(function(){
		window.location = '<?php echo site_url($this->admin_folder .'/'. $this->controller_dir. '/navigation-edit.html?id=');?>'+$(this).data('id');
	});
    refresh_Div();
});

$('#page-name').on('change', function() {
    var pag =  $(this).find('option:selected').text();
    if(pag == 'Pages'){
      $('#page-link').show();
      $('#linkk').hide();
    }else{
        $('#page-link').hide();
        $('#linkk').show();
    }

});


function refresh_Div() {
    var pag =   $('#page-name').find('option:selected').text();
        if(pag == 'Pages'){
            $('#page-link').show();
            $('#linkk').hide();
        }else{
            $('#page-link').hide();
            $('#linkk').show();
        }

}

setInterval(refresh_Div, 2000);
</script>
