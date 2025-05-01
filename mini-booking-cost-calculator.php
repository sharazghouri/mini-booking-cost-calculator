<?php
/**
 * Plugin Name: Mini Booking Cost Calculator
 * Plugin URI: http://github.com/sharazghouri/
 * Description: Simple Booking cost calculator.
 * Version: 1.0.0
 * Author: Sharaz Shahid
 * Author URI: http://github.com/sharazghouri/
 * Text Domain: mini-booking-cost-calculator
 * Domain Path: /languages
 * Requires PHP: 7.0
 * Requires at least: 6.7
 * Tested up to: 6.7.1
 *
 * Copyright:       Sharaz Shahid
 * License:         GNU General Public License v3.0
 * License URI:     https://www.gnu.org/licenses/gpl.html
 *
 * @package Solution_Box\mini-booking-cost-calculator
 */

namespace Solution_Box\Plugin\Mini_Booking_Cost_Calculator;

// Prevent direct file access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

const MBCC_PLUGIN_VERSION = '1.0.0';
const MBCC_PLUGIN_FILE    = __FILE__;
const MBCC_PLUGIN_DIR     = __DIR__;

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Helper function to access the shared plugin instance.
 *
 * @return Plugin
 */
function mini_booking_cost_calculator() {
	return Plugin_Factory::create( MBCC_PLUGIN_FILE, MBCC_PLUGIN_VERSION );
}

mini_booking_cost_calculator()->register();
