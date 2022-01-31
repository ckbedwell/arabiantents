<?
/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */
    if (has_post_thumbnail()) { //if a thumbnail has been set
        $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
        $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
        $imgURL = $featuredImage[0]; //get the url of the image out of the array
        $altText = get_post_meta($imgID , '_wp_attachment_image_alt', true);
        $captionText = get_post(get_post_thumbnail_id())->post_excerpt;

        $images = rwmb_meta('photos', 'type=image');
        $furniturePrice = rwmb_meta('furniture-price', $args = array('type=text'));
        }

get_header(); ?>
    <script>
        document.querySelector('body').classList.add('loaded-ajax');
    </script>
	<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
        <article>
            <header class="row-padding small-header">
                <div class="width-contain">
                    <h1 class="entry-title"><? the_title() ?></h1>
                </div>
            </header>

            <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

            <div class="entry-content" id="scrollto-entry-content">
                <section class="main-content">
                    <div class="width-contain">

                        <div class="two-fifths no-padding gallery tiered-gallery ">
                             <a class="lightbox-link no-left-margin" href="<?= $imgURL; ?>"><? the_post_thumbnail('full', array('class' => 'point-four-trans')); ?></a>
                             <?

                            if ($images) {
                                foreach ($images as $image) {
                                echo '<a class="lightbox-link" href="' . $image["full_url"] . '" caption="' . $image["caption"] . '"><div class="expand-card point-five-trans" style="background-image: url(' . $image["full_url"] . ');"></div></a>';
                                }
                            }
                            ?>

                        </div>

                        <div class="three-fifths">

                            <div class=" parent-contain furniture-information">
                                <? if(!empty($furniturePrice)) {
                                    echo '<h4 class="alignleft price">';
                                    if (rwmb_meta('from-prefix') == 1) {
                                        echo 'From ';
                                        }
                                        echo '£' . $furniturePrice . '</h4>';
                                    }
                                ?>

                                <div class="terms-list">
                                    <?
                                       $terms = get_the_terms($post->ID , 'furniture_type');
                                       foreach($terms as $term) {
                                           echo '<h4>' . $term->name . '</h4>';
                                           // Get rid of the other data stored in the object, since it's not needed
                                           unset($term);
                                           }
                                    ?>
                                </div>
                            </div>
                            <div class="parent-contain">
                                <?= do_shortcode(wpautop(get_the_content())); ?>
                            </div>
                        </div>
                    </div>
                </section>

                <?
                    $terms = get_the_terms($post->ID , 'colour');
                    if ($terms && ! is_wp_error($terms)) :
                        $colour_names = array();
                        foreach ($terms as $term) {
                            $colour_names[] = $term->name;
                        }

                    $colours = join(", ", $colour_names);
                    endif;

                    $args = array(
                        'post_type' => 'furniture',
                        'posts_per_page' => '10',
                        'post__not_in' => array($post->ID),
                        'tax_query' => array (
                            array (
                                'taxonomy' => 'colour',
                                'field' => 'slug',
                                'terms' => $colours,
                               ),
                           ),

                       );

                    $recentPosts = new WP_Query($args);

                    if ($recentPosts->have_posts()) : ?>

                    <section class="suggested">
                        <div class="width-contain">
                            <h2>Similar furniture</h2>
                            <p class="width-contain-600 alignleft">Here's some of our furniture which has a similar look and feel to <? the_title(); ?>.</p>

                            <div class="parent-contain gallery masonry-grid">



                                        <? while ($recentPosts->have_posts()) : $recentPosts->the_post();
                                            $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
                                            $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
                                            $imgURL = $featuredImage[0]; //get the url of the image out of the array
                                            $furniturePrice = rwmb_meta('furniture-price', $args = array('type=text'));
                                        ?>

                                                <a class="lightbox-link masonry-item" href="<?= $imgURL; ?>" caption="<? the_title(); ?>">
                                                    <img class="point-five-trans" src="<?= $imgURL; ?>">
                                                    <div class="overlay-information">
                                                        <h3><?= the_title(); ?></h3>
                                                        <h5><?
                                                                if(!empty($furniturePrice)) {
                                                                    if (rwmb_meta('from-prefix') == 1) {
                                                                        echo 'From ';
                                                                    }
                                                                    echo '£' . $furniturePrice;
                                                                }

                                                            ?>
                                                        </h5>
                                                    </div>
                                                </a>
                                    <? endwhile; ?>
                            </div>
                        </div>
                    </section>

                    <? endif; wp_reset_query(); ?>
                </div>
            <footer class="entry-footer">
                <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
	       </footer>
        </article>
        <? include(locate_template('/partials/cta.php')); ?>
    </main>
<? get_footer(); ?>
