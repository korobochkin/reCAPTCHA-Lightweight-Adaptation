<?php

/**
 * Class Recaptcha_Lightweight_Adaptation_Admin_Settings_Field_Checkbox
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Field_Checkbox {

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
	 * The list of the variants for inputs (checkboxes).
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var array $option_variants
	 */
	protected $option_variants;

	/**
	 * Register stuff for input.
	 *
	 * @since 1.0.0
	 *
	 * @param array $option_name
	 * @param array $option_variants
	 */
	public function __construct( $option_name, $option_variants ) {
		$this->option_name = $option_name;
		$this->option_variants = $option_variants;
	}

	/**
	 * Output the input.
	 *
	 * @since 1.0.0
	 */
	public function render() {
		$options = get_option( $this->option_name[0] );
		$br = false;
		echo '<fieldset>';
		foreach( $this->option_variants as $name => $text ) {
			if( $br ) {
				echo '<br>';
			}
			$br = true;
			if( !empty( $options[$this->option_name[1]] ) ) {
				$checked = checked( in_array( $name, $options[$this->option_name[1]]), true, false );
			}
			else {
				$checked = '';
			}
			printf(
				'<label><input name="%s[%s][%s]" type="checkbox" value="1" %s> %s</label>',
				$this->option_name[0],
				$this->option_name[1],
				$name,
				$checked,
				$text
			);
		}
		echo '</fieldset>';
	}
}
