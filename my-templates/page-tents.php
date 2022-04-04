<?

/**
 * Template Name: Tents Overview Page
 */

get_header();
?>
<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>
  <?
  $terms = get_terms('tent_type', array(
    'hide_empty' => 0,
    //'orderby' => 'count', BEING ORDERED BY CUSTOM TAXONOMY ORDER NE PLUGIN
  ));

  foreach ($terms as $term) :
    if (have_posts()) : ?>
      <section class="width-contain sectioned">
        <a class="" href="<?= get_term_link($term->term_id); ?>">
          <h2 class="section-header"><?= $term->name; ?></h2>
        </a>
        <? if (!empty($term->description)) : ?>
          <div class="width-contain-1000 sectioned">
            <?= createTextColumns($term->description); ?>
          </div>
        <? endif; ?>
        <div>
          <?= inc('/partials/cta-blocks.php', [
            'args' => queryToBlocks([
              'post_type' => 'tent',
              'tent_type' => $term->slug
            ]),
            'ratio' => [1.5, 1]
          ]); ?>
        </div>
      </section>
    <? endif;
  endforeach; ?>
</main>
<? get_footer(); ?>