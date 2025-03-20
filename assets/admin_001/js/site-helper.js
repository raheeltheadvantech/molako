$(document).ready(function(){
	/*$.ajaxSetup({
		beforeSend: function(xhr){},
		complete: function(xhr,status){},
	});*/
});

function bindBootstrapModalEvents() {
    var $body = $('body'),
        curPos = 0,
        isOpened = false,
        isOpenedTwice = false;
    $body.off('shown.bs.modal hidden.bs.modal', '.modal');
    $body.on('shown.bs.modal', '.modal', function () {
        if (isOpened) {
            isOpenedTwice = true;
        } else {
            isOpened = true;
            curPos = $(window).scrollTop();
            $body.css('overflow', 'hidden');
        }
    });
    $body.on('hidden.bs.modal', '.modal', function () {
        if (!isOpenedTwice) {
            $(window).scrollTop(curPos);
            $body.css('overflow', 'visible');
            isOpened = false;
        }
        isOpenedTwice = false;
    });
}

var Log = function(y){
	x = AppConfig.DebugMode
	x = typeof x === 'boolean' ? x : false;
	if(x){
		console.log(y);
	}
}
var LogAlert = function(){
	x = AppConfig.DebugMode
	x = typeof x === 'boolean' ? x : false;
	if(!x){
		console.log('DebugMode is OFF.');
	}
}
LogAlert();

var RandomString = function(x) {
	x = typeof x === 'number' ? x : 12;
	var chars = "ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz0123456789";
	var string_length = x;
	var randomstring = '';
	for (var i=0; i<string_length; i++) {
		var rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum,rnum+1);
	}
	
	return randomstring;
}

function showAjaxPreloader(){
	
}

function hideAjaxPreloader(){
	
}
