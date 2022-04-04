<?php
function postFeaturedImage($post) {
  $imageId = get_post_thumbnail_id($post->ID);
  $image_data = wp_get_attachment_metadata($imageId);
  // var_dump($image_data);
  $src = 'wp-content/uploads/' . $image_data['file'];
  $height = $image_data['height'];
  $width = $image_data['width'];
  $alt = $image_data['image_meta']['title'];

  return array(
    'src' => $src,
    'height' => $height,
    'width' => $width,
    'alt' => $alt
  );
}
?>