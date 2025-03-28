<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Theme CSS -->
<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/admin_001/new/vendor/jquery-ui/jquery-ui.theme.css" /> -->
<style type="text/css">
    .dd {
    position: relative;
    display: block;
    margin: 0;
    padding: 0;
    list-style: none;
    font-size: 13px;
    line-height: 20px;
}

.dd-list {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    list-style: none;
}

.dd-list .dd-list {
    padding-left: 30px;
}

.dd-collapsed .dd-list {
    display: none;
}

.dd-item, .dd-empty, .dd-placeholder {
    display: block;
    position: relative;
    margin: 0;
    padding: 0;
    min-height: 20px;
    font-size: 13px;
    line-height: 20px;
}

.dd-handle {
    display: block;
    height: 34px;
    margin: 5px 0;
    padding: 6px 10px;
    color: #333;
    text-decoration: none;
    font-weight: 600;
    border: 1px solid #CCC;
    background: #F6F6F6;
    -webkit-border-radius: 3px;
    border-radius: 3px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

.dd-handle:hover {
    color: #0088cc;
    background: #fff;
}

.dd-item > button {
    display: block;
    position: relative;
    cursor: pointer;
    float: left;
    width: 25px;
    height: 20px;
    margin: 7px 0;
    padding: 0;
    text-indent: 100%;
    white-space: nowrap;
    overflow: hidden;
    border: 0;
    background: transparent;
    font-size: 12px;
    line-height: 1;
    text-align: center;
    font-weight: bold;
}

.dd-item > button:before {
    content: '+';
    display: block;
    position: absolute;
    width: 100%;
    text-align: center;
    text-indent: 0;
}

.dd-item > button[data-action="collapse"]:before {
    content: '-';
}

.dd-placeholder {
    margin: 5px 0;
    padding: 0;
    min-height: 30px;
    background: white;
    border: 1px dashed #CCC;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
}

.dd-empty {
    margin: 5px 0;
    padding: 0;
    min-height: 30px;
    background: #f2fbff;
    border: 1px dashed #b6bcbf;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    border: 1px dashed #bbb;
    min-height: 100px;
    background-color: #e5e5e5;
    background-image: -webkit-linear-gradient(45deg, white 25%, transparent 25%, transparent 75%, white 75%, white), -webkit-linear-gradient(45deg, white 25%, transparent 25%, transparent 75%, white 75%, white);
    background-image: -moz-linear-gradient(45deg, white 25%, transparent 25%, transparent 75%, white 75%, white), -moz-linear-gradient(45deg, white 25%, transparent 25%, transparent 75%, white 75%, white);
    background-image: linear-gradient(45deg, white 25%, transparent 25%, transparent 75%, white 75%, white), linear-gradient(45deg, white 25%, transparent 25%, transparent 75%, white 75%, white);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
}

.dd-dragel {
    position: absolute;
    pointer-events: none;
    z-index: 9999;
}

.dd-dragel > .dd-item .dd-handle {
    margin-top: 0;
}

.dd-dragel .dd-handle {
    -webkit-box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, 0.1);
    box-shadow: 2px 4px 6px 0 rgba(0, 0, 0, 0.1);
}
/*Extra*/
#navMenu{
    margin-left: 25px;
}

