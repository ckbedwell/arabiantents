<?
$isSingleTent = true;
$postID = get_the_ID();
$featuredImg = get_the_featured_image(get_the_ID()); //DIFFERENT (IMG INSTEAD OF IMAGE) BECAUSE OF INCLUDE PASSING VARIABLE
$specificTestimonial = get_post_meta(get_the_ID(), 'specific-testimonial', true);
$images = rwmb_meta('photos', 'type=image');
$acfVideo = get_field('video');

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main single-tent'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <div class="wrapper entry-content drop-off" id="scrollto-entry-content">
    <? include(locate_template('/partials/tents/overview-info.php')); ?>

    <section class="width-contain-960 sectioned">
      <h2 class="section-header">
        <?= rwmb_meta('more-info-h2', $args = array('type=text')); ?>
      </h2>
      <?= createTextColumns(get_the_content()); ?>
    </section>

    <? if (!empty($specificTestimonial)) : ?>
      <section class="width-contain-960 sectioned">
        <? get_template_part('partials/specific-testimonial'); ?>
      </section>
    <? endif; ?>

    <? if (!empty($images)) : ?>
      <section class="width-contain sectioned">
        <?= inc('/partials/gallery.php', ['images' => $images]); ?>
      </section>
    <?php endif; ?>

    <? get_template_part('partials/enquiry-forms/quick-form'); ?>

    <? if ($acfVideo) : ?>
      <section class="width-contain sectioned">
        <h2 class="section-header">
          Watch our video
        </h2>
        <?= inc('/partials/videos.php', ['videos' => array($acfVideo)]); ?>
        </div>
      </section>
    <? endif; ?>
</main>

<? get_footer(); ?>