<?

/**
 * The template for displaying all single posts.
 *
 * @package digicrab
 */

$imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image
$featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
$imgURL = $featuredImage[0]; //get the url of the image out of the array
$altText = get_post_meta($imgID , '_wp_attachment_image_alt', true);
$captionText = get_post(get_post_thumbnail_id())->post_excerpt;

$venueAddress = rwmb_meta('venue-address', $args = array('type=text'));
$venueWebsite = rwmb_meta('venue-website', $args = array('type=text'));
$venueEmail = rwmb_meta('venue-email', $args = array('type=text'));
$venuePhone = rwmb_meta('venue-phone', $args = array('type=text'));

$theLocations = get_the_terms($post->ID , 'location');
foreach ($theLocations as $theLocation) {
    $location = $theLocation->name;
    }

get_header(); ?>

	<main id="post-<? the_ID(); ?>" <? post_class('site-main'); ?> role="main">
        <article>
            <? get_template_part('featured-image'); ?>

            <div class="entry-content" id="scrollto-entry-content">
                <section class="scrollto-padding info">
                    <? if (function_exists('breadcrumbs')) { breadcrumbs(); } ?>
                </section>

                <section class="row-padding">
                    <div class="width-contain">
                        <? if(get_the_content()) : ?>
                        <div class="half intro">
                            <h2><?= rwmb_meta('more-info-h2', $args = array('type=text')); ?></h2>
                            <?= do_shortcode(wpautop(get_the_content())); ?>
                            <? $specificTestimonial = rwmb_meta ('specific-testimonial'); if (!empty($specificTestimonial)) { get_template_part('partials/specific-testimonial'); } ?>
                        </div>

                        <? $images = rwmb_meta('venue-photos', 'type=image'); if(!empty($images)) : ?>
                        <div class="gallery tiered-gallery half">
                            <h3><? the_title(); ?> Gallery</h3>
                            <a class="lightbox-link" href="<?= $imgURL; ?>" caption="<?= $captionText; ?>"><div class='full display-card featured-image point-five-trans' data-bg="<?= $imgURL; ?>"></div><button class="pinterest-btn" onclick="window.open('//pinterest.com/pin/create/link/?url=<?= 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>&media=<?= $featuredImage['full_url']; ?>&description=<?= get_the_excerpt(); ?>','_blank','resizable=yes'); event.stopPropagation(); event.preventDefault();">Save</button></a>
                            <noscript>
                                <a class="lightbox-link" href="<?= $imgURL; ?>" caption="<?= $captionText; ?>"><div class='full display-card featured-image point-five-trans' style='background-image: url("<?= $imgURL; ?>");'></div></a>
                            </noscript>

                            <?
                                foreach ($images as $image) {
                                echo '<a class="lightbox-link" href="' . $image["full_url"] . '" caption="' . $image["caption"] . '"><div class="display-card featured-image point-five-trans" data-bg="' . $image["full_url"] . '"></div><button class="pinterest-btn" onclick="window.open(\'//pinterest.com/pin/create/link/?url=http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"] .'&media=' . $image['full_url'] .'&description=' . $image["caption"] . '\',\'_blank\',\'resizable=yes\'); event.stopPropagation(); event.preventDefault();">Save</button></a>
                                <noscript>
                                    <a class="lightbox-link" href="' . $image["full_url"] . '" caption="' . $image["caption"] . '"><div class="display-card featured-image point-five-trans" style="background-image: url(' . $image["full_url"] . ');"></div></a>
                                </noscript>

                                ';
                                }
                            ?>

                        </div>
                        <? endif; endif; ?>

                        <div class="parent-contain row-padding">
                            <div class="half">
                                <h2>Contact Details</h2>
                                <?php echo get_favorites_button($postID); ?>
                                 <a href="/shortlist/" class="enquire-button">My ShortList</a>
                                <?php 
                                    $capacity = get_field('capacity', $postID);
                                    $licensed_for_marriage = get_field('licensed_for_marriage', $postID);
                                    $catering = get_field('catering', $postID);
                                    $bar = get_field('bar', $postID);
                                    $pets_welcome = get_field('pets_welcome', $postID);
                                    $exclusivity = get_field('exclusivity', $postID);
                                    $accommodation = get_field('accommodation_', $postID);
                                 ?>
                                 
                                <?php if(!empty ($capacity) ) : ?>
                                    <div class="full">
                                        <h3 class="third">Capacity: </h3>
                                        <div class="two-thirds">
                                            <?php echo $capacity; ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                
                                <?php if(!empty ($licensed_for_marriage) ) : ?>
                                    <div class="full">
                                        <h3 class="third">Licensed for Marriage: </h3>
                                        <div class="two-thirds">
                                            <?php echo $licensed_for_marriage; ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                
                                <?php if(!empty ($catering) ) : ?>
                                    <div class="full">
                                        <h3 class="third">Catering: </h3>
                                        <div class="two-thirds">
                                            <?php echo $catering; ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                
                                <?php if(!empty ($bar) ) : ?>
                                    <div class="full">
                                        <h3 class="third">Bar: </h3>
                                        <div class="two-thirds">
                                            <?php echo $bar; ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                
                                
                                <?php if(!empty ($pets_welcome) ) : ?>
                                    <div class="full">
                                        <h3 class="third">Pets Welcome: </h3>
                                        <div class="two-thirds">
                                            <?php echo $pets_welcome; ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                
                                
                                <?php if(!empty ($child_friendly) ) : ?>
                                    <div class="full">
                                        <h3 class="third">Child Friendly: </h3>
                                        <div class="two-thirds">
                                            <?php echo $child_friendly; ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                
                                <?php if(!empty ($exclusivity) ) : ?>
                                    <div class="full">
                                        <h3 class="third">Exclusivity: </h3>
                                        <div class="two-thirds">
                                            <?php echo $exclusivity; ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                
                                <?php if(!empty ($accommodation) ) : ?>
                                    <div class="full">
                                        <h3 class="third">Accommodation: </h3>
                                        <div class="two-thirds">
                                            <?php echo $accommodation; ?>
                                        </div>
                                    </div>
                                <? endif; ?>
                                
                                
                                
                                <? if (!empty ($venueAddress)) : ?>
                                    <div class="full">
                                        <h3 class="third">Address</h3>
                                        <div class="two-thirds">
                                            <? $formattedAddress = str_replace(',', '<br/>', $venueAddress); echo $formattedAddress; ?>
                                        </div>
                                    </div>
                                <? endif; ?>

                                <? if (!empty ($venueWebsite)) : ?>
                                    <div class="full">
                                        <h3 class="third">Website</h3>
                                        <div class="two-thirds">
                                            <a href="<?= $venueWebsite; ?>" target="_blank"><?= $venueWebsite; ?></a>
                                        </div>
                                    </div>
                                <? endif; ?>

                                <? if (!empty ($venueEmail)) : ?>
                                    <div class="full">
                                        <h3 class="third">Email</h3>
                                        <div class="two-thirds">
                                            <a href="mailto:<?= $venueEmail; ?>"><?= $venueEmail; ?></a>
                                        </div>
                                    </div>
                                <? endif; ?>

                                <? if (!empty ($venuePhone)) : ?>
                                    <div class="full">
                                        <h3 class="third">Phone</h3>
                                        <div class="two-thirds">
                                            <a href="tel:<?= $venuePhone; ?>"><?= $venuePhone; ?></a>
                                        </div>
                                    </div>
                                <? endif; ?>
                            </div>

                            <div class="half">
                                <?
                                        $map = rwmb_meta('loc', array(
                                            'type' => 'map',
                                            'width' => '100%',
                                            'height' => '40rem',
                                            'marker' => true,
                                            'api_key' => 'AIzaSyBjvS-FtBe5Z1iR8mIJGLB3pEXB0F9Bmp4',
                                            'js_options' => array(
                                                'scrollwheel' => true,
                                           ),
                                       ));
                                        echo $map;
                                   ?>
                            </div>
                        </div>
                    </div>
                </section>


                        <?
                                $currentPost = $post->ID;
                                $args = array(
                                    'post_type' => 'venue',
                                    'posts_per_page' => '4',
                                    'taxonomy' => 'location',
                                    'term'    => $location,
                                    'post__not_in' => array($currentPost),
                                   );

                                $recentPosts = new WP_Query($args);
                                $size = sized_by_count($recentPosts->post_count, 'third');
                                if($recentPosts->have_posts()) : ?>
                                    <section class="row-padding text-center related-locations">
                                        <div class="width-contain">
                                            <h2>Other venues located in <?= $location; ?></h2>
                                		  <div class="alignleft full row-padding-small center-items">
                                    <? while ($recentPosts->have_posts()) : $recentPosts->the_post();
                                        $postURL = get_the_permalink($post->ID);
                                        $featuredImage = get_the_featured_image($post->ID);
                                    ?>
                                            <div class="<?= $size; ?>-margined">
                                                    <a href="<?= $postURL; ?>" class="display-card featured-image image-link" data-bg="<?= $featuredImage['full_url']; ?>"></a>
                                                    <noscript>
                                                        <a href="<?= $postURL; ?>" class="display-card featured-image" style="background-image: url(<?= $featuredImage['full_url']; ?>);"></a>
                                                    </noscript>
                                                    <h3><?= the_title(); ?></h3>
                                            </div>
                                    <? endwhile; wp_reset_query(); ?>


                                            </div>
                                            <a class="aligncenter no-margin black-button clickable " href="/event-management/venues">Back to see the venues map</a>
                                        </div>
                                    </section>
                            <? endif; ?>

            </div>
        </article>
        <? include(locate_template('/partials/cta.php')); ?>
        <footer class="entry-footer">
            <? edit_post_link(__('Edit', 'digicrab'), '<span class="edit-link">', '</span>'); ?>
       </footer>
    </main>
<? get_footer(); ?>
