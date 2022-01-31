<?
/**
 * The template for displaying archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package digicrab
 */

/*** MAIN QUERY MODIFIED IN FUNCTIONS.PHP -- ONLY FINDS EXTERNAL BLOGS ***/

$queried_object = get_queried_object();
$title = $queried_object->name;
$slug = $queried_object->slug;
$taxonomy = $queried_object->taxonomy;
$term_id = $queried_object->term_id;
$content = $queried_object->description;

$acfAddHeader = get_field('term_additional_header', $taxonomy . '_' . $term_id);
$acfImages = get_field('term_gallery', $taxonomy . '_' . $term_id);
$acfSimilarIdeas = get_field('similar_ideas', $taxonomy . '_' . $term_id);
$acfTestimonial = get_field('term_testimonial', $taxonomy . '_' . $term_id);
$acfVideo = get_field('term_video', $taxonomy . '_' . $term_id);
$faqs = get_field('term_faqs', $taxonomy . '_' . $term_id);

get_header(); ?>


		<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
            <? include(locate_template('/featured-image.php')); ?>

            <div class="scrollto-padding" id="scrollto-entry-content"></div>
            <div class="wrapper entry-content drop-off">
                <section class="no-padding info">
                    <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

                    <div class="height-filler hide"></div>
                    <div class="full sticky-info">
                        <div class="width-contain row-padding-extra-small">
                            <div class="two-thirds">
                                <span class="icon-lamp2 big-icon no-padding alignleft"></span>
                                <div class="five-sixths no-padding">
                                    <h2>Just getting started with planning?</h2>
                                    <p>Tell us a bit about your <? display_the_archive_title(); ?> and we can send you information tailored to your needs.</p>
                                </div>
                            </div>

                            <div class="alignright third">
                                <a href="/contact" class="vertical-align horizontal-align no-margin more-info enquire-button" value="enquiry-form">Tell us your <?= $title; ?> ideas</a>
                            </div>
                            <button class="lower-info point-five-trans clickable"><span class="icon-arrow-right point-five-trans"></span></button>
                        </div>
                    </div>
                </section>

                <? if ($content) : ?>
                <section class="row-padding">
                    <div class="width-contain-700">
                        <div class="intro">
                            <? if($acfAddHeader) { echo '<h2>' . $acfAddHeader . '</h2>'; } ?>
                            <?= wpautop($content); ?>
                            <?
                                if(!empty($acfImages)) :
                            ?>
                                <div class="row-padding gallery">
                                    <div class="added-gallery">
                                        <?php
                                        foreach ( $acfImages as $image ) {
                                        echo '<a href="' . $image["url"] . '" class="lightbox-link image-link" caption="' . $image["caption"] . '">
                                                <div class="display-card-small featured-image point-five-trans" data-bg="' . $image["url"] . '"></div>
                                                <noscript>
                                                    <div class="display-card-small featured-image point-five-trans" style="background-image: url(' . $image["url"] . ');"></div>
                                                </noscript>
                                                <button class="pinterest-btn" onclick="window.open(\'//pinterest.com/pin/create/link/?url=http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] .'&media=' . $image['url'] .'&description=' . $image["caption"] . '\',\'_blank\',\'resizable=yes\'); event.stopPropagation(); event.preventDefault();">Save</button>
                                                </a>';
                                        }
                                    ?>
                                    </div>
                                </div>
                            <? endif; ?>
                            <? if ($acfTestimonial) { include(locate_template('/partials/specific-testimonial.php')); } ?>
                        </div>
                    </div>
                </section>
                <? endif; ?>

                <? if($acfVideo) : ?>
                <section class="row-padding">
                    <div class="width-contain-700 text-center">
                        <h2>Watch our video</h2>
                        <div class="laptop-container">
                            <div class="padded laptop-border">
                                <div class="responsive-video">
                                    <iframe src="<?= $acfVideo; ?>" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <? endif; ?>

                <? if($faqs) : ?>
                    <section class="row-padding">
                       <div class="anchor-id" id="faqs" style="padding-top: 70px; margin-top: -70px">
                           <div class="width-contain-700 intro">
                                <h2><?= display_the_archive_title() . ' faqs'?> </h2>
                                <?= wpautop($faqs); ?>
                            </div>
                        </div>
                    </section>
                <? endif; ?>

                <?
                    $args = array(
                        'post_type' => 'tent',
                        'posts_per_page' => '-1',
                        'tag' => $slug,
                       );

                    $tentPosts = new WP_Query ($args);
                    $count = $tentPosts->post_count;
                    $size = sized_by_count($count);
                    if ($tentPosts->have_posts()) : ?>

                    <section class="row-padding text-center favourite-tents">
                        <div class="width-contain-700 intro">
                            <h2><?= $title; ?> Tents</h2>
                            <p class="width-contain-600">These are our favourite tents when having a <?= strtolower($title); ?>.</p>
                            <div class="full clearfix row-padding-extra-small center-items">
                            <? while ($tentPosts->have_posts()) : ?>
                                <?
                                    $tentPosts->the_post();
                                    $postID = get_the_ID();
                                    $featuredImage = get_the_featured_image($postID);
                                ?>
                                <div class="<?= $size; ?> larger-cards" id="post-<? the_ID(); ?>">
                                    <a class="image-link display-card featured-image" href="<? the_permalink(); ?>" data-bg="<?= $featuredImage['full_url']; ?>" title="<?= $featuredImage['alt']; ?>">
                                        <div class="overlay-information">
                                            <h3><? the_title(); ?></h3>
                                        </div>
                                    </a>
                                </div>
                            <? endwhile; ?>
                            </div>
                        </div>
                    </section>
                <? endif; wp_reset_query(); ?>

                <?
                    $args = array(
                        'post_type'=> 'furniture',
                        'posts_per_page' => '9',
                        'tag' => $slug,
                       );

                    $furniture = new WP_Query ($args);
                    $count = $furniture->post_count;
                    $furnitureSize = sized_by_count($count, 'full', 'half', true);

                    $args = array(
                        'post_type'=> 'venue-dressing',
                        'tag' => $slug,
                       );

                    $venueDressing = new WP_Query ($args);
                    $count = $venueDressing->post_count;
                    $venueDressingSize = sized_by_count($count, 'half', 'half', true);
                ?>

                <? if($furniture->have_posts() || $venueDressing->have_posts() || $acfSimilarIdeas) : ?>
                <section class="row-padding other-things">
                    <div class="width-contain-700 text-center intro">
                        <h2>Other things to take a look at</h2>
                        <p class="width-contain-600 text-center">We have so much going on at the Arabian Tent company, here's a few things which you might have missed.</p>
                        <div class="full row-padding-small furniture-items">
                            <? if($furniture->have_posts()) : ?>
                                <div class="padded material-card clearfix center-items gallery">
                                    <h3><?= $title; ?> Furniture</h3>
                                    <? while($furniture->have_posts()) :
                                        $furniture->the_post();
                                        $postID = get_the_ID();
                                        $featuredImage = get_the_featured_image($postID);
                                        ?>
                                    <div class="<?= $furnitureSize; ?>-margined no-padding" id="post-<? the_ID(); ?>">
                                        <a class="full lightbox-link image-link" href="<?= $featuredImage['full_url']; ?>" caption="<? the_title(); ?>" title="<?= the_title(); ?>">
                                            <div class="full display-card-small featured-image point-five-trans" data-bg="<?= $featuredImage['full_url']; ?>"></div>
                                            <noscript>
                                                <div class="full display-card-small featured-image point-five-trans" style="background-image: url(<?  echo $featuredImage['full_url']; ?>);"></div>
                                            </noscript>
                                        </a>
                                    </div>
                                    <? endwhile; ?>
                                    <a href="/furniture-decoration" class="clearleft full">See all of our furniture</a>
                                </div>
                            <? endif; ?>

                            <? if($venueDressing->have_posts()) : ?>
                                <div class="padded material-card clearfix venue-dressings">
                                    <h3 class="text-center">Venue Dressings</h3>
                                    <? while($venueDressing->have_posts()) :
                                        $venueDressing->the_post();
                                        $postID = get_the_ID();
                                        $featuredImage = get_the_featured_image($postID);
                                        ?>
                                    <div class="<?= $venueDressingSize; ?>-margined no-padding" id="post-<? the_ID(); ?>">
                                        <a class="full image-link" href="<? the_permalink(); ?>" title="<?= the_title(); ?>">
                                            <div class="display-card-small featured-image" data-bg="<?= $featuredImage['full_url']; ?>"></div>
                                            <noscript>
                                                <div class="display-card featured-image" style="background-image: url(<?  echo $featuredImage['full_url']; ?>);"></div>
                                            </noscript>
                                        </a>
                                        <h3 class="small-h3 no-margin"><? the_title(); ?></h3>
                                    </div>
                                    <? endwhile; ?>
                                </div>
                            <? endif; ?>

                            <? if($acfSimilarIdeas) : ?>
                                <div class="padded material-card clearfix">
                                    <h3>Similar Ideas</h3>
                                    <?
                                        $count = count($acfSimilarIdeas);
                                        $size = sized_by_count($count, 'full', 'half', true);
                                        foreach($acfSimilarIdeas as $similarIdea) : ?>
                                        <div class="<?= $size; ?>-margined no-padding">
                                            <a href="<?= get_term_link($similarIdea); ?>" class="full image-link" title="<?= get_term($similarIdea)->name; ?>" alt="<?= get_term($similarIdea)->name; ?>">
                                                <div class="display-card-small featured-image" data-bg="<?= get_field('term_image', $taxonomy . '_' . $similarIdea); ?>"></div>
                                            </a>
                                            <h3 class="small-h3 no-margin"><?= get_term($similarIdea)->name; ?></h3>
                                        </div>
                                    <? endforeach; ?>
                                </div>
                            <? endif; ?>
                        </div>
                    </div>
                </section>
                <? endif; ?>

                <?
                    $args = array(
                        'category_name' => 'Blog',
                        'tag' => $slug,
                       );
                    $blogs = new WP_Query($args);
                                   ?>
                <? if (have_posts() || $blogs->have_posts()) : ?>
                    <section class="row-padding text-center blogs">
                        <div class="width-contain-700 intro">
                            <h2>Blogs about <?= $title; ?> ideas</h2>
                            <p class="width-contain-600">We have collected blogs and websites from around the web which share our passion for throwing the perfect party. Take a look at them here.</p>

                            <?
                                if($blogs->have_posts()) : ?>
                                <div class="alignleft full row-padding-small center-items internal-blogs">
                                    <h3>On our blog</h3>
                                    <? while($blogs->have_posts()) : $blogs->the_post(); ?>
                                        <?
                                            $featuredImage = get_the_featured_image(get_the_ID());
                                        ?>
                                        <div class="third">
                                            <a href="<? the_permalink(); ?>" class="full image-link" title="<? the_title(); ?>" alt="<? the_title(); ?>">
                                                <div class="display-card-medium featured-image" data-bg="<?= $featuredImage['full_url']; ?>"></div>
                                                <noscript>
                                                    <div class="display-card-medium featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></div>
                                                </noscript>
                                            </a>
                                            <h3 class="small-h3"><? the_title(); ?></h3>
                                        </div>
                                    <? endwhile; ?>
                                </div>
                                <? endif; ?>

                            <? if(have_posts()) : ?>
                            <div>
                            <div class="alignleft full row-padding-small center-items external-blogs">
                                <h3>Blogs around the web</h3>
                                <? while (have_posts()) : the_post(); ?>
                                    <?
                                        $featuredImage = get_the_featured_image(get_the_ID());
                                    ?>
                                    <div class="quarter">
                                        <a href="<?= get_field('blog_url'); ?>" class="full image-link" target="_blank" title="<? the_title(); ?>" alt="<? the_title(); ?>">
                                            <div class="display-card-medium featured-image" data-bg="<?= $featuredImage['full_url']; ?>"></div>
                                            <div class="overlay-information to-bottom">
                                                <h4 class="full text-center"><?= get_field('website_name'); ?></h4>
                                            </div>
                                            <noscript>
                                                <div class="display-card-medium featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></div>
                                            </noscript>
                                        </a>
                                        <h3 class="small-h3"><? the_title(); ?></h3>
                                    </div>

                                <? endwhile; ?>
                            </div>
                            <? endif; ?>

                            </div>
                        </div>
                    </section>
                    <? endif;  ?>
                </div>
                <? include(locate_template('/partials/cta.php')); ?>
        </main>
        
    <style>
        .material-card {
            margin-bottom: 4rem;
        }

        .entry-content .row-padding.gallery {
            border: none;
        }

        .added-gallery a.image-link {
            display: inline-block;
            width: 25%;
        }

        @media screen and (max-width: 1085px) {
            .added-gallery a.image-link {
                width: 50%;
            }
        }
    </style>
<? edit_tag_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
<? get_footer(); ?>
