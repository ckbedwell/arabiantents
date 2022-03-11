<? $count = count($ideas); ?>
<div class="grid-<?= $count; ?> grid-1-m gap-3">
  <?php
    foreach ($ideas as $idea) :
    $image = get_field('term_image', 'post_tag' . '_' . get_term($idea)->term_id);
    $title = get_term($idea)->name;
  ?>
    <div>
      <a href="<?= get_term_link($idea); ?>">
        <? createImage($image); ?>
      </a>
      <div><?= $title; ?></div>
    </div>
  <?php endforeach; ?>
</div>
