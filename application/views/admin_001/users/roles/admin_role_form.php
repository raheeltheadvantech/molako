<div class="content-inner">
    <div class="col-lg-8 col-lg-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title"><?php echo 'Admin Role'?></h4>
            </div>
            <div class="panel-body pb0">
                <?php //echo form_open($this->admin_folder.'/Admin_roles/'.$function.'/'.$id, 'class=""') ?>
                <?php echo form_open($this->admin_folder . '/' . $this->controller_dir . '/' . $route); ?>
                <div class="form-wrapper">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- <label><?php echo 'Name';?> <span class="required">*</span></label> -->
                                <?php 
                                $data	= array('placeholder'=>lang('Name'), 'label' => 'Name *', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'name'=>'name', 'value'=>set_value('name', $name), 'class'=>'form-control', 'id'=>'name');
                                echo form_input_1($data);
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-12">
                                <label><?php echo 'Status';?> <span class="required">*</span></label>
                                <?php
                                    $options = array(
                                        '1'	=> lang('enabled'),
                                        '0'	=> lang('disabled')
                                        );
                                    echo form_dropdown('enabled', $options, set_value('enabled',$enabled), 'class="form-control"');
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6">
                                <button class="btn btn-primary btn-ajax"><?php echo 'Save'; ?></button>
                                <a href="<?php echo site_url($this->admin_folder.'/users/roles.html') ?>" class="btn btn-default">Back</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
</div>

