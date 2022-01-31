<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_furniture_custom_posts() {
    $labels = array(
        'name'          => _x('Furniture', 'post type general name'),
        'singular_name' => _x('Furniture', 'post type singular name'),
        'add_new'       => _x('Add New Furniture', 'furniture'),
        'add_new_item'       => __('Add New Furniture'),
        'edit_item'          => __('Edit Furniture'),
        'new_item'           => __('New Furniture'),
        'all_items'          => __('All Furniture'),
        'view_item'          => __('View Furniture'),
        'search_items'       => __('Search Furniture'),
        'not_found'          => __('No Furniture found'),
        'not_found_in_trash' => __('No Furniture found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Furniture'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our furniture and furniture-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-hammer',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'taxonomies' => array('post_tag'),
        'has_archive'   => true,
        'rewrite'       => array(
            'slug' => 'furniture-decoration/%furniture_type%',
            ),

    );

    register_post_type('furniture', $args);

}

add_action('init', 'digicrab_three_fifty_furniture_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_furniture_messages($messages) {
    global $post, $post_ID;

    $messages['furniture'] = array(
        0 => '',
        1 => sprintf(__('Furniture updated. <a href="%s">View Furniture</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Furniture updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Furniture restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Furniture published. <a href="%s">View Furniture</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Furniture saved.'),
        8 => sprintf(__('Furniture submitted. <a target="_blank" href="%s">Preview Furniture</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Furniture scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Furniture</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Furniture draft updated. <a target="_blank" href="%s">Preview Furniture</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_furniture_messages');
