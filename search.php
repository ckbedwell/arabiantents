<?

/**
 * The template for displaying search results pages.
 *
 * @package digicrab
 */

get_header(); ?>

<section id="primary" class="content-area">
  <main id="main" class="site-main" role="main">

    <? if (have_posts()) : ?>

      <header class="page-header">
        <h1 class="page-title"><? printf(__('Search Results for: %s', 'digicrab'), '<span>' . get_search_query() . '</span>'); ?></h1>
      </header><!-- .page-header -->

      <? /* Start the Loop */ ?>
      <? while (have_posts()) : the_post(); ?>

        <?
        /**
         * Run the loop for the search to output the results.
         * If you want to overload this in a child theme then include a file
         * called content-search.php and that will be used instead.
         */
        get_template_part('excerpt');
        ?>

      <? endwhile; ?>

      <? the_posts_navigation(); ?>

    <? else : ?>

      <? get_template_part('content', 'none'); ?>

    <? endif; ?>

  </main><!-- #main -->
</section><!-- #primary -->

<? get_sidebar(); ?>
<? get_footer(); ?>