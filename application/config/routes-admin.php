<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**************************************/
/**************************************/
/*********		ADMIN		***********/
/**************************************/
/**************************************/

$admin_url_prefix = 'admin/';
$admin_dir_prefix = 'admin/';

$route['admin']		= $admin_dir_prefix . 'Admin_dashboard';
$route['admin/']	= $admin_dir_prefix . 'Admin_dashboard';

$route[$admin_url_prefix . 'error.html']				= $admin_dir_prefix . 'Admin_error_handler/page_error';
$route[$admin_url_prefix . '404.html']					= $admin_dir_prefix . 'Admin_error_handler/page_404';
$route[$admin_url_prefix . 'access_error.html']			= $admin_dir_prefix . 'Admin_error';


$route[$admin_url_prefix . 'login.html']				= $admin_dir_prefix . 'Admin_login/index';
$route[$admin_url_prefix . 'logout.html']				= $admin_dir_prefix . 'Admin_login/logout';
$route[$admin_url_prefix . 'signout.html']				= $admin_dir_prefix . 'Admin_dashboard/logout';
$route[$admin_url_prefix . 'login']						= $admin_dir_prefix . 'Admin_login/login';
$route[$admin_url_prefix . 'logout']					= $admin_dir_prefix . 'Admin_dashboard/logout';
$route[$admin_url_prefix . 'signout']					= $admin_dir_prefix . 'Admin_dashboard/logout';


$route[$admin_url_prefix . 'media/(.+)']				= $admin_dir_prefix . 'media/$1';
$route[$admin_url_prefix . 'dashboard.html']			= $admin_dir_prefix . 'Admin_dashboard/index';
$route[$admin_url_prefix . 'dashboard/chart.html']			= $admin_dir_prefix . 'Admin_dashboard/chart';

//catalog category section
$route[$admin_url_prefix . 'catalog/categories.html']						= $admin_dir_prefix . 'catalog/Admin_categories/index';
$route[$admin_url_prefix . 'catalog/category-add.html']						= $admin_dir_prefix . 'catalog/Admin_categories/add';
$route[$admin_url_prefix . 'catalog/category-edit.html']					= $admin_dir_prefix . 'catalog/Admin_categories/edit';
$route[$admin_url_prefix . 'catalog/category-delete.html']					= $admin_dir_prefix . 'catalog/Admin_categories/delete';
$route[$admin_url_prefix . 'catalog/category/image-upload-form.html']		= $admin_dir_prefix . 'catalog/Admin_categories/image_upload_form';
$route[$admin_url_prefix . 'catalog/category/simple-image-uploader.html']	= $admin_dir_prefix . 'catalog/Admin_categories/simple_image_uploader';
$route[$admin_url_prefix . 'catalog/category/category-autocomplete.html'] = $admin_dir_prefix . 'catalog/Admin_categories/category_autocomplete';

$route[$admin_url_prefix . 'catalog/manufacturers.html']						= $admin_dir_prefix . 'catalog/Admin_manufacturers/index';
$route[$admin_url_prefix . 'catalog/manufacturer-add.html']					    = $admin_dir_prefix . 'catalog/Admin_manufacturers/add';
$route[$admin_url_prefix . 'catalog/manufacturer-edit.html']					= $admin_dir_prefix . 'catalog/Admin_manufacturers/edit';
$route[$admin_url_prefix . 'catalog/manufacturer-delete.html']					= $admin_dir_prefix . 'catalog/Admin_manufacturers/delete';
$route[$admin_url_prefix . 'catalog/manufacturer/image-upload-form.html']		= $admin_dir_prefix . 'catalog/Admin_manufacturers/image_upload_form';
$route[$admin_url_prefix . 'catalog/manufacturer/simple-image-uploader.html']	= $admin_dir_prefix . 'catalog/Admin_manufacturers/simple_image_uploader';

$route[$admin_url_prefix . 'catalog/brands.html']						= $admin_dir_prefix . 'catalog/Admin_brands/index';

