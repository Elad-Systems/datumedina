jQuery(function($){
	$('#all_categories').on('hidden.bs.collapse', function () {
	 $('#hp_load_more').html(homeparam.hpmore)

	})
	$('#all_categories').on('shown.bs.collapse	', function () {
	 $('#hp_load_more').html(homeparam.hpless)
	})
});