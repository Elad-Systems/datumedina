<?php
add_action( 'category_add_form_fields', 'add_feature_field', 10, 2 );
function add_feature_field($taxonomy) {
    ?>
    <div class="form-field term-group">
        <label for="feature_expose"><?php _e( 'Featured Expose Position', 'datumedina' ); ?></label>
        <input type="text" name="feature_expose" id="feature_expose" value="">
    </div>
        <div class="form-field term-group">
        <label for="category_color"><?php _e( 'Category Color', 'datumedina' ); ?></label>
        <input type="text" name="category_color" class="colorfield"  id="category_color" value="#cccccc">
    </div>
    <?php
}
add_action( 'category_edit_form_fields', 'edit_feature_field', 10, 2 );
function edit_feature_field( $term, $taxonomy ){
    $feature_term = get_term_meta( $term->term_id, 'feature_expose', true );
    $color_term = get_term_meta( $term->term_id, 'category_color', true );

    ?>
    <tr class="form-field term-group-wrap">
        <th scope="row"><label for="feature_expose"><?php _e( 'Featured Expose Position', 'datumedina' ); ?></label></th>
        <td>
			<input type="text" name="feature_expose" id="feature_expose" value="<?php echo $feature_term ?>">
        </td>
    </tr>
    <tr class="form-field term-group-wrap">
        <th scope="row"><label for="category_color"><?php _e( 'Category Color', 'datumedina' ); ?></label></th>
        <td>
            <input type="text" name="category_color" class="colorfield" id="category_color" value="<?php echo $color_term ?>">
        </td>
    </tr>
    <?php
}
add_action( 'created_category', 'save_feature_meta', 10, 2 );
function save_feature_meta( $term_id, $tt_id ){
    if( isset( $_POST['feature_expose'] ) && '' !== $_POST['feature_expose'] ){
        $feature = sanitize_title( $_POST['feature_expose'] );
        add_term_meta( $term_id, 'feature_expose', $feature, true );
    }
   if( isset( $_POST['category_color'] ) && '' !== $_POST['category_color'] ){
        $feature =$_POST['category_color'] ;
        add_term_meta( $term_id, 'category_color', $feature, true );
    }
}
add_action( 'edited_category', 'update_feature_meta', 10, 2 );
function update_feature_meta( $term_id, $tt_id ){
    if( isset( $_POST['feature_expose'] ) && '' !== $_POST['feature_expose'] ){
        $group = sanitize_title( $_POST['feature_expose'] );
        update_term_meta( $term_id, 'feature_expose', $group );
    }
    if( isset( $_POST['category_color'] ) && '' !== $_POST['category_color'] ){
        $group =$_POST['category_color'];
        update_term_meta( $term_id, 'category_color', $group );
    }
}
add_filter('manage_edit-category_columns', 'add_feature_column' );
function add_feature_column( $columns ){
    $columns['feature_order'] = __( 'Featured Order', 'datumedina' );
     $columns['category_color'] = __( 'Category Color', 'datumedina' );
    return $columns;
}
add_filter('manage_category_custom_column', 'add_category_column_content', 10, 3 );
function add_category_column_content( $content, $column_name, $term_id ){
    if( $column_name !== 'feature_order' && $column_name !== 'category_color' ){
        return $content;
    }

    $term_id = absint( $term_id );
    if( $column_name == 'feature_order' ){
    $feature_expose = get_term_meta( $term_id, 'feature_expose', true );
        if( !empty( $feature_expose ) ){
            $content .= esc_attr( $feature_expose);
        }
    }
    if( $column_name == 'category_color' ){
    $category_color = get_term_meta( $term_id, 'category_color', true );
        if( !empty( $category_color ) ){
            $content .= "<div style='width:40px;height:40px;background-color:$category_color'></div>";
        }
    }
    return $content;
}
//add_filter( 'manage_edit-category_sortable_columns', 'add_category_column_sortable' );
function add_category_column_sortable( $sortable ){
    $sortable[ 'feature_order' ] = 'feature_order';
    return $sortable;
}
?>