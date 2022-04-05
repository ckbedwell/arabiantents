<?

/**
 *
 * Template Name: Additional Service Sub-Page
 */
?>

<? get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main entry-content'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= rwmb_meta('more-info-h2', $args = array('type=text')); ?></h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>

  <? if (get_the_title() === 'Catering') : ?>
    <section class="width-contain sectioned">
      <h2 class="section-header">Caterers we recommend?</h2>
      <?= inc('/partials/cta-blocks.php', [
        'args' => queryToBlocks([
          'post_type' => 'caterer',
          ]),
        'ratio' => [1, 1]
      ]); ?>
    </section>
  <? endif; ?>

  <? get_template_part('partials/enquiry-forms/quick-form'); ?>
</main>
<style>
  .contact-form {
    margin-bottom: 0;
  }
</style>

<? get_footer(); ?>