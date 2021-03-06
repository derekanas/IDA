<?php
/**
 * @file
 * Contains functions called only by admin pages.
 */

/**
 * Off-loaded SlickViews::option_definition().
 */
function _slick_views_option_definition() {
  $options = array(
    'optionset' => array('default' => 'default'),
    'optionset_thumbnail' => array('default' => ''),
    'skin' => array('default' => ''),
    'skin_thumbnail' => array('default' => ''),
    'skin_arrows' => array('default' => ''),
    'skin_dots' => array('default' => ''),
    'asnavfor_main' => array('default' => ''),
    'asnavfor_thumbnail' => array('default' => ''),
    'asnavfor_auto' => array('default' => FALSE),
    'thumbnail_caption' => array('default' => ''),
    'grid' => array('default' => ''),
    'grid_medium' => array('default' => ''),
    'grid_small' => array('default' => ''),
    'visible_slides' => array('default' => ''),
    'preserve_keys' => array('default' => FALSE),
    'slide_field_wrapper' => array('default' => FALSE),
    'slide_title' => array('default' => ''),
    'slide_image' => array('default' => ''),
    'slide_thumbnail' => array('default' => ''),
    'slide_overlay' => array('default' => ''),
    'slide_link' => array('default' => ''),
    'editor_link' => array('default' => ''),
    'slide_layout' => array('default' => ''),
    'slide_caption' => array('default' => array()),
    'override' => array('default' => FALSE),
    'overridables' => array('default' => array()),
    'id' => array('default' => ''),
  );
  return $options;
}

/**
 * Off-loaded SlickViews::options_form().
 */
