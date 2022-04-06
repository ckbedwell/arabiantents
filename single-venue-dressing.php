<?

/**
 * Template Name: Venue Dressing Sub-page
 *
 * @package digicrab
 */

get_header();
$images = rwmb_meta('photos', 'type=image');

?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main entry-content'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= rwmb_meta('more-info-h2'); ?></h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>

  <? if (!empty($images)) : ?>
    <section class="width-contain sectioned">
      <?= inc('/partials/gallery.php', ['images' => $images]); ?>
    </section>
  <?php endif; ?>

  <? if (!empty($specificTestimonial)) : ?>
      <section class="width-contain-960 sectioned">
        <?= inc('/partials/specific-testimonial.php', ['testimonial' => $specificTestimonial]); ?>
      </section>
    <? endif; ?>

  <? get_template_part('partials/enquiry-forms/quick-form'); ?>
</main>
<style>
  .contact-form {
    margin-bottom: 0;
  }
</style>
<? get_footer(); ?>