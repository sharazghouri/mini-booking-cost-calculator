<?php

namespace Solution_Box\Plugin\Mini_Booking_Cost_Calculator;

/**
 * The main plugin class.
 *
 * @package  Solution_Box/mini-booking-cost-calculator
 */
class Plugin {

	/**
	 * Plugin meta data.
	 *
	 * @var array
	 */
	protected $data;

	/**
	 * Setup Plugin.
	 *
	 * @var mixed
	 */
	public $setup_plugin;

	
	/**
	 * Admin interface
	 *
	 * @var Admin_Controller
	 */
	public $admin;


	/**
	 * Frontend interface
	 *
	 * @var Admin_Controller
	 */
	public $frontend;

	/**
	 * Frontend interface
	 *
	 * @var Admin_Controller
	 */
	public $booking_quote;




	/**
	 * Constructs and initializes the WooCommerce Product Tabs plugin instance.
	 *
	 * @param string $file    The main plugin __FILE__ .
	 * @param string $version The current plugin version.
	 */
	public function __construct( $file = null, $version = '1.0' ) {

		$this->data = array(
			'version'        => $version,
			'file'           => $file,
		);

	}

	/**
	 * {@inheritdoc}
	 */
	public function register() {

		add_action( 'plugins_loaded', array( $this, 'init' ) );

		add_action( 'init', array( $this, 'load_textdomain' ), 5 );
		add_action( 'init', array( $this, 'register_ajax_handlers' ) );
	
		$this->setup_plugin();
	}

	/**
	 * Plugin initialize.
	 *
	 * @return void
	 */
	public function init() {
		

		// Admin only services.
		if ( is_admin() ) {

			$this->admin = new Admin\Admin_Controller( $this );
			$this->admin->register();
		}

		if ( ! is_admin() ) {
			$this->frontend = new Frontend\Frontend( $this );
			$this->frontend->register();

			$this->booking_quote = new ShortCodes\Booking_Quote;
			$this->booking_quote->register();

		}

	}


	/**
	 * Ajax handerls
	 *
	 * @return void
	 */
	function register_ajax_handlers(){
		
		// Register AJAX handlers for both logged-in and non-logged-in users
		add_action('wp_ajax_submit_booking_quote', array($this, 'process_form'));

		// Register AJAX handlers - move these to init hook
		add_action('wp_ajax_nopriv_submit_booking_quote', array($this, 'process_form'));

	}


	/**
	 * Load the textdomain.
	 */
	public function load_textdomain() {

		load_plugin_textdomain( 'mini-booking-cost-calculator', false, $this->get_slug() . '/languages' );
	}

	/**
		 * Processes the form submission via AJAX
		 * Calculates quote, saves to database, and sends email notification
		 */
		public function process_form() {
			$booking_quote = new ShortCodes\Booking_Quote(  );
			$booking_quote->process_form();
		}
	/**
	 * Setup plugin.
	 *
	 * @return void
	 */
	public function setup_plugin() {
		$this->setup_plugin = new Plugin_Setup( $this->get_data( 'file' ), $this );
		$this->setup_plugin->register();
	}



	/**
	 * Get plugin data by key.
	 *
	 * @param string $key data key.
	 * @return mixed
	 */
	public function get_data( $key = 'version' ) {

		return $this->data[ $key ] ?? '';
	}

	/**
	 * Get plugin slug.
	 *
	 * @return string
	 */
	public function get_slug() {
		$dir_path = $this->get_data( 'file' );

		return ! empty( $dir_path ) ? \basename( $dir_path, '.php' ) : '';
	}

	/**
	 * Get plugin version.
	 *
	 * @return mixed
	 */
	public function get_version() {
		$this->get_data( 'version' );
	}

	/**
	 * Get plugin base name
	 */
	public function get_basename() {
		$base_file = basename( dirname( $this->get_data( 'file' ) ) ) . '/' . $this->get_slug() . '.php';
		return $base_file;
	}

}

