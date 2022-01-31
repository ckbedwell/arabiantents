<? $recentPosts = new WP_Query ($args); ?>
<? while ($recentPosts->have_posts()) { ?>
    <? $recentPosts->the_post(); ?>
    <? $postID = get_the_ID(); ?>
    <? $imgID = get_post_thumbnail_id($post->ID); //get the id of the featured image ?>
    <? $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array) ?>
    <? $imgURL = $featuredImage[0]; //get the url of the image out of the array ?>

    <a class="quarter-margined no-padding image-link" href="<? the_permalink(); ?>">
        <div class="display-card featured-image" data-bg="<?= $imgURL; ?>"></div>
        <noscript>
            <div class="display-card featured-image" style="background-image:url(<?= $imgURL; ?>);"></div>
        </noscript>

        <div class="overlay-information">
            <div class="wrapper">
                <h3><? the_title(); ?></h3>
            </div>
        </div>
    </a>
<? } ?>
<? wp_reset_query(); ?>
