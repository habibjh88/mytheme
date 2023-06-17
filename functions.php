<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */


if ( ! isset( $content_width ) ) {
	$content_width = 1240;
}

class MyTheme_Main {

	public $theme = 'mytheme';
	public $action = 'mytheme_theme_init';

	public function __construct() {
		add_action( 'after_setup_theme', [ $this, 'load_textdomain' ] );
		$this->includes();
	}

	public function load_textdomain() {
		load_theme_textdomain( $this->theme, get_template_directory() . '/languages' );
	}

	public function includes() {
		require_once get_template_directory() . '/inc/constants.php';
		require_once get_template_directory() . '/inc/helper.php';
		require_once get_template_directory() . '/inc/includes.php';

		do_action( $this->action );
	}

}

new MyTheme_Main;