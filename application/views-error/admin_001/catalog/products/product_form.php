<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<style>
    input[readonly], input[readonly]:hover, input[readonly]:focus{
        background-color: transparent !important;
        font-size: 1em;
        outline: 0;
        border: 1px solid #ccc;
        box-shadow: none;
        cursor: no-drop;
    }

    textarea[readonly], textarea[readonly]:hover, textarea[readonly]:focus{
        background-color: transparent !important;
        font-size: 1em;
        outline: 0;
        border: 1px solid #ccc;
        box-shadow: none;
        cursor: no-drop;
    }

    .form-group label.readonly{
        position: relative;
    }

    .form-group .readonly:after{
        content: '';
        position: absolute;
        left: 0px;
        top: 0px;
        color: red;
    }

    .form-group.readonly:hover > input[type="text"]{
        border-color: red;
    }

    .form-group.readonly:hover > textarea{
        border-color: red;
    }

    .form-group.readonly:hover:after{
        content: 'Read Only';
        position: absolute;
        right: 21px;
        top: 26px;
        color: red;
    }
    #sortable tr{
        cursor:move;
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

    .image-box {
        padding: 15px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin: 10px;
    }


</style>
<?php $placeholder = base_url($this->config->item('placeholder_image')); ?>
<?php $entry_sort_order = 'sort'; ?>
<?php $button_remove = 'Remove'; ?>
<?php $row = 1; ?>
<?php $row1 = 1; ?>
<?php $row2 = 1; ?>
<?php $row3 = 0; ?>
<?php echo form_open($this->admin_folder .'/'. $this->controller_dir .'/'. $route); ?>
<div class="row">

    <div class="col-md-12">

        <div class="page-header">
            <h4>Product</h4>
        </div>

        <div class="panel with-nav-tabs panel-default">
            <div class="panel-heading">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
                    <li><a href="#tab-links" data-toggle="tab">Links</a></li>
                    <li><a href="#tab-related" data-toggle="tab">Related</a></li>
                    <li><a href="#tab-options" data-toggle="tab">Options</a></li>
                    <li><a href="#tab-specifications" data-toggle="tab">Specifications</a></li>
                    <li><a href="#tab-images" data-toggle="tab">Images</a></li>
                    <li><a href="#tab-prices" data-toggle="tab">Prices</a></li>
                    <li><a href="#tab-shipping" data-toggle="tab">Shipping</a></li>
                    <li><a href="#tab-warrenty" data-toggle="tab">Warrenty</a></li>
                    <li><a href="#tab-seo" data-toggle="tab">SEO</a></li>
                </ul>
            </div>

            <div class="panel-body">
                <div class="tab-content">
                    <div class="tab-pane fade active in" id="tab-general">
                        <input type="hidden" name="product_id" value="<?php echo $id;?>">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    $data = array('name'=>'product_name', 'label'=>'Name', 'placeholder'=>'Name', 'class'=>'form-control', 'value'=>set_value('product_name', $product_name));
                                    echo form_input_1($data);
                                    ?>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">


                                    <?php
                                    $data = array('name'=>'short_description', 'label'=>lang('short_description'), 'placeholder'=>lang('short_description'), 'class'=>'form-control tinymce',  'value'=>set_value('short_description', $short_description, false), 'rows'=>4);
                                    echo form_textarea_1($data);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    $data = array('name'=>'long_description', 'label'=>lang('long_description'), 'placeholder'=>lang('long_description'), 'class'=>'form-control tinymce',  'value'=>set_value('long_description', $long_description, false), 'rows'=>6);
                                    echo form_textarea_1($data);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <label>Is enabled</label>
                                    <?php
                                    $options = array(
                                        '1'	=> lang('enabled'),
                                        '0'	=> lang('disabled')
                                    );
                                    echo form_dropdown('is_enabled', $options, set_value('is_enabled', $is_enabled), 'class="form-control"');
                                    ?>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <?php
                                    $data = array('name'=>'sku', 'label'=>lang('sku'), 'placeholder'=>lang('sku'), 'class'=>'form-control', 'id'=>'skuu', 'value'=>set_value('sku', $sku));
                                    echo form_input_1($data);
                                    ?>
                                </div>

                                <div class="col-sm-3">
                                    <?php
                                    $data = array('name'=>'barcode', 'label'=>lang('barcode'), 'placeholder'=>lang('barcode'), 'class'=>'form-control', 'value'=>set_value('barcode', $barcode));
                                    echo form_input_1($data);
                                    ?>
                                </div>

                                <div class="col-sm-3">
                                    <?php
                                    $data = array('name'=>'quantity', 'label'=>lang('quantity'), 'placeholder'=>lang('quantity'), 'class'=>'form-control', 'value'=>set_value('quantity', $quantity));
                                    echo form_input_1($data);
                                    ?>
                                </div>


                            </div>
                            <!--<div class="row">
                                 <div class="col-sm-12">
                                    <?php /*
                                    $data = array('name'=>'config_theme', 'label'=>lang('config_theme'), 'placeholder'=>lang('config_theme'), 'class'=>'form-control', 'value'=>set_value('config_theme', $config_theme));
                                    echo form_input_1($data);
                                    */?>
                                </div>
                            </div>-->
                        </div>

                    </div>

                    <div class="tab-pane fade" id="tab-links">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="col-sm-8">
                                            <label class="control-label" for="input-filter"><span data-toggle="tooltip" title="Related Products">Product Categories</span></label>
                                            <input type="text" name="product-categories" value="" placeholder="Search for  products Categories" id="input-product-categories" class="form-control" />
                                            <div id="product-category" class="well well-sm" style="height: 150px; overflow: auto;">
                                                <?php
                                                if(isset($product_categories) && !empty($product_categories)){
                                                    //print_r($related_products);
                                                    foreach ($product_categories as $pcategories) { ?>
                                                        <div id="product-category<?php echo $pcategories->category_id; ?>" class="product-category"><i class="fa fa-minus-circle"></i> <?php echo $pcategories->name; ?>
                                                            <input type="hidden" name="product_category[]" value="<?php echo $pcategories->category_id; ?>" />
                                                        </div>
                                                    <?php } }?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Brands</label>
                                    <?php
                                    $options = array();
                                    foreach ($brands as $brand){
                                        $options[$brand->brand_id] = $brand->name;

                                    }
                                    echo form_dropdown('brand_id', $options, set_value('brand_id',$brand_id), 'class="form-control"');
                                    ?>
                                </div>
                            </div>

                        </div>
                    </div>


                    <div class="tab-pane fade" id="tab-related">
                        <div class="box-body">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-8">
                                        <label class="control-label" for="input-filter"><span data-toggle="tooltip" title="Related Products">Related Products</span></label>
                                        <input type="text" name="related-products" value="" placeholder="Search for related products" id="input-related-products" class="form-control" />
                                        <div id="product-related" class="well well-sm" style="height: 150px; overflow: auto;">
                                            <?php
                                            if(isset($related_products) && !empty($related_products)){
                                                //print_r($related_products);
                                                foreach ($related_products as $related_product) { ?>
                                                    <div id="product-related<?php echo $related_product->product_id; ?>" class="product-related"><i class="fa fa-minus-circle"></i> <?php echo $related_product->product_name; ?>
                                                        <input type="hidden" name="product_related[]" value="<?php echo $related_product->product_id; ?>" />
                                                    </div>
                                                <?php } }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="tab-options">
                        <div class="box-body">
                            <button type="button" id="addoptionbtn" title="Add/edit options" class="btn btn-primary" data-original-title="Add/edit options" style="margin-bottom: 10px">Add/edit options</button>
                            <div class="table-responsive" id="addoptions" style="display: none">
                                <table id="options" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <td class="text-left" style="width: 20%">Varient Options</td>
                                        <td style="width: 50%"></td>
                                        <td></td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(isset($option_name) && !empty($option_name) && isset($option_value) && !empty($option_value) ): ?>
                                    <?php
                                        $option_name = json_decode($option_name);
                                        $option_value = json_decode($option_value);
                                        $option_type = json_decode($option_type);
                                        for ($i = 0 ; $i< count($option_name); $i++){ ?>
                                            <tr id="option-row<?php echo $row1;?>">
                                              <td class="text-left">Option<?php echo $row1;?><input name="option_name[]"  type="text" class="form-control" placeholder="Size" value="<?php echo $option_name[$i];?>"></td>
                                               <td class="text-left">Options<input name="option_value[]" type="text" class="form-control" placeholder="Seperate option with a comma" value="<?php echo $option_value[$i];?>"> </td>
                                               <td class="text-left">Type<?php echo $row1;?><select name="option_type[]" class="form-control"><option value="">Select Type</option><?php echo product_option_type($option_type[$i]);?></select></td>
                                               <td class="text-left" style="position:relative"><button type="button" onclick="$('#option-row<?php echo $row1;?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                            </tr>
                                        <?php
                                        $row1++;
                                        } ?>
                                    <?php endif; ?>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-left"><button type="button" onclick="addOption();" data-toggle="tooltip" title="Add/edit options" class="btn btn-primary" data-original-title="Add/edit options"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <button type="button" id="saveoptionbtn" title="Add/edit options" class="btn btn-primary" data-original-title="Add/edit options" style="margin-bottom: 10px">Save Changes</button>
                                <button type="button" id="canceloptionbtn" title="Cancel options" class="btn btn-primary" data-original-title="Add/edit options" style="margin-bottom: 10px">Cancel</button>

                            </div>

                            <div class="table-responsive" id="getoptions"></div>


                        </div>

                    </div>

                    <div class="tab-pane fade" id="tab-specifications">
                        <div class="box-body">

                            <div class="table-responsive">
                                <table id="specifications" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <td class="text-left" style="width: 20%"  colspan="4">Specifications</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" style="width: 20%">Name</td>
                                        <td style="width: 50%">Value</td>
                                        <td>Is Filter</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(isset($pspecifications) && !empty($pspecifications)): ?>
                                        <?php
                                        for ($i = 0 ; $i< count($pspecifications); $i++){ ?>
                                            <tr id="specify-row<?php echo $row2;?>">
                                                <td class="text-left"><input name="specify_name[]"  type="text" class="form-control" placeholder="Series" value="<?php echo $pspecifications[$i]->filter_key;?>"></td>
                                                <td class="text-left"><input name="specify_value[]" type="text" class="form-control" placeholder="4000D" value="<?php echo $pspecifications[$i]->filter_value;?>"> </td>
                                                <td class="text-left"><input type="checkbox" name="specify_filter[<?php echo $row3; ?>]" value="1" <?php if($pspecifications[$i]->is_filter == 1){?> checked <?php } ?>> </td>
                                                <td class="text-left" style="position:relative"><button type="button" onclick="$('#specify-row<?php echo $row2;?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                            </tr>
                                            <?php
                                            $row2++;
                                            $row3++;
                                        } ?>
                                    <?php endif; ?>
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-left"><button type="button" onclick="addSpecify();" data-toggle="tooltip" title="Add/edit Specification" class="btn btn-primary" data-original-title="Add/edit specifications"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>

                        </div>

                    </div>

                    <div class="tab-pane fade" id="tab-images">
                        <div class="box-body">
                            <div id="dropzone" class="fallback dropzone">
                                <input name="file" type="file" id="file" multiple class="d-none" style="display: none"/>
                                <div id="dz-add-image" class="dz-preview dz-last-preview ">
                                    <div class="dz-image">+</div>
                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="tab-prices">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <?php
                                    $data = array('name'=>'sale_price', 'label'=>lang('sale_price'), 'placeholder'=>lang('sale_price'), 'class'=>'form-control', 'value'=>set_value('sale_price', $sale_price));
                                    echo form_input_1($data);
                                    ?>
                                </div>
                            </div>


                            <div class="row" style="margin-bottom: 10px;">
                                <div class="col-md-3">
                                    <label>Tax Class</label>
                                    <?php
                                    $options = array();
                                    foreach ($tax_classes as $tclass){
                                        $options[$tclass->tax_class_id] = $tclass->title;

                                    }
                                    echo form_dropdown('tax_class_id', $options, set_value('tax_class_id',$tax_class_id), 'class="form-control"');
                                    ?>
                                </div>
                            </div>


                            <div class="table-responsive">
                                <table id="special" class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <td class="text-left" style="width: 20%"  colspan="3">Special</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left" style="width: 20%">Special Price</td>
                                        <td style="width: 50%">Start Date</td>
                                        <td style="width: 50%">End Date</td>
                                        <td>Action</td>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php if(isset($special_price) && !empty($special_price)): ?>
                                        <?php
                                        for ($i = 0 ; $i< count($special_price); $i++){ ?>
                                            <tr id="special-row<?php echo $row2;?>">
                                                <td class="text-left"><input name="special_price[]"  type="text" class="form-control" placeholder="250.00" value="<?php echo $special_price[$i]->price;?>"></td>
                                                <td class="text-left"><input name="start_date[]" type="text" class="form-control date_ex"  value="<?php echo $special_price[$i]->start_date;?>"> </td>
                                                <td class="text-left"><input name="end_date[]" type="text" class="form-control date_ex"  value="<?php echo $special_price[$i]->end_date;?>"> </td>
                                                <td class="text-left" style="position:relative"><button type="button" onclick="$('#special-row<?php echo $row2;?>').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                                            </tr>
                                            <?php
                                            $row2++;
                                            $row3++;
                                        } ?>
                                    <?php endif; ?>

                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td class="text-left"><button type="button" onclick="addSpecial();" data-toggle="tooltip" title="Add/edit Special Price" class="btn btn-primary" data-original-title="Add/edit Special Price"><i class="fa fa-plus-circle"></i></button></td>
                                    </tr>
                                    </tfoot>
                                </table>

                            </div>

                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-shipping">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <label><?php echo lang('is_shippable') ?></label>
                                    <?php
                                    $options = array(
                                        '1'	=> lang('yes'),
                                        '0'	=> lang('no')
                                    );
                                    echo form_dropdown('is_shippable', $options, set_value('is_shippable', $is_shippable), 'class="form-control" id="is_shippable"');
                                    ?>
                                </div>
                            </div>
                            <div id="is_ship_div">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <?php
                                        $data = array('name'=>'length', 'label'=>lang('length'), 'placeholder'=>lang('length'), 'class'=>'form-control', 'value'=>set_value('length', $length));
                                        echo form_input_1($data);
                                        ?>
                                    </div>
                                    <span class="p-unit"><?php echo $p_unit; ?></span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <?php
                                        $data = array('name'=>'width', 'label'=>lang('width'), 'placeholder'=>lang('width'), 'class'=>'form-control', 'value'=>set_value('width', $width));
                                        echo form_input_1($data);
                                        ?>
                                    </div>
                                    <span class="p-unit"><?php echo $p_unit; ?></span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <?php
                                        $data = array('name'=>'height', 'label'=>lang('height'), 'placeholder'=>lang('height'), 'class'=>'form-control', 'value'=>set_value('height', $height));
                                        echo form_input_1($data);
                                        ?>
                                    </div>
                                    <span class="p-unit"><?php echo $p_unit; ?></span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">

                                        <?php
                                        $data	= array('name'=>'product_unit', 'label'=>lang('product_unit'), 'class'=>'form-control', 'id'=>'product_unit');
                                        echo form_dropdown_1($data, $length_menu, set_value('product_unit', $product_unit));
                                        ?>

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <?php
                                        $data = array('name'=>'weight', 'label'=>lang('weight'), 'placeholder'=>lang('weight'), 'class'=>'form-control', 'value'=>set_value('weight', $weight));
                                        echo form_input_1($data);
                                        ?>
                                    </div>
                                    <span class="w-unit"><?php echo $w_unit; ?></span>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <?php
                                        $data	= array('name'=>'weight_unit', 'label'=>lang('weight_unit'), 'class'=>'form-control', 'id'=>'weight_unit');
                                        echo form_dropdown_1($data, $weight_menu, set_value('weight_unit', $weight_unit));
                                        ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-warrenty">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <?php
                                    $data = array('name'=>'return_warrenty', 'label'=>lang('return_warrenty'), 'placeholder'=>'15 days return or exchange', 'class'=>'form-control', 'value'=>set_value('return_warrenty', $return_warrenty));
                                    echo form_input_1($data);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <?php
                                    $data = array('name'=>'manufacturing_defect_warrenty', 'label'=>lang('manufacturing_defect_warrenty'), 'placeholder'=>'30 Days', 'class'=>'form-control', 'value'=>set_value('manufacturing_defect_warrenty', $manufacturing_defect_warrenty));
                                    echo form_input_1($data);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-3">
                                    <?php
                                    $data = array('name'=>'courtesy_warranty', 'label'=>lang('courtesy_warranty'), 'placeholder'=>'1 Year', 'class'=>'form-control', 'value'=>set_value('courtesy_warranty', $courtesy_warranty));
                                    echo form_input_1($data);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="tab-seo">
                        <div class="box-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    $data = array('name'=>'meta_title', 'label'=>lang('meta_title'), 'placeholder'=>lang('meta_title'), 'class'=>'form-control', 'value'=>set_value('meta_description', $meta_title));
                                    echo form_input_1($data);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    $data = array('name'=>'meta_description', 'label'=>lang('meta_description'), 'placeholder'=>lang('meta_description'), 'class'=>'form-control', 'value'=>set_value('meta_description', $meta_description), 'rows'=>4);
                                    echo form_textarea_1($data);
                                    ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <?php
                                    $data = array('name'=>'meta_keywords', 'label'=>lang('meta_keywords'), 'placeholder'=>lang('meta_keywords'), 'class'=>'form-control', 'value'=>set_value('meta_keyword', $meta_keywords), 'rows'=>4);
                                    echo form_textarea_1($data);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <input type="submit" class="btn btn-primary" value="Save" />
        <?php echo form_close(); ?>

        <script type="text/javascript">
            //<![CDATA[
            $(document).ready(function(){

            });
            //]]>

            $('#addoptionbtn').on('click', function() {
               //alert('ccc');
                $('#getoptions').hide();
                $('#addoptionbtn').hide();
                $('#addoptions').show();
            });

            $('#canceloptionbtn').on('click', function() {
                //alert('ccc');
                $('#getoptions').show();
                $('#addoptionbtn').show();
                $('#addoptions').hide();
            });


            $('#saveoptionbtn').on('click', function() {

                var $inputs = $("#addoptions").find("input, button, select, textarea");

                $.ajax({
                    url: '<?php echo site_url($this->admin_folder.'/catalog/save-options.html'); ?>',
                    dataType: 'text',
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    data: $inputs.serialize(),

                    success: function(data) {

                        $('#addoptions').hide(data);
                        $('#getoptions').show();
                        $('#addoptionbtn').show();
                        $('#getoptions').html('');
                        $('#getoptions').append(data);
                    }
                });

                //update sku
                update_sku();
            });

            $(function () {
                var product_id = $('input[name=product_id]').val() || 0;

                var $inputss = $("#addoptions").find("input, button, select, textarea");

                $.ajax({
                    url: '<?php echo site_url($this->admin_folder.'/catalog/save-options.html'); ?>?product_id='+product_id,
                    dataType: 'text',
                    type: 'post',
                    contentType: 'application/x-www-form-urlencoded',
                    data: $inputss.serialize(),

                    success: function(data) {

                        $('#addoptions').hide(data);
                        $('#getoptions').show();
                        $('#getoptions').html('');
                        $('#getoptions').append(data);

                    }
                });

            });


            // Remove combination
            $('body').on('click', '#variantEditTable input[name=del_btn]', function (e) {
                e.preventDefault();
                $(this).closest('tr').remove();
            })

        </script>

        <script>
            // Image Manager
            $(document).on('click', 'a[data-toggle=\'image\']', function(e) {
                var $element = $(this);
                var $popover = $element.data('bs.popover'); // element has bs popover?

                e.preventDefault();

                // destroy all image popovers
                $('a[data-toggle="image"]').popover('destroy');

                // remove flickering (do not re-add popover when clicking for removal)
                if ($popover) {
                    return;
                }

                $element.popover({
                    html: true,
                    placement: 'right',
                    trigger: 'manual',
                    content: function() {
                        return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
                    }
                });

                $element.popover('show');

                $('#button-image').on('click', function() {
                    var $button = $(this);
                    var $icon   = $button.find('> i');

                    $('#modal-image').remove();

                    $.ajax({
                        url: '<?php echo site_url($this->admin_folder.'/tool/filemanager.html'); ?>?target=' + $element.parent().find('input').attr('id') + '&thumb=' + $element.attr('id'),
                        dataType: 'html',
                        beforeSend: function() {
                            $button.prop('disabled', true);
                            if ($icon.length) {
                                $icon.attr('class', 'fa fa-circle-o-notch fa-spin');
                            }
                        },
                        complete: function() {
                            $button.prop('disabled', false);
                            if ($icon.length) {
                                $icon.attr('class', 'fa fa-pencil');
                            }
                        },
                        success: function(html) {
                            $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

                            $('#modal-image').modal('show');
                        }
                    });

                    $element.popover('destroy');
                });

                $('#button-clear').on('click', function() {
                    $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

                    $element.parent().find('input').val('');

                    $element.popover('destroy');
                });
            });
        </script>
        <script type="text/javascript"><!--
            var special_row = <?php echo $row; ?>;
            function addSpecial() {
                html  = '<tr id="special-row' + special_row + '">';
                html += '<td class="text-left"><input name="special_price[]"  type="text" class="form-control" placeholder="250.00" value=""></td>';
                html += '<td class="text-left"><input name="start_date[]" type="text" class="form-control date_ex" placeholder="" value=""> </td>';
                html += '<td class="text-left"><input name="end_date[]" type="text" class="form-control date_ex" placeholder="" value=""> </td>';
                html += '<td class="text-left" style="position:relative"><button type="button" onclick="$(\'#special-row' +special_row+ '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                html += '</tr>';

                $('#special tbody').append(html);

                $(".date_ex").datepicker({ dateFormat: 'yy-mm-dd' });

                special_row++;
            }
            //--></script>
        <script type="text/javascript"><!--
            var option_row = <?php echo $row1; ?>;
            function addOption() {

                html  = '<tr id="option-row' + option_row + '">';
                html += '<td class="text-left">Option'+option_row+'<input name="option_name[]"  type="text" class="form-control" placeholder="Size" value=""></td>';
                html += '<td class="text-left">Options<input name="option_value[]" type="text" class="form-control" placeholder="Seperate option with a comma" value=""> </td>';
                html += '<td class="text-left">Type'+option_row+'<select name="option_type[]" class="form-control"><option value="">Select Type</option><?php echo product_option_type();?></select></td>';
                html += '<td class="text-left" style="position:relative"><button type="button" onclick="$(\'#option-row' +option_row+ '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                html += '</tr>';

                $('#options tbody').append(html);

                option_row++;
            }

            var specify_row = <?php echo $row2; ?>;
            var specify_filter_row = <?php echo $row3; ?>;
            function addSpecify() {

                html  = '<tr id="specify-row' + specify_row + '">';
                html += '<td class="text-left"><input name="specify_name[]"  type="text" class="form-control" placeholder="Series" value=""></td>';
                html += '<td class="text-left"><input name="specify_value[]" type="text" class="form-control" placeholder="4000D" value=""> </td>';
                html += '<td class="text-left"><input type="checkbox" name="specify_filter['+specify_filter_row+ ']" value="1"> </td>';
                html += '<td class="text-left" style="position:relative"><button type="button" onclick="$(\'#specify-row' +specify_row+ '\').remove();" data-toggle="tooltip" title="Remove" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                html += '</tr>';

                $('#specifications tbody').append(html);

                specify_row++;
                specify_filter_row++;
            }

            //--></script>


        <script>
            function push_to_ebay(product_id, element) {

                $.ajax({
                    url: '<?php echo site_url($this->admin_folder.'/catalog/push-to-ebay.html'); ?>',
                    dataType: 'json',
                    method: 'post',
                    data: {'product_id' : product_id},
                    beforeSend: function() {
                        element.empty().html('<i class="fa fa-refresh fa-spin"></i> Pushing to Ebay').attr('disabled', true);
                    },
                    complete: function() {
                        element.empty().html('<i class="fa fa-paper-plane"></i> Push to Ebay').attr('disabled', false);
                    },
                    success: function(data) {
                        $('#ebay-output').empty().html(data.html);
                    }
                });
            }
            $(document).ready(function () {
                $('#push-to-ebay').click(function () {
                    var product_id = $(this).data('product-id');
                    push_to_ebay(product_id, $(this));
                });
            });

        </script>


        <script src="<?php echo site_url().'assets/'.site_config_item('admin_assets').'/js/jquery.ui.js'; ?>"></script>
        <link rel="stylesheet" href="<?php echo site_url().'assets/'.site_config_item('admin_assets').'/css/jquery.ui.css'; ?>">
        <script>
            $( function() {
                $( "#sortable" ).sortable({placeholder: "ui-state-highlight"});
                $( "#sortable" ).disableSelection();
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
                url: '<?php echo site_url($this->admin_url .'/'. $this->controller_dir .'/product/image-uploader.html'); ?>',
                maxFilesize: 5,
                <!--Adicione o Maximo de arquivos-->
                maxFiles: 10,
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
                        var elm_file = $("<input name=\"images[]\" type=\"hidden\"/>");
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
            ];


            //Add existing files into dropzone
            var existingFiles = [
            <?php if(!empty($product_images)) {
                foreach ($product_images as $key=>$image) {?>
            {name: '<?php echo $product_images[$key]->image; ?>', size: 1, path: '<?php echo site_url('images/products/thumbnails/');?>', youtube_url: ''},
                <?php } } ?>
            ];

            for (i = 0; i < existingFiles.length; i++) {
                // console.log(existingFiles[i]);

                dropzone.emit("addedfile", existingFiles[i]);
                dropzone.emit("thumbnail", existingFiles[i], existingFiles[i].path + existingFiles[i].name);
                dropzone.emit("complete", existingFiles[i]);
            }


            // Set focus on input...
            $('#add-media-url').on('shown.bs.modal', function () {
                $('#embed_img_url').val('');
                $("#media_url").prop('disabled', false);
                $('#embed_img_url').trigger('focus');
            })


        </script>
        <!-- <<< Dropzone Script Section <<< -->

        <script>
            $(document).ready(function() {
                $('#mltislct').multiselect({
                    includeSelectAllOption: true,
                    enableFiltering: true,
                    enableCaseInsensitiveFiltering: true,
                    filterPlaceholder:'Search Here..'
                });

                $('#is_shippable').on('change', function() {

                    if($(this).val() === '0') {
                        $('#is_ship_div').hide();
                    } else {
                        $('#is_ship_div').show();
                    }
                });

                var ship = $('#is_shippable').val();
                if(ship == 0)
                    $('#is_ship_div').hide();

                $("#skuu").keyup(function(){
                    console.log('sku',$(this).val());
                    $(".option-sku").val($(this).val()+'-');
                    //alert($(this).val());
                });


                $(function() {
                    $(".date_ex").datepicker({ dateFormat: 'yy-mm-dd' });
                });

            });
        </script>


        <script>
            $('input[name=\'related-products\']').typeahead({
                    source: function(query, process){
                        objects = [];
                        map = {};
                        $.ajax({
                            url:'<?php echo site_url($this->admin_folder.'/catalog/products/related-products-autocomplete.html') ?>',
                            method:"POST",
                            data:{term:query},
                            dataType:"json",
                            success: function(json) {
                                $.each(json, function(i, object) {
                                    map[object.label] = object;
                                    objects.push(object.label);
                                });
                                process(objects);
                            }
                        });
                    },
                    updater: function(item) {
                        $('#product-related' + map[item].value).remove();
                            $('#product-related').append('<div id="product-related' + map[item].value + '" class="product-related"><i class="fa fa-minus-circle"></i> ' + map[item].label + '<input type="hidden" name="product_related[]" value="' + map[item].value + '" /></div>');
                            $('input[name=\'related-products\']').val('');
                            //return item;
                    }
                });

            $('#product-related').delegate('.fa-minus-circle', 'click', function() {
                $(this).parent().remove();
            });



            $('input[name=\'product-categories\']').typeahead({
                source: function(query, process){
                    objects = [];
                    map = {};
                    $.ajax({
                        url:'<?php echo site_url($this->admin_folder.'/catalog/products/product-category-autocomplete.html') ?>',
                        method:"POST",
                        data:{term:query},
                        dataType:"json",
                        success: function(json) {
                            $.each(json, function(i, object) {
                                map[object.label] = object;
                                objects.push(object.label);
                            });
                            process(objects);
                        }
                    });
                },
                updater: function(item) {
                    $('#product-category' + map[item].value).remove();
                    $('#product-category').append('<div id="product-category' + map[item].value + '" class="product-category"><i class="fa fa-minus-circle"></i> ' + map[item].label + '<input type="hidden" name="product_category[]" value="' + map[item].value + '" /></div>');
                    $('input[name=\'product-categories\']').val('');
                    //return item;
                }
            });

            $('#product-category').delegate('.fa-minus-circle', 'click', function() {
                $(this).parent().remove();
            });
        </script>




        <script type="text/javascript">

            $(document).ready(function() {

                //on change sku value
                $("#skuu").keyup(function(){
                    var sku = $(this).val();
                    setTimeout(function() {
                        var num = 0;
                        $("#variantEditTable tr").each(function(){
                            // console.log('sku tr',$("#skuu").val());
                            $('.option-sku'+num).val($("#skuu").val()+'_'+$(this).find('td.skuu').text().toUpperCase());
                            num++;
                        });

                    }, 1000);
                });

                //on page load
                update_sku();
            });

            function update_sku(){
                setTimeout(function() {
                    var num = 0;
                    $("#variantEditTable tr").each(function(){
                            // console.log($(this).text());
                        $('.option-sku'+num).val($("#skuu").val()+'_'+$(this).find('td.skuu').text().toUpperCase());
                        num++;
                    });
                }, 3000);
            }



            $('#weight_unit').on('change', function() {
               var opt =  $(this).find('option:selected').text();
                $('.w-unit').text(opt);
            });

            $('#product_unit').on('change', function() {
                var opt =  $(this).find('option:selected').text();
                $('.p-unit').text(opt);
            });

        </script>



