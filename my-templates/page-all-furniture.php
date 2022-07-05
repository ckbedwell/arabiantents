<?
/*
* Template Name: All furniture items
* Description: Display all the Team Members on the website.
*/
get_header();
?>



<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <?= createHeaderImage(postFeaturedImage($post), get_the_title()); ?>
  <? include(locate_template('/scaffold/breadcrumbs.php')); ?>


  <section class="width-contain sectioned">
    <h2 class="section-header">Download our furniture pricelist</h2>
    <a href="https://arabiantents.com/wp-content/themes/arabiantents/resources/HoH - Price list 2021-2.pdf" target="_blank" class="image-link download-link text-center material-card">
      <img src="https://arabiantents.com/wp-content/uploads/2019/09/Screenshot-2019-09-20-at-15.25.04.png" class="lazy-loaded">
    </a>
  </section>

  <section class="width-contain-960 sectioned">
    <h2 class="section-header"><?= $section1Title; ?></h2>
    <?= createTextColumns(get_the_content()); ?>
  </section>
</main>

<? get_footer(); ?>