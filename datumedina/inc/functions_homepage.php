<?php
function get_all_categories_exclude_features(){
	$terms = get_terms(
	array(
    	'taxonomy' => 'category',
    	'hide_empty' => false,
    	'exclude' => homepage_featured_categories_array_id(),
	));
	foreach ($terms as $key => $term) {
	    $color_term = get_term_meta( $term->term_id, 'category_color', true );
		?>
		<div class="col-md-3 term term-<?php echo $term->term_id ?> category category-<?php echo $term->term_id ?>">
			<div class="term-title term-title-<?php echo $term->term_id ?>">
                <?php echo "<h3 style='border-color:$color_term'><a href='".esc_url( get_term_link( $term ))."'>".$term->name."</a></h3>";?>
				<?php echo "<div class='description'>".$term->description."</div>";?>
			</div>
		</div>
		<?php
	}
}
function homepage_featured_categories(){
	$theme_options = get_option( 'theme_options_option_name' );
	$features_count = $theme_options['homepage_max_featured_categories_0'];
	$terms = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => false,
    'number' => $features_count,
	'meta_query' => array(
	         'feature_list' => array(
	            'key'       => 'feature_expose',
	            'compare'   => 'EXISTS'
	         )
	    ),
	'orderby' => 'feature_list',
	));

	foreach ($terms as $key => $term) {
	    //print_r($term);
	    $color_term = get_term_meta( $term->term_id, 'category_color', true );
		?>
		<div class="col-md-3 term term-<?php echo $term->term_id ?> category category-<?php echo $term->term_id ?>">
			<div class="term-title term-title-<?php echo $term->term_id ?>">
				<?php echo "<h3 style='border-color:$color_term'><a href='".esc_url( get_term_link( $term ))."'>".$term->name."</a></h3>";?>
				<?php echo "<div class='description'>".$term->description."</div>";?>
			</div>
		</div>
		<?php
	}
//get_all_categories_exclude_features();
}
function homepage_featured_categories_array_id(){
	$theme_options = get_option( 'theme_options_option_name' );
	$features_count = $theme_options['homepage_max_featured_categories_0'];
	$terms = get_terms( array(
    'taxonomy' => 'category',
    'hide_empty' => false,
    'number' => $features_count,
	'meta_query' => array(
	         'feature_list' => array(
	            'key'       => 'feature_expose',
	            'compare'   => 'EXISTS'
	         )
	    ),
	'orderby' => 'feature_list',
	) );

	foreach ($terms as $key => $term)	$list_categories[] = $term->term_id;
	return $list_categories;
}
?>