function _slick_views_options_form(&$form, &$form_state, $view, $settings) {
  $fields = $view->display_handler->get_handlers('field');
  $skins = slick_skins_options();
  $optionsets = slick_optionset_options();
  $is_tooltip = array('class' => array('is-tooltip'));

  $elements = array();
  $elements['optionset'] = array(
    '#title' => t('Option set main'),
    '#type' => 'select',
    '#options' => $optionsets,
    '#default_value' => $settings['optionset'],
    '#description' => t('Manage optionsets at <a href="@link">Slick carousel admin page</a>.', array('@link' => url('admin/config/media/slick'))),
    '#attributes' => $is_tooltip,
  );

  $elements['skin'] = array(
    '#type' => 'select',
    '#title' => t('Skin main'),
    '#options' => $skins,
    '#default_value' => $settings['skin'],
    '#empty_option' => t('- None -'),
    '#description' => t('Skins allow swappable layouts like next/prev links, split image and caption, etc. However a combination of skins and options may lead to unpredictable layouts, get dirty yourself.'),
    '#attributes' => $is_tooltip,
  );

  $elements['optionset_thumbnail'] = array(
    '#title' => t('Option set thumbnail'),
    '#type' => 'select',
    '#options' => $optionsets,
    '#empty_option' => t('- None -'),
    '#default_value' => $settings['optionset_thumbnail'],
    '#description' => t('If provided, asNavFor aka thumbnail navigation applies. Leave empty to not use thumbnail navigation.'),
    '#attributes' => $is_tooltip,
  );

  $elements['skin_thumbnail'] = array(
    '#type' => 'select',
    '#title' => t('Skin thumbnail'),
    '#options' => $skins,
    '#empty_option' => t('- None -'),
    '#default_value' => $settings['skin_thumbnail'],
    '#description' => t('Thumbnail navigation skin. Leave empty to not use thumbnail navigation.'),
    '#attributes' => $is_tooltip,
  );

  $elements['skin_arrows'] = array(
    '#type' => 'select',
    '#title' => t('Skin arrows'),
    '#options' => array(),
    '#default_value' => $settings['skin_arrows'],
    '#empty_option' => t('- None -'),
    '#description' => t('Use hook_slick_arrows_info() to add your own arrows skins, in the same format as hook_slick_skins_info().'),
    '#attributes' => $is_tooltip,
    '#access' => FALSE,
  );

  if ($arrows = slick_arrows_options()) {
    $elements['skin_arrows']['#options'] = $arrows;
    $elements['skin_arrows']['#access'] = TRUE;
  }

  $elements['skin_dots'] = array(
    '#type' => 'select',
    '#title' => t('Skin dots'),
    '#options' => array(),
    '#default_value' => $settings['skin_dots'],
    '#empty_option' => t('- None -'),
    '#description' => t('Use hook_slick_dots_info() to add your own dots skins, in the same format as hook_slick_skins_info().'),
    '#attributes' => $is_tooltip,
    '#access' => FALSE,
  );

  if ($dots = slick_dots_options()) {
    $elements['skin_dots']['#options'] = $dots;
    $elements['skin_dots']['#access'] = TRUE;
  }

  $elements['asnavfor_main'] = array(
    '#type' => 'textfield',
    '#title' => t('asNavFor main'),
    '#default_value' => $settings['asnavfor_main'],
    '#description' => t('Valid CSS selector (with "." or "#") to override asNavFor target for the main display, e.g.: #slick-main-thumbnail or .slick--nav. This should address the thumbnail display class or ID attributes. Slick thumbnail navigation ID is suffixed with "-thumbnail".'),
    '#attributes' => $is_tooltip,
  );

  $elements['asnavfor_thumbnail'] = array(
    '#type' => 'textfield',
    '#title' => t('asNavFor thumbnail'),
    '#default_value' => $settings['asnavfor_thumbnail'],
    '#description' => t('Valid CSS selector (with "." or "#") to override asNavFor target for the thumbnail display, e.g.: #slick-main or .slick--for. This should address the main display class or ID attributes. Also provide thumbnail field below.'),
    '#attributes' => $is_tooltip,
  );

  $elements['asnavfor_auto'] = array(
    '#title' => t('asNavFor auto selectors'),
    '#type' => 'checkbox',
    '#default_value' => $settings['asnavfor_auto'],
    '#field_suffix' => '',
    '#title_display' => 'before',
    '#description' => t('If checked, asNavFor selectors will be determined by the current view ID selector automatically. Check if unsure with selectors.'),
    '#attributes' => $is_tooltip,
  );

  $grid_options = drupal_map_assoc(range(1, 12));
  $elements['grid'] = array(
    '#type' => 'select',
    '#title' => t('Grid large'),
    '#options' => $grid_options,
    '#empty_option' => t('- None -'),
    '#default_value' => $settings['grid'],
    '#description' => t('The amount of block grid columns for large monitors 64.063em - 90em. Use skin Grid for starter. This module feature has been around before the Slick library officiallly supported it. Leave empty to use the library grid system instead.'),
    '#attributes' => $is_tooltip,
  );

  $elements['grid_medium'] = array(
    '#type' => 'select',
    '#title' => t('Grid medium'),
    '#options' => $grid_options,
    '#empty_option' => t('- None -'),
    '#default_value' => $settings['grid_medium'],
    '#description' => t('The amount of block grid columns for medium devices 40.063em - 64em.'),
    '#attributes' => $is_tooltip,
  );

  $elements['grid_small'] = array(
    '#type' => 'select',
    '#title' => t('Grid small'),
    '#options' => $grid_options,
    '#empty_option' => t('- None -'),
    '#default_value' => $settings['grid_small'],
    '#description' => t('The amount of block grid columns for small devices 0 - 40em.'),
    '#attributes' => $is_tooltip,
  );

  $elements['visible_slides'] = array(
    '#type' => 'select',
    '#title' => t('Visible slides'),
    '#options' => drupal_map_assoc(range(1, 32)),
    '#empty_option' => t('- None -'),
    '#default_value' => $settings['visible_slides'],
    '#description' => t('How many items per slide displayed at a time related to this grid.'),
    '#attributes' => $is_tooltip,
  );

  $elements['preserve_keys'] = array(
    '#title' => t('Preserve keys'),
    '#type' => 'checkbox',
    '#default_value' => $settings['preserve_keys'],
    '#description' => t('If checked, keys will be preserved. Default is FALSE which will reindex the grid chunk numerically'),
    '#attributes' => $is_tooltip,
    '#field_suffix' => '.',
    '#title_display' => 'before',
  );

  $elements['slide_field_wrapper'] = array(
    '#title' => t('Slick markups'),
    '#type' => 'checkbox',
    '#default_value' => $settings['slide_field_wrapper'],
    '#description' => t('If checked, Slick will provides its markups for the following fields. For more complex slide (asNavFor + nested/overlay + main BG altogether), be sure to apply filter criteria and skin properly.'),
    '#attributes' => $is_tooltip,
    '#field_suffix' => '',
    '#title_display' => 'before',
  );

  $image_options = $caption_options = $layout_options = $link_options = array();
  $editor_options = $title_options = $thumbnail_caption_options = array();

  foreach ($fields as $field => $handler) {
    if (isset($handler->field_info)) {
      $type = $handler->field_info['type'];

      switch ($type) {
        case 'file':
        case 'image':
          $image_options[$field] = $handler->ui_name();
          break;

        case 'list_text':
          $layout_options[$field] = $handler->ui_name();
          break;

        case 'text':
        case 'text_long':
        case 'text_with_summary':
        case 'link_field':
          $link_options[$field] = $handler->ui_name();
          $title_options[$field] = $handler->ui_name();
          if ($type != 'link_field') {
            $thumbnail_caption_options[$field] = $handler->ui_name();
          }
          break;
      }
    }

    // Content: title is not really a field, unless title.module installed.
    if ($handler->field == 'title') {
      $title_options[$field] = $handler->ui_name();
      $thumbnail_caption_options[$field] = $handler->ui_name();
    }

    if ($handler->field == 'view_node') {
      $link_options[$field] = $handler->ui_name();
    }

    if ($handler->field == 'edit_node' || $handler->field == 'delete_node') {
      $editor_options[$field] = $handler->ui_name();
    }

    // Caption can be anything to get custom works going.
    $caption_options[$field] = $handler->ui_name();
  }

  // Simple uniform layout, or a dedicated list text field.
  $slick_fields = url(drupal_get_path('module', 'slick_fields') . '/README.txt');
  $layout_options = $layout_options ? $layout_options : slick_layouts();
  $elements['slide_layout'] = array(
    '#title' => t('Slide layout'),
    '#type' => 'select',
    '#default_value' => $settings['slide_layout'],
    '#options' => $layout_options,
    '#empty_option' => t('- None -'),
    '#description' => t('Two options: <ol><li>A custom list text field, to control each slide layout. Choose "key" under its Formatter.</li><li>Builtin layouts, to apply uniformly to all slides.</li></ol>Leave empty to DIY. <a href="@url">Read more</a> about layouts.', array('@url' => $slick_fields)),
    '#attributes' => $is_tooltip,
    '#prefix' => '<h3 class="form--slick__title">' . t('Fields') . '</h3>',
  );

  // Title field.
  $elements['slide_title'] = array(
    '#title' => t('Slide title'),
    '#type' => 'select',
    '#empty_option' => t('- None -'),
    '#options' => $title_options,
    '#default_value' => $settings['slide_title'],
    '#description' => t('If provided, it will be wrapped with H2 and class .slide__title.'),
    '#attributes' => $is_tooltip,
  );

  // Main image field.
  $elements['slide_image'] = array(
    '#title' => t('Main image field'),
    '#type' => 'select',
    '#empty_option' => t('- None -'),
    '#options' => $image_options,
    '#default_value' => $settings['slide_image'],
    '#description' => t('Main image, treated as background if overlay is provided.'),
    '#attributes' => $is_tooltip,
  );

  // Thumbnail field relevant to asNavFor.
  $elements['slide_thumbnail'] = array(
    '#title' => t('Thumbnail image'),
    '#type' => 'select',
    '#empty_option' => t('- None -'),
    '#options' => $image_options,
    '#default_value' => $settings['slide_thumbnail'],
    '#description' => t("Only needed if <em>Option set thumbnail</em> is provided. May be the same field as the main image, only different instance. Leave empty to not use thumbnail pager."),
    '#attributes' => $is_tooltip,
  );

  // Thumbnail caption.
  $elements['thumbnail_caption'] = array(
    '#type' => 'select',
    '#title' => t('Thumbnail caption'),
    '#default_value' => $settings['thumbnail_caption'],
    '#options' => $thumbnail_caption_options,
    '#empty_option' => t('- None -'),
    '#description' => t('Thumbnail caption maybe just title/ plain text. If Thumbnail image is not provided, the thumbnail pagers will be just text like regular tabs.'),
    '#attributes' => $is_tooltip,
  );

  // Slide overlay.
  $elements['slide_overlay'] = array(
    '#title' => t('Overlay image/video'),
    '#type' => 'select',
    '#empty_option' => t('- None -'),
    '#options' => $image_options,
    '#default_value' => $settings['slide_overlay'],
    '#description' => t('If audio/video, be sure the display is not image. Zebra layout is reasonable for overlay and captions.'),
    '#attributes' => $is_tooltip,
  );

  // Link field.
  $elements['slide_link'] = array(
    '#title' => t('Link'),
    '#type' => 'select',
    '#empty_option' => t('- None -'),
    '#options' => $link_options,
    '#default_value' => $settings['slide_link'],
    '#description' => t('Link to content: Read more, View Case Study, etc, wrapped with class .slide__link.'),
    '#attributes' => $is_tooltip,
  );
  
  // Editor link.
  $elements['editor_link'] = array(
    '#title' => t('Editor link'),
    '#type' => 'select',
    '#empty_option' => t('- None -'),
    '#options' => $editor_options,
    '#default_value' => $settings['editor_link'],
    '#description' => t('Link for editor: edit, delete.'),
    '#attributes' => $is_tooltip,
  );

  // Caption fields.
  $slide_captions = is_array($settings['slide_caption']) ? array_values($settings['slide_caption']) : $settings['slide_caption'];

  $elements['slide_caption'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Caption fields'),
    '#description' => t("Select fields for the caption, excluding those already selected above."),
    '#options' => $caption_options,
    '#default_value' => $slide_captions,
    '#attributes' => $is_tooltip,
  );

  // Add empty suffix to style checkboxes like iOS.
  foreach ($elements['slide_caption']['#options'] as $key => $element) {
    $elements['slide_caption'][$key]['#field_suffix'] = '';
    $elements['slide_caption'][$key]['#title_display'] = 'before';
  }

  $elements['id'] = array(
    '#type' => 'textfield',
    '#title' => t('Element ID'),
    '#description' => t("Manually define the Slick carousel container ID attribute <em>Ensure you don't display similar ID elements on the same page</em>. If you provide Option set thumbnail and asNavFor, slick thumbnail navigation ID is suffixed with '-thumbnail'."),
    '#size' => 40,
    '#maxlength' => 255,
    '#default_value' => $settings['id'],
    '#attributes' => $is_tooltip,
    '#field_prefix' => '#',
  );

  $elements['override'] = array(
    '#title' => t('Override optionset'),
    '#type' => 'checkbox',
    '#default_value' => $settings['override'],
    '#description' => t('If checked, the following options will override the main optionset. Useful to re-use one optionset for several different displays. Use hook_slick_overridable_options_info_alter() to add more.'),
    '#attributes' => $is_tooltip,
    '#field_suffix' => '',
    '#title_display' => 'before',
  );

  $overridable_options = slick_get_overridable_options();
  $overridable_values = is_array($settings['overridables']) ? array_values($settings['overridables']) : $settings['overridables'];
  $elements['overridables'] = array(
    '#type' => 'checkboxes',
    '#title' => t('Overridable options'),
    '#description' => t("Override the main optionset to re-use one. Anything dictated here will override the current main optionset. OFF means FALSE"),
    '#options' => $overridable_options,
    '#default_value' => $overridable_values,
    '#attributes' => $is_tooltip,
    '#states' => array(
      'visible' => array(
        ':input[name$="[override]"]' => array('checked' => TRUE),
      ),
    ),
  );

  // Add empty suffix to style checkboxes like iOS.
  foreach ($elements['overridables']['#options'] as $key => $element) {
    $elements['overridables'][$key]['#field_suffix'] = '';
    $elements['overridables'][$key]['#title_display'] = 'before';
  }

  return $elements;
}
