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
            <header class="small-header ">
                <div class="width-contain">
                    <h1 class="entry-title text-center">Layouts</h1>
                </div>
            </header>

            <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

            <section class="parent-contain" id="scrollto-entry-content">
                <div class="width-contain center-items text-center">
                    <? while (have_posts()) : the_post(); ?>
                        <div class="quarter">
                            <?
                                $featuredImage = get_the_featured_image($post->ID);
                            ?>
                            <a class="full" href="<? the_permalink(); ?>">
                                <img class="full" data-src="<?= $featuredImage['full_url']; ?>">
                                <noscript>
                                    <img class="full" src="<?= $featuredImage['full_url']; ?>">
                                </noscript>
                            </a>
                            <h2><? the_title(); ?></h2>

                        </div>
                    <? endwhile; ?>
                </div>
            </section>

            <? include(locate_template('/partials/cta.php')); ?>
            <footer class="entry-footer">
                <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
            </footer>
        </main>
<? get_footer(); ?>
