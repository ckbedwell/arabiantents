<?

/**
 * Template Name: Venue Dressing Sub-page
 *
 * @package digicrab
 */
$featuredImage = get_the_featured_image($post->ID);
$icon = get_post_meta($post->ID, 'page-icon', true);
if (empty($icon)) {
  $icon = 'icon-furniture';
}

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main entry-content'); ?> role="main">
  <article>
    <? get_template_part('featured-image2'); ?>

    <div class="wrapper entry-content drop-off" id="scrollto-entry-content">
      <section class="scrollto-padding info">
        <? if (function_exists('breadcrumbs')) {
          breadcrumbs();
        } ?>

        <div class="height-filler hide"></div>
        <div class="full sticky-info">
          <div class="width-contain row-padding-extra-small">
            <div class="two-thirds">
              <span class="<?= $icon; ?> big-icon no-padding alignleft"></span>
              <div class="five-sixths no-padding">
                <h2>Ready to decorate?</h2>
                <p>We love to help plan a party! Tell us a bit about your event and we will get back to you within 24 hours.</p>
              </div>
            </div>
            <div class="alignright third">
              <a href="/contact" class="vertical-align horizontal-align no-margin more-info enquire-button" value="enquiry-form">Enquire about our <? the_title(); ?></a>
            </div>
            <button class="lower-info point-five-trans clickable"><span class="icon-arrow-right point-five-trans"></span></button>
          </div>
        </div>
      </section>
      <section class="entry-content main-content width-contain">
        <div class="intro">
          <h2><?= rwmb_meta('more-info-h2', $args = array('type=text')); ?></h2>
          <?= do_shortcode(wpautop(get_the_content())); ?>
          <? $specificTestimonial = rwmb_meta('specific-testimonial');
          if (!empty($specificTestimonial)) {
            get_template_part('partials/specific-testimonial');
          } ?>
        </div>
      </section>
      <?php $images = rwmb_meta('photos', 'type=image');
      if (!empty($images)) : ?>
        <section class="gallery">
          <div class="width-contain pb-90">
            <div class="gallery">
              <? foreach ($images as $key => $image) : ?>
                <a href="<?= $image["full_url"]; ?>" class="fl-l image-link lightbox-link">
                  <img src="<?= wp_get_attachment_image_url($key, 'medium'); ?>" class="obf-cv point-five-trans" width="300" height="200" alt="<?= $image["alt"]; ?>">
                </a>
              <? endforeach; ?>
            </div>
          </div>
        </section>
      <?php endif; ?>
      <footer class="entry-footer">
        <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
      </footer>
    </div>
    <? include(locate_template('/partials/cta.php')); ?>
  </article>
</main>
<? get_footer(); ?>