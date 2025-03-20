//$.getScript(ASSETS_URL+'/js/custom.js', function() {alert('Load was performed.');});

// Sticky Action Bar code
jQuery(window).scroll(function () {
	var scroll = jQuery(window).scrollTop();
	if (scroll >= 40) {
		jQuery(".action-bar").addClass("sticky");
	} else {
		jQuery(".action-bar").removeClass("sticky");
	}
});

if (typeof metisMenu === 'function') { 
	$("#metismenu").metisMenu();
}

$(window).on("load",function(){
	if (typeof mCustomScrollbar === 'function') { 
		$(".middle-bar").mCustomScrollbar();
	}
});

$(".user-li.dropdown").click(function(){
  $("body").toggleClass("user-popup");
});

$(".custom-backdrop").click(function(){
  $("body").removeClass("user-popup");
});

$(".custom-upload").on("change", ".file-upload-field", function(){ 
    $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, '') );
});

$(function(){
	$('#change_me').on("click", function () {
		$('.banner').addClass("active");
			setTimeout(RemoveClass, 2500);
		});
	function RemoveClass() {
		$('.banner').removeClass("active");
	}
}); 

$(".dropdown-menu").click(function(event){
  event.stopPropagation();
});


// Hide table columns
$(".ul-cols li").click(function(evt){
	var t = $(this).data('class');
	if($(this).find(':checkbox').is(':checked')){
		$('.table-cols').find('th[data-class="'+t+'"], td[data-class="'+t+'"]').removeClass('hidden');
	}else{
		$('.table-cols').find('th[data-class="'+t+'"], td[data-class="'+t+'"]').addClass('hidden');
	}
	/*
	evt.stopPropagation();
	evt.preventDefault();
	var t = $(this).data('class');
	alert(t);
	$('.table-cols').find('th[data-class="'+t+'"], td[data-class="'+t+'"]').toggleClass('hidden');
	*/
});


function showLoader(obj){
	obj.addClass('is-loading');
}

function hideLoader(obj, delay){
	delay = ( typeof delay === 'undefined' ? 0 : delay );
	
	setTimeout(
		function(){
			obj.removeClass('is-loading');
		}
	, delay);
}
