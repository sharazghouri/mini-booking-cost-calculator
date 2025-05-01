/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/*!*********************************!*\
  !*** ./assets/public/public.js ***!
  \*********************************/


(function ($) {
  jQuery(document).ready(function ($) {
    $('#booking-quote-form').on('submit', function (e) {
      e.preventDefault();

      // Submit form data via AJAX
      $.ajax({
        url: window.bookingQuoteAjax.ajaxurl,
        type: 'POST',
        data: {
          action: 'submit_booking_quote',
          nonce: window.bookingQuoteAjax.nonce,
          formData: $(this).serialize()
        },
        success: function (response) {
          if (response.success) {
            // Display success message
            $('#quote-result').html(response.data.message).addClass('success');
          } else {
            // Display error message
            alert('Error: ' + response.data.message);
          }
        }
      });
    });
  });
})(jQuery);
/******/ })()
;
//# sourceMappingURL=public.js.map