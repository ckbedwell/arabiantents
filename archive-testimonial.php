<?

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */
?>
<? get_header();

$post = get_page_by_title('Testimonials');
$testimonialCount = $wp_query->post_count;
?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <div class="text-center">
      We currently have <strong><?= $testimonialCount; ?></strong> testimonials.
    </div>
  </section>

  <section class="width-contain">
    <? if (have_posts()) : ?>
      <? while (have_posts()) : ?>
        <? the_post(); ?>
        <article class="testimonial-entry">
          <? the_title('<h2 class="excerpt-title">', '</h2>'); ?>
          <?= wpautop(get_the_content()); ?>
        </article>
      <? endwhile; ?>
    <? endif; ?>
  </section>
</main>
<? get_footer(); ?>