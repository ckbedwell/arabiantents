<?

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */

/*** MAIN QUERY MODIFIED IN FUNCTIONS.PHP -- ONLY FINDS EXTERNAL BLOGS ***/

$queried_object = get_queried_object();
$title = get_the_title();
$slug = $queried_object->slug;
$taxonomy = $queried_object->taxonomy;

$acfAddHeader = get_field('term_additional_header');
$acfImages = get_field('term_gallery');
$acfSimilarIdeas = get_field('similar_ideas');
$acfTestimonial = get_field('term_testimonial');
$acfVideo = get_field('term_video');


get_header(); ?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <? include(locate_template('/featured-image.php')); ?>
  <div class="scrollto-padding DS" id="scrollto-entry-content"></div>
  <div class="wrapper entry-content drop-off">
    <section class="no-padding info">
      <? if (function_exists('breadcrumbs')) {
        breadcrumbs();
      } ?>

      <div class="height-filler hide"></div>
      <div class="full sticky-info">
        <div class="width-contain row-padding-extra-small">
          <div class="two-thirds">
            <span class="icon-lamp2 big-icon no-padding alignleft"></span>
            <div class="five-sixths no-padding">
              <h2>Just getting started with planning?</h2>
              <p>Tell us a bit about your ideas and we can send you information tailored to your needs.</p>
            </div>
          </div>

          <div class="alignright third">
            <a href="/contact" class="vertical-align horizontal-align no-margin more-info enquire-button" value="enquiry-form">Tell us your ideas</a>
          </div>
          <button class="lower-info point-five-trans clickable"><span class="icon-arrow-right point-five-trans"></span></button>
        </div>
      </div>
    </section>

    <? if (get_the_content()) : ?>
      <section class="row-padding">
        <div class="width-contain">
          <div class="intro">
            <? if ($acfAddHeader) {
              echo '<h2>' . $acfAddHeader . '</h2>';
            } ?>
            <?= wpautop(get_the_content()); ?>
            <? if ($acfTestimonial) {
              inc('/partials/specific-testimonial.php', ['testimonial' => $acfTestimonial]);
            } ?>
          </div>
        </div>
      </section>
    <? endif; ?>

    <? if ($acfVideo) : ?>
      <section class="row-padding">
        <div class="width-contain-900 text-center">
          <h2>Watch our video</h2>
          <div class="laptop-container">
            <div class="padded laptop-border">
              <div class="responsive-video">
                <iframe src="<?= $acfVideo; ?>" allowfullscreen></iframe>
              </div>
            </div>
          </div>
        </div>
      </section>
    <? endif; ?>



  </div>
  <? include(locate_template('/partials/cta.php')); ?>
</main>
<? edit_tag_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
<? get_footer(); ?>