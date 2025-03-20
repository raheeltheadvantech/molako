// Discover Country Slider
$('.discover-slider').bxSlider({
  minSlides: 1,
  maxSlides: 3,
  slideWidth: 350,
  slideMargin: 20,
  easing: 'easeOutElastic',
  speed: 2000,
  controls: false,
  auto: true,
  pager: true  
});

// testimonial_slider Slide Code
  $('.testimonial_slider').bxSlider({
	  pagerCustom: '#bx-pager'
});

// Sign in testimonial slider Slide Code
  $('.testimonial-slider').bxSlider({
	  pagerCustom: '#bx-pager'
});

// Client Logo Slide Code
$('.client-logo-slider').bxSlider({
  minSlides: 2,
  maxSlides: 4,
  slideWidth: 265,
  slideMargin: 15,
  easing: 'easeOutElastic',
  speed: 2000,
  controls: false,
  auto: true,
  pager: false  
});

// Calander Code
$( ".calendar-icon" ).datepicker({
  showAnim: ""
});

// accordion 
$('.accordiontwo').accordion();

// Grid VS List View 
$("document").ready(function(){
	$('#list').trigger('click');
});
$('#list').click(function(e){e.preventDefault();$('#products .item').addClass('custompad list-group-item');});
$('#grid').click(function(e){e.preventDefault();$('#products .item').addClass('').removeClass('custompad list-group-item');
});

// Custom color on Checked chckbox on amenities box 
$(".amenities-box .checkbox input[type='checkbox']").change(function(){
    if($(this).is(":checked")){
        $(this).parent().addClass("border-class"); 
    }else{
        $(this).parent().removeClass("border-class");  
    }
});

$(".dz-select input[type='checkbox']").click(function(){
   if($(this).is(":checked")){
        $(".dz-row").addClass("selection-mode album-border");
    }else{
        $(".dz-row").removeClass("selection-mode album-border");  
    }
});

