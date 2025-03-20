<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<script type="text/javascript" src="<?php echo site_url($assets_dir.'typeahead/typeahead.bundle.js'); ?>"></script>
<script>
$(document).ready(function(){

	var apply_typehead = function(mode){
		mode = ( typeof mode === 'undefined' ? 0 : mode);
		var inpt_ctrl = $('.typeahead');
		
		if(mode == 1){
			inpt_ctrl.val('');
			inpt_ctrl.typeahead('destroy');
			$('[name=q]').val('');
		}

		var engine = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: {
				url: '<?php echo site_url($this->user_url .'/catalog/ajax/search.html');?>',
				prepare: function(query, settings){
					var q = query.replace(/,/g , '');
					var params = 'q='+q+'';
					settings.type = 'POST';
					settings.data = params;
					return settings;
				},
				transform: function(resp){
					return resp.data;
				}
			}
		});
		
		var typeahead = inpt_ctrl.typeahead({
			highlight:true,
			showHintOnFocus:true,
			hint: false,
			limit: 10,
			minLength: 3
			}, {
			templates: {
				empty: '',
				suggestion: function(data){
					return '<div>'+data.value+'</div>';
				}
			},
			name: 'search-home',
			display: 'value',
			source: engine
		})
		.bind('typeahead:select', function(e, suggestion) {
			$('[name=q]').val(suggestion.q);
		});
	};
	
	$('.btn-search').click(function(){
		var q = $('.typeahead').val();
		$('[name=q]').val(q);
		$('[name=term]').val(q);
		
		$('.form-search').submit();
	});
	
	$(document).on('submit','form.form-search',function(){
		var q = $('.typeahead').val();
		var cat_id = $('#category_id').val();
		const attachArray = [q,cat_id];
		$('#q').val(attachArray);
		$('#term').val(attachArray);
	});
	
	apply_typehead();
});
</script>
