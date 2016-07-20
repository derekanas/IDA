<?php

/**
 * @file
 * Views Superslides Include File.
 *
 * Declares a Views Plugin for Views Superslides.
 */

/**
 * Implements hook_views_plugin().
 */
function views_superslides_views_plugins() {
  $plugins =  array(
    'style' => array(
      'views_superslides' => array(
        'title' => t('Views Superslides - jQuery Full-Page Slider'),
        'handler' => 'views_superslides_style_plugin',
        'theme' => 'views_view_superslides',
        'theme path' => drupal_get_path('module', 'views_superslides') . '/includes',
        'help' => t('Provide a full-page slider for Views.'),
        'uses row plugin' => TRUE,
        'uses options' => TRUE,
        'uses fields' => TRUE,
        'type' => 'normal',
      ),
    ),
  );
  return $plugins;
}
