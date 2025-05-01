<?php

namespace Solution_Box\Plugin\Mini_Booking_Cost_Calculator;

/**
 * Plugin Setup
 *
 * @package   Solution_Box/mini-booking-cost-calculator
 */
class Plugin_Setup {
	/**
	 * Plugin's entry file
	 *
	 * @var string
	 */
	private $file;

	/**
	 * Plugin instance
	 *
	 * @var Plugin
	 */
	private $plugin;

	

	/**
	 * Constructor.
	 *
	 * @param mixed  $file
	 * @param Plugin $plugin
	 */
	public function __construct( $file, Plugin $plugin ) {
		$this->file    = $file;
		$this->plugin  = $plugin;
	}

	/**
	 * Register the service.
	 */
	public function register() {
		register_activation_hook( $this->file, array( $this, 'on_activate' ) );
		register_deactivation_hook( $this->file, array( $this, 'on_deactivate' ) );
		add_action( 'admin_init', array( $this, 'after_plugin_activation' ) );
	}

	/**
	 * On activation.
	 *
	 * @param mixed $network_wide
	 */
	public function on_activate( $network_wide ) {

	$this->create_submissions_table();
	}

	/**
	 * Do nothing.
	 *
	 * @param bool $network_wide
	 */
	public function on_deactivate( $network_wide ) {
	}

	/**
	 * Detect the transient and redirect to wizard.
	 *
	 * @return void
	 */
	public function after_plugin_activation() {

	}


			/**
		 * Creates the database table for storing booking submissions
		 * This runs on plugin activation and init
		 */
		public function create_submissions_table() {
			global $wpdb;
			$table_name = $wpdb->prefix . 'booking_quotes';
			
			// Check if table already exists
			if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
					$charset_collate = $wpdb->get_charset_collate();
					
					// Define table structure
					$sql = "CREATE TABLE $table_name (
							id mediumint(9) NOT NULL AUTO_INCREMENT,
							name varchar(100) NOT NULL,
							address text NOT NULL,
							distance float NOT NULL,
							rooms int NOT NULL,
							total_cost float NOT NULL,
							created_at datetime DEFAULT CURRENT_TIMESTAMP,
							PRIMARY KEY  (id)
					) $charset_collate;";
					
					require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
					dbDelta($sql);
			}
	}
}
