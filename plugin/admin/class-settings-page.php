<?php

/**
 * Class Recaptcha_Lightweight_Adaptation_Admin_Settings_Page
 *
 * @since 1.0.0
 */
class Recaptcha_Lightweight_Adaptation_Admin_Settings_Page {

	protected $page_title;

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
		<form action='options.php' method='post'>

			<h2><?php echo $this->page_title; ?></h2>

			<?php
			settings_fields( $this->option_group );
			do_settings_sections( $this->option_group );
			submit_button();
			?>

		</form>
	<?php
	}
}
