<?

/**
 *
 * Template Name: Event Sub-Page
 */

$featuredImage = get_the_featured_image($post->ID);

get_header();

$CTAimages = rwmb_meta('cta-image');
$desc =  get_post_meta($post->ID, 'singular-desc', true);
$videos = rwmb_meta('videos');
$images = rwmb_meta('photos', 'type=image');
$specificTestimonial = rwmb_meta('specific-testimonial');
$ideas = wp_get_post_tags(get_the_ID());
$partners = get_field("partners_gallery");
$divideOnH2 = preg_split('/(?=<h2>)/', get_the_content(), -1, PREG_SPLIT_NO_EMPTY);
$sections = [];

function stripClosingH2($content)
{
  $str = str_replace("</h2>", "", $content);
  $str = str_replace("<h2>", "", $content);
  return $str;
}

foreach ($divideOnH2 as $division) {
  $splitH2 = explode("</h2>", $division);
  array_push($sections, array_map('stripClosingH2', $splitH2));
}

$section1 = array_shift($sections);
$section1Title = rwmb_meta('more-info-h2');
$section1Text = $section1[0];

$section2 = array_shift($sections);
$section3 = array_shift($sections);
?>
<style>
  .text-columns img,
  .text-columns iframe {
    display: none;
  }
</style>
<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= $section1Title; ?></h2>
    <?= createTextColumns($section1Text); ?>
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

  <? if ($section2) : ?>
    <section class="width-contain-960 sectioned">
      <h2 class="section-header"><?= $section2[0]; ?></h2>
      <?= createTextColumns($section2[1]); ?>
    </section>
  <? endif; ?>

  <? if ($videos) : ?>
    <section class="width-contain sectioned">
      <h2 class="section-header">Experience an Arabian Tents event</h2>
      <?= inc('/partials/videos.php', ['videos' => $videos]); ?>
    </section>
  <?php endif; ?>

  <? if ($section3) : ?>
    <section class="width-contain-960 sectioned">
      <h2 class="section-header"><?= $section3[0]; ?></h2>
      <?= createTextColumns($section3[1]); ?>
    </section>
  <? endif; ?>

  <? if ($partners) : ?>
    <section class="width-contain-960 sectioned">
      <h2 class="section-header">Our <?= ucfirst($desc); ?> Partners</h2>
      <? inc('/partials/partners-gallery.php', ['partners' => $partners]); ?>
    </section>
  <? endif; ?>

  <? if ($ideas) : ?>
    <section class="width-contain sectioned">
      <h2 class="section-header">Ideas gallery</h2>
      <?= inc("/partials/ideas-gallery.php", ['ideas' => $ideas]); ?>
    </section>
  <? endif; ?>
  <?= inc("/partials/events-sub.php"); ?>
</main>
<? get_footer(); ?>