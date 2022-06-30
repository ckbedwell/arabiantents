<?php
  $pageUrl = $_SERVER["REQUEST_URI"];
  $crumbs = explode("/", $pageUrl);
  array_pop($crumbs);
  $i = 0;
  $count = count($crumbs);
?>

<div class="breadcrumbs">
  <div class="width-contain">
    <div class="breadcrumbs__wrapper flex">
      <? foreach($crumbs as $crumb) : ?>
        <? if ($i == 0) : ?>
          <a href="/" class="breadcrumbs__breadcrumb">Home</a>
        <? elseif ($i === $count - 1) : ?>
          <div class="breadcrumbs__breadcrumb">
            <?= ucwords(str_replace("-"," ", $crumb)); ?>
          </div>
        <? else : $currentCrumb = '/' . $crumb; ?>
          <a class="breadcrumbs__breadcrumb" href="<?= $currentCrumb; ?>">
            <?= ucwords(str_replace("-"," ", $crumb)); ?>
          </a>
        <? endif; $i++; ?>
      <? endforeach; ?>
    </div>
  </div>
</div>
