<?php
/**
 * File doc comment.
 *
 * Longer description for the file doc
 *
 * @link        https://github.com/guiwuff/status-toggler/inc/
 * @since       1.0.0
 * @package     Status_Toggler
 * @subpackage  Status_Toggler/inc
 */

/**
 * If class already exist, return to the main loop.
 */
if ( class_exists( 'Status_Toggler' ) ) {
	return;
}

/**
 * Core plugin class.
 *
 * Maintain action hooks and filter hooks registration to the framework
 * during plugins execution.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Status_Toggler
 * @subpackage Status_Toggler/inc
 * @author     GUI Wuff <gui.wuff@gmail.com>
 */
class Status_Toggler {
	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Status_Toggler_Loader      $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * Protected array for plugin identity.
	 *
	 * @since  1.0.0
	 * @var    array       $plugins        The identity array of the plugin.
	 * @access protected
	 */
	protected $plugins;

	/**
	 * Protected var for plugin version.
	 *
	 * @since  1.0.0
	 * @var    string       $version        The current version of the plugin.
	 * @access protected
	 */
	protected $version;

	/**
	 * Protected var for plugin name.
	 *
	 * @since  1.0.0
	 * @var    string       $plugin_name    Unique identity of the plugin.
	 * @access protected
	 */
	protected $plugin_name;

	/**
	 * Protected var for plugin path.
	 *
	 * @since  1.0.0
	 * @var    string       $plugin_path    Directory path of the plugin.
	 * @access protected
	 */
	protected $plugin_path;

	/**
	 * Plugins core functionality.
	 *
	 * Define identity and version of the plugin and load class files for the plugin
	 *
	 * @param   array $params   Array contains plugin's identity.
	 * @since   1.0.0
	 */
	function __construct() {
		/**
		 * Define $version and $plugin_name and $plugin_path.
		 */
		$this->plugin_name = STATUS_TOGGLER_NAME;
		$this->plugin_path = STATUS_TOGGLER_PATH;
		$this->version     = STATUS_TOGGLER_VERSION;

		$this->plugins = array(
			'version' => STATUS_TOGGLER_VERSION,
			'name'    => STATUS_TOGGLER_NAME,
			'path'    => STATUS_TOGGLER_PATH,
			'url'     => STATUS_TOGGLER_URL,
		);

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load plugins required classes.
	 *
	 * Maintains loading all Plugin Classes therefore make sure
	 * all hooks are registered when the plugin instance initiated.
	 *
	 * @access  private
	 * @since   1.0.0
	 */
	private function load_dependencies() {
		$plugins = $this->plugins;
		/**
		 * Require Loader class.
		 */
		require_once "{$plugins['path']}inc/class-status-toggler-loader.php";
		/**
		 * Require Internationalization class.
		 */
		require_once "{$plugins['path']}inc/class-status-toggler-i18n.php";
		/**
		 * Require Admin class.
		 */
		require_once "{$plugins['path']}admin/class-status-toggler-admin.php";
		/**
		 * Require Admin Acf class.
		 */
		require_once "{$plugins['path']}admin/class-status-toggler-admin-acf.php";

		/**
		 * Require Public class.
		 */
		require_once "{$plugins['path']}public/class-status-toggler-public.php";

		$this->loader  = new Status_Toggler_loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Site_Function_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Status_Toggler_I18n();
		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {
		$plugins = $this->plugins;
		$loader  = $this->loader;

		$plugin_admin   = new Status_Toggler_Admin( $plugins );
		$plugin_acf     = new Status_Toggler_Admin_Acf( $plugins, $loader );


		/* Admin notice after activation. */
		if ( get_transient( "{$plugins['name']}-transient" ) ) {
			$loader->add_action( 'admin_notices', $plugin_admin, 'display_activation_notice' );
		}

		$loader->add_action( 'init', $plugin_admin, 'register_status_post_type' );


		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugins = $this->plugins;
		$plugin_public = new Status_Toggler_Public( $plugins );

		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since   1.0.0
	 * @return  Status_Toggler_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

}
