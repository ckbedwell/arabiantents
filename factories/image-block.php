<?php
function createImageBlock($title, $props, $ratio)
{
  ob_start();
  $desc = $props['desc'];
  $img = $props['img'];
  $icon = $props['icon'];
  $width = $ratio[0];
  $height = $ratio[1];
?>
  <div class="cta-block">
    <div class="cta-block__image-wrapper">
      <? createImage($img, $desc, $height, $width); ?>
      <? if (isset($icon)) : ?>
        <span class="<?= $icon; ?> cta-block__icon"></span>
      <? endif; ?>
      <div class="cta_block__content">
        <div>
          <h3 class="secondary">
            <?= $title; ?>
          </h3>
        </div>
      </div>
    </div>
  </div>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>