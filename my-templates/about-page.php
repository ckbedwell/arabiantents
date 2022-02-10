<?

/**
 *
 * Template Name: About Page
 */
?>
<? get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <? get_template_part('featured-image'); ?>

  <div class="entry-content scrollto-padding" id="scrollto-entry-content">
    <? if (function_exists('breadcrumbs')) {
      breadcrumbs();
    } ?>

    <section class="quick-navigation">
      <div class="width-contain">
        <h2 class="text-center">In this section you will also find:</h2>
        <a class="third-margined no-padding image-link" href="testimonials">
          <img data-src="/wp-content/uploads/2016/01/testimonials.jpg">
          <noscript>
            <img src="/wp-content/uploads/2016/01/testimonials.jpg">
          </noscript>
          <div class="overlay-information">
            <div class="wrapper">
              <h3>Testimonials</h3>
            </div>
          </div>
        </a>

        <a class="third-margined no-padding image-link" href="team">
          <img data-src="/wp-content/uploads/2016/01/team.jpg">
          <noscript>
            <img src="/wp-content/uploads/2016/01/team.jpg">
          </noscript>
          <div class="overlay-information">
            <div class="wrapper">
              <h3>Team</h3>
            </div>
          </div>
        </a>

        <a class="third-margined no-padding image-link" href="press">
          <img data-src="/wp-content/uploads/2016/01/press.jpg">
          <noscript>
            <img src="/wp-content/uploads/2016/01/press.jpg">
          </noscript>
          <div class="overlay-information">
            <div class="wrapper">
              <h3>Press</h3>
            </div>
          </div>
        </a>
      </div>
    </section>
    <section class="entry-content">
      <div class="width-contain">
        <!--<div class="width-contain-700 intro">   -->
        <div class="width-contain intro">
          <?= do_shortcode(wpautop(get_the_content())); ?>
        </div>
      </div>
    </section>

    <section>
      <div class="width-contain" style="display: block;">
        <div class="full no-padding additional-info">
          <div class="sub-menu-full">
            <h3 class="text-center">OUR CLIENTS</h3>
            <div class="point-three-trans text-center owl-carousel owl-partners">
              <?php if (have_rows('client_logos')) : ?>
                <?php while (have_rows('client_logos')) : the_row(); ?>
                  <?php $image = get_sub_field('logo'); ?>
                  <img src="<?php echo $image['sizes']['client-sizes']; ?>">
              <?php endwhile;
              endif; ?>

            </div>
          </div>
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