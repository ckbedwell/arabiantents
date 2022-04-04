<?

get_header();
$post = get_page_by_title('Blog');

?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain">
    <?= inc('/partials/cta-blocks.php', [
        'args' => queryToBlocks([
          'post_type' => 'post',
        ]),
        'ratio' => [1, 1]
      ]); ?>
  </section>
</main>

<? get_footer(); ?>