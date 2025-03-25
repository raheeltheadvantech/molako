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
<div class="row">

    <div class="col-md-12">

        <div class="page-header">
            <h4><?php echo $page_title; ?></h4>
        </div>

        <div class="row">
            <div class="col-sm-5">
                <div class="col-sm-12">
                    <?php
                    var_dump($title_name);
                    $data = array('name' => $title_name, 'label' => 'Title', 'placeholder' => 'Title', 'class' => 'form-control', 'value' => set_value($title_name, $title));
                    echo form_input_1($data);
                    ?>
                </div>
                <div class="col-sm-12">
                    <?php
                    $data = array('name' => $total_name, 'label' => 'Total  <span class="text-info">(The checkout total the order must reach before this payment method becomes active)</span>', 'placeholder' => 'Total', 'class' => 'form-control', 'value' => set_value($total_name, $total));
                    echo form_input_1($data);
                    ?>
                   
                 </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Order Status</label>
                        <?php
                        $options = array();
                        foreach ($order_status as $status) {
                            $options[$status->order_status_id] = $status->name;
                        }
                        echo form_dropdown($order_status_id_name, $options, set_value($order_status_id_name, $order_status_id), 'class="form-control"');
                        ?>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label>Status</label>
                        <?php
                        $options = array(
                            '1' => lang('enabled'),
                            '0' => lang('disabled')
                        );
                        echo form_dropdown($status_name, $options, set_value($status_name, $enabled), 'class="form-control"');
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
            <div class="col-md-7">
                <div class="col-md-12">
                    <h4>Jazz Cash API Integration settings</h4>
                    <hr>
                    <div class="form-group">
                        <label>Mode</label>
                        <?php
                        $options = array(
                            '1' => 'Sandbox Mode',
                            '0' => 'Live Mode'
                        );
                        echo form_dropdown($sandbox_mode_name, $options, set_value($sandbox_mode_name, $sandbox_mode), 'class="form-control"');
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <h4>Sandbox settings</h4>
                            <hr>
                            <?php
                            $data = array('name' => $sandbox_username_name, 'label' => 'Jazz Cash Muerchant ID', 'placeholder' => 'Jazz Cash Muerchant ID', 'class' => 'form-control', 'value' => set_value($sandbox_username_name, $sandbox_username));
                            echo form_input_1($data);
                            ?>
                        </div>
                        <div class="col-md-12">
                            <?php
                            $data = array('name' => $sandbox_password_name, 'label' => 'Jazz Cash Merchant password', 'placeholder' => 'Jazz Cash Merchant password', 'class' => 'form-control', 'value' => set_value($sandbox_password_name, $sandbox_password));
                            echo form_input_1($data);
                            ?>
                        </div>
                        <div class="col-md-12">
                            <?php
                            $data = array('name' => $sandbox_api_signature_name, 'label' => 'Jazz Cash Merchant Salt', 'placeholder' => 'Jazz Cash Merchant Salt', 'class' => 'form-control', 'value' => set_value($sandbox_api_signature_name, $sandbox_api_signature));
                            echo form_input_1($data);
                            ?>
                        </div>
                        <div class="col-md-12">
                            <?php
                            $data = array('name' => $sandbox_return_url_name, 'label' => 'Jazz Cash Return URL', 'placeholder' => 'Jazz Cash Return URL', 'class' => 'form-control', 'value' => set_value($sandbox_return_url, $sandbox_return_url));
                            echo form_input_1($data);
                            ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-12">
                            <h4>Live settings</h4>
                            <hr>
                            <?php
                            $data = array('name' => $live_username_name, 'label' => 'Jazz Cash Muerchant ID', 'placeholder' => 'Jazz Cash Jazz Cash Muerchant ID', 'class' => 'form-control', 'value' => set_value($live_username_name, $live_username));
                            echo form_input_1($data);
                            ?>
                        </div>
                        <div class="col-md-12">
                            <?php
                            $data = array('name' => $live_password_name, 'label' => 'Jazz Cash Merchant password', 'placeholder' => 'Jazz Cash Merchant password', 'class' => 'form-control', 'value' => set_value($live_password_name, $live_password));
                            echo form_input_1($data);
                            ?>
                        </div>
                        <div class="col-md-12">
                            <?php
                            $data = array('name' => $live_api_signature_name, 'label' => 'Jazz Cash Merchant Salt', 'placeholder' => 'Jazz Cash Merchant Salt', 'class' => 'form-control', 'value' => set_value($live_api_signature_name, $live_api_signature));
                            echo form_input_1($data);
                            ?>
                        </div>
                        <div class="col-md-12">
                            <?php
                            $data = array('name' => $live_return_url_name, 'label' => 'Jazz Cash Return URL', 'placeholder' => 'Jazz Cash Merchant Salt', 'class' => 'form-control', 'value' => set_value($live_return_url, $live_return_url));
                            echo form_input_1($data);
                            ?>
                        </div>
                    </div>
                </div>     
            </div>
        </div>

    </div>
</div>
<div class="row" style="margin-top: 15px">
    <div class="col-sm-12 text-right">
        <input type="submit" class="btn btn-primary" value="Save"/>
        <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder . '/' . $this->controller_dir . '/extensions/payment.html'); ?>">Back</a>
    </div>
</div>

<?php echo form_close(); ?>
