<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\MyTheme\Customizer\Settings;

use radiustheme\MyTheme\Customizer\Controls\Customizer_Image_Radio_Control;
use radiustheme\MyTheme\Customizer\MyTheme_Customizer;
use radiustheme\MyTheme\Customizer\Controls\Customizer_Switch_Control;
use WP_Customize_Media_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class MyTheme_Footer_Settings extends MyTheme_Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_footer_controls' ] );
	}

	public function register_footer_controls( $wp_customize ) {
		// Footer Style
		$wp_customize->add_setting( 'footer_style',
			[
				'default'           => $this->defaults['footer_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_radio_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Image_Radio_Control( $wp_customize, 'footer_style',
			[
				'label'       => __( 'Footer Layout', 'mytheme' ),
				'description' => esc_html__( 'Select the header style', 'mytheme' ),
				'section'     => 'footer_section',
				'choices'     => [
					'1' => [
						'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-1.png',
						'name'  => __( 'Style 1', 'mytheme' ),
					],
					'2' => [
						'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/footer-2.png',
						'name'  => __( 'Style 2', 'mytheme' ),
					],
				],
			]
		) );
		// Footer Border
		$wp_customize->add_setting( 'footer_border',
			[
				'default'           => $this->defaults['footer_border'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'footer_border',
			[
				'label'   => __( 'Footer Border Top', 'mytheme' ),
				'section' => 'footer_section',
			]
		) );

		// Copyright Area Control
		$wp_customize->add_setting( 'copyright_area',
			[
				'default'           => $this->defaults['copyright_area'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'copyright_area',
			[
				'label'   => __( 'Display Copyright Area', 'mytheme' ),
				'section' => 'footer_section',
			]
		) );
		// Copyright Text
		$wp_customize->add_setting( 'copyright_text',
			[
				'default'           => $this->defaults['copyright_text'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_textarea_field',
			]
		);
		$wp_customize->add_control( 'copyright_text',
			[
				'label'           => __( 'Copyright Text', 'mytheme' ),
				'section'         => 'footer_section',
				'type'            => 'textarea',
				'active_callback' => 'rttheme_is_copyright_area_enabled',
			]
		);

		// Footer Background Image
		$wp_customize->add_setting( 'footer_bg_image',
			[
				'default'           => $this->defaults['footer_bg_image'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'footer_bg_image',
			[
				'label'         => __( 'Footer-2 Background Image', 'mytheme' ),
				'description'   => esc_html__( 'This background will work only for Footer-2. Always choose a dark background for best view.', 'mytheme' ),
				'section'       => 'footer_section',
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
	}

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new MyTheme_Footer_Settings();
}
