<?php
// Собственно, сама капча: вывод капчи, методы для проверки подлинности капчи и взаимодействие с API
// Все остальное должно использовать лишь функции отсюда.
class Recaptcha_Lightweight_Adaptation_Captcha {

	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts_styles' ) );
		add_action( 'login_enqueue_scripts', array( __CLASS__, 'scripts_styles' ) );
		//self::scripts_styles();
	}

	public static function scripts_styles() {
		wp_register_script(
			'google-recaptcha',
			'//www.google.com/recaptcha/api.js',
			array(),
			'1.0.0',
			true
		);
	}

	public static function render( $callback_name = 'recaptcha_wp_callback' ) {
		$options = get_option( 'recaptcha_lightweight_adaptation' );
		if( !empty( $options['site_key'] ) && is_string( $options['site_key'] ) ) {
			printf(
				'<div class="g-recaptcha" data-sitekey="%s" data-callback="%s" data-size="compact"></div>',
				$options['site_key'],
				$callback_name
			);
		}
	}
}
