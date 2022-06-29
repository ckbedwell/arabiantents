<?php
function createTextColumns($content, $columnsCount = 2)
{
  ob_start();
?>
  <div class="text-columns" style="--columnsCount: <?= $columnsCount; ?>;">
    <?= do_shortcode(wpautop($content)); ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  return $output;
}
?>