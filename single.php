<?
/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */

get_header(); ?>

	<main id="post-<? the_ID(); ?>" <? post_class('site-main, point-five-trans'); ?> role="main">
        <article>
            <? get_template_part('featured-image'); ?>

            <? if(!in_category('external-blogs')) : ?>
                <div class="entry-content scrollto-padding" id="scrollto-entry-content">
                    <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

                    <section class="row-padding ">
                        <div class="width-contain">
                            <div class="width-contain-700">
                                <?= do_shortcode(wpautop(get_the_content())); ?>
                                <div class="row-padding-small text-center">
                                    <h3>Share this article</h3>
                                    <? get_template_part('partials/share-buttons'); ?>
                                </div>
                            </div>
                        </div>
                    </section>

                    <? get_template_part('partials/what-next'); ?>

                </div>
                <? include(locate_template('/partials/cta.php')); ?>
                <footer class="parent-contain entry-footer">
                    <? get_template_part('partials/about-the-author'); ?>
                    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
                </footer>
            <? endif; ?>
        </article>

    </main>
<? get_footer(); ?>
