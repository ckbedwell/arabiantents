<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_location_custom_posts() {
    $labels = array(
        'name'          => _x('Locations', 'post type general name'),
        'singular_name' => _x('Location', 'post type singular name'),
        'add_new'       => _x('Add New Location', 'location'),
        'add_new_item'       => __('Add New Location'),
        'edit_item'          => __('Edit Location'),
        'new_item'           => __('New Location'),
        'all_items'          => __('All Locations'),
        'view_item'          => __('View Location'),
        'search_items'       => __('Search Location'),
        'not_found'          => __('No Location found'),
        'not_found_in_trash' => __('No Location found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Locations'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our location and location-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-location',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'has_archive'   => true,
        'rewrite'       => array(
            'slug' => 'about/where-we-work',
            ),

    );

    register_post_type('location', $args);

}

add_action('init', 'digicrab_three_fifty_location_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_location_messages($messages) {
    global $post, $post_ID;

    $messages['location'] = array(
        0 => '',
        1 => sprintf(__('Location updated. <a href="%s">View Location</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Location updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Location restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Location published. <a href="%s">View Location</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Location saved.'),
        8 => sprintf(__('Location submitted. <a target="_blank" href="%s">Preview Location</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Location scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Location</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Location draft updated. <a target="_blank" href="%s">Preview Location</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_location_messages');
