<?
/*
 * Template Name: Christmas Decorators Page
 * Description: Christmas Decorators Page
 */

get_header();
$images = get_field('image_gallery');
$galleryImages = get_field('christmas_decorators_tiered_pyramid_gallery');
$moreInfoHeader = get_field('more_info_header')
?>
<style>
  aside.alignright {
    float: none;
    width: 100%;
    padding: 0;
    margin: 4rem 0;
  }
</style>
<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <section class="wrapper no-padding">
    <div class="darkened-reader-radial">
      <?
      if ($images) {
        foreach ($images as $image) :
          $parent = get_post_ancestors($image['ID']);
          $parentID = $parent[0];
          $parentTitle = get_the_title($parentID);
      ?>
          <div class="slide featured-image" style="background-image: url(<?php echo $image["url"]; ?>);"></div>

      <? endforeach;
      }
      ?>
    </div>

    <div class="full vertical-align">
      <div class="width-contain">
        <div class="width-contain-800 padded text-center intro over-slider-box">
          <h1 class="padded no-margin entry-title"><?= the_title(); ?></h1>
          <?= the_excerpt(); ?><?/*
                            <a class="white-button clickable" href="#scrollto-entry-content">Read more</a>*/ ?>
        </div>
      </div>
    </div>
  </section>
  <div class="wrapper entry-content drop-off" id="scrollto-entry-content">
    <section class="scrollto-padding info">
      <? if (function_exists('breadcrumbs')) {
        breadcrumbs();
      } ?>
      <div class="height-filler hide"></div>
      <div class="full sticky-info">
        <div class="width-contain row-padding-extra-small">
          <div class="two-thirds">
            <span class="<?= $icon; ?> big-icon no-padding alignleft"></span>
            <div class="five-sixths no-padding">
              <h2>Ready to decorate?</h2>
              <p>We love to help plan a party! Tell us a bit about your event and we will get back to you within 24 hours.</p>
            </div>
          </div>
          <div class="alignright third">
            <a href="/contact" class="vertical-align horizontal-align no-margin more-info enquire-button" value="quick-enquiry">Enquire about our <? the_title(); ?></a>
          </div>
          <button class="lower-info point-five-trans clickable"><span class="icon-arrow-right point-five-trans"></span></button>
        </div>
      </div>
    </section>
    <section class="main-content" style="background-color: white;">
      <div class="width-contain">
        <div class="intro">
          <?php if ($moreInfoHeader) : ?>
            <h2><?php echo $moreInfoHeader; ?></h2>
          <?php endif; ?>
          <?= do_shortcode(wpautop(get_the_content())); ?>
        </div>


      </div>
    </section>
    <? include(locate_template('/partials/christmas-next.php')); ?>
    <? include(locate_template('/partials/cta.php')); ?>
  </div>

  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>