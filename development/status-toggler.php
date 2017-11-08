<?php
/**
 * Status Toggler WordPress Plugin
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package Status_Toggler
 * @author  GUI Wuff <gui.wuff@gmail.com>
 * @link    https://agenbola.pro/
 * @since   1.0.0
 *
 * @wordpress-plugin
 * Plugin Name:   Status Toggler
 * Plugin URI:    https://github.com/guiwuff/status-toggler
 * Description:   Show manually configured boolean type status on the front end.
 * Version:       1.0.0
 * Author:        GUI Wuff <gui.wuff@gmail.com>
 * Author URI:    https://agenbola.pro/
 * License:       GPL-2.0+
 * License URI:   http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:   status-toggler
 * Domain Path:   /lang
 */

/**
 * Abort if called directyly.
 */
if ( ! defined( 'WPINC' ) ) {
	die( 'Just a plugin >_<' );
}

/**
 * Define global constants.
 */

if ( ! defined( 'STATUS_TOGGLER_NAME' ) ) {
	define( 'STATUS_TOGGLER_NAME', 'status-toggler' );
}

if ( ! defined( 'STATUS_TOGGLER_VERSION' ) ) {
	define( 'STATUS_TOGGLER_VERSION', '1.0.0' );
}

if ( ! defined( 'STATUS_TOGGLER_PATH' ) ) {
	define( 'STATUS_TOGGLER_PATH', plugin_dir_path( __FILE__ ) );
}



/**
 * WordPress Plugin Activation and Deactivation hook.
 */

if ( ! function_exists( 'status_toggler_activate' ) ) {
	/**
	 * Callback function for wp plugin activation hook.
	 */
	function status_toggler_activate() {
		/**
		 * Include activation class and execute.
		 */
		require_once( plugin_dir_path( __FILE__ ) . 'inc/class-status-toggler-activator.php' );
		Status_Toggler_Activator::now();
	}

	/* Hook to WordPress */
	register_activation_hook( __FILE__, 'status_toggler_activate' );
}

if ( ! function_exists( 'status_toggler_deactivate' ) ) {
	/**
	 * Callback function for wp plugin deactivation hook.
	 */
	function status_toggler_deactivate() {
		/**
		 * Include deactivation class and execute.
		 */
		require_once( plugin_dir_path( __FILE__ ) . 'inc/class-status-toggler-deactivator.php' );
		Status_Toggler_Deactivator::now();
	}

	/* Hook to WordPress */
	register_deactivation_hook( __FILE__, 'status_toggler_deactivate' );
}

if ( ! function_exists( 'status_toggler_run' ) ) {
	/**
	 * Function to create the plugin instance.
	 */
	function status_toggler_run() {
		$plugin = new Status_Toggler();
		$plugin->run();
	}

	status_toggler_run();
} else {
	exit;
}



