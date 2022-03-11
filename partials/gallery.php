<div class="gallery">
  <? foreach($images as $image) :
    $image_data = wp_get_attachment_metadata($image['ID']);
    $src = 'wp-content/uploads/' . $image_data['file'];
    $height = $image_data['height'];
    $width = $image_data['width'];
    $alt = $image_data['image_meta']['title'];
  ?>
    <a href="<?= $src; ?>">
      <?= createImage($src, $alt, $height, $width); ?>
    </a>
  <? endforeach; ?>
</div>
