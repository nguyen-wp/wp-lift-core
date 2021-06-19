<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       baonguyenyam.github.io
 * @since      1.0.0
 *
 * @package    LIFT_WP_CORE
 * @subpackage LIFT_WP_CORE/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    LIFT_WP_CORE
 * @subpackage LIFT_WP_CORE/public
 * @author     Nguyen Pham <baonguyenyam@gmail.com>
 */
class LIFT_WP_CORE_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
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

		// wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/baotre.css', array(), $this->version, 'all' );
		// wp_enqueue_style( 'dangnho-video', plugin_dir_url( __FILE__ ) . 'css/plyr.css', array(), $this->version, 'all' );
		// wp_enqueue_style( 'dangnho-theme', plugin_dir_url( __FILE__ ) . 'css/dangnho.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
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

		// wp_register_script('tre-moments', plugin_dir_url( __FILE__ ) . 'vendor/js/moment.min.js', array('jquery'));
		// wp_enqueue_script('tre-moments');
		// wp_register_script('tre-timezone', plugin_dir_url( __FILE__ ) . 'vendor/js/moment-timezone.min.js', array('jquery'));
		// wp_enqueue_script('tre-timezone');
		// wp_register_script('tre-select2', plugin_dir_url( __FILE__ ) . 'vendor/js/select2.min.js', array('jquery'));
		// wp_enqueue_script('tre-select2');
		// wp_register_script('tre-plyr', plugin_dir_url( __FILE__ ) . 'js/plyr.js', array('jquery'));
		// wp_enqueue_script('tre-plyr');
		// wp_register_script('tre-baotre', plugin_dir_url( __FILE__ ) . 'js/baotre.js', array('jquery'));
		// wp_enqueue_script('tre-baotre');
		// wp_register_script('dangnho', plugin_dir_url( __FILE__ ) . 'js/dangnho.js', array('jquery'));
		// wp_enqueue_script('dangnho');
	

	}

}
