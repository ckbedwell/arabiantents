<?php
function createTextColumns($content)
{
  ob_start();
?>
  <div class="text-columns">
    <?= wpautop($content); ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>