<?

/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */
$featuredImage = get_the_featured_image($post->ID);

$contactNumber = get_field("contact_number");
$email = get_field("email_address");
$website = get_field("website_address");
$address = get_field("caterers_address");
$sampleMenu = get_field("sample_menu");
$averagePrice = get_field("average_price_per_head");
$glassHire = get_field("glass_and_or_plate_hire");
$staff = get_field("can_supply_staff");
$specialities = get_field("specialities");

$images = get_field("gallery");

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <article>
    <? include(locate_template('featured-image.php')); ?>

    <div class="scrollto-padding" id="scrollto-entry-content">
      <? if (function_exists('breadcrumbs')) {
        breadcrumbs();
      } ?>

      <section>
        <div class="width-contain">
          <div class="half intro">
            <h2>About <? the_title(); ?></h2>
            <div class="clearleft full additional-information">
              <?
              if ($address) : ?>
                <div class="full padded clearleft">
                  <div class="sixth no-padding-left">
                    <span class="icon-location"></span>
                  </div>

                  <div class="five-sixths">
                    <?= $address; ?>
                  </div>
                </div>
              <? endif; ?>
              <div class="clearleft full">
                <?
                if (have_rows('sample_menu')) : ?>
                  <div class="half">
                    <div class="sixth no-padding-left">
                      <span class="icon-file-download"></span>
                    </div>

                    <div class="five-sixths">
                      <? while (have_rows('sample_menu')) : the_row(); ?>
                        <a href="<?= the_sub_field('link_to_pdf'); ?>" target="_blank" class="clearleft"><?= the_sub_field('download_title'); ?></a>
                      <? endwhile; ?>
                    </div>
                  </div>
                <? endif;

                if ($averagePrice) : ?>
                  <div class="half">
                    <div class="sixth no-padding-left">
                      <span class="icon-coin-pound"></span>
                    </div>

                    <div class="five-sixths">
                      Average price £<?= $averagePrice; ?>
                    </div>
                  </div>
                <? endif;

                if ($glassHire) : ?>
                  <div class="half">
                    <div class="sixth no-padding-left">
                      <span class="icon-glass"></span>
                    </div>

                    <div class="five-sixths">
                      This caterer can supply glass hire.
                    </div>
                  </div>
                <? endif;

                if ($staff) : ?>
                  <div class="half">
                    <div class="sixth no-padding-left">
                      <span class="icon-man-woman"></span>
                    </div>

                    <div class="five-sixths">
                      This caterer can supply staff.
                    </div>
                  </div>
                <? endif;

                if (have_rows("specialities")) : ?>
                  <div class="alignleft full padded">
                    <h4>Specialities</h4>
                    <ul>
                      <?
                      while (have_rows("specialities")) : the_row();
                        echo "<li>" . get_sub_field("dish_name") . "</li>";
                      endwhile;
                      ?>
                    </ul>
                  </div>
                <? endif; ?>
              </div>
            </div>
            <div class="alignleft full">
              <?= do_shortcode(wpautop(get_the_content())); ?>
            </div>
          </div>

          <? if (!empty($images)) : ?>
            <div class="gallery half tiered-gallery">
              <h3><? the_title(); ?>'s Gallery</h3>
              <?
              foreach ($images as $image) {
                echo '<a class="lightbox-link" href="' . $image["url"] . '" caption="' . $image["caption"] . '">
                                        <div class="display-card-small featured-image point-five-trans" data-bg="' . $image["url"] . '"></div>
                                        <noscript>
                                             <div class="display-card-small featured-image point-five-trans" style="background-image: url(' . $image["url"] . ');"></div>
                                        </noscript>
                                        </a>';
              }
              ?>

            </div>
          <? endif; ?>
        </div>
      </section>
    </div>

    <? include(locate_template('/partials/cta.php')); ?>

    <footer class="entry-footer">
      <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
    </footer>
    <style>
      .additional-information [class*="icon-"] {
        display: block;
        font-size: 3rem;
      }

      .entry-header a {
        color: white;
      }
    </style>
  </article>
</main>

<style>
  .about-the-author .vertical-align {
    position: static;
    -webkit-transform: translate(0, 0);
    transform: translate(0, 0);
  }
</style>
<? get_footer(); ?>