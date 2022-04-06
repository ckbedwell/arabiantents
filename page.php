<?

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package digicrab
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= $section1Title; ?></h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>
</main>
<? get_footer(); ?>