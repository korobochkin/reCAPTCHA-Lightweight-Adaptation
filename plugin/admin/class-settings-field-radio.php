<?php

/**
 * Class Recaptcha_Lightweight_Adaptation_Admin_Settings_Field_Radio
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Field_Radio {

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
	 * The list of the variants for inputs (radiobuttons).
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
		foreach( $this->option_variants as $name => $text ) {
			if( !empty( $options[$this->option_name[1]] ) ) {
				$checked = checked($name, $options[$this->option_name[1]], false);
			}
			else {
				$checked = '';
			}
			printf(
				'<p><label><input name="%s[%s]" type="radio" value="%s" class="tog" %s>%s</label></p>',
				$this->option_name[0],
				$this->option_name[1],
				$name,
				$checked,
				$text
			);
		}
	}
}
