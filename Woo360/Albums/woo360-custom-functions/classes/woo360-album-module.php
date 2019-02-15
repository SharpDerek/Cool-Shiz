<?php
	
/**
 * A class that handles loading custom modules and custom
 * fields if the builder is installed and activated.
 */
class Woo360_Album_Loader {
	
	/**
	 * Initializes the class once all plugins have loaded.
	 */
	static public function init() {
		add_action( 'plugins_loaded', __CLASS__ . '::setup_hooks' );
	}
	
	/**
	 * Setup hooks if the builder is installed and activated.
	 */
	static public function setup_hooks() {
		if ( ! class_exists( 'FLBuilder' ) ) {
			return;	
		}
		
		// Load custom modules.
		add_action( 'init', __CLASS__ . '::load_modules' );
		
		// Enqueue custom field assets.
		add_action( 'init', __CLASS__ . '::enqueue_field_assets' );
	}
	
	/**
	 * Loads our custom modules.
	 */
	static public function load_modules() {
		require_once WOO360_ALBUM_DIR . 'modules/album/album.php';
	}
	
	/**
	 * Enqueues our custom field assets only if the builder UI is active.
	 */
	static public function enqueue_field_assets() {
		if ( ! FLBuilderModel::is_builder_active() ) {
			return;
		}
		
		wp_enqueue_style( 'custom', FL_MODULE_EXAMPLES_URL . 'assets/css/custom.css', array(), '' );
		wp_enqueue_script( 'custom', FL_MODULE_EXAMPLES_URL . 'assets/js/custom.js', array(), '', true );
	}
}

Woo360_Album_Loader::init();