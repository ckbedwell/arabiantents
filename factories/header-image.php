<?php
function createHeaderImage($post, $title = null, $links = [])
{
  $imageId = get_post_thumbnail_id($post->ID);
  $image_data = wp_get_attachment_metadata($imageId);
  // var_dump($image_data);
  $src = 'wp-content/uploads/' . $image_data['file'];
  $height = $image_data['height'];
  $width = $image_data['width'];
  $alt = $image_data['image_meta']['title'];
  ob_start();
?>
  <div class="header-image wrapper">
    <?= createImage($src, $alt, $height, $width); ?>
    <? if (isset($title) || !empty($links)) : ?>
      <div class="radial">
        <div class="width-contain">
          <h1><?= $title; ?></h1>
          <? if (!empty($links)) : ?>
            <div class="usps">
              <div class="flex gap-2 gap-1-m">
                <?
                $i = 0;
                foreach ($links as $key => $link) :
                ?>
                  <a href="<?= $link; ?>"><?= $key; ?></a>
                  <? if ($i !== count($links) - 1) : ?>
                    <span class="divider"></span>
                  <?php endif; ?>
                  <? $i++; ?>
                <? endforeach; ?>
              </div>
            </div>
          <? endif; ?>
        </div>
      </div>
    <?php endif; ?>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>