var config = {
	selector: '.tinymce,.redactor',
	menubar: false,
	// General options
	mode : "textareas",
//	theme : "advanced",
	plugins : "paste",

	// Theme options
	theme_advanced_buttons1 : "",
	theme_advanced_buttons2 : "",
	theme_advanced_buttons3 : "",
	theme_advanced_buttons4 : "",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "js/template_list.js",
	external_link_list_url : "js/link_list.js",
	external_image_list_url : "js/image_list.js",
	media_external_list_url : "js/media_list.js",

	toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify",
	//fontsize_formats: "8px 10px 12px 14px 18px 24px 36px",
	fontsize_formats: '8pt 10pt 12pt 14pt 18pt 24pt 36pt 48pt 60pt 72pt',

	// URL
	relative_urls : false,
	remove_script_host : true,
	convert_urls : true,
	//document_base_url : "/",

};

//var config = {selector: '.tinymce'};
tinyMCE.init(config);
