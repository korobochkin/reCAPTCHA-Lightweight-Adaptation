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
	 * @var
	 */
	public static $pages;

	/**
	 *
	 */
	public static function __construct() {
		self::$pages = array (
			//'name_of_the_page' =>
		);
	}

	/**
	 *
	 */
	public static function pages() {
		//require_once() . 'admin/class-recaptcha-lighweight-adaptation-admin-general-settings.php';
	}

	/**
	 *
	 */
	public static function register_pages() {

	}

	/**
	 * Output the row actions links on the WordPress Plugins list page.
	 */
	public static function plugin_row_actions() {
		//add_filter( 'plugin_action_links_' . WPSEO_BASENAME, array( $this, 'add_action_link' ), 10, 2 );
	}
}
