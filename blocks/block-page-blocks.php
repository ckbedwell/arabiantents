<?php
function blockPageBlocks()
{
  $items = get_sub_field('items');
  $itemsPerRow = get_sub_field('items_per_row');
  $ratio = get_sub_field('aspect_ratio');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createPageBlocks($items, $itemsPerRow, $ratio);

  return blockWrapper($container, $classes, $blockContent);
}

function createPageBlocks($items, $itemsPerRow, $ratio) {
  $ctaBlocks = archiveToBlocks($items);
  $blocks = '';

  foreach ($ctaBlocks as $key => $props) {
    $blocks .= createCtaBlock($key, $props, [$ratio['width'], $ratio['height']]);
  }

  ob_start();
  ?>
    <div class="grid-<?= $itemsPerRow; ?> grid-2-t grid-1-m gap-3 cta-blocks">
      <?= $blocks; ?>
    </div>
  <?
  $output = ob_get_clean();
  return $output;
}
?>