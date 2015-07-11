<?php
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Field {

	protected $option_name;

	public function __construct( $option_name ) {
		$this->option_name = $option_name;
	}

	public function render() {
		$options = get_option( $this->option_name[0], array() );
		if( empty( $options ) || empty( $options[$this->option_name[1]] ) ) {
			$value = '';
		}
		else {
			$value = $options[$this->option_name[1]];
		}
		printf(
			'<input name="%s[%s]" type="text" value="%s" class="regular-text">',
			$this->option_name[0],
			$this->option_name[1],
			esc_attr( $value )
		);
	}
}
