<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_press_custom_posts() {
    $labels = array(
        'name'          => _x('Press', 'post type general name'),
        'singular_name' => _x('Press', 'post type singular name'),
        'add_new'       => _x('Add New Press', 'case-studies'),
        'add_new_item'       => __('Add New Press'),
        'edit_item'          => __('Edit Press'),
        'new_item'           => __('New Press'),
        'all_items'          => __('All Press'),
        'view_item'          => __('View Press'),
        'search_items'       => __('Search Press'),
        'not_found'          => __('No Press found'),
        'not_found_in_trash' => __('No Press found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Press'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our press and press-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-megaphone',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'has_archive'   => true,
        'rewrite'       => array(
            'slug' => 'about/press'
            ),

    );

    register_post_type('press', $args);

}

add_action('init', 'digicrab_three_fifty_press_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_press_messages($messages) {
    global $post, $post_ID;

    $messages['press'] = array(
        0 => '',
        1 => sprintf(__('Press updated. <a href="%s">View Press</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Press updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Press restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Press published. <a href="%s">View Press</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Press saved.'),
        8 => sprintf(__('Press submitted. <a target="_blank" href="%s">Preview Press</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Press scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Press</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Press draft updated. <a target="_blank" href="%s">Preview Press</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_press_messages');
