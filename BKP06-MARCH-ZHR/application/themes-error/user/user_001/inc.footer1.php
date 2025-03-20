<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<!-- Footer Area -->
<div class="footer-area">
    <!-- Footer Static -->
    <div class="footer-static">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-3 col-sm-12">
                    <div class="footer-static-title">
                        <h3>INFORMATION</h3>
                    </div>
                    <div class="footer-static-content mb-3">
                        <ul>
                            <?php foreach($this->user_pages as $menu_page):?>
                            <li>
                                <?php if(empty($menu_page->content)):?>
                                    <a href="<?php echo href_page($menu_page); ?>" <?php if($menu_page->new_window ==1){echo 'target="_blank"';} ?>>
                                        <span><?php echo $menu_page->menu_title;?></span>
                                    </a>
                                <?php else:?>
                                    <a href="<?php echo href_page($menu_page); ?>">
                                        <span><?php echo $menu_page->menu_title;?></span>
                                    </a>
                                <?php endif;?>
                            </li>
                            <?php endforeach;?>
                            <li><a href="<?php echo site_url('contact-us.html') ?>">Contact Us</a></li>
                        </ul>

                    </div>
                    <!-- Social Footer -->
                    <div class="social-footer">
                        <ul class="link-follow">
                            <li class="first">
                                <a href="https://www.facebook.com/Techcity.Canada/" target="_blank" class="facebook fa fa-facebook"></a>
                            </li>
                            <li>
                                <a href="https://twitter.com/TechCityCanada" target="_blank" class="twitter fa fa-twitter"></a>
                            </li>
                            <li>
                                <a href="#" class="google fa fa-google-plus"></a>
                            </li>
                            <li>
                                <a href="#" class="instagram fa fa-instagram"></a>
                            </li>
                        </ul>
                    </div><!-- End Social Footer -->
                </div>
                <div class="col-lg-4 col-md-3 col-sm-12">
                    <div class="footer-static-title">
                        <h3>TORONTO</h3>
                    </div>
                    <div class="footer-static-content">
                        <div class="contact-info">
                            <p class="phone"><?php echo $this->site_config->item('config_telephone'); ?></p>
                            <p class="email"><?php echo $this->site_config->item('config_email'); ?></p>
                            <p class="adress"><?php echo $this->site_config->item('config_address'); ?></p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-12 d-none">
                    <div class="footer-static-title">
                        <h3>SCARBOROUGH</h3>
                    </div>
                    <div class="footer-static-content">
                        <div class="contact-info">
                            <p class="phone">(416) 751 5222</p>
                            <p class="email">info@pcpearl.com</p>
                            <p class="adress">1274 Kennedy road Scarborough Ontario M1P 2L5</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-3 col-sm-12">
                    <div class="footer-static-title">
                        <h3>NEWSLETTER</h3>
                    </div>
                    <div class="footer-static-content contact-form">
                        <div class="mb-2">
                            <input type="text" name="subscribe_name" placeholder="Name" id="subscribe_name" required="required" class="form-control" style="padding: 5px 8px">
                            <div id="name"></div>
                        </div>
                        <div class="mb-2">
                            <input type="text" title="Sign up for our newsletter" placeholder="Email" name="subscribe_email" id="subscribe_email" required="required" class="form-control" style="padding: 5px 8px">
                            <div id="nemail"></div>
                        </div>
                        <div class="subscribe-action text-right" style="width: 100%">
                            <button id="btn-newsletter"
                               onclick="add_newsletter()" title="Subscribe" type="submit">Subscribe</button>
                        </div>
                        <div id="notification-normal"></div>
                    </div>
                </div>
                <!-- End Single Footer Static -->
            </div>
        </div>
    </div><!-- End Footer Static -->
    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <!-- Copyright -->
                    <div class="copyright">
                        <p>Copyright © 2021 <?php echo $this->site_config->item('config_name'); ?>. All Right Reserved</p>
                    </div>
                </div>
                <div class="col-md-6"> 
                    <!-- Footer Payment -->
                    <div class="footer-payment">
                        <a href="https://www.paypal.com/pk/home" target="_blank"><img src="assets/images/logo/payment.webp" alt="payment"></a>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- End Footer Bottom -->
</div><!-- End Footer Area -->

<!-- Import Javascript -->
<?php $assets_dir = 'assets/'.site_config_item('user_assets').'/js/'; ?>
<?php $vendor_dir = 'assets/vendors/'; ?>


<!-- JS
    ============================================ -->

<!-- Modernizer & jQuery JS -->
<script src="<?php echo site_url($assets_dir.'vendor/modernizr-2.8.3.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'vendor/jquery-1.12.4.min.js'); ?>"></script>


