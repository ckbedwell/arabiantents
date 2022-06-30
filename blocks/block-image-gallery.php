<?php
function blockImageGallery()
{
  $content = get_sub_field('gallery_images');
  $container = get_sub_field('container');
  $classes = get_sub_field('classes');
  $blockContent = createImageGallery($content);

  return blockWrapper($container, $classes, $blockContent);
}

function createImageGallery($images)
{
  ob_start();
?>
  <div class="gallery">
    <? foreach($images as $image) :
      // var_dump($image);
      $src = $image['url'];
      $height = $image['height'];
      $width = $image['width'];
      $alt = $image['alt'];
    ?>
      <a href="<?= $src; ?>">
        <?= createImage($src, $alt, $height, $width); ?>
      </a>
    <? endforeach; ?>
</div>
<?php
  $output = ob_get_clean();
  return $output;
}
?>
