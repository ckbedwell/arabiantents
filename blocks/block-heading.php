<?php
function blockHeading()
{
  $content = get_sub_field('content');
  $tag = get_sub_field('tag');
  $headingClasses = get_sub_field('heading_classes');
  $textAlignment = get_sub_field('text_alignment');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createHeading($content, $tag, $headingClasses, $textAlignment);

  return blockWrapper($container, $classes, $blockContent);
}

function createHeading($content, $tag, $headingClasses, $textAlignment)
{
  ob_start();
?>
  <<?= $tag; ?> class="<?= $headingClasses; ?>" style="text-align: <?= $textAlignment; ?>;">
    <?= $content; ?>
  </<?= $tag; ?>>
<?php
  $output = ob_get_clean();
  ob_flush();
  return $output;
}
?>