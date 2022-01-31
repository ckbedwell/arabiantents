<?

/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */
$isSingleTent = true;
$postID = get_the_ID();
$featuredImg = get_the_featured_image(get_the_ID()); //DIFFERENT (IMG INSTEAD OF IMAGE) BECAUSE OF INCLUDE PASSING VARIABLE
$tour = rwmb_meta('tour-url', $args = array('type=text'));

get_header(); ?>

	<main id="<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
            <? include(locate_template('featured-image2.php')); ?>

            <div class="wrapper entry-content drop-off" id="scrollto-entry-content">
                <section class="scrollto-padding info">
                    <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>

                    <div class="height-filler hide"></div>
                    <div class="full text-center sticky-info">
                        <div class="width-contain">
                            <div class="two-thirds no-padding-right no-padding-left">
                                <span class="icon-info big-icon alignleft" style="padding-top: 1.5rem;"></span>
                                <div class="iconwrapper fifth">
                                    <span class="icon-users"></span>
                                    <span class="title">Max Capacity:<button class="more-info icon-info2 js-only" value="tent-faqs" scrollto="answer1"></button></span>
                                    <a class="meta-info more-info" value="tent-faqs" scrollto="answer1"><?= rwmb_meta('max-capacity', $args = array('type=number')); ?></a>
                                </div>

                                <div class="iconwrapper fifth">
                                    <span class="icon-rulers"></span>
                                    <span class="title">Min. Space Required:<button class="more-info icon-info2 js-only" value="tent-faqs" scrollto="answer2"></button></span>
                                    <a class="meta-info more-info" value="tent-faqs" scrollto="answer2"><?= rwmb_meta('min-size', $args = array('type=text')); ?></a>
                                </div>

                                <div class="iconwrapper fifth">
                                    <span class="icon-clock"></span>
                                    <span class="title">Build Time:<button class="more-info icon-info2 js-only" value="tent-faqs" scrollto="answer3"></button></span>
                                    <a class="meta-info more-info" value="tent-faqs" scrollto="answer3"><?= rwmb_meta('build-time', $args = array('type=text')); ?></a>
                                </div>

                                <div class="iconwrapper fifth">
                                    <span class="icon-coin-pound"></span>
                                    <span class="title">Layout and Price:<button class="more-info icon-info2 js-only" value="tent-faqs" scrollto="answer8"></button></span>
                                    <a class="meta-info more-info" value="tent-faqs" scrollto="answer8">See examples</a>
                                </div>
                            </div>
                            <div class="alignright third no-padding">
                                <a href="/contact" class="vertical-align horizontal-align no-margin more-info enquire-button" value="enquiry-form">Enquire about <? the_title(); ?></a>
                            </div>
                            <button class="lower-info point-five-trans clickable"><span class="icon-arrow-right point-five-trans"></span></button>
                            
                        </div>
                    </div>
                </section>
                <section class="row-padding main-content">
                    <div class="width-contain">
                        <div class="intro">
                            <h2><?= rwmb_meta('more-info-h2', $args = array('type=text')); ?></h2>
                            <?php // echo do_shortcode('[favorite_button post_id=”'.$postID.'″]'); ?>
                            
                            <img scr="<?php the_field('sketch_image', $postID); ?>" style="width: 100%; height: auto;" >
                            <?= do_shortcode(wpautop(get_the_content())); ?>
                            <?php echo get_favorites_button($postID); ?>
                            <a href="/shortlist/" class="enquire-button">My ShortList</a>
                            <? $specificTestimonial = get_post_meta(get_the_ID(), 'specific-testimonial', true); if (!empty($specificTestimonial)) { get_template_part('partials/specific-testimonial'); } ?>
                        </div>


                    </div>
                </section>

                <?
                    if(!empty($tour)) : ?>
                <section class="row-padding text-center js-only interactive-tour" id="scrollto-interactive-tour">
                    <div class="width-contain">
                        <h2>Take an interactive tour of the <? the_title(); ?></h2>
                        <p>Feel free to look around using either your mouse, touch screen or the controls at the bottom of the screen.</p>
                        <div class="responsive-video">
                            <iframe type="text/html" data-src="<?= $tour; ?>" wmode="opaque" allowfullscreen="true"></iframe>
                            <div class="clickable scroll-cover scroll-to-tour"></div>
                        </div>
                    </div>
                </section>
                <? endif; ?>
                <? $images = rwmb_meta('photos', 'type=image'); ?>
                <div class="width-contain pb-90">
                    <div class="gallery">
                        <? foreach ($images as $key => $image): ?>
                        <a href="<?=$image["full_url"]; ?>" class="fl-l image-link lightbox-link" >
                        <img src="<?= wp_get_attachment_image_url($key, 'medium'); ?>" class="obf-cv point-five-trans" width="300" height="200" alt="<?=$image["alt"]; ?>">
                                </a>
                        <? endforeach; ?>
                    </div>
                </div>
                <? if($acfVideo = get_field( 'video' )) : ?>
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
                <?
                    $meta_quer_args = array(
                        'relation'  =>   'OR',
                        array(
                            'key'       =>   'specific-tents',
                            'value'     =>   $postID,
                            'compare'   =>   '=',
                           )
                       );

                    $args = array(
                        'post_type' => 'furniture',
                        'posts_per_page' => '10',
                        'meta_query' => $meta_quer_args
                       );


                    $recentPosts = new WP_Query($args);
                    $countPosts = $recentPosts->found_posts;
                    if ($countPosts > 0) : /*?>

                <section class="suggested js-only">
                    <div class="width-contain intro">
                        <h2 class="text-center">What looks good with the <? the_title(); ?></h2>
                        <p class="width-contain-600 text-center">Here's a small selection of our additional tents, furniture and props which we think complete the <? the_title(); ?>'s look.</p>
                        <p class="clearleft">Showing <strong class="showing">-</strong> out of <strong class="out-of"></strong> furniture items.</p>
                        <div class="parent-contain gallery masonry-grid" items="10">


                        </div>
                    </div>
                </section>
            </div><!---END ENTRY CONTENT / DROP OFF--->
                    <?*/ endif;


                // $tags = get_the_terms(get_the_ID(), 'post_tag');
                // $tent_tags = rwmb_meta('previous_customers');
                $tent_tags = get_field("previous_ideas");
                // var_dump($tent_tags);
                $count = count($tent_tags);
                $size = sized_by_count($count);
                if($tent_tags) : /*?>
                    <section class="previous-customers">
                        <div class="width-contain">
                            <div class="used-for text-center">
                                <h2>How our previous customers have used the <? the_title(); ?></h2>
                                <p class="width-contain-600">We're always on the lookout for new and exciting ways to decorate and theme our tents and these are a few ideas which our customers have found worked well for the <? the_title(); ?>.</p>
                                <div class="full row-padding-extra-small center-items">
                                    <?
                                       foreach($tent_tags as $tag) {

                                            $tagURL = get_term_link($tag);
                                            $taxonomy = $tag->taxonomy;
                                            $image = get_field('term_image', $taxonomy . '_' . $tag->term_id);//USE UNIVERSAL IMAGE


                                            echo '<a href="' . $tagURL . '"class="'. $size .'-margined no-padding image-link">
                                                    <div class="featured-image display-card" data-bg="' . $image . '"></div>
                                                    <noscript><div class="featured-image display-card" style="background-image:url(' . $image . ');"></div></noscript>
                                                    <div class="overlay-information"><h3>' . $tag->name . '</h3></div>
                                                </a>';
                                          }
                                    ?>
                                    </div>
                            </div>
                        </div>
                    </section>
                <?*/ endif; ?>


                <footer class="entry-footer">
                    <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
                </footer>
    </main>

<? $tour = $_GET["tour"];
  if($tour == true) : ?>
    <script>
        jQuery(document).ready(function() {
            setTimeout(function() {
                jQuery('html,body').animate({scrollTop: jQuery('.scroll-cover').offset().top - 45}, 1000);
                jQuery('html').addClass('nav-up');
            }, 500);
            });
    </script>
<? endif; ?>

<? get_footer(); ?>
