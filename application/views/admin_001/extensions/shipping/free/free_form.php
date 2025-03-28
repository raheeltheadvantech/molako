<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style>
    input[readonly], input[readonly]:hover, input[readonly]:focus {
        background-color: transparent !important;
        font-size: 1em;
        outline: 0;
        border: 1px solid #ccc;
        box-shadow: none;
        cursor: no-drop;
    }

    textarea[readonly], textarea[readonly]:hover, textarea[readonly]:focus {
        background-color: transparent !important;
        font-size: 1em;
        outline: 0;
        border: 1px solid #ccc;
        box-shadow: none;
        cursor: no-drop;
    }

    .form-group label.readonly {
        position: relative;
    }

    .form-group .readonly:after {
        content: '';
        position: absolute;
        left: 0px;
        top: 0px;
        color: red;
    }

    .form-group.readonly:hover > input[type="text"] {
        border-color: red;
    }

    .form-group.readonly:hover > textarea {
        border-color: red;
    }

    .form-group.readonly:hover:after {
        content: 'Read Only';
        position: absolute;
        right: 21px;
        top: 26px;
        color: red;
    }

    #sortable tr {
        cursor: move;
    }

    .product-filter {
        padding: 0px 5px;
        background: #ccc;
        border-radius: 3px;
        margin-bottom: 5px;
    }

    .product-filter .fa:hover {
        cursor: pointer;
        color: red;
    }
</style>
<?php $placeholder = base_url($this->config->item('placeholder_image')); ?>
<?php $entry_sort_order = 'sort'; ?>
<?php $button_remove = 'Remove'; ?>
<?php echo form_open($route); ?>
<input type="hidden" name="<?php echo $geo_zone_id_name; ?>" value="<?php echo $geo_zone_id; ?>">
<input type="hidden" name="<?php echo $tax_class_id_name; ?>" value="<?php echo $tax_class_id; ?>">
<input type="hidden" name="<?php echo $total_name; ?>" value="<?php echo $total; ?>">
<div class="row">

    <div class="col-md-12">

        <div class="page-header">
            <h4><?php echo $page_title; ?></h4>
        </div>

        <div class="row">
            <div class="col-sm-5">
                <div class="col-sm-12">
                    <?php
                    $data = array('name' => $title_name, 'label' => 'Title', 'placeholder' => 'Title', 'class' => 'form-control', 'value' => set_value($title_name, $title));
                    echo form_input_1($data);
                    ?>
                </div>
                <div class="col-sm-12">
                    <?php
                        $data = array('name' => $total_name, 'label' => 'Total <span class="text-info">(Sub-Total amount needed before the free shipping module becomes available)</span>', 'placeholder' => 'Total', 'class' => 'form-control', 'value' => set_value($total_name, $total));
                        echo form_input_1($data);
                    ?>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Status</label>
                        <?php
                        $options = array(
                            '1' => lang('enabled'),
                            '0' => lang('disabled')
                        );
                        echo form_dropdown($status_name, $options, set_value($status_name, $status), 'class="form-control"');
                        ?>
                    </div>
                </div>
                <div class="col-sm-12">
                    <?php
                    $data = array('name' => $sort_order_name, 'label' => 'Sort Order', 'placeholder' => 'Order', 'class' => 'form-control', 'value' => set_value($sort_order_name, $sort_order));
                    echo form_input_1($data);
                    ?>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php
                $data = array('name' => $cost_name, 'label' => 'Item cost', 'placeholder' => 'Item cost', 'class' => 'form-control', 'value' => set_value($cost_name, $cost));
                echo form_input_1($data);
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 15px">
    <div class="col-sm-5 text-right">
        <input type="submit" class="btn btn-primary" value="Save"/>
        <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder . '/' . $this->controller_dir . '/extensions/shipping.html'); ?>">Back</a>
    </div>
</div>

<?php echo form_close(); ?>


<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function () {

    });
    //]]>
</script>




