<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_testimonial_custom_posts() {
    $labels = array(
        'name'          => _x('Testimonials', 'post type general name'),
        'singular_name' => _x('Testimonial', 'post type singular name'),
        'add_new'       => _x('Add New Testimonial', 'case-studies'),
        'add_new_item'       => __('Add New Testimonial'),
        'edit_item'          => __('Edit Testimonial'),
        'new_item'           => __('New Testimonial'),
        'all_items'          => __('All Testimonials'),
        'view_item'          => __('View Testimonial'),
        'search_items'       => __('Search Testimonials'),
        'not_found'          => __('No Testimonials found'),
        'not_found_in_trash' => __('No Testimonials found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Testimonials'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our testimonials and testimonial-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-format-status',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'has_archive'   => true,
        'rewrite'       => array(
            'slug' => 'about/testimonials'
            ),

    );

    register_post_type('testimonial', $args);

}

add_action('init', 'digicrab_three_fifty_testimonial_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_testimonial_messages($messages) {
    global $post, $post_ID;

    $messages['testimonial'] = array(
        0 => '',
        1 => sprintf(__('Testimonial updated. <a href="%s">View Testimonial</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Testimonial updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Testimonial restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Testimonial published. <a href="%s">View Testimonial</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Testimonial saved.'),
        8 => sprintf(__('Testimonial submitted. <a target="_blank" href="%s">Preview Testimonial</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Testimonial scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Testimonial</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Testimonial draft updated. <a target="_blank" href="%s">Preview Testimonial</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_testimonial_messages');
