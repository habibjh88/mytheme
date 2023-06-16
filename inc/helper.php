<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\MyTheme;

use Rtcl\Helpers\Functions;
use RtclPro\Helpers\Fns;

class Helper {

	/**
	 * Check, if it has sidebar
	 * @return bool
	 */
	public static function has_sidebar() {
		return ( self::has_full_width() ) ? false : true;
	}

	/**
	 * Check if is fullwidth layout
	 * @return bool
	 */
	public static function has_full_width() {
		return ( MyTheme::$layout == 'full-width' ) ? true : false;
	}

	/**
	 * Get listing single style
	 * @return mixed|string
	 */
	public static function listing_single_style() {
		$opt_layout  = ! empty( MyTheme::$options['single_listing_style'] ) ? MyTheme::$options['single_listing_style'] : '1';
		$meta_layout = get_post_meta( get_the_id(), 'listing_layout', true );
		if ( ! $meta_layout || 'default' == $meta_layout ) {
			return $opt_layout;
		} else {
			return $meta_layout;
		}
	}

	/**
	 * Get layout classes
	 * @return void
	 */
	public static function the_layout_class() {
		//$fullwidth_col = (MyTheme::$options['blog_style'] == 'style2') ? 'col-sm-12 col-12' : 'col-sm-10 offset-sm-1 col-12';

		$fullwidth_col = ( MyTheme::$options['blog_style'] == 'style1' && is_home() ) ? 'col-sm-10 offset-sm-1 col-12' : 'col-sm-12 col-12';

		$layout_class = self::has_sidebar() ? 'col-lg-8 col-sm-12 col-12' : $fullwidth_col;
		if ( MyTheme::$layout == 'left-sidebar' ) {
			$layout_class .= ' order-lg-2';
		}
		echo apply_filters( 'mytheme_layout_class', $layout_class );
	}

	/**
	 * Get sidebar class
	 * @return void
	 */
	public static function the_sidebar_class() {
		$sidebar_class = self::has_sidebar() ? 'col-lg-4 col-sm-12 sidebar-break-lg' : 'col-sm-12 col-12';
		echo apply_filters( 'mytheme_sidebar_class', $sidebar_class );
	}

	/**
	 * Comments callback function
	 *
	 * @param $comment
	 * @param $args
	 * @param $depth
	 *
	 * @return void
	 */
	public static function comments_callback( $comment, $args, $depth ) {
		$args2 = get_defined_vars();
		Helper::get_template_part( 'template-parts/comments-callback', $args2 );
	}

	/**
	 * File require function
	 *
	 * @param $filename
	 * @param $dir
	 *
	 * @return false|void
	 */
	public static function requires( $filename, $dir = false ) {
		if ( $dir ) {
			$child_file = get_stylesheet_directory() . '/' . $dir . '/' . $filename;

			if ( file_exists( $child_file ) ) {
				$file = $child_file;
			} else {
				$file = get_template_directory() . '/' . $dir . '/' . $filename;
			}
		} else {
			$child_file = get_stylesheet_directory() . '/inc/' . $filename;

			if ( file_exists( $child_file ) ) {
				$file = $child_file;
			} else {
				$file = Constants::$theme_inc_dir . $filename;
			}
		}
		if ( file_exists( $file ) ) {
			require_once $file;
		} else {
			return false;
		}
	}

	/**
	 * Get file path
	 *
	 * @param $path
	 *
	 * @return string
	 */
	public static function get_file( $path ) {
		$file = get_stylesheet_directory_uri() . $path;
		if ( ! file_exists( $file ) ) {
			$file = get_template_directory_uri() . $path;
		}

		return $file;
	}

	/**
	 * Get image path
	 *
	 * @param $filename
	 *
	 * @return string
	 */
	public static function get_img( $filename ) {
		$path = '/assets/img/' . $filename;

		return self::get_file( $path );
	}

