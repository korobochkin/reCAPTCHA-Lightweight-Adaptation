<?php
namespace Korobochkin\RecaptchaLightweightAdaptation;

/**
 * Main class Recaptcha_Lightweight_Adaptation_Plugin.
 *
 * @since 2.0.0
 *
 * @package    Recaptcha_Lightweight_Adaptation_Plugin
 * @subpackage Recaptcha_Lightweight_Adaptation_Plugin/inc
 */
class Plugin {

    /**
     * The unique identifier of this plugin.
     *
     * @since 2.0.0
     */
    const NAME = 'recaptcha_lightweight_adaptation';

    /**
     * The current version of the plugin.
     *
     * @since 2.0.0
     */
    const VERSION = '2.0.0';

    /**
     * Define the core functionality of the plugin.
     *
     * @since 2.0.0
     */
    public static function init() {

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
     * Run the all stuff.
     *
     * @since 1.0.0
     */
    public static function run() {

        // Translations
        Translations\Translations::load_translations();

        // Admin only
        if( is_admin() ) {
            //\Korobochkin\RecaptchaLightweightAdaptation\Admin::init();
        }

        // Enable Recaptcha on wp-login.php page. You can disable this via remove_action().
        //add_action( 'init', array( 'Recaptcha_Lightweight_Adaptation_WP_Login', 'init' ) );

        /**
         * Стоит написать здесь функционал создания настроек при активации плагина.
         */
    }
}
