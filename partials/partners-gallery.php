<div class="grid grid-8 grid-6-t grid-4-m gap-3 gap-2-t">
  <? foreach ($partners as $partner) : ?>
    <?= createImage($partner['partner_image'], null, 1, 1, "contain"); ?>
  <? endforeach; ?>
</div>