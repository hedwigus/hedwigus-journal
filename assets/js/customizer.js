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

  [
    ['hedwigus_hero_eyebrow', '.hero-eyebrow-text'],
    ['hedwigus_hero_title', '.hero-title-text'],
    ['hedwigus_hero_accent', '.hero-accent-text'],
    ['hedwigus_hero_lead', '.hero .lead']
  ].forEach(function (pair) {
    wp.customize(pair[0], function (value) {
      value.bind(function (next) {
        $(pair[1]).text(next);
      });
    });
  });
})(jQuery);
