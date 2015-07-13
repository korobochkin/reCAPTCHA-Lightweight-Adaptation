<?php

/**
 * Main class Recaptcha_Lightweight_Adaptation_Plugin.
 *
 * @since 1.0.0
 *
 * @package    Recaptcha_Lightweight_Adaptation_Plugin
 * @subpackage Recaptcha_Lightweight_Adaptation_Plugin/inc
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
	public static function init() {
		self::$plugin_name = 'recaptcha_lightweight_adaptation';
		self::$version = '1.0.0';
	}

	/**
	 * Load necessary files.
	 *
	 * @since 1.0.0
	 */
	public static function load_dependencies() {
		if( is_admin() ) {
			// The main admin file.
			require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-admin.php';
			Recaptcha_Lightweight_Adaptation_Admin::init();
		}

		// The main class for output captcha and other stuff
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'inc/class-captcha.php';
		Recaptcha_Lightweight_Adaptation_Captcha::init();

		// Google API
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'inc/class-api.php';
		Recaptcha_Lightweight_Adaptation_API::init();

		// Captcha on wp-login.php page
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wp-login.php';
	}

	/**
	 * Translation
	 *
	 * @since 1.0.0
	 */
	public static function translate() {

	}

	/**
	 * Run the all stuff.
	 *
	 * @since 1.0.0
	 */
	public static function run() {
		self::init();

		/**
		 * Decide which files will be loaded.
		 */
		self::load_dependencies();

		// Enable Recaptcha on wp-login.php page. You can disable this via remove_action().
		add_action( 'init', array( 'Recaptcha_Lightweight_Adaptation_WP_Login', 'init' ) );

		/**
		 * Load translates.
		 */

		/**
		 * Стоит написать здесь функционал создания настроек при активации плагина.
		 */
	}
}
