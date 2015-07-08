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
	 *
	 */
	public static function init() {
		// Register admin pages
		add_action( 'admin_menu', array( 'Recaptcha_Lightweight_Adaptation_Admin_Settings', 'register_pages' ) );

		// Sections
		add_action( 'admin_init', array( 'Recaptcha_Lightweight_Adaptation_Admin_Settings', 'register_settings' ) );

		// Добавляем ссылку на настройку плагина
	}

	/**
	 * Output the row actions links on the WordPress Plugins list page.
	 */
	public static function plugin_row_actions() {
		//add_filter( 'plugin_action_links_' . WPSEO_BASENAME, array( $this, 'add_action_link' ), 10, 2 );
	}
}
