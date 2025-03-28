<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- Contact area -->
<style>
    .map-area{
        margin: 40px 0;
    }
</style>
<div class="location-area">
    <div class="container">
        <h2 style="text-align: center;">Store Locations</h2>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <!-- contact info -->
                    <div class="col-lg-12 col-md-12 col-12">
                        <div class="store-location">
                            <div class="map-area">
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2885.99898885391!2d-79.34065942342089!3d43.66899085140869!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4cb7f2a0956ef%3A0xbd8783a9805fd59b!2s1012%20Gerrard%20St%20E%2C%20Toronto%2C%20ON%20M4M%201Z3%2C%20Canada!5e0!3m2!1sen!2s!4v1687788232525!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                <!-- <div id="googleMap" style="width:100%;height:410px;"></div> -->
                             </div><!-- End Map area -->
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker"></i> <strong>Address : 1012 Gerrard St E, Toronto, ON M4M 1Z3</strong>
                                </li>
                                <li>
                                    <i class="fa fa-mobile"></i> <strong>Phone : 1(855)-455-1222 </strong>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i> <strong>Email</strong>
                                    <a href="mailto:<?php echo $this->site_config->item('config_email'); ?>"><?php echo $this->site_config->item('config_email'); ?></a>
                                </li>
                            </ul>
                            <div class="map-area">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2881.739004120521!2d-79.2809949234173!3d43.75751634567716!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89d4d1ee05b51753%3A0xbba3acc044f9bd97!2s1274%20Kennedy%20Rd%2C%20Scarborough%2C%20ON%20M1P%202L5%2C%20Canada!5e0!3m2!1sen!2s!4v1687788278582!5m2!1sen!2s" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    <!-- <div id="googleMap" style="width:100%;height:410px;"></div> -->
                            </div><!-- End Map area -->
                            <ul>
                                <li>
                                    <i class="fa fa-map-marker"></i> <strong>Address : 1274 Kennedy road Scarborough Ontario M1P 2L5 </strong>
                                </li>
                                <li>
                                    <i class="fa fa-mobile"></i> <strong>Phone : (416) 751 5222</strong>
                                </li>
                                <li>
                                    <i class="fa fa-envelope"></i> <strong>Email</strong>
                                    <a href="mailto:<?php echo $this->site_config->item('config_email'); ?>"><?php echo $this->site_config->item('config_email'); ?></a>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End contact info -->
                </div>
            </div>
        </div>
    </div>
</div>
                













