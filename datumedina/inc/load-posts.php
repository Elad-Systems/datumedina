<?php
function display_category_types(){
        $terms = get_terms( 'contentscategories', array(
            'hide_empty' => false,
        ) );
        //print_r($terms);
        echo "<div class='active-tabs'>";
            echo "<span class='reset active'>";
            echo __('All','datumedina');
            echo "</span>";
        foreach ($terms as $key => $term) {
            echo "<span class='contentscategories-".$term->term_id."'>";
            echo "<a href='#'>".$term->name."</a>";
            echo "</span>";
        }
        echo "</div>";
}

function theme_ajax_load_more() {
    check_ajax_referer( 'be-load-more-nonce', 'nonce' );
    $args = isset( $_POST['query'] ) ? $_POST['query'] : array();
    $args['paged'] = esc_attr( $_POST['page'] );
    ob_start();
    $loop = new WP_Query( $args );
    if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();
        post_summary_display();
    endwhile; endif; wp_reset_postdata();
    $return_object['posts_list'] = ob_get_clean();
    $return_object['data_return_count'] = $loop->post_count;
    wp_send_json_success( $return_object );
    wp_die();
}
add_action( 'wp_ajax_theme_ajax_load_more', 'theme_ajax_load_more' );
add_action( 'wp_ajax_nopriv_theme_ajax_load_more', 'theme_ajax_load_more' );


function load_more_posts_js() {
  $count_default = get_option( 'posts_per_page' );
  $query = array(
    'posts_per_page' => $count_default
  );
  $args = array(
    'nonce' => wp_create_nonce( 'be-load-more-nonce' ),
    'url'   => admin_url( 'admin-ajax.php' ),
    'page' => 2,
    'found' =>1,
    'display_count' => $count_default,
    'query' => $query,
  );
  wp_enqueue_script( 'ajax-load-more', plugin_dir_url( __FILE__ ) . '/js/load_posts.js', array( 'jquery' ), '1.1', true );
  wp_localize_script( 'ajax-load-more', 'postsloadmore', $args );

}

function theme_load_posts($params) {

    $args = array(
        'post_type'      => 'post',
        'hide_empty'     => 0,
    );
    $loop = new WP_Query( $args );
    echo "<div class='".$params['class_container']."'>";
    if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();
        post_summary_display($params);
    endwhile; endif; wp_reset_postdata();
    echo "</div>";

  $count_default = get_option( 'posts_per_page' );
  $args[ 'posts_per_page' ] = $count_default;

  $ajax_args = array(
    'nonce' => wp_create_nonce( 'be-load-more-nonce' ),
    'url'   => admin_url( 'admin-ajax.php' ),
    //'page' => 2,
    'found' =>1,
    'display_count' => $count_default,
    'query_container' => $params['class_container'],
    'load_more_button_translate' => __('Load More','datumediana'),
    'query' => $args,
  );
  wp_enqueue_script( 'be-load-more', get_template_directory_uri() . '/js/load_posts.js', array( 'jquery' ), '1.0', true );
  wp_localize_script( 'be-load-more', 'postsloadmore', $ajax_args );
}
function theme_load_posts_content_type($params) {

    $args = array(
        'post_type'      => 'post',
        'tax_query' => array(
                array(
                    'taxonomy' => 'contentscategories',
                    'field'    => 'term_id',
                    'terms'    => array($params['type_content_ids']),
                ),
            ),
    );
    $loop = new WP_Query( $args );
    echo "<div class='".$params['class_container']."'>";
    if( $loop->have_posts() ): while( $loop->have_posts() ): $loop->the_post();
        post_summary_display($params);
    endwhile; endif; wp_reset_postdata();
    echo "";
    $theme_options = get_option( 'theme_options_option_name' );
    //$features_count = $theme_options['homepage_max_featured_categories_0'];
    $get_info_url = get_permalink($theme_options['information_center_0'])."/?contentscategories=".$params['type_content_ids'];
    echo "<a href='$get_info_url' class='load-more'>".__('More','datumedina')."</a>";
    //?contentscategories=34/
    echo "</div>";
}
function shortcode_get_posts_list($atts){
        //$args = shortcode_parse_atts( $atts );
        ob_start();
        if(isset($atts['type'])){
            display_category_types();
        }
        if(isset($atts['type_content_ids']))
            theme_load_posts_content_type($atts);
        else
            theme_load_posts($atts);
        return ob_get_clean();
}
add_shortcode('posts_list', 'shortcode_get_posts_list');
?>