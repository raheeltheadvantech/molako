<?php defined('BASEPATH') OR exit('No direct script access allowed');


 ?>


<?php echo form_open_multipart($this->admin_url .'/'. $this->controller_dir. '/'.$route); ?>

<div class="box">
    
    <?php if ($this->admin_session->flashdata('error')) : ?>
        <div class="alert alert-danger fade in">
            <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-warning"></i>
            <strong>Error</strong> <?php echo $this->admin_session->flashdata('error'); ?>
        </div>
	<?php endif; ?>
    
    <div class="row">
        <div class="col-sm-6">
        	<?php 

            echo form_input_1(array('name'=>'title', 'onkeydown' => 'return return /^[a-zA-Z\s<>\/]*$/.test(event.key)' , 'label'=>'Title', 'placeholder'=>'', 'class'=>'form-control', 'value'=>html_entity_decode(set_value('title',$title)))); ?>
        </div>
        <div class="col-sm-6">
            <?php echo form_input_1(array('name'=>'head', 'onkeydown' => 'return return /^[a-zA-Z\s<>\/]*$/.test(event.key)' , 'label'=>'Heading', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('head', $head))); ?>
        </div>
        <div class="col-sm-6">
        	<?php echo form_input_1(array('name'=>'name', 'onkeydown' => 'return return /^[a-zA-Z\s<>\/]*$/.test(event.key)' , 'label'=>'Name', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('name', $name))); ?>
        </div>
        <div class="col-sm-6">
            <label>Is enabled</label>
            <?php
                $options = array(
                    '0' => lang('disabled'),
                    '1' => lang('enabled')
                    ); 
                echo form_dropdown('is_enabled', $options, set_value('is_enabled',$is_enabled), 'class="form-control"');
            ?>
        </div>
    </div>
    
    <div class="row" style="display: none;">
        <div class="col-sm-6">
        	<?php echo form_input_1(array('name'=>'enable_on', 'label'=>'Enable on', 'placeholder'=>'', 'class'=>'form-control cdate', 'value'=>set_value('enable_on', $enable_on))); ?>
        </div>
        <div class="col-sm-6">
        	<?php echo form_input_1(array('name'=>'disable_on', 'label'=>'Disable on', 'placeholder'=>'', 'class'=>'form-control cdate', 'value'=>set_value('disable_on', $disable_on))); ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-6">
        	<?php echo form_input_1(array('name'=>'link', 'label'=>'Link', 'placeholder'=>'', 'class'=>'form-control', 'value'=>set_value('link', $link))); ?>
        </div>
        <div class="col-sm-6">
        	<?php 
				$data	= array('name'=>'new_window', 'label'=>'new_window', 'class'=>'form-control');
				echo form_dropdown_1($data, array(1=>'Yes', 0=>'No', ), set_value('new_window', $new_window));
			?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?php
            $data = array('name'=>'detail', 'label'=>'Detail', 'placeholder'=>lang('detail'), 'class'=>'form-control', 'value'=>set_value('detail', $detail), 'rows'=>4);
            echo form_textarea_1($data);
            ?>
        </div>
    </div>

    <div class="row">
        <!--        <div style="margin-top:20px;">-->
        <!--        	<iframe class="col-md-8" id="iframe_uploader" src="--><?php //echo site_url($this->admin_url.'/'. $this->controller_dir .'/category/image-upload-form.html');?><!--" style="height:75px; border:0px;"></iframe>-->
        <!--        </div>-->
        <div id="dropzone" class="fallback dropzone">
            <input name="file" type="file" id="file"  class="d-none" style="display: none"/>

            <div id="dz-add-image" class="dz-preview dz-last-preview ">
                <div class="dz-image">+</div>
            </div>
        </div>
    </div>
    
    
    <button type="submit" class="btn btn-primary">Save</button>
    <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir .'/sliders.html');?>">Back</a>
    
</div>

<input type="hidden" name="submitted" value="submitted" />

<?php echo form_close(); ?>


<?php


//this makes it easy to use the same code for initial generation of the form as well as javascript additions
function replace_newline2($string) {
	return trim((string)str_replace(array("\r", "\r\n", "\n", "\t"), ' ', $string));
}
?>

