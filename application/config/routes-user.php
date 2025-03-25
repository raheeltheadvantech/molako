<?php defined('BASEPATH') OR exit('No direct script access allowed');





/**************************************/

/**************************************/

/*********		USER		***********/

/**************************************/

/**************************************/



//$route['modules/(.+)']								= 'User_modules/index';



$route['login.html']								= 'User_home/login_redirect';
$route['test.html']								= 'User_home/test';
$route['special_products.html']								= 'User_home/special_products';
$route['best_products.html']								= 'User_home/best_products';

$route['register.html']								= 'User_home/register_redirect';





$user_url_prefix = 'secure/';

$user_dir_prefix = 'user/account/';





$route[$user_url_prefix.'forget-password.html']		= 'User_home/forget_password';

$route[$user_url_prefix.'reset-password.html']		= 'User_home/reset_password';



$route[$user_url_prefix. 'dashboard.html']			= $user_dir_prefix.'User_dashboard/index';



$route[$user_url_prefix. 'profile.html']			= $user_dir_prefix.'User_account/edit_account';

$route[$user_url_prefix. 'edit-profile.html']		= $user_dir_prefix.'User_account/edit_account';

$route[$user_url_prefix. 'change-password.html']	= $user_dir_prefix.'User_account/change_password';



$route[$user_url_prefix. 'addresses.html']					= $user_dir_prefix.'User_address/index';

$route[$user_url_prefix. 'addresses/add.html'] 				= $user_dir_prefix.'User_address/add_address';

$route[$user_url_prefix. 'addresses/make_default.html'] 				= $user_dir_prefix.'User_address/make_default';

$route[$user_url_prefix. 'addresses/edit.html'] 			= $user_dir_prefix.'User_address/edit_address';

$route[$user_url_prefix. 'addresses/delete.html'] 			= $user_dir_prefix.'User_address/delete_address';

$route[$user_url_prefix. 'addresses/country-region.html']	= $user_dir_prefix.'User_address/get_region_by_country';



$route[$user_url_prefix. 'order-history.html']			= $user_dir_prefix.'User_order/index';

$route[$user_url_prefix. 'order-history-detail.html'] 	= $user_dir_prefix.'User_order/order_detail';

$route[$user_url_prefix. 'transactions.html'] 			= $user_dir_prefix.'User_order/transactions_list';



$route[$user_url_prefix. 'wishlist.html'] 				= $user_dir_prefix.'User_wishlist/index';

$route[$user_url_prefix. 'wishlist/add.html'] 			= $user_dir_prefix.'User_wishlist/add_to_wishlist';

$route[$user_url_prefix. 'wishlist/remove.html'] 		= $user_dir_prefix.'User_wishlist/remove_from_wishlist';



$route[$user_url_prefix. 'logout']					= $user_dir_prefix.'User_account/logout';

$route[$user_url_prefix. 'signout']					= $user_dir_prefix.'User_account/logout';

$route[$user_url_prefix. 'logout.html']				= $user_dir_prefix.'User_account/logout';

$route[$user_url_prefix. 'signout.html']			= $user_dir_prefix.'User_account/logout';





$route[$user_url_prefix. 'signin']					= 'User_home/signin';

$route['quickview.html']			                = 'User_home/quick_view';

$route[$user_url_prefix. 'login']					= 'User_home/signin';

$route[$user_url_prefix. 'login.html']				= 'User_home/login';

$route[$user_url_prefix. 'register.html']			= 'User_home/register';

$route[$user_url_prefix. 'ajax_login.html']			= 'User_home/ajax_login';



$user_url_prefix = '';

$user_dir_prefix = 'user/';



$route[$user_url_prefix. 'brands.html']					    = $user_dir_prefix.'User_brand/get_brand';

$route[$user_url_prefix. 'catalog.html']					= $user_dir_prefix.'User_catalog/index';

$route[$user_url_prefix. 'catalog/brand/(:any).html']		= $user_dir_prefix.'User_catalog/brands/$1';

$route[$user_url_prefix. 'catalog_ajax.html']				= $user_dir_prefix.'User_catalog/catalog_ajax';

$route[$user_url_prefix. 'catalog/product-detail.html']		= $user_dir_prefix.'User_catalog/product_detail';

$route[$user_url_prefix. 'catalog/ajax/open-lightbox.html']	= $user_dir_prefix.'User_catalog/open_lightbox_ajax';

$route[$user_url_prefix. 'catalog/special.html']			= $user_dir_prefix.'User_catalog/get_special_products';

$route[$user_url_prefix. 'catalog/ajax/search.html']		= $user_dir_prefix.'User_catalog/do_search_ajax';

$route[$user_url_prefix. 'catalog/(:any).html']				= 'user/User_catalog/product_detail/$1';



// route for deals

$route[$user_url_prefix. 'deals.html']					= $user_dir_prefix.'User_catalog/deals';



$route['brands.html']					= 'User_home/brands';

$route[$user_url_prefix. 'map']					= 'User_home/map';



$route[$user_url_prefix. 'checkout/cart.html']					= $user_dir_prefix.'cart/User_cart/index';

$route[$user_url_prefix. 'checkout/load-cart.html']					= $user_dir_prefix.'cart/User_cart/load_cart';

