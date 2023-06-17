<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme;


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
	public static function get_maybe_rtl_css( $filename, $rtlfilename ) {
		if ( is_rtl() ) {
			$path = '/assets/css/' . $rtlfilename . '.css';

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

		$exclude = [
			'attachment',
			'revision',
			'nav_menu_item',
			'elementor_library',
			'tpg_builder',
			'e-landing-page',
			'page'
		];

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
