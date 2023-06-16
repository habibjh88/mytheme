<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\MyTheme;

use Rtcl\Helpers\Functions;
use RtclStore\Helpers\Functions as StoreFunctions;

class Layouts {

	protected static $instance = null;

	public $base;
	public $type;
	public $meta_value;

	public function __construct() {
		$this->base = 'mytheme';

		add_action( 'template_redirect', [ $this, 'layout_settings' ] );
	}

	public static function instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function layout_settings() {
		$is_listing = $is_listing_archive = $is_store = $is_store_archive = $is_agent_archive = false;

		if ( class_exists( 'Rtcl' ) ) {
			$is_listing_archive = Functions::is_listings() || Functions::is_listing_taxonomy();
		}
		if ( $is_listing_archive ) {
			$is_listing = true;
		}
		if ( class_exists( 'RtclStore' ) && class_exists( 'Rtcl' ) ) {
			$is_store_archive = StoreFunctions::is_store() || StoreFunctions::is_store_taxonomy();
		}
		if ( class_exists( 'RtclAgent' ) ) {
			$is_agent_archive = rtcl_is_agent();
		}
		if ( $is_store_archive ) {
			$is_store = true;
		}
		// Single Pages
		if ( ( is_single() || is_page() ) && ! $is_listing ) {
			$post_type        = get_post_type();
			$post_id          = get_the_id();
			$this->meta_value = get_post_meta( $post_id, "{$this->base}_layout_settings", true );


			switch ( $post_type ) {
				case 'post':
					$this->type = 'single_post';
					break;
				case 'rtcl_listing':
					$this->type                                   = 'listing_single';
					MyTheme::$options[ $this->type . '_layout' ]  = 'full-width';
					MyTheme::$options[ $this->type . '_sidebar' ] = '';
					break;
				case 'rtcl_agent' :
					$this->type = 'agent_single';
					break;
				case 'product' :
					$this->type = 'woocommerce_single';
					break;
				default:
					$this->type = 'page';
			}


			MyTheme::$layout                = $this->meta_layout_option( 'layout' );
			MyTheme::$sidebar               = $this->meta_layout_option( 'sidebar' );
			MyTheme::$padding_top           = $this->meta_layout_option( 'padding_top' );
			MyTheme::$padding_bottom        = $this->meta_layout_option( 'padding_bottom' );
			MyTheme::$padding_top_footer    = $this->meta_layout_option( 'padding_top_footer', false );
			MyTheme::$padding_bottom_footer = $this->meta_layout_option( 'padding_bottom_footer', false );
			MyTheme::$has_top_bar           = $this->meta_layout_global_option( 'top_bar', true );
			MyTheme::$header_width          = $this->meta_layout_global_option( 'header_width' );
			MyTheme::$header_style          = $this->meta_layout_global_option( 'header_style' );
			MyTheme::$menu_alignment        = $this->meta_layout_global_option( 'menu_alignment' );
			MyTheme::$footer_style          = $this->meta_layout_global_option( 'footer_style' );
			MyTheme::$has_tr_header         = $this->meta_layout_global_option( 'tr_header', true );
			MyTheme::$has_breadcrumb        = $this->meta_layout_global_option( 'breadcrumb', true );


		} // Blog and Archive
		elseif ( is_home() || is_archive() || is_search() || is_404() || $is_listing || $is_store ) {
			if ( is_404() ) {
				$this->type                                   = 'error';
				MyTheme::$options[ $this->type . '_layout' ]  = 'full-width';
				MyTheme::$options[ $this->type . '_sidebar' ] = '';
			} elseif ( $is_listing_archive ) {
				$this->type = 'listing_archive';
			} elseif ( $is_store_archive ) {
				$this->type = 'store_archive';
			} elseif ( $is_agent_archive ) {
				$this->type = 'agent_archive';
			} elseif ( class_exists( 'WooCommerce' ) && is_shop() ) {
				$this->type = 'woocommerce_archive';
			} else {
				$this->type = 'blog';
			}


			MyTheme::$layout         = $this->layout_option( 'layout' );
			MyTheme::$sidebar        = $this->layout_option( 'sidebar' );
			MyTheme::$padding_top    = $this->layout_option( 'padding_top' );
			MyTheme::$padding_bottom = $this->layout_option( 'padding_bottom' );
			MyTheme::$has_breadcrumb = $this->layout_global_option( 'breadcrumb', true );
			MyTheme::$has_top_bar    = $this->layout_global_option( 'top_bar', true );
			MyTheme::$header_width   = $this->layout_global_option( 'header_width' );
			MyTheme::$menu_alignment = $this->layout_global_option( 'menu_alignment' );
			MyTheme::$header_style   = $this->layout_global_option( 'header_style' );
			MyTheme::$footer_style   = $this->layout_global_option( 'footer_style' );
			MyTheme::$has_tr_header  = $this->layout_global_option( 'tr_header', true );
		}

		// All pages
		MyTheme::$footer_border    = $this->meta_global_option( 'footer_border', true );
		MyTheme::$breadcrumb_style = $this->meta_global_option( 'breadcrumb_style' );
	}

