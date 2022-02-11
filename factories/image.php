<?php
  function createImage($src, $alt = null, $height = 1, $width = 1) {
    ob_start();
?>
    <div
      class="image"
      style="--aspect-h: <?= $height; ?>; --aspect-w: <?= $width; ?>"
    >
      <img
        alt="<?= $alt; ?>"
        src="<?= $src; ?>" />
    </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
  }
?>
