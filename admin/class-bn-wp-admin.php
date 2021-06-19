<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       baonguyenyam.github.io
 * @since      1.0.0
 *
 * @package    LIFT_WP_CORE
 * @subpackage LIFT_WP_CORE/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    LIFT_WP_CORE
 * @subpackage LIFT_WP_CORE/admin
 * @author     Nguyen Pham <baonguyenyam@gmail.com>
 */
class LIFT_WP_CORE_Admin {

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
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in LIFT_WP_CORE_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The LIFT_WP_CORE_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 'lift_admin_main_css',  plugin_dir_url( __FILE__ ) . 'assets/css/dist/main.min.css', array() );
		wp_enqueue_script('lift_admin_main_js');

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in LIFT_WP_CORE_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The LIFT_WP_CORE_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_register_script('lift_admin_main_js', plugin_dir_url( __FILE__ ) . 'assets/js/dist/main.prod.js', array('jquery'));
        wp_enqueue_script('lift_admin_main_js');

	}
	

}
