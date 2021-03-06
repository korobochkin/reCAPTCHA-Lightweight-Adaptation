<?php
// Собственно, сама капча: вывод капчи, методы для проверки подлинности капчи и взаимодействие с API
// Все остальное должно использовать лишь функции отсюда.
/**
 * Class Recaptcha_Lightweight_Adaptation_Captcha
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_Captcha {

	/**
	 * Require stuff.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts_styles' ) );
		add_action( 'login_enqueue_scripts', array( __CLASS__, 'scripts_styles' ) );
	}

	/**
	 * Register scripts.
	 *
	 * @since 1.0.0
	 */
	public static function scripts_styles() {
		$options = get_option( 'recaptcha_lightweight_adaptation' );
		if( !empty( $options['language'] ) ) {
			$hl = $options['language'];
		}
		else {
			$hl = 'en';
		}

		wp_register_script(
			'google-recaptcha',
			esc_url( add_query_arg( array( 'hl' => $hl ), '//www.google.com/recaptcha/api.js') ),
			array(),
			'1.0.0',
			true
		);
	}

	/**
	 * Echo the captcha widget.
	 *
	 * @since 1.0.0
	 *
	 * @param string $size Size of the widget.
	 * @param string $tabindex Input tabindex attr.
	 * @param string $callback JS callback.
	 * @param string $expired_callback JS exp callback.
	 */
	public static function render( $size = 'compact', $tabindex = 'none', $callback = 'recaptcha_wp_callback', $expired_callback = 'recaptcha_wp_expired_callback' ) {
		$options = get_option( 'recaptcha_lightweight_adaptation' );
		if( !empty( $options['site_key'] ) && is_string( $options['site_key'] ) ) {
			printf(
				'<div class="g-recaptcha" data-sitekey="%s" data-theme="%s" data-type="%s" data-size="%s" data-tabindex="%s" data-callback="%s" data-expired-callback="%s"></div>',
				esc_attr( $options['site_key'] ),
				esc_attr( ( !empty( $options['theme'] ) ? $options['theme'] : 'light' ) ),
				'',
				esc_attr( $size ),
				esc_attr( $tabindex ),
				esc_attr( $callback ),
				esc_attr( $expired_callback )
			);
		}
	}
}
