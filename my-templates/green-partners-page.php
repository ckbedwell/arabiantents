<?

/**
 *
 * Template Name: Green Partners
 */

get_header();

?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= $section1Title; ?></h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>

  <section class="width-contain sectioned">
    <h2 class="section-header">Our recommended suppliers</h2>
      <?= inc('/partials/events/_grid_item.php', [
        'args' => [
          'post_type' => 'page',
          'tax_query' => [
            [
              'taxonomy' => 'page-type',
              'field' => 'slug',
              'terms' => 'additional-service',
            ]
          ]
        ]
      ]); ?>
  </section>
</main>
<? get_footer(); ?>