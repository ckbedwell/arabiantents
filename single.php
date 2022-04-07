<?

/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain-960 sectioned post-content">
    <h2 class="section-header"><?= $section1Title; ?></h2>
    <?= do_shortcode(wpautop(get_the_content())); ?>
  </section>
</main>
<? get_footer(); ?>