	/**
	 * Get CSS path
	 *
	 * @param $filename
	 *
	 * @return string
	 */
	public static function get_css( $filename ) {
		$path = '/assets/css/' . $filename . '.css';

		return self::get_file( $path );
	}

	/**
	 * Get RTL css if it needs
	 *
	 * @param $filename
	 *
	 * @return string
	 */
	public static function get_maybe_rtl_css( $filename ) {
		if ( is_rtl() ) {
			$path = '/assets/css-rtl/' . $filename . '.css';

			return self::get_file( $path );
		} else {
			return self::get_css( $filename );
		}
	}

	/**
	 * Get RTL css path
	 *
	 * @param $filename
	 *
	 * @return string
	 */
	public static function get_rtl_css( $filename ) {
		$path = '/assets/css-rtl/' . $filename . '.css';

		return self::get_file( $path );
	}

	/**
	 * Get js file path
	 *
	 * @param $filename
	 *
	 * @return string
	 */
	public static function get_js( $filename ) {
		$path = '/assets/js/' . $filename . '.js';

		return self::get_file( $path );
	}

	/**
	 * Get template part
	 *
	 * @param $template
	 * @param $args
	 *
	 * @return false|void
	 */
	public static function get_template_part( $template, $args = [] ) {
		extract( $args );

		$template = '/' . $template . '.php';

		if ( file_exists( get_stylesheet_directory() . $template ) ) {
			$file = get_stylesheet_directory() . $template;
		} else {
			$file = get_template_directory() . $template;
		}
		if ( file_exists( $file ) ) {
			require $file;
		} else {
			return false;
		}
	}

	/**
	 * Get all sidebar list
	 *
	 * @return array
	 */
	public static function custom_sidebar_fields(): array {
		$base                                      = 'mytheme';
		$sidebar_fields                            = [];
		$sidebar_fields['sidebar']                 = esc_html__( 'Sidebar', 'mytheme' );
		$sidebar_fields['listing-archive-sidebar'] = esc_html__( 'Listing Archive Sidebar', 'mytheme' );
		$sidebar_fields['store-sidebar']           = esc_html__( 'Agency/Store Sidebar', 'mytheme' );
		$sidebar_fields['agent-sidebar']           = esc_html__( 'Agent Sidebar', 'mytheme' );
		if ( class_exists( 'WooCommerce' ) ) {
			$sidebar_fields['woocommerce-archive-sidebar'] = esc_html__( 'WooCommerce Archive Sidebar', 'mytheme' );
			$sidebar_fields['woocommerce-single-sidebar']  = esc_html__( 'WooCommerce Single Sidebar', 'mytheme' );
		}
		$sidebars = get_option( "{$base}_custom_sidebars", [] );
		if ( $sidebars ) {
			foreach ( $sidebars as $sidebar ) {
				$sidebar_fields[ $sidebar['id'] ] = $sidebar['name'];
			}
		}

		return $sidebar_fields;
	}

	/**
	 * Get site header list
	 *
	 * @param $return_type
	 *
	 * @return array|array[]
	 */
	public static function get_mytheme_header_list( $return_type = '' ): array {
		if ( 'header' === $return_type ) {
			return [
				'1' => [
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-1.png',
					'name'  => __( 'Style 1', 'mytheme' ),
				],
				'2' => [
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-2.png',
					'name'  => __( 'Style 2', 'mytheme' ),
				],
				'3' => [
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-3.png',
					'name'  => __( 'Style 3', 'mytheme' ),
				],
				'4' => [
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-4.png',
					'name'  => __( 'Style 4', 'mytheme' ),
				],
				'5' => [
					'image' => trailingslashit( get_template_directory_uri() ) . 'assets/img/header-5.png',
					'name'  => __( 'Style 5 (NO BG)', 'mytheme' ),
				],
			];
		} else {
			return [
				'default' => esc_html__( 'Default', 'mytheme' ),
				'1'       => esc_html__( 'Layout 1', 'mytheme' ),
				'2'       => esc_html__( 'Layout 2', 'mytheme' ),
				'3'       => esc_html__( 'Layout 3', 'mytheme' ),
				'4'       => esc_html__( 'Layout 4', 'mytheme' ),
				'5'       => esc_html__( 'Layout 5', 'mytheme' ),
			];
		}
	}

