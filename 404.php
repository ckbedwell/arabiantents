<?

/**
 * The template for displaying 404 pages.
 *
 *
 * @package digicrab
 */

get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
  <section class="width-contain-700 sectioned">
    <h1 class="page-title">It looks like the party has moved on...</h1>
    <p>Sorry, we can't find what you are looking for!</p>
    <p>We might have moved the page or taken it down. You can either go back to the <a href="/">homepage</a>, or use our navigation to see if you can find what you are looking for. If you still can't find what you are looking for, email Katherine at <a href="mailto:katherine@arabiantents.com">katherine@arabiantents.com</a>.</p>

    <img src="/wp-content/themes/arabiantents/images/party-over.png">
  </section>
</main>
<? get_footer(); ?>