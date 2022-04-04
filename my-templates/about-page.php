<?

/**
 *
 * Template Name: About Page
 */
?>
<? get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <h2 class="section-header">More about us?</h2>
      <?= inc('/partials/cta-blocks.php', [
        'args' => queryToBlocks([
          'post_type' => 'page',
          'order' => 'ASC',
          'tax_query' => [
            [
              'taxonomy' => 'page-type',
              'field' => 'slug',
              'terms' => 'about-sub',
            ]
          ]
        ]),
        'ratio' => [1, 1]
      ]); ?>
  </section>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header">The largest collection of themed marquees in the UK</h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>

  <section class="sectioned">
    <div class="width-contain">
      <? include(locate_template('/partials/worked-with.php')); ?>
    </div>
  </section>
</main>

<? get_footer(); ?>