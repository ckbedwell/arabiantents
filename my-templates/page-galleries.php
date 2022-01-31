<?
/**
 *
 * Template Name: Galleries Page
 */

get_header(); ?>

	<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">

        <? get_template_part('featured-image'); ?>

        <div class="entry-content scrollto-padding" id="scrollto-entry-content">
            <<? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

            <section>
                <div class="width-contain">
                    <div class="row-padding-extra-small">
                        <?

                        $args = array (
                            'post_type' => 'page',
                            'order' => 'ASC',
                            'tax_query' => array(
                                array(
                                    'taxonomy' => 'page-type',
                                    'field' => 'slug',
                                    'terms' => ['gallery', 'image-gallery'],
                                   )
                               )
                           );

                            $recentPosts = new WP_Query ($args);
                            while ($recentPosts->have_posts()) : $recentPosts->the_post();
                                $postID = get_the_ID();
                                $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
                                $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
                                $imgURL = $featuredImage[0]; //get the url of the image out of the array
                                ?>

                                <a class="half-margined no-padding image-link" href="<? the_permalink(); ?>">
                                    <div class="display-card-large featured-image" data-bg="<?= $imgURL; ?>"></div>
                                    <noscript>
                                        <div class="display-card featured-image" style="background-image:url(<?= $imgURL; ?>);"></div>
                                    </noscript>

                                    <div class="overlay-information">
                                        <div class="wrapper">
                                            <h3><? the_title(); ?></h3>
                                        </div>
                                    </div>
                                </a>
                        <? endwhile; wp_reset_query(); ?>
                    </div>
                </div>
            </section>
            <? include(locate_template('/partials/cta.php')); ?>
        </div>


	<footer class="entry-footer">
		<? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
	</footer>
</main>
<? get_footer(); ?>