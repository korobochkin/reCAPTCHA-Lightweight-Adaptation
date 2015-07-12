<?php
// Добавление капчки на страницу регистрации, проверка данных формы, вывод ошибок.
class Recaptcha_Lightweight_Adaptation_WP_Login {

	public static function init() {
		add_action( 'login_enqueue_scripts', array( __CLASS__, 'scripts' ) );
		add_action( 'register_form', array( __CLASS__, 'render' ) );

		/*add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts_styles' ) );
		add_action( 'login_enqueue_scripts', array( __CLASS__, 'scripts_styles' ) );
		*/
	}

	public static function scripts() {
		wp_enqueue_script( 'google-recaptcha' );
	}

	public static function render() {
		echo '<div style="margin: 10px 0;">';
		Recaptcha_Lightweight_Adaptation_Captcha::render();
		echo '</div>';
	}
}
