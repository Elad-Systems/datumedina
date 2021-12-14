<div class='info-search'>
<form method="post" name='info-search' action="">
    <input id='free-search' type='text' name='s' class='free-search' value='<?php echo $_REQUEST['s'] ?>' />
     <?php

     $args = array(
        'show_option_all'    => '',
        'show_option_none'   => __('All Post Content','datumedina'),
        'option_none_value'  => '-1',
        'orderby'            => 'ID',
        'order'              => 'ASC',
        'show_count'         => 0,
        'hide_empty'         => 0,
        'child_of'           => 0,
        'exclude'            => '',
        'include'            => '',
        'echo'               => 1,
        'selected'           => $_REQUEST['contentscategories'],
        'hierarchical'       => 0,
        'name'               => 'contentscategories',
        'id'                 => '',
        'class'              => 'contentscategories',
        'depth'              => 0,
        'tab_index'          => 0,
        'taxonomy'           => 'contentscategories',
        'hide_if_empty'      => false,
        'value_field'        => 'term_id',
    );
     wp_dropdown_categories( $args ); ?>
     <input id='start-date' type='text' name='start-date' class='start-date datepicker' value='<?php echo $_REQUEST['start-date'] ?>' placeholder="<?php _e('From-','datumedina') ?>"/>
     
     <input id='end-date' type='text' name='end-date' class='end-date datepicker' value='<?php echo $_REQUEST['end-date'] ?>' placeholder="<?php _e('To-','datumedina') ?>" />
    <?php echo get_terms_chekboxes('post_tag', $args = array('hide_empty'=>false));?>
    <input type='submit' name='send-info-form' value="<?php _e('Search','datumedina');?>"/>
</form>
</div>
