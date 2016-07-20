(function ($) {
Drupal.behaviors.photosEditlist = {
  attach: function(context) {
    $('form#photos-upload-form').submit(function() {
      if ($('#edit-pid').length) {
        var selectedAlbum = $('#edit-pid').val();
        if (!selectedAlbum) {
          alert(Drupal.t('Upload to album field is required.'));
          return false;
        }
      }
    });
  }
};
})(jQuery);
