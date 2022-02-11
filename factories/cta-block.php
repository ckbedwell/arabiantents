<?php
function createCtaBlock($title, $props)
{
  ob_start();
  $desc = $props['desc'];
  $img = $props['img'];
  $href = $props['href'];
?>
  <a class="cta-block" href="<?= $href; ?>">
    <? if (isset($img)) {
      createImage($img, $desc);
    } ?>
    <div class="cta_block__content">
      <div>
        <h3 class="secondary"><?= $title ?></h3>
        <div class="cta_block__desc"><?= $desc ?></div>
      </div>
      <div>
        <span class="action-button">
          Click me
        </span>
      </div>
    </div>
  </a>
<?php
  $output = ob_get_clean();
  ob_flush();
  echo $output;
}
?>