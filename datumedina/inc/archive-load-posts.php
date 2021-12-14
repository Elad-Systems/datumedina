<?php
 function archive_ajax_load_posts() {
    global $wp_query;
    if( is_category()) {
        wp_enqueue_script('archive-load-posts',get_template_directory_uri()  . '/js/archive-load-posts.js',array('jquery'), '1.0',true  );
        $max = $wp_query->max_num_pages;
        $paged = ( get_query_var('paged') > 1 ) ? get_query_var('paged') : 1;
        wp_localize_script( 'archive-load-posts', 'archiveajaxparam', array( 'startPage' => $paged, 'maxPages' => $max,'nextLink' => next_posts($max, false),'loadmore'=>__('Load more','datumedina') ,'loading'=>__('Loading...','datumedina') ) );
    }
 }
 add_action('wp_enqueue_scripts', 'archive_ajax_load_posts');
 ?>