$route[$user_url_prefix. 'checkout/top-search.html']					= $user_dir_prefix.'cart/User_cart/top_srch';

$route[$user_url_prefix. 'checkout/add-to-cart.html']			= $user_dir_prefix.'cart/User_cart/add_to_cart';

$route[$user_url_prefix. 'checkout/update-cart.html']			= $user_dir_prefix.'cart/User_cart/update_cart';

$route[$user_url_prefix. 'checkout/remove-cart.html']			= $user_dir_prefix.'cart/User_cart/remove_cart';

$route[$user_url_prefix. 'checkout/get_variant_details.html']	= $user_dir_prefix.'cart/User_cart/get_variant_details';

// die($user_url_prefix. 'checkout/get_variant_details.html');



$route[$user_url_prefix. 'checkout/apply-coupon.html']			= $user_dir_prefix.'cart/User_cart/apply_coupon';

$route[$user_url_prefix. 'checkout/remove-coupon.html']			= $user_dir_prefix.'cart/User_cart/remove_coupon';



$route[$user_url_prefix. 'guest/checkout.html']	= $user_dir_prefix.'checkout/Onepage_checkout/checkout';

$route[$user_url_prefix. 'guest/ajax-checkout.html']	= $user_dir_prefix.'checkout/Onepage_checkout/ajax_checkout';

$route[$user_url_prefix. 'guest/order-success.html']	= $user_dir_prefix.'checkout/Onepage_checkout/success';

$route[$user_url_prefix. 'guest/place-order.html']	= $user_dir_prefix.'checkout/Onepage_checkout/place_order';

$route[$user_url_prefix. 'secure/guest/country-region.html']	= $user_dir_prefix.'checkout/Onepage_checkout/get_region_by_country';

$route[$user_url_prefix. 'checkout/billing.html']	= $user_dir_prefix.'checkout/User_checkout/billing';

$route[$user_url_prefix. 'checkout/billing/address.html'] 	= 'user/checkout/User_checkout_account/index';



$route[$user_url_prefix. 'checkout/shipping.html']		= $user_dir_prefix.'checkout/User_checkout/shipping';

$route[$user_url_prefix. 'checkout/shipping/address.html']	= $user_dir_prefix.'checkout/User_checkout_account/shipping_address';


$route[$user_url_prefix. 'checkout/shipping-method.html']	= $user_dir_prefix.'checkout/User_checkout/shipping_method';
// die($user_url_prefix. 'checkout/shipping-method.html');





$route[$user_url_prefix. 'confirm.html']					= $user_dir_prefix.'checkout/User_checkout/confirm';

$route[$user_url_prefix. 'checkout/confirm-order.html']		= $user_dir_prefix.'checkout/User_checkout/place_order';



$route[$user_url_prefix. 'checkout/paypayl.html']			= $user_dir_prefix.'checkout/User_checkout/paypayl_payment';



// $route[$user_url_prefix. 'checkout/process-payment.html']	= 'user/checkout/User_checkout/capture_payment_by_return_url';

// $route[$user_url_prefix. 'checkout/callback-payment.html']	= 'user/checkout/User_checkout/capture_payment_by_callback_url';

// $route[$user_url_prefix. 'checkout/order-success.html']		= $user_dir_prefix.'checkout/User_checkout/success';

$route[$user_url_prefix. 'checkout/process-payment.html']	= $user_dir_prefix.'/checkout/User_checkout_callback/capture_payment_by_return_url';

$route[$user_url_prefix. 'checkout/process-jazzcash.html']	= $user_dir_prefix.'/checkout/User_checkout_callback/jazzcash_capture_payment_by_return_url';



$route[$user_url_prefix. 'checkout/callback-payment.html']	= $user_dir_prefix.'/checkout/User_checkout_callback/capture_payment_by_callback_url';

$route[$user_url_prefix. 'checkout/order-success.html']		= $user_dir_prefix.'checkout/User_checkout_callback/success';





// $route[$user_url_prefix. 'checkout.html']	   = $user_dir_prefix.'checkout/User_checkout/onepage_checkout';

// $route[$user_url_prefix. 'checkout.html']	   = $user_dir_prefix.'checkout/User_checkout/billing';



$route[$user_url_prefix. 'checkout/payment-address.html']	= $user_dir_prefix.'checkout/User_checkout/payment_address';

$route[$user_url_prefix. 'checkout/payment-method.html']	= $user_dir_prefix.'checkout/User_checkout/payment_method';







$route[$user_url_prefix. 'checkout/confirm.html']			= $user_dir_prefix.'checkout/User_checkout/confirm';



$route[$user_url_prefix. 'contact-us.html']					= $user_dir_prefix.'User_contact/index';

$route[$user_url_prefix. 'store-location.html']				= $user_dir_prefix.'User_contact/store_location';

$route[$user_url_prefix. 'categories.html']					= $user_dir_prefix.'User_catalog/index';

$route[$user_url_prefix. 'newsletter.html']				    = $user_dir_prefix.'User_contact/add_newsletter';

// $route[$user_url_prefix. 'page.html']					    = 'User_page/index';

$route[$user_url_prefix. 'pages/(:any).html']				= $user_dir_prefix.'/User_page/index';







$route['error.html']				= 'User_error_handler/page_error';

$route['404.html']					= 'User_error_handler/page_404';

