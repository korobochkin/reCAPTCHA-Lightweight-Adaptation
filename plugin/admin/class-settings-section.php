<?php

/**
 * Class Recaptcha_Lightweight_Adaptation_Admin_Settings_Section
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Section {

	/**
	 * Section desired content.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @var string $content
	 */
	public $content;

	/**
	 * Set up section content.
	 *
	 * @since 1.0.0
	 *
	 * @param string $content
	 */
	public function __construct( $content ) {
		$this->content = $content;
	}

	/**
	 * Output section.
	 *
	 * @since 1.0.0
	 */
	public function render() {
		echo $this->content;
	}
}
