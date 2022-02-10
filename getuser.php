<?


$args = array(
  'post_type' => 'layout',
  'layout_type' => 'dining, party',
  //'post__in' => $tents,
);

$query = new WP_Query($args);
if (have_posts()) : ?>
  <? while ($query->have_posts()) : $query->the_post(); ?>
    <?
    $postID = get_the_ID();
    $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
    $featuredImage = wp_get_attachment_image_src($imgID, 'full'); //get the url of the featured image (returns an array)
    $imgURL = $featuredImage[0]; //get the url of the image out of the array
    $lower = strtolower(get_the_title());
    $friendlyTitle = str_replace(" ", "-", $lower);
    ?>
    <div class="third" id="post-<? the_ID(); ?>">
      <input type="checkbox" name="field_tents[]" value="<? the_title(); ?>" id="<?= $friendlyTitle; ?>">
      <label for="<?= $friendlyTitle; ?>" class="display-card featured-image" data-bg="<?= $imgURL; ?>">
        <div class="overlay-information">
          <h3><? the_title(); ?></h3>
        </div>
      </label>
      <a class="iframe-loader" href="<? the_permalink(); ?>"><span class="icon-search"></span> View <? the_title(); ?></a>
    </div>
  <? endwhile; ?>
<? wp_reset_postdata();
endif; ?>