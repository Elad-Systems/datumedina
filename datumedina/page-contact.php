<?php /* Template Name: Contact */ ?>
__('Contact', 'datumedina');
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
                ?>
                <div class="row">
                    <div  class="col-md-4"><?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('contact-sidebar') ) :endif; ?></div>
                    <div  class="col-md-8"><?php the_content(); ?></div>
                </div>
                <?php

                // End of the loop.
                endwhile;
                ?>
            </main>
        </div>
        <div class="col-md-4">
            <aside>
                <?php do_action( 'page_side' ); ?>
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('default-sidebar') ) :endif; ?>
            </aside>
        </div>
    </div>
</div>
<?php get_footer() ?>