<?

/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package digicrab
 */

// Template Name: Shortlist Page

get_header(); ?>
<?php $shortlist = get_user_favorites_list($user_id = null, $site_id = null, $include_links = true, $filters = null, $include_button = true, $include_thumbnails = true, $thumbnail_size = 'thumbnail', $include_excerpt = true);
$shortListLink = get_user_favorites_list($user_id = null, $site_id = null, $include_links = true, $filters = null, $include_button = false, $include_thumbnails = false, $include_excerpt = false);
$favoritesIDS = get_user_favorites($user_id = null);

$linksToSend = '';
$regexp = "<a\s[^>]*href=(\"??)([^\" >]*?)\\1[^>]*>(.*)<\/a>";
$count = 0;
if (preg_match_all("/$regexp/siU", $shortListLink, $matches, PREG_SET_ORDER)) {
  foreach ($matches as $match) {
    if ($count % 2 == 0) {
      $linksToSend .= $match[2] . " \n\n";
    }
    $count++;
  }
}

$_SESSION['shortlistEmail'] = $linksToSend;

?>
<div style="display: none;">
  <pre>
        <?php print_r($favoritesIDS); ?>
    </pre>
</div>
<style>
  div.wpcf7-validation-errors,
  div.wpcf7-acceptance-missing,
  div.wpcf7-mail-sent-ok {
    border-color: #f1ece0 !important;
    text-align: center !important;
    font-style: italic;
  }

  .text-center {
    text-align: center !important;
  }

  .align-center {
    display: block !important;
    margin: 10px auto !important;
  }

  span.wpcf7-not-valid-tip {
    font-size: 15px !important;
    text-align: center !important;
  }
</style>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

  <? include(locate_template('featured-image.php')); ?>

  <div class="entry-content scrollto-padding" id="scrollto-entry-content">
    <? if (function_exists('breadcrumbs')) {
      breadcrumbs();
    } ?>

    <section class="entry-content">
      <div class="width-contain intro">

        <?= do_shortcode(wpautop(get_the_content())); ?>
        <? php // echo $shortlist; 
        ?>



        <?php
        $query = new WP_Query(array(
          'post_type' => array('venue', 'tent'),
          'post__in' => $favoritesIDS,
        ));
        ?>
        <? while ($query->have_posts()) : $query->the_post(); ?>
          <?
          $featuredImage = get_the_featured_image($post->ID);
          $count = $query->post_count;
          $size = sized_by_count($count, 'half', 'third', true);
          ?>
          <div class="<?= $size; ?> larger-cards" id="post-<? the_ID(); ?>">
            <a class="full image-link wrapper" href="<? the_permalink(); ?>">
              <div class="display-card featured-image" data-bg="<?= $featuredImage['full_url']; ?>"></div>
              <noscript>
                <div class="display-card featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></div>
              </noscript>

              <div class="overlay-information">
                <h3><? the_title(); ?></h3>
              </div>
            </a>
            <div class="fill fill-padding">
              <?php
              $capacity = get_field('capacity', $postID);
              $licensed_for_marriage = get_field('licensed_for_marriage', $postID);
              $catering = get_field('catering', $postID);
              $bar = get_field('bar', $postID);
              $pets_welcome = get_field('pets_welcome', $postID);
              $exclusivity = get_field('exclusivity', $postID);
              $accommodation = get_field('accommodation_', $postID);
              ?>
              <?php if (rwmb_meta('max-capacity')) : ?>
                <h4> Capacity: <strong><?= rwmb_meta('max-capacity', $args = array('type=number')); ?></strong> </h4>
              <?php endif; ?>
              <?php if (rwmb_meta('min-size')) : ?>
                <h4> Min. Space Required: <strong><?= rwmb_meta('min-size', $args = array('type=text')); ?></strong> </h4>
              <?php endif; ?>
              <?php if (rwmb_meta('build-time')) : ?>
                <h4> Build Time: <strong><?= rwmb_meta('build-time', $args = array('type=text')); ?></strong> </h4>
              <?php endif; ?>
              <?php if ($capacity) : ?>
                <h4> Capacity: <strong><?php echo $capacity; ?></strong> </h4>
              <?php endif; ?>
              <?php if ($licensed_for_marriage) : ?>
                <h4> Licensed for Marriage: <strong><?php echo $licensed_for_marriage; ?></strong> </h4>
              <?php endif; ?>
              <?php if ($catering) : ?>
                <h4> Catering: <strong><?php echo $catering; ?></strong> </h4>
              <?php endif; ?>
              <?php if ($bar) : ?>
                <h4> Bar: <strong><?php echo $bar; ?></strong> </h4>
              <?php endif; ?>
              <?php if ($pets_welcome) : ?>
                <h4> Pets Welcome: <strong><?php echo $pets_welcome; ?></strong> </h4>
              <?php endif; ?>
              <?php if ($exclusivity) : ?>
                <h4> Exclusivity: <strong><?php echo $exclusivity; ?></strong> </h4>
              <?php endif; ?>
              <?php if ($accommodation) : ?>
                <h4> Accommodation: <strong><?php echo $accommodation; ?></strong> </h4>
              <?php endif; ?>
            </div>
          </div>

        <?php endwhile; ?>
        <div style="clear: both;"></div>
        <h2 style="text-align: center;">Email Shortlist</h2>
        <?php echo do_shortcode('[contact-form-7 id="7454" title=Shortlist" ]');
        ?>
      </div>
    </section>
  </div>




  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
  <? include(locate_template('/partials/cta.php')); ?>
</main>
<? get_footer(); ?>