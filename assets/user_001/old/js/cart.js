// Cart add remove functions
var cart = {
	'add': function(product_id, quantity ,current_quantity , elem) {

		var is_variation = '';
		var variation_attr =  $(elem).data('is_variation');
		if (typeof variation_attr !== typeof undefined && variation_attr !== false) {
			is_variation = '&is_variation='+$(elem).data('is_variation');
		}

		var redirect = '&redirect=1';

		$.ajax({
			url: 'checkout/add-to-cart.html',
			type: 'post',
			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1) + '&product_cur_qty=' + (typeof(current_quantity) != 'undefined' ? current_quantity : 0) + is_variation+redirect,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				$('.alert-dismissible, .text-danger').remove();
				if (json['redirect']) {
					location = json['redirect'];
					return false;
				}
				if (json['result'] == true) {
					$('#content').prepend('<div class="alert alert-success alert-dismissible">' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					setTimeout(function() {
						//$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
					}, 100);
					$('html, body').animate({
						scrollTop: 0
					}, 'slow');

					setTimeout(function () {
						if (json['redirect']) {
							location = json['redirect'];
							return false;
						}
					}, 2000);

					//$('#cart > ul').load('index.php?route=common/cart/info ul li');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},

	'modaladd': function(product_id,qty,current_quantity , elem) {


		var quantity = $("#"+qty+"-"+product_id).val();

		var is_variation = '';
		var variation_attr =  $(elem).data('is_variation');
		if (typeof variation_attr !== typeof undefined && variation_attr !== false) {
			is_variation = '&is_variation='+$(elem).data('is_variation');
		}

		var redirect = '&redirect=1';

		$.ajax({
			url: 'checkout/add-to-cart.html',
			type: 'post',
			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1) + '&product_cur_qty=' + (typeof(current_quantity) != 'undefined' ? current_quantity : 0) + is_variation+redirect,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				$('.alert-dismissible, .text-danger').remove();
				if (json['redirect']) {
					location = json['redirect'];
					return false;
				}
				if (json['result'] == true) {
					$('#content').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					setTimeout(function() {
						//$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
					}, 100);
					$('html, body').animate({
						scrollTop: 0
					}, 'slow');

					setTimeout(function () {
						if (json['redirect']) {
							location = json['redirect'];
							return false;
						}
					}, 2000);

					//$('#cart > ul').load('index.php?route=common/cart/info ul li');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},

	'update': function(key, quantity) {
		$.ajax({
			url: 'checkout/update-cart.html',
			type: 'post',
			data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('.alert, .text-danger').remove();
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				if (json['result'] == true) {
					$('#content').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					$('html, body').animate({
						scrollTop: 0
					}, 'slow');
				}else if(json['result'] == 'error'){
					$('#content').before('<div class="alert alert-danger alert-dismissible"><i class="fa fa-warning"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					$('html, body').animate({
						scrollTop: 0
					}, 'slow');
				}

				setTimeout(function() {
					location = 'checkout/cart.html';
				}, 1000);
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'remove': function(key) {
		$.ajax({
			url: 'checkout/remove-cart.html',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				$('.alert, .text-danger').remove();
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				setTimeout(function() {
					//$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
				}, 100);
				//if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
				//location = 'index.php?route=checkout/cart';
				location = 'checkout/cart.html';
				//} else {
				// $('#cart > ul').load('index.php?route=common/cart/info ul li');
				//}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});

	}
}