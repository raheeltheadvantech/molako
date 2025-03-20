<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>


<?php $placeholder = base_url($this->config->item('placeholder_image')); ?>
<?php $entry_sort_order = 'sort'; ?>
<?php $button_remove = 'Remove'; ?>
<?php $row = 0; ?>


<?php echo form_open($this->admin_folder . '/' . $this->controller_dir . '/' . $route); ?>
<div class="row">

    <div class="col-md-12">
        <div class="page-header">
            <h4>Geo Zones</h4>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php
                echo form_input_1(array('name' => 'name', 'label' => 'Name', 'placeholder' => 'Geo Zone Name', 'class' => 'form-control', 'value' => set_value('name', $name)));
                //echo form_dropdown('country_id', $country_options, set_value('country_id', $country_id), 'class="form-control" id="country"');
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?php
                $data = array('name'=>'description', 'label'=>'Description', 'placeholder'=>'Geo Zone description', 'class'=>'form-control', 'value'=>set_value('description', $description), 'rows'=>4);
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
                    <table id="zone-to-geo-zone" class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr>
                            <td class="text-left" style="width: 20%"  colspan="3">Geo Zones</td>
                        </tr>
                        <tr>
                            <td class="text-left" style="width: 20%">Country</td>
                            <td style="width: 50%">Zones</td>
                            <td>Action</td>
                        </tr>
                        </thead>
                        <tbody>

                        <?php
                        if(!empty($zone_to_geo_zone)){
                        foreach($zone_to_geo_zone as $val) {?>

                        <tr id="zone-to-geo-zone-row<?php echo $row; ?>">
                            <td class="text-left"><select name="zone_to_geo_zone[<?php echo $row; ?>][country_id]" class="form-control" data-index="<?php echo $row; ?>" data-zone-id="<?php echo $val->zone_id; ?>" disabled="disabled">

                                    <?php foreach($country_options as $key=>$val2){ ?>
                                   <?php if($key == $val->country_id) {?>
                                    <option value="<?php echo $key; ?>" selected="selected"><?php echo RemoveSpecialChar($val2); ?></option>
                                    <?php }else{?>
                                        <option value="<?php echo $key; ?>" ><?php echo RemoveSpecialChar($val2); ?></option>
                                   <?php } } ?>
                                </select>
                            </td>
                            <td class="text-left"><select name="zone_to_geo_zone[<?php echo $row; ?>][zone_id]" class="form-control" disabled="disabled">
                                </select></td>
                            <td class="text-left"><button type="button" onclick="$('#zone-to-geo-zone-row<?php echo $row; ?>').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>
                        </tr>

                        <?php $row++;  } } ?>

                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td class="text-left"><button type="button" id="button-geo-zone"  data-toggle="tooltip" title="Add/edit Special Price" class="btn btn-primary" data-original-title="Add/edit Special Price"><i class="fa fa-plus-circle"></i></button></td>
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

<?php


?>



        <script type="text/javascript"><!--
            var zone_to_geo_zone_row = <?php echo $row; ?>;

            $('#button-geo-zone').on('click', function() {

                html  = '<tr id="zone-to-geo-zone-row' + zone_to_geo_zone_row + '">';
                html += '  <td class="text-left"><select name="zone_to_geo_zone[' + zone_to_geo_zone_row + '][country_id]" class="form-control" data-index="' + zone_to_geo_zone_row + '">';


                <?php foreach($country_options as $key=>$val){ ?>
                html += '    <option value="<?php echo $key; ?>" <?php if($key == $default_country){  echo 'selected'; }?> ><?php echo RemoveSpecialChar($val); ?></option>';
                <?php } ?>
                html += '</select></td>';
                html += '  <td class="text-left"><select name="zone_to_geo_zone[' + zone_to_geo_zone_row + '][zone_id]" class="form-control">' ;

                <?php foreach($regions as $key=>$val){ ?>
                html += '    <option value="<?php echo $key; ?>"><?php echo RemoveSpecialChar($val); ?></option>';
                <?php } ?>

                html += '</select></td>';

                    html += '  <td class="text-left"><button type="button" onclick="$(\'#zone-to-geo-zone-row' + zone_to_geo_zone_row + '\').remove();" data-toggle="tooltip" title="{{ button_remove }}" class="btn btn-danger"><i class="fa fa-minus-circle"></i></button></td>';
                html += '</tr>';

                $('#zone-to-geo-zone tbody').append(html);

                $('zone_to_geo_zone[' + zone_to_geo_zone_row + '][country_id]').trigger();

                zone_to_geo_zone_row++;
            });



            $('#zone-to-geo-zone').on('change', 'select[name$=\'[country_id]\']', function() {

                var element = this;

                if (element.value) {

                    $.ajax({
                        url: '<?php echo site_url($this->admin_folder . '/localisation/country-region.html'); ?>',
                        type: 'post',
                        data: 'country_id=' + element.value,
                        dataType: 'json',
                        beforeSend: function() {
                            $(element).prop('disabled', true);
                            $('button[form=\'form-geo-zone\']').prop('disabled', true);
                        },
                        complete: function() {
                            $(element).prop('disabled', false);
                            $('button[form=\'form-geo-zone\']').prop('disabled', false);
                        },
                        success: function(json) {
                            html = '<option value="0">All Zones</option>';
                            var states =  json['data'];
                            $.each(states,function(key,val){


                                var opt = $('<option />');
                                opt.val(key);
                                opt.text(val);
                                $('#regions').append(opt);

                                html += '<option value="' + key + '"';

                                if (key == $(element).attr('data-zone-id')) {
                                    html += ' selected="selected"';
                                }

                                html += '>' + val + '</option>';


                            });

                            $('select[name=\'zone_to_geo_zone[' + $(element).attr('data-index') + '][zone_id]\']').html(html);

                            $('select[name=\'zone_to_geo_zone[' + $(element).attr('data-index') + '][zone_id]\']').prop('disabled', false);

                            $('select[name$=\'[country_id]\']:disabled:first').trigger('change');
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                        }
                    });
                }
            });

            $('select[name$=\'[country_id]\']:disabled:first').trigger('change');

            //--></script>





