<?
/*
 * Template Name: Resources Page
 * Description: Resources page
 */

get_header(); ?>


<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <? include(locate_template('featured-image.php')); ?>

  <div class="entry-content scrollto-padding" id="scrollto-entry-content">
    <? if (function_exists('breadcrumbs')) {
      breadcrumbs();
    } ?>

    <section class="entry-content quick-navigation">
      <div class="width-contain text-center">
        <? if (get_field("resources_to_upload")) : ?>

          <? while (have_rows("resources_to_upload")) : the_row(); ?>
            <div class="third-margined no-padding">
              <h4 class=""><? the_sub_field("resource_title"); ?></h4>
              <a href="<? the_sub_field("link"); ?>" target="_blank" class="height-matcher full image-link download-link material-card" style="display: flex; align-items: center;">
                <img src="<? the_sub_field("resource_cover_image"); ?>">
                <noscript>
                  <img src="<? the_sub_field("resource_cover_image"); ?>">
                </noscript>
              </a>
            </div>
          <? endwhile; ?>

        <? endif; ?>
      </div>
    </section>
  </div>
  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
  <? include(locate_template('/partials/cta.php')); ?>
</main>
<? get_footer(); ?>