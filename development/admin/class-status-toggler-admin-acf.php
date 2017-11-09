<?php
/**
 * Status toggler Admin Metabox class
 */

/**
 * If class already exist, return to the main loop.
 */
if ( ! class_exists( 'Status_Toggler_Admin_Acf' ) ) {

	class Status_Toggler_Admin_Acf {

		protected $acf;
		protected $plugins;

		function __construct( $plugins, $loader ) {
			$this->plugins = $plugins;
			$loader->add_filter( 'acf/settings/path', $this, 'acf_settings_path' );
			$loader->add_filter( 'acf/settings/dir', $this , 'acf_settings_dir' );
			$loader->add_filter( 'acf/settings/show_admin', $this, '__return_false' );
			$acf_file = $this->plugins['path'] . 'inc/acf/acf.php';
			include_once( $acf_file );
			$acf = $this->init_acf();
			$this->acf = $acf;

			$this->register_fields();
		}

		public function acf_settings_path() {
			$path = $this->plugins['path'] . 'inc/acf/';
			return $path;
		}

		public function acf_settings_dir() {
			$dir = $this->plugins['url'] . 'inc/acf/';
			return $dir;
		}

		public static function __return_false() {
			return false;
		}

		private function register_fields() {

			$fields_group = $this->set_fields_group();

			if ( function_exists( 'acf_add_local_field_group' ) ) {
				acf_add_local_field_group( $fields_group );
			} 

		}

		private function set_fields_group() {

			$field_prefix = 'status_meta_field';

			$fields_group = array(
				'key'           => 'status_group',
				'id'            => 'status_meta_box',
				'title'         => __( 'Status Content', 'status-toggler' ),
				'instructions'  => '(*) Required',
				'fields'        => array(
					array(
						'key'           => "{$field_prefix}_layout",
						'name'          => 'layout_group',
						'type'          => 'group',
						'layout'        => 'table',
						'sub_fields'    => array(
							array(
								'key'           => "{$field_prefix}_current",
								'label'         => 'Current Status',
								'name'          => 'current_status',
								'type'          => 'true_false',
								'required'      => 1,
								'default_value' => 0,
								'ui'            => 1,
								'ui_on_text'    => 'ON',
								'ui_off_text'   => 'OFF',
							),
							array(
								'key'           => "{$field_prefix}_icon_off",
								'label'         => 'Icon Off',
								'name'          => 'icon_off',
								'type'          => 'image',
								'required'      => 1,
								'save_format'   => 'url',
								'preview_size'  => 'full',
								'library'       => 'all',
							),
							array(
								'key'           => "{$field_prefix}_icon_on",
								'label'         => 'Icon On',
								'name'          => 'icon_on',
								'type'          => 'image',
								'required'      => 1,
								'save_format'   => 'url',
								'preview_size'  => 'full',
								'library'       => 'all',
							),
						),
					),
					array(
						'key'           => "{$field_prefix}_description",
						'label'         => 'Description',
						'name'          => 'status_description',
						'type'          => 'textarea',
						'instructions'  => __( 'Description of the status or additional informations you wuould like to display.', 'status-toggler' ),
						'default_value' => '',
						'placeholder'   => '',
						'maxlength'     => '',
						'rows'          => 3,
						'formatting'    => 'html',
					),
				),
				'location' => array(
					array(
						array(
							'param'    => 'post_type',
							'operator' => '==',
							'value'    => 'status',
							'order_no' => 0,
							'group_no' => 0,
						),
					),
				),
				'options' => array(
					'position'       => 'acf_after_title',
					'layout'         => 'default',
					'hide_on_screen' => array(
						0 => 'permalink',
						1 => 'the_content',
						2 => 'excerpt',
						3 => 'custom_fields',
						4 => 'discussion',
						5 => 'comments',
						6 => 'revisions',
						7 => 'slug',
						8 => 'author',
						9 => 'format',
						10 => 'featured_image',
						11 => 'categories',
						12 => 'tags',
						13 => 'send-trackbacks',
					),
				),
				'menu_order' => 0,
				'instruction_placement' => 'label',
			);

			return $fields_group;
		}

		public function init_acf() {
			global $acf;
			if ( ! isset( $acf ) ) {
				$acf = new acf();
				$acf->initialize();
			}
			return $acf;
		}

		public function get_acf() {
			return $this->acf;
		}

	}

}
