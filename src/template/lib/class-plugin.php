<?php

namespace QuadLayers\{{plugin-namespace}};

final class Plugin {

	protected static $instance;
	protected static $menu_slug = '{{plugin-name}}';

	private function __construct() {
		/**
		 * Load plugin textdomain.
		 */
		load_plugin_textdomain( '{{plugin-name}}', false, QLXXX_PLUGIN_DIR . '/languages/' );
		/**
		 * Admin
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		/**
		 * Frontend
		 */
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ) );
		/**
		 * Load plugin classes
		 */
		Setup::instance();
	}

	public function admin_scripts() {

		if ( ! isset( $_GET['page'] ) || $_GET['page'] !== self::get_menu_slug() ) {
			return;
		}

		$backend = include_once QLXXX_PLUGIN_DIR . 'build/backend/js/index.asset.php';
		wp_enqueue_script( '{{plugin-name}}-backend', plugins_url( 'build/backend/js/index.js', QLXXX_PLUGIN_FILE ), $backend['dependencies'], $backend['version'] );
		wp_enqueue_style( '{{plugin-name}}-backend', plugins_url( 'build/backend/css/style.css', QLXXX_PLUGIN_FILE ), array(), QLXXX_PLUGIN_VERSION );
	}

	public function frontend_scripts() {
		$frontend = include_once QLXXX_PLUGIN_DIR . 'build/frontend/js/index.asset.php';
		wp_enqueue_script( '{{plugin-name}}-frontend', plugins_url( 'build/frontend/js/index.js', QLXXX_PLUGIN_FILE ), $frontend['dependencies'], $frontend['version'] );
		wp_enqueue_style( '{{plugin-name}}-frontend', plugins_url( 'build/frontend/css/style.css', QLXXX_PLUGIN_FILE ), array(), QLXXX_PLUGIN_VERSION );
	}

	public static function get_menu_slug() {
		return self::$menu_slug;
	}

	function add_menu() {
		$menu_slug = self::get_menu_slug();
		add_menu_page(
			QLXXX_PLUGIN_NAME,
			QLXXX_PLUGIN_NAME,
			'edit_posts',
			$menu_slug,
			'__return_null'
			// plugins_url( '/assets/backend/img/tiktok-white.svg', QLXXX_PLUGIN_FILE )
		);
		add_submenu_page(
			$menu_slug,
			esc_html__( 'SubPage 1', '{{plugin-name}}' ),
			esc_html__( 'SubPage 1', '{{plugin-name}}' ),
			'edit_posts',
			$menu_slug,
			'__return_null'
		);
		add_submenu_page(
			$menu_slug,
			esc_html__( 'SubPage 2', '{{plugin-name}}' ),
			esc_html__( 'SubPage 2', '{{plugin-name}}' ),
			'manage_options',
			"{$menu_slug}&tab=accounts",
			'__return_null'
		);

	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

}

/**
 * TODO: ver si es necesario
 */
function {{plugin-namespace}}() {     // phpcs:ignore WordPress.NamingConventions.ValidFunctionName.FunctionNameInvalid
	return Plugin::instance();
}

{{plugin-namespace}}();
