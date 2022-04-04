<?

/**
 *
 * Template Name: Eco Overview
 */
?>
<? get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <h2 class="text-center section-header">In this section:</h2>
    <div class="row-padding-extra-small">
      <?= inc('/partials/events/_grid_item.php', [
        'args' => [
          'post_type' => 'page',
          'order' => 'ASC',
          'posts_per_page' => -1,
          'post_parent'    => $post->ID
        ]
      ]); ?>
    </div>
  </section>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= $section1Title; ?></h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>
</main>

<? get_footer(); ?>