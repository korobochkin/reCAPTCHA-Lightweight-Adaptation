<?php
// Добавление капчки на страницу регистрации, проверка данных формы, вывод ошибок.
/**
 * Class Recaptcha_Lightweight_Adaptation_WP_Login
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_WP_Login {

	/**
	 * Add stuff on wp-login.php page.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		$settings = get_option( 'recaptcha_lightweight_adaptation' );
		if( !empty( $settings['locations'] ) && is_array( $settings['locations'] ) ) {
			// Script for all
			add_action( 'login_enqueue_scripts', array( __CLASS__, 'scripts' ) );

			if( in_array( 'register', $settings['locations'] ) ) {
				add_action( 'register_form', array( __CLASS__, 'render' ) );
				add_filter( 'registration_errors', array( __CLASS__, 'registration_errors' ), 10, 3 );
			}
			if( in_array( 'lostpassword', $settings['locations'] ) ) {
				add_action( 'lostpassword_form', array( __CLASS__, 'render' ) );
				add_filter( 'allow_password_reset', array( __CLASS__, 'allow_password_reset' ), 10, 2 );
			}
		}





		/*add_action( 'wp_enqueue_scripts', array( __CLASS__, 'scripts_styles' ) );
		add_action( 'login_enqueue_scripts', array( __CLASS__, 'scripts_styles' ) );
		*/
	}

	/**
	 * Scripts.
	 *
	 * @since 1.0.0
	 */
	public static function scripts() {
		wp_enqueue_script( 'google-recaptcha' );
	}

	/**
	 * Print the widget.
	 *
	 * @since 1.0.0
	 */
	public static function render() {
		echo '<div style="margin: 10px 0;">';
		Recaptcha_Lightweight_Adaptation_Captcha::render();
		echo '</div>';
	}

	/**
	 * Validate form submit.
	 *
	 * @since 1.0.0
	 *
	 * @param $errors
	 * @param $sanitized_user_login
	 * @param $user_email
	 *
	 * @return mixed
	 */
	public static function registration_errors( $errors, $sanitized_user_login, $user_email ) {
		if( !empty( $_POST['g-recaptcha-response'] ) ) {
			$validate = Recaptcha_Lightweight_Adaptation_API::validate( $_POST['g-recaptcha-response'] );
			//$validate = Recaptcha_Lightweight_Adaptation_API::validate( 'jkhkjh' );

			// Not a robot
			if( $validate === true ) {
				return $errors;
			}
			// Errors with captcha
			elseif( is_wp_error( $validate ) ) {
				if( !empty( $validate->errors ) ) {
					foreach( $validate->errors as $code => $new_error ) {
						$errors->add( $code, '<strong>ERROR</strong> ' . $new_error[0] );
					}
				}
				else {
					// We have errors object but no errors inside.
					$errors->add( 'unknown_result_of_recaptcha_validation', __( '<strong>ERROR</strong> Unknown result of the Recaptcha Light Adaptation plugin validation process.', 'recaptcha_lightweight_adaptation' ) );
				}
			}
			// Errors with captcha
			else {
				// Unknown result after validation
				$errors->add( 'unknown_result_of_recaptcha_validation', __( '<strong>ERROR</strong> Unknown result of the Recaptcha Light Adaptation plugin validation process.', 'recaptcha_lightweight_adaptation' ) );
			}
		}
		else {
			$errors->add( 'missing_recaptcha_code', __( '<strong>ERROR</strong>. Checkin „I’m not a robot“ checkbox.', 'recaptcha_lightweight_adaptation' ) );
		}

		return $errors;
	}

	/**
	 * Validate pass reset submit.
	 *
	 * @submit 1.0.0
	 *
	 * @param $result
	 * @param $user_id
	 *
	 * @return WP_Error
	 */
	public static function allow_password_reset( $result, $user_id ) {
		$validate = self::default_validate();
		if( is_wp_error( $validate ) ) {
			return $validate;
		}
		elseif( $validate === true ) {
			return $result;
		}
		return $result;
	}

	/**
	 * Default validate submit.
	 *
	 * @since 1.0.0
	 *
	 * @return bool|WP_Error
	 */
	public static function default_validate() {
		$errors = new WP_Error();

		if( !empty( $_POST['g-recaptcha-response'] ) ) {
			$validate = Recaptcha_Lightweight_Adaptation_API::validate( $_POST['g-recaptcha-response'] );
			//$validate = Recaptcha_Lightweight_Adaptation_API::validate( 'jkhkjh' );

			// Not a robot
			if( $validate === true ) {
				return true;
			}
			// Errors with captcha
			elseif( is_wp_error( $validate ) ) {
				if( !empty( $validate->errors ) ) {
					foreach( $validate->errors as $code => $new_error ) {
						$errors->add( $code, '<strong>ERROR</strong> ' . $new_error[0] );
					}
				}
				else {
					// We have errors object but no errors inside.
					$errors->add( 'unknown_result_of_recaptcha_validation', __( '<strong>ERROR</strong> Unknown result of the Recaptcha Light Adaptation plugin validation process.', 'recaptcha_lightweight_adaptation' ) );
				}
			}
			// Errors with captcha
			else {
				// Unknown result after validation
				$errors->add( 'unknown_result_of_recaptcha_validation', __( '<strong>ERROR</strong> Unknown result of the Recaptcha Light Adaptation plugin validation process.', 'recaptcha_lightweight_adaptation' ) );
			}
		}
		else {
			$errors->add( 'missing_recaptcha_code', __( '<strong>ERROR</strong>. Checkin „I’m not a robot“ checkbox.', 'recaptcha_lightweight_adaptation' ) );
		}

		return $errors;
	}
}
