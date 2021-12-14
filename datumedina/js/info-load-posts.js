jQuery(function($){

	$('.'+infoajaxparam.query_container).append( '<button class="load-more">'+infoajaxparam.load_more_translate+'</button>' );
	var button = $('.'+infoajaxparam.query_container+' .load-more');//load_more_button_translate
	var page = 2;
	var displaycount = infoajaxparam.display_count;
	var loading = false;
	var myClass = '';
	$('body').on('click', '.load-more', function(){
	console.log(infoajaxparam.query);
		if( ! loading ) {
			loading = true;
			console.log(page);
			var data = {
				action: 'theme_ajax_load_more',
				nonce: infoajaxparam.nonce,
				page: page,
				query: infoajaxparam.query,
			};
			console.log('Befor Ajax');
			$.post(infoajaxparam.url, data, function(res) {
				if( res.success) {
					console.log(res);
					console.log(displaycount);
					console.log(res.data.data_return_count);
					$('.'+infoajaxparam.query_container).append( res.data.posts_list );
					if(displaycount <= res.data.data_return_count)
							$('.'+infoajaxparam.query_container).append( button );
					else
							$('.load-more').remove( );
					page = page +1;
					if(myClass !== ''){
						$('.'+infoajaxparam.query_container+" > div").removeClass('hide_filter')
						$('.'+infoajaxparam.query_container+" > div").not('.'+myClass).addClass('hide_filter');
					}
					loading = false;
				} else {
					console.log(res);
				}
			}).fail(function(xhr, textStatus, e) {
				console.log(xhr.responseText);
			});
			console.log('After Ajax');
		}
	});

	$('body').on('click', '.active-tabs span', function(){
		//var lastClickType = $(this);
		$('.active-tabs span').removeClass('active');
		$(this).addClass('active');

		var myClassAll = $(this).attr("class");
		var class_split = myClassAll.split(' ');
		myClass = class_split[0];
		//alert(myClass);
		console.log(myClass);
		$('.'+infoajaxparam.query_container+" > div").removeClass('hide_filter')
		if(myClass !== 'reset')
			$('.'+infoajaxparam.query_container+" > div").not('.'+myClass).addClass('hide_filter');
		return false;
	});
});