$route[$admin_url_prefix . 'catalog/brand-add.html']					= $admin_dir_prefix . 'catalog/Admin_brands/add';
$route[$admin_url_prefix . 'catalog/brand-edit.html']					= $admin_dir_prefix . 'catalog/Admin_brands/edit';
$route[$admin_url_prefix . 'catalog/brand-delete.html']					= $admin_dir_prefix . 'catalog/Admin_brands/delete';
$route[$admin_url_prefix . 'catalog/color.html']						= $admin_dir_prefix . 'catalog/Admin_color/index';

$route[$admin_url_prefix . 'catalog/color-add.html']					= $admin_dir_prefix . 'catalog/Admin_color/add';
$route[$admin_url_prefix . 'catalog/color-edit.html']					= $admin_dir_prefix . 'catalog/Admin_color/edit';
$route[$admin_url_prefix . 'catalog/color-delete.html']					= $admin_dir_prefix . 'catalog/Admin_color/delete';

$route[$admin_url_prefix . 'catalog/brand/image-upload-form.html']		= $admin_dir_prefix . 'catalog/Admin_brands/image_upload_form';
$route[$admin_url_prefix . 'catalog/brand/simple-image-uploader.html']	= $admin_dir_prefix . 'catalog/Admin_brands/simple_image_uploader';


// file manger routes
$route[$admin_url_prefix . 'tool/filemanager.html']				= $admin_dir_prefix . 'module/Admin_file_manager/index';
$route[$admin_url_prefix . 'tool/file_manager.html']			= $admin_dir_prefix . 'module/Admin_file_manager/index';
$route[$admin_url_prefix . 'tool/file_manager/folder.html']		= $admin_dir_prefix . 'module/Admin_file_manager/folder';
$route[$admin_url_prefix . 'tool/file_manager/delete.html']		= $admin_dir_prefix . 'module/Admin_file_manager/delete';
$route[$admin_url_prefix . 'tool/file_manager/delete.html']		= $admin_dir_prefix . 'module/Admin_file_manager/delete';
$route[$admin_url_prefix . 'tool/file_manager/upload.html']		= $admin_dir_prefix . 'module/Admin_file_manager/upload';

$route[$admin_url_prefix . 'catalog/products.html']				= $admin_dir_prefix . 'catalog/Admin_products/index';
$route[$admin_url_prefix . 'catalog/product-add.html']			= $admin_dir_prefix . 'catalog/Admin_products/add';
$route[$admin_url_prefix . 'catalog/product-edit.html']			= $admin_dir_prefix . 'catalog/Admin_products/edit';
$route[$admin_url_prefix . 'catalog/special-products.html']		= $admin_dir_prefix . 'catalog/Admin_products/get_special_products';
$route[$admin_url_prefix . 'catalog/get-special.html']		    = $admin_dir_prefix . 'catalog/Admin_products/get_special';
$route[$admin_url_prefix . 'catalog/mark-as-disable.html']		= $admin_dir_prefix . 'catalog/Admin_products/mark_as_disable';
$route[$admin_url_prefix . 'catalog/mark-as-special.html']		= $admin_dir_prefix . 'catalog/Admin_products/mark_as_special';
$route[$admin_url_prefix . 'catalog/products/related-products-autocomplete.html'] = $admin_dir_prefix . 'catalog/Admin_products/products_autocomplete';
$route[$admin_url_prefix . 'catalog/products/product-category-autocomplete.html'] = $admin_dir_prefix . 'catalog/Admin_products/category_autocomplete';
$route[$admin_url_prefix . 'catalog/save-options.html']		    = $admin_dir_prefix . 'catalog/Admin_products/save_options';
$route[$admin_url_prefix . 'catalog/product/image-uploader.html']	= $admin_dir_prefix . 'catalog/Admin_products/image_uploader';


// EXTENSIONS ROUTES SETTINGS
$route[$admin_url_prefix . 'extensions.html']			    = $admin_dir_prefix . 'extensions/Admin_extensions/index';
$route[$admin_url_prefix . 'extensions/edit.html']          = $admin_dir_prefix . 'extensions/Admin_extensions/edit';

