<?

/**
 *
 * Template Name: Your Event Page
 */
?>
<? get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage($post, get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>
  <section class="width-contain">
    <h2 class="section-header">What kind of event are you having?</h2>
    <div class="row-padding-extra-small">
      <?= inc('/partials/cta-blocks.php', [
        'args' => queryToBlocks([
          'post_type' => 'page',
          'order' => 'ASC',
          'tax_query' => [
            [
              'taxonomy' => 'page-type',
              'field' => 'slug',
              'terms' => 'service-page',
            ]
          ]
        ])
      ]); ?>
    </div>
  </section>

  <section class="width-contain sectioned">
    <div class="width-contain-700 intro">
      <?= do_shortcode(wpautop(get_the_content())); ?>
    </div>
  </section>

  <?= inc("/partials/events-sub.php"); ?>

  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>

<? get_footer(); ?>