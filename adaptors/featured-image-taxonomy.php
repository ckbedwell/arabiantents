<?php
function taxonomyFeaturedImage($queried_object) {
  $image_data = get_field('term_image', $queried_object);
  $src = $image_data['url'];
  $height = $image_data['height'];
  $width = $image_data['width'];
  $alt = $image_data['description'];

  return array(
    'src' => $src,
    'height' => $height,
    'width' => $width,
    'alt' => $alt
  );
}
?>