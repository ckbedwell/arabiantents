<?php
  function createDisplayCard($title, $img) {
    ob_start();
?>
    <div class="display-card">
      <img src="<?= $img; ?>" />
      <h3><?= $title ?></h3>
    </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
  }
?>
