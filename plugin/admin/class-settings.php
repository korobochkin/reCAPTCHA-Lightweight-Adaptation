<?php

class Recaptcha_Lightweight_Adaptation_Admin_Settings {

	/**
	 * @var
	 */
	public static $pages = array();

	public static $settings = array();

	public static $sections = array();

	public static $fields = array();

	public static function register_pages() {
		self::$pages['general'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Page(
			__( 'Recaptcha lightweight adaptation', 'recaptcha_lightweight_adaptation' ),
			'recaptcha_lightweight_adaptation_general'
		);
		add_submenu_page(
			'options-general.php',
			__( 'Recaptcha lightweight adaptation', 'recaptcha_lightweight_adaptation' ),
			__( 'Recaptcha', 'recaptcha_lightweight_adaptation' ),
			'manage_options',
			'recaptcha-lightweight-adaptation',
			array( self::$pages['general'], 'render' )
		);
	}

	public static function register_settings() {
		// Settings
		self::$settings['general'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Setting_General( 'recaptcha_lightweight_adaptation' );
		register_setting( 'recaptcha_lightweight_adaptation_general', 'recaptcha_lightweight_adaptation', array( self::$settings['general'], 'sanitize' ) );



		// Sections
		// Keys
		self::$sections['general']['keys'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Section(
			__( 'This keys settings are required. You can get it on <a href="https://www.google.com/recaptcha/admin">Google reCAPTCHA Admin</a> page.', 'recaptcha_lightweight_adaptation' )
		);
		add_settings_section(
			'keys',
			__( 'Secret keys', 'recaptcha_lightweight_adaptation' ),
			array( self::$sections['general']['keys'], 'render' ),
			'recaptcha_lightweight_adaptation_general'
		);

		// View
		self::$sections['general']['view'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Section(
			__( 'Visual settings of the Captcha block (widget).', 'recaptcha_lightweight_adaptation' )
		);
		add_settings_section(
			'view',
			__( 'View', 'recaptcha_lightweight_adaptation' ),
			array( self::$sections['general']['view'], 'render' ),
			'recaptcha_lightweight_adaptation_general'
		);

		// Where to show
		self::$sections['general']['locations'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Section(
			__( 'Where to show Recaptcha widget (and validate).', 'recaptcha_lightweight_adaptation' )
		);
		add_settings_section(
			'locations',
			__( 'Locations', 'recaptcha_lightweight_adaptation' ),
			array( self::$sections['general']['locations'], 'render' ),
			'recaptcha_lightweight_adaptation_general'
		);



		// Fields
		// Site Key
		self::$fields['general']['keys']['site_key'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Field(
			array( 'recaptcha_lightweight_adaptation', 'site_key' )
		);
		add_settings_field(
			'site_key',
			__( 'Site key', 'recaptcha_lightweight_adaptation' ),
			array( self::$fields['general']['keys']['site_key'], 'render' ),
			'recaptcha_lightweight_adaptation_general',
			'keys'
		);

		// Secret Key
		self::$fields['general']['keys']['secret_key'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Field(
			array( 'recaptcha_lightweight_adaptation', 'secret_key' )
		);
		add_settings_field(
			'secret_key',
			__( 'Secret key', 'recaptcha_lightweight_adaptation' ),
			array( self::$fields['general']['keys']['secret_key'], 'render' ),
			'recaptcha_lightweight_adaptation_general',
			'keys'
		);

		// Theme (dark | light)
		self::$fields['general']['view']['theme'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Field_Radio(
			array( 'recaptcha_lightweight_adaptation', 'theme' ),
			array(
				'light' => __( 'Light', 'recaptcha_lightweight_adaptation' ),
				'dark' => __( 'Dark', 'recaptcha_lightweight_adaptation' )
			)
		);
		add_settings_field(
			'theme',
			__( 'The color theme of the widget', 'recaptcha_lightweight_adaptation' ),
			array( self::$fields['general']['view']['theme'], 'render' ),
			'recaptcha_lightweight_adaptation_general',
			'view'
		);

		// Language
		self::$fields['general']['view']['language'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Field(
			array( 'recaptcha_lightweight_adaptation', 'language' ),
			__( 'You can specify many of languages for Captcha widget. The list of available lanuage codes at <a href="https://developers.google.com/recaptcha/docs/language" target="_blank">Google Language codes</a>.', 'recaptcha_lightweight_adaptation' )
		);
		add_settings_field(
			'language',
			__( 'Language', 'recaptcha_lightweight_adaptation' ),
			array( self::$fields['general']['view']['language'], 'render' ),
			'recaptcha_lightweight_adaptation_general',
			'view'
		);

		// Locations
		// Theme (dark | light)
		self::$fields['general']['locations']['locations'] = new Recaptcha_Lightweight_Adaptation_Admin_Settings_Field_Checkbox(
			array( 'recaptcha_lightweight_adaptation', 'locations' ),
			array(
				'register' => __( 'The signup page (<code>wp-login.php?action=register</code>).', 'recaptcha_lightweight_adaptation' ),
				'lostpassword' => __( 'The reset password page (<code>wp-login.php?action=lostpassword</code>).', 'recaptcha_lightweight_adaptation' )
			)
		);
		add_settings_field(
			'locations',
			__( 'The pages which shows up the Recaptcha widget', 'recaptcha_lightweight_adaptation' ),
			array( self::$fields['general']['locations']['locations'], 'render' ),
			'recaptcha_lightweight_adaptation_general',
			'locations'
		);
	}
}
