<?

/************************ REGISTER CASE STUDIES ************************************************************************************/

function digicrab_three_fifty_photographer_custom_posts() {
    $labels = array(
        'name'          => _x('Photographers', 'post type general name'),
        'singular_name' => _x('Photographer', 'post type singular name'),
        'add_new'       => _x('Add New Photographer', 'photographer'),
        'add_new_item'       => __('Add New Photographer'),
        'edit_item'          => __('Edit Photographer'),
        'new_item'           => __('New Photographer'),
        'all_items'          => __('All Photographers'),
        'view_item'          => __('View Photographer'),
        'search_items'       => __('Search Photographers'),
        'not_found'          => __('No Photographers found'),
        'not_found_in_trash' => __('No Photographers found in the Trash'),
        'parent_item_colon'  => '',
        'menu_name'          => 'Photographers'
    );

    $args = array(
        'labels'        => $labels,
        'description'   => 'Holds our photographers and photographer-specific data',
        'public'        => true,
        'menu_position' => 4,
        'menu_icon'   => 'dashicons-camera',
        'supports'      => array('title', 'editor', 'thumbnail', 'revisions', 'author'),
        'taxonomies' => array('post_tag'),
        'has_archive'   => true,
        'rewrite'       => array(
            'slug' => 'event-design/photographers',
            'with_front' => false,
            ),

    );

    register_post_type('photographer', $args);

}

add_action('init', 'digicrab_three_fifty_photographer_custom_posts');


/********************* CUSTOM MESSAGES **********************/

function my_updated_photographer_messages($messages) {
    global $post, $post_ID;

    $messages['photographer'] = array(
        0 => '',
        1 => sprintf(__('Photographers updated. <a href="%s">View Photographers</a>'), esc_url(get_permalink($post_ID))),
        2 => __('Custom field updated.'),
        3 => __('Custom field deleted.'),
        4 => __('Photographers updated.'),
        5 => isset($_GET['revision']) ? sprintf(__('Photographers restored to revision from %s'), wp_post_revision_title((int) $_GET['revision'], false)) : false,
        6 => sprintf(__('Photographers published. <a href="%s">View Photographers</a>'), esc_url(get_permalink($post_ID))),
        7 => __('Photographers saved.'),
        8 => sprintf(__('Photographers submitted. <a target="_blank" href="%s">Preview Photographers</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
        9 => sprintf(__('Photographers scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Photographers</a>'), date_i18n(__('M j, Y @ G:i'), strtotime($post->post_date)), esc_url(get_permalink($post_ID))),
        10 => sprintf(__('Photographers draft updated. <a target="_blank" href="%s">Preview Photographers</a>'), esc_url(add_query_arg('preview', 'true', get_permalink($post_ID)))),
    );

    return $messages;

}
add_filter('post_updated_messages', 'my_updated_photographer_messages');