<link rel="stylesheet" href="<?php echo site_url('assets/js/jquery.ui/jquery.ui.min.css') ?>">
<link rel="stylesheet" href="<?php echo site_url('assets/js/jquery.ui/jquery.ui.theme.css') ?>">
<link rel="stylesheet" href="<?php echo site_url('assets/js/jquery.ui/jquery.ui.datepicker.css') ?>">
<script type="text/javascript" src="<?php echo site_url('assets/js/jquery.ui/jquery-ui.js');?>"></script>

<script type="text/javascript">
$(document).ready(function(){
	
	$('.cdate').datepicker({dateFormat: 'yy-mm-dd', showButtonPanel: true});
	
	$('.btn-edit').click(function(){
		window.location = '<?php echo site_url($this->admin_folder .'/'. $this->controller_dir. '/slider-edit.html?id=');?>'+$(this).data('id');
	});
	
});
</script>


<!-- >>> Dropzone Script Section >>> -->
<script>

    // Custome Add file buttion for Dropzone >>>
    dzAddButton = $('#dz-add-image').clone();

    function dz_add_image() {
        // jquery count classes.
        //var numImg = $('.dz-success').length;
        $('#dropzone').append(dzAddButton);


    }

    $("#dropzone").on("click", "#dz-add-image", function () {
        $('#dropzone').trigger("click");
    });
    // Custome Add file buttion for Dropzone <<<

    // Dropzone init >>>
    Dropzone.autoDiscover = false;
    var dropzone = new Dropzone('#dropzone', {
        addRemoveLinks: true,
        dictRemoveFile: "×",
        url: '<?php echo site_url($this->admin_url .'/'. $this->controller_dir .'/slider/simple-image-uploader.html'); ?>',
        maxFilesize: 5,
        <!--Adicione o Maximo de arquivos-->
        maxFiles: 1,
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        init: function () {
            this.on('addedfile', function (file, json) {
                $('#dz-add-image').remove();
            });
            this.on('removedfile', function (file) {
                $("#" + file.new_name).remove();
            });
            this.on('complete', function (file, json) {

                file.new_name = file.name;

                if (file && file.xhr && file.xhr.responseText) {
                    file.new_name = file.xhr.responseText;
                }
                dz_add_image();

                // This will take care of file input elm for ( Add file, Add media file, Embed Youtube)
                var elm_file = $("<input name=\"image\" type=\"hidden\"/>");
                $(elm_file).val(file.new_name);
                $(file.previewElement).append(elm_file);

            });
        }
    });
    // Dropzone init <<<


    // Sortable for Dropzone init >>>
    new Sortable(document.getElementById('dropzone'), {
        animation: 150,
        swapThreshold: 0.49,
        draggable: ".dz-image-preview",

        ghostClass: "sortable-ghost",  // Class name for the drop placeholder
        chosenClass: "sortable-chosen",  // Class name for the chosen item
        dragClass: "sortable-drag",  // Class name for the dragging item


        swapThreshold: 1, // Threshold of the swap zone
        forceFallback: false,  // ignore the HTML5 DnD behaviour and force the fallback to kick in
        onStart: function (evt) {
            $('#dz-add-image').remove();
        },
        onMove: function (evt) {
            $('#dz-add-image').remove();
        },
        onEnd: function (evt) {
            dz_add_image();
        },
        onSort: function (evt) {
        },
        onUpdate: function (evt) {
        },


    });
    // Sortable for Dropzone init <<<


    //Add existing files into dropzone
    var existingFiles = [
        <?php if(!empty($image)){?>
        {name: '<?php echo $image; ?>', size: 1, path: '<?php echo site_url('images/slides/thumbnails/');?>', youtube_url: ''},
        <?php } ?>
    ];


    for (i = 0; i < existingFiles.length; i++) {
        // console.log(existingFiles[i]);

        dropzone.emit("addedfile", existingFiles[i]);
        dropzone.emit("thumbnail", existingFiles[i], existingFiles[i].path + existingFiles[i].name);
        dropzone.emit("complete", existingFiles[i]);
    }

    // Load Youtube video on Thumbnail click



    // Set focus on input...
    $('#add-media-url').on('shown.bs.modal', function () {
        $('#embed_img_url').val('');
        $("#media_url").prop('disabled', false);
        $('#embed_img_url').trigger('focus');
    })






</script>
<!-- <<< Dropzone Script Section <<< -->