	/**
	 * Custom listing template
	 *
	 * @param $template
	 * @param $echo
	 * @param $args
	 * @param $path
	 *
	 * @return string|void
	 */
	public static function get_custom_listing_template( $template, $echo = true, $args = [], $path = 'custom/' ) {
		$template = 'classified-listing/' . $path . $template;
		if ( $echo ) {
			self::get_template_part( $template, $args );
		} else {
			$template .= '.php';

			return $template;
		}
	}

	/**
	 * Custom store template
	 *
	 * @param $template
	 * @param $echo
	 * @param $args
	 *
	 * @return string|void
	 */
	public static function get_custom_store_template( $template, $echo = true, $args = [] ) {
		$template = 'classified-listing/store/custom/' . $template;
		if ( $echo ) {
			self::get_template_part( $template, $args );
		} else {
			$template .= '.php';

			return $template;
		}
	}

	/**
	 * Check chat is enable or not
	 * @return bool
	 */
	public static function is_chat_enabled() {
		if ( MyTheme::$options['header_chat_icon'] && class_exists( 'Rtcl' ) ) {
			if ( class_exists( 'RtclPro' ) && Fns::is_enable_chat() ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Get primary color
	 * @return mixed|null
	 */
	public static function get_primary_color() {
		return apply_filters( 'mytheme_primary_color', MyTheme::$options['primary_color'] );
	}

	/**
	 * Get secondary color
	 * @return mixed|null
	 */
	public static function get_secondary_color() {
		return apply_filters( 'mytheme_secondary_color', MyTheme::$options['secondary_color'] );
	}

	/**
	 * Get body color
	 * @return mixed|null
	 */
	public static function get_body_color() {
		return apply_filters( 'mytheme_body_color', MyTheme::$options['body_color'] );
	}

	/**
	 * Set temp query
	 *
	 * @param $query
	 *
	 * @return mixed
	 */
	public static function wp_set_temp_query( $query ) {
		global $wp_query;
		$temp     = $wp_query;
		$wp_query = $query;

		return $temp;
	}

	/**
	 * Reset temp query
	 *
	 * @param $temp
	 *
	 * @return void
	 */
	public static function wp_reset_temp_query( $temp ) {
		global $wp_query;
		$wp_query = $temp;
		wp_reset_postdata();
	}

	/**
	 * Change hex to rgb color
	 *
	 * @param $hex
	 *
	 * @return string
	 */
	public static function hex2rgb( $hex ) {
		$hex = str_replace( "#", "", $hex );
		if ( strlen( $hex ) == 3 ) {
			$r = hexdec( substr( $hex, 0, 1 ) . substr( $hex, 0, 1 ) );
			$g = hexdec( substr( $hex, 1, 1 ) . substr( $hex, 1, 1 ) );
			$b = hexdec( substr( $hex, 2, 1 ) . substr( $hex, 2, 1 ) );
		} else {
			$r = hexdec( substr( $hex, 0, 2 ) );
			$g = hexdec( substr( $hex, 2, 2 ) );
			$b = hexdec( substr( $hex, 4, 2 ) );
		}
		$rgb = "$r, $g, $b";

		return $rgb;
	}

	/**
	 * Get Social information
	 * @return array[]
	 */
	public static function socials() {
		$mytheme_socials = [
			'facebook'  => [
				'icon' => 'fab fa-facebook-square',
				'url'  => MyTheme::$options['facebook'],
			],
			'twitter'   => [
				'icon' => 'fab fa-twitter',
				'url'  => MyTheme::$options['twitter'],
			],
			'linkedin'  => [
				'icon' => 'fab fa-linkedin-in',
				'url'  => MyTheme::$options['linkedin'],
			],
			'youtube'   => [
				'icon' => 'fab fa-youtube',
				'url'  => MyTheme::$options['youtube'],
			],
			'pinterest' => [
				'icon' => 'fab fa-pinterest',
				'url'  => MyTheme::$options['pinterest'],
			],
			'instagram' => [
				'icon' => 'fab fa-instagram',
				'url'  => MyTheme::$options['instagram'],
			],
			'skype'     => [
				'icon' => 'fab fa-skype',
				'url'  => MyTheme::$options['skype'],
			],
		];

		return array_filter( $mytheme_socials, [ __CLASS__, 'filter_social' ] );
	}

	/**
	 * Post share to social link
	 * @return array
	 */
	public static function post_share_on_social() {
		$sharer = [];
		if ( MyTheme::$options['social_facebook'] ) {
			$sharer[] = 'facebook';
		}
		if ( MyTheme::$options['social_twitter'] ) {
			$sharer[] = 'twitter';
		}
		if ( MyTheme::$options['social_linkedin'] ) {
			$sharer[] = 'linkedin';
		}
		if ( MyTheme::$options['social_pinterest'] ) {
			$sharer[] = 'pinterest';
		}
		if ( MyTheme::$options['social_tumblr'] ) {
			$sharer[] = 'tumblr';
		}
		if ( MyTheme::$options['social_reddit'] ) {
			$sharer[] = 'reddit';
		}
		if ( MyTheme::$options['social_vk'] ) {
			$sharer[] = 'vk';
		}
		if ( MyTheme::$options['social_whatsapp'] ) {
			$sharer[] = 'whatsapp';
		}
		if ( MyTheme::$options['social_telegram'] ) {
			$sharer[] = 'telegram';
		}
		if ( MyTheme::$options['social_skype'] ) {
			$sharer[] = 'skype';
		}
		if ( MyTheme::$options['social_email'] ) {
			$sharer[] = 'email';
		}
		if ( MyTheme::$options['social_pocket'] ) {
			$sharer[] = 'pocket';
		}

		return $sharer;
	}

	/**
	 * Check social link exist or not
	 *
	 * @param $args
	 *
	 * @return bool
	 */
	public static function filter_social( $args ) {
		return ( $args['url'] != '' );
	}

	/**
	 * Get user social information
	 *
	 * @param $social_links
	 *
	 * @return void
	 */
	public static function get_user_social_info( $social_links ) {
		if ( count( $social_links ) < 1 && ! is_array( $social_links ) ) {
			return;
		}
		ob_start();
		?>
        <ul class="agent-social">
            <li class="social-item">
                <a href="#" class="social-hover-icon social-link">
                    <i class="fas fa-share-alt"></i>
                </a>
                <ul class="team-social-dropdown">
					<?php foreach ( $social_links as $icon ) : ?>

                        <li class="social-item">
                            <a
                                    href="<?php echo esc_html( $icon['social_link'] ) ?>"
                                    class="social-link" target="_blank"
                                    title="<?php echo esc_html( $icon['social_title'] ) ?>">
								<?php \Elementor\Icons_Manager::render_icon( $icon['social_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                            </a>
                        </li>

					<?php endforeach; ?>
                </ul>
            </li>
        </ul>
		<?php
		echo ob_get_clean();
	}

	/**
	 * Make ago time | Time Elapsed
	 * @return string|void
	 */
	public static function time_elapsed_string() {
		$ptime = get_the_time( 'U' );
		$etime = time() - $ptime;

		if ( $etime < 1 ) {
			return '0 seconds';
		}

		$a        = [
			365 * 24 * 60 * 60 => 'year',
			30 * 24 * 60 * 60  => 'month',
			24 * 60 * 60       => 'day',
			60 * 60            => 'hour',
			60                 => 'minute',
			1                  => 'second',
		];
		$a_plural = [
			'year'   => 'years',
			'month'  => 'months',
			'day'    => 'days',
			'hour'   => 'hours',
			'minute' => 'minutes',
			'second' => 'seconds',
		];

		foreach ( $a as $secs => $str ) {
			$d = $etime / $secs;
			if ( $d >= 1 ) {
				$r = round( $d );

				return $r . ' ' . ( $r > 1 ? $a_plural[ $str ] : $str ) . ' ago';
			}
		}
	}

	/**
	 * Post reading time calculate
	 *
	 * @param $content
	 * @param $is_zero
	 * @param $reading_suffix
	 *
	 * @return string
	 */
	public static function reading_time_count( $content = '', $is_zero = false, $reading_suffix = '' ) {
		global $post;
		$post_content = $content ? $content : $post->post_content; // wordpress users only
		$word         = str_word_count( strip_tags( strip_shortcodes( $post_content ) ) );
		$m            = floor( $word / 200 );
		$s            = floor( $word % 200 / ( 200 / 60 ) );
		if ( $is_zero && $m < 10 ) {
			$m = '0' . $m;
		}
		if ( $is_zero && $s < 10 ) {
			$s = '0' . $s;
		}
		$suffix = $reading_suffix ? " " . $reading_suffix : null;
		if ( $m < 1 ) {
			return $s . ' Second' . ( $s == 1 ? '' : 's' ) . $suffix;
		}

		return $m . ' Min' . ( $m == 1 ? '' : 's' ) . $suffix;
	}

	/**
	 * Make lighten or darken color
	 *
	 * @param $hex
	 * @param $steps
	 *
	 * @return string
	 */
	public static function rt_modify_color( $hex, $steps ) {
		$steps = max( - 255, min( 255, $steps ) );
		// Format the hex color string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}
		// Get decimal values
		$r = hexdec( substr( $hex, 0, 2 ) );
		$g = hexdec( substr( $hex, 2, 2 ) );
		$b = hexdec( substr( $hex, 4, 2 ) );
		// Adjust number of steps and keep it inside 0 to 255
		$r     = max( 0, min( 255, $r + $steps ) );
		$g     = max( 0, min( 255, $g + $steps ) );
		$b     = max( 0, min( 255, $b + $steps ) );
		$r_hex = str_pad( dechex( $r ), 2, '0', STR_PAD_LEFT );
		$g_hex = str_pad( dechex( $g ), 2, '0', STR_PAD_LEFT );
		$b_hex = str_pad( dechex( $b ), 2, '0', STR_PAD_LEFT );

		return '#' . $r_hex . $g_hex . $b_hex;
	}

	/**
	 * Check meta and customizer value
	 *
	 * @param $post_id
	 * @param $key
	 *
	 * @return mixed|string
	 */
	public static function rt_get_meta_option( $post_id, $key ) {
		$op_value   = MyTheme::$options[ $key ];
		$meta_value = get_post_meta( $post_id, $key, true );

		if ( $meta_value !== 'default' && ! empty( $meta_value ) ) {
			$op_value = $meta_value;
		}

		return $op_value;

	}

	/**
	 * Number Shorten
	 *
	 * @param $number
	 * @param $precision
	 * @param $divisors
	 *
	 * @return mixed|string
	 */
	public static function rt_number_shorten( $number, $precision = 3, $divisors = null ) {
		if ( $number < 1000 ) {
			return $number;
		}

		$thousand    = _x( 'K', 'Thousand Shorthand', 'mytheme' );
		$million     = _x( 'M', 'Million Shorthand', 'mytheme' );
		$billion     = _x( 'B', 'Billion Shorthand', 'mytheme' );
		$trillion    = _x( 'T', 'Trillion Shorthand', 'mytheme' );
		$quadrillion = _x( 'Qa', 'Quadrillion Shorthand', 'mytheme' );
		$quintillion = _x( 'Qi', 'Quintillion Shorthand', 'mytheme' );

		$shorthand_label = apply_filters( 'mytheme_shorthand_price_label', [
			'thousand'    => $thousand,
			'million'     => $million,
			'billion'     => $billion,
			'trillion'    => $trillion,
			'quadrillion' => $quadrillion,
			'quintillion' => $quintillion
		] );

		// Setup default $divisors if not provided
		if ( ! isset( $divisors ) ) {
			$divisors = [
				pow( 1000, 0 ) => '', // 1000^0 == 1
				pow( 1000, 1 ) => isset( $shorthand_label['thousand'] ) ? $shorthand_label['thousand'] : $thousand,
				pow( 1000, 2 ) => isset( $shorthand_label['million'] ) ? $shorthand_label['million'] : $million,
				pow( 1000, 3 ) => isset( $shorthand_label['billion'] ) ? $shorthand_label['billion'] : $billion,
				pow( 1000, 4 ) => isset( $shorthand_label['trillion'] ) ? $shorthand_label['trillion'] : $trillion,
				pow( 1000, 5 ) => isset( $shorthand_label['quadrillion'] ) ? $shorthand_label['quadrillion'] : $quadrillion,
				pow( 1000, 6 ) => isset( $shorthand_label['quintillion'] ) ? $shorthand_label['quintillion'] : $quintillion,
			];
		}


		// Loop through each $divisor and find the
		// lowest amount that matches
		foreach ( $divisors as $divisor => $shorthand ) {
			if ( abs( $number ) < ( $divisor * 1000 ) ) {
				// We found a match!
				break;
			}
		}

		// We found our match, or there were no matches.
		// Either way, use the last defined value for $divisor.

		$shorthand_price = apply_filters( 'mytheme_shorthand_price', number_format( $number / $divisor, $precision ) );

		return self::rt_remove_unnecessary_zero( $shorthand_price ) . "<span class='price-shorthand'>{$shorthand}</span>";
	}

	/**
	 * Number to K, Lac, Cr convert
	 *
	 * @param $number
	 *
	 * @return mixed|string
	 */
	public static function number_to_lac( $number, $precision = 1 ) {

		$hundred   = '';
		$thousand  = _x( 'K', 'Thousand Shorthand', 'mytheme' );
		$thousands = _x( 'K', 'Thousands Shorthand', 'mytheme' );
		$lac       = _x( ' Lac', 'Lac Shorthand', 'mytheme' );
		$lacs      = _x( ' Lacs', 'Lacs Shorthand', 'mytheme' );
		$cr        = _x( ' Cr', 'Cr Shorthand', 'mytheme' );
		$crs       = _x( ' Crs', 'Crs Shorthand', 'mytheme' );

		$shorthand_label = apply_filters( 'mytheme_shorthand_price_label_2', [
			'hundred'   => $hundred,
			'thousand'  => $thousand,
			'thousands' => $thousands,
			'lac'       => $lac,
			'lacs'      => $lacs,
			'crore'     => $cr,
			'crores'    => $crs,
		] );

		if ( $number == 0 ) {
			return '';
		} else {

			$n_count = strlen( self::rt_remove_unnecessary_zero( $number, '1' ) ); // 7
			switch ( $n_count ) {
				case 3:
					$val       = $number / 100;
					$val       = number_format( $val, $precision );
					$shorthand = ( isset( $shorthand_label['hundred'] ) ? $shorthand_label['hundred'] : $hundred );
					$finalval  = self::rt_remove_unnecessary_zero( $val ) . "<span class='price-shorthand'>{$shorthand}</span>";
					break;
				case 4:
					$val       = $number / 1000;
					$val       = number_format( $val, $precision );
					$shorthand = ( isset( $shorthand_label['thousand'] ) ? $shorthand_label['thousand'] : $thousand );
					$finalval  = self::rt_remove_unnecessary_zero( $val ) . "<span class='price-shorthand'>{$shorthand}</span>";
					break;
				case 5:
					$val       = $number / 1000;
					$val       = number_format( $val, $precision );
					$shorthand = ( isset( $shorthand_label['thousands'] ) ? $shorthand_label['thousands'] : $thousands );
					$finalval  = self::rt_remove_unnecessary_zero( $val ) . "<span class='price-shorthand'>{$shorthand}</span>";
					break;
				case 6:
					$val       = $number / 100000;
					$val       = number_format( $val, $precision );
					$shorthand = ( isset( $shorthand_label['lac'] ) ? $shorthand_label['lac'] : $lac );
					$finalval  = self::rt_remove_unnecessary_zero( $val ) . "<span class='price-shorthand'>{$shorthand}</span>";
					break;
				case 7:
					$val       = $number / 100000;
					$val       = number_format( $val, $precision );
					$shorthand = ( isset( $shorthand_label['lacs'] ) ? $shorthand_label['lacs'] : $lacs );
					$finalval  = self::rt_remove_unnecessary_zero( $val ) . "<span class='price-shorthand'>{$shorthand}</span>";
					break;
				case 8:
					$val       = $number / 10000000;
					$val       = number_format( $val, $precision );
					$shorthand = ( isset( $shorthand_label['crore'] ) ? $shorthand_label['crore'] : $cr );
					$finalval  = self::rt_remove_unnecessary_zero( $val ) . "<span class='price-shorthand'>{$shorthand}</span>";
					break;
				case 8 < $n_count:
					$val       = $number / 10000000;
					$val       = number_format( $val, $precision );
					$shorthand = ( isset( $shorthand_label['crores'] ) ? $shorthand_label['crores'] : $crs );
					$finalval  = self::rt_remove_unnecessary_zero( $val ) . "<span class='price-shorthand'>{$shorthand}</span>";
					break;
				default:
					$finalval = $number;
			}

			return $finalval;

		}
	}

	/**
	 * Remove unnecessary zero after point
	 *
	 * @param $value
	 *
	 * @return mixed|string
	 */
	public static function rt_remove_unnecessary_zero( $value, $return_type = '' ) {

		if ( strpos( $value, '.' ) ) {
			[ $a, $b ] = explode( ".", $value );

			if ( $return_type == '1' ) {
				return $a;
			}

			if ( $return_type == '2' ) {
				return $b;
			}

			if ( ! array_filter( str_split( $b ) ) ) {
				$value = $a;
			} else {
				$value = $a . '.' . rtrim( $b, '0' );
			}
		}

		return $value;
	}

	/**
	 * Custom pagination for page template
	 *
	 * @param $query
	 *
	 * @return string|void
	 */
	static function mytheme_list_posts_pagination( $query = '' ) {
		if ( ! $query ) {
			global $query;
		}
		if ( $query->max_num_pages > 1 ) :
			$big   = 999999999; // need an unlikely integer
			$items = paginate_links( [
				'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
				'format'    => '?paged=%#%',
				'prev_next' => true,
				'current'   => max( 1, get_query_var( 'paged' ) ),
				'total'     => $query->max_num_pages,
				'type'      => 'array',
				'prev_text' => '<i class="fas fa-angle-double-left"></i>',
				'next_text' => '<i class="fas fa-angle-double-right"></i>',
			] );

			$pagination = '<div class="pagination-number"><ul class="pagination clearfix"><li>';
			$pagination .= join( "</li><li>", (array) $items );
			$pagination .= "</li></ul></div>";

			return $pagination;
		endif;

		return '';
	}

	/**
	 * Get Listing author image
	 *
	 * @param $listing
	 * @param $size
	 * @param $default
	 * @param $args
	 *
	 * @return void
	 */
	static public function get_listing_author_iamge( $listing, $size = 40, $default = 'Author', $args = [] ) {
		$manager_id = get_post_meta( $listing->get_id(), '_rtcl_manager_id', true );
		$owner_id   = $manager_id ? $manager_id : $listing->get_owner_id();
		$pp_id      = absint( get_user_meta( $owner_id, '_rtcl_pp_id', true ) );
		if ( $pp_id ) {
			echo wp_get_attachment_image( $pp_id, [ $size, $size ] );
		} else {
			echo get_avatar( $listing->get_author_id(), $size );
		}
	}

	/**
	 * Get Mytheme thumb carousel markup
	 *
	 * @param        $listing_id
	 * @param string $size
	 */

	public static function mytheme_thumb_carousel( $listing_id, $size = 'rtcl-thumbnail' ) { ?>
        <div class="listing-archive-carousel">
            <div class="swiper-wrapper">
				<?php $images = Functions::get_listing_images( $listing_id ); ?>
				<?php foreach ( $images as $index => $image ): ?>
					<?php $thumb_img = wp_get_attachment_image_src( $image->ID, $size ); ?>
                    <div class="swiper-slide">
                        <div class="thumbnail-bg" style="background-image:url(<?php echo esc_url( $thumb_img[0] ) ?>)">
                            <a class="listing-link" href="<?php echo esc_attr( get_the_permalink( $listing_id ) ) ?>"></a>
                        </div>
                    </div>
				<?php endforeach; ?>
            </div>
            <div class="listing-archive-pagination">
                <div class="swiper-button-prev listing-navigation">
                    <i class="fas fa-angle-left"></i>
                </div>
                <div class="swiper-button-next listing-navigation">
                    <i class="fas fa-angle-right"></i>
                </div>
            </div>
        </div>
		<?php
	}

	/**
	 * Get Date Archive Link
	 * @return string
	 */
	public static function get_date_archive_link() {
		$archive_year  = get_the_date( 'Y' );
		$archive_month = get_the_date( 'm' );
		$archive_day   = get_the_date( 'j' );

		return get_day_link( $archive_year, $archive_month, $archive_day );
	}

	/**
	 * @param int $user_id
	 * @param $options
	 *
	 * @return array
	 */
	public static function get_user_listing_ids( int $user_id, $options = [] ): array {
		if ( ! absint( $user_id ) ) {
			return [];
		}
		$args = [
			'post_type'      => rtcl()->post_type,
			'post_status'    => 'publish',
			'posts_per_page' => ! empty( $options['listings_per_page'] ) ? absint( $options['listings_per_page'] ) : - 1,
			'paged'          => ! empty( $options['paged'] ) ? absint( $options['paged'] ) : 1,
			'author'         => $user_id,
			'fields'         => 'ids',
		];

		$results = new \WP_Query( apply_filters( 'mytheme_get_user_listing_ids', $args ) );
		if ( ! empty( $results->posts ) ) {
			return $results->posts;
		}

		return [];
	}

	/**
	 * Get all posts type
	 * @return array
	 */
	public static function get_post_types() {
		$post_types = get_post_types(
			[
				'public'            => true,
				'show_in_nav_menus' => true,
			],
			'objects'
		);
		$post_types = wp_list_pluck( $post_types, 'label', 'name' );

		$exclude = [ 'attachment', 'revision', 'nav_menu_item', 'elementor_library', 'tpg_builder', 'e-landing-page', 'page' ];

		foreach ( $exclude as $ex ) {
			unset( $post_types[ $ex ] );
		}

		return $post_types;
	}


	/**
	 * Homlist html print
	 *
	 * @param $html
	 *
	 * @return string
	 */
	public static function mytheme_kses( $html ) {
		$allowed_html = [
			'a'      => [
				'href'   => [],
				'title'  => [],
				'class'  => [],
				'target' => [],
			],
			'br'     => [],
			'em'     => [],
			'strong' => [],
			'i'      => [
				'class' => []
			],
			'iframe' => [
				'class'                 => [],
				'id'                    => [],
				'name'                  => [],
				'src'                   => [],
				'title'                 => [],
				'frameBorder'           => [],
				'width'                 => [],
				'height'                => [],
				'scrolling'             => [],
				'allowvr'               => [],
				'allow'                 => [],
				'allowFullScreen'       => [],
				'webkitallowfullscreen' => [],
				'mozallowfullscreen'    => [],
				'loading'               => [],
			],
		];

		return wp_kses( $html, $allowed_html );
	}

}
