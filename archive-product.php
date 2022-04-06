<?

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */

get_header();
$archive = get_queried_object();

?>
<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <h1 class="page-title">
    <?= $archive->label; ?>
  </h1>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
      <?= inc('/partials/image-blocks.php', [
        'blocks' => archiveToBlocks($wp_query->posts),
        'ratio' => [1, 1]
      ]); ?>
  </section>
</main>
<? get_footer(); ?>