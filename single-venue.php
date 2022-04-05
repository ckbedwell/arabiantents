<?

/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */

$imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
$featuredImage = wp_get_attachment_image_src($imgID, 'full'); //get the url of the featured image (returns an array)
$imgURL = $featuredImage[0]; //get the url of the image out of the array
$altText = get_post_meta($imgID, '_wp_attachment_image_alt', true);
$captionText = get_post(get_post_thumbnail_id())->post_excerpt;

$venueAddress = rwmb_meta('venue-address', $args = array('type=text'));
$venueWebsite = rwmb_meta('venue-website', $args = array('type=text'));
$venueEmail = rwmb_meta('venue-email', $args = array('type=text'));
$venuePhone = rwmb_meta('venue-phone', $args = array('type=text'));
$images = rwmb_meta('venue-photos', 'type=image');
$theLocations = get_the_terms($post->ID, 'location');

foreach ($theLocations as $theLocation) {
  $location = $theLocation->name;
}

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <h2>
      <?= rwmb_meta('more-info-h2', $args = array('type=text')); ?>
    </h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>

    <? if (!empty($images)) : ?>
      <section class="width-contain sectioned">
        <?= inc('/partials/gallery.php', ['images' => $images]); ?>
      </section>
    <?php endif; ?>

    <section class="width-contain sectioned">
      <h2 class="section-header">
        Contact Details
      </h2>
        <?php
          $capacity = get_field('capacity', $postID);
          $licensed_for_marriage = get_field('licensed_for_marriage', $postID);
          $catering = get_field('catering', $postID);
          $bar = get_field('bar', $postID);
          $pets_welcome = get_field('pets_welcome', $postID);
          $exclusivity = get_field('exclusivity', $postID);
          $accommodation = get_field('accommodation_', $postID);
        ?>

        <?php if (!empty($capacity)) : ?>
          <div class="">
            Capacity: <?php echo $capacity; ?>
          </div>
        <? endif; ?>

        <?php if (!empty($licensed_for_marriage)) : ?>
          <div class="">
            Licensed for Marriage: <?php echo $licensed_for_marriage; ?>
          </div>
        <? endif; ?>

        <?php if (!empty($catering)) : ?>
          <div class="">
            Catering: <?php echo $catering; ?>
          </div>
        <? endif; ?>

        <?php if (!empty($bar)) : ?>
          <div class="">
            Bar: <?php echo $bar; ?>
          </div>
        <? endif; ?>


        <?php if (!empty($pets_welcome)) : ?>
          <div class="">
            Pets Welcome: <?php echo $pets_welcome; ?>
          </div>
        <? endif; ?>


        <?php if (!empty($child_friendly)) : ?>
          <div class="">
            Child Friendly: <?php echo $child_friendly; ?>
          </div>
        <? endif; ?>

        <?php if (!empty($exclusivity)) : ?>
          <div class="">
            Exclusivity: <?php echo $exclusivity; ?>
          </div>
        <? endif; ?>

        <?php if (!empty($accommodation)) : ?>
          <div class="">
            Accommodation: <?php echo $accommodation; ?>
          </div>
        <? endif; ?>

        <? if (!empty($venueAddress)) : ?>
          <div class="">
            <? $formattedAddress = str_replace(',', '<br/>', $venueAddress);
              echo $formattedAddress; ?>
          </div>
        <? endif; ?>

        <? if (!empty($venueWebsite)) : ?>
          <div class="">
            Website <a href="<?= $venueWebsite; ?>" target="_blank"><?= $venueWebsite; ?></a>
          </div>
        <? endif; ?>

        <? if (!empty($venueEmail)) : ?>
          <div class="">
            <a href="mailto:<?= $venueEmail; ?>"><?= $venueEmail; ?></a>
          </div>
        <? endif; ?>

        <? if (!empty($venuePhone)) : ?>
          <div class="">
            <a href="tel:<?= $venuePhone; ?>"><?= $venuePhone; ?></a>
          </div>
        <? endif; ?>
  </section>
</main>
<? get_footer(); ?>
