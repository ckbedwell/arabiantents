<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_venue_custom_posts() {
    $labels = array(
        'name'          => _x('Venues', 'post type general name'),
        'singular_name' => _x('Venue', 'post type singular name'),
        'add_new'       => _x('Add New Venue', 'case-studies'),
        'add_new_item'       => __('Add New Venue'),
        'edit_item'          => __('Edit Venue'),
        'new_item'           => __('New Venue'),
        'all_items'          => __('All Venues'),
        'view_item'          => __('View Venue'),
        'search_items'       => __('Search Venues'),
        'not_found'          => __('No Venues found'),
        'not_found_in_trash' => __('No Venues found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Venues'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our venues and venue-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-location',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'has_archive'   => true,
        'rewrite'       => array(
            'slug' => 'event-design/venues'
            ),

    );

    register_post_type('venue', $args);

}

add_action('init', 'digicrab_three_fifty_venue_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_venue_messages($messages) {
    global $post, $post_ID;

    $messages['venue'] = array(
        0 => '',
        1 => sprintf(__('Venue updated. <a href="%s">View Venue</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Venue updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Venue restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Venue published. <a href="%s">View Venue</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Venue saved.'),
        8 => sprintf(__('Venue submitted. <a target="_blank" href="%s">Preview Venue</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Venue scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Venue</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Venue draft updated. <a target="_blank" href="%s">Preview Venue</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_venue_messages');
