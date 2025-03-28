<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; 
?>
<style>
	.tf-page-title{
	padding: 69px 0 65px;
    background-image: url(<?php echo site_url($assets_img_dir.'/shop/file/page-title-blog.png') ?>);
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
	}
</style>
<!-- reCaptcha -->
<!-- <script src="https://www.google.com/recaptcha/api.js" async defer></script> -->

        <!-- page-title -->
        <div class="tf-page-title style-2">
            <div class="container-full">
                <div class="heading text-center">Contact Us</div>
            </div>
        </div>
        <!-- /page-title -->
        <!-- map -->
        <section class="flat-spacing-9">
            <div class="container">
                <div class="tf-grid-layout gap-0 lg-col-2">
                    <div class="w-100">
                        <!-- <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d317859.6089702069!2d-0.075949!3d51.508112!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x48760349331f38dd%3A0xa8bf49dde1d56467!2sTower%20of%20London!5e0!3m2!1sen!2sus!4v1719221598456!5m2!1sen!2sus" width="100%" height="894" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe> -->
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3307.812009849324!2d71.53511697443005!3d33.997362120628395!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38d917bd3a34f605%3A0x108cbd719083b627!2sMolako%20Super%20Store!5e0!3m2!1sen!2s!4v1726842695827!5m2!1sen!2s" width="100%" height="500" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                    <div class="tf-content-left has-mt">
                        <div class="sticky-top">
                            <h5 class="mb_20">Visit Our Store</h5>
                            <div class="mb_20">
                                <p class="mb_15"><strong>Address</strong></p>
                                <p><?php echo $this->site_config->item('config_address'); ?></p>
                            </div>
                            <div class="mb_20">
                                <p class="mb_15"><strong>Phone</strong></p>
                                <p><a href="tel:<?php echo $this->site_config->item('config_telephone'); ?>"><?php echo $this->site_config->item('config_telephone'); ?></a></p>
                            </div>
                            <div class="mb_20">
                                <p class="mb_15"><strong>Email</strong></p>
                                <p><?php echo $this->site_config->item('config_email'); ?></p>
                            </div>
                            <div class="mb_36">
                                <p class="mb_15"><strong>Opening Hours</strong></p>
                                <!-- <p class="mb_15">Our store has opened for shopping, </p> -->
                                <p>Everyday 10am to 9pm</p>
                            </div>
                            <div>
                                <ul class="tf-social-icon d-flex gap-20 style-default">
                                    <li><a  target="_blank" href="https://www.facebook.com/MolakoPeshawar?mibextid=ZbWKwL" class="box-icon w_28 round social-facebook bg_line"><img src="<?= base_url($assets_img_dir) ?>facebook_icon.png" /></a></li>
                        <li><a target="_blank" href="https://www.instagram.com/molako_peshawar?igsh=c3R2eTY1bDlxcWhs" class="box-icon w_28 round social-instagram bg_line"><img src="<?= base_url($assets_img_dir) ?>instagram_icon.png" /></a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- /map -->
        <!-- form -->
        <section class="bg_grey-7 flat-spacing-9">
            <div class="container">
                <div class="flat-title">
                    <span class="title">Get in Touch</span>
                    <p class="sub-title text_black-2">If you’ve got great products your making or looking to work with us then drop us a line.</p>
                </div>
                <div>
                    <?php echo form_open(site_url('contact-us.html')) ?>
                        <div class="d-flex gap-15 mb_15">
                            <fieldset class="w-100">
                                 <?php echo form_input_1(array('name'=>'name', 'label'=>'Name *', 'placeholder'=>'Enter your name', 'class'=>'form-control', 'value'=>set_value('name', $name))); ?>
                            </fieldset>
                            <fieldset class="w-100">
                                <?php echo form_input_1(array('name'=>'email', 'label'=>'Email *', 'placeholder'=>'Enter your email', 'class'=>'form-control', 'value'=>set_value('email', $email))); ?>
                            </fieldset>
                            <fieldset class="w-100">
                                <?php echo form_input_1(array('name'=>'phone', 'label'=>'Phone', 'placeholder'=>'Enter your phone ','onkeyup'=>'formatPhone(this)', 'class'=>'form-control', 'value'=>set_value('phone', $phone))); ?>
                            </fieldset>
                        </div>
                        <div class="mb_15">
                             <?php echo form_textarea_1(array('name'=>'message', 'label'=>'Message *', 'placeholder'=>'Message', 'class'=>'form-control', 'value'=>set_value('message', $message))); ?>
                        </div>
                        <div class="send-wrap">
                            <button type="submit" class="tf-btn radius-3 btn-fill animate-hover-btn justify-content-center">Send</button>
                        </div>
                    <?php echo form_close(); ?>
                </div>
            </div>
        </section>
        <!-- /form -->
<!-- Google Map js -->
<!-- <script src="https://maps.googleapis.com/maps/api/js"></script>
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
</script> -->