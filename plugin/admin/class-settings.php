<?php

class Recaptcha_Lightweight_Adaptation_Admin_Settings {

	/**
	 * @var
	 */
	public static $pages = array();

	public static $settings = array();

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

		// Settings
		self::$settings['recaptcha_lightweight_adaptation_general'] = array(
			'recaptcha_lightweight_adaptation',
			'Recaptcha_Lightweight_Adaptation_Admin_Settings_Setting'
		);

		// Sections
		self::$sections['recaptcha_lightweight_adaptation_general'] = array(
			'settings' => array (
				'keys',
				__( 'Secret keys', 'recaptcha_lightweight_adaptation' ),
				'Recaptcha_Lightweight_Adaptation_Admin_Settings_Section',
			),
			'content' => __( 'This keys settings are required. You can get it on <a href="https://www.google.com/recaptcha/admin">Google reCAPTCHA Admin</a> page.', 'recaptcha_lightweight_adaptation' )
		);
	}

	public static function register_pages() {
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'class-settings-setting.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'class-settings-section.php';
	}

	public static function register_settings() {
		// Register settings
		if( !empty( self::$settings ) ) {
			foreach( self::$settings as $name => $value ) {
				register_setting( $name, $value[0], $value[1] );
			}
		}

		if( !empty( self::$sections ) ) {
			foreach ( self::$sections as $name => $value ) {
				if( empty( self::$sections[$name]['instance'] ) ) {
					self::$sections[$name]['instance'] = new $value['settings'][2]( $value['content'] );
				}

				add_settings_section(
					$value['settings'][0],
					$value['settings'][1],
					array(
						self::$sections[$name]['instance'],
						'render'
					),
					$name
				);
			}
		}
	}
}
