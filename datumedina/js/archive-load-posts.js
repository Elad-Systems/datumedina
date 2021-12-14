jQuery(document).ready(function($) {
    //alert('test');
    // The number of the next page to load (/page/x/).
    var pageNum = parseInt(archiveajaxparam.startPage) + 1;

    // The maximum number of pages the current query can return.
    var max = parseInt(archiveajaxparam.maxPages);
	//alert(max);
	console.log('max - '+max);
	console.log('page - '+pageNum);
    // The link of the next page of posts.
    var nextLink = archiveajaxparam.nextLink;
    var myClass = '';
    /**
	 * Replace the traditional navigation with our own,
	 * but only if there is at least one page of new posts to load.
	 */
    if(pageNum <= max) {
        // Insert the "More Posts" link.
        $('#content')
            .append('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
            .append('<p id="pbd-alp-load-posts"><a href="#"><button class="load-more">'+archiveajaxparam.loadmore+'</button></a></p>');

        // Remove the traditional navigation.
        $('.navigation').remove();
    }
    /**
	 * Load new posts when the link is clicked.
	 */
    $('#pbd-alp-load-posts a').click(function() {

        // Are there more posts to load?
        if(pageNum <= max) {

            // Show that we're working.
            $(this).text(archiveajaxparam.loading);

            $('.pbd-alp-placeholder-'+ pageNum).load(nextLink + ' .post',
                                                     function() {
                // Update page number and nextLink.
                pageNum++;
                nextLink = nextLink.replace(/\/page\/[0-9]?/, '/page/'+ pageNum);
                // Add a new placeholder, for when user clicks again.
                $('#pbd-alp-load-posts')
                    .before('<div class="pbd-alp-placeholder-'+ pageNum +'"></div>')
                // Update the button message.
                if(pageNum <= max) {
                    $('#pbd-alp-load-posts a').html('<button class="load-more">'+archiveajaxparam.loadmore+'</button>');
                } else {
                    $('#pbd-alp-load-posts a').html('&nbsp;');
                }
            }
                                                    );
        } else {
            $('#pbd-alp-load-posts a').append('.');
        }

        if(myClass !== ''){
            $('#content .filter-selector').removeClass('hide_filter')
            $('#content .filter-selector').not('.'+myClass).addClass('hide_filter');
        }
        return false;
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
        $('#content .filter-selector').removeClass('hide_filter')
        if(myClass !== 'reset')
            $('#content .filter-selector').not('.'+myClass).addClass('hide_filter');
        return false;
    });



});