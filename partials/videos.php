<? $count = count($videos); ?>
<div class="grid-<?= $count; ?> grid-1-m gap-3">
  <?php foreach ($videos as $video) : ?>
    <div class="responsive-video">
      <iframe src="<?= $video; ?>" allowfullscreen></iframe>
    </div>
  <?php endforeach; ?>
</div>