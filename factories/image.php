<?php
function createImage($src, $alt = null, $height = 1, $width = 1)
{
  ob_start();
?>
  <div class="image" style="--aspect-h: <?= $height; ?>; --aspect-w: <?= $width; ?>;">
    <? if (isset($src)) : ?>
      <img alt="<?= $alt; ?>" src="<?= $src; ?>" />
    <? endif; ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>