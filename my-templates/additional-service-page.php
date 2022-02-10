<?

/**
 *
 * Template Name: Additional Service Sub-Page
 */
?>
<? $featuredImage = get_the_featured_image($post->ID); ?>
<? if (!$icon = get_post_meta($post->ID, 'page-icon', true)) {
  $icon = 'icon-clipboard';
} ?>
<? get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main entry-content'); ?> role="main">
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
              <h2>Are you interested in our <? the_title(); ?> service?</h2>
              <p>Tell us a bit about your event and we can get back to you within 24 hours with a quote. </p>
            </div>
          </div>
          <div class="alignright third">
            <a href="/contact" class="vertical-align horizontal-align no-margin enquire-button clickable more-info" value="enquiry-form">Tell us about your event</a>
          </div>
          <button class="lower-info point-five-trans clickable">
            <span class="icon-arrow-right point-five-trans"></span>
          </button>
        </div>
      </div>
    </section>

    <section class="row-padding">
      <div class="width-contain">
        <div class="half intro">
          <h2><?= rwmb_meta('more-info-h2', $args = array('type=text')); ?></h2>
          <?= do_shortcode(wpautop(get_the_content())); ?>
          <? $specificTestimonial = rwmb_meta('specific-testimonial'); ?>
          <? if (!empty($specificTestimonial)) {
            get_template_part('partials/specific-testimonial');
          } ?>
        </div>



        <? if (get_the_title() === 'Catering') { ?>
          <div class="parent-contain row-padding">
            <? $query = new WP_Query(['post_type' => 'caterer']); ?>
            <? $count = $query->post_count; ?>

            <h2 class="text-center">Caterers we recommend</h2>
            <div class="center-items text-center caterers">
              <? while ($query->have_posts()) { ?>
                <? $query->the_post(); ?>
                <? $featuredImage = get_the_featured_image($post->ID); ?>

                <div class="quarter">
                  <? $featuredImage = get_the_featured_image($post->ID); ?>
                  <a class="full" href="<? the_permalink(); ?>">
                    <img class="full" data-src="<?= $featuredImage['full_url']; ?>">
                    <noscript>
                      <img class="full" src="<?= $featuredImage['full_url']; ?>">
                    </noscript>
                  </a>

                  <h3><? the_title(); ?></h3>
                </div>
              <? } ?>
            </div>

            <? wp_reset_postdata(); ?>
          </div>
        <? } ?>
      </div>
    </section>
  </div>
  <? include(locate_template('/partials/cta.php')); ?>

  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>

<? get_footer(); ?>