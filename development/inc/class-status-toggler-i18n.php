<?php
/**
 * File doc comment
 */
if ( class_exists( 'Status_Toggler_I18n' ) ) {
	return;
}

/**
 * Plugin internationalization plugin.
 */
class Status_Toggler_I18n {

	/**
	 * Plugin Name for text-domain.
	 *
	 * @var    string  $plugin_name   Var to keep plugin's version.
	 * @access protected
	 */
	protected $plugin_name;

	/**
	 * Plugin Path for language directory.
	 *
	 * @var    string  $plugin_path   Var to hold plugin path info.
	 * @access protected
	 */
	protected $plugin_path;

	/**
	 * Class initialization.
	 *
	 * Populate $plugin_name and $plugin_path from constants.
	 */
	function __construct(){
		$this->plugin_name = STATUS_TOGGLER_NAME;
		$this->plugin_path = STATUS_TOGGLER_PATH;
	}
	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			$this->plugin_name,
			false,
			$this->plugin_path . 'lang/'
		);

	}

}
