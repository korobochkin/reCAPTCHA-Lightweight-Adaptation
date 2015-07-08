<?php
// основная секция настроек на главной (и пока единственой) странице настроек :)

class Recaptcha_Lightweight_Adaptation_Admin_Settings_Section {

	public $content;

	public function __construct( $content ) {
		$this->content = $content;
	}

	public function render() {
		echo $this->content;
	}
}
