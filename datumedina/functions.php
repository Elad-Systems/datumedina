<?php
include('inc/functions_general.php');
include('inc/theme-taxonomy.php');
//include('inc/theme-options.php');
include('inc/tax-meta-fields.php');
include('inc/functions_contact.php');
include('inc/load-posts.php');
include('inc/archive-load-posts.php');
include('inc/clean-theme.php');
include('inc/functions_homepage.php');

if ( ! function_exists( 'theme_setup' ) ) :
function theme_setup() {
    load_theme_textdomain( 'datumedina');
    //load_theme_textdomain( 'datumedina',get_template_directory() . '/languages' );

    add_filter('widget_text','do_shortcode');

    /*
     * Let WordPress manage the document title.
     * By adding theme support, we declare that this theme does not use a
     * hard-coded <title> tag in the document head, and expect WordPress to
     * provide it for us.
     */
    add_theme_support( 'title-tag' );
    add_theme_support( 'yoast-seo-breadcrumbs' );

    /*
     * Enable support for Post Thumbnails on posts and pages.
     *
     * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
     */
    add_theme_support( 'post-thumbnails' );
    set_post_thumbnail_size( 1200, 9999 );
    add_image_size( 'contact_featured_image_size', 100, 100 );
    add_image_size( 'post_featured_image_size', 260, 145,true );

    // This theme uses wp_nav_menu() in two locations.
    register_nav_menus( array(
        'main-menu' => __( 'Main Menu', 'datumedina' ),
        'side-menu' => __( 'Side Menu', 'datumedina' ),
        'footer-menu'  => __( 'Footer Menu', 'datumedina' ),
        'footer-utility-menu'  => __( 'Footer Utility Menu', 'datumedina' ),
    ) );

    add_theme_support( 'html5', array('search-form','comment-form','comment-list','gallery','caption'));
}
endif; // theme_setup
add_action( 'after_setup_theme', 'theme_setup' );

