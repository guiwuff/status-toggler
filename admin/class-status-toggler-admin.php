<?php
/**
 * File doc comment.
 * 
 * Longer description for the file doc
 *
 * @link        https://github.com/guiwuff/status-toggler/admin/
 * @since       1.0.0
 * @package     Status_Toggler
 * @subpackage  Status_Toggler/admin
 */

/**
 * If class already exist, return to the main loop.
 */
if ( ! class_exists( 'Status_Toggler_Admin' ) ) {
	return;
}

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    Status_Toggler
 * @subpackage Site_Function/admin
 * @author     GUI Wuff <gui.wuff@gmail.com>
 */
class Status_Toggler_Admin {
	/**
	 * The plugin options.
	 *
	 * @since     1.0.0
	 * @access    private
	 * @var       string
	 */
	private $options;
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * The path of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_path   The path of this plugin.
	 */
	private $plugin_path;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param    string $plugin_name    The name of this plugin.
	 * @param    string $version        The version of this plugin.
	 * @param    string $plugin_path    path of this plugin.
	 */
	public function __construct( $plugin_name, $version, $plugin_path ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		$this->plugin_path = $plugin_path;

		$this->set_options();

	}

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugin_name . '-options' );

	}

	/**
	 * Display activation notices.
	 */
	public function display_activation_notices() {

		$admin_notice_class   = 'notice notice-success is-dismissable';
		$admin_notice_message = __( 'Status Post Type created. You can manage your Status from Status Menu in the Admin Page', 'status-toggler' );

		include( $this->plugin_path . "admin/partials/partials-{$this->plugin_name}-admin-notice.php" );

	}

}
