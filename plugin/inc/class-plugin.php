<?php

/**
 * Main class Recaptcha_Lightweight_Adaptation.
 *
 * @since 1.0.0
 *
 * @package    Recaptcha_Lightweight_Adaptation
 * @subpackage Recaptcha_Lightweight_Adaptation/inc
 */
class Recaptcha_Lightweight_Adaptation_Plugin {

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var string $plugin_name ID of the plugin.
	 */
	protected static $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var string $version The current version of the plugin.
	 */
	protected static $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since 1.0.0
	 */
	public static function __construct() {
		self::$plugin_name = 'recaptcha_lightweight_adaptation';
		self::$version = '1.0.0';
	}

	public static function load_dependencies() {
		if( is_admin() ) {
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-recaptcha-lightweight-adaptation-admin.php';
		}
		else {
			//require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class';
		}
	}

	public static function translate() {

	}

	public static function run() {
		/**
		 * Decide which files will be loaded.
		 */
		self::load_dependencies();

		/**
		 * Load translates.
		 */

		/**
		 *
		 */
	}
}