function load_theme_assets(){
    wp_enqueue_script( 'bootstrap-js', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js', array('jquery'), true); // all the bootstrap javascript goodness
    wp_enqueue_script( 'general-js', get_stylesheet_directory_uri() . '/js/general.js', array(), true);
    if ( is_front_page() ){
            wp_enqueue_script( 'hp-general-js', get_stylesheet_directory_uri() . '/js/homepage.js', array(), rand(1,200));
            wp_localize_script( 'hp-general-js', 'homeparam', array('hpmore' =>  __('More Categories','datumedina') , 'hpless' =>  __('Less Categories ','datumedina')) );
    }
    if ( is_archive() ){
            wp_enqueue_script( 'archive-general-js', get_stylesheet_directory_uri() . '/js/archive.js', array(), rand(1,200));
            wp_localize_script( 'archive-general-js', 'archiveparam', array('archivemore' =>  __('Read More','datumedina') , 'archiveless' =>  __('Read Less','datumedina')) );
    }

    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style( 'bootstrap', '//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' );
    wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/css/style.css' );
    wp_enqueue_style( 'responsive-style', get_stylesheet_directory_uri() . '/css/responsive.css' );
    wp_enqueue_style( 'jquery-ui-datepicker-style' , '//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/smoothness/jquery-ui.css');
    if(is_rtl()) wp_enqueue_style( 'main-style-rtl', get_stylesheet_directory_uri() . '/css/rtl.css' );
}
add_action( 'wp_enqueue_scripts', 'load_theme_assets' );

function custom_excerpt_length( $length ) {
    return 10;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

add_action('page_side','display_side_menu');
function display_side_menu(){
    if(is_page()){
            //$current_page_id = get_the_ID();
            //if(get_post_meta(get_the_ID(), '_sogo_display-side-menu', true))
            //exit;
            get_template_part('inc/side','menu');
    }
}
add_action('archive_side','display_side_menu_archive');
function display_side_menu_archive(){
            get_template_part('inc/side','menu');
}
add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Default Sidebar', 'datumedina' ),
        'id' => 'default-sidebar',
        'description' => __( 'Widgets in this area will be shown on the footer of site.', 'datumedina'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Homepage Slider Sidebar', 'datumedina' ),
        'id' => 'home-page-slider-sidebar',
        'description' => __( 'Widgets in this area will be shown on The Top Slider Homepage.', 'datumedina'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Homepage Banners Sidebar', 'datumedina' ),
        'id' => 'home-page-sidebar',
        'description' => __( 'Widgets in this area will be shown on The Top Homepage.', 'datumedina'),
        'before_widget' => '<div id="%1$s" class="widget col-md-4 col-sm-12 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );
    register_sidebar( array(
        'name' => __( 'Homepage Right Sidebar', 'datumedina' ),
        'id' => 'home-right-sidebar',
        'description' => __( 'Widgets in this area will be shown on the Right Side Of Homepage.', 'datumedina' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Homepage Left Sidebar', 'datumedina' ),
        'id' => 'home-left-sidebar',
        'description' => __( 'Widgets in this area will be shown on the Left Side Of Homepage.', 'datumedina' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Contact Sidebar', 'datumedina' ),
        'id' => 'contact-sidebar',
        'description' => __( 'Widgets in this area will be shown on the Contact Page.', 'datumedina' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );
            register_sidebar( array(
        'name' => __( 'Footer Sidebar', 'datumedina' ),
        'id' => 'footer-sidebar',
        'description' => __( 'Widgets in this area will be shown on the footer of site.', 'datumedina' ),
        'before_widget' => '<div id="%1$s" class="widget col-md-4 %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="widgettitle">',
        'after_title'   => '</h3>',
    ) );
}
add_filter( 'wp_nav_menu_objects', 'my_wp_nav_menu_objects_sub_menu', 10, 2 );
function my_wp_nav_menu_objects_sub_menu( $sorted_menu_items, $args ) {
    if($args->theme_location != 'side-menu') return $sorted_menu_items;

   if ( isset( $args->sub_menu ) ) {
   $root_id = 0;
    foreach ( $sorted_menu_items as $menu_item ) {
      if ( $menu_item->current ) {
        $found_root=true;
        $root_id = ( $menu_item->menu_item_parent ) ? $menu_item->menu_item_parent : $menu_item->ID;
      }
    }
    if(!$found_root) return;
    $menu_item_parents = array();
    foreach ( $sorted_menu_items as $key => $item ) {
    if (!(($item->menu_item_parent == $root_id)||($item->ID == $root_id))){
        unset( $sorted_menu_items[$key] );
      }
    }
    if(count( (array)$sorted_menu_items) == 1) return;
     return $sorted_menu_items;
  }
return ;
}

/**
 * Generated by the WordPress Option Page generator
 * at http://jeremyhixon.com/wp-tools/option-page/
 */

class ThemeOptions {
    private $theme_options_options;

    public function __construct() {
        add_action( 'admin_menu', array( $this, 'theme_options_add_plugin_page' ) );
        add_action( 'admin_init', array( $this, 'theme_options_page_init' ) );
    }

    public function theme_options_add_plugin_page() {
        add_menu_page(
            __( 'Theme Options', 'datumedina' ), // page_title
            __( 'Theme Options', 'datumedina' ), // menu_title
            'manage_options', // capability
            'theme-options', // menu_slug
            array( $this, 'theme_options_create_admin_page' ), // function
            'dashicons-admin-generic', // icon_url
            76 // position
        );
    }

    public function theme_options_create_admin_page() {
        $this->theme_options_options = get_option( 'theme_options_option_name' ); ?>

        <div class="wrap">
            <h2>Theme Options</h2>
            <p></p>
            <?php settings_errors(); ?>
            <form method="post" action="options.php">
                <?php
                    settings_fields( 'theme_options_option_group' );
                    do_settings_sections( 'theme-options-admin' );
                    submit_button();
                ?>
            </form>
        </div>
    <?php }

    public function theme_options_page_init() {
        register_setting(
            'theme_options_option_group', // option_group
            'theme_options_option_name', // option_name
            array( $this, 'theme_options_sanitize' ) // sanitize_callback
        );
        // first section
        add_settings_section(
            'theme_options_homepage_section', // id
            __('Homepage Properties','datumedina'), // title
            array( $this, 'theme_options_homepage_info' ), // callback
            'theme-options-admin' // page
        );
        add_settings_field(
            'homepage_max_featured_categories_0', // id
            __('Homepage Max Featured Categories','datumedina'), // title
            array( $this, 'homepage_max_featured_categories_0_callback' ), // callback
            'theme-options-admin', // page
            'theme_options_homepage_section' // section
        );
        add_settings_field(
            'information_center_0', // id
            __('Information center page id','datumedina'), // title
            array( $this, 'information_center_0_callback' ), // callback
            'theme-options-admin', // page
            'theme_options_homepage_section' // section
        );
        // second section
        add_settings_section(
            'theme_options_setting_section', // id
            __('Social Networks','datumedina'), // title
            array( $this, 'theme_options_section_info' ), // callback
            'theme-options-admin' // page
        );

        add_settings_field(
            'youtube_0', // id
            __('YouTube','datumedina'), // title
            array( $this, 'youtube_0_callback' ), // callback
            'theme-options-admin', // page
            'theme_options_setting_section' // section
        );

        add_settings_field(
            'facebook_1', // id
            __('facebook','datumedina'), // title
            array( $this, 'facebook_1_callback' ), // callback
            'theme-options-admin', // page
            'theme_options_setting_section' // section
        );

        add_settings_field(
            'twitter_2', // id
            __('Twitter','datumedina'), // title
            array( $this, 'twitter_2_callback' ), // callback
            'theme-options-admin', // page
            'theme_options_setting_section' // section
        );

        add_settings_field(
            'google_3', // id
            __('Google+','datumedina'), // title
            array( $this, 'google_3_callback' ), // callback
            'theme-options-admin', // page
            'theme_options_setting_section' // section
        );
    }

    public function theme_options_sanitize($input) {
        $sanitary_values = array();
        if ( isset( $input['youtube_0'] ) ) {
            $sanitary_values['youtube_0'] = sanitize_text_field( $input['youtube_0'] );
        }

        if ( isset( $input['facebook_1'] ) ) {
            $sanitary_values['facebook_1'] = sanitize_text_field( $input['facebook_1'] );
        }

        if ( isset( $input['twitter_2'] ) ) {
            $sanitary_values['twitter_2'] = sanitize_text_field( $input['twitter_2'] );
        }

        if ( isset( $input['google_3'] ) ) {
            $sanitary_values['google_3'] = sanitize_text_field( $input['google_3'] );
        }

        if ( isset( $input['homepage_max_featured_categories_0'] ) ) {
            $sanitary_values['homepage_max_featured_categories_0'] = sanitize_text_field( $input['homepage_max_featured_categories_0'] );
        }
        if ( isset( $input['information_center_0'] ) ) {
            $sanitary_values['information_center_0'] = sanitize_text_field( $input['information_center_0'] );
        }
        return $sanitary_values;
    }

    public function theme_options_section_info() {

    }

    public function youtube_0_callback() {

        printf(
            '<input class="regular-text" type="text" name="theme_options_option_name[youtube_0]" id="youtube_0" value="%s">',
            isset( $this->theme_options_options['youtube_0'] ) ? esc_attr( $this->theme_options_options['youtube_0']) : ''
        );
    }

    public function facebook_1_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme_options_option_name[facebook_1]" id="facebook_1" value="%s">',
            isset( $this->theme_options_options['facebook_1'] ) ? esc_attr( $this->theme_options_options['facebook_1']) : ''
        );
    }

    public function twitter_2_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme_options_option_name[twitter_2]" id="twitter_2" value="%s">',
            isset( $this->theme_options_options['twitter_2'] ) ? esc_attr( $this->theme_options_options['twitter_2']) : ''
        );
    }

    public function google_3_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme_options_option_name[google_3]" id="google_3" value="%s">',
            isset( $this->theme_options_options['google_3'] ) ? esc_attr( $this->theme_options_options['google_3']) : ''
        );
    }

    public function homepage_max_featured_categories_0_callback() {
        printf(
            '<input class="regular-text" type="text" name="theme_options_option_name[homepage_max_featured_categories_0]" id="homepage_max_featured_categories_0" value="%s">',
            isset( $this->theme_options_options['homepage_max_featured_categories_0'] ) ? esc_attr( $this->theme_options_options['homepage_max_featured_categories_0']) : ''
        );
    }
    public function information_center_0_callback() {
        wp_dropdown_pages( array('selected'  => $this->theme_options_options['information_center_0']) );
        /*printf(
            '<input class="regular-text" type="text" name="theme_options_option_name[information_center_0]" id="information_center_0" value="%s">',
            isset( $this->theme_options_options['information_center_0'] ) ? esc_attr( $this->theme_options_options['information_center_0']) : ''
        );*/
    }
    //information_center_0
}
if ( is_admin() )
    $theme_options = new ThemeOptions();

/*
 * Use the classic editor
 * */
add_filter('use_block_editor_for_post_type', 'completly_disable_block_editor');
function completly_disable_block_editor($use_block_editor) {
    return false;
}

?>