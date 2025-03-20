(function ($) {
 "use strict";
/*----------------------------
 jQuery MeanMenu
------------------------------ */
	$('.mobile-menu nav').meanmenu({
		meanScreenWidth: "991",
		meanMenuContainer: ".mobile-menu",
	});

/*----------------------------
 Category Menu
------------------------------ */
	$(".category-menu-title").on('click', function(){
		$(".categorie-list").toggle();
	});
	
/*--------------------------
	Category Accordion
---------------------------- */	
	 $('.rx-parent').on('click', function(){
		$('.rx-child').slideToggle(300);
		$(this).toggleClass('rx-change');
	});

/*----------------------------
 main slider
------------------------------ */
	$('#mainSlider').nivoSlider({
		directionNav: true,
		animSpeed: 500,
		slices: 18,
		pauseTime: 5000,
		pauseOnHover: false,
		controlNav: false,
		prevText: '<i class="fa fa-angle-left nivo-prev-icon"></i>',
		nextText: '<i class="fa fa-angle-right nivo-next-icon"></i>'
	});		

/*----------------------------
 DB Select Js
------------------------------ */
	$('#product-categori').ddslick({
		onSelected: function(selectedData){
			//callback function: do something with selectedData;
		}   
	});	
 
/*----------------------------
 owl active
------------------------------ */
  	/* Bestsell Carousel */
	$("#bestsell-carousel").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});
  
	/* Bestsell Carousel 2 */
	$("#bestsell-carousel-2").owlCarousel({
		autoPlay: false, 
		slideSpeed: 2000,
		dots: false,
		nav: true,
		addClassActive: true,
		items : 4,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});
  
	/* Most Viewed Carousel */
	$("#most-viewed-carousel").owlCarousel({
		autoPlay: false, 
		slideSpeed: 2000,
		dots: false,
		nav: true,
		addClassActive: true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	}); 
  
	/* Most Viewed Carousel 2 */
	$("#most-viewed-carousel-2").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 4,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:3,
			},
			1200:{
				items:4,
			}
		}
	});
  
	/* Random Carousel */
	$("#random-carousel").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});  
  
	/* Random Carousel 2 */
	$("#random-carousel-2").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 4,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:3,
			},
			1200:{
				items:4,
			}
		}
	});
  
	/* bestseller-carousel tech */
	$("#bestseller-carousel").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});


	/* mostviewed carousel tech*/
	$("#mostviewed-carousel").owlCarousel({
		autoPlay: false,
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});

	/* Laptop Carousel tech*/
	$("#newarrivals-carousel").owlCarousel({
		autoPlay: false,
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});



	/* Laptop Carousel 2 */
	$("#special-carousel").owlCarousel({
		autoPlay: false,
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});




	$("#related-products-carousel").owlCarousel({
		autoPlay: false,
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});




	/* Single Product */
	$("#single-product").owlCarousel({
		autoPlay: false,
		slideSpeed:2000,
		dots:false,
		nav:true,
		items : 1,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [980,1],
		itemsTablet: [768,1],
		itemsMobile : [479,1],
	});




	/* Laptop Carousel 2 */
	$("#laptop-carousel-2").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});
  
  /* Laptop Carousel 3 */
  $("#laptop-carousel-3").owlCarousel({
      autoPlay: false, 
	  slideSpeed:2000,
	  dots:false,
	  nav:true,
	  addClassActive:true,
      items : 4,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,4],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });
  
	/* Tablet Carousel */
	$("#tablet-carousel").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 4,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:3,
			},
			1200:{
				items:4,
			}
		}
	});
  
	/* Tablet Carousel 2 */
	$("#tablet-carousel-2").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 5,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:3,
			},
			992:{
				items:4,
			},
			1200:{
				items:5,
			}
		}
	});
  
  /* Tablet Carousel 3 */
  $("#tablet-carousel-3").owlCarousel({
      autoPlay: false,
	  slideSpeed:2000,
	  dots:false,
	  nav:true,
	  addClassActive:true,
      items : 4,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
      itemsDesktop : [1199,4],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });



	/* Timer Product Carousel */
	$("#timer-product-carousel").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:true,
		addClassActive:true,
		items : 1,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:1,
			},
			576:{
				items:2,
			},
			768:{
				items:2,
			},
			992:{
				items:1,
			}
		}
	});
  
	/* Client Carousel */
	$("#client-carousel").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:true,
		nav:false,
		addClassActive:true,
		items : 1,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	});
  
	/* Blog Post Carousel */
	$("#blog-post-carousel").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:true,
		nav:false,
		addClassActive:true,
		items : 1,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],	 
	});
  
	/* Logo Carousel */
	$("#logo-carousel").owlCarousel({
		autoPlay: false, 
		slideSpeed:2000,
		dots:false,
		nav:false,
		addClassActive:true,
		items : 4,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		responsive:{
			0:{
				items:2,
			},
			576:{
				items:3,
			},
			768:{
				items:4,
			},
			992:{
				items:4,
			},
			1200:{
				items:4,
			}
		}
	});
  
  /* Single Product */
  $("#single-product1").owlCarousel({
	  autoPlay: false, 
	  slideSpeed:2000,
	  dots:false,
	  nav:true,	  
	  items : 1,
	  navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	  itemsDesktop : [1199,1],
	  itemsDesktopSmall : [980,1],
	  itemsTablet: [768,1],
	  itemsMobile : [479,1],
  });

	$("#single-product2").owlCarousel({
		autoPlay: false,
		slideSpeed:2000,
		dots:false,
		nav:true,
		items : 1,
		navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
		itemsDesktop : [1199,1],
		itemsDesktopSmall : [980,1],
		itemsTablet: [768,1],
		itemsMobile : [479,1],
	});


	/* Releted Product */
  $("#related-products-carousel1").owlCarousel({
	  autoPlay: false, 
	  slideSpeed:2000,
	  dots:false,
	  nav:true,	  
	  items : 5,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	  itemsDesktop : [1199,4],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });
  
  /* Upsell Product */
  $("#upsell-products-carousel").owlCarousel({
	  autoPlay: false, 
	  slideSpeed:2000,
      dots:false,
	  nav:true,	  
	  items : 5,
	  /* transitionStyle : "fade", */    /* [This code for animation ] */
	  navText:["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
	  itemsDesktop : [1199,4],
	  itemsDesktopSmall : [980,3],
	  itemsTablet: [768,2],
	  itemsMobile : [479,1],
  });

/*----------------------------
 Countdown
------------------------------ */
	$('[data-countdown]').each(function() {
	  var $this = $(this), finalDate = $(this).data('countdown');
	  $this.countdown(finalDate, function(event) {
		$this.html(event.strftime('<span class="cdown days"><span class="time-count">%-D</span> <p>Days :</p></span> <span class="cdown hour"><span class="time-count">%-H</span> <p>Hour :</p></span> <span class="cdown minutes"><span class="time-count">%M</span> <p>Min :</p></span> <span class="cdown second"> <span><span class="time-count">%S</span> <p>Sec</p></span>'));
	  });
	});	

/*----------------------------
 price-slider active
------------------------------ */  
	  $( "#slider-range" ).slider({
	   range: true,
	   min: 99,
	   max: 700,
	   values: [ 99, 700 ],
	   slide: function( event, ui ) {
		$( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
	   }
	  });
	  $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
	   " - $" + $( "#slider-range" ).slider( "values", 1 ) );  
	   
/*----------------------------
  Simple Lence Active
------------------------------ */  
	$('#p-view .simpleLens-lens-image').simpleLens({
		loading_image: 'images/products/loading.gif'
	});
  
/*--------------------------
 scrollUp
---------------------------- */	
	$.scrollUp({
        scrollText: '<i class="fa fa-angle-up"></i>',
        easingType: 'linear',
        scrollSpeed: 900,
        animation: 'fade'
    }); 	


/*--------------------------
 collapse
---------------------------- */	
	$('.panel_heading a').on('click', function(){
		$('.panel_heading a').removeClass('active');
		$(this).addClass('active');
	})



	// $('#button-cart').click(function () {
	// 	var product_id 	= $('input[name="product-identify"]').val();
	// 	var quantity 	= $('input[name="qty"]').val();
	// 	//console.log(product_id);
	// 	//console.log(quantity);
	// 	cart.add(product_id,quantity , this);
	// });

	$(document).on('click', '.btn-update',function () {
		var product_id = $(this).data('product-id');
		var quantity = $('input[name="quantity['+ product_id +']"]').val();
		//console.log(product_id);
		//console.log(quantity);
		cart.update(product_id,quantity);
	});

	$(document).on('change', '.variant_dropdowns',function(event) {
		get_variation_detail();
	});

	function get_variation_detail(){

		$('#detail_add_to_cart').attr('disabled',true);
		$('#detail_add_to_cart').css('cursor','no-drop');

		var variations = '';
		$('.variant_dropdowns').each(function(){
			if(variations == '')
				variations = $(this).val();
			else
				variations += '-'+$(this).val();
		});

		var product_id = $('#product_id').val();
		$('#noVariant').hide();
		$.ajax({
			url: 'checkout/get_variant_details.html',
			type: 'post',
			data: {'product_id':product_id,'variations':variations},
			dataType: 'json',
			beforeSend: function() {
				//$('#button-cart').button('loading');
			},
			complete: function() {
				//	$('#button-cart').button('reset');
			},
			success: function(json) {
				if (json['success']) {
					$('#variant_id').val(json['variant_id']);
					$('#product_cur_qty').val(json['variant_qty']);
					$('.product-card__item-stock-number').text(json['variant_qty']+' ');
					var item_price = json['variant_price'];

					$('.product-card__item-info-price-with-discount').text(item_price);

					$('#detail_add_to_cart1').removeAttr('disabled');
					$('#detail_add_to_cart1').css('cursor','pointer');

				}else{
					// alert('no variant');
					$('#noVariant').show();
					$('#detail_add_to_cart1').attr('disabled',true);
					$('#detail_add_to_cart1').css('cursor','no-drop');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});

		// alert(variations);
	}


	$(document).ready(function () {

		var has_varient = $('#has_varients').val();
		if(has_varient == 1) {
			get_variation_detail();
			//setTimeout(function () {}, 1000);
		}

		setTimeout(function () {
			var product_qty = $('#product_cur_qty').val();
			if(product_qty == 0) {
				$('#noVariant').show();
				$('#detail_add_to_cart').attr('disabled',true);
				$('#detail_add_to_cart').css('cursor','no-drop');
			}
		}, 2000);
	});



	$(document).on('click', '.add-cart-button',function(event) {

		//var its_form = $(this).closest('form.product-form-data');
		//console.log(its_form);
		var serialized_data = $('#product-data').serialize()
		//var serialized_data = its_form.serializeToObject();

		$.ajax({
			url: 'checkout/add-to-cart.html',
			type: 'post',
			//	data: $($wrapper_form_data+' input[type=\'text\'],' + $wrapper_form_data +' input[type=\'hidden\']'),
			data: serialized_data,
			dataType: 'json',
			beforeSend: function() {
				//$('#button-cart').button('loading');
			},
			complete: function() {
				//	$('#button-cart').button('reset');
			},
			success: function(json) {
					if (json['result'] == true) {
						$('#content').prepend('<div class="alert alert-success alert-dismissible"><i class="fa fa-check-circle"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
						$('html, body').animate({
							scrollTop: 0
						}, 'slow');

					}
					else if(json['result'] == 'error'){
					$('#content').before('<div class="alert alert-danger alert-dismissible"><i class="fa fa-warning"></i> ' + json['message'] + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
					$('html, body').animate({
						scrollTop: 0
					}, 'slow');
				}

				setTimeout(function () {
					if (json['redirect']) {
						location = json['redirect'];
						return false;
					}
				}, 2000);


			},
			error: function(xhr, ajaxOptions, thrownError) {
				//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	});


	$(function(){

//hide div after page load
		$('.pageloadLayer').hide();

//show/hide on ajax response
		$( document ).ajaxStart(function() {
			$('.pageloadLayer').show();
		});

		$( document ).ajaxComplete(function() {
			$('.pageloadLayer').hide();
		});

	});



	$('#country').change(function(){

		var country_id = $('#country option:selected').val();
		$.ajax({
			url: 'secure/addresses/country-region.html',
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
					//console.log(states);
					$('#regions').empty();
					$.each(states,function(key,val){
						var opt = $('<option />');
						opt.val(key);
						opt.text(val);
						$('#regions').append(opt);
					});

				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				//alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});

	});

})(jQuery);

