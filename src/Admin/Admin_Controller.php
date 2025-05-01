<?php

namespace Solution_Box\Plugin\Mini_Booking_Cost_Calculator\Admin;

use Solution_Box\Plugin\Mini_Booking_Cost_Calculator\Plugin;


/**
 * Handles the admin functions.
 *
 * @package  Solution_Box/mini-booking-cost-calculator
 */
class Admin_Controller {


	private $plugin;
	private $plugin_name;
	private $version;


	public function __construct( Plugin $plugin ) {
		$this->plugin      = $plugin;
		$this->plugin_name = $plugin->get_slug();
		$this->version     = $plugin->get_version();

	}

	public function register() {

		// Admin scripts
		add_action( 'admin_enqueue_scripts', array( $this, 'settings_page_scripts' ) );

		
	}




	/**
	 * Enqueue the admin scripts and styles.
	 *
	 * @param string $hook
	 */
	public function settings_page_scripts( $hook ) {


			// wp_enqueue_script( $this->plugin_name . '-settings', plugin_dir_url( __DIR__ ) . '../assets/js/admin.js', array( 'jquery', 'wp-element', 'wp-api-fetch' ), $this->version, true );
			// wp_enqueue_style( $this->plugin_name . '-settings', plugin_dir_url( __DIR__ ) . '../assets/css/admin.css', array(), $this->plugin->get_version(), 'all' );

	}


}
