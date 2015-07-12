<?php

/**
 * Class Recaptcha_Lightweight_Adaptation_Admin_Settings_Page
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Page {

	/**
	 * Page settings title.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var string $page_title
	 */
	protected $page_title;

	/**
	 * Option which stores content of this setting in wp_options table.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 *
	 * @var string $option_group
	 */
	protected $option_group;

	/**
	 * Set up the page title and option groups.
	 *
	 * @since 1.0.0
	 *
	 * @param string $page_title Page title.
	 * @param string $option_group The name of the option_group.
	 */
	public function __construct( $page_title, $option_group ) {
		$this->page_title   = $page_title;
		$this->option_group = $option_group;
	}

	/**
	 * Shows up the page.
	 *
	 * @since 1.0.0
	 */
	public function render() {
		?>
		<div class="wrap">
			<h2><?php echo $this->page_title; ?></h2>
			<form action='options.php' method='post'>
				<?php
				settings_fields( $this->option_group );
				do_settings_sections( $this->option_group );
				submit_button();
				?>
			</form>
		</div>
		<?php
	}
}
