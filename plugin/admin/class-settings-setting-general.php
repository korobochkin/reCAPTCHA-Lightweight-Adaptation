<?php

class Recaptcha_Lightweight_Adaptation_Admin_Settings_Setting_General {

	protected $option_name;

	public function __construct( $option_name ) {
		$this->option_name = $option_name;
	}

	public function sanitize( $old_values ) {
		$new_values = get_option( $this->option_name );

		if( isset( $old_values['site_key'] ) ) {
			$new_values['site_key'] = sanitize_text_field( (string)$old_values['site_key'] );
		}

		if( isset( $old_values['secret_key'] ) ) {
			$new_values['secret_key'] = sanitize_text_field( (string)$old_values['secret_key'] );
		}

		return $new_values;
	}
}
