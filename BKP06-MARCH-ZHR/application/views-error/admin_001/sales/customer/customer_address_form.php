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

<?php $country_options1 = array('223' => 'United States',); ?>
<?php $region_options1 = array(
    '3613' => 'Alabama',
    '3614' => 'Alaska',
    '3615' => 'American Samoa',
    '3616' => 'Arizona',
    '3617' => 'Arkansas',
    '3618' => 'Armed Forces Africa',
    '3619' => 'Armed Forces Americas',
    '3620' => 'Armed Forces Canada',
    '3621' => 'Armed Forces Europe',
    '3622' => 'Armed Forces Middle East',
    '3623' => 'Armed Forces Pacific',
    '3624' => 'California',
    '3625' => 'Colorado',
    '3626' => 'Connecticut',
    '3627' => 'Delaware',
    '3628' => 'District of Columbia',
    '3629' => 'Federated States Of Micronesia',
    '3630' => 'Florida',
    '3631' => 'Georgia',
    '3632' => 'Guam',
    '3633' => 'Hawaii',
    '3634' => 'Idaho',
    '3635' => 'Illinois',
    '3636' => 'Indiana',
    '3637' => 'Iowa',
    '3638' => 'Kansas',
    '3639' => 'Kentucky',
    '3640' => 'Louisiana',
    '3641' => 'Maine',
    '3642' => 'Marshall Islands',
    '3643' => 'Maryland',
    '3644' => 'Massachusetts',
    '3645' => 'Michigan',
    '3646' => 'Minnesota',
    '3647' => 'Mississippi',
    '3648' => 'Missouri',
    '3649' => 'Montana',
    '3650' => 'Nebraska',
    '3651' => 'Nevada',
    '3652' => 'New Hampshire',
    '3653' => 'New Jersey',
    '3654' => 'New Mexico',
    '3655' => 'New York',
    '3656' => 'North Carolina',
    '3657' => 'North Dakota',
    '3658' => 'Northern Mariana Islands',
    '3659' => 'Ohio',
    '3660' => 'Oklahoma',
    '3661' => 'Oregon',
    '3662' => 'Palau',
    '3663' => 'Pennsylvania',
    '3664' => 'Puerto Rico',
    '3665' => 'Rhode Island',
    '3666' => 'South Carolina',
    '3667' => 'South Dakota',
    '3668' => 'Tennessee',
    '3669' => 'Texas',
    '3670' => 'Utah',
    '3671' => 'Vermont',
    '3672' => 'Virgin Islands',
    '3673' => 'Virginia',
    '3674' => 'Washington',
    '3675' => 'West Virginia',
    '3676' => 'Wisconsin',
    '3677' => 'Wyoming',
); ?> 


<?php echo form_open($this->admin_folder . '/' . $this->controller_dir . '/' . $route); ?>
<div class="row">

    <div class="col-md-12">
        <div class="page-header">
            <h4>Customer Address Form</h4>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php $data = array('name' => "first_name", 'label' => 'First Name', 'placeholder' => 'First Name', 'required' => 'required','class' => 'form-control','value' => set_value('first_name', $first_name)); ?>
                <?php echo form_input_1($data); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php echo form_input_1(array('name' => 'last_name', 'label' => 'Last Name', 'placeholder' => 'Last Name', 'required' => 'required', 'class' => 'form-control', 'value' => set_value('last_name', $last_name))); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php echo form_input_1(array('name' => 'company', 'label' => 'Company', 'placeholder' => 'Company', 'class' => 'form-control', 'value' => set_value('company', $company))); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php echo form_input_1(array('name' => 'address_1', 'label' => 'Address 1', 'placeholder' => 'Address 1', 'required' => 'required', 'class' => 'form-control', 'value' => set_value('address_1', $address_1))); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php echo form_input_1(array('name' => 'address_2', 'label' => 'Address 2', 'placeholder' => 'Address 2', 'class' => 'form-control', 'value' => set_value('address_2', $address_2))); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php echo form_input_1(array('name' => 'city', 'label' => 'City', 'placeholder' => 'City', 'required' => 'required', 'class' => 'form-control', 'value' => set_value('city', $city))); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <?php echo form_input_1(array('name' => 'postcode', 'label' => 'Post Code', 'placeholder' => 'postcode', 'class' => 'form-control', 'value' => set_value('postcode', $postcode))); ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="required">Country</label>
                <?php
                echo form_dropdown('country_id', $country_options, set_value('country_id', $country_id), 'class="form-control" id="country"');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label class="required">Regions</label>

                <?php
                echo form_dropdown('region_id', $regions, set_value('region_id', $region_id), 'class="form-control" id="regions"');
                ?>
            </div>
        </div>
    </div>
</div>
<div class="row" style="margin-top: 15px">
    <div class="col-sm-4">
        <input type="submit" class="btn btn-primary" value="Save"/>
        <a class="btn btn-outline-gray" href="<?php echo site_url($back); ?>">Back</a>
        <?php echo form_close(); ?>
    </div>
</div>



<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function () {

    });
    //]]>
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

    $('#country').change(function(){

        var country_id = $('#country option:selected').val();
        $.ajax({
            url: '<?php echo site_url($this->admin_folder . '/customers/country-region.html'); ?>',
            type: 'post',
            data: 'country_id=' + country_id,
            dataType: 'json',
            beforeSend: function() {
                //$('#button-cart').button('loading');
            },
            complete: function() {
                //	$('#button-cart').button('reset');
            },
            success: function(json) {
                if (json['result'] == true) {

                    var states =  json['data'];
                    console.log(states);
                    $('#regions').empty();
                    $.each(states,function(key,val){
                        var opt = $('<option />');
                        opt.val(key);
                        opt.text(val);
                        $('#regions').append(opt);
                    });

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });

    });
//--></script>


