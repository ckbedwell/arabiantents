<?php
function blockWorkedWith()
{
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createWorkedWith();

  return blockWrapper($container, $classes, $blockContent);
}
?>


<?
function createWorkedWith()
{
  ob_start();
?>
  <? include(locate_template('/partials/worked-with.php')); ?>
<?php
  $output = ob_get_clean();
  ob_flush();
  return $output;
}
?>