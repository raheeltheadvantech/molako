$(document).ready(function(){	
	var viewportHeight = $(window).height() - Math.abs(40); //header+margins
	var contents = $('.container.contents').height();
	if(contents < viewportHeight)$('footer').css('margin-top', parseInt((viewportHeight-contents),10));
	$(window).resize(function() {
		var contents = $('.container.contents').height();
		var viewportHeight = $(window).height() - Math.abs(40);	//header+margins;
		if(contents < viewportHeight)$('footer').css('margin-top', parseInt((viewportHeight-contents),10));
	});

	phery.on({
		'before': function(){
			showAjaxPreloader();
		},
		'always': function(){
			hideAjaxPreloader();
		},
		'exception': function(){
			alert('Exception occured.');
			hideAjaxPreloader();
		},
		'fail': function(xhr, status, error){
			alert('Request failed: '+error + ' : '+xhr.responseText);
			hideAjaxPreloader();
		}
	});
	
	$('form').bind({
		'phery:always': function(){
			$(this).find('.btn').removeAttr('disabled');
			hideAjaxButtonLoader();
			$(this).find('.btn-ajax').show();
		},
		'phery:before': function(){
			if ($(this).phery('inprogress')){
				return false; // will cancel the new action
			}
			$(this).find('.btn').attr('disabled', 'disabled');
			$(this).find('.btn-ajax').hide();
			showAjaxButtonLoader($(this).find('.btn-ajax[clicked="true"]'));
		}
	});	
	
	$('form').find('input[type="submit"], button, a.btn').click(function() {
		$('form').find('input[type="submit"], button, a.btn').removeAttr('clicked');
		$(this).attr('clicked', 'true');
	});
	
	$('a.confirm').on('click', function(){
		if(!confirm($(this).data('confirm')))
		return false;
	});

	phery.config({
		'only' : true,
		'disabled' : true
	}).lock_config();
	
});

function focusRecentAdded() {
	$(".recent-added").animate({'background-color':'#ffff00'}, 400)
		.animate({'background-color':'transparent'}, 1200);
	$(".recent-added").removeClass('recent-added').addClass('recent-added-old');
}

function showAjaxButtonLoader(obj) {
	var data = '<div id="ajax-btn-loader"></div>';
	var data = '<div id="ajax-btn-loader-container" class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-ellipsis"><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div><div><div></div></div></div>';
	
	var preloaderOverlay = $(data).insertAfter($(obj));
}
function hideAjaxButtonLoader() {
	$('body').find('#ajax-btn-loader-container').remove();
}

function showAjaxPreloader(is_window, top, left) {
	var topP = (typeof top === 'undefined') ? '' : top;
	var leftP = (typeof left === 'undefined') ? '' : left;
	var is_window = (typeof is_window === 'undefined') ? true : is_window;
	var preloaderOverlay = $('<div id="ajax-preloader-overlay"></div>').appendTo($('body')),
		preloaderContainer = $('<div id="preloader-container"></div>').appendTo($('body'));
		
	preloaderOverlay.css('width', $(document).width());
	preloaderOverlay.css('height', $(document).height());
	
	var topPosition = $(document).scrollTop() + ($(window).height() - preloaderContainer.outerHeight(true)) / 2,
		leftPosition = ($(document).width() - preloaderContainer.outerWidth(true)) / 2;
		
		if(topP != '')topPosition = topP;
		if(leftP != '')leftPosition = leftP;
		if(is_window){
			leftPosition = ($(window).width() - preloaderContainer.outerWidth(true)) / 2;
		}
		
	preloaderContainer.css({top: topPosition, left: leftPosition});
}

function hideAjaxPreloader() {
	$('body').find('#ajax-preloader-overlay').remove();	
	$('body').find('#preloader-container').remove();
	focusRecentAdded();
}

function scrollTop(elem, speed, is_animate){
	var speed = (typeof speed === 'undefined') ? 1000 : speed;
	var is_animate = (typeof is_animate === 'undefined') ? false : is_animate;
	var top = Math.round($(elem).offset().top)+0;
	//$(window).scrollTop(top);
	$('body,html').animate(
		{scrollTop: top},
		speed,
		function(){
			if(!is_animate) return false;
			$(elem).animate
			({
				'background-color': '#ffff00',
				'opacity': 0.8
			})
		}
	);
	return false;
}

function redirect(url, delay){
	var delay = (typeof delay === 'undefined') ? 0 : delay;
	var url = (typeof url === 'undefined') ? SITE_URL : url;
	
	setTimeout(function(){ window.location.href = url; }, delay);
	return false;
}
