<div class="content-inner scrollbar-inner">
    <?php //echo form_open($this->admin_folder.'/admin_roles/'.$function.'/'.$id, 'class=""') ?>

    <?php echo form_open($this->admin_folder . '/users/roles/' . $route); ?>

    <div class="col-md-12">
        <div class="page-header">
            <h4><?php echo $page_header?> <small><?php echo $result->name?></small></h4>
        </div>
        <?php if(is_array($categories) and sizeof($categories) > 0 ):

            //echo '<pre>';
            // print_r($categories);

            ?>
            <div class="tabs tabs-left">
                <ul class="nav nav-tabs">
                    <?php foreach( $categories as $key=>$val ): ?>
                        <li class="<?php echo $key == 0 ? 'active' : ''; ?>">
                            <a href="#category_<?php echo $val->acl_category_id;?>" data-toggle="tab" aria-expanded="true"><?php echo ($val->name);?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
                <div class="tab-content">
                    <?php foreach( $categories as $key=>$val ): ?>
                        <div class="tab-pane fade <?php echo $key == 0 ? 'active' : ''; ?> in" id="category_<?php echo $val->acl_category_id;?>">
                            <div class="tabs">
                                <?php if(is_array($val->modules) and sizeof($val->modules) > 0 ):?>
                                    <ul class="nav nav-tabs btm-0 no-bg">
                                        <?php foreach( $val->modules as $key2=>$val2 ): ?>
                                            <li class="<?php echo $key2 == 0 ? 'active' : ''; ?>">
                                                <a href="#module_<?php echo $val2->acl_module_id;?>" data-toggle="tab" aria-expanded="true"><?php echo ($val2->name) ;?></a>
                                            </li>
                                        <?php endforeach;?>
                                    </ul>
                                    <div class="tab-content">
                                        <?php foreach( $val->modules as $key2=>$val2 ): ?>
                                            <?php if(is_array($val2->actions) and sizeof($val2->actions) > 0 ):?>
                                                <div class="tab-pane fade <?php echo $key2 == 0 ? 'active' : ''; ?> in" id="module_<?php echo $val2->acl_module_id;?>">
                                                    <div class="row">
                                                        <div class="col-sm-12 form-group">
                                                            <?php foreach( $val2->actions as $key3=>$val3 ):

                                                                if($val3->view){
                                                                ?>
                                                                <div class="checkbox-custom checkbox-inline2">
                                                                <?php $data		= array('name'=>"items[$val2->acl_category_id][$val3->acl_module_id][$val3->acl_action_id][view]", 'id'=>"items_{$val2->acl_category_id}_{$val3->acl_module_id}_{$val3->acl_action_id}_view", 'value'=>1, 'checked'=>set_checkbox("items[$val2->acl_category_id][$val3->acl_module_id][$val3->acl_action_id][$val3->view]", 1, (isset($items_tmp[$val2->acl_category_id][$val3->acl_module_id]['view']) and $items_tmp[$val2->acl_category_id][$val3->acl_module_id]['view'] > 0) ? true : false ));?>
                                                                    <?php echo form_checkbox($data); ?>
                                                                <label for="<?php echo "items_{$val2->acl_category_id}_{$val3->acl_module_id}_{$val3->acl_action_id}_view";?>"><?php echo 'View';?></label>
                                                                </div>
                                                                <?php } if($val3->add){?>
                                                                <div class="checkbox-custom checkbox-inline2">
                                                                    <?php $data	= array('name'=>"items[$val2->acl_category_id][$val3->acl_module_id][$val3->acl_action_id][add]", 'id'=>"items_{$val2->acl_category_id}_{$val3->acl_module_id}_{$val3->acl_action_id}_add", 'value'=>1, 'checked'=>set_checkbox("items[$val2->acl_category_id][$val3->acl_module_id][$val3->acl_action_id]['add']", 1, (isset($items_tmp[$val2->acl_category_id][$val3->acl_module_id]['add']) and $items_tmp[$val2->acl_category_id][$val3->acl_module_id]['add'] > 0) ? true : false));?>
                                                                    <?php echo form_checkbox($data); ?>
                                                                    <label for="<?php echo "items_{$val2->acl_category_id}_{$val3->acl_module_id}_{$val3->acl_action_id}_add";?>"><?php echo 'Add';?></label>
                                                                </div>
                                                               <?php } if($val3->edit){?>
                                                                <div class="checkbox-custom checkbox-inline2">
                                                                    <?php $data		= array('name'=>"items[$val2->acl_category_id][$val3->acl_module_id][$val3->acl_action_id][edit]", 'id'=>"items_{$val2->acl_category_id}_{$val3->acl_module_id}_{$val3->acl_action_id}_edit", 'value'=>1, 'checked'=>set_checkbox("items[$val2->acl_category_id][$val3->acl_module_id][$val3->acl_action_id][$val3->edit]", 1, (isset($items_tmp[$val2->acl_category_id][$val3->acl_module_id]['edit']) and $items_tmp[$val2->acl_category_id][$val3->acl_module_id]['edit'] > 0) ? true : false));?>
                                                                    <?php echo form_checkbox($data); ?>
                                                                    <label for="<?php echo "items_{$val2->acl_category_id}_{$val3->acl_module_id}_{$val3->acl_action_id}_edit";?>"><?php echo 'Edit';?></label>
                                                                </div>
                                                              <?php } if($val3->delete){?>
                                                                <div class="checkbox-custom checkbox-inline2">
                                                                    <?php $data		= array('name'=>"items[$val2->acl_category_id][$val3->acl_module_id][$val3->acl_action_id][delete]", 'id'=>"items_{$val2->acl_category_id}_{$val3->acl_module_id}_{$val3->acl_action_id}_delete", 'value'=>1, 'checked'=>set_checkbox("items[$val2->acl_category_id][$val3->acl_module_id][$val3->acl_action_id][$val3->delete]", 1, (isset($items_tmp[$val2->acl_category_id][$val3->acl_module_id]['delete']) and $items_tmp[$val2->acl_category_id][$val3->acl_module_id]['delete'] > 0) ? true : false ));?>
                                                                    <?php echo form_checkbox($data); ?>
                                                                    <label for="<?php echo "items_{$val2->acl_category_id}_{$val3->acl_module_id}_{$val3->acl_action_id}_delete";?>"><?php echo 'Delete';?></label>
                                                                </div>
                                                             <?php } ?>


                                                            <?php endforeach;?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php else:?>
                                                <div class="tab-pane fade <?php echo $key2 == 0 ? 'active' : ''; ?> in" id="module_<?php echo $val2->acl_module_id;?>">
                                                    <div class="row">
                                                        <div class="col-sm-12 form-group">
                                                            <div class="checkbox-custom checkbox-inline2">
                                                                <?php $data     = array('name'=>"items[$val2->acl_category_id][$val2->acl_module_id][view]", 'id'=>"items_{$val2->acl_category_id}_{$val2->acl_module_id}_view", 'value'=>1, 'checked'=>set_checkbox("items[$val2->acl_category_id][$val2->acl_module_id]", 1, (isset($items_tmp[$val2->acl_category_id][$val2->acl_module_id]['view']) and $items_tmp[$val2->acl_category_id][$val2->acl_module_id]['view'] > 0) ? true : false ));?>
                                                                    <?php echo form_checkbox($data); ?>
                                                                    <label for="<?php echo "items_{$val2->acl_category_id}_{$val2->acl_module_id}_view";?>"><?php echo 'View';?></label>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php endif;?>
                                        <?php endforeach;?>
                                    </div>
                                <?php endif;?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="col-md-2">
        <button name="submit" class="btn btn-primary btn-ajax mt-15 btn-100">Update Permission</button>
    </div>
    <?php echo form_close();?>
</div>
