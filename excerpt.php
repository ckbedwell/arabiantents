<?
$imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
$featuredImage = wp_get_attachment_image_src($imgID, 'full'); //get the url of the featured image (returns an array)
$imgURL = $featuredImage[0]; //get the url of the image out of the array
$altText = get_post_meta($imgID, '_wp_attachment_image_alt', true);
$captionText = get_post(get_post_thumbnail_id())->post_excerpt;
?>

<article class="third archive-item">
  <? if (!empty($imgID)) : ?>
    <div class="parent-contain">
      <a href="<? the_permalink(); ?>" class="full image-link">
        <div class="display-card-medium featured-image" data-bg="<?= $imgURL; ?>"></div>

        <noscript>
          <div class="display-card-medium featured-image" style="background-image: url(<?= $imgURL; ?>);"></div>
        </noscript>

      </a>
    </div>
  <? endif; ?>

  <div class="parent-contain">
    <div class="height-match">
      <h2 class="excerpt-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

    </div>

  </div>
</article>