<?php
function blockVideo()
{
  $content = get_sub_field('video_url');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createVideo($content);

  return blockWrapper($container, $classes, $blockContent);
}
?>

<?
function createVideo($content)
{
  ob_start();
?>

  <div class="responsive-video">
    <iframe src="<?= $content; ?>" allowfullscreen></iframe>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  return $output;
}
?>