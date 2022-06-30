<?php
function blockIdeaBlocks()
{
  $items = get_sub_field('items');
  $itemsPerRow = get_sub_field('items_per_row');
  $ratio = get_sub_field('aspect_ratio');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createIdeaBlocks($items, $itemsPerRow, $ratio);

  return blockWrapper($container, $classes, $blockContent);
}

function createIdeaBlocks($items, $itemsPerRow, $ratio) {
  $blocks = '';

  foreach ($items as $item) {
    $imageData = get_field('term_image', 'post_tag' . '_' . get_term($item)->term_id);
    $img = isset($imageData['url']) ? $imageData['url'] : '';
    $desc = get_term($item)->name;
    $href = get_term_link($item);

    $blocks .= createCtaBlock(null, ['img' => $img, 'href' => $href, 'desc' => $desc], [$ratio['width'], $ratio['height']]);
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