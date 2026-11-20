/* Customizer live preview. */
(function ($) {
  'use strict';

  wp.customize('hedwigus_accent', function (value) {
    value.bind(function (next) {
      document.documentElement.style.setProperty('--accent', next);
    });
  });

  wp.customize('hedwigus_footer_text', function (value) {
    value.bind(function (next) {
      $('.footer-grid p').text(next);
    });
  });
})(jQuery);
