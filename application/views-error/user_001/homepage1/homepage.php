<?php $assets_img_dir = 'assets/'.site_config_item('user_assets').'/images/'; ?>
<?php $product_img_dir = 'images/products/'; ?>

<style type="text/css">
.product-area .fa-angle-left,
.product-area .fa-angle-right {
    font-size: 2rem;
    background: #FBAA0E none repeat scroll 0 0;
    padding: 20px 10px;
    color: #fff;
}

.deals{
    width: 100%;
}
.owl-item{
    border: 1px solid #2e6ed5;
}
/****************************/
.bbb_viewed {
    padding: 40px 40px;
    background: #eff6fa
}

.bbb_main_container {
    padding: 20px 15px;
    border: 2px solid #FBAA0E;
}

.bbb_viewed_title_container {
    border-bottom: solid 1px #dadada;
    display: flex;
}

.bbb_viewed_title {
    margin-bottom: 16px;
    margin-top: 8px;
    width: 30%;

}

.bbb_viewed_nav_container {
    /*     position: absolute;*/
    /*     right: -5px;*/
    /*     bottom: 14px;*/
    text-align: right;
    width: 70%;
}

.bbb_viewed_nav {
    display: inline-block;
    cursor: pointer
}

.bbb_viewed_nav i {
    color: #dadada;
    font-size: 18px;
    padding: 5px;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease
}

.bbb_viewed_nav:hover i {
    color: #606264
}

.bbb_viewed_prev {
    margin-right: 15px
}

.bbb_viewed_slider_container {
    padding-top: 13px;
}

.bbb_viewed_item {
    width: 100%;
    background: #FFFFFF;
    border-radius: 2px;
    padding: 10px;
/*    border: 1px solid #2e6ed5;*/
    height: 250px;
}

.bbb_viewed_image {
    width: 150px;
    height: 150px;
}

.bbb_viewed_image img {
    display: block;
    max-width: 100%
}

.bbb_viewed_content {
    width: 100%;
    margin-top: 25px
}

.bbb_viewed_price {
    font-size: 16px;
    color: #000000;
    font-weight: 500
}

.bbb_viewed_item.discount .bbb_viewed_price {
    color: #2e6ed5;
}

.bbb_viewed_price span {
    position: relative;
    font-size: 12px;
    font-weight: 400;
    color: rgba(0, 0, 0, 0.6);
    margin-left: 8px
}

.bbb_viewed_price span::after {
    display: block;
    position: absolute;
    top: 6px;
    left: -2px;
    width: calc(100% + 4px);
    height: 1px;
    background: #8d8d8d;
    content: ''
}

.bbb_viewed_name {
    margin-top: 3px
}

.bbb_viewed_name a {
    font-size: 14px;
    color: #000000;
    -webkit-transition: all 200ms ease;
    -moz-transition: all 200ms ease;
    -ms-transition: all 200ms ease;
    -o-transition: all 200ms ease;
    transition: all 200ms ease
}

.bbb_viewed_name a:hover {
    color: #0e8ce4
}

.item_marks {
    position: absolute;
    top: 12px;
    left: 12px
}

.item_mark {
    display: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    color: #FFFFFF;
    font-size: 10px;
    font-weight: 500;
    line-height: 36px;
    text-align: center
}

.item_discount {
    background: #2e6ed5;
    margin-right: 2px;
}

.item_new {
    background: #0e8ce4
}

.bbb_viewed_item.discount .item_discount {
    display: inline-block
}

.bbb_viewed_item.is_new .item_new {
    display: inline-block
}
</style>

<!-- Main Slider Area -->
<?php include('inc.slider.php') ?>
<!-- End Main Slider Area -->

<!-- Top Banner Area -->
<div class="top-banner-area" hidden>
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-md-3 col-sm-6">
                <!-- Single Banner -->
                <div class="single-banner">
                    <a href="#"><img src="<?php echo site_url($assets_img_dir.'banner/banner1.webp') ?>"
                            alt="banner"></a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <!-- Single Banner -->
                <div class="single-banner">
                    <a href="#"><img src="<?php echo site_url($assets_img_dir.'banner/banner2.webp') ?>"
                            alt="banner"></a>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <!-- Single Banner -->
                <div class="single-banner">
                    <a href="#"><img src="<?php echo site_url($assets_img_dir.'banner/banner3.webp') ?>"
                            alt="banner"></a>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Top Banner Area -->

