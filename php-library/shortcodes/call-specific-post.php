<?

function call_blog_function($atts, $content = null) {
    extract(shortcode_atts(array(
        'name' => '',
        ), $atts));
    ?>

    <? ob_start(); ?>
        <?
            $postID = get_post_meta(get_the_ID(), 'specific-blog', 'type=text');
            $postURL = get_the_permalink($postID);
            $postExcerpt = get_the_excerpt($postID);
            if (has_post_thumbnail($postID)) { //if a thumbnail has been set
                $imgID = get_post_thumbnail_id($postID); //get the id of the featured image
                $featuredImage = wp_get_attachment_image_src($imgID, 'full');//get the url of the featured image (returns an array)
                $imgURL = $featuredImage[0]; //get the url of the image out of the array
                $altText = get_post_meta($imgID , '_wp_attachment_image_alt', true);
                }
            ?>

        <aside class="alignright">
            <h4>More on our blog</h4>
            <a class="full image-link" href="<?= $postURL; ?>">
                <div class="display-card featured-image" data-bg="<?= $imgURL; ?>"></div>
                <noscript>
                    <div class="display-card featured-image" style="background-image: url(<?= $imgURL; ?>);"></div>
                </noscript>
                <div class="overlay-information">
                    <h3><?= get_the_title($postID); ?></h3>
                </div>
            </a>
        </aside>


    <? return ob_get_clean();


}

function register_shortcodes(){
   add_shortcode('show-post', 'call_blog_function');
}

add_action('init', 'register_shortcodes');
