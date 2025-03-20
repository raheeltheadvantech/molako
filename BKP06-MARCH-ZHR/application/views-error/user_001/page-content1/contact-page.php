<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- reCaptcha -->
<script src="https://www.google.com/recaptcha/api.js" async defer></script>
<style type="text/css">
    .edit{
        border: 2px solid #2e6ed5;
        border-radius: 5px;
    }
    .contact-form{
        padding: 10px;
    }
    .map-area{
        margin-top: 20px;
    }

</style>
<!-- Contact area -->
<div class="contact-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- contact info -->
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="contact-info contact">
                            <h3>Contact info</h3>
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker"></i> <strong>Address</strong>
                                    <?php echo $this->site_config->item('config_address'); ?>
                                </li>
                                <li>
                                    <i class="fa fa-mobile"></i> <strong>Phone</strong>
                                    <?php echo $this->site_config->item('config_telephone'); ?>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i> <strong>Email</strong>
                                    <a href="mailto:<?php echo $this->site_config->item('config_email'); ?>"><?php echo $this->site_config->item('config_email'); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End contact info -->
                    <div class="col-lg-6 col-md-12 col-12 edit">
                        <div class="contact-form ">
                            <h3><i class="fa fa-envelope-o"></i> Leave a Message</h3>
                            <?php echo form_open(site_url('contact-us.html')) ?>
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <!-- <input name="name" type="text" placeholder="Name (required)" /> -->
                                        <?php echo form_input_1(array('name'=>'name', 'label'=>'Name *', 'placeholder'=>'Enter your name here...', 'class'=>'form-control', 'value'=>set_value('name', $name))); ?>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                                        <?php echo form_input_1(array('name'=>'email', 'label'=>'Email *', 'placeholder'=>'Enter your email address here...', 'class'=>'form-control', 'value'=>set_value('email', $email))); ?>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <?php echo form_input_1(array('name'=>'phone', 'label'=>'Phone', 'placeholder'=>'Enter your phone number i.e. (416) 751 5222', 'class'=>'form-control', 'value'=>set_value('phone', $phone))); ?>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                                        <?php echo form_textarea_1(array('name'=>'message', 'label'=>'Message *', 'placeholder'=>'Message', 'class'=>'form-control', 'value'=>set_value('message', $message))); ?>
                                        <!-- Google reCAPTCHA box -->
                                        <!-- <div class="g-recaptcha" data-sitekey="6LdmcvkmAAAAAJWcyb_B-lNqQOZiEY5wpIIcmxoK" style="margin-top: 10px"></div> -->
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-right">
                                        <input  id="submit" type="submit" value="Submit Form"  style="margin-bottom: 10px;"/>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Map area -->
                        <div class="map-area">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.9989884683705!2d-79.34027318424558!3d43.66899085942694!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4cb7f2a0956ef%3A0xbd8783a9805fd59b!2s1012%20Gerrard%20St%20E%2C%20Toronto%2C%20ON%20M4M%201Z3%2C%20Canada!5e0!3m2!1sen!2s!4v1659341501666!5m2!1sen!2s" width="100%" height="410" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                            <!-- <div id="googleMap" style="width:100%;height:410px;"></div> -->
                        </div><!-- End Map area -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Eontact area -->

<script>
    $(document).ready(function(){

        $('#submit').on('click', function(){

            var captcha = $('#captcha').val();
            var answer = $('#answer').val();
             if(captcha != answer){
                 $('#result').html('<center><label class="text-warning">Enter Valid Captcha Value!</label></center>');
                 return false;
             }
        });
    });


</script>





<!-- Google Map js -->
<script src="https://maps.googleapis.com/maps/api/js"></script>
<script>
    function initialize() {
        var mapOptions = {
            zoom: 15,
            scrollwheel: false,
            center: new google.maps.LatLng(23.81033, 90.41252)
        };

        var map = new google.maps.Map(document.getElementById('googleMap'),
            mapOptions);


        var marker = new google.maps.Marker({
            position: map.getCenter(),
            animation:google.maps.Animation.BOUNCE,
            icon: 'img/logo/map-marker.webp',
            map: map
        });

    }

    google.maps.event.addDomListener(window, 'load', initialize);
</script>
<!-- plugins JS













