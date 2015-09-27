<?php
namespace Korobochkin\RecaptchaLightweightAdaptation\Translations;
use Korobochkin\RecaptchaLightweightAdaptation\Plugin;

class Translations {

    public static function load_translations() {
        $kk = dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/';

        load_plugin_textdomain(
            Plugin::NAME,
            false,
            dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
        );
    }
}
