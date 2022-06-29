<?php
function blockTextColumns()
{
  $content = get_sub_field('content');
  $columnsCount = get_sub_field('columns');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createTextColumns($content, $columnsCount);

  return blockWrapper($container, $classes, $blockContent);
}
?>