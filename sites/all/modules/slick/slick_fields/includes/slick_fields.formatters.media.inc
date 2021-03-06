<?php
/**
 * @file
 * Fields formatter for the Slick and Media integration.
 */

/**
 * Formats image/media file data.
 */
function _slick_fields_format_media(&$settings, $config, $thumb_nav = FALSE) {
  $view_mode = $settings['view_mode'] ? $settings['view_mode'] : 'full';
  $is_ratio  = !empty($settings['media_switch']) && !empty($settings['aspect_ratio']);
  $settings['lightbox_ready'] = $settings['picture_ready'] = TRUE;

  $build = array();
  foreach ($config['items'] as $key => $item) {
    if (!isset($item['uri'])) {
      continue;
    }
    $file  = (object) $item;
    $uri   = $file->uri;
    $slide = array();
    $media = array(
      'scheme' => file_uri_scheme($uri),
      'media_uri' => $uri,
    );

    // Build settings for both theme_slick_item() and theme_slick_media().
    slick_extract_image_data($settings, $media, $slide, $item);
    $slide['settings'] += array(
      'ratio'     => $is_ratio ? $settings['aspect_ratio'] : FALSE,
      'type'      => $file->type,
      'view_mode' => $view_mode,
    );

    // Needed settings: type scheme image_style uri view_mode.
    $media['url'] = slick_get_media_url($slide['settings'], $media, $file);

    // Get audio/video thumbnail uri as opposed to the actual video uri.
    if ($media_image_uri = slick_get_media_thumbnail($slide['settings'], $media)) {
      $media['uri'] = $media_image_uri;
    }

    // Thumbnail usages: asNavFor pagers, dot, arrows, photobox thumbnails.
    $thumb = empty($settings['thumbnail_style']) ? array() : slick_get_thumbnail($settings['thumbnail_style'], $media);
    if (!$thumb_nav) {
      slick_get_caption($settings, 'file', $file, $view_mode, $slide);

      // Layout field as opposed from builtin layout above if so configured.
      if (!empty($settings['slide_layout']) && strpos($settings['slide_layout'], 'field_') !== FALSE) {
        $field_layout = field_get_items('file', $file, $settings['slide_layout']);
        $slide['settings']['layout'] = check_plain($field_layout[0]['value']);
      }

      // Slide classes, if so configured.
      if (!empty($settings['slide_classes']) && $slide_classes = field_get_items('file', $file, $settings['slide_classes'])) {
        $slide['settings']['slide_classes'] = strip_tags($slide_classes[0]['value']);
      }

      // Editor links.
      if (file_entity_access('update', $file)) {
        if (!empty($slide['caption']) && field_is_translatable($config['entity_type'], $config['field'])) {
          $slide['caption']['editor']['translate']['#markup'] = l(t('Translate'), 'file/' . $file->fid . '/translate', array(
            'query' => drupal_get_destination(),
            'attributes' => array(
              'title' => t('Translate file @title', array('@title' => $file->filename)),
              'class' => array('file__translate edit-link icon-globe'),
            ),
          ));
        }

        $slide['caption']['editor']['edit']['#markup'] = l(t('Edit'), 'file/' . $file->fid . '/edit', array(
          'query' => drupal_get_destination(),
          'attributes' => array(
            'title' => t('Edit file @title', array('@title' => $file->filename)),
            'class' => array('file__edit edit-link icon-edit'),
          ),
        ));
      }

      // Image with picture, lazyLoad, and lightbox supports.
      $slide['slide'] = array(
        '#theme'    => 'slick_media',
        '#item'     => slick_get_image($settings, $media, $key),
        '#settings' => $slide['settings'],
        '#uri'      => $media['uri'],
      );
    }
    else {
      $slide['slide'] = $thumb;
      if (!empty($settings['thumbnail_caption']) && $caption = field_get_items('file', $file, $settings['thumbnail_caption'])) {
        $slide['caption']['data']['#markup'] = filter_xss($caption[0]['value']);
      }
    }
    $build[$key] = $slide;
  }
  return $build;
}
