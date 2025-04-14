<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<style type="text/css">
    .all_mail{
        display: none;
    }
    .success{
        color: green;
    }
    .error{
        color: red;
    }
</style>
<?php echo form_open($this->admin_folder .'/'. $this->controller_dir. '/setting.html' ); ?>
<div class="row">

<div class="col-md-12">

    <div class="page-header">
        <h4>Settings</h4>
    </div>

<div class="panel with-nav-tabs panel-default">
	<div class="panel-heading">
        <ul class="nav nav-tabs">
          <li class="active"><a href="#tab-general" data-toggle="tab">General</a></li>
          <li><a href="#tab-store" data-toggle="tab">Store</a></li>
          <li><a href="#tab-local" data-toggle="tab">Local</a></li>
          <li><a href="#tab-option" data-toggle="tab">Option</a></li>
          <li><a href="#tab-mail" data-toggle="tab">Mail</a></li>
          <li><a href="#tab-top-bar" data-toggle="tab">Top Bar Content</a></li>
          <li><a href="#paypal_tab" data-toggle="tab">PayPal</a></li>
          <li><a href="#tab-checkout" data-toggle="tab">Checkout</a></li>
        </ul>
	</div>
    <div class="panel-body">
		<div class="tab-content">
        	
        	<div class="tab-pane fade active in" id="tab-general">
            	
                <div class="box-body">
                    <div class="row">
                         <div class="col-sm-12">
                            <?php 
                            $data = array('name'=>'config_meta_title', 'label'=>lang('meta_title'), 'placeholder'=>lang('meta_title'), 'class'=>'form-control', 'value'=>set_value('config_meta_title', $config_meta_title));
                            echo form_input_1($data); 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php 
                            $data = array('name'=>'config_meta_description', 'label'=>lang('meta_description'), 'placeholder'=>lang('meta_description'), 'class'=>'form-control', 'value'=>set_value('config_meta_description', $config_meta_description), 'rows'=>4);
                            echo form_textarea_1($data); 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-sm-12">
                            <?php 
                            $data = array('name'=>'config_meta_keyword', 'label'=>'Meta Keyword', 'placeholder'=>lang('meta_keyword'), 'class'=>'form-control', 'value'=>set_value('config_meta_keyword', $config_meta_keyword), 'rows'=>4);
                            echo form_textarea_1($data); 
                            ?>
                        </div>
                    </div>
                    <div class="row">
                         <div class="col-sm-12">
                            <?php 
                            $data = array('name'=>'config_theme', 'label'=>lang('theme'), 'placeholder'=>lang('theme'), 'class'=>'form-control', 'value'=>set_value('config_theme', $config_theme));
                            echo form_input_1($data); 
                            ?>
                        </div>
                    </div>
                </div>
        
            </div>
            
            <div class="tab-pane fade" id="tab-store">
            	
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                        	<?php 
        					$data = array('name'=>'config_name', 'label'=>lang('name'), 'placeholder'=>lang('name'), 'class'=>'form-control', 'value'=>set_value('config_name', $config_name));
        					echo form_input_1($data);
        					?>
                        </div>
                        <div class="col-sm-6">
                        	<?php 
        					$data = array('name'=>'config_owner', 'label'=>lang('owner'), 'placeholder'=>lang('owner'), 'class'=>'form-control', 'value'=>set_value('config_owner', $config_owner));
        					echo form_input_1($data); 
        					?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                        	<?php 
        					$data = array('name'=>'config_email', 'label'=>lang('email'), 'placeholder'=>lang('email'), 'class'=>'form-control', 'value'=>set_value('config_email', $config_email));
        					echo form_input_1($data);
        					?>
                        </div>
                    <!-- </div>
                    <div class="row"> -->
                        <div class="col-sm-3">
                        	<?php 
        					$data = array('name'=>'config_fax','id' => 'config_fax', 'label'=>lang('fax'), 'placeholder'=>lang('fax'), 'class'=>'form-control', 'value'=>set_value('config_fax', $config_fax));
        					echo form_input_1($data);
        					?>
                        </div>
                        <div class="col-sm-3">
                        	<?php 
        					$data = array('name'=>'config_telephone','id'=>'config_telephone', 'label'=>lang('telephone'), 'placeholder'=>lang('telephone'), 'class'=>'form-control', 'value'=>set_value('config_telephone', $config_telephone));
        					echo form_input_1($data); 
        					?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php 
                            $data = array('name'=>'config_address', 'label'=>lang('address'), 'placeholder'=>lang('address'), 'class'=>'form-control  ', 'value'=>set_value('config_address', $config_address), 'rows'=>4);
                            // redactor tinymce
                            echo form_textarea_1($data);
                            ?>
                        </div>
                    </div>
                </div>
                
            </div>
            
            <div class="tab-pane fade" id="tab-local">
            	
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <?php 
                            $data	= array('name'=>'config_country_id', 'label'=>lang('country'), 'class'=>'form-control dd-country_id', 'id'=>'config_country_id');
                            echo form_dropdown_1($data, $countries_menu, set_value('config_country_id', $config_country_id));
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php 
                            $data	= array('name'=>'config_zone_id', 'label'=>lang('zone_id'), 'class'=>'form-control dd-zone_id', 'id'=>'config_zone_id');
                            echo form_dropdown_1($data, $zones_menu, set_value('config_zone_id', $config_zone_id));
                            ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <?php 
                            $data	= array('name'=>'config_currency', 'label'=>lang('currency'), 'class'=>'form-control dd-currency_name', 'id'=>'config_currency');
                            echo form_dropdown_1($data, $currency_menu, set_value('config_currency', $config_currency));
                            ?>
                        </div>
                    <!-- </div>
                    
                    <div class="row"> -->
                        <div class="col-sm-3">
                            <?php 
                            $data	= array('name'=>'config_weight_class_id', 'label'=>lang('weight_unit'), 'class'=>'form-control', 'id'=>'config_weight_class_id');
                            echo form_dropdown_1($data, $weight_menu, set_value('config_weight_class_id', $config_weight_class_id));
                            ?>
                        </div>
                        <div class="col-sm-3">
                            <?php 
                            $data	= array('name'=>'config_length_class_id', 'label'=>lang('length_unit'), 'class'=>'form-control', 'id'=>'config_length_class_id');
                            echo form_dropdown_1($data, $length_menu, set_value('config_length_class_id', $config_length_class_id));
                            ?>
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-sm-6">
                            <?php
                            $data	= array('name'=>'everyone_discount_status', 'label'=>lang('discount_status'), 'class'=>'form-control', 'id'=>'everyone_discount_status');
                            echo form_dropdown_1($data, $discount_status, set_value('everyone_discount_status', $everyone_discount_status));
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            $data	= array('name'=>'everyone_discount_type', 'label'=>lang('discount_type'), 'class'=>'form-control', 'id'=>'everyone_discount_type');
                            echo form_dropdown_1($data, $discount_type, set_value('everyone_discount_type', $everyone_discount_type));
                            ?>
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-sm-6">
                            <?php
                            $data = array('name'=>'everyone_discount_value', 'label'=>lang('discount_value'), 'placeholder'=>lang('discount_value'), 'class'=>'form-control', 'value'=>set_value('everyone_discount_value', $everyone_discount_value), 'rows'=>4);
                            echo form_input_1($data);
                            ?>
                        </div>
                    </div>

                    <div class="row" style="display: none;">
                        <div class="col-sm-6">
                            <?php
                            $data	= array('name'=>'tax_status', 'label'=>lang('tax_status'), 'class'=>'form-control', 'id'=>'tax_status');
                            echo form_dropdown_1($data, $tax_status_select, set_value('tax_status', $tax_status));
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            $data	= array('name'=>'tax_type', 'label'=>lang('tax_type'), 'class'=>'form-control', 'id'=>'tax_type');
                            echo form_dropdown_1($data, $tax_type_select, set_value('tax_type', $tax_type));
                            ?>
                        </div>
                    </div>
                    <div class="row" style="display: none;">
                        <div class="col-sm-6">
                            <?php
                            $data = array('name'=>'tax_value', 'label'=>lang('tax_value'), 'placeholder'=>lang('tax_value'), 'class'=>'form-control', 'value'=>set_value('tax_value', $tax_value), 'rows'=>4);
                            echo form_input_1($data);
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php
                            //$data = array('name'=>'tax_states', 'label'=>lang('tax_states'), 'placeholder'=>lang('tax_states'), 'class'=>'form-control', 'value'=>set_value('tax_states', $tax_states), 'rows'=>4);
                            //echo form_input_1($data);
                            ?>

                            <label class="control-label" for="input-filter"><span data-toggle="tooltip" title="Related Products">Tax States</span></label>
                            <input type="text" name="tax-states" value="" placeholder="Search for  states" id="input-tax-states" class="form-control" />
                            <div id="tax-state" class="well well-sm" style="height: 150px; overflow: auto;">
                                <?php
                                if(isset($tax_states) && !empty($tax_states)){

                                    foreach ($tax_states as $key=>$val) { ?>
                                        <div id="tax-state<?php echo $key; ?>" class="tax-state"><i class="fa fa-minus-circle"></i> <?php echo $val; ?>
                                            <input type="hidden" name="tax_states[]" value="<?php echo $key; ?>" />
                                        </div>
                                    <?php } }?>
                            </div>
                        </div>
                    </div>


                    
                </div>
                
            </div>
            
            <div class="tab-pane fade" id="tab-option">
            
            
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <?php 
                            $data	= array('name'=>'config_time_zone', 'label'=>lang('time_zone'), 'class'=>'form-control dd-config_time_zone', 'id'=>'config_time_zone');
                            echo form_dropdown_1($data, $time_zone_menu, set_value('config_time_zone', $config_time_zone));
                            ?>
                        </div>
                    </div>
                </div>
                        
            </div>

            <div class="tab-pane fade" id="tab-mail">
                
                <div class="box-body">
                    <div class="row">
                        <div class="col-sm-6" style="    margin-top: 10px;">
                        <span id="send_email_txt" style="display:none;"  class=" pull-left">Loading ...</span>
                        </div>
                        <div class="col-sm-6">
                            <div class="col-sm-10 px-0">
                            <label>your Email:</label>
                            <input type="text" class="form-control" id="your_email" />
                        </div>
                    <div class="col-sm-2" style="margin-top: 20px;">
                        <button type="button" id="send_email" class=" pull-right btn btn-info">Test email</button>
                    </div>
                    </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php 
                            $data = array('name'=>'config_mail_from_name', 'label'=>lang('mail_from_name'), 'placeholder'=>lang('mail_from_name'), 'class'=>'form-control', 'value'=>set_value('config_mail_from_name', $config_mail_from_name));
                            echo form_input_1($data); 
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php 
                            $data = array('name'=>'config_mail_from_email', 'label'=>lang('mail_from_email'), 'placeholder'=>lang('mail_from_email'), 'class'=>'form-control', 'value'=>set_value('config_mail_from_email', $config_mail_from_email));
                            echo form_input_1($data);
                            ?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <?php 
                            $data   = array('name'=>'config_mail_engine','onchange'=>"change_mail_method()", 'label'=>lang('mail_engine'), 'class'=>'form-control', 'id'=>'config_mail_engine');
                            echo form_dropdown_1($data, $mail_engine_menu, set_value('config_mail_engine', $config_mail_engine));
                            ?>
                        </div>
                        <div class="col-sm-3 all_mail smtp">
                            <?php 
                            $data = array('name'=>'config_mail_smtp_hostname','label'=>lang('smtp_host'), 'placeholder'=>lang('mail_smtp_hostname'), 'class'=>'form-control', 'value'=>set_value('config_mail_smtp_hostname', $config_mail_smtp_hostname));
                            echo form_input_1($data); 
                            ?>
                        </div>
                        <div class="col-sm-3  all_mail smtp">
                            <?php 
                            $data = array('name'=>'config_mail_smtp_port', 'label'=>lang('smtp_port'), 'placeholder'=>25, 'class'=>'form-control', 'value'=>set_value('config_mail_smtp_port', $config_mail_smtp_port));
                            echo form_input_1($data); 
                            ?>
                        </div>
                    </div>
                    
                    <div class="row all_mail smtp">
                        <div class="col-sm-6">
                            <?php 
                            $data = array('name'=>'config_mail_smtp_username', 'label'=>lang('smtp_user'), 'placeholder'=>lang('smtp_user'), 'class'=>'form-control', 'value'=>set_value('config_mail_smtp_username', $config_mail_smtp_username));
                            echo form_input_1($data); 
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php 
                            $data = array('name'=>'config_mail_smtp_password', 'label'=>lang('smtp_password'), 'placeholder'=>lang('smtp_password'), 'class'=>'form-control', 'value'=>set_value('config_mail_smtp_password', $config_mail_smtp_password), 'type'=>'password', );
                            echo form_input_1($data);
                            ?>
                        </div>
                    </div>
                    <div class="row all_mail sendgrid">
                        <div class="col-sm-12">
                            <?php $data = array('name'=>'sendgrid_key', 'label'=>'Sendgrid APi Key', 'placeholder'=>'Sendgrid APi Key', 'class'=>'form-control', 'value'=>set_value('sendgrid_key', (isset($sendgrid_key)?$sendgrid_key:'')));
                            echo form_input_1($data);?>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-sm-6 all_mail sendgrid">
                            <?php 
                            $data = array('name'=>'config_sendmail_path', 'label'=>lang('sendmail_path'), 'placeholder'=>lang('sendmail_path'), 'class'=>'form-control', 'value'=>set_value('config_sendmail_path', $config_sendmail_path));
                            echo form_input_1($data);
                            ?><span class="hint">/usr/sbin/sendmail</span>
                        </div>
                        
                    </div>
                    
                    <div class="row all_mail smtp">
                        <div class="col-sm-6">
                            <?php 
                            $data = array('name'=>'config_mail_smtp_timeout', 'label'=>lang('smtp_timeout'), 'placeholder'=>5, 'class'=>'form-control', 'value'=>set_value('config_mail_smtp_timeout', $config_mail_smtp_timeout));
                            echo form_input_1($data);
                            ?>
                        </div>

                        <div class="col-sm-6">
                            <?php 
                            $data   = array('name'=>'config_mail_smtp_crypto', 'label'=>lang('smtp_crypto'), 'class'=>'form-control', 'id'=>'config_mail_smtp_crypto');
                            echo form_dropdown_1($data, $mail_smtp_crypto_menu, set_value('config_mail_smtp_crypto', $config_mail_smtp_crypto));
                            ?>
                        </div>
                    </div> 
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <?php 
                            $data = array('name'=>'config_alert_emails', 'label'=>'Additional emails', 'placeholder'=>'Additional emails', 'class'=>'form-control', 'value'=>set_value('config_alert_emails', $config_alert_emails), 'rows'=>4);
                            echo form_textarea_1($data);
                            ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php 
                            $options = array(
                                        '1' => 'Yes',
                                        '0' => 'No'
                                        );
                            $data = array('name'=>'config_is_send_email_customer', 'label'=>'Send email to customer', 'class'=>'form-control',);
                            echo form_dropdown_1($data, $options, set_value('config_is_send_email_customer', $config_is_send_email_customer));
                            ?>
                        </div>
                        <div class="col-sm-6">
                            <?php 
                            $options = array(
                                        '1' => 'Yes',
                                        '0' => 'No'
                                        );
                            $data = array('name'=>'config_is_send_email_admin', 'label'=>'Send email to admin', 'class'=>'form-control',);
                            echo form_dropdown_1($data, $options, set_value('config_is_send_email_admin', $config_is_send_email_admin));
                            ?>
                        </div>
                    </div>
                    
                    
                    
                </div>
                
            </div>
            <div class="tab-pane fade" id="tab-top-bar">
                <div class="form-wrapper">
                    <div class="form-group">
                        <?php
                        $data = array('name'=>'config_top_bar_content', 'label'=>'Top Bar Content', 'placeholder'=>'Top Bar Content', 'class'=>'form-control redactor tinymce', 'value'=>set_value('config_alert_emails', $config_top_bar_content), 'rows'=>1);
                        echo form_textarea_1($data);
                        ?>
                    </div>
                </div>
                <div class="form-wrapper">
                    <div class="form-group">
                        <?php
                        $data = array('name'=>'config_bottom_bar_content', 'label'=>'Bottom Bar Content', 'placeholder'=>' Bottom Bar Content', 'class'=>'form-control redactor tinymce', 'value'=>set_value('config_bottom_bar_conten', $config_bottom_bar_content), 'rows'=>1);
                        echo form_textarea_1($data);
                        ?>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="paypal_tab">
                <div class="row">
                    <div class="col-sm-4">
                        <?php $data = array('name'=>'config_paypal_sandbox_username', 'label'=>'API Username', 'placeholder'=>'API Username', 'class'=>'form-control', 'value'=>set_value('config_paypal_sandbox_username', $config_paypal_sandbox_username));
                        echo form_input_1($data);?>
                    </div>
                    <div class="col-sm-4">
                        <?php $data = array('name'=>'config_paypal_sandbox_password', 'label'=>'API Password', 'placeholder'=>'API Password', 'class'=>'form-control', 'value'=>set_value('config_paypal_sandbox_password', $config_paypal_sandbox_password));
                        echo form_input_1($data);?>
                    </div>
                    <div class="col-sm-4">
                      <?php $data = array('name'=>'config_paypal_sandbox_api_signature', 'label'=>'API Signature', 'placeholder'=>'API Signature', 'class'=>'form-control', 'value'=>set_value('config_paypal_sandbox_api_signature', $config_paypal_sandbox_api_signature));
                        echo form_input_1($data);?>
                    </div>
                </div>
                <div class="row">
                  <div class="col-md-2">
                      <label>Is Sandbox</label>
                      <?php
                      $options = array(
                          '0' => 'No',
                          '1' => 'Yes'
                      );
                      echo form_dropdown('config_paypal_is_sandbox', $options, set_value('config_paypal_is_sandbox', $config_paypal_is_sandbox), 'class="form-control"');
                      ?>
                  </div>
                </div>
            </div>
            
            <div class="tab-pane fade" id="tab-checkout">
                <div class="row">
                    <div class="col-md-3">
                        <label>Display Out of stock</label>
                        <div class="form-check">
                          <input class="form-check-input outstock" type="checkbox" 
                            name="config_catalog_outstock" 
                            value="1" <?php echo ($config_catalog_outstock)? 'checked="checked"' : '';?>>
                          <label class="form-check-label">Yes</label>
                        </div>
                    </div>
                    <div class="col-md-3 allow_purchase" >
                        <label>Allow Purchase out of stock product</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" 
                            name="config_catalog_purchase" 
                            value="1" <?php echo ($config_catalog_purchase)? 'checked="checked"' : '';?>>
                          <label class="form-check-label">Yes</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Disable Checkout</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" 
                            name="config_catalog_disable_checkout" 
                            value="1" <?php echo ($config_catalog_disable_checkout)? 'checked="checked"' : '';?>>
                          <label class="form-check-label">Yes</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label>Coupon Code</label>
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" 
                            name="config_checkout_coupon_code" 
                            value="1" <?php echo ($config_checkout_coupon_code)? 'checked="checked"' : '';?>>
                          <label class="form-check-label">Yes</label>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
	</div>



