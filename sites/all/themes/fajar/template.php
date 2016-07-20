<?php

/**
 * @file
 * template.php
 */

function fajar_menu_tree__primary(&$variables) {
  return '<ul class="nav navbar-nav cl-effect-5">' . $variables['tree'] . '</ul> ';
}
function fajar_menu_link(array $variables) {
  $element = $variables['element'];
  $sub_menu = '';
  if($element['#theme'] == 'menu_link__main_menu') {
    unset($element['#attributes']['class']);
  }
  if ($element['#below']) {
   
    // Prevent dropdown functions from being added to management menu as to not affect navbar module.
    if (($element['#original_link']['menu_name'] == 'management') && (module_exists('navbar'))) {
      $sub_menu = drupal_render($element['#below']);
    }
    else {
     
      // Add our own wrapper
      unset($element['#below']['#theme_wrappers']);

      if ($element['#original_link']['depth'] >= 2) {
        $sub_menu = '<ul class="dropdown-menu level3">' . drupal_render($element['#below']) . '</ul>';
      }
      else {        
        $sub_menu = '<ul class="dropdown-menu">' . drupal_render($element['#below']) . '</ul>'; 
      }
      
      $element['#localized_options']['attributes']['class'][] = 'dropdown-toggle';
      $element['#localized_options']['attributes']['class'][] = 'scroll';
      $element['#localized_options']['attributes']['data-hover'] = 'dropdown';
     
      // Check if this element is nested within another
      if ((!empty($element['#original_link']['depth'])) && ($element['#original_link']['depth'] > 1)) { 
        // Generate as dropdown submenu
        $element['#attributes']['class'][] = 'dropdown';
        // $sub_menu = '<i class="fa fa-angle-right pull-right"></i>' . $sub_menu;
      }
      else {
        // Generate as standard dropdown
        $element['#attributes']['class'][] = 'dropdown';
        $element['#localized_options']['html'] = TRUE;        
      }
      // $element['#title'] .= ' <span class="caret"></span>';
      // Set dropdown trigger element to # to prevent inadvertant page loading with submenu click
      $element['#localized_options']['attributes']['data-target'] = '#';       
    }
  }
  else if (!($element['#original_link']['depth'] > 1)) {

    $element['#localized_options']['html'] = TRUE;
    $element['#title'] = '<span data-hover="'.$element['#title'].'">'.$element['#title'].'</span>';
  }
  // Issue #1896674 - On primary navigation menu, class 'active' is not set on active menu item.
  // @see http://drupal.org/node/1896674
   if(strpos($output,"active")>0){
        $element['#attributes']['class'][] = "active scroll";
    }
  $output = l($element['#title'], $element['#href'], $element['#localized_options']);
  return '<li' . drupal_attributes($element['#attributes']) . '>' . $output . $sub_menu . "</li>\n";

}

function fajar_preprocess_page(&$variables) {
 
  // if (drupal_is_front_page()) {
  //   drupal_add_js('http://maps.google.com/maps/api/js?sensor=false', array('type' => 'external'));
  //   drupal_add_js(drupal_get_path('theme', 'fajar').'/js/map-dark.js');      
  // }
  

  $search_box = drupal_render(drupal_get_form('search_form'));
  $variables['search_box'] = $search_box;



  // Add information about the number of sidebars.
  if (!empty($variables['page']['sidebar_first']) && !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-md-6"';
  }
  elseif (!empty($variables['page']['sidebar_first']) || !empty($variables['page']['sidebar_second'])) {
    $variables['content_column_class'] = ' class="col-md-8"';
  }
  else {
    $variables['content_column_class'] = ' class="col-md-12"';
  }  
} 
function fajar_js_alter(&$js) {  
  $bootstrap_js_path = drupal_get_path('theme', 'bootstrap') . '/js/bootstrap.js';
  $st_block_appear_js_path = drupal_get_path('module', 'st_block') . '/js/jquery.appear.js';
  if (isset($js[$st_block_appear_js_path])) {
    unset($js[$st_block_appear_js_path]);
  }
  unset($js[$bootstrap_js_path]);   
  $isotope_js_path = drupal_get_path('module', 'views_isotope') . '/views_isotope.js';
  if (isset($js[$isotope_js_path])) {    
    unset($js[$isotope_js_path]);
    drupal_add_js(drupal_get_path('theme', 'fajar') . '/js/views_isotope.js');
  } 
}
function fajar_theme() {
    return array(
        'contact_site_form' => array(
            'render element' => 'form',
            'template' => 'contact-site-form',
            'path' => drupal_get_path('theme', 'fajar') . '/templates/system',
        ),
    );
}

function fajar_breadcrumb($variables) {

	$GLOBALS['base_path']; 
	$GLOBALS['base_url']; 
  $site_frontpage_new = $GLOBALS['base_url'];
	$site_frontpage = $GLOBALS['base_url'];
  	$breadcrumb = $variables['breadcrumb'];
	$newbreadcrumbs=array();

  	if (!empty($breadcrumb)) {
		foreach($breadcrumb as $each){
			if(!is_array($each)){
				array_push($newbreadcrumbs,$each);
			}
		}
		$breadcrumb=$newbreadcrumbs;
    // Adding the title of the current page to the breadcrumb.
		// screen-reader users. Make the heading invisible with .element-invisible.
    //'<h2 class="element-invisible">' . t('You are here') . '</h2>';
    //'<h2 class="element-invisible">' . t('You are here') . '</h2>'
		$output = '';
	
		$output .= '<div class="breadcrumb"><a class="active-trail" href="'.$site_frontpage_new.'">Home</a> » ' . implode(' » ', $breadcrumb) . ' » '.drupal_get_title().'</div>';
		return $output;
  	}else{
		$output = '';
	
		$output .= '<div class="breadcrumb"><a class="active-trail" href="'.$site_frontpage_new.'">Home</a> » '.drupal_get_title().'</div>';
		return $output;
	}
}


function fajar_form_alter(){ 


if ($form_id == 'webform_client_form_117'){
   $form['#action'] = '?#block-block-16';
}


}

?>


