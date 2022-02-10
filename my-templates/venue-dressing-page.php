<?

/**
 *
 * Template Name: Venue Dressing Page
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

  <? get_template_part('featured-image'); ?>

  <div class="entry-content scrollto-padding" id="scrollto-entry-content">
    <? if (function_exists('breadcrumbs')) {
      breadcrumbs();
    } ?>

    <section class="quick-navigation">
      <div class="width-contain">
        <h2 class="text-center">In this section you will also find:</h2>
        <?
        $args = array(
          'post_type' => 'venue-dressing',
          'order' => 'ASC'
        );

        $recentPosts = new WP_Query($args);
        while ($recentPosts->have_posts()) : $recentPosts->the_post();
          $postID = get_the_ID();
          $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
          $featuredImage = wp_get_attachment_image_src($imgID, 'full'); //get the url of the featured image (returns an array)
          $imgURL = $featuredImage[0]; //get the url of the image out of the array
        ?>

          <a class="full quarter-margined no-padding image-link" href="<? the_permalink(); ?>">
            <div class="display-card featured-image" data-bg="<?= $imgURL; ?>"></div>
            <noscript>
              <div class="display-card featured-image" style="background-image:url(<?= $imgURL; ?>);"></div>
            </noscript>
            <div class="overlay-information">
              <div class="wrapper">
                <h3><? the_title(); ?></h3>
              </div>
            </div>
          </a>
        <? endwhile;
        wp_reset_query(); ?>

      </div>
    </section>
    <section class="entry-content">
      <div class="width-contain">
        <div class="width-contain-700 intro">
          <?= do_shortcode(wpautop(get_the_content())); ?>
        </div>
      </div>
    </section>

    <? include(locate_template('/partials/cta.php')); ?>
  </div>



  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>