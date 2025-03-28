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
<?php echo form_open($this->admin_folder . '/' . $this->controller_dir . '/' . $route); ?>
<div class="row">

    <div class="col-md-12">

        <div class="page-header">
            <h4>Customer Form</h4>
        </div>

        <div class="row">
            <div class="col-sm-4">
                <?php
                $data = array('name' => 'first_name', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label' => 'First Name', 'placeholder' => 'First Name', 'class' => 'form-control', 'value' => set_value('first_name', $first_name));
                echo form_input_1($data);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php
                $data = array('name' => 'last_name', 'onkeydown' => 'return /^[a-zA-Z\s]*$/.test(event.key)', 'label' => 'Last Name', 'placeholder' => 'Last Name', 'class' => 'form-control', 'value' => set_value('last_name', $last_name));
                echo form_input_1($data);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php
                $data = array('name' => 'email', 'label' => 'Email', 'placeholder' => 'Email', 'class' => 'form-control', 'value' => set_value('email', $email));
                echo form_input_1($data);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php
                $data = array('name' => 'phone', 'label' => 'Phone','onkeyup'=>'formatPhone(this)', 'placeholder' => 'Phone', 'class' => 'form-control', 'value' => set_value('phone', $phone));
                echo form_input_1($data);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php
                $data = array('type' => 'password', 'name' => 'password', 'label' => 'Password', 'placeholder' => 'Password', 'class' => 'form-control', 'value' => set_value('password', $password));
                echo form_input_1($data);
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php
                $data = array('type' => 'password', 'name' => 'confirm_password', 'label' => 'Password', 'placeholder' => 'Confirm Password', 'class' => 'form-control', 'value' => set_value('confirm_password', $confirm_password));
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
                echo form_dropdown('is_enabled', $options, set_value('is_enabled', $is_enabled), 'class="form-control"');
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 15px">
    <div class="col-sm-4">
        <input type="submit" class="btn btn-primary" value="Save"/>
        <a class="btn btn-outline-gray" href="<?php echo site_url($this->admin_folder . '/' . $this->controller_dir . '/sales/customers.html'); ?>">Back</a>
    </div>
</div>

<?php echo form_close(); ?>


<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function () {

    });
    //]]>
</script>

<script>
    // Image Manager
    $(document).on('click', 'a[data-toggle=\'image\']', function (e) {
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
            content: function () {
                return '<button type="button" id="button-image" class="btn btn-primary"><i class="fa fa-pencil"></i></button> <button type="button" id="button-clear" class="btn btn-danger"><i class="fa fa-trash-o"></i></button>';
            }
        });

        $element.popover('show');

        $('#button-image').on('click', function () {
            var $button = $(this);
            var $icon = $button.find('> i');

            $('#modal-image').remove();

            $.ajax({
                url: '<?php echo site_url($this->admin_folder . '/tool/filemanager.html'); ?>?target=' + $element.parent().find('input').attr('id') + '&thumb=' + $element.attr('id'),
                dataType: 'html',
                beforeSend: function () {
                    $button.prop('disabled', true);
                    if ($icon.length) {
                        $icon.attr('class', 'fa fa-circle-o-notch fa-spin');
                    }
                },
                complete: function () {
                    $button.prop('disabled', false);
                    if ($icon.length) {
                        $icon.attr('class', 'fa fa-pencil');
                    }
                },
                success: function (html) {
                    $('body').append('<div id="modal-image" class="modal">' + html + '</div>');

                    $('#modal-image').modal('show');
                }
            });

            $element.popover('destroy');
        });

        $('#button-clear').on('click', function () {
            $element.find('img').attr('src', $element.find('img').attr('data-placeholder'));

            $element.parent().find('input').val('');

            $element.popover('destroy');
        });
    });
</script>
<script type="text/javascript"><!--
    var image_row = 1<?php //echo $row; ?>;

    function addImage() {
        html = '<tr id="image-row' + image_row + '">';
        html += '  <td class="text-left"><a href="" id="thumb-image' + image_row + '"data-toggle="image" class="img-thumbnail"><img src="<?php echo $placeholder; ?>" alt="" title="" data-placeholder="<?php echo $placeholder; ?>" /></a><input type="hidden" name="product_images[]" value="" id="input-image' + image_row + '" /></td>';
        html += '  <td class="text-left"><button type="button" onclick="$(\'#image-row' + image_row + '\').remove();" data-toggle="tooltip" title="<?php echo $button_remove; ?>" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
        html += '</tr>';

        $('#images tbody').append(html);

        image_row++;
    }

    //--></script>

