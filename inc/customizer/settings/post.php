<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme\Customizer\Settings;

use MyTheme\Customizer\MyTheme_Customizer;
use MyTheme\Customizer\Controls\Customizer_Switch_Control;
use MyTheme\Customizer\Controls\Customizer_Multiple_Checkbox_Control;
use WP_Customize_Control;

/**
 * Adds the individual sections, settings, and controls to the theme customizer
 */
class MyTheme_Single_Post_Settings extends MyTheme_Customizer {

	public function __construct() {
		parent::instance();
		$this->populated_default_data();
		// Add Controls
		add_action( 'customize_register', [ $this, 'register_single_post_controls' ] );
	}

	public function register_single_post_controls( $wp_customize ) {
		$wp_customize->add_setting( 'post_date',
			[
				'default'           => $this->defaults['post_date'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_date',
			[
				'label'   => __( 'Display Date', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );

		$wp_customize->add_setting( 'post_author_name',
			[
				'default'           => $this->defaults['post_author_name'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_author_name',
			[
				'label'   => __( 'Display Author Name', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );

		$wp_customize->add_setting( 'post_comment_num',
			[
				'default'           => $this->defaults['post_comment_num'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_comment_num',
			[
				'label'   => __( 'Display Comment Count', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );

		$wp_customize->add_setting( 'post_cats',
			[
				'default'           => $this->defaults['post_cats'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_cats',
			[
				'label'   => __( 'Display Category', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );

		$wp_customize->add_setting( 'post_details_related_section',
			[
				'default'           => $this->defaults['post_details_related_section'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_details_related_section',
			[
				'label'   => __( 'Display Related Posts', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );

		$wp_customize->add_setting( 'post_details_reading_time',
			[
				'default'           => $this->defaults['post_details_reading_time'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_details_reading_time',
			[
				'label'   => __( 'Display Post Reading Time', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );

		$wp_customize->add_setting( 'post_tag',
			[
				'default'           => $this->defaults['post_tag'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_tag',
			[
				'label'   => __( 'Display Tag', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );

		$wp_customize->add_setting( 'post_social_icon',
			[
				'default'           => $this->defaults['post_social_icon'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_social_icon',
			[
				'label'   => __( 'Display Social Share', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );

		//Single post navigation
		$wp_customize->add_setting( 'post_navigation',
			[
				'default'           => $this->defaults['post_navigation'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_navigation',
			[
				'label'   => __( 'Display Navigation', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );

		$wp_customize->add_setting( 'post_author_about',
			[
				'default'           => $this->defaults['post_author_about'],
				'transport'         => 'refresh',
				'sanitize_callback' => 'rttheme_switch_sanitization',
			]
		);
		$wp_customize->add_control( new Customizer_Switch_Control( $wp_customize, 'post_author_about',
			[
				'label'   => __( 'Display Author About', 'mytheme' ),
				'section' => 'single_post_section',
			]
		) );
		// Social Share Facebook
		$wp_customize->add_setting( 'social_facebook', [
			'default'           => $this->defaults['social_facebook'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_facebook',
			[
				'label'   => __( 'Hide Facebook?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );
		// Social Share Twitter
		$wp_customize->add_setting( 'social_twitter', [
			'default'           => $this->defaults['social_twitter'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_twitter',
			[
				'label'   => __( 'Hide Twitter?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );
		// Social Share Linkedin
		$wp_customize->add_setting( 'social_linkedin', [
			'default'           => $this->defaults['social_linkedin'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_linkedin',
			[
				'label'   => __( 'Hide Linkedin?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );
		// Social Share Pinterest
		$wp_customize->add_setting( 'social_pinterest', [
			'default'           => $this->defaults['social_pinterest'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_pinterest',
			[
				'label'   => __( 'Hide Pinterest?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );
		// Social Share Tumblr
		$wp_customize->add_setting( 'social_tumblr', [
			'default'           => $this->defaults['social_tumblr'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_tumblr',
			[
				'label'   => __( 'Hide Tumblr?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );
		// Social Share Reddit
		$wp_customize->add_setting( 'social_reddit', [
			'default'           => $this->defaults['social_reddit'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_reddit',
			[
				'label'   => __( 'Hide Reddit?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );
		// Social Share VK
		$wp_customize->add_setting( 'social_vk', [
			'default'           => $this->defaults['social_vk'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_vk',
			[
				'label'   => __( 'Hide VK?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );

		// Social Share whatsapp
		$wp_customize->add_setting( 'social_whatsapp', [
			'default'           => $this->defaults['social_whatsapp'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_whatsapp',
			[
				'label'   => __( 'Hide Whatsapp?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );

		// Social Share telegram
		$wp_customize->add_setting( 'social_telegram', [
			'default'           => $this->defaults['social_telegram'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_telegram',
			[
				'label'   => __( 'Hide Telegram?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );

		// Social Share skype
		$wp_customize->add_setting( 'social_skype', [
			'default'           => $this->defaults['social_skype'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_skype',
			[
				'label'   => __( 'Hide skype?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );

		// Social Share email
		$wp_customize->add_setting( 'social_email', [
			'default'           => $this->defaults['social_email'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_email',
			[
				'label'   => __( 'Hide email?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );

		// Social Share pocket
		$wp_customize->add_setting( 'social_pocket', [
			'default'           => $this->defaults['social_pocket'],
			'transport'         => 'refresh',
			'sanitize_callback' => 'rttheme_text_sanitization',
		] );
		$wp_customize->add_control( new WP_Customize_Control( $wp_customize, 'social_pocket',
			[
				'label'   => __( 'Hide pocket?', 'mytheme' ),
				'section' => 'single_post_section',
				'type'    => 'checkbox',
			]
		) );
	}

}

/**
 * Initialise our Customizer settings only when they're required
 */
if ( class_exists( 'WP_Customize_Control' ) ) {
	new MyTheme_Single_Post_Settings();
}
