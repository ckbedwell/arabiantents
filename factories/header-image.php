<?php
function createHeaderImage($imageData, $title = null, $links = [])
{
  $src = $imageData['src'];
  $height = $imageData['height'];
  $width = $imageData['width'];
  $alt = $imageData['alt'];
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