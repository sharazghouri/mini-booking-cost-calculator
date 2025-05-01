=== Mini Booking Cost Calculator ===
Contributors: sharazghouri
Tags: booking, calculator, cost calculator, quote calculator, room booking
Requires at least: 5.0
Tested up to: 6.4
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
Requires PHP: 7.4

A simple yet powerful booking cost calculator for WordPress that helps calculate booking costs based on distance and number of rooms.

== Description ==

Mini Booking Cost Calculator is a WordPress plugin that allows you to add a booking cost calculator to any page or post using a simple shortcode. It calculates booking costs based on distance and number of rooms, making it perfect for cleaning services, moving companies, or any distance-based service provider.

= Features =

* Easy to use shortcode `[booking_quote]`
* Calculates costs based on:
  * Base fee ($100)
  * Distance fee ($10 per km)
  * Room fee ($50 per room)
* Responsive form design
* AJAX-powered calculations
* Instant quote display
* Stores submissions in database
* Email notifications for new quotes
* Translation-ready

= How to Use =

1. Install and activate the plugin
2. Add the shortcode `[booking_quote]` to any page or post
3. The form will appear with fields for:
   * Name
   * Address
   * Distance (in kilometers)
   * Number of rooms (1-5)

= Pricing Formula =

The total cost is calculated using this formula:
* Base Fee: $100
* Distance Cost: $10 × number of kilometers
* Room Cost: $50 × number of rooms

Example: For a 20km distance with 3 rooms
* Base Fee: $100
* Distance Cost: $200 (20km × $10)
* Room Cost: $150 (3 rooms × $50)
* Total Cost: $450

== Installation ==

1. Upload the plugin files to `/wp-content/plugins/mini-booking-cost-calculator`
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Place the shortcode `[booking_quote]` in your pages or posts

== Frequently Asked Questions ==

= How do I add the calculator to my page? =
Simply add the shortcode `[booking_quote]` to any page or post where you want the calculator to appear.

= Can I customize the pricing formula? =
Currently, the pricing formula is fixed. Future versions may include customizable pricing options.

= Is the form submission saved? =
Yes, all form submissions are saved in the database and an email notification is sent to the admin.

= Is the plugin translation-ready? =
Yes, the plugin is fully translation-ready and can be translated into any language.

== Screenshots ==

1. Booking calculator form
2. Quote result display
3. Admin email notification

== Changelog ==

= 1.0.0 =
* Initial release
* Added booking quote calculator shortcode
* Added form submission storage
* Added admin email notifications

== Upgrade Notice ==

= 1.0.0 =
Initial release of Mini Booking Cost Calculator

== Additional Information ==

For support, feature requests, or bug reports, please visit our [GitHub repository](http://github.com/sharazghouri/).

