<?
/*
 * Template Name: Contact Page
 * Description: Display the contact information on the website.
 */
?>
<? get_header(); ?>

<main class="site-main contact-page" role="main">
  <?= createHeaderImage(postFeaturedImage($post)); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>

  <section class="width-contain sectioned">
    <?= createTextColumns(get_the_content()); ?>
    <? if (is_active_sidebar('contact-details')) {
      dynamic_sidebar('contact-details');
    } ?>
    <div class="contact-details">
      <a id="directions">
        <? $address = get_post_meta(get_the_ID(), 'address', true); ?>
        <? echo str_replace(',', '<br/>', $address); ?>
        <? $postcode = explode(',', $address); ?>
      </a>
    </div>
    <div>
      <what3words-address words="beauty.emphasis.continues" />
    </div>
  </section>

  <? get_template_part('partials/enquiry-forms/quick-form'); ?>
</main>
<style>
  .header-image .image {
    min-height: unset !important;
  }

  .contact-form {
    margin-bottom: 0;
  }
</style>


<? get_footer(); ?>