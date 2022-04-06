<?
$imageBlocks = $blocks;
$ratio = $ratio;
$count = count($imageBlocks);
$length = 2;

if ($count === 4) {
  $length = 4;
}

if ($count === 3) {
  $length = 3;
}

if ($count === 1) {
  $length = 1;
}


if ($count > 4) {
  $length = 3;
}
?>
<section class="width-contain sectioned">
  <div class="grid-<?= $length; ?> grid-2-t grid-1-m gap-3 cta-blocks">
    <?
    foreach ($imageBlocks as $key => $props) {
      createImageBlock($key, $props, $ratio);
    }
    ?>
  </div>
</section>