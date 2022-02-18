<?

function call_testimonial_function($atts) {
    extract(shortcode_atts(array(
        'name' => '',
        ), $atts));
    ?>

    <? ob_start(); ?>
        <?
            $postID = get_post_meta (get_the_ID(), 'specific-testimonial', true);
            $postExcerpt = apply_filters('the_excerpt', get_post_field('post_excerpt', $postID));
            $postTitle = get_the_title($postID);
            ?>


        <aside class="alignright">
            <div class="testimonial">
                <blockquote>
                    <?= wpautop($postExcerpt); ?>
                    <p class="attributed"><?= $postTitle; ?></p>
                </blockquote>
            </div>
        </aside>


    <? return ob_get_clean();


}

function register_testimonial_shortcode(){
   add_shortcode('show-testimonial', 'call_testimonial_function');
}

add_action('init', 'register_testimonial_shortcode');
