<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
.label2{ margin-left:5px;}
.dropzone{

    border: none !important;
    width: 600px;

}
</style>

<script type="text/javascript">
//<![CDATA[
function add_image(data, filename_org)
{
	p	= data.split('.');
	var photo = '<?php add_image("'+p[0]+'", "'+filename_org+'", "'+p[0]+'.'+p[1]+'", '', '', '', site_url('images/categories/thumbnails'));?>';
	$('#mc_photos').html(photo);
}

function remove_image(img)
{
	if(confirm('Are you sure you want to remove this image?'))
	{
		var id	= img.attr('rel')
		$('#mc_photo_'+id).remove();
	}
}
//]]>
</script>


<?php echo form_open_multipart($this->admin_folder .'/'. $this->controller_dir. '/'.$route); ?>

<div class="box">
    
    <?php if ($this->admin_session->flashdata('error')) : ?>
        <div class="alert alert-danger fade in">
            <button class="close" data-dismiss="alert">×</button>
            <i class="fa-fw fa fa-warning"></i>
            <strong>Error</strong> <?php echo $this->admin_session->flashdata('error'); ?>
        </div>
	<?php endif; ?>

    <div class="row">
        <div class="col-md-4">
            <?php
            $data = array('name'=>'name', 'label'=>'Name', 'placeholder'=>'Name', 'class'=>'form-control', 'value'=>set_value('name', $name));
            echo form_input_1($data);
            ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?php
            $data = array('name'=>'sort', 'label'=>'Sort Order', 'placeholder'=>'Sort Order', 'class'=>'form-control', 'value'=>set_value('sort', $sort));
            echo form_input_1($data);
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <label>Is enabled</label>
            <?php
                $options = array(
                    '1'	=> lang('enabled'),
                    '0'	=> lang('disabled')
                    );
                echo form_dropdown('is_enabled', $options, set_value('is_enabled',$is_enabled), 'class="form-control"');
            ?>
        </div>
    </div>
    
    <div class="row">
<!--        <div style="margin-top:20px;">-->
<!--        	<iframe class="col-md-8" id="iframe_uploader" src="--><?php //echo site_url($this->admin_url.'/'. $this->controller_dir .'/brand/image-upload-form.html');?><!--" style="height:75px; border:0px;"></iframe>-->
<!--        </div>-->
        <div id="dropzone" class="fallback dropzone">
            <input name="file" type="file" id="file" multiple class="d-none" style="display: none"/>
            <div id="dz-add-image" class="dz-preview dz-last-preview ">
                <div class="dz-image">+</div>
            </div>
        </div>

	</div>
    
    
    <button type="submit" class="btn btn-primary">Save</button>
    <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir .'/brands.html');?>">Back</a>
    
</div>

<input type="hidden" name="brand_id" class="brand_id" value="<?php echo $brand_id; ?>" />
<input type="hidden" name="submitted" value="submitted" />

<?php echo form_close(); ?>

<?php
function add_image($photo_id, $filename_org,  $filename, $alt, $caption, $primary = false)
{
	ob_start();
	?>
	<div class="row mc_photo" id="mc_photo_<?php echo $photo_id;?>" style="background-color:#fff; border-bottom:1px solid #ddd; padding-bottom:20px; margin-bottom:20px;">
		<div class="col-md-2">
			<input type="hidden" name="images[<?php echo $photo_id;?>][filename_org]" value="<?php echo $filename_org;?>"/>
            <input type="hidden" name="images[<?php echo $photo_id;?>][filename]" value="<?php echo $filename;?>"/>
            <input type="hidden" name="images[<?php echo $photo_id;?>][alt]" value="<?php echo $alt;?>"/>
            <input type="hidden" name="images[<?php echo $photo_id;?>][caption]" value="<?php echo $caption;?>"/>
            
			<img class="mc_thumbnail" src="<?php echo site_url('images/brands/thumbnails/'.$filename);?>" width="80" style="padding:1px; border:1px solid #ddd"/>
		</div>
		<div class="col-md-6">
			<div class="row">
				<?php /*?><div class="col-md-2">
					<input name="images[<?php echo $photo_id;?>][alt]" value="<?php echo $alt;?>" class="span2" placeholder="<?php echo lang('alt_tag');?>"/>
				</div>
				<div class="col-md-2 hide">
					<input type="radio" name="primary_image" value="<?php echo $photo_id;?>" <?php if($primary) echo 'checked="checked"';?>/> <?php echo lang('primary');?>
				</div><?php */?>
				<div class="col-md-2">
					<a onclick="return remove_image($(this));" rel="<?php echo $photo_id;?>" class="btn btn-danger" style="float:right; font-size:9px;"><i class="icon-trash icon-white"></i> <?php echo lang('remove');?></a>
				</div>
			</div>
			<?php /*?><div class="row hide">
				<div class="col-md-6">
					<label><?php echo lang('caption');?></label>
					<textarea name="images[<?php echo $photo_id;?>][caption]" class="span6" rows="3"><?php echo $caption;?></textarea>
				</div>
			</div><?php */?>
		</div>
	</div>
	<?php 
	$stuff = ob_get_contents();
	ob_end_clean();
	
	echo replace_newline2($stuff);
}

//this makes it easy to use the same code for initial generation of the form as well as javascript additions
function replace_newline2($string) {
	return trim((string)str_replace(array("\r", "\r\n", "\n", "\t"), ' ', $string));
}
?>

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
        url: '<?php echo site_url($this->admin_url .'/'. $this->controller_dir .'/brand/simple-image-uploader.html'); ?>',
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
                var elm_file = $("<input name=\"images\" type=\"hidden\"/>");
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
        <?php if(!empty($images)){?>
        {name: '<?php echo $images; ?>', size: 1, path: '<?php echo site_url('images/brands/thumbnails/');?>', youtube_url: ''},
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
