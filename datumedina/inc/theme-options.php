﻿<?php
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
?>