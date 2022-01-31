<?
/**
 * Template Name: Tents Overview Page
 */

get_header(); ?>
		<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
            <? get_template_part('featured-image'); ?>

            <section class="parent-contain scrollto-padding" id="scrollto-entry-content">
            <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

            </section>
            <div class="entry-content">
                    <?
                        $terms = get_terms('tent_type', array(
                            'hide_empty' => 0,
                            //'orderby' => 'count', BEING ORDERED BY CUSTOM TAXONOMY ORDER NE PLUGIN

                           ));

                        foreach($terms as $term) {
                            $args = array(
                                'post_type' => 'tent',
                                'tent_type' => $term->slug
                           );
                            $query = new WP_Query($args);
                            if (have_posts())  : ?>
                            <div class="parent-contain row-padding tent-archive">
                                <div class="width-contain">
                                    <div class="width-contain text-center">
                                        <a class="branding-color" href="<?= get_term_link($term->term_id); ?>"><h2><?= $term->name; ?></h2></a>
                                        <?= wpautop($term->description); ?>
                                    </div>
                                    <div class="full">
                                        <? while ($query->have_posts()) : $query->the_post(); ?>
                                        <?
                                            $featuredImage = get_the_featured_image($post->ID);
                                            $tour = get_post_meta($post->ID, 'tour-url', true);
                                            $count = $query->post_count;
                                            $size = sized_by_count($count, 'half', 'third', true);
                                        ?>
                                        <div class="<?= $size; ?> larger-cards" id="post-<? the_ID(); ?>">
                                            <? if($tour) { echo '<a href="' . get_the_permalink() . '?tour=true" class="material-card clickable point-three-trans js-only tour-available" data-bg="/wp-content/themes/arabiantents/images/interactive-tour-available.png" title="Take an interactive tour around the '. get_the_title() . '"></a>'; } ?>
                                            <a class="full image-link wrapper" href="<? the_permalink(); ?>">
                                                <div class="display-card featured-image" data-bg="<?= $featuredImage['full_url']; ?>"></div>
                                                <noscript>
                                                    <div class="display-card featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></div>
                                                </noscript>

                                                <div class="overlay-information">
                                                    <h3><? the_title(); ?></h3>
                                                </div>
                                            </a>
                                        </div>
                                        <? endwhile; ?>
                                    </div>
                                </div>
                            </div>
                            <? wp_reset_postdata(); endif; } ?>

            </div>
            <? include(locate_template('/partials/cta.php')); ?>
            <footer class="entry-footer">
                <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
            </footer>
</main>
<? get_footer(); ?>
