<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @since      1.0.0
 *
 * @package    Mini_Booking_Cost_Calculator
 */

namespace Solution_Box\Plugin\Mini_Booking_Cost_Calculator\Frontend;

use Solution_Box\Plugin\Mini_Booking_Cost_Calculator\Util;

/**
 * The public-facing functionality of the plugin.
 */
class Frontend {

	/**
	 * The main plugin instance.
	 *
	 * @since    1.1.0
	 * @access   private
	 * @var      string    $plugin    The main plugin instance.
	 */
	private $plugin;

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
	 * @var      string    $plugin_name       The name of the plugin.
	 * @var      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin ) {

		$this->plugin            = $plugin;
		$this->plugin_name       = $plugin->get_slug();
		$this->version           = $plugin->get_version();


	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function register() {

		// Public Search by meta query
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_files' ) );
		
	}





	function enqueue_files() {


			wp_enqueue_style( $this->plugin_name . '-public', plugin_dir_url( __DIR__ ) . '../assets/css/public.css', array(), $this->version, 'all' );
			wp_enqueue_script( $this->plugin_name . '-public', plugin_dir_url( __DIR__ ) . '../assets/js/public.js', array( 'jquery'), $this->version, 'all' );
			wp_localize_script( $this->plugin_name . '-public', 'bookingQuoteAjax', array(
				'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( 'booking_quote_nonce' )
			));


	}




}
