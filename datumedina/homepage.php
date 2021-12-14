<?php /* Template Name: Homepage */ 
__('Homepage', 'datumedina');
get_header() ?>
<!-- html -->


<div class="StripSliderSidebar striped">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home-page-slider-sidebar') ) :endif; ?>
</div>
<div class="container">
    <div class="row striped">
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home-page-sidebar') ) :endif; ?>
    </div>
    <main class="striped">
        <div class="row striped">
            <div class="col-md-6">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home-right-sidebar') ) :endif; ?>
            </div>
            <div class="col-md-6">
                <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('home-left-sidebar') ) :endif; ?>
            </div>
        </div>
        <div class="row striped">
            <div class="col-md-12">
                <h2 class="widgettitle FullScreen"><?php _e('Central Subjects','datumedina'); ?></h2>
            </div>
            <?php
            homepage_featured_categories();
            ?>
        </div>
        <div id="all_categories" class="row collapse">
            <?php
            get_all_categories_exclude_features();
            ?>
        </div>
        <button id="hp_load_more" class="load-more"  data-toggle="collapse" data-target="#all_categories"><?php _e('More Categories','datumedina') ?></button> <!--  -->
    </main>
</div>
<?php get_footer() ?>