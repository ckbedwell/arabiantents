<?

/**
 *
 * Template Name: Venue Dressing Page
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <h2 class="section-header">In this section you will also find:</h2>
    <?= inc('/partials/cta-blocks.php', [
      'args' => queryToBlocks([
        'post_type' => 'venue-dressing',
        'order' => 'ASC'
      ]),
      'ratio' => [1, 1]
    ]); ?>
  </section>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= $section1Title; ?></h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>
</main>
<? get_footer(); ?>