<?php /* Template Name: Information Center */ ?>
<?php get_header();
//print_pr($_REQUEST);
?>
<div class="container">
    <div class="row">
        <div id="content"  class="col-md-8 content archive">
            <main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        /*if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb('<div id="breadcrumbs" class="ContainerBreadcrumbs">','</div>');
                        }*/
                        ?> 
                    </div>
                </div>
                <h1>מרכז מידע</h1>
                <?php include('inc/search-form.php'); ?>
                <?php
                $date_query = '';
                $tax_query = array();
                if(isset($_REQUEST['start-date']) && $_REQUEST['start-date'] != ''){
                    //$start = strtotime("-1 day",strtotime($_REQUEST['start-date']));
                    $date_array['after'] = $_REQUEST['start-date'];
                }
                if(isset($_REQUEST['end-date']) && $_REQUEST['end-date'] != ''){
                    $end = strtotime("+1 day",strtotime($_REQUEST['end-date']));
                    $date_array['before'] = date('d-m-Y',strtotime("+1 day",strtotime($_REQUEST['end-date'])));
                } else {
                	$_REQUEST['end-date'] = date("jS F, Y");
                }
                if(!empty($date_array)) {
                    $date_query = array($date_array,'inclusive'=>true);
                }
                if(isset($_REQUEST['post_tag'])){
                    //$tax_query['relation'] = 'AND';
                    $tax_query[] = array('taxonomy'=>'post_tag','field' =>term_id, 'terms' => $_REQUEST['post_tag'] );
                }
                if(isset($_REQUEST['contentscategories']) && ($_REQUEST['contentscategories'] !=  -1)){
                    if(isset($_REQUEST['post_tag'])) $tax_query['relation'] = 'AND';
                    $tax_query[] = array('taxonomy'=>'contentscategories','field' =>term_id, 'terms' => $_REQUEST['contentscategories'] );
                }
                //print_pr($tax_query);
            	$start_date =  date("jS F, Y", strtotime($_REQUEST['start-date'])).'  ';
                $end_date = date("jS F, Y", strtotime($_REQUEST['end-date'])).'  ';

                $args = array(
                    'post_type' => 'post',
                    //'order' => 'ASC',
                    'relation' => 'AND',
                    'date_query' => array(
                        array(
                            'after'     => $start_date,
                            'before'    => $end_date,
                            'inclusive' => true,
                        ),
                    ),
                    'tax_query' =>$tax_query,
                );
                if($_REQUEST['s'] != '') $args['s'] = $_REQUEST['s'];
                $posts_query = new WP_query( $args );
                printf( __( 'Found %s Resultes', 'datumedina' ), '<span>' . $posts_query->found_posts  . '</span>' );
                if($_REQUEST['s'] != ''):
                    echo "<h2>".__('Search Results for:','datumedina').' "'.$_REQUEST['s'].'"'."</h2>";
                else: 
                    echo "<h2>".__('Search Results','datumedina')."</h2>";
                endif;
                
                //print_pr($posts_query);
                while ( $posts_query->have_posts() ) : $posts_query->the_post();
                post_summary_display();
                endwhile;
                //wp_reset_postdata();
                $args['posts_per_page'] =  get_option( 'posts_per_page' );
                //$count_default = get_option( 'posts_per_page' );
                $jsargs = array(
                    'nonce' => wp_create_nonce( 'be-load-more-nonce' ),
                    'url'   => admin_url( 'admin-ajax.php' ),
                    'page' => 2,
                    'load_more_translate' => __('Load More','datumedina'),
                    'display_count' => get_option( 'posts_per_page' ),
                    'query' => $args,
                    'query_container' => 'content'
                );
                wp_enqueue_script('info-load-posts',get_template_directory_uri()  . '/js/info-load-posts.js',array('jquery'), rand(1, 150),true  );
                wp_localize_script( 'info-load-posts', 'infoajaxparam', $jsargs );
                ?>
            </main>
        </div>
        <div class="col-md-4">
            <aside>
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('default-sidebar') ) :endif; ?>
            </aside>
        </div>
    </div>
</div>
<?php get_footer() ?>