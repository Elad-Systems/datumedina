<?php get_header() ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        if ( function_exists('yoast_breadcrumb') ) {
                            yoast_breadcrumb('<div id="breadcrumbs" class="ContainerBreadcrumbs">','</div>');
                        }
                        ?> 
                    </div>
                </div>
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
                echo "<h1>".get_the_title()."</h1>";
                $current_post_type = wp_get_post_terms( get_the_ID(), 'contentscategories',array('fields'=>'names') );
                $list_tax_names = implode("</span><span>", $current_post_type);
                $current_post_tags = wp_get_post_terms( get_the_ID(), 'post_tag',array('fields'=>'names') );
                $list_tag_names = implode("</span><span>", $current_post_tags);
                echo "<div class='status_row clearfix'>";
                the_date( "d/m/Y", "<span class='post_date'>", "</span>");
                if ( $params['no_cats'] != 1) {  ?><div class="single_post_subjects cats"><?php _e('Subjects:','datumedina')?> <span><?php echo $list_cat_names ?></span></div><?php }
                if ( $params['no_tags'] != 1) {  ?><div class="single_post_subjects tags"><?php _e('Tags:','datumedina')?> <span><?php echo $list_tag_names ?></span></div><?php }
                echo "<div class='SocialMedia clearfix'>";
                echo "<a href='#'><span class='share'></span></a>";
                echo "<a href='#'><span class='tweeter'></span></a>";
                echo "</div>";
                echo "</div>";
                echo "<div class='MainImgPost'>";
                the_post_thumbnail('post_featured_image_size',$post_thumbnail_attr);
                echo "</div>";
                the_content();
                // End of the loop.
                endwhile;
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