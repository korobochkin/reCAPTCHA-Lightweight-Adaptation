<?php

/**
 * Class Recaptcha_Lightweight_Adaptation_Admin for admin pages.
 *
 * @since 1.0.0
 *
 * @package    Recaptcha_Lightweight_Adaptation
 * @subpackage Recaptcha_Lightweight_Adaptation/admin
 */
class Recaptcha_Lightweight_Adaptation_Admin {

	/**
	 * Set up admin pages and settings.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		self::load_deps();

		// Register admin pages
		add_action( 'admin_menu', array( 'Recaptcha_Lightweight_Adaptation_Admin_Settings', 'register_pages' ) );

		// Sections
		add_action( 'admin_init', array( 'Recaptcha_Lightweight_Adaptation_Admin_Settings', 'register_settings' ) );

		// Добавляем ссылку на настройку плагина
	}

	/**
	 * Output the row actions links on the WordPress Plugins list page.
	 *
	 * @since 1.0.0
	 */
	public static function plugin_row_actions() {
		//add_filter( 'plugin_action_links_' . WPSEO_BASENAME, array( $this, 'add_action_link' ), 10, 2 );
	}

	/**
	 * Load classes for construct pages, sections and fields via Settings API.
	 *
	 * @since 1.0.0
	 */
	public static function load_deps() {
		require_once 'class-settings.php';
		require_once 'class-settings-page.php';
		require_once 'class-settings-setting.php';
			require_once 'class-settings-setting-general.php';
		require_once 'class-settings-section.php';
		require_once 'class-settings-field.php';
			require_once 'class-settings-field-radio.php';
			require_once 'class-settings-field-checkbox.php';
	}
}
