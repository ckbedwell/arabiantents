<?php
  $infoBlocks = array(
    'Max Capacity:' => array(
      'icon' => 'icon-users',
      'answer' => 'answer0',
      'info' => rwmb_meta('max-capacity', $args = array('type=number')),
    ),
    'Min. Space Required:' => array(
      'icon' => 'icon-rulers',
      'answer' => 'answer1',
      'info' => rwmb_meta('min-size', $args = array('type=text')),
    ),
    'Build Time:' => array(
      'icon' => 'icon-clock',
      'answer' => 'answer2',
      'info' => rwmb_meta('build-time', $args = array('type=text')),
    ),
    'Layout and Price:' => array(
      'icon' => 'icon-coin-pound',
      'answer' => 'answer7',
      'info' => 'See examples',
    )
  )
?>

<section class="overview-info sectioned">
  <div class="width-contain">
    <div class="grid-4 grid-2-m gap-3">
      <?php foreach ($infoBlocks as $key => $infoBlock) : ?>
        <div class="info-block">
          <span class="info-block__icon <?= $infoBlock['icon'] ?>"></span>
          <span class="info-block__title">
            <?= $key; ?>
            <button class="more-info icon-info2" data-value="<?= $infoBlock['answer']; ?>"></button>
          </span>
          <?= $infoBlock['info']; ?>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<? include(locate_template('/partials/overlays/tent-faqs.php')); ?>