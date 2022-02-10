<?
wp_reset_query();

$acfImages = get_field('term_gallery', $taxonomy . '_' . $term_id);
$acfLocationImages = get_field('term_gallery');
$featuredImage = get_the_featured_image(get_the_ID());

if ($isSingleTent) {
  $featuredImage = get_the_featured_image($postID);
}

$caption = $featuredImage['caption'];
$featuredImage = $featuredImage['full_url'];

$excerpt = get_the_excerpt();
$title = get_the_title();

$smallHeader = get_post_meta($post->ID, 'small-header', true);

if ($isSingleTent != true && (is_archive() || is_tag() || is_tax())) { //
  $queried_object = get_queried_object();
  $taxonomy = $queried_object->taxonomy;
  $term_id = $queried_object->term_id;

  $featuredImage = get_field('term_image', $taxonomy . '_' . $term_id);
  $title = $queried_object->name;
  $excerpt = get_field('term_excerpt', $taxonomy . '_' . $term_id);
}

if ('caterer' === get_post_type()) {
  $featuredImage = $images[0]['url'];
}

if ('location' === get_post_type() || 'product' === get_post_type()) {
  $excerpt = get_field('term_excerpt');
  $featuredImage = get_field('term_image');
}
?>


<? if ($smallHeader == 1) : ?>
  <header class="row-padding wrapper small-header">
    <div class="width-contain text-center">
      <h1 class="entry-title"><? the_title(); ?></h1>
    </div>
  </header>
<? else : ?>

  <? if ($featuredImage) : ?>
    <header class="row-padding full-slider  entry-header full-bg-header">

      <?php if ($acfImages) : ?>
        <div class="featured-image">
          <div class="owl-carousel main-slider">

            <?
            foreach ($acfImages as $image) {

              echo   '<div class="item"><div class="main-slider__image" style="background-image: url(' . $image["url"] . ')"></div></div>';
            }
            ?>
          </div>
        </div>

      <?php elseif ($acfLocationImages) : ?>
        <div class="featured-image">
          <div class="owl-carousel main-slider">

            <?
            foreach ($acfLocationImages as $image) {
              echo   '<div class="item"><div class="main-slider__image" style="background-image: url(' . $image["url"] . ')"></div></div>';
            }
            ?>
          </div>
        </div>

      <?php else : ?>

        <div class="featured-image" data-bg="<?= $featuredImage; ?>"><? if ($caption) : ?><span class="point-three-trans clickable featured-image-caption"><span class="alignleft vertical-align icon-camera"></span><?= $caption; ?></span><? endif; ?></div>

      <? endif; ?>
      <button class="pinterest-btn" onclick="window.open('//pinterest.com/pin/create/link/?url=<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&media=<?= $featuredImage; ?>&description=<?= get_the_excerpt(); ?>','_blank','resizable=yes'); event.stopPropagation(); event.preventDefault();">Save</button>
    <? else : ?>
      <header class="row-padding wrapper entry-header">

      <? endif; ?>
      <div class="height-filler"></div>
      <div class="vertical-align full">
        <div>
          <div class="left-header-side alignleft">
            <? if ($taxonomy == 'post_tag') : ?>
              <h4>Get ideas for your...</h4>
            <? endif; ?>
            <h1 class="entry-title"><?= $title; ?></h1>
            <?

            if ($isSingleTent) {
              $terms = get_the_terms($postID, 'tent_type');
              foreach ($terms as $term) {
                echo '<h4>' . $term->name . '</h4>';
                // Get rid of the other data stored in the object, since it's not needed
                unset($term);
              }
            } elseif ('venue' == get_post_type()) {
              $terms = get_the_terms($post->ID, 'location');
              foreach ($terms as $term) {
                echo '<h4>' . $term->name . '</h4>';
                // Get rid of the other data stored in the object, since it's not needed
                unset($term);
              }
            } elseif ('caterer' == get_post_type()) {
              echo '<h4>Caterer</h4>';
            } elseif ('post' == get_post_type() && !$taxonomy == 'post_tag') {
              if (in_category('external-blogs')) {
                echo '<div class="post-meta">';
                echo '<span>' . get_field('website_name') . '</span>';
              } else {
                echo '<div class="post-meta">';
                author_image(get_the_author()->ID);
                echo '<span>' . get_the_author_link() . '</span>';
              }
              published_date();
              echo '</div>';
            }

            ?>



            <?
            if ('caterer' === get_post_type()) { ?>
              <? if (!empty($contactNumber)) : ?>
                <p><strong>Phone Number:</strong> <?= $contactNumber; ?></p>
              <? endif; ?>

              <? if (!empty($email)) : ?>
                <p><strong>Email:</strong> <a href="mailto:<?= $email; ?>"><?= $email; ?></a></p>
              <? endif; ?>

              <? if (!empty($website)) : ?>
                <p><strong>Website:</strong> <a href="<?= $website; ?>" target="_blank"><?= $website; ?></a></p>
              <? endif; ?>

            <? } else {
              echo wpautop($excerpt);
            }
            ?>
          </div>
        </div>
      </div>
      </header>
    <? endif; //SMALL HEADER 
    ?>