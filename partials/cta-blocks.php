<?
$ctaBlocks = $args;
$count = count($ctaBlocks);
$length = 2;

if ($count === 4) {
  $length = 4;
}

if ($count > 4) {
  $length = 3;
}

?>
<section class="width-contain sectioned">
  <div class="grid-<?= $length; ?> grid-2-t grid-1-m gap-3 cta-blocks">
    <?
    foreach ($ctaBlocks as $key => $props) {
      createCtaBlock($key, $props);
    }
    ?>
  </div>
</section>