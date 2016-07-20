/**
 * @file
 * Initialization method.
 *
 * Provides a unique invocation of Superslides per Superslides object on page.
 * Passes in configuration option to initialization method.
 *
 */
(function ($) {
  "use strict";
  Drupal.behaviors.views_superslides = {
    attach: function (context) {

      function isEmpty(str) {
        return (!str || 0 === str.length);
      }

      $('.views-superslides-wrapper:not(.views-superslides-processed)', context).each(function (index) {
        var inherit_height, inherit_width;
        var $this = $(this),
        id = $(this).attr('id'),
        settings = Drupal.settings.viewsSuperslides[id];

        if (isEmpty(settings.inherit_height_from)) {
          inherit_height = window;
        } else {
          inherit_height = settings.inherit_height_from;
        }

        if (isEmpty(settings.inherit_width_from)) {
          inherit_width = window;
        } else {
          inherit_width = settings.inherit_width_from;
        }

        $this
        .addClass('views-superslides-processed')
        .superslides({
          animation: settings.animation,
          inherit_width_from: inherit_width,
          inherit_height_from: inherit_height,
          hashchange: settings.hashchange
        });

      });
    }
  }

})(jQuery);