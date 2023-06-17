<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme\Customizer\Settings;

use MyTheme\Customizer\Controls\Customizer_Separator_Control;
use MyTheme\Customizer\MyTheme_Customizer;
use WP_Customize_Color_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class MyTheme_Color_Settings extends MyTheme_Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_color_controls' ] );
	}

	public function register_color_controls( $wp_customize ) {
		//Site Color Settings
		//====================================================================================

		// Primary Color
		$wp_customize->add_setting( 'primary_color',
			[
				'default'           => $this->defaults['primary_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_color',
			[
				'label'   => esc_html__( 'Primary Color', 'mytheme' ),
				'section' => 'site_color_section',
			]
		) );

		// Secondary Color
		$wp_customize->add_setting( 'secondary_color',
			[
				'default'           => $this->defaults['secondary_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_color',
			[
				'label'   => esc_html__( 'Secondary Color', 'mytheme' ),
				'section' => 'site_color_section',
			]
		) );

		// Body Color
		$wp_customize->add_setting( 'body_color',
			[
				'default'           => $this->defaults['body_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'body_color',
			[
				'label'   => esc_html__( 'Body Color', 'mytheme' ),
				'section' => 'site_color_section',
			]
		) );

		//Color Separator ------------------
		$wp_customize->add_setting( 'primary_color_separator',
			[
				'default'           => '',
				'sanitize_callback' => 'esc_html',
			]
		);
		$wp_customize->add_control( new Customizer_Separator_Control( $wp_customize, 'primary_color_separator', [
			'settings' => 'primary_color_separator',
			'section'  => 'site_color_section',
		] ) );


		// Others Color Settings
		//========================

		// Primary Lighiten Color
		$wp_customize->add_setting( 'primary_lighiten',
			[
				'default'           => $this->defaults['primary_lighiten'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_lighiten',
			[
				'label'   => esc_html__( 'Primary Light Color', 'mytheme' ),
				'section' => 'site_color_section',
			]
		) );

		// Primary Lighiten2 Color
		$wp_customize->add_setting( 'primary_lighiten2',
			[
				'default'           => $this->defaults['primary_lighiten2'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_lighiten2',
			[
				'label'   => esc_html__( 'Primary Light-2 Color', 'mytheme' ),
				'section' => 'site_color_section',
			]
		) );

		// Primary Lighiten2 Color
		$wp_customize->add_setting( 'primary_lighiten3',
			[
				'default'           => $this->defaults['primary_lighiten3'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_lighiten3',
			[
				'label'       => esc_html__( 'Primary Light-3 Color', 'mytheme' ),
				'description' => esc_html__( 'This color used for light background', 'mytheme' ),
				'section'     => 'site_color_section',
			]
		) );

		// Primary Dark Color
		//====================
		$wp_customize->add_setting( 'primary_dark',
			[
				'default'           => $this->defaults['primary_dark'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'primary_dark',
			[
				'label'   => esc_html__( 'Primary Dark Color', 'mytheme' ),
				'section' => 'site_color_section',
			]
		) );


		// Header Color Settings
		//====================================================================================

		$wp_customize->add_setting( 'menu_color',
			[
				'default'           => $this->defaults['menu_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_color',
			[
				'label'   => esc_html__( 'Menu Font Color', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		// Menu Color
		$wp_customize->add_setting( 'sub_menu_color',
			[
				'default'           => $this->defaults['sub_menu_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sub_menu_color',
			[
				'label'   => esc_html__( 'Sub Menu Font Color', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		// Menu Hover Color
		$wp_customize->add_setting( 'menu_hover_color',
			[
				'default'           => $this->defaults['menu_hover_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_hover_color',
			[
				'label'   => esc_html__( 'Menu Font Hover Color', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		// Transparent Menu Color
		$wp_customize->add_setting( 'transparent_menu_color',
			[
				'default'           => $this->defaults['transparent_menu_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'transparent_menu_color',
			[
				'label'   => esc_html__( 'Transparent Menu Color', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		// Transparent Menu Color
		$wp_customize->add_setting( 'transparent_menu_color_hover',
			[
				'default'           => $this->defaults['transparent_menu_color_hover'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'transparent_menu_color_hover',
			[
				'label'   => esc_html__( 'Transparent Menu Hover Color', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		//Separator
		$wp_customize->add_setting( 'menu_sticky_separator',
			[
				'default'           => '',
				'sanitize_callback' => 'esc_html',
			] );
		$wp_customize->add_control( new Customizer_Separator_Control( $wp_customize, 'menu_sticky_separator', [
			'settings' => 'menu_sticky_separator',
			'section'  => 'header_color_section',
		] ) );

		// Menu BG Color
		$wp_customize->add_setting( 'menu_background',
			[
				'default'           => $this->defaults['menu_background'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_background',
			[
				'label'   => esc_html__( 'Menu Background Color', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		// Sticky Menu BG Color
		$wp_customize->add_setting( 'sticky_menu_background',
			[
				'default'           => $this->defaults['sticky_menu_background'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sticky_menu_background',
			[
				'label'   => esc_html__( 'Sticky Menu Background Color', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		//Separator
		$wp_customize->add_setting( 'menu_color_separator',
			[
				'default'           => '',
				'sanitize_callback' => 'esc_html',
			] );
		$wp_customize->add_control( new Customizer_Separator_Control( $wp_customize, 'menu_color_separator', [
			'settings' => 'menu_color_separator',
			'section'  => 'header_color_section',
		] ) );

		// Menu Arrow Color
		$wp_customize->add_setting( 'menu_arrow_color',
			[
				'default'           => $this->defaults['menu_arrow_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_arrow_color',
			[
				'label'   => esc_html__( 'Menu Arrow Color', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		$wp_customize->add_setting( 'menu_icon_color_separator',
			[
				'default'           => '',
				'sanitize_callback' => 'esc_html',
			] );
		$wp_customize->add_control( new Customizer_Separator_Control( $wp_customize, 'menu_icon_color_separator', [
			'settings' => 'menu_icon_color_separator',
			'section'  => 'header_color_section',
		] ) );


		// Menu Icon Color
		$wp_customize->add_setting( 'menu_icon_color',
			[
				'default'           => $this->defaults['menu_icon_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_icon_color',
			[
				'label'   => esc_html__( 'Menu Icon Color', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		// Menu Icon Color
		$wp_customize->add_setting( 'menu_icon_hover_color',
			[
				'default'           => $this->defaults['menu_icon_hover_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'menu_icon_hover_color',
			[
				'label'   => esc_html__( 'Menu Icon Hover BG', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );


		// Button Background
		$wp_customize->add_setting( 'btn_color',
			[
				'default'           => $this->defaults['btn_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'btn_color',
			[
				'label'   => esc_html__( 'Button Background', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );
		// Button Hover Background
		$wp_customize->add_setting( 'btn_hover_color',
			[
				'default'           => $this->defaults['btn_hover_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'btn_hover_color',
			[
				'label'   => esc_html__( 'Button Hover Background', 'mytheme' ),
				'section' => 'header_color_section',
			]
		) );

		// Breadcrumb Color Settings
		//====================================================================================

		$wp_customize->add_setting( 'breadcrumb_bg1',
			[
				'default'           => $this->defaults['breadcrumb_bg1'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_bg1',
			[
				'label'   => esc_html__( 'Breadcrumb Gradient Color 1', 'mytheme' ),
				'section' => 'breadcrumb_color_section',
			]
		) );

		// Breadcrumb Gradient 2
		$wp_customize->add_setting( 'breadcrumb_bg2',
			[
				'default'           => $this->defaults['breadcrumb_bg2'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_bg2',
			[
				'label'   => esc_html__( 'Breadcrumb Gradient Color 2', 'mytheme' ),
				'section' => 'breadcrumb_color_section',
			]
		) );

		// Breadcrumb Text Color
		$wp_customize->add_setting( 'breadcrumb_title_color',
			[
				'default'           => $this->defaults['breadcrumb_title_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_title_color',
			[
				'label'   => esc_html__( 'Title Color', 'mytheme' ),
				'section' => 'breadcrumb_color_section',
			]
		) );
		// Breadcrumb Text Color
		$wp_customize->add_setting( 'breadcrumb_color',
			[
				'default'           => $this->defaults['breadcrumb_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_color',
			[
				'label'   => esc_html__( 'Text Color', 'mytheme' ),
				'section' => 'breadcrumb_color_section',
			]
		) );
		// Breadcrumb Active Color
		$wp_customize->add_setting( 'breadcrumb_active_color',
			[
				'default'           => $this->defaults['breadcrumb_active_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'breadcrumb_active_color',
			[
				'label'   => esc_html__( 'Active Color', 'mytheme' ),
				'section' => 'breadcrumb_color_section',
			]
		) );

		//Footer Color
		//====================================================================================

		// Footer Background
		$wp_customize->add_setting( 'footer_bg',
			[
				'default'           => $this->defaults['footer_bg'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_bg',
			[
				'label'       => esc_html__( 'Footer Background', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #ffffff', 'mytheme' ),
			]
		) );

		// Footer Background
		$wp_customize->add_setting( 'footer2_bg_overlay',
			[
				'default'           => $this->defaults['footer2_bg_overlay'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer2_bg_overlay',
			[
				'label'       => esc_html__( 'Footer-2 Overlay Background', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #0e2e50', 'mytheme' ),
			]
		) );

		//Background Overlay
		$wp_customize->add_setting( 'footer2_bg_overlay_opacity',
			[
				'capability'        => 'edit_theme_options',
				'sanitize_callback' => 'rttheme_text_sanitization',
				'default'           => $this->defaults['footer2_bg_overlay_opacity'],
			] );

		$wp_customize->add_control( 'footer2_bg_overlay_opacity',
			[
				'type'    => 'select',
				'section' => 'footer_color_section',
				'label'   => __( 'Footer 2 BG Opacity', 'mytheme' ),
				'choices' => [
					'0.1' => __( '0.1', 'mytheme' ),
					'0.2' => __( '0.2', 'mytheme' ),
					'0.3' => __( '0.3', 'mytheme' ),
					'0.4' => __( '0.4', 'mytheme' ),
					'0.5' => __( '0.5', 'mytheme' ),
					'0.6' => __( '0.6', 'mytheme' ),
					'0.7' => __( '0.7', 'mytheme' ),
					'0.8' => __( '0.8', 'mytheme' ),
					'0.9' => __( '0.9', 'mytheme' ),
					'1'   => __( '1', 'mytheme' ),
				],
			] );


		// Footer Text Color
		$wp_customize->add_setting( 'footer_text_color',
			[
				'default'           => $this->defaults['footer_text_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_color',
			[
				'label'       => esc_html__( 'Footer Text color', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #788593', 'mytheme' ),
			]
		) );

		// Footer Text Color
		$wp_customize->add_setting( 'footer2_text_color',
			[
				'default'           => $this->defaults['footer2_text_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer2_text_color',
			[
				'label'       => esc_html__( 'Footer-2 Text color', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #788593', 'mytheme' ),
			]
		) );

		// Footer Text Color
		$wp_customize->add_setting( 'footer_text_hover',
			[
				'default'           => $this->defaults['footer_text_hover'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_text_hover',
			[
				'label'       => esc_html__( 'Footer Link Hover Color', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #3270fc', 'mytheme' ),
			]
		) );

		// Footer-2 Text Color
		$wp_customize->add_setting( 'footer2_text_hover',
			[
				'default'           => $this->defaults['footer2_text_hover'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer2_text_hover',
			[
				'label'       => esc_html__( 'Footer-2 Link Hover Color', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #3270fc', 'mytheme' ),
			]
		) );

		// Footer Widget Title Color
		$wp_customize->add_setting( 'footer_title_color',
			[
				'default'           => $this->defaults['footer_title_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_title_color',
			[
				'label'       => esc_html__( 'Footer Widget Title Color', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #144273', 'mytheme' ),
			]
		) );

		// Footer-2 Widget Title Color
		$wp_customize->add_setting( 'footer2_title_color',
			[
				'default'           => $this->defaults['footer2_title_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer2_title_color',
			[
				'label'       => esc_html__( 'Footer-2 Widget Title Color', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #144273', 'mytheme' ),
			]
		) );

		// Widget Title Border
		$wp_customize->add_setting( 'footer_title_border_color',
			[
				'default'           => $this->defaults['footer_title_border_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_title_border_color',
			[
				'label'       => esc_html__( 'Widget Title Border Color', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #00c194', 'mytheme' ),
			]
		) );


		// icon and circle color
		$wp_customize->add_setting( 'footer_icon_circle_color',
			[
				'default'           => $this->defaults['footer_icon_circle_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer_icon_circle_color',
			[
				'label'   => esc_html__( 'Footer Icon & Circle Color', 'mytheme' ),
				'section' => 'footer_color_section',
			]
		) );

		// icon and circle color
		$wp_customize->add_setting( 'footer2_icon_circle_color',
			[
				'default'           => $this->defaults['footer2_icon_circle_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer2_icon_circle_color',
			[
				'label'   => esc_html__( 'Footer-2 Icon & Circle Color', 'mytheme' ),
				'section' => 'footer_color_section',
			]
		) );

		$wp_customize->add_setting( 'footer_color_separator',
			[
				'default'           => '',
				'sanitize_callback' => 'esc_html',
			] );
		$wp_customize->add_control( new Customizer_Separator_Control( $wp_customize, 'footer_color_separator', [
			'settings' => 'footer_color_separator',
			'section'  => 'footer_color_section',
		] ) );


		// Copyright Background
		$wp_customize->add_setting( 'copyright_bg',
			[
				'default'           => $this->defaults['copyright_bg'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
				'description'       => esc_html__( 'Default color: #f2f4f7', 'mytheme' ),
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_bg',
			[
				'label'       => esc_html__( 'Copyright Background', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #f2f4f7', 'mytheme' ),
			]
		) );

		// Footer 2 Copyright Background
		$wp_customize->add_setting( 'footer2_copyright_bg',
			[
				'default'           => $this->defaults['footer2_copyright_bg'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
				'description'       => esc_html__( 'Default color: #f2f4f7', 'mytheme' ),
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer2_copyright_bg',
			[
				'label'       => esc_html__( 'Footer-2 Copyright Background', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #082039', 'mytheme' ),
			]
		) );

		// Copyright Menu Color
		$wp_customize->add_setting( 'copyright_menu_color',
			[
				'default'           => $this->defaults['copyright_menu_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_menu_color',
			[
				'label'       => esc_html__( 'Copyright Menu', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #51667c', 'mytheme' ),
			]
		) );

		// Copyright Text Color
		$wp_customize->add_setting( 'copyright_text_color',
			[
				'default'           => $this->defaults['copyright_text_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'copyright_text_color',
			[
				'label'       => esc_html__( 'Copyright Text Color', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #51667c', 'mytheme' ),
			]
		) );

		// Copyright Text Footer 2
		$wp_customize->add_setting( 'footer2_copyright_text_color',
			[
				'default'           => $this->defaults['footer2_copyright_text_color'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'sanitize_hex_color',
			]
		);
		$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'footer2_copyright_text_color',
			[
				'label'       => esc_html__( 'Footer-2 Copyright Text color', 'mytheme' ),
				'section'     => 'footer_color_section',
				'description' => esc_html__( 'Default color: #51667c', 'mytheme' ),
			]
		) );
	}

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new MyTheme_Color_Settings();
}