	// Single
	private function meta_layout_global_option( $key, $is_bool = false ) {
		$layout_key = $this->type . '_' . $key;

		$meta      = ! empty( $this->meta_value[ $key ] ) ? $this->meta_value[ $key ] : 'default';
		$op_layout = MyTheme::$options[ $layout_key ] ? MyTheme::$options[ $layout_key ] : 'default';
		$op_global = MyTheme::$options[ $key ];

		if ( $meta != 'default' ) {
			$result = $meta;
		} elseif ( $op_layout != 'default' ) {
			$result = $op_layout;
		} else {
			$result = $op_global;
		}
		if ( $is_bool ) {
			$result = ( $result === 1 || $result === 'on' ) ? true : false;
		}

		return $result;
	}

	// Meta Global
	private function meta_global_option( $key, $is_bool = false ) {
		$meta      = ! empty( $this->meta_value[ $key ] ) ? $this->meta_value[ $key ] : 'default';
		$op_layout = MyTheme::$options[ $key ] ? MyTheme::$options[ $key ] : 'default';
		$op_global = MyTheme::$options[ $key ];

		if ( $meta != 'default' ) {
			$result = $meta;
		} elseif ( $op_layout != 'default' ) {
			$result = $op_layout;
		} else {
			$result = $op_global;
		}
		if ( $is_bool ) {
			$result = ( $result === 1 || $result === 'on' ) ? true : false;
		}

		return $result;
	}

	// Single
	private function meta_layout_option( $key, $check_opt = true ) {

		if ( $check_opt ) {
			$layout_key = $this->type . '_' . $key; //Ex->> agent_single_sidebar
			$op_layout  = MyTheme::$options[ $layout_key ];
		}
		$meta = ! empty( $this->meta_value[ $key ] ) ? $this->meta_value[ $key ] : 'default';

		$result = '';
		if ( $meta != 'default' ) {
			$result = $meta;
		} elseif($check_opt) {
			$result = $op_layout;
		}

		return $result;
	}

	// Archive
	private function layout_global_option( $key, $is_bool = false ) {
		$layout_key = $this->type . '_' . $key;

		$op_layout = MyTheme::$options[ $layout_key ] ? MyTheme::$options[ $layout_key ] : 'default';
		$op_global = MyTheme::$options[ $key ];

		if ( $op_layout != 'default' ) {
			$result = $op_layout;
		} else {
			$result = $op_global;
		}
		if ( $is_bool ) {
			$result = ( $result === 1 || $result === 'on' ) ? true : false;
		}

		return $result;
	}

	// Archive
	private function layout_option( $key ) {
		$layout_key = $this->type . '_' . $key;
		$op_layout  = MyTheme::$options[ $layout_key ];

		return $op_layout;
	}

	private function bgimg_option( $key, $is_single = true ) {
		$layout_key = $this->type . '_' . $key;

		if ( $is_single ) {
			$meta = ! empty( $this->meta_value[ $key ] ) ? $this->meta_value[ $key ] : '';
		} else {
			$meta = '';
		}

		$op_layout = MyTheme::$options[ $layout_key ];
		$op_global = MyTheme::$options[ $key ];

		if ( $meta ) {
			$src = wp_get_attachment_image_src( $meta, 'full', true );
			$img = $src[0];
		} elseif ( ! empty( $op_layout['url'] ) ) {
			$img = $op_layout['url'];
		} elseif ( ! empty( $op_global['url'] ) ) {
			$img = $op_global['url'];
		} else {
			$img = Helper::get_img( 'banner.jpg' );
		}

		return $img;
	}

}

Layouts::instance();