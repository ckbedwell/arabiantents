<?

/**
 *
 * Template Name: Event Sub-Page
 */

$featuredImage = get_the_featured_image($post->ID);

get_header();

$CTAimages = rwmb_meta('cta-image');
$desc =  get_post_meta($post->ID, 'singular-desc', true);
$stickyCTA = get_post_meta($post->ID, 'sticky-cta-text', true);
$videos = rwmb_meta('videos');

if (!$stickyCTA) {
  $stickyCTA = "Let's plan your perfect " . $desc . "!";
}
?>
<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <? get_template_part('featured-image2'); ?>

  <div class="wrapper entry-content drop-off" id="scrollto-entry-content">
    <section class="scrollto-padding info">
      <? if (function_exists('breadcrumbs')) {
        breadcrumbs();
      } ?>

      <div class="height-filler hide"></div>
      <div class="full sticky-info">
        <div class="width-contain row-padding-extra-small">
          <div class="two-thirds">
            <span class="icon-clipboard big-icon no-padding alignleft"></span>
            <div class="five-sixths no-padding">
              <h2><?= $stickyCTA; ?></h2>
              <p>Tell us a bit about your <?= $desc; ?> and we can get back to you within 24 hours with a quote. </p>
            </div>
          </div>
          <div class="alignright third">
            <a href="/contact" class="vertical-align horizontal-align no-margin enquire-button more-info" value="enquiry-form">Tell us about your event</a>
          </div>
          <button class="lower-info point-five-trans clickable"><span class="icon-arrow-right point-five-trans"></span></button>
        </div>
      </div>
    </section>

    <section class="row-padding">
      <div class="width-contain">
        <div class="intro">
          <h2><?= rwmb_meta('more-info-h2', $args = array('type=text')); ?></h2>
          <?= do_shortcode(wpautop(get_the_content())); ?>
          <?
          $images = rwmb_meta('photos', 'type=image');
          if (!empty($images)) :
          ?>
            <div class="row-padding gallery">
              <div class="added-gallery">
                <?php
                foreach ($images as $image) {
                  echo '<a href="' . $image["full_url"] . '" class="lightbox-link image-link" caption="' . $image["caption"] . '">
                                            <div class="display-card-small featured-image point-five-trans" data-bg="' . $image["full_url"] . '"></div>
                                            <noscript>
                                                <div class="display-card-small featured-image point-five-trans" style="background-image: url(' . $image["full_url"] . ');"></div>
                                            </noscript>
                                            <button class="pinterest-btn" onclick="window.open(\'//pinterest.com/pin/create/link/?url=http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] . '&media=' . $image['full_url'] . '&description=' . $image["caption"] . '\',\'_blank\',\'resizable=yes\'); event.stopPropagation(); event.preventDefault();">Save</button>
                                            </a>';
                }
                ?>
              </div>
            </div>
          <? endif; ?>
          <? $specificTestimonial = rwmb_meta('specific-testimonial');
          if (!empty($specificTestimonial)) {
            get_template_part('partials/specific-testimonial');
          } ?>
        </div>

        <? if ($videos) : ?>
          <div class="row-padding videos">
            <?php foreach ($videos as $video) : ?>
              <div class="half-margined">
                <div class="responsive-video">
                  <iframe src="<?= $video; ?>" allowfullscreen></iframe>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
        <?php endif; ?>

        <? if (have_rows('partners_gallery')) : ?>

          <div class="gallery row-padding-small">
            <h3><?= ucfirst($desc); ?> Partners</h3>
            <?
            while (have_rows("partners_gallery")) : the_row();
              $partnerURL = get_sub_field('partner_link');
              $image = get_sub_field('partner_image');
              echo '<a href="' . $partnerURL . '" target="_blank" class="eighter-margined no-padding image-link">
                                            <img data-src="' . $image . '">
                                            <noscript>
                                                <img src="' . $image . '">
                                            </noscript>
                                            </a>';
            endwhile;
            ?>
          </div>
        <? endif; ?>
      </div>
    </section>

    <?
    $ideas = wp_get_post_tags(get_the_ID());
    if ($ideas) :
    ?>
      <section class="row-padding text-center">
        <div class="width-contain">
          <h2>Are you having a special kind of <?= $desc; ?>?</h2>
          <div class="full center-items">
            <?
            $count = count($ideas);
            $size = sized_by_count($count);
            foreach ($ideas as $idea) : ?>
              <div class="<?= $size; ?>-margined no-padding">
                <a href="<?= get_term_link($idea); ?>" class="full image-link" title="<?= get_term($idea)->name; ?>" alt="<?= get_term($idea)->name; ?>">
                  <div class="display-card featured-image" data-bg="<?= get_field('term_image', 'post_tag' . '_' . get_term($idea)->term_id); ?>"></div>
                </a>
                <h3 class="small-h3 no-margin"><?= get_term($idea)->name; ?></h3>
              </div>
            <? endforeach; ?>
          </div>
        </div>
      </section>
    <? endif; ?>

    <?
    $title = get_post_meta($post->ID, 'event-management-h2', true);
    $content = get_post_meta($post->ID, 'event-management-content', true);
    $eventManagers = get_post_meta($post->ID, 'event-managers', false);
    $count = count($eventManagers);
    $size = sized_by_count($count, 'half', 'quarter', false);

    $services = get_post_meta($post->ID, 'additional-services', false);
    if ($services || $eventManagers || $content) :
    ?>


      <section class="row-padding">
        <div class="width-contain">
          <div class="half intro">
            <h2><?= $title; ?></h2>
            <?= $content; ?>
          </div>


          <div class="half text-center">
            <? if ($eventManagers) : ?>
              <!---
                            <div class="center-items ">
                                <h3>Event Managers</h3>
                                <? foreach ($eventManagers as $ID) : ?>
                                <div class="<?= $size; ?>">
                                    <a href="<?= get_author_posts_url($ID); ?>" class="image-link material-card rounded" alt="See <? the_author_meta('display_name', $ID); ?>'s profile" title="See <? the_author_meta('display_name', $ID); ?>'s profile'">
                                        <? author_image($ID); ?>
                                    </a>
                                    <h4><? the_author_meta('display_name', $ID); ?></h4>
                                </div>
                                <? endforeach; ?>
                            </div>
                        --->
            <? endif; ?>

            <?
            $count = count($services);
            $size = sized_by_count($count, 'half', 'third', false);
            if ($services) :
            ?>
              <div class="<? if ($count < 2) {
                            echo 'center-items';
                          } ?>">
                <h3>Services</h3>
                <?
                foreach ($services as $service) :
                  $featuredImage = get_the_featured_image($service);
                ?>
                  <a href="<? the_permalink($service); ?>" class="<?= $size; ?>-margined full no-padding image-link" alt="Read about our <?= get_the_title($service); ?> service" title="Read about our <?= get_the_title($service); ?> service">
                    <div class="display-card featured-image" data-bg="<?= $featuredImage['full_url']; ?>"></div>
                    <noscript>
                      <div class="display-card featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></div>
                    </noscript>
                    <div class="overlay-information">
                      <h3><?= get_the_title($service); ?></h3>
                    </div>
                  </a>
                <? endforeach; ?>
              </div>
            <? endif; ?>
          </div>
        </div>
      </section>
    <? endif; ?>
  </div>
  <? include(locate_template('/partials/cta.php')); ?>


  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
  <style>
    .entry-content .row-padding.gallery {
      border: none;
    }

    .added-gallery a {
      width: 25%;
    }

    .videos {
      display: flex;
      justify-content: center;
    }

    @media screen and (max-width: 1085px) {
      .added-gallery a {
        width: 50%;
      }

      .videos {
        display: block;
      }

      .videos .half-margined {
        margin: 0;
        width: 100%;
      }
    }
  </style>
</main>
<? get_footer(); ?>