</style>

    <div class="row">
        <div class="col-xs-12" hidden>
            <div class="content-wrapper">
            
                <div class="page-header">
                    <div class="pull-left">
                        <span><?php echo $page_header; ?></span>
                    </div>
                    
                    <div class="pull-right">
                    	<div class="btn-group">
                    	<?php if(!empty($result)):?>
                        <!-- <a href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/navigation-sort.html');?>" class="btn btn-primary">Sort</a> -->
                        <?php endif;?>
                        <a href="<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/navigation-add.html');?>" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </div><!-- Page Header -->
                
                
                <div class="custom-table">
                    
                    <!-- Table Meta -->
                    
                    <!-- Table Filter -->
                    <div class="table-wrapper">
                        <div class="table-responsive table-cols">
                        	<?php if(!empty($result)):?>
                            <table class="table table-bordered">
                                <thead>
                                <tr role="row">
                                    <th><?php echo sort_url('ID', 'navigation_id', $this->admin_folder .'/'. $this->controller_dir .'/navigations.html');?></th>

                                    <th><?php echo sort_url('Name', 'name', $this->admin_folder .'/'. $this->controller_dir .'/navigations.html');?></th>
                                    
                                    <th>Action</th>
                                </tr>
                                </thead>
                                
                                <tbody>
                                    <?php $index = 0;?>
                                    <?php foreach( $result as $key=>$val ): ?>
                                    <?php 
                                        $index++; 
                                        $class = 'even';
                                        if (($index % 2) == 1) $class = 'odd';
                                    ?>
                                    <tr role="row" id="tr-<?php echo $val->navigation_id;?>" class="<?php echo $class;?> item-slider_id" data-key="<?php echo $val->navigation_id;?>">
                                        <td><?php echo $val->navigation_id;?></td>
                                        <td><?php

                                            if($val->name == 'pages')
                                                echo Strtoupper($val->name).' | '.Strtoupper($val->link);
                                            else
                                            echo Strtoupper($val->name);
                                            ?>
                                        </td>

                                        <td><a href="javascript:void(0);" class="btn-edit" data-id="<?php echo $val->navigation_id;?>">Edit</a> / <a href="javascript:void(0);" class="btn-del" data-id="<?php echo $val->navigation_id;?>">Del</a></td>
                                    </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table><!-- Table -->
							<?php else : ?>
								<div class="text-center alert alert-warning">No item found</div>
                            <?php endif;?>
                                
                        </div><!-- Table Responsive -->
                    </div><!-- Table wrapper -->
                </div><!-- Custom Table -->
				
                <?php echo $this->pagination->create_links_html();?>
                
                <!-- Table pagination -->
                
            </div><!-- Content Wrapper -->
        </div>
        <div class="col-xs-12">
            <div class="content-wrapper">
            
                <div class="page-header">
                    <div class="pull-left">
                        <span><h2 class="panel-title">Nestable List</h2>
                    <p class="panel-subtitle">Drag & drop hierarchical list with mouse and touch compatibility.</p></span>
                    </div>
                    <div class="pull-right">
                        <div class="btn-group">
                            <button class='btn btn-primary btn-node' data-toggle='modal' data-target='#nodeModal'><i class="fa fa-plus"></i> Add</button>
                            <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6" id="navList">
                    <div class="dd" id="nestable">
                    <?php echo $navigation;?>
                    </div>
                    <input type="hidden" id="nestable-output">
                    <!-- <button id="save">Save</button> -->
                </div>
                
                <div class="col-md-4"> 
                    <div class='navContainer'>
                        <nav>
                        <?php echo $menu; ?>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- Modal -->
    <div id="childModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title child-title">Add Navigation Child</h4>
          </div>
          <?php echo form_open($this->admin_url .'/'. $this->controller_dir. '/'.$route); ?>
          <div class="modal-body child-form">
            <input hidden name="parent_id" id="pid">
            <div class="row">
                <div class="col-sm-6 name">
                    <?php $data = array('name'=>'name', 'label'=>lang('name'), 'placeholder'=>lang('name'), 'class'=>'form-control');
                    echo form_input_1($data);?>
                </div>
                <div class="col-sm-6">
                    <?php $data = array('name'=>'module', 'label'=>'Module Name', 'class'=>'form-control module-name','id'=>'module-name');
                    echo form_dropdown_1($data, $module);?>
                </div>
                <div class="col-sm-6 page-link" style="display: none;">
                  <?php
                  $data = array('name'=>'module_id', 'label'=>'Module ID', 'class'=>'form-control module_id', 'id'=>'module_id');
                  echo form_dropdown_1($data, $pages);
                  ?>
                </div>

                <div class="col-sm-6 cat-link" style="display: none;">
                  <?php
                  $data = array('name'=>'cat_id', 'label'=>'Category ID', 'class'=>'form-control', 'id'=>'cat_id');
                  echo form_dropdown_1($data, $cats);
                  ?>
                </div>
                
                <div class="col-md-3 is_enabled">
                    <label>Status</label>
                    <?php $options = array(
                      '0'   => lang('disabled'),
                      '1'   => lang('enabled')
                      );
                    $data = array('name'=>'is_enabled','id'=>'is_enabled','class'=>'form-control');
                    echo form_dropdown($data, $options);
                    ?>
                </div>
                <div class="col-md-3 is_enabled">
                    <?php $data = array('type' => 'number','name'=>'sort_order','label'=>'Sort Order', 'id'=>'sort_order','class'=>'form-control');
                    echo form_input_1($data);
                    ?>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-danger btn-del md-del d-none">Delete</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          <?=form_close();?>
        </div>

      </div>
    </div>
    <!-- Modal -->
    <div id="nodeModal" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title node-title">Add Navigation Node</h4>
          </div>
          <?php echo form_open($this->admin_url .'/'. $this->controller_dir. '/'.$route); ?>
          <div class="modal-body">
            <input hidden name="parent_id" id="pid">
            <div class="row">
                <div class="col-sm-6">
                    <?php $data = array('name'=>'name', 'label'=>lang('name'), 'placeholder'=>lang('name'), 'class'=>'form-control');
                    echo form_input_1($data);?>
                </div>
                <div class="col-sm-6">
                    <?php $data = array('name'=>'module', 'label'=>'Module Name', 'class'=>'form-control module-name','id'=>'module-name');
                    echo form_dropdown_1($data, $module);?>
                </div>
                <div class="col-sm-6 page-link" style="display: none;">
                  <?php
                  $data = array('name'=>'module_id', 'label'=>'Module ID', 'class'=>'form-control', 'id'=>'module_id');
                  echo form_dropdown_1($data, $pages);
                  ?>
                </div>
                <div class="col-sm-6 cat-link" style="display: none;">
                  <?php
                  $data = array('name'=>'cat_id', 'label'=>'Category ID', 'class'=>'form-control', 'id'=>'cat_id');
                  echo form_dropdown_1($data, $cats);
                  ?>
                </div>
                <div class="col-md-3">
                    <label>Status</label>
                    <?php $options = array(
                      '0'   => lang('disabled'),
                      '1'   => lang('enabled')
                      );
                    $data = array('name'=>'is_enabled','class'=>'form-control');
                    echo form_dropdown($data, $options);
                    ?>
                </div>
                <div class="col-md-3 is_enabled">
                    <?php $data = array('type' => 'number','name'=>'sort_order','label'=>'Sort Order','id'=>'sort_order','class'=>'form-control');
                    echo form_input_1($data);
                    ?>
                </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
          <?=form_close();?>
        </div>

      </div>
    </div>

