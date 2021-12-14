<?php
function get_contacts_list($contact_category_id = 0)
{
	$args = array(
	'post_type' => 'contact',
	'tax_query' => array(
		array(
			'taxonomy' => 'contactcategory',
			'field'    => 'term_id',
			'terms'    => $contact_category_id,
		),
	),
	);
	$contacts_query = new WP_Query( $args );
	if ( $contacts_query->have_posts() ) {
		// The Loop
		while ( $contacts_query->have_posts() ) {
			$contacts_query->the_post();
			?>
			<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<?php
				$post_thumbnail_attr = array(
				    'class' => "attachment-contact_featured_image_size",
				    'alt'   => get_the_title(),
				    'title' => get_the_title(),
				);
				?>
				<?php if ( has_post_thumbnail() ) : the_post_thumbnail('contact_featured_image_size',$post_thumbnail_attr);  endif; ?>
				<div class='contact_title'><?php the_title()?> - <?php echo properties_get_meta('properties_job_title')?></div>
				<div class='contact_content'><?php the_content()?> </div>
			</div>
			<?php
		}
		wp_reset_postdata();
	}
}

/* BUILD SHORT CODE */
function shortcode_get_contacts_list($atts){
   extract(shortcode_atts(array(
      'contactcategory' => 0,
   ), $atts));
   if(is_numeric($atts['contactcategory'])){
    	ob_start();
    	get_contacts_list($atts['contactcategory']);
   	 	return ob_get_clean();
   }
}
add_shortcode('ContactsList', 'shortcode_get_contacts_list');
function properties_get_meta( $value ) {
	global $post;
	$field = get_post_meta( $post->ID, $value, true );
	if ( ! empty( $field ) ) {
		return is_array( $field ) ? stripslashes_deep( $field ) : stripslashes( wp_kses_decode_entities( $field ) );
	} else {
		return false;
	}
}
function properties_add_meta_box() {
	add_meta_box(
		'properties-properties',
		__( 'Properties', 'datumedina' ),
		'properties_html',
		'contact',
		'normal',
		'default'
	);
}
add_action( 'add_meta_boxes', 'properties_add_meta_box' );

function properties_html( $post) {
	wp_nonce_field( '_properties_nonce', 'properties_nonce' ); ?>

	<p>
		<label for="properties_job_title"><?php _e( 'Job Title', 'datumedina' ); ?></label><br>
		<input type="text" name="properties_job_title" id="properties_job_title" value="<?php echo properties_get_meta( 'properties_job_title' ); ?>">
	</p><?php
}

function properties_save( $post_id ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
	if ( ! isset( $_POST['properties_nonce'] ) || ! wp_verify_nonce( $_POST['properties_nonce'], '_properties_nonce' ) ) return;
	if ( ! current_user_can( 'edit_post', $post_id ) ) return;

	if ( isset( $_POST['properties_job_title'] ) )
		update_post_meta( $post_id, 'properties_job_title', esc_attr( $_POST['properties_job_title'] ) );
}
add_action( 'save_post', 'properties_save' );




function contacts_shortcode_body_class( $c ) {
    global $post;
    if( isset($post->post_content) && has_shortcode( $post->post_content, 'ContactsList' ) ) {
        $c[] = 'contacts';
    }
    return $c;
}
add_filter( 'body_class', 'contacts_shortcode_body_class' );
?>