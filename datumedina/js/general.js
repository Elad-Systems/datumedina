jQuery(function($){
    $('.MobileMenu').click(function(){
		$('.StripHeader nav.MainNav').toggleClass('show-nav');
	});
    $('.IconSearch').click(function(){
		$('.StripHeader .Search').toggleClass('mobile-search');
	});
});


