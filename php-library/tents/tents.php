<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_tent_custom_posts() {
    $labels = array(
        'name'          => _x('Tents', 'post type general name'),
        'singular_name' => _x('Tent', 'post type singular name'),
        'add_new'       => _x('Add New Tent', 'tent'),
        'add_new_item'       => __('Add New Tent'),
        'edit_item'          => __('Edit Tent'),
        'new_item'           => __('New Tent'),
        'all_items'          => __('All Tents'),
        'view_item'          => __('View Tent'),
        'search_items'       => __('Search Tents'),
        'not_found'          => __('No Tents found'),
        'not_found_in_trash' => __('No Tents found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Tents'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our tents and tent-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-arrow-up-alt2',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'taxonomies' => array('post_tag'),
        'has_archive'   => true,
        'rewrite'       => array(
            'slug' => 'tents/%tent_type%',
            'with_front' => false,
            ),

    );

    register_post_type('tent', $args);

}

add_action('init', 'digicrab_three_fifty_tent_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_tent_messages($messages) {
    global $post, $post_ID;

    $messages['tent'] = array(
        0 => '',
        1 => sprintf(__('Tents updated. <a href="%s">View Tents</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Tents updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Tents restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Tents published. <a href="%s">View Tents</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Tents saved.'),
        8 => sprintf(__('Tents submitted. <a target="_blank" href="%s">Preview Tents</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Tents scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Tents</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Tents draft updated. <a target="_blank" href="%s">Preview Tents</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_tent_messages');
