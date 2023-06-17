<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme\Customizer\Settings;

use MyTheme\Customizer\MyTheme_Customizer;
use MyTheme\Customizer\Controls\Customizer_Switch_Control;
use MyTheme\Customizer\Controls\Customizer_Separator_Control;
use WP_Customize_Media_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class MyTheme_General_Settings extends MyTheme_Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_general_controls' ] );
	}

	public function register_general_controls( $wp_customize ) {
		// Main Logo
		$wp_customize->add_setting( 'logo',
			[
				'default'           => $this->defaults['logo'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'logo',
			[
				'label'         => __( 'Main Logo', 'mytheme' ),
				'description'   => esc_html__( 'Add site main logo', 'mytheme' ),
				'section'       => 'general_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select Logo', 'mytheme' ),
					'change'       => esc_html__( 'Change Logo', 'mytheme' ),
					'default'      => esc_html__( 'Default', 'mytheme' ),
					'remove'       => esc_html__( 'Remove', 'mytheme' ),
					'placeholder'  => esc_html__( 'No file selected', 'mytheme' ),
					'frame_title'  => esc_html__( 'Select File', 'mytheme' ),
					'frame_button' => esc_html__( 'Choose File', 'mytheme' ),
				],
			]
		) );

		$wp_customize->selective_refresh->add_partial( 'logo', [
			'selector'        => '.site-logo',
			'render_callback' => '__return_false',
		] );

		// Transparent Header Logo
		$wp_customize->add_setting( 'logo_light',
			[
				'default'           => $this->defaults['logo_light'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'logo_light',
			[
				'label'         => __( 'Light Logo', 'mytheme' ),
				'description'   => esc_html__( 'Add logo for transparent header', 'mytheme' ),
				'section'       => 'general_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select Logo', 'mytheme' ),
					'change'       => esc_html__( 'Change Logo', 'mytheme' ),
					'default'      => esc_html__( 'Default', 'mytheme' ),
					'remove'       => esc_html__( 'Remove', 'mytheme' ),
					'placeholder'  => esc_html__( 'No file selected', 'mytheme' ),
					'frame_title'  => esc_html__( 'Select File', 'mytheme' ),
					'frame_button' => esc_html__( 'Choose File', 'mytheme' ),
				],
			]
		) );

		// Mobile Logo
		$wp_customize->add_setting( 'mobile_logo',
			[
				'default'           => $this->defaults['mobile_logo'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'mobile_logo',
			[
				'label'         => esc_html__( 'Mobile Logo', 'mytheme' ),
				'description'   => esc_html__( 'Add logo for mobile header', 'mytheme' ),
				'section'       => 'general_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select Logo', 'mytheme' ),
					'change'       => esc_html__( 'Change Logo', 'mytheme' ),
					'default'      => esc_html__( 'Default', 'mytheme' ),
					'remove'       => esc_html__( 'Remove', 'mytheme' ),
					'placeholder'  => esc_html__( 'No file selected', 'mytheme' ),
					'frame_title'  => esc_html__( 'Select File', 'mytheme' ),
					'frame_button' => esc_html__( 'Choose File', 'mytheme' ),
				],
			]
		) );

		//Logo Width Height
		$wp_customize->add_setting( 'main_logo_width_height',
			[
				'default'           => $this->defaults['main_logo_width_height'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'main_logo_width_height',
			[
				'label'           => __( 'Logo max width / max height', 'mytheme' ),
				'section'         => 'general_section',
				'type'            => 'text',
				'description'     => __( 'Enter logo width height by comma separator. Eg: 196px,60px', 'mytheme' ),
				'input_attrs'     => [
					'placeholder' => __( '196px,60px', 'mytheme' ),
				],
			]
		);
		/**
		 * Separator
		 */
		$wp_customize->add_setting( 'separator_general1', [
			'default'           => '',
			'sanitize_callback' => 'esc_html',
		] );
		$wp_customize->add_control( new Customizer_Separator_Control( $wp_customize, 'separator_general1', [
			'settings' => 'separator_general1',
			'section'  => 'general_section',
		] ) );


		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting( 'preloader',
			[
				'default'           => $this->defaults['preloader'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'preloader',
			[
				'label'   => esc_html__( 'Preloader', 'mytheme' ),
				'section' => 'general_section',
			]
		) );

		// Preloader Image
		$wp_customize->add_setting( 'preloader_image',
			[
				'default'           => $this->defaults['preloader_image'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'preloader_image',
			[
				'label'         => esc_html__( 'Preloader Image', 'mytheme' ),
				'description'   => esc_html__( 'Add preloader image to change default image', 'mytheme' ),
				'section'       => 'general_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select Image', 'mytheme' ),
					'change'       => esc_html__( 'Change Image', 'mytheme' ),
					'default'      => esc_html__( 'Default', 'mytheme' ),
					'remove'       => esc_html__( 'Remove', 'mytheme' ),
					'placeholder'  => esc_html__( 'No file selected', 'mytheme' ),
					'frame_title'  => esc_html__( 'Select File', 'mytheme' ),
					'frame_button' => esc_html__( 'Choose File', 'mytheme' ),
				],
			]
		) );

		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting( 'sticky_sidebar',
			[
				'default'           => $this->defaults['sticky_sidebar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'sticky_sidebar',
			[
				'label'   => esc_html__( 'Sticky Sidebar', 'mytheme' ),
				'section' => 'general_section',
			]
		) );

		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting( 'back_to_top',
			[
				'default'           => $this->defaults['back_to_top'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'back_to_top',
			[
				'label'   => esc_html__( 'Back to Top', 'mytheme' ),
				'section' => 'general_section',
			]
		) );


		// Add our Checkbox switch setting and control for opening URLs in a new tab
		$wp_customize->add_setting( 'remove_admin_bar',
			[
				'default'           => $this->defaults['remove_admin_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'remove_admin_bar',
			[
				'label'   => esc_html__( 'Remove Admin Bar', 'mytheme' ),
				'section' => 'general_section',
				'description'   => esc_html__( 'This option not work for administrator users.', 'mytheme' ),
			]
		) );

	}

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new MyTheme_General_Settings();
}
