(function ($) { // JavaScript should be compatible with other libraries than jQuery
  Drupal.behaviors.textResize = { // D7 "Changed Drupal.behaviors to objects having the methods "attach" and "detach"."
    attach: function(context) {
		var text_resize_scope='content p, .content li, .content a, .content span, .main-container.container p,.main-container.container li,.main-container.container span,.main-container.container a,.breadcrumb,.view-content td,.view-content th,.field-content.repository-file-description, .view-filters label';
		var text_resize_line_height_allow=true;
		var text_resize_line_height_min=15;
		var text_resize_line_height_max=27;
		var text_resize_maximum=18;
		var text_resize_minimum=10;
      // Which div or page element are we resizing?
      if (text_resize_scope) { // Admin-specified scope takes precedence.
          var element_to_resize = $('.'+text_resize_scope); // CLASS specified by admin
      }
      else { // Look for some default scopes that might exist.
        if ($('DIV.left-corner').length > 0) {
          var element_to_resize = $('DIV.left-corner'); // Main body div for Garland
        }
        else if ($('#content-inner').length > 0) {
          var element_to_resize = $('#content-inner'); // Main body div for Zen-based themes
        }
        else if ($('#squeeze > #content').length > 0) {
          var element_to_resize = $('#squeeze > #content'); // Main body div for Zen Classic
        }
      }
      // Set the initial font size if necessary
      if ($.cookie('text_resize') != null) {
        element_to_resize.css('font-size', parseFloat($.cookie('text_resize')) + 'px');
		$("h1,h2,h3.title,h4,h1 a,h2 a,h3.title a,h4 a,.field-content.repository-file-description-title,.field-items p > strong,.view-grouping-header").css('cssText','font-size: '+(parseFloat($.cookie('text_resize'))*2) + 'px !important');
      }
      if (text_resize_line_height_allow) {
        // Set the initial line height if necessary
        if ($.cookie('text_resize_line_height') != null) {
          element_to_resize.css('line-height', parseFloat($.cookie('text_resize_line_height')) + 'px');
        }
      }
      // Changer links will change the text size when clicked
      $('a.changer').click(function() {
        // Set the current font size of the specified section as a variable
        var currentFontSize = parseFloat(element_to_resize.css('font-size'), 10);
        // Set the current line-height
        var current_line_height = parseFloat(element_to_resize.css('line-height'), 10);
        // javascript lets us choose which link was clicked, by ID
        if (this.id == 'text_resize_increase') {
          var new_font_size = currentFontSize + 2;
          if (text_resize_line_height_allow) { var new_line_height = new_font_size * 1.5; }
          // Allow resizing as long as font size doesn't go above text_resize_maximum.
          if (new_font_size <= text_resize_maximum) {
            $.cookie('text_resize', new_font_size, { path: '/' });
            if (text_resize_line_height_allow) { $.cookie('text_resize_line_height', new_line_height, { path: '/' }); }
            var allow_change = true;
          }
          else {
            $.cookie('text_resize', text_resize_maximum, { path: '/' });
            if (text_resize_line_height_allow) { $.cookie('text_resize_line_height', text_resize_line_height_max, { path: '/' }); }
            var reset_size_max = true;
          }
        }
        else if (this.id == 'text_resize_decrease') {
          var new_font_size = currentFontSize - 2;
          if (text_resize_line_height_allow) { var new_line_height = new_font_size * 1.5; }
          if (new_font_size >= text_resize_minimum) {
            // Allow resizing as long as font size doesn't go below text_resize_minimum.
            $.cookie('text_resize', new_font_size, { path: '/' });
            if (text_resize_line_height_allow) { $.cookie('text_resize_line_height', new_line_height, { path: '/' }); }
            var allow_change = true;
          }
          else {
            // If it goes below text_resize_minimum, just leave it at text_resize_minimum.
            $.cookie('text_resize', text_resize_minimum, { path: '/' });
            if (text_resize_line_height_allow) { $.cookie('text_resize_line_height', text_resize_line_height_min, { path: '/' }); }
            var reset_size_min = true;
          }
        }
        else if (this.id == 'text_resize_reset') {
          $.cookie('text_resize', null, { path: '/' });
          if (text_resize_line_height_allow) { $.cookie('text_resize_line_height', null, { path: '/' }); }
          var reset_size_original = true;
        }
        // jQuery lets us set the font size value of the main text div
        if (allow_change == true) {
          element_to_resize.css('font-size', new_font_size + 'px'); // Add 'px' onto the end, otherwise ems are used as units by default
		  $("h1,h2,h3.title,h4,h1 a,h2 a,h3.title a,h4 a,.field-content.repository-file-description-title,.field-items p > strong,.view-grouping-header").css('cssText','font-size: '+(parseFloat(new_font_size)*2) + 'px !important');
          if (text_resize_line_height_allow) { element_to_resize.css('line-height', new_line_height + 'px'); }
          return false;
        }
        else if (reset_size_min == true) {
          element_to_resize.css('font-size', text_resize_minimum + 'px');
		  $("h1,h2,h3.title,h4,h1 a,h2 a,h3.title a,h4 a,.field-content.repository-file-description-title,.field-items p > strong,.view-grouping-header").css('cssText','font-size: '+(parseFloat(text_resize_minimum)*2) + 'px !important');
          if (text_resize_line_height_allow) { element_to_resize.css('line-height', text_resize_line_height_min + 'px'); }
          return false;
        }
        else if (reset_size_max == true) {
          element_to_resize.css('font-size', text_resize_maximum + 'px');
		  $("h1,h2,h3.title,h4,h1 a,h2 a,h3.title a,h4 a,.field-content.repository-file-description-title,.field-items p > strong,.view-grouping-header").css('cssText','font-size: '+(parseFloat(text_resize_maximum)*2) + 'px !important');
          if (text_resize_line_height_allow) { element_to_resize.css('line-height', text_resize_line_height_max + 'px'); }
          return false;
        }
        else if (reset_size_original == true) {
          element_to_resize.css('font-size', '');
		  $("h1,h2,h3.title,h4,h1 a,h2 a,h3.title a,h4 a").css('font-size', '');
          if (text_resize_line_height_allow) { element_to_resize.css('line-height', ''); }
          return false;
        }
      });
    }
  };
})(jQuery);