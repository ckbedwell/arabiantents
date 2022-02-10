<?

/**
 *
 * Template Name: Christmas costs page
 */

get_header();

$moreInfoHeader = get_field('more_info_header');

?>
<style>
  .example-job {
    margin-bottom: 6rem;
  }

  .site-main .enquire-button,
  .call-to-action .color-button {
    background-color: rgb(11, 187, 11);
    border-color: rgb(11, 187, 11);
    border-bottom-color: green;
  }

  aside.alignright {
    float: none;
    width: 100%;
    padding: 0;
    margin: 4rem 0;
  }

  @media screen and (max-width: 960px) {
    .example-job [class*="half"] {
      width: 100%;
      margin-left: 0;
      margin-right: 0;
    }
  }
</style>
<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

  <? get_template_part('featured-image'); ?>

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
    <section>
      <div class="width-contain">
        <? if (have_rows('example_jobs')) : ?>
          <? while (have_rows('example_jobs')) : the_row();
            $images = get_sub_field('images');
            $title = get_sub_field('title');
            $description = get_sub_field('description');
          ?>
            <div class="parent-contain example-job">
              <div class="half-margined no-padding">
                <?php if ($title) : ?>
                  <h2><?php echo $title; ?></h2>
                <?php endif; ?>
                <?php if ($description) : ?>
                  <div class="intro">
                    <?php echo do_shortcode(wpautop($description)); ?>
                  </div>
                <?php endif; ?>
              </div>
              <div class="gallery half-margined no-padding tiered-gallery">
                <?
                foreach ($images as $image) {
                  $url = $image['url'];
                  $caption = $image['caption'];
                  echo '<a class="lightbox-link image-link" href="' . $url . '" caption="' . $caption . '">
                                            <div class="display-card-small featured-image point-five-trans" data-bg="' . $url . '"></div>
                                            <noscript><div class="display-card-small featured-image point-five-trans" style="background-image: url(' . $url . ');"></div></noscript>
                                            <button class="pinterest-btn" onclick="window.open(\'//pinterest.com/pin/create/link/?url=http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] . '&media=' . $url . '&description=' . $caption . '\',\'_blank\',\'resizable=yes\'); event.stopPropagation(); event.preventDefault();">Save</button>

                                        </a>';
                }
                ?>
              </div>
            </div>
          <? endwhile; ?>
        <?php endif; ?>
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