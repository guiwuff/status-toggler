<?php
/**
 * Fired during Plugin uninstallation.
 *
 * Verify the request before proceed with uninstallation process
 *
 * @link       https://github.com/guiwuff/status-toggler
 * @since      1.0.0
 * @package    Status_Toggler
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

if ( ! current_user_can( 'activate_plugins' ) ) {
	return;
}
check_admin_referer( 'bulk-plugins' );

/**
 * Delete Plugins Options database
 */
