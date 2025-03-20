(function ($) {
	"use strict";


	$('input[name=\'billing_address\']').on('change', function () {
		if (this.value == 'new') {
			$('#payment-existing').hide();
			$('#payment-new').show();
		} else {
			$('#payment-existing').show();
			$('#payment-new').hide();
		}
	});


	$('input[name=\'shipping_address\']').on('change', function () {
		if (this.value == 'new') {
			$('#shipping-existing').hide();
			$('#shipping-new').show();
		} else {
			$('#shipping-existing').show();
			$('#shipping-new').hide();
		}
	});



	$('input[name=\'checkout_option\']').on('change', function () {

		$('#is_guest').val(this.value);
		if (this.value == '1') {
			$('#password-section').hide();

			$('#collapse-payment-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="javascript:void(0);"  aria-expanded="true"><span class="number">2</span>Billing Details </a>');
		}
		else{
			$('#collapse-payment-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="javascript:void(0);"  aria-expanded="true"><span class="number">2</span>Account & Billing Details</a>');
			$('#password-section').show();
		}

	});



	$(document).delegate('#chk_option', 'click', function() {

		if ($('input[name=\'checkout_option\']').val() == '1') {
			$('#collapse-payment-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-payment-address" class="active" aria-expanded="true"> <span class="number">2</span>Billing Details <i class="fa fa-caret-down"></i></a>');
		} else {
			$('#collapse-payment-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-payment-address" class="active" aria-expanded="true"> <span class="number">2</span>Account & Billing Details <i class="fa fa-caret-down"></i></a>');
		}


		$('a[href=\'#collapse-payment-address\']').click();
		$('#collapse-payment-address').collapse('show');
	});


// Payment Address
	$(document).on('click', '#button-payment-address',function(event) {

		$.ajax({
			url: 'checkout/payment-address.html',
			type: 'post',
			data: $('#collapse-payment-address input[type=\'text\'], #collapse-payment-address input[type=\'date\'], #collapse-payment-address input[type=\'datetime-local\'], #collapse-payment-address input[type=\'time\'], #collapse-payment-address input[type=\'password\'], #collapse-payment-address input[type=\'checkbox\']:checked, #collapse-payment-address input[type=\'radio\']:checked, #collapse-payment-address input[type=\'hidden\'], #collapse-payment-address textarea, #collapse-payment-address select'),
			dataType: 'json',
			beforeSend: function() {
				//$('#button-cart').button('loading');
			},
			complete: function() {
				//	$('#button-cart').button('reset');
			},
			success: function(json) {
				if (json['result'] == true) {

					if (json['ajax_login'] == true) {
						//ajax login
						$.ajax({
							url: 'secure/ajax_login.html',
							type: 'post',
							data: $('#collapse-payment-address input[type=\'text\'], #collapse-payment-address input[type=\'password\']'),
							dataType: 'json',
							beforeSend: function () {
								//$('#button-cart').button('loading');
							},
							complete: function () {
								//	$('#button-cart').button('reset');
							},
							success: function (json) {
								if (json['result'] == true) {
									location.reload(true);
								} else if (json['result'] == 'error') {

									$('#ajax-login .content').prepend('<div class="alert alert-error alert-dismissible">' + json['message'] + '</div>');
								}

							},
							error: function (xhr, ajaxOptions, thrownError) {
								//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
							}
						});

					}else{
						if (json['reload'] == true) {
							location.reload(true);
						}


						$('a[href=\'#collapse-shipping-address\']').click();
						$('#collapse-shipping-address').collapse('show');

						$('#collapse-payment-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-payment-address" class="" aria-expanded="true"> <span class="number">2</span>Billing Details <i class="fa fa-caret-down"></i></a>');
						$('#collapse-shipping-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-shipping-address" class="active" aria-expanded="true"> <span class="number">3</span>Shipping Details <i class="fa fa-caret-down"></i></a>');

						$('#shipping-method').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="javascript:void(0);" class="" aria-expanded="true"> <span class="number">4</span>Shipping Method </i></a>');
						$('#payment-method').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="javascript:void(0);" class="" aria-expanded="true"> <span class="number">5</span>Payment Method </i></a>');
						$('#order-review').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="javascript:void(0);" class="" aria-expanded="true"> <span class="number">6</span>Order Review </i></a>');



					}


					//$('#content').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					//$('a[href=\'#collapse-shipping-address\']').trigger('click');
				}
				else if(json['result'] == 'error'){
					$('#collapse-payment-address .panel-body .message').empty();
					$('#collapse-payment-address .panel-body .message').prepend('<div class="alert alert-danger alert-dismissible">' + json['message'] + '</div>');
				}

			},
			error: function(xhr, ajaxOptions, thrownError) {
				//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});


	$(document).on('click', '#button-shipping-address',function(event) {

		$.ajax({
			url: 'checkout/shipping-address.html',
			type: 'post',
			data: $('#collapse-shipping-address input[type=\'text\'], #collapse-shipping-address input[type=\'date\'], #collapse-shipping-address input[type=\'datetime-local\'], #collapse-shipping-address input[type=\'time\'], #collapse-shipping-address input[type=\'password\'], #collapse-shipping-address input[type=\'checkbox\']:checked, #collapse-shipping-address input[type=\'radio\']:checked, #collapse-shipping-address input[type=\'hidden\'], #collapse-shipping-address textarea, #collapse-shipping-address select'),
			dataType: 'json',
			beforeSend: function() {
				//$('#button-cart').button('loading');
			},
			complete: function() {
				//	$('#button-cart').button('reset');
			},
			success: function(json) {
				if (json['result'] == true) {

					//$('a[href=\'#collapse-shipping-address\']').trigger('click');
					$('a[href=\'#shipping-method\']').click();
					$('#shipping-method').collapse('show');

					$('#collapse-payment-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-payment-address" class="" aria-expanded="true"> <span class="number">2</span>Billing Details <i class="fa fa-caret-down"></i></a>');
					$('#collapse-shipping-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-shipping-address" class="" aria-expanded="true"> <span class="number">3</span>Shipping Details <i class="fa fa-caret-down"></i></a>');
					$('#shipping-method').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#shipping-method" class="active" aria-expanded="true"> <span class="number">4</span>Shipping Method <i class="fa fa-caret-down"></i></a>');

					$('#payment-method').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="javascript:void(0);" class="" aria-expanded="true"> <span class="number">5</span>Payment Method </i></a>');
					$('#order-review').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="javascript:void(0);" class="" aria-expanded="true"> <span class="number">6</span>Order Review</i></a>');

				}
				else if(json['result'] == 'error'){
					$('#collapse-payment-address .panel-body').prepend('<div class="alert alert-danger alert-dismissible">' + json['message'] + '</div>');
				}

			},
			error: function(xhr, ajaxOptions, thrownError) {
				//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});

    $(document).on('click', '#button-shipping-method',function(event) {
        $.ajax({
            url: 'checkout/shipping-method.html',
            type: 'post',
            data: $('#shipping-method input[type=\'text\'], #shipping-method input[type=\'date\'], #shipping-method input[type=\'datetime-local\'], #shipping-method input[type=\'time\'], #shipping-method input[type=\'password\'], #shipping-method input[type=\'checkbox\']:checked, #shipping-method input[type=\'radio\']:checked, #shipping-method input[type=\'hidden\'], #shipping-method textarea, #shipping-method select'),
            dataType: 'json',
            beforeSend: function() {
                //$('#button-cart').button('loading');
            },
            complete: function() {
                //	$('#button-cart').button('reset');
            },
            success: function(json) {
                if (json['result'] == true) {
                    //$('#content').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');

                    //$('a[href=\'#collapse-shipping-address\']').trigger('click');
                    $('a[href=\'#payment-method\']').click();
                    $('#payment-method').collapse('show');
					$('#collapse-payment-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-payment-address" class="" aria-expanded="true"> <span class="number">2</span>Billing Details <i class="fa fa-caret-down"></i></a>');
					$('#collapse-shipping-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-shipping-address" class="" aria-expanded="true"> <span class="number">3</span>Shipping Details <i class="fa fa-caret-down"></i></a>');
					$('#shipping-method').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#shipping-method" class="" aria-expanded="true"> <span class="number">4</span>Shipping Method <i class="fa fa-caret-down"></i></a>');
					$('#payment-method').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#payment-method" class="active" aria-expanded="true"> <span class="number">5</span>Payment Method <i class="fa fa-caret-down"></i></a>');

					$('#order-review').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="javascript:void(0);" class="" aria-expanded="true"> <span class="number">6</span>Order Review</i></a>');

				}
                else if(json['result'] == 'error'){
                    $('#collapse-payment-address .panel-body').prepend('<div class="alert alert-danger alert-dismissible">' + json['message'] + '</div>');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });

	$(document).on('click', '#button-payment-method',function(event) {

		var method_selected = $("input:radio.cus_payment_method:checked").val();
		if (method_selected == "stripe") {
			getStripeToken();
		}else {
			$.ajax({
				url: 'checkout/payment-method.html',
				type: 'post',
				data: $('#payment-method input[type=\'text\'], #payment-method input[type=\'date\'], #payment-method input[type=\'datetime-local\'], #payment-method input[type=\'time\'], #payment-method input[type=\'password\'], #payment-method input[type=\'checkbox\']:checked, #payment-method input[type=\'radio\']:checked, #payment-method input[type=\'hidden\'], #payment-method textarea, #payment-method select'),
				dataType: 'json',
				beforeSend: function () {
					//$('#button-cart').button('loading');
				},
				complete: function () {
					//	$('#button-cart').button('reset');
				},
				success: function (json) {
					if (json['result'] == true) {
						//$('#content').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						//$('a[href=\'#collapse-shipping-address\']').trigger('click');
						$('a[href=\'#order-review\']').click();
						$('#order-review').collapse('show');

						$('#confirm-table').html(json['data']);

						$('#collapse-payment-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-payment-address" class="" aria-expanded="true"> <span class="number">2</span>Billing Details <i class="fa fa-caret-down"></i></a>');
						$('#collapse-shipping-address').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#collapse-shipping-address" class="" aria-expanded="true"> <span class="number">3</span>Shipping Details <i class="fa fa-caret-down"></i></a>');
						$('#shipping-method').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#shipping-method" class="" aria-expanded="true"> <span class="number">4</span>Shipping Method <i class="fa fa-caret-down"></i></a>');
						$('#payment-method').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#payment-method" class="" aria-expanded="true"> <span class="number">5</span>Payment Method <i class="fa fa-caret-down"></i></a>');
						$('#order-review').parent().find('.panel_heading .check-title').html('<a data-bs-toggle="collapse" href="#order-review" class="active" aria-expanded="true"> <span class="number">6</span>Order Review <i class="fa fa-caret-down"></i></a>');

					} else if (json['result'] == 'error') {
						$('#payment-method .panel-body').prepend('<div class="alert alert-danger alert-dismissible">' + json['message'] + '</div>');
					}

				},
				error: function (xhr, ajaxOptions, thrownError) {
					//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
				}
			});
		}
	});


    $(document).on('click', '#ajax_login_button',function(event) {

        $.ajax({
            url: 'secure/ajax_login.html',
            type: 'post',
            data: $('#ajax_login input[type=\'text\'], #ajax_login input[type=\'password\']'),
            dataType: 'json',
            beforeSend: function() {
                //$('#button-cart').button('loading');
            },
            complete: function() {
                //	$('#button-cart').button('reset');
            },
            success: function(json) {
                if (json['result'] == true) {
                    location.reload(true);
                }
                else if(json['error'] == true){
					$('#ajax_login .content').empty();
                    $('#ajax_login .content').prepend('<div class="alert alert-danger alert-dismissible">' + json['message'] + '</div>');
                }

            },
            error: function(xhr, ajaxOptions, thrownError) {
                //alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
    });


	$(document).on('click', '#confirm-order',function(event) {

		$.ajax({
			url: 'checkout/confirm-order.html',
			type: 'post',
			data: $('#payment-method input[type=\'text\'], #payment-method input[type=\'checkbox\']:checked'),
			dataType: 'json',
			beforeSend: function() {
				//$('#button-cart').button('loading');
			},
			complete: function() {
				//	$('#button-cart').button('reset');
			},
			success: function(json) {
				if (json['result'] == true) {

				}
				else if(json['result'] == 'error'){
					$('#order-review .panel-body .message').empty();
					$('#order-review .panel-body .message').prepend('<div class="alert alert-danger alert-dismissible">' + json['message'] + '</div>');
				}

			},
			error: function(xhr, ajaxOptions, thrownError) {
				//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});




	$('#billingcountry').change(function(){

		var country_id = $('#billingcountry option:selected').val();
		$.ajax({
			url: 'checkout/country-region.html',
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
					$('#billingregions').empty();
					$.each(states,function(key,val){
						var opt = $('<option />');
						opt.val(key);
						opt.text(val);
						$('#billingregions').append(opt);
					});

				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});

	});


	$('#shippingcountry').change(function(){

		var country_id = $('#shippingcountry option:selected').val();
		$.ajax({
			url: 'checkout/country-region.html',
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
					$('#shippingregions').empty();
					$.each(states,function(key,val){
						var opt = $('<option />');
						opt.val(key);
						opt.text(val);
						$('#shippingregions').append(opt);
					});

				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});

	});



})(jQuery);