<?php /* Template Name: Information Center */ ?>
<?php get_header();
    ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php include('inc/search-form.php'); ?>
                <?php
                $date_query = '';
                if(isset($_POST['start-date']) && $_POST['start-date'] != ''){
                        $start = strtotime("-1 day",strtotime($_POST['start-date']));
                        $date_array['after'] = date('d-m-Y',strtotime("-1 day",strtotime($_POST['start-date'])));
                }
                if(isset($_POST['end-date']) && $_POST['end-date'] != ''){
                       $end = strtotime("+1 day",strtotime($_POST['end-date']));
                        $date_array['befor'] = date('d-m-Y',strtotime("+1 day",strtotime($_POST['end-date'])));
                }
                if(!empty($date_array)) {
                    $date_query = array($date_array,'inclusive'=>true);
                }

                print_pr($date_query);
                $args = array(
                    'post_type' => 'post',
                    //'posts_per_page' => -1,
                    'order' => 'ASC',
                    'date_query' => $date_query,
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'people',
                                    'field'    => 'slug',
                                    'terms'    => 'bob',
                                ),
                            ),
                );
                $posts_query = new WP_query( $args );
                 print_pr($posts_query);
                // Start the loop.
                while ( $posts_query->have_posts() ) : $posts_query->the_post();
                    post_summary_display();
                endwhile;
                wp_reset_postdata();
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

jQuery(function($){
    $('#all_categories').on('hidden.bs.collapse', function () {
     $('#hp_load_more').html(homeparam.hpmore)

    })
    $('#all_categories').on('shown.bs.collapse  ', function () {
     $('#hp_load_more').html(homeparam.hpless)
    })
});
<?php get_footer() ?>
