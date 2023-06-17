<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme;

class General_Setup {

	protected static $instance = null;

	public function __construct() {

		add_action( 'after_setup_theme', [ $this, 'theme_setup' ] );
		add_filter( 'max_srcset_image_width', [ $this, 'disable_wp_responsive_images' ] );
		add_action( 'widgets_init', [ $this, 'register_sidebars' ], 99 );
		add_action( 'mytheme_breadcrumb', [ $this, 'breadcrumb' ] );
		add_filter( 'body_class', [ $this, 'body_classes' ] );
		add_action( 'wp_head', [ $this, 'noscript_hide_preloader' ], 1 );
		add_action( 'wp_head', [ $this, 'pingback' ] );
		add_action( 'wp_body_open', [ $this, 'preloader' ] );
		add_action( 'wp_footer', [ $this, 'scroll_to_top_html' ], 1 );
		add_filter( 'get_search_form', [ $this, 'search_form' ] );
		add_filter( 'post_class', [ $this, 'hentry_config' ] );
		add_filter( 'excerpt_more', [ $this, 'excerpt_more' ] );
		add_filter( 'wp_list_categories', [ $this, 'add_span_cat_count' ] );
		add_filter( 'get_archives_link', [ $this, 'add_span_archive_count' ] );
		add_filter( 'widget_text', 'do_shortcode' );

		//Disable Gutenberg widget block
		add_filter( 'gutenberg_use_widgets_block_editor', '__return_false' );// Disables the block editor from managing widgets in the Gutenberg plugin.
		add_filter( 'use_widgets_block_editor', '__return_false' ); // Disables the block editor from managing widgets.
		add_filter( 'wp_calculate_image_srcset', [ $this, 'calculate_image_srcset' ] );
	}

	/**
	 * Remove calculate image srcset
	 * @return array
	 */
	public function calculate_image_srcset() {
		return [];
	}