<!-- Single Product Area -->
<?php if(isset($sale_products) && !empty($sale_products)){?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.2.1/owl.carousel.js"></script>
<div class="bbb_viewed">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="bbb_main_container">
                    <div class="bbb_viewed_title_container">
                        <h3 class="bbb_viewed_title">Deals</h3>
                        <div class="bbb_viewed_nav_container">
                            <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fa fa-chevron-left"></i></div>
                            <div class="bbb_viewed_nav bbb_viewed_next"><i class="fa fa-chevron-right"></i></div>
                        </div>
                    </div>
                    <div class="bbb_viewed_slider_container">
                        <div class="owl-carousel owl-theme bbb_viewed_slider">
                            <?php foreach($sale_products as $key=>$val) 
                                {
                                    if ($val->special_price) { ?>
                            <div class="owl-item deals">
                                <div class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="bbb_viewed_image"><a href="<?php echo href_product($val) ?>">
                                            <?php
                                            $imgClass = '';
                                            echo create_product_image_html($val ,'small' , 1 ,null ,null ,  $imgClass);
                                            ?></a></div>
                                    <div class="bbb_viewed_content text-center">
                                        <div class="bbb_viewed_price">
                                            <?php echo format_currency($val->special_price); ?><span><?php echo format_currency($val->sale_price); ?></span>
                                        </div>
                                        <div class="bbb_viewed_name"><a title="<?php echo $val->product_name; ?>"
                                                href="<?php echo href_product($val) ?>"><?php echo $val->product_name; ?></a>
                                        </div>
                                    </div>
                                    <ul class="item_marks">
                                        <li class="item_mark item_discount">Sale</li>
                                        <!-- <li class="item_mark item_new">new</li> -->
                                    </ul>
                                </div>
                            </div>
                            <?php }} ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php }?>
<!-- single Product Area -->


<div class="product-area">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <!-- Product View Area -->
                <div class="product-view-area fix">
                    <?php  if(isset($bestseller_products) && !empty($bestseller_products)){?>
                    <div class="single-product-category">
                        <div class="head-title">
                            <p>BESTSELLER PRODUCTS</p>
                        </div>
                        <?php include('inc.bestseller.php') ;?>
                    </div>

                    <?php }
                    if (isset($new_arrival_products) && !empty($new_arrival_products)){ ?>

                    <div class="single-product-category">

                        <div class="head-title">
                            <p>NEW ARRIVALS</p>
                        </div>
                        <?php include('inc.new.arrivals.php'); ?>
                    </div>
                    <?php } 
                    if (isset($special_products) && !empty($special_products)){ ?>
                    <div class="single-product-category">
                        <div class="head-title">
                            <p>SPECIAL PRODUCTS</p>
                        </div>
                        <?php include('inc.special.php'); ?>
                    </div>
                    <?php }
                    if (isset($most_view_products) && !empty($most_view_products)){ ?>

                    <div class="single-product-category">

                        <div class="head-title">
                            <p>AWESOME SAVINGS</p>
                        </div>
                        <?php include('inc.mostviewed.php'); ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div><!-- End Product Area -->

<!-- Services Group -->
<script type="text/javascript">
$(function() {
    // $('.owl-stage').css('width','100%');
    $('.product-area .owl-item').css('width', '231px'); //240px
    if ($('.bbb_viewed_slider').length) {
        var viewedSlider = $('.bbb_viewed_slider');

        viewedSlider.owlCarousel({
            loop: true,
            margin: 10,
            autoplay: true,
            autoplayTimeout: 6000,
            nav: false,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                575: {
                    items: 1
                },
                768: {
                    items: 3
                },
                991: {
                    items: 4
                },
                1199: {
                    items: 6
                }
            }
        });

        if ($('.bbb_viewed_prev').length) {
            var prev = $('.bbb_viewed_prev');
            prev.on('click', function() {
                viewedSlider.trigger('prev.owl.carousel');
            });
        }

        if ($('.bbb_viewed_next').length) {
            var next = $('.bbb_viewed_next');
            next.on('click', function() {
                viewedSlider.trigger('next.owl.carousel');
            });
        }
    }
});
</script>