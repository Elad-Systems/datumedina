<?php
// Register Custom Post Type
function theme_contact() {
	$labels = array(
		'name'                  => _x( 'contacts', 'contacts General Name', 'datumedina' ),
		'singular_name'         => _x( 'contact', 'contacts Singular Name', 'datumedina' ),
		'menu_name'             => __( 'Contacts', 'datumedina' ),
		'name_admin_bar'        => __( 'Contacts', 'datumedina' ),
		'archives'              => __( 'Contacts Archives', 'datumedina' ),
		'attributes'            => __( 'Contact Attributes', 'datumedina' ),
		'parent_item_colon'     => __( 'Parent Contact:', 'datumedina' ),
		'all_items'             => __( 'All Contacts', 'datumedina' ),
		'add_new_item'          => __( 'Add New Contact', 'datumedina' ),
		'add_new'               => __( 'Add New', 'datumedina' ),
		'new_item'              => __( 'New Contact', 'datumedina' ),
		'edit_item'             => __( 'Edit Contact', 'datumedina' ),
		'update_item'           => __( 'Update Contact', 'datumedina' ),
		'view_item'             => __( 'View Contact', 'datumedina' ),
		'view_items'            => __( 'View Contacts', 'datumedina' ),
		'search_items'          => __( 'Search Contacts', 'datumedina' ),
		'not_found'             => __( 'Not found', 'datumedina' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'datumedina' ),
		'featured_image'        => __( 'Featured Image', 'datumedina' ),
		'set_featured_image'    => __( 'Set featured image', 'datumedina' ),
		'remove_featured_image' => __( 'Remove featured image', 'datumedina' ),
		'use_featured_image'    => __( 'Use as featured image', 'datumedina' ),
);
	$args = array(
		'label'                 => __( 'contact', 'datumedina' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', ),
		'taxonomies'            => array( 'contactcategory' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => false,		
		'exclude_from_search'   => true,
		'publicly_queryable'    => false,
		'capability_type'       => 'post',
	);
	register_post_type( 'contact', $args );

}
add_action( 'init', 'theme_contact', 0 );
// Register Custom Taxonomy
function custom_taxonomycontactcategory() {

	$labels = array(
		'name'                       => _x( 'Contact Categories', '', 'datumedina' ),
		'singular_name'              => _x( 'Contact Category', '', 'datumedina' ),
		'menu_name'                  => __( 'Contact Categories', 'datumedina' ),
		'all_items'                  => __( 'All Items', 'datumedina' ),
		'parent_item'                => __( 'Parent Item', 'datumedina' ),
		'parent_item_colon'          => __( 'Parent Item:', 'datumedina' ),
		'new_item_name'              => __( 'New Item Name', 'datumedina' ),
		'add_new_item'               => __( 'Add New Item', 'datumedina' ),
		'edit_item'                  => __( 'Edit Item', 'datumedina' ),
		'update_item'                => __( 'Update Item', 'datumedina' ),
		'view_item'                  => __( 'View Item', 'datumedina' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'datumedina' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'datumedina' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'datumedina' ),
		'popular_items'              => __( 'Popular Items', 'datumedina' ),
		'search_items'               => __( 'Search Items', 'datumedina' ),
		'not_found'                  => __( 'Not Found', 'datumedina' ),
		'no_terms'                   => __( 'No items', 'datumedina' ),
		'items_list'                 => __( 'Items list', 'datumedina' ),
		'items_list_navigation'      => __( 'Items list navigation', 'datumedina' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'contactcategory', array( 'contact' ), $args );


	$labels = array(
		'name'                       => _x( 'Content Types', '', 'datumedina' ),
		'singular_name'              => _x( 'Content Type', '', 'datumedina' ),
		'menu_name'                  => __( 'Content Types', 'datumedina' ),
		'all_items'                  => __( 'All Items', 'datumedina' ),
		'parent_item'                => __( 'Parent Item', 'datumedina' ),
		'parent_item_colon'          => __( 'Parent Item:', 'datumedina' ),
		'new_item_name'              => __( 'New Item Name', 'datumedina' ),
		'add_new_item'               => __( 'Add New Item', 'datumedina' ),
		'edit_item'                  => __( 'Edit Item', 'datumedina' ),
		'update_item'                => __( 'Update Item', 'datumedina' ),
		'view_item'                  => __( 'View Item', 'datumedina' ),
		'separate_items_with_commas' => __( 'Separate items with commas', 'datumedina' ),
		'add_or_remove_items'        => __( 'Add or remove items', 'datumedina' ),
		'choose_from_most_used'      => __( 'Choose from the most used', 'datumedina' ),
		'popular_items'              => __( 'Popular Items', 'datumedina' ),
		'search_items'               => __( 'Search Items', 'datumedina' ),
		'not_found'                  => __( 'Not Found', 'datumedina' ),
		'no_terms'                   => __( 'No items', 'datumedina' ),
		'items_list'                 => __( 'Items list', 'datumedina' ),
		'items_list_navigation'      => __( 'Items list navigation', 'datumedina' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
	);
	register_taxonomy( 'contentscategories', array( 'post' ), $args );
}
add_action( 'init', 'custom_taxonomycontactcategory', 0 );
?>