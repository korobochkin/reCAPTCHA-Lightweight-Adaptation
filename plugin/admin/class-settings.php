<?php

class Recaptcha_Lightweight_Adaptation_Admin_Settings {

	/**
	 * @var
	 */
	public static $pages = array();

	public static $sections;

	/**
	 *
	 */
	public static function __construct() {
		self::$sections = array();

		self::load_deps();

		// General settings page
		self::$pages['recaptcha_lightweight_adaptation_general'] = array (
			'settings' => array(
				'options-general.php',
				__( 'Recaptcha lightweight adaptation', 'recaptcha_lightweight_adaptation' ),
				__( 'Recaptcha', 'recaptcha_lightweight_adaptation' ),
				'manage_options',
				'recaptcha-lightweight-adaptation',
				'Recaptcha_Lightweight_Adaptation_Admin_Settings_Page'
			)
		);

		// Sections
		self::$sections[] = '';
	}

	public static function setup_pages() {
		if( !empty( self::$pages ) ) {

			// Load and initialize each page
			foreach( self::$pages as $name => $page ) {

				if( empty( self::$pages[$name]['instance'] ) ) {
					self::$pages[$name]['instance'] = new $page['settings'][5](
						$page['settings'][1],
						$name
					);

					add_submenu_page(
						$page['settings'][0],
						$page['settings'][1],
						$page['settings'][2],
						$page['settings'][3],
						$page['settings'][4],
						array(
							self::$pages[$name]['instance'],
							'render'
						)
					);
				}

			}

		}
	}

	public static function load_deps() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'class-settings-page.php';
	}

	public static function settings_init() {
		// тут надо регистрировать секции и поля страницы
	}
}
