<?php
/**
 * @file
 * Default Superslides Row Plugin Template.
 *
 * Available variables:
 * $views_superslides_id
 * $rows
 */
?>
<div id="<?php print $views_superslides_id ?>" class="views-superslides-wrapper">
  <ul class="slides-container">
  <?php $index = 0; ?>
  <?php foreach ($rows as $row): ?>
  <?php if ($use_title): ?>
    <li id="<?php if ($use_title)print $titles[$index] ?>">
  <?php else: ?>
    <li>
  <?php endif ?>
      <?php print $row ?>
    </li>
  <?php $index++; ?>
  <?php endforeach; ?>
  </ul>
  <nav class="slides-navigation">
    <a href="#" class="next">Next</a>
    <a href="#" class="prev">Previous</a>
  </nav>
</div>