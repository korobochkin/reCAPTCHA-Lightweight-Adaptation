<?php

/**
 * Class Recaptcha_Lightweight_Adaptation_Admin_Settings_Field
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Field {

	/**
	 * The array represent option in wp_options table and cell of array inside this option.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var array $option_name
	 */
	protected $option_name;

	/**
	 * Register stuff for input.
	 *
	 * @since 1.0.0
	 *
	 * @param array $option_name Option name and cell name inside this option.
	 * @param string $help_block Text for help block after field.
	 */
	public function __construct( $option_name, $help_block = '' ) {
		$this->option_name = $option_name;
		$this->help_block = $help_block;
	}

	/**
	 * Output the input.
	 *
	 * @since 1.0.0
	 */
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

		if( !empty( $this->help_block ) ) {
			echo '<p class="description">' . $this->help_block . '</p>';
		}
	}
}