<!-- Bootstrap JS -->
<script src="<?php echo site_url($assets_dir.'popper.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'bootstrap.min.js'); ?>"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Plugins JS -->
<script src="<?php echo site_url($assets_dir.'jquery.nivo.slider.pack.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'jquery.meanmenu.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'jquery-price-slider.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'jquery.simpleGallery.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'jquery.simpleLens.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'owl.carousel.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'jquery.scrollUp.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'dbclick.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'jquery.countdown.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'plugins.js'); ?>"></script>

<!-- script for masked input -->
<script src="<?php echo site_url($assets_dir.'jquery.maskedinput.min.js'); ?>"></script>
<script src="<?php echo site_url($assets_dir.'jquery.maskedinput.js'); ?>"></script>

<!-- <script src="<?php echo site_url($assets_dir.'wishlist.js'); ?>"></script> -->

<!-- Main JS -->
<script src="<?php echo site_url($assets_dir.'main.js'); ?>"></script>
<!-- For Phone number formate -->
<script type"text/javascript">
    $(function(){
        $("#phone").mask("(9999) 999-9999",{placeholder:" "});
    });
</script>

<script type="text/javascript">
    <?php if($this->user_session->flashdata('message')):?>
        toastr.success('success',"<?php echo $this->user_session->flashdata('message') ?>");
    <?php elseif($this->user_session->flashdata('error')):?>
        toastr.error('error',"<?php echo $this->user_session->flashdata('error') ?>");
    <?php endif;?>

    $(document).ready(function(){
            $(document).on('click', '.close',function(event) {
            $('.alert').fadeOut();
        });
        $('.btnRemove').click(function(){
            let formUrl = $(this).closest('form').attr('action');
            $(this).closest('form').attr('action','<?php echo site_url('checkout/remove-cart.html')?>');
            console.log('form-action',formUrl);
            $(this).attr('type','submit');
        })
        $('.add-wishlist').click(function(){
            let formUrl = $(this).closest('form').attr('action');
            $(this).closest('form').attr('action','<?php echo site_url('secure/wishlist/add.html')?>');
            console.log('form-action',formUrl);
            $(this).attr('type','submit');
        });

    }); 

    function add_newsletter() {
        let name = $('input[name=\'subscribe_name\']').val();
        let email = $('input[name=\'subscribe_email\']').val();
        console.log('email',email);
        $.ajax({
            url: '<?php echo site_url('newsletter.html'); ?>',
            type: 'post',
            data: {
                'email': email,
                'name': name,
            },
            dataType: 'json',
            beforeSend: function () {
                $('#btn-newsletter').button('loading');
            },
            complete: function () {
                $('#btn-newsletter').button('reset');
            },
            success: function (json) {
                $('#notification-normal').empty();
                $('#name').empty();
                $('#nemail').empty();

                if (json.error == true) 
                {
                    if (name == '') {

                        $('#name').append('<span class="text-danger"> Name is required</span>');
                    }
                    $('#nemail').append('<span class="text-danger"> ' + json.message + '</span>');
                    
                } else {
                    $('#subscribe_name').val('');
                    $('#subscribe_email').val('');
                    $('#nemail').append('<span class="text-success"> ' + json.message + '</span>');
                }

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    }

</script>

<?php // Javascript files ?>
<?php if (isset($js_files) && is_array($js_files)) : ?>
    <?php foreach ($js_files as $js) : ?>
        <?php if ( ! is_null($js)) : ?>
            <?php echo "\n"; ?><script type="text/javascript" src="<?php echo $js; ?>?v=<?php echo $this->site_config->item('site_version'); ?>"></script><?php echo "\n"; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($js_files_i18n) && is_array($js_files_i18n)) : ?>
    <?php foreach ($js_files_i18n as $js) : ?>
        <?php if ( ! is_null($js)) : ?>
            <?php echo "\n"; ?><script type="text/javascript"><?php echo "\n" . $js . "\n"; ?></script><?php echo "\n"; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($js_custom_external) && is_array($js_custom_external)) : ?>
    <?php foreach ($js_custom_external as $js) : ?>
        <?php if ( ! is_null($js)) : ?>
            <?php echo "\n"; ?><script type="text/javascript" src="<?php echo $js;?>?v=<?php echo $this->site_config->item('site_version'); ?>"></script><?php //echo "\n"; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (isset($js_custom) && is_array($js_custom)) : ?>
    <?php echo "\n"; ?><script type="text/javascript">
        <?php foreach ($js_custom as $js) : ?>
        <?php if ( ! is_null($js)) : ?>
        <?php echo $js; ?>
        <?php //$this->minify->js->add($js);?>
        <?php endif; ?>
        <?php endforeach; ?>
        <?php //echo $this->minify->js->gzip();?>
    </script><?php echo "\n"; ?>
<?php endif; ?>

<?php include('inc.footer-typeahead.php') ?>

</body>
</html>