$route[$admin_url_prefix . 'extensions/payment.html']		= $admin_dir_prefix . 'extensions/Admin_extensions/payment';
$route[$admin_url_prefix . 'extensions/shipping.html']		= $admin_dir_prefix . 'extensions/Admin_extensions/shipping';
$route[$admin_url_prefix . 'extensions/total.html']			= $admin_dir_prefix . 'extensions/Admin_total/index';
$route[$admin_url_prefix . 'extensions/total/add.html']		= $admin_dir_prefix . 'extensions/Admin_total/add';
$route[$admin_url_prefix . 'extensions/total/edit.html']	= $admin_dir_prefix . 'extensions/Admin_total/edit';
$route[$admin_url_prefix . 'extensions/total/delete.html']	= $admin_dir_prefix . 'extensions/Admin_total/delete';

// coupon_code
$route[$admin_url_prefix . 'extensions/coupon_code.html']			= $admin_dir_prefix . 'extensions/Admin_coupon_code/index';
$route[$admin_url_prefix . 'extensions/coupon_code/add.html']		= $admin_dir_prefix . 'extensions/Admin_coupon_code/form';
$route[$admin_url_prefix . 'extensions/coupon_code/edit.html']		= $admin_dir_prefix . 'extensions/Admin_coupon_code/form';
$route[$admin_url_prefix . 'extensions/coupon_code/delete.html']	= $admin_dir_prefix . 'extensions/Admin_coupon_code/delete';


//orders
$route[$admin_url_prefix . 'sales/orders.html']						= $admin_dir_prefix . 'sales/Admin_orders/index';
$route[$admin_url_prefix . 'sales/orders/order-detail.html']			= $admin_dir_prefix . 'sales/Admin_orders/order_detail';
$route[$admin_url_prefix . 'sales/orders/add-order-history.html']		= $admin_dir_prefix . 'sales/Admin_orders/add_order_history';
$route[$admin_url_prefix . 'sales/returns.html']				= $admin_dir_prefix . 'sales/Admin_orders/order_return';

//customers
$route[$admin_url_prefix . 'sales/customers.html']				= $admin_dir_prefix . 'sales/Admin_customer/index';
$route[$admin_url_prefix . 'sales/customers/address_list.html'] 	= $admin_dir_prefix . 'sales/Admin_customer/customer_addresses';
$route[$admin_url_prefix . 'sales/customers/address/add.html'] 	= $admin_dir_prefix . 'sales/Admin_customer/address_add';
$route[$admin_url_prefix . 'sales/customers/address/edit.html'] 	= $admin_dir_prefix . 'sales/Admin_customer/address_edit';
$route[$admin_url_prefix . 'sales/customers/add.html']			= $admin_dir_prefix . 'sales/Admin_customer/add';
$route[$admin_url_prefix . 'sales/customers/edit.html']			= $admin_dir_prefix . 'sales/Admin_customer/edit';
$route[$admin_url_prefix . 'sales/customers/delete.html']			= $admin_dir_prefix . 'sales/Admin_customer/delete';
$route[$admin_url_prefix . 'customers/country-region.html']	= $admin_dir_prefix . 'sales/Admin_customer/get_region_by_country';


// ADMIN USERS ROUTES SETTINGS
$route[$admin_url_prefix . 'users/user.html']			        = $admin_dir_prefix . 'users/Admin_user/index';
$route[$admin_url_prefix . 'users/add.html']		        = $admin_dir_prefix . 'users/Admin_user/add';
$route[$admin_url_prefix . 'users/edit.html']		        = $admin_dir_prefix . 'users/Admin_user/edit';
$route[$admin_url_prefix . 'users/delete.html']		        = $admin_dir_prefix . 'users/Admin_user/delete';

