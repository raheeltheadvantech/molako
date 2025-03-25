<?php //include('header.php'); ?>

<?php echo form_open($this->admin_url.'/'. $this->controller_dir.'/admin_pages/form/'.$id, 'class="form2"'); ?>



<div class="panel with-nav-tabs panel-default">
	<div class="panel-heading">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#content_tab" data-toggle="tab">Content</a></li>
          <li><a href="#seo_tab" data-toggle="tab">SEO</a></li>
        </ul>
	</div>
    <div class="panel-body">

	
	<div class="tab-content">
		<div class="tab-pane active" id="content_tab">
        	
            <div class="box-body">
                <div class="row">
                     <div class="col-sm-8">
                        <?php 
                        $data = array('name'=>'title', 'label'=>lang('title'), 'placeholder'=>lang('title'), 'class'=>'form-control', 'value'=>set_value('title', $title));
                        echo form_input_1($data); 
                        ?>
                    </div>
                    <div class="col-sm-4">
                        <?php 
                        $data = array('name'=>'menu_title', 'label'=>'Menu Title', 'placeholder'=>'Menu Title', 'class'=>'form-control', 'value'=>set_value('menu_title', $menu_title));
                        echo form_input_1($data); 
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <?php 
                        $data = array('name'=>'content', 'label'=>'Content', 'placeholder'=>lang('content'), 'class'=>'form-control redactor tinymce', 'value'=>set_value('content', $content), 'rows'=>20);
                        echo form_textarea_1($data); 
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <label>Is enabled</label>
                        <?php
                        $options = array(
                            '1' => lang('enabled'),
                            '0' => lang('disabled')
                        );
                        echo form_dropdown('enabled', $options, set_value('enabled', $enabled), 'class="form-control"');
                        ?>
                    </div>
                </div>
            </div>
		</div>
        
		<div class="tab-pane" id="seo_tab">
        	<div class="row"> 
                 <div class="col-sm-4">
                    <?php 
                    $data = array('name'=>'slug', 'label'=>'Meta Slug', 'placeholder'=>lang('slug'), 'class'=>'form-control', 'value'=>set_value('slug', $slug));
                    echo form_input_1($data); 
                    ?>
                </div>
            </div>
            <div class="row">
                 <div class="col-sm-4">
                    <?php 
                    $data = array('name'=>'meta_title', 'label'=>lang('meta_title'), 'placeholder'=>lang('meta_title'), 'class'=>'form-control', 'value'=>set_value('meta_title', $meta_title));
                    echo form_input_1($data); 
                    ?>
                </div>
            </div>
            <div class="row">
                 <div class="col-sm-4">
                    <?php 
                        $data = array('name'=>'meta_keywords', 'label'=>lang('meta_keywords'), 'placeholder'=>lang('meta_keywords'), 'class'=>'form-control', 'value'=>set_value('meta_keywords', $meta_keywords), 'rows'=>4);
                        echo form_textarea_1($data); 
					?>
                </div>
            </div>
            <div class="row">
                 <div class="col-sm-4">
                    <?php 
                        $data = array('name'=>'meta_description', 'label'=>lang('meta_description'), 'placeholder'=>lang('meta_description'), 'class'=>'form-control', 'value'=>set_value('meta_description', $meta_description), 'rows'=>4);
                        echo form_textarea_1($data); 
					?>
                </div>
            </div>
            
		</div>
	</div>
    
    <button type="submit" class="btn btn-primary">Save</button>
    
</div>
</form>

<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){
	
	$('form').submit(function() {
		$('.btn').attr('disabled', true).addClass('disabled');
	});
		
});
//]]>
</script>

<?php //include('footer.php'); ?>