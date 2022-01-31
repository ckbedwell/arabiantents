<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_venue_dressing_custom_posts() {
    $labels = array(
        'name'          => _x('Venue Dressing', 'post type general name'),
        'singular_name' => _x('Venue dressing', 'post type singular name'),
        'add_new'       => _x('Add New Venue dressing', 'venue dressing'),
        'add_new_item'       => __('Add New Venue dressing'),
        'edit_item'          => __('Edit Venue dressing'),
        'new_item'           => __('New Venue dressing'),
        'all_items'          => __('All Venue dressings'),
        'view_item'          => __('View Venue dressing'),
        'search_items'       => __('Search Venue dressings'),
        'not_found'          => __('No Venue dressings found'),
        'not_found_in_trash' => __('No Venue dressings found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Venue Dressing'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our venue dressing and venue dressing-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-art',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'taxonomies' => array('post_tag'),
        'has_archive'   => false,
        'rewrite'       => array(
            'slug' => 'decor-options',
            'with_front' => false,
            ),

    );

    register_post_type('venue-dressing', $args);

}

add_action('init', 'digicrab_three_fifty_venue_dressing_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_venue_dressing_messages($messages) {
    global $post, $post_ID;

    $messages['venue_dressing'] = array(
        0 => '',
        1 => sprintf(__('Venue dressings updated. <a href="%s">View Venue dressings</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Venue dressings updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Venue dressings restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Venue dressings published. <a href="%s">View Venue dressings</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Venue dressings saved.'),
        8 => sprintf(__('Venue dressings submitted. <a target="_blank" href="%s">Preview Venue dressings</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Venue dressings scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Venue dressings</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Venue dressings draft updated. <a target="_blank" href="%s">Preview Venue dressings</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_venue_dressing_messages');