$route[$admin_url_prefix . 'users/roles.html']	                = $admin_dir_prefix . 'users/Admin_roles/index';
$route[$admin_url_prefix . 'users/roles/add.html']	            = $admin_dir_prefix . 'users/Admin_roles/add';
$route[$admin_url_prefix . 'users/roles/edit.html']	            = $admin_dir_prefix . 'users/Admin_roles/edit';
$route[$admin_url_prefix . 'users/roles/delete.html']	            = $admin_dir_prefix . 'users/Admin_roles/delete';
$route[$admin_url_prefix . 'users/roles/permission/edit.html']	= $admin_dir_prefix . 'users/Admin_roles/admin_role_permission_edit';


//store managment
//boxes
$route[$admin_url_prefix . 'module/boxes.html']						= $admin_dir_prefix . 'module/Admin_boxes/index';
$route[$admin_url_prefix . 'module/box-sort.html']					= $admin_dir_prefix . 'module/Admin_boxes/sort_list';
$route[$admin_url_prefix . 'module/box/ajax/sort.html']				= $admin_dir_prefix . 'module/Admin_boxes/sort_ajax';
$route[$admin_url_prefix . 'module/box-add.html']					= $admin_dir_prefix . 'module/Admin_boxes/add';
$route[$admin_url_prefix . 'module/box-edit.html']					= $admin_dir_prefix . 'module/Admin_boxes/edit';
$route[$admin_url_prefix . 'module/boxes/delete.html']				= $admin_dir_prefix . 'module/Admin_boxes/delete';
$route[$admin_url_prefix . 'module/box/image-upload-form.html']		= $admin_dir_prefix . 'module/Admin_boxes/image_upload_form';
$route[$admin_url_prefix . 'module/box/simple-image-uploader.html']	= $admin_dir_prefix . 'module/Admin_boxes/simple_image_uploader';
//sliders
$route[$admin_url_prefix . 'module/sliders.html']						= $admin_dir_prefix . 'module/Admin_sliders/index';
$route[$admin_url_prefix . 'module/slider-sort.html']					= $admin_dir_prefix . 'module/Admin_sliders/sort_list';
$route[$admin_url_prefix . 'module/slider/ajax/sort.html']				= $admin_dir_prefix . 'module/Admin_sliders/sort_ajax';
$route[$admin_url_prefix . 'module/slider-add.html']					= $admin_dir_prefix . 'module/Admin_sliders/add';
$route[$admin_url_prefix . 'module/slider-edit.html']					= $admin_dir_prefix . 'module/Admin_sliders/edit';
$route[$admin_url_prefix . 'module/sliders/delete.html']				= $admin_dir_prefix . 'module/Admin_sliders/delete';
$route[$admin_url_prefix . 'module/slider/image-upload-form.html']		= $admin_dir_prefix . 'module/Admin_sliders/image_upload_form';
$route[$admin_url_prefix . 'module/slider/simple-image-uploader.html']	= $admin_dir_prefix . 'module/Admin_sliders/simple_image_uploader';



$route[$admin_url_prefix . 'module/navigations.html']					= $admin_dir_prefix . 'module/Admin_navigations/index';
$route[$admin_url_prefix . 'module/navigation-sort.html']				= $admin_dir_prefix . 'module/Admin_navigations/sort_list';
$route[$admin_url_prefix . 'module/navigation/ajax/sort.html']			= $admin_dir_prefix . 'module/Admin_navigations/sort_ajax';
$route[$admin_url_prefix . 'module/navigation/organize.html']			= $admin_dir_prefix . 'module/Admin_navigations/organize_navigations';
$route[$admin_url_prefix . 'module/navigation/add.html']				= $admin_dir_prefix . 'module/Admin_navigations/add';
$route[$admin_url_prefix . 'module/navigation/edit.html']				= $admin_dir_prefix . 'module/Admin_navigations/edit';
$route[$admin_url_prefix . 'module/navigation/delete.html']				= $admin_dir_prefix . 'module/Admin_navigations/delete';


