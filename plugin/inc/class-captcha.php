<?php
// Собственно, сама капча: вывод капчи, методы для проверки подлинности капчи и взаимодействие с API
// Все остальное должно использовать лишь функции отсюда.
class Recaptcha_Lightweight_Adaptation_Captcha {

	public static function scripts_styles() {
		wp_register_script(
			'google-recaptcha',
			'//www.google.com/recaptcha/api.js',
			array(),
			'1.0.0',
			true
		);
	}

	public static function render() {
		$options = get_option( 'recaptcha_lightweight_adaptation' );
		if( empty( $options['site_key'] ) && is_string( $options['site_key'] ) ) {
			printf(
				'<div class="g-recaptcha" data-sitekey="%s"></div>',
				$options['site_key']
			);
		}
	}
}
