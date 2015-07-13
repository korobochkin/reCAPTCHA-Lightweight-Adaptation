<?php
if( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

delete_option( 'recaptcha_lightweight_adaptation' );
