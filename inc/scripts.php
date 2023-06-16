<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\MyTheme;

use Elementor\Plugin;
use Rtcl\Helpers\Functions;
use Rtcl\Helpers\Link;

class Scripts {

	public $version;
	protected static $instance = null;

	public function __construct() {
		$this->version = Constants::$theme_version;
		add_action( 'wp_enqueue_scripts', [ $this, 'register_scripts' ], 12 );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_scripts' ], 15 );
		add_action( 'wp_default_scripts', [ $this, 'remove_jquery_migrate' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'register_gutenberg_scripts' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'enqueue_gutenberg_scripts' ], 20 );
		add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ], 15 );
		add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'rt_custom_animations' ], 99999 );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function fonts_url() {
		$fonts_url = '';
		$subsets   = '';
		$bodyFont  = 'Roboto';
		$bodyFW    = '300,400,500,600,700';

		$menuFont  = 'Ubuntu';
		$menuFontW = '300,400,500,600,700';

		$hFont  = 'Ubuntu';
		$hFontW = '500';
		$h1Font = '';
		$h2Font = '';
		$h3Font = '';
		$h4Font = '';
		$h5Font = '';
		$h6Font = '';

		// Body Font
		$body_font = json_decode( MyTheme::$options['typo_body'], true );

		if ( $body_font['font'] == 'Inherit' ) {
			$bodyFont = 'Roboto';
		} else {
			$bodyFont = $body_font['font'];
		}
		$bodyFontW = $body_font['regularweight'];

		// Menu Font
		$menu_font = json_decode( MyTheme::$options['typo_menu'], true );
		if ( $menu_font['font'] == 'Inherit' ) {
			$menuFont = 'Ubuntu';
		} else {
			$menuFont = $menu_font['font'];
		}
		$menuFontW = $menu_font['regularweight'];

		// Heading Font
		$h_font = json_decode( MyTheme::$options['typo_heading'], true );
		if ( $h_font['font'] == 'Inherit' ) {
			$hFont = 'Ubuntu';
		} else {
			$hFont = $h_font['font'];
		}
		$hFontW  = $h_font['regularweight'];
		$h1_font = json_decode( MyTheme::$options['typo_h1'], true );
		$h2_font = json_decode( MyTheme::$options['typo_h2'], true );
		$h3_font = json_decode( MyTheme::$options['typo_h3'], true );
		$h4_font = json_decode( MyTheme::$options['typo_h4'], true );
		$h5_font = json_decode( MyTheme::$options['typo_h5'], true );
		$h6_font = json_decode( MyTheme::$options['typo_h6'], true );

		if ( 'off' !== _x( 'on', 'Google font: on or off', 'mytheme' ) ) {
			if ( ! empty( $h1_font['font'] ) ) {
				if ( $h1_font['font'] == 'Inherit' ) {
					$h1Font  = $hFont;
					$h1FontW = $hFontW;
				} else {
					$h1Font  = $h2_font['font'];
					$h1FontW = $h1_font['regularweight'];
				}
			}
			if ( ! empty( $h2_font['font'] ) ) {
				if ( $h2_font['font'] == 'Inherit' ) {
					$h2Font  = $hFont;
					$h2FontW = $hFontW;
				} else {
					$h2Font  = $h2_font['font'];
					$h2FontW = $h2_font['regularweight'];
				}
			}
			if ( ! empty( $h3_font['font'] ) ) {
				if ( $h3_font['font'] == 'Inherit' ) {
					$h3Font  = $hFont;
					$h3FontW = $hFontW;
				} else {
					$h3Font  = $h3_font['font'];
					$h3FontW = $h3_font['regularweight'];
				}
			}
			if ( ! empty( $h4_font['font'] ) ) {
				if ( $h4_font['font'] == 'Inherit' ) {
					$h4Font  = $hFont;
					$h4FontW = $hFontW;
				} else {
					$h4Font  = $h4_font['font'];
					$h4FontW = $h4_font['regularweight'];
				}
			}
			if ( ! empty( $h5_font['font'] ) ) {
				if ( $h5_font['font'] == 'Inherit' ) {
					$h5Font  = $hFont;
					$h5FontW = $hFontW;
				} else {
					$h5Font  = $h5_font['font'];
					$h5FontW = $h5_font['regularweight'];
				}
			}
			if ( ! empty( $h6_font['font'] ) ) {
				if ( $h6_font['font'] == 'Inherit' ) {
					$h6Font  = $hFont;
					$h6FontW = $hFontW;
				} else {
					$h6Font  = $h6_font['font'];
					$h6FontW = $h6_font['regularweight'];
				}
			}

			$check_families = [];
			$font_families  = [];

			// Body Font
			if ( 'off' !== $bodyFont ) {
				$font_families[] = $bodyFont . ':300,400,500,600,700';
			}
			$check_families[] = $bodyFont;

			// Menu Font
			if ( 'off' !== $menuFont ) {
				if ( ! in_array( $menuFont, $check_families ) ) {
					$font_families[]  = $menuFont . ':300,400,500,600,700';
					$check_families[] = $menuFont;
				}
			}

			// Heading Font
			if ( 'off' !== $hFont ) {
				if ( ! in_array( $hFont, $check_families ) ) {
					$font_families[]  = $hFont . ':300,400,500,600,700';
					$check_families[] = $hFont;
				}
			}

			// Heading 1 Font
			if ( ! empty( $h1_font['font'] ) ) {
				if ( 'off' !== $h1Font ) {
					if ( ! in_array( $h1Font, $check_families ) ) {
						$font_families[]  = $h1Font . ':' . $h1FontW;
						$check_families[] = $h1Font;
					}
				}
			}
			// Heading 2 Font
			if ( ! empty( $h2_font['font'] ) ) {
				if ( 'off' !== $h2Font ) {
					if ( ! in_array( $h2Font, $check_families ) ) {
						$font_families[]  = $h2Font . ':' . $h2FontW;
						$check_families[] = $h2Font;
					}
				}
			}
			// Heading 3 Font
			if ( ! empty( $h3_font['font'] ) ) {
				if ( 'off' !== $h3Font ) {
					if ( ! in_array( $h3Font, $check_families ) ) {
						$font_families[]  = $h3Font . ':' . $h3FontW;
						$check_families[] = $h3Font;
					}
				}
			}
			// Heading 4 Font
			if ( ! empty( $h4_font['font'] ) ) {
				if ( 'off' !== $h4Font ) {
					if ( ! in_array( $h4Font, $check_families ) ) {
						$font_families[]  = $h4Font . ':' . $h4FontW;
						$check_families[] = $h4Font;
					}
				}
			}

			// Heading 5 Font
			if ( ! empty( $h5_font['font'] ) ) {
				if ( 'off' !== $h5Font ) {
					if ( ! in_array( $h5Font, $check_families ) ) {
						$font_families[]  = $h5Font . ':' . $h5FontW;
						$check_families[] = $h5Font;
					}
				}
			}
			// Heading 6 Font
			if ( ! empty( $h6_font['font'] ) ) {
				if ( 'off' !== $h6Font ) {
					if ( ! in_array( $h6Font, $check_families ) ) {
						$font_families[]  = $h6Font . ':' . $h6FontW;
						$check_families[] = $h6Font;
					}
				}
			}
			$final_fonts = array_unique( $font_families );
			$query_args  = [
				'family'  => urlencode( implode( '|', $final_fonts ) ),
				'subset'  => urlencode( $subsets ),
				'display' => urlencode( 'fallback' ),
			];

			$fonts_url = add_query_arg( $query_args, "//fonts.googleapis.com/css" );
		}

		return esc_url_raw( $fonts_url );
	}

	public function rt_custom_animations() {
		wp_register_style( 'rt-animation', Helper::get_css( 'rt-animation' ), [], $this->version );
		wp_enqueue_style( 'rt-animation' );
	}

	public function register_scripts() {

		/* Deregister */
		if(is_singular( 'rtcl_listing' )){
			wp_deregister_script( 'swiper' );
			wp_dequeue_script( 'swiper' );
			wp_register_script( 'swiper', rtcl()->get_assets_uri( "vendor/swiper/swiper-bundle.min.js" ), [
				'jquery',
				'imagesloaded'
			], '7.4.1' );
		}
		wp_deregister_style( 'font-awesome' );
		// Google fonts
		wp_register_style( 'mytheme-gfonts', $this->fonts_url(), [], $this->version );
		// Style
		wp_register_style( 'font-awesome', Helper::get_css( 'font-awesome.min' ), [], $this->version );
		wp_register_style( 'flaticon', Helper::get_css( 'flaticon' ), [], $this->version );
		wp_register_style( 'quentin-font', Helper::get_css( 'quentin-font' ), [], $this->version );

		wp_register_style( 'bootstrap', Helper::get_maybe_rtl_css( 'bootstrap.min' ), [], $this->version );
		wp_register_style( 'magnific-popup', Helper::get_maybe_rtl_css( 'magnific-popup' ), [], $this->version );
		wp_register_style( 'rangeSlider', Helper::get_maybe_rtl_css( 'ion.rangeSlider.min' ), [], $this->version );
		wp_register_style( 'mytheme-default', Helper::get_maybe_rtl_css( 'default' ), [], $this->version );
		wp_register_style( 'mytheme-style', Helper::get_maybe_rtl_css( 'styles' ), [], $this->version );
		wp_register_style( 'wc-style', Helper::get_maybe_rtl_css( 'wc' ), [], $this->version );

		wp_register_style( 'mytheme-rtl', Helper::get_rtl_css( 'rtl' ), [], $this->version );

		// Script
		wp_register_script( 'bootstrap', Helper::get_js( 'bootstrap.min' ), [ 'jquery' ], $this->version, true );
		wp_register_script( 'popper', Helper::get_js( 'popper.min' ), [ 'jquery' ], $this->version, true );
		wp_register_script( 'magnific-popup', Helper::get_js( 'jquery.magnific-popup.min' ), [ 'jquery' ], $this->version, true );
		wp_register_script( 'sticky-sidebar', Helper::get_js( 'sticky-sidebar.min' ), [], $this->version, true );
		wp_register_script( 'isotope', Helper::get_js( 'isotope.pkgd.min' ), [ 'jquery' ], $this->version, true );
		wp_register_script( 'navpoints', Helper::get_js( 'jquery.navpoints' ), [ 'jquery' ], $this->version, true );
		wp_register_script( 'rangeSlider', Helper::get_js( 'ion.rangeSlider.min' ), [ 'jquery' ], $this->version, true );
		wp_register_script( 'jquery.nav', Helper::get_js( 'jquery.nav' ), [ 'jquery' ], $this->version, true );
		wp_register_script( 'rt-bg-parallax', Helper::get_js( 'rt-parallax' ), [ 'jquery' ], $this->version, true );
		wp_register_script( 'mytheme-main', Helper::get_js( 'main' ), [ 'jquery' ], $this->version, true );
	}

	public function remove_jquery_migrate( $scripts ) {
		if ( ! is_admin() && isset( $scripts->registered['jquery'] ) ) {
			$script = $scripts->registered['jquery'];
			if ( $script->deps ) {
				$script->deps = array_diff( $script->deps, [ 'jquery-migrate' ] );
			}
		}
	}

	public function enqueue_scripts() {
		/*CSS*/
		wp_enqueue_style( 'mytheme-gfonts' );
		wp_enqueue_style( 'bootstrap' );
		wp_enqueue_style( 'font-awesome' );
		wp_enqueue_style( 'flaticon' );
		wp_enqueue_style( 'magnific-popup' );
		wp_enqueue_style( 'quentin-font' );
		wp_enqueue_style( 'mytheme-default' );
		wp_enqueue_style( 'rangeSlider' );
		wp_enqueue_style( 'mytheme-style' );
		wp_enqueue_style( 'wc-style' );
		if ( is_rtl() ) {
			wp_enqueue_style( 'mytheme-rtl' );
		}

		$this->dynamic_style();// Dynamic style
		/*JS*/
		//$this->elementor_scripts(); // Elementor Scripts in preview mode
		$this->conditional_scripts(); // Conditional Scripts

		if ( is_author() ) {
			wp_enqueue_script( 'rtcl-agent' );
		}
		wp_enqueue_script( 'popper' );
		wp_enqueue_script( 'bootstrap' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'jquery.nav' );
		wp_enqueue_script( 'navpoints' );
		wp_enqueue_script( 'select2' );
		wp_enqueue_script( 'rangeSlider' );
		wp_enqueue_script( 'masonry' );
		wp_enqueue_script( 'sticky-sidebar' );
		wp_enqueue_script( 'rt-bg-parallax' );
		wp_enqueue_script( 'isotope-pkgd', Helper::get_js( 'isotope.pkgd.min' ), [ 'jquery' ], $this->version, true );

		wp_enqueue_script( 'mytheme-main' );
		wp_enqueue_script( 'walkscore-tile' );
		$this->localized_scripts(); // Localization
	}

	public function enqueue_admin_scripts() {
		wp_register_style( 'flaticon', Helper::get_css( 'flaticon' ), [], $this->version );
		wp_register_style( 'rt-admin', Helper::get_css( 'rt-admin' ), [], $this->version );
		wp_enqueue_style( 'flaticon' );
		wp_enqueue_style( 'rt-admin' );
		wp_enqueue_style( 'mytheme-admin', Helper::get_css( 'mytheme-admin' ), [], $this->version );
		wp_enqueue_script( 'mytheme-admin', Helper::get_js( 'admin' ), [ 'jquery' ], $this->version, true );

		$nonce = wp_create_nonce( "dismissnotice" );
		wp_localize_script( 'mytheme-admin', 'MythemeAdminObj', [
			'ajaxUrl' => admin_url( 'admin-ajax.php' ),
			'nonce'   => $nonce
		] );

	}

	public function register_gutenberg_scripts() {
		wp_register_style( 'mytheme-gfonts', $this->fonts_url(), [], $this->version );
		wp_register_style( 'mytheme-gutenberg', Helper::get_maybe_rtl_css( 'gutenberg' ), [], $this->version );
	}

	public function enqueue_gutenberg_scripts() {
		wp_enqueue_style( 'mytheme-gfonts' );
		wp_enqueue_style( 'mytheme-gutenberg' );
		ob_start();
		Helper::requires( 'dynamic-styles/common.php' );
		$dynamic_css = ob_get_clean();
		$css         = $this->add_wrapper_to_css( $dynamic_css, '.wp-block.editor-block-list__block' );
		$css         = str_replace( 'gtnbg_root', '', $css );
		wp_add_inline_style( 'mytheme-gutenberg', $css );
	}

	private function conditional_scripts() {
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	public function elementor_scripts() {
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}
		if ( Plugin::$instance->preview->is_preview_mode() ) {
			// Load Style
			wp_enqueue_style( 'slick' );
			wp_enqueue_style( 'slick-theme' );
			// Load Script
			wp_enqueue_script( 'slick' );
			wp_enqueue_script( 'isotope' );
			wp_enqueue_script( 'typed' );
		}
	}

	private function localized_scripts() {
		global $post;

		if ( class_exists( 'rtcl' ) && Functions::is_listing() && Listing_Functions::is_enable_panorama_view() ) {
			$listing      = rtcl()->factory->get_listing( $post->ID );
			$imageID      = get_post_meta( $listing->get_id(), 'mytheme_panorama_img', true );
			$pannellumIMG = wp_get_attachment_image_url( $imageID, 'full' );
		}

		$localize_data = [
			'ajaxUrl'         => admin_url( 'admin-ajax.php' ),
			'appendHtml'      => '',
			'themeUrl'        => get_stylesheet_directory_uri(),
			'lsSideOffset'    => MyTheme::$options['sticky_header'] ? 130 : 10,
			'rtStickySidebar' => MyTheme::$options['sticky_sidebar'] ? 'enable' : 'disable',
			'rtMagnificPopup' => MyTheme::$options['magnific_popup'] ? 'enable' : 'disable',
		];

		if ( class_exists( 'rtcl' ) && Functions::is_listing() && Listing_Functions::is_enable_panorama_view() ) {
			$localize_data['listingTitle'] = $listing->get_the_title();
			$localize_data['pannellumIMG'] = $pannellumIMG;
			$localize_data['showControls'] = Functions::get_option_item( 'rtcl_general_settings', 'enable_panorama_control', true, 'checkbox' );
			$localize_data['autoLoad']     = Functions::get_option_item( 'rtcl_general_settings', 'enable_panorama_autoload', false, 'checkbox' );
		}

		$localize_data = apply_filters( 'mytheme_localized_data', $localize_data );

		wp_localize_script( 'mytheme-main', 'MyThemeObj', $localize_data );
	}

	private function dynamic_style() {
		$dynamic_css = $this->template_style();
		ob_start();
		Helper::requires( 'dynamic-styles/frontend.php' );
		$dynamic_css .= ob_get_clean();
		$dynamic_css = $this->optimized_css( $dynamic_css );
		wp_register_style( 'mytheme-dynamic', false );
		wp_enqueue_style( 'mytheme-dynamic' );
		wp_add_inline_style( 'mytheme-dynamic', $dynamic_css );
	}

	private function template_style() {
		$style = '';

		if ( MyTheme::$padding_top != '' ) {
			$style .= 'body .content-area {padding-top:' . MyTheme::$padding_top . '!important;}';
		}
		if ( MyTheme::$padding_bottom != '' ) {
			$style .= 'body .content-area {padding-bottom:' . MyTheme::$padding_bottom . ';!important}';
		}
		if ( MyTheme::$padding_top_footer != '' ) {
			$style .= 'body .main-footer {padding-top:' . MyTheme::$padding_top_footer . '!important;}';
		}
		if ( MyTheme::$padding_bottom_footer != '' ) {
			$style .= 'body .main-footer {padding-bottom:' . MyTheme::$padding_bottom_footer . ';!important}';
		}

		$bgimg            = ! empty( wp_get_attachment_image_url( MyTheme::$options['banner_image'], 'full' ) ) ? wp_get_attachment_image_url( MyTheme::$options['banner_image'],
			'full' ) : '';
		$breadcrumb_style = MyTheme::$breadcrumb_style;
		if ( ! empty( $bgimg ) && 'style-2' == $breadcrumb_style ) {
			$style .= '.breadcrumbs-banner {background-image:url(' . $bgimg . ');}';
		}

		return $style;
	}

	private function optimized_css( $css ) {
		$css = preg_replace( '!/\*[^*]*\*+([^/][^*]*\*+)*/!', '', $css );
		$css = str_replace( [ "\r\n", "\r", "\n", "\t", '  ', '    ', '    ' ], ' ', $css );

		return $css;
	}

	private function add_wrapper_to_css( $css, $base ) {
		$parts = explode( '}', $css );
		foreach ( $parts as &$part ) {
			if ( empty( $part ) ) {
				continue;
			}

			$firstPart = substr( $part, 0, strpos( $part, '{' ) + 1 );
			$lastPart  = substr( $part, strpos( $part, '{' ) + 2 );
			$subParts  = explode( ',', $firstPart );
			foreach ( $subParts as &$subPart ) {
				$subPart = str_replace( "\n", '', $subPart );
				$subPart = $base . ' ' . trim( $subPart );
			}

			$part = implode( ', ', $subParts ) . $lastPart;
		}

		$resultCSS = implode( "}\n", $parts );

		return $resultCSS;
	}

}

Scripts::instance();