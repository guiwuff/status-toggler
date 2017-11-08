<?php
/**
 * The file contains deactivation class.
 *
 * @link        https://github.com/guiwuff/status-toggler/inc/
 * @since       1.0.0
 * @package     Status_Toggler
 * @subpackage  Status_Toggler/inc
 */

/**
 * If class already exist, return to the main loop.
 */
if ( class_exists( 'Status_Toggler_Deactivator' ) ) {
	return;
}
/**
 * Plugin deactivator class.
 *
 * Class to execute deactivation sequences (TBA).
 *
 * @since      1.0.0
 * @package    Status_Toggler
 * @subpackage Status_Toggler/inc
 * @author     GUI Wuff <gui.wuff@gmail.com>
 */
class Status_Toggler_Deactivator {

	/**
	 * Method to call to execute plugin deactivation.
	 *
	 * Check user credentials before proceed with the deactivation process
	 * in the static method now()
	 */
	public static function now() {
		// Check user capabilities.
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		// Proceed if not return.
		$plugin = isset( $_REQUEST['plugin'] ) ? trim( $_REQUEST['plugin'] ) : '';
		check_admin_referer( "deactivate-plugin_{$plugin}" );

	}

}
