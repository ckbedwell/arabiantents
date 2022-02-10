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

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

  <? include(locate_template('featured-image.php')); ?>

  <div class="entry-content dfs scrollto-padding barbara" id="scrollto-entry-content">
    <? if (function_exists('breadcrumbs')) {
      breadcrumbs();
    } ?>

    <section class="entry-content">
      <div class="width-contain">
        <div class="width-contain-700 intro">
          <?= do_shortcode(wpautop(get_the_content())); ?>
        </div>
      </div>
    </section>
  </div>




  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
  <? include(locate_template('/partials/cta.php')); ?>
</main>
<? get_footer(); ?>