//pages
$route[$admin_url_prefix . 'module/pages.html']				= $admin_dir_prefix . 'module/Admin_pages/index';
$route[$admin_url_prefix . 'module/pages/bulk_save.html']	= $admin_dir_prefix . 'module/Admin_pages/bulk_save';
$route[$admin_url_prefix . 'module/pages/add.html']			= $admin_dir_prefix . 'module/Admin_pages/form';
$route[$admin_url_prefix . 'module/pages/edit.html']		= $admin_dir_prefix . 'module/Admin_pages/form';
$route[$admin_url_prefix . 'module/pages/delete.html']		= $admin_dir_prefix . 'module/Admin_pages/delete';

// Contact Us ROUTES SETTINGS
$route[$admin_url_prefix . 'support/contact.html']			= $admin_dir_prefix . 'support/Admin_contact/index';
$route[$admin_url_prefix . 'support/contact/detail.html']	= $admin_dir_prefix . 'support/Admin_contact/get_detail';

$route[$admin_url_prefix . 'support/newsletters.html']				= $admin_dir_prefix . 'support/Admin_newsletters/index';
$route[$admin_url_prefix . 'support/newsletters/export-csv.html']	= $admin_dir_prefix . 'support/Admin_newsletters/export_csv';


//settings
$route[$admin_url_prefix . 'system/setting.html']				= $admin_dir_prefix . 'system/Admin_settings/index';
$route[$admin_url_prefix . 'system/state-autocomplete.html']	= $admin_dir_prefix . 'system/Admin_settings/state_autocomplete';
$route[$admin_url_prefix . 'system/test-email.html']				= $admin_dir_prefix . 'system/Admin_settings/test_email';



//taxes
$route[$admin_url_prefix . 'module/taxes.html']						= $admin_dir_prefix . 'localisation/Admin_taxes/index';
$route[$admin_url_prefix . 'module/tax-add.html']					= $admin_dir_prefix . 'localisation/Admin_taxes/add';
$route[$admin_url_prefix . 'module/tax-edit.html']					= $admin_dir_prefix . 'localisation/Admin_taxes/edit';
$route[$admin_url_prefix . 'module/taxes/delete.html']				= $admin_dir_prefix . 'localisation/Admin_taxes/delete';


//taxes
$route[$admin_url_prefix . 'localisation/geo_zones.html']			            = $admin_dir_prefix . 'localisation/Admin_geo_zones/index';
$route[$admin_url_prefix . 'localisation/geo_zone_add.html']					= $admin_dir_prefix . 'localisation/Admin_geo_zones/add';
$route[$admin_url_prefix . 'localisation/geo_zone_edit.html']					= $admin_dir_prefix . 'localisation/Admin_geo_zones/edit';
$route[$admin_url_prefix . 'localisation/geo_zones/delete.html']				= $admin_dir_prefix . 'localisation/Admin_geo_zones/geo_zone_delete';

//tax rates
$route[$admin_url_prefix . 'localisation/tax_rates.html']			            = $admin_dir_prefix . 'localisation/Admin_tax_rates/index';
$route[$admin_url_prefix . 'localisation/tax_rate_add.html']					= $admin_dir_prefix . 'localisation/Admin_tax_rates/add';
$route[$admin_url_prefix . 'localisation/tax_rate_edit.html']					= $admin_dir_prefix . 'localisation/Admin_tax_rates/edit';
$route[$admin_url_prefix . 'localisation/tax_rates/delete.html']				= $admin_dir_prefix . 'localisation/Admin_tax_rates/delete';




//taxe classes
$route[$admin_url_prefix . 'localisation/tax_classes.html']			            = $admin_dir_prefix . 'localisation/Admin_tax_classes/index';
$route[$admin_url_prefix . 'localisation/tax_class_add.html']					= $admin_dir_prefix . 'localisation/Admin_tax_classes/add';
$route[$admin_url_prefix . 'localisation/tax_class_edit.html']					= $admin_dir_prefix . 'localisation/Admin_tax_classes/edit';
$route[$admin_url_prefix . 'localisation/tax_classes/delete.html']				= $admin_dir_prefix . 'localisation/Admin_tax_classes/delete';



$route[$admin_url_prefix . 'localisation/country-region.html']	                = $admin_dir_prefix . 'localisation/Admin_geo_zones/get_region_by_country';
