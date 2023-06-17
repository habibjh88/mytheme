<?php
/**
 * @author  MyTheme
 * @since   1.0
 * @version 1.0
 */

namespace MyTheme;

class TGM_Config {

	public $base;
	public $path;

	public function __construct() {
		$this->base = 'mytheme';
		$this->path = Constants::$theme_plugins_dir;

		add_action( 'tgmpa_register', [ $this, 'register_required_plugins' ] );
	}

	public function register_required_plugins() {
		$plugins = [
			// Bundled
			[
				'name'     => 'MyTheme Core',
				'slug'     => 'mytheme-core',
				'source'   => 'mytheme-core.zip',
				'required' => true,
				'version'  => '1.6.15',
			],

			// Repository
			[
				'name'     => 'WP Fluent Forms',
				'slug'     => 'fluentform',
				'required' => false,
			],
			[
				'name'     => 'Elementor Website Builder',
				'slug'     => 'elementor',
				'required' => true,
			],
		];

		$config = [
			'id'           => $this->base,            // Unique ID for hashing notices for multiple instances of TGMPA.
			'default_path' => $this->path,              // Default absolute path to bundled plugins.
			'menu'         => $this->base . '-install-plugins', // Menu slug.
			'has_notices'  => true,                    // Show admin notices or not.
			'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
			'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
			'is_automatic' => false,                    // Automatically activate plugins after installation or not.
			'message'      => '',                      // Message to output right before the plugins table.
		];

		tgmpa( $plugins, $config );
	}

}

new TGM_Config;