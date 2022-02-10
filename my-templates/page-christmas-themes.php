<?

/**
 *
 * Template Name: Christmas Themes Page
 */

get_header();

$moreInfoHeader = get_field('more_info_header')
?>
<style>
  aside.alignright {
    float: none;
    width: 100%;
    padding: 0;
    margin: 4rem 0;
  }

  .site-main .enquire-button,
  .call-to-action .color-button {
    background-color: rgb(11, 187, 11);
    border-color: rgb(11, 187, 11);
    border-bottom-color: green;
  }
</style>
<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

  <? include(locate_template('featured-image.php')); ?>

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
    </section>
    <?php
    $tent_tags = get_field("similar_ideas");
    $count = count($tent_tags);
    // $size = sized_by_count($count);
    $size = 'half';
    if ($tent_tags) : ?>
      <section class="previous-customers row-padding-small">
        <div class="width-contain">
          <div class="used-for text-center">
            <div class="full row-padding-extra-small center-items">
              <?
              foreach ($tent_tags as $tag) {

                $tagURL = get_term_link($tag);
                $taxonomy = "post_tag";
                $image = get_field('term_image', $taxonomy . '_' . $tag); //USE UNIVERSAL IMAGE

                echo '<div class="' . $size . ' larger-cards"><a href="' . $tagURL . '"class="full image-link">
                                                    <div class="featured-image display-card" data-bg="' . $image . '"></div>
                                                    <noscript><div class="featured-image display-card" style="background-image:url(' . $image . ');"></div></noscript>
                                                    <div class="overlay-information"><h3>' . get_term($tag)->name . '</h3></div>
                                                </a></div>';
              }
              ?>
            </div>
          </div>
        </div>
      </section>
    <? endif; ?>
    <section class="entry-content">
      <div class="width-contain">
        <div class="width-contain-750 intro">
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