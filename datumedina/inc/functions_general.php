<?php
function print_pr($item){
    echo "<pre style='direction:ltr'>";
    print_r($item);
    echo "</pre>";
}
add_action( 'admin_enqueue_scripts', 'theme_add_color_picker' );
function theme_add_color_picker( $hook ) {

    if( is_admin() ) {
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'admin-general-js', get_stylesheet_directory_uri() . '/js/admin-general.js', array( 'wp-color-picker' ),  false, true);
    }
}
function post_summary_display(){
    ?>
 <div id="post-<?php the_ID(); ?>" <?php post_class('filter-selector '); ?>>
  <?php
                 $post_thumbnail_attr = array(
                    'class' => "attachment-contact_featured_image_size",
                    'alt'   => get_the_title(),
                    'title' => get_the_title(),
                );
                ?>
                <?php if ( has_post_thumbnail() && $params['no_img'] != 1) :
                    //echo '<a href="'.get_the_permalink().'">';
                    //the_post_thumbnail('post_featured_image_size',$post_thumbnail_attr);
                    //echo "</a>";
                 endif; ?>
                <?php
                $current_post_type = wp_get_post_terms( get_the_ID(), 'contentscategories',array('fields'=>'names') );
                $list_tax_names = implode("</span><span>", $current_post_type);

                $current_post_tags = wp_get_post_terms( get_the_ID(), 'post_tag',array('fields'=>'names') );
                //var_dump($current_post_tags);
                $list_tag_names = implode("</span><span>", $current_post_tags);
                if(!empty($current_post_categories) && is_array($current_post_categories)){
                    $list_cat_names = implode("</span><span>", $current_post_categories);
                } else {
                    $list_cat_names= '';
                }
                ?>
                <div class='ajax_post_title'><h3><a href="<?php the_permalink(); ?>"><?php the_title()?></a></h3></div>
                <div class="ajax_post_date"><?php echo get_the_date()?> | <span><?php echo $list_tax_names ?></span></div>
                <?php if ( $params['no_tags'] != 1) {  ?><div class="ajax_post_subjects tags"><?php _e('Subjects:','datumedina')?> <span><?php echo $list_tag_names ?></span></div><?php } ?>
                <div class='ajax_post_content'><?php the_excerpt()?> </div>
</div>
<?php
}

function get_terms_chekboxes($taxonomies, $args) {
  $terms = get_terms($taxonomies, $args);
    $output .= '<div id="ck-button">';
  foreach($terms as $term){
      if(isset($_REQUEST[$term->taxonomy]) && is_array($_REQUEST[$term->taxonomy]) && !empty($_REQUEST[$term->taxonomy])) $set_search_tax = true;
      $selected='';
      if($set_search_tax && in_array($term->term_id, $_REQUEST[$term->taxonomy])) $selected = 'checked';
        $output .= '<label for="'.$term->slug.'"><input '.$selected.' type="checkbox" id="'.$term->slug.'" name="'.$term->taxonomy.'[]" value="'.$term->term_id.'"> <span>'.$term->name.'</span></label>';
  }
  $output .= '</div>';
  return $output;
}

function add_datepicker_in_footer(){ ?>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.datepicker').datepicker({
        dateFormat: 'dd-mm-yy'
    });
});
</script>
<?php
}
add_action('wp_footer','add_datepicker_in_footer',10);
?>
