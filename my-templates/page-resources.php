<?
/*
 * Template Name: Resources Page
 * Description: Resources page
 */

get_header(); ?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <? if (get_field("resources_to_upload")) : ?>
      <div class="grid-3 grid-2-t gap-3">
        <? while (have_rows("resources_to_upload")) : the_row();
          $title = get_sub_field("resource_title");
          $src = get_sub_field("resource_cover_image");
          $href = get_sub_field("link");
        ?>
          <div class="resource">
            <h2 class="text-center"><?= $title ?></h4>
            <a href="<?= $href ?>" target="_blank" class="">
              <?= createImage($src, $title); ?>
            </a>
          </div>
        <? endwhile; ?>
      </div>
    <? endif; ?>
  </section>
</main>
<style>
  .resource a {
    border: 1px solid var(--goldDark);
    display: block;
  }
</style>
<? get_footer(); ?>