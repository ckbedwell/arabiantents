<?
/**
 *
 * Template Name: Eco Overview
 */
?>
<? get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
    <? get_template_part('featured-image'); ?>

    <div class="entry-content scrollto-padding" id="scrollto-entry-content">
        <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

        <section class="quick-navigation">
            <div class="width-contain">
                <h2 class="text-center">In this section:</h2>
                <div class="row-padding-extra-small">
                    <?= inc('/partials/events/_grid_item.php', ['args' => [
                            'post_type' => 'page',
                            'order' => 'ASC',
                            'posts_per_page' => -1,
                            'post_parent'    => $post->ID
                        ]
                    ]); ?>
                </div>
            </div>
        </section>

        <section class="entry-content">
            <div class="width-contain">
                <div class="width-contain-700 intro">
                    <?= do_shortcode(wpautop(get_the_content())); ?>
                </div>
            </div>
        </section>

        <?= inc('/partials/cta.php'); ?>
    </div>

    <footer class="entry-footer">
        <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
    </footer>
</main>

<? get_footer(); ?>
