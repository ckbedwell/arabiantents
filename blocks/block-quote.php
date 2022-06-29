<?php
function blockQuote()
{
  $content = get_sub_field('content');
  $attributed = get_sub_field('attributed');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createBlockquote($content, $attributed);

  return blockWrapper($container, $classes, $blockContent);
}
?>