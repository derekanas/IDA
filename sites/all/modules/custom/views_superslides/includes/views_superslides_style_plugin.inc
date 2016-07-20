<?php

/**
 * @file
 * Views Superslides Style Plugin.
 *
 * Provides configuration object for initialization method.
 * Provides a form to control these options in the views interface.
 *
 */

/**
 * Implementation of views_plugin_style().
 */
class views_superslides_style_plugin extends views_plugin_style {

  /**
   * Set default options
   */
  function option_definition() {
    $options = parent::option_definition();

    $options += array(
        'animation' => array('default' => 'slide'),
        'inherit_width_from' => array('default' => ''),
        'inherit_height_from' => array('default' => ''),
        'hashchange' => array('default' => FALSE),
        'use_title_as_id' => array('default' => FALSE),
    );
    return $options;
  }

  /**
   * Render the given style.
   */
  function options_form(&$form, &$form_state) {
    parent::options_form($form, $form_state);

    ctools_include('dependent');

    $form['animation'] = array(
      '#type' => 'select',
      '#options' => array('slide' => 'Slide', 'fade' => 'Fade'),
      '#default_value' => $this->options['animation'],
      '#title' => t('Animation'),
      '#description' => t('jQuery animation type should this slider use.'),
    );

    $form['inherit_width_from'] = array(
      '#type' => 'textfield',
      '#default_value' => $this->options['inherit_width_from'],
      '#title' => t('Inherit Width From'),
      '#description' => t('[object] or [string] Accepts an element selector. If left blank defaults to window. Use to constrain slider to an element\'s width.'),
    );

    $form['inherit_height_from'] = array(
      '#type' => 'textfield',
      '#default_value' => $this->options['inherit_height_from'],
      '#title' => t('Inherit Height From'),
      '#description' => t('[object] or [string] Accepts an element selector. If left blank defaults to window. Use to constrain slider to an element\'s height.'),
    );

    $form['hashchange'] = array(
      '#type' => 'checkbox',
      '#default_value' => !empty($this->options['hashchange']),
      '#title' => t('Hash Change'),
      '#description' => t('Enable hashchange support in url.'),
    );

    $form['use_title_as_id'] = array(
      '#type' => 'checkbox',
      '#default_value' => !empty($this->options['use_title_as_id']),
      '#title' => t('Use Title as ID'),
      '#description' => t('If enabled, each resulting container will have the title of the node or entity applied as its ID name. When used in conjunction with "hashchange = TRUE", URLs will appear as sanitized Node title text instead of #1, #2, etc.'),
    );

  }
}