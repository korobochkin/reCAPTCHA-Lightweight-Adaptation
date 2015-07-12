<?php

class Recaptcha_Lightweight_Adaptation_Admin_Settings_Setting_General {

	protected $option_name;

	public function __construct( $option_name ) {
		$this->option_name = $option_name;
	}

	public function sanitize( $old_values ) {
		$new_values = get_option( $this->option_name );

		// Keys
		if( isset( $old_values['site_key'] ) ) {
			$new_values['site_key'] = sanitize_text_field( (string)$old_values['site_key'] );
		}

		if( isset( $old_values['secret_key'] ) ) {
			$new_values['secret_key'] = sanitize_text_field( (string)$old_values['secret_key'] );
		}

		// View (dark | light)
		if( isset( $old_values['theme'] ) && $old_values['theme'] = 'dark' ) {
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
		$new_values['locations'] = array();
		if( !empty( $old_values['locations'] ) ) {
			foreach( $old_values['locations'] as $key => $value ) {
				if( !empty( $key ) && $value === '1' ) {
					$new_values['locations'][] = $key;
				}
			}
		}

		return $new_values;
	}
}