	//disable wp responsive images
	function disable_wp_responsive_images() {
		return 1;
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function theme_setup() {
		// Theme supports
		add_theme_support( 'title-tag' );
		add_theme_support( 'align-wide' );
		add_theme_support( 'post-thumbnails' );
		add_theme_support( 'automatic-feed-links' );
		add_theme_support( 'html5', [ 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ] );
		add_theme_support( 'wp-block-styles' );
		add_theme_support( 'custom-logo' );
		add_theme_support( "custom-header" );
		add_theme_support( "custom-background" );
		add_theme_support( 'editor-styles' );

		// Image sizes
		$sizes = [
			'mytheme-size1'  => [ 1200, 650, true ], // When Full width
			'mytheme-size2'  => [ 370, 245, true ], // Listing Thumbnail Size and blog grid
			'mytheme-size3'  => [ 350, 420, true ],
			'mytheme-square' => [ 500, 500, true ],
		];

		$sizes = apply_filters( 'mytheme_image_size', $sizes );

		foreach ( $sizes as $size => $value ) {
			add_image_size( $size, $value[0], $value[1], $value[2] );
		}

		// Register menus
		register_nav_menus(
			[
				'primary'   => esc_html__( 'Primary', 'mytheme' ),
				'secondary' => esc_html__( 'Footer Menu', 'mytheme' ),
			]
		);
	}

	public function register_sidebars() {

		register_sidebar(
			[
				'name'          => esc_html__( 'Sidebar', 'mytheme' ),
				'id'            => 'sidebar',
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-heading">',
				'after_title'   => '</h3>',
			]
		);

		$footer_widget_titles = [
			'1' => esc_html__( 'Footer 1', 'mytheme' ),
			'2' => esc_html__( 'Footer 2', 'mytheme' ),
			'3' => esc_html__( 'Footer 3', 'mytheme' ),
			'4' => esc_html__( 'Footer 4', 'mytheme' ),
		];

		foreach ( $footer_widget_titles as $id => $name ) {
			register_sidebar(
				[
					'name'          => $name,
					'id'            => 'footer-' . $id,
					'before_widget' => '<div id="%1$s" class="footer-box %2$s">',
					'after_widget'  => '</div>',
					'before_title'  => '<h3 class="footer-title">',
					'after_title'   => '</h3>',
				]
			);
		}
	}

	public function body_classes( $classes ) {
		//Theme Version
		$header_style   = MyTheme::$header_style ?? 4;
		$classes[]      = 'theme-mytheme';

		$classes[] = 'header-style-' . $header_style;
		$classes[] = 'header-width-' . MyTheme::$header_width;
		$sticky    = MyTheme::$options['sticky_header'] ? 1 : 0;

		if ( $sticky ) {
			$classes[] = 'sticky-header';
		}

		if ( MyTheme::$has_tr_header ) {
			$classes[] = 'trheader';
		} else {
			$classes[] = 'no-trheader';
		}

		if ( is_front_page() && ! is_home() ) {
			$classes[] = 'front-page';
		}

		if ( class_exists( 'MyTheme_Core' ) ) {
			$classes[] = 'mytheme-core-installed';
		} else {
			$classes[] = 'need-mytheme-core';
		}

		if ( Helper::has_full_width() ) {
			$classes[] = 'is-full-width';
		}

		global $post;
		if ( isset( $post ) ) {
			$classes[] = $post->post_type . '-' . $post->post_name;
		}

		return $classes;
	}

	public function is_blog() {
		return ( is_archive() || is_author() || is_category() || is_home() || is_single() || is_tag() ) && 'post' == get_post_type();
	}

	public function noscript_hide_preloader() {
		// Hide preloader if js is disabled
		echo '<noscript><style>#preloader{display:none;}</style></noscript>';
	}

	public function pingback() {
		if ( is_singular() && pings_open() ) {
			printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
		}
	}

	public function preloader() {
		// Preloader
		if ( MyTheme::$options['preloader'] ) {
			if ( ! empty( wp_get_attachment_image_url( MyTheme::$options['preloader_image'], 'full' ) ) ) {
				$preloader_img = wp_get_attachment_image_url( MyTheme::$options['preloader_image'], 'full' );
			} else {
				$preloader_img = Helper::get_img( 'preloader.gif' );
			}
			echo '<div id="preloader" style="background-image:url(' . esc_url( $preloader_img ) . ');"></div>';
		}
	}

	public function wp_body_open() {
		do_action( 'wp_body_open' );
	}

	public function scroll_to_top_html() {
		// Back-to-top link
		if ( MyTheme::$options['back_to_top'] ) {
			echo '<a href="#" class="scrollToTop" style=""><i class="fa fa-angle-double-up"></i></a>';
		}
	}

	public function search_form() {
		$output = '
		<form method="get" class="custom-search-form" action="' . esc_url( home_url( '/' ) ) . '">
            <div class="search-box">
                <div class="row gutters-10">
                    <div class="col-12 form-group mb-0">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="' . esc_attr__( 'Search here...', 'mytheme' ) . '" value="' . get_search_query() . '" name="s" />
                            <span class="input-group-append">
                                <button class="item-btn" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
		</form>
		';

		return $output;
	}

	public function hentry_config( $classes ) {
		if ( is_search() || is_page() ) {
			$classes = array_diff( $classes, [ 'hentry' ] );
		}

		return $classes;
	}

	public function excerpt_more() {
		if ( is_search() ) {
			$readmore = '<a href="' . get_the_permalink() . '"> [' . esc_html__( 'read more ...', 'mytheme' ) . ']</a>';

			return $readmore;
		}

		return ' ...';
	}

	public function add_span_cat_count( $links ) {
		$links = str_replace( '</a> (', '<span>(', $links );
		$links = str_replace( ')', ')</span></a>', $links );

		return $links;
	}

	public function add_span_archive_count( $links ) {
		$links = str_replace( '</a>&nbsp;(', '<span>(', $links );
		$links = str_replace( ')', ')</span></a>', $links );

		return $links;
	}

	public function breadcrumb() {
		//TODO:Have to implement

	}

}

General_Setup::instance();