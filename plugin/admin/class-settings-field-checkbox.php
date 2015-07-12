<?php
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Field_Checkbox {

	protected $option_name;

	protected $option_variants;

	public function __construct( $option_name, $option_variants ) {
		$this->option_name = $option_name;
		$this->option_variants = $option_variants;
	}

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
