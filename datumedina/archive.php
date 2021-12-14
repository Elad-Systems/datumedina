<?php get_header() ?>
<?php
    $cat_title = single_cat_title("", false);
$category_desc = category_description();
?>
<div class="archive-top-strip">
    <?php if( ( $category_image = category_image_src( array('size' =>  'full' )  , false ) ) != null ): ?>
    <img src="<?php echo $category_image; ?>" alt="<?php echo $cat_title?>" class="img-responsive">
    <?php else: ?>
    <img src="<?php echo get_template_directory_uri() ?>/images/archive-top-strip-img-1.jpg" />
    <?php endif; ?>
</div>
<div class="container">
    <div class="row">
        <div id="content" class="col-md-8">
            <?php
            if (preg_match('/<!--more-->/',$category_desc)){
                $category_desc = str_replace('<!--more-->','<div id="fold" class="fold collapse">',$category_desc);
                $category_desc .= "</div><button id='archive_read_more' class='load-more' data-toggle='collapse' data-target='#fold'>".__('Read More','datumedina')."</button>";
            }
            //echo 'true<br>true<br>true<br>true<br>true<br>true<br>true<br>';
            echo '<div class="category_description"><h1>'.$cat_title. '</h1>'.$category_desc."</div>";
            ?>
            <?php
            if( is_category() ) {
                display_category_types();
            }
            // Start the loop.
            while ( have_posts() ) : the_post();
            post_summary_display();
            // End of the loop.
            endwhile;
            ?>
        </div>
        <div class="col-md-4">
            <aside>
                <?php do_action( 'archive_side' ); ?>
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('default-sidebar') ) :endif; ?>
            </aside>
        </div>
    </div>
</div>
<?php get_footer() ?>