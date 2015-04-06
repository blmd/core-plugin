<?php
/*
Plugin Name: Core Plugin
Plugin URI: http://github.com/blmd/core-plugin
Description: Core functionality plugin
Author: blmd
Author URI: http://github.com/blmd
Version: 0.1
*/

!defined( 'ABSPATH' ) && die;
define( 'CORE_PLUGIN_VERSION', '0.1' );
define( 'CORE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'CORE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'CORE_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );


class Core_Plugin {

	public static function factory() {
		static $instance = null;
		if ( ! ( $instance instanceof self ) ) {
			$instance = new self;
			$instance->includes();
			$instance->setup_actions();
		}
		return $instance;
	}

	protected function setup_actions() {
		// register_activation_hook( __FILE__, array($this, 'activation_hook') );
		add_action( 'init', array( $this, 'init' ), 5 );
		add_filter( 'site_transient_update_plugins', array( $this, 'site_transient_update_plugins' ), 10, 2 );
	}

	protected function includes() {
		// require_once CORE_PLUGIN_DIR . 'includes/file.php';
		// if ( is_admin () ) {
		// 	require_once CORE_PLUGIN_DIR . 'includes/admin/file.php';
		// }
	}

	public function init() {
		if ( is_admin() ) {
		}
		do_action( 'core_plugin_init', self::factory() );
	}

	public function site_transient_update_plugins( $arr ) {
		if ( isset( $arr->response[CORE_PLUGIN_BASENAME] ) ) {
			unset( $arr->response[CORE_PLUGIN_BASENAME] );
		}
		return $arr;
	}
	

	public function __construct() { }

	public function __clone() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'core-plugin' ), '0.1' );
	}

	public function __wakeup() {
		_doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'core-plugin' ), '0.1' );
	}

};

function Core_Plugin() {
	return Core_Plugin::factory();
}

Core_Plugin();
