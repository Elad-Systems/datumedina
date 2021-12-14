jQuery(function($){
	$('.'+postsloadmore.query_container).append( '<button class="load-more">'+postsloadmore.load_more_button_translate+'</button>' );
	var button = $('.'+postsloadmore.query_container+' .load-more');//load_more_button_translate
	var page = 2;
	var displaycount = postsloadmore.display_count;
	var loading = false;
	var myClass = '';
	$('body').on('click', '.load-more', function(){

		if( ! loading ) {
			loading = true;
			console.log(page);
			var data = {
				action: 'theme_ajax_load_more',
				nonce: postsloadmore.nonce,
				page: page,
				query: postsloadmore.query,
			};
			//console.log('Befor Ajax');
			$.post(postsloadmore.url, data, function(res) {
				if( res.success) {
					//console.log(res);
					//console.log(displaycount);
					//console.log(res.data.data_return_count);
					$('.'+postsloadmore.query_container).append( res.data.posts_list );
					if(displaycount <= res.data.data_return_count)
							$('.'+postsloadmore.query_container).append( button );
					else
							$('.load-more').remove( );
					page = page +1;
					if(myClass !== ''){
						$('.'+postsloadmore.query_container+" > div").removeClass('hide_filter')
						$('.'+postsloadmore.query_container+" > div").not('.'+myClass).addClass('hide_filter');
					}
					loading = false;
				} else {
					//console.log(res);
				}
			}).fail(function(xhr, textStatus, e) {
				//console.log(xhr.responseText);
			});
			//console.log('After Ajax');
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
		//console.log(myClass);
		$('.'+postsloadmore.query_container+" > div").removeClass('hide_filter')
		if(myClass !== 'reset')
			$('.'+postsloadmore.query_container+" > div").not('.'+myClass).addClass('hide_filter');
		return false;
	});
});