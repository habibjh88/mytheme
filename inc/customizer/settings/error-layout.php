<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme\Customizer\Settings;

use MyTheme\Customizer\MyTheme_Customizer;
use MyTheme\Helper;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class MyTheme_Error_Layout_Settings extends MyTheme_Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Register Page Controls
		add_action( 'customize_register', [ $this, 'register_error_layout_controls' ] );
	}

	public function register_error_layout_controls( $wp_customize ) {
		// Top bar
		$wp_customize->add_setting( 'error_top_bar',
			[
				'default'           => $this->defaults['error_top_bar'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_top_bar', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Top Bar', 'mytheme' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'mytheme' ),
				'on'      => esc_html__( 'Enable', 'mytheme' ),
				'off'     => esc_html__( 'Disable', 'mytheme' ),
			],
		] );

		//Menu Alignment
		$wp_customize->add_setting( 'error_menu_alignment', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['menu_alignment'],
		] );

		$wp_customize->add_control( 'error_menu_alignment', [
			'type'    => 'select',
			'section' => 'error_layout_section', // Add a default or your own section
			'label'   => __( 'Menu Alignment', 'mytheme' ),
			'choices' => [
				'default'     => __( 'Default', 'mytheme' ),
				'menu-left'   => __( 'Left Alignment', 'mytheme' ),
				'menu-center' => __( 'Center Alignment', 'mytheme' ),
				'menu-right'  => __( 'Right Alignment', 'mytheme' ),
			],
		] );

		//Header width
		$wp_customize->add_setting( 'error_header_width', [
			'capability'        => 'edit_theme_options',
			'sanitize_callback' => 'rttheme_text_sanitization',
			'default'           => $this->defaults['error_header_width'],
		] );

		$wp_customize->add_control( 'error_header_width', [
			'type'    => 'select',
			'section' => 'error_layout_section', // Add a default or your own section
			'label'   => __( 'Header Width', 'mytheme' ),
			'choices' => [
				'default'   => __( 'Default', 'mytheme' ),
				'box-width' => __( 'Box width', 'mytheme' ),
				'fullwidth' => __( 'Fullwidth', 'mytheme' ),
			],
		] );

		// Transparent Header
		$wp_customize->add_setting( 'error_tr_header',
			[
				'default'           => $this->defaults['error_tr_header'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_tr_header', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Transparent Header', 'mytheme' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'mytheme' ),
				'on'      => esc_html__( 'Enable', 'mytheme' ),
				'off'     => esc_html__( 'Disable', 'mytheme' ),
			],
		] );
		// Breadcrumb
		$wp_customize->add_setting( 'error_breadcrumb',
			[
				'default'           => $this->defaults['error_breadcrumb'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_breadcrumb', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Breadcrumb', 'mytheme' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'mytheme' ),
				'on'      => esc_html__( 'Enable', 'mytheme' ),
				'off'     => esc_html__( 'Disable', 'mytheme' ),
			],
		] );
		// Padding Top
		$wp_customize->add_setting( 'error_padding_top',
			[
				'default'           => $this->defaults['error_padding_top'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_padding_top',
			[
				'label'       => esc_html__( 'Content Padding Top', 'mytheme' ),
				'description' => esc_html__( '404 Page Content Padding Top ', 'mytheme' ),
				'section'     => 'error_layout_section',
				'type'        => 'text',
			]
		);
		// Padding Bottom
		$wp_customize->add_setting( 'error_padding_bottom',
			[
				'default'           => $this->defaults['error_padding_bottom'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_padding_bottom',
			[
				'label'       => esc_html__( 'Content Padding Bottom', 'mytheme' ),
				'description' => esc_html__( '404 Page Content Padding Bottom', 'mytheme' ),
				'section'     => 'error_layout_section',
				'type'        => 'text',
			]
		);
		// Footer Layout
		$wp_customize->add_setting( 'error_footer_style',
			[
				'default'           => $this->defaults['error_footer_style'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_text_sanitization',
			]
		);
		$wp_customize->add_control( 'error_footer_style', [
			'type'    => 'select',
			'section' => 'error_layout_section',
			'label'   => esc_html__( 'Footer Layout', 'mytheme' ),
			'choices' => [
				'default' => esc_html__( 'Default', 'mytheme' ),
				'1'       => esc_html__( 'Layout 1', 'mytheme' ),
				'2'       => esc_html__( 'Layout 2', 'mytheme' ),
			],
		] );
	}

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new MyTheme_Error_Layout_Settings();
}
