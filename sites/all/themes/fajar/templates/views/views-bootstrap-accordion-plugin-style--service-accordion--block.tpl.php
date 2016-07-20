<div id="views-bootstrap-accordion-<?php print $id ?>" class="<?php print $classes ?>">
<?php $i = 0; ?> 
 <?php foreach ($rows as $key => $row): ?>
    <div class="panel panel-default">
      <div class="panel-heading">
        <h4 class="panel-title">
          <i class="fa fa-check"></i>
          <a class="accordion-toggle"
             data-toggle="collapse"
             data-parent="#views-bootstrap-accordion-<?php print $id ?>"
             href="#collapse<?php print $key ?>">
            <?php print $titles[$key] ?>
          </a>
        </h4>
      </div>
      <div id="collapse<?php print $key ?>" class="panel-collapse collapse <?= ($i == 0) ? 'in' : ''; ?>">
        <div class="panel-body">
          <?php print $row ?>
        </div>
      </div>
    </div>
    <?php $i++; ?>
  <?php endforeach ?>
</div>


