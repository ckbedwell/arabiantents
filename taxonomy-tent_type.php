<?

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */
$count = $wp_query->post_count;
if ($count == 1) {
  include(locate_template('single-tent.php'));
} else {
  $description = term_description($wp_query->term_id);
  $queried_object = get_queried_object();
  $title = $queried_object->name;

  get_header(); ?>
  <main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(taxonomyFeaturedImage($queried_object), $title); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <?php if ($description) : ?>
    <div class="width-contain-1000 sectioned">
      <?= createTextColumns($description); ?>
    </div>
  <?php endif; ?>
  <?= inc('/partials/cta-blocks.php', [
            'args' => queryToBlocks([
              'post_type' => 'tent',
              'tent_type' => $term
            ]),
            'ratio' => [1.5, 1]
          ]); ?>
  </main>

<? } get_footer(); ?>