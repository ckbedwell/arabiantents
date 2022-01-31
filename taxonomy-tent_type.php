<?
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */
$count = $wp_query->post_count;
if ($count == 1) {
    include(locate_template('single-tent.php'));
    }
else {
$description = term_description($wp_query->term_id);
get_header(); ?>
		<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
            <? include(locate_template('featured-image.php')); ?>

            <section class="parent-contain entry-content scrollto-padding" id="scrollto-entry-content">
                <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>
            </section>
            <?php if ($description) : ?>
                <section class="parent-contain">
                    <div class="width-contain intro">
                        <?php echo $description; ?>
                    </div>
                </section>
            <?php endif; ?>

            <section class="parent-contain">
                <div class="width-contain">
                    <? if (have_posts()) : ?>

                        <? while (have_posts()) : the_post(); ?>
                            <?
                                $featuredImage = get_the_featured_image($post->ID);
                                $tour = get_post_meta($post->ID, 'tour-url', true);
                                $count = $wp_query->post_count;
                                if ($count == 1) { $size = 'full archive'; }
                                elseif ($count % 2 == 0) { $size = 'half archive';}
                                else { $size = 'third archive'; }
                            ?>
                            <div class="<?= $size; ?> larger-cards" id="post-<? the_ID(); ?>">
                                <? if($tour) { echo '<a href="' . get_the_permalink() . '?tour=true" class="material-card clickable point-three-trans js-only tour-available" data-bg="/wp-content/themes/arabiantents/images/interactive-tour-available.png" title="Take an interactive tour around the '. get_the_title() . '"></a>'; } ?>
                                <a class="full image-link" href="<? the_permalink(); ?>">
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
                        <? posts_pagination(); ?>


                    <? else : ?>
                        <? get_template_part('content', 'none'); ?>
                    <? endif; ?>
                </div>
            </section>
            <? include(locate_template('/partials/cta.php')); ?>
		</main>

<? get_footer(); } ?>
