<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php $placeholder = base_url($this->config->item('placeholder_image')); ?>
<?php $entry_sort_order = 'sort'; ?>
<?php $button_remove = 'Remove'; ?>
<?php $row = 0; ?>


<?php echo form_open($this->admin_folder . '/' . $this->controller_dir . '/' . $route); ?>
<div class="row">

    <div class="col-md-12">
        <div class="page-header">
            <h4>Tax Classes</h4>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php
                echo form_input_1(array('name' => 'title', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label' => 'Title', 'placeholder' => 'Tax Clas Title', 'class' => 'form-control', 'value' => set_value('title', $title)));
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php
                $data = array('name'=>'description', 'label'=>'Description', 'placeholder'=>'Tax class description', 'class'=>'form-control', 'value'=>set_value('description', $description), 'rows'=>4);
                echo form_input_1($data);
                //echo form_dropdown('region_id', $regions, set_value('region_id', $region_id), 'class="form-control" id="regions"');
                ?>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <?php //echo form_input_1(array('name' => 'tax_rate', 'label' => 'Tax Rate', 'placeholder' => 'Tax Rate', 'class' => 'form-control', 'value' => set_value('tax_rate', $tax_rate))); ?>
            </div>
        </div>

    </div>

    <div class="panel-body">
        <div class="tab-content">
            <div class="box-body">
                <div class="row">

                </div>

                <div class="table-responsive">
                    <table id="tax-rule" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-left" style="width: 20%"  colspan="4">Tax Rates</td>
                        </tr>
                        <tr>
                            <td class="text-left" style="width: 20%">Tax Rate</td>
                            <td>Bases on</td>
                            <td style="width: 50%">Priority</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>


                        <?php
                        if(!empty($tax_rule)){
                            foreach($tax_rule as $val) {?>
                        <tr id="tax-rule-row<?php echo $row; ?>">
                            <td class="text-left"><select name="tax_rule[<?php echo $row; ?>][tax_rate_id]" class="form-control">

                                    <?php foreach($tax_rate as $key=>$val2){ ?>
                                        <?php if($key == $val->tax_rate_id) {?>
                                            <option value="<?php echo $key; ?>" selected="selected"><?php echo RemoveSpecialChar($val2); ?></option>
                                        <?php }else{?>
                                            <option value="<?php echo $key; ?>" ><?php echo RemoveSpecialChar($val2); ?></option>
                                        <?php } } ?>

                                </select></td>
                                <td class="text-left"><select name="tax_rule[<?php echo $row; ?>][based]" class="form-control">


                                     <?php if($val->based == 'shipping') {?>
                                            <option value="shipping" selected="selected">Shippnig</option>
                                      <?php }else{?>
                                            <option value="shipping">Shippnig</option>
                                     <?php } ?>

                                        <?php if($val->based == 'payment') {?>
                                            <option value="payment" selected="selected">Payment</option>
                                        <?php }else{?>
                                            <option value="payment">Payment</option>
                                        <?php } ?>

                                        <?php if($val->based == 'store') {?>
                                            <option value="store" selected="selected">Store</option>
                                        <?php }else{?>
                                            <option value="store">Store</option>
                                        <?php } ?>

                                    </select></td>
                            <td class="text-left"><input type="text" name="tax_rule[<?php echo $row; ?>][priority]" value="<?php echo $val->priority; ?>" placeholder="Priority" class="form-control" /></td>
                            <td class="text-left"><button type="button" onclick="$('#tax-rule-row<?php echo $row; ?>').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                        </tr>
                        <?php $row++;  } } ?>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3"></td>
                            <td class="text-left"><button type="button" onclick="addRule();"  data-toggle="tooltip" title="Add/edit Special Price" class="btn btn-primary" data-original-title="Add/edit Special Price"><i class="fa fa-plus-circle"></i></button></td>
                        </tr>
                        </tfoot>
                    </table>

                </div>

            </div>
        </div>
        <input type="submit" class="btn btn-primary" value="Save" />
    </div>


    <?php echo form_close(); ?>
</div>


<script type="text/javascript"><!--
    var tax_rule_row = <?php echo $row; ?>;;

    function addRule() {
        html  = '<tr id="tax-rule-row' + tax_rule_row + '">';
        html += '  <td class="text-left"><select name="tax_rule[' + tax_rule_row + '][tax_rate_id]" class="form-control">';
        <?php foreach($tax_rate as $key=>$val){ ?>
        html += '    <option value="<?php echo $key; ?>"><?php echo RemoveSpecialChar($val); ?></option>';
        <?php } ?>

        html += '  </select></td>';
        html += '  <td class="text-left"><select name="tax_rule[' + tax_rule_row + '][based]" class="form-control">';
        html += '    <option value="shipping">Shipping</option>';
        html += '    <option value="payment">Payment</option>';
        html += '    <option value="store">Store</option>';
        html += '  </select></td>';
        html += '  <td class="text-left"><input type="text" name="tax_rule[' + tax_rule_row + '][priority]" value="" placeholder="Priority" class="form-control" /></td>';
        html += '  <td class="text-left"><button type="button" onclick="$(\'#tax-rule-row' + tax_rule_row + '\').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#tax-rule tbody').append(html);

        tax_rule_row++;
    }
    //--></script>



