<?php

/**
 * @file
 * Administrative pages for paging module.
 */

/**
 * Menu callback; display module settings form.
 */
function paging_settings() {
  $form = array();

  // Set the id of the top-level form tag.
  $form['#id'] = 'paging';

  // General paging settings, not specific to node type.
  $form['paging_general'] = array(
    '#type' => 'fieldset',
    '#title' => t('General paging settings'),
    '#collapsible' => FALSE,
  );

  // Paging separator string.
  // @TODO will need an upgrade path.
  $form['paging_general']['paging_separator'] = array(
    '#type' => 'textfield',
    '#title' => t('Page separator string'),
    '#size' => 20,
    '#maxlength' => 255,
    '#required' => TRUE,
    '#default_value' => variable_get('paging_separator', '<!--pagebreak-->'),
    '#description' => t('Use an HTML tag that will render reasonably when
      paging is not enabled, such as %pagebreak or %hr.', array('%pagebreak' => variable_get('paging_separator', '<!--pagebreak-->'), '%hr' => '<hr />')),
  );

  // Number of pagers on a page.
  // @TODO will need an upgrade path.
  $form['paging_general']['paging_pager_count'] = array(
    '#type' => 'radios',
    '#title' => t('Number of Pagers on each page'),
    '#options' => array(
      'one' => t('One'),
      'two' => t('Two'),
    ),
    '#required' => TRUE,
    '#description' => t('Choose how many pagers you would like on each page.
      The positioning of enabled pager(s) can be controlled for each
      <a href="@url">content type</a> under <em>Manage display</em>.',
      array('%none' => t('None'), '@paging' => '$node->paging', '@url' => url('admin/structure/types'))),
    '#default_value' => variable_get('paging_pager_count', 'one'),
    '#attributes' => array('class' => array('paging-pager')),
  );

  $paging_filter = FALSE;
  // Retrieve all input filters.
  foreach (filter_formats() as $format) {
    // Further retrieve all input formats.
    foreach (filter_list_format($format->format) as $filter) {
      // Check if any of the input formats have paging filter enabled.
      if ($filter->module == 'paging') {
        $paging_filter = TRUE;
        break;
      }
    }
  }
  if (!$paging_filter) {
    // Warn if paging filter is not yet enabled for any input format.
    drupal_set_message(t('Paging filter has not yet been enabled for any text
      formats. !link!', array('!link' => l(t('Enable now'), 'admin/config/content/formats'))), 'warning paging-warning');
  }

  // Get all valid fields.
  $fields = field_info_fields();
  $field_options = array();
  // Remove fields that are not on nodes.
  $valid_bundles = array('node'); // TODO make this work for other entity types?
  // Remove fields that are not lontext, or longtext and sumamry from the list.
  $valid_fields = array('text_long', 'text_with_summary');
  // Remove fields with multiple values.
  // @TODO
  foreach ($fields as $fieldname => $field) {
    $option = TRUE;
    if (!in_array($field['type'], $valid_fields)) {
      unset($fields[$fieldname]);
      $option = FALSE;
    }
    else {
      foreach ($valid_bundles as $bundle_name) {
        if (!array_key_exists($bundle_name, $field['bundles'])) {
          unset($fields[$fieldname]);
          $option = FALSE;
        }
      }
    }
    if ($option) {
      $field_options[$fieldname] = $fieldname;
    }
  }

  // Loop over all the available content types.
  foreach (node_type_get_types() as $type => $node_type) {
    $form[$type]['paging_config'] = array(
      '#type' => 'fieldset',
      '#title' => $node_type->name,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
      '#attributes' => array('id' => 'paging-type-' . $type, 'class' => array('paging-fieldset')),
    );

    // Left column fieldset.
    $form[$type]['paging_config']['paging_left'] = array(
      '#type' => 'fieldset',
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
      '#attributes' => array('class' => array('paging-left')),
    );

    // Paging toggle checkbox.
    $form[$type]['paging_config']['paging_left']['paging_enabled_' . $type] = array(
      '#type' => 'checkbox',
      '#title' => 'Enable paging',
      '#default_value' => variable_get('paging_enabled_' . $type, 0),
      '#attributes' => array('class' => array('paging-enabled')),
    );

    // Paging toggle checkbox.
    $form[$type]['paging_config']['paging_left']['paging_field_' . $type] = array(
      '#type' => 'radios',
      '#title' => 'Select field to use for page breaks',
      '#options' => $field_options,
      '#default_value' => variable_get('paging_field_' . $type, 0),
      '#attributes' => array('class' => array('paging-enabled')),
      '#states' => array(
        'visible' => array(// action to take.
          ':input[name="paging_enabled_' . $type . '"]' => array('checked' => TRUE),
        ),
      ),
    );

    // Change "Read more" path when first page is greater than or equal to the teaser.
    $form[$type]['paging_config']['paging_left']['paging_read_more_enabled_' . $type] = array(
      '#type' => 'checkbox',
      '#title' => t('Link "Read more" to second page'),
      '#description' => t('When enabled, the "Read more" link for teasers will
        link to the second page of the content if the teaser is larger than the
        first page or if they are the same.'),
      '#default_value' => variable_get('paging_read_more_enabled_' . $type, 0),
      '#states' => array(
        'visible' => array(// action to take.
          ':input[name="paging_enabled_' . $type . '"]' => array('checked' => TRUE),
        ),
      ),
    );

    // Set the browser's title to current page's name.
    $form[$type]['paging_config']['paging_left']['paging_name_title_' . $type] = array(
      '#type' => 'checkbox',
      '#title' => t('Change page title to name of current page'),
      '#description' => t("Change the node's and browser window's title into
        name of the current page."),
      '#default_value' => variable_get('paging_name_title_' . $type, 0),
      '#states' => array(
        'visible' => array(// action to take.
          ':input[name="paging_enabled_' . $type . '"]' => array('checked' => TRUE),
        ),
      ),
    );

    // Right column fieldset.
    $form[$type]['paging_config']['paging_right'] = array(
      '#type' => 'fieldset',
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,
      '#attributes' => array('class' => array('paging-right')),
      '#states' => array(
        'visible' => array(// action to take.
          ':input[name="paging_enabled_' . $type . '"]' => array('checked' => TRUE),
        ),
      ),
    );

    // Optional automatic paging method. Each option opens the corresponding character/word length select list.
    // Accompanied by paging.admin.js.
    // @TODO this will need an upgrade path. (now specifying keys for options)
    $form[$type]['paging_config']['paging_right']['paging_automatic_method_' . $type] = array(
      '#type' => 'radios',
      '#title' => t('Automatic paging method'),
      '#options' => array(
        'disabled' => t('Disabled'),
        'chars' => t('Limit by characters <small>(recommended)</small>'),
        'words' => t('Limit by words')),
      '#required' => TRUE,
      '#description' => t('Method for automatic paging (ignored where paging
        separator string is used).'),
      '#default_value' => variable_get('paging_automatic_method_' . $type, 'disabled'),
      '#attributes' => array('class' => array('paging-method')),
      '#states' => array(
        'visible' => array(// action to take.
          ':input[name="paging_enabled_' . $type . '"]' => array('checked' => TRUE),
        ),
      ),
    );

    // Get the length options.
    // @TODO: Do we really need 750?
    $char_len_options = array(-1 => 750) + range(500, 7500, 500);
    asort($char_len_options);
    $char_len_options = drupal_map_assoc($char_len_options);

    // Automatic paging method. Select list to choose the number of characters per page.
    $form[$type]['paging_config']['paging_right']['paging_automatic_chars_' . $type] = array(
      '#type' => 'select',
      '#title' => t('Length of each page'),
      '#options' => $char_len_options,
      '#field_suffix' => t('characters'),
      '#required' => TRUE,
      '#description' => '<br />' . t('Number of characters to display per page.'),
      '#default_value' => variable_get('paging_automatic_chars_' . $type, 4000),
      '#prefix' => '<div class="container-inline paging-chars paging-chars-' . $type . '">',
      '#suffix' => '</div>',
      '#states' => array(
        'visible' => array(// action to take.
          ':input[name="paging_enabled_' . $type . '"]' => array('checked' => TRUE),
          ':input[name="paging_automatic_method_' . $type . '"]' => array('value' => 'chars'),
          ),
        ),
      );

    // Automatic paging method. Text box to choose orphan size.
    $form[$type]['paging_config']['paging_right']['paging_automatic_chars_orphan_' . $type] = array(
      '#type' => 'textfield',
      '#title' => t('Length of orphans'),
      '#size' => 6,
      '#field_suffix' => t('characters'),
      '#required' => TRUE,
      '#description' => '<br />' . t('Number of characters to consider as an orphan.'),
      '#default_value' => variable_get('paging_automatic_chars_orphan_' . $type, 100),
      '#prefix' => '<div class="container-inline paging-chars-orphan paging-chars-orphan-' . $type . '">',
      '#suffix' => '</div>',
      '#states' => array(
        'visible' => array(// action to take.
          ':input[name="paging_enabled_' . $type . '"]' => array('checked' => TRUE),
          ':input[name="paging_automatic_method_' . $type . '"]' => array('value' => 'chars'),
          ),
        ),
      );

    // Automatic paging method. Select list to choose the number of words per page.
    $form[$type]['paging_config']['paging_right']['paging_automatic_words_' . $type] = array(
      '#type' => 'select',
      '#title' => t('Length of each page'),
      '#options' => drupal_map_assoc(range(100, 1000, 50)),
      '#field_suffix' => t('words'),
      '#required' => TRUE,
      '#description' => '<br />' . t('Number of words to display per page.'),
      '#default_value' => variable_get('paging_automatic_words_' . $type, 400),
      '#prefix' => '<div class="container-inline paging-words paging-words-' . $type . '">',
      '#suffix' => '</div>',
      '#states' => array(
        'visible' => array(// action to take.
          ':input[name="paging_enabled_' . $type . '"]' => array('checked' => TRUE),
          ':input[name="paging_automatic_method_' . $type . '"]' => array('value' => 'words'),
          ),
        ),
      );

    // Automatic paging method. Text box to set orphan page size.
    $form[$type]['paging_config']['paging_right']['paging_automatic_words_orphan_' . $type] = array(
      '#type' => 'textfield',
      '#title' => t('Length of orphans'),
      '#size' => 6,
      '#field_suffix' => t('words'),
      '#required' => TRUE,
      '#description' => '<br />' . t('Number of wordss to consider as an orphan.'),
      '#default_value' => variable_get('paging_automatic_words_orphan_' . $type, 200),
      '#prefix' => '<div class="container-inline paging-words-orphan paging-words-orphan-' . $type . '">',
      '#suffix' => '</div>',
      '#states' => array(
        'visible' => array(// action to take.
          ':input[name="paging_enabled_' . $type . '"]' => array('checked' => TRUE),
          ':input[name="paging_automatic_method_' . $type . '"]' => array('value' => 'words'),
          ),
        ),
      );
  }

  $module_path = drupal_get_path('module', 'paging');
  drupal_add_css($module_path . '/paging.admin.css', 'module');

  return system_settings_form($form);
}