<?
/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */

get_header(); ?>

	<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
        <article>
            <header class="row-padding small-header">
                <div class="width-contain">
                    <h1 class="entry-title"><? the_title(); ?>'s testimonial</h1>
                </div>
            </header>

            <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

            <section class="entry-content">
                <div class="width-contain">
                    <div class="width-contain-700 alignleft testimonial-entry">
                        <?= do_shortcode(wpautop(get_the_content())); ?>
                    </div>
                </div>
            </section>
            <? include(locate_template('/partials/cta.php')); ?>

            <footer class="entry-footer">
                <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
	       </footer>
        </article>
    </main>
<? get_footer(); ?>
