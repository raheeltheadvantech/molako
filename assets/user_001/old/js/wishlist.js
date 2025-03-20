var wishlist = {
	'base' : $('base').attr('href'),
	'user_url_prefix' : 'secure',
	'add': function(product_id, quantity) {
		$.ajax({
			url: this.base+ this.user_url_prefix + '/wishlist/add.html',
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: function(json) {
				console.log('add to wishcart')
				$('.alert-dismissible, .text-danger').remove();
				
				if (json['result'] == true) {
					$('#content').prepend('<div class="alert alert-success alert-dismissible">' + json['message'] + '  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					setTimeout(function() {
					}, 100);
					$('html, body').animate({
						scrollTop: 0
					}, 'slow');
				}

				if (json['error'] == true) {
					$('#content').prepend('<div class="alert alert-danger alert-dismissible"> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
					setTimeout(function() {
					}, 100);
					$('html, body').animate({
						scrollTop: 0
					}, 'slow');
				}
				// if (json['redirect']) {
				// 	location = json['redirect'];
				// 	return false;
				// }
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'remove': function(product_id) {
		$.ajax({
			url: this.base+ this.user_url_prefix +"/wishlist/remove.html",
			type: 'post',
			data: 'product_id=' + product_id,
			dataType: 'json',
			beforeSend: function() {
			},
			complete: function() {
			},
			success: function(json) {
				$('.alert-dismissible, .text-danger').remove();
				if (json['redirect']) {
					location = json['redirect'];
				}
				if (json['result'] == true) {
					$('#content').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					setTimeout(function() {
					}, 100);
					$('html, body').animate({
						scrollTop: 0
					}, 'slow');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}
