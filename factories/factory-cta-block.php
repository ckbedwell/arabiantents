<?php
function createCtaBlock($title, $props, $ratio)
{
  ob_start();
  $desc = $props['desc'];
  $img = $props['img'];
  $href = $props['href'];
  $cta = $props['cta'];
  $icon = $props['icon'];
  $width = $ratio[0];
  $height = $ratio[1];
?>
  <div class="cta-block">
    <a class="cta-block__image-wrapper" href="<?= $href; ?>">
      <?= createImage($img, $desc, $height, $width); ?>
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
    </a>
    <? if ($desc) : ?>
      <div>
        <div class="cta_block__desc"><?= $desc ?></div>
        <a class="action-button" href="<?= $href; ?>">
          <?= $cta; ?>
        </a>
      </div>
    <? endif; ?>
  </div>
<?php
  $output = ob_get_clean();
  return $output;
}
?>