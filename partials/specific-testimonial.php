<?
        $specificTestimonial = get_post_meta(get_the_ID(), 'specific-testimonial', true);
        if(is_tag()) {
            $specificTestimonial = get_field('term_testimonial', $taxonomy . '_' . $term_id);
            $specificTestimonial = $specificTestimonial->ID;
            }
        if (!empty($specificTestimonial)) : ?>
        <?

        $args = array(
            'p'     => $specificTestimonial,
            'post_type' => 'testimonial',
            'posts_per_page' => '1',
            );

        $recentPosts = new WP_Query($args);
        ?>

        <? while ($recentPosts->have_posts()) : $recentPosts->the_post(); ?>
            <div class="testimonial">

                <blockquote>
                    <? the_excerpt(); ?>
                    <p class="attributed"><? the_title(); ?></p>
                </blockquote>
            </div>
        <? endwhile; // end of the loop. ?>
        <? endif; wp_reset_query(); ?>