<script src="<?php echo base_url(); ?>assets/admin_001/new/vendor/jquery-nestable/jquery-nestable.js"></script>
<script src="<?php echo base_url(); ?>assets/admin_001/new/vendor/sortable/jquery-sortable-lists.min.js"></script>
 
<script type="text/javascript">
$(document).ready(function(){
	
	$('.btn-edit').click(function(){
		window.location = '<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/navigation-edit.html?id=');?>'+$(this).data('id');
	});
	
	$('.btn-del').click(function(){
		if(!confirm('Are you sure you want to remove this Navigation?')){
			return false;
		}
		
		window.location = '<?php echo site_url($this->admin_url .'/'. $this->controller_dir. '/navigation/delete.html?id=');?>'+$(this).data('id');
	});

    $('.module-name').on('change', function () {
        var pag = $(this).find('option:selected').text();
        $('.page-link').hide();
          $('.cat-link').hide();
        
        if (pag == 'Page') 
        {
            $('.page-link').show();
            $('.module_id').show();
        }
        else if (pag == 'Category') 
        {
            $('.cat-link').show();
            $('.cat_id').show();
        }
    });

    $('.btn-chlid').click(function(){

        $('.cat-link').hide();
        $('.page-link').hide();
        $('.module-name').val('');

        let id      = $(this).closest('li').attr('data-id');
        let pid     = $(this).closest('li').attr('data-pid');
        let name    = $(this).closest('li').attr('data-title');
        let mname    = $(this).closest('li').attr('data-module');

        $('.child-title').html("Add <b>"+name+"</b> node child");
        $('#pid').val(id);
        $('#module-name').val(mname);
        $('#module-name').change();
        $('.page-link').hide();
        $('.cat-link').hide();
        

        console.log('id',id);
        console.log('name',name);
        console.log('parent id',pid);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url($this->admin_url.'/'. $this->controller_dir.'/Admin_navigations/del_child');?>",
            data:{id: id},
            cache : false,
            success: function(data){
                // alert(data);
                if (data == 201) {
                    $('.btn-del').removeClass('d-none');
                    $('.md-del').attr('data-id',id);
                }else{
                    $('.btn-del').addClass('d-none');
                }
              $("#load").hide();
            } ,error: function(xhr, status, error) {
              alert(error);
            },
        });
    });

    $('.btn-assign').on('click', function(){
        $('.btn-del').removeClass('d-none');
        let id          = $(this).closest('li').attr('data-id');
        let pid         = $(this).closest('li').attr('data-pid');
        let name        = $(this).closest('li').attr('data-title');
        let $module     = $(this).closest('li').attr('data-module');
        let $module_id  = $(this).closest('li').attr('data-mid');
        let is_enabled  = $(this).closest('li').attr('data-enb');
        let order       = $(this).closest('li').attr('data-order');
        let cat_id       = $(this).closest('li').attr('data-cat_id');
        
        $('.child-title').html("Assign Module");
        $('.md-del').attr('data-id',id);
        $('#pid').val(pid);
        $('input[name="name"]').val(name);
        $('#cat_id').val(cat_id);
        $('input[name="sort_order"]').val(order);
        
        $('.module-name').val($module);
        $('.page-link').hide();
        $('.cat-link').hide();
        
        if ($module == 'page') 
        {
            $('.page-link').show();
            $('.module_id').show();
        }
        else if($module == 'category') 
        {
            $('.cat-link').show();
            $('.cat_id').show();
        }
       
        $('#is_enabled').val(is_enabled);


        let $action = $('.child-form').closest('form').attr('action');
        $('.child-form').closest('form').attr('action','<?=base_url($this->admin_url .'/'. $this->controller_dir. '/navigation/edit.html?id=')?>'+id);

        // console.log('$action',$action);
        // console.log('id',id);
        // console.log('name',name);
        // console.log('parent id',pid);
        
    });

    var updateOutput = function(e)
        {
            var list   = e.length ? e : $(e.target),
                output = list.data('output');
                // console.log('list',list);
            if (window.JSON) {
                output.val(window.JSON.stringify(list.nestable('serialize')));//, null, 2));
            } else {
                output.val('JSON browser support required for this demo.');
            }
        };

        // activate Nestable for list 1
        $('#nestable').nestable({
            group: 1
        })
        .on('change', updateOutput);
        $('div#nestable').on('change', function(el) {
          // if item is dropped
            // if dropped item is not inside <ol> tag, return (do nothing)
            // else continue with dropped logic
          // else if position is changed
            // trigger position change logic  
             // console.log('el: ',el);
        });



        // output initial serialised data
        updateOutput($('#nestable').data('output', $('#nestable-output')));
    });
