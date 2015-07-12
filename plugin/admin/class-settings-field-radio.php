<?php
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Field_Radio {

	protected $option_name;

	protected $option_variants;

	public function __construct( $option_name, $option_variants ) {
		$this->option_name = $option_name;
		$this->option_variants = $option_variants;
	}

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