<script>
    function push_to_ebay(product_id, element) {

        $.ajax({
            url: '<?php echo site_url($this->admin_folder . '/catalog/push-to-ebay.html'); ?>',
            dataType: 'json',
            method: 'post',
            data: {'product_id': product_id},
            beforeSend: function () {
                element.empty().html('<i class="fa fa-refresh fa-spin"></i> Pushing to Ebay').attr('disabled', true);
            },
            complete: function () {
                element.empty().html('<i class="fa fa-paper-plane"></i> Push to Ebay').attr('disabled', false);
            },
            success: function (data) {
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
<script><!--//
    // Filter
    $('input[name=\'filters\']').autocomplete({
        source: function (request, response) {
            $.ajax({
                url: '<?php echo site_url($this->admin_folder . '/catalog/filters/categories/filters-autocomplete.html') ?>?filter_name=' + encodeURIComponent(request.term),
                dataType: 'json',
                success: function (json) {
//console.log(json);
                    response($.map(json, function (item) {
//console.log(item);
                        return {
                            label: item['category_name'] + ' > ' + item['name'],
                            value: item['filter_category_id'] + '-' + item['filter_category_item_id']
                        }
                    }));

                }
            });
        },
        select: function (event, ui) {
            var item = ui.item;
            $('#product-filter' + item['label']).remove();
            $('#product-filter').append('<div id="product-filter' + item['value'] + '" class="product-filter"><i class="fa fa-minus-circle"></i> ' + item['label'] + '<input type="hidden" name="product_filters[]" value="' + item['value'] + '" /></div>');
            $('input[name=\'filters\']').val('');
            event.preventDefault();
        }
    }).on('focus', function () {
        $(this).keydown();
    });
    ;

    $('#product-filter').delegate('.fa-minus-circle', 'click', function () {
        $(this).parent().remove();
    });

//--></script>

<script type="text/javascript">//<!--
    var address_row_id = $('#address').find('li').length;
    function add_address() {
        if(address_row_id == undefined){
            address_row_id = $('#address').find('li').length;
        }else{
            address_row_id = address_row_id + 1;
        }
        var html = '<div class="tab-pane active" id="tab-address'+ address_row_id +'">\n' +
            '            <input type="hidden" name="address['+ address_row_id +'][address_id]" value="">\n' +
            '            <div class="row">\n' +
            '            <div class="col-sm-12">\n' +
            '            <div class="form-group ">\n' +
            '            <label>First Name</label>\n' +
            '        <input type="text" name="address['+ address_row_id +'][first_name]" value="" class="form-control" placeholder="First Name" required="required">\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            <div class="row">\n' +
            '            <div class="col-sm-12">\n' +
            '            <div class="form-group ">\n' +
            '            <label>Last Name</label>\n' +
            '        <input type="text" name="address['+ address_row_id +'][last_name]" value="" class="form-control" placeholder="Last Name" required="required">\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            <div class="row">\n' +
            '            <div class="col-sm-12">\n' +
            '            <div class="form-group ">\n' +
            '            <label>Company</label>\n' +
            '            <input type="text" name="address['+ address_row_id +'][company]" value="" class="form-control" placeholder="Company">\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            <div class="row">\n' +
            '            <div class="col-sm-12">\n' +
            '            <div class="form-group ">\n' +
            '            <label>Address 1</label>\n' +
            '        <input type="text" name="address['+ address_row_id +'][address_1]" value="" class="form-control" placeholder="Address 1" required="required">\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            <div class="row">\n' +
            '            <div class="col-sm-12">\n' +
            '            <div class="form-group ">\n' +
            '            <label>Address 2</label>\n' +
            '        <input type="text" name="address['+ address_row_id +'][address_2]" value="" class="form-control" placeholder="Address 2">\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            <div class="row">\n' +
            '            <div class="col-sm-12">\n' +
            '            <div class="form-group ">\n' +
            '            <label>City</label>\n' +
            '            <input type="text" name="address['+ address_row_id +'][city]" value="" class="form-control" placeholder="City" required="required">\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            <div class="row">\n' +
            '            <div class="col-sm-12">\n' +
            '            <div class="form-group ">\n' +
            '            <label>Post Code</label>\n' +
            '        <input type="text" name="address['+ address_row_id +'][postcode]" value="" class="form-control" placeholder="postcode">\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            <div class="row">\n' +
            '            <div class="col-md-12">\n' +
            '            <label class="required">Country</label>\n' +
            '            <select name="address['+ address_row_id +'][country_id]" class="form-control">\n' +
            '            <option value="1">United States</option>\n' +
            '        </select>\n' +
            '        </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="col-md-12">\n' +
            '            <label class="required">Regions</label>\n' +
            '            <select name="address['+ address_row_id +'][region_id]" class="form-control">\n' +
            '            <option value="3613">Alabama</option>\n' +
            '            <option value="3614">Alaska</option>\n' +
            '            <option value="3615">American Samoa</option>\n' +
            '        <option value="3616">Arizona</option>\n' +
            '            <option value="3617">Arkansas</option>\n' +
            '            <option value="3618">Armed Forces Africa</option>\n' +
            '        <option value="3619">Armed Forces Americas</option>\n' +
            '        <option value="3620">Armed Forces Canada</option>\n' +
            '        <option value="3621">Armed Forces Europe</option>\n' +
            '        <option value="3622">Armed Forces Middle East</option>\n' +
            '        <option value="3623">Armed Forces Pacific</option>\n' +
            '        <option value="3624">California</option>\n' +
            '            <option value="3625">Colorado</option>\n' +
            '            <option value="3626">Connecticut</option>\n' +
            '            <option value="3627">Delaware</option>\n' +
            '            <option value="3628">District of Columbia</option>\n' +
            '        <option value="3629">Federated States Of Micronesia</option>\n' +
            '        <option value="3630">Florida</option>\n' +
            '            <option value="3631">Georgia</option>\n' +
            '            <option value="3632">Guam</option>\n' +
            '            <option value="3633">Hawaii</option>\n' +
            '            <option value="3634">Idaho</option>\n' +
            '            <option value="3635">Illinois</option>\n' +
            '            <option value="3636">Indiana</option>\n' +
            '            <option value="3637">Iowa</option>\n' +
            '            <option value="3638">Kansas</option>\n' +
            '            <option value="3639">Kentucky</option>\n' +
            '            <option value="3640">Louisiana</option>\n' +
            '            <option value="3641">Maine</option>\n' +
            '            <option value="3642">Marshall Islands</option>\n' +
            '        <option value="3643">Maryland</option>\n' +
            '            <option value="3644">Massachusetts</option>\n' +
            '            <option value="3645">Michigan</option>\n' +
            '            <option value="3646">Minnesota</option>\n' +
            '            <option value="3647">Mississippi</option>\n' +
            '            <option value="3648">Missouri</option>\n' +
            '            <option value="3649">Montana</option>\n' +
            '            <option value="3650">Nebraska</option>\n' +
            '            <option value="3651">Nevada</option>\n' +
            '            <option value="3652">New Hampshire</option>\n' +
            '        <option value="3653">New Jersey</option>\n' +
            '        <option value="3654">New Mexico</option>\n' +
            '        <option value="3655">New York</option>\n' +
            '        <option value="3656">North Carolina</option>\n' +
            '        <option value="3657">North Dakota</option>\n' +
            '        <option value="3658">Northern Mariana Islands</option>\n' +
            '        <option value="3659">Ohio</option>\n' +
            '            <option value="3660">Oklahoma</option>\n' +
            '            <option value="3661">Oregon</option>\n' +
            '            <option value="3662">Palau</option>\n' +
            '            <option value="3663">Pennsylvania</option>\n' +
            '            <option value="3664">Puerto Rico</option>\n' +
            '        <option value="3665">Rhode Island</option>\n' +
            '        <option value="3666">South Carolina</option>\n' +
            '        <option value="3667">South Dakota</option>\n' +
            '        <option value="3668">Tennessee</option>\n' +
            '            <option value="3669">Texas</option>\n' +
            '            <option value="3670">Utah</option>\n' +
            '            <option value="3671">Vermont</option>\n' +
            '            <option value="3672">Virgin Islands</option>\n' +
            '        <option value="3673">Virginia</option>\n' +
            '            <option value="3674">Washington</option>\n' +
            '            <option value="3675">West Virginia</option>\n' +
            '        <option value="3676">Wisconsin</option>\n' +
            '            <option value="3677">Wyoming</option>\n' +
            '            </select>\n' +
            '            </div>\n' +
            '            </div>\n' +
            '            </div>';

            $('#address-add').before('<li><a href="#tab-address' + address_row_id + '" data-toggle="tab"><i class="fa fa-minus-circle" onclick="$(\'#address a:first\').tab(\'show\'); $(\'a[href=\\\'#tab-address' + address_row_id + '\\\']\').parent().remove(); $(\'#tab-address' + address_row_id + '\').remove();"></i> Address ' + address_row_id + '</a></li>');
            $('#tab-address .tab-content').append(html);
            $('#address a[href=\'#tab-address' + address_row_id + '\']').tab('show');
    }

//--></script>


