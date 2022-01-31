<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_cta_custom_posts() {
    $labels = array(
        'name'          => _x('Call to Actions', 'post type general name'),
        'singular_name' => _x('Call to Action', 'post type singular name'),
        'add_new'       => _x('Add New Call to Action', 'cta'),
        'add_new_item'       => __('Add New Call to Action'),
        'edit_item'          => __('Edit Call to Action'),
        'new_item'           => __('New Call to Action'),
        'all_items'          => __('All Call to Actions'),
        'view_item'          => __('View Call to Action'),
        'search_items'       => __('Search Call to Actions'),
        'not_found'          => __('No Call to Action found'),
        'not_found_in_trash' => __('No Call to Action found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Call to Actions'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our call to actions and call to action-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-phone',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'has_archive'   => false,
        'show_in_nav_menus'   => false,
        'publicly_queryable'  => false,
        'query_var'           => false,
    );

    register_post_type('cta', $args);

}

add_action('init', 'digicrab_three_fifty_cta_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_cta_messages($messages) {
    global $post, $post_ID;

    $messages['cta'] = array(
        0 => '',
        1 => sprintf(__('Call to Action updated. <a href="%s">View Call to Action</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Call to Action updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Call to Action restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Call to Action published. <a href="%s">View Call to Action</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Call to Action saved.'),
        8 => sprintf(__('Call to Action submitted. <a target="_blank" href="%s">Preview Call to Action</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Call to Action scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Call to Action</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Call to Action draft updated. <a target="_blank" href="%s">Preview Call to Action</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_cta_messages');
