<?php
/**
 * The file contains activation class.
 *
 * @link        https://github.com/guiwuff/status-toggler/inc/
 * @since       1.0.0
 * @package     Status_Toggler
 * @subpackage  Status_Toggler/inc
 */

/**
 * If class already exist, return to the main loop.
 */
if ( class_exists( 'Status_Toggler_Activator' ) ) {
	return;
}
/**
 * Plugin activator class.
 *
 * Display admin notice during activation, update or add Plugins options.
 *
 * @since      1.0.0
 * @package    Status_Toggler
 * @subpackage Status_Toggler/inc
 * @author     GUI Wuff <gui.wuff@gmail.com>
 */
class Status_Toggler_Activator {

	/**
	 * Protected var to hold plugin name.
	 *
	 * @var    string  $plugin_name  String to hold plugin name.
	 * @access protected
	 */
	protected $plugin_name;

	/**
	 * Initialize Activator Class.
	 *
	 * Construct populate $plugin_name from constants.
	 */
	function __construct() {

		$this->plugin_name = STATUS_TOGGLER_NAME;

	}

	/**
	 * Method to call to execute plugin activation.
	 *
	 * Check user credentials before proceed with the activation process
	 * in the static method now()
	 */
	public static function now() {
		// Check user credentials.
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		// Proceed if not return.
		$plugin = isset( $_REQUEST['plugin'] ) ? trim( $_REQUEST['plugin'] ) : '';
		check_admin_referer( "activate-plugin_{$plugin}" );

		// Additional admin notice after activation via transient.
		set_transient( "{$this->plugin_name}-transient", true, 10 );
	}

}
