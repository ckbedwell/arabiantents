<?

/**
 *
 * Template Name: Your Event Page
 */
?>
<? get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <h2 class="section-header">What kind of event are you having?</h2>
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
      ]),
      'ratio' => [1, 1]
    ]); ?>
  </section>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= $section1Title; ?></h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>

  <? if (have_rows('gallery_columns')) : ?>
    <? while (have_rows('gallery_columns')) : the_row();
      $images = get_sub_field('images');
      $title = get_sub_field('title');
      $description = get_sub_field('description');
    ?>
      <?php if ($images) : ?>
        <section class="width-contain-960 sectioned">
          <?php if ($title) : ?>
            <h2 class="section-header"><?= $title; ?></h2>
          <?php endif; ?>
          <?php if ($description) : ?>
            <?= do_shortcode(wpautop($description)); ?>
          <?php endif; ?>
          </div>
          <?= inc('/partials/gallery.php', ['images' => $images]); ?>
        </section>
      <?php endif; ?>
    <? endwhile; ?>
    <? get_template_part('partials/enquiry-forms/quick-form'); ?>
  <?php endif; ?>
  <?= inc("/partials/events-sub.php"); ?>
</main>

<? get_footer(); ?>