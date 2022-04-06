<?
/*
 * Template Name: Gallery Page
 * Description: Gallery page
 */

get_header();
$images = get_field('image_gallery');
?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <section class="width-contain sectioned">
    <h1 class="page-title"><? the_title(); ?></h1>
  </section>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <? if (!empty($images)) : ?>
    <section class="width-contain sectioned">
      <?= inc('/partials/gallery.php', ['images' => $images]); ?>
    </section>
  <?php endif; ?>
  <? get_template_part('partials/enquiry-forms/quick-form'); ?>
  <style>
    .contact-form {
      margin-bottom: 0;
    }
  </style>
</main>
<? get_footer(); ?>