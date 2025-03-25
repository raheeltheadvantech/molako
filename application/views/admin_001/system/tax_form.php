<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php echo form_open($this->admin_folder . '/' . $this->controller_dir . '/' . $route); ?>
<div class="row">

    <div class="col-md-12">
        <div class="page-header">
            <h4>Tax Price Form</h4>
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

        <div class="row">
            <div class="col-sm-4">
                <?php echo form_input_1(array('name' => 'tax_rate', 'label' => 'Tax Rate', 'placeholder' => 'Tax Rate', 'class' => 'form-control', 'value' => set_value('tax_rate', $tax_rate))); ?>
            </div>
        </div>

    </div>
</div>
<div class="row" style="margin-top: 15px">
    <div class="col-sm-4">
        <input type="submit" class="btn btn-primary" value="Save"/>
        <?php echo form_close(); ?>
    </div>
</div>


<script>

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


