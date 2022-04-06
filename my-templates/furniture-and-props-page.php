<?

/**
 *
 * Template Name: Furniture and Props Page
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

  <? get_template_part('featured-image'); ?>

  <div class="scrollto-padding" id="scrollto-entry-content">
    <section class="no-padding info">
      <? if (function_exists('breadcrumbs')) {
        breadcrumbs();
      } ?>

    </section>
    <section class="entry-content quick-navigation">
      <div class="width-contain">
        <h2 class="text-center">What kind of furniture do you want to see?</h2>
        <a class="third-margined no-padding image-link" href="/furniture-decoration/indoor-furniture">
          <img src="/wp-content/uploads/2016/01/indoor-large.jpg">
          <noscript>
            <img src="/wp-content/uploads/2016/01/indoor-large.jpg">
          </noscript>
          <div class="overlay-information">
            <div class="wrapper">
              <h3>Indoor Furniture</h3>
            </div>
          </div>
        </a>

        <a class="third-margined no-padding image-link" href="/furniture-decoration/outdoor-furniture">
          <img src="/wp-content/uploads/2016/01/outdoor-large.jpg">
          <noscript>
            <img src="/wp-content/uploads/2016/01/outdoor-large.jpg">
          </noscript>
          <div class="overlay-information">
            <div class="wrapper">
              <h3>Outdoor Furniture</h3>
            </div>
          </div>
        </a>

        <a class="third-margined no-padding image-link" href="/furniture-decoration/props-decor">
          <img src="/wp-content/uploads/2016/01/props-large.jpg">
          <noscript>
            <img src="/wp-content/uploads/2016/01/props-large.jpg">
          </noscript>
          <div class="overlay-information">
            <div class="wrapper">
              <h3>Props and Decor</h3>
            </div>
          </div>
        </a>

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