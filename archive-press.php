<?

/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */

get_header(); ?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <header class="row-padding small-header">
    <div class="width-contain text-center">
      <h1 class="entry-title">Press</h1>
    </div>
  </header>

  <? if (function_exists('breadcrumbs')) {
    breadcrumbs();
  } ?>

  <section class="parent-contain entry-content light-branding-bg" id="scrollto-entry-content">
    <div class="width-contain masonry-grid gallery">
      <?
      $query = new WP_Query(
        array(
          'post_type' => 'press',
          'posts_per_page' => -1,
          'fields' => 'ids'
        )
      );
      $image_query = new WP_Query(
        array(
          'post_type' => 'attachment',
          'post_status' => 'inherit',
          'post_mime_type' => 'image',
          'posts_per_page' => -1,
          'post_parent__in' => $query->posts,
          'order' => 'DESC'
        )
      );

      if ($image_query->have_posts()) : ?>
        <? while ($image_query->have_posts()) : ?>
          <?
          $image_query->the_post();
          $attachmentID = get_the_ID();
          $imgurl = wp_get_attachment_url();

          $parent = get_post_ancestors($attachmentID);
          $parentID = $parent[0];
          $parentTitle = get_the_title($parentID);
          $publishDate = rwmb_meta('publish-date', $args = array('type=text'), $parentID);
          ?>
          <a class="lightbox-link masonry-item" href="<?= $imgurl; ?>" caption="<?= $parentTitle; ?>">
            <img class="portfolio point-four-trans" src="<?= $imgurl; ?>">
            <div class="overlay-information">
              <h3><?= $parentTitle; ?></h3>
              <? if (!empty($publishDate)) {
                echo '<h5>' . $publishDate . '</h5>';
              } ?>
            </div>
          </a>

      <? endwhile;
      endif; ?>
    </div>
  </section>
  <? include(locate_template('/partials/cta.php')); ?>
  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>