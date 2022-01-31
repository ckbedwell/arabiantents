<?
/*
* Template Name: Home Page
*/

$page_id = get_the_ID();
echo '<div class="main-header">';
	get_header();
echo '</div>';

$intro_h2 = get_post_meta($page_id, "intro-h2", true);
$intro_cta_link = get_post_meta($page_id, "intro-cta-link", true);
$intro_cta_text = wp_get_attachment_image(get_post_meta($page_id, "intro-cta-text", true), 'full');
?>

<main id="post-<? the_ID(); ?>" <? post_class('site-main main-page'); ?> role="main">
    <header class="wrapper">
        <? # Include the right parital depending on user settings ?>
        <? $partial = get_post_meta($page_id, "video", true) !== "" ? 'video' : 'carousel' ?>
        <?= inc('partials/home/_header_' . $partial . '.php', ["page_id" => $page_id]); ?>

        <? if (!empty($intro_h2)) : ?>
        <div class="full vertical-align home-top-content">
            <div class="width-contain">
                <div class="width-contain-800 padded text-center intro over-slider-box">
                    <h1 class="padded no-margin entry-title"><?= $intro_h2 ?></h1>
                    <?= get_post_meta($page_id, "intro-text", true); ?>

                    <a href="<?= $intro_cta_link ?>" target="_blank"  class="black-button">
                        <?= $intro_cta_text; ?>
                    </a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </header>

    <div class="entry-content">
        <section class="row-padding the-best">
            <div class="width-contain-750 intro">
                <h2 class="text-center">The very best in tent hire</h2>
                <? the_content(); ?>
                <div class="testimonial">
                    <blockquote class="text-center">
                        <p style="font-size: 2rem;">What a year 2020 has been! Katherine was amazing throughout the whole experience, offering her creative genius to provide us with the most memorable and unique wedding marquee for our micro-wedding. She and her team were outstanding throughout, they are the best!</p>
                        <p class="attributed">Camilla and Mike</p>
                    </blockquote>
                </div>
            </div>
        </section>



        <section class="row-padding the-best">
            <div class="width-contain width-contain-750-mob">
                <h2 class="text-center">What kind of event are you having?</h2>
                    <?

                    $args = array (
                        'post_type' => 'page',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'page-type',
                                'field' => 'slug',
                                'terms' => 'service-page',
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

                            <a class="quarter-margined no-padding no-margin-bottom image-link" href="<? the_permalink(); ?>">
                                <div class="display-card-medium featured-image" data-bg="<?= $imgURL; ?>"></div>
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
        </section>

        <section class="row-padding what-we-do">
            <div class="width-contain width-contain-750-mob text-center intro">
                <h2>What can we do for you?</h2>
                <p>We have a full range of services to help make your next event a huge success.</p>
                <div class="full row-padding-small">
                    <?

                    $args = array (
                        'post_type' => 'page',
//                         'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'page-type',
                                'field' => 'slug',
                                'terms' => array('top-level', 'additional-service'),
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

                            <a class="quarter-margined no-padding no-margin-bottom image-link" href="<? the_permalink(); ?>">
                                <div class="display-card-large featured-image" data-bg="<?= $imgURL; ?>"></div>
                                <noscript>
                                    <div class="display-card-large featured-image" style="background-image:url(<?= $imgURL; ?>);"></div>
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

        <section class="row-padding about-arabian">
            <div class="width-contain width-contain-750-mob">
                <div class="half">
                    <h2>About the Arabian Tent Company</h2>
                    <p>Springing from a love of outdoor parties, The Arabian Tent Company was founded in 2004 by Katherine Hudson. The magic of festivals and marquee parties captured Katherine’s imagination, soon she was hooked and decided she had to try and put on her own event.</p>
                    <p>After searching the whole of the UK for a suitable party tent, and finding nothing but white PVC marquees, Katherine realised she would have to try a little harder if she wanted to do something truly special.</p>
                    <a href="/about" class="black-button">Read more</a>
                </div>

                <div class="half">
                    <h3>Explore more about the Arabian Tent Company</h3>
                    <?

                    $args = array (
                        'post_type' => 'page',
                        'order' => 'ASC',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'page-type',
                                'field' => 'slug',
                                'terms' => 'about-sub',
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

                            <a class="half-margined no-padding no-margin-bottom image-link" href="<? the_permalink(); ?>">
                                <div class="display-card-medium featured-image" data-bg="<?= $imgURL; ?>"></div>
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