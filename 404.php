<?

/**
 * The template for displaying 404 pages.
 *
 *
 * @package digicrab
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main, point-five-trans'); ?> role="main">


  <div class="entry-content scrollto-padding" id="scrollto-entry-content">
    <section class="entry-content four-zero-four-content">
      <div class="width-contain">
        <div class="half">
          <h1 class="entry-title1">It looks like the party has moved on...</h1>
          <p>Sorry, we can't find what you are looking for!</p>
          <p>We might have moved the page or taken it down. You can either go back to the <a href="/">homepage</a>, or use our navigation to see if you can find what you are looking for. If you still can't find what you are looking for, email Katherine at <a href="mailto:katherine@arabiantents.com">katherine@arabiantents.com</a>.</p>
        </div>
        <div class="half">
          <img src="/wp-content/themes/arabiantents/images/party-over.png">
        </div>
      </div>
    </section>
    <? if (function_exists('yoast_breadcrumb')) {
      yoast_breadcrumb('<div class="breadcrumbs fill"><div class="width-contain">', '</div></div>');
    }
    ?>

  </div>




  <footer class="entry-footer">
    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
  </footer>
</main>
<? get_footer(); ?>