<?php
  function createHeaderImage($post) {
    $featuredImage = get_the_featured_image($post->ID);
    $src = $featuredImage['full_url'];
    $height = $featuredImage['sizes']['large']['height'];
    $width = $featuredImage['sizes']['large']['width'];
    $alt = "";
    ob_start();
?>
    <div class="header-image">
      <?= createImage($src, $alt, $height, $width); ?>
    </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
  }
?>
