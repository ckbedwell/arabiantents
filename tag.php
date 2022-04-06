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
$title = $queried_object->name;
$slug = $queried_object->slug;
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
$content = $queried_object->description;

$acfAddHeader = get_field('term_additional_header', $taxonomy . '_' . $term_id);
$images = get_field('term_gallery', $taxonomy . '_' . $term_id);
$acfSimilarIdeas = get_field('similar_ideas', $taxonomy . '_' . $term_id);
$specificTestimonial = get_field('term_testimonial', $taxonomy . '_' . $term_id);
$acfVideo = get_field('term_video', $taxonomy . '_' . $term_id);
$faqs = get_field('term_faqs', $taxonomy . '_' . $term_id);

get_header(); ?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(taxonomyFeaturedImage($queried_object), $title); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= $acfAddHeader; ?></h2>
    <?= createTextColumns($content); ?>
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

  <? if ($acfVideo) : ?>
    <section class="width-contain sectioned">
      <h2 class="section-header">Watch our video</h2>
      <?= inc('/partials/videos.php', ['videos' => array($acfVideo)]); ?>
    </section>
  <?php endif; ?>

  <? if ($faqs) : ?>
    <section class="row-padding">
      <div class="anchor-id" id="faqs" style="padding-top: 70px; margin-top: -70px">
        <div class="width-contain-700 intro">
          <h2><?= display_the_archive_title() . ' faqs' ?> </h2>
          <?= wpautop($faqs); ?>
        </div>
      </div>
    </section>
  <? endif; ?>

  <? $tentPosts = queryToBlocks(array(
    'post_type' => 'tent',
    'posts_per_page' => '-1',
    'tag' => $slug,
  ));

  if (!empty($tentPosts)) : ?>
    <section class="width-contain sectioned">
      <h2 class="section-header">These are our favourite tents when having a <?= strtolower($title); ?></h2>
      <?= inc('/partials/cta-blocks.php', [
        'args' => $tentPosts,
        'ratio' => [1.6, 1]
      ]); ?>
    </section>
  <? endif; wp_reset_query(); ?>

  <? $internalBlogs = queryToBlocks(array(
    'category_name' => 'blog',
    'tag' => $slug,
  ));

  if (!empty($internalBlogs)) : ?>
    <section class="width-contain sectioned">
      <h2 class="section-header">On our blog</h2>
      <?= inc('/partials/cta-blocks.php', [
        'args' => $internalBlogs,
        'ratio' => [1.6, 1]
      ]); ?>
    </section>
  <? endif; wp_reset_query(); ?>

  <? $externalBlogs = queryToBlocks(array(
    'category_name' => 'external-blogs',
    'tag' => $slug,
  ));

  if (!empty($externalBlogs)) : ?>
    <section class="width-contain sectioned">
      <h2 class="section-header">Blogs around the web</h2>
      <?= inc('/partials/cta-blocks.php', [
        'args' => $externalBlogs,
        'ratio' => [1.6, 1]
      ]); ?>
    </section>
  <? endif; wp_reset_query(); ?>
</main>
<? get_footer(); ?>