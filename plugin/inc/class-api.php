<?php
// Взаимодействие с API от Гугла
/**
 * Class Recaptcha_Lightweight_Adaptation_API
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_API {

	/**
	 * API Endpoint.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var string $url
	 */
	protected static $url;

	/**
	 * List of available API Errors.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var array $api_errors
	 */
	protected static $api_errors;

	/**
	 * List of the plugin errors.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var array $plugin_errors
	 */
	protected static $plugin_errors;

	/**
	 * Set up errors and other stuff.
	 *
	 * @since 1.0.0
	 */
	public static function init() {
		self::$url = 'https://www.google.com/recaptcha/api/siteverify';

		/**
		 * API errors from
		 * https://developers.google.com/recaptcha/docs/verify#error-code-reference
		 */
		self::$api_errors = array(
			'missing-input-secret' => __( 'The secret parameter is missing.', 'recaptcha_lightweight_adaptation' ),
			'invalid-input-secret' => __( 'The secret parameter is invalid or malformed.', 'recaptcha_lightweight_adaptation' ),
			'missing-input-response' => __( 'The response parameter is missing.', 'recaptcha_lightweight_adaptation' ),
			'invalid-input-response' => __( 'The response parameter is invalid or malformed.', 'recaptcha_lightweight_adaptation' ),
			/*'' => __( '', 'recaptcha_lightweight_adaptation' ),
			'' => __( '', 'recaptcha_lightweight_adaptation' ),
			'' => __( '', 'recaptcha_lightweight_adaptation' ),
			'' => __( '', 'recaptcha_lightweight_adaptation' )*/
		);

		self::$plugin_errors = array(
			'not_all_data' => __( 'Not all required data are presents in admin settings or passed to function for check.', 'recaptcha_lightweight_adaptation' ),
			'invalid_api_answer' => __( 'The obtained data from Google API have not valid format. Please notify the site administrator.', 'recaptcha_lightweight_adaptation' ),
			'unknown_api_error_code' => __( 'Unknown Google API answer and (or) type of errors inside.', 'recaptcha_lightweight_adaptation' )
		);
	}

	/**
	 * Function to validate Captcha input from user.
	 *
	 * @since 1.0.0
	 *
	 * @param string $response User captcha key.
	 *
	 * @return array|bool|WP_Error True if all good, WP_Error obj if something wrong.
	 */
	public static function validate( $response ) {
		$secret = get_option( 'recaptcha_lightweight_adaptation' );
		if( empty( $response ) || empty( $secret['secret_key'] ) || !is_string( $response ) || !is_string( $secret['secret_key'] ) ) {
			return new WP_Error( 'not_all_data', self::$plugin_errors['not_all_data'] );
		}

		$result = wp_remote_post(
			self::$url,
			array(
				'body' => array(
					'secret' => $secret['secret_key'],
					'response' => $response
				)
			)
		);

		if( is_wp_error( $result ) ) {
			/*
			 * Возможно стоит переписать здесь выдачу ошибок и не показывать пользователям фундаментальные ошибки,
			 * когда серверу не удалось подключиться к Google.
			 */
			return $result;
		}

		if(
			!empty( $result['headers']['content-type'] )
			&&
			strpos( $result['headers']['content-type'], 'application/json' ) === 0
			&&
		    !empty( $result['body'] )
		) {
			$result['body'] = json_decode( $result['body'], true, 3 );

			if( !empty( $result['body']['success'] ) ) {
				if( $result['body']['success'] === true ) {
					return true;
				}
				else {
					if( !empty( $result['body']['error-codes'][0] ) ) {
						$validate_result = new WP_Error();
						$unkown_errors = false;
						foreach( $result['body']['error-codes'] as $error ) {
							if( !empty( self::$api_errors[$error] ) ) {
								$validate_result->add( $error, self::$api_errors[$error] );
								$unkown_errors = true;
							}
						}
						if( $unkown_errors ) {
							$validate_result->add( 'unknown_api_error_code', self::$plugin_errors['unknown_api_error_code'] );
						}
						return $validate_result;
					}
					else {
						return new WP_Error( 'invalid_api_answer', self::$plugin_errors['invalid_api_answer'] );
					}
				}
			}
			else {
				return new WP_Error( 'invalid_api_answer', self::$plugin_errors['invalid_api_answer'] );
			}
		}

		return new WP_Error( 'invalid_api_answer', self::$plugin_errors['invalid_api_answer'] );
	}
}
