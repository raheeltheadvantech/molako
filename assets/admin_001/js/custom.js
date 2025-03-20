// Sticky Action Bar code
jQuery(window).scroll(function () {
	var scroll = jQuery(window).scrollTop();
	if (scroll >= 40) {
		jQuery(".action-bar").addClass("sticky");
	} else {
		jQuery(".action-bar").removeClass("sticky");
	}
});

// Metis Menu Code
$("#metismenu").metisMenu();

// Custom Scroll Code
$(window).on("load",function(){
	$(".middle-bar").mCustomScrollbar();
});

// Top header Menu Open
$(".user-li.dropdown").click(function(){
  $("body").toggleClass("user-popup");
});

// Custom backdrop
$(".custom-backdrop").click(function(){
  $("body").removeClass("user-popup");
});

// Custom upload
$(".custom-upload").on("change", ".file-upload-field", function(){ 
    $(this).parent(".file-upload-wrapper").attr("data-text", $(this).val().replace(/.*(\/|\\)/, '') );
});

// Banner Code
$(function(){
	$('#change_me').on("click", function () {
		$('.banner').addClass("active");
			setTimeout(RemoveClass, 2500);
		});
	function RemoveClass() {
		$('.banner').removeClass("active");
	}
}); 


// Dropdown stop propagation
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
});













