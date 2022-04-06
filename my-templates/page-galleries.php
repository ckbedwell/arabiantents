<?

/**
 *
 * Template Name: Galleries Page
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <section class="width-contain sectioned">
    <h1 class="page-title"><? the_title(); ?></h1>
  </section>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain">
    <?= inc('/partials/cta-blocks.php', [
        'args' => queryToBlocks([
          'post_type' => 'page',
            'order' => 'ASC',
            'tax_query' => array(
              array(
                'taxonomy' => 'page-type',
                'field' => 'slug',
                'terms' => ['gallery', 'image-gallery'],
              )
            )
        ]),
        'ratio' => [1, 1]
      ]); ?>
  </section>
</main>
<? get_footer(); ?>