</div>

</div>
</div>
<input type="submit" class="btn btn-primary" value="Save" />
<?php echo form_close(); ?>

<!-- TinyMCE JS Editor-->
<script type="text/javascript" src="<?php echo site_url('assets/admin_001/js/tinymce/tinymce.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/admin_001/js/tinymce/jquery.tinymce.min.js'); ?>"></script>
<script type="text/javascript" src="<?php echo site_url('assets/admin_001/js/tinymce/tinymce_properties_minimal.js'); ?>"></script>



<script type="text/javascript">
//<![CDATA[
$(document).ready(function(){

    //$.mask.definitions['X'] = '[0-9]';
    $("#config_telephone,#config_fax").mask("<?php echo get_phone_format_js()?>",{placeholder:"_"});
});
//]]>
$(function() {
    <?php if($config_catalog_outstock){?>
        $('.allow_purchase').show();
    <?php }?>
    $('.outstock').change(function(){
        // let outstock = $(this).val();
        console.log('outstock',$(this).is(":checked"));
        if ($(this).is(":checked") == true) {
            $('.allow_purchase').show();
        }else{
            $('.allow_purchase').hide();
        }
        
    });
})

$('input[name=\'tax-states\']').typeahead({
    source: function(query, process){
        objects = [];
        map = {};
        $.ajax({
            url:'<?php echo site_url($this->admin_folder.'/common/state-autocomplete.html') ?>',
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
        $('#tax-state' + map[item].value).remove();
        $('#tax-state').append('<div id="tax-state' + map[item].value + '" class="tax-state"><i class="fa fa-minus-circle"></i> ' + map[item].label + '<input type="hidden" name="tax_states[]" value="' + map[item].value + '" /></div>');
        $('input[name=\'tax-states\']').val('');
        //return item;
    }
});

$('#tax-state').delegate('.fa-minus-circle', 'click', function() {
    $(this).parent().remove();
});
</script>


<script><!--//
    $('#config_country_id').change(function(){

        var country_id = $('#config_country_id option:selected').val();
        $.ajax({
            url: '<?php echo site_url($this->admin_folder . '/customers/country-region.html'); ?>',
            type: 'post',
            data: 'country_id=' + country_id,
            dataType: 'json',
            beforeSend: function() {
                //$('#button-cart').button('loading');
            },
            complete: function() {
                //  $('#button-cart').button('reset');
            },
            success: function(json) {
                if (json['result'] == true) {

                    var states =  json['data'];
                    console.log(states);
                    $('#config_zone_id').empty();
                    $.each(states,function(key,val){
                        var opt = $('<option />');
                        opt.val(key);
                        opt.text(val);
                        $('#config_zone_id').append(opt);
                    });

                }
            },
            error: function(xhr, ajaxOptions, thrownError) {
                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });

    });
    function change_mail_method()
    {
        $('.all_mail').hide();
        var val = $('select[name="config_mail_engine"]').val();
        $('.'+val).show();

    }
    $('.mail_alert').click(function(){
        change_mail_method();
    });
    function isEmail(emailAdress){
    let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (emailAdress.match(regex)) 
    return true; 

   else 
    return false; 
}
    $('#send_email').click(function(){

        var your_email = $('#your_email').val();
        $('#send_email_txt').removeClass('success');
        $('#send_email_txt').removeClass('error');
        $('#send_email_txt').text('');
        $('#send_email_txt').fadeOut("slow");
        if(isEmail(your_email))
        {
        var url ="<?= base_url($this->admin_folder .'/'. $this->controller_dir. '/test-email.html') ?>";
        $.ajax({
        url: url,
        dataType: "json",
        type: "Post",
        async: true,
        data: {'your_email':your_email },
        success: function (data) {
            if(data.status)
            {
                $('#send_email_txt').addClass('success');
                $('#send_email_txt').text(data.msg);

            }
            else
            {
                $('#send_email_txt').addClass('error');
                $('#send_email_txt').text(data.msg);


            }
            $('#send_email_txt').fadeIn("slow");
           
        },
        error: function (xhr, exception) {
            var msg = "";
            if (xhr.status === 0) {
                msg = "Not connect.\n Verify Network." + xhr.responseText;
            } else if (xhr.status == 404) {
                msg = "Requested page not found. [404]" + xhr.responseText;
            } else if (xhr.status == 500) {
                msg = "Internal Server Error [500]." +  xhr.responseText;
            } else if (exception === "parsererror") {
                msg = "Requested JSON parse failed.";
            } else if (exception === "timeout") {
                msg = "Time out error." + xhr.responseText;
            } else if (exception === "abort") {
                msg = "Ajax request aborted.";
            } else {
                msg = "Error:" + xhr.status + " " + xhr.responseText;
            }
           
        }
    }); 
        }
        else
        {
            $('#send_email_txt').removeClass('success');
            $('#send_email_txt').addClass('error');
            $('#send_email_txt').text('Enter valid email address!');
            $('#send_email_txt').fadeIn("slow");

        }

    });
    //--></script>




