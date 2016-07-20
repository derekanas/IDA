<?php

/**
 * @file
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
?>
<?php if (!empty($title)): ?>
  <h3><?php print $title; ?></h3>
<?php endif; ?>
<?php 
    $total = count((array)$rows); 
    $half = floor($total/2);
    $i = 0;
?>
<div class="about-creative-section text-center clearfix">
    <div class="wrap-line">    
    <span class="middle-line"></span>  
    </div>
<?php foreach ($rows as $id => $row): ?>
  <?php   
    $i++;
    if($i == 1) {
        print '<div class="about-creative-left">';
    }
    if($i == ($half+1)) {
        print '<div class="about-creative-right">';
    }
    $class_last = '';
    if($i == $half) {
        $class_last = 'line-last';
    }
    if($i <= $half) {
        $line = '<span class="line-right '.$class_last.'"></span>';
    }else {
        $line = '<span class="line-left '.$class_last.'"></span>';
    }
  ?>
  <div<?php if ($classes_array[$id]) { print ' class="' . $classes_array[$id] .' about-tri-sec"';  } ?>>
      <?php print $line; ?>
      <?php print $row; ?>
  </div>
  <?php 
    if($i == $half) {
        print '</div>';
    }
  ?>
<?php endforeach; ?>
  </div>
</div>