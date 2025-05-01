<?php
namespace Solution_Box\Plugin\Mini_Booking_Cost_Calculator\Shortcodes;

/**
 * Class Booking_Quote
 * Handles the booking quote calculator shortcode and related functionality
 * 
 * @package Solution_Box\Plugin\Mini_Booking_Cost_Calculator\Shortcodes
 */
class Booking_Quote {
		/**
		 * Base fee for all bookings
		 * @var int
		 */
		private $base_fee = 100;

		/**
		 * Fee per kilometer
		 * @var int
		 */
		private $per_km_fee = 10;

		/**
		 * Fee per room
		 * @var int
		 */
		private $per_room_fee = 50;
		
		/**
		 * Constructor - Sets up shortcode and necessary hooks
		 */
		public function __construct() {
				

		}

/**
	 * Register all of the hooks related to the shortcode functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	public function register() {

		// Register the shortcode
		add_shortcode('booking_quote', array($this, 'render_shortcode'));
		
	}



		/**
		 * Renders the booking quote form shortcode
		 * 
		 * @return string HTML output of the form
		 */
		public function render_shortcode() {
				ob_start();
				?>
				<div class="booking-quote-form">
						<form id="booking-quote-form">
								
								<!-- Name field -->
								<div class="form-group">
										<label for="name"><?php esc_html_e('Name:', 'mini-booking-cost-calculator'); ?></label>
										<input type="text" id="name" name="name" required>
								</div>

								<!-- Address field -->
								<div class="form-group">
										<label for="address"><?php esc_html_e('Address:', 'mini-booking-cost-calculator'); ?></label>
										<textarea id="address" name="address" required></textarea>
								</div>

								<!-- Distance field -->
								<div class="form-group">
										<label for="distance"><?php esc_html_e('Distance (km):', 'mini-booking-cost-calculator'); ?></label>
										<input type="number" id="distance" name="distance" min="0" step="0.1" required>
								</div>

								<!-- Room selection dropdown -->
								<div class="form-group">
										<label for="rooms"><?php esc_html_e('Number of Rooms:', 'mini-booking-cost-calculator'); ?></label>
										<select id="rooms" name="rooms" required>
												<?php for($i = 1; $i <= 5; $i++): ?>
														<option value="<?php echo $i; ?>"><?php echo $i; ?></option>
												<?php endfor; ?>
										</select>
								</div>

								<button type="submit"><?php esc_html_e('Calculate Quote', 'mini-booking-cost-calculator'); ?></button>
						</form>
						<!-- Container for displaying the quote result -->
						<div id="quote-result"></div>
				</div>

				<?php
				return ob_get_clean();
		}

		/**
		 * Processes the form submission via AJAX
		 * Calculates quote, saves to database, and sends email notification
		 */
		public function process_form() {
		
				// Verify nonce for security
				check_ajax_referer('booking_quote_nonce', 'nonce');
				
				// Parse form data
				parse_str($_POST['formData'], $form_data);
				
				// Sanitize input data
				$name = sanitize_text_field($form_data['name']);
				$address = sanitize_textarea_field($form_data['address']);
				$distance = floatval($form_data['distance']);
				$rooms = intval($form_data['rooms']);
				
				// Calculate the total quote
				$total = $this->calculate_quote($distance, $rooms);
				
				// Save submission to database
				$this->save_submission($name, $address, $distance, $rooms, $total);
				
				// Send email notification to admin
				$this->send_admin_notification($name, $address, $distance, $rooms, $total);
				
				// Send success response
				wp_send_json_success(array(
						'message' => sprintf(
								/* translators: %1$s: customer name, %2$s: formatted price */
								esc_html__('Thanks %1$s! Your estimated booking cost is $%2$s.', 'mini-booking-cost-calculator'),
								esc_html($name),
								number_format($total, 2)
						)
				));
		}

		/**
		 * Calculates the total quote based on distance and number of rooms
		 * 
		 * @param float $distance Distance in kilometers
		 * @param int $rooms Number of rooms
		 * @return float Total quote amount
		 */
		private function calculate_quote($distance, $rooms) {
				return $this->base_fee + ($distance * $this->per_km_fee) + ($rooms * $this->per_room_fee);
		}

		/**
		 * Saves the form submission to the database
		 * 
		 * @param string $name Customer name
		 * @param string $address Customer address
		 * @param float $distance Distance in kilometers
		 * @param int $rooms Number of rooms
		 * @param float $total Total quote amount
		 */
		private function save_submission($name, $address, $distance, $rooms, $total) {
				global $wpdb;
				$table_name = $wpdb->prefix . 'booking_quotes';
				
				$wpdb->insert(
						$table_name,
						array(
								'name' => $name,
								'address' => $address,
								'distance' => $distance,
								'rooms' => $rooms,
								'total_cost' => $total
						),
						array('%s', '%s', '%f', '%d', '%f')
				);
		}

		/**
		 * Sends an email notification to the admin about the new booking quote
		 * 
		 * @param string $name Customer name
		 * @param string $address Customer address
		 * @param float $distance Distance in kilometers
		 * @param int $rooms Number of rooms
		 * @param float $total Total quote amount
		 */
		private function send_admin_notification($name, $address, $distance, $rooms, $total) {
				$admin_email = get_option('admin_email');
				$subject = 'New Booking Quote Submission';
				
				// Prepare email message
				$message = sprintf(
						"New booking quote submission:\n\n" .
						"Name: %s\n" .
						"Address: %s\n" .
						"Distance: %s km\n" .
						"Rooms: %d\n" .
						"Total Cost: $%s\n",
						$name,
						$address,
						$distance,
						$rooms,
						number_format($total, 2)
				);
				
				// Send email
				wp_mail($admin_email, $subject, $message);
		}
} 