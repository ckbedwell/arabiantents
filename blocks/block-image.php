<?php
function blockImage()
{
  $image = get_sub_field('image');
  $type = get_sub_field('type');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $image_data = wp_get_attachment_metadata($image);
  $src = 'wp-content/uploads/' . $image_data['file'];
  $height = $image_data['height'];
  $width = $image_data['width'];
  $alt = $image_data['image_meta']['title'];
  $blockContent = createImage($src, $alt, $height, $width, $type);

  return blockWrapper($container, $classes, $blockContent);
}
?>