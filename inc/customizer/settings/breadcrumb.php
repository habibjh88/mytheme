<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\MyTheme\Customizer\Settings;

use radiustheme\MyTheme\Customizer\Controls\Customizer_Separator_Control;
use radiustheme\MyTheme\Customizer\MyTheme_Customizer;
use radiustheme\MyTheme\Customizer\Controls\Customizer_Switch_Control;
use radiustheme\MyTheme\Customizer\Controls\Customizer_Custom_Heading;
use WP_Customize_Media_Control;
use radiustheme\MyTheme\Helper;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class MyTheme_Breadcrumb_Settings extends MyTheme_Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_general_controls' ] );
	}

	public function register_general_controls( $wp_customize ) {
		$postype = Helper::get_post_types();

		// Breadcrumb
		$wp_customize->add_setting( 'breadcrumb',
			[
				'default'           => $this->defaults['breadcrumb'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'breadcrumb',
			[
				'label'   => __( 'Breadcrumb Visibility', 'mytheme' ),
				'section' => 'breadcrumb_section',
			]
		) );

		// Breadcrumb
		$wp_customize->add_setting( 'breadcrumb_style',
			[
				'default'           => $this->defaults['breadcrumb_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'breadcrumb_style', [
			'type'    => 'select',
			'section' => 'breadcrumb_section',
			'label'   => esc_html__( 'Breadcrumb', 'mytheme' ),
			'choices' => [
				'style-1' => esc_html__( 'Style 1', 'mytheme' ),
				'style-2' => esc_html__( 'Style 2', 'mytheme' ),
			],
		] );

		// Breadcrumb
		$wp_customize->add_setting( 'breadcrumb_title',
			[
				'default'           => $this->defaults['breadcrumb_title'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'breadcrumb_title', [
			'type'    => 'select',
			'section' => 'breadcrumb_section',
			'label'   => esc_html__( 'Breadcrumb Title Visibility', 'mytheme' ),
			'choices' => [
				'mytheme-page-title' => esc_html__( 'Visible', 'mytheme' ),
				'screen-reader-text'  => esc_html__( 'Hidden', 'mytheme' ),
				'disable'             => esc_html__( 'Disable', 'mytheme' ),
			],
		] );

		// Breadcrumb Image
		$wp_customize->add_setting( 'banner_image',
			[
				'default'           => $this->defaults['banner_image'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'absint',
			]
		);
		$wp_customize->add_control( new WP_Customize_Media_Control( $wp_customize, 'banner_image',
			[
				'label'         => esc_html__( 'Banner/Breadcrumb Background Image', 'mytheme' ),
				'description'   => esc_html__( 'Add image to change banner background image', 'mytheme' ),
				'section'       => 'breadcrumb_section',
				'mime_type'     => 'image',
				'button_labels' => [
					'select'       => esc_html__( 'Select File', 'mytheme' ),
					'change'       => esc_html__( 'Change File', 'mytheme' ),
					'default'      => esc_html__( 'Default', 'mytheme' ),
					'remove'       => esc_html__( 'Remove', 'mytheme' ),
					'placeholder'  => esc_html__( 'No file selected', 'mytheme' ),
					'frame_title'  => esc_html__( 'Select File', 'mytheme' ),
					'frame_button' => esc_html__( 'Choose File', 'mytheme' ),
				],
			]
		) );


		//Archive page title
		$wp_customize->add_setting( 'archive_page_title_heading',
			[
				'default'           => '',
				'sanitize_callback' => 'esc_html',
			] );

		$wp_customize->add_control( new Customizer_Custom_Heading( $wp_customize, 'archive_page_title_heading', [
			'label'    => esc_html__( 'Archive page Title', 'mytheme' ),
			'settings' => 'archive_page_title_heading',
			'section'  => 'breadcrumb_section',
		] ) );

		foreach ( $postype as $post_id => $post_title ) {

			$post_type_id = str_replace( ' ', '_', $post_id );
			//Archive page title
			$wp_customize->add_setting( $post_type_id . '_archive',
				[
					'default'           => '',
					'transport'         => 'refresh',
					'sanitize_callback' => 'rttheme_text_sanitization',
				]
			);
			$wp_customize->add_control( $post_type_id . '_archive',
				[
					'label'   => __( $post_title . ' Archive Text', 'mytheme' ),
					'section' => 'breadcrumb_section',
					'type'    => 'text',
				]
			);
		}
	}

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new MyTheme_Breadcrumb_Settings();
}
