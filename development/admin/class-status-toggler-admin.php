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
if ( class_exists( 'Status_Toggler_Admin' ) ) {
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
	
	protected $plugins;
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
	public function __construct( $plugins ) {

		$this->plugins  = $plugins;
		$this->set_options();

	}

	/**
	 * Sets the class variable $options
	 */
	private function set_options() {

		$this->options = get_option( $this->plugins['name'] . '-options' );

	}

	/**
	 * Display activation notices.
	 */
	public function display_activation_notice() {

		$admin_notice_class   = 'notice notice-success is-dismissable';
		$admin_notice_message = __( 'Status Post Type created. You can manage your Status from Status Menu in the Admin Page', 'status-toggler' );

		include( $this->plugins['path'] . "admin/partials/partials-{$plugins['name']}-admin-notice.php" );

	}

	/**
	 * Create status custom post type.
	 *
	 * Static method, executed during plugin activation from the Activator class.
	 */
	public static function register_status_post_type() {
		/**
		 * Labels and Args for status post type.
		 */
		$labels = array(
			'name'                  => _x( 'Status', 'Post Type General Name', 'status-toggler' ),
			'singular_name'         => _x( 'Status', 'Post Type Singular Name', 'status-toggler' ),
			'menu_name'             => __( 'Status', 'status-toggler' ),
			'attributes'            => __( 'Status Attributes', 'status-toggler' ),
			'parent_item_colon'     => __( 'Parent Status:', 'status-toggler' ),
			'all_items'             => __( 'All Status', 'status-toggler' ),
			'add_new_item'          => __( 'Add New Status', 'status-toggler' ),
			'add_new'               => __( 'New Status', 'status-toggler' ),
			'new_item'              => __( 'New Status', 'status-toggler' ),
			'edit_item'             => __( 'Edit Status', 'status-toggler' ),
			'update_item'           => __( 'Update Status', 'status-toggler' ),
			'view_item'             => __( 'View Status', 'status-toggler' ),
			'view_items'            => __( 'View Status', 'status-toggler' ),
			'search_items'          => __( 'Search Status', 'status-toggler' ),
			'not_found'             => __( 'No Status found', 'status-toggler' ),
			'not_found_in_trash'    => __( 'No Status found in Trash', 'status-toggler' ),
			'featured_image'        => __( 'Featured Image', 'status-toggler' ),
			'set_featured_image'    => __( 'Set featured image', 'status-toggler' ),
			'remove_featured_image' => __( 'Remove featured image', 'status-toggler' ),
			'use_featured_image'    => __( 'Use as featured image', 'status-toggler' ),
			'insert_into_item'      => __( 'Insert into Status', 'status-toggler' ),
			'uploaded_to_this_item' => __( 'Uploaded to this status', 'status-toggler' ),
			'items_list'            => __( 'Status list', 'status-toggler' ),
			'items_list_navigation' => __( 'Status list navigation', 'status-toggler' ),
			'filter_items_list'     => __( 'Filter Status list', 'status-toggler' ),
		);
		$args = array(
			'label'                 => __( 'Status', 'status-toggler' ),
			'description'           => __( 'Status Post Type', 'status-toggler' ),
			'labels'                => $labels,
			'supports'              => array( 'title' ),
			'hierarchical'          => true,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'menu_position'         => 5,
			'menu_icon'             => $this->plugins['url'] . 'admin/img/status-toggler-16px.png',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => true,
			'can_export'            => true,
			'has_archive'           => false,
			'exclude_from_search'   => false,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
			'show_in_rest'          => true,
		);

		register_post_type( 'status', $args );
	}

}

