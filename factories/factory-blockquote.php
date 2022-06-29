<?php
  function createBlockquote($quote, $attributed) {
    ob_start();
?>
    <blockquote class="text-center">
      <p><?= $quote; ?></p>
      <p class="attributed"><?= $attributed; ?></p>
    </blockquote>
<?php
  $output = ob_get_clean();
  ob_flush();
  return $output;
  }
?>
