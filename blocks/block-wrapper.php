<?php
function blockWrapper($container, $classes, $content)
{
  ob_start();
?>
  <div class="<?= $classes; ?>">
    <div class="width-contain-<?= $container; ?>">
      <?= $content; ?>
    </div>
  </div>
<?php
  $output = ob_get_clean();
  return $output;
}
?>