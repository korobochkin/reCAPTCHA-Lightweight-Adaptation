<?php

/**
 * Class Recaptcha_Lightweight_Adaptation_Admin_Settings_Setting
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Setting {

	/**
	 * Default sanitizer.
	 *
	 * @since 1.0.0
	 *
	 * @param array $value Data from user submit.
	 *
	 * @return mixed Filtered user data.
	 */
	public function sanitize( $value ) {
		return $value;
	}
}
