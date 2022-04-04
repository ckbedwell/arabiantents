<?php
function createTextColumns($content)
{
  ob_start();
?>
  <div class="text-columns">
    <?= do_shortcode(wpautop($content)); ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>