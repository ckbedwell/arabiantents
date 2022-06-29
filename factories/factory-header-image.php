<?php
function createHeaderImage($imageData, $title = null, $links = [], $headerPosition = null)
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
      <div class="radial <?= $headerPosition; ?>">
        <div class="width-contain">
          <h1><?= $title; ?></h1>
          <? if (!empty($links)) : ?>
            <div class="usps">
              <div class="flex gap-2 gap-1-m">
                <?
                $i = 0;
                foreach ($links as $link) :
                ?>
                  <a class="<?= $link['link_class']; ?>" href="<?= $link['link']; ?>"><?= $link['link_label']; ?></a>
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
  return $output;
}
?>