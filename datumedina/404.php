<?php get_header() ?>
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <main id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                <!--  פה ניתן להכניס כל סוג של HTML  -->
                <?php
                // Start the loop.
                while ( have_posts() ) : the_post();
                //echo "<h1>".get_the_title()."</h1>";
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