<?php

/**
 * Class Recaptcha_Lightweight_Adaptation_Admin_Settings_Setting_General
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Setting_General {

	/**
	 * Name of the option in wp_options table.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var string $option_name
	 */
	protected $option_name;

	/**
	 * Construct.
	 *
	 * @since 1.0.0
	 *
	 * @param string $option_name
	 */
	public function __construct( $option_name ) {
		$this->option_name = $option_name;
	}

	/**
	 * Sanitize all data.
	 *
	 * @since 1.0.0
	 *
	 * @param array $old_values User submitted values.
	 *
	 * @return array
	 */
	public function sanitize( $old_values ) {
		$new_values = array();

		// Keys
		if( isset( $old_values['site_key'] ) ) {
			$new_values['site_key'] = sanitize_text_field( (string)$old_values['site_key'] );
		}

		if( isset( $old_values['secret_key'] ) ) {
			$new_values['secret_key'] = sanitize_text_field( (string)$old_values['secret_key'] );
		}

		// View (dark | light)
		if( isset( $old_values['theme'] ) && $old_values['theme'] == 'dark' ) {
			$new_values['theme'] = 'dark';
		}
		else {
			$new_values['theme'] = 'light';
		}

		// Language
		if( isset( $old_values['language'] ) ) {
			$new_values['language'] = sanitize_text_field( (string)$old_values['language'] );
		}

		// Locations
		if( !empty( $old_values['locations'] ) && is_array( $old_values['locations'] ) ) {
			$new_values['locations'] = array();
			foreach( $old_values['locations'] as $key => $value ) {
				if( array_key_exists( $key, Recaptcha_Lightweight_Adaptation_Admin_Settings::$fields['general']['locations']['locations']->option_variants ) ) {
					// Check value
					$value = (bool)$value;
					if( $value ) {
						$new_values['locations'][$key] = $value;
					}
				}
			}
		}

		return $new_values;
	}
}
