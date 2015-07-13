<?php
/*
Plugin Name: reCAPTCHA Lightweight Adaptation
Plugin URI:  https://github.com/korobochkin/reCAPTCHA-lightweight-adaptation
Description: A lightweight Google reCAPTCHA adaptation. This plugin provides the ability to add reCAPTCHA on Sign Up and Reset password pages. Easy API and methods also available for your custom reCAPTCHA integration in the other places of your site.
Version:     1.0.0
Author:      Kolya Korobochkin
Author URI:  http://korobochkin.com/
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Domain Path: /languages
Text Domain: recaptcha_lightweight_adaptation
*/

/**
 * Load the main plugin class.
 */
require 'inc/class-plugin.php';
Recaptcha_Lightweight_Adaptation_Plugin::run();