</script>
<script>
    $(document).ready(function(){

        $('.dd').on('change', function() {
            // $(".pageloadLayer").show();
        
                var dataString = { 
                  data : $("#nestable-output").val(),
                };
                console.log('dataString: ',$("#nestable-output").val());
            $.ajax({
                type: "POST",
                url: "<?php echo site_url($this->admin_url.'/'. $this->controller_dir.'/navigation/organize.html');?>",
                data: dataString,
                cache : false,
                success: function(data){
                    console.log('res: '+data);
                    // $("#nestable").load(location.href + " #nestable");
                    window.location = "<?php echo base_url($this->admin_url .'/'. $this->controller_dir .'/navigations.html')?>";
                    // $(".pageloadLayer").hide();
                } ,error: function(xhr, status, error) {
                  alert(error);
                },
            });
        });

        // $("#save").click(function(){
        //      $("#load").show();
         
        //       var dataString = { 
        //           data : $("#nestable-output").val(),
        //         };

        //     $.ajax({
        //         type: "POST",
        //         url: "save.php",
        //         data: dataString,
        //         cache : false,
        //         success: function(data){
        //           $("#load").hide();
        //           alert('Data has been saved');
              
        //         } ,error: function(xhr, status, error) {
        //           alert(error);
        //         },
        //     });
        // });

    });
</script>
