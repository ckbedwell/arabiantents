<?
/**
 *
 * Template Name: Your Event Page
 */
?>
<? get_header(); ?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
    <? get_template_part('featured-image'); ?>

    <div class="entry-content scrollto-padding" id="scrollto-entry-content">
        <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

        <section class="quick-navigation">
            <div class="width-contain">
                <h2 class="text-center">What kind of event are you having?</h2>
                <div class="row-padding-extra-small">
                    <?= inc('/partials/events/_grid_item.php', ['args' => [
                            'post_type' => 'page',
                            'order' => 'ASC',
                            'tax_query' => [
                                [
                                    'taxonomy' => 'page-type',
                                    'field' => 'slug',
                                    'terms' => 'service-page',
                                ]
                            ]
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

        <section class="quick-navigation">
            <div class="width-contain">
                <h2 class="text-center">Our additional event management services</h2>
                <div class="row-padding-extra-small">
                    <?= inc('/partials/events/_grid_item.php', ['args' => [
                            'post_type' => 'page',
                            'tax_query' => [
                                [
                                    'taxonomy' => 'page-type',
                                    'field' => 'slug',
                                    'terms' => 'additional-service',
                                ]
                            ]
                        ]
                    ]); ?>
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
